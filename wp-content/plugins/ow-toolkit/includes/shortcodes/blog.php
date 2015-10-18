<?php 
function ulysses_blog( $atts ){	global $ulysses_option;    extract(shortcode_atts(array(		'section_id' => '',		'title' => '',		'sub_title' => ''    ), $atts));   if( '' === $section_id ) :        $section_id = __('blog','ulysses');   endif;
	// START BLOG SECTION 	ob_start();	?>
	<div class="blog-post-section carousel" id="<?php echo esc_attr( $section_id ); ?>">
		<div class="container">
			<div class="site-title">
				<p><?php echo esc_attr( $sub_title ); ?></p>
				<h1><?php echo esc_attr( $title ); ?></h1>
				<div class="site-dots d-text-c carousel-arrows"><i class="fa fa-times-2"></i><i class="fa fa-times-2"></i></div>
			</div>
			<!-- Blog Post Owl Carousel -->
			<div id="blog-post" class="trainers-slider blog-post">
				<?php 
				query_posts('posts_per_page='.get_option('posts_per_page'));			
				while ( have_posts() ) : the_post();
					$the_day = get_the_date( 'd', get_the_ID() );
					$the_month = get_the_date( 'M', get_the_ID() );
					$the_year = get_the_date( 'y', get_the_ID() );
					?>
					<div class="item">
						<div class="blog-entry">
							<div class="entry-date"><span class="d-text-c"><?php echo esc_attr( $the_day ); ?></span><?php echo esc_attr( $the_month ); ?></div>
							<div class="entry-cover">
								<?php 
								if ( has_post_thumbnail() ) : ?>
									<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_post_thumbnail('thumb-495-495'); ?></a>								<?php								else: ?>									<a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo '<img src="'.get_template_directory_uri().'/images/placeholder-495x495.png"/>'; ?></a>								<?php								endif;								?>								</div>							<div class="entry-hover d-bg-c">								<?php									if ( get_post_format() == 'aside' ) :										echo '<i class="fa fa-file"></i>';									elseif ( get_post_format() == 'image' ) :										echo '<i class="fa fa-image"></i>';									elseif ( get_post_format() == 'video' ) :										echo '<i class="fa fa-video-camera"></i>';									elseif ( get_post_format() == 'audio' ) :										echo '<i class="fa fa-file-audio-o"></i>';									elseif ( get_post_format() == 'quote' ) :										echo '<i class="fa fa-quote-left"></i>';									elseif ( get_post_format() == 'link' ) :										echo '<i class="fa fa-link"></i>';									elseif ( get_post_format() == 'gallery' ) :										echo '<i class="fa fa-file-picture-o"></i>';									else :										echo '<i class="fa fa-camera"></i>';									endif;								?>
								<h2><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>								<p><?php the_category( ', ' ); ?></p>							</div>						</div>					</div>					<?php				endwhile;				// Reset Query				wp_reset_query();				?>			</div><!-- Trainers Owl Carousel Over -->		</div>	</div>	<!-- Blog Post Section Over -->	<?php	return ob_get_clean();}add_shortcode('ulysses_blog', 'ulysses_blog');?>