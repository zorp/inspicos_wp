<?php
/**
 * The default template for displaying Single posts
 *
 * @package WordPress
 * @subpackage StereoClub
 * @since StereoClub 1.0
 */
?>

<?php get_header(); ?>
<div id="main" class="site-main container_12">
	<div id="primary" class="grid_8">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

		<?php endif; ?>

	</div>
	<?php get_sidebar(); ?>
	<div class="clear"></div>
</div>
<?php get_footer(); ?>
