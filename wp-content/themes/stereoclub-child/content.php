<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage StereoClub
 * @since StereoClub 1.0
 */

?>
<!-- Posts -->
<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<div class="clear"></div>
	</header>
	<div class="entry-meta">
		<time datetime="2010-03-20" class="fleft"><?php wplook_get_date(); ?></time>
		<?php $share_buttons = get_post_meta(get_the_ID(), 'wpl_share_buttons_blog', true); ?>
		<?php if ( $share_buttons !='off' ) {
			wplook_get_share_buttons();
		} ?>
		<div class="clear"></div>
	</div>
	
	<div class="entry-content-list">
		<?php if ( has_post_thumbnail() ) { ?>
			<figure>
				<?php the_post_thumbnail('large-thumb'); ?>
			</figure>
		<?php } ?>

		<div class="clear"></div>
		<div class="entry-content-post">
			<br />
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="clear"></div><div class="page-link"><span>' . __( 'Pages:', 'wplook' ) . '</span>', 'after' => '</div>' ) ); ?>
			<?php if ( get_the_tag_list( '', ', ' ) ) { ?>
				<div class="tag-i"> 
					<i class="icon-tags"></i> <a href="#" rel="tag"><?php echo get_the_tag_list('',', ',''); ?></a> 
				</div>
			<?php } ?>
		</div>
		<div class="clear"></div>
		
		<?php wplook_prev_next(); ?>
	</div>

</article>
<?php comments_template( '', true ); ?>