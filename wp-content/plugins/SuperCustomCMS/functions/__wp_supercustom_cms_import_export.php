<?php


/**
 * export options in file 
 */
function __wp_supercustom_cms_export() {
	global $wpdb;

	$filename = 'SuperCustomCMS_export-' . date( 'Y-m-d_G-i-s' ) . '.seq';
		
	header( "Content-Description: File Transfer");
	header( "Content-Disposition: attachment; filename=" . urlencode( $filename ) );
	header( "Content-Type: application/force-download");
	header( "Content-Type: application/octet-stream");
	header( "Content-Type: application/download");
	header( 'Content-Type: text/seq; charset=' . get_option( 'blog_charset' ), TRUE );
	flush();
	
	$export_data = mysql_query("SELECT option_value FROM $wpdb->options WHERE option_name = 'supercustom_cms'");
	$export_data = mysql_result( $export_data, 0 );
	echo $export_data;
	flush();
}

/**
 * import options in table _options
 */
function __wp_supercustom_cms_import() {
	
	// check file extension
	$str_file_name = $_FILES['datei']['name'];
	$str_file_ext  = explode( ".", $str_file_name );

	if ( $str_file_ext[1] != 'seq' ) {
		$addreferer = 'notexist';
	} elseif ( file_exists( $_FILES['datei']['name'] ) ) {
		$addreferer = 'exist';
	} else {
		// path for file
		$str_ziel = WP_CONTENT_DIR . '/' . $_FILES['datei']['name'];
		// transfer
		move_uploaded_file( $_FILES['datei']['tmp_name'], $str_ziel );
		// access authorisation
		chmod( $str_ziel, 0644);
		// SQL import
		ini_set( 'default_socket_timeout', 120);
		$import_file = file_get_contents( $str_ziel );
		
		__wp_supercustom_cms_deinstall();
		$import_file = unserialize( $import_file );
		
		if ( file_exists( $str_ziel ) )
			unlink( $str_ziel );
		update_option( 'supercustom_cms', $import_file );
		if ( file_exists( $str_ziel ) )
			unlink( $str_ziel );
		
		$addreferer = 'true';
	}

	$myErrors = new __wp_supercustom_cms_message_class();
	$myErrors = '<div id="message" class="updated fade"><p>' . 
		$myErrors->get_error( '__wp_supercustom_cms_import' ) . '</p></div>';
	echo $myErrors;
}
?>
