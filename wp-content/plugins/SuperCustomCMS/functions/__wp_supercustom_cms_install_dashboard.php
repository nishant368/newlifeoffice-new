<?php
/**
 * @package SuperCustomCMS
 * @subpackage Dashboard Setup
 * @author karim salim
 */
if ( ! function_exists( 'add_action' ) ) {
	echo "Hi there!  I'm just a part of plugin, not much I can do when called directly.";
	exit;
}

// retrun registered widgets; only on page index/dashboard :(
add_action( 'wp_dashboard_setup', '__wp_supercustom_cms_dashboard_setup', 99 );

function __wp_supercustom_cms_dashboard_setup () {
	global $wp_meta_boxes;
	
	$SuperCustomCMSoptions = get_option( 'supercustom_cms' );
	$widgets = __wp_supercustom_cms_get_dashboard_widgets();
	$SuperCustomCMSoptions['wp_supercustom_cms_dashboard_widgets'] = $widgets;
	if ( current_user_can( 'manage_options' ) )
		update_option( 'supercustom_cms', $SuperCustomCMSoptions );
	
	// exclude super admin
	if ( __wp_supercustom_cms_exclude_super_admin() )
		return NULL;
	
	$user_roles = __wp_supercustom_cms_get_all_user_roles();
	
	foreach ( $user_roles as $role ) {
		$disabled_dashboard_option_[$role] = __wp_supercustom_cms_get_option_value( 
			'wp_supercustom_cms_disabled_dashboard_option_' . $role . '_items'
		);
	}
	//var_dump( get_option('supercustom_cms') );
	foreach ( $user_roles as $role ) {
		if ( ! isset( $disabled_dashboard_option_[$role]['0'] ) )
			$disabled_dashboard_option_[$role]['0'] = '';
	}
	
	foreach ( $user_roles as $role ) {
		$user = wp_get_current_user();
		if ( is_array( $user->roles) && in_array( $role, $user->roles) ) {
			if ( current_user_can( $role ) && is_array( $disabled_dashboard_option_[$role] ) ) {
				foreach( $disabled_dashboard_option_[$role] as $widget ) {
					if ( isset( $widgets[$widget]['context']) )
						remove_meta_box( $widget, 'dashboard', $widgets[$widget]['context'] );
				}
			}
		}
	}
	
}

function __wp_supercustom_cms_get_dashboard_widgets () {
	global $wp_meta_boxes;
	
	$widgets = array();
	if ( isset($wp_meta_boxes['dashboard']) ) {
		foreach( $wp_meta_boxes['dashboard'] as $context => $data ) {
			foreach( $data as $priority => $data ) {
				foreach( $data as $widget => $data ) {
					$widgets[$widget] = array(
						'id' => $widget,
						'title' => strip_tags(
							preg_replace( '/( |)<span.*span>/im', '', $data['title'] )
						),
						'context' => $context,
						'priority' => $priority
					);
				}
			}
		}
	}
	return $widgets;
}