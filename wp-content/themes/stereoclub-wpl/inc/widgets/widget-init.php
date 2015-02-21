<?php 
/**
 * Register widget areas.
 *
 * @package WPlook
 * @subpackage StereoClub
 * @since StereoClub 1.0
 */


/*-----------------------------------------------------------
	Include Widgets
-----------------------------------------------------------*/
get_template_part( '/inc/widgets/widget', 'video' );
get_template_part( '/inc/widgets/widget', 'events' );
get_template_part( '/inc/widgets/widget', 'events-home' );
get_template_part( '/inc/widgets/widget', 'tours' );
get_template_part( '/inc/widgets/widget', 'posts' );
get_template_part( '/inc/widgets/widget', 'quote' );
get_template_part( '/inc/widgets/widget', 'flickr' );
get_template_part( '/inc/widgets/widget', 'address' );
get_template_part( '/inc/widgets/widget', 'cd' );
get_template_part( '/inc/widgets/widget', 'dj' );
get_template_part( '/inc/widgets/widget', 'playlist' );
get_template_part( '/inc/widgets/widget', 'social' );
get_template_part( '/inc/widgets/widget', 'gallery-home' );



function wplook_widgets_init() {

	/*-----------------------------------------------------------
		Home page Widget area
	-----------------------------------------------------------*/
	
	register_sidebar( array(
		'name' => __( 'Left Home Page Widget area', 'wplook' ),
		'id' => 'front-1',
		'description' => __('Widgets in this area will be shown only on the Home Page Template.','wplook' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="entry-header"><h1 class="entry-title">',
		'after_title' => '</h1><div class="clear"></div></div>'
	) );

	register_sidebar( array(
		'name' => __( 'Right Home Page Widget area', 'wplook' ),
		'id' => 'front-2',
		'description' => __('Widgets in this area will be shown only on the Home Page Template.','wplook' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="entry-header"><h1 class="entry-title">',
		'after_title' => '</h1><div class="clear"></div></div>'
	) );


	/*-----------------------------------------------------------
		Pages widget area
	-----------------------------------------------------------*/
	
	register_sidebar( array(
		'name' => __( 'Page Widget area', 'wplook' ),
		'id' => 'page-1',
		'description' => __('Widgets in this area will be shown on All Pages.','wplook' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="entry-header"><h1 class="entry-title">',
		'after_title' => '</h1><div class="clear"></div></div>'
	) );
	

	/*-----------------------------------------------------------
		Posts Widget area
	-----------------------------------------------------------*/
	
	register_sidebar( array(
		'name' => __( 'Blog Widget area', 'wplook' ),
		'id' => 'post-1',
		'description' => __('Widgets in this area will be shown on All Posts.','wplook' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="entry-header"><h1 class="entry-title">',
		'after_title' => '</h1><div class="clear"></div></div>'
	) );
	

	/*-----------------------------------------------------------
		Event widget area
	-----------------------------------------------------------*/
	
	register_sidebar( array(
		'name' => __( 'Event Widget area', 'wplook' ),
		'id' => 'event-1',
		'description' => __('Widgets in this area will be shown on All Events.','wplook' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="entry-header"><h1 class="entry-title">',
		'after_title' => '</h1><div class="clear"></div></div>'
	) );


	/*-----------------------------------------------------------
		Video Widget area
	-----------------------------------------------------------*/
	
	register_sidebar( array(
		'name' => __( 'Video Widget area', 'wplook' ),
		'id' => 'video-1',
		'description' => __('Widgets in this area will be shown on all Video pages.','wplook' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="entry-header"><h1 class="entry-title">',
		'after_title' => '</h1><div class="clear"></div></div>'
	) );


	/*-----------------------------------------------------------
		Gallerry Widget area
	-----------------------------------------------------------*/
	
	register_sidebar( array(
		'name' => __( 'Gallery Widget area', 'wplook' ),
		'id' => 'gallery-1',
		'description' => __('Widgets in this area will be shown on all Gallery pages.','wplook' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="entry-header"><h1 class="entry-title">',
		'after_title' => '</h1><div class="clear"></div></div>'
	) );
	

	/*-----------------------------------------------------------
		DJ widget area
	-----------------------------------------------------------*/
	
	register_sidebar( array(
		'name' => __( 'Dj Widget area', 'wplook' ),
		'id' => 'dj-1',
		'description' => __('Widgets in this area will be shown on all DJs page.','wplook' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="entry-header"><h1 class="entry-title">',
		'after_title' => '</h1><div class="clear"></div></div>'
	) );


	/*-----------------------------------------------------------
		CD Widget area
	-----------------------------------------------------------*/
	
	register_sidebar( array(
		'name' => __( 'CD Widget area', 'wplook' ),
		'id' => 'cd-1',
		'description' => __('Widgets in this area will be shown on all CD pages.','wplook' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="entry-header"><h1 class="entry-title">',
		'after_title' => '</h1><div class="clear"></div></div>'
	) );


	/*-----------------------------------------------------------
		Contact page Widget area
	-----------------------------------------------------------*/
	
	register_sidebar( array(
		'name' => __( 'Contact Page Widget area', 'wplook' ),
		'id' => 'contact-1',
		'description' => __('Widgets in this area will be shown on Contact Pages.','wplook' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="entry-header"><h1 class="entry-title">',
		'after_title' => '</h1><div class="clear"></div></div>'
	) );


	/*-----------------------------------------------------------
		Footer Widget area
	-----------------------------------------------------------*/

	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'wplook' ),
		'id' => 'f1-widgets',
		'description' => __( 'The first footer widget area', 'wplook' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="entry-header"><h1 class="entry-title">',
		'after_title' => '</h1><div class="clear"></div></div>'
	) );


	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'wplook' ),
		'id' => 'f2-widgets',
		'description' => __( 'The second footer widget area', 'wplook' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="entry-header"><h1 class="entry-title">',
		'after_title' => '</h1><div class="clear"></div></div>'
	) );


	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'wplook' ),
		'id' => 'f3-widgets',
		'description' => __( 'The Third footer widget area', 'wplook' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="entry-header"><h1 class="entry-title">',
		'after_title' => '</h1><div class="clear"></div></div>'
	) );

}
/** Register sidebars */
add_action( 'widgets_init', 'wplook_widgets_init' );
?>
