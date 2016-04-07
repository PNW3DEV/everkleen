<?php
/**
 * brainwave includes
 *
 * The $brainwave_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 */
$brainwave_includes = array(
	// Scripts and stylesheets
	'inc/scripts.php',

	/* Widgets */
	'inc/widgets/class-wc-widget-recent-reviews.php',
	// Woocommerce Recent Reviews
	'inc/widgets/class-bw-widget-social-icons.php',
	// Social Icons
	'inc/widgets/class-bw-widget-recent-posts.php',
	// Recent Posts

	/* Helpers */
	'inc/helpers/bw-custom-nav-menu.php',
	// Custom menu item meta

	'inc/init.php',
	// Initial theme setup and constants
	'inc/plugin-activate.php',
	// Plugins integration
	'inc/font-awesome/font-awesome-icons.php',
	// FontAwesome for Redux
	'redux-framework/ReduxCore/framework.php',
	// Redux Framework
	'inc/utils.php',
	// Utility functions
	'inc/brainwave-redux.php',
	// Brainwave Admin Page
	'inc/bw_slides/bw_slides.php',
	// Brainwave Slides Field
	'inc/social_icons/social_icons.php',
	// Social icons for Redux
	'inc/titles.php',
	// Page titles
	'inc/wp_bootstrap_navwalker.php',
	// Bootstrap Nav Walker (From https://github.com/twittem/wp-bootstrap-navwalker)
	'inc/comments.php',
	// Custom comments modifications
	'inc/extras.php',
	// Custom functions
);

foreach ( $brainwave_includes as $file ) {
	$filepath = get_template_directory() . '/' . $file;
	if ( ! file_exists( $filepath ) ) :
		trigger_error( sprintf( __( 'Error locating %s for inclusion', 'brainwave' ), $file ), E_USER_ERROR );
	endif;
	require_once $filepath;
}
unset( $file, $filepath );

if ( class_exists( 'WC_Query' ) ) {
	$WC_Query = new WC_Query();
	add_filter( 'loop_shop_post_in', array( $WC_Query, 'price_filter' ) );
}
