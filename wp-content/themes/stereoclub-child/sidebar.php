<?php
/**
 * The default Sidebar. It will appear on all Press/Blog pages
 *
 * @package WordPress
 * @subpackage StereoClub
 * @since StereoClub 1.0
 */
?>
<div id="secondary" class="grid_4 widget-area" role="complementary">
	<?php if ( ! dynamic_sidebar( 'post-1' ) ) : ?>
		<aside id="archives" class="widget">
			<div class="widget-title"><div class="entry-header"><h1 class="entry-title"><?php _e( 'Archives', 'wplook' ); ?></h1><div class="clear"></div></div>
			
			<ul>
				<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
			</ul>
		</aside>
	<?php endif; // end sidebar widget area ?>
</div>