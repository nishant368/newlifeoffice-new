<?php /*
Template Name: Contact Form 
*/ ?>

<?php global $shortname, $theme_options;

get_header();

?>

<?php

include ( 'raw_framework/raw_contact_form.php' );

?>

<div id="wrapper">

	<?php include ('navigation.php'); ?>
	
	<div id="content" class="clearfix">
		
		<div class="article-wrapper clearfix">
			
			<!-- CONTENT -->
			<article class="main">
				
				<?php if ( have_posts() ) : ?>
				
					<?php while ( have_posts() ) : the_post(); ?>
						
						<!-- TITLE -->
						<?php if ( get_post_meta( $post->ID, $shortname.'_page_title', true ) != ""  ) {
							echo '<h1>'. get_post_meta( $post->ID, $shortname.'_page_title', true ) .'</h1>';
						} else { ?>
							<h1><?php the_title(); ?></h1>
						<?php } ?>
						
						<!-- SUBTITLE -->
						<?php if ( get_post_meta( $post->ID, $shortname.'_page_subtitle', true ) != "" ) {
							echo '<span class="subtitle">'. get_post_meta( $post->ID, $shortname.'_page_subtitle', true ) .'</span>';
						} ?>
					
						<?php the_content(); ?>
					
					<?php endwhile; ?>
				
				<?php endif; ?>
				
				<?php if(!$emailSent) { ?>
				
					<!-- CONTACT FORM -->
					<div id="respond">
						
						<?php if(isset($hasError) || isset($captchaError)) { ?>
							<p class="error"><?php _e('There was an error submitting your message.', 'raw_theme'); ?><p>
						<?php } ?>
						
						<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
							
							<fieldset>
								
								<label for="contactName"><span>*</span><?php _e('Name', 'raw_theme'); ?></label>
								<?php if($nameError != '') { ?>
									<span class="error"><?php echo $nameError;?></span> 
								<?php } ?>
								<input type="text" name="contactName" id="contactName" class="required" value="<?php if(isset($_POST['contactName'])){ echo $_POST['contactName'];}?>" tabindex="1" />
								
								<label for="email"><span>*</span><?php _e('Email Address', 'raw_theme'); ?></label>
								<?php if($emailError != '') { ?>
									<span class="error"><?php echo $emailError;?></span>
								<?php } ?>
								<input type="text" name="email" id="email" class="required email" value="<?php if(isset($_POST['email'])){ echo $_POST['email'];}?>" tabindex="2"/>
								
								<label for="commentsText"><span>*</span><?php _e('Message', 'raw_theme'); ?></label>
								<?php if($commentError != '') { ?>
									<span class="error"><?php echo $commentError;?></span> 
								<?php } ?>
								<textarea name="comments" id="commentsText" class="required" rows="1" cols="1" tabindex="3"><?php if(isset($_POST['comments'])) {	if(function_exists('stripslashes')) {	echo stripslashes($_POST['comments']); } else { echo $_POST['comments'];}} ?></textarea>
								
								<input type="checkbox" name="sendCopy" id="sendCopy" class="checkbox" value="true" <?php if(isset($_POST['sendCopy']) && $_POST['sendCopy'] == true) echo ' checked="checked"'; ?> tabindex="4"/>
								<label class="checkbox" for="sendCopy"><?php _e('Send copy of email to yourself', 'raw_theme'); ?></label>
								
								<input name="submit" type="submit" id="submit" class="comment button" tabindex="5" value="<?php _e('Send', 'raw_theme'); ?>" />
								
								<span class="displace"><label for="checking"><?php _e('If you want to submit this form, do not enter anything in this field', 'raw_theme'); ?></label>
								<input type="text" name="checking" id="checking" value="<?php if(isset($_POST['checking']))  echo $_POST['checking'];?>" /></span>
								<input type="hidden" name="submitted" id="submitted" value="true" />
								
							</fieldset>

						</form>
						
					</div>
					<!-- END CONTACT FORM -->
					
				<?php } else {
					
					_e("Thanks. Your message has been sent.", "raw_theme");
					
				} ?>
				
			</article>
			<!-- END CONTENT -->
			
			<!-- SIDEBAR -->
			<ul id="article-sidebar">
				
				<?php if ( !function_exists('dynamic_sidebar') || !generated_dynamic_sidebar( __('Contact Sidebar', 'raw_theme') ) ) { ?>
		
				<?php } ?>
			
			</ul>
			<!-- END SIDEBAR -->
			
		</div>

	</div>
	
	<div id="push"></div>
	
</div>

<?php get_footer(); ?>