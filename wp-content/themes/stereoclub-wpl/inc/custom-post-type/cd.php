<?php
/**
 * The default Custom post type for CD
 *
 * @package WordPress
 * @subpackage StereoClub
 * @since StereoClub 1.0.4
 */
?>
<?php
if (!function_exists('wpl_cd_cpt')) {
	
	function wpl_cd_cpt(){
		
		$url_rewrite = ot_get_option('wpl_cd_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'cd'; }

		$url_rewrite_name = ot_get_option('wpl_cd_url_rewrite_name');
		if( !$url_rewrite_name ) { $url_rewrite_name = 'CD'; }

		register_post_type('post_cd',
			array(
				'labels' => array(
					'name' => 'CD',
					'singular_name' => $url_rewrite_name,
					'add_new' => 'Add New CD',
					'add_new_item' => 'Add New CD',
					'edit' => 'Edit',
					'edit_item' => 'Edit CD',
					'new_item' => 'New CD',
					'view' => 'View',
					'view_item' => 'View CD',
					'search_items' => 'Search CDs',
					'not_found' => 'No CDs found',
					'not_found_in_trash' => 'No CDs found in Trash',
					'parent' => 'Parent CD'
				),
				'description' => 'Easily lets you create some beautiful CDs.',
				'public' => true,
				'show_ui' => true, 
				'_builtin' => false,
				'capability_type' => 'page',
				'hierarchical' => false,
				'rewrite' => array('slug' => $url_rewrite),
				//'menu_icon' => get_template_directory_uri() . '/images/cd.png',
				'supports' => array('title', 'editor', 'thumbnail'),
			)
		); 
		flush_rewrite_rules();
	}
	add_action('init', 'wpl_cd_cpt');
}	


/*-----------------------------------------------------------------------------------*/
/*	Adding category for Publications
/*-----------------------------------------------------------------------------------*/

if (!function_exists('wpl_cd_category')) {
	function wpl_cd_category() {

		$url_rewrite = ot_get_option('wpl_cd_category_url_rewrite');
		if( !$url_rewrite ) { $url_rewrite = 'cd-category'; }

		register_taxonomy('wpl_cd_category', 'post_cd', 
			array( 
				'hierarchical' => true, 
				'labels' => array(
					  'name' => 'CD Categories',
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
	add_action('init', 'wpl_cd_category');
}