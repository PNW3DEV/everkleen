<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

if ( empty( $product ) || ! $product->exists() ) {
	return;
}

$related = $product->get_related( $posts_per_page );

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => $posts_per_page,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->id )
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) : ?>

	<div class="related products">
		<div class="col-sm-12">


		<h4 class="text-uppercase title-2 mb40"><?php _e( 'Related Products', 'woocommerce' ); ?></h4>

		<ul class="row products style-2 default-carousel 4-items no-dots pos-relative">

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>
				<?php
					global $product, $woocommerce_loop, $brainwave;

					if ( empty( $woocommerce_loop['loop'] ) ) {
						$woocommerce_loop['loop'] = 0;
					}
					if ( ! $product || ! $product->is_visible() ) {
						return;
					}
					$woocommerce_loop['loop']++;
				?>
				<li <?php post_class(); ?>>
					<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
					<a href="<?php the_permalink(); ?>">
						<?php
							do_action( 'woocommerce_before_shop_loop_item_title' );
							do_action( 'woocommerce_shop_loop_item_title' );
							do_action( 'woocommerce_after_shop_loop_item_title' );
						?>
					</a>
					<?php	do_action( 'woocommerce_after_shop_loop_item' ); ?>
				</li>
			<?php endwhile; // end of the loop. ?>

		</ul>

		</div>

	</div>

<?php endif;

wp_reset_postdata();
