<?php
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function testimonials_metabox( array $meta_boxes )
{
	/* ****************************************** */
	$testimonial_options = array(
		array( 'id' => 'testimonial_user', 'name' => 'User name:', 'type' => 'text','cols' => 4 ),
		array( 'id' => 'testimonial_user_designation', 'name' => 'User Designation:', 'type' => 'text','cols' => 4 ),
	);
	$meta_boxes[] = array(
		'title' => 'Testimonial Options',
		'pages' => 'testimonial',
		'fields' => $testimonial_options
	);
	/* ****************************************** */
	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'testimonials_metabox' );