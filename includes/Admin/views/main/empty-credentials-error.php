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
	<div class="notice notice-error"> 
		<p><strong><?php echo esc_html__( 'Please add twilio credentials on settings page', 'sncfwt' ); ?> </strong></p>
	</div>
</div>
