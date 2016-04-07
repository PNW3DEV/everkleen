<?php
/**
 * Scripts and stylesheets
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) : exit; endif;

function bw_enqueue_scripts() {
	global $brainwave;
	$assets_css = array(
		'animate'        => get_template_directory_uri() . '/dist/css/animate.css',
		'bootstrap'      => get_template_directory_uri() . '/dist/css/bootstrap.css',
		'wordpress'      => get_template_directory_uri() . '/dist/css/wordpress.css',
		'magnific_popup' => get_template_directory_uri() . '/dist/css/magnific-popup.css',
		'vc_composer'    => get_template_directory_uri() . '/dist/css/js_composer.min.css',
		'font_awesome'   => get_template_directory_uri() . '/dist/css/font-awesome.css',
		'style'          => get_template_directory_uri() . '/dist/css/style.css',
	);

	$assets_js = array(
		'bootstrap'             => get_template_directory_uri() . '/dist/js/bootstrap.min.js',
		'jquery_bgvideo'        => get_template_directory_uri() . '/dist/js/jquery.backgroundvideo.min.js',
		'jquery_superslides'    => get_template_directory_uri() . '/dist/js/jquery.superslides.min.js',
		'jquery_pjax'           => get_template_directory_uri() . '/dist/js/jquery.pjax.js',
		'script'                => get_template_directory_uri() . '/dist/js/script.js',
		'morphext'              => get_template_directory_uri() . '/dist/js/morphext.min.js',
		'isotope'               => get_template_directory_uri() . '/dist/js/isotope.min.js',
		'jquery_magnific_popup' => get_template_directory_uri() . '/dist/js/jquery.magnific-popup.min.js',
		'wow'                   => get_template_directory_uri() . '/dist/js/wow.min.js',
		'owl_carousel'          => get_template_directory_uri() . '/dist/js/owl.carousel.min.js',
		'imagesloaded'          => get_template_directory_uri() . '/dist/js/imagesloaded.pkgd.js',
		'jquery_inview'         => get_template_directory_uri() . '/dist/js/jquery.inview.min.js',
		'jquery_elevatezoom'    => get_template_directory_uri() . '/dist/js/jquery.elevatezoom.min.js',
		'waypoints'             => get_template_directory_uri() . '/dist/js/js_composer/waypoints.min.js',
		'wpb_composer_front'    => get_template_directory_uri() . '/dist/js/js_composer/js_composer_front.min.js',
		'vc_grid'               => get_template_directory_uri() . '/dist/js/js_composer/vc_grid.min.js',
		'vc_accordion'          => get_template_directory_uri() . '/dist/js/js_composer/vc-accordion.min.js',
		'vc_tta_autoplay'       => get_template_directory_uri() . '/dist/js/js_composer/vc-tta-autoplay.min.js',
		'vc_tabs'               => get_template_directory_uri() . '/dist/js/js_composer/vc-tabs.min.js',
	);

	if ( ! empty( $brainwave['smooth-scroll'] ) ) {
		if ( $brainwave['smooth-scroll'] ) {
			$assets_js['smoothscroll'] = get_template_directory_uri() . '/dist/js/SmoothScroll.min.js';
		}
	}

	wp_register_script( 'wordpress_js', get_template_directory_uri() . '/dist/js/wordpress.js' );
	$ajax_url = array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	);
	wp_localize_script( 'wordpress_js', 'helpers', $ajax_url );
	wp_enqueue_script( 'wordpress_js' );
	wp_enqueue_script( 'wc-price-slider' );
	// enqueue styles
	foreach ( $assets_css as $key => $value ) {
		wp_enqueue_style( $assets_css[ $key ], $assets_css[ $key ], false, null );
	}

	// enqueue scripts
	wp_enqueue_script( 'underscore' );
	foreach ( $assets_js as $key => $value ) {
		if ( ! wp_script_is( strtolower( $key ), 'enqueued' ) ) {
			wp_enqueue_script( $assets_js[ $key ], $assets_js[ $key ], array(
				'jquery',
				'jquery-ui-slider'
			), null, true );
		}
	}
	wp_enqueue_script( 'comment-reply' );
}

add_action( 'wp_enqueue_scripts', 'bw_enqueue_scripts', 110 );

function bw_enqueue_admin_scripts( $hook ) {
	wp_enqueue_script( 'wordpress_admin_js', get_template_directory_uri() . '/dist/js/wordpress_admin.js', array(
		'jquery',
		'jquery-ui-sortable'
	), null, true );
	wp_enqueue_script( 'jquery_magnific_popup_js', get_template_directory_uri() . '/dist/js/jquery.magnific-popup.min.js', array( 'jquery' ), null, true );

	wp_enqueue_style( 'wordpress_admin', get_template_directory_uri() . '/dist/css/wordpress_admin.css', false, null );
	wp_enqueue_style( 'magnific_popup', get_template_directory_uri() . '/dist/css/magnific-popup.css', false, null );
	wp_enqueue_style( 'et_line', get_template_directory_uri() . '/dist/css/et-line.css', false, null );
	wp_enqueue_style( 'elegant', get_template_directory_uri() . '/dist/css/elegant-font.css', false, null );
	wp_enqueue_style( 'simple-line-icons', get_template_directory_uri() . '/dist/css/simple-line-icons.css', false, null );
	wp_enqueue_style( 'fa', get_template_directory_uri() . '/dist/css/font-awesome.css', false, null );

}

add_action( 'admin_enqueue_scripts', 'bw_enqueue_admin_scripts', 100 );

function bw_styles_method() {
	global $brainwave;
	wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/dist/css/custom.css' );
	$font = str_replace( ' ', '+', $brainwave['typography']['font-family'] );

	$custom_css = "";
	$custom_css .= "@import url(https://fonts.googleapis.com/css?family={$font});";

	// Menu
	if ( $brainwave['menu-var'] == '1' ) {
		$custom_css .= ".navbar-fixed-top.scrolled {
      background: {$brainwave['menu-color']['rgba']} !important;
    }";
	} else {
		$custom_css .= ".navbar-fixed-top.scrolled.style-2 > nav > ul {
      background-color: {$brainwave['menu-color']['rgba']} !important;
    }";
	}

	if ( $brainwave['menu-var'] == '3' ) {
		$custom_css .= ".full-height-wrapper {
      background: {$brainwave['menu-color']['rgba']} !important;
    }";
	}

	$custom_css .= ".navbar-toggle.scrolled {
    background-color: {$brainwave['menu-btn-color']['rgba']} !important;
  }
  .navbar.style2 .brand-container {
    background-color: {$brainwave['menu-btn-color']['rgba']} !important;
  }
  .navigation a {
    color: {$brainwave['menu-font-color']} !important;
  }
  .brand-container-top {
    background-color: {$brainwave['logo-overlay-color']['rgba']} !important;
  }";

	//Slider
	$custom_css .= ".owl-nav .owl-prev,
  .owl-nav .owl-next,
  .owl-nav .prev,
  .owl-nav .next,
  .slides-navigation .owl-prev,
  .slides-navigation .owl-next,
  .slides-navigation .prev,
  .slides-navigation .next {
    background-color: {$brainwave['slider-nav-bg-color']['rgba']} !important;
    color: {$brainwave['slider-nav-color']['rgba']} !important;
  }

  .no-touch-device .owl-carousel .owl-prev:hover,
  .no-touch-device .owl-carousel .owl-next:hover,
  .no-touch-device .owl-carousel .prev:hover,
  .no-touch-device .owl-carousel .next:hover,
  .no-touch-device .slides-navigation .owl-prev:hover,
  .no-touch-device .slides-navigation .owl-next:hover,
  .no-touch-device .slides-navigation .prev:hover,
  .no-touch-device .slides-navigation .next:hover {
    background-color: {$brainwave['slider-nav-bg-color-hov']['rgba']} !important;
    color: {$brainwave['slider-nav-color-hov']['rgba']} !important;
  }
  .owl-nav .owl-prev:hover i,
  .owl-nav .owl-prev:focus i,
  .owl-nav .owl-prev:active i,
  .owl-nav .owl-next:hover i,
  .owl-nav .owl-next:focus i,
  .owl-nav .owl-next:active i,
  .owl-nav .prev:hover i,
  .owl-nav .prev:focus i,
  .owl-nav .prev:active i,
  .owl-nav .next:hover i,
  .owl-nav .next:focus i,
  .owl-nav .next:active i,
  .slides-navigation .owl-prev:hover i,
  .slides-navigation .owl-prev:focus i,
  .slides-navigation .owl-prev:active i,
  .slides-navigation .owl-next:hover i,
  .slides-navigation .owl-next:focus i,
  .slides-navigation .owl-next:active i,
  .slides-navigation .prev:hover i,
  .slides-navigation .prev:focus i,
  .slides-navigation .prev:active i,
  .slides-navigation .next:hover i,
  .slides-navigation .next:focus i,
  .slides-navigation .next:active i {
    color: {$brainwave['slider-nav-color-hov']['rgba']} !important;
  }";

	$custom_css .= ".site-footer {
    background: {$brainwave['footer-color']} !important;
  }
  .map-section .map-block:before {
    background: {$brainwave['map-overlay-color']['rgba']} !important;
  }
  body {
    font-family: {$brainwave['typography']['font-family']}, sans-serif;
    font-size: {$brainwave['typography']['font-size']} !important;
    line-height: {$brainwave['typography']['line-height']} !important;
  }";
	$custom_css .= $brainwave['custom_css'];
	//Preloader
	if ( ! empty( $brainwave['preloading-bg-color'] ) ) {
		$custom_css .= 'body .page-loader {
      background-color: ' . $brainwave['preloading-bg-color'] . ';
    }';
	}

	if ( ! empty( $brainwave['spinner-type'] ) ) {
		if ( $brainwave['spinner-type'] == 'predefined' ) {
			$spinners = bw_get_preloaders_list();
			$spinners = json_decode( $spinners );
			$custom_css .= $spinners->{$brainwave['spinner_predefined']}->css;
		}

		if ( $brainwave['spinner-type'] == 'custom' ) {
			$custom_css .= $brainwave['custom_spinner_css'];
		}
	}

	wp_add_inline_style( 'custom-style', $custom_css );
}

add_action( 'wp_enqueue_scripts', 'bw_styles_method', 115 );
