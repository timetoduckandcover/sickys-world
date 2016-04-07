<?php
/**
 *
 * @package FaceWP
 */
?>
<?php
if ( 'no-sidebar' != FaceWPC()->get( 'facewp_abbey_sidebar_position' ) && FaceWPC()->get( 'facewp_abbey_sidebar' ) && is_active_sidebar( FaceWPC()->get( 'facewp_abbey_sidebar' ) ) ) : ?>
<div class="col-md-3 <?php echo esc_attr( FaceWPC()->get( 'facewp_abbey_sidebar_position' ) ); ?>">
    <aside class="sidebar">
        <?php dynamic_sidebar( FaceWPC()->get( 'facewp_abbey_sidebar' ) ); ?>
    </aside>
</div>
<?php endif; ?>