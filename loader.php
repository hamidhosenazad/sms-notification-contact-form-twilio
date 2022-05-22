<?php
/**
 * Core plugin file
 *
 * @since      1.0
 * @package    sncfwt
 * @author     Hamid Azad
 */

/*
 * If this file is called directly, abort.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * The main plugin class
 */
final class Sms_Notification_Contact_Form_Twilio {

	/**
	 * Plugin version
	 *
	 * @var string
	 */
	const VERSION = '1.0.0';

	/**
	 * Class construcotr
	 */
	private function __construct() {
		$this->sncfwt_define_constants();
		$this->sncfwt_installer();
		$this->sncfwt_init_plugin();
	}

	/**
	 * Initializes a singleton instance
	 *
	 * @return \Sms_Notification_Contact_Form_Twilio
	 */
	public static function sncfwt_init() {
		static $instance = false;

		if ( ! $instance ) {
			$instance = new self();
		}

		return $instance;
	}

	/**
	 * Define the required plugin constants
	 *
	 * @return void
	 */
	public function sncfwt_define_constants() {
		define( 'SMS_NOTIFICATION_CONTACT_FORM_TWILIO_VERSION', self::VERSION );
		define( 'SMS_NOTIFICATION_CONTACT_FORM_TWILIO_FILE', __FILE__ );
		define( 'SMS_NOTIFICATION_CONTACT_FORM_TWILIO_PATH', __DIR__ );
		define( 'SMS_NOTIFICATION_CONTACT_FORM_TWILIO_URL', plugins_url( '', SMS_NOTIFICATION_CONTACT_FORM_TWILIO_FILE ) );
		define( 'SMS_NOTIFICATION_CONTACT_FORM_TWILIO_ASSETS', SMS_NOTIFICATION_CONTACT_FORM_TWILIO_URL . '/assets' );
	}

	/**
	 * Initialize the plugin
	 *
	 * @return void
	 */
	public function sncfwt_init_plugin() {
		if ( is_admin() ) {
			new wP\Plugin\Boilerplate\Admin();
			new wP\Plugin\Boilerplate\Assets();
		}

	}

	/**
	 * Do stuff upon plugin activation
	 *
	 * @return void
	 */
	public function sncfwt_installer() {
		$installer = new wP\Plugin\Boilerplate\Installer();
		$installer->sncfwt_run();
		$installed = get_option( 'sncfwt_installed' );
		if ( ! $installed ) {
			update_option( 'sncfwt_installed', time() );
		}
		update_option( 'sncfwt_version', SMS_NOTIFICATION_CONTACT_FORM_TWILIO_VERSION );
	}


}

/**
 * Initializes the main plugin
 *
 * @return \Sms_Notification_Contact_Form_Twilio
 */
function sms_notification_contact_form_twilio() {
	return Sms_Notification_Contact_Form_Twilio::sncfwt_init();
}

// Kick-off the plugin.
sms_notification_contact_form_twilio();
