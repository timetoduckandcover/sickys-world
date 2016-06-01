<ul class="share-buttons">
  <?php if( get_field('instagram_page') ): ?>
  <li>
    <a href="https://www.instagram.com/<?php the_field('instagram_page');?>">
      <i class="fa fa-instagram"></i>
    </a>
  </li>
  <?php endif; ?>
  <?php if( get_field('facebook_page') ): ?>
  <li>
    <a href="https://www.facebook.com/<?php the_field('facebook_page');?>">
      <i class="fa fa-facebook"></i>
    </a>
  </li>
  <?php endif; ?>
  <?php if( get_field('twitter_page') ): ?>
  <li>
    <a href="https://www.twitter.com/<?php the_field('twitter_page');?>">
      <i class="fa fa-twitter"></i>
    </a>
  </li>
  <?php endif; ?>
</ul>
