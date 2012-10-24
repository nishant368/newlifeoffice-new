<?php

	// TOGGLE
	function toggle($atts, $content){
		
		extract(shortcode_atts(array(
			'title' => ''
		), $atts));
		
		$new_content = remove_wpautop($content);
		
		return '<div class="toggle-content expanding">
			<div class="expand-button"><p>'.$title.'</p></div>
			<div class="expand">'.$new_content.'</div>
		</div>';
		
	}
	add_shortcode('toggle', 'toggle');
	
	// ---------- TINYMCE BUTTONS ---------- //

	function add_raw_toggle_button() {
	   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		 return;
	   if ( get_user_option('rich_editing') == 'true') {
		 add_filter('mce_external_plugins', 'add_raw_toggle_tinymce_plugin');
		 add_filter('mce_buttons_3', 'register_raw_toggle_button');
	   }
	}

	add_action('init', 'add_raw_toggle_button');

	function register_raw_toggle_button($buttons) {
	   array_push($buttons, "raw_toggle" );
	   return $buttons;
	}

	function add_raw_toggle_tinymce_plugin($plugin_array) {
		
		$plugin_array['raw_toggle'] = get_bloginfo('template_url').'/raw_framework/raw_shortcodes/toggle/toggle.js';	   
		return $plugin_array;
		
	}

	add_filter( 'tiny_mce_version', 'my_refresh_mce');

	// ---------- END TINYMCE BUTTONS ---------- //

?>