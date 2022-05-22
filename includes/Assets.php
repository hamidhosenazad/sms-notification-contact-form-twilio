<?php
/**
 * Core plugin file
 *
 * @since      1.0
 * @package    sms-notification-contact-form-with-twilio
 * @author     Hamid Azad
 */

namespace wP\Plugin\Boilerplate;

/*
 * If this file is called directly, abort.
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Assets handler class
 */
class Assets {

	/**
	 * Class constructor
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'sncfwt_register_assets' ) );
	}

	/**
	 * All available scripts
	 *
	 * @return array
	 */
	public function get_scripts() {
		return array(
			'wp-plugin-boilerplate-script' => array(
				'src'     => SMS_NOTIFICATION_CONTACT_FORM_TWILIO_ASSETS . '/js/sncfwt.js',
				'version' => filemtime( SMS_NOTIFICATION_CONTACT_FORM_TWILIO_PATH . '/assets/js/sncfwt.js' ),
				'deps'    => array( 'jquery' ),
			),
		);
	}

	/**
	 * All available styles
	 *
	 * @return array
	 */
	public function get_styles() {
		return array(
			'wp-plugin-boilerplate-style' => array(
				'src'     => SMS_NOTIFICATION_CONTACT_FORM_TWILIO_ASSETS . '/css/sncfwt.css',
				'version' => filemtime( SMS_NOTIFICATION_CONTACT_FORM_TWILIO_PATH . '/assets/css/sncfwt.css' ),
			),
		);
	}

	/**
	 * Register scripts and styles
	 *
	 * @return void
	 */
	public function sncfwt_register_assets() {
		$scripts = $this->get_scripts();
		$styles  = $this->get_styles();

		foreach ( $scripts as $handle => $script ) {
			$deps = isset( $script['deps'] ) ? $script['deps'] : false;
			wp_register_script( $handle, $script['src'], $deps, $script['version'], true );
			wp_enqueue_script( $handle );
		}

		foreach ( $styles as $handle => $style ) {
			$deps = isset( $style['deps'] ) ? $style['deps'] : false;
			wp_register_style( $handle, $style['src'], $deps, $script['version'] );
			wp_enqueue_style( $handle );
		}
	}
}
