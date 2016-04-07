<?php
/**
 * Show messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! $messages ){
	return;
}

?>
<div class="row">
	<?php foreach ( $messages as $message ) : ?>
		<div class="col-md-6 col-xs-12">
			<div class="alert alert-success transparent " role="alert">
				<i aria-hidden="true" class="fa fa-thumbs-o-up"></i><?php echo wp_kses_post( $message ); ?>
			</div>
		</div>
		<div class="clearfix"></div>
	<?php endforeach; ?>
</div>
