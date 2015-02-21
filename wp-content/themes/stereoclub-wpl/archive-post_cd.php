<?php
/**
 *  The default template for displaying CD archive
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
				<h1 class="entry-title"><?php single_cat_title(); ?></h1>
				<div class="clear"></div>
			</header>
			
			<div class="entry-content-list">
				
				<ul class="grid cs-style-gallery">

					<?php if ( $wp_query->have_posts() ) : ?>
						<?php while ( $wp_query->have_posts() ) : $wp_query->the_post();?>
						<?php 
							$artist_name = get_post_meta(get_the_ID(), 'wpl_cd_artist_name', true);
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
										<?php if ( $artist_name ) { ?>
											<div><?php echo $artist_name; ?></div>
										<?php } ?>
									</figcaption>
								</figure>
							</a>
						</li>

					
						<?php endwhile; wp_reset_postdata(); ?>
					
					<?php else : ?>

						<li class="single-post">
							<div class="entry-content">
								<?php _e('Sorry, no CD matched your criteria.', 'wplook'); ?>
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
	<?php get_sidebar('cd'); ?>
	
	<div class="clear"></div>
</div>

<?php get_footer(); ?>