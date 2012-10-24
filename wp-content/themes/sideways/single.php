<?php

global $shortname, $theme_options;

get_header();

?>

<div id="wrapper">
	
	<?php include ('navigation.php'); ?>

	<div id="content" class="clearfix">
		
		<div class="article-wrapper clearfix">
			
			<!-- CONTENT -->
			<article id="post-<?php the_ID(); ?>" <?php post_class('main'); ?>>
				
				<?php if ( have_posts() ) : ?>
				
					<?php while ( have_posts() ) : the_post(); ?>
						
						<h1><?php the_title(); ?></h1>						
						
						<div class="single-post-meta">
							
							<ul>
								<?php if ( $theme_options[$shortname.'_enable_meta_author'] == 'true' ){ ?>
									<li>By <?php the_author(); ?></li>
									<li>|</li>
								<?php } ?>
								
								<?php if ( $theme_options[$shortname.'_enable_meta_date'] == 'true' ){ ?>
									<li><time datetime="<?php the_time('c');?>"><?php the_time( get_option( 'date_format' ) );  ?></time></li>
									<li>|</li>
								<?php } ?>		
								
								<?php if ( $theme_options[$shortname.'_enable_meta_categories'] == 'true' ){ ?>
									<li><?php the_category(', '); ?></li>
								<?php } ?>
							</ul>						
							
						</div>			
				
						<!-- SUBTITLE -->
						
						<?php if ( get_post_meta( $post->ID, $shortname.'_page_subtitle', true ) != "" ) {
							echo '<span class="subtitle">'. get_post_meta( $post->ID, $shortname.'_page_subtitle', true ) .'</span>';
						} ?>						
						
						<?php if ( preg_match( "/youtube\.com\/watch/i" , get_post_meta( $post->ID, $shortname.'_video_url', true ) ) ) { ?>
							
							<!-- YouTube Video -->
							<iframe title="YouTube video player" class="youtube-player" type="text/html" width="524" height="294" src="http://www.youtube.com/embed/<?php echo getYTid( get_post_meta( $post->ID, $shortname.'_video_url', true ) ); ?>?rel=0&amp;hd=1&amp;wmode=opaque" frameborder="0"></iframe>
						
						<?php } elseif ( preg_match( "/vimeo\.com/i" , get_post_meta( $post->ID, $shortname.'_video_url', true ) ) ) { ?>
							
							<!-- Vimeo Video -->
							<?php preg_match ( "/http:\/\/(www\.)?vimeo.com\/(\d+)/", get_post_meta( $post->ID, $shortname.'_video_url', true ), $vimeo_id ); ?>
							
							<iframe src="http://player.vimeo.com/video/<?php echo $vimeo_id[2]; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=<?php echo stripslashes($theme_options[ $shortname.'_accent_colour' ]);?>" width="524" height="294" frameborder="0"></iframe>
						
						<?php } elseif ( has_post_thumbnail() && get_post_meta( $post->ID, $shortname.'_hide_feature_image', true ) != 'on' ) { ?>
						
							<!-- ARTICLE IMAGE -->
							<div id="feature-image">
							
								<?php the_post_thumbnail( 'feature_image_524' );?>
								
							</div>
						
						<?php } ?>
						
						<?php the_content(); ?>
				
						<?php wp_link_pages( array( 'before' => '<div class="pagination"><p><span>'.__("Page: ", "raw_theme").'</span>', 'after' => '</p></div>', 'next_or_number' => 'number', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
						
						<?php if ( get_post_meta( $post->ID, $shortname.'_disable_author_bio', true ) != 'on' ){ ?>
						
							<!-- ABOUT AUTHOR -->
							<div id="author-bio">
							
								<?php echo get_avatar( get_the_author_meta('user_email'), '64', '' ); ?>			
							
								<div class="author-text">
									
									<h4><?php the_author_posts_link(); ?></h4>
									
									<div class="the-comment">
									
										<p><?php the_author_meta('description'); ?></p>
										
									</div>
									
								</div>
							
							</div>
							
						<?php } ?>
						
						<?php comments_template(); ?>
				
					<?php endwhile; ?>
					
				<?php endif; ?>
				
			</article>
			
			<!-- SIDEBAR -->
			<ul id="article-sidebar">
				
				<?php if ( !function_exists('dynamic_sidebar') || !generated_dynamic_sidebar( __('Article Sidebar', 'raw_theme') ) ) { ?>
				
				<?php } ?>				
			
			</ul>			
			
		</div>
	
	</div>
	
	<div id="push"></div>
	
</div>

<?php get_footer(); ?>