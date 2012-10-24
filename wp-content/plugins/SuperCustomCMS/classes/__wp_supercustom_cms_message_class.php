<?php
/**
 * @package SuperCustomCMS
 * @subpackage Settings page
 * @author karim salim
 */
class __wp_supercustom_cms_message_class {
	
	/**
	 * constructor
	 */
	function __wp_supercustom_cms_message_class() {
		
		$this->localizion_name = FB_SUPERCUSTOM_CMS_TEXTDOMAIN;
		$this->errors = new WP_Error();
		$this->initialize_errors();
	}

	/**
	 * get_error - Returns an error message based on the passed code
	 * Parameters - $code (the error code as a string)
	 * @return Returns an error message
	 */
	function get_error( $code = '' ) {
		
		$errorMessage = $this->errors->get_error_message( $code );
		
		if ( NULL == $errorMessage )
			return __( 'Unknown error.', $this->localizion_name );
		
		return $errorMessage;
	}

	/**
	 * Initializes all the error messages
	 */
	function initialize_errors() {
		$this->errors->add( '__wp_supercustom_cms_update', __( 'The updates were saved.', $this->localizion_name ) );
		$this->errors->add( '__wp_supercustom_cms_access_denied', __( 'You have not enough rights to edit entries in the database.', $this->localizion_name ) );
		$this->errors->add( '__wp_supercustom_cms_import', __( 'All entries in the database were imported.', $this->localizion_name ) );
		$this->errors->add( '__wp_supercustom_cms_deinstall', __( 'All entries in the database were deleted.', $this->localizion_name ) );
		$this->errors->add( '__wp_supercustom_cms_deinstall_yes', __( 'Set the checkbox on deinstall-button.', $this->localizion_name ) );
		$this->errors->add( '__wp_supercustom_cms_get_option', __( 'Can\'t load menu and submenu.', $this->localizion_name ) );
		$this->errors->add( '__wp_supercustom_cms_set_theme', __( 'Backend-Theme was activated!', $this->localizion_name ) );
		$this->errors->add( '__wp_supercustom_cms_load_theme', __( 'Load user data to themes was successful.', $this->localizion_name ) );
	}

}
?>