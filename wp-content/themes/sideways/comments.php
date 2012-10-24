<?php global $shortname; ?>


<?php if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly.');
	
if ( post_password_required() ) { ?>
	<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php return;
} ?>

<?php if ( have_comments() ) : ?>
	
	<h2><?php comments_number( __('Comments', 'raw_theme'), __('1 Comment', 'raw_theme'), __('% Comments', 'raw_theme') ); ?></h2>
	
	<div class="comment-pagination">
		<div class="left"><?php previous_comments_link() ?></div>
		<div class="right"><?php next_comments_link() ?></div>
	</div>
	
	<ol id="comments" class="commentlist clearfix">
		<?php wp_list_comments('callback=new_comment_list'); ?>
	</ol>
	
 <?php else : // This is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : // If comments are open, but there are no comments. ?>
		
	 <?php else : // If comments are closed. ?>

	<?php endif; ?>

<?php endif; ?>


<?php if ( comments_open() ) : ?>

	<div id="respond">

		<h2><?php comment_form_title( __('Leave a Comment', 'raw_theme'), __('Leave a Reply to %s', 'raw_theme') ); ?></h2>

		<div class="cancel-comment-reply">
			<small><?php cancel_comment_reply_link(); ?></small>
		</div>

		<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
			<p><?php printf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'raw_theme'), wp_login_url( get_permalink() ) ); ?></p>
		<?php else : ?>

		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentForm">

		<?php if ( is_user_logged_in() ) : ?>
			
			<div class="input">
				<p><?php printf( __('Logged in as %s', 'raw_theme' ), $user_identity ); ?>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account', 'raw_theme'); ?>"><?php _e('Log out &raquo;', 'raw_theme'); ?></a></p>
			</div>
			
		<?php else : ?>
			
			<label for="contactName"><span>*</span><?php _e('Name', 'raw_theme'); ?></label>
			<input type="text" name="author" id="contactName" class="requried" value="" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
			
			<label for="email"><span>*</span><?php _e('Email Address (not published)', 'raw_theme'); ?></label>
			<input type="text" name="email" id="email" class="requried email" value="" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
			
			<label for="url"><?php _e('Website', 'raw_theme'); ?></label>
			<input type="text" name="url" id="url" class="url" value="" tabindex="3" />

		<?php endif; ?>
			
			<label for="commentsText"><span>*</span><?php _e('Message', 'raw_theme'); ?></label>
			<textarea name="comment" id="commentsText" tabindex="4"></textarea>
			
			<input name="submit" type="submit" id="submit" class="requried" class="comment button" tabindex="5" value="<?php _e('Submit Comment', 'raw_theme'); ?>" />
			<?php comment_id_fields(); ?>
			
			<?php do_action('comment_form', $post->ID); ?>

		</form>

	<?php endif; // If registration required and not logged in ?>
	
	</div>

<?php endif; // if you delete this the sky will fall on your head ?>
