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

add_action( 'init', 'bp_rest_playground_init' );

/**
 * Init main Playground class
 */
function bp_rest_playground_init() {
	if ( ! class_exists( 'BuddyPress_Rest_Playground' ) ) {
		include_once __DIR__ . '/includes/class-bp-rest-playground.php';
		$GLOBALS['BP_Rest_Playground'] = BuddyPress_Rest_PlayGround::instance();
	}
}