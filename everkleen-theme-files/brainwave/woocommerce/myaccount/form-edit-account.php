<?php
/**
 * Edit account form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php wc_print_notices(); ?>

<form action="" method="post" class="row">

	<?php do_action( 'woocommerce_edit_account_form_start' ); ?>
	<div class="col-sm-6 col-xs-12">
		<h3 class="text-uppercase col-sm-12"><?php _e( 'Personal Information', 'woocommerce' ); ?></h3>
		<p class="form-row form-row-first col-sm-12">
			<label for="account_first_name"><?php _e( 'First name', 'woocommerce' ); ?> <span class="required">*</span></label>
			<input type="text" class="input-text form-control" name="account_first_name" id="account_first_name" value="<?php echo esc_attr( $user->first_name ); ?>" />
		</p>
		<p class="form-row form-row-last col-sm-12">
			<label for="account_last_name"><?php _e( 'Last name', 'woocommerce' ); ?> <span class="required">*</span></label>
			<input type="text" class="input-text form-control" name="account_last_name" id="account_last_name" value="<?php echo esc_attr( $user->last_name ); ?>" />
		</p>
		<div class="clearfix"></div>

		<p class="form-row form-row-wide col-sm-12">
			<label for="account_email"><?php _e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>
			<input type="email" class="input-text form-control" name="account_email" id="account_email" value="<?php echo esc_attr( $user->user_email ); ?>" />
		</p>
	</div>
	<div class="col-sm-6 col-xs-12 border-e9">
		<h3 class="text-uppercase col-sm-12"><?php _e( 'Password Change', 'woocommerce' ); ?></h3>

		<p class="form-row form-row-wide col-sm-12">
			<label for="password_current"><?php _e( 'Current Password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
			<input type="password" class="input-text form-control" name="password_current" id="password_current" />
		</p>
		<p class="form-row form-row-wide col-sm-12">
			<label for="password_1"><?php _e( 'New Password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
			<input type="password" class="input-text form-control" name="password_1" id="password_1" />
		</p>
		<p class="form-row form-row-wide col-sm-12">
			<label for="password_2"><?php _e( 'Confirm New Password', 'woocommerce' ); ?></label>
			<input type="password" class="input-text form-control" name="password_2" id="password_2" />
		</p>
		<div class="clearfix"></div>
	</div>

	<?php do_action( 'woocommerce_edit_account_form' ); ?>

	<div class="col-sm-12">
		<?php wp_nonce_field( 'save_account_details' ); ?>
		<div class="col-sm-12">
			<input type="submit" class="button btn btn-primary" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>" />
		</div>
		<input type="hidden" name="action" value="save_account_details" />
	</div>

	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>

</form>
