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
				
				<!-- TITLE -->
				<h1><?php echo $theme_options[$shortname.'_404_title']; ?></h1>
			
				<p><?php echo stripslashes( $theme_options[$shortname.'_404_message'] ); ?></p>
			
				<a href="<?php bloginfo('url'); ?>/" class="button right"><?php _e("Return to Home page", 'raw_theme'); ?></a>
		
			</article>
			
			<!-- SIDEBAR -->
			<ul id="article-sidebar">
				
				<?php if ( !function_exists('dynamic_sidebar') || !generated_dynamic_sidebar( __('404 Sidebar', 'raw_theme') ) ) { ?>
		
				<?php } ?>				
			
			</ul>			
			
		</div>
		
	</div>
	
	<div id="push"></div>
	
</div>

<?php get_footer(); ?>