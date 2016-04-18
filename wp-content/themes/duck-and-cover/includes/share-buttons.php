<ul class="share-buttons">
  <li>
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();?>" onclick="window.open(this.href, 'mywin','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;">
      <i class="fa fa-facebook"></i>
    </a>
  </li>
  <li>
    <a href="http://twitter.com/share?url=<?php the_permalink();?>&text=<?php echo wp_title('');?>" onclick="window.open(this.href, 'mywin','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;">
      <i class="fa fa-twitter"></i>
    </a>
  </li>
  <li>
    <a href="https://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&media=&description=<?php echo wp_title('');?>" onclick="window.open(this.href, 'mywin','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;">
      <i class="fa fa-pinterest"></i>
    </a>
  </li>
</ul>
