<?php
/**
* @package SamuzuSynd
*/
/*
Plugin Name: Samuzu Synd
Plugin URI: https://bowiecreative.co/samuzu-synd
Description: This is a plugin to syndicate content via the WP Rest API.
Version: 1.0.0
Author: Jason Stallings & Alex Zuniga
Author URI: https://bowiecreative.co
License: GPLv2 or later
Text Domain: samuzu-synd
*/


function alert_func( $atts ) {
	// Make the request to the json API.
	$result = wp_remote_get('https://thecloud.wpengine.com/wp-json/wp/v2/posts'); // any json url here
//var_dump($result);
	// Decode the response.
	$posts = json_decode($result['body'], true); // 'body' is the element from the json array
//var_dump($posts);
	// Pull the first post. Zero Index
	$post = $posts[0];
//var_dump($post);
	// Grab the rendered post content.
	return $post['content']['rendered']; //this 'content' and 'rendered' are the array elements in the 'body' json element.
}

// Register the shortcode with WordPress.
add_shortcode( 'alert', 'alert_func' ); // 'contact' here is declaring the shortcode to be used in the post.
