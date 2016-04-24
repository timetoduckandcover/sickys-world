<?php
  $display_id = get_field('single_featured_product_image');
  $display_size = 'full-size';
  $display_array = wp_get_attachment_image_src($display_id, $display_size);
  $display_url = $display_array[0];
?>

<div id="single-featured-product-section">
  <div class="row">
    <div class="col-xs-12 col-sm-6">
      <img src="<?php echo $display_url; ?>" alt="Single featured product image" class="img-full" />
    </div>
    <div class="col-xs-12 col-sm-5">
      <div class="single-featured-product-caption">
        <h2 class="header-2 uppercase"><?php the_field('single_featured_product_sub_header');?></h2>
        <h1><?php the_field('single_featured_product_main_header');?></h1>
        <p>
          <?php the_field('single_featured_product_copy');?>
        </p>
        <a href="<?php the_field('single_featured_product_link');?>" class="button">View</a>
      </div>
    </div>
  </div>
</div>
