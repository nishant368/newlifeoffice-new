<?php
 
/**
 * Plugin Name: SuperCustomCMS
 * Plugin URI:
 * Text Domain: SuperCustomCMS
 * Domain Path:
 * Description:
 * Author:
 * Author URI:
 * Version:
 * License:
 */



global $wp_version;
if ( ! function_exists( 'add_action' ) || version_compare( $wp_version, "2.5alpha", "<") ) {
	if ( function_exists( 'add_action' ) )
		$exit_msg = 'The plugin <em><a href="http://bueltge.de/wordpress-admin-theme-SuperCustomCMS/674/">SuperCustomCMS</a></em> requires WordPress 2.5 or newer. <a href="http://codex.wordpress.org/Upgrading_WordPress">Please update WordPress</a> or delete the plugin.';
	else
		$exit_msg = '';
	
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit( $exit_msg );
}

if ( function_exists( 'add_action' ) ) {
	
	// Pre-2.6 compatibility
	if ( ! defined( 'WP_CONTENT_URL' ) )
		define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
	if ( ! defined( 'WP_CONTENT_DIR' ) )
		define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
	if ( ! defined( 'WP_PLUGIN_URL' ) )
		define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );
	if ( ! defined( 'WP_PLUGIN_DIR' ) )
		define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );

	// plugin definitions
	define( 'FB_SUPERCUSTOM_CMS_BASENAME', plugin_basename( __FILE__ ) );
	define( 'FB_SUPERCUSTOM_CMS_BASEFOLDER', plugin_basename( dirname( __FILE__ ) ) );
	define( 'FB_SUPERCUSTOM_CMS_TEXTDOMAIN', __wp_supercustom_cms_get_plugin_data( 'TextDomain' ) );
    define( 'WP_SUPERCUSTOM_CMS_ADDRESS', WP_PLUGIN_URL.'/'.FB_SUPERCUSTOM_CMS_BASEFOLDER.'/');
    define( 'WP_SUPERCUSTOM_CMS_ADMIN', get_option( 'siteurl' ).'/wp-admin/admin.php?page=WP_SuperCustomCMS');
}

function __wp_supercustom_cms_get_plugin_data( $value = 'Version' ) {
	
	if ( ! function_exists( 'get_plugin_data' ) )
		require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
	
	$plugin_data = get_plugin_data( __FILE__ );
	$plugin_value = $plugin_data[$value];
	
	return $plugin_value;
}
// some basics for message
include'classes/__wp_supercustom_cms_message_class.php';
include('includes/conditionals.php');
include('includes/plugin_deactivate.php');
// on admin init
add_action( 'admin_init', '__wp_supercustom_cms_textdomain' );
add_action( 'admin_init', '__wp_supercustom_cms_register_styles', 1 );
add_action( 'admin_init', '__wp_supercustom_cms_admin_init', 2 );
add_action( 'admin_menu', '__wp_supercustom_cms_add_settings_page' );
add_action( 'admin_menu', '__wp_supercustom_cms_remove_dashboard' );
add_action('init', 'supercustom_cms_check_for_login');
add_action('admin_notices','supercustom_cms_nag');
add_action('admin_init', 'supercustom_cms_add_init');
add_action('admin_menu', 'supercustom_cms_add_admin'); 
add_action('admin_head', 'supercustom_cms_custom_css');
add_action('login_head', 'supercustom_cms_custom_login_logo');
add_action('admin_head', 'supercustom_cms_hide_switch_theme');
add_action('admin_menu', 'supercustom_cms_remove_default_post_metaboxes');
add_action('admin_init', 'supercustom_cms_remove_admin_menus');
add_action('admin_menu', 'supercustom_cms_remove_default_page_metaboxes');
add_action('admin_head', 'supercustom_cms_dashboard_mod');
add_action('admin_head-media-upload-popup', 'supercustom_cms_iframe_mod');
add_action('wp_before_admin_bar_render', 'supercustom_cms_adminbar', 0);
add_action('wp_dashboard_setup', 'supercustom_cms_add_dashboard_widget_custom' );

if ( version_compare( $wp_version, '3.2alpha', '<=' ) )
	add_action( 'admin_init', '__wp_supercustom_cms_admin_styles', 1 );

register_activation_hook( __FILE__, '__wp_supercustom_cms_install' );
register_uninstall_hook( __FILE__, '__wp_supercustom_cms_deinstall' );
register_deactivation_hook(__FILE__, '__wp_supercustom_cms_deinstall' );
register_deactivation_hook( __FILE__, 'supercustom_cms_plugin_deactivate' );

function supercustom_cms_check_for_login()
{
	if( get_option('supercustom_cms_o_enable_login_redirect') ):
		$segments = explode('/' ,  $_SERVER['REQUEST_URI'] );
		if ( $segments[ (count($segments) - 1) ] == 'login' ):
			wp_redirect( get_bloginfo('url') . '/wp-login.php' );
			exit;
		endif;
	endif;
}
function supercustom_cms_dashboard_mod()
{
    global $current_screen;

    if( ($current_screen->id == 'dashboard' ) ):

        if( get_option('supercustom_cms_o_dashboard_override') || get_option('supercustom_cms_o_dashboard_override') == '' ) :

			if ( get_option('supercustom_cms_o_dashboard_override') != __('Dashboard') ) :

				$val = (get_option('supercustom_cms_o_dashboard_override') == '' ? '&nbsp;' : get_option('supercustom_cms_o_dashboard_override') );
				echo '<style type="text/css">#wpbody-content .wrap h2 { visibility: hidden; }</style>
						<script type="text/javascript">
								jQuery(document).ready(function($) {
										$("#wpbody-content .wrap h2:eq(0)").html("'.$val.'");
										$("#wpbody-content .wrap h2").css("visibility","visible");
								});
						</script>';
						
				endif;
						
        endif;

    	if( get_option('supercustom_cms_o_header_custom_logo') ):

            $background =  get_option('supercustom_cms_o_header_custom_logo');

            if(!preg_match("@^https?://@", $background)){
		$background = get_bloginfo('stylesheet_directory').'/images/'.$background;
            }
		
            echo '<style type="text/css">
                            #icon-index {background:transparent;height:auto;width:auto;visibility: hidden;}
                            #dashboard-widgets-wrap {clear:both}
                    </style>';
            echo '<script type="text/javascript">
                            jQuery(document).ready(function($) {
                                    $("#icon-index").html("<img src=\"'.$background.'\" alt=\"\" />");
                                    $("#icon-index").css("visibility","visible");                                    
                            });
                    </script>';
    	endif;
    
    endif;
	
}
function _wp_supercustomcms_UserCompare($needsToBe,$current)
{
    if($needsToBe == '0' || $needsToBe == '')
        return;
 
    $roles = array( 'administrator' => 25 , 'editor' => 20, 'author' => 15, 'contributor' => 10, 'subscriber' => 5 );

    $needsToBe = $roles[$needsToBe];
    $current = $roles[$current];

    if($current >= $needsToBe ):
        return true;
    else:
        return false;
    endif;
}

function supercustom_cms_remove_others() {

if( get_option('supercustom_cms_o_dashboard_admin') && current_user_can('activate_plugins') ) { return; }

global $wp_meta_boxes;
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
unset($wp_meta_boxes['dashboard']['normal']['core']['custom_help_widget']);
unset($wp_meta_boxes['dashboard']['normal']['core']['my_dashboard_widget']);
 
}
 
function supercustom_cms_remove_right_now()
{
    if( get_option('supercustom_cms_o_dashboard_admin') && current_user_can('activate_plugins') ) { return; }
    global $wp_meta_boxes;
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
}
 
function supercustom_cms_remove_recent_comments() 
{
   
    if( get_option('supercustom_cms_o_dashboard_admin') && current_user_can('activate_plugins') ) { return; }
    global $wp_meta_boxes;
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
}

function supercustom_cms_output()
{
    global $userdata;
    $WP_Roles = new WP_Roles();
    $role_names = $WP_Roles->get_names();
    unset($role_names['administrator']);
    $all_caps = supercustom_cms_get_all_caps_from_wp_roles();

    sort($all_caps);
    $output = "<div id=\"roles_capabilities\">";

    foreach($role_names as $role_id => $role_name)
    {
        $output .= "<div id=\"roles_$role_id\" class=\"edit_role_name\">";
        $output .= "<ul class=\"role_name_editor\">";

        foreach($all_caps as $capability)
        {
            $checked = isset($WP_Roles->roles[$role_id]['capabilities'][$capability])&&$WP_Roles->roles[$role_id]['capabilities']			[$capability]==1?'checked="checked"':'';
            $output .= "<li><input type=\"checkbox\" $checked name=\"ROLES[$role_id][$capability]\" value=1 />&nbsp;".ucfirst(str_replace("_"," ",$capability))."</li>&nbsp; ";
        }

        $output .= "</ul>"; $output .= "</div>";
    }
    $output .= "</div>";
    return $output;
}

function supercustom_cms_get_all_caps_from_wp_roles()
{
    $WP_Roles = new WP_Roles();
    $role_names = $WP_Roles->get_names();
    $all_caps = array();
    if(count($WP_Roles->roles)>0)
    {
        foreach($WP_Roles->roles as $role_id => $row)
        {
            foreach($row['capabilities'] as $capability => $allowed)
            {
                $all_caps[$capability]=$capability;
            }
        }
    }
    return $all_caps;
}

function supercustom_cms_roles_dropdown($params = array())
{
    $wp_roles = new WP_Roles();
    // remove unwanted roles
    if(!empty($params['remove_role']))
            unset($wp_roles->role_names[$params['remove_role']]);

    return $wp_roles->role_names;
}

function supercustom_cms_adminbar() 
{
     global $wp_version;

    if(get_option('supercustom_cms_o_dashboard_border')):
    echo '<style type="text/css"> .postbox-container .meta-box-sortables.empty-container, #side-sortables.empty-container{border:0;} </style>';
    endif;
    if( get_option('supercustom_cms_o_hide_wp_adminbar') ):
        echo " \n\n <style type=\"text/css\">#wp-admin-bar-wp-logo { display:none; }</style> \n\n";
    endif;

    if( get_option('supercustom_cms_o_adminbar_custom_logo') ):
        $background = get_option('supercustom_cms_o_adminbar_custom_logo');
        if(!preg_match("@^https?://@", $background))
            $background = get_bloginfo('stylesheet_directory').'/images/'.$background;

        echo '<script type="text/javascript"> jQuery(document).ready(function(){ ';
        echo  'jQuery("#wp-admin-bar-root-default").prepend(" <li id=\"supercustom_cms_admin_logo\"> <span style=\"float:left;height:28px;line-height:28px;vertical-align:middle;text-align:center;width:28px\"><img src=\"'.$background.'\" width=\"16\" height=\"16\" alt=\"Login\" style=\"height:16px;width:16px;vertical-align:middle\" /> </span> </li> ");  }); ';
        echo '</script> ';

    endif;

   $style = '<style type="text/css">';

        if(get_option('supercustom_cms_o_header_custom_logo') != "")
        {
            $background = get_option('supercustom_cms_o_header_custom_logo');

            if(!preg_match("@^https?://@", $background))
            $background = get_bloginfo('stylesheet_directory').'/images/'.$background;

            $style .= '#header-logo { background-image: url('.$background . ') !important; ';
            $css_width = get_option('supercustom_cms_o_header_custom_logo_width');

            if ($css_width != '')
            {
                $style .= 'width: ' . get_option('supercustom_cms_o_header_custom_logo_width') . 'px; ';
            }
            else
            {
                if (( version_compare( $wp_version, '3.2', '>=' ) ) && (!empty($customHFHeight)))
                {
                    $style .= 'height: '.$customHFHeight.'px; ';
                }
            }
            $style .= '} ';
        }

        if (( version_compare( $wp_version, '3.2', '>=' ) ) && (!empty($customHFHeight))) {
                $style .= '  #wphead { height: '.$customHFHeight.'px; }
                                #wphead h1 { font-size: 22px; padding: 10px 8px 5px; }
                                #header-logo { height: 32px; }
                                #user_info { padding-top: 8px }
                                #user_info_arrow { margin-top: 8px; }
                                #user_info_links { top: 8px; }
                                #footer p { padding-top: 15px; }
                                #supercustom-cms-footer-container { padding-top: 10px; line-height: 30px;} '."\n";
        }

        if (( version_compare( $wp_version, '3.2', '<' ) ) && (empty($customHFHeight))) {
               $style .= '#supercustom-cms-footer-container { 	padding-top: 10px; 	line-height: 30px; }';
        }

        if (get_option('supercustom_cms_o_header_logo_link') == 1) {
                $style .= '#site-heading { display: none; } ';
        }

    $style .= '</style>';

    echo $style;
    

    if (get_option('supercustom_cms_o_header_logo_link') == 1) {
            echo '<script type="text/javascript">';
            echo "jQuery(function($){ $('#header-logo').wrap('<a href=\"" . site_url() . "\" alt=\"" . get_bloginfo('name') . "\" title=\"" . get_bloginfo('name') . "\">'); });";
            echo '</script>';
    }
}

// add footer logo
function supercustom_cms_remove_footer_admin() {
    $footer_logo = get_option('supercustom_cms_o_footer_custom_logo');
    if($footer_logo)
        if(!preg_match("@^https?://@", $footer_logo))
                $footer_logo = get_bloginfo('stylesheet_directory').'/images/'.$footer_logo;

        echo '<div id="supercustom-cms-footer-container">';
        if (get_option('supercustom_cms_o_developer_url')) {

                echo '<a target="_blank" href="' . get_option('supercustom_cms_o_developer_url') . '">';

                if (get_option('supercustom_cms_o_footer_custom_logo_width')) {
        	 	echo '<img style="width:' . get_option('supercustom_cms_o_footer_custom_logo_width') . 'px;" ';
        	} else {
        		echo '<img ';
        	}
           echo ' src="'.$footer_logo. '" id="supercustom-cms-footer-logo"> </a> <span> <a target="_blank" href="' . get_option('supercustom_cms_o_developer_url') . '">' . get_option('supercustom_cms_o_developer_name') . '</a> </span>';
        } else {
        	if (get_option('supercustom_cms_o_footer_custom_logo_width')) {
        	 	echo '<img style="width:' . get_option('supercustom_cms_o_footer_custom_logo_width') . 'px;" ';
        	} else {
        		echo '<img ';
        	}        
            echo ' src="'.$footer_logo . '" id="supercustom-cms-footer-logo"> <span>' . stripslashes(get_option('supercustom_cms_o_developer_name')).'</span>';
        }
        echo '</div><p id="safari-fix"';
}

function supercustom_cms_developer_link()
{
    echo '<div id="supercustom-cms-footer-container">';
    echo ( get_option('supercustom_cms_o_developer_url') ? '<a target="_blank" href="' . get_option('supercustom_cms_o_developer_url') . '">' : '' );
    echo get_option('supercustom_cms_o_developer_name');
    echo ( get_option('supercustom_cms_o_developer_url') ? '</a>' : '' );
    echo '</div>';
}


// custom logo login
function supercustom_cms_custom_login_logo()
{
    wp_print_scripts( array( 'jquery' ) );
    $login_custom_logo = get_option('supercustom_cms_o_login_custom_logo');

    if(!preg_match("@^https?://@", $login_custom_logo))
            $login_custom_logo = get_bloginfo('stylesheet_directory').'/images/'.$login_custom_logo;

    echo '<style type="text/css">';
    echo stripslashes( get_option('supercustom_cms_o_login_bg_css') );

    if (get_option('supercustom_cms_o_login_custom_logo')):
        echo ' .login h1 a { display:all; background: url('.$login_custom_logo . ') no-repeat bottom center !important; margin-bottom: 10px; } ';

        if(get_option('supercustom_cms_o_loginbg_white') ):
                echo ' body.login {background: #fff } ';
        endif;

        echo '</style> ';

        echo '<script type="text/javascript">
                function loginalt() {
                        var changeLink = document.getElementById(\'login\').innerHTML;
                        changeLink = changeLink.replace("http://wordpress.org/", "' . site_url() . '");
                        changeLink = changeLink.replace("Powered by WordPress", "' . get_bloginfo('name') . '");
                        document.getElementById(\'login\').innerHTML = changeLink;
                }
                window.onload=loginalt;
        </script>';

    elseif( get_option('supercustom_cms_o_login_bg_css') ):
        
        echo  stripslashes( get_option('supercustom_cms_o_login_bg_css') );
        echo '</style> ';
    else:
        echo '</style> ';
    endif;

    if(get_option('supercustom_cms_o_login_bg_css')):
        echo '<script type="text/javascript"> jQuery(document).ready(function(){ jQuery("#login").wrap("<div id=\'supercustom-cms-login-wrapper\'></div>"); }); </script> ';
    endif;
	
}
 
function supercustom_cms_custom_dashboard_help()
{
    echo stripslashes(get_option('supercustom_cms_o_welcome_text'));
}
function supercustom_cms_custom_dashboard_help_new1()
{
    echo stripslashes(get_option('supercustom_cms_o_welcome_text1'));
}
function supercustom_cms_custom_dashboard_help_new2()
{
    echo stripslashes(get_option('supercustom_cms_o_welcome_text2'));
}
function supercustom_cms_custom_dashboard_help_new3()
{
    echo stripslashes(get_option('supercustom_cms_o_welcome_text3'));
}
function supercustom_cms_custom_dashboard_help_new4()
{
    echo stripslashes(get_option('supercustom_cms_o_welcome_text4'));
}
function supercustom_cms_add_dashboard_widget_custom() 
{
    if ( get_option('supercustom_cms_o_show_welcome') ):
        if ( _wp_supercustomcms_UserCompare( strtolower(get_option('supercustom_cms_o_welcome_visible_to')),  strtolower( supercustom_cms_get_current_user_role() ) ) ):
            wp_add_dashboard_widget('custom_help_widget', get_option('supercustom_cms_o_welcome_title'), 'supercustom_cms_custom_dashboard_help');
        endif;

        if ( _wp_supercustomcms_UserCompare( strtolower(get_option('supercustom_cms_o_welcome_visible_to1')),  strtolower( supercustom_cms_get_current_user_role() ) ) ):
            wp_add_dashboard_widget('my_dashboard_widget1', get_option('supercustom_cms_o_welcome_title1'), 'supercustom_cms_custom_dashboard_help_new1');
        endif;
        
        if ( _wp_supercustomcms_UserCompare( strtolower(get_option('supercustom_cms_o_welcome_visible_to2')),  strtolower( supercustom_cms_get_current_user_role() ) ) ):
            wp_add_dashboard_widget('my_dashboard_widget2', get_option('supercustom_cms_o_welcome_title2'), 'supercustom_cms_custom_dashboard_help_new2');
        endif;
        
        
        if ( _wp_supercustomcms_UserCompare( strtolower(get_option('supercustom_cms_o_welcome_visible_to3')),  strtolower( supercustom_cms_get_current_user_role() ) ) ):
            wp_add_dashboard_widget('my_dashboard_widget3', get_option('supercustom_cms_o_welcome_title3'), 'supercustom_cms_custom_dashboard_help_new3');
        endif;
        
        if ( _wp_supercustomcms_UserCompare( strtolower(get_option('supercustom_cms_o_welcome_visible_to4')),  strtolower( supercustom_cms_get_current_user_role() ) ) ):
            wp_add_dashboard_widget('my_dashboard_widget4', get_option('supercustom_cms_o_welcome_title4'), 'supercustom_cms_custom_dashboard_help_new4');
        endif;

    endif;
}

function remove_footer_version()
{
    return '';
}

function supercustom_cms_hide_wp_version()
{
    echo '<style type="text/css">#wp-version-message { display: none;}</style>';
}
	
function supercustom_cms_get_current_user_role() {
    global $wp_roles;
    $current_user = wp_get_current_user();
    $roles = $current_user->roles;
    $role = array_shift($roles);
    return isset($wp_roles->role_names[$role]) ? translate_user_role($wp_roles->role_names[$role] ) : false;
}

function supercustom_cms_custom_editor_stylesheet($url)
{
    
    if( get_option('supercustom_cms_o_welcome_stylesheet')):
        $url = get_stylesheet_directory_uri() . '/' ;
        $url .= get_option('supercustom_cms_o_welcome_stylesheet');
    endif;

    return $url;
}

function supercustom_cms_hide_switch_theme()
{
    if(!current_user_can( 'manage_options' ) ):
       echo '<style type="text/css">
                    #dashboard_right_now .versions p, #dashboard_right_now .versions #wp-version-message  { display: none; }
              </style>
       ';
    endif;
}

function supercustom_cms_admin_title($admin_title)
{
    if( get_option('supercustom_cms_o_admin_page_title') ):
        return str_replace (
                "&#8212; WordPress",
                get_option('supercustom_cms_o_admin_page_title'),
                $admin_title
        );
    else:
        return $admin_title;
    endif;
}

function supercustom_cms_remove_admin_menus () {
    global $menu, $submenu;

    $exclude[0] = '';

    if (get_option('supercustom_cms_o_hide_posts'))
        array_push($exclude,__('Posts','default'));

    if (get_option('supercustom_cms_o_hide_comments'))
        array_push($exclude,__('Comments','default'));
    if (get_option('supercustom_cms_o_hide_tools'))
        array_push($exclude,__('Tools','default'));
    if (get_option('supercustom_cms_o_hide_profile'))
        array_push($exclude,__('Profile','default'));


   

    unset($exclude[0]);

//    print_r($exclude);die;

    if (sizeof($exclude) > 0):
        if (!current_user_can('activate_plugins')):
            if( isset($menu) && is_array($menu) ):
                foreach($menu as $mId=>$menuArray):
                    $tmp = explode(' ',$menuArray[0]);
                    if(in_array( $tmp[0] , $exclude )):
                            unset($menu[$mId]);
                    endif;
                endforeach;
            endif;
        endif;
    endif;

   if(isset($submenu['themes.php'])):
        if (!current_user_can('activate_plugins')):
            foreach( $submenu['themes.php'] as $k=>$v):
                if(get_option('supercustom_cms_o_subtemplate_hide_'.$k) ):
                        unset($submenu['themes.php'][$k]);
                endif;
            endforeach;
        endif;
    endif;

}	
 
function supercustom_cms_custom_pages_columns($defaults) 
{
    if (get_option('supercustom_cms_o_page_meta_box_comments'))
            unset($defaults['comments']);
    if (get_option('supercustom_cms_o_page_meta_box_author'))
            unset($defaults['author']);
    return $defaults;
}

function supercustom_cms_remove_default_page_metaboxes()
{
    add_filter('manage_pages_columns', 'supercustom_cms_custom_pages_columns');

    if (get_option('supercustom_cms_o_page_meta_box_custom'))
        remove_meta_box( 'postcustom','page','normal' );
    if (get_option('supercustom_cms_o_page_meta_box_author'))
        remove_meta_box( 'authordiv','page','normal' );
    if (get_option('supercustom_cms_o_page_meta_box_discussions'))
        remove_meta_box( 'commentstatusdiv','page','normal' );
    if (get_option('supercustom_cms_o_page_meta_box_slug'))
        remove_meta_box( 'slugdiv','page','normal' );
    if (get_option('supercustom_cms_o_page_meta_box_revisions'))
        remove_meta_box( 'revisionsdiv','page','normal' );
    if (get_option('supercustom_cms_o_page_meta_box_page'))
        remove_meta_box( 'pageparentdiv','page','normal' );
    if (get_option('supercustom_cms_o_page_meta_box_comments'))
        remove_meta_box( 'commentsdiv','page','normal' );
}

function supercustom_cms_custom_post_columns($defaults) 
{
    if (get_option('supercustom_cms_o_post_meta_box_comments'))
        unset($defaults['comments']);
    if (get_option('supercustom_cms_o_post_meta_box_author'))
        unset($defaults['author']);
    if (get_option('supercustom_cms_o_post_meta_box_categories'))
        unset($defaults['categories']);
    return $defaults;
}

function supercustom_cms_manage_my_category_columns($defaults)
{
    if (get_option('supercustom_cms_o_post_meta_box_slug'))
            unset($defaults['slug']);
    return $defaults;
}

function supercustom_cms_remove_default_post_metaboxes() 
{
    add_filter('manage_posts_columns', 'supercustom_cms_custom_post_columns');
    add_filter('manage_edit-post_tag_columns','supercustom_cms_manage_my_category_columns');
    add_filter('manage_edit-category_columns','supercustom_cms_manage_my_category_columns');

    if (get_option('supercustom_cms_o_post_meta_box_custom'))
        remove_meta_box( 'postcustom','post','normal' );
    if (get_option('supercustom_cms_o_post_meta_box_excerpt'))
        remove_meta_box( 'postexcerpt','post','normal' );
    if (get_option('supercustom_cms_o_post_meta_box_discussions'))
        remove_meta_box( 'commentstatusdiv','post','normal' );
    if (get_option('supercustom_cms_o_post_meta_box_send'))
        remove_meta_box( 'trackbacksdiv','post','normal' );
    if (get_option('supercustom_cms_o_post_meta_box_slug'))
        remove_meta_box( 'slugdiv','post','normal' );
    if (get_option('supercustom_cms_o_post_meta_box_author'))
        remove_meta_box( 'authordiv','post','normal');
    if (get_option('supercustom_cms_o_post_meta_box_revisions'))
        remove_meta_box( 'revisionsdiv','post','normal' );
    if (get_option('supercustom_cms_o_post_meta_box_tags'))
        remove_meta_box( 'tagsdiv-post_tag','post','normal' );
    if (get_option('supercustom_cms_o_post_meta_box_categories'))
        remove_meta_box( 'categorydiv','post','normal' );
    if (get_option('supercustom_cms_o_post_meta_box_comments'))
        remove_meta_box( 'commentsdiv','post','normal' );
}

function supercustom_cms_add_admin() 
{
	
global $_wp_supercustomcms_ThemeName, $_wp_supercustomcms_ShortName, $menu, $submenu;

    if ( isset($_GET['page']) && $_GET['page'] == 'WP_SuperCustomCMS')
     {
        if ( isset($_REQUEST['action']) && 'save' == $_REQUEST['action'] )
        {
            add_action('admin_init', '_wp_supercustomcms_Save');
        }
        else if( isset($_REQUEST['action']) && 'reset' == $_REQUEST['action'] )
        {
            add_action('admin_init', '_wp_supercustomcms_Reset');
        }
    }
}

function _wp_supercustomcms_Save()
{
    include('includes/admin.config.php');

    update_option('supercustom_cms_o_ver', _wp_supercustomcms_);
    
    foreach ($_wp_supercustomcms_Options as $value):
        if( isset( $value['id'] ) && isset( $_REQUEST[ $value['id'] ] ) ):
            update_option( $value['id'], $_REQUEST[ $value['id'] ]  );
        elseif( isset( $value['id'] ) && (!isset($_REQUEST[$value['id']])) ):
            delete_option( $value['id'] );
        endif;
    endforeach;

    _wp_supercustomcms_UpdateCaps();

    if($_REQUEST['supercustom_cms_o_editor_template_access'] == "1")
    {
        $role = get_role( 'editor' );
        $role->add_cap( 'edit_theme_options' );
    }
    else
    {
        $role = get_role( 'editor' );
        $role->remove_cap( 'switch_themes' ); // Legacy
        $role->remove_cap( 'edit_theme_options' );
    }
    //&saved=true
    header("Location: admin.php?page=WP_SuperCustomCMS");
    die;
}

function _wp_supercustomcms_Reset()
{
    include('includes/admin.config.php');
    foreach ($_wp_supercustomcms_Options as $value):
        if(isset($value['id'])):
            delete_option( $value['id'] );
        endif;
    endforeach;

    header("Location: admin.php?page=WP_SuperCustomCMS&reset=true");
    die;
}

function _wp_supercustomcms_UpdateCaps()
{
    $config = array(
      /*  array(
            'key'   =>  'supercustom_cms_o_hide_posts',
            'caps'  =>  array('edit_posts', 'manage_categories')
        ),*/
        array(
            'key'   =>  'supercustom_cms_o_hide_pages',
            'caps'  =>  array('edit_pages')
        ),
        array(
            'key'   =>  'supercustom_cms_o_hide_media',
            'caps'  =>  array('upload_files')
        ),
        array(
            'key'   =>  'supercustom_cms_o_hide_links',
            'caps'  =>  array('manage_links')
        )
    );

    foreach($config as $opts):
        if(isset( $_POST[ $opts['key'] ] )):
            $role = get_role( 'editor' );
            foreach($opts['caps'] as $cap):
                $role->remove_cap( $cap );
            endforeach;
        else:
            $role = get_role( 'editor' );
            foreach($opts['caps'] as $cap):
                $role->add_cap( $cap );
            endforeach;
        endif;
    endforeach;
}

function supercustom_cms_add_init() 
{
    global $_wp_supercustomcms_ThemeName, $_wp_supercustomcms_ShortName, $menu, $submenu;

if(! get_option('supercustom_cms_o_welcome_title') )
{
        include('includes/admin.config.php');
        foreach ($_wp_supercustomcms_Options as $value):
                if ( isset($value['id']) && $value['id'] != '' && isset($value['std']) ):
                        add_option( $value['id'], $value['std']  );
                endif;
        endforeach;
 }

    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_register_script('my-upload', WP_SUPERCUSTOM_CMS_ADDRESS.'scripts/supercustom_cms_script.js', array('jquery','media-upload','thickbox'), _wp_supercustomcms_ );
    wp_enqueue_script('my-upload');
    wp_enqueue_style('thickbox');
    wp_enqueue_style('white-label-cms', WP_SUPERCUSTOM_CMS_ADDRESS.'css/supercustom_cms_style.css', false, _wp_supercustomcms_, 'all');
}
function supercustom_cms_nag()
{
    if ( ! get_option('supercustom_cms_o_ver') ) echo '<div id="message" class="updated fade"><p><strong>Please update your <a href="admin.php?page=WP_SuperCustomCMS">Wordpress Custom Backend Settings</a></strong></p></div>';
}
function supercustom_cms_admin() 
{
    global $menu, $submenu;
    $i=0;
    include('includes/admin.config.php');

    if ( isset($_REQUEST['saved']) && $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong> Settings saved.</strong></p></div>';
    if ( isset($_REQUEST['reset']) && $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong> Settings reset.</strong></p></div>';

    require('includes/admin.view.php');
}

function supercustom_cms_iframe_mod()
{
    if( (isset($_GET['_wp_supercustomcms_']) ) ||  isset( $_GET["post_id"] ) && ( $_GET['post_id'] == '0' ) )
    { ?>
    <style type="text/css">
        #media-upload-header #sidemenu li#tab-type_url,
        #media-upload-header #sidemenu li#tab-gallery {display: none;}
        #media-items tr.url,#media-items tr.align,#media-items tr.image_alt,
        #media-items tr.post_title,  #media-items tr.image-size,
        #media-items tr.post_excerpt,#media-items tr.post_content,
        #media-items tr.image_alt p, #media-items table thead input.button,
        #media-items table thead img.imgedit-wait-spin,
        #media-items tr.submit a.wp-post-thumbnail {display: none;}
    </style>
    <script type="text/javascript">
    (function($){
    $(document).ready(function(){
        $('#media-items').bind('DOMNodeInserted',function(){
            $('input[value="Insert into Post"]').each(function(){
                    $(this).attr('value','Use This Image');
            });
        });
    });

    })(jQuery);
    </script>
<?php
    }
}
if ( is_admin() ) {

    //Load the plugin
    require 'includes/supercustom-menu-editor-core.php';
    $wp_menu_editor = new WPMenuEditor(__FILE__, 'supercustomcms_menu_editor');

}//is_admin()

include'functions/__wp_supercustom_cms_functions.php';
// include options-page in admin panel
require_once( 'SuperCustomCMS_page.php' );

// globale settings
require_once( 'functions/__wp_supercustom_cms_settings_notice.php' );
// core functions
?>
