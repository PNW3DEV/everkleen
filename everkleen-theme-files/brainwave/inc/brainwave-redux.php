<?php
if ( ! class_exists( 'Redux' ) ) {
	return;
}

// This is your option name where all the Redux data is stored.
$opt_name = "brainwave";
$theme    = wp_get_theme(); // For use with some settings. Not necessary.
$args     = array(
	'opt_name'             => $opt_name,
	'display_name'         => $theme->get( 'Name' ),
	'display_version'      => '',
	// Version that appears at the top of your panel
	'menu_type'            => 'menu',
	//Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
	'allow_sub_menu'       => true,
	// Show the sections below the admin menu item or not
	'menu_title'           => __( 'Theme Settings', 'brainwave' ),
	'page_title'           => __( 'Theme Settings', 'brainwave' ),
	// You will need to generate a Google API key to use this feature.
	// Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
	'google_api_key'       => '',
	// Set it you want google fonts to update weekly. A google_api_key value is required.
	'google_update_weekly' => false,
	// Must be defined to add google fonts to the typography module
	'async_typography'     => true,
	// Use a asynchronous font on the front end or font string
	//'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
	'admin_bar'            => false,
	// Show the panel pages on the admin bar
	'admin_bar_icon'       => 'dashicons-portfolio',
	// Choose an icon for the admin bar menu
	'admin_bar_priority'   => 50,
	// Choose an priority for the admin bar menu
	'global_variable'      => '',
	// Set a different name for your global variable other than the opt_name
	'dev_mode'             => false,
	// Show the time the page took to load, etc
	'update_notice'        => true,
	// If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
	'customizer'           => true,
	// Enable basic customizer support

	// OPTIONAL -> Give you extra features
	'page_priority'        => null,
	// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	'page_parent'          => 'themes.php',
	// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
	'page_permissions'     => 'manage_options',
	// Permissions needed to access the options panel.
	'menu_icon'            => 'dashicons-portfolio',
	// Specify a custom URL to an icon
	'last_tab'             => '',
	// Force your panel to always open to a specific tab (by id)
	'page_icon'            => 'icon-themes',
	// Icon displayed in the admin panel next to your menu_title
	'page_slug'            => '',
	// Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
	'save_defaults'        => true,
	// On load save the defaults to DB before user clicks save or not
	'default_show'         => false,
	// If true, shows the default value next to each field that is not the default value.
	'default_mark'         => '',
	// What to print by the field's title if the value shown is default. Suggested: *
	'show_import_export'   => false,
	// Shows the Import/Export panel when not used as a field.

	// CAREFUL -> These options are for advanced use only
	'transient_time'       => 60 * MINUTE_IN_SECONDS,
	'output'               => true,
	// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
	'output_tag'           => true,
	// Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
	// 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

	// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
	'database'             => '',
	// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
	'system_info'          => false,
	// REMOVE

	//'compiler'             => true,

	// HINTS
	'hints'                => array(
		'icon'          => 'el el-question-sign',
		'icon_position' => 'right',
		'icon_color'    => 'lightgray',
		'icon_size'     => 'normal',
		'tip_style'     => array(
			'color'   => 'red',
			'shadow'  => true,
			'rounded' => false,
			'style'   => '',
		),
		'tip_position'  => array(
			'my' => 'top left',
			'at' => 'bottom right',
		),
		'tip_effect'    => array(
			'show' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'mouseover',
			),
			'hide' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'click mouseleave',
			),
		),
	)
);
Redux::setArgs( $opt_name, $args );

/*
 * ---> END ARGUMENTS
 */

// Get Subscribers List From Database
global $wp_filesystem, $wpdb;

$upload_dir = wp_upload_dir();
$filename   = trailingslashit( $upload_dir['url'] ) . 'list.csv';

$table_name = esc_sql( $wpdb->prefix . 'bw_subscribers' );
$is_table   = $wpdb->query( "SHOW TABLES LIKE '$table_name'" );
if ( ! empty( $is_table ) ) {
	$result           = $wpdb->get_results( "SELECT * FROM `$table_name` " );
	$subscribers_list = '';
	foreach ( $result as $key => $value ) {
		$mail = get_object_vars( $value );
		$subscribers_list .= '<div class="subscriber-container"><span id="s' . esc_attr( $mail['id'] ) . '">' . $mail['subscriber_email'] . '</span><i class="remove-subscriber fa fa-times"></i></div>';
	}
	$subscribers_list .= '<br><a id="btn-export" href="' . esc_url( $filename ) . '" target="_blank" class="button button-default">Export</a>';
} else {
	bw_create_tables();
	$subscribers_list = '';
}

// General Section Starts
Redux::setSection( $opt_name, array(
	'title'  => __( 'General', 'brainwave' ),
	'id'     => 'general',
	'icon'   => 'el el-wrench',
	'fields' => array(
		array(
			'id'      => 'documentation',
			'type'    => 'raw',
			'title'   => __( 'Documentation', 'brainwave' ),
			'content' => '<p>Need Help? Click <a target="_blank" href="' . esc_url( get_template_directory_uri() . '/docs/index.html' ) . '">here.</a></p>',
		),
		array(
			'id'   => 'divider_1',
			'type' => 'divide'
		),
		array(
			'id'      => 'onepage',
			'type'    => 'switch',
			'title'   => __( 'Onepage on Main', 'brainwave' ),
			'default' => '1'
		),
		array(
			'id'      => 'back-to-top',
			'type'    => 'switch',
			'title'   => __( 'Show "Back to top" button', 'brainwave' ),
			'default' => '0'
		),
		array(
			'id'      => 'smooth-scroll',
			'type'    => 'switch',
			'title'   => __( 'On/Off smooth scroll', 'brainwave' ),
			'default' => '0'
		),
		array(
			'id'   => 'divider_2',
			'type' => 'divide'
		),
		array(
			'id'       => 'logo-img',
			'type'     => 'media',
			'title'    => __( 'Logo', 'brainwave' ),
			'subtitle' => __( 'Image', 'brainwave' ),
			'default'  => ''
		),
		array(
			'id'       => 'logo-overlay-color',
			'type'     => 'color_rgba',
			'title'    => '',
			'subtitle' => __( 'Logo Overlay Color', 'brainwave' ),
			'default'  => array(
				'color' => '#000000',
				'alpha' => 1,
				'rgba'  => 'rgba(0, 0, 0, 1)',
			),
		),
		array(
			'id'   => 'divider_3',
			'type' => 'divide'
		),
		array(
			'id'      => 'typography',
			'type'    => 'typography',
			'title'   => __( 'Font Settings', 'brainwave' ),
			'google'  => true,
			'units'   => 'em',
			'default' => array(
				'font-style'  => '300',
				'font-family' => 'Open Sans',
				'google'      => true,
				'font-size'   => '1.7em',
				'line-height' => '1.6'
			),
		),
		array(
			'id'   => 'divider_4',
			'type' => 'divide'
		),
		array(
			'id'      => 'footer-col',
			'type'    => 'button_set',
			'title'   => __( 'Footer Sidebar Columns', 'brainwave' ),
			'options' => array(
				'12' => '1',
				'6'  => '2',
				'4'  => '3',
				'3'  => '4',
				'2'  => '5',
			),
			'default' => '12'
		),
		array(
			'id'      => 'footer-company',
			'type'    => 'text',
			'title'   => __( 'Footer Company Text', 'brainwave' ),
			'default' => 'Brainwave',
		),
		array(
			'id'      => 'footer-additional',
			'type'    => 'text',
			'title'   => __( 'Footer Additional Text', 'brainwave' ),
			'default' => 'Made With Love in Ukraine',
		),
		array(
			'id'       => 'footer-color',
			'type'     => 'color',
			'title'    => '',
			'subtitle' => __( 'Footer Color', 'brainwave' ),
			'default'  => '#000000',
			'validate' => 'color',
		),
		array(
			'id'   => 'divider_5',
			'type' => 'divide'
		),
		array(
			'id'      => 'subscriber-list',
			'type'    => 'raw',
			'title'   => __( 'Subscribers', 'brainwave' ),
			'content' => $subscribers_list,
		),
		array(
			'id'   => 'divider_6',
			'type' => 'divide'
		),
		array(
			'id'      => 'services_link',
			'type'    => 'text',
			'title'   => __( 'Services Link', 'brainwave' ),
			'default' => '/#services',
		),
		array(
			'id'      => 'contacts_link',
			'type'    => 'text',
			'title'   => __( 'Contacts Link', 'brainwave' ),
			'default' => '/#contacts',
		),
		array(
			'id'      => 'portfolio_link',
			'type'    => 'text',
			'title'   => __( 'Portfolio Link', 'brainwave' ),
			'default' => '/#portfolio',
		),
		array(
			'id'   => 'divider_7',
			'type' => 'divide'
		),
		array(
			'id'      => 'portfolio_popup',
			'type'    => 'switch',
			// 'mode'      => 'css',
			'title'   => __( 'Open portfolio posts in popups', 'brainwave' ),
			'default' => 'false',
		),
		array(
			'id'      => 'custom_css',
			'type'    => 'ace_editor',
			'mode'    => 'css',
			'title'   => __( 'Custom CSS', 'brainwave' ),
			'default' => '',
		),
		array(
			'id'      => 'custom_js',
			'type'    => 'ace_editor',
			'mode'    => 'javascript ',
			'title'   => __( 'Custom JS', 'brainwave' ),
			'default' => '',
		),
		array(
			'id'   => 'divider_8',
			'type' => 'divide'
		),
		array(
			'id'      => 'page404',
			'type'    => 'media',
			'mode'    => 'image',
			'title'   => __( '404 Background', 'brainwave' ),
			'default' => '',
		),
		array(
			'id'      => 'under-construction',
			'type'    => 'switch',
			'title'   => __( 'Under Construction', 'brainwave' ),
			'default' => 0,
		),
		array(
			'id'       => 'under-construction-img',
			'type'     => 'media',
			'required' => array( 'under-construction', 'equals', 1 ),
			'mode'     => 'image',
			'title'    => __( 'Under Construction Background', 'brainwave' ),
			'default'  => '',
		),
		array(
			'id'   => 'divider_9',
			'type' => 'divide'
		),
		array(
			'id'       => 'pages-layout',
			'type'     => 'image_select',
			'title'    => __( 'Pages Layout Variant', 'brainwave' ),
			'subtitle' => __( 'full width, right, left or two sidebars', 'brainwave' ),
			'desc'     => __( '', 'brainwave' ),
			'options'  => array(
				'1' => array(
					'alt' => 'full width',
					'img' => ReduxFramework::$_url . 'assets/img/1c.png'
				),
				'2' => array(
					'alt' => 'left sidebar',
					'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
				),
				'3' => array(
					'alt' => 'right sidebar',
					'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
				),
				'4' => array(
					'alt' => 'two sidebars',
					'img' => ReduxFramework::$_url . 'assets/img/3cm.png'
				),
			),
			'default'  => '1',
		),
		array(
			'id'   => 'divider_10',
			'type' => 'divide'
		),
		array(
			'id'       => 'slider-nav-color',
			'type'     => 'color_rgba',
			'title'    => __( '', 'brainwave' ),
			'subtitle' => __( 'Slider Arrows Color', 'brainwave' ),
			'desc'     => __( '', 'brainwave' ),
			'default'  => array(
				'color' => '#ffffff',
				'alpha' => 1,
				'rgba'  => 'rgba(255, 255, 255, 1)',
			),
		),
		array(
			'id'       => 'slider-nav-bg-color',
			'type'     => 'color_rgba',
			'title'    => __( '', 'brainwave' ),
			'subtitle' => __( 'Slider Arrows BG Color', 'brainwave' ),
			'desc'     => __( '', 'brainwave' ),
			'default'  => array(
				'color' => '#000000',
				'alpha' => 0.8,
				'rgba'  => 'rgba(0, 0, 0, 0.8)',
			),
		),
		array(
			'id'       => 'slider-nav-color-hov',
			'type'     => 'color_rgba',
			'title'    => __( '', 'brainwave' ),
			'subtitle' => __( 'Slider Arrows Color On Hover', 'brainwave' ),
			'desc'     => __( '', 'brainwave' ),
			'default'  => array(
				'color' => '#ffffff',
				'alpha' => 1,
				'rgba'  => 'rgba( 255, 255, 255, 1 )',
			),
		),
		array(
			'id'       => 'slider-nav-bg-color-hov',
			'type'     => 'color_rgba',
			'title'    => __( '', 'brainwave' ),
			'subtitle' => __( 'Slider Arrows BG Color On Hover', 'brainwave' ),
			'desc'     => __( '', 'brainwave' ),
			'default'  => array(
				'color' => '#000000',
				'alpha' => 0.6,
				'rgba'  => 'rgba(0, 0, 0, 0,6)',
			),
		),
		array(
			'id'   => 'divider_11',
			'type' => 'divide'
		),
		array(
			'id'       => 'map-overlay-color',
			'type'     => 'color_rgba',
			'title'    => __( '', 'brainwave' ),
			'subtitle' => __( 'Map overlay color', 'brainwave' ),
			'desc'     => __( '', 'brainwave' ),
			'default'  => array(
				'color' => '#000000',
				'alpha' => 0.6,
				'rgba'  => 'rgba(0, 0, 0, 0,6)',
			),
		),
		array(
			'id'   => 'divider_12',
			'type' => 'divide'
		),
		array(
			'id'      => 'ajax-pages',
			'type'    => 'switch',
			'title'   => __( 'Ajax Pages Opening', 'brainwave' ),
			'default' => 1,
		),
	)
) );

// Blog Section Starts
Redux::setSection( $opt_name, array(
	'title'  => __( 'Blog', 'brainwave' ),
	'id'     => 'blog',
	'icon'   => 'el el-bold',
	'fields' => array(
		array(
			'id'      => 'paging',
			'type'    => 'image_select',
			'title'   => __( 'Blog List Pagination', 'brainwave' ),
			'options' => array(
				'1' => array(
					'alt' => '',
					'img' => ReduxFramework::$_url . '../../dist/img/pagination_number.png'
				),
				'2' => array(
					'alt' => '',
					'img' => ReduxFramework::$_url . '../../dist/img/pagination_buttons.png'
				),
			),
			'default' => '1'
		),
		array(
			'id'       => 'layout',
			'type'     => 'image_select',
			'title'    => __( 'Blog Layout Variant', 'brainwave' ),
			'subtitle' => __( 'full width, right, left or two sidebars', 'brainwave' ),
			'options'  => array(
				'1' => array(
					'alt' => 'full width',
					'img' => ReduxFramework::$_url . 'assets/img/1c.png'
				),
				'2' => array(
					'alt' => 'left sidebar',
					'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
				),
				'3' => array(
					'alt' => 'right sidebar',
					'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
				),
				'4' => array(
					'alt' => 'two sidebars',
					'img' => ReduxFramework::$_url . 'assets/img/3cm.png'
				),
			),
			'default'  => '1',
		),
		array(
			'id'      => 'excerpt_length',
			'type'    => 'spinner',
			'title'   => __( 'Excerpt words count', 'brainwave' ),
			'min'     => '0',
			'max'     => '100',
			'step'    => '1',
			'default' => '75',
		),
		array(
			'id'      => 'post-nav',
			'type'    => 'switch',
			'title'   => __( 'Navigation in single post', 'brainwave' ),
			'default' => '1',
		),
		array(
			'id'   => 'divider_13',
			'type' => 'divide'
		),
		array(
			'id'       => 'meta',
			'type'     => 'switch',
			'title'    => __( 'Meta', 'brainwave' ),
			'subtitle' => __( 'date, author, tags, comments', 'brainwave' ),
			'default'  => '1',
		),
		array(
			'id'       => 'meta-date',
			'required' => array( 'meta', 'equals', '1' ),
			'type'     => 'switch',
			'title'    => '',
			'subtitle' => __( 'Date', 'brainwave' ),
			'default'  => '1',
		),
		array(
			'id'       => 'meta-date-format',
			'required' => array( 'meta-date', 'equals', '1' ),
			'type'     => 'text',
			'title'    => '',
			'subtitle' => __( 'Date Format', 'brainwave' ) . "\n" . '( ' . __( 'If You not sure about change that, don\'t do it', 'brainwave' ) . ' )',
			'desc'     => __( 'There are <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">rules</a> and <a href="https://codex.wordpress.org/Formatting_Date_and_Time#Examples" target="_blank">examples</a> how to fill that field', 'brainwave' ),
			'default'  => 'l, F jS, Y',
		),
		array(
			'id'       => 'meta-author',
			'required' => array( 'meta', 'equals', '1' ),
			'type'     => 'switch',
			'title'    => '',
			'subtitle' => __( 'Author', 'brainwave' ),
			'default'  => '1',
		),
		array(
			'id'       => 'meta-tags',
			'required' => array( 'meta', 'equals', '1' ),
			'type'     => 'switch',
			'title'    => '',
			'subtitle' => __( 'Tags', 'brainwave' ),
			'default'  => '1',
		),
		array(
			'id'       => 'meta-comments',
			'required' => array( 'meta', 'equals', '1' ),
			'type'     => 'switch',
			'title'    => '',
			'subtitle' => __( 'Comments', 'brainwave' ),
			'default'  => '1',
		),
	)
) );

// Shop Section Starts
Redux::setSection( $opt_name, array(
	'title'  => __( 'Shop', 'brainwave' ),
	'id'     => 'shop',
	'icon'   => 'el el-shopping-cart',
	'fields' => array(
		array(
			'id'       => 'shop-layout',
			'type'     => 'image_select',
			'title'    => __( 'Shop Layout Variant', 'brainwave' ),
			'subtitle' => __( 'full width, right, left or two sidebars', 'brainwave' ),
			'options'  => array(
				'1' => array(
					'alt' => 'full width',
					'img' => ReduxFramework::$_url . 'assets/img/1c.png'
				),
				'2' => array(
					'alt' => 'left sidebar',
					'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
				),
				'3' => array(
					'alt' => 'right sidebar',
					'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
				),
			),
			'default'  => '1',
		),
		array(
			'id'      => 'shop-col',
			'type'    => 'button_set',
			'title'   => __( 'Shop Columns', 'brainwave' ),
			'options' => array(
				'12' => '1',
				'6'  => '2',
				'4'  => '3',
				'3'  => '4',
				'2'  => '5',
			),
			'default' => '12',
		),
		array(
			'id'      => 'shop-acc',
			'type'    => 'switch',
			'title'   => __( 'Account in Menu', 'brainwave' ),
			'default' => 0,
		),
		array(
			'id'      => 'shop-title',
			'type'    => 'text',
			'title'   => __( 'Shop Main Title', 'brainwave' ),
			'default' => __( 'Shop', 'brainwave' ),
		),
	)
) );

// Menu Section Starts
Redux::setSection( $opt_name, array(
	'title'  => __( 'Menu', 'brainwave' ),
	'id'     => 'menu',
	'icon'   => 'el el-lines',
	'fields' => array(
		array(
			'id'      => 'menu-var',
			'type'    => 'image_select',
			'title'   => __( 'Menu Variant', 'brainwave' ),
			'options' => array(
				'1' => array(
					'alt' => '',
					'img' => ReduxFramework::$_url . '../../dist/img/m1.png'
				),
				'2' => array(
					'alt' => '',
					'img' => ReduxFramework::$_url . '../../dist/img/m2.png'
				),
				'3' => array(
					'alt' => '',
					'img' => ReduxFramework::$_url . '../../dist/img/m3.png'
				),
			),
			'default' => '1',
		),
		array(
			'id'      => 'menu-portfolio',
			// 'required' => array( 'menu-var', 'equals', '1' ),
			'type'    => 'switch',
			'title'   => __( 'Show menu in portfolio items', 'brainwave' ),
			'default' => '0',
		),
		array(
			'id'       => 'menu-hide',
			'required' => array( 'menu-var', 'equals', '1' ),
			'type'     => 'switch',
			'title'    => __( 'Menu Hide When Scroll', 'brainwave' ),
			'default'  => '0',
		),
		array(
			'id'       => 'menu-fixed',
			'required' => array( 'menu-var', 'equals', '1' ),
			'type'     => 'switch',
			'title'    => __( 'Menu Fixed On Top', 'brainwave' ),
			'default'  => '1',
		),
		array(
			'id'      => 'menu-scroll',
			'type'    => 'switch',
			'title'   => __( 'Menu Scroll Onepage', 'brainwave' ),
			'default' => '1',
		),
		array(
			'id'       => 'menu-color',
			'type'     => 'color_rgba',
			'title'    => '',
			'subtitle' => __( 'Menu Background Color', 'brainwave' ),
			'default'  => array(
				'color' => '#000000',
				'alpha' => 0.9,
				'rgba'  => 'rgba(0, 0, 0, 0.9)',
			),
		),
		array(
			'id'       => 'menu-btn-color',
			'type'     => 'color_rgba',
			'required' => array( 'menu-var', 'equals', array( '3', '4' ) ),
			'title'    => '',
			'subtitle' => __( 'Menu Button Color', 'brainwave' ),
			'default'  => array(
				'color' => '#000000',
				'alpha' => 0.9,
				'rgba'  => 'rgba(0, 0, 0, 0.9)',
			),
		),
		array(
			'id'       => 'menu-font-color',
			'type'     => 'color',
			'title'    => '',
			'subtitle' => __( 'Menu Font Color', 'brainwave' ),
			'default'  => '#ffffff',
			'validate' => 'color',
		),

	)
) );

// Header Section Starts
Redux::setSection( $opt_name, array(
	'title'  => __( 'Header', 'brainwave' ),
	'id'     => 'header',
	'icon'   => 'el el-website',
	'fields' => array(
		array(
			'id'       => 'header-title',
			'type'     => 'text',
			'title'    => __( 'Header Title', 'brainwave' ),
			'subtitle' => __( '', 'brainwave' ),
			'default'  => 'Blog List',
		),
		array(
			'id'       => 'bg-img',
			'type'     => 'media',
			'title'    => __( 'Header Background', 'brainwave' ),
			'subtitle' => __( 'Image', 'brainwave' ),
			'default'  => ''
		),
		array(
			'id'       => 'bg-opacity',
			'type'     => 'spinner',
			'title'    => '',
			'subtitle' => __( 'Overlay Opacity', 'brainwave' ),
			'min'      => '0',
			'max'      => '1',
			'step'     => '0.01',
			'default'  => '0.9'
		),
		array(
			'id'       => 'bg-color',
			'type'     => 'color',
			'title'    => '',
			'subtitle' => __( 'Overlay Color', 'brainwave' ),
			'default'  => '#000000',
			'validate' => 'color',
		),
		array(
			'id'   => 'divider_14',
			'type' => 'divide'
		),
		array(
			'id'       => 'header-var',
			'type'     => 'button_set',
			'title'    => __( 'Header Variant', 'brainwave' ),
			'subtitle' => __( '', 'brainwave' ),
			'desc'     => __( '', 'brainwave' ),
			'options'  => array(
				'home1'  => 'Content + Image Slider',
				'home2'  => 'Text + Image Slider',
				'video'  => 'Video + Slider',
				'video2' => 'Video + Text',
				'image'  => 'Image + Slider',
				'none'   => 'None',
			),
			'default'  => 'home1'
		),
		array(
			'id'       => 'header-opacity',
			'type'     => 'spinner',
			'required' => array( 'header-var', 'equals', array( 'home1', 'home2', 'video', 'image' ) ),
			'title'    => __( 'Header Opacity', 'brainwave' ),
			'subtitle' => '',
			'min'      => '0',
			'max'      => '1',
			'step'     => '0.01',
			'default'  => '0.9',
		),
		array(
			'id'       => 'header-color',
			'type'     => 'color',
			'required' => array( 'header-var', 'equals', array( 'home1', 'home2', 'video', 'image' ) ),
			'title'    => __( '', 'brainwave' ),
			'subtitle' => __( 'Overlay Color', 'brainwave' ),
			'desc'     => __( '', 'brainwave' ),
			'default'  => '#000000',
			'validate' => 'color',
		),
		array(
			'id'       => 'videobg',
			'type'     => 'media',
			'mode'     => 'video',
			'url'      => true,
			'required' => array( 'header-var', 'equals', array( 'video', 'video2' ) ),
			'title'    => __( 'Video BG', 'brainwave' ),
			'subtitle' => '',
			'desc'     => '',
		),
		array(
			'id'       => 'video-imagebg',
			'type'     => 'media',
			'mode'     => 'image',
			'required' => array( 'header-var', 'equals', array( 'video', 'video2' ) ),
			'title'    => __( 'Image For Mobile BG', 'brainwave' ),
			'subtitle' => '',
			'desc'     => '',
		),
		array(
			'id'       => 'imagebg',
			'type'     => 'media',
			'mode'     => 'image',
			'required' => array( 'header-var', 'equals', 'image' ),
			'title'    => __( 'Image BG', 'brainwave' ),
			'subtitle' => '',
			'desc'     => '',
		),
		array(
			'id'          => 'home1',
			'type'        => 'bw_slides',
			'required'    => array( 'header-var', 'equals', 'home1' ),
			'title'       => __( 'Slides Options', 'brainwave' ),
			'subtitle'    => __( 'Unlimited slides with drag and drop sortings.', 'brainwave' ),
			'desc'        => __( 'This field will store all slides values into a multidimensional array to use into a foreach loop.', 'brainwave' ),
			'placeholder' => array(
				'title'       => __( 'This is a title', 'brainwave' ),
				'description' => __( 'Description Here', 'brainwave' ),
			),
			'show'        => array(
				'title'       => true,
				'description' => true,
				'url'         => false,
			),
		),
		array(
			'id'          => 'home2',
			'type'        => 'slides',
			'required'    => array( 'header-var', 'equals', array( 'home2', 'video2' ) ),
			'title'       => __( 'Slides Options', 'brainwave' ),
			'subtitle'    => __( 'Unlimited slides with drag and drop sortings.', 'brainwave' ),
			'desc'        => __( 'This field will store all slides values into a multidimensional array to use into a foreach loop.', 'brainwave' ),
			'placeholder' => array(
				'title' => __( 'This is a title', 'brainwave' ),
			),
			'show'        => array(
				'title'       => true,
				'description' => false,
				'url'         => false,
			),
		),
		array(
			'id'          => 'slider',
			'type'        => 'bw_slides',
			'required'    => array( 'header-var', 'equals', array( 'video', 'image' ) ),
			'title'       => __( 'Slides Options', 'brainwave' ),
			'subtitle'    => __( 'Unlimited slides with drag and drop sortings.', 'brainwave' ),
			'desc'        => __( 'This field will store all slides values into a multidimensional array to use into a foreach loop.', 'brainwave' ),
			'placeholder' => array(
				'title'       => __( 'This is a title', 'brainwave' ),
				'description' => __( 'Description Here', 'brainwave' ),
			),
			'show'        => array(
				'title'       => true,
				'description' => true,
				'url'         => false,
			),
		),
	)
) );

// Social Widget Section Starts
Redux::setSection( $opt_name, array(
	'title'  => __( 'Social Widget', 'brainwave' ),
	'id'     => 'social',
	'icon'   => 'el el-share',
	'desc'   => __( '', 'brainwave' ),
	'fields' => array(
		array(
			'id'           => 'social-icons',
			'type'         => 'bw_social_icons',
			'title'        => __( 'Links', 'brainwave' ),
			'options'      => bw_get_font_awesome_icons(),
			'default_show' => false,
			'default'      => array(
				0 => array(
					'title'  => 'Twitter',
					'select' => 'fa-twitter',
					'url'    => 'https://twitter.com',
					'sort'   => 0
				),
				1 => array(
					'title'  => 'Facebook',
					'url'    => 'https://facebook.com',
					'select' => 'fa-facebook',
					'sort'   => 1
				),
				2 => array(
					'title'  => 'GitHub',
					'url'    => 'https://github.com',
					'select' => 'fa-github',
					'sort'   => 2
				),
				3 => array(
					'title'  => 'Google',
					'url'    => 'https://plus.google.com',
					'select' => 'fa-google-plus',
					'sort'   => 3
				),
			)
		),
	)
) );

// Social Widget Section Starts
Redux::setSection( $opt_name, array(
	'title'  => __( 'Import/Export Theme Settings', 'brainwave' ),
	'id'     => 'import',
	'icon'   => 'el el-refresh',
	'desc'   => __( '', 'brainwave' ),
	'fields' => array(
		array(
			'id'         => 'opt-import-export',
			'type'       => 'import_export',
			'title'      => 'Import Export',
			'subtitle'   => 'Save and restore your Redux options',
			'full_width' => false,
		),
	),
) );

$spinners = bw_get_preloaders_list();
$spinners = (array) json_decode( $spinners );
// var_dump(  $spinners);
$spinners_html = '';
foreach ( $spinners as $key => $value ) {
	$spinners_html .= '<div class="spinner_overlay" data-name="' . $key . '">'
	                  . '<style>' . $value->css . '</style>'
	                  . $value->html
	                  . '</div>';
}
// Preloader Section Starts
Redux::setSection( $opt_name, array(
	'title'  => __( 'Preloader', 'brainwave' ),
	'id'     => 'preloader',
	'icon'   => 'fa fa-spinner',
	'fields' => array(
		array(
			'id'      => 'spinner-type',
			'type'    => 'button_set',
			'title'   => __( 'Spinner Type', 'brainwave' ),
			'options' => array(
				'default'    => 'Default',
				'image'      => 'Image',
				'predefined' => 'Predefined',
				'custom'     => 'Custom',
				'none'       => 'None',
			),
			'default' => 'default'
		),
		array(
			'id'       => 'preloading-bg-color',
			'type'     => 'color',
			'title'    => __( 'Preloader Background Color', 'brainwave' ),
			'default'  => '#ffffff',
			'validate' => 'color',
		),
		array(
			'id'       => 'image-spinner',
			'type'     => 'media',
			'mode'     => 'image',
			'required' => array( 'spinner-type', 'equals', 'image' ),
			'title'    => __( 'Image', 'brainwave' ),
		),
		array(
			'id'       => 'spinners_preview',
			'required' => array( 'spinner-type', 'equals', 'predefined' ),
			'type'     => 'raw',
			'content'  => $spinners_html,
		),
		array(
			'id'       => 'spinner_predefined',
			'required' => array( 'spinner-type', 'equals', 'predefined' ),
			'type'     => 'text',
			'readonly' => true,
			'title'    => __( 'Active', 'brainwave' ),
			'default'  => 'atom',
		),
		array(
			'id'       => 'custom_spinner_html',
			'required' => array( 'spinner-type', 'equals', 'custom' ),
			'type'     => 'ace_editor',
			'mode'     => 'html',
			'title'    => __( 'HTML', 'brainwave' ),
			'default'  => '',
		),
		array(
			'id'       => 'custom_spinner_css',
			'required' => array( 'spinner-type', 'equals', 'custom' ),
			'type'     => 'ace_editor',
			'mode'     => 'css',
			'title'    => __( 'CSS', 'brainwave' ),
			'default'  => '',
		),
		array(
			'id'       => 'custom_spinner_js',
			'required' => array( 'spinner-type', 'equals', 'custom' ),
			'type'     => 'ace_editor',
			'mode'     => 'javascript',
			'title'    => __( 'JS', 'brainwave' ),
			'default'  => '',
		),

	)
) );


?>
