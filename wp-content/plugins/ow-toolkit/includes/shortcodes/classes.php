<?php 
function ulysses_classes( $atts )
    extract(shortcode_atts(array(
	if( '' === $section_id ) :
	// START CLASSES SECTION 
		</div>
		<!-- Flex Slider For Classes Section -->
				<?php 
				$classes = array('post_type' => 'classes', 'posts_per_page'=> 10 );
				query_posts( $classes ); 
				while ( have_posts() ) : the_post();
					$classes_bg = get_post_meta(get_the_ID(), 'classes_bg', true);
					$classes_bg_image = wp_get_attachment_image( $classes_bg, 'full' );
					<li class="slide">
						<div class="slide-text">
							<div class="white-box">
								<?php the_title('<h4>',',</h4>'); ?>
								<?php the_content(); ?>
								<a href="<?php echo esc_url($classes_button_url); ?>" class="button-box d-border-c d-bg-c-h d-text-c"><?php echo esc_attr( $classes_button_text ); ?></a>
				// Reset Query
add_shortcode('ulysses_classes', 'ulysses_classes');