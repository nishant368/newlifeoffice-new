<?php

	// DROPCAPS 1
	function dropcap_1($atts, $content){
		
		return '<span class="dropcap_1">'.$content.'</span>';
	}
	add_shortcode('dropcap_1', 'dropcap_1');
	
	// DROPCAPS 2
	function dropcap_2($atts, $content){
		
		return '<span class="dropcap_2">'.$content.'</span>';
	}
	add_shortcode('dropcap_2', 'dropcap_2');
	
	
	// ---------- TINYMCE BUTTONS ---------- //

	function add_raw_dropcaps_button() {
	   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		 return;
	   if ( get_user_option('rich_editing') == 'true') {
		 add_filter('mce_external_plugins', 'add_raw_dropcaps_tinymce_plugin');
		 add_filter('mce_buttons_3', 'register_raw_dropcaps_button');
	   }
	}

	add_action('init', 'add_raw_dropcaps_button');

	function register_raw_dropcaps_button($buttons) {
	   array_push($buttons, "raw_dropcaps" );
	   return $buttons;
	}

	function add_raw_dropcaps_tinymce_plugin($plugin_array) {
		
		$plugin_array['raw_dropcaps'] = get_bloginfo('template_url').'/raw_framework/raw_shortcodes/dropcaps/dropcaps.js';	   
		return $plugin_array;
		
	}

	add_filter( 'tiny_mce_version', 'my_refresh_mce');

	// ---------- END TINYMCE BUTTONS ---------- //

?>