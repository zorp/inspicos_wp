<?php
/**
 * The default Sidebar. It will appear on all events pages
 *
 * @package WordPress
 * @subpackage StereoClub
 * @since StereoClub 1.0
 */
?>
<div id="secondary" class="grid_4 widget-area" role="complementary">
<?php if ( is_single() ) { ?>

	<?php 
		$event_location = get_post_meta(get_the_ID(), 'wpl_event_location', true);
		$event_address = get_post_meta(get_the_ID(), 'wpl_event_address', true);
		$event_lat = get_post_meta(get_the_ID(), 'wpl_event_latitude', true);
		$event_lng = get_post_meta(get_the_ID(), 'wpl_event_longitude', true);
		$event_pin = get_post_meta(get_the_ID(), 'wpl_event_pin_map_icon', true);
		$event_place = get_post_meta($post->ID, 'wpl_event_city', true);
	?>
		
		<?php if ( $event_location || $event_address || ( $event_lat && $event_lng ) ) { ?>
			<!-- Widget Events -->
			<aside id="event_map" class="widget">
				<div class="entry-header">
					<h1 class="entry-title"><?php _e('Location', 'wplook'); ?></h1>
					<div class="clear"></div>
				</div>

				<?php if ( $event_location || $event_address) { ?>
					<div class="entry-meta-map">
						<strong><?php echo $event_location; ?></strong><br />
						
						<strong><?php echo $event_place; ?></strong><br />
						<?php echo $event_address; ?>
						<div class="clear"></div>
					</div>
				<?php } ?>

				<?php if ( $event_lat !='' && $event_lng != '') {?>
					<div class="entry-content-map">
						<script type="text/javascript">
							function initialize() {
								var mapOptions = {
									center: new google.maps.LatLng(<?php echo $event_lat; ?>, <?php echo $event_lng ?>),
									zoom: 15,
									mapTypeId: google.maps.MapTypeId.ROADMAP,
								};
								var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
								
								var image = '<?php echo $event_pin; ?>';

								var myLatLng = new google.maps.LatLng(<?php echo $event_lat; ?>, <?php echo $event_lng ?>);
								var beachMarker = new google.maps.Marker({
									position: myLatLng,
									map: map,
									icon: image
								});
							}
							google.maps.event.addDomListener(window, 'load', initialize);
						</script>
						<div id="map-canvas"/>
					</div>
				<?php } ?>

			</aside>
		<?php } ?>

<?php } ?>



<?php if ( is_active_sidebar( 'event-1' ) ) : ?>
	<?php if ( ! dynamic_sidebar( 'event-1' ) ) : ?>
	<?php endif; // end sidebar widget area ?>
<?php endif; ?>

</div>