<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) : exit; endif;

/**
 * Use Bootstrap's media object for listing comments
 *
 * @link http://getbootstrap.com/components/#media
 */
class BW_Walker_Comment extends Walker_Comment {
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$GLOBALS['comment_depth'] = $depth + 1;
		echo '<ul ';
		echo comment_class( 'media list-unstyled comment-' . get_comment_ID() );
		echo '>';
	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$GLOBALS['comment_depth'] = $depth + 1;
		echo '</ul>';
	}

	function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
		$depth ++;
		$GLOBALS['comment_depth'] = $depth;
		$GLOBALS['comment']       = $comment;

		if ( ! empty( $args['callback'] ) ) {
			call_user_func( $args['callback'], $comment, $args, $depth );

			return;
		}
		extract( $args, EXTR_SKIP );
		?>

	<li id="comment-<?php esc_attr( comment_ID() ); ?>" <?php comment_class( 'media comment-' . get_comment_ID() ); ?>>
		<?php echo get_avatar( $comment, $size = '64' ); ?>
		<div class="comment-body pull-right">
		<div class="comment-header">
			<h4><?php echo get_comment_author_link(); ?></h4>
			<time datetime="<?php echo esc_attr( get_comment_date( 'j F Y' ) ); ?>">
				<a href="<?php echo esc_url( htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ); ?>"><?php printf( __( '%1$s', 'brainwave' ), get_comment_date( 'j F Y' ), get_comment_time() ); ?></a>
			</time>
			<span
				class="comment-edit pull-right"><?php edit_comment_link( __( 'edit', 'brainwave' ), '', '' ); ?></span>
			<?php comment_reply_link( array_merge( $args, array( 'depth'     => $depth,
			                                                     'max_depth' => $args['max_depth']
			) ) ); ?>
		</div>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<div class="alert alert-info transparent mt10">
				<i aria-hidden="true" class="et-icon-megaphone"></i>
				<?php _e( 'Your comment is awaiting moderation.', 'brainwave' ); ?>
			</div>
		<?php endif; ?>

		<div class="comment-text">
			<?php
			$comment_text = wp_kses( get_comment_text(), array(
				'a'          => array(
					'href'  => array(),
					'title' => array()
				),
				'br'         => array(),
				//Headings
				'h1'         => array(),
				'h2'         => array(),
				'h3'         => array(),
				'h4'         => array(),
				'h5'         => array(),
				'h6'         => array(),
				//blockquotes
				'blockquote' => array(),
				//Tables
				'table'      => array(),
				'thead'      => array(),
				'tbody'      => array(),
				'tfoot'      => array(),
				'tr'         => array(),
				'td'         => array(),
				'th'         => array(),
				//Lists
				'dl'         => array(),
				'dd'         => array(),
				'dt'         => array(),
				'ol'         => array(),
				'ul'         => array(),
				'li'         => array(),
				//Others
				'address'    => array(),
				'abbr'       => array(),
				'acronym'    => array(),
				'big'        => array(),
				'cite'       => array(),
				'del'        => array(),
				'ins'        => array(),
				'kbd'        => array(),
				'code'       => array(),
				'q'          => array(),
				'sub'        => array(),
				'sup'        => array(),
				'tt'         => array(),
				'pre'        => array(),
				'var'        => array(),

				//Markup
				'em'         => array(),
				'strong'     => array()
			) );
			echo apply_filters( 'the_content', $comment_text );
			?>
		</div>

		<?php
	}

	function end_el( &$output, $comment, $depth = 0, $args = array() ) {
		if ( ! empty( $args['end-callback'] ) ) {
			call_user_func( $args['end-callback'], $comment, $args, $depth );

			return;
		}
		// Close ".media-body" <div> located in templates/comment.php, and then the comment's <li>
		echo "</div></li>\n";
	}
}

function bw_get_avatar( $avatar, $type ) {
	if ( ! is_object( $type ) ) : return $avatar; endif;
	$avatar = str_replace( "class='avatar", "class='avatar pull-left media-object", $avatar );

	return $avatar;
}

add_filter( 'get_avatar', 'bw_get_avatar', 10, 2 );
