<?php
/**
 * The default template for displaying the background messages
 *
 * @package WordPress
 * @subpackage StereoClub
 * @since StereoClub 1.0
 */
?>
<?php $header_image = get_header_image(); ?>

<?php if ( ot_get_option('wpl_bg_messages') != 'off' && ot_get_option('wpl_bg_function') != 'off' && ot_get_option('wpl_slider_revolution') == '' ){ ?>
	<!-- Teaser Text -->
	<div class="container_12 teaser">

		<div id="slidecaption" class="grid_12"></div>

		<div class="grid_12 margin-battom slider-arrow">
			<a id="prevslide" class="load-item"></a>
			<a id="nextslide" class="load-item"></a>
			<div class="clear"></div>
		</div>
		<div class="celar"></div>
	</div>
<?php } elseif ( ot_get_option( 'wpl_slider_revolution') != '' ){ ?>
	<div class="container_12">
		<div class="grid_12">
			<?php putRevSlider( ot_get_option( 'wpl_slider_revolution') ); ?>
		</div>
	</div>
<?php } elseif ( ! empty( $header_image ) ) { ?>
	<div class="container_12 header-image">
		<div class="grid_12">

			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php
				
				if ( is_singular() && has_post_thumbnail( $post->ID ) &&
						( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID), 'ch-images'  ) ) &&
						$image[1] >= 960 ) :
					// Houston, we have a new header image!
					echo get_the_post_thumbnail( $post->ID, array(1200,380) );
				else : ?>
					<img src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>" />
				<?php endif; // end check for featured image or standard header ?>
			</a>

		</div>
	</div>
<?php } ?>