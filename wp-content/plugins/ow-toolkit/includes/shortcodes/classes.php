<?php 
function ulysses_classes( $atts ){	global $ulysses_option;
    extract(shortcode_atts(array(		'section_id' => '',		'title' => '',		'sub_title' => ''    ), $atts));
	if( '' === $section_id ) :		$section_id = __('classes','ulysses');	endif;
	// START CLASSES SECTION 	ob_start();	?>	<!-- Classes Section -->	<div class="classes-section" id="<?php echo esc_attr( $section_id ); ?>">		<div class="container">			<div class="site-title">				<p><?php echo esc_attr( $sub_title ); ?></p>				<h1><?php echo esc_attr( $title ); ?></h1>				<div class="site-dots d-text-c"><i class="fa fa-times-2"></i><i class="fa fa-times-2"></i></div>			</div>
		</div>
		<!-- Flex Slider For Classes Section -->		<div id="classes-slider" class="flexslider classes-slider">			<ul class="slides slide-wrapper">
				<?php 
				$classes = array('post_type' => 'classes', 'posts_per_page'=> 10 );
				query_posts( $classes ); 
				while ( have_posts() ) : the_post();
					$classes_bg = get_post_meta(get_the_ID(), 'classes_bg', true);
					$classes_bg_image = wp_get_attachment_image( $classes_bg, 'full' );					$classes_timing = get_post_meta(get_the_ID(), 'classes_timing', true);					$classes_trainer = get_post_meta(get_the_ID(), 'classes_trainer', true);					$classes_address = get_post_meta(get_the_ID(), 'classes_address', true);					$classes_payment = get_post_meta(get_the_ID(), 'classes_payment', true);					$classes_button_text = get_post_meta(get_the_ID(), 'classes_button_text', true);					$classes_button_url = get_post_meta(get_the_ID(), 'classes_button_url', true);					?>
					<li class="slide">
						<div class="slide-text">
							<div class="white-box">
								<?php the_title('<h4>',',</h4>'); ?>
								<?php the_content(); ?>
								<a href="<?php echo esc_url($classes_button_url); ?>" class="button-box d-border-c d-bg-c-h d-text-c"><?php echo esc_attr( $classes_button_text ); ?></a>							</div>							<div class="box-2 d-bg-c">								<ul>									<li class="i-1"><?php echo esc_attr( $classes_timing ); ?></li>									<li class="i-2"><?php echo esc_attr( $classes_trainer ); ?></li>									<li class="i-3"><?php echo esc_attr( $classes_address ); ?></li>									<li class="i-4"><?php echo esc_attr( $classes_payment ); ?></li>								</ul>							</div>						</div>						<?php echo $classes_bg_image; ?>					</li>					<?php				endwhile;
				// Reset Query				wp_reset_query();				?>			</ul>		</div>	</div>	<!-- Classes Section Over -->	<?php	return ob_get_clean();}
add_shortcode('ulysses_classes', 'ulysses_classes');?>