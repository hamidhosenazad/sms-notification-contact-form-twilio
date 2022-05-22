<?php
/**
 * Sms notification contact form  with twilio
 *
 * @package     sncfwt
 * @author      Hamid Azad
 * @copyright   2021 Hamid Azad
 * @license     GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name: Sms notification contact form  with twilio
 * Plugin URI:  https://hamidazad/wp-plugin-boilerplate
 * Description: Plugin to send sms notification on contact  form submission with twilio
 * Version:     1.0.0
 * Author:      Hamid Azad
 * Author URI:  https://github.com/hamidhosenazad
 * Text Domain: sncfwt
 * License:     GPL v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

/*
 * If this file is called directly, abort.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Check if contact form is active.
 */
function sncfwt_check_contact_form_active() {
	if ( class_exists( 'WPCF7' ) ) {
		require_once __DIR__ . '/loader.php';
	} else {
		add_action( 'admin_notices', 'sncfwt_requires_contact_form' );
	}
}
add_action( 'plugins_loaded', 'sncfwt_check_contact_form_active' );

/**
 * Admin notice if contact form is not active.
 */
function sncfwt_requires_contact_form() {
	$class = 'notice notice-error';
	printf( '<div class="%1$s"><p style="' . esc_attr( 'display: inline-block;' ) . '">%2$s</p> <a href="' . esc_url( 'https://wordpress.org/plugins/contact-form-7/' ) . '" target="' . esc_attr( '_blank' ) . '">Install and Activate Contact Form 7</a>.</div>', esc_attr( $class ), esc_html__( 'Sms notification contact form  with twilio plugin requires contact form to be active.', 'sncfwt' ) );
}
