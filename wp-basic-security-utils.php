<?php
/**
 * Plugin Name: WP Basic Security Utils
 * Plugin URI: https://github.com/Asad-ms/wp-basic-security-utils
 * Description: Improves basic WordPress security using lightweight hooks and filters.
 * Version: 1.0.0
 * Author: Asad
 * Author URI: https://github.com/Asad-ms
 * License: GPL v2 or later
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Disable XML-RPC to prevent brute-force attacks
 */
add_filter( 'xmlrpc_enabled', '__return_false' );

/**
 * Remove WordPress version from head
 */
remove_action( 'wp_head', 'wp_generator' );

/**
 * Hide login error details
 */
function wbsu_hide_login_errors() {
    return __( 'Invalid login credentials.', 'wp-basic-security-utils' );
}

add_filter( 'login_errors', 'wbsu_hide_login_errors' );

/**
 * Add basic security headers
 */
function wbsu_add_security_headers() {
    if ( headers_sent() ) {
        return;
    }

    header( 'X-Content-Type-Options: nosniff' );
    header( 'X-Frame-Options: SAMEORIGIN' );
    header( 'X-XSS-Protection: 1; mode=block' );
}
add_action( 'send_headers', 'wbsu_add_security_headers' );
