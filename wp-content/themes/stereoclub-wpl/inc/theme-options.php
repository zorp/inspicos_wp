<?php
/**
 * The default Theme Options
 *
 * @package WordPress
 * @subpackage StereoClub
 * @since StereoClub 1.0
 */


/*-----------------------------------------------------------------------------------*/
/*	Initialize the options before anything else. 
/*-----------------------------------------------------------------------------------*/

add_action( 'admin_init', 'wpl_theme_options', 1 );


/*-----------------------------------------------------------------------------------*/
/*	Build the custom settings & update OptionTree.
/*-----------------------------------------------------------------------------------*/
if (!function_exists('wpl_theme_options')) {
	function wpl_theme_options() {

		/*-----------------------------------------------------------
			Get a copy of the saved settings array.
		-----------------------------------------------------------*/

		$saved_settings = get_option( 'option_tree_settings', array() );

		/*-----------------------------------------------------------
			Custom settings array that will eventually be  passes 
			to the OptionTree Settings API Class.
		-----------------------------------------------------------*/

		$custom_settings = array(
			'contextual_help' => array(

				'content'       => array( 
					array(
						'id'        => 'general_help',
						'title'     => 'General',
						'content'   => '<p>Help content goes here!</p>'
					)
				),

				'sidebar'       => '<p>Sidebar content goes here!</p>',
			),

			'sections'        => array(


				/*-----------------------------------------------------------
					General Settings
				-----------------------------------------------------------*/
				
				array(
					'title'       => 'General settings',
					'id'          => 'general_settings'
				),


				/*-----------------------------------------------------------
					Toolbar Settings
				-----------------------------------------------------------*/
				
				array(
					'title'       => 'Social Network',
					'id'          => 'social_settings'
				),


				/*-----------------------------------------------------------
					Slider Settings
				-----------------------------------------------------------*/

				array(
					'title'       => 'Background settings',
					'id'          => 'background_settings'
				),


				/*-----------------------------------------------------------
					Events settings
				-----------------------------------------------------------*/

				array(
					'title'       => 'Events settings',
					'id'          => 'events_settings'
				),
				

				/*-----------------------------------------------------------
					Video settings
				-----------------------------------------------------------*/

				array(
					'title'       => 'Video settings',
					'id'          => 'video_settings'
				),


				/*-----------------------------------------------------------
					Gallery settings
				-----------------------------------------------------------*/

				array(
					'title'       => 'Gallery settings',
					'id'          => 'gallery_settings'
				),


				/*-----------------------------------------------------------
					Dj settings
				-----------------------------------------------------------*/

				array(
					'title'       => 'Dj settings',
					'id'          => 'dj_settings'
				),


				/*-----------------------------------------------------------
					CD settings
				-----------------------------------------------------------*/

				array(
					'title'       => 'CD settings',
					'id'          => 'cd_settings'
				),

			),

			'settings'        => array(

				/*-----------------------------------------------------------
					General Settings
				-----------------------------------------------------------*/
				
				array(
					'label'       => 'Logo Image',
					'id'          => 'wpl_logo',
					'type'        => 'upload',
					'desc'        => 'Max file width 360px and max file height 75px',
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),

				array(
					'label'       => 'Favicon',
					'id'          => 'wpl_favicon',
					'type'        => 'upload',
					'desc'        => 'Upload your favicon.<br/><br/><strong>NOTICE:</strong> Use .png image type. You can generate an favicon <a target="_blank" href="http://www.favicon.cc">here</a>',
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),

				array(
					'label'       => 'Google Analytics Tracking Code',
					'id'          => 'wpl_google_analytics_tracking_code',
					'type'        => 'textarea-simple',
					'desc'        => 'Insert the complete tracking script from analytics.google.com',
					'std'         => '',
					'rows'        => '8',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),

				array(
					'label'       => 'Status info',
					'id'          => 'wpl_status',
					'type'        => 'on-off',
					'desc'        => 'Activate or deactivate Status info from the footer.',
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),

				array(
					'label'       => 'Copyright',
					'id'          => 'wpl_copyright',
					'type'        => 'text',
					'desc'        => 'Enter your Copyright notice displayed in the footer of the website.',
					'std'         => 'Copyright &copy; 2013. All Rights reserved.',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),

				array(
					'label'       => 'Custom Cascading Style Sheets',
					'id'          => 'wpl_css',
					'type'        => 'css',
					'desc'        => 'Add custom CSS to your theme.',
					'std'         => '',
					'rows'        => '10',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),

				array(
					'label'       => 'Contact Form Email',
					'id'          => 'wpl_contact_form_email',
					'type'        => 'text',
					'desc'        => 'Add the default emaild address for contact form.',
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),

				array(
					'label'       => 'Footer Widget area',
					'id'          => 'wpl_footer_widget_area',
					'type'        => 'on-off',
					'desc'        => 'Activate or deactivate footer widget area',
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'general_settings'
				),


				/*-----------------------------------------------------------
					Toolbar Settings
				-----------------------------------------------------------*/

				array(
					'label'       => 'Social Network Navigation',
					'id'          => 'toolbar_share',
					'type'        => 'list-item',
					'desc'        => 'Press the <strong>Add New</strong> button in order to add social media links.',
					'settings'    => array(
						array(
							'label'       => 'Service Name',
							'id'          => 'wpl_share_item_name',
							'type'        => 'text',
							'desc'        => 'The name of the social network site, for example: "Facebook"',
							'std'         => '',
							'rows'        => '',
							'post_type'   => '',
							'taxonomy'    => '',
							'class'       => '',
							'section'     => ''
						),
						array(
							'label'       => 'URL',
							'id'          => 'wpl_share_item_url',
							'type'        => 'text',
							'desc'        => 'Enter the URL of the social network site, for example: http://www.facebook.com/wplookthemes',
							'std'         => '',
							'rows'        => '',
							'post_type'   => '',
							'taxonomy'    => '',
							'class'       => '',
							'section'     => ''
						), 
						array(
							'label'       => 'Icon',
							'id'          => 'wpl_share_item_icon',
							'type'        => 'text',
							'desc'        => '<strong>NOTICE</strong>: Choose one item from tne next list: <br />icon-facebook, <br />icon-twitter, <br />icon-pinterest, <br />icon-google-plus, <br />icon-lastfm, <br />icon-soundcloud, <br />icon-vimeo, <br />icon-dribbble, <br />icon-flickr, <br />icon-feed2',
							'std'         => 'icon-',
							'rows'        => '',
							'post_type'   => '',
							'taxonomy'    => '',
							'class'       => '',
							'section'     => ''
						), 
					),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'social_settings'
				),

				array(
					'label'       => 'Search form',
					'id'          => 'wpl_search_form',
					'type'        => 'on-off',
					'desc'        => 'Activate or deactivate the search form.',
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'social_settings'
				),


				/*-----------------------------------------------------------
					Background Settings
				-----------------------------------------------------------*/

				array(
					'label'       => 'Slides',
					'id'          => 'wpl_sliders',
					'type'        => 'list-item',
					'desc'        => 'Press the <strong>Add New</strong> button in order to add a new slider.',
					'settings'    => array(
						array(
							'label'       => 'Slider Image',
							'id'          => 'wpl_slider_item_image',
							'type'        => 'upload',
							'desc'        => '<strong>Recommended image size:</strong> 1920x1080px.',
							'std'         => '',
							'rows'        => '',
							'post_type'   => '',
							'class'       => '',
							'taxonomy'    => '',
							'class'       => '',
							'section'     => ''
						),


						array(
							'label'       => 'Slide Title',
							'id'          => 'wpl_slider_item_title',
							'type'        => 'text',
							'desc'        => 'Enter a slide Title. <br /><strong>Note:</strong> Only text are permited, no special characters. <br /> Add a <strong>span</strong> if you want to add a background for the text.',
							'std'         => '',
							'rows'        => '',
							'post_type'   => '',
							'class'       => '',
							'taxonomy'    => '',
							'section'     => ''
						),

						
						array(
							'label'       => 'Slide Description',
							'id'          => 'wpl_slider_item_description',
							'type'        => 'text',
							'desc'        => 'Enter a slide Description. <br /><strong>Note:</strong> Only text are permited, no special characters. <br /> Add a <strong>span</strong> if you want to add a background for the text.',
							'std'         => '',
							'rows'        => '',
							'post_type'   => '',
							'class'       => '',
							'taxonomy'    => '',
							'section'     => ''
						),


					),
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'background_settings'
				),
			

				array(
					'label'       => 'Background messages on home page',
					'id'          => 'wpl_bg_messages',
					'type'        => 'on-off',
					'desc'        => 'Display or hide the Home page background messages',
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'background_settings'
				),


				array(
					'label'       => 'Revolution Slider Alias',
					'id'          => 'wpl_slider_revolution',
					'type'        => 'text',
					'desc'        => '<strong>Use Revolution Slider instead of display background messages on home page.</strong> If you have installed the revolution slider Plugin, add the Slider Alias here. From this example [rev_slider test1] you need to add only the test1. If you do not have the plugin you can buy it from here: http://bit.ly/1eD7aE1',
					'std'         => '',
					'rows'        => '',
					'post_type'   => '',
					'class'       => '',
					'taxonomy'    => '',
					'section'     => 'background_settings'
				),


				array(
					'label'       => 'Progress Bar',
					'id'          => 'wpl_slide_progress_bar',
					'type'        => 'on-off',
					'desc'        => 'Display or hide the progress bar',
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'background_settings'
				),


				array(
					'label'       => 'Slide Interval',
					'id'          => 'wpl_slider_interval',
					'type'        => 'text',
					'desc'        => 'Length between transitions',
					'std'         => '5000',
					'rows'        => '',
					'post_type'   => '',
					'class'       => '',
					'taxonomy'    => '',
					'section'     => 'background_settings'
				),

				array(
					'label'       => 'Slide transition speed',
					'id'          => 'wpl_slider_transition_speed',
					'type'        => 'text',
					'desc'        => 'Speed of transition',
					'std'         => '1700',
					'rows'        => '',
					'post_type'   => '',
					'class'       => '',
					'taxonomy'    => '',
					'section'     => 'background_settings'
				),

				array(
					'label'       => 'Background functionality',
					'id'          => 'wpl_bg_function',
					'type'        => 'on-off',
					'desc'        => 'Disable the progress bar, background slides and messages.',
					'std'         => 'on',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'background_settings'
				),


				/*-----------------------------------------------------------
					Events settings
				-----------------------------------------------------------*/

				array(
					'label'       => 'URL Rewrite',
					'id'          => 'wpl_events_url_rewrite',
					'type'        => 'text',
					'desc'        => '',
					'std'         => 'events',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'events_settings'
				),

				array(
					'label'       => 'URL Rewrite Name',
					'id'          => 'wpl_events_url_rewrite_name',
					'type'        => 'text',
					'desc'        => '',
					'std'         => 'Event',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'events_settings'
				),

				array(
					'label'       => 'Category URL Rewrite',
					'id'          => 'wpl_events_category_url_rewrite',
					'type'        => 'text',
					'desc'        => '',
					'std'         => 'events-category',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'events_settings'
				),


				array(
					'label'       => 'First item excerpt limit',
					'id'          => 'wpl_events_excerpt_limit',
					'type'        => 'numeric-slider',
					'desc'        => 'Set how many words do you want to display for the first upcoming and past events excerpt.',
					'std'         => '45',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'events_settings'
				),

				array(
					'label'       => 'Other items excerpt limit',
					'id'          => 'wpl_rest_events_excerpt_limit',
					'type'        => 'numeric-slider',
					'desc'        => 'Set how many words do you want to display for the rest upcoming and past events excerpt.',
					'std'         => '20',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'events_settings'
				),



				/*-----------------------------------------------------------
					Video settings
				-----------------------------------------------------------*/

				array(
					'label'       => 'URL Rewrite',
					'id'          => 'wpl_video_url_rewrite',
					'type'        => 'text',
					'desc'        => '',
					'std'         => 'video',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'video_settings'
				),

				array(
					'label'       => 'URL Rewrite name',
					'id'          => 'wpl_video_url_rewrite_name',
					'type'        => 'text',
					'desc'        => '',
					'std'         => 'Video',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'video_settings'
				),

				array(
					'label'       => 'Category URL Rewrite',
					'id'          => 'wpl_video_category_url_rewrite',
					'type'        => 'text',
					'desc'        => '',
					'std'         => 'video-category',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'video_settings'
				),


				/*-----------------------------------------------------------
					Gallery settings
				-----------------------------------------------------------*/

				array(
					'label'       => 'URL Rewrite',
					'id'          => 'wpl_gallery_url_rewrite',
					'type'        => 'text',
					'desc'        => '',
					'std'         => 'gallery',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'gallery_settings'
				),

				array(
					'label'       => 'URL Rewrite Name',
					'id'          => 'wpl_gallery_url_rewrite_name',
					'type'        => 'text',
					'desc'        => '',
					'std'         => 'Galleries',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'gallery_settings'
				),

				array(
					'label'       => 'Category URL Rewrite',
					'id'          => 'wpl_gallery_category_url_rewrite',
					'type'        => 'text',
					'desc'        => '',
					'std'         => 'gallery-category',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'gallery_settings'
				),


				/*-----------------------------------------------------------
					Dj settings
				-----------------------------------------------------------*/

				array(
					'label'       => 'URL Rewrite',
					'id'          => 'wpl_dj_url_rewrite',
					'type'        => 'text',
					'desc'        => '',
					'std'         => 'dj',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'dj_settings'
				),

				array(
					'label'       => 'URL Rewrite Name',
					'id'          => 'wpl_dj_url_rewrite_name',
					'type'        => 'text',
					'desc'        => '',
					'std'         => 'Dj',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'dj_settings'
				),

				array(
					'label'       => 'Category URL Rewrite',
					'id'          => 'wpl_dj_category_url_rewrite',
					'type'        => 'text',
					'desc'        => '',
					'std'         => 'dj-category',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'dj_settings'
				),


				/*-----------------------------------------------------------
					CD settings
				-----------------------------------------------------------*/

				array(
					'label'       => 'URL Rewrite',
					'id'          => 'wpl_cd_url_rewrite',
					'type'        => 'text',
					'desc'        => '',
					'std'         => 'cd',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'cd_settings'
				),

				array(
					'label'       => 'URL Rewrite Name',
					'id'          => 'wpl_cd_url_rewrite_name',
					'type'        => 'text',
					'desc'        => '',
					'std'         => 'CD',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'cd_settings'
				),

				array(
					'label'       => 'Category URL Rewrite',
					'id'          => 'wpl_cd_category_url_rewrite',
					'type'        => 'text',
					'desc'        => '',
					'std'         => 'cd-category',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'class'       => '',
					'section'     => 'cd_settings'
				),


				
			)
		);
		/* settings are not the same update the DB */
		if ( $saved_settings !== $custom_settings ) {
			update_option( 'option_tree_settings', $custom_settings ); 
		}
	}
}

