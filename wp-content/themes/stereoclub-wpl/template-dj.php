<?php
/**
 * Template Name: Resident Dj Page
 *
 * @package WordPress
 * @subpackage StereoClub
 * @since StereoClub 1.0.0
 */
?>

<?php get_header(); ?>
<!-- Main -->
<div id="main" class="site-main container_12">
	
	<!-- Left column -->
	<div id="primary" class="grid_8">
		<!-- CD list -->
		<section id="galleries" class="WPlooklatestposts">
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<div class="clear"></div>
			</header>
			
			<div class="entry-content-list">
				
				<ul class="grid cs-style-gallery">

					<?php $args = array( 'post_type' => 'post_dj','post_status' => 'publish', 'paged'=> $paged); ?>
					<?php $wp_query = null; ?>
					<?php $wp_query = new WP_Query( $args ); ?>
					<?php if ( $wp_query->have_posts() ) : ?>
						<?php while ( $wp_query->have_posts() ) : $wp_query->the_post();?>
						<?php 
							$event_date = get_post_meta(get_the_ID(), 'wpl_event_date', true); 

						?>


						<li class='cd-cs-style-item'>
							<a href="<?php the_permalink(); ?>">
								<figure>
									<?php if ( has_post_thumbnail() ) { 
										the_post_thumbnail('medium-thumb'); 
									} else { ?>
										<img src="<?php echo get_template_directory_uri() . '/images/temp/300x300.jpg' ?>">
									<?php } ?>
									<figcaption>
										<h3><?php the_title(); ?></h3>
										<?php if ( wplook_custom_taxonomies_terms_links() ) { ?>
											<div><?php echo wplook_custom_taxonomies_terms_links(); ?></div>
										<?php } else { ?>
											<div><?php _e('Read more', 'wplook'); ?></div>
										<?php } ?>
									</figcaption>
								</figure>
							</a>
						</li>

					
						<?php endwhile; wp_reset_postdata(); ?>
					
					<?php else : ?>

						<li class="single-post">
							<div class="entry-content">
								<?php _e('Sorry, no DJs matched your criteria.', 'wplook'); ?>
							</div>
							<div class="clear"></div>
						</li>

					<?php endif; ?>	

				</ul>

				<div class="clear"></div>

				<?php wplook_content_navigation('postnav' ) ?>
					
			</div>

		</section>

	</div>
	
	<!-- Right Column / Widget area -->
	<?php get_sidebar('dj'); ?>
	
	<div class="clear"></div>
</div>

<?php get_footer(); ?>