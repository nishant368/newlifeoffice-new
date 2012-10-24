<?php
// Saving option to Database
function smartSeo_save_admin_options() {
	if ( $_REQUEST['page'] == 'smartSeo' ) {
	 	if ( 'save' == $_REQUEST['smartSeo_save'] ) {
	 		global $admin_options;
	 		return smartSeo_save_options($admin_options); 
			
	 	} elseif ( 'reset' == $_REQUEST['smartSeo_reset'] ) {

			global $wpdb;
			$query = "DELETE FROM $wpdb->options WHERE option_name LIKE 'smartSeo_%'";
			$wpdb->query($query);
			return 'reset';
		}
	}
}

function smartSeo_save_options($options = null) {
	global $smartSeo;
	$prefix = $smartSeo->prefix;

	foreach ($options as $option) { 
	
		if(is_array($option['type'])) {  
			foreach($option['type'] as $array){
				if($array['type'] == 'text'){
					smartSeo_save_text($array); 
				}
			}
		}

		switch ( $option['type'] ) {		
			case 'text':
				smartSeo_save_text($option);
				break;
	        
	        case 'checkbox':
				smartSeo_save_checkbox($option);
				break;
	        
	        case 'multicheck':
				smartSeo_save_multicheck($option);
				break;
	        
	        case 'multi':
				smartSeo_save_multi($option);
				break;
	        
	        case 'slider':
				smartSeo_save_slider($option);
				break;
	        
	        case 'boxes':
				smartSeo_save_boxes($option);
				break;
	        default:
	        	smartSeo_save_default($option); 
		}
	}
	
	if ( $_REQUEST['page'] == 'smartSeo' && $_REQUEST['smartSeo_save'] == 'save' ) {
		return 'saved';
	}	
}
