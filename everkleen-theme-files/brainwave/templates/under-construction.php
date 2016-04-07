<?php
get_header( '404' );
global $brainwave;
?>
<div class="not-found under-construction"
     data-background="<?php echo esc_attr( $brainwave['under-construction-img']['url'] ); ?>"
     data-overlay-color="#191919" data-overlay-opacity="0.4">
	<div class="text-center">
		<span class="text-large text-uppercase"><?php _e( 'Sorry', 'brainwave' ); ?></span>
		<span class="text-small"><?php _e( 'We are currently under construction!', 'brainwave' ); ?></span>
	</div>
</div>
<?php get_footer(); ?>
