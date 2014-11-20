<?php
/**
 * The template for displaying comments.
 *
 * This is where you can edit any of the placeholder text for comments/the comment form!
 *
 * @package Gracie
 */
?>
<div id="comments">
    <?php 
    if ( post_password_required() ) : ?>
        <p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'gracie' ); ?></p>
    </div><!-- #comments -->
    <?php return;
    endif;
    ?>

    <?php if ( have_comments() ) : ?>

        <ol class="commentlist">
            <?php
                /* See gracie_comment() in inc/functions/comments.php for more.  */
                wp_list_comments( array( 'callback' => 'gracie_comment' ) );
            ?>
        </ol>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
        <nav id="comment-nav-below">
            <h1 class="assistive-text"><?php _e( 'Comment navigation', 'gracie' ); ?></h1>
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'gracie' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'gracie' ) ); ?></div>
        </nav>
        <?php endif; // check for comment navigation ?>

    <?php
        elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
        <p class="nocomments"><?php _e( 'Comments are closed.', 'gracie' ); ?></p>
    <?php endif; ?>

    <?php 
    $fields = array (
        'author' => '<p class="comment-form-author"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /><label for="author">Name (Required)</label></p>',
        'email' => '<p class="comment-form-email"><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /><label for="email">Email (Required)</label></p>',
        'url' => '<p class="comment-form-url"><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /><label for="url">URL</label></p>',
    );
    comment_form( 
        array(
             'title_reply' => '<div class="comment-form-title">Leave a Comment</div>',
             'comment_notes_before' => '',
             'label_submit' => 'COMMENT',
             'comment_field' => '<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>',
             'fields' => $fields
         ) 
    ); ?>

</div><!-- #comments -->