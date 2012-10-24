<?php

	// DIVIDER
	function divider($atts,  $content = null){
		
		extract(shortcode_atts(array(
			'style' => ''
		), $atts));
		
		if ( $style == 'thin' ) { // Thin Divider
			return '<hr class="thin"/>';
		} elseif ( $style == 'top' ) { // Divider With Top Link
			return '<div class="divider top"><a href="#top">top</a></div>';
		} else { // Think Divider
			return '<hr/>';
		}
	}
	add_shortcode('divider', 'divider');
	
	
	// ---------- TINYMCE BUTTONS ---------- //

	function add_raw_divider_button() {
	   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		 return;
	   if ( get_user_option('rich_editing') == 'true') {
		 add_filter('mce_external_plugins', 'add_raw_divider_tinymce_plugin');
		 add_filter('mce_buttons_3', 'register_raw_divider_button');
	   }
	}

	add_action('init', 'add_raw_divider_button');

	function register_raw_divider_button($buttons) {
	   array_push($buttons, "raw_divider" );
	   return $buttons;
	}

	function add_raw_divider_tinymce_plugin($plugin_array) {
		
		$plugin_array['raw_divider'] = get_bloginfo('template_url').'/raw_framework/raw_shortcodes/divider/divider.js';	   
		return $plugin_array;
		
	}

	add_filter( 'tiny_mce_version', 'my_refresh_mce');

	// ---------- END TINYMCE BUTTONS ---------- //

?>