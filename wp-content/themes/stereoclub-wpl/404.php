<?php
/**
 * The default template for 404 error page
 *
 * @package WordPress
 * @subpackage StereoClub
 * @since StereoClub 1.0
 */
?>

<?php get_header(); ?>
<!-- Main -->
<div id="main" class="site-main container_12">
	
	<!-- Left column -->
	<div id="primary" class="grid_12">
		
		<!-- Latest Posts -->
		<section id="404-error" class="WPlooklatestposts">
			<header class="entry-header">
				<h1 class="entry-title"><?php _e('Error 404', 'wplook'); ?></h1>
				<div class="clear"></div>
			</header>
			
			<div class="entry-content-list">

				<article class="error404 margins">
					<h3><?php _e('The page you were looking for could not be found.', 'wplook'); ?></h3>
					<br />
					<a target="_self" class="button medium orange square" href="<?php echo home_url( '/' ); ?>"><?php _e('Go to home page', 'wplook'); ?></a>
				</article>

			</div>

		</section>

	</div>
	
	<div class="clear"></div>
</div>
<?php get_footer(); ?>
