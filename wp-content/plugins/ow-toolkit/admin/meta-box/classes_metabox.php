<?php
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function classes_metabox( array $meta_boxes )
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
	/*
	- Class Name [default wp]
	- Class Description [default wp]

	- Class Days, Start Time, End Time
	- Class Trainer Name
	- Class Address
	- Class Payment

	- Class Button Text
	*/
	/* ****************************************** */
	$classes_options = array(
		array( 'id' => 'classes_bg', 'name' => 'Classes Background Image', 'type' => 'image','cols' => 3 ),
		array( 'id' => 'classes_timing', 'name' => 'Class Days, Start Time, End Time', 'type' => 'text','cols' => 4 ),
		array( 'id' => 'classes_trainer', 'name' => 'Class Trainer Name', 'type' => 'text','cols' => 4 ),
		array( 'id' => 'classes_address', 'name' => 'Class Address', 'type' => 'text','cols' => 4 ),
		array( 'id' => 'classes_payment', 'name' => 'Class Payment', 'type' => 'text','cols' => 4 ),
		array( 'id' => 'classes_button_text', 'name' => 'Class Button Text', 'type' => 'text','cols' => 4, 'default' => 'view timetable' ),		array( 'id' => 'classes_button_url', 'name' => 'Class Button URL', 'type' => 'text','cols' => 4, 'default' => '#' ),
	);
	$meta_boxes[] = array(
		'title' => 'Classes Options',
		'pages' => 'classes',
		'fields' => $classes_options
	);
	/* ****************************************** */
	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'classes_metabox' );