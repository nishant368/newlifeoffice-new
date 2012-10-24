<?php
	
$themename = 'Sideways';
$shortname = 'sideways';
$theme_options = get_option( $shortname.'_theme_options' );

include_once TEMPLATEPATH.'/raw_framework/plugins/pagination.php';
include_once TEMPLATEPATH.'/raw_framework/plugins/raw_widgets.php';
include_once TEMPLATEPATH.'/raw_framework/plugins/sidebar_generator.php';
include_once TEMPLATEPATH.'/raw_framework/raw_comments.php';
include_once TEMPLATEPATH.'/raw_framework/raw_functions.php';
include_once TEMPLATEPATH.'/raw_framework/raw_navigation.php';
include_once TEMPLATEPATH.'/raw_framework/raw_panel/raw_panel.php';
include_once TEMPLATEPATH.'/raw_framework/raw_shortcodes/raw_shortcodes.php';

?>