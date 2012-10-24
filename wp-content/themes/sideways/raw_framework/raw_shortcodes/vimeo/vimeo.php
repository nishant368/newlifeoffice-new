<?php

	// VIMEO
	function vimeo($atts, $content = null) {
        extract(shortcode_atts(array(
			'id' => ''
		), $atts));
		
		$VideoInfo = getVimeoInfo($id);
		$thumbnail = $VideoInfo['thumbnail_large'];
		$title = $VideoInfo ['title'];
		$url = $VideoInfo ['url'];
	
		return '<dl class="gallery-item">
			<dt class="gallery-icon vimeo">
				<a href="'.$url.'" title="'.$title.'" rel="prettyPhoto">
					<img width="300" height="200" src="'.$thumbnail.'" alt="'.$title.'" />
				</a>
			</dt>
			<dd class="gallery-caption" style="opacity: 1; ">
				'. truncate( $title, 20) .'
			</dd>
		</dl>';
		
	}
	add_shortcode('vimeo', 'vimeo');
	
	function getVimeoInfo($id) {
		if (!function_exists('curl_init')) die('CURL is not installed!');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://vimeo.com/api/v2/video/$id.php");
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		$output = unserialize(curl_exec($ch));
		$output = $output[0];
		curl_close($ch);
		return $output;
	}
	
	
	// ---------- TINYMCE BUTTONS ---------- //

	function add_raw_vimeo_button() {
	   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		 return;
	   if ( get_user_option('rich_editing') == 'true') {
		 add_filter('mce_external_plugins', 'add_raw_vimeo_tinymce_plugin');
		 add_filter('mce_buttons_3', 'register_raw_vimeo_button');
	   }
	}

	add_action('init', 'add_raw_vimeo_button');

	function register_raw_vimeo_button($buttons) {
	   array_push($buttons, "raw_vimeo" );
	   return $buttons;
	}

	function add_raw_vimeo_tinymce_plugin($plugin_array) {
		
		$plugin_array['raw_vimeo'] = get_bloginfo('template_url').'/raw_framework/raw_shortcodes/vimeo/vimeo.js';	   
		return $plugin_array;
		
	}

	add_filter( 'tiny_mce_version', 'my_refresh_mce');

	// ---------- END TINYMCE BUTTONS ---------- //

?>