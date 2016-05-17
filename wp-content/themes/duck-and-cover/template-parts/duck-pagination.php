<div class="duck-pagination">
  <div class="prev">
    <?php
    // next_posts_link() usage with max_num_pages
    next_posts_link( 'Prev', $the_query->max_num_pages );
    ?>
  </div>
  <div class="next">
    <?php
    previous_posts_link( 'Next' );
    ?>
  </div>
</div>
<?php
// clean up after the query and pagination
wp_reset_postdata();
?>
