<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Recent Reviews Widget
 *
 * @author   ScienateCraft
 * @category Widgets
 * @extends  WC_Widget
 */
if ( class_exists( 'WC_Query' ) ) {

	class BW_Widget_Recent_Reviews extends WC_Widget {

		/**
		 * Constructor
		 */
		public function __construct() {
			$this->widget_cssclass    = 'woocommerce widget_recent_reviews';
			$this->widget_description = __( 'Display a list of your most recent reviews on your site.', 'woocommerce' );
			$this->widget_id          = 'woocommerce_recent_reviews';
			$this->widget_name        = __( 'WooCommerce Recent Reviews', 'woocommerce' );
			$this->settings           = array(
				'title'  => array(
					'type'  => 'text',
					'std'   => __( 'Recent Reviews', 'woocommerce' ),
					'label' => __( 'Title', 'woocommerce' )
				),
				'number' => array(
					'type'  => 'number',
					'step'  => 1,
					'min'   => 1,
					'max'   => '',
					'std'   => 10,
					'label' => __( 'Number of reviews to show', 'woocommerce' )
				)
			);

			parent::__construct();
		}

		/**
		 * widget function.
		 *
		 * @see WP_Widget
		 *
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {
			global $comments, $comment;

			if ( $this->get_cached_widget( $args ) ) {
				return;
			}

			ob_start();

			$number   = ! empty( $instance['number'] ) ? absint( $instance['number'] ) : $this->settings['number']['std'];
			$comments = get_comments( array( 'number'      => $number,
			                                 'status'      => 'approve',
			                                 'post_status' => 'publish',
			                                 'post_type'   => 'product'
			) );

			if ( $comments ) {
				$this->widget_start( $args, $instance );

				echo '<ul class="product_list_widget">';

				foreach ( (array) $comments as $comment ) {

					$_product = wc_get_product( $comment->comment_post_ID );

					$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );

					$rating_html = $_product->get_rating_html( $rating );

					echo '<li><div class="pull-left left"><a href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '">';

					echo $_product->get_image();

					echo '</a></div>';

					echo '<div class="pull-right right"><a href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '">';

					echo esc_html( $_product->get_title() ) . '</a>';

					echo $rating_html;

					printf( '<span class="reviewer">' . _x( 'by %1$s', 'by comment author', 'woocommerce' ) . '</span>', get_comment_author() );

					echo '</div><div class="clearfix"></div></li>';
				}

				echo '</ul>';

				$this->widget_end( $args );
			}

			$content = ob_get_clean();

			echo wp_kses( $content, array(
				'a'      => array(
					'href'  => array(),
					'title' => array()
				),
				'br'     => array(),
				'em'     => array(),
				'strong' => array()
			) );

			$this->cache_widget( $args, $content );
		}
	}

	function bw_register_woo_widgets() {
		unregister_widget( 'WC_Widget_Recent_Reviews' );
		register_widget( 'BW_Widget_Recent_Reviews' );
	}

	add_action( 'widgets_init', 'bw_register_woo_widgets' );


}
