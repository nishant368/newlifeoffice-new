<?php
	
	// DOWNLOAD BOX
	function download($atts, $content){
	
		$new_content = remove_wpautop($content);
		return '<div class="download_box">'.$new_content.'</div>';
		
	}
	add_shortcode('download', 'download');
	
	// INFO BOX
	function info($atts, $content){
		
		$new_content = remove_wpautop($content);
		return '<div class="info_box">'.$new_content.'</div>';
	}
	add_shortcode('info', 'info');
	
	// WARNING BOX
	function warning($atts, $content){
		
		$new_content = remove_wpautop($content);
		return '<div class="warning_box">'.$new_content.'</div>';
	}
	add_shortcode('warning', 'warning');
	
	
	// ---------- TINYMCE BUTTONS ---------- //

	function add_raw_boxes_button() {
	   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		 return;
	   if ( get_user_option('rich_editing') == 'true') {
		 add_filter('mce_external_plugins', 'add_raw_boxes_tinymce_plugin');
		 add_filter('mce_buttons_3', 'register_raw_boxes_button');
	   }
	}

	add_action('init', 'add_raw_boxes_button');

	function register_raw_boxes_button($buttons) {
	   array_push($buttons, "raw_boxes" );
	   return $buttons;
	}

	function add_raw_boxes_tinymce_plugin($plugin_array) {
		
		$plugin_array['raw_boxes'] = get_bloginfo('template_url').'/raw_framework/raw_shortcodes/boxes/boxes.js';	   
		return $plugin_array;
		
	}

	add_filter( 'tiny_mce_version', 'my_refresh_mce');

	// ---------- END TINYMCE BUTTONS ---------- //

?>