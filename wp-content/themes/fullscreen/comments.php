<?php if ( post_password_required() ) : ?>
    <div id="comments">
        <p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'simplicius' ); ?></p>
    </div><!-- #comments -->
    <?php return; ?>
<?php endif; ?>

<div id="comments">
    <?php if ( have_comments() ) : ?>
        <h2 id="comments-title">
            <?php
			printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'simplicius' ),
			number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
			?>
        </h2>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
            <div class="navigation">
                <div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'simplicius' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'simplicius' ) ); ?></div>
            </div> <!-- .navigation -->
        <?php endif; // check for comment navigation ?>

        <ol class="commentlist">
            <?php wp_list_comments( array( 'callback' => 'theme_comment' ) ); ?>
        </ol>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
            <div class="navigation">
                <div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'simplicius' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'simplicius' ) ); ?></div>
            </div><!-- .navigation -->
        <?php endif; // check for comment navigation ?>

    <?php else : ?>
        <?php if ( ! comments_open() ) : ?>
            <!-- <p class="nocomments"><?php _e( 'Comments are closed.', 'simplicius' ); ?></p> -->
        <?php endif; // end ! comments_open() ?>
    <?php endif; // end have_comments() ?>
<?php
$args = array(
'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8"></textarea></p>',
);
comment_form($args); 
?>

</div><!-- #comments -->
