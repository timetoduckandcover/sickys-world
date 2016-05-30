<?php
  $display_id = get_field('single_featured_product_image');
  $display_size = 'full-size';
  $display_array = wp_get_attachment_image_src($display_id, $display_size);
  $display_url = $display_array[0];
?>

<div id="single-featured-product-section">
  <div class="single-featured-image-area">
    <img src="<?php echo $display_url; ?>" alt="Single featured product image" class="img-full" />
  </div>
  <div class="single-featured-caption-area">
    <div class="single-featured-product-caption">
      <h3 class="uppercase"><?php the_field('single_featured_product_sub_header');?></h3>
      <h1 class="uppercase"><?php the_field('single_featured_product_main_header');?></h1>
      <p><?php the_field('single_featured_product_copy');?></p>
      <a href="<?php the_field('single_featured_product_link');?>" class="button"><?php the_field('single_featured_product_button_copy');?></a>
    </div>
  </div>
</div>
