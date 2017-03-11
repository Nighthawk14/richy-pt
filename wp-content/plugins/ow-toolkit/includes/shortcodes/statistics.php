<?php 

function ulysses_statistics( $atts )
{

	global $ulysses_option;

    extract(shortcode_atts(array(
		'section_id' => ''
    ), $atts));

	if( '' === $section_id ) :
		$section_id = __('statistics','ulysses');
	endif;

	// START STATISTICS SECTION === -->
	ob_start();
	?>
	<div class="statistics-section hidden-xs hidden-sm" id="<?php echo esc_attr( $section_id ); ?>">
		<div class="container">
			<div class="row">
				<?php 
				if(!empty($ulysses_option['opt_statistics'])):
					$opt_statistics = $ulysses_option['opt_statistics'];
					$i=1;
					foreach ( $opt_statistics as $opt_statistic ) :
						 $statistics_icon_uri = $opt_statistic['attachment_id'];
						 $statistics_icon = wp_get_attachment_url ( $statistics_icon_uri );
						?>
						 <div class="col-md-4">
							  <div class="statistic statistic-bg-2" style="background-image: url('<?php echo $statistics_icon; ?>');">
								<div class="bg-cover"></div>
								<div class="statistic-cut"></div>
								<h3 class="d-text-c counter-all" id="statistics_count-<?php echo esc_attr( $i ); ?>" data-statistics_percent="<?php echo esc_attr($opt_statistic['title']); ?>">&nbsp;</h3>
								<h6><?php echo esc_attr( $opt_statistic['description'] ); ?></h6>
							</div>
						</div>
					<?php 
					$i++;
					endforeach;
				endif;
				?>
			</div>
		</div>
	</div>
	<?php
	return ob_get_clean();
}

add_shortcode('ulysses_statistics', 'ulysses_statistics');
?>