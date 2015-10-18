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
			?>
			<h2><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
			<?php the_tags( '<p>', ', ', '</p>' ); ?>
		</div>
		<?php
	endif;
	?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
		<a href="<?php echo esc_url( get_permalink() ); ?>" class="read-more d-border-c-h d-text-c"><?php _e( 'Continue reading...', 'ulysses' ) ?></a>
	</div><!-- .entry-summary -->
</article><!-- #post-## -->