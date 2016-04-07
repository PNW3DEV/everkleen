<?php
global $brainwave;
get_header( 'home' );
if ( have_posts() ) {
	$count = 0;
	while ( have_posts() ) : the_post();
		if ( is_search() && ( $post->post_type !== 'post' ) ) :
			continue;
		else :
			get_template_part( 'templates/excerpt' );
			$count ++;
		endif;
	endwhile;
	if ( $count === 0 ) {
		get_template_part( 'templates/empty' );
	}
} else {
	get_template_part( 'templates/empty' );
}
get_footer( 'post' );
?>
