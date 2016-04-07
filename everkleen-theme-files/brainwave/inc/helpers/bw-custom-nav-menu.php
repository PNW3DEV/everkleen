<?php
/**
 * @package nav-menu-custom-fields
 * @version 0.1.0
 */
/*
Plugin Name: Nav Menu Custom Fields
*/

/*
 * Saves new field to postmeta for navigation
 */
add_action( 'wp_update_nav_menu_item', 'bw_nav_update', 10, 3 );
function bw_nav_update( $menu_id, $menu_item_db_id, $args ) {
	if ( ! empty( $_REQUEST['menu-item-hide'] ) ) {
		if ( is_array( $_REQUEST['menu-item-hide'] ) ) {
			if ( ! empty ( $_REQUEST['menu-item-hide'][ $menu_item_db_id ] ) ) {
				$custom_value = $_REQUEST['menu-item-hide'][ $menu_item_db_id ];
				update_post_meta( $menu_item_db_id, 'hide', $custom_value );
			}
		}
	}
}

/*
 * Adds value of new field to $item object that will be passed to     Walker_Nav_Menu_Edit_Custom
 */
add_filter( 'wp_setup_nav_menu_item', 'bw_nav_item' );
function bw_nav_item( $menu_item ) {
	$menu_item->hide = get_post_meta( $menu_item->ID, 'hide', true );

	return $menu_item;
}

add_filter( 'wp_edit_nav_menu_walker', 'bw_nav_edit_walker', 10, 2 );
function bw_nav_edit_walker( $walker, $menu_id ) {
	return 'BW_Walker_Nav_Menu_Edit';
}

/**
 * Copied from Walker_Nav_Menu_Edit class in core
 *
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class BW_Walker_Nav_Menu_Edit extends Walker_Nav_Menu  {
/**
 * @see Walker_Nav_Menu::start_lvl()
 * @since 3.0.0
 *
 * @param string $output Passed by reference.
 */
function start_lvl( &$output, $depth = 0, $args = array() ) {
}

/**
 * @see Walker_Nav_Menu::end_lvl()
 * @since 3.0.0
 *
 * @param string $output Passed by reference.
 */
function end_lvl( &$output, $depth = 0, $args = array() ) {
}

/**
 * @see Walker::start_el()
 * @since 3.0.0
 *
 * @param string $output Passed by reference. Used to append additional content.
 * @param object $item Menu item data object.
 * @param int $depth Depth of menu item. Used for padding.
 * @param object $args
 */
function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
global $_wp_nav_menu_max_depth;
$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

ob_start();
$item_id      = esc_attr( $item->ID );
$removed_args = array(
	'action',
	'customlink-tab',
	'edit-menu-item',
	'menu-item',
	'page-tab',
	'_wpnonce',
);

$original_title = '';
if ( 'taxonomy' == $item->type ) {
	$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
	if ( is_wp_error( $original_title ) ) {
		$original_title = false;
	}
} elseif ( 'post_type' == $item->type ) {
	$original_object = get_post( $item->object_id );
	$original_title  = $original_object->post_title;
}

$classes = array(
	'menu-item menu-item-depth-' . esc_attr( $depth ),
	'menu-item-' . esc_attr( $item->object ),
	'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive' ),
);

$title = $item->title;

if ( ! empty( $item->_invalid ) ) {
	$classes[] = 'menu-item-invalid';
	/* translators: %s: title of menu item which is invalid */
	$title = sprintf( __( '%s (Invalid)', 'brainwave' ), $item->title );
} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
	$classes[] = 'pending';
	/* translators: %s: title of menu item in draft status */
	$title = sprintf( __( '%s (Pending)', 'brainwave' ), $item->title );
}

$title = empty( $item->label ) ? $title : $item->label;

?>
<li id="menu-item-<?php echo esc_attr( $item_id ); ?>" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<dl class="menu-item-bar">
		<dt class="menu-item-handle">
			<span class="item-title"><?php echo esc_html( $title ); ?></span>
                <span class="item-controls">
                    <span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
                    <span class="item-order hide-if-js">
                        <a href="<?php
                        echo wp_nonce_url(
	                        add_query_arg(
		                        array(
			                        'action'    => 'move-up-menu-item',
			                        'menu-item' => $item_id,
		                        ),
		                        remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) )
	                        ),
	                        'move-menu_item'
                        );
                        ?>" class="item-move-up"><abbr title="<?php esc_attr_e( 'Move up', 'brainwave' ); ?>">
		                        &#8593;</abbr></a>
                        |
                        <a href="<?php
                        echo wp_nonce_url(
	                        add_query_arg(
		                        array(
			                        'action'    => 'move-down-menu-item',
			                        'menu-item' => $item_id,
		                        ),
		                        remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) )
	                        ),
	                        'move-menu_item'
                        );
                        ?>" class="item-move-down"><abbr title="<?php esc_attr_e( 'Move down', 'brainwave' ); ?>">
		                        &#8595;</abbr></a>
                    </span>
                    <a class="item-edit" id="edit-<?php echo esc_attr( $item_id ); ?>"
                       title="<?php esc_attr_e( 'Edit Menu Item', 'brainwave' ); ?>" href="<?php
                    echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
                    ?>"><?php _e( 'Edit Menu Item', 'brainwave' ); ?></a>
                </span>
		</dt>
	</dl>

	<div class="menu-item-settings" id="menu-item-settings-<?php echo esc_attr( $item_id ); ?>">
		<?php if ( 'custom' == $item->type ) : ?>
			<p class="field-url description description-wide">
				<label for="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>">
					<?php _e( 'URL', 'brainwave' ); ?><br/>
					<input type="text" id="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>"
					       class="widefat code edit-menu-item-url"
					       name="menu-item-url[<?php echo esc_attr( $item_id ); ?>]"
					       value="<?php echo esc_attr( $item->url ); ?>"/>
				</label>
			</p>
		<?php endif; ?>
		<p class="description description-thin">
			<label for="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>">
				<?php _e( 'Navigation Label', 'brainwave' ); ?><br/>
				<input type="text" id="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>"
				       class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr( $item_id ); ?>]"
				       value="<?php echo esc_attr( $item->title ); ?>"/>
			</label>
		</p>
		<p class="description description-thin">
			<label for="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>">
				<?php _e( 'Title Attribute', 'brainwave' ); ?><br/>
				<input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>"
				       class="widefat edit-menu-item-attr-title"
				       name="menu-item-attr-title[<?php echo esc_attr( $item_id ); ?>]"
				       value="<?php echo esc_attr( $item->post_excerpt ); ?>"/>
			</label>
		</p>
		<p class="field-link-target description">
			<label for="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>">
				<input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>" value="_blank"
				       name="menu-item-target[<?php echo esc_attr( $item_id ); ?>]"<?php checked( $item->target, '_blank' ); ?> />
				<?php _e( 'Open link in a new window/tab', 'brainwave' ); ?>
			</label>
		</p>
		<p class="field-css-classes description description-thin">
			<label for="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>">
				<?php _e( 'CSS Classes (optional)', 'brainwave' ); ?><br/>
				<input type="text" id="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>"
				       class="widefat code edit-menu-item-classes"
				       name="menu-item-classes[<?php echo esc_attr( $item_id ); ?>]"
				       value="<?php echo esc_attr( implode( ' ', $item->classes ) ); ?>"/>
			</label>
		</p>
		<p class="field-xfn description description-thin">
			<label for="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>">
				<?php _e( 'Link Relationship (XFN)', 'brainwave' ); ?><br/>
				<input type="text" id="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>"
				       class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr( $item_id ); ?>]"
				       value="<?php echo esc_attr( $item->xfn ); ?>"/>
			</label>
		</p>
		<p class="field-description description description-wide">
			<label for="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>">
				<?php _e( 'Description', 'brainwave' ); ?><br/>
				<textarea id="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>"
				          class="widefat edit-menu-item-description" rows="3" cols="20"
				          name="menu-item-description[<?php echo esc_attr( $item_id ); ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
				<span
					class="description"><?php _e( 'The description will be displayed in the menu if the current theme supports it.', 'brainwave' ); ?></span>
			</label>
		</p>
		<?php
		/*
		 * This is the added field
		 */
		?>
		<p class="field-hide description description-wide">
			<label for="edit-menu-item-hide-<?php echo esc_attr( $item_id ); ?>">
				<input type="checkbox" id="edit-menu-item-hide-<?php echo esc_attr( $item_id ); ?>"
				       class="widefat code edit-menu-item-hide"
				       name="menu-item-hide[<?php echo esc_attr( $item_id ); ?>]"
				       value="1" <?php checked( esc_attr( $item->hide ), '1' ); ?> />
				<?php _e( 'Hide element in menu', 'brainwave' ); ?><br/>
			</label>
		</p>
		<?php
		/*
		 * end added field
		 */
		?>
		<div class="menu-item-actions description-wide submitbox">
			<?php if ( 'custom' != $item->type && $original_title !== false ) : ?>
				<p class="link-to-original">
					<?php printf( __( 'Original: %s', 'brainwave' ), '<a href="' . esc_url( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
				</p>
			<?php endif; ?>
			<a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr( $item_id ); ?>" href="<?php
			echo wp_nonce_url(
				add_query_arg(
					array(
						'action'    => 'delete-menu-item',
						'menu-item' => $item_id,
					),
					remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) )
				),
				'delete-menu_item_' . $item_id
			); ?>"><?php _e( 'Remove', 'brainwave' ); ?></a> <span class="meta-sep"> | </span> <a
				class="item-cancel submitcancel" id="cancel-<?php echo esc_attr( $item_id ); ?>"
				href="<?php echo esc_url( add_query_arg( array(
					'edit-menu-item' => $item_id,
					'cancel'         => time()
				), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) ) );
				?>#menu-item-settings-<?php echo esc_attr( $item_id ); ?>"><?php _e( 'Cancel', 'brainwave' ); ?></a>
		</div>

		<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr( $item_id ); ?>]"
		       value="<?php echo esc_attr( $item_id ); ?>"/>
		<input class="menu-item-data-object-id" type="hidden"
		       name="menu-item-object-id[<?php echo esc_attr( $item_id ); ?>]"
		       value="<?php echo esc_attr( $item->object_id ); ?>"/>
		<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr( $item_id ); ?>]"
		       value="<?php echo esc_attr( $item->object ); ?>"/>
		<input class="menu-item-data-parent-id" type="hidden"
		       name="menu-item-parent-id[<?php echo esc_attr( $item_id ); ?>]"
		       value="<?php echo esc_attr( $item->menu_item_parent ); ?>"/>
		<input class="menu-item-data-position" type="hidden"
		       name="menu-item-position[<?php echo esc_attr( $item_id ); ?>]"
		       value="<?php echo esc_attr( $item->menu_order ); ?>"/>
		<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr( $item_id ); ?>]"
		       value="<?php echo esc_attr( $item->type ); ?>"/>
	</div><!-- .menu-item-settings-->
	<ul class="menu-item-transport"></ul>
	<?php
	$output .= ob_get_clean();
	}
	}

	?>