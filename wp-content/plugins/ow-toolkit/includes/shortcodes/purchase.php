<?php function ulysses_purchase( $atts ){	global $ulysses_option;    extract(shortcode_atts(array(		'section_id' => ''    ), $atts));	if( '' === $section_id ) :		$section_id = __('purchase','ulysses');	endif;	// START PURCHASE SECTION 	ob_start();	?>	<div class="purchase-section" id="<?php echo esc_attr( $section_id ); ?>">		<div class="bg-cover">			<div class="container">				<div class="site-title">					<p><?php echo esc_attr( $ulysses_option['opt_purchase_subtitle'] ); ?></p>					<h1><?php echo esc_attr( $ulysses_option['opt_purchase_title'] ); ?></h1>					<?php if($ulysses_option['opt_purchase_btn_txt']): ?>						<a href="<?php echo esc_url($ulysses_option['opt_purchase_btn_url']); ?>"><?php echo esc_attr( $ulysses_option['opt_purchase_btn_txt'] ); ?></a>					<?php endif; ?>				</div>			</div>		</div>	</div>	<?php	return ob_get_clean();}add_shortcode('ulysses_purchase', 'ulysses_purchase');?>