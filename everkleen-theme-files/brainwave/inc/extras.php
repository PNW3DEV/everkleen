<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) : exit; endif;

// filter to replace class on reply link
function bw_replace_reply_link_class( $class ) {
	$class = str_replace( "class='comment-reply-link", "class='comment-reply-link pull-right", $class );

	return $class;
}

add_filter( 'comment_reply_link', 'bw_replace_reply_link_class' );

// filters to show password form
function bw_password_form() {
	$output = '<form class="form-horizontal" action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">';
	$output .= '<div class="row">';
	$output .= '<label class="control-label col-xs-2">' . __( "Password:", 'brainwave' ) . ' </label>';
	$output .= '<div class="col-xs-6">';
	$output .= '<input class="form-control" name="post_password" type="password" size="20" />';
	$output .= '</div>';
	$output .= '<input class="col-xs-2 btn btn-primary" type="submit" name="Submit" value="' . __( "Go", 'brainwave' ) . '" />';
	$output .= '</div>';
	$output .= '</form>';

	return $output;
}

add_filter( 'the_password_form', 'bw_password_form' );

function bw_excerpt_password_form( $excerpt ) {
	if ( post_password_required() ) : $excerpt = get_the_password_form(); endif;

	return $excerpt;
}

add_filter( 'the_excerpt', 'bw_excerpt_password_form' );

// filter to change excerpt output
if ( ! function_exists( 'bw_wp_trim_excerpt' ) ) {
	function bw_wp_trim_excerpt( $wpse_excerpt ) {
		global $brainwave;
		$raw_excerpt = $wpse_excerpt;
		if ( '' == $wpse_excerpt ) {
			$wpse_excerpt = get_the_content( '' );
			$wpse_excerpt = apply_filters( 'the_content', $wpse_excerpt );
			$wpse_excerpt = str_replace( ']]>', ']]&gt;', $wpse_excerpt );
			//Set the excerpt word count and only break after sentence is complete.
			$excerpt_word_count = $brainwave['excerpt_length'];
			$excerpt_length     = apply_filters( 'excerpt_length', $excerpt_word_count );
			$tokens             = array();
			$excerptOutput      = '';
			$count              = 0;
			// Divide the string into tokens; HTML tags, or words, followed by any whitespace
			preg_match_all( '/(<[^>]+>|[^<>\s]+)\s*/u', $wpse_excerpt, $tokens );
			foreach ( $tokens[0] as $token ) {
				if ( $count >= $excerpt_length && preg_match( '/[\.\;]\s*$/uS', $token ) ) :
					// Limit reached, continue until . or ; occur at the end
					$excerptOutput .= trim( $token );
					break;
				endif;
				// Add words to complete sentence
				$count ++;
				// Append what's left of the token
				$excerptOutput .= $token;
			}
			$wpse_excerpt = trim( force_balance_tags( $excerptOutput ) );
			// After the content
			$wpse_excerpt .= wp_link_pages( array( 'echo' => 0 ) );

			return $wpse_excerpt;
		}

		return apply_filters( 'bw_wp_trim_excerpt', $wpse_excerpt, $raw_excerpt );
	}
}
remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );
add_filter( 'get_the_excerpt', 'bw_wp_trim_excerpt' );

// filter to set defaults embed size
function bw_modify_embed_defaults() {
	return array(
		'width'  => 848,
		'height' => 500
	);
}

add_filter( 'embed_defaults', 'bw_modify_embed_defaults' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 *
 * @return string The filtered title.
 */
function bw_wp_title( $title, $sep ) {
	global $page, $paged;

	$title = get_bloginfo( 'name' ) . ' | ' . bw_title();

	return $title;
}

add_filter( 'wp_title', 'bw_wp_title', 10, 2 );

function bw_add_menu_items( $items, $args ) {
	global $userdata, $woocommerce, $brainwave;
	if ( function_exists( 'WC' ) ) {

		if ( is_user_logged_in() && $args->theme_location == 'primary_navigation' && $brainwave['shop-acc'] == 1 ) {
			get_currentuserinfo();

			// Divider
			$items .= '<li class="divider-vertical hidden-xs"></li>';

			// Account
			$items .= '<li class="has-sub large left">';
			$items .= '<a class="single-page-load" href="' . esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) . '" data-title="' . esc_attr( get_bloginfo( 'name' ) . ' | ' . __( 'My Account', 'brainwave' ) ) . '"><i aria-hidden="true" class="et-icon-profile-male"></i><i class="visible-xs-inline-block">' . __( 'My Account', 'brainwave' ) . '</i></a>';
			$items .= '<ul class="sub">';
			$items .= '<li class="header-account-avatar">';
			$items .= '<a class="single-page-load" href="' . esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) . '" data-title="' . esc_attr( get_bloginfo( 'name' ) . ' | ' . __( 'My Account', 'brainwave' ) ) . '" title=""><img width="100" height="100" src="' . esc_url( get_avatar_url( $userdata->ID, 100 ) ) . '" alt="" class="img-circle"> </a>';
			$items .= '</li>';
			$items .= '<li class="header-account-username">';
			$items .= '<h4 class="mt0 mb0">' . $userdata->display_name . '</h4> </li>';
			$items .= '<li><a class="single-page-load" href="' . esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) . '"  data-title="' . esc_attr( get_bloginfo( 'name' ) . ' | ' . __( 'My Account', 'brainwave' ) ) . '">' . __( 'Account Infomation', 'brainwave' ) . '</a></li>';
			if ( function_exists( 'YITH_WCWL' ) && YITH_WCWL()->count_products() ) {
				$items .= '<li><a class="single-page-load" href="' . esc_url( YITH_WCWL()->get_wishlist_url() ) . '">' . __( 'Wishlist', 'yith-woocommerce-wishlist' ) . '</a></li>';
			}
			$items .= '<li><a class="single-page-load" href="' . esc_url( wp_logout_url() ) . '">' . __( 'Log Out', 'brainwave' ) . '</a></li>';
			$items .= '</ul>';
			$items .= '</li>';

			// Cart

			$items .= '<li class="has-sub large left">';
			$items .= '<a href="' . esc_url( get_permalink( get_option( 'woocommerce_cart_page_id' ) ) ) . '" class="single-page-load" data-title="' . esc_attr( get_bloginfo( 'name' ) . ' | ' . __( 'Cart', 'brainwave' ) ) . '"><i aria-hidden="true" class="et-icon-basket"></i><i class="visible-xs-inline-block"> ' . __( 'Cart', 'brainwave' ) . '</i><span class="cart-number"><span>' . WC()->cart->cart_contents_count . '</span></span></a>';
			$items .= '<ul class="sub">';
			$items .= '<ul class="whishlist">';

			foreach ( WC()->cart->cart_contents as $key => $cart_item ) {
				$p_id       = $cart_item["product_id"];
				$p_title    = $cart_item["data"]->post->post_title;
				$p_image    = wp_get_attachment_image_src( get_post_thumbnail_id( $cart_item["product_id"] ), '100x100' );
				$p_url      = get_permalink( $p_id );
				$p_price    = $cart_item["data"]->price;
				$p_quantity = $cart_item["quantity"];

				$items .= '<li>';
				$items .= '<div class="whishlist-item">';

				// Image
				$items .= '<div class="product-image">';
				$items .= '<a class="single-page-load" href="' . esc_url( $p_url ) . '" data-title="' . esc_attr( get_bloginfo( 'name' ) . ' | ' . $p_title ) . '" title="">';
				$items .= '<img width="100" height="100" src="' . esc_url( $p_image[0] ) . '" alt="#">';
				$items .= '</a>';
				$items .= '</div>';

				//Body
				$items .= '<div class="product-body">';
				$items .= '<div class="whishlist-name">';
				$items .= '<a class="single-page-load" href="' . esc_url( $p_url ) . '" data-title="' . esc_attr( get_bloginfo( 'name' ) . ' | ' . $p_title ) . '" title="">' . $p_title . '</a>';
				$items .= '</div>';
				$items .= '<div class="whishlist-price">';
				$items .= '<span>' . $p_quantity . ' × ' . wc_price( $p_price ) . '</span>';
				$items .= '</div>';
				$items .= '</div>';

				$items .= '<div class="remove">';
				$items .= '<a class="single-page-load" href="' . esc_url( WC()->cart->get_remove_url( $key ) ) . '" title="">';
				$items .= '×';
				$items .= '</a>';
				$items .= '</div>';
				$items .= '</div>';
				$items .= '</li>';

			}

			// Total
			$items .= '<li>';
			$items .= '<div class="menu-cart-total">';
			$items .= '<span>Total:</span>';
			$items .= '<span class="price">' . wc_price( WC()->cart->subtotal ) . '</span>';
			$items .= '</div>';
			$items .= '</li>';

			$items .= '<li>';
			$items .= '<div class="cart-action"> <a class="single-page-load btn btn-default btn-inverted" data-title="' . esc_attr( get_bloginfo( 'name' ) . ' | ' . __( 'Cart', 'brainwave' ) ) . '" href="' . esc_url( get_permalink( get_option( 'woocommerce_cart_page_id' ) ) ) . '">' . __( 'View Cart', 'brainwave' ) . '</a> </div>';
			$items .= '</li>';

			$items .= '</ul>';
			$items .= '</ul>';
			$items .= '</li>';
		} elseif ( ! is_user_logged_in() && $args->theme_location == 'primary_navigation' && $brainwave['shop-acc'] == 1 ) {
			// Divider
			$items .= '<li class="divider-vertical hidden-xs"></li>';
			// Log In Page
			$items .= '<li><a class="single-page-load" data-title="' . esc_attr( get_bloginfo( 'name' ) . ' | ' . __( 'Log In', 'brainwave' ) ) . '" href="' . esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) . '"><i aria-hidden="true" class="et-icon-profile-male"></i><i class="visible-xs-inline-block">' . __( 'My Account', 'brainwave' ) . '</i></a></li>';
		}
	}

	return $items;
}

add_filter( 'wp_nav_menu_items', 'bw_add_menu_items', 10, 2 );

add_filter( 'woocommerce_breadcrumb_defaults', 'bw_woocommerce_breadcrumbs' );
function bw_woocommerce_breadcrumbs() {
	return array(
		'delimiter'   => '',
		'wrap_before' => '<ol class="breadcrumb white no-bg">',
		'wrap_after'  => '</ol>',
		'before'      => '<li>',
		'after'       => '</li>',
		'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
	);
}

//Remove Woocommerce Default Styles
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

?>
