<?php

global $shortname, $theme_options;

get_header( 'horizontal');

?>

<div id="wrapper">
	
	<?php include ('navigation.php'); ?>

	<div id="content" class="height-fix clearfix">
		
		<div id="filter" class="fixed">
			
			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
			<?php /* If this is a category archive */ if (is_category()) { ?>
				<h4><?php printf( __('Archive for the &#8216;%s&#8217; category', 'raw_theme'), single_cat_title( "", false ) ); ?></h4>
			<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
				<h4><?php printf( __('Posts Tagged &#8216;%s&#8217;', 'raw_theme'), single_tag_title( "", false ) ); ?></h4>
			<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				<h4><?php printf( __('Archive for %s', 'raw_theme'), the_time('F jS, Y')); ?></h4>
			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				<h4><?php printf( __('Archive for %s', 'raw_theme'), the_time('F, Y')); ?></h4>
			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				<h4><?php printf( __('Archive for %s', 'raw_theme'), the_time('Y')); ?></h4>
			<?php /* If this is an author archive */ } elseif (is_author()) { ?>
				<h4><?php _e('Author Archive', 'raw_theme'); ?></h4>
			<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<h4><?php _e('Blog Archives', 'raw_theme'); ?></h4>
			<?php } ?>
			
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
						
							<iframe src="http://player.vimeo.com/video/<?php echo $vimeo_id[2]; ?>?title=0&amp;byline=0&amp;portrait=0" width="764" height="430" frameborder="0"></iframe>
							
						</div>
						
					
					<?php } else { ?>
						
						<!-- TEXT POST -->
						
						<?php if ( has_post_thumbnail() ) { ?>
							
							<!-- With Featured Image -->
							
							<div class="article-wrapper type-image hover_100">
				
								<article>
								
									<h1><span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span></h1>
									
									<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'type-gallery-landscape' );?></a>
									
									<section><?php the_excerpt(); ?></section>
									
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
				
			</div>
		
		<?php else: ?>
			
			<div id="article-list">	
				
				<div class="article-wrapper type-text">
					
					<article>
					
						<h1><?php _e('No results found' ,'raw_theme'); ?></h1>
				
						<section>
						
							<p>
								<?php if ( is_category() ) { // If this is a category archive
									printf( __('Sorry, but there aren\'t any posts in the %s category yet.', 'raw_theme'), single_cat_title('',false) );
								} else if ( is_date() ) { // If this is a date archive
									_e('Sorry, but there aren\'t any posts with this date.', 'raw_theme');
								} else if ( is_author() ) { // If this is a category archive
									$userdata = get_userdatabylogin( get_query_var('author_name') );
									printf( __('Sorry, but there aren\'t any posts by %s yet.', 'raw_theme'), $userdata->display_name );
								} else {
									_e( 'No posts found.', 'raw_theme' );
								} ?>
							</p>
						
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