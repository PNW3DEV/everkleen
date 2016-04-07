<?php

// Social Widget
class BW_Social_Icons extends WP_Widget {

	function __construct() {
		// Instantiate the parent object
		parent::__construct( 'BW_Social_Icons', __( 'Brainwave Social Icons', 'brainwave' ) );
	}

	function widget( $args, $instance ) {
		global $brainwave;

		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		echo '<div class="text-center">';
		foreach ( $brainwave['social-icons'] as $key => $value ) {
			echo '<a href="' . esc_url( $brainwave['social-icons'][ $key ]['url'] ) . '" class="bw-social ' . esc_attr( $instance['theme'] ) . '">';
			echo '<i class="fa ' . esc_attr( $brainwave['social-icons'][ $key ]['select'] ) . '"></i>';
			echo '</a>';
		}
		echo '</div>';
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance['theme'] = ( ! empty( $new_instance['theme'] ) ) ? strip_tags( $new_instance['theme'] ) : '';

		return $instance;
		// Save widget options
	}

	function form( $instance ) {
		if ( isset( $instance['theme'] ) ) {
			$theme = $instance['theme'];
		} else {
			$theme = '';
		}
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'theme' ) ); ?>">
				<?php _e( 'Icons Theme:', 'brainwave' ); ?>
			</label>
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'theme' ) ); ?>"
			        name="<?php echo esc_attr( $this->get_field_name( 'theme' ) ); ?>">
				<option <?php selected( $theme, 'light' ); ?> value='light'>Light</option>
				<option <?php selected( $theme, 'dark' ); ?> value='dark'>Dark</option>
			</select>
		</p>
		<?php
	}
}

function bw_register_widgets() {
	register_widget( 'BW_Social_Icons' );
}

add_action( 'widgets_init', 'bw_register_widgets' );

?>
