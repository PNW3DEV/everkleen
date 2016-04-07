<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.2
 */
global $product;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! comments_open() ) {
	return;
}

?>
<div role="tabpanel" class="tab-pane fade active in" id="reviews">
	<div id="comments">
		<h3 class="text-uppercase"><?php
			if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_review_count() ) )
				printf( _n( '%s review for %s', '%s reviews for %s', $count, 'woocommerce' ), $count, get_the_title() );
			else
				_e( 'Reviews', 'woocommerce' );
		?></h3>

		<?php if ( have_comments() ) : ?>

			<ol class="media-list comments-list">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
					'prev_text' => '&larr;',
					'next_text' => '&rarr;',
					'type'      => 'list',
				) ) );
				echo '</nav>';
			endif; ?>

		<?php else : ?>

			<p class="woocommerce-noreviews"><?php _e( 'There are no reviews yet.', 'woocommerce' ); ?></p>

		<?php endif; ?>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) : ?>

			<div id="respond">
				<?php
					$commenter = wp_get_current_commenter();
					$title_reply = have_comments() ? __( 'Add a review', 'woocommerce' ) : __( 'Be the first to review', 'woocommerce' ) . ' &ldquo;' . get_the_title() . '&rdquo;';
					$comment_form = array(
						'title_reply'          => '<h3 class="text-uppercase col-md-12">' . $title_reply . '</h3>',
						'title_reply_to'       => __( 'Leave a Reply to %s', 'woocommerce' ),
						'comment_notes_before' => '',
						'comment_notes_after'  => '',
						'fields'               => '',
						'label_submit'  => __( 'Submit', 'woocommerce' ),
						'class_submit' => 'btn btn-primary',
						'logged_in_as'  => '',
						'comment_field' => '',
						'submit_field'         => '<div class="form-submit col-md-12">%1$s %2$s</div>',
					);

					if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
						$comment_form['must_log_in'] = '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a review.', 'woocommerce' ), esc_url( $account_page_url ) ) . '</p>';
					}

					if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
						$comment_form['fields'] = array(
							'author' => '<div class="form-group col-sm-4 comment-form-author">' . '' .
							            '<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" placeholder="' . __( 'Name', 'brainwave' ) . ' *" aria-required="true" /></div>',
							'email'  => '<div class="form-group col-sm-4 comment-form-email">' .
							            '<input id="email" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" placeholder="' . __( 'Email', 'brainwave' ) . ' *" aria-required="true" /></div>',
						);
						$comment_form['comment_field'] = '<div class="form-group col-sm-4 comment-form-rating"><select name="rating" id="rating">
							<option value="">' . __( 'Rate&hellip;', 'woocommerce' ) . '</option>
							<option value="5">' . __( 'Perfect', 'woocommerce' ) . '</option>
							<option value="4">' . __( 'Good', 'woocommerce' ) . '</option>
							<option value="3">' . __( 'Average', 'woocommerce' ) . '</option>
							<option value="2">' . __( 'Not that bad', 'woocommerce' ) . '</option>
							<option value="1">' . __( 'Very Poor', 'woocommerce' ) . '</option>
						</select></div>';
					} else {
						$comment_form['fields'] = array(
							'author' => '<div class="form-group col-sm-6 comment-form-author">' . '' .
							            '<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" placeholder="' . __( 'Name', 'brainwave' ) . ' *" aria-required="true" /></div>',
							'email'  => '<div class="form-group col-sm-6 comment-form-email">' .
							            '<input id="email" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" placeholder="' . __( 'Email', 'brainwave' ) . ' *" aria-required="true" /></div>',
						);
					}

					$comment_form['comment_field'] .= '<div class="form-group col-sm-12"><textarea id="comment" class="form-control" name="comment" placeholder="' . __( 'Comment', 'brainwave' ) . ' *" aria-required="true"></textarea></div><div class="clearfix"></div>';
					echo '<div class="row">';
					comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
					echo '</div>';
				?>
			</div>

	<?php else : ?>

		<p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>

	<?php endif; ?>

	<div class="clear"></div>
</div>
