<?php
  $sunglasses_id = get_field('sunglasses_main_image');
  $sunglasses_size = 'full-size';
  $sunglasses_array = wp_get_attachment_image_src($sunglasses_id, $sunglasses_size);
  $sunglasses_url = $sunglasses_array[0];
  $sunglasses2_id = get_field('sunglasses_second_image');
  $sunglasses2_size = 'full-size';
  $sunglasses2_array = wp_get_attachment_image_src($sunglasses2_id, $sunglasses2_size);
  $sunglasses2_url = $sunglasses2_array[0];
  $sunglassesbg_id = get_field('sunglasses_background_image');
  $sunglassesbg_size = 'full-size';
  $sunglassesbg_array = wp_get_attachment_image_src($sunglassesbg_id, $sunglassesbg_size);
  $sunglassesbg_url = $sunglassesbg_array[0];
  $sunglassesbg2_id = get_field('sunglasses_second_background_image');
  $sunglassesbg2_size = 'full-size';
  $sunglassesbg2_array = wp_get_attachment_image_src($sunglassesbg2_id, $sunglassesbg2_size);
  $sunglassesbg2_url = $sunglassesbg2_array[0];
?>



<div id="sunglasses-section" style="background-image:url(<?php echo $sunglassesbg_url; ?>)">
  <div class="text-center sunglasses-section_top">
    <h2 class="header-2 uppercase"><?php the_field('sunglasses_main_header');?></h2>
    <img src="<?php echo $sunglasses_url; ?>" alt="Single featured product image" class="img-full" />
    <p><?php the_field('sunglasses_copy');?></p>
  </div>
  <div class="sunglasses-section_main" style="background-image:url(<?php echo $sunglassesbg2_url; ?>)">
    <div class="container">
      <h1 style="color:<?php the_field('sunglasses_second_header_color');?> !important"><?php the_field('sunglasses_second_header');?></h1>
      <div class="sunglasses-image-box" style="background-image:url(<?php echo $sunglasses2_url; ?>)">
        <a href="<?php the_field('sunglasses_link');?>" class="button">View</a>
      </div>
    </div>
  </div>
</div>
