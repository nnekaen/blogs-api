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

/**
 * Get posts via REST API.
 */
function get_posts() {

	// Initialize variable.
	$getposts = '';
	
	// Enter the name of your blog here followed by /wp-json/wp/v2/posts and add filters like this one that limits the result to 2 posts.
	$response = wp_remote_get( 'https://protonmail.com/blog/wp-json/wp/v2/posts?per_page=2' );

	// Exit if error.
	if ( is_wp_error( $response ) ) {
		return;
	}

	// Get the body.
	$posts = json_decode( wp_remote_retrieve_body( $response ) );

	// Exit if nothing is returned.
	if ( empty( $posts ) ) {
		return;
	}

	// If there are posts.
	if ( ! empty( $posts ) ) {

		// For each post.
		foreach ( $posts as $post ) {
            
            // Show a linked title and post date.
			$getposts .= '<a href="' . esc_url( $post->link ) . '" target=\"_blank\">' . esc_html( $post->title->rendered ) . '</a> <br />';
		}
		
		return $getposts;
	}

}
// Register as a shortcode to be used on the site.
add_shortcode( 'get_blog_via_rest', 'get_posts' );