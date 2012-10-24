<?php
	
	// REMOVE DEFAULT GALLERY STYLING
	function raw_remove_gallery_css( $css ) {
		return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
	}
	add_filter( 'gallery_style', 'raw_remove_gallery_css' );
	
	// ALLOW SHORTCODES IN WIDGETS
	add_filter('widget_text', 'do_shortcode');
	
	// REMOVE AUTOP FROM SHORTCODES
	remove_filter ('do_shortcode', 'wpautop');

	// BOXES
	include('boxes/boxes.php');
	
	// BUTTONS
	include('button/button.php');
	
	// CLEARBOTH
	include('clearboth/clearboth.php');
	
	// COLUMNS
	include('columns/columns.php');
	
	// DIVIDER
	include('divider/divider.php');
	
	// DROPCAPS
	include('dropcaps/dropcaps.php');
	
	// HIGHLIGHT
	include('highlight/highlight.php');
	
	// LISTS
	include('lists/lists.php');
	
	// QUOTES
	include('quotes/quotes.php');
	
	// TOGGLE
	include('toggle/toggle.php');
	
	// VIDEO
	//include('video/video.php');
	
	// VIMEO
	include('vimeo/vimeo.php');
	
	// YOUTUBE
	include('youtube/youtube.php');
	
	// TinyMCE VERSION HACK
	function my_refresh_mce($ver) {
	  $ver += 3;
	  return $ver;
	}
	
?>