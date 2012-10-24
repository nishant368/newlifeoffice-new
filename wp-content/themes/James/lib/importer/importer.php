<?php
if(!defined('WP_LOAD_IMPORTERS')) {
  define('WP_LOAD_IMPORTERS', true);
}

// Load Wordpress importer
require_once(ABSPATH . 'wp-admin/includes/import.php');
$error = false;
$file = TEMPLATEPATH . '/lib/importer/dummy/dummy.xml';

//check if wp_importer, the base importer class is available, otherwise include it
if(!class_exists( 'WP_Importer')) {
	$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
	if(file_exists($class_wp_importer))	{
		require_once($class_wp_importer);
	}	else {
		$error = true;
	}
}

//check if the wp import class is available, this class handles the wordpress XML files. If not include it
//make sure to exclude the init function at the end of the file in kriesi_importer
if(!class_exists('WP_Import')) {
	$class_wp_import = TEMPLATEPATH . '/lib/importer/class.wordpress_importer.php';
	if(file_exists($class_wp_import)) {
		require_once($class_wp_import);
	} else {
		$error = true;
	}
}

if($error !== false) {
	echo "The Auto importing script could not be loaded. please use the wordpress importer and import the XML file that is located in your themes folder manually.";
} else {
	if(!is_file($file)) {
		echo "The XML file containing the dummy content is not available or could not be read in <pre>".TEMPLATEPATH."</pre><br/> You might want to try to set the file permission to chmod 777.<br/>If this doesn't work please use the wordpress importer and import the XML file (should be located in your themes folder: dummy.xml) manually <a href='/wp-admin/import.php'>here.</a>";
	}	else {
	  $optionFields = array( '_tdCore-logo' => ''.site_url().'/wp-content/themes/James/lib/importer/dummy/JAMES-WP-LOGO.png', '_tdCore-home-bgType' => 'gallery', '_td-home-bgGal-speed' => '2', 'td-galleryCount' => '3', '_tdCore-galleryImg_1' => ''.site_url().'/wp-content/themes/James/lib/importer/dummy/dummy900x720-1.jpg', '_tdCore-galleryImg_2' => ''.site_url().'/wp-content/themes/James/lib/importer/dummy/dummy900x720-2.jpg', '_tdCore-galleryImg_3' => ''.site_url().'/wp-content/themes/James/lib/importer/dummy/dummy900x720-3.jpg', '_tdCore-rasterEffect' => 'small squares', '_td-hoverColor' => 'ff00ff', '_tdCore-copyName' => 'Theme Dutch', '_tdCore-copyLink' => 'http://www.theme-dutch.com', '_tdCore-p-font' => 'News Cycle', '_tdCore-h-font' => 'News Cycle' );
	  foreach($optionFields AS $field => $new_data) {
	    update_option($field, $new_data);
	  }
	
		$wp_import = new WP_Import();
		$wp_import->fetch_attachments = true;
		$wp_import->import_file($file);
	}
}