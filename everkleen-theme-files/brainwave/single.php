<?php
global $brainwave;
get_header( 'post' );

if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>
		<?php if ( is_page() ) : get_section_bg( $post->ID ); endif; ?>
		<article <?php post_class( 'post' ); ?> >
			<header>
				<h2 class="entry-title"><?php the_title(); ?></h2>
				<?php
				get_template_part( 'templates/entry-meta' );
				bw_show_gallery( $post );
				?>
			</header>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>

			<?php if ( $brainwave['post-nav'] == 1 ) : ?>
				<nav>
					<ul class="pager">
						<?php
						if ( get_previous_post() ) :
							echo '<li class="previous">';
							if ( $brainwave['ajax-pages'] ) :
								?>
								<a href="<?php echo esc_url( get_permalink( get_previous_post()->ID ) ); ?>"
								   class="single-page-load"
								   data-title="<?php echo esc_attr( get_bloginfo( 'name' ) . ' | ' . get_the_title( get_previous_post()->ID ) ); ?>"><span
										aria-hidden="true"><i
											class="fa fa-angle-left"></i></span>&nbsp;&nbsp;<?php echo get_the_title( get_previous_post()->ID ); ?>
								</a>
								<?php
							else :
								?>
								<a href="<?php echo esc_url( get_permalink( get_previous_post()->ID ) ); ?>"
								   data-title="<?php echo esc_attr( get_bloginfo( 'name' ) . ' | ' . get_the_title( get_previous_post()->ID ) ); ?>"><span
										aria-hidden="true"><i
											class="fa fa-angle-left"></i></span>&nbsp;&nbsp;<?php echo get_the_title( get_previous_post()->ID ); ?>
								</a>
								<?php
							endif;
							echo '</li>';
						endif;
						if ( get_next_post() ) :
							echo '<li class="next">';
							if ( $brainwave['ajax-pages'] ) :
								?>
								<a href="<?php echo esc_url( get_permalink( get_next_post()->ID ) ); ?>"
								   class="single-page-load"
								   data-title="<?php echo esc_attr( get_bloginfo( 'name' ) . ' | ' . get_the_title( get_next_post()->ID ) ); ?>"><?php echo get_the_title( get_next_post()->ID ); ?>
									&nbsp;&nbsp;<span aria-hidden="true"><i class="fa fa-angle-right"></i></span></a>
								<?php
							else :
								?>
								<a href="<?php echo esc_url( get_permalink( get_next_post()->ID ) ); ?>"
								   data-title="<?php echo esc_attr( get_bloginfo( 'name' ) . ' | ' . get_the_title( get_next_post()->ID ) ); ?>"><?php echo get_the_title( get_next_post()->ID ); ?>
									&nbsp;&nbsp;<span aria-hidden="true"><i class="fa fa-angle-right"></i></span></a>
								<?php
							endif;
							echo '</li>';
						endif;
						?>
					</ul>
				</nav>
				<?php
			endif;
			comments_template();
			?>
		</article>
		<?php
	endwhile;
else :
	get_template_part( 'templates/empty' );
endif;
get_footer( 'post' );
?>
