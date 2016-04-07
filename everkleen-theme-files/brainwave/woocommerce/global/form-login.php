<?php
/**
 * Login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( is_user_logged_in() ) {
	return;
}

?>
<form method="post" class="login mb-sm30" <?php if ( $hidden ) echo 'style="display:none;"'; ?>>

	<?php do_action( 'woocommerce_login_form_start' ); ?>

	<?php // if ( $message ) echo wpautop( wptexturize( $message ) ); ?>
	<?php if ( $message ) : ?>
		<p class="col-md-8 col-md-offset-2 mt20">
			<?php echo wptexturize( $message ); ?>
		</p>
	<?php endif; ?>
	<div class="form col-xs-12 col-sm-6 col-sm-offset-3">

		<div class="form-row col-sm-6 col-xs-12 text-left form-row-first">
			<label for="username"><?php _e( 'Username or email', 'woocommerce' ); ?> <span class="required">*</span></label>
			<input type="text" class="input-text" name="username" id="username" />
		</div>
		<div class="form-row col-xs-12 col-sm-6 text-left form-row-last">
			<label for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
			<input class="input-text" type="password" name="password" id="password" />
		</div>
		<div class="clear"></div>

		<?php do_action( 'woocommerce_login_form' ); ?>

		<div class="form-row col-xs-12 text-left">
			<div class="checkbox mt13 mb0">
				<input name="rememberme" type="checkbox" id="rememberme" value="forever" />
				<label for="rememberme" class="inline"><?php _e( 'Remember me', 'woocommerce' ); ?></label>
				<div class="lost_password">
					<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
				</div>
			</div>
			<?php wp_nonce_field( 'woocommerce-login' ); ?>
			<input type="submit" class="button btn btn-primary mt15" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>" />
			<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
		</div>

		<div class="clear"></div>
	</div>

	<?php do_action( 'woocommerce_login_form_end' ); ?>

</form>
