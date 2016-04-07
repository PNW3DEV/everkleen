<?php
global $brainwave;
get_header();
?>
<div class="pos-relative row">
	<?php

	$page_size = get_post_meta( $post->ID, 'page_size', true );
	switch ( $page_size ) {
		case 'None':
			$size = '<div class="pos-relative">';
			break;
		case 'Small':
			$size = '<div class="page-section-small">';
			break;
		case 'Normal':
			$size = '<div class="page-section">';
			break;
		default:
			$size = '<div class="page-section">';
			break;
	}

	switch ( $brainwave['pages-layout'] ) {
		case '1':
			echo '<div class="post-list col-sm-12" role="main">';
			echo $size;
			bw_get_section_bg( $post->ID );
			echo '<div class="container">';
			break;
		case '2':
			echo '<div class="post-list col-sm-9" role="main">';
			echo $size;
			bw_get_section_bg( $post->ID );
			echo '<div class="container">';
			break;
		case '3':
			echo '<aside class="sidebar col-sm-3" role="complementary">';
			dynamic_sidebar( 'sidebar-left' );
			echo '</aside>';
			echo '<div class="post-list col-sm-9" role="main">';
			echo $size;
			bw_get_section_bg( $post->ID );
			echo '<div class="container">';
			break;
		case '4':
			echo '<aside class="sidebar col-sm-3" role="complementary">';
			dynamic_sidebar( 'sidebar-left' );
			echo '</aside>';
			echo '<div class="post-list col-sm-6" role="main">';
			echo $size;
			bw_get_section_bg( $post->ID );
			echo '<div class="container">';
			break;
		default:
			break;
	}

	if ( have_posts() ) :
		while ( have_posts() ) : the_post(); ?>
			<div class="entry-content">
				<?php
				$pattern = array(
					'promo-photo',
					'skills',
					'services',
					'services_container',
					'indents',
					'buttons',
					'features',
					'layers-img',
					'counter',
					'contact',
					'img_slide',
					'team_slide',
					'video_slide',
					'testimonial_slide',
					'client_slide',
					'custom_slide',
					'project_details',
					'subscribe',
					'text-rotator',
					'portfolio',
					'features_container',
					'bw_map',
					'slider',
				);

				$page_content = get_the_content();
				foreach ( $pattern as $shortcode ) {
					$shortcode_full = bw_get_shortcode( $shortcode, $page_content );
					if ( strpos( $shortcode_full, 'after_page="true"' ) ) :
						$page_content = str_replace( $shortcode_full, '', $page_content );
					endif;
				}
				echo apply_filters( 'the_content', $page_content );
				?>
			</div>
			<footer>
				<?php wp_link_pages(); ?>
			</footer>
			<?php
		endwhile;
	else :
		get_template_part( 'templates/empty' );
	endif;

	switch ( $brainwave['pages-layout'] ) {
		case '1':
			echo '</div>';
			echo '</div>';
			$page_content = get_the_content();
			foreach ( $pattern as $shortcode ) {
				$shortcode_full = bw_get_shortcode( $shortcode, $page_content );
				if ( strpos( $shortcode_full, 'after_page="true"' ) ) :
					echo do_shortcode( $shortcode_full );
				endif;
			}

			echo '</div>';
			break;
		case '2':
			echo '</div>';
			echo '</div>';
			$page_content = get_the_content();
			foreach ( $pattern as $shortcode ) {
				$shortcode_full = bw_get_shortcode( $shortcode, $page_content );
				if ( strpos( $shortcode_full, 'after_page="true"' ) ) :
					echo do_shortcode( $shortcode_full );
				endif;
			}

			echo '</div>';
			echo '<aside class="sidebar col-sm-3" role="complementary">';
			dynamic_sidebar( 'sidebar-primary' );
			echo '</aside>';
			break;
		case '3':
			echo '</div>';
			echo '</div>';
			$page_content = get_the_content();
			foreach ( $pattern as $shortcode ) {
				$shortcode_full = bw_get_shortcode( $shortcode, $page_content );
				if ( strpos( $shortcode_full, 'after_page="true"' ) ) :
					echo do_shortcode( $shortcode_full );
				endif;
			}

			echo '</div>';
			break;
		case '4':
			echo '</div>';
			echo '</div>';
			$page_content = get_the_content();
			foreach ( $pattern as $shortcode ) {
				$shortcode_full = bw_get_shortcode( $shortcode, $page_content );
				if ( strpos( $shortcode_full, 'after_page="true"' ) ) :
					echo do_shortcode( $shortcode_full );
				endif;
			}

			echo '</div>';
			echo '<aside class="sidebar col-sm-3" role="complementary">';
			dynamic_sidebar( 'sidebar-primary' );
			echo '</aside>';
			break;
		default:
			break;
	}
	?>
</div>
<div class="container">
	<?php comments_template(); ?>
</div>
<?php get_footer(); ?>
