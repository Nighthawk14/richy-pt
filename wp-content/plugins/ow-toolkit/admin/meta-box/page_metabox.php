<?php
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function page_metabox( array $meta_boxes )
{	
	/* ****************************************** */
	$manage_blocks = array(
		array( 'id' => 'page_title_option', 'name' => 'Page Title', 'type' => 'select', 'options' => array( 'page_title_enabled' => 'Enable', 'page_title_disabled' => 'Disable'),'cols' => 4 ),
		array( 'id' => 'page_sidebar_option', 'name' => 'Sidebar', 'type' => 'select', 'options' => array( 'sidebar_enabled' => 'Enable', 'sidebar_disabled' => 'Disable' ),'cols' => 4 ),
		array( 'id' => 'page_sidebar_name', 'name' => 'Sidebar', 'type' => 'select', 'options' => array( 'content_sidebar' => 'Content Sidebar', 'woocommerce_sidebar' => 'Woocommerce Sidebar' ),'cols' => 4 ),
	);
	$meta_boxes[] = array(
		'title' => 'Page Options',
		'pages' => 'page',
		'fields' => $manage_blocks
	);
	/* ****************************************** */
	$page_layout = array(
		array( 'id' => 'page_layout', 'name' => 'Page Layout', 'type' => 'select', 'options' => array( 'page_layout_boxed' => 'Boxed (Fit to the Container)', 'page_layout_wide' => 'Wide (100% Body)'),'cols' => 4 )
	);
	$meta_boxes[] = array(
		'title' => 'Page Layout Options',
		'pages' => 'page',
		'fields' => $page_layout
	);
	/* ****************************************** */
	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'page_metabox' );