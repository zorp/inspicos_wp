<?php
/**
 * The default template for displaying events archive
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
	
		<!-- Latest Events -->
		<header class="entry-header">
			<h1 class="entry-title"><?php single_cat_title(); ?></h1>
			<div class="clear"></div>
		</header>
			<div class="entry-content-list">

			<?php 
				$mySlugCategory = $wp_query->query["wpl_events_category"];
				
				$args = array(
					'post_type' => 'post_events', 
					'paged'=> $paged, 
					'meta_key' => 'wpl_event_date', 
					'orderby' => 'meta_value',
					'order' => 'DESC',
					'tax_query' => array(
						array(
							'taxonomy' => 'wpl_events_category',
							'field' => 'slug',
							'terms' => $mySlugCategory
						)
					)
				); 
			?>
							
			<?php $wp_query = null;
				$wp_query = new WP_Query( $args );
			?>

				<?php if ( $wp_query->have_posts() ) : ?>
					<?php $count = 0; ?>
					<?php while ( $wp_query->have_posts() ) : $wp_query->the_post();?>
					<?php
						$myid = get_the_ID();
						$event_date = get_post_meta($myid, 'wpl_event_date', true);
						$event_time = get_post_meta($myid, 'wpl_event_time', true);
						$event_status = get_post_meta($myid, 'wpl_events_status', true);
						$event_price = get_post_meta($myid, 'wpl_event_price', true);
						$event_url = get_post_meta($myid, 'wpl_event_url', true);
						$count++;
					?>

					<?php if ($count == 1) : ?>	

						<article class="latest-item">
							<?php if ( has_post_thumbnail() ) { ?>
								<div class="grid_4 alpha omega">
									<figure>
										<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail('medium-ver-thumb'); ?>
										</a>
									</figure>
								</div>
							<div class="grid_4 alpha omega">
							<?php } else { ?>
								<div class="grid_7  alpha">
							<?php }?>	
								<div class="entry-description">
									<h1 class="entry-head"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
									<div class="short-description">
										<p><?php echo wplook_short_excerpt(ot_get_option('wpl_events_excerpt_limit'));?></p>
									</div>
								</div>
							</div>
							<div class="clear"></div>
							<div class="entry-footer">
							
							<?php if ( $event_date !='' ) { ?>
								<time class="fleft" datetime="<?php echo date('c',strtotime($event_date)); ?>"><a href="<?php the_permalink(); ?>"><i class="icon-calendar"></i> <?php echo date_i18n( get_option('date_format'), strtotime($event_date) ); ?></a></time> 
							<?php } ?>

							<?php if ( $event_time !='' ) { ?>
								<span class="hour fleft"><a href="#"><i class="icon-clock"></i> <?php echo $event_time; ?></a></span>
							<?php } ?>

							<?php if ( $event_status =='soldout' ) { ?>
								<span class="buy fleft"><span><a href="<?php echo $event_url; ?>"><?php _e('Sold out', 'wplook'); ?></a></span></span>
							<?php } elseif ( $event_status =='canceled' ) {?>
								<span class="buy fleft"><span><a href="<?php echo $event_url; ?>"><?php _e('Canceled', 'wplook'); ?></a></span></span>
							<?php } elseif ( $event_status =='freeentry' ) {?>
								<span class="buy fleft"><span><a href="<?php echo $event_url; ?>"><?php _e('Free entry', 'wplook'); ?></a></span></span>
							<?php } elseif ( $event_status =='none' ) {
								// none
							} else { ?>
								<span class="buy fleft"><span class="price"><?php echo $event_price; ?></span>
									<span><a href="<?php echo $event_url; ?>"><?php _e('Buy', 'wplook'); ?></a></span>
								</span>
							<?php }?>

								<span class="button-readmore fright"><a href="<?php the_permalink(); ?>" title="<?php _e('join us', 'wplook'); ?>"><?php _e('join us', 'wplook'); ?></a></span>
								<div class="clear"></div>
							</div>
						</article>

					<?php else : ?>

						<div class="list-block-item">
							<div class="margins">
								<div class="entry-date">
									<div class="date"><?php echo date( ('j'), strtotime($event_date) ); ?></div>
									<div class="month"><?php echo date_i18n( ('M'), strtotime($event_date) ); ?></div>
								</div>
								<div class="entry-description">
									<h1 class="entry-head"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
									<div class="short-description">
										<p><?php echo wplook_short_excerpt(ot_get_option('wpl_rest_events_excerpt_limit'));?></p>
									</div>
								</div>
								<div class="clear"></div>
							</div>
						</div>

					<?php endif; ?>
							
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