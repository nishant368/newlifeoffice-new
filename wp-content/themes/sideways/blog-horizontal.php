<?php

global $shortname, $theme_options;

get_header( 'horizontal');

?>

<div id="wrapper">
	
	<?php include ('navigation.php'); ?>

	<div id="content" class="height-fix clearfix">

		<!-- BLOG ITEMS -->
		<div id="article-list">			
			
			<?php if ( have_posts() ): ?>
			
				<?php while ( have_posts() ): the_post(); ?>					
					
					<?php if ( preg_match( "/youtube\.com\/watch/i", get_post_meta( $post->ID, $shortname.'_video_url', true ) ) ) { ?>
					
						<!-- YouTube Video -->
						
						<div class="article-wrapper type-video">
			
							<article>
								
								<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
								
								<?php raw_excerpt( 'excerptlength_blog', 'excerptmore' ); ?>

								<footer class="post-meta">
										
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
										
									</footer>
									
							</article>
							
							<iframe title="YouTube video player" class="youtube-player" type="text/html" width="764" height="430" src="http://www.youtube.com/embed/<?php echo getYTid( get_post_meta( $post->ID, $shortname.'_video_url', true ) ); ?>?rel=0&amp;hd=1&amp;wmode=opaque" frameborder="0"></iframe>
							
						</div>
					
					<?php } elseif ( preg_match( "/vimeo\.com/i" , get_post_meta( $post->ID, $shortname.'_video_url', true ) ) ) { ?>
						
						<!-- Vimeo Video -->
						<div class="article-wrapper type-video">
			
							<article>
							
								<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
								
								<?php raw_excerpt( 'excerptlength_blog', 'excerptmore' ); ?>
								
								<footer class="post-meta">
										
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
										
									</footer>
								
							</article>
						
							<?php preg_match ( "/http:\/\/(www\.)?vimeo.com\/(\d+)/", get_post_meta( $post->ID, $shortname.'_video_url', true ), $vimeo_id ); ?>
						
							<iframe src="http://player.vimeo.com/video/<?php echo $vimeo_id[2]; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=<?php echo stripslashes($theme_options[ $shortname.'_accent_colour' ]);?>" width="764" height="430" frameborder="0"></iframe>
							
						</div>
						
					
					<?php } else { ?>
						
						<!-- TEXT POST -->
						
						<?php if ( has_post_thumbnail() ) { ?>
							
							<!-- With Featured Image -->
							
							<div class="article-wrapper type-image hover_100">
				
								<article>
								
									<h1><span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span></h1>
									
									<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'type-gallery-landscape' );?></a>
									
									<section><?php raw_excerpt( 'excerptlength_blog', 'excerptmore' ); ?></section>
									
									<footer class="post-meta">
										
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
										
									</footer>
									
								</article>
								
							</div>
			
						<?php } else { ?>
						
							<!-- Without Featured Image -->
						
							<div class="article-wrapper type-text">
								
								<article>
								
									<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
				
									<section><?php raw_excerpt( 'excerptlength_blog', 'excerptmore' ); ?></section>
									
									<footer class="post-meta">
										
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
										
										<a href="<?php the_permalink(); ?>" class="more-link"><?php _e('More', 'raw_theme'); ?>+</a>
										
									</footer>
									
								</article>
								
							</div>
						
						<?php } ?>
						
					<?php } ?>
				
				<?php endwhile; ?>
	
			<?php endif; ?>
		
		</div>
	
	</div>
	
	<!-- PAGINATION -->
	<?php pagination(); ?>
	
	<div id="push"></div>
	
</div>

<?php get_footer( 'fixed' ); ?>