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
  wp_enqueue_script( 'js-file', get_stylesheet_directory_uri()  . '/js/script.js');
}
add_action('wp_enqueue_scripts','tthq_isotope_scripts_functions');
