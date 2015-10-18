<?php
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function trainers_metabox( array $meta_boxes )
{
	/* ****************************************** */
	/*
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
	*/
	/* ****************************************** */
	$about_trainer = array(
		array( 'id' => 'trainer_image', 'name' => 'Trainer Photograph', 'type' => 'image','cols' => 3 ),
		array( 'id' => 'trainer_designation', 'name' => 'Trainer Designation', 'type' => 'text','cols' => 4 ),
		array( 'id' => 'trainer_description', 'name' => 'Trainer Description', 'type' => 'textarea','cols' => 7 ),
	);
	$meta_boxes[] = array(
		'title' => 'About Trainer',
		'pages' => 'trainers',
		'fields' => $about_trainer
	);
	/* ****************************************** */
	$trainer_social = array(
		array( 'id' => 'trainer_fb', 'name' => 'Facebook Profile URL', 'type' => 'text','cols' => 4,'default'=>'http://facebook.com' ),
		array( 'id' => 'trainer_twitter', 'name' => 'Twitter Profile URL', 'type' => 'text','cols' => 4,'default'=>'http://twitter.com' ),
		array( 'id' => 'trainer_instagram', 'name' => 'Instagram Profile URL', 'type' => 'text','cols' => 4,'default'=>'http://instagram.com' ),
		array( 'id' => 'trainer_g_plus', 'name' => 'Google+ Profile URL', 'type' => 'text','cols' => 4, 'default' => 'http://plus.google.com' ),
	);
	$meta_boxes[] = array(
		'title' => 'Trainer Social Profile',
		'pages' => 'trainers',
		'fields' => $trainer_social
	);
	/* ****************************************** */
	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'trainers_metabox' );