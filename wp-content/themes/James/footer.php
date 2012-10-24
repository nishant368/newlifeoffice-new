<?php
$HomebgType = get_option('_tdCore-home-bgType');
$HomebgImg = get_option('_tdCore-home-bgImg');
$SearchbgImg = get_option('_tdCore-search-bgImg');
$notFoundbgImg = get_option('_tdCore-notfound-bgImg');
$archivebgImg = get_option('_tdCore-archive-bgImg');
$rasterEffect = get_option('_tdCore-rasterEffect');
switch ($rasterEffect) {
   case 'none':
      $rasterEffect = 'off';
   break;
   case 'vertical stripes':
      $rasterEffect = 'verticalStripes';
   break;
   case 'circles':
      $rasterEffect = 'circles';
   break;
   case 'squares':
      $rasterEffect = 'squares';
   break;
	 case 'small squares':
	 		$rasterEffect = 'small-square';
	 break;
}
$analytics = get_option('_tdCore-analytics');
$logo = get_option('_tdCore-logo');
$twitter = get_option('_tdCore-twitter');
$flickr = get_option('_tdCore-flickr');
$rss = get_option('_tdCore-rss');
$facebook = get_option('_tdCore-facebook');
$linkedin = get_option('_tdCore-linkedin');
$youtube = get_option('_tdCore-youtube');
$own1 = get_option('_tdCore-own1');
$own1Logo = get_option('_tdCore-own1-logo');
$own2 = get_option('_tdCore-own2');
$own2Logo = get_option('_tdCore-own2-logo');
$own3 = get_option('_tdCore-own3');
$own3Logo = get_option('_tdCore-own3-logo');
$own4 = get_option('_tdCore-own4');
$own4Logo = get_option('_tdCore-own4-logo');
$copyName = get_option('_tdCore-copyName');
if(!$copyName || trim($copyName) == '') { $copyName = 'Theme Dutch'; }
$copyLink = get_option('_tdCore-copyLink');
if(!$copyLink || trim($copyLink) == '') { $copyLink = 'http://www.theme-dutch.com'; }
?>

<div id='footer'>
  <div class="loginWrap">
    <div class="loginTooltip"><?php echo __( 'Login', 'tdCore' ); ?></div>
    <div class="login-icon"></div>
    <div class="login-content">
      <div class="login-form">
        <?php if (!(current_user_can('level_0'))){ ?>
        <form action="<?php echo home_url(); ?>/wp-login.php" method="post">
          <input type="text" name="log" id="log" value="<?php echo esc_html(stripslashes($user_login), 1) ?>" size="20" />
          <input type="password" name="pwd" id="pwd" size="20" />
          <input type="submit" name="submit" value="<?php echo __( 'Login', 'tdCore' ); ?>" class="loginButton" />
        </form>
        <a class="recover" href="<?php echo home_url(); ?>/wp-login.php?action=lostpassword"><?php echo __( 'Recover password', 'tdCore' ); ?></a><br />
        <a class="register" href="<?php echo home_url(); ?>/wp-login.php?action=register"><?php echo __( 'Register', 'tdCore' ); ?></a>
        <?php } else { 
global $current_user;
get_currentuserinfo(); ?>
        <?php echo __( 'Hi', 'tdCore' ).' '.$current_user->user_login ?>, <br />
        <a class="logout" href="<?php echo wp_logout_url( $_SERVER["REQUEST_URI"]  ); ?>">Logout?</a>
        <?php }?>
        <span class="clearAll"></span> </div>
    </div>
  </div>
  <div class="searchWrap">
    <div class="searchTooltip"><?php echo __( 'Search', 'tdCore' ); ?></div>
    <div class="search-icon"></div>
    <div class="search-content">
      <div class="search-bar">
        <?php get_search_form(); ?>
      </div>
      <div class="social">
        <?php if ($twitter != '') { ?>
        <a href="http://twitter.com/<?php echo $twitter; ?>/" target="_blank" class="twitter" ></a>
        <?php } ?>
        <?php if ($flickr != '') { ?>
        <a href="http://flickr.com/<?php echo $flickr; ?>/" target="_blank" class="flickr" ></a>
        <?php } ?>
        <?php if ($rss != '') { ?>
        <a href="<?php echo $rss; ?>" target="_blank" class="rss" ></a>
        <?php } ?>
        <?php if ($facebook != '') { ?>
        <a href="http://facebook.com/<?php echo $facebook; ?>/" target="_blank" class="facebook" ></a>
        <?php } ?>
        <?php if ($linkedin != '') { ?>
        <a href="http://linkedin.com/in/<?php echo $linkedin; ?>/" target="_blank" class="linkedin" ></a>
        <?php } ?>
        <?php if ($youtube != '') { ?>
        <a href="http://youtube.com/<?php echo $youtube; ?>/" target="_blank" class="youtube" ></a>
        <?php } ?>
        <?php if ($own1 != '') { ?>
        <a href="<?php echo $own1; ?>" target="_blank" ><img src="<?php echo $own1Logo; ?>" /></a>
        <?php } ?>
        <?php if ($own2 != '') { ?>
        <a href="<?php echo $own2; ?>" target="_blank" ><img src="<?php echo $own2Logo; ?>" /></a>
        <?php } ?>
        <?php if ($own3 != '') { ?>
        <a href="<?php echo $own3; ?>" target="_blank" ><img src="<?php echo $own3Logo; ?>" /></a>
        <?php } ?>
        <?php if ($own4 != '') { ?>
        <a href="<?php echo $own4; ?>" target="_blank" ><img src="<?php echo $own4Logo; ?>" /></a>
        <?php } ?>
      </div>
      <?php
$menuLeft = array( 'container_class' => 'menu-header', 'menu_class' => 'menu', 'menu_id' => 'menu-header', 'theme_location' => 'primary', 'after' => '<span class="menuHeaderStripe">|</span>' );
$menuRight = array( 'theme_location' => 'footer', 'container_class' => 'menu-right', 'menu_class' => 'menu', 'menu_id' => 'menu-right', 'before' => ' | ', 'fallback_cb' => false );
?>
    </div>
  </div>
  <div class="logo"><a href="<?php echo site_url(); ?>"><img alt='<?php echo get_bloginfo('name'); ?>' src='<?php echo $logo; ?>' /></a></div>
  <?php wp_nav_menu( $menuLeft ); ?>
  <div class="copyright"><a href="<?php echo $copyLink; ?>">&copy; <?php echo date('Y') . ' ' . $copyName; ?></a>
    <?php wp_nav_menu( $menuRight ); ?>
  </div>
</div>
<?php
if (is_tag()) { 
if(trim($archivebgImg) != '') {
$archivebgImg = makePathAbsolute($archivebgImg);
	if($rasterEffect != '') {
	if($rasterEffect != 'off') {
echo '<div class="rasterize" style="background: url(\''.get_template_directory_uri().'/images/'.$rasterEffect.'.png\');"></div>';
	}
}
echo '<div id="supersized"></div>';
$PageBgGalSpeed = '4000';
$PageBgGalEffect = '1';
?>
<script type="text/javascript">		
jQuery(document).ready(function () { jQuery.supersized({ slideshow : 1, autoplay : 1, start_slide : 1, slide_interval : <?php echo $PageBgGalSpeed; ?>, transition : <?php echo $PageBgGalEffect; ?>, transition_speed : 1500, new_window : 1, pause_hover : 0, keyboard_nav : 1, performance : 1, image_protect : 1, image_path : 'img/', min_width : 0, min_height : 0, vertical_center : 1, horizontal_center : 1, fit_portrait : 1, fit_landscape : 0, navigation : 1, thumbnail_navigation : 1, slide_counter : 1, slide_captions : 1, slides : [
{image : '<?php echo $archivebgImg; ?>'}]}); });
</script>
<?php
}
}
else if (is_author()) {
	if(trim($archivebgImg) != '') {
$archivebgImg = makePathAbsolute($archivebgImg);
	if($rasterEffect != '') {
	if($rasterEffect != 'off') {
echo '<div class="rasterize" style="background: url(\''.get_template_directory_uri().'/images/'.$rasterEffect.'.png\');"></div>';
	}
}
echo '<div id="supersized"></div>';
$PageBgGalSpeed = '4000';
$PageBgGalEffect = '1';
?>
<script type="text/javascript">		
jQuery(document).ready(function () { jQuery.supersized({ slideshow : 1, autoplay : 1, start_slide : 1, slide_interval : <?php echo $PageBgGalSpeed; ?>, transition : <?php echo $PageBgGalEffect; ?>, transition_speed : 1500, new_window : 1, pause_hover : 0, keyboard_nav : 1, performance : 1, image_protect : 1, image_path : 'img/', min_width : 0, min_height : 0, vertical_center : 1, horizontal_center : 1, fit_portrait : 1, fit_landscape : 0, navigation : 1, thumbnail_navigation : 1, slide_counter : 1, slide_captions : 1, slides : [
{image : '<?php echo $archivebgImg; ?>'}]}); });
</script>
<?php
}
} 
else if (is_search()) { 
if(trim($SearchbgImg) != '') {
$notFoundbgImg = makePathAbsolute($SearchbgImg);
	if($rasterEffect != '') {
	if($rasterEffect != 'off') {
echo '<div class="rasterize" style="background: url(\''.get_template_directory_uri().'/images/'.$rasterEffect.'.png\');"></div>';
	}
}
echo '<div id="supersized"></div>';
$PageBgGalSpeed = '4000';
$PageBgGalEffect = '1';
?>
<script type="text/javascript">		
jQuery(document).ready(function () { jQuery.supersized({ slideshow : 1, autoplay : 1, start_slide : 1, slide_interval : <?php echo $PageBgGalSpeed; ?>, transition : <?php echo $PageBgGalEffect; ?>, transition_speed : 1500, new_window : 1, pause_hover : 0, keyboard_nav : 1, performance : 1, image_protect : 1, image_path : 'img/', min_width : 0, min_height : 0, vertical_center : 1, horizontal_center : 1, fit_portrait : 1, fit_landscape : 0, navigation : 1, thumbnail_navigation : 1, slide_counter : 1, slide_captions : 1, slides : [
{image : '<?php echo $SearchbgImg; ?>'}]}); });
</script>
<?php
}
} 
else if(is_archive()) {
	if(!is_category()) {
		if(trim($archivebgImg) != '') {
$archivebgImg = makePathAbsolute($archivebgImg);
	if($rasterEffect != '') {
	if($rasterEffect != 'off') {
echo '<div class="rasterize" style="background: url(\''.get_template_directory_uri().'/images/'.$rasterEffect.'.png\');"></div>';
	}
}
echo '<div id="supersized"></div>';
$PageBgGalSpeed = '4000';
$PageBgGalEffect = '1';
?>
<script type="text/javascript">		
jQuery(document).ready(function () { jQuery.supersized({ slideshow : 1, autoplay : 1, start_slide : 1, slide_interval : <?php echo $PageBgGalSpeed; ?>, transition : <?php echo $PageBgGalEffect; ?>, transition_speed : 1500, new_window : 1, pause_hover : 0, keyboard_nav : 1, performance : 1, image_protect : 1, image_path : 'img/', min_width : 0, min_height : 0, vertical_center : 1, horizontal_center : 1, fit_portrait : 1, fit_landscape : 0, navigation : 1, thumbnail_navigation : 1, slide_counter : 1, slide_captions : 1, slides : [
{image : '<?php echo $archivebgImg; ?>'}]}); });
</script>
<?php
}
	}
	if(is_category()) {
foreach((get_the_category()) as $category)
{
$postcat= $category->cat_ID;
$catname =$category->cat_name;
$catslug = $category->category_nicename;
	if (is_category($catslug)) { 
		$end = $postcat;
	}
}
$args=array('orderby' => 'name','order' => 'ASC');
$categories=get_categories($args);
$iC = '';
foreach($categories as $cat):
$iC++;
if($cat->name != ''):
if($end == $cat->cat_ID) {
$catname = $cat->name;
$count = get_option('portfolioType'.$iC);
if($count == 'Gallery') {
	if($rasterEffect != '') {
	if($rasterEffect != 'off') {
	echo '<div class="rasterize" style="background: url(\''.get_template_directory_uri().'/images/'.$rasterEffect.'.png\');"></div>';
	}
	}
}
if($count == 'Posts' or $count == 'Sales')  {
	$galCount = get_option('td-galleryCount-'.$iC);
	if($galCount == '0') {
	} else	if($galCount != '') {
	if($rasterEffect != '') {
	if($rasterEffect != 'off') {
echo '<div class="rasterize" style="background: url(\''.get_template_directory_uri().'/images/'.$rasterEffect.'.png\');"></div>';
	}
}
		echo '<div id="supersized"></div>';
		$portBgGalSpeed = get_option('_td-bgGalSpeed-'.$iC);
		if($portBgGalSpeed != '') {
$portBgGalSpeed = $portBgGalSpeed * 2000;
} else {
$portBgGalSpeed = '4000';
}
$portBgGalEffect = get_option('_td-bgGalEffect-'.$iC);
if($portBgGalEffect != '') {
switch ($portBgGalEffect) {
case "Fade":
$portBgGalEffect = '1';
break;
case "Slide top":
$portBgGalEffect = '2';
break;
case "Slide right":
$portBgGalEffect = '3';
break;
case "Slide bottom":
$portBgGalEffect = '4';
break;
case "Slide left":
$portBgGalEffect = '5';
break;
case "Carousel right":
$portBgGalEffect = '6';
break;
case "Carousel left":
$portBgGalEffect = '7';
break;
}
} 
else {
$portBgGalEffect = '1';
}
?>
<script type="text/javascript">		
jQuery(document).ready(function () { jQuery.supersized({ slideshow : 1, autoplay : 1, start_slide : 1, slide_interval : <?php echo $portBgGalSpeed; ?>, transition : <?php echo $portBgGalEffect; ?>, transition_speed : 1500, new_window : 1, pause_hover : 0, keyboard_nav : 1, performance : 1, image_protect : 1, image_path : 'img/', min_width : 0, min_height : 0, vertical_center : 1, horizontal_center : 1, fit_portrait : 1, fit_landscape : 0, navigation : 1, thumbnail_navigation : 1, slide_counter : 1, slide_captions : 1, slides : [
<?php
$portGalLast = $galCount - 2;
for ($i = 0; $i <= $portGalLast; $i++) {
$n = $i+1;
$portBgGal = get_option('_tdCore-gallery'.$iC.'Img_'.$n.'');
?>{image : '<?php echo $portBgGal; ?>'},  
<?php } $portBgGalLast = get_option('_tdCore-gallery'.$iC.'Img_'.$galCount.''); ?>
{image : '<?php echo $portBgGalLast; ?>'}]}); });
</script>
<?php
	}
}
}
endif;
endforeach;
} } else if (is_front_page()) {
	if(!is_page()) { } else {
	$bgType = get_post_meta($post->ID, '_tdCore-bgType', true);
$bgImg = get_post_meta($post->ID, '_tdCore-bgImg', true);
$bgVid = get_post_meta($post->ID, '_tdCore-bgVid', true);
$bgColor = get_post_meta($post->ID, '_tdCore-bgColor', true);
switch($bgType) {
case 'gallery':
$PagegalleryCount = get_post_meta($post->ID, '_tdCore-galleryCount', true);
if($PagegalleryCount != '') {
	if($PagegalleryCount != '0') {
	echo '<div id="supersized"></div>';
	if($rasterEffect != '') {
	if($rasterEffect != 'off') {
echo '<div class="rasterize" style="background: url(\''.get_template_directory_uri().'/images/'.$rasterEffect.'.png\');"></div>';
	}
}
$PageBgGalSpeed = get_post_meta($post->ID, '_tdCore-bgGal-speed', true);
if($PageBgGalSpeed != '') {
$PageBgGalSpeed = $PageBgGalSpeed * 2000;
} else {
$PageBgGalSpeed = '4000';
}
$PageBgGalEffect = get_post_meta($post->ID, '_tdCore-bgGalEffect', true);
if($PageBgGalEffect != '') {
switch ($PageBgGalEffect) {
case "Fade":
$PageBgGalEffect = '1';
break;
case "Slide top":
$PageBgGalEffect = '2';
break;
case "Slide right":
$PageBgGalEffect = '3';
break;
case "Slide bottom":
$PageBgGalEffect = '4';
break;
case "Slide left":
$PageBgGalEffect = '5';
break;
case "Carousel right":
$PageBgGalEffect = '6';
break;
case "Carousel left":
$PageBgGalEffect = '7';
break;
}
} 
else {
$PageBgGalEffect = '1';
}
?>
<script type="text/javascript">		
jQuery(document).ready(function () { jQuery.supersized({ slideshow : 1, autoplay : 1, start_slide : 1, slide_interval : <?php echo $PageBgGalSpeed; ?>, transition : <?php echo $PageBgGalEffect; ?>, transition_speed : 1500, new_window : 1, pause_hover : 0, keyboard_nav : 1, performance : 1, image_protect : 1, image_path : 'img/', min_width : 0, min_height : 0, vertical_center : 1, horizontal_center : 1, fit_portrait : 1, fit_landscape : 0, navigation : 1, thumbnail_navigation : 1, slide_counter : 1, slide_captions : 1, slides : [
<?php
$PagegalLast = $PagegalleryCount - 2;
for ($i = 0; $i <= $PagegalLast; $i++) {
$n = $i+1;
$PagehomeBgGal = get_post_meta($post->ID, '_tdCore-galleryImg_'.$n.'', true);
?>{image : '<?php echo $PagehomeBgGal; ?>'},  
<?php } $PageBgGalLast = get_post_meta($post->ID, '_tdCore-galleryImg_'.$PagegalleryCount.'', true); ?>
{image : '<?php echo $PageBgGalLast; ?>'}]}); });
</script>
<?php
	}
}
break;
case 'color':
echo '<div id="bgholder" style="background-color:#'. $bgColor .'; display:block;"></div>';
break;
case 'video':
if($rasterEffect != '') {
	if($rasterEffect != 'off') {
echo '<div class="rasterize" style="background: url(\''.get_template_directory_uri().'/images/'.$rasterEffect.'.png\');"></div>';
	}
}
?>
<div id="bgholder" style="display:block;">
  <object classid="" codebase="" width="100%" height="100%" id="myfile" align="middle">
    <param name="allowScriptAccess" value="sameDomain" />
    <param name="movie" value="<?php echo get_template_directory_uri(); ?>/tdplayer.swf?moviefile=<?php echo $bgVid; ?>&autoplay=1" />
    <param name="quality" value="high" />
    <param name="scale" value="noscale" />
    <param name="bgcolor" value="#000" />
    <param name="wmode" value="transparent" />
    <embed src="<?php echo get_template_directory_uri(); ?>/tdplayer.swf?moviefile=<?php echo $bgVid; ?>&autoplay=1" wmode="transparent" quality="high" scale="noscale" bgcolor="#ffffff" width="100%" height="100%" name="myfile" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go
/getflashplayer" />
  </object>
</div>
<?php
break;
case 'url':
$bgUrl = get_post_meta($post->ID, '_tdCore-bgUrl', true);
$bgUrl = safeUrl($bgUrl);
?>
<div id="bgholder" style="display:block;">
  <object classid="" codebase="" width="100%" height="100%" id="myfile" align="middle">
    <iframe width="100%" height="100%" src="<?php echo $bgUrl; ?>" frameborder="0" allowfullscreen></iframe>
  </object>
</div>
<?php
break;
case 'map':
$bgMap = get_post_meta($post->ID, '_tdCore-bgMap', true);
?>
<input id="address" type="textbox" value="<?php echo $bgMap; ?>" style="display: none;">
<div id="bgholder" style="display:block;"> 
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
  <script type="text/javascript">
   var geocoder;
  var map;
  function initialize() {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(-34.397, 150.644);
    var myOptions = {
      zoom: 15,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
  }
  function codeAddress() {
    var address = document.getElementById("address").value;
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location
        });
      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
  }
jQuery(document).ready(function() {
	initialize();
	codeAddress();
});
</script>
  <div id="map_canvas" style="width:100%; height:100%"></div>
</div>
<?php
break;
}
	}
} else if(is_404()) {
if(trim($notFoundbgImg) != '') {
$notFoundbgImg = makePathAbsolute($notFoundbgImg);
echo '<div id="supersized"></div>';
	if($rasterEffect != '') {
	if($rasterEffect != 'off') {
echo '<div class="rasterize" style="background: url(\''.get_template_directory_uri().'/images/'.$rasterEffect.'.png\');"></div>';
	}
}
$PageBgGalSpeed = '4000';
$PageBgGalEffect = '1';
?>
<script type="text/javascript">		
jQuery(document).ready(function () { jQuery.supersized({ slideshow : 1, autoplay : 1, start_slide : 1, slide_interval : <?php echo $PageBgGalSpeed; ?>, transition : <?php echo $PageBgGalEffect; ?>, transition_speed : 1500, new_window : 1, pause_hover : 0, keyboard_nav : 1, performance : 1, image_protect : 1, image_path : 'img/', min_width : 0, min_height : 0, vertical_center : 1, horizontal_center : 1, fit_portrait : 1, fit_landscape : 0, navigation : 1, thumbnail_navigation : 1, slide_counter : 1, slide_captions : 1, slides : [
{image : '<?php echo $notFoundbgImg; ?>'}]}); });
</script>
<?php
}
} else if(!is_front_page()) { 
$bgType = get_post_meta($post->ID, '_tdCore-bgType', true);
$bgImg = get_post_meta($post->ID, '_tdCore-bgImg', true);
$bgVid = get_post_meta($post->ID, '_tdCore-bgVid', true);
$bgColor = get_post_meta($post->ID, '_tdCore-bgColor', true);
switch($bgType) {
case 'gallery':
$PagegalleryCount = get_post_meta($post->ID, '_tdCore-galleryCount', true);
if($PagegalleryCount != '') {
	if($PagegalleryCount != '0') {
	echo '<div id="supersized"></div>';
	if($rasterEffect != '') {
	if($rasterEffect != 'off') {
echo '<div class="rasterize" style="background: url(\''.get_template_directory_uri().'/images/'.$rasterEffect.'.png\');"></div>';
	}
}
$PageBgGalSpeed = get_post_meta($post->ID, '_tdCore-bgGal-speed', true);
if($PageBgGalSpeed != '') {
$PageBgGalSpeed = $PageBgGalSpeed * 2000;
} else {
$PageBgGalSpeed = '4000';
}
$PageBgGalEffect = get_post_meta($post->ID, '_tdCore-bgGalEffect', true);
if($PageBgGalEffect != '') {
switch ($PageBgGalEffect) {
case "Fade":
$PageBgGalEffect = '1';
break;
case "Slide top":
$PageBgGalEffect = '2';
break;
case "Slide right":
$PageBgGalEffect = '3';
break;
case "Slide bottom":
$PageBgGalEffect = '4';
break;
case "Slide left":
$PageBgGalEffect = '5';
break;
case "Carousel right":
$PageBgGalEffect = '6';
break;
case "Carousel left":
$PageBgGalEffect = '7';
break;
}
} 
else {
$PageBgGalEffect = '1';
}
?>
<script type="text/javascript">		
jQuery(document).ready(function () { jQuery.supersized({ slideshow : 1, autoplay : 1, start_slide : 1, slide_interval : <?php echo $PageBgGalSpeed; ?>, transition : <?php echo $PageBgGalEffect; ?>, transition_speed : 1500, new_window : 1, pause_hover : 0, keyboard_nav : 1, performance : 1, image_protect : 1, image_path : 'img/', min_width : 0, min_height : 0, vertical_center : 1, horizontal_center : 1, fit_portrait : 1, fit_landscape : 0, navigation : 1, thumbnail_navigation : 1, slide_counter : 1, slide_captions : 1, slides : [
<?php
$PagegalLast = $PagegalleryCount - 2;
for ($i = 0; $i <= $PagegalLast; $i++) {
$n = $i+1;
$PagehomeBgGal = get_post_meta($post->ID, '_tdCore-galleryImg_'.$n.'', true);
?>{image : '<?php echo $PagehomeBgGal; ?>'},  
<?php } $PageBgGalLast = get_post_meta($post->ID, '_tdCore-galleryImg_'.$PagegalleryCount.'', true); ?>
{image : '<?php echo $PageBgGalLast; ?>'}]}); });
</script>
<?php
	}
}
break;
case 'color':
echo '<div id="bgholder" style="background-color:#'. $bgColor .'; display:block;"></div>';
break;
case 'video':
if($rasterEffect != '') {
	if($rasterEffect != 'off') {
echo '<div class="rasterize" style="background: url(\''.get_template_directory_uri().'/images/'.$rasterEffect.'.png\');"></div>';
	}
}
?>
<div id="bgholder" style="display:block;">
  <object classid="" codebase="" width="100%" height="100%" id="myfile" align="middle">
    <param name="allowScriptAccess" value="sameDomain" />
    <param name="movie" value="<?php echo get_template_directory_uri(); ?>/tdplayer.swf?moviefile=<?php echo $bgVid; ?>&autoplay=1" />
    <param name="quality" value="high" />
    <param name="scale" value="noscale" />
    <param name="bgcolor" value="#000" />
    <param name="wmode" value="transparent" />
    <embed src="<?php echo get_template_directory_uri(); ?>/tdplayer.swf?moviefile=<?php echo $bgVid; ?>&autoplay=1" wmode="transparent" quality="high" scale="noscale" bgcolor="#ffffff" width="100%" height="100%" name="myfile" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go
/getflashplayer" />
  </object>
</div>
<?php
break;
case 'url':
$bgUrl = get_post_meta($post->ID, '_tdCore-bgUrl', true);
$bgUrl = safeUrl($bgUrl);
?>
<div id="bgholder" style="display:block;">
  <object classid="" codebase="" width="100%" height="100%" id="myfile" align="middle">
    <iframe width="100%" height="100%" src="<?php echo $bgUrl; ?>" frameborder="0" allowfullscreen></iframe>
  </object>
</div>
<?php
break;
case 'map':
$bgMap = get_post_meta($post->ID, '_tdCore-bgMap', true);
?>
<input id="address" type="textbox" value="<?php echo $bgMap; ?>" style="display: none;">
<div id="bgholder" style="display:block;"> 
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
  <script type="text/javascript">
   var geocoder;
  var map;
  function initialize() {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(-34.397, 150.644);
    var myOptions = {
      zoom: 15,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
  }
  function codeAddress() {
    var address = document.getElementById("address").value;
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location
        });
      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
  }
jQuery(document).ready(function() {
	initialize();
	codeAddress();
});
</script>
  <div id="map_canvas" style="width:100%; height:100%"></div>
</div>
<?php
break;
}
} 
if($analytics) { 
echo stripslashes_deep($analytics);
}
?>
<?php
wp_footer();
?>
</body></html>