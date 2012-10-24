<?php
/**
 * @package SuperCustomCMS
 * @subpackage Settings page
 * @author karim salim
 */
if ( ! function_exists( 'add_action' ) ) {
	echo "Hi there!  I'm just a part of plugin, not much I can do when called directly.";
	exit;
}

// export options
if ( isset( $_GET['__wp_supercustom_cms_export'] ) ) {
	__wp_supercustom_cms_export();
	die();
}

//include( 'SuperCustomCMS_admin_bar.php' );

function __wp_supercustom_cms_options() {
	global $wpdb, $_wp_admin_css_colors, $wp_version, $wp_roles, $table_prefix;
	
	$__wp_supercustom_cms_user_info = '';

	//get array with userroles
	$user_roles = __wp_supercustom_cms_get_all_user_roles();
	$user_roles_names = __wp_supercustom_cms_get_all_user_roles_names();

	// update options
	if ( /*( isset($_POST['__wp_supercustom_cms_action']) && $_POST['__wp_supercustom_cms_action'] == '__wp_supercustom_cms_insert') &&*/ $_POST['__wp_supercustom_cms_save'] ) {

		if ( function_exists('current_user_can') && current_user_can('manage_options') ) {
			check_admin_referer('wp_supercustom_cms_nonce');
			__wp_supercustom_cms_update();
		
		} else {
			$myErrors = new __wp_supercustom_cms_message_class();
			$myErrors = '<div id="message" class="error"><p>' . $myErrors->get_error('__wp_supercustom_cms_access_denied') . '</p></div>';
			wp_die($myErrors);
		}
	}
	
	// import options
	if ( ( isset($_POST['__wp_supercustom_cms_action']) && $_POST['__wp_supercustom_cms_action'] == '__wp_supercustom_cms_import') && $_POST['__wp_supercustom_cms_save'] ) {

		if ( function_exists('current_user_can') && current_user_can('manage_options') ) {
			check_admin_referer('wp_supercustom_cms_nonce');
			
			__wp_supercustom_cms_import();
			
		} else {
			$myErrors = new __wp_supercustom_cms_message_class();
			$myErrors = '<div id="message" class="error"><p>' . $myErrors->get_error('__wp_supercustom_cms_access_denied') . '</p></div>';
			wp_die($myErrors);
		}
	}
	
	// deinstall options
	if ( ( isset($_POST['__wp_supercustom_cms_action']) && $_POST['__wp_supercustom_cms_action'] == '__wp_supercustom_cms_deinstall') &&  ($_POST['__wp_supercustom_cms_deinstall_yes'] != '__wp_supercustom_cms_deinstall') ) {

		$myErrors = new __wp_supercustom_cms_message_class();
		$myErrors = '<div id="message" class="error"><p>' . $myErrors->get_error('__wp_supercustom_cms_deinstall_yes') . '</p></div>';
		wp_die($myErrors);
	}

	if ( ( isset($_POST['__wp_supercustom_cms_action']) && $_POST['__wp_supercustom_cms_action'] == '__wp_supercustom_cms_deinstall') && $_POST['__wp_supercustom_cms_deinstall'] && ($_POST['__wp_supercustom_cms_deinstall_yes'] == '__wp_supercustom_cms_deinstall') ) {

		if ( function_exists('current_user_can') && current_user_can('manage_options') ) {
			check_admin_referer('wp_supercustom_cms_nonce');

			__wp_supercustom_cms_deinstall();

			$myErrors = new __wp_supercustom_cms_message_class();
			$myErrors = '<div id="message" class="updated fade"><p>' . $myErrors->get_error('__wp_supercustom_cms_deinstall') . '</p></div>';
			echo $myErrors;
		} else {
			$myErrors = new __wp_supercustom_cms_message_class();
			$myErrors = '<div id="message" class="error"><p>' . $myErrors->get_error('__wp_supercustom_cms_access_denied') . '</p></div>';
			wp_die($myErrors);
		}
	}
	
	// load theme user data
	if ( ( isset($_POST['__wp_supercustom_cms_action']) && $_POST['__wp_supercustom_cms_action'] == '__wp_supercustom_cms_load_theme') && $_POST['__wp_supercustom_cms_load'] ) {
		if ( function_exists('current_user_can') && current_user_can('edit_users') ) {
			check_admin_referer('wp_supercustom_cms_nonce');
			
			$myErrors = new __wp_supercustom_cms_message_class();
			$myErrors = '<div id="message" class="updated fade"><p>' . $myErrors->get_error('__wp_supercustom_cms_load_theme') . '</p></div>';
			echo $myErrors;
		} else {
			$myErrors = new __wp_supercustom_cms_message_class();
			$myErrors = '<div id="message" class="error"><p>' . $myErrors->get_error('__wp_supercustom_cms_access_denied') . '</p></div>';
			wp_die($myErrors);
		}
	}
	
	if ( ( isset($_POST['__wp_supercustom_cms_action']) && $_POST['__wp_supercustom_cms_action'] == '__wp_supercustom_cms_set_theme') && $_POST['__wp_supercustom_cms_save'] ) {
		if ( function_exists('current_user_can') && current_user_can('edit_users') ) {
			check_admin_referer('wp_supercustom_cms_nonce');
			
			__wp_supercustom_cms_set_theme();
			
			$myErrors = new __wp_supercustom_cms_message_class();
			$myErrors = '<div id="message" class="updated fade"><p>' . $myErrors->get_error('__wp_supercustom_cms_set_theme') . '</p></div>';
			echo $myErrors;
		} else {
			$myErrors = new __wp_supercustom_cms_message_class();
			$myErrors = '<div id="message" class="error"><p>' . $myErrors->get_error('__wp_supercustom_cms_access_denied') . '</p></div>';
			wp_die($myErrors);
		}
	}
?>
<style type="text/css">
.hndle
{

}
.button-abc
{
	background:url('<?php _e(WP_SUPERCUSTOM_CMS_ADDRESS); ?>images/savechanges.png') no-repeat;
  width: 90px;
  height: 28px;
  float: right;
  margin-right: 5px;
  border: none!important;
  cursor: pointer;
  margin-top: 9px;
  
}
.button-abc:hover
{
    background:url('<?php _e(WP_SUPERCUSTOM_CMS_ADDRESS); ?>images/savechanges_hover.png') no-repeat;
}
.button-abcx
{
    background:url('<?php _e(WP_SUPERCUSTOM_CMS_ADDRESS); ?>images/loaduserdata.png') no-repeat;
  width: 90px;
  height: 27px;
  float: left;
  margin-left: 5px;
   border: none!important;
  cursor: pointer;
  
}
.button-abcx:hover
{
    background:url('<?php _e(WP_SUPERCUSTOM_CMS_ADDRESS); ?>images/loaduserdata_hover.png') no-repeat;
}
</style>
<!--<script type="text/javascript" src="<?php _e(WP_SUPERCUSTOM_CMS_ADDRESS); ?>scripts/supercustom_cms_script.js"></script>
<link rel="stylesheet" href="<?php _e(WP_SUPERCUSTOM_CMS_ADDRESS); ?>css/supercustom_cms_style.css"/>
<link rel="stylesheet" href="<?php _e(WP_SUPERCUSTOM_CMS_ADDRESS); ?>css/editor.css"/>
-->
	<div class="wrap">
		<div class="supercustom_cms_opts">
        <img  src="<?php _e(WP_SUPERCUSTOM_CMS_ADDRESS); ?>images/wpsc_logo.png" class="wp_supercustom_cms_images" style="width: 744px;"/>
		<?php 
        // Branding Options
		require_once( 'options/__wp_supercustom_cms_branding.php' );
        
        //Menu editor
        require_once('options/__wp_supercustom_cms_menu_editor.php');
        ?>
        <form name="backend_option" method="post" id="__wp_supercustom_cms_options" action="?page=<?php echo esc_attr( $_GET['page'] );?>" >
		<?php 
        
		// Backend Options for all roles
		require_once('options/__wp_supercustom_cms_backend_options.php');
		
		// global options on all pages in backend for diffferent roles
		require_once('options/__wp_supercustom_cms_global_options.php');
		
		// dashboard options for different roles
		require_once('options/__wp_supercustom_cms_dashboard_options.php');
		
		// Menu Submenu Options
		require_once('options/__wp_supercustom_cms_menu_options.php');
		
		// Write Page Options
		require_once('options/__wp_supercustom_cms_write_post_options.php');
		
		// Write Page Options
		require_once('options/__wp_supercustom_cms_write_page_options.php');
		
		// Custom Post Type
		if ( function_exists( 'get_post_types' ) )
			require_once('options/__wp_supercustom_cms_write_cp_options.php');
		
		// Links Options 
		require_once('options/__wp_supercustom_cms_links_options.php');
		
		// WP Nav Menu Options 
		require_once('options/__wp_supercustom_cms_wp_nav_menu_options.php');
		?>
		
		<?php
		// Theme Options
		require_once('options/__wp_supercustom_cms_theme_options.php');
		
		// Im/Export Options
		//require_once('options/__wp_supercustom_cms_im_export_options.php');
		
		// deinstall options
		//require_once('options/__wp_supercustom_cms_deinstall_options.php');
		if(isset($_POST['editor'])||isset($_POST['save'])||isset($_POST['save1'])||isset($_POST['save2'])||isset($_POST['save3'])||isset($_POST['__wp_supercustom_cms_save'])){echo'<script type="text/javascript">window.location = "'.WP_SUPERCUSTOM_CMS_ADMIN.'"</script>';}
        ?>
        </form>
		</div>
		<script type="text/javascript">
		<!--
		<?php if ( version_compare( $wp_version, '2.7alpha', '<' ) ) { ?>
		jQuery('.postbox h3').prepend('<a class="togbox">+</a> ');
		<?php } ?>
		jQuery('.postbox h3').click( function() { jQuery(jQuery(this).parent().get(0)).toggleClass('closed'); } );
		jQuery('.postbox .handlediv').click( function() { jQuery(jQuery(this).parent().get(0)).toggleClass('closed'); } );
		jQuery('.postbox.close-me').each(function() {
			jQuery(this).addClass("closed");
		});
		//-->
		</script>
        
        <script type="text/javascript">
        jQuery(document).ready(function($) {
        		// Upload function goes here
        
        		jQuery('.upload_image_button').click(function() {
        		formField = jQuery(this).attr('rel');
        		tb_show('', 'media-upload.php?type=image&wlcms=true&TB_iframe=true');
        		return false;
        		});
        
        		window.send_to_editor = function(html) {
        		imgurl = jQuery('img',html).attr('src');
        		jQuery('#'+formField).val(imgurl);
        		tb_remove();
        		}
        
        
        
        	var formfield=null;
        	window.original_send_to_editor = window.send_to_editor;
        	window.send_to_editor = function(html){
        		if (formfield) {
        			var fileurl = jQuery('img',html).attr('src');
        			formfield.val(fileurl);
        			tb_remove();
        		} else {
        			window.original_send_to_editor(html);
        		}
        		formfield=null;
        	};
        
        	jQuery('.lu_upload_button').click(function() {
         		formfield = jQuery(this).parent().parent().find(".text_input");
         		tb_show('', 'media-upload.php?type=image&wlcms=true&TB_iframe=true');
        		jQuery('#TB_overlay,#TB_closeWindowButton').bind("click",function(){formfield=null;});
        		return false;
        	});
        	jQuery(document).keyup(function(e) {
          		if (e.keyCode == 27) formfield=null;
        	});
        
        });
        </script>

	</div>
<?php
}
?>