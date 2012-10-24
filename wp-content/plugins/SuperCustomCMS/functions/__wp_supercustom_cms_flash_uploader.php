<?php

/**
 * Control Flash Uploader
 * 
 * @return boolean
 */
function __wp_supercustom_cms_control_flashloader() {
	
	$__wp_supercustom_cms_control_flashloader = __wp_supercustom_cms_get_option_value( '__wp_supercustom_cms_control_flashloader' );
	
	if ( $__wp_supercustom_cms_control_flashloader == '1' ) {
		return FALSE;
	} else {
		return TRUE;
	}
}
/**
 * remove the flash_uploader
 */
function __wp_supercustom_cms_disable_flash_uploader() {
	
	return FALSE;
}
?>
