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
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}

/**
 * Delete table from DB upon plugin deletion.
 *
 * @return void
 */
function sncfwt_delete_installed_tables() {
	global $wpdb;
	$tables = array( 'sncfwt_contact_forms', 'sncfwt_twilio_credentials' );
	foreach ( $tables as $table ) {
		$sncfwt_table = $wpdb->prefix . $table;
		$sql          = "DROP TABLE IF EXISTS $sncfwt_table";
		$wpdb->query( $sql );
	}
}
sncfwt_delete_installed_tables();
