<?php
/**
 * Checkout billing information form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/** @global WC_Checkout $checkout */
?>
<div class="woocommerce-billing-fields">
	<?php if ( WC()->cart->ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

		<h3><?php _e( 'Billing &amp; Shipping', 'woocommerce' ); ?></h3>

	<?php else : ?>

		<h3 class="col-md-12 mt-sm-10 text-uppercase"><?php _e( 'Billing Details', 'woocommerce' ); ?></h3>

	<?php endif; ?>

	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

	<?php foreach ( $checkout->checkout_fields['billing'] as $key => $field ) : ?>

		<?php
			if (in_array('form-row-wide', $field['class'])) {
				$field['class'][] = 'col-xs-12';
			} else {
				$field['class'][] = 'col-xs-6';
			}
			if ( ! in_array( 'update_totals_on_change', $field['class'] ) ) {
					$field['input_class'][] = 'form-control';
			}
			woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
		?>

	<?php endforeach; ?>

	<?php do_action('woocommerce_after_checkout_billing_form', $checkout ); ?>

	<?php if ( ! is_user_logged_in() && $checkout->enable_signup ) : ?>

		<?php if ( $checkout->enable_guest_checkout ) : ?>

			<div class="form-row col-xs-12 checkbox form-row-wide mt0">
				<input class="input-checkbox check_box" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true) ?> type="checkbox" name="createaccount" value="1" />
				<label for="createaccount" class="checkbox"><?php _e( 'Create an account?', 'woocommerce' ); ?></label>
			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<?php if ( ! empty( $checkout->checkout_fields['account'] ) ) : ?>
			<div class="create-account col-xs-12">

				<p><?php _e( 'Create an account by entering the information below. If you are a returning customer please login at the top of the page.', 'woocommerce' ); ?></p>

				<div class="row">
					<?php foreach ( $checkout->checkout_fields['account'] as $key => $field ) : ?>

						<?php
							$field['class'][] = 'col-xs-12';
							$field['input_class'][] = 'form-control';

							woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
						?>

					<?php endforeach; ?>

				</div>
				<div class="clear"></div>

			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>

	<?php endif; ?>
</div>
