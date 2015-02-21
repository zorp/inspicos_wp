<?php
/*
 * Plugin Name: Latest video widget
 * Plugin URI: http://www.wplook.com
 * Description: Display the lates video
 * Author: Victor Tihai
 * Version: 1.0
 * Author URI: http://www.wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("wplook_cd_widget");'));
class wplook_cd_widget extends WP_Widget {

	
	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
	 		'wplook_cd_widget',
			'WPlook CD',
			array( 'description' => __( 'A widget for displaying CD', 'wplook' ), )
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
			$title = __( 'CD', 'wplook' );
		}

		if ( $instance ) {
			$categories = esc_attr( $instance[ 'categories' ] );
		}
		else {
			$categories = __( 'All', 'wplook' );
		}
		if ( $instance ) {
			$display_type = esc_attr( $instance[ 'display_type' ] );
		}
		else {
			$display_type = __( 'random', 'wplook' );
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
						'taxonomy'  => 'wpl_cd_category' 
					) 
				); ?>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('display_type'); ?>"><?php _e('Order by:', 'wplook'); ?> <br /> </label>
				<select id="<?php echo $this->get_field_id('display_type'); ?>" name="<?php echo $this->get_field_name('display_type'); ?>">
					<option value="random" <?php selected( 'random', $display_type ); ?>><?php _e('Random', 'wplook'); ?></option>
					<option value="latest" <?php selected( 'latest', $display_type ); ?>><?php _e('Latest', 'wplook'); ?></option>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('nr_posts'); ?>"> <?php _e('Number of CD:', 'wplook'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('nr_posts'); ?>" name="<?php echo $this->get_field_name('nr_posts'); ?>" type="text" value="<?php echo $nr_posts; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Number of CD you want to display', 'wplook'); ?></p>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('read_more_link'); ?>"> <?php _e('URL to all CD page:', 'wplook'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('read_more_link'); ?>" name="<?php echo $this->get_field_name('read_more_link'); ?>" type="text" value="<?php echo $read_more_link; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('URL to all cds', 'wplook'); ?></p>
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
		$instance['display_type'] = sanitize_text_field($new_instance['display_type']);
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
		$display_type = apply_filters( 'widget', $instance['display_type'] );
		$nr_posts = apply_filters( 'widget', $instance['nr_posts'] );
		$read_more_link = apply_filters( 'widget', $instance['read_more_link'] );
		?>
		
		<?php
			if ( $categories < '1' && $display_type == 'random') {
				$args = array(
					'post_type' => 'post_cd',
					'post_status' => 'publish',
					'posts_per_page' => $nr_posts,
					'orderby' => 'rand',
				);
			} elseif ( $categories < '1' && $display_type != 'random' ) {
				$args = array(
					'post_type' => 'post_cd',
					'post_status' => 'publish',
					'posts_per_page' => $nr_posts,
					'orderby' => 'date',
				);
			} elseif ( $categories > '1' && $display_type == 'random') {
				$args = array(
					'post_type' => 'post_cd',
					'post_status' => 'publish',
					'posts_per_page' => $nr_posts,
					'orderby' => 'rand',
					'tax_query' => array(
						array(
							'taxonomy' => 'wpl_cd_category',
							'field' => 'id',
							'terms' => $categories
						)
					),
				);
			} else {
				$args = array(
					'post_type' => 'post_cd',
					'post_status' => 'publish',
					'posts_per_page' => $nr_posts,
					'orderby' => 'date',
					'tax_query' => array(
						array(
							'taxonomy' => 'wpl_cd_category',
							'field' => 'id',
							'terms' => $categories
						)
					),
				);
			}
			$cd = null;
			$cd = new WP_Query( $args );
		?>

			<?php if( $cd->have_posts() ) : ?>
			
				<!-- Widget video -->
				<aside id="WPlookCD-<?php the_ID(); ?>" class="widget WPlookCD">
					<header class="entry-header">
						<h1 class="entry-title"><?php echo $title ?></h1>
						<?php if ( $read_more_link != "") { ?>
							<div class="more-options">
								<a href="<?php echo $read_more_link; ?>" title="<?php _e('View all cd', 'wplook'); ?>"><i class="icon-ellipsis-horizontal"></i></a>
							</div>
						<?php } ?>
						<div class="clear"></div>
					</header>
					
					<ul>
						<?php while( $cd->have_posts() ) : $cd->the_post(); ?>
						<?php 
							$artist_name = get_post_meta(get_the_ID(), 'wpl_cd_artist_name', true);
							$release_date = get_post_meta(get_the_ID(), 'wpl_cd_release_date', true);
						?>
							<li>
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<?php if ( has_post_thumbnail() ) { 
										the_post_thumbnail('medium-thumb'); 
									} ?>
									<h1 class="entry-title"><?php the_title(); ?></h1>
									
									<?php if ( $artist_name ) { ?>
										<h2 class="entry-description"><?php echo $artist_name; ?></h2>
									<?php } ?>
									
									<?php if ( $release_date ) { ?>
										<h3 class="entry-description"><?php echo $release_date; ?></h3>
									<?php } ?>
									<div class="clear"></div>
								</a>
							</li>

						<?php endwhile; wp_reset_postdata(); ?>
					</ul>
				</aside>
			<?php endif; ?>

		<?php
	}
}
?>