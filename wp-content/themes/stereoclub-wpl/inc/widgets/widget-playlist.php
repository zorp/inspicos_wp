<?php
/*
 * Plugin Name: Latest video widget
 * Plugin URI: http://www.wplook.com
 * Description: Display the lates video
 * Author: Victor Tihai
 * Version: 1.0
 * Author URI: http://www.wplook.com
*/

add_action('widgets_init', create_function('', 'return register_widget("wplook_playlist_widget");'));
class wplook_playlist_widget extends WP_Widget {

	
	/*-----------------------------------------------------------------------------------*/
	/*	Widget actual processes
	/*-----------------------------------------------------------------------------------*/
	
	public function __construct() {
		parent::__construct(
	 		'wplook_playlist_widget',
			'WPlook PlayList',
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
			$cd_id = esc_attr( $instance[ 'cd_id' ] );
		}
		else {
			$cd_id = __( '1', 'wplook' );
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
				<label for="<?php echo $this->get_field_id('cd_id'); ?>"> <?php _e('The ID of the CD:', 'wplook'); ?> </label>
				<input class="widefat" id="<?php echo $this->get_field_id('cd_id'); ?>" name="<?php echo $this->get_field_name('cd_id'); ?>" type="text" value="<?php echo $cd_id; ?>" />
				<p style="font-size: 10px; color: #999; margin: -10px 0 0 0px; padding: 0px;"> <?php _e('Insert the ID of the CD', 'wplook'); ?></p>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('read_more_link'); ?>"> <?php _e('URL to a specific page:', 'wplook'); ?> </label>
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
		$instance['cd_id'] = sanitize_text_field($new_instance['cd_id']);
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
		$cd_id = apply_filters( 'widget', $instance['cd_id'] );
		$read_more_link = apply_filters( 'widget', $instance['read_more_link'] );
		?>
		
		<?php
			
				$args = array(
					'post_type' => 'post_cd',
					'post_status' => 'publish',
					'posts_per_page' => 1,
					'page_id' => $cd_id
				);
			
			$cd = null;
			$cd = new WP_Query( $args );
		?>

			
			<!-- Widget video -->
			<aside id="WPlookCD-<?php the_ID(); ?>" class="widget WPlookCD cd-playlist">

				<?php if( $cd->have_posts() ) : ?>	
					<header class="entry-header">
						<h1 class="entry-title"><?php echo $title ?></h1>
						<?php if ( $read_more_link != "") { ?>
							<div class="more-options">
								<a href="<?php echo $read_more_link; ?>" title="<?php _e('View all cd', 'wplook'); ?>"><i class="icon-ellipsis-horizontal"></i></a>
							</div>
						<?php } ?>
						<div class="clear"></div>
					</header>
					
					<ul class="playlist-nomargin">
						<?php while( $cd->have_posts() ) : $cd->the_post(); ?>
						<?php 
							$artist_name = get_post_meta(get_the_ID(), 'wpl_cd_artist_name', true);
							$release_date = get_post_meta(get_the_ID(), 'wpl_cd_release_date', true);
							$playlist = get_post_meta($post->ID, 'wpl_playlist', true);
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
				<?php endif; ?>
					<?php if( $playlist ) { ?>
						<audio class="audio" preload></audio>
							<ol class="audio-list">
								<?php foreach( $playlist as $item ) : ?>
									<?php if( $item['wpl_playlist_track'] ) { ?>
										<li><span class="icon-music"></span><a href="#" data-src="<?php echo $item['wpl_playlist_track'] ?>"><?php echo $item['wpl_playlist_track_name'] ?></a></li>
									<?php } ?>	
								<?php endforeach; ?>
							</ol>
					<?php } ?>
			</aside>
		<?php
	}
}
?>