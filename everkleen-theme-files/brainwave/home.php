<?php
global $brainwave;
get_header( 'home' );

$sticky = get_option( 'sticky_posts' );
if ( $sticky ) {
	$args = array(
		'post__in'       => $sticky,
		'posts_per_page' => get_option( 'posts_per_page' ),
		'post_type'      => 'post'
	);
	$sq   = new WP_Query( $args );
	if ( $sq->have_posts() ) {
		while ( $sq->have_posts() ) {
			$sq->the_post();
			get_template_part( 'templates/excerpt' );
		}
	}
	$sq_count  = $sq->post_count;
	$num_posts = $sq_count - get_option( 'posts_per_page' );
} else {
	$num_posts = get_option( 'posts_per_page' );
}

$args = array(
	'post__not_in'   => $sticky,
	'posts_per_page' => $num_posts,
	'post_type'      => 'post',
	'paged'          => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,
);
$nq   = new WP_Query( $args );
if ( $nq->have_posts() ) {
	while ( $nq->have_posts() ) {
		$nq->the_post();
		get_template_part( 'templates/excerpt' );
	}
} else {
	?>
	<div class="alert alert-warning">
		<?php _e( 'Sorry, no results were found.', 'brainwave' ); ?>
	</div>
	<?php
	get_search_form( false );
}

if ( $wp_query->max_num_pages > 1 ) :
	if ( $brainwave['paging'] == '2' ) :
		?>
		<nav>
			<ul class="pager">
				<?php
				$page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				if ( $page != 1 ) :
					echo '<li class="previous">';
					if ( $brainwave['ajax-pages'] ) :
						?>
						<a href="<?php echo esc_url( get_previous_posts_page_link() ); ?>" class="single-page-load"
						   data-title="<?php echo esc_attr( get_bloginfo( 'name' ) . ' | ' . get_the_title() ); ?>"><span
								aria-hidden="true"><i
									class="fa fa-angle-left"></i></span> <?php _e( 'Older', 'brainwave' ); ?></a>
						<?php
					else :
						?>
						<a href="<?php echo esc_url( get_previous_posts_page_link() ); ?>"
						   data-title="<?php echo esc_attr( get_bloginfo( 'name' ) . ' | ' . get_the_title() ); ?>"><span
								aria-hidden="true"><i
									class="fa fa-angle-left"></i></span> <?php _e( 'Older', 'brainwave' ); ?></a>
						<?php
					endif;
					echo '</li>';
				endif;

				if ( get_next_posts_page_link( $wp_query->max_num_pages ) ) :
					echo '<li class="next">';
					if ( $brainwave['ajax-pages'] ) :
						?>
						<a href="<?php echo esc_url( get_next_posts_page_link( $wp_query->max_num_pages ) ); ?>"
						   class="single-page-load"
						   data-title="<?php echo esc_attr( get_bloginfo( 'name' ) . ' | ' . get_the_title() ); ?>"><?php _e( 'Newer', 'brainwave' ); ?>
							<span aria-hidden="true"><i class="fa fa-angle-right"></i></span></a>
						<?php
					else :
						?>
						<a href="<?php echo esc_url( get_next_posts_page_link( $wp_query->max_num_pages ) ); ?>"
						   data-title="<?php echo esc_attr( get_bloginfo( 'name' ) . ' | ' . get_the_title() ); ?>"><?php _e( 'Newer', 'brainwave' ); ?>
							<span aria-hidden="true"><i class="fa fa-angle-right"></i></span></a>
						<?php
					endif;
					echo '</li>';
				endif;
				?>
			</ul>
		</nav>
		<?php
	else :
		?>
		<nav>
			<ul class="pagination">
				<?php
				$page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				if ( $page != 1 ) :
					echo '<li class="previous">';
					if ( $brainwave['ajax-pages'] ) :
						?>
						<a href="<?php echo esc_url( get_previous_posts_page_link() ); ?>" class="single-page-load"
						   data-title="<?php echo esc_attr( get_bloginfo( 'name' ) . ' | ' . get_the_title() ); ?>"><span
								aria-hidden="true"><i class="fa fa-angle-left"></i></span></a>
						<?php
					else :
						?>
						<a href="<?php echo esc_url( get_previous_posts_page_link() ); ?>"
						   data-title="<?php echo esc_attr( get_bloginfo( 'name' ) . ' | ' . get_the_title() ); ?>"><span
								aria-hidden="true"><i class="fa fa-angle-left"></i></span></a>
						<?php
					endif;
					echo '</li>';
				endif;
				?>
				<?php
				$args       = array(
					'prev_next' => false,
					'type'      => 'array',
				);
				$page       = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				$pagination = paginate_links( $args );
				foreach ( $pagination as $key => $value ) {
					echo ( ( $key + 1 ) === $page ) ? '<li class="active">' : '<li>';
					$cur_page = $key + 1;
					echo '<a href="?page_id=' . esc_attr( get_option( 'page_for_posts' ) ) . '&paged=' . esc_attr( $cur_page ) . '"  class="single-page-load" data-title="' . esc_attr( get_bloginfo( 'name' ) . ' | ' . get_the_title() ) . '">' . $cur_page . '</a>';
					echo '</li>';
				}
				if ( get_next_posts_page_link( $wp_query->max_num_pages ) ) :
					echo '<li class="next">';
					if ( $brainwave['ajax-pages'] ) :
						?>
						<a href="<?php echo esc_url( get_next_posts_page_link( $wp_query->max_num_pages ) ); ?>"
						   class="single-page-load"
						   data-title="<?php echo esc_attr( get_bloginfo( 'name' ) . ' | ' . get_the_title() ); ?>"><span
								aria-hidden="true"><i class="fa fa-angle-right"></i></span></a>
						<?php
					else :
						?>
						<a href="<?php echo esc_url( get_next_posts_page_link( $wp_query->max_num_pages ) ); ?>"
						   data-title="<?php echo esc_attr( get_bloginfo( 'name' ) . ' | ' . get_the_title() ); ?>"><span
								aria-hidden="true"><i class="fa fa-angle-right"></i></span></a>
						<?php
					endif;
					echo '</li>';
				endif;
				?>
			</ul>
		</nav>
		<?php
	endif;
endif;
?>
<?php get_footer( 'post' ); ?>
