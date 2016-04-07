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
		echo bw_build_header( woocommerce_get_page_id( 'shop' ) );
		?>
	</header>
