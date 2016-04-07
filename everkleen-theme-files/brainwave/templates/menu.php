<?php
global $brainwave;
if ( ( $brainwave['menu-var'] == '2' ) || ( $brainwave['menu-var'] == '3' ) ) :
	?>
	<div class="brand-container-top-wrapper">
		<?php if ( $brainwave['ajax-pages'] ) : ?>
			<a class="brand-container-top" href="<?php echo esc_url( home_url() ); ?>"
			   data-title="<?php esc_attr( get_bloginfo( 'name' ) ); ?>">
				<img src="<?php echo esc_url( $brainwave['logo-img']['url'] ); ?>" alt=""
				     data-title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
			</a>
		<?php else : ?>
			<a class="brand-container-top" href="<?php echo esc_url( home_url() ); ?>">
				<img src="<?php echo esc_url( $brainwave['logo-img']['url'] ); ?>" alt="">
			</a>
		<?php endif; ?>
	</div>
	<?php
endif;

$classes = 'navigation default light ';

if ( $brainwave['menu-var'] == '2' ) {
	$classes .= ' style-2 navbar-fixed-top';
} else if ( $brainwave['menu-var'] == '3' ) {
	$classes .= ' style-3 navbar-fixed-top ';
} else {
	if ( $brainwave['menu-hide'] ) {
		$classes .= ' hide-on-scroll ';
	}
	if ( $brainwave['menu-fixed'] ) {
		$classes .= ' navbar-fixed-top ';
	}
}
echo '<div class="' . esc_attr( $classes ) . '">';
echo '<nav role="navigation">';

?>

<?php
if ( $brainwave['menu-var'] == '1' ) :
	if ( $brainwave['ajax-pages'] ) :
		?>
		<a class="navbar-brand" href="<?php echo esc_url( home_url() ); ?>"
		   data-title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
			<img
				src="<?php echo ( ! empty( $brainwave['logo-img']['url'] ) ) ? esc_url( $brainwave['logo-img']['url'] ) : ''; ?>"
				alt="" data-title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
		</a>
	<?php else : ?>
		<a class="navbar-brand" href="<?php echo esc_url( home_url() ); ?>">
			<img src="<?php echo esc_url( $brainwave['logo-img']['url'] ); ?>" alt="">
		</a>
		<?php
	endif;
endif;
?>

<button type="button" class="navbar-toggle collapsed">
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span
		class="title"><?php echo ( $brainwave['menu-var'] != '3' ) ? __( 'Menu', 'brainwave' ) : __( 'Close', 'brainwave' ); ?></span>
</button>

<?php if ( $brainwave['menu-var'] == '3' ) : ?>
<div class="full-height-wrapper">
	<div class="table">
		<div class="table-cell">
			<?php endif; ?>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary_navigation',
					'menu_class'     => 'clearfix',
					'fallback_cb'    => 'bw_page_menu',
					'container'      => '',
					'walker'         => new BW_Navwalker(),
				)
			);
			?>

			<?php if ( $brainwave['menu-var'] == '3' ) : ?>
		</div>
	</div>
</div>
<?php endif; ?>

</nav>
</div>
