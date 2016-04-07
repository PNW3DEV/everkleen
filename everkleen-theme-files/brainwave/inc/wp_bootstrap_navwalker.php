<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) : exit; endif;


class BW_Navwalker extends Walker_Nav_Menu {

	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul role=\"menu\" class=\"sub \">\n";
	}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $brainwave;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$args   = (object) $args;
		if ( ! empty( $item->hide ) ) {
			return;
		}
		/**
		 * Dividers, Headers or Disabled
		 * =============================
		 * Determine whether the item is a Divider, Header, Disabled or regular
		 * menu item. To prevent errors we use the strcasecmp() function to so a
		 * comparison that is not case sensitive. The strcasecmp() function returns
		 * a 0 if the strings are equal.
		 */
		if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth > 0 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} elseif ( strcasecmp( $item->title, 'divider' ) == 0 && $depth > 0 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} elseif ( strcasecmp( $item->attr_title, 'dropdown-header' ) == 0 && $depth > 0 ) {
			$output .= $indent . '<li role="presentation" class="dropdown-header">' . $item->title;
		} elseif ( strcasecmp( $item->attr_title, 'disabled' ) == 0 ) {
			$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . $item->title . '</a>';
		} else {
			$class_names = $value = '';
			$classes     = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[]   = 'menu-item-' . $item->ID;
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
			if ( $args->has_children ) {
				$class_names .= ' has-sub';
			}
			if ( in_array( 'current-menu-item', $classes ) ) : $class_names .= ' active'; endif;
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
			$id          = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
			$id          = $id ? ' id="' . esc_attr( $id ) . '"' : '';
			$output .= $indent . '<li' . $id . $value . $class_names . '>';
			$atts           = array();
			$atts['title']  = ! empty( $item->title ) ? $item->title : '';
			$atts['target'] = ! empty( $item->target ) ? $item->target : '';
			$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';

			// If item has_children add atts to a.
			if ( $args->has_children ) :
				$atts['href']          = ! empty( $item->url ) ? $item->url : '#';
				$atts['class']         = 'dropdown-toggle';
				$atts['aria-haspopup'] = 'true';
			else :
				$atts['href'] = ! empty( $item->url ) ? $item->url : '#';
			endif;
			$atts       = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					if ( ( $brainwave['menu-scroll'] == '1' )
					     && ( $brainwave['onepage'] )
					     && ( get_option( 'show_on_front' ) !== 'posts' )
					     && ( $item->type != 'custom' )
					     && ( get_post_meta( $item->object_id, 'show_in_onepage', true ) != '' )
					) {
						if ( 'href' === $attr ) {
							$value = esc_url( trailingslashit( get_bloginfo( 'url' ) ) . '#' . get_post( $item->object_id )->post_name );
							// $value = '#' . get_post( $item->object_id )->post_name;
						}
					}
					$attributes .= ' ' . $attr . '="' . esc_attr( $value ) . '"';
				}
			}
			$item_output = $args->before;
			/*
			 * Glyphicons
			 * ===========
			 * Since the the menu item is NOT a Divider or Header we check the see
			 * if there is a value in the attr_title property. If the attr_title
			 * property is NOT null we apply it as the class name for the glyphicon.
			 */
			if ( ( $brainwave['menu-scroll'] == '1' )
			     && ( $brainwave['onepage'] )
			     && ( get_option( 'show_on_front' ) !== 'posts' )
			     && ( $item->type != 'custom' )
			     && ( get_post_meta( $item->object_id, 'show_in_onepage', true ) != '' )
			) {
				if ( ! is_front_page() ) {
					if ( $brainwave['ajax-pages'] && ( $item->type != 'custom' ) ) {
						$attributes .= 'class="single-page-load" data-title="' . esc_attr( get_bloginfo( 'name' ) . ' | ' . apply_filters( 'the_title', $item->title, $item->ID ) ) . '" ';
					}
				}
				if ( ! empty( $item->attr_title ) ) {
					$item_output .= '<a ' . $attributes . '><span class="glyphicon ' . esc_attr( $item->attr_title ) . '"></span>&nbsp;';
				} else {
					$item_output .= '<a ' . $attributes . '>';
				}
			} else {
				if ( ! empty( $item->attr_title ) ) {
					if ( $brainwave['ajax-pages'] && ( $item->type != 'custom' ) ) {
						$item_output .= '<a class="single-page-load" data-title="' . esc_attr( get_bloginfo( 'name' ) . ' | ' . apply_filters( 'the_title', $item->title, $item->ID ) ) . '" ' . $attributes . '><span class="glyphicon ' . esc_attr( $item->attr_title ) . '"></span>&nbsp;';
					} else {
						$item_output .= '<a ' . $attributes . '><span class="glyphicon ' . esc_attr( $item->attr_title ) . '"></span>&nbsp;';
					}
				} else {
					if ( $brainwave['ajax-pages'] && ( $item->type != 'custom' ) ) {
						$item_output .= '<a class="single-page-load" data-title="' . esc_attr( get_bloginfo( 'name' ) . ' | ' . apply_filters( 'the_title', $item->title, $item->ID ) ) . '" ' . $attributes . '>';
					} else {
						$item_output .= '<a ' . $attributes . '>';
					}
				}
			}

			if ( ! empty( $item->title ) ) {
				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			} else {
				$item_output .= $args->link_before . apply_filters( 'the_title', $item->post_title, $item->ID ) . $args->link_after;
			}
			if ( $depth === 0 ) {
				$item_output .= ( $args->has_children ) ? ' <i class="fa fa-angle-down"></i></a>' : '</a>';
			} else {
				$item_output .= ( $args->has_children ) ? ' <i class="fa fa-angle-down pull-right"></i></a>' : '</a>';
			}
			$item_output .= $args->after;
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}

	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth.
	 *
	 * This method shouldn't be called directly, use the walk() method instead.
	 *
	 * @see Walker::start_el()
	 * @since 2.5.0
	 *
	 * @param object $element Data object
	 * @param array $children_elements List of elements to continue traversing.
	 * @param int $max_depth Max depth to traverse.
	 * @param int $depth Depth of current element.
	 * @param array $args
	 * @param string $output Passed by reference. Used to append additional content.
	 *
	 * @return null Null on failure with no changes to parameters.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
		if ( ! $element ) : return; endif;
		$id_field = $this->db_fields['id'];
		// Display this element.
		if ( is_object( $args[0] ) ) :
			$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
		endif;
		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}


}
