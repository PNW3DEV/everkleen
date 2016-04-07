<?php global $brainwave; ?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php wp_title(); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
	<link rel="alternate" type="application/rss+xml" title="<?php esc_attr( get_bloginfo( 'name' ) ); ?>"
	      href="<?php esc_url( get_feed_link() ); ?>">
</head>
<?php get_template_part( 'templates/customize' ); ?>
<body <?php body_class( array( 'load' ) ); ?> >
<div class="wrapper">
	<header>
		<?php
		if ( has_post_thumbnail() ) {
			$header_bg_image = wp_get_attachment_url( get_post_thumbnail_id() );
		}
		?>
		<?php get_template_part( 'templates/menu' ); ?>
		<div class="page-header " data-background="<?php echo esc_attr( $header_bg_image ); ?>"
		     data-overlay-color="#000000" data-overlay-opacity="0.9">
			<div class="container">
				<div class="col-sm-12">
					<div class="text-center">
						<h1 class="text-uppercase ls-030 fw-100 " data-color="#ffffff"
						    data-border-color=""><?php echo bw_title(); ?></h1>
						<?php woocommerce_breadcrumb(); ?>
					</div>
				</div>
			</div>
		</div>
	</header>
