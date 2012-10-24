<?php

$_wp_supercustomcms_ShortName = "supercustom_cms_o";

global $wp_version, $submenu;

$_wp_supercustomcms_Options = array(
    array( "name" =>  "WP CustomSuper CMS", "type" => "title"),
    array( "name" => "Branding", "type" => "section"),
    array( "type" => "open"),
    array( "name" => "Admin Bar", "type" => "subtitle")
);
 
if ( version_compare( $wp_version, '3.2.5', '>=' ) )
{
    $_wp_supercustomcms_Options[] = array(
            "name"  => "Hide WordPress Logo",
            "desc"  => "Hide WordPress logo from the admin bar",
            "id"    => $_wp_supercustomcms_ShortName."_hide_wp_adminbar",
            "type"  => "radio",
            "options" => array("1", "0"),
            "std"   => 0);
    $_wp_supercustomcms_Options[] = 	array(
            "name"  => "Add Your Logo (16px x 16px)",
            "desc"  => "Adds a 16px logo to the admin bar",
            "id"    => $_wp_supercustomcms_ShortName."_adminbar_custom_logo",
            "class" => 'upload_image_button',
            "type"  => "file",
            "std"   => '');
    $_wp_supercustomcms_Options[] = array( "name" => "Add Dashboard Logo", "type" => "subtitle" );
    $_wp_supercustomcms_Options[] = array(
            "name"  => "Add Dashboard Logo",
            "desc"  => "This will replace the home icon on the dashboard with your own logo.",
            "id"    => $_wp_supercustomcms_ShortName."_header_custom_logo",
            "class" =>'upload_image_button',
            "type"  => "file",
            "std"   => '');
    $_wp_supercustomcms_Options[] = array(
            "name"  => "Replace Dashboard Heading",
            "desc"  => "This will replace the heading \"Dashboard\" on the dashboard page. This combined with a custom logo will help improve the branding experience for your client",
            "id"    => $_wp_supercustomcms_ShortName."_dashboard_override",
            "type"  => "text",
            "title" => '',
            "std"   => __('Dashboard'));
}
else
{
    $_wp_supercustomcms_Options[] = array(
            "name"  => "Classic Header Height",
            "desc"  => "<b>3.2 Only</b> - This will keep Header height to 46px, pre WordPress 3.2 size (better for branding) if its empty",
            "id"    => $_wp_supercustomcms_ShortName."_header_height",
            "type"  => "text",
            "unit"  => "px",
            "class" => 'default-text',
            "title" => 'Header',
            "std"   => '0');

    $_wp_supercustomcms_Options[] = array(
            "name"  => "Custom Header Logo",
            "desc"  => "This is a logo that will appear in the header. It should be a transparent .gif or .png and about 32px by 32px. You can either upload an image, or just type in the image name if you have already placed it in the images folder of your theme or child.",
            "id"    => $_wp_supercustomcms_ShortName."_header_custom_logo",
            "class" => 'upload_image_button',
            "type"  => "file",
            "std"   => '');

    $_wp_supercustomcms_Options[] = array(
            "name"  => "Custom Header Logo Width",
            "desc"  => "Leave blank for default value of 32px.",
            "id"    => $_wp_supercustomcms_ShortName."_header_custom_logo_width",
            "type"  => "text",
            "unit"  => "px",
            "class" => 'default-text',
            "title" => '32',
            "std"   => '');
  
	$_wp_supercustomcms_Options[] = array(
            "name" => "Header Logo As Site Link",
            "desc" => "The logo that appears in the header with be the link to the site. It will remove the text link",
            "id" => $_wp_supercustomcms_ShortName."_header_logo_link",
            "type" => "radio",
            "options" => array("1", "0"),
            "std" => 0);
}

$_wp_supercustomcms_Options2 = array(
    array( "name" => "Footer", "type" => "subtitle" ),
    array(
            "name"  => "Custom Footer Logo",
            "desc"  => "This logo will appear in the footer on the left hand side",
            "id"    => $_wp_supercustomcms_ShortName."_footer_custom_logo",
            "type"  => "file",
            "class" => 'upload_image_button',
            "std"   => ''),
	
    array(
            "name"  => "Developer Website URL",
            "desc"  => "There will be a link to your website in the footer. Leave it blank if you don't want the link otherwise please include http://",
            "id"    => $_wp_supercustomcms_ShortName."_developer_url",
            "type"  => "text",
            "std"   => ''),
	
    array(
            "name"  => "Developer Website Name",
            "desc"  => "The developer's name will appear in the footer",
            "id"    => $_wp_supercustomcms_ShortName."_developer_name",
            "type"  => "text",
            "std"   => ''),

    array(
            "name"  => "Hide WP Version",
            "desc"  => "This will hide WordPress Version in right corner of the footer and on the Right Now dashboard panel",
            "id"    => $_wp_supercustomcms_ShortName."_hide_wpversion",
            "type"  => "radio",
            "options" => array("1", "0"),
            "std"   => 0),

    array(  "name" => "Login", "type" => "subtitle"),
	
    array(
            "name"  => "Make background colour white",
            "desc"  => "This will make the login screen have a white background. Useful if your logo isn't transparent.",
            "id"    => $_wp_supercustomcms_ShortName."_loginbg_white",
            "type"  => "radio",
            "options" => array("1", "0"),
            "std"   => 0),

    array(
            "name"  => "Custom Login Logo",
            "desc"  => "This logo will appear on the login page.  It should be about 300px by 80px.",
            "id"    => $_wp_supercustomcms_ShortName."_login_custom_logo",
            "type"  => "file",
            "class" => 'upload_image_button',
            "std"   => ''),

    array(
            "name"  => "Custom Login CSS",
            "desc"  => "For example:<br /> .login form { background-color: #0013FF } <br />.login #login p#nav a { color: #333 !important }<br /><br /> Or if you want to get fancy:<br /> #supercustom-cms-login-wrapper{ background: url('wp-content/plugins/white-label-cms/images/footergrass.jpg') repeat-x fixed center bottom transparent; display: block; height: 100%; left: 0; overflow: auto; position: absolute; top: 0; width: 100%;} ",
            "id"    => $_wp_supercustomcms_ShortName."_login_bg_css",
            "type"  => "textarea",
            "std"   => ''),

    array(  "name" => "Admin Page Title","type" => "subtitle"),

    array(
            "name"  => "Custom Page Titles",
            "desc"  => "This replaces the - WordPress in the admin page titles. If this is set to nothing WordPress will continue to appear in the page titles",
            "id"    => $_wp_supercustomcms_ShortName."_admin_page_title",
            "type"  => "text",
            "std"   => ''),

    array( "type" => "close"),
    array( "name" => "Dashboard Panels", "type" => "section"),
    array( "type" => "open"),


    array(
            "name" => "Add your own Welcome Panel?",
            "desc" => "This will appear on the dashboard. We recommend providing your contact details and links to the help files you have made for your client.",
            "id" => $_wp_supercustomcms_ShortName."_show_welcome",
            "type" => "radio",
            "options" => array("1", "0"),
            "std" => "0" ),

    array( "name" => "Welcome Panel Settings", "type" => "subsectionvars"),

    array(
            "name" => "Visible To",
            "desc" => "This means the welcome panel will appear for users with roles higher or equal to the one chosen.",
            "id" => $_wp_supercustomcms_ShortName."_welcome_visible_to",
            "type" => "select",
            "options"=>supercustom_cms_roles_dropdown(),
            "std" => 'editor'),

    array(
            "name" => "Title",
            "desc" => "The title of your dashboard panel.",
            "id" => $_wp_supercustomcms_ShortName."_welcome_title",
            "type" => "text",
            "std" => 'Welcome To Your New Website'),

    array(
            "name" => "Description",
            "desc" => "Please add the text in html format here.",
            "id" => $_wp_supercustomcms_ShortName."_welcome_text",
            "type" => "textarea",
            "std" => ''),

array( 	"name" => "Second Panel Settings","type" => "subtitle"),

array( 	"name" => "Visible To",
		"desc" => "This means the welcome panel will appear for users with roles lesser or equal to the one chosen.",
		"id" => $_wp_supercustomcms_ShortName."_welcome_visible_to1",
		"type" => "select",
		"options"=>supercustom_cms_roles_dropdown(),
		"std" => ''),

array( 	"name" => "Title",
		"desc" => "The title of your dashboard panel.",
		"id" => $_wp_supercustomcms_ShortName."_welcome_title1",
		"type" => "text",
		"std" => ''),	

array( 	"name" => "Description",
		"desc" => "Please add the text in html format here.",
		"id" => $_wp_supercustomcms_ShortName."_welcome_text1",
		"type" => "textarea",
		"std" => ''),



array( 	"name" => "Third Panel Settings","type" => "subtitle"),

array( 	"name" => "Visible To",
		"desc" => "This means the welcome panel will appear for users with roles lesser or equal to the one chosen.",
		"id" => $_wp_supercustomcms_ShortName."_welcome_visible_to2",
		"type" => "select",
		"options"=>supercustom_cms_roles_dropdown(),
		"std" => ''),

array( 	"name" => "Title",
		"desc" => "The title of your dashboard panel.",
		"id" => $_wp_supercustomcms_ShortName."_welcome_title2",
		"type" => "text",
		"std" => ''),	

array( 	"name" => "Description",
		"desc" => "Please add the text in html format here.",
		"id" => $_wp_supercustomcms_ShortName."_welcome_text2",
		"type" => "textarea",
		"std" => ''),
        
array( 	"name" => "Forth Panel Settings","type" => "subtitle"),

array( 	"name" => "Visible To",
		"desc" => "This means the welcome panel will appear for users with roles lesser or equal to the one chosen.",
		"id" => $_wp_supercustomcms_ShortName."_welcome_visible_to3",
		"type" => "select",
		"options"=>supercustom_cms_roles_dropdown(),
		"std" => ''),

array( 	"name" => "Title",
		"desc" => "The title of your dashboard panel.",
		"id" => $_wp_supercustomcms_ShortName."_welcome_title3",
		"type" => "text",
		"std" => ''),	

array( 	"name" => "Description",
		"desc" => "Please add the text in html format here.",
		"id" => $_wp_supercustomcms_ShortName."_welcome_text3",
		"type" => "textarea",
		"std" => ''),
        
  array( 	"name" => "Fifth Panel Settings","type" => "subtitle"),

array( 	"name" => "Visible To",
		"desc" => "This means the welcome panel will appear for users with roles lesser or equal to the one chosen.",
		"id" => $_wp_supercustomcms_ShortName."_welcome_visible_to4",
		"type" => "select",
		"options"=>supercustom_cms_roles_dropdown(),
		"std" => ''),

array( 	"name" => "Title",
		"desc" => "The title of your dashboard panel.",
		"id" => $_wp_supercustomcms_ShortName."_welcome_title4",
		"type" => "text",
		"std" => ''),	

array( 	"name" => "Description",
		"desc" => "Please add the text in html format here.",
		"id" => $_wp_supercustomcms_ShortName."_welcome_text4",
		"type" => "textarea",
		"std" => ''),
array( "type" => "closeonce"),

array( "type" => "close"),

array( 	"name" => "Admin Settings", "type" => "section"),
array( "type" => "open"),
	
array( 	"name" => "Enable Login URL Redirect",
		"desc" => "Clients can go to /login as well as /wp-login.php only when permalinks are enabled",
		"id" => $_wp_supercustomcms_ShortName."_enable_login_redirect",
		"type" => "radio",
		"options" => array("1", "0"),
		"std" => 1),
			
array( 	"name" => "Hide Nag Update",
		"desc" => "This will hide the Nag Update for out of date versions of WordPress",
		"id" => $_wp_supercustomcms_ShortName."_dashboard_remove_nag_update",
		"type" => "radio",
		"options" => array("1", "0"),
		"std" => 1),
			
array( 	"name" => "Hide Help Box",
		"desc" => "This will hide the Help Box dropdown",
		"id" => $_wp_supercustomcms_ShortName."_dashboard_remove_help_box",
		"type" => "radio",
		"options" => array("1", "0"),
		"std" => 0),
			
array( 	"name" => "Hide Screen Options",
		"desc" => "This will hide the Screen Options dropdown",
		"id" => $_wp_supercustomcms_ShortName."_dashboard_remove_screen_options",
		"type" => "radio",
		"options" => array("1", "0"),
		"std" => 0),

array( 	"name" => "Hide Meta Boxes","type" => "subtitle"),
	
array("id"=>'',"type"=>"divopen",'class'=>"supercustom_cms_input"),

array(	"heading" => "Hide Post Meta Boxes",
		"desc" => "Choose meta boxes that you want to remove from the Edit Post panel",
		"type"=>"headings"),
			
array( 
		"id" => $_wp_supercustomcms_ShortName."_hide_post_div",
		"type" => "divopen",
		'class'=>$_wp_supercustomcms_ShortName."_hide_post_divclass"),
array( 
		"id" => $_wp_supercustomcms_ShortName."_post_meta_box_excerpt",
		"type" => "checkbox",
		"label"=>"Excerpt",
		"std" => 0),
array( 
		"id" => $_wp_supercustomcms_ShortName."_post_meta_box_slug",
		"type" => "checkbox",
		"label"=>"Slug",
		"std" => 0),
array( 
	
	"id" => $_wp_supercustomcms_ShortName."_post_meta_box_tags",
	"type" => "checkbox",
	"label"=>"Tags",
	"std" => 0),
		
array( 
		"id" => $_wp_supercustomcms_ShortName."_post_meta_box_author",
		"type" => "checkbox",
		"label"=>"Author",
		"std" => 0),
array( 
	
	"id" => $_wp_supercustomcms_ShortName."_post_meta_box_comments",
	"type" => "checkbox",
	"label"=>"Comments",
	"std" => 0),
array( "type" => "divclose"),

array( 
		"id" => $_wp_supercustomcms_ShortName."_hide_post_divnew",
		"type" => "divopen",
		'class'=>$_wp_supercustomcms_ShortName."_hide_post_divclassnew"),

array( 
	
	"id" => $_wp_supercustomcms_ShortName."_post_meta_box_revisions",
	"type" => "checkbox",
	"label"=>"Revisions",
	"std" => 0),
array( 
	
	"id" => $_wp_supercustomcms_ShortName."_post_meta_box_discussions",
	"type" => "checkbox",
	"label"=>"Discussion",
	"std" => 0),
array( 
	
	"id" => $_wp_supercustomcms_ShortName."_post_meta_box_categories",
	"type" => "checkbox",
	"label"=>"Categories",
	"std" => 0),

array( 
		"id" => $_wp_supercustomcms_ShortName."_post_meta_box_custom",
		"type" => "checkbox",
		"label"=>"Custom Fields",
		"std" => 0),
			
array( 
		"id" => $_wp_supercustomcms_ShortName."_post_meta_box_send",
		"type" => "checkbox",	
		"label"=>"Send Trackbacks",
		"std" => 0),
			
			
				
array("type" => "divclose"),
array("type" => "divclose"),
array('type'=>'clear'),
array('type'=>'space'),

array( 

"id" => '',
"type" => "divopen",
'class'=>"supercustom_cms_input"),
	
/**/
array( "heading" => "Hide Page Meta Boxes",
	"desc" => "Choose meta boxes that you want to remove from the Edit Page panel",
	"type"=>"headings"),
array( 
	
	"id" => $_wp_supercustomcms_ShortName."_hide_page_divmain",
	"type" => "divopen",
	'class'=>$_wp_supercustomcms_ShortName."_hide_page_divclassmain"),

array( 
	
	"id" => $_wp_supercustomcms_ShortName."_hide_page_div",
	"type" => "divopen",
	'class'=>$_wp_supercustomcms_ShortName."_hide_page_divclass"),
array( 
	
	"id" => $_wp_supercustomcms_ShortName."_page_meta_box_custom",
	"type" => "checkbox",
	"label"=>"Custom Fields",
	"std" => 0),
array( 
	
	"id" => $_wp_supercustomcms_ShortName."_page_meta_box_author",
	"type" => "checkbox",
	"label"=>"Author",
	"std" => 0),
		
array( 
	
	"id" => $_wp_supercustomcms_ShortName."_page_meta_box_discussions",
	"type" => "checkbox",
	"label"=>"Discussion",
	"std" => 0),
array( 
	
	"id" => $_wp_supercustomcms_ShortName."_page_meta_box_revisions",
	"type" => "checkbox",
	"label"=>"Revisions",
	"std" => 0),
array( 
	
	
	"type" => "divclose"
	),
array( 
	
	"id" => $_wp_supercustomcms_ShortName."_hide_page_divnew",
	"type" => "divopen",
	'class'=>$_wp_supercustomcms_ShortName."_hide_page_divclassnew"),
 
array( 
	
	"id" => $_wp_supercustomcms_ShortName."_page_meta_box_page",
	"type" => "checkbox",
	"label"=>"Page Attributes",
	"std" => 0),
array( 
	
	"id" => $_wp_supercustomcms_ShortName."_page_meta_box_slug",
	"type" => "checkbox",
	"label"=>"Slug",
	"std" => 0),
array("type" => "divclose"),
array("type" => "divclose"),
array("type" => "divclose"),
	
array( "name" => "Custom CSS for Admin",
	"desc" => "Override or add to any of the styles in the WordPress admin enter your own custom css here",
	"id" => $_wp_supercustomcms_ShortName."_custom_css",
	"type" => "textarea",
	"std" => ''),
array( "name" => "Custom Editor Stylesheet",
	"desc" => "Create and upload a custom stylesheet with all style rules  prefixed with .mceContentBody to your themes directory and enter the filename",
	"id" => $_wp_supercustomcms_ShortName."_welcome_stylesheet",
	"type" => "textcustom",
	"std" => ''),	
array( "type" => "close")
	);


$supercustom_cms_show_appearance_legacy = '0';
$supercustom_cms_show_menus_legacy = '1';
$supercustom_cms_show_widgets_legacy = '1';


if ((get_option('supercustom_cms_o_show_appearance')) || ( get_option('supercustom_cms_o_show_widgets')))
{
    $supercustom_cms_show_appearance_legacy = '1';
    if (get_option('supercustom_cms_o_show_appearance')) {
            $supercustom_cms_show_menus_legacy = '0';
    }
    if (get_option('supercustom_cms_o_show_widgets')) {
            $supercustom_cms_show_widgets_legacy = '0';
    }
}


$_wp_supercustomcms_Options3[] = array( "type" => "divclose" );
$_wp_supercustomcms_Options3[] = array( "type" => "divclose" );
// To improve the config builder.
$_wp_supercustomcms_Options = array_merge( $_wp_supercustomcms_Options, $_wp_supercustomcms_Options2, $_wp_supercustomcms_Options3 );
 
?>