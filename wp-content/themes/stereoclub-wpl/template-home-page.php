<?php
/**
 * Template Name: Home page
 *
 * @package WordPress
 * @subpackage StereoClub
 * @since StereoClub 1.0.0
 */
?>

<?php get_header(); ?>

<?php get_template_part( 'inc', 'background-message' ); ?>
<!-- Main -->
<div id="main" class="site-main container_12">
	
	<!-- Left column -->
	
		<?php if ( is_active_sidebar( 'front-1' ) || is_active_sidebar( 'front-2' ) ) { ?>
			
			<?php if ( is_active_sidebar( 'front-1' ) ) : ?>
				<!-- First Widget Area -->
				<div id="primary" class="grid_8">
					<?php ! dynamic_sidebar( 'front-1' ); ?>
				</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'front-2' ) ) : ?>
				<!-- Second Widget Area -->
				<div id="secondary" class="grid_4 widget-area" role="complementary">
					<?php dynamic_sidebar( 'front-2' ); ?>
				</div>
			<?php endif; ?>


		<?php }	?>

	<div class="clear"></div>
</div><!-- / #main -->
		
	
<?php get_footer(); ?>