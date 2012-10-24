<?php /*
Template Name: Portfolio Grid 
*/ ?>

<?php global $shortname, $theme_options;

get_header();

?>

<div id="wrapper">
	
	<?php include( 'navigation.php' ); ?>

	<div id="content" class="clearfix">
	
		<div class="article-wrapper">
			
			<article>
				
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
			
						<!-- PORTFOLIO FILTER -->
						<?php if ( get_post_meta( $post->ID, $shortname.'_portfolio_filter', true ) == 'on' ) { ?>
							
							<ul id="filter">
								
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
					
					<?php endwhile; ?>
	
				<?php endif; ?>
				
				<!-- PORTFOLIO GRID -->
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

					<ul id="portfolio" class="clearfix">
						
						<?php while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post(); ?>
			
							<?php $post_categories = get_the_terms( $post->ID, 'portfolio-categories' );?>
							<?php $categories_list = NULL; ?>
							
							<?php if ( $post_categories != NULL ) {
								foreach ( $post_categories as $category ) { 
									$slug = urldecode( $category->slug );
									$categories_list .= $slug.' '; 
								}
							} ?>
							
							<li class="<?php echo $categories_list; ?>">
								
								<!-- THUMBNAIL -->
								<?php the_post_thumbnail('thumbnail'); ?>
								
								<?php // If set to open in lightbox...
								if ( get_post_meta( $post->ID, $shortname.'_open_lightbox', true ) == 'on' ) {
							
									$set = $post->ID;
									
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
								
									<div class="info">
										
										<h1>
											<?php if ( get_post_meta( $post->ID, $shortname.'_page_title', true ) ) {
												echo get_post_meta( $post->ID, $shortname.'_page_title', true );				
											} else {
												the_title();
											}?>
										</h1>
										
										<?php raw_excerpt( 'excerptlength_portfolio', 'excerptmore' ); ?>					
										
										<?php if ( get_post_meta( $post->ID, $shortname.'_video_url', true ) != '' ) { ?>
											
											<a href="<?php echo get_post_meta( $post->ID, $shortname.'_video_url', true ); ?>" rel="prettyPhoto" class="more-link" title="" ><?php _e( 'More', 'raw_theme'); ?>+</a>
											
										<?php } else { ?>
											
											<a href="<?php echo $first_url; ?>" rel="prettyPhoto[<?php echo $set; ?>]" title="<?php echo $feature_description; ?>" class="more-link"><?php _e( 'More', 'raw_theme'); ?>+</a>
											
											<?php										
												echo $gallery;
												unset($gallery);										
											?>
											
										<?php } ?>
										
									</div>								
								
								<?php } else { ?>	
									
									<div class="info">
										
										<h1>
											<?php if ( get_post_meta( $post->ID, $shortname.'_page_title', true ) != "" ) {
												echo get_post_meta( $post->ID, $shortname.'_page_title', true );				
											} else {
												the_title();
											}?>
										</h1>
										
										<?php raw_excerpt( 'excerptlength_portfolio', 'excerptmore' ); ?>
										
										<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="more-link"><?php _e( 'More', 'raw_theme'); ?>+</a>
										
									</div>			
									
								<?php } ?>	
						
							</li>
						
						<?php endwhile; ?>					
					
					</ul>
				
					<?php pagination( $portfolio_query->max_num_pages ); ?>
					
					<div class="clearboth"></div>
					
				<?php endif; ?>
				
				<?php wp_reset_query(); ?>
				
			</article>
		
		</div>
	
	</div>
	
	<div id="push"></div>
	
</div>

<?php get_footer(); ?>