<?php

global $shortname, $theme_options;

get_header();

?>

<div id="wrapper">
	
	<?php include ('navigation.php'); ?>

	<div id="content" class="clearfix">
		
		<div class="article-wrapper clearfix">
			
			<header>
				<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
				<?php /* If this is a category archive */ if (is_category()) { ?>
					<h4><?php printf( __('Archive for &#8216;%s&#8217;', 'raw_theme'), single_cat_title( '', false ) ); ?></h4>
				<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
					<h4><?php printf( __('Posts Tagged &#8216;%s&#8217;', 'raw_theme'), single_tag_title( '', false ) ); ?></h4>
				<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
					<h4><?php printf( __('Archive for %s', 'raw_theme'), get_the_date() ); ?></h4>
				<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
					<h4><?php printf( __('Archive for %s', 'raw_theme'), get_the_date('F Y')); ?></h4>
				<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
					<h4><?php printf( __('Archive for %s', 'raw_theme'), get_the_date('Y')); ?></h4>
				<?php /* If this is an author archive */ } elseif (is_author()) { ?>
					<h4><?php _e('Author Archive', 'raw_theme'); ?></h4>
				<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
					<h4><?php _e('Blog Archives', 'raw_theme'); ?></h4>
				<?php } ?>
			</header>
			
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
			
			<?php else: ?>
			
				<article class="main">
					
					<h1><?php _e('No results found' ,'raw_theme'); ?></h1>
			
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
				
				</article>
				
			<?php endif; ?>	
			
		</div>
	
	</div>
	
	<div id="push"></div>
	
</div>

<?php get_footer(); ?>