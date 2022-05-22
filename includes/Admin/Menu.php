<?php
/**
 * Core plugin file
 *
 * @since      1.0
 * @package    sncfwt
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
		$parent_slug = 'sncfwt';
		$capability  = 'manage_options';

		add_menu_page( esc_html__( 'Sms Notifacation', 'sncfwt' ), esc_html__( 'Sms Notifacation', 'sncfwt' ), $capability, $parent_slug, array( $this, 'sncfwt_page' ), 'dashicons-media-text' );
		add_submenu_page( $parent_slug, esc_html__( 'Main Page', 'sncfwt' ), esc_html__( 'Main Page', 'sncfwt' ), $capability, $parent_slug, array( $this, 'sncfwt_page' ) );
		add_submenu_page( $parent_slug, esc_html__( 'Settings', 'sncfwt' ), esc_html__( 'Settings', 'sncfwt' ), $capability, 'sncfwt-settings', array( $this, 'sncfwt_settings_page' ) );
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

