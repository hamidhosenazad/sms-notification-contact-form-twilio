<?php
/**
 * Core plugin file
 *
 * @since      1.0
 * @package    sms-notification-contact-form-with-twilio
 * @author     Hamid Azad
 */

/*
 * If this file is called directly, abort.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
require_once plugin_dir_path( __DIR__ ) . '/vendor/autoload.php';
use Twilio\Rest\Client;
use Twilio\Exceptions\TwilioException;

/**
 * Fetch twilio settings from the DB
 *
 * @param  int $id of row.
 *
 * @return object
 */
function sncfwt_get_twilio_credentials( $id ) {
	global $wpdb;
	return $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}sncfwt_twilio_credentials WHERE id = %d", $id ) );
}

/**
 * Contact form 7 all forms list
 *
 * @return array
 */
function sncfwt_get_contact_forms_list() {
	$sncfwt_list = array();
	$args        = array(
		'post_type'      => 'wpcf7_contact_form',
		'posts_per_page' => -1,
	);
	$data        = get_posts( $args );
	if ( $data ) {
		$i = 1;
		foreach ( $data as $key ) {
			$sncfwt_listrs[ $i ] = $i;
			$sncfwt_list[ $i ]   = array(
				'form_id'    => $key->ID,
				'form_title' => $key->post_title,
			);
			$i++;
		}
	} else {
		$sncfwt_list['0'] = false;
	}
	return $sncfwt_list;
}

/**
 * Insert twilio credentials to DB
 *
 * @param  array $args as data.
 *
 * @return int|WP_Error
 */
function sncfwt_insert_twilio_credentials( $args = array() ) {
	global $wpdb;

	$defaults = array(
		'id'           => 1,
		'twilio_sid'   => '',
		'twilio_auth'  => '',
		'twilio_phone' => '',
		'created_at'   => current_time( 'mysql' ),
	);

	$format = array(
		'%d',
		'%s',
		'%s',
		'%s',
		'%s',
	);

	$data     = wp_parse_args( $args, $defaults );
	$replaced = $wpdb->replace(
		"{$wpdb->prefix}sncfwt_twilio_credentials",
		$data,
		$format
	);
	if ( $replaced ) {
		echo "<div class='sncfwt-tiny-alert sncfwt-tiny-alert-green'>Record Inserted/Updated</div>";
	} else {
		echo "<div class='sncfwt-tiny-alert sncfwt-tiny-alert-red'>Unknown Error Occured</div>";
	}
}

/**
 * Display form list
 *
 * @param $form_id.
 * @return array
 */
function sncfwt_display_contact_forms_list( $form_id ) {
	global $wpdb;
	$sncfwt_form_list_result = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}sncfwt_contact_forms WHERE form_id = %d", $form_id ) );
	if ( ! empty( $sncfwt_form_list_result ) ) {
		return $sncfwt_form_list_result;
	}
}

/**
 * Insert contact form list into the DB
 *
 * @param array $args as data.
 */
function sncfwt_insert_contact_forms_list( $args ) {
	global $wpdb;
	$defaults               = array(
		'form_id'        => '',
		'form_title'     => '',
		'receiver_phone' => '',
		'sms_status'     => '',
		'created_at'     => current_time( 'mysql' ),
	);
	$data                   = wp_parse_args( $args, $defaults );
	$check_if_form_id_exist = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}sncfwt_contact_forms WHERE form_id = %d", $args['form_id'] ) );
	$format                 = array(
		'%s',
		'%s',
		'%s',
		'%s',
		'%s',
	);

	if ( $check_if_form_id_exist ) {
		$updated = $wpdb->update(
			$wpdb->prefix . 'sncfwt_contact_forms',
			$data,
			array( 'form_id' => $args['form_id'] ),
			$format
		);
		if ( $updated ) {
			echo "<div class='sncfwt-tiny-alert sncfwt-tiny-alert-green'>Record Inserted/Updated</div>";
		} else {
			echo "<div class='sncfwt-tiny-alert sncfwt-tiny-alert-red'>Unknown Error Occured</div>";
		}
	} else {
		$inserted = $wpdb->insert(
			"{$wpdb->prefix}sncfwt_contact_forms",
			$data,
			$format
		);
		if ( $inserted ) {
			echo "<div class='sncfwt-tiny-alert sncfwt-tiny-alert-green'>Record Inserted/Updated</div>";
		} else {
			echo "<div class='sncfwt-tiny-alert sncfwt-tiny-alert-red'>Unknown Error Occured</div>";
		}
	}
}
add_action(
	'wpcf7_before_send_mail',
	function( $contact_form, &$abort, $submission ) {
		global $wpdb;
		$form_id   = $_POST['_wpcf7'];
		$form_info = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}sncfwt_contact_forms WHERE form_id = %d", $form_id ) );
		if ( $form_info && $form_info->sms_status == 'Active' ) {
			$post_keys = array_keys( $_POST );
			$url       = 'http://' . $_SERVER['HTTP_HOST'];
			$message   = "This text is from $url $form_info->form_title form" . PHP_EOL;
			for ( $i = 6;$i < count( $_POST );$i++ ) {
				$message .= $post_keys[ $i ] . '=' . $_POST[ $post_keys[ $i ] ] . PHP_EOL;
			}
			$twilio_credentials = sncfwt_get_twilio_credentials( 1 );
			$twilio_sid         = $twilio_credentials->twilio_sid;
			$twilio_auth        = $twilio_credentials->twilio_auth;
			$twilio_phone       = $twilio_credentials->twilio_phone;
			$twilio             = new Client( $twilio_sid, $twilio_auth );
			try {
				$twilio->messages->create(
					$form_info->receiver_phone,
					array(
						'body' => $message,
						'from' => $twilio_phone,
					)
				);
			} catch ( TwilioException $e ) {
				mail( get_option( 'admin_email' ), 'Twilio Error', $e->getMessage() );
			}
		}
	},
	10,
	3
);

add_action( 'before_delete_post', 'my_func', 99, 2 );
function my_func( $postid ) {
	// We check if the post type isn't ours and just return
	if ( get_post_type( $postid ) != 'wpcf7_contact_form' ) {
		return;
	}
	global $wpdb;
	return $wpdb->delete(
		$wpdb->prefix . 'sncfwt_contact_forms',
		array( 'form_id' => $postid ),
		array( '%d' )
	);
}


