<?php

global $shortname, $theme_options;

if( $theme_options[$shortname.'_blog_layout'] == __("Vertical Layout", "raw_theme") ) {
	include ('blog-vertical.php');
} else {
	include ('blog-horizontal.php');
}

?>