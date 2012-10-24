<?php
/* Update option field */
function updateThemeOptionField($field) {
$current_data = get_option($field);
$new_data = $_POST[$field];

if($current_data !== false) {
if(trim($new_data) == '') {
delete_option($field);
} elseif($new_data != $current_data) {
update_option($field, $new_data);
}
}	elseif($new_data != '') {
add_option($field, $new_data);
}
}

/* If form was submitted */
if(isset($_POST['td-action'])) {

/* Check link for http */
if(isset($_POST['_tdCore-copyright-link'])) {
$_POST['_tdCore-copyright-link'] = checkLinkForHttp($_POST['_tdCore-copyright-link']);
}

/* Update options */
$optionFields = array('_tdCore-analytics', '_tdCore-favicon', '_tdCore-logo', '_tdCore-wplogo', '_tdCore-wplogoW', '_tdCore-wplogoH', '_tdCore-logo-align', '_tdCore-metaSwitch', '_tdCore-style', '_td-homeCat', '_tdCore-home-bgVid', '_td-home-bgGalEffect', '_td-home-bgGal-speed', 'td-galleryCount', '_tdCore-galleryImg_1', '_tdCore-galleryImg_2', '_tdCore-galleryImg_3', '_tdCore-galleryImg_4', '_tdCore-galleryImg_5', '_tdCore-galleryImg_6', '_tdCore-galleryImg_7', '_tdCore-galleryImg_8', '_tdCore-galleryImg_9', '_tdCore-galleryImg_10', '_tdCore-home-bgType', '_tdCore-home-bgColor', 'tdCore-blind1', 'tdCore-blind2', 'tdCore-blind3', 'tdCore-blind4', 'tdCore-blind5', '_tdCore-twitter', '_tdCore-flickr', '_tdCore-rss', '_tdCore-facebook', '_tdCore-linkedin', '_tdCore-youtube', '_tdCore-own1', '_tdCore-own1-logo', '_tdCore-own2', '_tdCore-own2-logo', '_tdCore-own3', '_tdCore-own3-logo', '_tdCore-own4', '_tdCore-own4-logo', '_tdCore-copyLink', '_tdCore-copyName', '_tdCore-blog-bgType', '_tdCore-blog-bgImg', '_tdCore-blog-bgColor', '_tdCore-search-bgType', '_tdCore-search-bgImg', '_tdCore-search-bgColor', '_tdCore-notfound-bgType', '_tdCore-notfound-bgImg', '_tdCore-archive-bgImg', '_tdCore-notfound-bgColor', '_td-hoverColor', '_tdCore-p-font', '_tdCore-h-font', '_tdCore-rasterEffect', '_tdCore-font-logo', '_tdCore-font-menu', '_tdCore-font-h1', '_tdCore-font-h2', '_tdCore-font-h3', '_tdCore-font-h4', '_tdCore-font-h5', '_tdCore-font-h6', '_tdCore-font-p', '_tdCore-font-copy');
$Count = $_POST['_tdCore-catCount'];
$counter == 1;
$portfolioArray = array();
while ( $counter < $Count ) {
$counter++;
$Pitem = "portfolioType".$counter;
$portGalS = "_td-bgGalSpeed-".$counter;
$portGalE = "_td-bgGalEffect-".$counter;
$portGalC = "td-galleryCount-".$counter;
$portGal1 = "_tdCore-gallery".$counter."Img_1";
$portGal2 = "_tdCore-gallery".$counter."Img_2";
$portGal3 = "_tdCore-gallery".$counter."Img_3";
$portGal4 = "_tdCore-gallery".$counter."Img_4";
$portGal5 = "_tdCore-gallery".$counter."Img_5";
$portGal6 = "_tdCore-gallery".$counter."Img_6";
$portGal7 = "_tdCore-gallery".$counter."Img_7";
$portGal8 = "_tdCore-gallery".$counter."Img_8";
$portGal9 = "_tdCore-gallery".$counter."Img_9";
$portGal10 = "_tdCore-gallery".$counter."Img_10";
$portfolioArray[] = $Pitem; 
$portfolioArray[] = $portGalS;
$portfolioArray[] = $portGalE;
$portfolioArray[] = $portGalC;
$portfolioArray[] = $portGal1;
$portfolioArray[] = $portGal2;
$portfolioArray[] = $portGal3;
$portfolioArray[] = $portGal4;
$portfolioArray[] = $portGal5;
$portfolioArray[] = $portGal6;
$portfolioArray[] = $portGal7;
$portfolioArray[] = $portGal8;
$portfolioArray[] = $portGal9;
$portfolioArray[] = $portGal10;
}
$optionFields = array_merge($optionFields, $portfolioArray);
foreach($optionFields AS $o) {
updateThemeOptionField($o);
}
}
/* Display theme options tdCore */
function ThemeOptions() {
?><link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/tdpanel.css" type="text/css" media="screen" />
<div class="wrap">
<h2>James</h2>
<form method="post" action="" id="tdCoreform">
<div class="td-panel">
<ul class="admin-menu">
<li><input type="button" value="GENERAL" onclick="showTab('tab-general');" class="tab tab-general" style="margin:0 4px 0 0; cursor:pointer;" /></li>
<li><input type="button" value="HOME" onclick="showTab('tab-home');" class="tab tab-home" style="margin:0 4px 0 0; cursor:pointer;" /></li>
<li><input type="button" value="SOCIABLES" onclick="showTab('tab-sociables');" class="tab tab-sociables" style="margin:0 4px 0 0; cursor:pointer;" /></li>
<li><input type="button" value="FOOTER" onclick="showTab('tab-footer');" class="tab tab-footer" style="margin:0 4px 0 0; cursor:pointer;" /></li>
<li><input type="button" value="BACKGROUNDS" onclick="showTab('tab-backgrounds');" class="tab tab-backgrounds" style="margin:0 4px 0 0; cursor:pointer;" /></li>
<li><input type="button" value="FONTS" onclick="showTab('tab-fonts');" class="tab tab-fonts" style="margin:0 4px 0 0; cursor:pointer;" /></li>
<li><input type="button" value="CATEGORY SETUP" onclick="showTab('tab-portfolio');" class="tab tab-portfolio" style="margin:0 4px 0 0; cursor:pointer;" /></li>
</ul>
<br style="clear: both;" />
<div cellpadding="0" cellspacing="5" style="margin:-8px 0 0 0;  margin: 5px 0 0; background: #fff; border: 1px solid #eee; display:none; padding:10px; width:800px;" id="tab-intro" class="tabs">
<strong style="margin:15px 0 0 0;">Welcome</strong>
<p valign="top" style="padding:3px 0 0 0;">James is an impressive Wordpress theme, designed to have your website up and running in no time. It is suitable for all kind of businesses and gives your visitors a lot of pleasure to look at. Have fun working with this original and very creative theme. James is very minimalistic and easy to work with, but has all great features you'll expect from an extended Wordpress theme.
<br /><br />
<strong style="margin:15px 0 0 0;">Support</strong><br />
<p valign="top" style="padding:3px 0 0 0;">If you need support for James please visit <a href="http://www.theme-dutch.com">www.theme-dutch.com.</a>
Please read at the Support-page how to get support from our support-team.
To follow our guidelines in Step 1/2/3 is the quickest way to get help.</p>
Have fun!
<br /><br />
Theme Dutch</p>
</div>
<?php
/* Get general options */
$favicon = get_option('_tdCore-favicon');
$cufonEnabled = get_option('_tdCore-cufonEnabled');
$hide = ($cufonEnabled != 'true') ? ' style="display:none;"' : '';
$cufonFont = get_option('_tdCore-cufonFont');
$payoffColor = get_option('_tdCore-payoffColor');
$analytics = get_option('_tdCore-analytics');
$logo = get_option('_tdCore-logo');
$wplogo = get_option('_tdCore-wplogo');
$wplogoW = get_option('_tdCore-wplogoW');
$wplogoH = get_option('_tdCore-wplogoH');
$logoAlign = get_option('_tdCore-logo-align');
$style = get_option('_tdCore-style');
$rasterEffect = get_option('_tdCore-rasterEffect');
$metaSwitch = get_option('_tdCore-metaSwitch');
?>
<div cellpadding="0" cellspacing="5" style="margin:-8px 0 0 0;  margin: 5px 0 0; background: #fff; border: 1px solid #eee; display:none; padding:10px; width:800px;" id="tab-general" class="tabs">
	<div>
	<strong style="margin:15px 0 0 0;">General</strong>
	</div>
  
	<div class="notEven">
	<p valign="top" style="padding:3px 0 0 0;">Favicon location:</p>
	<input type="text" id="_tdCore-favicon" name="_tdCore-favicon" value="<?php echo $favicon; ?>" style="width:350px;" /><input id="upload_favicon_button" type="button" value="Upload Image" />
	<br /><span style="color:#999; font-size:10px;">Upload your own favicon and give your site that little bit extra!</span>
	</div>
  
	<div class="even">
	<p valign="top" style="padding:3px 0 0 0;">Logo location:</p>
	<input type="text" id="_tdCore-logo" name="_tdCore-logo" value="<?php echo $logo; ?>" style="width:350px;" /><input id="upload_logo_button" type="button" value="Upload image" />
	<br /><span style="color:#999; font-size:10px;">Upload your logo here.</span>
	</div>
  
  <div class="notEven">
	<p valign="top" style="padding:3px 0 0 0;">White label logo:</p>
	<input type="text" id="_tdCore-wplogo" name="_tdCore-wplogo" value="<?php echo $wplogo; ?>" style="width:350px;" /><input id="upload_wplogo_button" type="button" value="Upload image" />
	<br /><span style="color:#999; font-size:10px;">This will change the original wordpress login logo with one of your own.</span>
  <p valign="top" style="padding:3px 0 0 0;">Logo width:</p>
	<input type="text" id="_tdCore-wplogoW" name="_tdCore-wplogoW" value="<?php echo $wplogoW; ?>" style="width:150px;" />
  <p valign="top" style="padding:3px 0 0 0;">Logo height:</p>
	<input type="text" id="_tdCore-wplogoH" name="_tdCore-wplogoH" value="<?php echo $wplogoH; ?>" style="width:150px;" />
	</div>
  
  <div class="even">
	<p valign="top" style="padding:3px 0 0 0;">Blog meta on/off:</p>
	<select id="tdCore-metaSwitch" name="_tdCore-metaSwitch">
    <option<?php if($metaSwitch == "on") { echo " selected"; } ?>>on</option>
    <option<?php if($metaSwitch == "off") { echo " selected"; } ?>>off</option>
  </select>
	<br /><span style="color:#999; font-size:10px;">Do you want to show the blog meta, or sparkle your images.</span>
	</div>
  
	<div class="notEven">
  <p valign="top" style="padding:3px 0 0 0;">Style:</p>
  <select id="tdCore-style" name="_tdCore-style">
  <option<?php if($style == "Black") { echo " selected"; } ?>>Black</option>
  <option<?php if($style == "White") { echo " selected"; } ?>>White</option>
  </select>
	<br /><span style="color:#999; font-size:10px;">Select the style you want for James.</span>
	</div>
  
  <div class="even">
  <p valign="top" style="padding:3px 0 0 0;">Image/Video grid effect:</p>
  <select id="tdCore-rasterEffect" name="_tdCore-rasterEffect">
  <option<?php
  if($rasterEffect == "none") { echo " selected"; }
  ?>>none</option>
  <option<?php
  if($rasterEffect == "vertical stripes") { echo " selected"; }
  ?>>vertical stripes</option>
  <option<?php
  if($rasterEffect == "circles") { echo " selected"; }
  ?>>circles</option>
  <option<?php
  if($rasterEffect == "squares") { echo " selected"; }
  ?>>squares</option>
  <option<?php
  if($rasterEffect == "small squares") { echo " selected"; }
  ?>>small squares</option>
  </select>
  <br /><span style="color:#999; font-size:10px;">Select the screen effect to your video here.</span>
  </div>
  
  <div class="notEven">
  <p valign="top" style="padding:3px 0 0 0;">Google Analytics:</p>
  <textarea id="tdCore-analytics" name="_tdCore-analytics" style="height:120px; width:505px;"><?php echo stripslashes_deep($analytics); ?></textarea><br />
  <span style="color:#999; font-size:10px;">Insert your google analytics code here.</span>
  </div>
  
  <div class="even">
  <p valign="top" style="padding:3px 0 0 0;">Dummy content:</p>
  <p><select id="tdCore-dummycontent" name="_tdCore-dummycontent">
  <option value="false">Don't place dummy content</option>
  <option value="true">Place dummy content</option>
  </select>
  <br />  
  <span style="color:#999; font-size:10px;">This option lets you see how James works.
  James loads automatically dummy content to your site.<br />
  Please use a new Wordpress  3.0+ installation.</span></p>
	<?php
  /* Import dummy content */
  if(isset($_POST['_tdCore-dummycontent']) && $_POST['_tdCore-dummycontent'] == 'true') {
  ?>
  <div>
  <p colspan="2"><?php
  require_once('importer/importer.php');
  ?></p>
  </div>
  <?php
  }
  ?>
  </div>
  
  <div>
  <br /><input type="submit" name="save" value="Save changes" style="cursor:pointer; margin:5px 0;" />
  </div>
</div>

<?php
$HomebgType = get_option('_tdCore-home-bgType');
$HomebgImg = get_option('_tdCore-home-bgImg');
$HomehideBgImg = ($HomebgType != 'gallery') ? ' style="display:none;"' : '';
$HomehideBgVid = ($HomebgType != 'video') ? ' style="display:none;"' : '';
$HomehideBgCat = ($HomebgType != 'bricks') ? ' style="display:none;"' : '';
$HomebgVid = get_option('_tdCore-home-bgVid');
$galleryCount = get_option('td-galleryCount');
$homeCat = get_option('_td-homeCat');
/* gallery 1 */
$galleryImg1 = get_option('_tdCore-galleryImg_1');
/* gallery 2 */
$galleryImg2 = get_option('_tdCore-galleryImg_2');
/* gallery 3 */
$galleryImg3 = get_option('_tdCore-galleryImg_3');
/* gallery 4 */
$galleryImg4 = get_option('_tdCore-galleryImg_4');
/* gallery 5 */
$galleryImg5 = get_option('_tdCore-galleryImg_5');
/* gallery 6 */
$galleryImg6 = get_option('_tdCore-galleryImg_6');
/* gallery 7 */
$galleryImg7 = get_option('_tdCore-galleryImg_7');
/* gallery 8 */
$galleryImg8 = get_option('_tdCore-galleryImg_8');
/* gallery 9 */
$galleryImg9 = get_option('_tdCore-galleryImg_9');
/* gallery 10 */
$galleryImg10 = get_option('_tdCore-galleryImg_10');
$homeBgGalSpeed = get_option('_td-home-bgGal-speed');
$homeBgGalEffect = get_option('_td-home-bgGalEffect');
?>
<div cellpadding="0" cellspacing="5" style="margin:-8px 0 0 0;  margin: 5px 0 0; background: #fff; border: 1px solid #eee; display:none; padding:10px; width:800px;" id="tab-home" class="tabs">
  <div>
  <strong style="margin:15px 0 0 0;">Home</strong>
  </div>
  
  <div class="notEven">
  <select id="tdCore-home-bgType" name="_tdCore-home-bgType" onChange="showBgImgField();">
    <option<?php if($HomebgType == "video") { echo ' selected'; } ?>>video</option>
    <option<?php if($HomebgType == "gallery") { echo ' selected'; } ?>>gallery</option>
    <option<?php if($HomebgType == "bricks") { echo ' selected'; } ?>>bricks</option>
  </select>
  <br /><span style="color:#999; font-size:10px;">What would you like? Some bricks, a gallery or video on your home..</span>
  </div>
  
  <div class="even">
    <div id="tdCore-bgVideo-td" width="33%" <?php echo $HomehideBgVid; ?>><p valign="top" style="padding:3px 0 0 0;">Background Video</p></div>
    <div id="tdCore-bgImg-td" width="33%" <?php echo $HomehideBgImg; ?>><p valign="top" style="padding:3px 0 0 0;">Background Gallery</p></div>
    
    <div id="tdCore-bgVideo-tr" <?php echo $HomehideBgVid; ?>>
		<input type="text" id="_tdCore-home-bgVid" name="_tdCore-home-bgVid" value="<?php echo $HomebgVid; ?>" />
		<br  /><span style="color:#999; font-size:10px;">Fill in the complete url to your video (only selfhosted for now!).</span>
		</div>

		<div id="tdCore-bgImg-tr" <?php echo $HomehideBgImg; ?>>
		<p valign="top" style="padding:3px 0 0 0;" id="bgImgTitle">Transition speed:</p>
		<p><input type="text" id="td-home-bgGal-speed" name="_td-home-bgGal-speed" value="<?php echo $homeBgGalSpeed; ?>" />
		<span style="color:#999; font-size:10px;" id="bgImgDesc">Enter the speed between slides (1-5).</span></p>
		<p valign="top" style="padding:3px 0 0 0;">Background gallery effect:</p>
    <p><select id="td-home-bgGalEffect" name="_td-home-bgGalEffect">
    <option<?php
    if($homeBgGalEffect == "Fade") { echo " selected"; }
    ?>>Fade</option>
    <option<?php
    if($homeBgGalEffect == "Slide top") { echo " selected"; }
    ?>>Slide top</option>
    <option<?php
    if($homeBgGalEffect == "Slide right") { echo " selected"; }
    ?>>Slide right</option>
    <option<?php
    if($homeBgGalEffect == "Slide bottom") { echo " selected"; }
    ?>>Slide bottom</option>
    <option<?php
    if($homeBgGalEffect == "Slide left") { echo " selected"; }
    ?>>Slide left</option>
    <option<?php
    if($homeBgGalEffect == "Carousel left") { echo " selected"; }
    ?>>Carousel left</option>
    <option<?php
    if($homeBgGalEffect == "Carousel right") { echo " selected"; }
    ?>>Carousel right</option>
    </select>
    <br />
    <span style="color:#999; font-size:10px;">Select wich effect you want to use.</span></p>
    <div class="galleryCount" style="display: none;"><input type="text" id="td-galleryCount" name="td-galleryCount" value="<?php echo $galleryCount; ?>" /></div>
    <div class="galleryContainer">
		<?php
    $count = $galleryCount;
    for ($i = 1; $i <= $count; $i++) {
    $n = $i;
    $galleryImg = get_option('_tdCore-galleryImg_'.$n.'');
    echo "<div>gallery image ".$n.": <input type=\"text\" id=\"_tdCore-galleryImg_".$n."\" name=\"_tdCore-galleryImg_".$n."\" value=\"".$galleryImg."\" /><input id=\"upload_galleryImg_".$n."_button\" type=\"button\" value=\"Upload Image\" /></div>";
    }
    ?>
    </div>
		<br style="clear: both" />
		<div class='addBgGal'><input type="button" onclick="" value="Add slide"></div>
		<div class='deleteImg'><input type="button" onclick="" value="Delete slide"></div>
		<br style="clear: both" />
		</div><!-- </tdCore-bgImg-tr> -->
    
    <div class="homepageCat" <?php echo $HomehideBgCat; ?>>
    <p valign="top" style="padding:3px 0 0 0;">Homepage category:</p>
    <?php
    $args = array(
    'show_option_none'   => 'All',
    'orderby'            => 'Name', 
    'order'              => 'ASC',
    'show_count'         => 1,
    'selected'					 => $homeCat,
    'echo'               => 1,
    'name'               => '_td-homeCat' );
    wp_dropdown_categories($args); 
    ?>
    <br /><span style="color:#999; font-size:10px;">Choose a category to display on the homepage.</span>
    </div>
	</div><!-- </even> -->
	<br />
	<div>
  <input type="submit" name="save" value="Save changes" style="cursor:pointer; margin:5px 0;" />
  </div>
</div>

<?php
/* Get sociables options */
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
?>
<div cellpadding="0" cellspacing="5" style="margin:-8px 0 0 0;  margin: 5px 0 0; background: #fff; border: 1px solid #eee; display:none; padding:10px; width:800px;" id="tab-sociables" class="tabs">
  <div>
  <strong style="margin:15px 0 0 0;">Sociables</strong>
  </div>

  <div class="notEven"><p valign="top" style="padding:3px 0 0 0;">Twitter: <input type="text" id="_tdCore-twitter" name="_tdCore-twitter" value="<?php echo $twitter; ?>" style="width:350px;" /></p></div>
  <div class="even"><p valign="top" style="padding:3px 0 0 0;">Flickr: <input type="text" id="_tdCore-flickr" name="_tdCore-flickr" value="<?php echo $flickr; ?>" style="width:350px;" /></p></div>
  <div class="notEven"><p valign="top" style="padding:3px 0 0 0;">Rss: <input type="text" id="_tdCore-rss" name="_tdCore-rss" value="<?php echo $rss; ?>" style="width:350px;" /></p></div>
  <div class="even"><p valign="top" style="padding:3px 0 0 0;">Facebook: <input type="text" id="_tdCore-facebook" name="_tdCore-facebook" value="<?php echo $facebook; ?>" style="width:350px;" /></p></div>
  <div class="notEven"><p valign="top" style="padding:3px 0 0 0;">LinkedIn: <input type="text" id="_tdCore-linkedin" name="_tdCore-linkedin" value="<?php echo $linkedin; ?>" style="width:350px;" /></p></div>
  <div class="even"><p valign="top" style="padding:3px 0 0 0;">Youtube: <input type="text" id="_tdCore-youtube" name="_tdCore-youtube" value="<?php echo $youtube; ?>" style="width:350px;" /></p></div>
  <div class="notEven"><p valign="top" style="padding:3px 0 0 0;">Sociable #1: <input type="text" id="_tdCore-own1" name="_tdCore-own1" value="<?php echo $own1; ?>" style="width:250px;" /><input type="text" id="_tdCore-own1-logo" name="_tdCore-own1-logo" value="<?php echo $own1Logo; ?>" style="width:250px;" /><input id="upload_own1_logo_button" type="button" value="Upload logo image" /></p></div>
  <div class="even"><p valign="top" style="padding:3px 0 0 0;">Sociable #2: <input type="text" id="_tdCore-own2" name="_tdCore-own2" value="<?php echo $own2; ?>" style="width:250px;" /><input type="text" id="_tdCore-own2-logo" name="_tdCore-own2-logo" value="<?php echo $own2Logo; ?>" style="width:250px;" /><input id="upload_own2_logo_button" type="button" value="Upload logo image" /></p></div>
  <div class="notEven"><p valign="top" style="padding:3px 0 0 0;">Sociable #3: <input type="text" id="_tdCore-own3" name="_tdCore-own3" value="<?php echo $own3; ?>" style="width:250px;" /><input type="text" id="_tdCore-own3-logo" name="_tdCore-own3-logo" value="<?php echo $own3Logo; ?>" style="width:250px;" /><input id="upload_own3_logo_button" type="button" value="Upload logo image" /></p></div>
  <div class="even"><p valign="top" style="padding:3px 0 0 0;">Sociable #4: <input type="text" id="_tdCore-own4" name="_tdCore-own4" value="<?php echo $own4; ?>" style="width:250px;" /><input type="text" id="_tdCore-own4-logo" name="_tdCore-own4-logo" value="<?php echo $own4Logo; ?>" style="width:250px;" /><input id="upload_own4_logo_button" type="button" value="Upload logo image" /></p>
	<span style="color:#999; font-size:10px;">For the own sociables you will need to fill in the complete link to your social platform! (images advice: 20 x 20 px).</span></div>

  <div>
  <br /><input type="submit" name="save" value="Save changes" style="cursor:pointer; margin:5px 0;" />
  </div>
</div>

<?php
/* Get footer options */
$copyName = get_option('_tdCore-copyName');
$copyLink = get_option('_tdCore-copyLink');
?>
<div cellpadding="0" cellspacing="5" style="margin:-8px 0 0 0;  margin: 5px 0 0; background: #fff; border: 1px solid #eee; display:none; padding:10px; width:800px;" id="tab-footer" class="tabs">
  <div>
  <strong style="margin:15px 0 0 0;">Footer</strong>
  </div>
  
  <div class="notEven">
  <p valign="top" style="padding:3px 0 0 0;">Copyright name:</p>
  <input type="text" id="_tdCore-copyName" name="_tdCore-copyName" value="<?php echo $copyName; ?>" style="width:350px;" />
  <br /><span style="color:#999; font-size:10px;">Please fill in your name and it will show in the copyright area.</span>
  </div>
  
  <div class="even">
  <p valign="top" style="padding:3px 0 0 0;">Copyright link:</p>
  <input type="text" id="_tdCore-copyLink" name="_tdCore-copyLink" value="<?php echo $copyLink; ?>" style="width:350px;" />
  <br /><span style="color:#999; font-size:10px;">Please use a full link for example: http://www.theme-dutch.com.</span>
  </div>
  
  <div>
  <br /><input type="submit" name="save" value="Save changes" style="cursor:pointer; margin:5px 0;" />
  </div>
</div>

<?php
/* Search page */
$SearchbgImg = get_option('_tdCore-search-bgImg');
/* 404 page */
$notFoundbgImg = get_option('_tdCore-notfound-bgImg');
/* Archive pages */
$archivebgImg = get_option('_tdCore-archive-bgImg');
?>
<div cellpadding="0" cellspacing="5" style="margin:-8px 0 0 0;  margin: 5px 0 0; background: #fff; border: 1px solid #eee; display:none; padding:10px; width:800px;" id="tab-backgrounds" class="tabs">
  <div>
  <strong style="margin:15px 0 0 0;">Backgrounds</strong>
  </div>

  <div class="notEven">
  <p valign="top" style="padding:3px 0 0 0;">Search page</p>
  <p valign="top" style="padding:3px 0 0 0;">Background image</p>
  <input type="text" id="_tdCore-search-bgImg" name="_tdCore-search-bgImg" value="<?php echo $SearchbgImg; ?>" /><input id="upload_search_img_button" type="button" value="Upload image" />
  <br /><span style="color:#999; font-size:10px;">Upload your own background image.</span>
  </div>
  
  <div class="even">
  <p valign="top" style="padding:3px 0 0 0;">404 page</p>
  <p valign="top" style="padding:3px 0 0 0;">Background image</p>
  <input type="text" id="_tdCore-notfound-bgImg" name="_tdCore-notfound-bgImg" value="<?php echo $notFoundbgImg; ?>" /><input id="upload_notfound_img_button" type="button" value="Upload image" />
  <br /><span style="color:#999; font-size:10px;">Upload your own background image.</span>
  </div>
  
  <div class="notEven">
  <p valign="top" style="padding:3px 0 0 0;">Archive pages</p>
  <p valign="top" style="padding:3px 0 0 0;">Background image</p>
  <input type="text" id="_tdCore-archive-bgImg" name="_tdCore-archive-bgImg" value="<?php echo $archivebgImg; ?>" /><input id="upload_archive_img_button" type="button" value="Upload image" />
  <br /><span style="color:#999; font-size:10px;">Upload your own background image.</span>
  </div>
  
  <div>
  <br /><input type="submit" name="save" value="Save changes" style="cursor:pointer; margin:5px 0;" />
  </div>
</div>

<?php
/* Get font options */
$pFont = get_option('_tdCore-p-font');
$hFont = get_option('_tdCore-h-font');
$fontLogo = get_option('_tdCore-font-logo');
$fontMenu = get_option('_tdCore-font-menu');
$fontH1 = get_option('_tdCore-font-h1');
$fontH2 = get_option('_tdCore-font-h2');
$fontH3 = get_option('_tdCore-font-h3');
$fontH4 = get_option('_tdCore-font-h4');
$fontH5 = get_option('_tdCore-font-h5');
$fontH6 = get_option('_tdCore-font-h6');
$fontP = get_option('_tdCore-font-p');
$fontCopy = get_option('_tdCore-font-copy');
$hoverColor = get_option('_td-hoverColor');
?>
<div cellpadding="0" cellspacing="5" style="margin:-8px 0 0 0;  margin: 5px 0 0; background: #fff; border: 1px solid #eee; display:none; padding:10px; width:800px;" id="tab-fonts" class="tabs">
  <div>
    <strong style="margin:15px 0 0 0;">Fonts</strong>
  </div>
  
  <div class="notEven">
    <div style="float: left; width: 30%;">
      <p valign="top" style="padding:3px 0 0 0;">Pharagraph font:</p>
      <select id="_tdCore-p-font" name="_tdCore-p-font" onChange="changeFont();">
         <optgroup label="Standard fonts"> 
          <option<?php if($pFont == "Calibri") { echo ' selected'; } ?>>Calibri</option>
          <option<?php if($pFont == "Arial") { echo ' selected'; } ?>>Arial</option>
          <option<?php if($pFont == "Verdana") { echo ' selected'; } ?>>Verdana</option>
          <option<?php if($pFont == "Trebuchet MS") { echo ' selected'; } ?>>Trebuchet MS</option>
          <option<?php if($pFont == "Times New Roman") { echo ' selected'; } ?>>Times New Roman</option>
          <option<?php if($pFont == "Lucida Sans Unicode") { echo ' selected'; } ?>>Lucida Sans Unicode</option>
        </optgroup>
        <optgroup label="Google fonts"> 
          <option<?php if($pFont == "News Cycle") { echo ' selected'; } ?>>News Cycle</option>
          <option<?php if($pFont == "Cabin Sketch") { echo ' selected'; } ?>>Cabin Sketch</option>
          <option<?php if($pFont == "Aclonica") { echo ' selected'; } ?>>Aclonica</option>
          <option<?php if($pFont == "Quattrocento Sans") { echo ' selected'; } ?>>Quattrocento Sans</option>
          <option<?php if($pFont == "Terminal Dosis Light") { echo ' selected'; } ?>>Terminal Dosis Light</option>
          <option<?php if($pFont == "Anonymous Pro") { echo ' selected'; } ?>>Anonymous Pro</option>
          <option<?php if($pFont == "Crimson Text") { echo ' selected'; } ?>>Crimson Text</option>
          <option<?php if($pFont == "Lekton") { echo ' selected'; } ?>>Lekton</option>
          <option<?php if($pFont == "Oswald") { echo ' selected'; } ?>>Oswald</option>
          <option<?php if($pFont == "Michroma") { echo ' selected'; } ?>>Michroma</option>
          <option<?php if($pFont == "Cuprum") { echo ' selected'; } ?>>Cuprum</option>
          <option<?php if($pFont == "Cabin") { echo ' selected'; } ?>>Cabin</option>
          <option<?php if($pFont == "Anton") { echo ' selected'; } ?>>Anton</option>
          <option<?php if($pFont == "Orbitron") { echo ' selected'; } ?>>Orbitron</option>
        </optgroup>
      </select>
      <br />
      <p valign="top" style="padding:3px 0 0 0;">Heading font: </p>
      <select id="_tdCore-h-font" name="_tdCore-h-font" onChange="changeFont();">
        <optgroup label="Standard fonts"> 
          <option<?php if($hFont == "Calibri") { echo ' selected'; } ?>>Calibri</option>
          <option<?php if($hFont == "Arial") { echo ' selected'; } ?>>Arial</option>
          <option<?php if($hFont == "Verdana") { echo ' selected'; } ?>>Verdana</option>
          <option<?php if($hFont == "Trebuchet MS") { echo ' selected'; } ?>>Trebuchet MS</option>
          <option<?php if($hFont == "Times New Roman") { echo ' selected'; } ?>>Times New Roman</option>
          <option<?php if($hFont == "Lucida Sans Unicode") { echo ' selected'; } ?>>Lucida Sans Unicode</option>
        </optgroup>
        <optgroup label="Google fonts"> 
          <option<?php if($hFont == "News Cycle") { echo ' selected'; } ?>>News Cycle</option>
          <option<?php if($hFont == "Cabin Sketch") { echo ' selected'; } ?>>Cabin Sketch</option>
          <option<?php if($hFont == "Aclonica") { echo ' selected'; } ?>>Aclonica</option>
          <option<?php if($hFont == "Quattrocento Sans") { echo ' selected'; } ?>>Quattrocento Sans</option>
          <option<?php if($hFont == "Terminal Dosis Light") { echo ' selected'; } ?>>Terminal Dosis Light</option>
          <option<?php if($hFont == "Anonymous Pro") { echo ' selected'; } ?>>Anonymous Pro</option>
          <option<?php if($hFont == "Crimson Text") { echo ' selected'; } ?>>Crimson Text</option>
          <option<?php if($hFont == "Lekton") { echo ' selected'; } ?>>Lekton</option>
          <option<?php if($hFont == "Oswald") { echo ' selected'; } ?>>Oswald</option>
          <option<?php if($hFont == "Michroma") { echo ' selected'; } ?>>Michroma</option>
          <option<?php if($hFont == "Cuprum") { echo ' selected'; } ?>>Cuprum</option>
          <option<?php if($hFont == "Cabin") { echo ' selected'; } ?>>Cabin</option>
          <option<?php if($hFont == "Josefin Slab") { echo ' selected'; } ?>>Josefin Slab</option>
          <option<?php if($hFont == "Anton") { echo ' selected'; } ?>>Anton</option>
          <option<?php if($hFont == "Yanone Kaffeesatz") { echo ' selected'; } ?>>Yanone Kaffeesatz</option>
          <option<?php if($hFont == "Gruppo") { echo ' selected'; } ?>>Gruppo</option>
          <option<?php if($hFont == "Orbitron") { echo ' selected'; } ?>>Orbitron</option>
          <option<?php if($hFont == "Pacifico") { echo ' selected'; } ?>>Pacifico</option>
          <option<?php if($hFont == "Crushed") { echo ' selected'; } ?>>Crushed</option>
        </optgroup>
      </select>
    </div><!-- </div float: left width 30%> -->
    <div style="float: left; width: 70%;">
      <div id="imagePreview"><h1>Lorem ipsum dolor sit amet.</h1> <p>consectetur adipiscing elit. Integer nec ante augue, id luctus dolor. Morbi massa ligula, pretium et eleifend congue, suscipit at elit. Quisque in nulla nulla. In hac habitasse platea dictumst. Vivamus placerat consequat lectus, sit amet porta nisl fringilla nec. Vivamus nisl nisl, rhoncus sed imperdiet nec, vestibulum sed nisl. Sed sed neque ut dui imperdiet imperdiet eget at orci. Donec non luctus mi. Maecenas sagittis magna massa. Duis enim arcu, varius ut porta et, facilisis et sapien. Fusce non facilisis nibh. Curabitur orci nisi, commodo et tincidunt ac, commodo at turpis. </p></div>
    </div>
    <br style="clear: both" />
  </div><!-- </notEven> -->
  
  <div>
    <br /><strong style="margin:15px 0 0 0;">Font sizes:</strong>
  </div>
  
  <div class="even">
    <div class="clearFixStyle"></div>
    <p class="styleSwitchP" style="font-family: calibri; font-size: 12px; color: black;">Logo font size:</p>
      <div class="pixelCount">
        <select id="_tdCore-font-logo" name="_tdCore-font-logo">
          <option <?php if($fontLogo == "9px") { echo ' selected'; } ?>>9px</option>
          <option <?php if($fontLogo == "10px") { echo ' selected'; } ?>>10px</option>
          <option <?php if($fontLogo == "11px") { echo ' selected'; } ?>>11px</option>
          <option <?php if($fontLogo == "12px") { echo ' selected'; } ?>>12px</option>
          <option <?php if($fontLogo == "13px") { echo ' selected'; } ?>>13px</option>
          <option <?php if($fontLogo == "14px") { echo ' selected'; } ?>>14px</option>
          <option <?php if($fontLogo == "15px") { echo ' selected'; } ?>>15px</option>
        </select>
      </div>
    <div class="clearFixStyle"></div>
    <p class="styleSwitchP" style="font-family: calibri; font-size: 12px; color: black;">Menu font size:</p>
      <div class="pixelCount">
        <select id="_tdCore-font-menu" name="_tdCore-font-menu">
          <option <?php if($fontMenu == "9px") { echo ' selected'; } ?>>9px</option>
          <option <?php if($fontMenu == "10px") { echo ' selected'; } ?>>10px</option>
          <option <?php if($fontMenu == "11px") { echo ' selected'; } ?>>11px</option>
          <option <?php if($fontMenu == "12px") { echo ' selected'; } ?>>12px</option>
          <option <?php if($fontMenu == "13px") { echo ' selected'; } ?>>13px</option>
          <option <?php if($fontMenu == "14px") { echo ' selected'; } ?>>14px</option>
          <option <?php if($fontMenu == "15px") { echo ' selected'; } ?>>15px</option>
        </select>
      </div>
    <div class="clearFixStyle"></div>
    <p class="styleSwitchP" style="font-family: calibri; font-size: 12px; color: black;">H1 font size:</p>
      <div class="pixelCount">
        <select id="_tdCore-font-h1" name="_tdCore-font-h1">
          <option <?php if($fontH1 == "16px") { echo ' selected'; } ?>>16px</option>
          <option <?php if($fontH1 == "18px") { echo ' selected'; } ?>>18px</option>
          <option <?php if($fontH1 == "20px") { echo ' selected'; } ?>>20px</option>
          <option <?php if($fontH1 == "22px") { echo ' selected'; } ?>>22px</option>
          <option <?php if($fontH1 == "24px") { echo ' selected'; } ?>>24px</option>
          <option <?php if($fontH1 == "26px") { echo ' selected'; } ?>>26px</option>
          <option <?php if($fontH1 == "28px") { echo ' selected'; } ?>>28px</option>
          <option <?php if($fontH1 == "30px") { echo ' selected'; } ?>>30px</option>
          <option <?php if($fontH1 == "32px") { echo ' selected'; } ?>>32px</option>
          <option <?php if($fontH1 == "34px") { echo ' selected'; } ?>>34px</option>
          <option <?php if($fontH1 == "36px") { echo ' selected'; } ?>>36px</option>
        </select>
      </div>
    <div class="clearFixStyle"></div>
    <p class="styleSwitchP" style="font-family: calibri; font-size: 12px; color: black;">H2 font size:</p>
      <div class="pixelCount">
        <select id="_tdCore-font-h2" name="_tdCore-font-h2" onChange="changeFontSize();">
          <option <?php if($fontH2 == "16px") { echo ' selected'; } ?>>16px</option>
          <option <?php if($fontH2 == "18px") { echo ' selected'; } ?>>18px</option>
          <option <?php if($fontH2 == "20px") { echo ' selected'; } ?>>20px</option>
          <option <?php if($fontH2 == "22px") { echo ' selected'; } ?>>22px</option>
          <option <?php if($fontH2 == "24px") { echo ' selected'; } ?>>24px</option>
          <option <?php if($fontH2 == "26px") { echo ' selected'; } ?>>26px</option>
          <option <?php if($fontH2 == "28px") { echo ' selected'; } ?>>28px</option>
          <option <?php if($fontH2 == "30px") { echo ' selected'; } ?>>30px</option>
          <option <?php if($fontH2 == "32px") { echo ' selected'; } ?>>32px</option>
          <option <?php if($fontH2 == "34px") { echo ' selected'; } ?>>34px</option>
          <option <?php if($fontH2 == "36px") { echo ' selected'; } ?>>36px</option>
        </select>
      </div>
    <div class="clearFixStyle"></div>
    <p class="styleSwitchP" style="font-family: calibri; font-size: 12px; color: black;">H3 font size:</p>
      <div class="pixelCount">
        <select id="_tdCore-font-h3" name="_tdCore-font-h3" onChange="changeFontSize();">
          <option <?php if($fontH3 == "16px") { echo ' selected'; } ?>>16px</option>
          <option <?php if($fontH3 == "18px") { echo ' selected'; } ?>>18px</option>
          <option <?php if($fontH3 == "20px") { echo ' selected'; } ?>>20px</option>
          <option <?php if($fontH3 == "22px") { echo ' selected'; } ?>>22px</option>
          <option <?php if($fontH3 == "24px") { echo ' selected'; } ?>>24px</option>
          <option <?php if($fontH3 == "26px") { echo ' selected'; } ?>>26px</option>
          <option <?php if($fontH3 == "28px") { echo ' selected'; } ?>>28px</option>
          <option <?php if($fontH3 == "30px") { echo ' selected'; } ?>>30px</option>
          <option <?php if($fontH3 == "32px") { echo ' selected'; } ?>>32px</option>
          <option <?php if($fontH3 == "34px") { echo ' selected'; } ?>>34px</option>
          <option <?php if($fontH3 == "36px") { echo ' selected'; } ?>>36px</option>
        </select>
      </div>
    <div class="clearFixStyle"></div>
    <p class="styleSwitchP" style="font-family: calibri; font-size: 12px; color: black;">H4 font size:</p>
      <div class="pixelCount">
        <select id="_tdCore-font-h4" name="_tdCore-font-h4" onChange="changeFontSize();">
          <option <?php if($fontH4 == "16px") { echo ' selected'; } ?>>16px</option>
          <option <?php if($fontH4 == "18px") { echo ' selected'; } ?>>18px</option>
          <option <?php if($fontH4 == "20px") { echo ' selected'; } ?>>20px</option>
          <option <?php if($fontH4 == "22px") { echo ' selected'; } ?>>22px</option>
          <option <?php if($fontH4 == "24px") { echo ' selected'; } ?>>24px</option>
          <option <?php if($fontH4 == "26px") { echo ' selected'; } ?>>26px</option>
          <option <?php if($fontH4 == "28px") { echo ' selected'; } ?>>28px</option>
          <option <?php if($fontH4 == "30px") { echo ' selected'; } ?>>30px</option>
          <option <?php if($fontH4 == "32px") { echo ' selected'; } ?>>32px</option>
          <option <?php if($fontH4 == "34px") { echo ' selected'; } ?>>34px</option>
          <option <?php if($fontH4 == "36px") { echo ' selected'; } ?>>36px</option>
        </select>
      </div>
    <div class="clearFixStyle"></div>
    <p class="styleSwitchP" style="font-family: calibri; font-size: 12px; color: black;">H5 font size:</p>
      <div class="pixelCount">
        <select id="_tdCore-font-h5" name="_tdCore-font-h5" onChange="changeFontSize();">
          <option <?php if($fontH5 == "16px") { echo ' selected'; } ?>>16px</option>
          <option <?php if($fontH5 == "18px") { echo ' selected'; } ?>>18px</option>
          <option <?php if($fontH5 == "20px") { echo ' selected'; } ?>>20px</option>
          <option <?php if($fontH5 == "22px") { echo ' selected'; } ?>>22px</option>
          <option <?php if($fontH5 == "24px") { echo ' selected'; } ?>>24px</option>
          <option <?php if($fontH5 == "26px") { echo ' selected'; } ?>>26px</option>
          <option <?php if($fontH5 == "28px") { echo ' selected'; } ?>>28px</option>
          <option <?php if($fontH5 == "30px") { echo ' selected'; } ?>>30px</option>
          <option <?php if($fontH5 == "32px") { echo ' selected'; } ?>>32px</option>
          <option <?php if($fontH5 == "34px") { echo ' selected'; } ?>>34px</option>
          <option <?php if($fontH5 == "36px") { echo ' selected'; } ?>>36px</option>
        </select>
      </div>
    <div class="clearFixStyle"></div>
    <p class="styleSwitchP" style="font-family: calibri; font-size: 12px; color: black;">H6 font size:</p>
      <div class="pixelCount">
        <select id="_tdCore-font-h6" name="_tdCore-font-h6" onChange="changeFontSize();">
          <option <?php if($fontH6 == "16px") { echo ' selected'; } ?>>16px</option>
          <option <?php if($fontH6 == "18px") { echo ' selected'; } ?>>18px</option>
          <option <?php if($fontH6 == "20px") { echo ' selected'; } ?>>20px</option>
          <option <?php if($fontH6 == "22px") { echo ' selected'; } ?>>22px</option>
          <option <?php if($fontH6 == "24px") { echo ' selected'; } ?>>24px</option>
          <option <?php if($fontH6 == "26px") { echo ' selected'; } ?>>26px</option>
          <option <?php if($fontH6 == "28px") { echo ' selected'; } ?>>28px</option>
          <option <?php if($fontH6 == "30px") { echo ' selected'; } ?>>30px</option>
          <option <?php if($fontH6 == "32px") { echo ' selected'; } ?>>32px</option>
          <option <?php if($fontH6 == "34px") { echo ' selected'; } ?>>34px</option>
          <option <?php if($fontH6 == "36px") { echo ' selected'; } ?>>36px</option>
        </select>
      </div>
    <div class="clearFixStyle"></div>
    <p class="styleSwitchP" style="font-family: calibri; font-size: 12px; color: black;">P font size:</p>
      <div class="pixelCount">
        <select id="_tdCore-font-p" name="_tdCore-font-p" onChange="changeFontSize();">
          <option <?php if($fontP == "9px") { echo ' selected'; } ?>>9px</option>
          <option <?php if($fontP == "10px") { echo ' selected'; } ?>>10px</option>
          <option <?php if($fontP == "11px") { echo ' selected'; } ?>>11px</option>
          <option <?php if($fontP == "12px") { echo ' selected'; } ?>>12px</option>
          <option <?php if($fontP == "13px") { echo ' selected'; } ?>>13px</option>
          <option <?php if($fontP == "14px") { echo ' selected'; } ?>>14px</option>
          <option <?php if($fontP == "15px") { echo ' selected'; } ?>>15px</option>
        </select>
      </div>
    <div class="clearFixStyle"></div>
    <p class="styleSwitchP" style="font-family: calibri; font-size: 12px; color: black;">Copyright size:</p>
      <div class="pixelCount">
        <select id="_tdCore-font-copy" name="_tdCore-font-copy" onChange="changeFontSize();">
          <option <?php if($fontCopy == "9px") { echo ' selected'; } ?>>9px</option>
          <option <?php if($fontCopy == "10px") { echo ' selected'; } ?>>10px</option>
          <option <?php if($fontCopy == "11px") { echo ' selected'; } ?>>11px</option>
          <option <?php if($fontCopy == "12px") { echo ' selected'; } ?>>12px</option>
          <option <?php if($fontCopy == "13px") { echo ' selected'; } ?>>13px</option>
          <option <?php if($fontCopy == "14px") { echo ' selected'; } ?>>14px</option>
          <option <?php if($fontCopy == "15px") { echo ' selected'; } ?>>15px</option>
        </select>
      </div>
    <div class="clearFixStyle"></div>
  </div><!-- </even> -->
  
  <div>
    <br /><strong style="margin:15px 0 0 0;">Font color:</strong>
  </div>
  
  <div class="notEven">
  	<p valign="top" style="padding:3px 0 0 0;" id="bgImgTitle">Link hover color:</p>
  	<input type="text" id="_td-hoverColor" name="_td-hoverColor" value="<?php echo $hoverColor; ?>" />
  	<br />
  	<span style="color:#999; font-size:10px;" id="bgImgDesc">Would you like a hover color?</span>
  </div><!--</notEven> -->
  	
  <div>
    <br /><input type="submit" name="save" value="Save changes" style="cursor:pointer; margin:5px 0;" />
  </div>
</div>

<?php
/* Get portfolio options */
?>
<div cellpadding="0" cellspacing="5" style="margin:-8px 0 0 0;  margin: 5px 0 0; background: #fff; border: 1px solid #eee; display:none; padding:10px; width:800px;" id="tab-portfolio" class="tabs">
  <div>
  <strong style="margin:15px 0 0 0;">Category setup</strong>
  </div>
	<?php
  $args=array('orderby' => 'name','order' => 'ASC');
  $categories=get_categories($args);
  $list = "";
  foreach($categories as $cat):
  $iC++;
  if (is_int($iC/2)) {
  $eO = 'even';
  } else {
  $eO = 'notEven';
  }
  if($cat->name != ''):
  $title = $cat->name;
  $count = get_option('portfolioType'.$iC);
  $list = $title." 
  <select id='".$cat->cat_ID."' class='portfolioSwitch".$iC."' name='portfolioType".$iC."' onChange='switchPortfolioField(".$iC.");'>
  <option " . ( ($count == "Bricks") ? "selected"   : "") . ">Bricks</option>
  <option " . ( ($count == "Gallery") ? "selected"   : "") . ">Gallery</option>
  <option " . ( ($count == "Posts") ? "selected"   : "") . ">Posts</option>
	<option value='Sales' " . ( ($count == "Sales") ? "selected"   : "") . ">Product</option>
  </select><br />";
  echo "<div class=".$eO.">";
  echo $list;
  if($count == 'Posts' or $count == 'Sales') {
  $postDisplay = 'style="display: block;"';
  } else {
  $postDisplay = 'style="display: none;"';
  }
	$PortBgGalEffect = get_option('_td-bgGalEffect-'.$iC);
	$BgGalSpeed = get_option('_td-bgGalSpeed-'.$iC);
	$galleryCount = get_option('td-galleryCount-'.$iC);
	?>
  <div id="posts-background<?php echo $iC; ?>" <?php echo $postDisplay; ?>>
  <p valign="top" style="padding:3px 0 0 0;"><?php echo $title; ?> background gallery effect:</p>
  <select id="td-bgGalEffect-<?php echo $iC ?>" name="_td-bgGalEffect-<?php echo $iC ?>">
    <option<?php if($PortBgGalEffect == "Fade") { echo " selected"; } ?>>Fade</option>
    <option<?php if($PortBgGalEffect == "Slide top") { echo " selected"; } ?>>Slide top</option>
    <option<?php if($PortBgGalEffect == "Slide right") { echo " selected"; } ?>>Slide right</option>
    <option<?php if($PortBgGalEffect == "Slide bottom") { echo " selected"; } ?>>Slide bottom</option>
    <option<?php if($PortBgGalEffect == "Slide left") { echo " selected"; } ?>>Slide left</option>
    <option<?php if($PortBgGalEffect == "Carousel left") { echo " selected"; } ?>>Carousel left</option>
    <option<?php if($PortBgGalEffect == "Carousel right") { echo " selected"; } ?>>Carousel right</option>
  </select>
  <br />
  <p valign="top" style="padding:3px 0 0 0;" id="bgImgTitle">Transition speed:</p>
  <input type="text" id="td-bgGalSpeed-<?php echo $iC ?>" name="_td-bgGalSpeed-<?php echo $iC ?>" value="<?php echo $BgGalSpeed; ?>" />
  <br />
  <span style="color:#999; font-size:10px;" id="bgImgDesc">Enter the speed between slides (1-5).</span>
  <span style="color:#999; font-size:10px;">Select wich effect you want to use.</span>
  <div class="galleryCount-<?php echo $iC ?>" style="display: none;"><input type="text" id="td-galleryCount-<?php echo $iC ?>" name="td-galleryCount-<?php echo $iC ?>" value="<?php echo $galleryCount; ?>" /></div>
  <div class="galleryContainer-<?php echo $iC ?>">
  <?php
  $count = $galleryCount;
  for ($i = 1; $i <= $count; $i++) {
  $n = $i;
  $galleryImg = get_option('_tdCore-gallery'.$iC.'Img_'.$n.'');
  echo "<div>gallery image ".$n.": <input type=\"text\" id=\"_tdCore-gallery".$iC."Img_".$n."\" name=\"_tdCore-gallery".$iC."Img_".$n."\" value=\"".$galleryImg."\" /><input id=\"upload_gallery".$iC."Img_".$n."_button\" type=\"button\" value=\"Upload Image\" /></div>";
  }
  ?>
  </div>
  <br style="clear: both" />
  <div class='addBgGal-<?php echo $iC ?>'><input type="button" onclick="" value="Add slide"></div>
  <div class='deleteImg-<?php echo $iC ?>'><input type="button" onclick="" value="Delete slide"></div>
  <br style="clear: both" />
  </div>
</div>
<?php
endif;
endforeach;
?>
<br />
<input type="hidden" id="_tdCore-catCount" name="_tdCore-catCount" value="<?php echo $iC; ?>" />
<div>
<input type="submit" name="save" value="Save changes" style="cursor:pointer; margin:5px 0;" />
</div>
</div>
<input type="hidden" name="td-action" value="save" />
</form>
</div>
<?php
wp_deregister_script('jquery');
wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"), false, '1.5');
wp_enqueue_script('jquery');
?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/js/cp/css/colorpicker.css" />
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/cp/js/colorpicker.js"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
var counter = '';
<?php 
$Count = $iC;
$counter == 1;
while ( $counter < $Count ) {
$counter++;
?>
counter == <?php echo $counter; ?>;
fields = jQuery(".galleryContainer-<?php echo $counter; ?> > div").size();
jQuery(".galleryCount-<?php echo $counter; ?> > input").val(fields);
jQuery('.addBgGal-<?php echo $counter; ?>').click(function() {
fields = 1+jQuery(".galleryContainer-<?php echo $counter; ?> > div").size();
if(fields == 11) {
alert('You reached the maximum amount of fields for background gallery.');
exit();
} else {
if(fields == 1) {
jQuery('.galleryContainer-<?php echo $counter; ?>').append('<div>gallery image: '+fields+' <input type="text" id="_tdCore-gallery<?php echo $counter; ?>Img_1" name="_tdCore-gallery<?php echo $counter; ?>Img_1" value="<?php echo $galleryImg1; ?>" /><input id="upload_gallery<?php echo $counter; ?>Img_1_button" type="button" value="Upload Image" /></div>');
}
if(fields == 2) {
jQuery('.galleryContainer-<?php echo $counter; ?>').append('<div>gallery image: '+fields+' <input type="text" id="_tdCore-gallery<?php echo $counter; ?>Img_2" name="_tdCore-gallery<?php echo $counter; ?>Img_2" value="<?php echo $galleryImg2; ?>" /><input id="upload_gallery<?php echo $counter; ?>Img_2_button" type="button" value="Upload Image" /></div>');
}
if(fields == 3) {
jQuery('.galleryContainer-<?php echo $counter; ?>').append('<div>gallery image: '+fields+' <input type="text" id="_tdCore-gallery<?php echo $counter; ?>Img_3" name="_tdCore-gallery<?php echo $counter; ?>Img_3" value="<?php echo $galleryImg3; ?>" /><input id="upload_gallery<?php echo $counter; ?>Img_3_button" type="button" value="Upload Image" /></div>');
}
if(fields == 4) {
jQuery('.galleryContainer-<?php echo $counter; ?>').append('<div>gallery image: '+fields+' <input type="text" id="_tdCore-gallery<?php echo $counter; ?>Img_4" name="_tdCore-gallery<?php echo $counter; ?>Img_4" value="<?php echo $galleryImg4; ?>" /><input id="upload_gallery<?php echo $counter; ?>Img_4_button" type="button" value="Upload Image" /></div>');
}
if(fields == 5) {
jQuery('.galleryContainer-<?php echo $counter; ?>').append('<div>gallery image: '+fields+' <input type="text" id="_tdCore-gallery<?php echo $counter; ?>Img_5" name="_tdCore-gallery<?php echo $counter; ?>Img_5" value="<?php echo $galleryImg5; ?>" /><input id="upload_gallery<?php echo $counter; ?>Img_5_button" type="button" value="Upload Image" /></div>');
}
if(fields == 6) {
jQuery('.galleryContainer-<?php echo $counter; ?>').append('<div>gallery image: '+fields+' <input type="text" id="_tdCore-gallery<?php echo $counter; ?>Img_6" name="_tdCore-gallery<?php echo $counter; ?>Img_6" value="<?php echo $galleryImg6; ?>" /><input id="upload_gallery<?php echo $counter; ?>Img_6_button" type="button" value="Upload Image" /></div>');
}
if(fields == 7) {
jQuery('.galleryContainer-<?php echo $counter; ?>').append('<div>gallery image: '+fields+' <input type="text" id="_tdCore-gallery<?php echo $counter; ?>Img_7" name="_tdCore-gallery<?php echo $counter; ?>Img_7" value="<?php echo $galleryImg7; ?>" /><input id="upload_gallery<?php echo $counter; ?>Img_7_button" type="button" value="Upload Image" /></div>');
}
if(fields == 8) {
jQuery('.galleryContainer-<?php echo $counter; ?>').append('<div>gallery image: '+fields+' <input type="text" id="_tdCore-gallery<?php echo $counter; ?>Img_8" name="_tdCore-gallery<?php echo $counter; ?>Img_8" value="<?php echo $galleryImg8; ?>" /><input id="upload_gallery<?php echo $counter; ?>Img_8_button" type="button" value="Upload Image" /></div>');
}
if(fields == 9) {
jQuery('.galleryContainer-<?php echo $counter; ?>').append('<div>gallery image: '+fields+' <input type="text" id="_tdCore-gallery<?php echo $counter; ?>Img_9" name="_tdCore-gallery<?php echo $counter; ?>Img_9" value="<?php echo $galleryImg9; ?>" /><input id="upload_gallery<?php echo $counter; ?>Img_9_button" type="button" value="Upload Image" /></div>');
}
if(fields == 10) {
jQuery('.galleryContainer-<?php echo $counter; ?>').append('<div>gallery image: '+fields+' <input type="text" id="_tdCore-gallery<?php echo $counter; ?>Img_10" name="_tdCore-gallery<?php echo $counter; ?>Img_10" value="<?php echo $galleryImg10; ?>" /><input id="upload_gallery<?php echo $counter; ?>Img_10_button" type="button" value="Upload Image" /></div>');
}
jQuery(".galleryCount-<?php echo $counter; ?> > input").val(fields);
}
});

jQuery('.deleteImg-<?php echo $counter; ?>').click(function() {
fields = jQuery(".galleryContainer-<?php echo $counter; ?> > div").size();
ffield = fields - 3;
chris = fields -4;
rfield = fields - 1;
vfield = fields - 1;
if(vfield == -1) {
alert('there are no more fields to delete');
vfield = 0;
exit();
}
jQuery(".galleryCount-<?php echo $counter; ?> > input").val(vfield);
jQuery(".galleryContainer-<?php echo $counter; ?> > div:last").remove();
fields = fields -1 ;
});
var formfield;
jQuery('#upload_gallery<?php echo $counter; ?>Img_1_button').live('click', function() {
formfield = jQuery('#_tdCore-gallery<?php echo $counter; ?>Img_1').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_gallery<?php echo $counter; ?>Img_2_button').live('click', function() {
formfield = jQuery('#_tdCore-gallery<?php echo $counter; ?>Img_2').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_gallery<?php echo $counter; ?>Img_3_button').live('click', function() {
formfield = jQuery('#_tdCore-gallery<?php echo $counter; ?>Img_3').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_gallery<?php echo $counter; ?>Img_4_button').live('click', function() {
formfield = jQuery('#_tdCore-gallery<?php echo $counter; ?>Img_4').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_gallery<?php echo $counter; ?>Img_5_button').live('click', function() {
formfield = jQuery('#_tdCore-gallery<?php echo $counter; ?>Img_5').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_gallery<?php echo $counter; ?>Img_6_button').live('click', function() {
formfield = jQuery('#_tdCore-gallery<?php echo $counter; ?>Img_6').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_gallery<?php echo $counter; ?>Img_7_button').live('click', function() {
formfield = jQuery('#_tdCore-gallery<?php echo $counter; ?>Img_7').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_gallery<?php echo $counter; ?>Img_8_button').live('click', function() {
formfield = jQuery('#_tdCore-gallery<?php echo $counter; ?>Img_8').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_gallery<?php echo $counter; ?>Img_9_button').live('click', function() {
formfield = jQuery('#_tdCore-gallery<?php echo $counter; ?>Img_9').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_gallery<?php echo $counter; ?>Img_10_button').live('click', function() {
formfield = jQuery('#_tdCore-gallery<?php echo $counter; ?>Img_10').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
<?php
} 
?>
changeFont();
fields = jQuery(".galleryContainer > div").size();
jQuery('.addBgGal').click(function() {
fields = 1+jQuery(".galleryContainer > div").size();
if(fields == 11) {
alert('You reached the maximum amount of fields for background gallery.');
exit();
} else {
if(fields == 1) {
jQuery('.galleryContainer').append('<div>gallery image: '+fields+' <input type="text" id="_tdCore-galleryImg_1" name="_tdCore-galleryImg_1" value="<?php echo $galleryImg1; ?>" /><input id="upload_galleryImg_1_button" type="button" value="Upload Image" /></div>');
}
if(fields == 2) {
jQuery('.galleryContainer').append('<div>gallery image: '+fields+' <input type="text" id="_tdCore-galleryImg_2" name="_tdCore-galleryImg_2" value="<?php echo $galleryImg2; ?>" /><input id="upload_galleryImg_2_button" type="button" value="Upload Image" /></div>');
}
if(fields == 3) {
jQuery('.galleryContainer').append('<div>gallery image: '+fields+' <input type="text" id="_tdCore-galleryImg_3" name="_tdCore-galleryImg_3" value="<?php echo $galleryImg3; ?>" /><input id="upload_galleryImg_3_button" type="button" value="Upload Image" /></div>');
}
if(fields == 4) {
jQuery('.galleryContainer').append('<div>gallery image: '+fields+' <input type="text" id="_tdCore-galleryImg_4" name="_tdCore-galleryImg_4" value="<?php echo $galleryImg4; ?>" /><input id="upload_galleryImg_4_button" type="button" value="Upload Image" /></div>');
}
if(fields == 5) {
jQuery('.galleryContainer').append('<div>gallery image: '+fields+' <input type="text" id="_tdCore-galleryImg_5" name="_tdCore-galleryImg_5" value="<?php echo $galleryImg5; ?>" /><input id="upload_galleryImg_5_button" type="button" value="Upload Image" /></div>');
}
if(fields == 6) {
jQuery('.galleryContainer').append('<div>gallery image: '+fields+' <input type="text" id="_tdCore-galleryImg_6" name="_tdCore-galleryImg_6" value="<?php echo $galleryImg6; ?>" /><input id="upload_galleryImg_6_button" type="button" value="Upload Image" /></div>');
}
if(fields == 7) {
jQuery('.galleryContainer').append('<div>gallery image: '+fields+' <input type="text" id="_tdCore-galleryImg_7" name="_tdCore-galleryImg_7" value="<?php echo $galleryImg7; ?>" /><input id="upload_galleryImg_7_button" type="button" value="Upload Image" /></div>');
}
if(fields == 8) {
jQuery('.galleryContainer').append('<div>gallery image: '+fields+' <input type="text" id="_tdCore-galleryImg_8" name="_tdCore-galleryImg_8" value="<?php echo $galleryImg8; ?>" /><input id="upload_galleryImg_8_button" type="button" value="Upload Image" /></div>');
}
if(fields == 9) {
jQuery('.galleryContainer').append('<div>gallery image: '+fields+' <input type="text" id="_tdCore-galleryImg_9" name="_tdCore-galleryImg_9" value="<?php echo $galleryImg9; ?>" /><input id="upload_galleryImg_9_button" type="button" value="Upload Image" /></div>');
}
if(fields == 10) {
jQuery('.galleryContainer').append('<div>gallery image: '+fields+' <input type="text" id="_tdCore-galleryImg_10" name="_tdCore-galleryImg_10" value="<?php echo $galleryImg10; ?>" /><input id="upload_galleryImg_10_button" type="button" value="Upload Image" /></div>');
}
jQuery(".galleryCount > input").val(fields);
}
});

jQuery('.deleteImg').click(function() {
ffield = fields - 3;
chris = fields -4;
rfield = fields - 1;
vfield = fields - 1;
if(vfield == -1) {
alert('there are no more fields to delete');
vfield = 0;
exit();
}
jQuery(".galleryCount > input").val(vfield);
jQuery(".galleryContainer > div:eq("+rfield+")").remove();
fields = fields -1 ;
});
var formfield;
jQuery('#upload_galleryImg_1_button').live('click', function() {
formfield = jQuery('#_tdCore-galleryImg_1').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_galleryImg_2_button').live('click', function() {
formfield = jQuery('#_tdCore-galleryImg_2').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_galleryImg_3_button').live('click', function() {
formfield = jQuery('#_tdCore-galleryImg_3').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_galleryImg_4_button').live('click', function() {
formfield = jQuery('#_tdCore-galleryImg_4').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_galleryImg_5_button').live('click', function() {
formfield = jQuery('#_tdCore-galleryImg_5').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_galleryImg_6_button').live('click', function() {
formfield = jQuery('#_tdCore-galleryImg_6').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_galleryImg_7_button').live('click', function() {
formfield = jQuery('#_tdCore-galleryImg_7').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_galleryImg_8_button').live('click', function() {
formfield = jQuery('#_tdCore-galleryImg_8').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_galleryImg_9_button').live('click', function() {
formfield = jQuery('#_tdCore-galleryImg_9').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_galleryImg_10_button').live('click', function() {
formfield = jQuery('#_tdCore-galleryImg_10').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_favicon_button').live('click', function() {
formfield = jQuery('#_tdCore-favicon').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_pageIcon_button').live('click', function() {
formfield = jQuery('#_tdCore-pageIcon').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_logo_button').live('click', function() {
formfield = jQuery('#_tdCore-logo').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_own1_logo_button').live('click', function() {
formfield = jQuery('#_tdCore-own1-logo').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_own2_logo_button').live('click', function() {
formfield = jQuery('#_tdCore-own2-logo').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_own3_logo_button').live('click', function() {
formfield = jQuery('#_tdCore-own3-logo').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_own4_logo_button').live('click', function() {
formfield = jQuery('#_tdCore-own4-logo').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_blog_img_button').live('click', function() {
formfield = jQuery('#_tdCore-blog-bgImg').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_search_img_button').live('click', function() {
formfield = jQuery('#_tdCore-search-bgImg').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_notfound_img_button').live('click', function() {
formfield = jQuery('#_tdCore-notfound-bgImg').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_archive_img_button').live('click', function() {
formfield = jQuery('#_tdCore-archive-bgImg').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_wplogo_button').live('click', function() {
formfield = jQuery('#_tdCore-wplogo').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
window.original_send_to_editor = window.send_to_editor;
window.send_to_editor = function(html){
if (formfield) {
imgurl = jQuery('img',html).attr('src');
jQuery('#' + formfield).val(imgurl);
tb_remove();
formfield = '';
return false;
} else {
window.original_send_to_editor(html);
return false;
}
};
jQuery('#_td-hoverColor').ColorPicker({
onSubmit:function(hsb, hex, rgb, el) {
jQuery(el).val(hex);
jQuery(el).ColorPickerHide();
},
onBeforeShow:function() {
jQuery(this).ColorPickerSetColor(this.value);
}
});
jQuery('#_tdCore-blog-bgColor').ColorPicker({
onSubmit:function(hsb, hex, rgb, el) {
jQuery(el).val(hex);
jQuery(el).ColorPickerHide();
},
onBeforeShow:function() {
jQuery(this).ColorPickerSetColor(this.value);
}
});
jQuery('#_tdCore-search-bgColor').ColorPicker({
onSubmit:function(hsb, hex, rgb, el) {
jQuery(el).val(hex);
jQuery(el).ColorPickerHide();
},
onBeforeShow:function() {
jQuery(this).ColorPickerSetColor(this.value);
}
});
jQuery('#_tdCore-notfound-bgColor').ColorPicker({
onSubmit:function(hsb, hex, rgb, el) {
jQuery(el).val(hex);
jQuery(el).ColorPickerHide();
},
onBeforeShow:function() {
jQuery(this).ColorPickerSetColor(this.value);
}
});
var hash = window.location.hash.replace("#", "");
if(jQuery("#tab-" + hash).length > 0) {
jQuery("#tab-" + hash).fadeIn();
} else {
jQuery("#tab-intro").fadeIn();
}
});

function showTab(id) {
jQuery("#tdCoreform").attr("action", "#" + id.replace("tab-", ""));
jQuery(".tabs").stop(true, true).fadeOut(200);
jQuery("#" + id).delay(300).fadeIn();
jQuery('.tab').removeClass('active');
jQuery('li').removeClass('liActive');
jQuery('.'+id).stop().fadeOut().addClass('active').fadeIn();
jQuery('.'+id).parent().addClass('liActive');
}
function changeFont() {
var Pfont = jQuery("#_tdCore-p-font").val();
var Hfont = jQuery("#_tdCore-h-font").val();
WebFontConfig = { google: { families: [ Pfont , Hfont ] } }; 
(function() { 
var wf = document.createElement('script'); 
wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js'; 
wf.type = 'text/javascript'; 
wf.async = 'true'; 
var s = document.getElementsByTagName('script')[0]; 
s.parentNode.insertBefore(wf, s); 
})();
jQuery("#imagePreview p").css('font-family', Pfont);
jQuery("#imagePreview h1").css('font-family', Hfont);
}
function showBgImgField() {
if(jQuery("#tdCore-home-bgType").val() == "gallery") {
jQuery("#tdCore-bgVideo-td").fadeOut(200);
jQuery("#tdCore-bgVideo-tr").fadeOut(200);
jQuery("#tdCore-bgImg-tr").fadeIn();
jQuery("#tdCore-bgImg-td").fadeIn();
jQuery(".homepageCat").fadeOut(200);
} else if(jQuery("#tdCore-home-bgType").val() == "video") {
jQuery("#tdCore-bgVideo-td").fadeIn();
jQuery("#tdCore-bgVideo-tr").fadeIn();
jQuery("#tdCore-bgImg-td").fadeOut(200);
jQuery("#tdCore-bgImg-tr").fadeOut(200);
jQuery(".homepageCat").fadeOut(200);
} else {
jQuery("#tdCore-bgImg-td").fadeOut(200);
jQuery("#tdCore-bgImg-tr").fadeOut(200);
jQuery("#tdCore-bgVideo-td").fadeOut(200);
jQuery("#tdCore-bgVideo-tr").fadeOut(200);
jQuery(".homepageCat").fadeIn();
}
}
function showBlogBgImgField() {
if(jQuery("#tdCore-blog-bgType").val() == "image") {
jQuery("#tdCore-BlogbgColor-td").fadeOut(100);
jQuery("#tdCore-BlogbgColor-tr").fadeOut(100);
jQuery("#tdCore-BlogbgImg-tr").fadeIn();
jQuery("#tdCore-BlogbgImg-td").fadeIn();
} else {
jQuery("#tdCore-BlogbgColor-td").fadeIn();
jQuery("#tdCore-BlogbgColor-tr").fadeIn();
jQuery("#tdCore-BlogbgImg-td").fadeOut(100);
jQuery("#tdCore-BlogbgImg-tr").fadeOut(100);
}
}
function switchPortfolioField(v) {
if(jQuery('.portfolioSwitch'+v).val() == 'Posts') {
jQuery("#posts-background"+v).fadeIn();
} else if(jQuery('.portfolioSwitch'+v).val() == 'Sales') {
	jQuery('#posts-background'+v).fadeIn();
} else {
jQuery("#posts-background"+v).fadeOut(100);
}
}
</script>
<?php
}
/* Add tinyMCE for homepage WYSIWYG editing */
if(isset($_GET['page'])) {
	if($_GET['page'] == 'theme_options.php') {
		add_filter('admin_head','showTinyMCE');
	}
}
function showTinyMCE() {
wp_enqueue_script('common');
wp_enqueue_script('jquery-color');
wp_print_scripts('editor');
if(function_exists('add_thickbox')) { add_thickbox(); }
wp_print_scripts('media-upload');
if(function_exists('wp_tiny_mce')) { wp_tiny_mce(); }
wp_admin_css();
wp_enqueue_script('utils');
do_action('admin_print_styles-post-php');
do_action('admin_print_styles');
remove_all_filters('mce_external_plugins');
}
/* Add theme options page */
add_action('admin_menu', 'teamDutchAddThemeOptions');
function teamDutchAddThemeOptions() {
add_theme_page('James theme options', '<span style="color:#e57300;">James</span>', 'edit_themes', 'theme_options.php', 'ThemeOptions', get_template_directory_uri() . '/images/td-icon.png');
}
?>