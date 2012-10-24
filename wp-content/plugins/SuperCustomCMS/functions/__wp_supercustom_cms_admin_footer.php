<?php


/**
 * credit in wp-footer
 */
function __wp_supercustom_cms_admin_footer() {
	
	$plugin_data = get_plugin_data( __FILE__ );
	$plugin_data['Title'] = $plugin_data['Name'];
	
	if ( !empty( $plugin_data['PluginURI'] ) && !empty( $plugin_data['Name'] ) )
		$plugin_data['Title'] = '<a href="' . $plugin_data['PluginURI'] . '" title="'.__( 'Visit plugin homepage' ).'">' . $plugin_data['Name'] . '</a>';

	if ( basename( $_SERVER['REQUEST_URI'] ) == 'SuperCustomCMS.php' ) {
		printf( '%1$s ' . __( 'plugin' ) . ' | ' . __( 'Version' ) . ' <a href="http://wordpress.org/extend/plugins/SuperCustomCMS/changelog/" title="' . __( 'History', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ) . '">%2$s</a> | ' . __( 'Author' ) . ' %3$s<br />', $plugin_data['Title'], $plugin_data['Version'], $plugin_data['Author'] );
	}
	
	if ( __wp_supercustom_cms_get_option_value( '__wp_supercustom_cms_advice' ) == 1 && basename( $_SERVER['REQUEST_URI'] ) != 'SuperCustomCMS.php' ) {
		printf( '%1$s ' . __( 'plugin activate', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ) . ' | ' . stripslashes( __wp_supercustom_cms_get_option_value( '__wp_supercustom_cms_advice_txt' ) ) . '<br />', $plugin_data['Title'] );
	}
	
}
?>
