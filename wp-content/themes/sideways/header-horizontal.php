<?php

global $shortname, $theme_options;

// Enqueue jQuery mousewheel script
wp_register_script('mousewheel', get_bloginfo('template_url').'/js/jquery.mousewheel.min.js');
wp_enqueue_script('mousewheel');

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	
	<title>
		<?php global $page, $paged;

		wp_title( '|', true, 'right' );

		// Add the blog name.
		bloginfo( 'name' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			echo " | $site_description";
		}
		
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 ) {
			echo ' | ' . sprintf( __( 'Page %s', 'raw_theme' ), max( $paged, $page ) );
		}
		?>
	</title>
	
	<meta charset="<?php bloginfo('charset'); ?>" />
	
	<?php if ( $theme_options[$shortname.'_favicon'] != '') {
		// FAVICON
		echo '<link rel="shortcut icon" href="'.stripslashes( $theme_options[$shortname.'_favicon'] ).'" />';
	} ?>	
	<?php if ( $theme_options[$shortname.'_apple_bookmark'] != '') {
		// APPLE BOOKMARK
		echo '<link rel="apple-touch-icon" href="'.stripslashes( $theme_options[$shortname.'_apple_bookmark'] ).'" />';
	} ?>
	
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_url' ); ?>" media="screen"/>
	<link rel="stylesheet" href="<?php bloginfo( 'template_directory' ); ?>/css/colours.php" type="text/css" media="screen"/>
	
	<?php if ( $theme_options[$shortname.'_prettyphoto'] == 'true' ) { ?>
		<!-- PRETTY PHOTO -->
		<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/prettyPhoto_h.css" media="screen" />
	<?php } ?>

	<!--[if lt IE 9]>
		<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie8.css" media="screen" />
	<![endif]-->
	<!--[if lt IE 8]>
		<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie7.css" media="screen" />
	<![endif]-->
	
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<?php if( $theme_options[$shortname.'_custom_css'] != '' ) { ?>
		<!-- CUSTOM CSS -->
		<style type="text/css">		
			<?php echo stripslashes( $theme_options[$shortname.'_custom_css'] ); ?>		
		</style>		
	<?php }; ?>
	
	<?php wp_head(); ?>
	
	<?php get_template_part( 'background' ); ?>	
	
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/hscroll.js"></script> 
	
</head>
<body <?php body_class(); ?>>