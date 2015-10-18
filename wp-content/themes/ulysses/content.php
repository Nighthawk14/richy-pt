<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage ulysses
 * @since ulysses 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('blog-entry'); ?>>
	<?php
	if(is_sticky()) :
		?>
		<header>
			<?php
			the_title('<h2 class="sr-only">','</h2>');
			$the_day = get_the_date( 'd', get_the_ID() );
			$the_month = get_the_date( 'M', get_the_ID() );
			$the_year = get_the_date( 'y', get_the_ID() );
			?>
			<div class="entry-date"><span class="d-text-c"><?php echo esc_html( $the_day ); ?></span><?php echo esc_html( $the_month ); ?></div>
			<div class="entry-hover d-bg-c">
				<?php
				if ( get_post_format() == 'aside' ) :
					echo '<i class="fa fa-file"></i>';
				elseif ( get_post_format() == 'image' ) :
					echo '<i class="fa fa-image"></i>';
				elseif ( get_post_format() == 'video' ) :
					echo '<i class="fa fa-video-camera"></i>';
				elseif ( get_post_format() == 'audio' ) :
					echo '<i class="fa fa-file-audio-o"></i>';
				elseif ( get_post_format() == 'quote' ) :
					echo '<i class="fa fa-quote-left"></i>';
				elseif ( get_post_format() == 'link' ) :
					echo '<i class="fa fa-link"></i>';
				elseif ( get_post_format() == 'gallery' ) :
					echo '<i class="fa fa-file-picture-o"></i>';
				else :
					echo '<i class="fa fa-camera"></i>';
				endif;

				if( !is_single() ):
					?>
					<h2><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
					<?php
				else :
					the_title('<h2>','</h2>');
				endif;

				the_tags( '<p>', ', ', '</p>' ); ?>
			</div>
		</header>
		<div class="entry-cover">
			<?php
			if ( has_post_thumbnail() ) :
				the_post_thumbnail('thumb-900-500');
			endif;
			?>
		</div>
		<?php
	else :
		the_title('<h2 class="sr-only">','</h2>');

		$the_day = get_the_date( 'd', get_the_ID() );
		$the_month = get_the_date( 'M', get_the_ID() );
		$the_year = get_the_date( 'y', get_the_ID() );
		?>
		<div class="entry-date"><span class="d-text-c"><?php echo esc_html( $the_day ); ?></span><?php echo esc_html( $the_month ); ?></div>
		<div class="entry-cover">
			<?php
			if ( has_post_thumbnail() ) :
				the_post_thumbnail('thumb-900-500');
			endif;
			?>
		</div>
		<div class="entry-hover d-bg-c">
			<?php
			if ( get_post_format() == 'aside' ) :
				echo '<i class="fa fa-file"></i>';
			elseif ( get_post_format() == 'image' ) :
				echo '<i class="fa fa-image"></i>';
			elseif ( get_post_format() == 'video' ) :
				echo '<i class="fa fa-video-camera"></i>';
			elseif ( get_post_format() == 'audio' ) :
				echo '<i class="fa fa-file-audio-o"></i>';
			elseif ( get_post_format() == 'quote' ) :
				echo '<i class="fa fa-quote-left"></i>';
			elseif ( get_post_format() == 'link' ) :
				echo '<i class="fa fa-link"></i>';
			elseif ( get_post_format() == 'gallery' ) :
				echo '<i class="fa fa-file-picture-o"></i>';
			else :
				echo '<i class="fa fa-camera"></i>';
			endif;
			if( !is_single() ):
				?>
				<h2><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
				<?php
			else :
				the_title('<h2>','</h2>');
			endif;

			the_tags( '<p>', ', ', '</p>' ); ?>
		</div>
		<?php
	endif;

	if ( !is_single() ) : ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
			<a href="<?php echo esc_url( get_permalink() ); ?>" class="read-more d-border-c-h d-text-c"><?php _e( 'Continue reading...', 'ulysses' ); ?></a>
		</div><!-- .entry-summary -->
		<?php
	else : ?>
		<div class="entry-content">
			<?php
			the_content();
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfourteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
			?>
		</div><!-- .entry-content -->
		<div class="entry-footer">
			<h6><?php echo esc_html( $the_month ); ?> <?php echo esc_html( $the_day ); ?><?php _e( ',', 'ulysses' ); ?> <?php echo esc_html( $the_year ); ?> <?php _e( '/', 'ulysses' ); ?> <?php comments_number( 'NO COMMENTS', 'ONE COMMENT', '% COMMENTS' ); ?> <?php _e( '/', 'ulysses' ); ?> <?php echo wpb_get_post_views(get_the_ID()); ?> </h6>
			<div class="entry-author">
				<?php echo get_avatar( get_the_author_meta('email') , 90 ); ?>
				<h6><?php echo get_the_author_meta('display_name'); ?></h6>
				<p><?php echo get_the_author_meta('description'); ?></p>
			</div>
			<ul class="all-socials">
				<li><?php _e( 'Share Post', 'ulysses' ); ?></li>
				<li><a href="http://www.facebook.com/share.php?u=<?php echo esc_url(the_permalink()); ?>&title=<?php the_title(); ?>" class="d-bg-c-h d-border-c-h"><i class="fa fa-facebook"></i></a></li>
				<li><a href="http://twitter.com/intent/tweet?status=<?php the_title(); ?><?php _e( '+', 'ulysses' ); ?><?php echo esc_url(the_permalink()); ?>" class="d-bg-c-h d-border-c-h"><i class="fa fa-twitter"></i></a></li>
				<li><a href="https://plus.google.com/share?url=<?php echo esc_url(the_permalink()); ?>" class="d-bg-c-h d-border-c-h"><i class="fa fa-google-plus"></i></a></li>
				<li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url(the_permalink()); ?>&title=<?php the_title(); ?>&source=<?php echo esc_url(the_permalink()); ?>" class="d-bg-c-h d-border-c-h"><i class="fa fa-linkedin"></i></a></li>
				<li><a href="http://www.newsvine.com/_tools/seed&save?u=<?php echo esc_url(the_permalink()); ?>&h=<?php the_title(); ?>" class="d-bg-c-h d-border-c-h"><i class="fa fa-vine"></i></a></li>
			</ul>
		</div>
		<?php
	endif; ?>
</article><!-- #post-## -->