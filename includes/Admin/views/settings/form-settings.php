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
<form  method="post">
		<table class="form-table">
			<tbody>
				<tr class="row">
					<th scope="row">
						<label for="twilio-sid"><?php echo esc_html__( 'Twilio Sid', 'sms-notification-contact-form-with-twilio' ); ?> </label>
					</th>
					<td>
						<input type="text" name="twilio_sid" id="twilio-sid" class="regular-text" value="<?php echo isset( $twilio_credentials->twilio_sid ) ? esc_html( $twilio_credentials->twilio_sid ) : ''; ?>">
						<?php
						if ( ! empty( $this->errors['sid'] ) ) {
							echo '<span class="notice notice-error">' . esc_html__( 'Twilio Sid  can not be empty ', 'sms-notification-contact-form-with-twilio' ) . '</span>';}
						?>
					</td>
				</tr>
				<tr>
					<th scope="row">
					<label for="twilio_auth"><?php echo esc_html__( 'Twilio Auth', 'sms-notification-contact-form-with-twilio' ); ?> </label>
					</th>
					<td>						
						<input type="text" name="twilio_auth" id="twilio_auth" class="regular-text" value="<?php echo isset( $twilio_credentials->twilio_auth ) ? esc_html( $twilio_credentials->twilio_auth ) : ''; ?>">
						<?php
						if ( ! empty( $this->errors['auth'] ) ) {
							echo '<span class="notice notice-error">' . esc_html__( 'Twilio Auth token can not be empty ', 'sms-notification-contact-form-with-twilio' ) . '</span>';}
						?>
					</td>
				</tr>
				<tr class="row">
					<th scope="row">
					<label for="twilio-sid"><?php echo esc_html__( 'SMS capable Twilio Phone', 'sms-notification-contact-form-with-twilio' ); ?> </label>
					</th>
					<td>
						<input type="text" name="twilio_phone" id="twilio-phone" class="regular-text" value="<?php echo isset( $twilio_credentials->twilio_phone ) ? esc_html( $twilio_credentials->twilio_phone ) : ''; ?>">
						<?php
						if ( ! empty( $this->errors['phone'] ) ) {
							echo '<span class="notice notice-error">' . esc_html__( 'Twilio phone number to send sms can not be empty ', 'sms-notification-contact-form-with-twilio' ) . '</span>';}
						?>
					</td>
				</tr>
			</tbody>
		</table>

		<?php wp_nonce_field( 'twilio-settings' ); ?>
		<?php submit_button( esc_html__( 'Submit', 'sms-notification-contact-form-with-twilio' ), 'primary', 'submit_settings' ); ?>
	</form>
