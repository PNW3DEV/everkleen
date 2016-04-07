<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Recent Reviews Widget
 *
 * @author   ScienteCraft
 * @category Widgets
 * @version  2.3.0
 * @extends  WC_Widget
 */
class BW_Widget_Recent_Posts extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'classname'   => 'widget_recent_entries',
		                     'description' => __( "Your site&#8217;s most recent Posts.", 'brainwave' )
		);
		parent::__construct( 'bw-recent-posts', __( 'Brainwave Recent Posts', 'brainwave' ), $widget_ops );
		$this->alt_option_name = 'widget_recent_entries';

		add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}

	/**
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'widget_recent_posts', 'widget' );
		}

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];

			return;
		}

		ob_start();

		$title = ( ! empty( $instance['title'] ) ) ? esc_html( $instance['title'] ) : __( 'Recent Posts', 'brainwave' );

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
		}
		$show_date      = isset( $instance['show_date'] ) ? esc_html( $instance['show_date'] ) : false;
		$show_thumbnail = isset( $instance['show_thumbnail'] ) ? esc_html( $instance['show_thumbnail'] ) : false;
		/**
		 * Filter the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		) ) );

		if ( $r->have_posts() ) :
			?>
			<?php echo $args['before_widget']; ?>
			<?php if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
			<ul>
				<?php while ( $r->have_posts() ) : $r->the_post(); ?>
					<li class="clearfix">
						<?php if ( ( $show_thumbnail ) && ( has_post_thumbnail( $r->post->ID ) ) ) : ?>
							<?php $thumbnail = wp_get_attachment_url( get_post_thumbnail_id( $r->post->ID ) ); ?>
							<a href="<?php echo esc_url( get_permalink( $r->post->ID ) ); ?>" class="pull-left"><img
									src="<?php echo esc_url( $thumbnail ); ?>" alt="" width="70" height="70"></a>
						<?php endif; ?>
						<div class="widget-posts-descr">
							<a href="<?php echo esc_url( get_permalink( $r->post->ID ) ); ?>"><?php echo ( get_the_title( $r->post->ID ) ) ? get_the_title( $r->post->ID ) : $r->post->ID; ?></a>
							<?php if ( $show_date ) : ?>
								<span
									class="post-date"><?php echo __( 'Posted by', 'brainwave' ) . ' ' . get_the_author_meta( 'user_nicename', $r->post->post_author ) . ' ' . get_the_date( 'd M' ); ?></span>
							<?php endif; ?>
						</div>
					</li>
				<?php endwhile; ?>
			</ul>
			<?php echo $args['after_widget']; ?>
			<?php
			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();

		endif;

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'widget_recent_posts', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}

	/**
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                   = $old_instance;
		$instance['title']          = strip_tags( $new_instance['title'] );
		$instance['number']         = (int) $new_instance['number'];
		$instance['show_date']      = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$instance['show_thumbnail'] = isset( $new_instance['show_thumbnail'] ) ? (bool) $new_instance['show_thumbnail'] : false;
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['widget_recent_entries'] ) ) {
			delete_option( 'widget_recent_entries' );
		}

		return $instance;
	}

	/**
	 * @access public
	 */
	public function flush_widget_cache() {
		wp_cache_delete( 'widget_recent_posts', 'widget' );
	}

	/**
	 * @param array $instance
	 */
	public function form( $instance ) {
		$title          = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number         = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date      = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		$show_thumbnail = isset( $instance['show_thumbnail'] ) ? (bool) $instance['show_thumbnail'] : false;
		?>
		<p><label
				for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'brainwave' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
			       value="<?php echo esc_attr( $title ); ?>"/></p>

		<p><label
				for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php _e( 'Number of posts to show:', 'brainwave' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text"
			       value="<?php echo esc_attr( $number ); ?>" size="3"/></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?>
		          id="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>"
		          name="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>"/>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>"><?php _e( 'Display post date?', 'brainwave' ); ?></label>
		</p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_thumbnail ); ?>
		          id="<?php echo esc_attr( $this->get_field_id( 'show_thumbnail' ) ); ?>"
		          name="<?php echo esc_attr( $this->get_field_name( 'show_thumbnail' ) ); ?>"/>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'show_thumbnail' ) ); ?>"><?php _e( 'Display post thumbnail?', 'brainwave' ); ?></label>
		</p>
		<?php
	}
}

function bw_register_standart_widgets() {
	register_widget( 'BW_Widget_Recent_Posts' );
}

add_action( 'widgets_init', 'bw_register_standart_widgets' );
