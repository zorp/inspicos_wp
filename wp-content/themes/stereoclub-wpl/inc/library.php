<?php
/**
 * Custom Functions
 *
 * @package WordPress
 * @subpackage StereoClub
 * @since StereoClub 1.0
 */

/*-----------------------------------------------------------
	Custom Tag cloud Widget
-----------------------------------------------------------*/

if ( ! function_exists( 'wplook_tag_cloud_widget' ) ) {

	function wplook_tag_cloud_widget($args) {
		$args['largest'] = 14;
		$args['smallest'] = 14;
		$args['unit'] = 'px';
		return $args;
	}
	add_filter( 'widget_tag_cloud_args', 'wplook_tag_cloud_widget' );
}


/*-----------------------------------------------------------
	Get Date
-----------------------------------------------------------*/

if ( ! function_exists( 'wplook_get_date' ) ) {

	function wplook_get_date() {
		the_time(get_option('date_format'));
	}
}


/*-----------------------------------------------------------
	Get Time
-----------------------------------------------------------*/

if ( ! function_exists( 'wplook_get_time' ) ) {

	function wplook_get_time() {
		the_time(get_option('time_format'));
	}
}


/*-----------------------------------------------------------------------------------*/
/*  Add a container for video
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wpl_custom_oembed_filter' ) ) {

	add_filter( 'embed_oembed_html', 'wpl_custom_oembed_filter', 10, 4 ) ;

	function wpl_custom_oembed_filter($html, $url, $attr, $post_ID) {
		$return = '<div class="video-container">'.$html.'</div>';
	    return $return;
	}
}

/*-----------------------------------------------------------
	Get Date and Time
-----------------------------------------------------------*/

if ( ! function_exists( 'wplook_get_date_time' ) ) {

	function wplook_get_date_time() {
		the_time(get_option('date_format')); 
		_e( ' at ', 'wplook');
		the_time(get_option('time_format'));
	}
}


/*-----------------------------------------------------------
	Display Navigation for post, pages, search
-----------------------------------------------------------*/

if ( ! function_exists( 'wplook_content_navigation' ) ) {

	function wplook_content_navigation( $nav_id ) {
		global $wp_query;
		if ( $wp_query->max_num_pages > 1 ) : ?>
			<nav class="entry-pagination" id="<?php echo $nav_id; ?>">
				<div class="nav-previous"><?php previous_posts_link( __( '<span class="nav-previous-icon"></span>  <span class="nav-previous-text">Newer</span>', 'wplook' ) ); ?></div>
				<div class="nav-next"><?php next_posts_link( __( '<span class="nav-next-text">Older</span> <span class="nav-next-icon"></span>', 'wplook' ) ); ?></div>
				<div class="clear"></div>
			</nav><!-- #nav -->
		<?php endif;
	}
}


/*	----------------------------------------------------------
	Display Navigation between
= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = */
 
if ( ! function_exists( 'wplook_prev_next' ) ) {


	function wplook_prev_next() { ?>
		<nav class="entry-pagination" id="<?php echo $nav_id; ?>">
			<div class="nav-previous"><?php next_post_link( '%link', __( '<span class="nav-previous-icon"></span>  <span class="nav-previous-text">Previous</span>', 'wplook' ) ); ?></div>
			<div class="nav-next"><?php previous_post_link( '%link', __( '<span class="nav-next-text">Next</span> <span class="nav-next-icon"></span>', 'wplook' ) ); ?></div>
			<div class="clear"></div>
		</nav>
		<?php
	} 
}



/*-----------------------------------------------------------------------------------*/
/*	Open Graph
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'wplook_open_graph' ) ) {
	function wplook_open_graph() {
		global $wp_query;
		$wplook_postid = $wp_query->post->ID;
		$wplook_title = single_post_title('', false);
		$wplook_url = get_permalink($wplook_postid);
		$wplook_desc = strip_tags(get_the_excerpt($wplook_postid));
		$wplook_blogname = get_bloginfo('name');
			echo "\n<meta property='og:title' content='$wplook_title' >",			
				"\n<meta property='og:site_name' content='$wplook_blogname' >",				
				"\n<meta property='og:url' content='$wplook_url' >",				
				"\n<meta property='og:type' content='article' >",
				"\n<meta property='og:description' content='$wplook_desc' >";
		}
	add_action('wp_head', 'wplook_open_graph');
}

if ( ! function_exists( 'wplook_fb_thumb' ) ) {
	function wplook_fb_thumb() {
	if ( is_single() || is_page() ) {
			if (has_post_thumbnail()) {
				$fbthumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium-thumb');
				$fbthumburl = $fbthumb[0];
				echo "\n<meta property='og:image' content='$fbthumburl' />\n";
			}
		}
	}
	add_action( 'wp_head', 'wplook_fb_thumb' );
}

/*-----------------------------------------------------------------------------------*/
/*	Include the thumbnail in the RSS feed
/*-----------------------------------------------------------------------------------*/

function featuredtoRSS($content) {

	global $post;

	if ( has_post_thumbnail( $post->ID ) ){
		$content = '' . get_the_post_thumbnail( $post->ID, 'medium-thumb', array( 'style' => 'float:left; margin:0 15px 15px 0;' ) ) . '' . $content;
	}
	return $content;
}
add_filter('the_excerpt_rss', 'featuredtoRSS');
add_filter('the_content_feed', 'featuredtoRSS');


/*-----------------------------------------------------------
	Get taxonomies terms links
-----------------------------------------------------------*/

if ( ! function_exists( 'wplook_custom_taxonomies_terms_links' ) ) {

	function wplook_custom_taxonomies_terms_links() {
		global $post, $post_id;
		// get post by post id
		$post = get_post($post->ID);
		// get post type by post
		$post_type = $post->post_type;
		// get post type taxonomies
		$taxonomies = get_object_taxonomies($post_type);
		foreach ($taxonomies as $taxonomy) {
			// get the terms related to post
			$terms = get_the_terms( $post->ID, $taxonomy );
			if ( !empty( $terms ) ) {
				$out = array();
				foreach ( $terms as $term )
					$out[] = $term->name;
				$return = join( ', ', $out );
			} else {
				$return = '';
			}
			return $return;
		}
	}
}


/*	----------------------------------------------------------
	Likes functionality
= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = */

$timebeforerevote = 120;

add_action('wp_ajax_nopriv_post-like', 'post_like');
add_action('wp_ajax_post-like', 'post_like');


if ( ! function_exists( 'post_like' ) ) {

	function post_like() {
		$nonce = $_POST['nonce'];
	 
		if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
			die ( 'Busted!');
			
		if(isset($_POST['post_like'])) {
			$ip = $_SERVER['REMOTE_ADDR'];
			$post_id = $_POST['post_id'];
			
			$meta_IP = get_post_meta($post_id, "voted_IP");

			// BugFix by Rico Dupuis
			$voted_IP = array();
			if( is_array($meta_IP) && count($meta_IP))
				$voted_IP = $meta_IP[0];
			// END: BugFix
			
			$meta_count = get_post_meta($post_id, "votes_count", true);

			if(!hasAlreadyVoted($post_id)) {
				$voted_IP[$ip] = time();

				update_post_meta($post_id, "voted_IP", $voted_IP);
				update_post_meta($post_id, "votes_count", ++$meta_count);
				
				echo $meta_count;
			}
			else
				echo "already";
		}
		exit;
	}

}

if ( ! function_exists( 'hasAlreadyVoted' ) ) {

	function hasAlreadyVoted($post_id) {
		global $timebeforerevote;

		$meta_IP = get_post_meta($post_id, "voted_IP");

		if(isset($_POST['post_like'])) {
			// BugFix by Rico Dupuis
			$voted_IP = array();
			if( is_array($meta_IP) && count($meta_IP))
				$voted_IP = $meta_IP[0];
			// END: BugFix

			$ip = $_SERVER['REMOTE_ADDR'];
			
			if(in_array($ip, array_keys($voted_IP))) {
				$time = $voted_IP[$ip];
				$now = time();
				
				if(round(($now - $time) / 60) > $timebeforerevote)
					return false;
					
				return true;
			}
		}
		return false;
	}
}

if ( ! function_exists( 'getPostLikeLink' ) ) {

	function getPostLikeLink($post_id) {
		$vote_count = get_post_meta($post_id, "votes_count", true);
		$vote_count = intval($vote_count);
		
		$output = '<span class="post-like">';
		if(hasAlreadyVoted($post_id))
			$output .= ' <span class="like icon-heart"></span> ';
		else
			$output .= '<a href="#" data-post_id="'.$post_id.'"><span class="like icon-heart2"></span></a> ';
		
		$output .= '<span class="count">';
		
		if( $vote_count == 1 )
			$output .= $vote_count. __(' Like', 'wplook');
		elseif( $vote_count >= 2 )
			$output .= $vote_count. __(' Likes', 'wplook');
		
		$output .= '</span></span>';
		
		return $output;
	}
}


/*	----------------------------------------------------------
	Count Post views
= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = */

if ( ! function_exists( 'getPostViews' ) ) {

	function getPostViews($postID){
		$count_key = 'post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if($count==''){
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
			return "0 View";
		}
		return $count. __(' Views', 'wplook');
	}
}


if ( ! function_exists( 'setPostViews' ) ) {

	function setPostViews($postID) {
		$count_key = 'post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if($count==''){
			$count = 0;
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
		}else{
			$count++;
			update_post_meta($postID, $count_key, $count);
		}
	}
}


/*-----------------------------------------------------------------------------------*/
/*	Display share buttons on posts
/*-----------------------------------------------------------------------------------*/

function wplook_get_share_buttons() { ?>
<div class="more-options share-bt">
	<a class='share-click' title="<?php _e('Share', 'wplook'); ?>"><i class="icon-share"></i></a>
	<ul class="share-buttons">
		<li><a class="share-icon-fb" id="fbbutton" onclick="fbwindows('http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>'); return false;"><i class="icon-facebook"></i></li></a> 
		<li><a class="share-icon-tw" id="twbutton" onClick="twwindows('http://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php the_permalink(); ?>'); return false;"><i class="icon-twitter"></i></li></a>
		<li><a class="share-icon-pt" id="pinbutton" onClick="pinwindows('http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=');"><i class="icon-pinterest"></i></li></a>
	</ul>
</div>
<?php }

/*-----------------------------------------------------------------------------------*/
/*	Background functionality
/*-----------------------------------------------------------------------------------*/


if ( ! function_exists( 'slider_functionality' ) ) {

	function slider_functionality() { ?>
		<?php 
			$wpl_sliders = ot_get_option( 'wpl_sliders', array() );
		?>

		<?php if ( ot_get_option('wpl_bg_function') == 'on' ){ ?>
			<script>
				jQuery(function(jQuery){
					jQuery.supersized({
						// Functionality
						slide_interval			:	<?php if ( ot_get_option('wpl_slider_interval') != '') { echo ot_get_option('wpl_slider_interval'); } else { echo '5000'; } ?>,		// Length between transitions
						transition				:	1,			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
						transition_speed		:	<?php if ( ot_get_option('wpl_slider_transition_speed') != '') { echo ot_get_option('wpl_slider_transition_speed'); } else { echo '1700'; } ?>,		// Speed of transition

						// Components							
						slide_links				:	'false',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
						slides					:
							[	// Slideshow Images

								<?php foreach( $wpl_sliders as $item ) : ?>
									<?php echo "{image :'";?> <?php echo $item['wpl_slider_item_image']; ?><?php echo " ', title :'";?> <?php echo "<h1>"; ?> <?php echo $item['wpl_slider_item_title']; ?> <?php echo "</h1>"; ?> <?php echo "<h2>"; ?> <?php echo $item['wpl_slider_item_description']; ?> <?php echo "</h2>"; ?><?php echo "'},";?>
								<?php endforeach; ?>
							]
					});
				});
			</script>
		<?php } 
	}
	add_action('wp_footer', 'slider_functionality', 100);
}

/*-----------------------------------------------------------
	Add custom Colors to the theme
-----------------------------------------------------------*/

if ( ! function_exists( 'hg_customize_register' ) ) {
	
	add_action( 'customize_register', 'hg_customize_register' );
	function hg_customize_register($wp_customize) {
		$colors = array();
		$colors[] = array( 'slug'=>'wpl_link_color', 'default' => '#aa0114', 'label' => __( 'Link color', 'wplook' ) );
		$colors[] = array( 'slug'=>'wpl_hover_link_color', 'default' => '#dd3333', 'label' => __( 'Hover link color', 'wplook' ) );
		$colors[] = array( 'slug'=>'wpl_accent_bg_color', 'default' => '#dd3333', 'label' => __( 'Accent Color', 'wplook' ) );
		$colors[] = array( 'slug'=>'wpl_accent_text_color', 'default' => '#FFFFFF', 'label' => __( 'Accent Text Color', 'wplook' ) );
		$colors[] = array( 'slug'=>'wpl_secondary_color', 'default' => '#1c1d21', 'label' => __( 'Secondary Color', 'wplook' ) );

		foreach($colors as $color) {
			// SETTINGS
			$wp_customize->add_setting( $color['slug'], array( 'default' => $color['default'], 'type' => 'option', 'capability' => 'edit_theme_options' ));

			// CONTROLS
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $color['slug'], array( 'label' => $color['label'], 'section' => 'colors', 'settings' => $color['slug'] )));
		}
	}
}


/*-----------------------------------------------------------------------------------*/
/*	Print Custom Color Styles
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_print_custom_color_style' ) ) {

	function wplook_print_custom_color_style() { ?>
		<?php
			$link_color = get_option('wpl_link_color');
			$hover_link_color = get_option('wpl_hover_link_color');
			$accent_bg_color = get_option('wpl_accent_bg_color');
			$accent_text_color = get_option('wpl_accent_text_color');
			$secondary_color = get_option('wpl_secondary_color');
		?>
		<style>
			/* Link Color */
			a, a:visited { color: <?php echo $link_color; ?>;}
			
			/* Hover Link Color */
			a:focus, a:active, a:hover { color: <?php echo $hover_link_color; ?>; }
			
			/* Accent Background Color */
			.entry-header, #site-navigation  ul li a:hover, #site-navigation  ul li.current_page_item a, .header-search-form, .widget .tagcloud a, .grid figcaption, .audiojs .progress, #contact-form .submit-button, .latest-item .entry-footer .button-readmore a, .latest-item .entry-footer .buy span a, .flex-direction-nav a, #commentform #submit, #progress-bar, .share-items .share-item-icon-search a:hover, #site-navigation ul.sub-menu li:hover, .grid figcaption a, .entry-meta .buy span a, .WPlookAnounce, .toggle-event  .category-selected a, .entry-header-comments .reply a, .mean-container a.meanmenu-reveal span, .toggle-event .expand-button .buy .tour-status, .menu-language-menu-container ul li a {background: <?php echo $accent_bg_color; ?>;}
			.nav-previous-icon, .nav-next-icon, .widget_search #searchsubmit, .error404 .search-button {background-color: <?php echo $accent_bg_color; ?>;}
			.audiojs .play-pause p.play, .audiojs .play-pause p.pause {color: <?php echo $accent_bg_color; ?>;}
			/* Accent Text Color */
			.entry-header, .header-search-form input, .WPlookAnounce .announce-body, .WPlookAnounce .announce-body a {color: <?php echo $accent_text_color; ?>;}

			/* Secondary color */
			#site-navigation  ul, .share-items li, #nextslide, #prevslide, #status-info, #site-info, .single-post .entry-meta, .entry-meta-map, .widget_search #searchform #s, .error404 #searchform #s, .menu-language-menu-container ul li a:hover, .more-options .share-buttons  { background: <?php echo $secondary_color; ?>;}
			
		</style>
	<?php }
	add_action( 'wp_head', 'wplook_print_custom_color_style' );
}


/*-----------------------------------------------------------------------------------*/
/*	Manage columns for Events
/*-----------------------------------------------------------------------------------*/

function add_new_events_columns($columns) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Event Title', 'wplook' ),
		'wpl_event_date' => __( 'Date', 'wplook' ),
		'wpl_event_time' => __( 'Time', 'wplook' ),
		'wpl_event_address' => __( 'Address', 'wplook' ),
	);

return $columns;

}
add_filter("manage_edit-post_events_columns", "add_new_events_columns");

 
function wpl_events_columns( $column, $post_id ) {
	
	switch ($column) {
		/*-----------------------------------------------------------
			Events: Position
		-----------------------------------------------------------*/
		case 'wpl_event_date' :

		$wpl_event_date = get_post_meta( $post_id, 'wpl_event_date', true );

		if ( empty( $wpl_event_date ) )
			echo __( 'Unknown', 'wplook' );

		else
			printf( __( '%s', 'wplook' ), $wpl_event_date );

		break;

		/*-----------------------------------------------------------
			Events: Phone
		-----------------------------------------------------------*/
		case 'wpl_event_time' :

		$wpl_event_time = get_post_meta( $post_id, 'wpl_event_time', true );

		if ( empty( $wpl_event_time ) )
			echo __( 'Unknown', 'wplook' );

		else
			printf( __( '%s', 'wplook' ), $wpl_event_time );

		break;
		

		/*-----------------------------------------------------------
			Events: Email
		-----------------------------------------------------------*/
		case 'wpl_event_address' :

		$wpl_event_address = get_post_meta( $post_id, 'wpl_event_address', true );

		if ( empty( $wpl_event_address ) )
			echo __( 'Unknown', 'wplook' );

		else
			printf( __( '%s', 'wplook' ), $wpl_event_address );

		break;

	
	} // end switch
}
add_action('manage_post_events_posts_custom_column', 'wpl_events_columns', 10, 2);

function post_events_sort_me( $columns ) { 
$columns['wpl_event_date'] = 'wpl_event_date'; 
$columns['wpl_event_address'] = 'wpl_event_address';

return $columns; 
}

add_filter( 'manage_edit-post_events_sortable_columns', 'post_events_sort_me' );

// Sort by event date
function eventdate_orderby( $vars ) {
	if ( isset( $vars['orderby'] ) && 'wpl_event_date' == $vars['orderby'] ) {

		$vars = array_merge( $vars, array(
			'meta_key' => 'wpl_event_date',
			'orderby' => 'meta_value'
		));
	}

	return $vars;
}
add_filter( 'request', 'eventdate_orderby' );


/*-----------------------------------------------------------------------------------*/
/*	Manage columns for Videos
/*-----------------------------------------------------------------------------------*/

function add_new_video_columns($columns) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Name', 'wplook' ),
		'wpl_video_url' => __( 'Video URL', 'wplook' ),
		'post_views_count' => __( 'Views', 'wplook' ),
		'votes_count' => __( 'Votes', 'wplook' ),
		'date' => __( 'Date', 'wplook' )
	);

return $columns;

}
add_filter("manage_edit-post_video_columns", "add_new_video_columns");

 
function wpl_video_columns( $column, $post_id ) {
	
	switch ($column) {
		

		/*-----------------------------------------------------------
			Video: url
		-----------------------------------------------------------*/
		case 'wpl_video_url' :

		$wpl_video_url = get_post_meta( $post_id, 'wpl_video_url', true );

		if ( empty( $wpl_video_url ) )
			echo __( 'Unknown', 'wplook' );

		else
			printf( __( '%s', 'wplook' ), $wpl_video_url );

		break;


		/*-----------------------------------------------------------
			Video: views
		-----------------------------------------------------------*/
		case 'post_views_count' :

		$post_views_count = get_post_meta( $post_id, 'post_views_count', true );

		if ( empty( $post_views_count ) )
			echo __( 'Unknown', 'wplook' );

		else
			printf( __( '%s', 'wplook' ), $post_views_count );

		break;



		/*-----------------------------------------------------------
			Video: votes
		-----------------------------------------------------------*/
		case 'votes_count' :

		$votes_count = get_post_meta( $post_id, 'votes_count', true );

		if ( empty( $votes_count ) )
			echo __( 'Unknown', 'wplook' );

		else
			printf( __( '%s', 'wplook' ), $votes_count );

		break;

	
	} // end switch
}
add_action('manage_post_video_posts_custom_column', 'wpl_video_columns', 10, 2);


/*-----------------------------------------------------------------------------------*/
/*	Manage columns for Galleries
/*-----------------------------------------------------------------------------------*/

function add_new_gallery_columns($columns) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Name', 'wplook' ),
		'post_views_count' => __( 'Views', 'wplook' ),
		'votes_count' => __( 'Votes', 'wplook' ),
		'date' => __( 'Date', 'wplook' )
	);

return $columns;

}
add_filter("manage_edit-post_gallery_columns", "add_new_gallery_columns");

 
function wpl_gallery_columns( $column, $post_id ) {
	
	switch ($column) {
		

		/*-----------------------------------------------------------
			Gallery: views
		-----------------------------------------------------------*/
		case 'post_views_count' :

		$post_views_count = get_post_meta( $post_id, 'post_views_count', true );

		if ( empty( $post_views_count ) )
			echo __( 'Unknown', 'wplook' );

		else
			printf( __( '%s', 'wplook' ), $post_views_count );

		break;



		/*-----------------------------------------------------------
			Gallery: votes
		-----------------------------------------------------------*/
		case 'votes_count' :

		$votes_count = get_post_meta( $post_id, 'votes_count', true );

		if ( empty( $votes_count ) )
			echo __( 'Unknown', 'wplook' );

		else
			printf( __( '%s', 'wplook' ), $votes_count );

		break;

	
	} // end switch
}
add_action('manage_post_gallery_posts_custom_column', 'wpl_gallery_columns', 10, 2);


/*-----------------------------------------------------------------------------------*/
/*	Manage columns for DJ
/*-----------------------------------------------------------------------------------*/

function add_new_dj_columns($columns) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Name', 'wplook' ),
		'post_views_count' => __( 'Views', 'wplook' ),
		'votes_count' => __( 'Votes', 'wplook' ),
		'date' => __( 'Date', 'wplook' )
	);

return $columns;

}
add_filter("manage_edit-post_dj_columns", "add_new_dj_columns");

 
function wpl_dj_columns( $column, $post_id ) {
	
	switch ($column) {
		

		/*-----------------------------------------------------------
			DJ's: views
		-----------------------------------------------------------*/
		case 'post_views_count' :

		$post_views_count = get_post_meta( $post_id, 'post_views_count', true );

		if ( empty( $post_views_count ) )
			echo __( 'Unknown', 'wplook' );

		else
			printf( __( '%s', 'wplook' ), $post_views_count );

		break;



		/*-----------------------------------------------------------
			DJ's: votes
		-----------------------------------------------------------*/
		case 'votes_count' :

		$votes_count = get_post_meta( $post_id, 'votes_count', true );

		if ( empty( $votes_count ) )
			echo __( 'Unknown', 'wplook' );

		else
			printf( __( '%s', 'wplook' ), $votes_count );

		break;

	
	} // end switch
}
add_action('manage_post_dj_posts_custom_column', 'wpl_dj_columns', 10, 2);


/*-----------------------------------------------------------------------------------*/
/*	Manage columns for DJ
/*-----------------------------------------------------------------------------------*/

function add_new_cd_columns($columns) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Name', 'wplook' ),
		'wpl_cd_genre' => __( 'Genres', 'wplook' ),
		'wpl_cd_release_date' => __( 'Release date', 'wplook' ),
		'post_views_count' => __( 'Views', 'wplook' ),
		'votes_count' => __( 'Votes', 'wplook' ),
		'date' => __( 'Date', 'wplook' )
	);

return $columns;

}
add_filter("manage_edit-post_cd_columns", "add_new_cd_columns");

 
function wpl_cd_columns( $column, $post_id ) {
	
	switch ($column) {
		

		/*-----------------------------------------------------------
			CD: Genre
		-----------------------------------------------------------*/
		case 'wpl_cd_genre' :

		$wpl_cd_genre = get_post_meta( $post_id, 'wpl_cd_genre', true );

		if ( empty( $wpl_cd_genre ) )
			echo __( 'Unknown', 'wplook' );

		else
			printf( __( '%s', 'wplook' ), $wpl_cd_genre );

		break;


		/*-----------------------------------------------------------
			CD: Release date
		-----------------------------------------------------------*/
		case 'wpl_cd_release_date' :

		$wpl_cd_release_date = get_post_meta( $post_id, 'wpl_cd_release_date', true );

		if ( empty( $wpl_cd_release_date ) )
			echo __( 'Unknown', 'wplook' );

		else
			printf( __( '%s', 'wplook' ), $wpl_cd_release_date );

		break;


		/*-----------------------------------------------------------
			CD: views
		-----------------------------------------------------------*/
		case 'post_views_count' :

		$post_views_count = get_post_meta( $post_id, 'post_views_count', true );

		if ( empty( $post_views_count ) )
			echo __( 'Unknown', 'wplook' );

		else
			printf( __( '%s', 'wplook' ), $post_views_count );

		break;



		/*-----------------------------------------------------------
			CD: votes
		-----------------------------------------------------------*/
		case 'votes_count' :

		$votes_count = get_post_meta( $post_id, 'votes_count', true );

		if ( empty( $votes_count ) )
			echo __( 'Unknown', 'wplook' );

		else
			printf( __( '%s', 'wplook' ), $votes_count );

		break;

	
	} // end switch
}
add_action('manage_post_cd_posts_custom_column', 'wpl_cd_columns', 10, 2);


/*-----------------------------------------------------------------------------------*/
/*	Trim excerpt
/*-----------------------------------------------------------------------------------*/

function wplook_short_excerpt($limit) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'...';
	} else {
		$excerpt = implode(" ",$excerpt);
	}	
	$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	return $excerpt;
}
 

/*-----------------------------------------------------------------------------------*/
/*	Trim content
/*-----------------------------------------------------------------------------------*/

function wplook_short_content($limit) {
	$content = explode(' ', get_the_content(), $limit);
	if (count($content)>=$limit) {
		array_pop($content);
		$content = implode(" ",$content).'...';
	} else {
		$content = implode(" ",$content);
	}	
	$content = preg_replace('/\[.+\]/','', $content);
	$content = apply_filters('the_content', $content); 
	$content = str_replace(']]>', ']]&gt;', $content);
	return $content;
}


/*	----------------------------------------------------------
	Buttons
= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = */

if (!function_exists('wplook_button')) {
	function wplook_button( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'url' => '#',
			'target' => '_self',
			'style' => 'grey',
			'size' => 'small',
			'type' => 'round'
		), $atts));
		
	   return '<a target="'.$target.'" class="button '.$size.' '.$style.' '. $type .'" href="'.$url.'">' . do_shortcode($content) . '</a>';
	}
	add_shortcode('button', 'wplook_button');
}


/*	----------------------------------------------------------
	Alerts
= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = */

if (!function_exists('wplook_alert')) {
	function wplook_alert( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'style'   => 'white'
		), $atts));
		
		return '<div class="alert '.$style.'">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('alert', 'wplook_alert');
}


/*	----------------------------------------------------------
	Awesome icons
= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = */

if (!function_exists('wplook_awesome_icons')) {
	function wplook_awesome_icons( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'name'  => 'icon-wrench'
		), $atts));
		
		return '<i class="'.$name.'"><span>' . do_shortcode($content) . '</span></i>';
	}
	add_shortcode('icon', 'wplook_awesome_icons');
}