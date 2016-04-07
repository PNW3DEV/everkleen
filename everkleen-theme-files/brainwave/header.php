<?php global $brainwave; ?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php wp_title(); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
	<link rel="alternate" type="application/rss+xml" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
	      href="<?php esc_url( get_feed_link() ); ?>">
</head>
<?php get_template_part( 'templates/customize' ); ?>
<body <?php body_class( array( 'load' ) ); ?> >
<div class="wrapper">
	<header>
		<?php
		get_template_part( 'templates/menu' );

		if ( is_single() || is_page() ) :
			echo bw_build_header( get_the_ID() );
		else :
			?>
			<div class="page-header background-fixed"
			     data-background="<?php echo ( ! empty( $brainwave['bg-img']['url'] ) ) ? esc_attr( $brainwave['bg-img']['url'] ) : '' ?>"
			     data-overlay-color="<?php echo esc_attr( $brainwave['bg-color'] ); ?>"
			     data-overlay-opacity="<?php echo esc_attr( $brainwave['bg-opacity'] ); ?>">
				<h1 class="text-uppercase">
					<?php echo bw_title(); ?>
				</h1>
			</div><!-- .page-header -->
			<?php
		endif;

		//Creative Header
		bw_get_creative_header( get_the_ID() );
		?>
	</header>
