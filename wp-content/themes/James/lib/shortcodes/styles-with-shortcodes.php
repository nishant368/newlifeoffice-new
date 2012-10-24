<?php

/**
Plugin Name: Styles with Shortcodes for WordPress
Plugin URI: http://plugins.righthere.com/styles-with-shortcodes/
Description: Now you can customize your content faster and easier than ever before with custom style shortcodes. This plugin lets you easily customize your content by using Shortcodes. Choose from more than 70 built in shortcodes like; jQuery Toggles and Tabs, Tooltips, Column shortcodes, Gallery and Image shortcodes, Button Styles, Alert Box Styles, Pullquotes, Blockquotes, Twitter buttons, Retweet button, Facebook Like buttons and many more!
You can even create your own or import and export shortcodes.
Version: 1.5.4 rev1943
Author: Alberto Lau (RightHere LLC)
Author URI: http://plugins.righthere.com
 **/

if(!function_exists('property_exists')):
function property_exists($o,$p){
	return is_object($o) && 'NULL'!==gettype($o->$p);
}
endif;

class custom_shortcode_styling {
	var $options;
	var $sws_scripts = array();
	var $sws_styles = array();
	var $bundles = array();
	function custom_shortcode_styling(){
		$this->options = get_option('sws_options');
		add_action('plugins_loaded',array(&$this,'plugins_loaded'));
		add_action('init',array(&$this,'init'));
		
		if(isset($this->options['disable_autop'])&&$this->options['disable_autop']==1){
			remove_filter ('the_content', 'wpautop');
		}
	}
	
	function init(){
		if(is_admin()):
			wp_enqueue_style('wpcss-toggle',WPCSS_URL.'css/toggle.css',array(),'1.0.3');
			wp_enqueue_style('colorpicker',WPCSS_URL.'colorpicker/css/colorpicker.css',array(),'1.0.0');
		endif;
	}
	
	function plugins_loaded(){		
		wp_enqueue_script('jquery');	
		//-- register scripts ----
		require_once WPCSS_PATH.'includes/bundled_scripts_and_styles.php';	
		new bundled_scripts_and_styles();//
		
		require_once WPCSS_PATH.'includes/class.CSShortcodes.php';
		require_once WPCSS_PATH.'includes/class.ImportExport.php';		
		require_once WPCSS_PATH.'includes/class.CSShortcodesLoad.php';	
		
		if(is_admin()):
			//wp_enqueue_style('wpcss-toggle',WPCSS_URL.'css/toggle.css',array(),'1.0.3');
			wp_enqueue_script('wpsws',WPCSS_URL.'js/sws.js',array(),'1.0.1');
			
			//wp_enqueue_style('colorpicker',WPCSS_URL.'colorpicker/css/colorpicker.css',array(),'1.0.0');
			wp_enqueue_script('sws-colorpicker',WPCSS_URL.'colorpicker/js/colorpicker.js',array('jquery'),'1.0.0');			
			
			require_once WPCSS_PATH.'includes/class.CSSEditor.php';
			require_once WPCSS_PATH.'includes/class.CSSOptions.php';
		endif;		
	}
	
	function add_script($id,$label,$url=''){
		$this->sws_scripts[] = (object)array('id'=>$id,'label'=>$label,'url'=>$url);
	}
	
	function add_style($id,$label,$url='',$ui_theme=false){
		$this->sws_styles[] = (object)array('id'=>$id,'label'=>$label,'url'=>$url,'ui_theme'=>$ui_theme);
	}
	
	function add_bundle($id,$label,$path){
		$this->bundles[$id]=(object)array('id'=>$id,'label'=>$label,'path'=>$path);
	}
}  
?>