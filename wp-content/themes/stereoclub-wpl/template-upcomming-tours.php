<?php
/**
 * Template Name: Upcoming Tours Dates
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
		<?php $args = array(
			'post_type' => 'post_events', 
			'posts_per_page' => 20, 
			'paged'=> $paged, 
			'meta_key' => 'wpl_event_date', 
			'orderby' => 'meta_value',
			'order' => 'ASC',
			'meta_compare' => '>=',
			'meta_value' => date_i18n('Y-m-d')
		); ?>
		<!-- Latest Events -->
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<div class="clear"></div>
			</header>
				
			<div class="entry-content-list">
				<?php $wp_query = null;
				$wp_query = new WP_Query( $args ); ?>
				<?php if ( $wp_query->have_posts() ) : ?>
					<?php while ( $wp_query->have_posts() ) : $wp_query->the_post();?>
					<?php
						$event_date = get_post_meta(get_the_ID(), 'wpl_event_date', true);
						$event_time = get_post_meta($post->ID, 'wpl_event_time', true);
						$event_status = get_post_meta(get_the_ID(), 'wpl_events_status', true);
						$event_price = get_post_meta(get_the_ID(), 'wpl_event_price', true);
						$event_url = get_post_meta(get_the_ID(), 'wpl_event_url', true);
						$event_location = get_post_meta($post->ID, 'wpl_event_location', true);
						$event_place = get_post_meta($post->ID, 'wpl_event_city', true);
					?>

						<div class="toggle-event">
							<div class="expand-button">
								<time datetime="<?php echo date('c',strtotime($event_date)); ?>" class="fleft tours-date"><?php echo date_i18n( get_option('date_format'), strtotime($event_date) ); ?></time>
								<div class="place"><?php echo $event_place; ?></div>
								

								<?php if ( $event_status =='soldout' ) { ?>
									<span class="buy"><span class="tour-status"><a href="<?php echo $event_url; ?>"><?php _e('Sold out', 'wplook'); ?></a></span></span>
								<?php } elseif ( $event_status =='canceled' ) {?>
									<span class="buy"><span class="tour-status"><a href="<?php echo $event_url; ?>"><?php _e('Canceled', 'wplook'); ?></a></span></span>
								<?php } elseif ( $event_status =='freeentry' ) {?>
									<span class="buy"><span class="tour-status"><a href="<?php echo $event_url; ?>"><?php _e('Free entry', 'wplook'); ?></a></span></span>
								<?php } elseif ( $event_status =='none' ) { 
									//none
								} else { ?>
									<span class="buy">
										<span class="tour-status">
											<span><a href="<?php echo $event_url; ?>"><?php _e('Buy', 'wplook'); ?></a></span>
										</span>	
									</span>
								<?php } ?>

								<div class="location"><?php echo $event_location; ?></div>
								<div class="clear"></div>
							</div>
							<div class="expand">
								<div class="list-event-widget">
									<?php if ( has_post_thumbnail() ) { ?>
										<div class="entry-thumb">
											<?php the_post_thumbnail('small-thumb'); ?>
										</div>
									<?php } else { ?>
										<div class="entry-date">
											<div class="date"><?php echo date( ('j'), strtotime($event_date) ); ?></div>
											<div class="month"><?php echo date_i18n( ('M'), strtotime($event_date) ); ?></div>
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
							</div>
						</div>
				
							
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
	
<?php get_sidebar('events'); ?>
<div class="clear"></div>		
</div><!-- / #main -->
<?php get_footer(); ?>