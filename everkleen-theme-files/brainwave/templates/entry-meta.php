<?php global $brainwave; ?>
<div class="byline author vcard meta-data">
	<?php
	if ( is_sticky() ) : echo ' <i class="fa fa-thumb-tack"></i> '; endif;
	if ( $brainwave['meta'] == 1 ) {
		// date & time
		if ( $brainwave['meta-date'] == 1 ) {
			echo "<time class='published' datetime=' " . esc_attr( get_the_time( $brainwave['meta-date-format'] ) ) . "'>";
			echo get_the_date( $brainwave['meta-date-format'] );
			echo "</time>";
		}

		// author
		if ( $brainwave['meta-author'] == 1 ) {
			_e( ' - By ', 'brainwave' );
			echo "<a href=' " . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . "' rel='author' class='fn'>";
			echo get_the_author();
			echo "</a>";
		}

		// tags
		if ( $brainwave['meta-tags'] == 1 ) {
			$tags = get_the_tags();
			if ( $tags ) {
				echo ' - ';
				the_tags( '', ', ', '' );
			}
			$taxonomy = 'category';

			// get the term IDs assigned to post.
			$post_terms = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) );
			// separator between links
			$separator = ', ';

			if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ) {
				echo ' - ';
				$term_ids = implode( ',', $post_terms );
				$terms    = wp_list_categories( 'title_li=&style=none&echo=0&taxonomy=' . $taxonomy . '&include=' . $term_ids );
				$terms    = rtrim( trim( str_replace( '<br />', $separator, $terms ) ), $separator );

				// display post categories
				echo $terms;
			}
		}

		// number of comments
		if ( $brainwave['meta-comments'] == 1 ) {
			echo ' - ';
			if ( get_comments_number() > 0 ) {
				if ( get_comments_number() == 1 ) {
					echo _e( 'One comment', 'brainwave' );
				} else {
					echo get_comments_number() . __( ' comments', 'brainwave' );
				}
			} else {
				echo '0' . __( ' comments', 'brainwave' );
			}
		}
	}
	?>
</div>
