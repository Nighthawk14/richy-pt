<?php
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function slider_metabox( array $meta_boxes )
{
	$animate_effects = array (
		'rollIn' => 'rollIn',

		'fadeInDown' => 'fadeInDown',
		'fadeInUp' => 'fadeInUp',

		'flipInX' => 'flipInX',

		'bounceInUp' => 'bounceInUp',
		'bounceInLeft' => 'bounceInLeft',
		'bounceInRight' => 'bounceInRight',

		'lightSpeedIn' => 'lightSpeedIn',

		'pulse' => 'pulse',
		'flip' => 'flip',
		'swing' => 'swing'
	);
	/* ****************************************** */
	$slider_options = array(
		array( 'id' => 'slide_bg', 'name' => 'Slide Background Image', 'type' => 'image','cols' => 3 ),
		array( 'id' => 'slide_heading_1', 'name' => 'Slide Heading 1', 'type' => 'text','cols' => 5 ),
		array(
			'id' => 'slide_heading_1_effect',
			'name' => 'Slide Heading 1 Text Effect',
			'type' => 'select',
			'options' => $animate_effects,
			'cols' => 3
		),
		array( 'id' => 'slide_heading_2', 'name' => 'Slide Heading 2', 'type' => 'text','cols' => 5 ),
		array(
			'id' => 'slide_heading_2_effect',
			'name' => 'Slide Heading 2 Text Effect',
			'type' => 'select',
			'options' => $animate_effects,
			'cols' => 3
		),
		array( 'id' => 'slide_heading_3', 'name' => 'Slide Description', 'type' => 'textarea','cols' => 5 ),
		array(
			'id' => 'slide_heading_3_effect',
			'name' => 'Slide Description Text Effect',
			'type' => 'select',
			'options' => $animate_effects,
			'cols' => 3
		),		
	);
	$meta_boxes[] = array(
		'title' => 'Slider Options',
		'pages' => 'slider',
		'fields' => $slider_options
	);
	/* ****************************************** */
	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'slider_metabox' );