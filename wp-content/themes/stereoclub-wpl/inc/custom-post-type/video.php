<?php
/**
 * The default Custom post type for Video
 *
 * @package WordPress
 * @subpackage StereoClub
 * @since StereoClub 1.0
 */
?>
<?php 
if (!function_exists('wpl_video_cpt')) {
	
	function wpl_video_cpt(){
		
		$url_rewrite = ot_get_option('wpl_video_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'video'; }

		$url_rewrite_name = ot_get_option('wpl_video_url_rewrite_name');
		if( !$url_rewrite_name ) { $url_rewrite_name = 'Video'; }

		register_post_type('post_video',
			array(
				'labels' => array(
					'name' => 'Videos',
					'singular_name' => $url_rewrite_name,
					'add_new' => 'Add New Video',
					'add_new_item' => 'Add New Video',
					'edit' => 'Edit',
					'edit_item' => 'Edit Video',
					'new_item' => 'New Video',
					'view' => 'View',
					'view_item' => 'View Videos',
					'search_items' => 'Search Videos',
					'not_found' => 'No Videos found',
					'not_found_in_trash' => 'No Videos found in Trash',
					'parent' => 'Parent Video'
				),
				'description' => 'Easily lets you create some beautiful Videos.',
				'public' => true,
				'show_ui' => true, 
				'_builtin' => false,
				'capability_type' => 'page',
				'hierarchical' => false,
				'rewrite' => array('slug' => $url_rewrite),
				'supports' => array('title', 'editor', 'thumbnail'),
			)
		); 
		flush_rewrite_rules();
	}
	add_action('init', 'wpl_video_cpt');
}

/*-----------------------------------------------------------------------------------*/
/*	Adding category for Videos
/*-----------------------------------------------------------------------------------*/

if (!function_exists('wpl_video_category')) {
	function wpl_video_category() {

		$url_rewrite = ot_get_option('wpl_video_category_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'videos-category'; }

		register_taxonomy('wpl_video_category', 'post_video', 
			array( 
				'hierarchical' => true, 
				'labels' => array(
					  'name' => 'Video Categories',
					  'singular_name' => 'Category',
					  'search_items' =>  'Search in Category',
					  'popular_items' => 'Popular Categories',
					  'all_items' => 'All Categories',
					  'parent_item' => 'Parent Category',
					  'parent_item_colon' => 'Parent Category:',
					  'edit_item' => 'Edit Category',
					  'update_item' => 'Update Category',
					  'add_new_item' => 'Add New Category',
					  'new_item_name' => 'New Category Name'
				),
				'show_ui' => true,
				'query_var' => true, 
				'rewrite' => array('slug' => $url_rewrite)
			) 
		); 
		flush_rewrite_rules();
	}
	add_action('init', 'wpl_video_category');
}