<?php global $brainwave; ?>
</div>
</div>
</div>

<div class="page-section bg-section" data-background="" data-overlay-color="#ffffff" data-overlay-opacity="0.9">
	<div class="text-center">
		<h3 class="text-uppercase"><?php _e( 'Like Our Works?', 'brainwave' ); ?></h3>
		<a href="<?php echo esc_url( $brainwave['services_link'] ); ?>" type="button"
		   class="btn btn-primary single-page-load"
		   data-title="<?php echo esc_attr( get_bloginfo( 'name' ) . ' | ' . __( 'Services', 'brainwave' ) ); ?>"><?php _e( 'View Services', 'brainwave' ); ?></a>
		<a href="<?php echo esc_url( $brainwave['contacts_link'] ); ?>" type="button"
		   class="btn btn-default single-page-load"
		   data-title="<?php echo esc_attr( get_bloginfo( 'name' ) . ' | ' . __( 'Contacts', 'brainwave' ) ); ?>"><?php _e( 'Start Project', 'brainwave' ); ?></a>
	</div>
</div>

<div class="work-navigation footer clearfix">
	<div class="row">
		<div class="col-xs-4 text-left">
			<?php if ( get_previous_post() ) : ?>
				<a href="<?php echo esc_url( get_permalink( get_previous_post()->ID ) ); ?>"
				   class="work-prev single-page-load"
				   data-title="<?php echo esc_attr( get_bloginfo( 'name' ) . ' | ' . get_the_title( get_previous_post()->ID ) ); ?>"><i
						class="fa fa-angle-left"></i>&nbsp;<?php _e( 'Previous', 'brainwave' ); ?></a>
			<?php endif; ?>
		</div>
		<div class="col-xs-4 text-center">
			<a href="<?php echo esc_url( $brainwave['portfolio_link'] ); ?>" class="work-all single-page-load"
			   data-title="<?php echo esc_attr( get_bloginfo( 'name' ) . ' | ' . __( 'Portfolio', 'brainwave' ) ); ?>"><?php _e( 'All works', 'brainwave' ); ?></a>
		</div>
		<div class="col-xs-4 text-right">
			<?php if ( get_next_post() ) : ?>
				<a href="<?php echo esc_url( get_permalink( get_next_post()->ID ) ); ?>"
				   class="work-next single-page-load"
				   data-title="<?php echo esc_attr( get_bloginfo( 'name' ) . ' | ' . get_the_title( get_next_post()->ID ) ); ?>"><?php _e( 'Next', 'brainwave' ); ?>
					&nbsp;<i class="fa fa-angle-right"></i></a>
			<?php endif; ?>
		</div>
	</div>
</div>
</div>

<div class="page-loader">
	<div class="preloader loading">
		<span class="slice"></span>
		<span class="slice"></span>
		<span class="slice"></span>
		<span class="slice"></span>
		<span class="slice"></span>
		<span class="slice"></span>
	</div>
</div>

<footer class="site-footer pos-relative">
	<div class="container">
		<?php dynamic_sidebar( 'sidebar-footer' ); ?>
	</div>

	<div class="copyright">
		<div
			class="company text-center text-uppercase">&copy; <?php echo esc_html( $brainwave['footer-company'] ) . ' ' . date( 'Y' ); ?></div>
		<div class="text-center"><?php echo esc_html( $brainwave['footer-additional'] ); ?></div>
	</div>  <!-- .copyright -->
</footer>
<?php if ( ! empty( $brainwave['back-to-top'] ) ) : if ( $brainwave['back-to-top'] ) : ?>
	<a href="#" class="scroll-to-top"> <i class="fa fa-angle-up"></i> </a>
<?php endif; endif; ?>
<?php wp_footer(); ?>
</body>
</html>
