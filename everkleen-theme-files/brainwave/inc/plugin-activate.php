<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) : exit; endif;

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/inc/helpers/class-tgm-plugin-activation.php';
/**
 * Register the required plugins for this theme.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
add_action( 'tgmpa_register', 'bw_register_plugins' );
function bw_register_plugins() {
	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		// This is an example of how to include a plugin pre-packaged with a theme
		array(
			'name'               => 'WPBakery Visual Composer',
			// The plugin name
			'slug'               => 'js_composer',
			// The plugin slug (typically the folder name)
			'source'             => get_template_directory_uri() . '/inc/plugins/js_composer.zip',
			// The plugin source
			'required'           => false,
			// If false, the plugin is only 'recommended' instead of required
			'version'            => '4.11.1',
			// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '',
			// If set, overrides default API URL and points to an external URL
		),
		array(
			'name'               => 'BW Portfolio',
			// The plugin name
			'slug'               => 'bw-portfolio',
			// The plugin slug (typically the folder name)
			'source'             => get_template_directory_uri() . '/inc/plugins/bw_portfolio.zip',
			// The plugin source
			'required'           => true,
			// If false, the plugin is only 'recommended' instead of required
			'version'            => '0.0.8',
			// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '',
			// If set, overrides default API URL and points to an external URL
		),
		array(
			'name'               => 'Envato Market',
			// The plugin name
			'slug'               => 'envato-market',
			// The plugin slug (typically the folder name)
			'source'             => get_template_directory_uri() . '/inc/plugins/envato-market.zip',
			// The plugin source
			'required'           => false,
			// If false, the plugin is only 'recommended' instead of required
			'version'            => '1.0.0-beta',
			// E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '',
			// If set, overrides default API URL and points to an external URL
		),
		array(
			'name'               => 'Contact Form 7',
			// The plugin name
			'slug'               => 'contact-form-7',
			// The plugin slug (typically the folder name)
			'required'           => false,
			// If false, the plugin is only 'recommended' instead of required
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => 'https://wordpress.org/plugins/contact-form-7/',
			// If set, overrides default API URL and points to an external URL
		),
		array(
			'name'               => 'WooCommerce',
			// The plugin name
			'slug'               => 'woocommerce',
			// The plugin slug (typically the folder name)
			'required'           => false,
			// If false, the plugin is only 'recommended' instead of required
			'force_activation'   => false,
			// If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => 'https://wordpress.org/plugins/woocommerce/',
			// If set, overrides default API URL and points to an external URL
		),
	);

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'brainwave';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'           => $theme_text_domain, // Text domain - likely want to be the same as your theme.
		'default_path'     => '', // Default absolute path to pre-packaged plugins
		'parent_menu_slug' => 'themes.php', // Default parent menu slug
		'parent_url_slug'  => 'themes.php', // Default parent URL slug
		'menu'             => 'install-required-plugins', // Menu slug
		'has_notices'      => true, // Show admin notices or not
		'is_automatic'     => true, // Automatically activate plugins after installation or not
		'message'          => '', // Message to output right before the plugins table
	);
	tgmpa( $plugins, $config );
}

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
add_action( 'vc_before_init', 'bw_vcSetAsTheme' );
function bw_vcSetAsTheme() {
	vc_set_as_theme();
	$list = array(
		'page',
		'post',
		'portfolio',
	);
	vc_set_default_editor_post_types( $list );
}

?>
