<?php /*
Template Name: Portfolio Horizontal 
*/ ?>

<?php global $shortname, $theme_options;

get_header( 'horizontal'); ?>

<div id="wrapper">
	
	<?php include( 'navigation.php' ); ?>

	<div id="content" class="height-fix clearfix">

		<!-- PORTFOLIO FILTER -->
		<?php if ( get_post_meta( $post->ID, $shortname.'_portfolio_filter', true ) == 'on' ) { ?>
			
			<ul id="filter" class="fixed">
				
				<li><h4>Filter:</h4></li>
				<li class="current"><a title="all" href="#"><?php _e('All', 'raw_theme'); ?></a></li>
				
				<?php if ( get_post_meta( $post->ID, $shortname.'_portfolio_category', true ) == "All Categories" ) {
					
					$categories = get_terms( 'portfolio-categories' );							
					
					foreach ( $categories as $cat ) {
						echo '<li><a title="'. urldecode( $cat->slug ) .'" href="#">'. $cat->name .'</a></li>';
					}
		
				} else {
					
					$cat_id = get_term_by( 'name', get_post_meta( $post->ID, $shortname.'_portfolio_category', true ), 'portfolio-categories' ) ;							
					$categories = get_term_children( $cat_id->term_id, 'portfolio-categories' );
					
					foreach ( $categories as $cat ) {
						$term = get_term_by( 'id', $cat, 'portfolio-categories' );
										echo '<li><a title="'. urldecode( $term->slug ) .'" href="#">'. $term->name .'</a></li>';
					}
					
				} ?>
				
			</ul>
			
		<?php } ?>
		<!-- END PORTFOLIO FILTER -->			
		
		<!-- PORTFOLIO -->
		<?php if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		} elseif ( get_query_var('page') ) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		} ?>
		
		<?php if ( get_post_meta( $post->ID, $shortname.'_portfolio_category', true ) == "All Categories") {
	
			$query_args = array(
				'post_type' => 'portfolio',
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'posts_per_page' => get_post_meta( $post->ID, $shortname.'_portfolio_post_per_page', true ),
				'paged' => $paged
			); 
		
		} else {
			
			$category = get_term_by( 'name', get_post_meta( $post->ID, $shortname.'_portfolio_category', true ), 'portfolio-categories');
			
			$query_args = array(
				'post_type' => 'portfolio', 
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'taxonomy' => 'portfolio-categories',
				'field' => 'slug',
				'term' => $category->slug,
				'posts_per_page' => get_post_meta( $post->ID, $shortname.'_portfolio_post_per_page', true ),
				'paged' => $paged
			);
			
		}
		
		$portfolio_query = new WP_query( $query_args ); ?>
		
		<?php if ( $portfolio_query->have_posts() ) : ?>
		
			<!-- PORTFOLIO ITEMS -->
			<div id="article-list">			
				
				<?php while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post(); ?>
					
					<?php $post_categories = get_the_terms( $post->ID, 'portfolio-categories' );?>
					<?php $categories_list = NULL; ?>
					
					<?php if ( $post_categories != NULL ) {
						foreach ( $post_categories as $category ) { 
							$slug = urldecode( $category->slug );
							$categories_list .= $slug .' '; 
						}
					} ?>
					
					<?php if ( preg_match( "/youtube\.com\/watch/i", get_post_meta( $post->ID, $shortname.'_video_url', true ) ) ) { ?>
					
						<!-- YouTube Video -->
						<div class="article-wrapper type-video <?php echo $categories_list; ?>">
			
							<article>
								
								<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
								
								<section>									
									<?php raw_excerpt( 'excerptlength_portfolio', 'excerptmore' ); ?>			
								</section>
						
							</article>
							
							<iframe title="YouTube video player" class="youtube-player" type="text/html" width="764" height="430" src="http://www.youtube.com/embed/<?php echo getYTid( get_post_meta( $post->ID, $shortname.'_video_url', true ) ); ?>?rel=0&amp;hd=1&amp;wmode=opaque" frameborder="0"></iframe>
							
						</div>
					
					<?php } elseif ( preg_match( "/vimeo\.com/i", get_post_meta( $post->ID, $shortname.'_video_url', true ) ) ) { ?>
						
						<!-- Vimeo Video -->
						<div class="article-wrapper type-video <?php echo $categories_list; ?>">
			
							<article>
							
								<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
								
								<section>
									<?php raw_excerpt( 'excerptlength_portfolio', 'excerptmore' ); ?>			
								</section>
							
							</article>
							
							<?php preg_match ( "/http:\/\/(www\.)?vimeo.com\/(\d+)/", get_post_meta( $post->ID, $shortname.'_video_url', true ), $vimeo_id ); ?>
						
							<iframe src="http://player.vimeo.com/video/<?php echo $vimeo_id[2]; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=<?php echo stripslashes($theme_options[ $shortname.'_accent_colour' ]);?>" width="764" height="430" frameborder="0"></iframe>							
						</div>
					
					<?php } else { ?>
					
						<!-- TEXT POST -->						
						<?php if ( has_post_thumbnail() ) { ?>
							
							<!-- With Featured Image -->
							<div class="article-wrapper type-image hover_100 <?php echo $categories_list; ?>">
								
								<article>
								
									<h1><span><?php the_title(); ?></span></h1>
									
									<?php
								
									// If set to open in lightbox...
									if ( get_post_meta( $post->ID, $shortname.'_open_lightbox', true ) == 'on' ) {
							
										$set = $post->ID;
										
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
										
										$attachments = get_posts( $args );
										
										if ($attachments) {				
										
											$isFirst = true;
											
											// GALLERY ITEMS
											$gallery = '<div style="display:none;">';
												
												foreach ($attachments as $attachment) {
												 
													$attachurl = wp_get_attachment_url( $attachment->ID );
													
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
										
										<?php										
											echo $gallery;
											unset( $gallery );
										?>
										
									<?php } else { ?>
										
										<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'type-gallery-landscape' );?></a>
									
									<?php } ?>
									
									<section>
										<?php raw_excerpt( 'excerptlength_portfolio', 'excerptmore' ); ?>				
									</section>							
									
								</article>
								
							</div>
			
						<?php } else { ?>
						
							<!-- Without Featured Image -->						
							<div class="article-wrapper type-text <?php echo $categories_list; ?>">
								
								<article>
								
									<h1><?php the_title(); ?></h1>
				
									<section>
										<?php raw_excerpt( 'excerptlength_portfolio', 'excerptmore' ); ?>			
									</section>
									
									<footer class="post-meta">
										
										<a href="<?php the_permalink(); ?>" class="more-link"><?php _e( 'More', 'raw_theme' ); ?>+</a>
										
									</footer>
									
								</article>
								
							</div>
						
						<?php } ?>
						
					<?php } ?>
				
				<?php endwhile; ?>				
				
			</div>
			
		<?php endif; ?>
		
	</div>
	<!-- END PORTFOLIO -->
	
	<!-- PAGINATION -->
	<?php pagination( $portfolio_query->max_num_pages ); ?>
	
	<?php wp_reset_query(); ?>
	
	<div id="push"></div>
	
</div>

<?php get_footer( 'fixed' ); ?>