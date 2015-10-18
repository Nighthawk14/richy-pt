<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage ulysses
 * @since ulysses 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('page-post-entry'); ?>>
	<?php the_title('<h2 class="sr-only">','</h2>'); ?>
	<header class="entry-header">
		<?php if( has_post_thumbnail() ) : ?>
			<div class="entry-cover">
				<?php the_post_thumbnail('thumb-900-500'); ?>
			</div>
		<?php endif; ?>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php
			the_content();
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'ulysses' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div>
</article><!-- #post-## -->
