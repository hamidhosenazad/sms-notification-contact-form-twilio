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

?>
<div class="wrap">
	<?php
	foreach ( $data as $value ) {
		$contact_form_enabled_list = sncfwt_display_contact_forms_list( $value['form_id'] );
		?>
	<form  method="post">
		<table class="form-table">
			<tbody>
				<tr class="row">
					<th scope="row">
						<label for="form-title"><?php echo esc_html__( 'Form Title', 'sncfwt' ); ?> </label>
					</th>
					<th scope="row">
						<label for="sms-status"><?php echo esc_html__( 'SMS Status', 'sncfwt' ); ?> </label>
					</th>
					<th scope="row">
						<label for="receiver_phone"><?php echo esc_html__( 'Receiver Phone', 'sncfwt' ); ?> </label>
					</th>				
				</tr>
				<tr class="row">
					<td>
						<?php echo esc_html( ( $value['form_title'] ) ); ?>
					</td>
					<td>
						<select name="sms_status">
							<?php
							if ( $contact_form_enabled_list->sms_status ) {
								echo '<option value=' . esc_html( $contact_form_enabled_list->sms_status ) . '>' . esc_html( $contact_form_enabled_list->sms_status ) . '</option>';
							}
							?>
							<option value="<?php echo esc_html( ( 'Active' ) ); ?>"><?php echo esc_html( ( 'Active' ) ); ?></option>
							<option value="<?php echo esc_html( ( 'Inactive' ) ); ?>"><?php echo esc_html( ( 'Inactive' ) ); ?></option>
						</select>
					</td>
					<td>
						<input type="text" name="receiver_phone" id="receiver_phone" class="regular-text" value="<?php echo isset( $contact_form_enabled_list->receiver_phone ) ? esc_html( $contact_form_enabled_list->receiver_phone ) : ''; ?>" placeholder="E. 164 format phone number">
								<?php
								if ( ! empty( $this->errors['receiver_phone'] ) ) {
									if ( $this->errors['form_id'] == $value['form_id'] ) {
										echo '<span class="notice notice-error">' . esc_html__( 'SMS reciever phone number cannot be empty ', 'sncfwt' ) . '</span>';
									}
								}
								?>
					</td>
					<td>
						<input type="hidden" name="form_id" value="<?php echo esc_html( ( $value['form_id'] ) ); ?>"/>
						<input type="hidden" name="form_title" value="<?php echo esc_html( ( $value['form_title'] ) ); ?>"/>
								<?php wp_nonce_field( 'sms-capability' ); ?>
								<?php submit_button( esc_html__( 'Submit', 'sncfwt' ), 'primary', 'submit_sms_capability' ); ?>
					</td>
				</tr>
			</tbody>
		</table>
	</form>
								<?php

	};
	?>
</div>
