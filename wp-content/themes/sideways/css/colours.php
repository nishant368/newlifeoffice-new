<?php 
	header('Content-type: text/css');
	
	// Setup location of WordPress
	$absolute_path = __FILE__;
	$path_to_file = explode( 'wp-content', $absolute_path );
	$path_to_wp = $path_to_file[0];

	// Access WordPress
	require_once( $path_to_wp.'/wp-load.php' );

	// Get theme options
	global $shortname;
	$theme_options = get_option( $shortname.'_theme_options' );
	
	$accent_colour = $theme_options[ $shortname.'_accent_colour' ];
?>
@charset "UTF-8";

a,
.info .more-link,
label span {
	color: <?php echo '#'. $accent_colour; ?>;
}

.highlight,
.button,
.comment-reply-link,
input[type=submit],
.dropcap_2  {
	background-color: <?php echo '#'. $accent_colour; ?>;
}