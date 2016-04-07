<?php
global $brainwave;
switch ( $brainwave['layout'] ) {
	case '1':
		echo '</div>';
		echo '</div>';
		break;
	case '2':
		echo '</div>';
		echo '<aside class="sidebar col-sm-3" role="complementary">';
		dynamic_sidebar( 'sidebar-primary' );
		echo '</aside>';
		echo '</div>';
		break;
	case '3':
		echo '</div>';
		echo '</div>';
		break;
	case '4':
		echo '</div>';
		echo '<aside class="sidebar col-sm-3" role="complementary">';
		dynamic_sidebar( 'sidebar-primary' );
		echo '</aside>';
		echo '</div>';
		break;
	default:
		break;
}
?>
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
