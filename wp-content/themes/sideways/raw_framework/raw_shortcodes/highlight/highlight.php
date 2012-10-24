<?php
	
	// HIGHLIGHT
	function highlight($atts, $content){
		
		return '<span class="highlight">'.$content.'</span>';
	}
	add_shortcode('highlight', 'highlight');	
	
	// ---------- TINYMCE BUTTONS ---------- //

	function add_raw_highlight_button() {
	   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		 return;
	   if ( get_user_option('rich_editing') == 'true') {
		 add_filter('mce_external_plugins', 'add_raw_highlight_tinymce_plugin');
		 add_filter('mce_buttons_3', 'register_raw_highlight_button');
	   }
	}

	add_action('init', 'add_raw_highlight_button');

	function register_raw_highlight_button($buttons) {
	   array_push($buttons, "raw_highlight" );
	   return $buttons;
	}

	function add_raw_highlight_tinymce_plugin($plugin_array) {
		
		$plugin_array['raw_highlight'] = get_bloginfo('template_url').'/raw_framework/raw_shortcodes/highlight/highlight.js';	   
		return $plugin_array;
		
	}

	add_filter( 'tiny_mce_version', 'my_refresh_mce');

	// ---------- END TINYMCE BUTTONS ---------- //

?>