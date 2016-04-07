<?php
/**
 * Pagination - Show numbered pagination for catalog pages.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $wp_query, $brainwave;

if ( $wp_query->max_num_pages <= 1 ) {
	return;
}
?>
<nav class="woocommerce-pagination">
	<?php
		$testpaging = paginate_links( apply_filters( 'woocommerce_pagination_args', array(
			'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
			'format'       => '',
			'add_args'     => '',
			'current'      => max( 1, get_query_var( 'paged' ) ),
			'total'        => $wp_query->max_num_pages,
			'prev_next'    => False,
			'type'         => 'array',
		) ) );
	?>

		<ul class="pagination">
			<?php
				$page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				if ( $page != 1 ) :
					echo '<li class="previous">';
					if ( $brainwave['ajax-pages'] ) :
			?>
						<a href="<?php echo get_previous_posts_page_link(); ?>" class="single-page-load" data-title="<?php echo get_bloginfo('name') . ' | ' . get_the_title(); ?>"><span aria-hidden="true"><i class="fa fa-angle-left"></i></span></a>
			<?php
					else :
			?>
						<a href="<?php echo get_previous_posts_page_link(); ?>" data-title="<?php echo get_bloginfo('name') . ' | ' . get_the_title(); ?>"><span aria-hidden="true"><i class="fa fa-angle-left"></i></span></a>
			<?php
					endif;
					echo '</li>';
				endif;
			?>
			<?php
				foreach ( $testpaging as $key => $value ) {
					echo ( ( $key + 1 ) === $page ) ? '<li class="active">' : '<li>';
					echo $value;
					echo '</li>';
				}
				if ( get_next_posts_page_link( $wp_query->max_num_pages ) ) :
					echo '<li class="next">';
					if ( $brainwave['ajax-pages'] ) :
			?>
						<a href="<?php echo get_next_posts_page_link($wp_query->max_num_pages); ?>"  class="single-page-load" data-title="<?php echo get_bloginfo('name') . ' | ' . get_the_title(); ?>"><span aria-hidden="true"><i class="fa fa-angle-right"></i></span></a>
			<?php
					else :
			?>
						<a href="<?php echo get_next_posts_page_link($wp_query->max_num_pages); ?>"  data-title="<?php echo get_bloginfo('name') . ' | ' . get_the_title(); ?>"><span aria-hidden="true"><i class="fa fa-angle-right"></i></span></a>
			<?php
					endif;
					echo '</li>';
				endif;
			?>
		</ul>
</nav>
