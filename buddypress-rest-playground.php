<?php
/**
 * Plugin Name:     BuddyPress Rest Playground
 * Description:     This is experimental plugin to test REST API
 * Author:          Paresh
 * Author URI:      pareshradadiya.github.io
 * Text Domain:     buddypress-rest-playground
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Buddypress_Rest_Playground
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

register_activation_hook( __FILE__, 'bp_rest_playground_activate' );
function bp_rest_playground_activate() {
	flush_rewrite_rules();
}

add_action( 'rest_api_init', 'bp_rest_pl_register_api_hooks' );

function bp_rest_pl_register_api_hooks() {
	$namespace = 'buddypress-rest-playground/v1';

	register_rest_route( $namespace, '/activity-post/', array(
		'methods'  => 'POST',
		'callback' => 'bp_rest_pl_activity_comment',
	) );

	register_rest_route( $namespace, '/comment-post/', array(
		'methods'  => 'POST',
		'callback' => 'bp_rest_pl_post_comment',
	) );

	register_rest_route( $namespace, '/reply-post/', array(
		'methods'  => 'POST',
		'callback' => 'bp_rest_pl_reply_comment',
	) );
}

function bp_rest_pl_activity_comment() {
	$args = array(
		'type'      => 'activity_update',
		'component' => 'activity',
		'content'   => 'Rest API is awesome',
	);

	$update_success = bp_activity_add( $args ) ? true : false;
	$response       = new WP_REST_Response( $update_success );

	return $response;
}

function bp_rest_pl_post_comment() {

	$data = array(
		'comment_post_ID'      => 1,
		'comment_author'       => 'admin',
		'comment_author_email' => 'admin@admin.com',
		'comment_content'      => 'Rest API is awesome',
		'comment_type'         => '',
		'comment_parent'       => 0,
		'user_id'              => 1,
		'comment_author_IP'    => '127.0.0.1',
		'comment_agent'        => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.10) Gecko/2009042316 Firefox/3.0.10 (.NET CLR 3.5.30729)',
		'comment_approved'     => 1,
	);

	$update_success = wp_insert_comment( $data ) ? true : false;
	$response       = new WP_REST_Response( $update_success );

	return $response;
}

function bp_rest_pl_reply_comment() {

	$reply_data = array(
		'post_parent'  => '361',
		'post_content' => 'Rest API is awesome!',
		'post_title'   => 'Rest Reply',
	);

	$update_success = bbp_insert_reply( $reply_data ) ? true : false;
	$response       = new WP_REST_Response( $update_success );

	return $response;
}
