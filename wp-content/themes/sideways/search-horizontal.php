<?php

global $shortname, $theme_options;

get_header( 'horizontal');

?>

<div id="wrapper">
	
	<?php include ('navigation.php'); ?>

	<div id="content" class="height-fix clearfix">
		
		<div id="filter" class="fixed">
			
			<h4><?php printf( __('Search Results for "%s"', 'raw_theme'), get_search_query() ); ?></h4>
			
		</div>

		<?php if ( have_posts() ) : ?>
		
			<!-- ITEMS -->
			<div id="article-list">			
				
				<?php while ( have_posts() ) : the_post(); ?>					
					
					<?php if ( preg_match( "/youtube\.com\/watch/i" , get_post_meta( $post->ID, $shortname.'_video_url', true ) ) ) { ?>
					
						<!-- YouTube Video -->
						<div class="article-wrapper type-video">
			
							<article>
								
								<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
								
								<section><?php raw_excerpt( 'excerptlength_blog', 'excerptmore' ); ?></section>
						
							</article>
							
							<iframe title="YouTube video player" class="youtube-player" type="text/html" width="764" height="430" src="http://www.youtube.com/embed/<?php echo getYTid( get_post_meta( $post->ID, $shortname.'_video_url', true ) ); ?>?rel=0&amp;hd=1&amp;wmode=opaque" frameborder="0"></iframe>
							
						</div>
					
					<?php } elseif ( preg_match( "/vimeo\.com/i" , get_post_meta( $post->ID, $shortname.'_video_url', true ) ) ) { ?>
						
						<!-- Vimeo Video -->
						<div class="article-wrapper type-video">
			
							<article>
							
								<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
								
								<section><?php raw_excerpt( 'excerptlength_blog', 'excerptmore' ); ?></section>
							
							</article>
							
							<?php preg_match ( "/http:\/\/(www\.)?vimeo.com\/(\d+)/", get_post_meta( $post->ID, $shortname.'_video_url', true ), $vimeo_id ); ?>
						
							<iframe src="http://player.vimeo.com/video/<?php echo $vimeo_id[2]; ?>?title=0&amp;byline=0&amp;portrait=0" width="764" height="430" frameborder="0"></iframe>
							
						</div>
					
					<?php } else { ?>
					
						<!-- TEXT POST -->						
						<?php if ( has_post_thumbnail() ) { ?>
							
							<!-- With Featured Image -->
							<div class="article-wrapper type-image hover_100 <?php foreach ($post_categories as $category) {$name = sanitize_title($category->name);echo $name.' ';}?>">
								
								<article>
								
									<h1><span><?php the_title(); ?></span></h1>
									
									<?php
								
									// If set to open in lightbox...
									if ( get_post_meta( $post->ID, $shortname.'_open_lightbox', true ) == 'on' ) {
							
										$set = rand(0,99999);
										
										// Get Post Thumbnail URL
										$src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'Full');
										
										// Get lightbox items
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
										
											$isFirst = true;
											
											// GALLERY ITEMS
											$gallery = '<div style="display:none;">';
												
												foreach ($attachments as $attachment) {
												 
													$attachurl = wp_get_attachment_url($attachment->ID);	
													
													if ($isFirst) {
														
														$feature_description = $attachment->post_content;
														$first_url = $attachurl;
														$isFirst = false;
														continue;
													
													} else {   
														
														$description = $attachment->post_content;
														$gallery .= '<a href="'. $attachurl .'" rel="prettyPhoto['.$set.']" title="'. $description .'"></a>';
														
													}											
													
													
												}
											
											$gallery .= '</div>';
							
										} ?>
										
										<a href="<?php echo $first_url; ?>" rel="prettyPhoto[<?php echo $set; ?>]" title="<?php echo $feature_description; ?>"><?php the_post_thumbnail( 'type-gallery-landscape' );?></a>
										
										<?php echo $gallery; ?>
										
									<?php } else { ?>
										
										<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'type-gallery-landscape' );?></a>
									
									<?php } ?>
									
									<section><?php raw_excerpt( 'excerptlength_blog', 'excerptmore' ); ?></section>							
									
								</article>
								
							</div>
			
						<?php } else { ?>
						
							<!-- Without Featured Image -->						
							<div class="article-wrapper type-text">
								
								<article>
								
									<h1><?php the_title(); ?></h1>
				
									<section><?php raw_excerpt( 'excerptlength_blog', 'excerptmore' ); ?></section>
									
									<footer class="post-meta">
										
										<a href="<?php the_permalink(); ?>" class="more-link"><?php _e('More', 'raw_theme'); ?>+</a>
										
									</footer>
									
								</article>
								
							</div>
						
						<?php } ?>
						
					<?php } ?>
				
				<?php endwhile; ?>				
				
			</div>
		
		<?php else: ?>
			
			<div id="article-list">	
				
				<div class="article-wrapper type-text">
					
					<article>
					
						<h1><?php _e('No results found' ,'raw_theme'); ?></h1>
				
						<section>
						
							<p><?php _e('Please try another search term.' ,'raw_theme'); ?></p>
						
						</section>
					
					</article>
					
				</div>
				
			</div>
		
		<?php endif; ?>
	
	</div>
	
	<!-- PAGINATION -->
	<?php pagination( $wp_query->max_num_pages ); ?>
	
	<div id="push"></div>
	
</div>

<?php get_footer( 'fixed' ); ?>