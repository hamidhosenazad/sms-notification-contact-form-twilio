<?php
/**
 * Core plugin file
 *
 * @since      1.0
 * @package    sms-notification-contact-form-with-twilio
 * @author     Hamid Azad
 */

namespace Sncfwt\Plugin\Includes;

/*
 * If this file is called directly, abort.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The admin class
 */
class Admin {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		new Admin\Menu();
	}

}
