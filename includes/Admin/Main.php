<?php
/**
 * Core plugin file
 *
 * @since      1.0
 * @package    sms-notification-contact-form-with-twilio
 * @author     Hamid Azad
 */

namespace Sncfwt\Plugin\Includes\Admin;

/*
 * If this file is called directly, abort.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The Main page class
 */
class Main {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		$this->sncfwt_submit_sms_capability();
		$twilio_credentials = sncfwt_get_twilio_credentials( 1 );
		if ( ! empty( $twilio_credentials ) ) {
			$data = sncfwt_get_contact_forms_list();
			if ( ! isset( $data[0] ) ) {
				$enable_sms_template = __DIR__ . '/views/main/enable-sms-capability.php';
				if ( file_exists( $enable_sms_template ) ) {
					include $enable_sms_template;
				}
			} else {
				$empty_form_error_template = __DIR__ . '/views/main/empty-forms-list-error.php';
				if ( file_exists( $empty_form_error_template ) ) {
					include $empty_form_error_template;
				}
			}
		} else {
			$error_credential_template = __DIR__ . '/views/main/empty-credentials-error.php';
			if ( file_exists( $error_credential_template ) ) {
				include $error_credential_template;
			}
		}
	}

	/**
	 * Submit SMS capability into the DB.
	 *
	 * @return void
	 */
	public function sncfwt_submit_sms_capability() {
		if ( isset( $_POST['submit_sms_capability'], $_POST['_wpnonce'] ) && wp_verify_nonce( sanitize_key( $_POST['_wpnonce'] ), 'sms-capability' ) && current_user_can( 'manage_options' ) ) {
			if ( isset( $_POST['form_id'] ) ) {
				$form_id = sanitize_text_field( wp_unslash( $_POST['form_id'] ) );
			}
			if ( isset( $_POST['form_title'] ) ) {
				$form_title = sanitize_text_field( wp_unslash( $_POST['form_title'] ) );
			}
			if ( isset( $_POST['receiver_phone'] ) ) {
				$receiver_phone = sanitize_text_field( wp_unslash( $_POST['receiver_phone'] ) );
			}
			if ( isset( $_POST['sms_status'] ) ) {
				$sms_status = sanitize_text_field( wp_unslash( $_POST['sms_status'] ) );
			}

			if ( empty( $receiver_phone ) ) {
				$this->errors['receiver_phone'] = true;
				$this->errors['form_id']        = $form_id;
			}
			if ( empty( $this->errors ) ) {
				$insert_sms = sncfwt_insert_contact_forms_list(
					array(
						'form_id'        => $form_id,
						'form_title'     => $form_title,
						'receiver_phone' => $receiver_phone,
						'sms_status'     => $sms_status,
					)
				);
			}
		}
	}
}
