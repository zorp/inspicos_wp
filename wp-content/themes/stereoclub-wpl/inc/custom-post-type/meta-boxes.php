<?php
/**
 * The default Meta Box Settings
 *
 * @package WordPress
 * @subpackage StereoClub
 * @since StereoClub 1.0
 */



/*-----------------------------------------------------------------------------------*/
/*	Initialize the meta boxes. 
/*-----------------------------------------------------------------------------------*/

add_action( 'admin_init', 'wpl_meta_boxes' );

function wpl_meta_boxes() {

	
	/*-----------------------------------------------------------
		Custom meta box for pages
	-----------------------------------------------------------*/
	
	$page_meta_box = array(
		'id'          => 'page_meta_box',
		'title'       => 'Page Options',
		'desc'        => '',
		'pages'       => array( 'page' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
			
			array(
				'label'       => 'Sidebar Option',
				'id'          => 'wpl_sidebar_option',
				'type'        => 'on-off',
				'desc'        => 'Display or hide the sidebar on this page', 
				'std'         => 'on',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			)
		)
	);
	ot_register_meta_box( $page_meta_box );


	/*-----------------------------------------------------------
		Custom meta box for CD
	-----------------------------------------------------------*/
	
	$cd_meta_box = array(
		'id'          => 'cd_meta_box',
		'title'       => 'Page Options',
		'desc'        => '',
		'pages'       => array( 'post_cd' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(

			array(
				'label'       => 'Artist/band',
				'id'          => 'wpl_cd_artist_name',
				'type'        => 'text',
				'desc'        => 'Artist or band name',
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'section'     => ''
			),


			array(
				'label'       => 'Release Date',
				'id'          => 'wpl_cd_release_date',
				'type'        => 'text',
				'desc'        => 'Release date. (For ex: 2013)',
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'section'     => ''
			),

			array(
				'label'       => 'Itunes Link',
				'id'          => 'wpl_cd_itunes_url',
				'type'        => 'text',
				'desc'        => 'Itunes URL, if any.',
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'section'     => ''
			),

			array(
				'label'       => 'Likes',
				'id'          => 'votes_count',
				'type'        => 'text',
				'desc'        => 'Enter the number of Likes.',
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),

			array(
				'label'       => 'Views',
				'id'          => 'post_views_count',
				'type'        => 'text',
				'desc'        => 'Enter the number of views.',
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			
			array(
				'label'       => 'Audio Playlist',
				'id'          => 'wpl_playlist',
				'type'        => 'list-item',
				'desc'        => 'Use this tool to build audio playlist.',
				'settings'    => array(     
					array(
						'label'       => 'Track file (mp3)',
						'id'          => 'wpl_playlist_track',
						'type'        => 'upload',
						'desc'        => 'Upload mp3 file.',
						'std'         => '',
						'rows'        => '',
						'post_type'   => '',
						'taxonomy'    => '',
						'class'       => '',
						'section'     => ''
					),

					array(
						'label'       => 'Track Name',
						'id'          => 'wpl_playlist_track_name',
						'type'        => 'text',
						'desc'        => 'Track name',
						'std'         => '',
						'rows'        => '',
						'post_type'   => '',
						'taxonomy'    => '',
						'class'       => '',
						'section'     => ''
					),
					
				)
			),

			array(
				'label'       => 'Share Buttons',
				'id'          => 'wpl_share_buttons_cd',
				'type'        => 'on-off',
				'desc'        => 'Activate or deactivate Share Buttons', 
				'std'         => 'on',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),



		)
	);
	ot_register_meta_box( $cd_meta_box );


	/*-----------------------------------------------------------
  		Custom meta box for posts
  	-----------------------------------------------------------*/

	$blog_meta_box = array(
		'id'          => 'blog_meta_box',
		'title'       => 'Post Options',
		'desc'        => '',
		'pages'       => array( 'post' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(  
			array(
				'label'       => 'Likes',
				'id'          => 'votes_count',
				'type'        => 'text',
				'desc'        => 'Enter the number of Likes.',
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),

			array(
				'label'       => 'Views',
				'id'          => 'post_views_count',
				'type'        => 'text',
				'desc'        => 'Enter the number of views.',
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),

			array(
				'label'       => 'Share Buttons',
				'id'          => 'wpl_share_buttons_blog',
				'type'        => 'on-off',
				'desc'        => 'Activate or deactivate Share Buttons',
				'std'         => 'on',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),

		)
	);
	ot_register_meta_box( $blog_meta_box );


	/*-----------------------------------------------------------
  		Video
  	-----------------------------------------------------------*/

	$videos_meta_box = array(
		'id'          => 'videos_meta_box',
		'title'       => 'Video Options',
		'desc'        => '',
		'pages'       => array( 'post_video' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(  
			
			array(
				'label'       => 'Video URL',
				'id'          => 'wpl_video_url',
				'type'        => 'text',
				'desc'        => 'Insert the video url here',
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'section'     => ''
			),

			array(
				'label'       => 'Likes',
				'id'          => 'votes_count',
				'type'        => 'text',
				'desc'        => 'Enter the number of Likes.',
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),

			array(
				'label'       => 'Views',
				'id'          => 'post_views_count',
				'type'        => 'text',
				'desc'        => 'Enter the number of views.',
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),

			array(
				'label'       => 'Sidebar Option',
				'id'          => 'wpl_sidebar_option',
				'type'        => 'on-off',
				'desc'        => 'Display or hide the sidebar on this page', 
				'std'         => 'on',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),

			array(
				'label'       => 'Share Buttons',
				'id'          => 'wpl_share_buttons_video',
				'type'        => 'on-off',
				'desc'        => 'Activate or deactivate Share Buttons',
				'std'         => 'on',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),

		)
	);
	ot_register_meta_box( $videos_meta_box );

	/*-----------------------------------------------------------
  		DJs
  	-----------------------------------------------------------*/

	$dj_meta_box = array(
		'id'          => 'dj_meta_box',
		'title'       => 'Dj Options',
		'desc'        => '',
		'pages'       => array( 'post_dj' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(  
			

			array(
				'label'       => 'Likes',
				'id'          => 'votes_count',
				'type'        => 'text',
				'desc'        => 'Enter the number of Likes.',
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),

			array(
				'label'       => 'Views',
				'id'          => 'post_views_count',
				'type'        => 'text',
				'desc'        => 'Enter the number of views.',
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),


			array(
				'label'       => 'Share Buttons',
				'id'          => 'wpl_share_buttons_dj',
				'type'        => 'on-off',
				'desc'        => 'Activate or deactivate Share Buttons', 
				'std'         => 'on',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),

		)
	);
	ot_register_meta_box( $dj_meta_box );


	/*-----------------------------------------------------------
  		Gallery
  	-----------------------------------------------------------*/

	$gallery_meta_box = array(
		'id'          => 'gallery_meta_box',
		'title'       => 'Gallery Options',
		'desc'        => '',
		'pages'       => array( 'post_gallery' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(  
			array(
				'label'       => 'Likes',
				'id'          => 'votes_count',
				'type'        => 'text',
				'desc'        => 'Enter the number of Likes.',
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),

			array(
				'label'       => 'Views',
				'id'          => 'post_views_count',
				'type'        => 'text',
				'desc'        => 'Enter the number of views.',
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),

			array(
				'label'       => 'Sidebar Option',
				'id'          => 'wpl_sidebar_option',
				'type'        => 'on-off',
				'desc'        => 'Display or hide the sidebar on this page', 
				'std'         => 'on',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),

			array(
				'label'       => 'Share Buttons',
				'id'          => 'wpl_share_buttons_gallery',
				'type'        => 'on-off',
				'desc'        => 'Activate or deactivate Share Buttons', 
				'std'         => 'on',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),


		)
	);
	ot_register_meta_box( $gallery_meta_box );


	/*-----------------------------------------------------------
  		Events
  	-----------------------------------------------------------*/

	$events_meta_box = array(
		'id'          => 'events_meta_box',
		'title'       => 'Events Options',
		'desc'        => '',
		'pages'       => array( 'post_events' ),
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(  
			array(
				'label'       => 'Flyer',
				'id'          => 'wpl_flyer_image',
				'type'        => 'upload',
				'desc'        => 'The image will display in the event page.',
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'section'     => ''
			),

			array(
				'label'       => 'Do you want to display the Flyer Horizontally?',
				'id'          => 'wpl_flyer_position_orizontal',
				'desc'        => 'By default the flyer is displayed on the left side. Activate this setting if your want to dispay the flyer on top and horizontally positioned.',
				'std'         => '',
				'type'        => 'checkbox',
				'section'     => '',
				'class'       => '',
				'choices'     => array(
					array( 
					'value' => 'yes',
					'label' => 'Yes' 
					)
				)
			),

			array(
				'label'       => 'Date',
				'id'          => 'wpl_event_date',
				'type'        => 'date-picker',
				'desc'        => 'Insert the event date. Ex: 2013-04-27 (yyyy-mm-dd)',
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'label'       => 'Time',
				'id'          => 'wpl_event_time',
				'type'        => 'text',
				'desc'        => 'Insert the event time. Ex: 18:00 or 06:00 PM',
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),

			array(
				'label'       => 'Event Price',
				'id'          => 'wpl_event_price',
				'type'        => 'text',
				'desc'        => 'Add the price for the entrance.',
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),


			array(
				'label'       => 'Event Status',
				'id'          => 'wpl_events_status',
				'type'        => 'select',
				'desc'        => 'Select the event status', 
				'choices'     => array(
					array(
						'label'       => 'None',
						'value'       => 'none'
					),
					array(
						'label'       => 'Sold out',
						'value'       => 'soldout'
					),
					array(
						'label'       => 'Canceled',
						'value'       => 'canceled'
					),
					array(
						'label'       => 'Free entry',
						'value'       => 'freeentry'
					),
					array(
						'label'       => 'Buy',
						'value'       => 'buy'
					),
				),        
				'std'         => 'activate',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),



			array(
				'label'       => 'Buy URL',
				'id'          => 'wpl_event_url',
				'type'        => 'text',
				'desc'        => 'Add the URL from where to buy the ticket.',
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),

			array(
				'label'       => 'Event Location',
				'id'          => 'wpl_event_location',
				'type'        => 'text',
				'desc'        => 'The name of the building where the event will take place',
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),


			array(
				'label'       => 'Address',
				'id'          => 'wpl_event_address',
				'type'        => 'text',
				'desc'        => 'Add the event adress. Ex: 51 Sherbrooke W., Montreal, QC.',
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),


			array(
				'label'       => 'City/Country',
				'id'          => 'wpl_event_city',
				'type'        => 'text',
				'desc'        => 'Add the event City and Country. Ex: Paris/France',
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),


			array(
				'label'       => 'Latitude',
				'id'          => 'wpl_event_latitude',
				'type'        => 'text',
				'desc'        => 'Add the event Latitude',
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'label'       => 'Longitude',
				'id'          => 'wpl_event_longitude',
				'type'        => 'text',
				'desc'        => 'Add the event Longitude',
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),
			array(
				'label'       => 'Pin map Icon',
				'id'          => 'wpl_event_pin_map_icon',
				'type'        => 'upload',
				'desc'        => 'Upload an Pin for map. The image size: ~32x32px.',
				'std'         => '',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),

			array(
				'label'       => 'Share Buttons',
				'id'          => 'wpl_share_buttons_events',
				'type'        => 'on-off',
				'desc'        => 'Activate or deactivate Share Buttons', 
				'std'         => 'on',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => ''
			),

		)
	);
	ot_register_meta_box( $events_meta_box );
	
}