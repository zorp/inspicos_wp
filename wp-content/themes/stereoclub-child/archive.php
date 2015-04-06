<?php
/**
 * The default template for displaying Post Archive
 *
 * @package WordPress
 * @subpackage StereoClub
 * @since StereoClub 1.0
 */
?>

<?php get_header(); ?>
<!-- Main -->
<div id="main" class="site-main container_12">
	
	<!-- Left column -->
	<div id="primary" class="grid_8">
		<!-- Latest posts  -->
			<header class="entry-header">
				<h1 class="entry-title"><?php single_cat_title(); ?></h1>
				<div class="clear"></div>
			</header>
				
			<div class="entry-content-list">
				
				<?php if ( $wp_query->have_posts() ) : ?>
					<?php $count = 0; ?>
					<?php while ( $wp_query->have_posts() ) : $wp_query->the_post();?>
					<?php
						$count++;
					?>

					<?php if ($count == 1) : ?>	

						<article id="post-<?php the_ID(); ?>" <?php post_class('latest-item'); ?>>
							<?php if ( has_post_thumbnail() ) { ?>
								<div class="grid_2 alpha omega">
									<div class="entry-thumb">
										<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail('medium-thumb'); ?>
										</a>
									</div>
								</div>
							<div class="grid_6 alpha omega">
							<?php } else { ?>
								<div class="grid_7 alpha">
							<?php }?>
								<div class="entry-description">
									<time class="fleft fleftmargin" datetime="<?php echo get_the_date( 'c' ) ?>"><a href="<?php the_permalink(); ?>"><i class="icon-calendar"></i> <?php wplook_get_date(); ?></a></time>
									<!--<span class="author fleft"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><i class="icon-user"></i> <?php echo get_the_author(); ?></a></span>-->
									<div class="clear"></div>
									<h1 class="entry-head"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
									<div class="short-description">
										<p><?php echo wplook_short_excerpt(ot_get_option('wpl_events_excerpt_limit'));?>...</p>
									</div>
									<a href="<?php the_permalink(); ?>" title="<?php _e('read more', 'wplook'); ?>" class="link-icon"><?php _e('read more', 'wplook'); ?></a>
								</div>
							</div>
							<div class="clear"></div>
						</article>

					<?php else : ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class('list-block-item'); ?>>
							<div class="margins">
								<?php if ( has_post_thumbnail() ) { ?>
									<div class="entry-thumb">
										<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail('small-thumb'); ?>
										</a>
									</div>
								<?php } else { ?>
									<div class="entry-date">
										<div class="date"><?php echo get_the_date( 'j' ) ?></div>
										<div class="month"><?php echo get_the_date( 'M' ) ?></div>
									</div>
								<?php } ?>

								<div class="entry-description">
									<time class="fleft fleftmargin" datetime="<?php echo get_the_date( 'c' ) ?>"><a href="<?php the_permalink(); ?>"><i class="icon-calendar"></i> <?php wplook_get_date(); ?></a></time>
									<!--<span class="author fleft"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><i class="icon-user"></i> <?php echo get_the_author(); ?></a></span>-->
									<div class="clear"></div>
									<h1 class="entry-head"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
									<div class="short-description">
										<p><?php echo wplook_short_excerpt(ot_get_option('wpl_rest_events_excerpt_limit'));?></p>
									</div>
									<a href="<?php the_permalink(); ?>" title="<?php _e('read more', 'wplook'); ?>" class="link-icon"><?php _e('read more', 'wplook'); ?></a>
								</div>
								<div class="clear"></div>
							</div>
						</article>

					<?php endif; ?>
							
					<?php endwhile; wp_reset_postdata(); ?>

					<div class="clear"></div>

					<?php wplook_content_navigation('postnav' ) ?>
				
		<?php else : ?>
			<article class="single-post">

				<div class="entry-content">
					<br>
					<div class="entry-content-post">
						<br />
						<?php _e('Sorry, no events matched your criteria.', 'wplook'); ?>
					</div>
					<div class="clear"></div>

				</div>

			</article>

		<?php endif; ?>
		</div>
	</div> <!-- / #primary -->
	
<?php get_sidebar(); ?>
<div class="clear"></div>		
</div><!-- / #main -->
<?php get_footer(); ?>