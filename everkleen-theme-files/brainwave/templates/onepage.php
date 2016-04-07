<?php
global $brainwave;
$bg_overlay_opacity = get_post_meta( $post->ID, 'overlay-opacity', true );
$bg_overlay_color   = get_post_meta( $post->ID, 'overlay-color', true );
$title_displaying   = get_post_meta( $post->ID, 'page_title_displaying', true );
$fixed_bg           = get_post_meta( $post->ID, 'bg_fixed', true );
$title_text_color   = ( get_post_meta( $post->ID, 'title_text_color', true ) ) ? get_post_meta( $post->ID, 'title_text_color', true ) : '#ffffff';

?>
<article id="<?php echo esc_attr( $post->post_name ); ?>" class="pos-relative"
         data-background-color="<?php echo esc_attr( $bg_overlay_color ); ?>"
         data-background-opacity="<?php echo esc_attr( $bg_overlay_opacity ); ?>">
	<?php
	if ( ( isset( $title_displaying ) ) && ( ! empty( $title_displaying ) ) ) {
		$header_bg_image = '';
		if ( has_post_thumbnail( $id ) ) {
			$bg_img                 = wp_get_attachment_url( get_post_thumbnail_id() );
			$header_bg_image        = 'data-background="' . esc_attr( $bg_img ) . '"';
			$header_overlay_color   = ( get_post_meta( $post->ID, 'header_overlay_color', true ) ) ? 'data-overlay-color="' . esc_attr( get_post_meta( $id, 'header_overlay_color', true ) ) . '"' : 'data-overlay-color="#191919"';
			$header_overlay_opacity = ( get_post_meta( $post->ID, 'header_overlay_opacity', true ) ) ? 'data-overlay-opacity="' . esc_attr( get_post_meta( $id, 'header_overlay_opacity', true ) ) . '"' : 'data-overlay-color="0.95"';
		} else {
			$header_overlay_color   = ( get_post_meta( $post->ID, 'header_overlay_color', true ) ) ? 'data-background-color="' . esc_attr( get_post_meta( $id, 'header_overlay_color', true ) ) . '"' : 'data-background-color="#191919"';
			$header_overlay_opacity = ( get_post_meta( $post->ID, 'header_overlay_opacity', true ) ) ? 'data-background-opacity="' . esc_attr( get_post_meta( $id, 'header_overlay_opacity', true ) ) . '"' : 'data-background-color="0.95"';
		}
		?>
		<div
			class="section-header <?php echo ( $fixed_bg ) ? ' background-fixed ' : ''; ?>" <?php echo $header_bg_image . ' ' . $header_overlay_color . ' ' . $header_overlay_opacity; ?>>
			<h2 class="text-uppercase"
			    data-color="<?php echo esc_attr( $title_text_color ); ?>"><?php the_title(); ?></h2>
		</div>
		<?php
	}

	$page_size = get_post_meta( $post->ID, 'page_size', true );
	switch ( $page_size ) {
		case 'None':
			echo '<div class="pos-relative">';
			break;
		case 'Small':
			echo '<div class="page-section-small">';
			break;
		case 'Normal':
			echo '<div class="page-section">';
			break;
		default:
			echo '<div class="page-section">';
			break;
	}
	?>
	<?php bw_get_section_bg( $post->ID ); ?>
	<div class="container">
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
	</div>
</article>

<?php
echo '<div data-background-color="' . esc_attr( $bg_overlay_color ) . '" data-background-opacity="' . esc_attr( $bg_overlay_opacity ) . '">';
$page_content = get_the_content();
foreach ( $pattern as $shortcode ) {
	$shortcode_full = bw_get_shortcode( $shortcode, $page_content );
	if ( strpos( $shortcode_full, 'after_page="true"' ) ) {
		echo do_shortcode( $shortcode_full );
	}
}
echo '</div>';
?>
