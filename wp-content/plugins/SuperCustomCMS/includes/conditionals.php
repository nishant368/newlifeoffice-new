<?php

/*
 *	CONDITIONAL ACTIONS
 */
 
 
if(get_option('supercustom_cms_o_footer_custom_logo'))
{
	add_filter('admin_footer_text', 'supercustom_cms_remove_footer_admin');
}
elseif(get_option('supercustom_cms_o_developer_name'))
{
	add_filter('admin_footer_text', 'supercustom_cms_developer_link');
}

if (get_option('supercustom_cms_o_dashboard_remove_right_now') == 1) 
{
	add_action('wp_dashboard_setup', 'supercustom_cms_remove_right_now');
}

if (get_option('supercustom_cms_o_dashboard_remove_recent_comments') == 1) 
{
	add_action('wp_dashboard_setup', 'supercustom_cms_remove_recent_comments');
}

if (get_option('supercustom_cms_o_dashboard_others') == 1) 
{
	add_action('wp_dashboard_setup', 'supercustom_cms_remove_others');
}
 
if (get_option('supercustom_cms_o_dashboard_remove_nag_update') == 1) 
{
	add_action( 'admin_init', create_function('', 'remove_action( \'admin_notices\', \'update_nag\', 3 );') );
}
 
if (get_option('supercustom_cms_o_hide_admin_bar') == 1) 
{
	add_filter( 'show_admin_bar', '__return_false' );
}

if (get_option('supercustom_cms_o_hide_wpversion') == 1) 
{
	add_filter( 'update_footer', 'remove_footer_version', 9999 );
	add_action( 'admin_head', 'supercustom_cms_hide_wp_version');
}


/*
 *	ADDITIONAL HEADER CSS
 */

function supercustom_cms_custom_css()
{
		
	$supercustom_cms_header_css = '';
	 
	if(get_option('supercustom_cms_o_custom_css')!="")
	{
		$supercustom_cms_header_css .= wp_specialchars_decode( stripslashes( get_option('supercustom_cms_o_custom_css') ), 1, 0, 1 );
	}
	
	if (get_option('supercustom_cms_o_dashboard_remove_help_box') == 1) 
	{
		$supercustom_cms_header_css .= '#contextual-help-link-wrap { display: none; }';
		$supercustom_cms_header_css .= '#contextual-help-link { display: none; }';
	}
	
	if (get_option('supercustom_cms_o_post_meta_box_slug'))
	{
		$supercustom_cms_header_css .=  '#slugdiv, #edit-slug-box { display: none; } ';
	}
	
	if (get_option('supercustom_cms_o_dashboard_remove_screen_options') == 1) 
	{
		$supercustom_cms_header_css .=  '#screen-options-link-wrap { display: none; }';
	}
	
	if (!current_user_can('activate_plugins'))
	{
		if (get_option('supercustom_cms_o_hide_admin_bar_option') == 1) 
		{
			$supercustom_cms_header_css .= '.show-admin-bar { display: none; }';
		}
	
		if (get_option('supercustom_cms_o_inherit_hide_menus') == 1) 
		{
			if (get_option('supercustom_cms_o_hide_posts'))
			{
				$supercustom_cms_header_css .= '#wp-admin-bar-new-post { display: none; }';
			}
			if (get_option('supercustom_cms_o_hide_pages')) 
			{
				$supercustom_cms_header_css .= '#wp-admin-bar-new-page { display: none; }';
			}
			if (get_option('supercustom_cms_o_hide_media')) 
			{
				$supercustom_cms_header_css .= '#wp-admin-bar-new-media { display: none; }';
			}
			if (get_option('supercustom_cms_o_hide_links')) 
			{
				$supercustom_cms_header_css .= '#wp-admin-bar-new-link { display: none; }';
			}
			if (get_option('supercustom_cms_o_hide_comments')) 
			{
				$supercustom_cms_header_css .= '#wp-admin-bar-comments { display: none; }';
			}
			if (!get_option('supercustom_cms_o_show_widgets')) 
			{
				$supercustom_cms_header_css .= '#wp-admin-bar-widgets { display: none; }';
			}
			if (!get_option('supercustom_cms_o_show_appearance')) 
			{
				$supercustom_cms_header_css .='#wp-admin-bar-menus { display: none; }';
			}
			if (!get_option('supercustom_cms_o_show_background')) 
			{
				$supercustom_cms_header_css .= '#wp-admin-bar-background { display: none; }';
			}
			if (!get_option('supercustom_cms_o_show_header')) 
			{
				$supercustom_cms_header_css .= '#wp-admin-bar-header { display: none; }';
			}
		}
	}
	

	echo '<style type="text/css">';
	echo $supercustom_cms_header_css;
	echo '</style>';
}


?>