<?php
$wp_include = "../wp-load.php";
$i = 0;
while (!file_exists($wp_include) && $i++ < 10) {
  $wp_include = "../$wp_include";
}
require($wp_include);
// check for rights
if ( !is_user_logged_in() || !current_user_can('edit_posts') ) 
	wp_die(__("You are not allowed to be here"));
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Theme Dutch Shortcode</title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/lib/shortcodes/tinymce.js"></script>
<base target="_self" />
</head>
<body id="link" onLoad="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';" style="display:none">
<fieldset>
  <legend>Select the shortcode you would like to insert</legend>
  <table border="0" cellpadding="4" cellspacing="0">
    <tr>
      <td><select id="style_shortcode" name="style_shortcode" style="width: 200px">
          <optgroup label="Lightbox gallery">
          <option value="image">Single image</option>
          <option value="image_gallery">Image gallery</option>
          <option value="video">Single video</option>
          <option value="video_gallery">Video gallery</option>
          </optgroup>
        </select></td>
    </tr>
  </table>
</fieldset>
<div class="mceActionPanel">
  <div style="float:left">
    <input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();" />
  </div>
  <div style="float:right">
    <input type="submit" id="insert" name="insert" value="Insert" onClick="insertTeamDutchShortcode();" />
  </div>
</div>
</body>
</html>
