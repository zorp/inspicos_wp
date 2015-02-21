<?php
/**
 * The default Custom post type for Staff
 *
 * @package WordPress
 * @subpackage StereoClub
 * @since StereoClub 1.0
 */
?>
<?php
if (!function_exists('wpl_dj_cpt')) {
	
	function wpl_dj_cpt(){
		
		$url_rewrite = ot_get_option('wpl_dj_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'staff'; }

		$url_rewrite_name = ot_get_option('wpl_dj_url_rewrite_name');
		if( !$url_rewrite_name ) { $url_rewrite_name = 'dj'; }

		register_post_type('post_dj',
			array(
				'labels' => array(
					'name' => 'Dj',
					'singular_name' => $url_rewrite_name,
					'add_new' => 'Add New DJ',
					'add_new_item' => 'Add New DJ',
					'edit' => 'Edit',
					'edit_item' => 'Edit DJ',
					'new_item' => 'New DJ',
					'view' => 'View',
					'view_item' => 'View DJ',
					'search_items' => 'Search for DJs',
					'not_found' => 'No DJs found',
					'not_found_in_trash' => 'No DJs found in Trash',
					'parent' => 'Parent DJ'
				),
				'description' => 'Easily lets you create some beautiful Dj.',
				'public' => true,
				'show_ui' => true, 
				'_builtin' => false,
				'capability_type' => 'page',
				'hierarchical' => false,
				'rewrite' => array('slug' => $url_rewrite),
				//'menu_icon' => get_template_directory_uri() . '/images/dj.png',
				'supports' => array('title', 'editor', 'thumbnail'),
			)
		); 
		flush_rewrite_rules();
	}
	add_action('init', 'wpl_dj_cpt');
}

/*-----------------------------------------------------------------------------------*/
/*	Adding category for Staff
/*-----------------------------------------------------------------------------------*/

if (!function_exists('wpl_dj_category')) {
	function wpl_dj_category() {

		$url_rewrite = ot_get_option('wpl_dj_category_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'dj-items'; }

		register_taxonomy('wpl_dj_category', 'post_dj', 
			array( 
				'hierarchical' => true, 
				'labels' => array(
					  'name' => 'DJ Categories',
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
	add_action('init', 'wpl_dj_category');
}