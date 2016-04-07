<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly
	}

	global $brainwave, $wp;
	get_header('shop'); ?>
	<div class="pos-relative">
		<?php
			bw_get_section_bg( woocommerce_get_page_id('shop') );
			switch ( $brainwave['shop-layout'] ) {
				case '1':
					echo '<div class="container page-section">';
					echo '<div class="post-list col-sm-12" role="main">';
					break;
				case '2':
					echo '<div class="container page-section">';
					echo '<div class="post-list col-sm-9" role="main">';
					break;
				case '3':
					echo '<div class="container page-section">';
					echo '<aside class="sidebar col-sm-3" role="complementary">';
					dynamic_sidebar( 'sidebar-shop' );
					echo '</aside>';
					echo '<div class="post-list col-sm-9" role="main">';
					break;
				default:
					break;
			}

			do_action( 'woocommerce_output_content_wrapper' );
			do_action( 'woocommerce_archive_description' );
			if ( have_posts() ) {
				/**
				 * woocommerce_before_shop_loop hook
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				 woocommerce_catalog_ordering();
				//  do_action( 'woocommerce_before_shop_loop' );

				woocommerce_product_loop_start();
				woocommerce_product_subcategories();
				while ( have_posts() ) {
					the_post();
					wc_get_template_part( 'content', 'product' );
				}
				woocommerce_product_loop_end();
				woocommerce_result_count();
				do_action( 'woocommerce_after_shop_loop' );
			} else if ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) {
				wc_get_template( 'loop/no-products-found.php' );
			}

			do_action( 'woocommerce_after_main_content' );

?>
<script>
	var wp_shop = '<?php echo serialize( $wp ); ?>';
</script>
<?php
			switch ( $brainwave['shop-layout'] ) {
		    case '1':
		      echo '</div>';
		      echo '</div>';
		      break;
		    case '2':
		      echo '</div>';
		      echo '<aside class="sidebar col-sm-3" role="complementary">';
		      dynamic_sidebar( 'sidebar-shop' );
		      echo '</aside>';
		      echo '</div>';
		      break;
		    case '3':
		      echo '</div>';
		      echo '</div>';
		      break;
		    default:
		      break;
		  }
		?>
	</div>
<?php	get_footer( 'shop' );	?>
