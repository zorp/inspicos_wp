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
								<div class="grid_3 alpha no-m-b first">
									<?php dynamic_sidebar( 'f1-widgets' ); ?>
								</div>
							<?php endif; ?>

							<?php if ( is_active_sidebar( 'f2-widgets' ) ) : ?>					
								<!-- Second Widget Area -->
								<div class="grid_3 no-m-b second">
									<?php dynamic_sidebar( 'f2-widgets' ); ?>
								</div>
							<?php endif; ?>

							<?php if ( is_active_sidebar( 'f3-widgets' ) ) : ?>					
								<!-- Third Widget Area -->
								<div class="grid_3 omega no-m-b third">
									<?php dynamic_sidebar( 'f3-widgets' ); ?>
								</div>
							<?php endif; ?>

							<div class="grid_3 omega no-m-b fourth">
								<div class="cancer-logo">
									<a href="http://www.cancer.dk/om+os/The+Danish+Cancer+Society.htm" target="_blank"><img src="/wp-content/uploads/2015/11/Logo_EP_Hjemmeside_Dec15Dec16.jpg" alt="" /></a>
								</div>
							</div>

						<?php }	?>
					</div>
				<?php }	?>

				<?php if ( ot_get_option('wpl_copyright') != 'empty' ): ?>
					<!-- Site info -->
					<div id="site-info" class="grid_12">
						<div class="margins">
							<?php if ( ot_get_option('wpl_copyright') != 'empty' ){ echo ot_get_option('wpl_copyright'); } ?>
						</div>
					</div>
				<?php endif ?>

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