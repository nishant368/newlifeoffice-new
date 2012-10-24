<?php
/* Initialize the theme admin functionality. */
add_action('init', 'smartSeo_admin_init' );


// Initializes the theme administration functions. Makes sure we have a theme settings page and a meta box on the edit post/page screen.
function smartSeo_admin_init() {
	global $smartSeo;
	$prefix = $smartSeo->prefix;

	/* Initialize the theme settings page. */
	add_action('admin_menu', 'smartSeo_settings_page_init');
	
	/* Initialize the admin head js,css. Call smartSeo_admin_head() from options/init_options.php */
	add_action('admin_head', 'smartSeo_admin_head');
	
	/* Initialize the admin option fields. Call admin_option_fields() from options/admin_options.php */
	add_action('admin_head', 'admin_option_fields');
	add_action('admin_head', 'smartSeo_save_admin_options');
}

/* Initializes plugin settings */
function smartSeo_settings_page_init() {
	global $smartSeo;
	
	/* get plugin information. */
	$utils = $smartSeo->utils;

	/* Create the theme settings page. */
	add_object_page('Page Title', $utils['shortname'], 2,'smartSeo', 'smartSeo_create_settings_page', PLUGIN_URI . $utils['icon']);
	add_submenu_page('smartSeo', 'AdminMenu', 'Configuration', 'administrator', 'smartSeo', 'smartSeo_create_settings_page');
	//add_submenu_page('smartSeo', 'Suport', 'Support', 'administrator', 'support', 'smartSeo_create_support_page');
}