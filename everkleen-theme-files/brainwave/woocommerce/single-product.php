<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
 
	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly
	}

	get_header('product');
?>
	<div class="container page-section pos-relative">
		<div class="post-list col-sm-12" role="main">
		<?php
			do_action( 'woocommerce_output_content_wrapper' );
			while ( have_posts() ) {
				the_post();
				wc_get_template_part( 'content', 'single-product' );
			}
			do_action( 'woocommerce_after_main_content' );
		?>
		</div>
	</div>
<?php get_footer(); ?>
