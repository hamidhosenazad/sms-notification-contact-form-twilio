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

?>
<div class="wrap">
	<div class="notice notice-error"> 
		<p><strong><?php echo esc_html__( 'Please add twilio credentials on settings page', 'sms-notification-contact-form-with-twilio' ); ?> </strong></p>
	</div>
</div>
