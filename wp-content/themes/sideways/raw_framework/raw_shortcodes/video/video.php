<?php

	// VIDEO
	function video($atts, $content){
		 extract(shortcode_atts(array(
			'title' => '',
			'url' => '',
			'image' => '',
			'height' => '480',
			'width' => '270',
			'align' => 'none', // none, alignleft, alignright, aligncenter
			'controlbar' => 'bottom', // bottom, over, top
			'autostart' => 'false', // false, true
			'icons' => 'true', // true, false
			'stretching' => 'fill', // fill, exactfit, uniform, none
			'skin' => ''
		), $atts));
		
		return '<div class="videoplayer '.$align.'">
			<div id="'.sanitize_title( $title ).'">
				<script type="text/javascript">
					jwplayer("'.sanitize_title( $title ).'").setup({
						file: "'.$url.'",
						height: '.$height.',
						width: '.$width.',
						controlbar: "'.$controlbar.'",
						icons: "'.$icons.'",
						stretching: "'.$stretching.'",
						autostart: '.$autostart.',
						flashplayer: "'.get_bloginfo('template_directory').'/raw_framework/plugins/jwplayer/player.swf",
						skin: "'.get_bloginfo('template_directory').'/raw_framework/plugins/jwplayer/'.$skin.'"
					});
				</script>
			</div>
		</div>';

	}
	add_shortcode('video', 'video');
	
	// ---------- TINYMCE BUTTONS ---------- //

	function add_raw_video_button() {
	   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		 return;
	   if ( get_user_option('rich_editing') == 'true') {
		 add_filter('mce_external_plugins', 'add_raw_video_tinymce_plugin');
		 add_filter('mce_buttons_3', 'register_raw_video_button');
	   }
	}
	
	add_action('init', 'add_raw_video_button');

	function register_raw_video_button($buttons) {
	   array_push($buttons, "raw_video" );
	   return $buttons;
	}

	function add_raw_video_tinymce_plugin($plugin_array) {
		
		$plugin_array['raw_video'] = get_bloginfo('template_url').'/raw_framework/raw_shortcodes/video/video.js';	   
		return $plugin_array;
		
	}

	add_filter( 'tiny_mce_version', 'my_refresh_mce');

	// ---------- END TINYMCE BUTTONS ---------- //

?>