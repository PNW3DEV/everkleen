<?php global $brainwave; ?>
</div>
<div class="page-loader">
	<?php echo build_preloader(); ?>
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
