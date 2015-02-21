<?php
/**
 * The default template for search results
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
		<!-- Search -->
			<header class="entry-header">
				<h1 class="page-title"><?php _e('Search Results for:', 'wplook'); ?> '<?php echo get_search_query(); ?>'</h1>
				<div class="clear"></div>
			</header>
				
			<div class="entry-content-list search-results">
				
				<?php if ( $wp_query->have_posts() ) : ?>
					
					<?php while ( $wp_query->have_posts() ) : $wp_query->the_post();?>
						<article id="post-<?php the_ID(); ?>" <?php post_class('list-block-item'); ?>>
							<div class="margins">
								<?php if ( has_post_thumbnail() ) { ?>
									<div class="entry-thumb">
										<?php the_post_thumbnail('small-thumb'); ?>
									</div>
								<?php } else { ?>
									<div class="entry-date">
										<div class="date"><?php echo get_the_date( 'j' ) ?></div>
										<div class="month"><?php echo get_the_date( 'M' ) ?></div>
									</div>
								<?php } ?>

								<div class="entry-description">
									<h1 class="entry-head"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
									<div class="short-description">
										<p><?php echo wplook_short_excerpt(ot_get_option('wpl_rest_events_excerpt_limit'));?></p>
									</div>
								</div>
								<div class="clear"></div>
							</div>
						</article>
							
					<?php endwhile; wp_reset_postdata(); ?>

					<div class="clear"></div>

					<?php wplook_content_navigation('postnav' ) ?>
				
		<?php else : ?>
			<article class="single-post">

				<div class="entry-content">
					<br>
					<div class="entry-content-post">
						<br />
						<?php _e('Sorry, no posts matched your criteria.', 'wplook'); ?>
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