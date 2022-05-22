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
 * The Settings form handler class
 */
class Settings {

	/**
	 * Settings form errors
	 *
	 * @var array
	 */
	public $errors = array();

	/**
	 * Initialize the class
	 */
	public function sncfwt_settings_page() {
		$this->sncfwt_submit_twilio_credentials();
		$twilio_credentials = sncfwt_get_twilio_credentials( 1 );
		if ( empty( $twilio_credentials ) ) {
			$template = __DIR__ . '/views/settings/add-settings.php';
		} else {
			$template = __DIR__ . '/views/settings/list-settings.php';
		}
		if ( file_exists( $template ) ) {
			include $template;
		}
	}

	/**
	 * Submit twilio settings into the DB
	 *
	 * @return void
	 */
	public function sncfwt_submit_twilio_credentials() {
		if ( isset( $_POST['submit_settings'], $_POST['_wpnonce'] ) && wp_verify_nonce( sanitize_key( $_POST['_wpnonce'] ), 'twilio-settings' ) && current_user_can( 'manage_options' ) ) {
			if ( isset( $_POST['twilio_sid'] ) ) {
				$sid = sanitize_text_field( wp_unslash( $_POST['twilio_sid'] ) );
			}
			if ( isset( $_POST['twilio_auth'] ) ) {
				$auth = sanitize_text_field( wp_unslash( $_POST['twilio_auth'] ) );
			}
			if ( isset( $_POST['twilio_phone'] ) ) {
				$phone = sanitize_text_field( wp_unslash( $_POST['twilio_phone'] ) );
			}

			if ( empty( $sid ) ) {
				$this->errors['sid'] = true;
			}
			if ( empty( $auth ) ) {
				$this->errors['auth'] = true;
			}
			if ( empty( $phone ) ) {
				$this->errors['phone'] = true;
			}
			if ( empty( $this->errors ) ) {
				$insert_id = sncfwt_insert_twilio_credentials(
					array(
						'twilio_sid'   => $sid,
						'twilio_auth'  => $auth,
						'twilio_phone' => $phone,
					)
				);
			}
		}
	}

}

