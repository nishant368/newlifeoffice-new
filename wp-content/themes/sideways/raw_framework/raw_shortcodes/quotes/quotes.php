<?php

	// QUOTE RIGHT
	function quote_right($atts, $content){
		
		$new_content = remove_wpautop($content);
		
		return '<span class="quote_right">'.$new_content.'</span>';
	}
	add_shortcode('quote_right', 'quote_right');
	
	// QUOTE LEFT
	function quote_left($atts, $content){
		
		$new_content = remove_wpautop($content);
		
		return '<span class="quote_left">'.$new_content.'</span>';
	}
	add_shortcode('quote_left', 'quote_left');
	
	
	// ---------- TINYMCE BUTTONS ---------- //

	function add_raw_quotes_button() {
	   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		 return;
	   if ( get_user_option('rich_editing') == 'true') {
		 add_filter('mce_external_plugins', 'add_raw_quotes_tinymce_plugin');
		 add_filter('mce_buttons_3', 'register_raw_quotes_button');
	   }
	}

	add_action('init', 'add_raw_quotes_button');

	function register_raw_quotes_button($buttons) {
	   array_push($buttons, "raw_quotes" );
	   return $buttons;
	}

	function add_raw_quotes_tinymce_plugin($plugin_array) {
		
		$plugin_array['raw_quotes'] = get_bloginfo('template_url').'/raw_framework/raw_shortcodes/quotes/quotes.js';	   
		return $plugin_array;
		
	}

	add_filter( 'tiny_mce_version', 'my_refresh_mce');

	// ---------- END TINYMCE BUTTONS ---------- //

?>