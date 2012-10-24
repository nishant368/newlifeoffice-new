<?php

	// FOURTH
	function fourth($atts, $content){
		
		extract(shortcode_atts(array(
			'end' => ''
		), $atts));
		
		$new_content = remove_wpautop($content);
		
		if ( $end == 'true' ) {
			return '<div class="fourth end">'.$new_content.'</div>';
		} else {
			return '<div class="fourth">'.$new_content.'</div>';
		}
		
	}
	//add_shortcode('fourth', 'fourth');
	
	// THIRD
	function third($atts, $content){
		
		extract(shortcode_atts(array(
			'end' => ''
		), $atts));
		
		$new_content = remove_wpautop($content);
		
		if ( $end == 'true' ) {
			return '<div class="third end">'.$new_content.'</div>';
		} else {
			return '<div class="third">'.$new_content.'</div>';
		}
		
	}
	add_shortcode('third', 'third');
	
	// HALF
	function half($atts, $content){
	
		extract(shortcode_atts(array(
			'end' => ''
		), $atts));
		
		$new_content = remove_wpautop($content);
		
		if ( $end == 'true' ) {
			return '<div class="half end">'.$new_content.'</div>';
		} else {
			return '<div class="half">'.$new_content.'</div>';
		}
		
	}
	add_shortcode('half', 'half');
	
	// TWO THIRDS
	function twothirds($atts, $content){
	
		extract(shortcode_atts(array(
			'end' => ''
		), $atts));
		
		$new_content = remove_wpautop($content);
		
		if ( $end == 'true' ) {
			return '<div class="two-thirds end">'.$new_content.'</div>';
		} else {
			return '<div class="two-thirds">'.$new_content.'</div>';
		}
	}
	add_shortcode('twothirds', 'twothirds');
	
	
	// ---------- TINYMCE BUTTONS ---------- //

	function add_raw_columns_button() {
	   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		 return;
	   if ( get_user_option('rich_editing') == 'true') {
		 add_filter('mce_external_plugins', 'add_raw_columns_tinymce_plugin');
		 add_filter('mce_buttons_3', 'register_raw_columns_button');
	   }
	}

	add_action('init', 'add_raw_columns_button');

	function register_raw_columns_button($buttons) {
	   array_push($buttons, "raw_columns" );
	   return $buttons;
	}

	function add_raw_columns_tinymce_plugin($plugin_array) {
		
		$plugin_array['raw_columns'] = get_bloginfo('template_url').'/raw_framework/raw_shortcodes/columns/columns.js';	   
		return $plugin_array;
		
	}

	add_filter( 'tiny_mce_version', 'my_refresh_mce');

	// ---------- END TINYMCE BUTTONS ---------- //

?>