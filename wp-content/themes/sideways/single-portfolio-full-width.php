<?php

global $shortname, $theme_options;

get_header();

?>

<div id="wrapper">
	
	<?php include ('navigation.php'); ?>

	<div id="content" class="clearfix">
		
		<?php if ( have_posts() ): ?>
			
			<?php while ( have_posts() ): the_post(); ?>
				
				<div class="article-wrapper">
					
					<!-- CONTENT -->
					<article class="clearfix">
						
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
						
						<?php if ( get_post_meta( $post->ID, $shortname.'_show_feature_image', true ) == 'on' ) {?>
						
							<!-- ARTICLE IMAGE -->
							<div id="feature-image">
							
								<?php the_post_thumbnail( 'feature_image_800x373' ); ?>
								
							</div>
							
						<?php } ?>
					
						<?php the_content(); ?>
						
					</article>
				
				</div>
			
			<?php endwhile; ?>
	
		<?php endif; ?>
	
	</div>
	
	<div id="push"></div>
	
</div>

<?php get_footer(); ?>