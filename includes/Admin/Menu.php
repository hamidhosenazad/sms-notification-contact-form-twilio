<?php
/**
 * Core plugin file
 *
 * @since      1.0
 * @package    sms-notification-contact-form-with-twilio
 * @author     Hamid Azad
 */

namespace wP\Plugin\Boilerplate\Admin;

/*
 * If this file is called directly, abort.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The Menu handler class
 */
class Menu {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'sncfwt_admin_menu' ) );
	}

	/**
	 * Register admin menu
	 *
	 * @return void
	 */
	public function sncfwt_admin_menu() {
		$parent_slug = 'sms-notification-contact-form-with-twilio';
		$capability  = 'manage_options';

		add_menu_page( esc_html__( 'Sms Notifacation', 'sms-notification-contact-form-with-twilio' ), esc_html__( 'Sms Notifacation', 'sms-notification-contact-form-with-twilio' ), $capability, $parent_slug, array( $this, 'sncfwt_page' ), 'dashicons-media-text' );
		add_submenu_page( $parent_slug, esc_html__( 'Main Page', 'sms-notification-contact-form-with-twilio' ), esc_html__( 'Main Page', 'sms-notification-contact-form-with-twilio' ), $capability, $parent_slug, array( $this, 'sncfwt_page' ) );
		add_submenu_page( $parent_slug, esc_html__( 'Settings', 'sms-notification-contact-form-with-twilio' ), esc_html__( 'Settings', 'sms-notification-contact-form-with-twilio' ), $capability, 'sms-notification-contact-form-with-twilio-settings', array( $this, 'sncfwt_settings_page' ) );
	}

	/**
	 * Render the plugin page
	 *
	 * @return void
	 */
	public function sncfwt_page() {
		$main = new Main();
	}

	/**
	 * Handles the settings page
	 *
	 * @return void
	 */
	public function sncfwt_settings_page() {
		$settings = new Settings();
		$settings->sncfwt_settings_page();
	}
}

