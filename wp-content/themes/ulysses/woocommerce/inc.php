<?php

require_once( dirname( __FILE__ ) . '/woocommerce-new-product-badge.php' );

// add_filter( 'woocommerce_enqueue_styles', '__return_false' );
// remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

/*
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs )
{
	unset( $tabs['description'] ); // Remove the description tab
	unset( $tabs['reviews'] ); // Remove the reviews tab
	unset( $tabs['additional_information'] ); // Remove the additional information tab
	return $tabs;
}
*/

/*
add_action('woocommerce_archive_description', 'woocommerce_category_description', 2);
function woocommerce_category_description()
{
	if (is_product_category())
	{
		global $wp_query;
		$cat = $wp_query->get_queried_object();
		echo "CAT IS:".print_r($cat,true); // the category needed.
	}
}
*/
