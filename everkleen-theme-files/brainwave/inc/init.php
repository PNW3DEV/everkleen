<?php
/**
 * brainwave initial setup and constants
 */
function bw_setup_theme() {
	// Make theme available for translation
	// Community translations can be found at https://github.com/brainwave/brainwave-translations
	load_theme_textdomain( 'brainwave', get_template_directory() . '/lang' );

	// Register wp_nav_menu() menus
	// http://codex.wordpress.org/Function_Reference/register_nav_menus
	register_nav_menus(
		array(
			'primary_navigation' => __( 'Primary Navigation', 'brainwave' )
		)
	);

	// Add post thumbnails
	// http://codex.wordpress.org/Post_Thumbnails
	// http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
	// http://codex.wordpress.org/Function_Reference/add_image_size
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );

	add_image_size( '100x100', 100, 100, true );
	add_image_size( '171x171', 171, 171, true );
	add_image_size( '200x150', 200, 150, true );
	add_image_size( '200x200', 200, 200, true );
	add_image_size( 'tab-image', 60, 60, true );
	add_image_size( 'featured-image', 750, 500, true );

	// Add HTML5 markup for captions
	// http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
	add_theme_support( 'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);
	add_theme_support( 'woocommerce' );
	add_theme_support( 'jquery-cdn' );            // Enable to load jQuery from the Google CDN

	// Tell the TinyMCE editor to use a custom stylesheet
	add_editor_style( '/assets/css/editor-style.css' );
}

add_action( 'after_setup_theme', 'bw_setup_theme' );

if ( is_admin() && isset( $_GET['theme'] ) && $pagenow == "customize.php" ) {
	bw_create_tables();
}
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == "themes.php" ) {
	header( 'Location: ' . admin_url() . 'admin.php?page=BrainWave&tab=8' );
}


// Additional functionality tables in DB create
function bw_create_tables() {
	global $wpdb;

	// Create table for subscribers
	$sql = "CREATE TABLE IF NOT EXISTS " . $wpdb->prefix . "bw_subscribers (
    id int(11) NOT NULL AUTO_INCREMENT,
    subscriber_email varchar(255) DEFAULT NULL,
    UNIQUE KEY id (id)
  ) CHARSET=utf8;";
	$wpdb->query( $sql );

	// Crate grid for Visual Composer Posts Grid Shortcode
	$post_data = array(
		'post_title'   => wp_strip_all_tags( 'Brainwave Grid' ),
		'post_content' => '[vc_gitem c_zone_position="bottom"][vc_gitem_animated_block][vc_gitem_zone_a height_mode="1-1" link="post_link" featured_image="yes"][vc_gitem_row position="top"][vc_gitem_col width="1/1"][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col width="1/2"][/vc_gitem_col][vc_gitem_col width="1/2"][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col width="1/1"][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_a][vc_gitem_zone_b][vc_gitem_row position="top"][vc_gitem_col width="1/1"][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col width="1/2"][/vc_gitem_col][vc_gitem_col width="1/2"][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col width="1/1"][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_b][/vc_gitem_animated_block][vc_gitem_zone_c css=".vc_custom_1419240516480{background-color: #f9f9f9 !important;}"][vc_gitem_row][vc_gitem_col width="1/1" featured_image="" el_class="latest-post"][vc_gitem_post_title link="none" font_container="tag:h3|text_align:left" use_custom_fonts="" google_fonts="font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal" el_class="text-uppercase mb5"][vc_gitem_post_date link="none" font_container="tag:div|text_align:left" use_custom_fonts="" google_fonts="font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal" el_class="post-meta mb17"][vc_gitem_post_excerpt link="none" font_container="tag:p|text_align:left" use_custom_fonts="" google_fonts="font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal" el_class="excerpt"][vc_btn link="post_link" title="Read more" style="flat" shape="square" color="black" size="sm" align="left" button_block="" add_icon="true" i_align="right" i_type="fontawesome" i_icon_fontawesome="fa fa-angle-right" i_icon_openiconic="vc-oi vc-oi-dial" i_icon_typicons="typcn typcn-adjust-brightness" i_icon_entypo="entypo-icon entypo-icon-note" i_icon_linecons="vc_li vc_li-heart" i_icon_pixelicons="vc_pixel_icon vc_pixel_icon-alert"][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_c][/vc_gitem]',
		'post_status'  => 'publish',
		'post_type'    => 'vc_grid_item',
		'post_author'  => 1,
	);
	if ( ! $wpdb->get_results( "SELECT * FROM $wpdb->posts WHERE post_title = '" . wp_strip_all_tags( 'Brainwave Grid' ) . "'" ) ) {
		$post_id = wp_insert_post( $post_data );
	}

	// Crate table for categories
	$sql = "CREATE TABLE IF NOT EXISTS " . $wpdb->prefix . "bw_block_categories (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    block_type tinytext NOT NULL,
    name tinytext NOT NULL,
    slug tinytext NOT NULL,
    UNIQUE KEY id (id)
    ) CHARSET=utf8;";
	$wpdb->query( $sql );

	// Create three test categories
	$count_cat = $wpdb->get_results( "SELECT COUNT(*) FROM " . $wpdb->prefix . "bw_block_categories" );
	$count_cat = get_object_vars( $count_cat[0] );
	$count_cat = (int) $count_cat["COUNT(*)"];

	if ( $count_cat === 0 ) {
		// Photography
		$wpdb->insert(
			$wpdb->prefix . 'bw_block_categories',
			array(
				'id'         => 1,
				'block_type' => 'portfolio',
				'name'       => 'Photography',
				'slug'       => 'photography',
			),
			array( '%d', '%s', '%s', '%s' )
		);
		// Design
		$wpdb->insert(
			$wpdb->prefix . 'bw_block_categories',
			array(
				'id'         => 2,
				'block_type' => 'portfolio',
				'name'       => 'Design',
				'slug'       => 'design',
			),
			array( '%d', '%s', '%s', '%s' )
		);
		// Branding
		$wpdb->insert(
			$wpdb->prefix . 'bw_block_categories',
			array(
				'id'         => 3,
				'block_type' => 'portfolio',
				'name'       => 'Branding',
				'slug'       => 'branding',
			),
			array( '%d', '%s', '%s', '%s' )
		);
	}
}

add_action( 'after_switch_theme', 'bw_create_tables' );
add_action( 'customize_preview_init', 'bw_create_tables' );

// Register sidebars
function bw_widgets_init() {
	global $brainwave;

	register_sidebar( array(
		'name'          => __( 'Primary', 'brainwave' ),
		'id'            => 'sidebar-primary',
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Left', 'brainwave' ),
		'id'            => 'sidebar-left',
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );

	if ( empty( $brainwave['footer-col'] ) ) {
		$brainwave['footer-col'] = '1';
	}
	register_sidebar( array(
		'name'          => __( 'Footer', 'brainwave' ),
		'id'            => 'sidebar-footer',
		'before_widget' => '<section class="col-sm-' . $brainwave['footer-col'] . ' widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Shop', 'brainwave' ),
		'id'            => 'sidebar-shop',
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );

}

add_action( 'widgets_init', 'bw_widgets_init' );

//vc_row page_section param
function bw_vc_add_custom_params() {
	$bw_vc_row_atts = array(
		'type'        => 'dropdown',
		'heading'     => "Page Section",
		'param_name'  => 'page_section',
		'value'       => array(
			"None",
			"Small",
			"Normal"
		),
		'description' => __( "Top and Bottom Padding for row", "brainwave" )
	);
	vc_add_param( 'vc_row', $bw_vc_row_atts );
}

add_action( 'vc_before_init', 'bw_vc_add_custom_params' );

// Custom meta boxes add
function bw_add_meta_box() {
	add_meta_box( 'displaying_options', __( 'Displaying Page', 'brainwave' ), 'bw_displaying_options', 'page', 'side' );
	add_meta_box( 'page_header', __( 'Style Header', 'brainwave' ), 'bw_page_header_options', 'page', 'normal' );
	add_meta_box( 'page_header', __( 'Style Header', 'brainwave' ), 'bw_page_header_options', 'post', 'normal' );
	add_meta_box( 'new_featured', __( 'Featured Carousel', 'brainwave' ), 'bw_carousel_options', 'post', 'side' );
	add_meta_box( 'section_bg', __( 'Section Background', 'brainwave' ), 'bw_section_bg_options', 'page', 'normal' );
	add_meta_box( 'creative_header', __( 'Creative Header', 'brainwave' ), 'bw_creative_header', 'page', 'side' );
}

add_action( 'add_meta_boxes', 'bw_add_meta_box' );

// Featured Carousel
function bw_carousel_options() {
	global $post;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) : return $post_id; endif;
	$new_featured_img = get_post_meta( $post->ID, 'new_featured_img', true );
	?>
	<div class='upload'>
		<a id="upload_img"><?php _e( '+ Add Image(s)', 'brainwave' ); ?></a>
		<input id='list-of-images' type='hidden' name="new_featured_img"
		       value='<?php echo esc_attr( $new_featured_img ); ?> '>
		<div class='preview-img-container'>
			<ul id="sortable">
				<?php
				if ( isset( $new_featured_img ) && ! empty( $new_featured_img ) && ( $new_featured_img != ' ' ) ) :
					$new_featured_img = json_decode( $new_featured_img );
					foreach ( get_object_vars( $new_featured_img ) as $key => $value ) {
						echo '<li><i class="close fa fa-times"></i>' . wp_get_attachment_image( $new_featured_img->$key->{'id'}, '200x200', 0, array( 'data-id' => $new_featured_img->$key->{'id'} ) ) . '</li>';
					}
				endif;
				?>
			</ul>
		</div>
	</div>
	<?php
}

// Creative Header
function bw_creative_header() {
	global $post;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) : return $post_id; endif;
	$creative_enable = get_post_meta( $post->ID, 'creative_enable', true );
	$creative_header = get_post_meta( $post->ID, 'creative_header', true );
	$creative_header = trim( $creative_header );
	?>
	<div class='upload'>
		<div class="enable-creative-slider">
			<input type="checkbox" name="creative_enable" id="creative_enable"
			       value="true" <?php checked( $creative_enable, 'true' ); ?>/>
			<label for="creative_enable">Enable Creative Slider</label>
		</div>

		<a id="upload_img_creative"><?php _e( '+ Add Image(s)', 'brainwave' ); ?></a>
		<input id='creative_header_images' type='hidden' name="creative_header"
		       value='<?php echo esc_attr( $creative_header ); ?> '>
		<div class='preview-creative'>
			<ul id="creative_sortable">
				<?php
				if ( ! empty( $creative_header ) ) {
					$creative_header = json_decode( $creative_header );
					foreach ( get_object_vars( $creative_header ) as $key => $value ) {
						echo '<li><i class="close fa fa-times"></i>' . wp_get_attachment_image( $creative_header->$key->{'id'}, '200x200', 0, array( 'data-id' => $creative_header->$key->{'id'} ) ) . '</li>';
					}
				}
				?>
			</ul>
		</div>
	</div>
	<?php
}

// Section Background
function bw_section_bg_options() {
	global $post;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) : return $post_id; endif;
	$section_bg_col  = get_post_meta( $post->ID, 'section_bg_col', true );
	$section_bg      = get_post_meta( $post->ID, 'section_bg', true );
	$section_color   = get_post_meta( $post->ID, 'overlay-color', true );
	$section_opacity = get_post_meta( $post->ID, 'overlay-opacity', true );

	if ( empty( $section_opacity ) ) {
		$section_opacity = '0';
	}
	if ( empty( $section_color ) ) {
		$section_color = '#f4f4f4';
	}

	if ( empty( $section_bg_col ) ) {
		$section_bg_col = 12;
	}
	?>
	<div class="overlay-color-wrapper">
		<label for="overlay-color">Overlay Color</label>
		<input type="color" class="overlay-color" name="overlay-color"
		       value="<?php echo esc_attr( $section_color ); ?>"/>
	</div>

	<div class="overlay-opacity-wrapper">
		<label for="overlay-opacity">Overlay Opacity</label>
		<input type="number" id="overlay-opacity" name="overlay-opacity" min="0" max="1" step="0.01"
		       placeholder="opacity" value="<?php echo esc_attr( $section_opacity ); ?>">
	</div>

	<select id="section_bg_col" name="section_bg_col">
		<option <?php selected( $section_bg_col, '12' ); ?> value="12">1</option>
		<option <?php selected( $section_bg_col, '6' ); ?> value="6">2</option>
		<option <?php selected( $section_bg_col, '4' ); ?> value="4">3</option>
		<option <?php selected( $section_bg_col, '3' ); ?> value="3">4</option>
		<option <?php selected( $section_bg_col, '2' ); ?> value="2">6</option>
	</select>

	<div class='upload'>
		<a id="upload_section_bg">+ Add Image(s)</a>
		<a id="add_empty_bg">+ Add Empty</a>
		<input id='list-of-bg-images' type='hidden' name="section_bg" value='<?php echo esc_attr( $section_bg ); ?> '>
		<div class='preview-bg-img-container'>
			<ul id="sortable_bg" class="show<?php echo esc_attr( 12 / $section_bg_col ); ?>">
				<?php
				if ( isset( $section_bg ) && ! empty( $section_bg ) && ( $section_bg != ' ' ) ) :
					$section_bg = json_decode( $section_bg );
					foreach ( get_object_vars( $section_bg ) as $key => $value ) {
						if ( ! empty( $section_bg->$key->id ) ) {
							$fixed = 'bw-pin';
							if ( ! empty( $value->fixed ) ) {
								if ( $value->fixed == "true" ) {
									$fixed = 'bw-pinned';
								}
							}
							echo '<li class="col' . esc_attr( $section_bg_col ) . '"><i class="' . esc_attr( $fixed ) . ' fa fa-thumb-tack"></i><i class="close fa fa-times"></i>' . wp_get_attachment_image( $section_bg->$key->{'id'}, '200x200', 0, array( 'data-id'    => $section_bg->$key->{'id'},
							                                                                                                                                                                                                                                  'data-fixed' => ( ! empty( $section_bg->$key->{'fixed'} ) ? $section_bg->$key->{'fixed'} : 'false' )
								) ) . '</li>';
						} else {
							echo '<li class="empty col' . esc_attr( $section_bg_col ) . '"><i class="close fa fa-times"></i></li>';
						}
					}
				endif;
				?>
			</ul>
		</div>
	</div>
	<?php
}

// How to display pages in onepage
function bw_displaying_options() {
	global $post;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) : return $post_id; endif;
	$page_title_displaying = get_post_meta( $post->ID, 'page_title_displaying', true );
	$page_size             = get_post_meta( $post->ID, 'page_size', true );
	$show_in_onepage       = get_post_meta( $post->ID, 'show_in_onepage', true );

	if ( empty( $page_size ) ) {
		$page_size = 'Normal';
	}
	?>
	<div class="displaying_options">
		<div>
			<input type="checkbox" id="page_title_displaying" name="page_title_displaying"
			       value="title_displaying" <?php checked( $page_title_displaying, 'title_displaying' ); ?> >
			<label for="page_title_displaying">Display Title in Onepage</label>
		</div>
		<div>
			<label for="page_size">Page Section</label>
			<select class="" id="page_size" name="page_size">
				<option <?php selected( $page_size, 'None' ); ?>
					value="None"><?php _e( 'None', 'brainwave' ); ?></option>
				<option <?php selected( $page_size, 'Small' ); ?>
					value="Small"><?php _e( 'Small', 'brainwave' ); ?></option>
				<option <?php selected( $page_size, 'Normal' ); ?>
					value="Normal"><?php _e( 'Normal', 'brainwave' ); ?></option>
			</select>
		</div>
		<div>
			<input type="checkbox" id="show_in_onepage" name="show_in_onepage"
			       value="show_in_onepage" <?php checked( $show_in_onepage, 'show_in_onepage' ); ?> >
			<label for="show_in_onepage">Show This Page On Main (if onepage feature is using)</label>
		</div>
	</div>
	<?php
}

// How to display header of page
function bw_page_header_options() {
	global $post;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) : return $post_id; endif;

	$header_size            = ( get_post_meta( $post->ID, 'header_size', true ) ) ? get_post_meta( $post->ID, 'header_size', true ) : 'Small';
	$header_bg_color        = ( get_post_meta( $post->ID, 'header_bg_color', true ) ) ? get_post_meta( $post->ID, 'header_bg_color', true ) : '#000000';
	$bg_fixed               = ( get_post_meta( $post->ID, 'bg_fixed', true ) ) ? get_post_meta( $post->ID, 'bg_fixed', true ) : '';
	$header_overlay_color   = ( get_post_meta( $post->ID, 'header_overlay_color', true ) ) ? get_post_meta( $post->ID, 'header_overlay_color', true ) : '';
	$header_overlay_opacity = ( get_post_meta( $post->ID, 'header_overlay_opacity', true ) ) ? get_post_meta( $post->ID, 'header_overlay_opacity', true ) : '0.9';
	$title_text_align       = ( get_post_meta( $post->ID, 'title_text_align', true ) ) ? get_post_meta( $post->ID, 'title_text_align', true ) : 'Center';
	$breadcrumb_show        = ( get_post_meta( $post->ID, 'breadcrumb_show', true ) ) ? get_post_meta( $post->ID, 'breadcrumb_show', true ) : '';
	$breadcrumb_pos         = ( get_post_meta( $post->ID, 'breadcrumb_pos', true ) ) ? get_post_meta( $post->ID, 'breadcrumb_pos', true ) : '';
	$breadcrumb_style       = ( get_post_meta( $post->ID, 'breadcrumb_style', true ) ) ? get_post_meta( $post->ID, 'breadcrumb_style', true ) : 'Light';
	$breadcrumb_bg          = ( get_post_meta( $post->ID, 'breadcrumb_bg', true ) ) ? get_post_meta( $post->ID, 'breadcrumb_bg', true ) : '';
	$title_text_color       = ( get_post_meta( $post->ID, 'title_text_color', true ) ) ? get_post_meta( $post->ID, 'title_text_color', true ) : '#ffffff';
	$title_font_weight      = ( get_post_meta( $post->ID, 'title_font_weight', true ) ) ? get_post_meta( $post->ID, 'title_font_weight', true ) : '100';
	$title_letter_spacing   = ( get_post_meta( $post->ID, 'title_letter_spacing', true ) ) ? get_post_meta( $post->ID, 'title_letter_spacing', true ) : '0.3';
	$title_border           = ( get_post_meta( $post->ID, 'title_border', true ) ) ? get_post_meta( $post->ID, 'title_border', true ) : '';
	$title_border_color     = ( get_post_meta( $post->ID, 'title_border_color', true ) ) ? get_post_meta( $post->ID, 'title_border_color', true ) : '';
	$header_subtitle        = ( get_post_meta( $post->ID, 'header_subtitle', true ) ) ? get_post_meta( $post->ID, 'header_subtitle', true ) : '';

	?>
	<div class="header_displaying_options">

		<div>
			<label for="size_values"><?php _e( 'Header Size', 'brainwave' ); ?></label>
			<select id="size_values" name="header_size">
				<option <?php selected( $header_size, 'Small' ); ?>
					value="Small"><?php _e( 'Small', 'brainwave' ); ?></option>
				<option <?php selected( $header_size, 'Normal' ); ?>
					value="Normal"><?php _e( 'Normal', 'brainwave' ); ?></option>
				<option <?php selected( $header_size, 'Large' ); ?>
					value="Large"><?php _e( 'Large', 'brainwave' ); ?></option>
			</select>
		</div>

		<div>
			<label for="bg_color"><?php _e( 'Header Background Color', 'brainwave' ); ?></label>
			<input type="color" id="bg_color" name="header_bg_color"
			       value="<?php echo esc_attr( $header_bg_color ); ?>"/>
		</div>

		<div class="checkbox">
			<label><?php _e( 'Fixed Background', 'brainwave' ); ?></label>
			<input type="checkbox" id="bg_fixed" name="bg_fixed"
			       value="bg_fixed" <?php checked( $bg_fixed, 'bg_fixed' ); ?> >
			<label for="bg_fixed"><?php _e( 'On/Off', 'brainwave' ); ?></label>
		</div>

		<div>
			<label for="overlay_color"><?php _e( 'Header Overlay Color', 'brainwave' ); ?></label>
			<input type="color" id="overlay_color" name="header_overlay_color"
			       value="<?php echo esc_attr( $header_overlay_color ); ?>"/>
		</div>

		<div>
			<label for="header_overlay_opacity"><?php _e( 'Header Overlay Opacity', 'brainwave' ); ?></label>
			<input type="number" id="header_overlay_opacity" name="header_overlay_opacity" min="0.01" max="0.99"
			       step="0.01" value="<?php echo esc_attr( $header_overlay_opacity ); ?>">
			<div class="sub-lable"><?php _e( 'Number From 0.01 to 0.99 with 0.01 step', 'brainwave' ); ?></div>
		</div>

		<div>
			<label for="title_text_align"><?php _e( 'Title Text Align', 'brainwave' ); ?></label>
			<select id="title_text_align" name="title_text_align">
				<option <?php selected( $title_text_align, 'Left' ); ?>
					value="Left"><?php _e( 'Left', 'brainwave' ); ?></option>
				<option <?php selected( $title_text_align, 'Center' ); ?>
					value="Center"><?php _e( 'Center', 'brainwave' ); ?></option>
				<option <?php selected( $title_text_align, 'Right' ); ?>
					value="Right"><?php _e( 'Right', 'brainwave' ); ?></option>
			</select>
		</div>

		<div class="checkbox">
			<label><?php _e( 'Breadcrumb', 'brainwave' ); ?></label>
			<input type="checkbox" id="breadcrumb_show" name="breadcrumb_show"
			       value="breadcrumb_show" <?php checked( $breadcrumb_show, 'breadcrumb_show' ); ?> >
			<label for="breadcrumb_show"><?php _e( 'On/Off', 'brainwave' ); ?></label>
		</div>

		<div>
			<label for="breadcrumb_pos"><?php _e( 'Breadcrumb Position', 'brainwave' ); ?></label>
			<select id="breadcrumb_pos" name="breadcrumb_pos">
				<option <?php selected( $breadcrumb_pos, 'Left' ); ?>
					value="Left"><?php _e( 'Left', 'brainwave' ); ?></option>
				<option <?php selected( $breadcrumb_pos, 'Right' ); ?>
					value="Right"><?php _e( 'Right', 'brainwave' ); ?></option>
				<option <?php selected( $breadcrumb_pos, 'Top' ); ?>
					value="Top"><?php _e( 'Top', 'brainwave' ); ?></option>
				<option <?php selected( $breadcrumb_pos, 'Bottom' ); ?>
					value="Bottom"><?php _e( 'Bottom', 'brainwave' ); ?></option>
			</select>
		</div>

		<div>
			<label for="breadcrumb_style"><?php _e( 'Breadcrumb Style', 'brainwave' ); ?></label>
			<select id="breadcrumb_style" name="breadcrumb_style">
				<option <?php selected( $breadcrumb_style, 'Dark' ); ?>
					value="Dark"><?php _e( 'Dark', 'brainwave' ); ?></option>
				<option <?php selected( $breadcrumb_style, 'Light' ); ?>
					value="Light"><?php _e( 'Light', 'brainwave' ); ?></option>
			</select>
		</div>

		<div class="checkbox">
			<label><?php _e( 'Breadcrumb Background', 'brainwave' ); ?></label>
			<input type="checkbox" id="breadcrumb_bg" name="breadcrumb_bg"
			       value="breadcrumb_bg" <?php checked( $breadcrumb_bg, 'breadcrumb_bg' ); ?> >
			<label for="breadcrumb_bg"><?php _e( 'On/Off', 'brainwave' ); ?></label>
		</div>

		<div>
			<label for="title_text_color"><?php _e( 'Title Text Color', 'brainwave' ); ?></label>
			<input type="color" id="title_text_color" name="title_text_color"
			       value="<?php echo esc_attr( $title_text_color ); ?>"/>
		</div>

		<div>
			<label for="title_font_weight"><?php _e( 'Title Text Weight', 'brainwave' ); ?></label>
			<input type="number" id="title_font_weight" name="title_font_weight" min="100" max="900" step="100"
			       value="<?php echo esc_attr( $title_font_weight ); ?>">
			<div class="sub-lable"><?php _e( 'Number From 100 to 900 with 100 step', 'brainwave' ); ?></div>
		</div>

		<div>
			<label for="title_letter_spacing"><?php _e( 'Title Letter Spacing', 'brainwave' ); ?></label>
			<input type="number" id="title_letter_spacing" name="title_letter_spacing" min="0.01" max="0.99" step="0.01"
			       value="<?php echo esc_attr( $title_letter_spacing ); ?>">
			<div class="sub-lable"><?php _e( 'Number From 0.01 to 0.99 with 0.01 step', 'brainwave' ); ?></div>
		</div>

		<div class="checkbox">
			<label><?php _e( 'Title Border', 'brainwave' ); ?></label>
			<input type="checkbox" id="title_border" name="title_border"
			       value="title_border" <?php checked( $title_border, 'title_border' ); ?> >
			<label for="title_border"><?php _e( 'On/Off', 'brainwave' ); ?></label>
		</div>

		<div>
			<label for="title_border_color"><?php _e( 'Title Border Color', 'brainwave' ); ?></label>
			<input type="color" id="title_border_color" name="title_border_color"
			       value="<?php echo esc_attr( $title_border_color ); ?>"/>
		</div>

		<div>
			<label for="header_subtitle"><?php _e( 'Subtitle', 'brainwave' ); ?></label>
			<input type="text" id="header_subtitle" name="header_subtitle"
			       placeholder="<?php esc_attr_e( 'Subtitle text here', 'brainwave' ); ?>"
			       value="<?php echo esc_attr( $header_subtitle ); ?>"/>
		</div>
	</div>
	<?php
}

// Saving meta
function bw_save_extras() {
	global $post;

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	} else {
		if ( isset( $_POST['new_featured_img'] ) ) {
			update_post_meta( $post->ID, "new_featured_img", str_replace( '  ', ' ', $_POST["new_featured_img"] ) );
		}
		if ( isset( $_POST['section_bg'] ) ) {
			update_post_meta( $post->ID, "section_bg", str_replace( '  ', ' ', $_POST["section_bg"] ) );
		}
		if ( isset( $_POST['section_bg_col'] ) ) {
			update_post_meta( $post->ID, "section_bg_col", str_replace( '  ', ' ', $_POST["section_bg_col"] ) );
		}
		if ( isset( $_POST['overlay-opacity'] ) ) {
			update_post_meta( $post->ID, "overlay-opacity", str_replace( '  ', ' ', $_POST["overlay-opacity"] ) );
		}
		if ( isset( $_POST['overlay-color'] ) ) {
			update_post_meta( $post->ID, "overlay-color", str_replace( '  ', ' ', $_POST["overlay-color"] ) );
		}
		if ( isset( $_POST['masonry_view'] ) ) {
			update_post_meta( $post->ID, "masonry_view", $_POST["masonry_view"] );
		}
		if ( isset( $_POST['page_size'] ) ) {
			update_post_meta( $post->ID, "page_size", $_POST["page_size"] );
		}
		if ( isset( $_POST['page_title_displaying'] ) ) {
			if ( $_POST['page_title_displaying'] != get_post_meta( $post->ID, 'page_title_displaying', true ) ) {
				update_post_meta( $post->ID, "page_title_displaying", $_POST["page_title_displaying"] );
			}
		} else {
			if ( isset( $post ) ) {
				delete_post_meta( $post->ID, "page_title_displaying" );
			}
		}
		if ( isset( $_POST['show_in_onepage'] ) ) {
			if ( $_POST['show_in_onepage'] != get_post_meta( $post->ID, 'show_in_onepage', true ) ) {
				update_post_meta( $post->ID, "show_in_onepage", $_POST["show_in_onepage"] );
			}
		} else {
			if ( isset( $post ) ) {
				delete_post_meta( $post->ID, "show_in_onepage" );
			}
		}
		if ( isset( $_POST['block_categories'] ) ) {
			update_post_meta( $post->ID, 'block_categories', sanitize_text_field( $_POST['block_categories'] ) );
		}
		if ( isset( $_POST['creative_enable'] ) ) {
			if ( $_POST['creative_enable'] != get_post_meta( $post->ID, 'creative_enable', true ) ) {
				update_post_meta( $post->ID, "creative_enable", $_POST["creative_enable"] );
			}
		} else {
			if ( isset( $post ) ) {
				delete_post_meta( $post->ID, "creative_enable" );
			}
		}
		if ( isset( $_POST['creative_header'] ) ) {
			update_post_meta( $post->ID, "creative_header", $_POST["creative_header"] );
		}

		// Header Save Meta
		if ( isset( $_POST['header_size'] ) ) {
			update_post_meta( $post->ID, "header_size", $_POST["header_size"] );
		}
		if ( isset( $_POST['header_bg_color'] ) ) {
			update_post_meta( $post->ID, "header_bg_color", $_POST["header_bg_color"] );
		}
		if ( isset( $_POST['bg_fixed'] ) ) {
			if ( $_POST['bg_fixed'] != get_post_meta( $post->ID, 'bg_fixed', true ) ) {
				update_post_meta( $post->ID, "bg_fixed", $_POST["bg_fixed"] );
			}
		} else {
			if ( isset( $post ) ) {
				delete_post_meta( $post->ID, "bg_fixed" );
			}
		}
		if ( isset( $_POST['header_overlay_color'] ) ) {
			update_post_meta( $post->ID, "header_overlay_color", $_POST["header_overlay_color"] );
		}
		if ( isset( $_POST['header_overlay_opacity'] ) ) {
			update_post_meta( $post->ID, "header_overlay_opacity", $_POST["header_overlay_opacity"] );
		}
		if ( isset( $_POST['title_text_align'] ) ) {
			update_post_meta( $post->ID, "title_text_align", $_POST["title_text_align"] );
		}
		if ( isset( $_POST['breadcrumb_show'] ) ) {
			if ( $_POST['breadcrumb_show'] != get_post_meta( $post->ID, 'breadcrumb_show', true ) ) {
				update_post_meta( $post->ID, "breadcrumb_show", $_POST["breadcrumb_show"] );
			}
		} else {
			if ( isset( $post ) ) {
				delete_post_meta( $post->ID, "breadcrumb_show" );
			}
		}
		if ( isset( $_POST['breadcrumb_bg'] ) ) {
			if ( $_POST['breadcrumb_bg'] != get_post_meta( $post->ID, 'breadcrumb_bg', true ) ) {
				update_post_meta( $post->ID, "breadcrumb_bg", $_POST["breadcrumb_bg"] );
			}
		} else {
			if ( isset( $post ) ) {
				delete_post_meta( $post->ID, "breadcrumb_bg" );
			}
		}
		if ( isset( $_POST['breadcrumb_style'] ) ) {
			update_post_meta( $post->ID, "breadcrumb_style", $_POST["breadcrumb_style"] );
		}
		if ( isset( $_POST['breadcrumb_pos'] ) ) {
			update_post_meta( $post->ID, "breadcrumb_pos", $_POST["breadcrumb_pos"] );
		}
		if ( isset( $_POST['title_text_color'] ) ) {
			update_post_meta( $post->ID, "title_text_color", $_POST["title_text_color"] );
		}
		if ( isset( $_POST['title_font_weight'] ) ) {
			update_post_meta( $post->ID, "title_font_weight", $_POST["title_font_weight"] );
		}
		if ( isset( $_POST['title_letter_spacing'] ) ) {
			update_post_meta( $post->ID, "title_letter_spacing", $_POST["title_letter_spacing"] );
		}
		if ( isset( $_POST['title_border'] ) ) {
			if ( $_POST['title_border'] != get_post_meta( $post->ID, 'title_border', true ) ) {
				update_post_meta( $post->ID, "title_border", $_POST["title_border"] );
			}
		} else {
			if ( isset( $post ) ) {
				delete_post_meta( $post->ID, "title_border" );
			}
		}
		if ( isset( $_POST['title_border_color'] ) ) {
			update_post_meta( $post->ID, "title_border_color", $_POST["title_border_color"] );
		}
		if ( isset( $_POST['header_subtitle'] ) ) {
			update_post_meta( $post->ID, "header_subtitle", $_POST["header_subtitle"] );
		}
	}
}

add_action( 'save_post', 'bw_save_extras' );

// New oembed types register
function bw_oembed_provider() {
	wp_oembed_add_provider( '#https?://(www\.)?coub.com/view/.*#i', 'https://coub.com/api/oembed.json', true );
	wp_oembed_add_provider( '#https?://(?:api\.)?soundcloud\.com/.*#i', 'http://soundcloud.com/oembed', true );
}

add_action( 'init', 'bw_oembed_provider' );
if ( ! isset( $content_width ) ) : $content_width = 1140; endif;
