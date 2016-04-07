<?php
get_header( '404' );
global $brainwave;
?>

<div class="not-found" data-background="<?php echo esc_attr( $brainwave['page404']['url'] ); ?>"
     data-overlay-color="#191919" data-overlay-opacity="0.4">
	<div class="text-center">
		<span class="text-large">404</span>
		<span class="text-small"><?php _e( 'Page not found', 'brainwave' ); ?></span>
	</div>
</div>

<?php get_footer(); ?>
