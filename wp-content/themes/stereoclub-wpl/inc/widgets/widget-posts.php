<?php
/*
 * Plugin Name: Posts
 * Plugin URI: http://www.wplook.com
 * Description: Add Posts on pages
 * Author: Victor Tihai
 * Version: 1.0
 * Author URI: http://www.wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("wplook_posts_widget");'));
class wplook_posts_widget extends WP_Widget {

	
	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
	 		'wplook_posts_widget',
			'WPlook Posts Home',
			array( 'description' => __( 'A widget for displaying latest Posts', 'wplook' ), )
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
			$title = __( 'Posts', 'wplook' );
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
						'taxonomy'  => 'category' 
					) 
				); ?>
				
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('nr_posts'); ?>"> <?php _e('Number of Posts:', 'wplook'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('nr_posts'); ?>" name="<?php echo $this->get_field_name('nr_posts'); ?>" type="text" value="<?php echo $nr_posts; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Number of posts you want to display', 'wplook'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('read_more_link'); ?>"> <?php _e('URL to all Posts:', 'wplook'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('read_more_link'); ?>" name="<?php echo $this->get_field_name('read_more_link'); ?>" type="text" value="<?php echo $read_more_link; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('View all posts URL', 'wplook'); ?></p>
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
		$read_more_link = apply_filters( 'widget', $instance['read_more_link'] );
		?>
		
		<?php

			if ( $categories < '1' ) {
				$args = array(
					'ignore_sticky_posts'=> 1,
					'post_type' => 'post',
					'post_status' => 'publish',
					'posts_per_page' => $nr_posts,
				);
			} else {
				$args = array(
					'ignore_sticky_posts'=> 1,
					'post_type' => 'post',
					'post_status' => 'publish',
					'posts_per_page' => $nr_posts,
					'cat' => $categories
				);
			}

			$posts = null;
			$posts = new WP_Query( $args );
		?>

			<?php if( $posts->have_posts() ) : ?>
			
				<!-- Latest Posts -->
				<aside id="latest-posts-<?php the_ID(); ?>" class="WPlooklatestposts widget">
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
						<?php while( $posts->have_posts() ) : $posts->the_post(); ?>
							<div class="list-block-item">
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
							</div>
						<?php endwhile; wp_reset_postdata(); ?>
						<div class="clear"></div>
					</div>
					
				</aside>

			<?php endif; ?>
		<?php
	}
}
?>