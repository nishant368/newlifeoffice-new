<?php

	// YOUTUBE
	function youtube($atts, $content = null) {
        extract(shortcode_atts(array(
			'id' => '',
			'title' => ''
		), $atts));
		
        return '<dl class="gallery-item">
			<dt class="gallery-icon youtube">
				<a href="http://www.youtube.com/watch?v='.$id.'" title="'.$title.'" rel="prettyPhoto">
					<img width="354" height="266" src="http://img.youtube.com/vi/'.$id.'/0.jpg" alt="'.$title.'" />
				</a>
			</dt>
			<dd class="gallery-caption" style="opacity: 1; ">
				'.$title.'
			</dd>
		</dl>';
		
	}
	add_shortcode('youtube', 'youtube');
	
	
	// ---------- TINYMCE BUTTONS ---------- //

	function add_raw_youtube_button() {
	   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		 return;
	   if ( get_user_option('rich_editing') == 'true') {
		 add_filter('mce_external_plugins', 'add_raw_youtube_tinymce_plugin');
		 add_filter('mce_buttons_3', 'register_raw_youtube_button');
	   }
	}

	add_action('init', 'add_raw_youtube_button');

	function register_raw_youtube_button($buttons) {
	   array_push($buttons, "raw_youtube", "|" );
	   return $buttons;
	}

	function add_raw_youtube_tinymce_plugin($plugin_array) {
		
		$plugin_array['raw_youtube'] = get_bloginfo('template_url').'/raw_framework/raw_shortcodes/youtube/youtube.js';	   
		return $plugin_array;
		
	}

	add_filter( 'tiny_mce_version', 'my_refresh_mce');

	// ---------- END TINYMCE BUTTONS ---------- //

?>