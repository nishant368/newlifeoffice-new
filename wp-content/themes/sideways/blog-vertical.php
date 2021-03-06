<?php

global $shortname, $theme_options;

get_header();

?>

<div id="wrapper">
	
	<?php include ('navigation.php'); ?>

	<div id="content" class="clearfix">
		
		<div class="article-wrapper clearfix">
			
			<!-- SIDEBAR -->
			<ul id="article-sidebar">
				
				<?php if ( !function_exists('dynamic_sidebar') || !generated_dynamic_sidebar( __('Article Sidebar', 'raw_theme') ) ) { ?>
				
				<?php } ?>				
			
			</ul>	
			
			<!-- CONTENT -->
			<?php if ( have_posts() ) : ?>
			
				<?php while ( have_posts() ) : the_post(); ?>					
				
					<article id="post-<?php the_ID(); ?>" <?php post_class('main'); ?>>
					
						<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>					
						
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
				
						<?php if ( preg_match( "/youtube\.com\/watch/i", get_post_meta( $post->ID, $shortname.'_video_url', true ) ) ) { ?>
							
							<!-- YouTube Video -->
							<iframe title="YouTube video player" class="youtube-player" type="text/html" width="524" height="294" src="http://www.youtube.com/embed/<?php echo getYTid( get_post_meta( $post->ID, $shortname.'_video_url', true ) ); ?>?rel=0&amp;hd=1&amp;wmode=opaque" frameborder="0"></iframe>
						
						<?php } elseif ( preg_match( "/vimeo\.com/i", get_post_meta( $post->ID, $shortname.'_video_url', true ) ) ) { ?>
							
							<!-- Vimeo Video -->
							<?php preg_match ( "/http:\/\/(www\.)?vimeo.com\/(\d+)/", get_post_meta( $post->ID, $shortname.'_video_url', true ), $vimeo_id ); ?>
							
							<iframe src="http://player.vimeo.com/video/<?php echo $vimeo_id[2]; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=<?php echo stripslashes($theme_options[ $shortname.'_accent_colour' ]);?>" width="524" height="294" frameborder="0"></iframe>
						
						<?php } elseif ( has_post_thumbnail() ) { ?>
						
							<!-- ARTICLE IMAGE -->
							<div id="feature-image">
							
								<?php the_post_thumbnail( 'feature_image_524x373' );?>
								
							</div>
						
						<?php } ?>
						
						<?php raw_excerpt( 'excerptlength_blog_long', 'excerptmore' ); ?>

						<a href="<?php the_permalink(); ?>" class="button right"><?php _e('More', 'raw_theme'); ?>+</a>
					
					</article>
				
				<?php endwhile; ?>
				
				<!-- PAGINATION -->
				<?php pagination( ); ?>			
				
			<?php endif; ?>	
			
		</div>
	
	</div>
	
	<div id="push"></div>
	
</div>

<?php get_footer(); ?>