<?php
global $postid;

if ( post_password_required() ) : return; endif;
$postid   = get_the_ID();
$comments = get_comments(
	array(
		'post_id' => $postid,
		// 'status'  => 'approve'
	)
);

if ( $comments ) {
	echo '<section id="comments">'; //comments
	echo '<h3 class="text-uppercase">';
	printf( _n( 'one comment', 'comments (%1$s) ', get_comments_number(), 'brainwave' ), number_format_i18n( get_comments_number() ) );
	echo '</h3>';
	echo '<ol class="media-list comments-list">';
	wp_list_comments( array( 'walker' => new BW_Walker_Comment ), $comments );
	echo '</ol>';
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
		echo '<nav>';
		echo '<ul class="pager">';
		if ( get_previous_comments_link() ) {
			echo '<li class="previous">';
			previous_comments_link( __( '&larr; Older comments', 'brainwave' ) );
			echo '</li>';
		}
		if ( get_next_comments_link() ) {
			echo '<li class="next">';
			next_comments_link( __( 'Newer comments &rarr;', 'brainwave' ) );
			echo '</li>';
		}
		echo '</ul>';
		echo '</nav>';
	}
	echo '</section>';// end comments
}

if ( get_option( 'require_name_email' ) ) {
	$required = ' *" aria-required="true"';
} else {
	$required = '"';
}

$form_args = array(
	'id_form'           => 'commentform',
	'id_submit'         => 'submit',
	'title_reply'       => '<h3 class="text-uppercase">' . __( 'Leave a Reply', 'brainwave' ) . '</h3>',
	'title_reply_to'    => __( 'Leave a Reply to %s', 'brainwave' ),
	'cancel_reply_link' => __( 'Cancel Reply', 'brainwave' ),
	'label_submit'      => __( 'Submit', 'brainwave' ),
	'class_submit'      => 'btn btn-primary',

	'comment_field' => '<div class="form-group"><textarea name="comment" id="comment" class="form-control" placeholder="' . __( 'Comment', 'brainwave' ) . ' *' . '" aria-required="true"></textarea></div>',

	'must_log_in' => '<p>You must be <a href="' . esc_url( wp_login_url( get_permalink() ) ) . '">logged in</a> to post a comment.</p>',

	'logged_in_as'         => '<p class="text-uppercase">Logged in as <strong><a href="' . esc_url( get_option( 'siteurl' ) ) . '/wp-admin/profile.php">' . $user_identity . '</a></strong><a href="' . esc_url( wp_logout_url( get_permalink() ) ) . '" title="' . __( '&nbsp;Log out of this account', 'brainwave' ) . '">' . __( '&nbsp;Log out &raquo;', 'brainwave' ) . ' </a></p>',
	'comment_notes_before' => '<div class="msg col-xs-10">&nbsp; </div>',
	'comment_notes_after'  => '',

	'fields' => array(
		'author' =>
			'<div class="row"><div class="form-group col-sm-6">
        <input type="text" class="form-control" name="author" id="author" placeholder="' . __( 'Name', 'brainwave' ) . $required . '>
        </div>',
		'email'  =>
			'<div class="form-group col-sm-6">
        <input type="email" class="form-control" name="email" id="email" placeholder="' . __( 'Email', 'brainwave' ) . $required . '>
        </div></div>',
		'url'    =>
			'<div class="form-group">
        <input type="url" class="form-control" name="url" id="url" placeholder="' . __( 'Website', 'brainwave' ) . '">
        </div>',
	),
);

if ( comments_open() ) {
	comment_form( $form_args );
}
