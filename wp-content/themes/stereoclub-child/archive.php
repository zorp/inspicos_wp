<?php
/**
 * The default template for displaying Post Archive
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
	<div id="primary" class="grid_8">
		<!-- Latest posts  -->
			<header class="entry-header">
				<h1 class="entry-title"><?php single_cat_title(); ?></h1>
				<div class="clear"></div>
			</header>
				
			<div class="entry-content-list list-page news-list-page">
				
				<?php if ( $wp_query->have_posts() ) : ?>
					<?php $count = 0; ?>
					<?php while ( $wp_query->have_posts() ) : $wp_query->the_post();?>
					<?php
						$count++;
					?>

					<?php if ($count == 1) : ?>	

						<?php if ( has_post_thumbnail() ) { ?>
						<div class="profile-image grid_3 omega alpha no-m-t">
							<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium-thumb'); ?></a>
						</div>
						<div class="profile-text grid_4 omega no-m-t">
						<?php } else { ?>
						<div class="profile-text grid_7 omega alpha no-m-t">
						<?php }?>
							<h2 class="entry-head"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<time datetime="<?php echo get_the_date( 'c' ) ?>"><a href="<?php the_permalink(); ?>"><?php wplook_get_date(); ?></a></time>
							<p><?php echo wplook_short_excerpt(ot_get_option('wpl_events_excerpt_limit'));?>...</p>
							<a href="<?php the_permalink(); ?>" title="<?php _e('read more', 'wplook'); ?>" class="link-icon"><?php _e('read more', 'wplook'); ?></a>
						</div>
						<div class="clear"></div>

					<?php else : ?>

						<?php if ( has_post_thumbnail() ) { ?>
						<div class="profile-image grid_3 omega alpha no-m-t">
							<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium-thumb'); ?></a>
						</div>
						<div class="profile-text grid_4 omega no-m-t">
						<?php } else { ?>
						<div class="profile-text grid_7 omega alpha no-m-t">
						<?php }?>
							<h2 class="entry-head"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<time datetime="<?php echo get_the_date( 'c' ) ?>"><a href="<?php the_permalink(); ?>"><?php wplook_get_date(); ?></a></time>
							<p><?php echo wplook_short_excerpt(ot_get_option('wpl_events_excerpt_limit'));?>...</p>
							<a href="<?php the_permalink(); ?>" title="<?php _e('read more', 'wplook'); ?>" class="link-icon"><?php _e('read more', 'wplook'); ?></a>
						</div>
						<div class="clear"></div>

					<?php endif; ?>

					<?php	
					if ($wp_query->post_count != $count) {
						echo "<hr />";
					}
					?>
							
					<?php endwhile; wp_reset_postdata(); ?>

					<div class="clear"></div>

					<?php wplook_content_navigation('postnav' ) ?>
				
		<?php else : ?>
			<article class="single-post">

				<div class="entry-content">
					<br>
					<div class="entry-content-post">
						<br />
						<?php _e('Sorry, no events matched your criteria.', 'wplook'); ?>
					</div>
					<div class="clear"></div>

				</div>

			</article>

		<?php endif; ?>
		</div>
	</div> <!-- / #primary -->
	
<?php get_sidebar(); ?>
<div class="clear"></div>		
</div><!-- / #main -->
<?php get_footer(); ?>