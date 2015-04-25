<?php
/**
 * The default template for displaying Single pages
 *
 * @package WordPress
 * @subpackage StereoClub
 * @since StereoClub 1.0
 */
?>

<?php get_header(); ?>

<?php 
	$page_width = get_post_meta(get_the_ID(), 'wpl_sidebar_option', true);
?>
<!-- Main -->
<div id="main" class="site-main container_12">
	<!-- Left column -->
	<div id="primary" class="<?php if ( $page_width == 'on' ) { echo 'grid_8'; } else { echo 'grid_12'; } ?>">
		<?php while ( have_posts() ) : the_post(); // start of the loop.?>
			<!-- About Us -->
			<article class="single-post">
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<div class="clear"></div>
				</header>

				<div class="entry-content">
					<div class="entry-content-post">
						<?php the_content(); ?>
					</div>
					<div class="clear"></div>

				</div>

			</article>
		
		<?php endwhile; // end of the loop. ?>
	</div>
	
	<?php if ($page_width == 'on') { 
		get_sidebar('page');
	} ?>
	
	<div class="clear"></div>
</div>
<?php get_footer(); ?>
