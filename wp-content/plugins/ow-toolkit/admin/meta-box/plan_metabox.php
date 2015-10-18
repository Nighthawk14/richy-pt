<?php
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function plan_metaboxes( array $meta_boxes )
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

	// Example of all available fields
	$fields = array(
 		array( 'id' => 'plan_price', 'name' => 'Plan Price', 'type' => 'text','cols' => 5 ),
		array( 'id' => 'plan_duration', 'name' => 'Plan Duration', 'type' => 'select', 'options' => array( 'plan-year' => 'Per Year', 'plan-month' => 'Per Month', 'plan-day' => 'Per Day' ),'cols' => 5 ),
 		array( 'id' => 'plan_features', 'name' => 'Plan Features', 'type' => 'text', 'repeatable' => true, 'sortable' => true ),
		array( 'id' => 'plan_btn_txt', 'name' => 'Button Text', 'type' => 'text','cols' => 5, 'default' => 'Buy now' ),
		array( 'id' => 'plan_btn_url', 'name' => 'Button URL', 'type' => 'text','cols' => 5 ),
		array(
			'id' => 'plan_box_effect',
			'name' => 'Box Animate Effect',
			'type' => 'select',
			'options' => $animate_effects,
			'cols' => 3
		),
		array( 'id' => 'plan_active', 'name' => 'Highlight Plan', 'type' => 'select', 'options' => array( 'active-disabled' => 'Disable', 'active-enabled' => 'Enabled'),'cols' => 5 ),
	);

	$meta_boxes[] = array(
		'title' => 'Pricing Options',
		'pages' => 'price_table',
		'fields' => $fields
	);

	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'plan_metaboxes' );