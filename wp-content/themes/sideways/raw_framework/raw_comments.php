<?php 

// ---------- COMMENTS ---------- //
function new_comment_list($comment, $args, $depth) {

	$GLOBALS['comment'] = $comment; ?>
	
	<li <?php comment_class('clearfix'); ?> id="li-comment-<?php comment_ID(); ?>">
	
		<?php if(get_comment_type() == 'comment') {

			if ( user_can( $comment->user_id,'level_2' ) ) {
				$admin_class = 'admin_comment';
			}

		}?>
		
		<div class="comment-holder <?php echo $admin_class; ?>" id="comment-<?php comment_ID(); ?>">
		
			<?php echo get_avatar($comment, 80); ?>
			
			<div class="author-text">
				
				<small><time><?php comment_date (); ?> @ <?php comment_time(); ?></time></small>
					
				<h4><?php comment_author_link(); ?> <?php _e('says:', 'raw_theme'); ?></h4>
				
				<div class="the-comment">
					
					<?php if ($comment->commnet_approved == '0'):?>
						<p><?php _e('Your comment is awaiting moderation.', 'raw_theme'); ?></p>
					<?php endif; ?>
					
					<?php comment_text() ?>
					
				</div>				
				
				<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'login_text' => '', 'reply_text' => __('Reply', 'raw_theme') ) ) ); ?>
				
			</div>
			
		</div>
		
<?php
}

?>