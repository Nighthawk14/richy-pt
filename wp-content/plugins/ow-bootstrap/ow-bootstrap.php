<?php/*	Plugin Name: OW Bootstrap	Description: OW Bootstrap is a easy to use Bootstrap shortcodes plugin	Version: 1.1	Author: GeoThemes & Onistaweb.com	Author URI: http://www.onistaweb.com/*/
// If this file is called directly, abort.if ( ! defined( 'WPINC' ) ) {	die;}
require_once plugin_dir_path( __FILE__ ) . 'includes/class-ow-bootstrap.php';
/* Shortcode */require_once plugin_dir_path( __FILE__ ) . 'admin/shortcodes/tinymce.button.php'; // MCE Buttons
function run_ow_bootstrap() {	$plugin = new OW_Bootstrap();	$plugin->run();}run_ow_bootstrap();