<?php global $brainwave; ?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php wp_title(); ?></title>
	<?php wp_head(); ?>

</head>
<?php get_template_part( 'templates/customize' ); ?>

<body <?php body_class( array( 'load' ) ); ?> >
<div class="wrapper">
	<?php
	$post_cat = bw_get_portfolio_post_categories( get_post( get_the_ID() ) );
	$outcat   = '';
	global $wpdb;
	$temp = 0;
	for ( $i = 0; $i < strlen( $post_cat ); $i ++ ) {
		if ( $post_cat[ $i ] === ',' ) {
			$cat        = trim( substr( $post_cat, $temp, $i - $temp ) );
			$temp       = $i + 1;
			$table_name = esc_sql( $wpdb->prefix . "bw_block_categories" );
			$is_table   = $wpdb->query( "SHOW TABLES LIKE '$table_name'" );
			if ( ! empty( $is_table ) ) {
				$result = $wpdb->get_results( "SELECT name FROM $table_name WHERE id = '" . $cat . "'" );
				if ( $result ) {

					$cat = get_object_vars( $result[0] );
					if ( ! empty( $outcat ) ) {
						$outcat .= ', ' . $cat['name'];
					} else {
						$outcat .= $cat['name'];
					}
				} else {
					$outcat = '';
				}
			} else {
				$outcat = '';
			}
		}
	}
	if ( ! empty( $brainwave['menu-portfolio'] ) ) {
		if ( $brainwave['menu-portfolio'] ) {
			get_template_part( 'templates/menu' );
		}
	}
	if ( has_post_thumbnail() ) :
		$head_featured = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail_name' );
		?>
		<div class="page-header-small" data-background-color="<?php echo esc_attr( $brainwave['bg-color'] ); ?>"
		     data-background="<?php echo esc_attr( $head_featured[0] ); ?>"
		     data-overlay-color="<?php echo esc_attr( $brainwave['bg-color'] ); ?>"
		     data-overlay-opacity="<?php echo esc_attr( $brainwave['bg-opacity'] ); ?>">
			<div class="container">
				<div class="col-sm-12">
					<div class="text-center">
						<h2 class="text-uppercase title-3 white mt29" data-color="#fff">
							<?php echo bw_title(); ?>
						</h2>
					</div>
					<div class="sub-header text-center opacity-50 text-uppercase ls-02 mt10 mb30"
					     data-color="#fff"><?php echo esc_html( $outcat ); ?></div>
				</div>
			</div>
		</div>
	<?php else : ?>
		<div class="page-header-small" data-background-color="<?php echo esc_attr( $brainwave['bg-color'] ); ?>"
		     data-background="<?php echo esc_attr( $brainwave['bg-img']['url'] ); ?>"
		     data-overlay-color="<?php echo esc_attr( $brainwave['bg-color'] ); ?>"
		     data-overlay-opacity="<?php echo esc_attr( $brainwave['bg-opacity'] ); ?>">
			<div class="container">
				<div class="col-sm-12">
					<div class="text-center">
						<h2 class="text-uppercase title-3 white mt29" data-color="#fff">
							<?php echo bw_title(); ?>
						</h2>
					</div>
					<div class="sub-header text-center opacity-50 text-uppercase ls-02 mt10 mb30"
					     data-color="#fff"><?php echo esc_html( $outcat ); ?></div>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<div class="work-navigation header clearfix">
		<div class="row">
			<div class="col-xs-4 text-left">
				<?php if ( get_previous_post() ) : ?>
					<a href="<?php echo esc_url( get_permalink( get_previous_post()->ID ) ); ?>"
					   class="work-prev single-page-load"
					   data-title="<?php echo esc_attr( get_bloginfo( 'name' ) . ' | ' . get_the_title( get_previous_post()->ID ) ); ?>"><i
							class="fa fa-angle-left"></i>&nbsp;<?php _e( 'Previous', 'brainwave' ); ?></a>
				<?php endif; ?>
			</div>
			<div class="col-xs-4 text-center">
				<a href="<?php echo esc_url( $brainwave['portfolio_link'] ); ?>" class="work-all single-page-load"
				   data-title="<?php echo esc_attr( get_bloginfo( 'name' ) . ' | ' . __( 'Portfolio', 'brainwave' ) ); ?>"><?php _e( 'All works', 'brainwave' ); ?></a>
			</div>
			<div class="col-xs-4 text-right">
				<?php if ( get_next_post() ) : ?>
					<a href="<?php echo esc_url( get_permalink( get_next_post()->ID ) ); ?>"
					   class="work-next single-page-load"
					   data-title="<?php echo esc_attr( get_bloginfo( 'name' ) . ' | ' . get_the_title( get_next_post()->ID ) ); ?>"><?php _e( 'Next', 'brainwave' ); ?>
						&nbsp;<i class="fa fa-angle-right"></i></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="page-section">
		<div class="container">
			<div class="row">
