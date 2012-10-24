<?php

global $shortname, $theme_options;

if( $theme_options[$shortname.'_search_layout'] == __("Vertical Layout", "raw_theme") ) {
	include ('search-vertical.php');
} else {
	include ('search-horizontal.php');
}

 ?>