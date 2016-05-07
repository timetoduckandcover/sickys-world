<?php
  $category1_id = get_field('top_categories_image_1');
  $category1_size = 'full-size';
  $category1_array = wp_get_attachment_image_src($category1_id, $category1_size);
  $category1_url = $category1_array[0];
?>
<?php
  $category1hover_id = get_field('top_categories_image_1_hover');
  $category1hover_size = 'full-size';
  $category1hover_array = wp_get_attachment_image_src($category1hover_id, $category1hover_size);
  $category1hover_url = $category1hover_array[0];
?>
<?php
  $category2_id = get_field('top_categories_image_2');
  $category2_size = 'full-size';
  $category2_array = wp_get_attachment_image_src($category2_id, $category2_size);
  $category2_url = $category2_array[0];
?>
<?php
  $category2hover_id = get_field('top_categories_image_2_hover');
  $category2hover_size = 'full-size';
  $category2hover_array = wp_get_attachment_image_src($category2hover_id, $category2hover_size);
  $category2hover_url = $category2hover_array[0];
?>

<div class="duck-front-page-top-categories">
  <div class="row">
    <div class="col-xs-12 col-sm-6">
      <a href="<?php the_field('top_category_1_link');?>" class="duck-front-page-top-category">
        <div class="top-category-images">
          <img src="<?php echo $category1_url; ?>" alt="<?php echo $image['alt']; ?>" class="img-full top-cat-first" />
          <img src="<?php echo $category1hover_url; ?>" alt="<?php echo $image['alt']; ?>" class="img-full top-cat-second" />
        </div>
        <h3 class="header-2 uppercase"><?php the_field('top_category_1_name');?></h3>
      </a>
    </div>
    <div class="col-xs-12 col-sm-6">
      <a href="<?php the_field('top_category_2_link');?>" class="duck-front-page-top-category">
        <div class="top-category-images">
          <img src="<?php echo $category2_url; ?>" alt="<?php echo $image['alt']; ?>" class="img-full top-cat-first" />
          <img src="<?php echo $category2hover_url; ?>" alt="<?php echo $image['alt']; ?>" class="top-cat-second" />
        </div>
        <h3 class="header-2 uppercase"><?php the_field('top_category_2_name');?></h3>
      </a>
    </div>
  </div>
</div>
