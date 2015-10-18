<?php
/**
 * The Sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage ulysses
 * @since ulysses 1.0
*/

$page_sidebar_name = get_post_meta(get_the_ID(), 'page_sidebar_name', true);

if( function_exists( "is_woocommerce" ) ) :

	if( is_woocommerce() ) :

		dynamic_sidebar('woocommerce_sidebar');

	elseif( !empty($page_sidebar_name) ) :

		dynamic_sidebar($page_sidebar_name);	

	else :

		dynamic_sidebar('content_sidebar');

	endif;

elseif( !empty($page_sidebar_name) ) :

	dynamic_sidebar($page_sidebar_name);	

else :

	dynamic_sidebar('content_sidebar');

endif;

?>