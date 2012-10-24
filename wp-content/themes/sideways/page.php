<?php

global $shortname, $theme_options;

get_header();

?>

<div id="wrapper">
	
	<?php include ('navigation.php'); ?>

	<div id="content" class="clearfix">
		
		<div class="article-wrapper clearfix">
		
			<!-- CONTENT -->
			<article class="main clearfix">
				
				<?php if ( have_posts() ): ?>
			
					<?php while ( have_posts() ): the_post(); ?>
						
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
						
						<?php comments_template(); ?>
					
					<?php endwhile; ?>
		
				<?php endif; ?>
			
			</article>
			
			<!-- SIDEBAR -->
			<ul id="article-sidebar">
				
				<?php if ( !function_exists('dynamic_sidebar') || !generated_dynamic_sidebar( __('Page Sidebar', 'raw_theme') ) ) { ?>
		
				<?php } ?>				
			
			</ul>			
			
		</div>
		
	</div>
	
	<div id="push"></div>
	
</div>

<?php get_footer(); ?>