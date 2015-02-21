<?php
/**
 * The default template for displaying Video archive
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
		
		<section id="galleries" class="WPlooklatestposts">
			<header class="entry-header">
				<h1 class="entry-title"><?php single_cat_title(); ?></h1>
				<div class="clear"></div>
			</header>

			<div class="entry-content-list">

				<ul class="grid cs-style-gallery">
					<?php if ( $wp_query->have_posts() ) : ?>
						<?php $count = 0; ?>
						<?php while ( $wp_query->have_posts() ) : $wp_query->the_post();?>
							<?php 
								$video_url = get_post_meta(get_the_ID(), 'wpl_video_url', true); 
							?>
							<?php $count++; ?>	
							<?php if ($count == 1) : ?>

								<li class='first-cs-style-item'>
									<a href="<?php the_permalink(); ?>">
										<figure>
											
											<?php if ( has_post_thumbnail() ) { 
												the_post_thumbnail('medium-large-thumb'); 
											} else { ?>
												<img src="<?php echo get_template_directory_uri() . '/images/temp/440x340.jpg' ?>">
											<?php } ?>

											<figcaption>
												<h3><?php wplook_get_date(); ?></h3>
												<div><?php the_title(); ?></div>
											</figcaption>
											<div class="clear"></div>
										</figure>
									</a>
									
								</li>
							<?php else : ?>	
								<li class='rest-cs-style-item'>
									<a href="<?php the_permalink(); ?>">
										<figure>
											
											<?php if ( has_post_thumbnail() ) { 
												the_post_thumbnail('medium-large-thumb'); 
											} else { ?>
												<img src="<?php echo get_template_directory_uri() . '/images/temp/440x340.jpg' ?>">
											<?php } ?>

											<figcaption>
												<h3><?php wplook_get_date(); ?></h3>
												<div><?php the_title(); ?></div>
											</figcaption>
										</figure>
									</a>
								</li>

							<?php endif; ?>
						
						<?php endwhile; wp_reset_postdata(); ?>
					

					<?php else : ?>

						<li class="single-post">
							 <div class="entry-content">
								 <?php _e('Sorry, no videos matched your criteria.', 'wplook'); ?>
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
	<?php get_sidebar('video'); ?>
	
	<div class="clear"></div>
</div>

<?php get_footer(); ?>