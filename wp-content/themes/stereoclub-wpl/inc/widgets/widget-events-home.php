<?php
/*
 * Plugin Name: Events
 * Plugin URI: http://www.wplook.com
 * Description: Add Events on pages
 * Author: Victor Tihai
 * Version: 1.0
 * Author URI: http://www.wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("wplook_events_home_widget");'));
class wplook_events_home_widget extends WP_Widget {

	
	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
	 		'wplook_events_home_widget',
			'WPlook Events Home',
			array( 'description' => __( 'A widget for displaying upcomming or past events. This widget was designed to be used only on the left home page widget area.', 'wplook' ), )
		);
	}

	
	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the options form on admin
	/*-----------------------------------------------------------------------------------*/
	
	public function form( $instance ) {
		if ( $instance ) {
			$title = esc_attr( $instance[ 'title' ] );
		}
		else {
			$title = __( 'Events', 'wplook' );
		}

		if ( $instance ) {
			$categories = esc_attr( $instance[ 'categories' ] );
		}
		else {
			$categories = __( 'All', 'wplook' );
		}

		if ( $instance ) {
			$nr_posts = esc_attr( $instance[ 'nr_posts' ] );
		}
		else {
			$nr_posts = __( '4', 'wplook' );
		}

		if ( $instance ) {
			$event_type = esc_attr( $instance[ 'event_type' ] );
		}
		else {
			$event_type = __( '', 'wplook' );
		}

		if ( $instance ) {
			$read_more_link = esc_attr( $instance[ 'read_more_link' ] );
		}
		else {
			$read_more_link = __( '', 'wplook' );
		}

		?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title:', 'wplook'); ?> </label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('categories'); ?>">
				<?php _e('Category:', 'wplook'); ?>
				<br />
			</label>
			
			<?php wp_dropdown_categories(
				array( 
					'name'	=> $this->get_field_name("categories"),
					'show_option_all'    => __('All', 'wplook'),
					'show_count'	=> 1,
					'selected' => $categories,
					'taxonomy'  => 'wpl_events_category' 
				) 
			); ?>
			
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('nr_posts'); ?>"> <?php _e('Number of Events:', 'wplook'); ?> </label>
			<input class="widefat" id="<?php echo $this->get_field_id('nr_posts'); ?>" name="<?php echo $this->get_field_name('nr_posts'); ?>" type="text" value="<?php echo $nr_posts; ?>" />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Number of events you want to display', 'wplook'); ?></p>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('event_type'); ?>"><?php _e('Event Type:', 'wplook'); ?> <br /> </label>
			<select id="<?php echo $this->get_field_id('event_type'); ?>" name="<?php echo $this->get_field_name('event_type'); ?>">
				<option value="upcomming_events" <?php selected( 'upcomming_events', $event_type ); ?>><?php _e('Upcomming Events', 'wplook'); ?></option>
				<option value="past_events" <?php selected( 'past_events', $event_type ); ?>><?php _e('Past Events', 'wplook'); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('read_more_link'); ?>"> <?php _e('URL to all events:', 'wplook'); ?> </label>
			<input class="widefat" id="<?php echo $this->get_field_id('read_more_link'); ?>" name="<?php echo $this->get_field_name('read_more_link'); ?>" type="text" value="<?php echo $read_more_link; ?>" />
			<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('View all events URL', 'wplook'); ?></p>
		</p>
		
		<?php 
	}
	

	/*-----------------------------------------------------------------------------------*/
	/*	Processes widget options to be saved
	/*-----------------------------------------------------------------------------------*/
	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['categories'] = sanitize_text_field($new_instance['categories']);
		$instance['nr_posts'] = sanitize_text_field($new_instance['nr_posts']);
		$instance['event_type'] = sanitize_text_field($new_instance['event_type']);
		$instance['read_more_link'] = sanitize_text_field($new_instance['read_more_link']);
		return $instance;
	}


	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the content of the widget
	/*-----------------------------------------------------------------------------------*/

	public function widget( $args, $instance ) {
		global $post;
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$categories = apply_filters( 'widget_categories', $instance['categories'] );
		$nr_posts = apply_filters( 'widget', $instance['nr_posts'] );
		$event_type = apply_filters( 'widget', $instance['event_type'] );
		$read_more_link = apply_filters( 'widget', $instance['read_more_link'] );
		?>
		
		<?php

			if ( $categories < '1' ) {

				if ( $event_type == "past_events") {
					$args = array(
						'post_type' => 'post_events', 
						'posts_per_page' => $nr_posts, 
						'meta_key' => 'wpl_event_date', 
						'orderby' => 'meta_value',
						'order' => 'ASC',
						'meta_compare' => '<',
						'meta_value' => date_i18n('Y-m-d')
					);
				} else {
					$args = array(
						'post_type' => 'post_events', 
						'posts_per_page' => $nr_posts, 
						'meta_key' => 'wpl_event_date', 
						'orderby' => 'meta_value',
						'order' => 'ASC',
						'meta_compare' => '>=',
						'meta_value' => date_i18n('Y-m-d')
					);
				}

			} else {

				if ( $event_type == "past_events") {
					$args = array(
						'post_type' => 'post_events', 
						'posts_per_page' => $nr_posts, 
						'meta_key' => 'wpl_event_date', 
						'orderby' => 'meta_value',
						'order' => 'ASC',
						'meta_compare' => '<',
						'meta_value' => date_i18n('Y-m-d'),
						'tax_query' => array(
							array(
								'taxonomy' => 'wpl_events_category',
								'field' => 'id',
								'terms' => $categories
							)
						)
					);
				} else {
					$args = array(
						'post_type' => 'post_events', 
						'posts_per_page' => $nr_posts, 
						'meta_key' => 'wpl_event_date', 
						'orderby' => 'meta_value',
						'order' => 'ASC',
						'meta_compare' => '>=',
						'meta_value' => date_i18n('Y-m-d'),
						'tax_query' => array(
							array(
								'taxonomy' => 'wpl_events_category',
								'field' => 'id',
								'terms' => $categories
							)
						)
					);
				}
			}

			$events = null;
			$events = new WP_Query( $args );
		?>
		
			<?php if( $events->have_posts() ) : ?>
				<!-- Upcoming Events -->
				<aside id="upcomming-events-<?php the_ID(); ?>" class="WPlookevents WPlookeventshome widget upcomming-events">
					<header class="entry-header">
						<h1 class="entry-title"><?php echo $title ?></h1>
						<?php if ( $read_more_link != "") { ?>
							<div class="more-options">
								<a href="<?php echo $read_more_link; ?>" title="<?php _e('View all', 'wplook'); ?>"><i class="icon-ellipsis-horizontal"></i></a>
							</div>
						<?php } ?>
						<div class="clear"></div>
					</header>
					
					<div class="entry-content">

						<?php while( $events->have_posts() ) : $events->the_post(); ?>
							<?php
								$event_date = get_post_meta(get_the_ID(), 'wpl_event_date', true);
								$event_time = get_post_meta($post->ID, 'wpl_event_time', true);
								
							?>
							<article class="list-block-item">
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
							</article>
						<?php endwhile; wp_reset_postdata(); ?>
						<div class="clear"></div>
					</div>
				</aside>
			<?php endif; ?>
		<?php
	}
}
?>