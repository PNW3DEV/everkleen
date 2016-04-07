<?php
/**
 * Show options for ordering
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $wpdb;
$tablepost =  esc_sql( $wpdb->prefix . 'postmeta' );
$min_price = min( array_column( $wpdb->get_results(
	"SELECT *
	FROM  $tablepost
	WHERE  (`meta_key` =  '_price') ",
	'ARRAY_A'
), 'meta_value') );
$max_price = max( array_column( $wpdb->get_results(
	"SELECT *
	FROM  $tablepost
	WHERE  (`meta_key` =  '_price') ",
	'ARRAY_A'
), 'meta_value') );

$curr_min_price = isset( $_GET['min_price'] ) ? esc_attr( $_GET['min_price'] ) : $min_price;
$curr_max_price = isset( $_GET['max_price'] ) ? esc_attr( $_GET['max_price'] ) : $max_price;
$orderby = isset( $_GET['orderby'] ) ? esc_attr( $_GET['orderby'] ) : 'menu_order';

?>

<div class="top-nav style-2">
  <div class="row">
    <div class="col-sm-12">
			<div class="col-sm-7 select-sorting dark">
				<div class="active"><span><?php echo $catalog_orderby_options[$orderby]; ?></span><i class="fa fa-angle-down"></i></div>
				<ul name="orderby" class="orderby list">
					<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
						<?php
							$selected = selected( $orderby, $id, false );
							if ( $selected ) {
								$selected = ' data-' . trim(selected( $orderby, $id, false )) . ' ';
							}
						?>
						<li data-id="<?php echo esc_attr( $id ); ?>" value="<?php echo esc_attr( $id ); ?>" <?php echo $selected; ?>><?php echo esc_html( $name ); ?></li>
					<?php endforeach; ?>
				</ul>
				<?php
					// Keep query string vars intact
					foreach ( $_GET as $key => $val ) {
						if ( 'orderby' === $key || 'submit' === $key ) {
							continue;
						}
						if ( is_array( $val ) ) {
							foreach( $val as $innerVal ) {
								echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
							}
						} else {
							echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
						}
					}
				?>
			</div>
			<div class="col-sm-1 text-right price-title dark">Price: </div>
		  <div class="col-sm-4 creative dark">
		      <div id="price-range">
						<input type="hidden" name="curr_min_price" value="">
						<input type="hidden" name="curr_max_price" value="">
		      </div>
		      <div class="price_range_amount" data-min="<?php echo esc_attr( $min_price ); ?>" data-max="<?php echo esc_attr( $max_price ); ?>" data-current-min="<?php echo esc_attr( $curr_min_price ); ?>" data-current-max="<?php echo esc_attr( $curr_max_price ); ?>"> </div>
		  </div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
