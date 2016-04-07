<?php global $brainwave; ?>
<article <?php post_class(); ?> >
	<header>
		<h2 class="entry-title">
			<?php if ( $brainwave['ajax-pages'] ) : ?>
				<a class="single-page-load"
				   data-title="<?php echo esc_attr( get_bloginfo( 'name' ) . ' | ' . get_the_title() ); ?>"
				   href="<?php echo esc_url( get_permalink() ); ?>"
				   title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a>
			<?php else : ?>
				<a href="<?php echo esc_url( get_permalink() ); ?>"
				   title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a>
			<?php endif; ?>
		</h2>

		<?php
		get_template_part( 'templates/entry-meta' );
		if ( has_post_thumbnail() ) {
			echo '<div class="thumbnail">';
			the_post_thumbnail();
			echo '</div>';
		}
		bw_show_gallery( $post );
		?>
	</header>
	<div class="entry-summary">
		<?php
		the_excerpt();
		if ( $brainwave['ajax-pages'] ) {
			echo '<p></p><a class="btn btn-default btn-sm single-page-load" data-title="' . esc_attr( get_bloginfo( 'name' ) . ' | ' . get_the_title() ) . '" href="' . esc_url( get_permalink() ) . '">' . __( 'Continue', 'brainwave' ) . ' <i class="fa fa-angle-right"></i></a>';
		} else {
			echo '<p></p><a class="btn btn-default btn-sm" href="' . esc_url( get_permalink() ) . '">' . __( 'Continue', 'brainwave' ) . ' <i class="fa fa-angle-right"></i></a>';
		}
		?>
	</div>
</article>
