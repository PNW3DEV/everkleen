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

	<header id="home">

		<?php

		get_template_part( 'templates/menu' );

		$menu_name = 'primary_navigation';
		if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
			$menu       = wp_get_nav_menu_object( $locations[ $menu_name ] );
			$menu_items = wp_get_nav_menu_items( $menu->term_id );
			if ( $menu_items ) {
				foreach ( $menu_items as $key => $cur_page ) {
					if ( ( $cur_page->object_id !== get_option( 'page_on_front' ) ) && ( $cur_page->type !== 'custom' ) && ( get_post_meta( $cur_page->object_id, 'show_in_onepage', true ) != '' ) ) {
						$first_article = '#' . get_post( $cur_page->object_id )->post_name;
						break;
					} else {
						$first_article = '#';
					}
				}
			} else {
				$first_article = '#';
			}
		} else {
			$pages = get_pages();
			foreach ( $pages as $page ) {
				if ( ( $page->ID !== get_option( 'page_on_front' ) ) && ( get_post_meta( $page->ID, 'show_in_onepage', true ) != '' ) ) {
					$first_article = '#' . get_post( $page->ID )->post_name;
					break;
				} else {
					$first_article = '#';
				}
			}
		}

		switch ( $brainwave['header-var'] ) {
			case 'home1':
				$slides = 0;
				?>
				<div id="slides" class="home-slider">
					<div class="slides-container">
						<?php
						if ( isset( $brainwave['home1'] ) ) :
							foreach ( $brainwave['home1'] as $key => $slide ) {
								$slides ++;
								?>
								<div class="slide"
								     data-overlay-color="<?php echo esc_attr( $brainwave['header-color'] ); ?>"
								     data-overlay-opacity="<?php echo esc_attr( $brainwave['header-opacity'] ); ?>">
									<img src="<?php echo esc_url( $slide['image'] ); ?>" alt="">
									<div class="content">
										<div class="display-tc">
											<?php echo apply_filters( 'the_content', $slide['description'] ); ?>
										</div>
									</div>
								</div>
								<?php
							}
						endif;
						?>
					</div>
					<?php if ( $slides > 1 ) : ?>
						<nav class="slides-navigation">
							<a href="#" class="prev"><i class="fa fa-angle-left"></i></a>
							<a href="#" class="next"><i class="fa fa-angle-right"></i></a>
						</nav>
					<?php endif; ?>
				</div>
				<div class="scroll-btn-wrapper">
					<a href="<?php echo esc_url( $first_article ); ?>" class="scroll-down scrollTo"><img
							src="<?php echo esc_url( get_template_directory_uri() . '/dist/img/mouse.png' ); ?>"
							alt=""><?php _e( 'Scroll Down', 'brainwave' ); ?></a>
				</div>
				<?php
				break;
			case 'home2':
				$slides = 0;
				?>
				<div id="slides" class="home-slider slider-2">
					<div class="slides-container">
						<?php
						if ( isset( $brainwave['home2'] ) ) :
							foreach ( $brainwave['home2'] as $key => $slide ) {
								$slides ++;
								?>
								<div class="slide"
								     data-overlay-color="<?php echo esc_attr( $brainwave['header-color'] ); ?>"
								     data-overlay-opacity="<?php echo esc_attr( $brainwave['header-opacity'] ); ?>">
									<img src="<?php echo esc_url( $slide['image'] ); ?>" alt="">
									<div class="content">
										<div class="display-tc">
											<div class="text-container text-center">
												<div class="top">
													<div class="lines"></div>
												</div>
												<div class="background-container">
													<div class="text text-uppercase">
														<?php echo esc_html( $slide['title'] ); ?>
													</div>
												</div>
												<div class="bottom">
													<div class="lines"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php
							}
						endif;
						?>

					</div>
					<?php if ( $slides > 1 ) : ?>
						<nav class="slides-navigation">
							<a href="#" class="prev"><i class="fa fa-angle-left"></i></a>
							<a href="#" class="next"><i class="fa fa-angle-right"></i></a>
						</nav>
					<?php endif; ?>
				</div>
				<div class="scroll-btn-wrapper">
					<a href="<?php echo esc_url( $first_article ); ?>" class="scroll-down scrollTo"><img
							src="<?php echo esc_url( get_template_directory_uri() . '/dist/img/mouse.png' ); ?>"
							alt=""><?php _e( 'Scroll Down', 'brainwave' ); ?></a>
				</div>

				<?php
				break;
			case 'video':
				$slides = 0;
				?>
				<!-- Video BG Init -->
				<div class="videobg"
				     data-background="<?php echo ( ! empty( $brainwave['video-imagebg']['url'] ) ) ? esc_attr( $brainwave['video-imagebg']['url'] ) : ''; ?>"
				     data-overlay-color="<?php echo esc_attr( $brainwave['header-color'] ); ?>"
				     data-overlay-opacity="<?php echo esc_attr( $brainwave['header-opacity'] ); ?>">
					<?php
					$html = '';
					$html .= '<video id="video_background" preload="auto" autoplay="autoplay" loop="true"';
					$html .= 'style="display:none;position:fixed;top:0;left:0;bottom:0;right:0;z-index:-100;width:100%;height:100%;">';
					$html .= '<source src="' . esc_url( $brainwave['videobg']['url'] ) . '" type="video/mp4" />';
					$html .= '</video>';
					echo $html;

					?>
				</div>

				<div id="slides" class="home-slider video">
					<div class="slides-container">
						<?php
						if ( isset( $brainwave['slider'] ) ) :
							foreach ( $brainwave['slider'] as $key => $slide ) {
								$slides ++;
								?>
								<div class="slide">
									<?php if ( ! empty( $slide['image'] ) ) : ?>
										<img src="<?php echo esc_url( $slide['image'] ); ?>" alt="">
									<?php endif; ?>
									<div class="content">
										<div class="display-tc">
											<?php echo apply_filters( 'the_content', $slide['description'] ); ?>
										</div>
									</div>
								</div>
								<?php
							}
						endif;
						?>

					</div>
					<?php if ( $slides > 1 ) : ?>
						<nav class="slides-navigation">
							<a href="#" class="prev"><i class="fa fa-angle-left"></i></a>
							<a href="#" class="next"><i class="fa fa-angle-right"></i></a>
						</nav>
					<?php endif; ?>
				</div>
				<div class="scroll-btn-wrapper">
					<a href="<?php echo esc_url( $first_article ); ?>" class="scroll-down scrollTo"><img
							src="<?php echo esc_url( get_template_directory_uri() . '/dist/img/mouse.png' ); ?>"
							alt=""><?php _e( 'Scroll Down', 'brainwave' ); ?></a>
				</div>
				<?php
				break;
			case 'video2':
				$slides = 0;
				?>
				<!-- Video BG Init -->
				<div class="videobg"
				     data-background="<?php echo ( ! empty( $brainwave['video-imagebg']['url'] ) ) ? esc_attr( $brainwave['video-imagebg']['url'] ) : ''; ?>"
				     data-overlay-color="<?php echo esc_attr( $brainwave['header-color'] ); ?>"
				     data-overlay-opacity="<?php echo esc_attr( $brainwave['header-opacity'] ); ?>">
					<?php
					$html = '';
					$html .= '<video id="video_background" preload="auto" autoplay="autoplay" loop="true"';
					$html .= 'style="display:none;position:fixed;top:0;left:0;bottom:0;right:0;z-index:-100;width:100%;height:100%;">';
					$html .= '<source src="' . esc_url( $brainwave['videobg']['url'] ) . '" type="video/mp4" />';
					$html .= '</video>';
					echo $html;

					?>
				</div>

				<div id="slides" class="home-slider video slider-2">
					<div class="slides-container">
						<?php
						if ( isset( $brainwave['home2'] ) ) :
							foreach ( $brainwave['home2'] as $key => $slide ) {
								$slides ++;
								?>
								<div class="slide">
									<div class="content">
										<div class="display-tc">
											<div class="text-container text-center">
												<div class="top">
													<div class="lines"></div>
												</div>
												<div class="background-container">
													<div class="text text-uppercase">
														<?php echo esc_html( $slide['title'] ); ?>
													</div>
												</div>
												<div class="bottom">
													<div class="lines"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php
							}
						endif;
						?>

					</div>
					<?php if ( $slides > 1 ) : ?>
						<nav class="slides-navigation">
							<a href="#" class="prev"><i class="fa fa-angle-left"></i></a>
							<a href="#" class="next"><i class="fa fa-angle-right"></i></a>
						</nav>
					<?php endif; ?>
				</div>
				<div class="scroll-btn-wrapper">
					<a href="<?php echo esc_url( $first_article ); ?>" class="scroll-down scrollTo"><img
							src="<?php echo esc_url( get_template_directory_uri() . '/dist/img/mouse.png' ); ?>"
							alt=""><?php _e( 'Scroll Down', 'brainwave' ); ?></a>
				</div>
				<?php
				break;
			case 'image':
				$slides = 0;
				?>
				<!-- Image BG -->
				<div class="image-bg" data-background="<?php echo esc_attr( $brainwave['imagebg']['url'] ); ?>"
				     data-overlay-color="<?php echo esc_attr( $brainwave['header-color'] ); ?>"
				     data-overlay-opacity="<?php echo esc_attr( $brainwave['header-opacity'] ); ?>"></div>
				<!-- End Image BG -->

				<div id="slides" class="home-slider image">
					<div class="slides-container">
						<?php
						if ( isset( $brainwave['slider'] ) ) :
							foreach ( $brainwave['slider'] as $key => $slide ) {
								$slides ++;
								?>
								<div class="slide">
									<div class="content">
										<div class="display-tc">
											<?php echo apply_filters( 'the_content', $slide['description'] ); ?>
										</div>
									</div>
								</div>
								<?php
							}
						endif;
						?>

					</div>
					<?php if ( $slides > 1 ) : ?>
						<nav class="slides-navigation">
							<a href="#" class="prev"><i class="fa fa-angle-left"></i></a>
							<a href="#" class="next"><i class="fa fa-angle-right"></i></a>
						</nav>
					<?php endif; ?>
				</div>
				<div class="scroll-btn-wrapper">
					<a href="<?php echo esc_url( $first_article ); ?>" class="scroll-down scrollTo"><img
							src="<?php echo esc_url( get_template_directory_uri() . '/dist/img/mouse.png' ); ?>"
							alt=""><?php _e( 'Scroll Down', 'brainwave' ); ?></a>
				</div>
				<?php
				break;
			default:
				# code...
				break;
		}
		?>

	</header>
