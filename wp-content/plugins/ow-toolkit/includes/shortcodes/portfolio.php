<?php

function ulysses_portfolio( $atts ){
	global $ulysses_option;
    extract(shortcode_atts(array(
		'section_id' => ''
    ), $atts));

   if( '' === $section_id ) :
        $section_id = __('portfolio','ulysses');
   endif;

	// START PORTFOLIO 
	ob_start();
?>
	
	<div class="portfolio-v1" id="<?php echo $section_id ?>">
		<div class="container">
			<ul class="filter" data-theme-plugin="filters">
				<?php

				$terms = get_terms("portfolio-category");
				$count = count($terms);

				echo '<li><a data-category="" href="#" class="d-bg-c-h d-border-c active">All</a></li>';

				if ( $count > 0 )
				{
					foreach ( $terms as $term )
					{
						$termname = strtolower($term->name);
						$termname = str_replace(' ', '-', $termname);
						echo '<li> <a href="#" class="d-bg-c-h d-border-c" data-category="'.$termname.'">'.$term->name.'</a></li>';
					}
				}
				?>
			</ul>
			<div class="row" data-theme-plugin="masonry">
				<?php
				$portfolio_args = array( 'post_type' => 'portfolio', 'posts_per_page' => -1 );
				$portfolio_loop = new WP_Query( $portfolio_args );

				while ( $portfolio_loop->have_posts() ) : $portfolio_loop->the_post();
					
					$portfolio_meta = get_post_meta(get_the_ID(), 'portfolio_image', true);
					$portfolio_img_url = wp_get_attachment_url( $portfolio_meta );
					$portfolio_img = wp_get_attachment_image( $portfolio_meta, 'thumb-263-263' );

					$terms = get_the_terms( get_the_ID(), 'portfolio-category' );
					if ( $terms && ! is_wp_error( $terms ) ) :
						$links = array();

						foreach ( $terms as $term )
						{
							$links[] = $term->name;
						}

						$tax_links = join( " ", str_replace(' ', '-', $links));
						$tax = strtolower($tax_links);
					else :
						$tax = '';
					endif;
					?>
					<div class="col-md-3 <?php echo $tax; ?> col-xs-6">
						<div class="portfolio-item">
							<div class="portfolio-item-cover">
								<div class="portfolio-item-hover">
									<div class="portfolio-item-bg d-bg-c"></div>
									<a class="swipebox" href="<?php echo $portfolio_img_url; ?>"><i class="fa fa-search"></i></a>
								</div>
								<?php echo $portfolio_img; ?>
								
							</div>
							<h4><?php the_title(); ?></h4>
							<h6>
								<?php
								$get_terms = get_the_terms( get_the_ID(), 'portfolio-category' );
								$get_terms_count = count($get_terms);

								if( $get_terms_count > 1 ):
									foreach ( $get_terms as $single_term )
									{
										$category_name = $single_term->name;
										echo '<span>'.$category_name.'</span>';
									}
								else :
									echo $tax;
								endif;
								?>
							</h6>
						</div>
					</div><?php
				endwhile;

				/* Restore original Post Data */
				wp_reset_postdata();
				?>
			</div>
		</div>
	</div>

<?php
	return ob_get_clean();
}
add_shortcode('ulysses_portfolio', 'ulysses_portfolio');
?>