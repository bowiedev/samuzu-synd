<?php
/**
* @package SamuzuSynd
*/
/*
Plugin Name: Samuzu Synd
Plugin URI: https://bowiecreative.co/samuzu-synd
Description: This is a plugin to syndicate content via the WP Rest API. Using transients to cache the response to the source url is not slammed every time the page is requested.
Version: 1.0.0
Author: Jason Stallings & Alex Zuniga
Author URI: https://bowiecreative.co
License: GPLv2 or later
Text Domain: samuzu-synd
*/
function contact_func( $atts ) {
	$postID = $atts['postid'];
	if ( false === ( $result = get_transient( 'restapi_response' ) ) ) {
		$result = wp_remote_get("https://thecloud.wpengine.com/wp-json/wp/v2/posts/$postID"); // any json url here
		set_transient( 'restapi_response', $result, 12 * HOUR_IN_SECONDS );
	}
	// Decode the response.
	$post = json_decode($result['body'], true); // 'body' is the element from the json array
//var_dump($posts);
	return $post['content']['rendered']; //this 'content' and 'rendered' are the array elements in the 'body' json element.
}
// Register the shortcode with WordPress.
add_shortcode( 'contact', 'contact_func' ); // 'contact' here is declaring the shortcode to be used in the post.

