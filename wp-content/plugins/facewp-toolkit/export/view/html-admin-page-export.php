<div class="wrapper">
	<div class="content">
		<table class="form-table">
			<tbody>
			<tr>
				<td scope="row" width="150"><h2><?php esc_html_e( 'Export', 'facewp-abbey' ); ?></h2></td>
			</tr>
			<tr valign="middle">
				<td>
					<form method="post" action="">
						<input type="hidden" name="export_option" value="widgets"/>
						<input type="submit" value="Export Widgets" name="export"/>
					</form>
					<br/>
					<form method="post" action="">
						<input type="hidden" name="export_option" value="menus"/>
						<input type="submit" value="Export Menus" name="export"/>
					</form>
					<br/>
					<form method="post" action="">
						<input type="hidden" name="export_option" value="page_options"/>
						<input type="submit" value="Export Page Options" name="export"/>
					</form>
					<br/>
					<form method="post" action="">
						<input type="hidden" name="export_option" value="woocommerce_settings"/>
						<input type="submit" value="Export WooCommerce" name="export"/>
					</form>
					<br/>

					<p>
						Widget Logic: You have go to <a
							href="<?php echo admin_url( 'widgets.php' ); ?>">Widgets page</a>, exports widget logic data
						and save to <b>{your_theme}/includes/dummy-data/{demo}/.
							NOTE: Change file name to 'widget_logic_options.txt'</b>.
					</p>
					<br/>

					<p>
						Essential Grid Export: You have go to <a
							href="<?php echo admin_url( 'admin.php?page=essential-grid-import-export' ); ?>">Essential
							Grid Export page</a>, exports customized components and save to <b>{your_theme}/includes/dummy-data/{demo}/
							NOTE: Change file to 'essential_grid.txt'</b>.
					</p>
					<br/>

					<p>
						Revolution Slider Export: You have go to <a
							href="<?php echo admin_url( 'admin.php?page=revslider&view=sliders' ); ?>">Revolution
							Sliders page</a>, exports each slider and save to <b>{your_theme}/includes/dummy-data/{demo}/rev_sliders/</b>.
					</p>
				</td>
			</tr>
			</tbody>
		</table>
	</div>
</div>