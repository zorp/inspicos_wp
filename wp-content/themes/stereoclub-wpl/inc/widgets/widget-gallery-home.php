<?php
/*
 * Plugin Name: Latest Gallery
 * Plugin URI: http://www.wplook.com
 * Description: Display the lates galleries
 * Author: Victor Tihai
 * Version: 1.0
 * Author URI: http://www.wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("wplook_latest_gallery_widget");'));
class wplook_latest_gallery_widget extends WP_Widget {

	
	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
	 		'wplook_latest_gallery_widget',
			'WPlook Latest Galleries',
			array( 'description' => __( 'A widget for displaying latest Galleries. This widget was designed to be used only on the left home page widget area.', 'wplook' ), )
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
			$title = __( 'Gallery', 'wplook' );
		}

		if ( $instance ) {
			$nr_posts = esc_attr( $instance[ 'nr_posts' ] );
		}
		else {
			$nr_posts = __( '4', 'wplook' );
		}

		if ( $instance ) {
			$display_type = esc_attr( $instance[ 'display_type' ] );
		}
		else {
			$display_type = __( 'random', 'wplook' );
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
				<label for="<?php echo $this->get_field_id('nr_posts'); ?>"> <?php _e('Number of galleries:', 'wplook'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('nr_posts'); ?>" name="<?php echo $this->get_field_name('nr_posts'); ?>" type="text" value="<?php echo $nr_posts; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('The number of galleries you want to display. For example: 3, 5, 7, 9', 'wplook'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('display_type'); ?>"><?php _e('Order:', 'wplook'); ?> <br /> </label>
				<select id="<?php echo $this->get_field_id('display_type'); ?>" name="<?php echo $this->get_field_name('display_type'); ?>">
					<option value="rand" <?php selected( 'rand', $display_type ); ?>><?php _e('Random', 'wplook'); ?></option>
					<option value="date" <?php selected( 'date', $display_type ); ?>><?php _e('Latest', 'wplook'); ?></option>
				</select>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('read_more_link'); ?>"> <?php _e('URL to all Galleries:', 'wplook'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('read_more_link'); ?>" name="<?php echo $this->get_field_name('read_more_link'); ?>" type="text" value="<?php echo $read_more_link; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('URL to all galleries', 'wplook'); ?></p>
			</p>

		<?php 
	}
	

	/*-----------------------------------------------------------------------------------*/
	/*	Processes widget options to be saved
	/*-----------------------------------------------------------------------------------*/
	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['nr_posts'] = sanitize_text_field($new_instance['nr_posts']);
		$instance['display_type'] = sanitize_text_field($new_instance['display_type']);
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
		$nr_posts = apply_filters( 'widget_nr_posts', $instance['nr_posts'] );
		$display_type = apply_filters( 'widget', $instance['display_type'] );
		$read_more_link = apply_filters( 'widget', $instance['read_more_link'] );
		?>
		

			
		<!-- Widget video -->
		<aside id="video-widget-<?php the_ID(); ?>" class="WPlookGalleryVidget">
			<header class="entry-header">
				<h1 class="entry-title"><?php echo $title ?></h1>
				<?php if ( $read_more_link != "") { ?>
					<div class="more-options">
						<a href="<?php echo $read_more_link; ?>" title="<?php _e('View all Videos', 'wplook'); ?>"><i class="icon-ellipsis-horizontal"></i></a>
					</div>
				<?php } ?>
				<div class="clear"></div>
			</header>
			
			<div class="entry-content-list">

				<ul class="grid cs-style-gallery">
					<?php $args = array( 'post_type' => 'post_gallery','post_status' => 'publish', 'posts_per_page' => $nr_posts, 'orderby' => $display_type); ?>
					<?php $wp_query = null; ?>
					<?php $wp_query = new WP_Query( $args ); ?>
					<?php if ( $wp_query->have_posts() ) : ?>
						<?php $count = 0; ?>
						<?php while ( $wp_query->have_posts() ) : $wp_query->the_post();?>
							<?php 
								$event_date = get_post_meta(get_the_ID(), 'wpl_event_date', true); 

							?>
							<?php $count++; ?>	
							<?php if ($count == 1) : ?>

								<li class='first-cs-style-item'>
									<a href="<?php the_permalink(); ?>">
										<figure>
											<?php if ( has_post_thumbnail() ) { 
												the_post_thumbnail('medium-large-thumb'); 
											} else { ?>
												<img src="<?php echo get_template_directory_uri() . '/images/temp/440x340.jpg' ?>">
											<?php } ?>

											<figcaption>
												<h3><?php wplook_get_date(); ?></h3>
												<div><?php the_title(); ?></div>
											</figcaption>
											<div class="clear"></div>
										</figure>
									</a>
								</li>

							<?php else : ?>	
								
								<li class='rest-cs-style-item'>
									<a href="<?php the_permalink(); ?>">
										<figure>
											<?php if ( has_post_thumbnail() ) { 
												the_post_thumbnail('medium-large-thumb'); 
											} else { ?>
												<img src="<?php echo get_template_directory_uri() . '/images/temp/440x340.jpg' ?>">
											<?php } ?>
											<figcaption>
												<h3><?php wplook_get_date(); ?></h3>
												<div><?php the_title(); ?></div>
											</figcaption>
										</figure>
									</a>
								</li>

							<?php endif; ?>

						<?php endwhile; wp_reset_postdata(); ?>
					
					<?php else : ?>

						<li class="single-post">
							<div class="entry-content">
								<?php _e('Sorry, no galleries matched your criteria.', 'wplook'); ?>
							</div>
							<div class="clear"></div>
						</li>

					<?php endif; ?>
					</ul>
					<div class="clear"></div>
					
				<?php wplook_content_navigation('postnav' ) ?>

			</div>
		</aside>


		<?php
	}
}
?>