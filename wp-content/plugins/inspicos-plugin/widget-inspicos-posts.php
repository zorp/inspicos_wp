<?php
add_action('widgets_init', create_function('', 'return register_widget("inspicos_posts_widget");'));
class inspicos_posts_widget extends WP_Widget {

	
	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
	 		'inspicos_posts_widget',
			'Inspicos Posts Home',
			array( 'description' => __( 'A widget for displaying latest Posts', 'inspicos' ), )
		);
	}

	
	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the options form on admin
	/*-----------------------------------------------------------------------------------*/
	
	public function form( $instance ) {
		/*if ( $instance ) {
			$title = esc_attr( $instance[ 'title' ] );
		}
		else {
			$title = __( 'Posts', 'inspicos' );
		}

		if ( $instance ) {
			$categories = esc_attr( $instance[ 'categories' ] );
		}
		else {
			$categories = __( 'All', 'inspicos' );
		} */

		if ( $instance ) {
			$nr_posts = esc_attr( $instance[ 'nr_posts' ] );
		}
		else {
			$nr_posts = __( '4', 'inspicos' );
		}

		if ( $instance ) {
			$offset_posts = esc_attr( $instance[ 'offset_posts' ] );
		}
		else {
			$offset_posts = __( '0', 'inspicos' );
		}

		?>			
			<p>
				<label for="<?php echo $this->get_field_id('nr_posts'); ?>"> <?php _e('Number of Posts:', 'inspicos'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('nr_posts'); ?>" name="<?php echo $this->get_field_name('nr_posts'); ?>" type="text" value="<?php echo $nr_posts; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Number of posts you want to display', 'inspicos'); ?></p>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('offset_posts'); ?>"> <?php _e('Offset posts by:', 'inspicos'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('offset_posts'); ?>" name="<?php echo $this->get_field_name('offset_posts'); ?>" type="text" value="<?php echo $offset_posts; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Offset posts displayed by', 'inspicos'); ?></p>
			</p>

		<?php 
	}
	

	/*-----------------------------------------------------------------------------------*/
	/*	Processes widget options to be saved
	/*-----------------------------------------------------------------------------------*/
	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['nr_posts'] = sanitize_text_field($new_instance['nr_posts']);
		$instance['offset_posts'] = sanitize_text_field($new_instance['offset_posts']);
		return $instance;
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Outputs the content of the widget
	/*-----------------------------------------------------------------------------------*/

	public function widget( $args, $instance ) {
		global $post;
		extract( $args );
		$nr_posts = apply_filters( 'widget', $instance['nr_posts'] );
		$offset_posts = apply_filters( 'widget', $instance['offset_posts'] );
		?>
		
		<?php
			$args = array(
				'ignore_sticky_posts'=> 1,
				'post_type' => 'post',
				'post_status' => 'publish',
				'posts_per_page' => $nr_posts,
				'offset'=> $offset_posts,
			);

			$posts = null;
			$posts = new WP_Query( $args );
			$count = 0;
		?>

			<?php if( $posts->have_posts() ) : ?>
			
				<!-- Latest Posts -->
				<?php while( $posts->have_posts() ) : $posts->the_post(); ?>
					<?php
						$count++
					?>
					<aside id="latest-posts-<?php the_ID(); ?>" class="inspicoslatestposts widget">
						<header class="entry-header<?php echo ($count==1)?' first':'';?>">
							<!--<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><?php //echo wplook_custom_taxonomies_terms_links(); ?></h1>-->
							<h2 class="entry-title"><?php echo get_post_custom_values('short_title')[0]; ?></h2>
							<div class="clear"></div>
						</header>
						
						<div class="entry-content list-entry-content">
							<div class="entry-description">
								<h1 class="entry-head"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
								<div class="short-description">
									<p><?php echo wplook_short_excerpt(ot_get_option('wpl_rest_events_excerpt_limit'));?>...</p>
									<a href="<?php the_permalink(); ?>" title="<?php _e('read more', 'wplook'); ?>" class="link-icon"><?php _e('read more', 'wplook'); ?></a>
								</div>
							</div>
						</div>
					</aside>
				<?php endwhile; wp_reset_postdata(); ?>

			<?php endif; ?>
		<?php
	}
}
?>