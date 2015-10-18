<?php 
function ulysses_product_carousel( $atts )
{
    extract(shortcode_atts(array(
		'section_id' => '',
    ), $atts));
	if( '' === $section_id ) :
		$section_id = __('product-carousel','ulysses');
	endif;	
	ob_start();
	?>
	<div id="<?php echo esc_attr( $section_id ); ?>" class="our-clients-logo">
		<div class="row tesla-carousel-items">
			<div id="clients-logo" class="owl-carousel owl-theme">
				<?php 
				$args = array(
					'post_type' => 'product',
					'posts_per_page' => 10
				);				
				$loop = new WP_Query( $args );
				if ( $loop->have_posts() )
				{
					while ( $loop->have_posts() ) : $loop->the_post();
						?>
						<div class="item">
							<a href="<?php echo esc_url(get_permalink( get_the_ID() )); ?>"><?php echo get_the_post_thumbnail(get_the_ID(), 'thumbnail'); ?></a>
						</div>
						<?php 
					endwhile;
				}
				else
				{
					echo __( 'No products found' , 'ulysses');
				}
				wp_reset_postdata();
				?>
			</div>
		</div>
	</div>
	<?php 
	return ob_get_clean();
}
add_shortcode('ulysses_product_carousel', 'ulysses_product_carousel');?>