<?php

global $shortname, $theme_options;

if( $theme_options[$shortname.'_archive_layout'] == __("Vertical Layout", "raw_theme") ) {
	include ('archive-vertical.php');
} else {
	include ('archive-horizontal.php');
}

?>