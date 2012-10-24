<?php /*
Template Name: Gallery
*/ ?>

<?php global $shortname, $theme_options;

get_header( 'horizontal');

?>

<div id="wrapper">
	
	<?php include ('navigation.php'); ?>

	<div id="content" class="height-fix clearfix">

		<!-- BLOG ITEMS -->
		<div id="article-list">			
			
			<?php if ( have_posts() ): ?>
			
				<?php while ( have_posts() ): the_post(); ?>					
					
					<!-- INTRODUCTON -->
					<div class="article-wrapper type-text">
					
						<article>
						
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
							
							<section><?php the_content(); ?></section>
							
						</article>
						
					</div>
					
					<?php if ( !post_password_required($post) ) {
					
						$args = array(
							'post_type' => 'attachment',
							'numberposts' => -1,
							'post_status' => null,
							'post_parent' => $post->ID,
							'orderby' => 'menu_order',
							'order' => 'ASC'
						); 
						
						$attachments = get_posts($args);
						
						if ($attachments) {						
						
							foreach ($attachments as $attachment) { ?>
								
								<?php $thumbnail = wp_get_attachment_image_src( $attachment->ID, 'full' );
								if( $thumbnail[1] > $thumbnail[2] ) { // Landscape
									$image_class = 'type-gallery-landscape';
								} else {
									$image_class = 'type-gallery-portrait';
								} ?>
								
								<div class="article-wrapper hover_50 <?php echo $image_class; ?>">
								
									<?php $attachurl = wp_get_attachment_url($attachment->ID);										
									$src = wp_get_attachment_image_src( $attachment->ID, $image_class);
									$title = apply_filters('the_title', $attachment->post_title);
									$description = $attachment->post_content; ?>

									<a href="<?php echo $attachurl; ?>" rel="prettyPhoto[1]" title="<?php echo $description; ?>" ><img src="<?php echo $src[0]; ?>" alt="<?php echo $title; ?>" /></a>
									
								</div>						
								
							<?php }
							
						}
					
					}
				
				endwhile;
	
			endif; ?>
		
		</div>
	
	</div>
	
	<!-- PAGINATION -->
	<?php pagination(); ?>
	
	<div id="push"></div>
	
</div>

<?php get_footer( 'fixed' ); ?>