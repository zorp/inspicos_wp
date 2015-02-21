<?php
/**
 * The footer template
 *
 * @package WordPress
 * @subpackage StereoClub
 * @since StereoClub 1.0
 */
?>
			<!-- Footer Widget area -->
			<footer id="colophon" class="site-footer container_12">
				<?php if ( ( ot_get_option('wpl_footer_widget_area') == 'on') ) { ?>
					<!-- Status info -->
					<div id="status-info" class="grid_12 no-p-b">
						
						<?php if ( ( ot_get_option('wpl_status') == 'on') ) { ?>
							<?php 
								$args = array(
									'post_type' => 'post',
									'ignore_sticky_posts'=> 1,
									'post_status' => 'publish',
									'tax_query' => array(
										array(
											'taxonomy' => 'post_format',
											'field' => 'slug',
											'terms' => array( 'post-format-status' )
										)
									)
								);
								
							?>
							
							<?php $wp_query = null; ?>
							<?php $wp_query = new WP_Query( $args ); ?>
							<?php if ( $wp_query->have_posts() ) : ?>
							<div class="status-title">
								<h1><?php _e('Status:', 'wplook'); ?></h1>
							</div>
								<div id="slider-status" class="flexslider">
									<ul class="slides">
									
										<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
											<li><a href="<?php the_permalink() ?>"><?php the_title() ?> - <?php wplook_get_date(); ?></a></li>
										<?php endwhile; wp_reset_postdata(); ?>
									
									</ul>
								</div>
							<div class="clear"></div>
							<?php endif; ?>
							<div class="clear"></div>
						<?php } ?>


						<?php if (is_active_sidebar( 'f1-widgets' ) || is_active_sidebar( 'f2-widgets' ) || is_active_sidebar( 'f3-widgets' ) ) { ?>

							<?php if ( is_active_sidebar( 'f1-widgets' ) ) : ?>					
								<!-- First Widget Area -->
								<div class="grid_4 alpha no-m-b">
									<?php dynamic_sidebar( 'f1-widgets' ); ?>
								</div>
							<?php endif; ?>

							<?php if ( is_active_sidebar( 'f2-widgets' ) ) : ?>					
								<!-- Second Widget Area -->
								<div class="grid_4 no-m-b">
									<?php dynamic_sidebar( 'f2-widgets' ); ?>
								</div>
							<?php endif; ?>

							<?php if ( is_active_sidebar( 'f3-widgets' ) ) : ?>					
								<!-- Third Widget Area -->
								<div class="grid_4 omega no-m-b">
									<?php dynamic_sidebar( 'f3-widgets' ); ?>
								</div>
							<?php endif; ?>

						<?php }	?>
					</div>
				<?php }	?>

				<!-- Site info -->
				<div id="site-info" class="grid_12"><div class="margins">
					<?php if ( ot_get_option('wpl_copyright') ){ echo ot_get_option('wpl_copyright'); } ?>  <?php _e('Designed by', 'wplook'); ?> <a href="https://wplook.com/theme/stereoclub/?utm_source=Footer-URL&utm_medium=link&utm_campaign=StereoClub" title="<?php _e('WPlook', 'wplook'); ?>" target="_blank">WPlook</a></div></div>

			</footer>
		</div>
	</div>
	
	<?php if ( ot_get_option('wpl_google_analytics_tracking_code') ) {
		// Google Analytics Tracking Code
		echo ot_get_option('wpl_google_analytics_tracking_code');
	} ?>

	<?php wp_footer(); ?>
	</body>
</html>