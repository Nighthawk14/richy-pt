<?php

/* Register TinyMCE Shortcode Buttons */
function ow_bootstrap_tinymce_js()
{
    add_action( 'current_screen', 'thisScreen_owb' );
	function thisScreen_owb()
	{
		$currentScreen = get_current_screen();
		if( $currentScreen->post_type === "page" )
		{
			// make sure the user has correct permissions
			if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
				return;
			}

			// Add to visual mode
			if ( get_user_option('rich_editing') == 'true' ) {
				add_filter( 'mce_external_plugins', 'ow_bootstrap_add_js_plugin' );
				add_filter( 'mce_buttons', 'register_ow_bootstrap_tinymce_button' );
			}
		}
	}	
}
add_action('init', 'ow_bootstrap_tinymce_js');

function ow_bootstrap_add_js_plugin( $plugin_array )
{
    $plugin_array['ow_bootstrap_button'] = plugins_url('js/ow.bootstrap_tinymce.js', __FILE__ );
    return $plugin_array;
}

function register_ow_bootstrap_tinymce_button( $buttons )
{
    array_push( $buttons, "ow_generate_bootstrap" );  // "ow_generate_bootstrap"  from tinymce.js
    return $buttons; 
}