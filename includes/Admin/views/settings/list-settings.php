<?php
/**
 * Core plugin file
 *
 * @since      1.0
 * @package    sncfwt
 * @author     Hamid Azad
 */

namespace wP\Plugin\Boilerplate\Admin;

/*
 * If this file is called directly, abort.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class = 'wrap' >
	<h1>Edit Twilio Credentials</h1>
	<?php
		$form_template = __DIR__ . '/form-settings.php';
		require $form_template;
	?>
</div>

