<?php
/**
 * Plugin Name:  Blog from WP API
 * Description:  Gets the latest 5 posts from a blog via the REST API.
 * Author:       Nneka Edozien
 * Version:      1.0
 *
 * @package blogfromwpapi
 */

// Disable direct file access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BLOGAPI_VERSION', '1.0.0' );
define( 'BLOGAPI__MINIMUM_WP_VERSION', '1.0' );
define( 'BLOGAPI__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'BLOGAPI_DELETE_LIMIT', 100000 );

register_activation_hook( __FILE__, array( 'blog-api', 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array( 'blog-api', 'plugin_deactivation' ) );

require_once( BLOGAPI__PLUGIN_DIR . 'function.php' );
require_once( ABSPATH . 'wp-admin/includes/post.php' );
require_once( ABSPATH . 'wp-admin/includes/taxonomy.php' );


function tthq_isotope_scripts_functions() {
  wp_enqueue_script( 'js-file', get_stylesheet_directory_uri()  . '/js/scripts.js');
}
add_action('wp_enqueue_scripts','tthq_isotope_scripts_functions');
// include custom jQuery
function shapeSpace_include_custom_jquerys() {

	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js', array(), null, true);

}
add_action('wp_enqueue_scripts', 'shapeSpace_include_custom_jquerys');

function ttha_add_custom_isotope_js() {
{
wp_register_script( 'Isotope', 'https://npmcdn.com/isotope-layout@3/dist/isotope.pkgd.js');
wp_enqueue_script('Isotope');
}
}
add_action( 'wp_enqueue_scripts', 'ttha_add_custom_isotope_js' );
