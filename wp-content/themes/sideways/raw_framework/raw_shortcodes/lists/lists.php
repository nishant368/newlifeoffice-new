<?php

	// LISTS
	function create_list($atts, $content){
		extract(shortcode_atts(array(
			'style' => 'check'
		), $atts));
		
		$new_content = preg_replace('#^<\/p>|<p>$#', '', $content);
		return '<ul class="'.$style.'">'.$new_content.'</ul>';
	}
	add_shortcode('list', 'create_list');
	
	
	// ---------- TINYMCE BUTTONS ---------- //

	function add_raw_lists_button() {
	   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		 return;
	   if ( get_user_option('rich_editing') == 'true') {
		 add_filter('mce_external_plugins', 'add_raw_lists_tinymce_plugin');
		 add_filter('mce_buttons_3', 'register_raw_lists_button');
	   }
	}

	add_action('init', 'add_raw_lists_button');

	function register_raw_lists_button($buttons) {
	   array_push($buttons, "raw_lists" );
	   return $buttons;
	}

	function add_raw_lists_tinymce_plugin($plugin_array) {
		
		$plugin_array['raw_lists'] = get_bloginfo('template_url').'/raw_framework/raw_shortcodes/lists/lists.js';	   
		return $plugin_array;
		
	}

	add_filter( 'tiny_mce_version', 'my_refresh_mce');

	// ---------- END TINYMCE BUTTONS ---------- //

?>