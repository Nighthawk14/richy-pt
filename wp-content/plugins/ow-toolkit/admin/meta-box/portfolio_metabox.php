<?php
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function portfolio_metabox( array $meta_boxes )
{
	/* ****************************************** */
	$portfolio_metabox = array(
		array( 'id' => 'portfolio_image', 'name' => 'Portfolio Image', 'type' => 'image','cols' => 3 )
	);
	$meta_boxes[] = array(
		'title' => 'Portfolio Options',
		'pages' => 'portfolio',
		'fields' => $portfolio_metabox
	);
	/* ****************************************** */
	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'portfolio_metabox' );