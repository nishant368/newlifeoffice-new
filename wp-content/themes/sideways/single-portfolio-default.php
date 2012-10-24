<?php

global $shortname, $theme_options;

get_header();

?>

<div id="wrapper">
	
	<?php include ('navigation.php'); ?>

	<div id="content" class="clearfix">
		
		<?php if ( have_posts() ): ?>
			
			<?php while ( have_posts() ): the_post(); ?>
				
				<div class="article-wrapper clearfix">
					
					<!-- CONTENT -->
					<article class="main">
						
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
						
						<?php if ( preg_match( "/youtube\.com\/watch/i", get_post_meta( $post->ID, $shortname.'_video_url', true ) ) ) { ?>
							
							<!-- YouTube Video -->
							<iframe title="YouTube video player" class="youtube-player" type="text/html" width="524" height="294" src="http://www.youtube.com/embed/<?php echo getYTid( get_post_meta( $post->ID, $shortname.'_video_url', true ) ); ?>?rel=0&amp;hd=1&amp;wmode=opaque" frameborder="0"></iframe>
						
						<?php } elseif ( preg_match( "/vimeo\.com/i", get_post_meta( $post->ID, $shortname.'_video_url', true ) ) ) { ?>
							
							<!-- Vimeo Video -->
							<?php preg_match ( "/http:\/\/(www\.)?vimeo.com\/(\d+)/", get_post_meta( $post->ID, $shortname.'_video_url', true ), $vimeo_id ); ?>
							
							<iframe src="http://player.vimeo.com/video/<?php echo $vimeo_id[2]; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=<?php echo stripslashes($theme_options[ $shortname.'_accent_colour' ]);?>" width="524" height="294" frameborder="0"></iframe>
						
						<?php } elseif ( has_post_thumbnail() && get_post_meta( $post->ID, $shortname.'_show_feature_image', true ) == 'on' ) { ?>
						
							<!-- ARTICLE IMAGE -->
							<div id="feature-image">
							
								<?php the_post_thumbnail( 'feature_image_524' );?>
								
							</div>
						
						<?php } ?>						
					
						<?php the_content(); ?>
						
						<?php comments_template(); ?>
						
					</article>
					
					<!-- SIDEBAR -->
					<ul id="article-sidebar">
						
						<?php if ( !function_exists('dynamic_sidebar') || !generated_dynamic_sidebar( __('Page Sidebar', 'raw_theme') ) ) { ?>
				
						<?php } ?>				
					
					</ul>			
					
				</div>
			
			<?php endwhile; ?>
	
		<?php endif; ?>
		
	</div>
	
	<div id="push"></div>
	
</div>

<?php get_footer(); ?>