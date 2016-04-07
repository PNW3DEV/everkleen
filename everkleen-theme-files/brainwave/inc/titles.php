<?php
/**
 * Page titles
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) : exit; endif;

function bw_title() {
	global $brainwave;

	if ( function_exists( 'is_shop' ) ) {
		if ( is_shop() ) {
			if ( ! empty( $brainwave['shop-title'] ) ) {
				return esc_html( $brainwave['shop-title'] );
			}
		}
	}

	if ( is_home() ) :
		if ( get_option( 'page_for_posts', true ) ) :
			return get_the_title( get_option( 'page_for_posts' ) );
		else :
			return esc_html( $brainwave['header-title'] );
		endif;
		if ( get_option( 'page_on_front', true ) ) :
			return get_the_title( get_option( 'page_on_front', true ) );
		endif;
	elseif ( is_single() || is_page() ) :
		return get_the_title();
	elseif ( is_archive() ) :
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		if ( $term ) :
			return apply_filters( 'single_term_title', $term->name );
		elseif ( is_post_type_archive() ) :
			return apply_filters( 'the_title', get_queried_object()->labels->name );
		elseif ( is_day() ) :
			return sprintf( __( 'Daily Archives: %s', 'brainwave' ), get_the_date() );
		elseif ( is_month() ) :
			return sprintf( __( 'Monthly Archives: %s', 'brainwave' ), get_the_date( 'F Y' ) );
		elseif ( is_year() ) :
			return sprintf( __( 'Yearly Archives: %s', 'brainwave' ), get_the_date( 'Y' ) );
		elseif ( is_author() ) :
			$author = get_queried_object();

			return sprintf( __( 'Author Archives: %s', 'brainwave' ), apply_filters( 'the_author', is_object( $author ) ? $author->display_name : null ) );
		else :
			return single_cat_title( '', false );
		endif;
	elseif ( is_search() ) :
		return __( 'Search Results', 'brainwave' );
	elseif ( is_404() ) :
		return __( 'Not Found', 'brainwave' );
	else :
		return esc_html( $brainwave['header-title'] );
	endif;
}
