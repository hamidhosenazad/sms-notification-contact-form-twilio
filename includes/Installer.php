<?php
/**
 * Core plugin file
 *
 * @since      1.0
 * @package    sms-notification-contact-form-with-twilio
 * @author     Hamid Azad
 */

namespace wP\Plugin\Boilerplate;

/**
 * Installer class
 */
class Installer {

	/**
	 * Run the installer
	 *
	 * @return void
	 */
	public function sncfwt_run() {
		$this->create_tables();
	}

	/**
	 * Create necessary database tables
	 *
	 * @return void
	 */
	public function create_tables() {
		global $wpdb;

		$charset_collate = $wpdb->get_charset_collate();

		$schema1 = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}sncfwt_twilio_credentials` (
			`id` int(11)  NOT NULL ,
			`twilio_sid` varchar(100) NOT NULL DEFAULT '',
			`twilio_auth` varchar(255) DEFAULT NULL,
			`twilio_phone` varchar(100) DEFAULT NULL,
			`created_at` datetime NOT NULL,
			PRIMARY KEY (`id`)
		  ) $charset_collate";

		if ( ! function_exists( 'dbDelta' ) ) {
			require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		}

		$schema2 = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}sncfwt_contact_forms` (
			`id` int(11)  unsigned NOT NULL AUTO_INCREMENT ,
			`form_id` varchar(100) NOT NULL DEFAULT '',
			`form_title` varchar(255) NOT NULL DEFAULT '',
			`receiver_phone` varchar(100) DEFAULT NULL,
			`sms_status` varchar(100) DEFAULT NULL,
			`created_at` datetime NOT NULL,
			PRIMARY KEY (`id`)
		  ) $charset_collate";

		if ( ! function_exists( 'dbDelta' ) ) {
			require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		}

		dbDelta( $schema1 );
		dbDelta( $schema2 );
	}
}
