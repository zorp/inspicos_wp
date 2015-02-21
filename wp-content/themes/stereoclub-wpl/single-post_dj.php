<?php
/**
 * The default template for displaying Single Resident DJ
 *
 * @package WordPress
 * @subpackage StereoClub
 * @since StereoClub 1.0
 */
?>

<?php get_header(); ?>
<div id="main" class="site-main container_12">
	<!-- Left column -->
	<div id="primary" class="grid_8">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<!-- dj -->
		<article class="single-post event">
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php $share_buttons = get_post_meta(get_the_ID(), 'wpl_share_buttons_dj', true); ?>
					<?php if ( $share_buttons !='off' ) {
						wplook_get_share_buttons();
					} ?>
					<div class="clear"></div>
			</header>
			<div class="entry-meta">
				<?php if ( wplook_custom_taxonomies_terms_links() ) { ?>
					<span class="music-type fleft"><?php echo wplook_custom_taxonomies_terms_links(); ?></span>
				<?php } ?>

				<span class="likes fright"><?php echo getPostLikeLink(get_the_ID()); ?></span>
				<span class="views fright"><i class="icon-eye"></i><?php setPostViews(get_the_ID()); ?> <?php echo getPostViews(get_the_ID()); ?></span>
				<div class="clear"></div>
			</div>

			<div class="entry-content">

				<div class="clear"></div>
				<div class="entry-content-post">
							
					<?php if ( has_post_thumbnail() ) { ?>
						
						<div class="grid_3 alpha">
							<figure>
								<?php
									$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large-thumb');
									echo '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" rel="prettyPhoto" >';
									the_post_thumbnail('medium-thumb');
									echo '</a>';
								?>
							</figure>
						</div>
						<div class="grid_4 omega">

					<?php } else { ?>
						
						<div class="grid_7 alpha omega">

						<?php } ?>

						<?php the_content(); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>

				<?php wplook_prev_next(); ?>

			</div>

		</article>

		<?php endwhile; endif; ?>

	</div><!-- #primary -->

		<?php get_sidebar('dj'); ?>
		<div class="clear"></div>
</div> <!-- / #main -->	
<?php get_footer(); ?>