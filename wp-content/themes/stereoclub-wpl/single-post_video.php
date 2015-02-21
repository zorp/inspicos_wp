<?php
/**
 * The default template for displaying SIngle video posts
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
<!-- Left column -->
<div id="main" class="site-main container_12">
	<div id="primary" class="<?php if ( $page_width == 'on' ) { echo 'grid_8'; } else { echo 'grid_12'; } ?>">
		<!-- Latest Posts -->
		
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php 
			$video_url = get_post_meta(get_the_ID(), 'wpl_video_url', true);
		?>
			<article class="single-post">
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php $share_buttons = get_post_meta(get_the_ID(), 'wpl_share_buttons_video', true); ?>
					<?php if ( $share_buttons !='off' ) {
						wplook_get_share_buttons();
					} ?>
					<div class="clear"></div>
				</header>
				<div class="entry-meta">
					<time datetime="2013-04-25T19:02:42+00:00" class="fleft"><?php wplook_get_date(); ?></time>
					<?php if ( wplook_custom_taxonomies_terms_links() ) { ?>
						<span class="category-selected fleft"><?php echo wplook_custom_taxonomies_terms_links(); ?></span>
					<?php } ?>
					<span class="likes fright"><?php echo getPostLikeLink(get_the_ID()); ?></span>
					<span class="views fright"><i class="icon-eye"></i><?php setPostViews(get_the_ID()); ?> <?php echo getPostViews(get_the_ID()); ?></span>
					<div class="clear"></div>
				</div>
				
				<div class="entry-content">
					
					<?php if ($video_url) { ?>
						<div class='fitvid entry-image-video'>
							<?php $embed_code = wp_oembed_get($video_url);
								echo $embed_code;
							?>
						</div>
					<?php } ?>

					<br />

					<div class="clear"></div>
					<div class="entry-content-post">
						<?php the_content(); ?>
					</div>
					<div class="clear"></div>

						<?php wplook_prev_next(); ?>

				</div>

			</article>

			<?php endwhile; endif; ?>
	</div>
	
	<?php if ($page_width == 'on') {
		get_sidebar('video');
	} ?>

	<div class="clear"></div>
</div>
<?php get_footer(); ?>
