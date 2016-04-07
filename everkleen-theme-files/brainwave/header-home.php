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
		if ( get_option( 'page_for_posts' ) ) {
			echo bw_build_header( get_option( 'page_for_posts' ) );
		} else {
			?>
			<div class="page-header background-fixed " data-background-color="#191919"
			     data-background="<?php echo ( ! empty( $brainwave['bg-img']['url'] ) ) ? esc_attr( $brainwave['bg-img']['url'] ) : '' ?>"
			     data-overlay-color="<?php echo esc_attr( $brainwave['bg-color'] ); ?>"
			     data-overlay-opacity="<?php echo esc_attr( $brainwave['bg-opacity'] ); ?>">
				<div class="container">
					<div class="col-sm-12">
						<div class="text-center">
							<h1 class="text-uppercase ls-030 fw-100 " data-color="#ffffff" data-border-color="#ffffff">
								<?php echo bw_title(); ?>
							</h1>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
		?>
	</header>

	<?php
	switch ( $brainwave['layout'] ) {
		case '1':
			echo '<div class="container page-section">';
			echo '<div class="post-list col-sm-12" role="main">';
			break;
		case '2':
			echo '<div class="container page-section">';
			echo '<div class="post-list col-sm-9" role="main">';
			break;
		case '3':
			echo '<div class="container page-section">';
			echo '<aside class="sidebar col-sm-3" role="complementary">';
			dynamic_sidebar( 'sidebar-left' );
			echo '</aside>';
			echo '<div class="post-list col-sm-9" role="main">';
			break;
		case '4':
			echo '<div class="container page-section">';
			echo '<aside class="sidebar col-sm-3" role="complementary">';
			dynamic_sidebar( 'sidebar-left' );
			echo '</aside>';
			echo '<div class="post-list col-sm-6" role="main">';
			break;
		default:
			break;
	}
	?>
