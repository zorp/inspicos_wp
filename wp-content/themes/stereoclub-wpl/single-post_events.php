<?php
/**
 * The default template for displaying Single causes
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
				<?php
					$event_date = get_post_meta(get_the_ID(), 'wpl_event_date', true);
					$event_time = get_post_meta($post->ID, 'wpl_event_time', true);
					$event_url = get_post_meta(get_the_ID(), 'wpl_event_url', true);
					$event_location = get_post_meta(get_the_ID(), 'wpl_event_location', true);
					$event_address = get_post_meta(get_the_ID(), 'wpl_event_address', true);

					$event_lat = get_post_meta(get_the_ID(), 'wpl_event_latitude', true);
					$event_lng = get_post_meta(get_the_ID(), 'wpl_event_longitude', true);
					$event_pin = get_post_meta(get_the_ID(), 'wpl_event_pin_map_icon', true);

					$event_flyer = get_post_meta(get_the_ID(), 'wpl_flyer_image', true);
					$event_flyer_position = get_post_meta(get_the_ID(), 'wpl_flyer_position_orizontal', array() );
					$event_status = get_post_meta(get_the_ID(), 'wpl_events_status', true);
					$event_price = get_post_meta(get_the_ID(), 'wpl_event_price', true);
					$event_url = get_post_meta(get_the_ID(), 'wpl_event_url', true);
				?>
				<article class="single-post event">
						<header class="entry-header">
							<h1 class="entry-title"><?php the_title(); ?></h1>
							<?php $share_buttons = get_post_meta(get_the_ID(), 'wpl_share_buttons_events', true); ?>
							<?php if ( $share_buttons !='off' ) {
								wplook_get_share_buttons();
							} ?>
							<div class="clear"></div>
						</header>
						<div class="entry-meta">
							<time datetime="2010-03-20" class="fleft"><?php echo date_i18n( get_option('date_format'), strtotime($event_date) ); ?></time>
							<span class="category-selected fleft"><?php echo date_i18n( ('l'), strtotime($event_date) ); ?></span>
							<?php if ( $event_time !='' ) { ?>
								<span class="hour fleft"><i class="icon-clock"></i> <?php echo $event_time; ?></span>
							<?php } ?>
							<?php if ( $event_status =='soldout' ) { ?>
								<span class="buy fright"><span><a href="<?php echo $event_url; ?>"><?php _e('Sold out', 'wplook'); ?></a></span></span>
							<?php } elseif ( $event_status =='canceled' ) {?>
								<span class="buy fright"><span><a href="<?php echo $event_url; ?>"><?php _e('Canceled', 'wplook'); ?></a></span></span>
							<?php } elseif ( $event_status =='freeentry' ) {?>
								<span class="buy fright"><span><a href="<?php echo $event_url; ?>"><?php _e('Free entry', 'wplook'); ?></a></span></span>
							<?php } elseif ( $event_status =='none' ) {
								// none
							} else { ?>
								<span class="buy fright"><span class="price"><?php echo $event_price; ?></span>
									<span><a href="<?php echo $event_url; ?>"><?php _e('Buy', 'wplook'); ?></a></span>
								</span>
							<?php } ?>
							<div class="clear"></div>
						</div>
						<?php if (! empty($event_flyer_position) && $event_flyer != '' ) { ?>

							<div class="entry-content-list">
								<figure>
									<a href="<?php echo $event_flyer; ?>" rel="prettyPhoto">
										<img src="<?php echo $event_flyer; ?>" alt="<?php the_title(); ?>">
									</a>	
								</figure>
							</div>

						<?php } ?>

						<div class="entry-content">

							<div class="clear"></div>
							<div class="entry-content-post">
								
								<?php if ( empty($event_flyer_position) && $event_flyer != '' ) { ?>
									
									<div class="grid_3 alpha">
										<figure>
											<a href="<?php echo $event_flyer; ?>" rel="prettyPhoto">
												<img src="<?php echo $event_flyer; ?>" alt="<?php the_title(); ?>">
											</a>	
										</figure>
									</div>
									<div class="grid_4 omega">

								<?php } else { ?>
									
									<div class="no-class">

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

		</div><!-- #content -->

		<?php get_sidebar('events'); ?>
		<div class="clear"></div>
</div> <!-- / #main -->	

<?php get_footer(); ?>