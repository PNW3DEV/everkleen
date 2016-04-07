<?php
global $brainwave;

if ( $brainwave['under-construction'] == 1 ) {
	get_template_part( 'templates/under-construction' );
	die();
} else {

	if ( $post->ID === (int) get_option( 'page_on_front' ) ) {
		if ( $brainwave['onepage'] ) {
			$menu_name = 'primary_navigation';
			if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
				$menu       = wp_get_nav_menu_object( $locations[ $menu_name ] );
				$menu_items = wp_get_nav_menu_items( $menu->term_id );

				if ( $menu_items ) {
					get_header( 'onepage' );
					$posts_list = '';
					foreach ( (array) $menu_items as $key => $menu_item ) {
						$post = get_post( $menu_item->object_id );
						if ( ( $menu_item->object_id != get_option( 'page_for_posts' ) )
						     && ( $menu_item->object_id != get_option( 'page_on_front' ) )
						     && ( $menu_item->type != 'custom' )
						     && ( get_post_meta( $menu_item->object_id, 'show_in_onepage', true ) != '' )
						) {
							setup_postdata( $post );
							get_template_part( 'templates/onepage' );
						}
					}
					get_footer();
				} else {
					get_header( 'onepage' );
					$pages = get_pages();
					foreach ( $pages as $page ) {
						$post = get_post( $page->ID );
						if ( get_post_meta( $post->ID, 'show_in_onepage', true ) != '' ) {
							setup_postdata( $post );
							get_template_part( 'templates/onepage' );
						}
					}
					get_footer();
				}
			} else {
				get_header( 'onepage' );
				$pages = get_pages();
				foreach ( $pages as $page ) {
					$post = get_post( $page->ID );
					if ( get_post_meta( $post->ID, 'show_in_onepage', true ) != '' ) {
						setup_postdata( $post );
						get_template_part( 'templates/onepage' );
					}
				}
				get_footer();
			}
		} else {
			get_header();
			get_template_part( 'page' );
			get_footer();
		}

	} else {
		get_template_part( 'home' );
	}
}
?>
