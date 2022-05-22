<?php
/**
 * Core plugin file
 *
 * @since      1.0
 * @package    sncfwt
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
