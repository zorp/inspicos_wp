<?php
/**
 * The header template file
 *
 * @package WordPress
 * @subpackage StereoClub
 * @since StereoClub 1.0
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php global $page, $paged;
		wp_title( '', true, 'right' );
		?></title>
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Favicon -->
	<?php if ( ot_get_option('wpl_favicon') ) { ?>
		<link rel="shortcut icon" href="<?php echo ot_get_option('wpl_favicon');  ?>">
		<link rel="apple-touch-icon" href="<?php echo ot_get_option('wpl_favicon');  ?>" />
	<?php } ?>
	
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>
	<?php wp_head(); ?>
	<style type="text/css"><?php echo stripslashes(ot_get_option('wpl_css')) ?></style>
	<link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,200&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
</head>
<body <?php body_class(); ?>>
	
	<!-- Progress Bar -->					
	<?php if ( ot_get_option('wpl_slide_progress_bar') != 'off'){?>
		<div id="progress-back" class="load-item">
			<div id="progress-bar"></div>
		</div>
	<?php } ?> 

	<div id="page">
		<div id="page-view">
			
			<!-- Header -->
			<header id="branding" class="site-header" role="banner">
				<div class="container_12">
					<div class="grid_12 no-m-b no-m-t">
						<!-- Site title and description -->
						<div class="fleft grid_4 branding">
							<h1 id="site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo('description'); ?>" rel="home">
								<?php   
								if ( ot_get_option('wpl_logo') != ''){?>
										<img src="<?php echo ot_get_option('wpl_logo'); ?>">
									<?php } else {
										bloginfo('name');
									}?>
								</a>
							</h1>
							<h2 id="site-description"><?php bloginfo('description'); ?></h2>
						</div>
						<!-- Search and Share icons -->
						<div class="fright no-m-t socialnetworking">
							<?php $toolbar_share = ot_get_option( 'toolbar_share', array() ); ?>
								
								<?php
									if ( has_nav_menu( 'language' ) ) { 
										wp_nav_menu( array('depth' => '3', 'theme_location' => 'language' ));
								} ?> 

								<ul class="share-items">
									<?php if ( ot_get_option('wpl_search_form') == "on") { ?>
									<li class="share-item-icon-search">
										<a target="_blank" title="Search"><i class="icon-search"></i></a>
										<!-- Search Form -->
										<div class="header-search-form">
											<form method="get" id="header-searchform" action="<?php echo get_site_url(); ?>">
												<div>
													<input class="radius" type="text" size="" name="s" id="s" value="<?php _e('Type your searching word', 'wplook'); ?>" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/>
													<input type="submit" class="search-button" id="searchsubmit" value="<?php _e('Search', 'wplook'); ?>" />
												</div>
											</form>
										</div>
									</li>
									<?php } ?>
									
									<?php if( $toolbar_share ) : ?>
										<?php foreach( $toolbar_share as $item ) : ?>
											<li class="share-item-<?php echo $item['wpl_share_item_icon']; ?>"><a target="_blank" title="<?php echo $item['wpl_share_item_name']; ?>" href="<?php echo $item['wpl_share_item_url']; ?>"><i class="<?php echo $item['wpl_share_item_icon']; ?>"></i></a></li>
										<?php endforeach; ?>
									<?php endif; ?>
								</ul>

								<div class="epa-logo"><img src="/wp-content/uploads/2015/02/epa_logo.png" alt="European Patent Attorneys"</div>
						</div>
						<div class="clear"></div>
					</div>
				</div>
			</header>
			
			<!-- Main Menu -->
			<div class="container_12 main-menu-section">
				<nav role="navigation" class="site-navigation main-navigation grid_12" id="site-navigation">
					<?php wp_nav_menu( array('depth' => '3', 'theme_location' => 'primary' )); ?>
				</nav>
			</div>