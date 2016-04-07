<?php
class TM_Importer extends TM_WP_Importer {
	var $preStringOption;
	var $results;
	var $getOptions;
	var $saveOptions;
	var $termNames;

	function import_posts_pages( $xml_file, $option_file, $step_number = 1, $numberOfSteps = 1 ) {
		//do the actual import
		$this->import_stepped( $xml_file, $step_number, $numberOfSteps );

		//Ensure the $wp_rewrite global is loaded
		global $wp_rewrite;
		//Call flush_rules() as a method of the $wp_rewrite object
		$wp_rewrite->flush_rules();

		return true;
	}

	/**
	 * The main controller for the actual import stage for pages, posts, etc
	 *
	 * @param string $file Path to the WXR file for importing
	 */
	function import_stepped( $file, $step_number = 1 ) {
		add_filter( 'import_post_meta_key', array( $this, 'is_valid_meta_key' ) );
		add_filter( 'http_request_timeout', array( &$this, 'bump_request_timeout' ) );

		$this->import_start( $file );

		$this->get_author_mapping();

		wp_suspend_cache_invalidation( true );

		$this->process_categories();
		$this->process_tags();
		$this->process_terms();

		$logs_dir               = dirname( $file ) . DIRECTORY_SEPARATOR;
		$menu_mapping_log       = $logs_dir . 'menu_mapping.txt';
		$processed_terms_log    = $logs_dir . 'processed_terms.txt';
		$processed_posts_log    = $logs_dir . 'processed_posts.txt';
		$menu_item_orphans_log  = $logs_dir . 'menu_item_orphans.txt';
		$missing_menu_items_log = $logs_dir . 'missing_menu_items.txt';
		$url_remap_log          = $logs_dir . 'url_remap.txt';
		$post_orphans_log       = $logs_dir . 'post_orphans.txt';
		$featured_images_log    = $logs_dir . 'featured_images.txt';

		require_once(ABSPATH . 'wp-admin/includes/file.php');
		WP_Filesystem();
		global $wp_filesystem;

		if ( 0 == $step_number ) {
			@unlink( $menu_mapping_log );
			@unlink( $processed_terms_log );
			@unlink( $processed_posts_log );
			@unlink( $menu_item_orphans_log );
			@unlink( $missing_menu_items_log );
			@unlink( $url_remap_log );
			@unlink( $post_orphans_log );
			@unlink( $featured_images_log );
		}

		if ( file_exists( $menu_mapping_log ) ) {
			@$this->processed_menu_items = json_decode( $wp_filesystem->get_contents( $menu_mapping_log ), true );
		}
		if ( file_exists( $processed_terms_log ) ) {
			@$this->processed_terms = json_decode( $wp_filesystem->get_contents( $processed_terms_log ), true );
		}
		if ( file_exists( $processed_posts_log ) ) {
			@$this->processed_posts = json_decode( $wp_filesystem->get_contents( $processed_posts_log ), true );
		}
		if ( file_exists( $menu_item_orphans_log ) ) {
			@$this->menu_item_orphans = json_decode( $wp_filesystem->get_contents( $menu_item_orphans_log ), true );
		}
		if ( file_exists( $missing_menu_items_log ) ) {
			@$this->missing_menu_items = json_decode( $wp_filesystem->get_contents( $missing_menu_items_log ), true );
		}
		if ( file_exists( $url_remap_log ) ) {
			@$this->url_remap = json_decode( $wp_filesystem->get_contents( $url_remap_log ), true );
		}
		if ( file_exists( $post_orphans_log ) ) {
			@$this->post_orphans = json_decode( $wp_filesystem->get_contents( $post_orphans_log ), true );
		}
		if ( file_exists( $featured_images_log ) ) {
			@$this->featured_images = json_decode( $wp_filesystem->get_contents( $featured_images_log ), true );
		}

		//the processing of posts is stepped
		$posts_result = $this->process_posts_stepped( $step_number );
		wp_suspend_cache_invalidation( false );

		//we do this only on the last step
		if ( $posts_result[0] >= $posts_result[1] ) {
			//we process the menus because there are problems when the pages, posts, etc that don't first exist
			$this->process_menus();
		}

		if ( $this->processed_menu_items ) {
			$wp_filesystem->put_contents( $menu_mapping_log, json_encode( $this->processed_menu_items ), FS_CHMOD_FILE );
		}
		if ( $this->processed_terms ) {
			$wp_filesystem->put_contents( $processed_terms_log, json_encode( $this->processed_terms ), FS_CHMOD_FILE );
		}
		if ( $this->processed_posts ) {
			$wp_filesystem->put_contents( $processed_posts_log, json_encode( $this->processed_posts ), FS_CHMOD_FILE );
		}
		if ( $this->menu_item_orphans ) {
			$wp_filesystem->put_contents( $menu_item_orphans_log, json_encode( $this->menu_item_orphans ), FS_CHMOD_FILE );
		}
		if ( $this->missing_menu_items ) {
			$wp_filesystem->put_contents( $missing_menu_items_log, json_encode( $this->missing_menu_items ), FS_CHMOD_FILE );
		}
		if ( $this->url_remap ) {
			$wp_filesystem->put_contents( $url_remap_log, json_encode( $this->url_remap ), FS_CHMOD_FILE );
		}
		if ( $this->post_orphans ) {
			$wp_filesystem->put_contents( $post_orphans_log, json_encode( $this->post_orphans ), FS_CHMOD_FILE );
		}
		if ( $this->featured_images ) {
			$wp_filesystem->put_contents( $featured_images_log, json_encode( $this->featured_images ), FS_CHMOD_FILE );
		}

		// update incorrect/missing information in the DB
		$this->backfill_parents();
		$this->backfill_attachment_urls();
		$this->remap_featured_images();

		$this->import_end();

		return $posts_result;
	}

	/**
	 * Create new posts based on import information
	 * Posts marked as having a parent which doesn't exist will become top level items.
	 * Doesn't create a new post if: the post type doesn't exist, the given post ID
	 * is already noted as imported or a post with the same title and date already exists.
	 * Note that new/updated terms, comments and meta are imported for the last of the above.
	 */
	function process_posts_stepped( $step_number = 1 ) {
		$this->posts = apply_filters( 'wp_import_posts', $this->posts );

		//get the total number of posts (actual posts, pages, custom posts, menus, etc)
		$number_of_posts = count( $this->posts );

		if ( 0 == $step_number ) {
			$step_number = 1;
		} else {
			$step_number += 2;
		}
		
		$current_position = $step_number - 1;

		//get only the posts for the current step
		$current_posts = array_slice( $this->posts, $current_position, 2 );

		foreach ( $current_posts as $post ) {

			$post = apply_filters( 'wp_import_post_data_raw', $post );

			if ( ! post_type_exists( $post['post_type'] ) ) {
				printf( __( 'Failed to import "%s": Invalid post type %s', 'listable' ), esc_html( $post['post_title'] ), esc_html( $post['post_type'] ) );
				echo '<br />';
				do_action( 'wp_import_post_exists', $post );
				continue;
			}

			if ( isset( $this->processed_posts[ $post['post_id'] ] ) && ! empty( $post['post_id'] ) ) {
				continue;
			}

			if ( $post['status'] == 'auto-draft' || $post['status'] == 'draft' ) {
				continue;
			}

			if ( 'nav_menu_item' == $post['post_type'] ) {
				//we will add the menus at the end of the last step
				//$this->process_menu_item( $post );
				continue;
			}

			$post_type_object = get_post_type_object( $post['post_type'] );

			$post_exists = post_exists( $post['post_title'] );
			if ( $post_exists && get_post_type( $post_exists ) == $post['post_type'] ) {
				//printf( __('%s &#8220;%s&#8221; already exists.', 'listable'), $post_type_object->labels->singular_name, esc_html($post['post_title']) );
				//echo '<br />';

				//save it for later check if it exists - it may be unattached to it's parent
				$post_parent = (int) $post['post_parent'];
				if ( $post_parent ) {
					// if we already know the parent, map it to the new local ID
					if ( isset( $this->processed_posts[ $post_parent ] ) ) {
						$post_parent = $this->processed_posts[ $post_parent ];
						// otherwise record the parent for later
					} else {
						$this->post_orphans[ intval( $post['post_id'] ) ] = $post_parent;
						$post_parent                                      = 0;
					}
				}

				$comment_post_ID = $post_id = $post_exists;
			} else {
				$post_parent = (int) $post['post_parent'];
				if ( $post_parent ) {
					// if we already know the parent, map it to the new local ID
					if ( isset( $this->processed_posts[ $post_parent ] ) ) {
						$post_parent = $this->processed_posts[ $post_parent ];
						// otherwise record the parent for later
					} else {
						$this->post_orphans[ intval( $post['post_id'] ) ] = $post_parent;
						$post_parent                                      = 0;
					}
				}

				// map the post author
				$author = sanitize_user( $post['post_author'], true );
				if ( isset( $this->author_mapping[ $author ] ) ) {
					$author = $this->author_mapping[ $author ];
				} else {
					$author = (int) get_current_user_id();
				}

				$postdata = array(
					'import_id'      => $post['post_id'],
					'post_author'    => $author,
					'post_date'      => $post['post_date'],
					'post_date_gmt'  => $post['post_date_gmt'],
					'post_content'   => $post['post_content'],
					'post_excerpt'   => $post['post_excerpt'],
					'post_title'     => $post['post_title'],
					'post_status'    => $post['status'],
					'post_name'      => $post['post_name'],
					'comment_status' => $post['comment_status'],
					'ping_status'    => $post['ping_status'],
					'guid'           => $post['guid'],
					'post_parent'    => $post_parent,
					'menu_order'     => $post['menu_order'],
					'post_type'      => $post['post_type'],
					'post_password'  => $post['post_password']
				);

				$original_post_ID = $post['post_id'];
				$postdata         = apply_filters( 'wp_import_post_data_processed', $postdata, $post );

				if ( 'attachment' == $postdata['post_type'] ) {
					$remote_url = ! empty( $post['attachment_url'] ) ? $post['attachment_url'] : $post['guid'];

					// try to use _wp_attached file for upload folder placement to ensure the same location as the export site
					// e.g. location is 2003/05/image.jpg but the attachment post_date is 2010/09, see media_handle_upload()
					$postdata['upload_date'] = $post['post_date'];
					if ( isset( $post['postmeta'] ) ) {
						foreach ( $post['postmeta'] as $meta ) {
							if ( $meta['key'] == '_wp_attached_file' ) {
								if ( preg_match( '%^[0-9]{4}/[0-9]{2}%', $meta['value'], $matches ) ) {
									$postdata['upload_date'] = $matches[0];
								}
								break;
							}
						}
					}

					$comment_post_ID = $post_id = $this->process_attachment( $postdata, $remote_url );
				} else {
					$comment_post_ID = $post_id = wp_insert_post( $postdata, true );
					do_action( 'wp_import_insert_post', $post_id, $original_post_ID, $postdata, $post );
				}

				if ( is_wp_error( $post_id ) ) {
					printf( __( 'Failed to import %s "%s"', 'listable' ), $post_type_object->labels->singular_name, esc_html( $post['post_title'] ) );
					if ( defined( 'IMPORT_DEBUG' ) && IMPORT_DEBUG ) {
						echo ': ' . $post_id->get_error_message();
					}
					echo '<br />';
					continue;
				}

				if ( $post['is_sticky'] == 1 ) {
					stick_post( $post_id );
				}
			}

			// map pre-import ID to local ID
			$this->processed_posts[ intval( $post['post_id'] ) ] = (int) $post_id;

			if ( ! isset( $post['terms'] ) ) {
				$post['terms'] = array();
			}

			$post['terms'] = apply_filters( 'wp_import_post_terms', $post['terms'], $post_id, $post );

			// add categories, tags and other terms
			if ( ! empty( $post['terms'] ) ) {
				$terms_to_set = array();
				foreach ( $post['terms'] as $term ) {
					// back compat with WXR 1.0 map 'tag' to 'post_tag'
					$taxonomy    = ( 'tag' == $term['domain'] ) ? 'post_tag' : $term['domain'];
					$term_exists = term_exists( $term['slug'], $taxonomy );
					$term_id     = is_array( $term_exists ) ? $term_exists['term_id'] : $term_exists;
					if ( ! $term_id ) {
						$t = wp_insert_term( $term['name'], $taxonomy, array( 'slug' => $term['slug'] ) );
						if ( ! is_wp_error( $t ) ) {
							$term_id = $t['term_id'];
							do_action( 'wp_import_insert_term', $t, $term, $post_id, $post );
						} else {
							printf( __( 'Failed to import %s %s', 'listable' ), esc_html( $taxonomy ), esc_html( $term['name'] ) );
							if ( defined( 'IMPORT_DEBUG' ) && IMPORT_DEBUG ) {
								echo ': ' . $t->get_error_message();
							}
							echo '<br />';
							do_action( 'wp_import_insert_term_failed', $t, $term, $post_id, $post );
							continue;
						}
					}
					$terms_to_set[ $taxonomy ][] = intval( $term_id );
				}

				foreach ( $terms_to_set as $tax => $ids ) {
					$tt_ids = wp_set_post_terms( $post_id, $ids, $tax );
					do_action( 'wp_import_set_post_terms', $tt_ids, $ids, $tax, $post_id, $post );
				}
				unset( $post['terms'], $terms_to_set );
			}

			if ( ! isset( $post['comments'] ) ) {
				$post['comments'] = array();
			}

			$post['comments'] = apply_filters( 'wp_import_post_comments', $post['comments'], $post_id, $post );

			// add/update comments
			if ( ! empty( $post['comments'] ) ) {
				$num_comments      = 0;
				$inserted_comments = array();
				foreach ( $post['comments'] as $comment ) {
					$comment_id                                         = $comment['comment_id'];
					$newcomments[ $comment_id ]['comment_post_ID']      = $comment_post_ID;
					$newcomments[ $comment_id ]['comment_author']       = $comment['comment_author'];
					$newcomments[ $comment_id ]['comment_author_email'] = $comment['comment_author_email'];
					$newcomments[ $comment_id ]['comment_author_IP']    = $comment['comment_author_IP'];
					$newcomments[ $comment_id ]['comment_author_url']   = $comment['comment_author_url'];
					$newcomments[ $comment_id ]['comment_date']         = $comment['comment_date'];
					$newcomments[ $comment_id ]['comment_date_gmt']     = $comment['comment_date_gmt'];
					$newcomments[ $comment_id ]['comment_content']      = $comment['comment_content'];
					$newcomments[ $comment_id ]['comment_approved']     = $comment['comment_approved'];
					$newcomments[ $comment_id ]['comment_type']         = $comment['comment_type'];
					$newcomments[ $comment_id ]['comment_parent']       = $comment['comment_parent'];
					$newcomments[ $comment_id ]['commentmeta']          = isset( $comment['commentmeta'] ) ? $comment['commentmeta'] : array();
					if ( isset( $this->processed_authors[ $comment['comment_user_id'] ] ) ) {
						$newcomments[ $comment_id ]['user_id'] = $this->processed_authors[ $comment['comment_user_id'] ];
					}
				}
				ksort( $newcomments );

				foreach ( $newcomments as $key => $comment ) {
					// if this is a new post we can skip the comment_exists() check
					if ( ! $post_exists || ! comment_exists( $comment['comment_author'], $comment['comment_date'] ) ) {
						if ( isset( $inserted_comments[ $comment['comment_parent'] ] ) ) {
							$comment['comment_parent'] = $inserted_comments[ $comment['comment_parent'] ];
						}
						$comment                   = wp_filter_comment( $comment );
						$inserted_comments[ $key ] = wp_insert_comment( $comment );
						do_action( 'wp_import_insert_comment', $inserted_comments[ $key ], $comment, $comment_post_ID, $post );

						foreach ( $comment['commentmeta'] as $meta ) {
							$value = maybe_unserialize( $meta['value'] );
							add_comment_meta( $inserted_comments[ $key ], $meta['key'], $value );
						}

						$num_comments ++;
					}
				}
				unset( $newcomments, $inserted_comments, $post['comments'] );
			}

			if ( ! isset( $post['postmeta'] ) ) {
				$post['postmeta'] = array();
			}

			$post['postmeta'] = apply_filters( 'wp_import_post_meta', $post['postmeta'], $post_id, $post );

			// add/update post meta
			if ( ! empty( $post['postmeta'] ) ) {
				foreach ( $post['postmeta'] as $meta ) {
					$key   = apply_filters( 'import_post_meta_key', $meta['key'], $post_id, $post );
					$value = false;

					if ( '_edit_last' == $key ) {
						if ( isset( $this->processed_authors[ intval( $meta['value'] ) ] ) ) {
							$value = $this->processed_authors[ intval( $meta['value'] ) ];
						} else {
							$key = false;
						}
					}

					if ( $key ) {
						// export gets meta straight from the DB so could have a serialized string
						if ( ! $value ) {
							$value = maybe_unserialize( $meta['value'] );
						}

						add_post_meta( $post_id, $key, $value );
						do_action( 'import_post_meta', $post_id, $key, $value );

						// if the post has a featured-classic image, take note of this in case of remap
						if ( '_thumbnail_id' == $key ) {
							$this->featured_images[ $post_id ] = (int) $value;
						}
					}
				}
			}
		}
		unset( $current_posts );
		
		return array( $step_number, $number_of_posts );
	}

	/**
	 * Performs post-import cleanup of files and the cache
	 */
	function import_end() {
		unset( $this->posts );
		wp_import_cleanup( $this->id );

		wp_cache_flush();
		foreach ( get_taxonomies() as $tax ) {
			delete_option( "{$tax}_children" );
			_get_term_hierarchy( $tax );
		}

		wp_defer_term_counting( false );
		wp_defer_comment_counting( false );

		//echo '<p>' . __( 'All done.', 'listable' ) . ' <a href="' . admin_url() . '">' . __( 'Have fun!', 'listable' ) . '</a>' . '</p>';
		//echo '<p>' . __( 'Remember to update the passwords and roles of imported users.', 'listable' ) . '</p>';

		do_action( 'import_end' );
	}

	/**
	 * Create new menu items based on import information
	 * Posts marked as having a parent which doesn't exist will become top level items.
	 * Doesn't create a new post if: the post type doesn't exist, the given post ID
	 * is already noted as imported or a post with the same title and date already exists.
	 * Note that new/updated terms, comments and meta are imported for the last of the above.
	 */
	function process_menus() {
		$this->posts = apply_filters( 'wp_import_posts', $this->posts );
		foreach ( $this->posts as $post ) {
			$post = apply_filters( 'wp_import_post_data_raw', $post );

			//			if ( ! post_type_exists( $post['post_type'] ) ) {
			//				printf( __( 'Failed to import &#8220;%s&#8221;: Invalid post type %s', 'listable' ),
			//					esc_html($post['post_title']), esc_html($post['post_type']) );
			//				echo '<br />';
			//				do_action( 'wp_import_post_exists', $post );
			//				continue;
			//			}

			if ( isset( $this->processed_posts[ $post['post_id'] ] ) && ! empty( $post['post_id'] ) ) {
				continue;
			}

			if ( $post['status'] == 'auto-draft' ) {
				continue;
			}

			if ( 'nav_menu_item' == $post['post_type'] ) {
				$this->process_menu_item( $post );
			}
		}
	}

	/**
	 * Attempt to create a new menu item from import data
	 * Fails for draft, orphaned menu items and those without an associated nav_menu
	 * or an invalid nav_menu term. If the post type or term object which the menu item
	 * represents doesn't exist then the menu item will not be imported (waits until the
	 * end of the import to retry again before discarding).
	 *
	 * @param array $item Menu item details from WXR file
	 */
	function process_menu_item( $item ) {

		// skip draft, orphaned menu items
		if ( 'draft' == $item['status'] ) {
			return;
		}

		$menu_slug = false;
		if ( isset( $item['terms'] ) ) {
			// loop through terms, assume first nav_menu term is correct menu
			foreach ( $item['terms'] as $term ) {
				if ( 'nav_menu' == $term['domain'] ) {
					$menu_slug = $term['slug'];
					break;
				}
			}
		}

		// no nav_menu term associated with this menu item
		if ( ! $menu_slug ) {
			_e( 'Menu item skipped due to missing menu slug', 'listable' );
			echo '<br />';

			return;
		}

		$menu_id = term_exists( $menu_slug, 'nav_menu' );
		if ( ! $menu_id ) {
			printf( __( 'Menu item skipped due to invalid menu slug: %s', 'listable' ), esc_html( $menu_slug ) );
			echo '<br />';

			return;
		} else {
			$menu_id = is_array( $menu_id ) ? $menu_id['term_id'] : $menu_id;
		}

		foreach ( $item['postmeta'] as $meta ) {
			$$meta['key'] = $meta['value'];
		}


		if ( 'taxonomy' == $_menu_item_type && isset( $this->processed_terms[ intval( $_menu_item_object_id ) ] ) ) {
			$_menu_item_object_id = $this->processed_terms[ intval( $_menu_item_object_id ) ];
		} else if ( 'post_type' == $_menu_item_type && isset( $this->processed_posts[ intval( $_menu_item_object_id ) ] ) ) {
			$_menu_item_object_id = $this->processed_posts[ intval( $_menu_item_object_id ) ];
		} else if ( 'custom' != $_menu_item_type ) {
			// associated object is missing or not imported yet, we'll retry later
			$this->missing_menu_items[] = $item;

			return;
		}

		if ( isset( $this->processed_menu_items[ intval( $_menu_item_menu_item_parent ) ] ) ) {
			$_menu_item_menu_item_parent = $this->processed_menu_items[ intval( $_menu_item_menu_item_parent ) ];
		} else if ( $_menu_item_menu_item_parent ) {
			$this->menu_item_orphans[ intval( $item['post_id'] ) ] = (int) $_menu_item_menu_item_parent;
			$_menu_item_menu_item_parent                           = 0;
		}

		// wp_update_nav_menu_item expects CSS classes as a space separated string
		$_menu_item_classes = maybe_unserialize( $_menu_item_classes );
		if ( is_array( $_menu_item_classes ) ) {
			$_menu_item_classes = implode( ' ', $_menu_item_classes );
		}

		$args = array(
			'menu-item-object-id'   => $_menu_item_object_id,
			'menu-item-object'      => $_menu_item_object,
			'menu-item-parent-id'   => $_menu_item_menu_item_parent,
			'menu-item-position'    => intval( $item['menu_order'] ),
			'menu-item-type'        => $_menu_item_type,
			'menu-item-title'       => $item['post_title'],
			'menu-item-url'         => $_menu_item_url,
			'menu-item-description' => $item['post_content'],
			'menu-item-attr-title'  => $item['post_excerpt'],
			'menu-item-target'      => $_menu_item_target,
			'menu-item-classes'     => $_menu_item_classes,
			'menu-item-xfn'         => $_menu_item_xfn,
			'menu-item-status'      => $item['status'],

			'menu-item-nolink'                 => isset( $_menu_item_nolink ) ? $_menu_item_nolink : '',
			'menu-item-hide'                   => isset( $_menu_item_hide ) ? $_menu_item_hide : '',
			'menu-item-menu_type'              => isset( $_menu_item_menu_type ) ? $_menu_item_menu_type : '',
			'menu-item-sub_menu_position'      => isset( $_menu_item_sub_menu_position ) ? $_menu_item_sub_menu_position : '',
			'menu-item-sub_menu_columns'       => isset( $_menu_item_sub_menu_columns ) ? $_menu_item_sub_menu_columns : '',
			'menu-item-columns'                => isset( $_menu_item_columns ) ? $_menu_item_columns : '',
			'menu-item-background_image'       => isset( $_menu_item_background_image ) ? $_menu_item_background_image : '',
			'menu-item-background_position'    => isset( $_menu_item_background_position ) ? $_menu_item_background_position : '',
			'menu-item-background_repeat'      => isset( $_menu_item_background_repeat ) ? $_menu_item_background_repeat : '',
			'menu-item-icon_class'             => isset( $_menu_item_icon_class ) ? $_menu_item_icon_class : '',
			'menu-item-badge_label'            => isset( $_menu_item_badge_label ) ? $_menu_item_badge_label : '',
			'menu-item-badge_text_color'       => isset( $_menu_item_badge_text_color ) ? $_menu_item_badge_text_color : '',
			'menu-item-badge_background_color' => isset( $_menu_item_badge_background_color ) ? $_menu_item_badge_background_color : '',
			'menu-item-widget_area'            => isset( $_menu_item_widget_area ) ? $_menu_item_widget_area : '',
		);

		$id = wp_update_nav_menu_item( $menu_id, 0, $args );
		if ( $id && ! is_wp_error( $id ) ) {

			if ( isset( $wpgrade_megamenu_layout ) ) {
				$args['wpgrade_megamenu_layout'] = $wpgrade_megamenu_layout;
				update_post_meta( $id, 'wpgrade_megamenu_layout', $args['wpgrade_megamenu_layout'] );
			}

			$this->processed_menu_items[ intval( $item['post_id'] ) ] = (int) $id;
		}
	}
}
