<?php
/* This variable prevents jQuery from being loaded a second time */
$jQueryLoaded = true;

/* Update option field */
function updateOptionField($post_id, $field) {
  $current_data = get_post_meta($post_id, $field, true);
	$new_data = $_POST[$field];
	
  if($current_data !== false) {
    if($new_data == '') {
    	delete_post_meta($post_id, $field);
    } elseif ($new_data != $current_data) {
    	update_post_meta($post_id, $field, $new_data);
    }
  }	elseif($new_data != '') {
  	add_post_meta($post_id, $field, $new_data, true);
  }
}

/* Update option fields */
function tdCoreUpdateOptions($post_id) {
  $optionFields = array('_tdCore-bgType', '_tdCore-showContent', '_tdCore-bgImg', '_tdCore-bgColor', '_tdCore-bgMap', '_tdCore-bgUrl', '_tdCore-bgVid', '_tdCore-slideHeight', 'td-slideCount', '_tdCore-slideImg_1', '_tdCore-slideLink_1', '_tdCore-slideText_1' , '_tdCore-slideImg_2', '_tdCore-slideLink_2', '_tdCore-slideText_2' , '_tdCore-slideImg_3', '_tdCore-slideLink_3', '_tdCore-slideText_3' , '_tdCore-slideImg_4', '_tdCore-slideLink_4', '_tdCore-slideText_4' , '_tdCore-slideImg_5', '_tdCore-slideLink_5', '_tdCore-slideText_5' , '_tdCore-slideImg_6', '_tdCore-slideLink_6', '_tdCore-slideText_6' , '_tdCore-slideImg_7', '_tdCore-slideLink_7', '_tdCore-slideText_7' , '_tdCore-slideImg_8', '_tdCore-slideLink_8', '_tdCore-slideText_8' , '_tdCore-slideImg_9', '_tdCore-slideLink_9', '_tdCore-slideText_9' , '_tdCore-slideImg_10', '_tdCore-slideLink_10', '_tdCore-slideText_10', '_tdCore-showContact', '_tdCore-contact-title', '_tdCore-contact-emailto', '_tdCore-contact-showGender', '_tdCore-contact-showName', '_tdCore-contact-nameRequired', '_tdCore-contact-showAddress', '_tdCore-contact-addressRequired', '_tdCore-contact-showPostalcode', '_tdCore-contact-postalcodeRequired', '_tdCore-contact-showCity', '_tdCore-contact-cityRequired', '_tdCore-contact-showCountry', '_tdCore-contact-countryRequired', '_tdCore-contact-showTelephone', '_tdCore-contact-telephoneRequired', '_tdCore-contact-showEmail', '_tdCore-contact-emailRequired', '_tdCore-contact-showMessage', '_tdCore-contact-messageRequired', '_tdCore-contact-captcha', '_tdCore-galleryCount', '_tdCore-galleryImg_1', '_tdCore-galleryImg_2', '_tdCore-galleryImg_3', '_tdCore-galleryImg_4', '_tdCore-galleryImg_5', '_tdCore-galleryImg_6', '_tdCore-galleryImg_7', '_tdCore-galleryImg_8', '_tdCore-galleryImg_9', '_tdCore-galleryImg_10', '_tdCore-bgGal-speed', '_tdCore-bgGalEffect', '_tdCore-brickFormat', '_tdCore-brickVideo', '_tdCore-salePrice', '_tdCore-saleThumb1', '_tdCore-saleThumb2', '_tdCore-saleThumb3', '_tdCore-saleThumb4', '_tdCore-saleDisplay'
);
  foreach($optionFields AS $m) {
    updateOptionField($post_id, $m);
	}
}
/* Display Sensitive options */
function placeSensitivePostOptions() {
  global $post;
  /* General options */
  $bgType = get_post_meta($post->ID, '_tdCore-bgType', true);
	$bgVid = get_post_meta($post->ID, '_tdCore-bgVid', true);
  $bgImg = get_post_meta($post->ID, '_tdCore-bgImg', true);
	$bgUrl = get_post_meta($post->ID, '_tdCore-bgUrl', true);
	$bgMap = get_post_meta($post->ID, '_tdCore-bgMap', true);
	$hideBgImg = ($bgType != 'gallery') ? ' style="display:none;"' : '';
	$hideBgColor = ($bgType != 'color') ? ' style="display:none;"' : '';
	$hideBgVid = ($bgType != 'video') ? ' style="display:none;"' : '';
	$hideBgUrl = ($bgType != 'url') ? ' style="display:none;"' : '';
	$hideBgMap = ($bgType != 'map') ? ' style="display:none;"' : '';
	$bgColor = get_post_meta($post->ID, '_tdCore-bgColor', true);
	$slideHeight = get_post_meta($post->ID, '_tdCore-slideHeight', true);
	$slideCount = get_post_meta($post->ID, 'td-slideCount', true);
	/* slide 1 */
	$slideImg1 = get_post_meta($post->ID, '_tdCore-slideImg_1', true);
	$slideLink1 = get_post_meta($post->ID, '_tdCore-slideLink_1', true);
	$slideText1 = get_post_meta($post->ID, '_tdCore-slideText_1', true);
	/* slide 2 */
	$slideImg2 = get_post_meta($post->ID, '_tdCore-slideImg_2', true);
	$slideLink2 = get_post_meta($post->ID, '_tdCore-slideLink_2', true);
	$slideText2 = get_post_meta($post->ID, '_tdCore-slideText_2', true);
	/* slide 3 */
	$slideImg3 = get_post_meta($post->ID, '_tdCore-slideImg_3', true);
	$slideLink3 = get_post_meta($post->ID, '_tdCore-slideLink_3', true);
	$slideText3 = get_post_meta($post->ID, '_tdCore-slideText_3', true);
	/* slide 4 */
	$slideImg4 = get_post_meta($post->ID, '_tdCore-slideImg_4', true);
	$slideLink4 = get_post_meta($post->ID, '_tdCore-slideLink_4', true);
	$slideText4 = get_post_meta($post->ID, '_tdCore-slideText_4', true);
	/* slide 5 */
	$slideImg5 = get_post_meta($post->ID, '_tdCore-slideImg_5', true);
	$slideLink5 = get_post_meta($post->ID, '_tdCore-slideLink_5', true);
	$slideText5 = get_post_meta($post->ID, '_tdCore-slideText_5', true);
	/* slide 6 */
	$slideImg6 = get_post_meta($post->ID, '_tdCore-slideImg_6', true);
	$slideLink6 = get_post_meta($post->ID, '_tdCore-slideLink_6', true);
	$slideText6 = get_post_meta($post->ID, '_tdCore-slideText_6', true);
	/* slide 7 */
	$slideImg7 = get_post_meta($post->ID, '_tdCore-slideImg_7', true);
	$slideLink7 = get_post_meta($post->ID, '_tdCore-slideLink_7', true);
	$slideText7 = get_post_meta($post->ID, '_tdCore-slideText_7', true);
	/* slide 8 */
	$slideImg8 = get_post_meta($post->ID, '_tdCore-slideImg_8', true);
	$slideLink8 = get_post_meta($post->ID, '_tdCore-slideLink_8', true);
	$slideText8 = get_post_meta($post->ID, '_tdCore-slideText_8', true);
	/* slide 9 */
	$slideImg9 = get_post_meta($post->ID, '_tdCore-slideImg_9', true);
	$slideLink9 = get_post_meta($post->ID, '_tdCore-slideLink_9', true);
	$slideText9 = get_post_meta($post->ID, '_tdCore-slideText_9', true);
	/* slide 10 */
	$slideImg10 = get_post_meta($post->ID, '_tdCore-slideImg_10', true);
	$slideLink10 = get_post_meta($post->ID, '_tdCore-slideLink_10', true);
	$slideText10 = get_post_meta($post->ID, '_tdCore-slideText_10', true);
	/* Contact options */
  $showContact = get_post_meta($post->ID, '_tdCore-showContact', true);
  $hideContact = ($showContact != 'true') ? ' display:none;' : '';
  $contactTitle = get_post_meta($post->ID, '_tdCore-contact-title', true);
  $emailTo = get_post_meta($post->ID, '_tdCore-contact-emailto', true);
  $showGender = get_post_meta($post->ID, '_tdCore-contact-showGender', true);
  $showName = get_post_meta($post->ID, '_tdCore-contact-showName', true);
  $contactNameRequired = get_post_meta($post->ID, '_tdCore-contact-nameRequired', true);
  $showAddress = get_post_meta($post->ID, '_tdCore-contact-showAddress', true);
  $contactAddressRequired = get_post_meta($post->ID, '_tdCore-contact-addressRequired', true);
  $showPostalcode = get_post_meta($post->ID, '_tdCore-contact-showPostalcode', true);
  $contactPostalcodeRequired = get_post_meta($post->ID, '_tdCore-contact-postalcodeRequired', true);
  $showCity = get_post_meta($post->ID, '_tdCore-contact-showCity', true);
  $contactCityRequired = get_post_meta($post->ID, '_tdCore-contact-cityRequired', true);
  $showCountry = get_post_meta($post->ID, '_tdCore-contact-showCountry', true);
  $contactCountryRequired = get_post_meta($post->ID, '_tdCore-contact-countryRequired', true);
  $showTelephone = get_post_meta($post->ID, '_tdCore-contact-showTelephone', true);
  $contactTelephoneRequired = get_post_meta($post->ID, '_tdCore-contact-telephoneRequired', true);
  $showEmail = get_post_meta($post->ID, '_tdCore-contact-showEmail', true);
  $contactEmailRequired = get_post_meta($post->ID, '_tdCore-contact-emailRequired', true);
  $showMessage = get_post_meta($post->ID, '_tdCore-contact-showMessage', true);
  $contactMessageRequired = get_post_meta($post->ID, '_tdCore-contact-messageRequired', true);
  $contactCaptcha = get_post_meta($post->ID, '_tdCore-contact-captcha', true);
	$galleryCount = get_post_meta($post->ID, '_tdCore-galleryCount', true);
	/* gallery 1 */
	$galleryImg1 = get_post_meta($post->ID, '_tdCore-galleryImg_1', true);
	/* gallery 2 */
	$galleryImg2 = get_post_meta($post->ID, '_tdCore-galleryImg_2', true);
	/* gallery 3 */
	$galleryImg3 = get_post_meta($post->ID, '_tdCore-galleryImg_3', true);
	/* gallery 4 */
	$galleryImg4 = get_post_meta($post->ID, '_tdCore-galleryImg_4', true);
	/* gallery 5 */
	$galleryImg5 = get_post_meta($post->ID, '_tdCore-galleryImg_5', true);
	/* gallery 6 */
	$galleryImg6 = get_post_meta($post->ID, '_tdCore-galleryImg_6', true);
	/* gallery 7 */
	$galleryImg7 = get_post_meta($post->ID, '_tdCore-galleryImg_7', true);
	/* gallery 8 */
	$galleryImg8 = get_post_meta($post->ID, '_tdCore-galleryImg_8', true);
	/* gallery 9 */
	$galleryImg9 = get_post_meta($post->ID, '_tdCore-galleryImg_9', true);
	/* gallery 10 */
	$galleryImg10 = get_post_meta($post->ID, '_tdCore-galleryImg_10', true);
	$homeBgGalSpeed = get_post_meta($post->ID, '_tdCore-bgGal-speed', true);
	$homeBgGalEffect = get_post_meta($post->ID, '_tdCore-bgGalEffect', true);
	$brickFormat = get_post_meta($post->ID, '_tdCore-brickFormat', true);
	$hideBrickVideo = ($brickFormat != 'brick6') ? ' style="display:none;"' : '';
	$brickVideo = get_post_meta($post->ID, '_tdCore-brickVideo', true);
	$saleDisplay = get_post_meta($post->ID, '_tdCore-saleDisplay', true);
	$saleDisplay = ($saleDisplay != '') ? 'checked="checked"' : 'check="unchecked"';
	$salePrice = get_post_meta($post->ID, '_tdCore-salePrice', true);
  $saleThumb1 = get_post_meta($post->ID, '_tdCore-saleThumb1', true);
  $saleThumb2 = get_post_meta($post->ID, '_tdCore-saleThumb2', true);
  $saleThumb3 = get_post_meta($post->ID, '_tdCore-saleThumb3', true);
  $saleThumb4 = get_post_meta($post->ID, '_tdCore-saleThumb4', true);
	?> 
<input type="hidden" name="theme-dutch_options_box_nonce" value="<?php echo wp_create_nonce('post_options.php'); ?>" />
<div style="padding: 10px;">
<!-- BACKGROUND POST -->
<div style="padding:10px 0;"><strong style="padding:3px 0 0 0; font-size: 13px;">Background</strong></div>
<br />
<div>
  <select id="tdCore-bgType" name="_tdCore-bgType" onChange="showBgImgField();">
    <option<?php if($bgType == "gallery") { echo ' selected'; } ?>>gallery</option>
    <option<?php if($bgType == "video") { echo ' selected'; } ?>>video</option>
    <option<?php if($bgType == "url") { echo ' selected'; } ?>>url</option>
    <option<?php if($bgType == "map") { echo ' selected'; } ?>>map</option>
  </select>
</div>
<br /><span style="color:#999; font-size:10px;">Use a full screen gallery, video, website or map background.</span>
<div id="tdCore-bgImg-td" <?php echo $hideBgImg; ?>><p valign="top" style="padding:3px 0 0 0;">Background gallery</p></div>
<div id="tdCore-bgVid-td" <?php echo $hideBgVid; ?>><p valign="top" style="padding:3px 0 0 0;">Background video</p></div>
<div id="tdCore-bgUrl-td" <?php echo $hideBgUrl; ?>><p valign="top" style="padding:3px 0 0 0;">Background url</p></div>
<div id="tdCore-bgMap-td" <?php echo $hideBgMap; ?>><p valign="top" style="padding:3px 0 0 0;">Background map</p></div>
<div id="tdCore-bgUrl-tr" <?php echo $hideBgUrl; ?>>
<input type="text" id="_tdCore-bgUrl" name="_tdCore-bgUrl" value="<?php echo $bgUrl; ?>" />
<br /><div style="color:#999; font-size:10px; margin-top: 5px;">Fill in the complete URL to the website. (E.G. www.theme-dutch.nl), Be aware this can be heavy!</div><br />
</div>
<div id="tdCore-bgMap-tr" <?php echo $hideBgMap; ?>>
<input type="text" id="_tdCore-bgMap" name="_tdCore-bgMap" value="<?php echo $bgMap; ?>" />
<br /><div style="color:#999; font-size:10px; margin-top: 5px;">Fill in an address like so: Koningin regentesselaan 44, Roermond</div><br />
</div>
<div id="tdCore-bgVid-tr" <?php echo $hideBgVid; ?>>
<input type="text" id="_tdCore-bgVid" name="_tdCore-bgVid" value="<?php echo $bgVid; ?>" />
<br /><div style="color:#999; font-size:10px; margin-top: 5px;">Only localy hosted video support.</div><br />
</div>
<div id="tdCore-bgImg-tr" <?php echo $hideBgImg; ?>>
<p valign="top" style="padding:3px 0 0 0;" id="bgImgTitle">Transition speed:</p>
        <p><input type="text" id="_tdCore-bgGal-speed" name="_tdCore-bgGal-speed" value="<?php echo $homeBgGalSpeed; ?>" />
        <br />
            <span style="color:#999; font-size:10px;" id="bgImgDesc">Enter the speed between slides (1-5).</span></p>
           
          <p valign="top" style="padding:3px 0 0 0;">Background gallery effect:</p>
          <p><select id="_tdCore-bgGalEffect" name="_tdCore-bgGalEffect">
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
<div class="galleryCount" style="display: none;"><input type="text" id="_tdCore-galleryCount" name="_tdCore-galleryCount" value="<?php echo $galleryCount; ?>" /></div>
<div class="bGgalleryContainer">
<?php
		  $count = $galleryCount;
		  for ($i = 1; $i <= $count; $i++) {
			  $n = $i;
				$galleryImg = get_post_meta($post->ID, '_tdCore-galleryImg_'.$n.'', true);
				echo "<div>gallery image ".$n.": <input type=\"text\" id=\"_tdCore-galleryImg_".$n."\" name=\"_tdCore-galleryImg_".$n."\" value=\"".$galleryImg."\" /><input id=\"upload_galleryImg_".$n."_button\" type=\"button\" value=\"Upload Image\" /></div>";
		  }
	?>
</div>
<br style="clear: both" />
<div class='addBgGalS'><input type="button" onclick="" value="Add slide"></div>
<div class='deleteImgS'><input type="button" onclick="" value="Delete slide"></div>
<br style="clear: both" />
</div>

	<hr />
	<!-- BRICK OPTIONS POST -->
  <div style="padding:10px 0;"><strong style="padding:3px 0 0 0; font-size: 13px;">Brick format</strong></div>
  <p><select id="_tdCore-brickFormat" name="_tdCore-brickFormat" onChange="showBrickField();">
    <option<?php if($brickFormat == "brick1") { echo " selected"; } ?> value="brick1" >Brick 1 | 150x150</option>
    <option<?php if($brickFormat == "brick2") { echo " selected"; } ?> value="brick2" >Brick 2 | 300x150</option>
    <option<?php if($brickFormat == "brick3") { echo " selected"; } ?> value="brick3" >Brick 3 | 300x300</option>
    <option<?php if($brickFormat == "brick4") { echo " selected"; } ?> value="brick4" >Brick 4 | 600x300</option>
    <option<?php if($brickFormat == "brick5") { echo " selected"; } ?> value="brick5" >Brick 5 | 150x300</option>
    <option<?php if($brickFormat == "brick6") { echo " selected"; } ?> value="brick6" >Brick 6 | Video</option>
  </select>
  <br />
  <span style="color:#999; font-size:10px;">If you are using the brick homepage or blog, provide us with what brick you would like.</span></p>
  <div id="tdCore-brickVideo-tr" <?php echo $hideBrickVideo; ?>>
    <p valign="top" style="padding:3px 0 0 0;">Brick video</p>
    <input type="text" id="_tdCore-brickVideo" name="_tdCore-brickVideo" value="<?php echo $brickVideo; ?>" />
    <br /><div style="color:#999; font-size:10px; margin-top: 5px;">Fill in complete url (only: youtube, vimeo, selfhosted).</div><br />
  </div>
  <hr />
  <div style="width: 100%;">
    <div class="slideCount" style="display: none;"><input type="text" id="td-slideCount" name="td-slideCount" value="<?php echo $slideCount; ?>" /></div>
    <div style="padding:10px 0;"><strong style="padding:3px 0 0 0; font-size: 13px;">Slider options</strong></div>
    <p valign="top" style="padding:3px 0 0 0;">Slider height:</p>
    <input type="text" id="_tdCore-slideHeight" name="_tdCore-slideHeight" value="<?php echo $slideHeight ?>" />px<br /><br />
    <div class="slideContainer">
      <?php
      $count = $slideCount;
      for ($i = 1; $i <= $count; $i++) {
      $n = $i;
      $slideImg = get_post_meta($post->ID, '_tdCore-slideImg_'.$n.'', true);
      $slideLink = get_post_meta($post->ID, '_tdCore-slideLink_'.$n.'', true);
      $slideText = get_post_meta($post->ID, '_tdCore-slideText_'.$n.'', true);
      echo "<div>Slide ".$n."<br />Slide image: <input type=\"text\" id=\"_tdCore-slideImg_".$n."\" name=\"_tdCore-slideImg_".$n."\" value=\"".$slideImg."\" /><input id=\"upload_slideImg_".$n."_button\" type=\"button\" value=\"Upload Image\" /><br />Slide link: <input type=\"text\" id=\"_tdCore-slideLink_".$n."\" name=\"_tdCore-slideLink_".$n."\" value=\"".$slideLink."\" /> Slide overlaytext: <input type=\"text\" id=\"_tdCore-slideText_".$n."\" name=\"_tdCore-slideText_".$n."\" value=\"".$slideText."\" /></div>";
      }
      ?>
    </div>
    <div class='addBgGal' style="float: left;"><input type="button" onclick="" value="Add slide"></div>
    <div class='deleteImg' style="float: left;"><input type="button" onclick="" value="Delete slide"></div>
    <br style="clear: both;" />
    <br />
  </div>
  
  <hr />
  <!-- SALES OPTIONS ON POST -->
  <div style="width: 100%;">
    <div style="padding:10px 0;"><strong style="padding:3px 0 0 0; font-size: 13px;">Product options</strong></div>
    <p valign="top" style="padding:3px 0 0 0;">Show as product post:
    <input type="checkbox" value="1" <?php echo $saleDisplay; ?> id="_tdCore-saleDisplay" name="_tdCore-saleDisplay" /><br />
    <span style="color:#999; font-size:10px;" id="bgImgDesc">This will change the look of the single page to a product page.<br />
    You can set up the category to be a product gallery in the James category options.</span></p>
    <p valign="top" style="padding:3px 0 0 0;">Product price:</p>
    <input type="text" id="_tdCore-salePrice" name="_tdCore-salePrice" value="<?php echo $salePrice ?>" />
    <p valign="top" style="padding:3px 0 0 0;">Thumbnail #1:</p>
    <input type="text" id="_tdCore-saleThumb1" name="_tdCore-saleThumb1" value="<?php echo $saleThumb1 ?>" /><input id="upload_saleThumb1_button" type="button" value="Upload image" />
    <p valign="top" style="padding:3px 0 0 0;">Thumbnail #2:</p>
    <input type="text" id="_tdCore-saleThumb2" name="_tdCore-saleThumb2" value="<?php echo $saleThumb2 ?>" /><input id="upload_saleThumb2_button" type="button" value="Upload image" />
    <p valign="top" style="padding:3px 0 0 0;">Thumbnail #3:</p>
    <input type="text" id="_tdCore-saleThumb3" name="_tdCore-saleThumb3" value="<?php echo $saleThumb3 ?>" /><input id="upload_saleThumb3_button" type="button" value="Upload image" />
    <p valign="top" style="padding:3px 0 0 0;">Thumbnail #4:</p>
    <input type="text" id="_tdCore-saleThumb4" name="_tdCore-saleThumb4" value="<?php echo $saleThumb4 ?>" /><input id="upload_saleThumb4_button" type="button" value="Upload image" />
  </div>

</div>
  <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/js/cp/css/colorpicker.css" />
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/cp/js/colorpicker.js"></script>
  <script type="text/javascript">
		jQuery(document).ready(function() {
			showBgImgField();
			bGfields = jQuery(".galleryContainer > div").size();
			jQuery('.addBgGalS').click(function() {
			bGfields = 1+jQuery(".bGgalleryContainer > div").size();
			if(bGfields == 11) {
				alert('You reached the maximum amount of fields for background gallery.');
				exit();
			} else {
				  if(bGfields == 1) {
					jQuery('.bGgalleryContainer').append('<div>gallery image: '+bGfields+' <input type="text" id="_tdCore-galleryImg_1" name="_tdCore-galleryImg_1" value="<?php echo $galleryImg1; ?>" /><input id="upload_galleryImg_1_button" type="button" value="Upload Image" /></div>');
					}
					if(bGfields == 2) {
					jQuery('.bGgalleryContainer').append('<div>gallery image: '+bGfields+' <input type="text" id="_tdCore-galleryImg_2" name="_tdCore-galleryImg_2" value="<?php echo $galleryImg2; ?>" /><input id="upload_galleryImg_2_button" type="button" value="Upload Image" /></div>');
					}
					if(bGfields == 3) {
					jQuery('.bGgalleryContainer').append('<div>gallery image: '+bGfields+' <input type="text" id="_tdCore-galleryImg_3" name="_tdCore-galleryImg_3" value="<?php echo $galleryImg3; ?>" /><input id="upload_galleryImg_3_button" type="button" value="Upload Image" /></div>');
					}
					if(bGfields == 4) {
					jQuery('.bGgalleryContainer').append('<div>gallery image: '+bGfields+' <input type="text" id="_tdCore-galleryImg_4" name="_tdCore-galleryImg_4" value="<?php echo $galleryImg4; ?>" /><input id="upload_galleryImg_4_button" type="button" value="Upload Image" /></div>');
					}
					if(bGfields == 5) {
					jQuery('.bGgalleryContainer').append('<div>gallery image: '+bGfields+' <input type="text" id="_tdCore-galleryImg_5" name="_tdCore-galleryImg_5" value="<?php echo $galleryImg5; ?>" /><input id="upload_galleryImg_5_button" type="button" value="Upload Image" /></div>');
					}
					if(bGfields == 6) {
					jQuery('.bGgalleryContainer').append('<div>gallery image: '+bGfields+' <input type="text" id="_tdCore-galleryImg_6" name="_tdCore-galleryImg_6" value="<?php echo $galleryImg6; ?>" /><input id="upload_galleryImg_6_button" type="button" value="Upload Image" /></div>');
					}
					if(bGfields == 7) {
					jQuery('.bGgalleryContainer').append('<div>gallery image: '+bGfields+' <input type="text" id="_tdCore-galleryImg_7" name="_tdCore-galleryImg_7" value="<?php echo $galleryImg7; ?>" /><input id="upload_galleryImg_7_button" type="button" value="Upload Image" /></div>');
					}
					if(bGfields == 8) {
					jQuery('.bGgalleryContainer').append('<div>gallery image: '+bGfields+' <input type="text" id="_tdCore-galleryImg_8" name="_tdCore-galleryImg_8" value="<?php echo $galleryImg8; ?>" /><input id="upload_galleryImg_8_button" type="button" value="Upload Image" /></div>');
					}
					if(bGfields == 9) {
					jQuery('.bGgalleryContainer').append('<div>gallery image: '+bGfields+' <input type="text" id="_tdCore-galleryImg_9" name="_tdCore-galleryImg_9" value="<?php echo $galleryImg9; ?>" /><input id="upload_galleryImg_9_button" type="button" value="Upload Image" /></div>');
					}
					if(bGfields == 10) {
					jQuery('.bGgalleryContainer').append('<div>gallery image: '+bGfields+' <input type="text" id="_tdCore-galleryImg_10" name="_tdCore-galleryImg_10" value="<?php echo $galleryImg10; ?>" /><input id="upload_galleryImg_10_button" type="button" value="Upload Image" /></div>');
					}
			jQuery(".galleryCount > input").val(bGfields);
			}
		});
			
			jQuery('.deleteImgS').click(function() {
				ffield = bGfields - 3;
				chris = bGfields -4;
				rfield = bGfields - 1;
				vfield = bGfields - 1;
				if(vfield == -1) {
					alert('there are no more fields to delete');
					vfield = 0;
					exit();
				}
				jQuery(".galleryCount > input").val(vfield);
			jQuery(".bGgalleryContainer > div:eq("+rfield+")").remove();
			bGfields = bGfields -1 ;
			});
			
			
			fields = jQuery(".slideContainer > div").size();
			jQuery('.addBgGal').click(function() {
			fields = 1+jQuery(".slideContainer > div").size();
			if(fields == 11) {
				alert('You reached the maximum amount of fields for background gallery.');
				exit();
			} else {
				  if(fields == 1) {
					jQuery('.slideContainer').append('<div style="margin-bottom: 15px;">Slide image: '+fields+' <input type="text" id="_tdCore-slideImg_1" name="_tdCore-slideImg_1" value="<?php echo $slideImg1; ?>" /><input id="upload_slideImg_1_button" type="button" value="Upload Image" /><br />Slide link: <input type="text" id="_tdCore-slideLink_1" name="_tdCore-slideLink_1" value="<?php echo $slideLink1; ?>" /> Slide overlaytext: <input type="text" id="_tdCore-slideText_1" name="_tdCore-slideText_1" value="<?php echo $slideText1; ?>" /></div>');
					}
					if(fields == 2) {
					jQuery('.slideContainer').append('<div style="margin-bottom: 15px;">Slide image: '+fields+' <input type="text" id="_tdCore-slideImg_2" name="_tdCore-slideImg_2" value="<?php echo $slideImg2; ?>" /><input id="upload_slideImg_2_button" type="button" value="Upload Image" /><br />Slide link: <input type="text" id="_tdCore-slideLink_2" name="_tdCore-slideLink_2" value="<?php echo $slideLink2; ?>" /> Slide overlaytext: <input type="text" id="_tdCore-slideText_2" name="_tdCore-slideText_2" value="<?php echo $slideText2; ?>" /></div>');
					}
					if(fields == 3) {
					jQuery('.slideContainer').append('<div style="margin-bottom: 15px;">Slide image: '+fields+' <input type="text" id="_tdCore-slideImg_3" name="_tdCore-slideImg_3" value="<?php echo $slideImg3; ?>" /><input id="upload_slideImg_3_button" type="button" value="Upload Image" /><br />Slide link: <input type="text" id="_tdCore-slideLink_3" name="_tdCore-slideLink_3" value="<?php echo $slideLink3; ?>" /> Slide overlaytext: <input type="text" id="_tdCore-slideText_3" name="_tdCore-slideText_3" value="<?php echo $slideText3; ?>" /></div>');
					}
					if(fields == 4) {
					jQuery('.slideContainer').append('<div style="margin-bottom: 15px;">Slide image: '+fields+' <input type="text" id="_tdCore-slideImg_4" name="_tdCore-slideImg_4" value="<?php echo $slideImg4; ?>" /><input id="upload_slideImg_4_button" type="button" value="Upload Image" /><br />Slide link: <input type="text" id="_tdCore-slideLink_4" name="_tdCore-slideLink_4" value="<?php echo $slideLink4; ?>" /> Slide overlaytext: <input type="text" id="_tdCore-slideText_4" name="_tdCore-slideText_4" value="<?php echo $slideText4; ?>" /></div>');
					}
					if(fields == 5) {
					jQuery('.slideContainer').append('<div style="margin-bottom: 15px;">Slide image: '+fields+' <input type="text" id="_tdCore-slideImg_5" name="_tdCore-slideImg_5" value="<?php echo $slideImg5; ?>" /><input id="upload_slideImg_5_button" type="button" value="Upload Image" /><br />Slide link: <input type="text" id="_tdCore-slideLink_5" name="_tdCore-slideLink_5" value="<?php echo $slideLink5; ?>" /> Slide overlaytext: <input type="text" id="_tdCore-slideText_5" name="_tdCore-slideText_5" value="<?php echo $slideText5; ?>" /></div>');
					}
					if(fields == 6) {
					jQuery('.slideContainer').append('<div style="margin-bottom: 15px;">Slide image: '+fields+' <input type="text" id="_tdCore-slideImg_6" name="_tdCore-slideImg_6" value="<?php echo $slideImg6; ?>" /><input id="upload_slideImg_6_button" type="button" value="Upload Image" /><br />Slide link: <input type="text" id="_tdCore-slideLink_6" name="_tdCore-slideLink_6" value="<?php echo $slideLink6; ?>" /> Slide overlaytext: <input type="text" id="_tdCore-slideText_6" name="_tdCore-slideText_6" value="<?php echo $slideText6; ?>" /></div>');
					}
					if(fields == 7) {
					jQuery('.slideContainer').append('<div style="margin-bottom: 15px;">Slide image: '+fields+' <input type="text" id="_tdCore-slideImg_7" name="_tdCore-slideImg_7" value="<?php echo $slideImg7; ?>" /><input id="upload_slideImg_7_button" type="button" value="Upload Image" /><br />Slide link: <input type="text" id="_tdCore-slideLink_7" name="_tdCore-slideLink_7" value="<?php echo $slideLink7; ?>" /> Slide overlaytext: <input type="text" id="_tdCore-slideText_7" name="_tdCore-slideText_7" value="<?php echo $slideText7; ?>" /></div>');
					}
					if(fields == 8) {
					jQuery('.slideContainer').append('<div style="margin-bottom: 15px;">Slide image: '+fields+' <input type="text" id="_tdCore-slideImg_8" name="_tdCore-slideImg_8" value="<?php echo $slideImg8; ?>" /><input id="upload_slideImg_8_button" type="button" value="Upload Image" /><br />Slide link: <input type="text" id="_tdCore-slideLink_8" name="_tdCore-slideLink_8" value="<?php echo $slideLink8; ?>" /> Slide overlaytext: <input type="text" id="_tdCore-slideText_8" name="_tdCore-slideText_8" value="<?php echo $slideText8; ?>" /></div>');
					}
					if(fields == 9) {
					jQuery('.slideContainer').append('<div style="margin-bottom: 15px;">Slide image: '+fields+' <input type="text" id="_tdCore-slideImg_9" name="_tdCore-slideImg_9" value="<?php echo $slideImg9; ?>" /><input id="upload_slideImg_9_button" type="button" value="Upload Image" /><br />Slide link: <input type="text" id="_tdCore-slideLink_9" name="_tdCore-slideLink_9" value="<?php echo $slideLink9; ?>" /> Slide overlaytext: <input type="text" id="_tdCore-slideText_9" name="_tdCore-slideText_9" value="<?php echo $slideText9; ?>" /></div>');
					}
					if(fields == 10) {
					jQuery('.slideContainer').append('<div style="margin-bottom: 15px;">Slide image: '+fields+' <input type="text" id="_tdCore-slideImg_10" name="_tdCore-slideImg_10" value="<?php echo $slideImg10; ?>" /><input id="upload_slideImg_10_button" type="button" value="Upload Image" /><br />Slide link: <input type="text" id="_tdCore-slideLink_10" name="_tdCore-slideLink_10" value="<?php echo $slideLink10; ?>" /> Slide overlaytext: <input type="text" id="_tdCore-slideText_10" name="_tdCore-slideText_10" value="<?php echo $slideText10; ?>" /></div>');
					}
			jQuery(".slideCount > input").val(fields);
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
				jQuery(".slideCount > input").val(vfield);
			jQuery(".slideContainer > div:eq("+rfield+")").remove();
			fields = fields -1 ;
			});
			
	var formfield;
/* BG Image */
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
jQuery('#upload_saleThumb1_button').live('click', function() {
formfield = jQuery('#_tdCore-saleThumb1').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_saleThumb2_button').live('click', function() {
formfield = jQuery('#_tdCore-saleThumb2').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_saleThumb3_button').live('click', function() {
formfield = jQuery('#_tdCore-saleThumb3').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_saleThumb4_button').live('click', function() {
formfield = jQuery('#_tdCore-saleThumb4').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
/* Slider Image */
jQuery('#upload_slideImg_1_button').live('click', function() {
formfield = jQuery('#_tdCore-slideImg_1').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_slideImg_2_button').live('click', function() {
formfield = jQuery('#_tdCore-slideImg_2').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_slideImg_3_button').live('click', function() {
formfield = jQuery('#_tdCore-slideImg_3').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_slideImg_4_button').live('click', function() {
formfield = jQuery('#_tdCore-slideImg_4').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_slideImg_5_button').live('click', function() {
formfield = jQuery('#_tdCore-slideImg_5').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_slideImg_6_button').live('click', function() {
formfield = jQuery('#_tdCore-slideImg_6').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_slideImg_7_button').live('click', function() {
formfield = jQuery('#_tdCore-slideImg_7').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_slideImg_8_button').live('click', function() {
formfield = jQuery('#_tdCore-slideImg_8').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_slideImg_9_button').live('click', function() {
formfield = jQuery('#_tdCore-slideImg_9').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_slideImg_10_button').live('click', function() {
formfield = jQuery('#_tdCore-slideImg_10').attr('name');
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
	jQuery('#_tdCore-bgColor').ColorPicker({
      	onSubmit:function(hsb, hex, rgb, el) {
      		jQuery(el).val(hex);
      		jQuery(el).ColorPickerHide();
      	},
      	onBeforeShow:function() {
      		jQuery(this).ColorPickerSetColor(this.value);
      	}
      });
 });	
		function showContactFields() {
      if(jQuery("#_tdCore-showContact").val() == "false") {
        jQuery("#tdCore-showContact-table").fadeOut(200);
      } else {
        jQuery("#tdCore-showContact-table").fadeIn();
      }
    }
    function showBgImgField() {
      if(jQuery("#tdCore-bgType").val() == "gallery") {
				jQuery("#tdCore-bgColor-td").fadeOut(200);
        jQuery("#tdCore-bgColor-tr").fadeOut(200);
				jQuery("#tdCore-bgVid-td").fadeOut(200);
        jQuery("#tdCore-bgVid-tr").fadeOut(200);
				jQuery("#tdCore-bgUrl-td").fadeOut(200);
        jQuery("#tdCore-bgUrl-tr").fadeOut(200);
				jQuery("#tdCore-bgMap-td").fadeOut(200);
        jQuery("#tdCore-bgMap-tr").fadeOut(200);
        jQuery("#tdCore-bgImg-tr").fadeIn();
				jQuery("#tdCore-bgImg-td").fadeIn();
      } else if(jQuery("#tdCore-bgType").val() == "video") {
				jQuery("#tdCore-bgColor-td").fadeOut(200);
        jQuery("#tdCore-bgColor-tr").fadeOut(200);
				jQuery("#tdCore-bgImg-td").fadeOut(200);
        jQuery("#tdCore-bgImg-tr").fadeOut(200);
				jQuery("#tdCore-bgUrl-td").fadeOut(200);
        jQuery("#tdCore-bgUrl-tr").fadeOut(200);
				jQuery("#tdCore-bgMap-td").fadeOut(200);
        jQuery("#tdCore-bgMap-tr").fadeOut(200);
				jQuery("#tdCore-bgVid-td").fadeIn();
        jQuery("#tdCore-bgVid-tr").fadeIn();
      } else if(jQuery("#tdCore-bgType").val() == "url") {
				jQuery("#tdCore-bgColor-td").fadeOut(200);
        jQuery("#tdCore-bgColor-tr").fadeOut(200);
				jQuery("#tdCore-bgImg-td").fadeOut(200);
        jQuery("#tdCore-bgImg-tr").fadeOut(200);
				jQuery("#tdCore-bgVid-td").fadeOut(200);
        jQuery("#tdCore-bgVid-tr").fadeOut(200);
				jQuery("#tdCore-bgMap-td").fadeOut(200);
        jQuery("#tdCore-bgMap-tr").fadeOut(200);
				jQuery("#tdCore-bgUrl-td").fadeIn();
        jQuery("#tdCore-bgUrl-tr").fadeIn();
			} else if(jQuery("#tdCore-bgType").val() == "map") {
				jQuery("#tdCore-bgColor-td").fadeOut(200);
        jQuery("#tdCore-bgColor-tr").fadeOut(200);
				jQuery("#tdCore-bgImg-td").fadeOut(200);
        jQuery("#tdCore-bgImg-tr").fadeOut(200);
				jQuery("#tdCore-bgVid-td").fadeOut(200);
        jQuery("#tdCore-bgVid-tr").fadeOut(200);
				jQuery("#tdCore-bgUrl-td").fadeOut(200);
        jQuery("#tdCore-bgUrl-tr").fadeOut(200);
				jQuery("#tdCore-bgMap-td").fadeIn();
        jQuery("#tdCore-bgMap-tr").fadeIn();
			} else {
				jQuery("#tdCore-bgColor-td").fadeIn();
        jQuery("#tdCore-bgColor-tr").fadeIn();
				jQuery("#tdCore-bgImg-td").fadeOut(200);
        jQuery("#tdCore-bgImg-tr").fadeOut(200);
				jQuery("#tdCore-bgVid-td").fadeOut(200);
        jQuery("#tdCore-bgVid-tr").fadeOut(200);
				jQuery("#tdCore-bgUrl-td").fadeOut(200);
        jQuery("#tdCore-bgUrl-tr").fadeOut(200);
				jQuery("#tdCore-bgMap-td").fadeOut(200);
        jQuery("#tdCore-bgMap-tr").fadeOut(200);      }
    }
		function showBrickField() {
      if(jQuery("#_tdCore-brickFormat").val() == "brick6") {
				jQuery('#tdCore-brickVideo-tr').fadeIn();
      } else {
				jQuery('#tdCore-brickVideo-tr').fadeOut(200);
      }
    }
    
  </script>
  <?php
}

/* Display Sensitive options */
function placeSensitiveOptions() {
  global $post;
  /* General options */
	$showContent = get_post_meta($post->ID, '_tdCore-showContent', true);
  $bgType = get_post_meta($post->ID, '_tdCore-bgType', true);
	$bgVid = get_post_meta($post->ID, '_tdCore-bgVid', true);
  $bgImg = get_post_meta($post->ID, '_tdCore-bgImg', true);
	$bgUrl = get_post_meta($post->ID, '_tdCore-bgUrl', true);
	$bgMap = get_post_meta($post->ID, '_tdCore-bgMap', true);
	$hideBgImg = ($bgType != 'gallery') ? ' style="display:none;"' : '';
	$hideBgColor = ($bgType != 'color') ? ' style="display:none;"' : '';
	$hideBgVid = ($bgType != 'video') ? ' style="display:none;"' : '';
	$hideBgUrl = ($bgType != 'url') ? ' style="display:none;"' : '';
	$hideBgMap = ($bgType != 'map') ? ' style="display:none;"' : '';
	$bgColor = get_post_meta($post->ID, '_tdCore-bgColor', true);
	$slideHeight = get_post_meta($post->ID, '_tdCore-slideHeight', true);
	$slideCount = get_post_meta($post->ID, 'td-slideCount', true);
	/* slide 1 */
	$slideImg1 = get_post_meta($post->ID, '_tdCore-slideImg_1', true);
	$slideLink1 = get_post_meta($post->ID, '_tdCore-slideLink_1', true);
	$slideText1 = get_post_meta($post->ID, '_tdCore-slideText_1', true);
	/* slide 2 */
	$slideImg2 = get_post_meta($post->ID, '_tdCore-slideImg_2', true);
	$slideLink2 = get_post_meta($post->ID, '_tdCore-slideLink_2', true);
	$slideText2 = get_post_meta($post->ID, '_tdCore-slideText_2', true);
	/* slide 3 */
	$slideImg3 = get_post_meta($post->ID, '_tdCore-slideImg_3', true);
	$slideLink3 = get_post_meta($post->ID, '_tdCore-slideLink_3', true);
	$slideText3 = get_post_meta($post->ID, '_tdCore-slideText_3', true);
	/* slide 4 */
	$slideImg4 = get_post_meta($post->ID, '_tdCore-slideImg_4', true);
	$slideLink4 = get_post_meta($post->ID, '_tdCore-slideLink_4', true);
	$slideText4 = get_post_meta($post->ID, '_tdCore-slideText_4', true);
	/* slide 5 */
	$slideImg5 = get_post_meta($post->ID, '_tdCore-slideImg_5', true);
	$slideLink5 = get_post_meta($post->ID, '_tdCore-slideLink_5', true);
	$slideText5 = get_post_meta($post->ID, '_tdCore-slideText_5', true);
	/* slide 6 */
	$slideImg6 = get_post_meta($post->ID, '_tdCore-slideImg_6', true);
	$slideLink6 = get_post_meta($post->ID, '_tdCore-slideLink_6', true);
	$slideText6 = get_post_meta($post->ID, '_tdCore-slideText_6', true);
	/* slide 7 */
	$slideImg7 = get_post_meta($post->ID, '_tdCore-slideImg_7', true);
	$slideLink7 = get_post_meta($post->ID, '_tdCore-slideLink_7', true);
	$slideText7 = get_post_meta($post->ID, '_tdCore-slideText_7', true);
	/* slide 8 */
	$slideImg8 = get_post_meta($post->ID, '_tdCore-slideImg_8', true);
	$slideLink8 = get_post_meta($post->ID, '_tdCore-slideLink_8', true);
	$slideText8 = get_post_meta($post->ID, '_tdCore-slideText_8', true);
	/* slide 9 */
	$slideImg9 = get_post_meta($post->ID, '_tdCore-slideImg_9', true);
	$slideLink9 = get_post_meta($post->ID, '_tdCore-slideLink_9', true);
	$slideText9 = get_post_meta($post->ID, '_tdCore-slideText_9', true);
	/* slide 10 */
	$slideImg10 = get_post_meta($post->ID, '_tdCore-slideImg_10', true);
	$slideLink10 = get_post_meta($post->ID, '_tdCore-slideLink_10', true);
	$slideText10 = get_post_meta($post->ID, '_tdCore-slideText_10', true);
	/* Contact options */
  $showContact = get_post_meta($post->ID, '_tdCore-showContact', true);
  $hideContact = ($showContact != 'true') ? ' display:none;' : '';
  $contactTitle = get_post_meta($post->ID, '_tdCore-contact-title', true);
  $emailTo = get_post_meta($post->ID, '_tdCore-contact-emailto', true);
  $showGender = get_post_meta($post->ID, '_tdCore-contact-showGender', true);
  $showName = get_post_meta($post->ID, '_tdCore-contact-showName', true);
  $contactNameRequired = get_post_meta($post->ID, '_tdCore-contact-nameRequired', true);
  $showAddress = get_post_meta($post->ID, '_tdCore-contact-showAddress', true);
  $contactAddressRequired = get_post_meta($post->ID, '_tdCore-contact-addressRequired', true);
  $showPostalcode = get_post_meta($post->ID, '_tdCore-contact-showPostalcode', true);
  $contactPostalcodeRequired = get_post_meta($post->ID, '_tdCore-contact-postalcodeRequired', true);
  $showCity = get_post_meta($post->ID, '_tdCore-contact-showCity', true);
  $contactCityRequired = get_post_meta($post->ID, '_tdCore-contact-cityRequired', true);
  $showCountry = get_post_meta($post->ID, '_tdCore-contact-showCountry', true);
  $contactCountryRequired = get_post_meta($post->ID, '_tdCore-contact-countryRequired', true);
  $showTelephone = get_post_meta($post->ID, '_tdCore-contact-showTelephone', true);
  $contactTelephoneRequired = get_post_meta($post->ID, '_tdCore-contact-telephoneRequired', true);
  $showEmail = get_post_meta($post->ID, '_tdCore-contact-showEmail', true);
  $contactEmailRequired = get_post_meta($post->ID, '_tdCore-contact-emailRequired', true);
  $showMessage = get_post_meta($post->ID, '_tdCore-contact-showMessage', true);
  $contactMessageRequired = get_post_meta($post->ID, '_tdCore-contact-messageRequired', true);
  $contactCaptcha = get_post_meta($post->ID, '_tdCore-contact-captcha', true);
	$galleryCount = get_post_meta($post->ID, '_tdCore-galleryCount', true);
	/* gallery 1 */
	$galleryImg1 = get_post_meta($post->ID, '_tdCore-galleryImg_1', true);
	/* gallery 2 */
	$galleryImg2 = get_post_meta($post->ID, '_tdCore-galleryImg_2', true);
	/* gallery 3 */
	$galleryImg3 = get_post_meta($post->ID, '_tdCore-galleryImg_3', true);
	/* gallery 4 */
	$galleryImg4 = get_post_meta($post->ID, '_tdCore-galleryImg_4', true);
	/* gallery 5 */
	$galleryImg5 = get_post_meta($post->ID, '_tdCore-galleryImg_5', true);
	/* gallery 6 */
	$galleryImg6 = get_post_meta($post->ID, '_tdCore-galleryImg_6', true);
	/* gallery 7 */
	$galleryImg7 = get_post_meta($post->ID, '_tdCore-galleryImg_7', true);
	/* gallery 8 */
	$galleryImg8 = get_post_meta($post->ID, '_tdCore-galleryImg_8', true);
	/* gallery 9 */
	$galleryImg9 = get_post_meta($post->ID, '_tdCore-galleryImg_9', true);
	/* gallery 10 */
	$galleryImg10 = get_post_meta($post->ID, '_tdCore-galleryImg_10', true);
	$homeBgGalSpeed = get_post_meta($post->ID, '_tdCore-bgGal-speed', true);
	$homeBgGalEffect = get_post_meta($post->ID, '_tdCore-bgGalEffect', true);
	$brickFormat = get_post_meta($post->ID, '_tdCore-brickFormat', true);
	$hideBrickVideo = ($brickFormat != 'brick6') ? ' style="display:none;"' : '';
	$brickVideo = get_post_meta($post->ID, '_tdCore-brickVideo', true);
	
	?> 
	<input type="hidden" name="theme-dutch_options_box_nonce" value="<?php echo wp_create_nonce('post_options.php'); ?>" />
    <div style="padding: 10px;">
<div style="padding:10px 0;"><strong style="padding:3px 0 0 0; font-size: 13px;">Background</strong></div>
<p valign="top" style="padding:3px 0 0 0;" id="bgImgTitle">Show content:</p>
<select id="_tdCore-showContent" name="_tdCore-showContent">
<option<?php if($showContent == "yes") { echo ' selected'; } ?>>yes</option>
<option<?php if($showContent == "no") { echo ' selected'; } ?>>no</option>
</select><br /><br />
<span style="color:#999; font-size:10px;" id="bgImgDesc">Do you want to show the content block?</span><br /><br />
<div><select id="tdCore-bgType" name="_tdCore-bgType" onChange="showBgImgField();">
<option<?php
      if($bgType == "gallery") { echo ' selected'; }
  ?>>gallery</option>
  <option<?php
      if($bgType == "video") { echo ' selected'; }
  ?>>video</option>
  <option<?php
      if($bgType == "url") { echo ' selected'; }
  ?>>url</option>
  <option<?php
      if($bgType == "map") { echo ' selected'; }
  ?>>map</option>
  </select>
</div>
<br /><span style="color:#999; font-size:10px;">Use a full screen gallery, video, website or map background.</span>
<div id="tdCore-bgImg-td" <?php echo $hideBgImg; ?>><p valign="top" style="padding:3px 0 0 0;">Background gallery</p></div>
<div id="tdCore-bgVid-td" <?php echo $hideBgVid; ?>><p valign="top" style="padding:3px 0 0 0;">Background video</p></div>
<div id="tdCore-bgUrl-td" <?php echo $hideBgUrl; ?>><p valign="top" style="padding:3px 0 0 0;">Background url</p></div>
<div id="tdCore-bgMap-td" <?php echo $hideBgMap; ?>><p valign="top" style="padding:3px 0 0 0;">Background map</p></div>
<div id="tdCore-bgUrl-tr" <?php echo $hideBgUrl; ?>>
<input type="text" id="_tdCore-bgUrl" name="_tdCore-bgUrl" value="<?php echo $bgUrl; ?>" />
<br /><div style="color:#999; font-size:10px; margin-top: 5px;">Fill in the complete URL to the website. (E.G. www.theme-dutch.nl), Be aware this can be heavy!</div><br />
</div>
<div id="tdCore-bgMap-tr" <?php echo $hideBgMap; ?>>
<input type="text" id="_tdCore-bgMap" name="_tdCore-bgMap" value="<?php echo $bgMap; ?>" />
<br /><div style="color:#999; font-size:10px; margin-top: 5px;">Fill in an address like so: Koningin regentesselaan 44, Roermond</div><br />
</div>
<div id="tdCore-bgVid-tr" <?php echo $hideBgVid; ?>>
<input type="text" id="_tdCore-bgVid" name="_tdCore-bgVid" value="<?php echo $bgVid; ?>" />
<br /><div style="color:#999; font-size:10px; margin-top: 5px;">Only localy hosted video support.</div><br />
</div>
<div id="tdCore-bgImg-tr" <?php echo $hideBgImg; ?>>
<p valign="top" style="padding:3px 0 0 0;" id="bgImgTitle">Transition speed:</p>
        <p><input type="text" id="_tdCore-bgGal-speed" name="_tdCore-bgGal-speed" value="<?php echo $homeBgGalSpeed; ?>" />
        <br />
            <span style="color:#999; font-size:10px;" id="bgImgDesc">Enter the speed between slides (1-5).</span></p>
           
          <p valign="top" style="padding:3px 0 0 0;">Background gallery effect:</p>
          <p><select id="_tdCore-bgGalEffect" name="_tdCore-bgGalEffect">
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
<div class="galleryCount" style="display: none;"><input type="text" id="_tdCore-galleryCount" name="_tdCore-galleryCount" value="<?php echo $galleryCount; ?>" /></div>
<div class="bGgalleryContainer">
<?php
		  $count = $galleryCount;
		  for ($i = 1; $i <= $count; $i++) {
			  $n = $i;
				$galleryImg = get_post_meta($post->ID, '_tdCore-galleryImg_'.$n.'', true);
				echo "<div>gallery image ".$n.": <input type=\"text\" id=\"_tdCore-galleryImg_".$n."\" name=\"_tdCore-galleryImg_".$n."\" value=\"".$galleryImg."\" /><input id=\"upload_galleryImg_".$n."_button\" type=\"button\" value=\"Upload Image\" /></div>";
		  }
	?>
</div>
<br style="clear: both" />
<div class='addBgGalS'><input type="button" onclick="" value="Add slide"></div>
<div class='deleteImgS'><input type="button" onclick="" value="Delete slide"></div>
<br style="clear: both" />
</div>
<hr />
<div style="width: 100%;">
<div class="slideCount" style="display: none;"><input type="text" id="td-slideCount" name="td-slideCount" value="<?php echo $slideCount; ?>" /></div>
<div style="padding:10px 0;"><strong style="padding:3px 0 0 0; font-size: 13px;">Slider options</strong></div>
    <p valign="top" style="padding:3px 0 0 0;">Slider height:</p>
<input type="text" id="_tdCore-slideHeight" name="_tdCore-slideHeight" value="<?php echo $slideHeight ?>" />px<br /><br />
<div class="slideContainer">
<?php
		  $count = $slideCount;
		  for ($i = 1; $i <= $count; $i++) {
			  $n = $i;
				$slideImg = get_post_meta($post->ID, '_tdCore-slideImg_'.$n.'', true);
				$slideLink = get_post_meta($post->ID, '_tdCore-slideLink_'.$n.'', true);
				$slideText = get_post_meta($post->ID, '_tdCore-slideText_'.$n.'', true);
				echo "<div>Slide ".$n."<br />Slide image: <input type=\"text\" id=\"_tdCore-slideImg_".$n."\" name=\"_tdCore-slideImg_".$n."\" value=\"".$slideImg."\" /><input id=\"upload_slideImg_".$n."_button\" type=\"button\" value=\"Upload Image\" /><br />Slide link: <input type=\"text\" id=\"_tdCore-slideLink_".$n."\" name=\"_tdCore-slideLink_".$n."\" value=\"".$slideLink."\" /> Slide overlaytext: <input type=\"text\" id=\"_tdCore-slideText_".$n."\" name=\"_tdCore-slideText_".$n."\" value=\"".$slideText."\" /></div>";
		  }
	?>
</div>
<div class='addBgGal' style="float: left;"><input type="button" onclick="" value="Add slide"></div>
<div class='deleteImg' style="float: left;"><input type="button" onclick="" value="Delete slide"></div>
<br style="clear: both;" />
</div>
</div>
<div style="padding:10px;">
<hr />
<br />
<strong style="padding:3px 0 0 0; font-size: 13px;">Contact</strong>
<br />
    <div><p valign="top" style="padding:3px 0 0 0;">Show contact form:</p></div>
      <div><select id="_tdCore-showContact" name="_tdCore-showContact" onChange="showContactFields();"><option value="false"<?php
      if($showContact == "false") { echo " selected"; }
  ?>>no</option><option value="true"<?php
      if($showContact == "true") { echo " selected"; }
  ?>>yes</option></select></div>
    
 <div cellpadding="0" cellspacing="5" style="width:100%;<?php echo $hideContact; ?>" id="tdCore-showContact-table">
    <div><p valign="top" style="padding:3px 0 0 0;">Title: <span style="color:#ccc;">(optional)</span></p></div>
      <div><input type="text" id="tdCore-contact-title" name="_tdCore-contact-title" value="<?php echo $contactTitle; ?>" style="width:350px;" /></div>
      <div><p valign="top" style="padding:3px 0 0 0;">Send to e-mail:</p></div>
      <div><input type="text" id="tdCore-contact-emailto" name="_tdCore-contact-emailto" value="<?php echo $emailTo; ?>" style="width:350px;" /></div>
      <div><p valign="top" style="padding:3px 0 0 0;"><span style="width: 100px; display: inline-block;">Show Gender:</span> <select id="tdCore-contact-showGender" name="_tdCore-contact-showGender"><option value="false"<?php
      if($showGender == "false") { echo " selected"; }
      ?>>no</option><option value="true"<?php
      if($showGender == "true") { echo " selected"; }
      ?>>yes</option></select></p></div>
      <div></div>
 
      <div><p valign="top" style="padding:3px 0 0 0;"><span style="width: 100px; display: inline-block;">Show Name:</span> <select id="tdCore-contact-showName" name="_tdCore-contact-showName"><option value="false"<?php
      if($showName == "false") { echo " selected"; }
      ?>>no</option><option value="true"<?php
      if($showName == "true") { echo " selected"; }
      ?>>yes</option></select><select id="tdCore-contact-nameRequired" name="_tdCore-contact-nameRequired"><option value="false"<?php
      if($contactNameRequired == "false") { echo " selected"; }
      ?>>optional</option><option value="true"<?php
      if($contactNameRequired == "true") { echo " selected"; }
      ?>>required</option></select></p></div>

      <div><p valign="top" style="padding:3px 0 0 0;"><span style="width: 100px; display: inline-block;">Show Address:</span> <select id="tdCore-contact-showAddress" name="_tdCore-contact-showAddress"><option value="false"<?php
      if($showAddress == "false") { echo " selected"; }
      ?>>no</option><option value="true"<?php
      if($showAddress == "true") { echo " selected"; }
      ?>>yes</option></select><select id="tdCore-contact-addressRequired" name="_tdCore-contact-addressRequired"><option value="false"<?php
      if($contactAddressRequired == "false") { echo " selected"; }
      ?>>optional</option><option value="true"<?php
      if($contactAddressRequired == "true") { echo " selected"; }
      ?>>required</option></select></p></div>

      <div><p valign="top" style="padding:3px 0 0 0;"><span style="width: 100px; display: inline-block;">Show Postal code:</span> <select id="tdCore-contact-showPostalcode" name="_tdCore-contact-showPostalcode"><option value="false"<?php
      if($showPostalcode == "false") { echo " selected"; }
      ?>>no</option><option value="true"<?php
      if($showPostalcode == "true") { echo " selected"; }
      ?>>yes</option></select><select id="tdCore-contact-postalcodeRequired" name="_tdCore-contact-postalcodeRequired"><option value="false"<?php
      if($contactPostalcodeRequired == "false") { echo " selected"; }
      ?>>optional</option><option value="true"<?php
      if($contactPostalcodeRequired == "true") { echo " selected"; }
      ?>>required</option></select></p></div>

      <div><p valign="top" style="padding:3px 0 0 0;"><span style="width: 100px; display: inline-block;">Show City:</span> <select id="tdCore-contact-showCity" name="_tdCore-contact-showCity"><option value="false"<?php
      if($showCity == "false") { echo " selected"; }
      ?>>no</option><option value="true"<?php
      if($showCity == "true") { echo " selected"; }
      ?>>yes</option></select><select id="tdCore-contact-cityRequired" name="_tdCore-contact-cityRequired"><option value="false"<?php
      if($contactCityRequired == "false") { echo " selected"; }
      ?>>optional</option><option value="true"<?php
      if($contactCityRequired == "true") { echo " selected"; }
      ?>>required</option></select></p></div>

      <div><p valign="top" style="padding:3px 0 0 0;"><span style="width: 100px; display: inline-block;">Show Country:</span> <select id="tdCore-contact-showCountry" name="_tdCore-contact-showCountry"><option value="false"<?php
      if($showCountry == "false") { echo " selected"; }
      ?>>no</option><option value="true"<?php
      if($showCountry == "true") { echo " selected"; }
      ?>>yes</option></select><select id="tdCore-contact-countryRequired" name="_tdCore-contact-countryRequired"><option value="false"<?php
      if($contactCountryRequired == "false") { echo " selected"; }
      ?>>optional</option><option value="true"<?php
      if($contactCountryRequired == "true") { echo " selected"; }
      ?>>required</option></select></p></div>

      <div><p valign="top" style="padding:3px 0 0 0;"><span style="width: 100px; display: inline-block;">Show Telephone:</span> <select id="tdCore-contact-showTelephone" name="_tdCore-contact-showTelephone"><option value="false"<?php
      if($showTelephone == "false") { echo " selected"; }
      ?>>no</option><option value="true"<?php
      if($showTelephone == "true") { echo " selected"; }
      ?>>yes</option></select><select id="tdCore-contact-telephoneRequired" name="_tdCore-contact-telephoneRequired"><option value="false"<?php
      if($contactTelephoneRequired == "false") { echo " selected"; }
      ?>>optional</option><option value="true"<?php
      if($contactTelephoneRequired == "true") { echo " selected"; }
      ?>>required</option></select></p></div>

      <div><p valign="top" style="padding:3px 0 0 0;"><span style="width: 100px; display: inline-block;">Show E-mail:</span> <select id="tdCore-contact-showEmail" name="_tdCore-contact-showEmail"><option value="false"<?php
      if($showEmail == "false") { echo " selected"; }
      ?>>no</option><option value="true"<?php
      if($showEmail == "true") { echo " selected"; }
      ?>>yes</option></select><select id="tdCore-contact-emailRequired" name="_tdCore-contact-emailRequired"><option value="false"<?php
      if($contactEmailRequired == "false") { echo " selected"; }
      ?>>optional</option><option value="true"<?php
      if($contactEmailRequired == "true") { echo " selected"; }
      ?>>required</option></select></p></div>

      <div><p valign="top" style="padding:3px 0 0 0;"><span style="width: 100px; display: inline-block;">Show Message:</span> <select id="tdCore-contact-showMessage" name="_tdCore-contact-showMessage"><option value="false"<?php
      if($showMessage == "false") { echo " selected"; }
      ?>>no</option><option value="true"<?php
      if($showMessage == "true") { echo " selected"; }
      ?>>yes</option></select><select id="tdCore-contact-messageRequired" name="_tdCore-contact-messageRequired"><option value="false"<?php
      if($contactMessageRequired == "false") { echo " selected"; }
      ?>>optional</option><option value="true"<?php
      if($contactMessageRequired == "true") { echo " selected"; }
      ?>>required</option></select></p></div>

      <div><p valign="top" style="padding:3px 0 0 0;"><span style="width: 100px; display: inline-block;">Use CAPTCHA:</span> <select id="tdCore-contact-captcha" name="_tdCore-contact-captcha"><option value="false"<?php
      if($contactCaptcha == "false") { echo " selected"; }
      ?>>no</option><option value="true"<?php
      if($contactCaptcha == "true") { echo " selected"; }
      ?>>yes</option></select></p></div>
  </div>
  </div>
  <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/js/cp/css/colorpicker.css" />
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/cp/js/colorpicker.js"></script>
  <script type="text/javascript">
		jQuery(document).ready(function() {
			showBgImgField();
			bGfields = jQuery(".galleryContainer > div").size();
			jQuery('.addBgGalS').click(function() {
			bGfields = 1+jQuery(".bGgalleryContainer > div").size();
			if(bGfields == 11) {
				alert('You reached the maximum amount of fields for background gallery.');
				exit();
			} else {
				  if(bGfields == 1) {
					jQuery('.bGgalleryContainer').append('<div>gallery image: '+bGfields+' <input type="text" id="_tdCore-galleryImg_1" name="_tdCore-galleryImg_1" value="<?php echo $galleryImg1; ?>" /><input id="upload_galleryImg_1_button" type="button" value="Upload Image" /></div>');
					}
					if(bGfields == 2) {
					jQuery('.bGgalleryContainer').append('<div>gallery image: '+bGfields+' <input type="text" id="_tdCore-galleryImg_2" name="_tdCore-galleryImg_2" value="<?php echo $galleryImg2; ?>" /><input id="upload_galleryImg_2_button" type="button" value="Upload Image" /></div>');
					}
					if(bGfields == 3) {
					jQuery('.bGgalleryContainer').append('<div>gallery image: '+bGfields+' <input type="text" id="_tdCore-galleryImg_3" name="_tdCore-galleryImg_3" value="<?php echo $galleryImg3; ?>" /><input id="upload_galleryImg_3_button" type="button" value="Upload Image" /></div>');
					}
					if(bGfields == 4) {
					jQuery('.bGgalleryContainer').append('<div>gallery image: '+bGfields+' <input type="text" id="_tdCore-galleryImg_4" name="_tdCore-galleryImg_4" value="<?php echo $galleryImg4; ?>" /><input id="upload_galleryImg_4_button" type="button" value="Upload Image" /></div>');
					}
					if(bGfields == 5) {
					jQuery('.bGgalleryContainer').append('<div>gallery image: '+bGfields+' <input type="text" id="_tdCore-galleryImg_5" name="_tdCore-galleryImg_5" value="<?php echo $galleryImg5; ?>" /><input id="upload_galleryImg_5_button" type="button" value="Upload Image" /></div>');
					}
					if(bGfields == 6) {
					jQuery('.bGgalleryContainer').append('<div>gallery image: '+bGfields+' <input type="text" id="_tdCore-galleryImg_6" name="_tdCore-galleryImg_6" value="<?php echo $galleryImg6; ?>" /><input id="upload_galleryImg_6_button" type="button" value="Upload Image" /></div>');
					}
					if(bGfields == 7) {
					jQuery('.bGgalleryContainer').append('<div>gallery image: '+bGfields+' <input type="text" id="_tdCore-galleryImg_7" name="_tdCore-galleryImg_7" value="<?php echo $galleryImg7; ?>" /><input id="upload_galleryImg_7_button" type="button" value="Upload Image" /></div>');
					}
					if(bGfields == 8) {
					jQuery('.bGgalleryContainer').append('<div>gallery image: '+bGfields+' <input type="text" id="_tdCore-galleryImg_8" name="_tdCore-galleryImg_8" value="<?php echo $galleryImg8; ?>" /><input id="upload_galleryImg_8_button" type="button" value="Upload Image" /></div>');
					}
					if(bGfields == 9) {
					jQuery('.bGgalleryContainer').append('<div>gallery image: '+bGfields+' <input type="text" id="_tdCore-galleryImg_9" name="_tdCore-galleryImg_9" value="<?php echo $galleryImg9; ?>" /><input id="upload_galleryImg_9_button" type="button" value="Upload Image" /></div>');
					}
					if(bGfields == 10) {
					jQuery('.bGgalleryContainer').append('<div>gallery image: '+bGfields+' <input type="text" id="_tdCore-galleryImg_10" name="_tdCore-galleryImg_10" value="<?php echo $galleryImg10; ?>" /><input id="upload_galleryImg_10_button" type="button" value="Upload Image" /></div>');
					}
			jQuery(".galleryCount > input").val(bGfields);
			}
		});
			
			jQuery('.deleteImgS').click(function() {
				ffield = bGfields - 3;
				chris = bGfields -4;
				rfield = bGfields - 1;
				vfield = bGfields - 1;
				if(vfield == -1) {
					alert('there are no more fields to delete');
					vfield = 0;
					exit();
				}
				jQuery(".galleryCount > input").val(vfield);
			jQuery(".bGgalleryContainer > div:eq("+rfield+")").remove();
			bGfields = bGfields -1 ;
			});
			
			
			fields = jQuery(".slideContainer > div").size();
			jQuery('.addBgGal').click(function() {
			fields = 1+jQuery(".slideContainer > div").size();
			if(fields == 11) {
				alert('You reached the maximum amount of fields for background gallery.');
				exit();
			} else {
				  if(fields == 1) {
					jQuery('.slideContainer').append('<div style="margin-bottom: 15px;">Slide image: '+fields+' <input type="text" id="_tdCore-slideImg_1" name="_tdCore-slideImg_1" value="<?php echo $slideImg1; ?>" /><input id="upload_slideImg_1_button" type="button" value="Upload Image" /><br />Slide link: <input type="text" id="_tdCore-slideLink_1" name="_tdCore-slideLink_1" value="<?php echo $slideLink1; ?>" /> Slide overlaytext: <input type="text" id="_tdCore-slideText_1" name="_tdCore-slideText_1" value="<?php echo $slideText1; ?>" /></div>');
					}
					if(fields == 2) {
					jQuery('.slideContainer').append('<div style="margin-bottom: 15px;">Slide image: '+fields+' <input type="text" id="_tdCore-slideImg_2" name="_tdCore-slideImg_2" value="<?php echo $slideImg2; ?>" /><input id="upload_slideImg_2_button" type="button" value="Upload Image" /><br />Slide link: <input type="text" id="_tdCore-slideLink_2" name="_tdCore-slideLink_2" value="<?php echo $slideLink2; ?>" /> Slide overlaytext: <input type="text" id="_tdCore-slideText_2" name="_tdCore-slideText_2" value="<?php echo $slideText2; ?>" /></div>');
					}
					if(fields == 3) {
					jQuery('.slideContainer').append('<div style="margin-bottom: 15px;">Slide image: '+fields+' <input type="text" id="_tdCore-slideImg_3" name="_tdCore-slideImg_3" value="<?php echo $slideImg3; ?>" /><input id="upload_slideImg_3_button" type="button" value="Upload Image" /><br />Slide link: <input type="text" id="_tdCore-slideLink_3" name="_tdCore-slideLink_3" value="<?php echo $slideLink3; ?>" /> Slide overlaytext: <input type="text" id="_tdCore-slideText_3" name="_tdCore-slideText_3" value="<?php echo $slideText3; ?>" /></div>');
					}
					if(fields == 4) {
					jQuery('.slideContainer').append('<div style="margin-bottom: 15px;">Slide image: '+fields+' <input type="text" id="_tdCore-slideImg_4" name="_tdCore-slideImg_4" value="<?php echo $slideImg4; ?>" /><input id="upload_slideImg_4_button" type="button" value="Upload Image" /><br />Slide link: <input type="text" id="_tdCore-slideLink_4" name="_tdCore-slideLink_4" value="<?php echo $slideLink4; ?>" /> Slide overlaytext: <input type="text" id="_tdCore-slideText_4" name="_tdCore-slideText_4" value="<?php echo $slideText4; ?>" /></div>');
					}
					if(fields == 5) {
					jQuery('.slideContainer').append('<div style="margin-bottom: 15px;">Slide image: '+fields+' <input type="text" id="_tdCore-slideImg_5" name="_tdCore-slideImg_5" value="<?php echo $slideImg5; ?>" /><input id="upload_slideImg_5_button" type="button" value="Upload Image" /><br />Slide link: <input type="text" id="_tdCore-slideLink_5" name="_tdCore-slideLink_5" value="<?php echo $slideLink5; ?>" /> Slide overlaytext: <input type="text" id="_tdCore-slideText_5" name="_tdCore-slideText_5" value="<?php echo $slideText5; ?>" /></div>');
					}
					if(fields == 6) {
					jQuery('.slideContainer').append('<div style="margin-bottom: 15px;">Slide image: '+fields+' <input type="text" id="_tdCore-slideImg_6" name="_tdCore-slideImg_6" value="<?php echo $slideImg6; ?>" /><input id="upload_slideImg_6_button" type="button" value="Upload Image" /><br />Slide link: <input type="text" id="_tdCore-slideLink_6" name="_tdCore-slideLink_6" value="<?php echo $slideLink6; ?>" /> Slide overlaytext: <input type="text" id="_tdCore-slideText_6" name="_tdCore-slideText_6" value="<?php echo $slideText6; ?>" /></div>');
					}
					if(fields == 7) {
					jQuery('.slideContainer').append('<div style="margin-bottom: 15px;">Slide image: '+fields+' <input type="text" id="_tdCore-slideImg_7" name="_tdCore-slideImg_7" value="<?php echo $slideImg7; ?>" /><input id="upload_slideImg_7_button" type="button" value="Upload Image" /><br />Slide link: <input type="text" id="_tdCore-slideLink_7" name="_tdCore-slideLink_7" value="<?php echo $slideLink7; ?>" /> Slide overlaytext: <input type="text" id="_tdCore-slideText_7" name="_tdCore-slideText_7" value="<?php echo $slideText7; ?>" /></div>');
					}
					if(fields == 8) {
					jQuery('.slideContainer').append('<div style="margin-bottom: 15px;">Slide image: '+fields+' <input type="text" id="_tdCore-slideImg_8" name="_tdCore-slideImg_8" value="<?php echo $slideImg8; ?>" /><input id="upload_slideImg_8_button" type="button" value="Upload Image" /><br />Slide link: <input type="text" id="_tdCore-slideLink_8" name="_tdCore-slideLink_8" value="<?php echo $slideLink8; ?>" /> Slide overlaytext: <input type="text" id="_tdCore-slideText_8" name="_tdCore-slideText_8" value="<?php echo $slideText8; ?>" /></div>');
					}
					if(fields == 9) {
					jQuery('.slideContainer').append('<div style="margin-bottom: 15px;">Slide image: '+fields+' <input type="text" id="_tdCore-slideImg_9" name="_tdCore-slideImg_9" value="<?php echo $slideImg9; ?>" /><input id="upload_slideImg_9_button" type="button" value="Upload Image" /><br />Slide link: <input type="text" id="_tdCore-slideLink_9" name="_tdCore-slideLink_9" value="<?php echo $slideLink9; ?>" /> Slide overlaytext: <input type="text" id="_tdCore-slideText_9" name="_tdCore-slideText_9" value="<?php echo $slideText9; ?>" /></div>');
					}
					if(fields == 10) {
					jQuery('.slideContainer').append('<div style="margin-bottom: 15px;">Slide image: '+fields+' <input type="text" id="_tdCore-slideImg_10" name="_tdCore-slideImg_10" value="<?php echo $slideImg10; ?>" /><input id="upload_slideImg_10_button" type="button" value="Upload Image" /><br />Slide link: <input type="text" id="_tdCore-slideLink_10" name="_tdCore-slideLink_10" value="<?php echo $slideLink10; ?>" /> Slide overlaytext: <input type="text" id="_tdCore-slideText_10" name="_tdCore-slideText_10" value="<?php echo $slideText10; ?>" /></div>');
					}
			jQuery(".slideCount > input").val(fields);
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
				jQuery(".slideCount > input").val(vfield);
			jQuery(".slideContainer > div:eq("+rfield+")").remove();
			fields = fields -1 ;
			});
			
	var formfield;
/* BG Image */
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
/* Slider Image */
jQuery('#upload_slideImg_1_button').live('click', function() {
formfield = jQuery('#_tdCore-slideImg_1').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_slideImg_2_button').live('click', function() {
formfield = jQuery('#_tdCore-slideImg_2').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_slideImg_3_button').live('click', function() {
formfield = jQuery('#_tdCore-slideImg_3').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_slideImg_4_button').live('click', function() {
formfield = jQuery('#_tdCore-slideImg_4').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_slideImg_5_button').live('click', function() {
formfield = jQuery('#_tdCore-slideImg_5').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_slideImg_6_button').live('click', function() {
formfield = jQuery('#_tdCore-slideImg_6').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_slideImg_7_button').live('click', function() {
formfield = jQuery('#_tdCore-slideImg_7').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_slideImg_8_button').live('click', function() {
formfield = jQuery('#_tdCore-slideImg_8').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_slideImg_9_button').live('click', function() {
formfield = jQuery('#_tdCore-slideImg_9').attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
jQuery('#upload_slideImg_10_button').live('click', function() {
formfield = jQuery('#_tdCore-slideImg_10').attr('name');
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
	jQuery('#_tdCore-bgColor').ColorPicker({
      	onSubmit:function(hsb, hex, rgb, el) {
      		jQuery(el).val(hex);
      		jQuery(el).ColorPickerHide();
      	},
      	onBeforeShow:function() {
      		jQuery(this).ColorPickerSetColor(this.value);
      	}
      });
 });	
		function showContactFields() {
      if(jQuery("#_tdCore-showContact").val() == "false") {
        jQuery("#tdCore-showContact-table").fadeOut(200);
      } else {
        jQuery("#tdCore-showContact-table").fadeIn();
      }
    }
    function showBgImgField() {
      if(jQuery("#tdCore-bgType").val() == "gallery") {
				jQuery("#tdCore-bgVid-td").fadeOut(200);
        jQuery("#tdCore-bgVid-tr").fadeOut(200);
				jQuery("#tdCore-bgUrl-td").fadeOut(200);
        jQuery("#tdCore-bgUrl-tr").fadeOut(200);
				jQuery("#tdCore-bgMap-td").fadeOut(200);
        jQuery("#tdCore-bgMap-tr").fadeOut(200);
        jQuery("#tdCore-bgImg-tr").fadeIn();
				jQuery("#tdCore-bgImg-td").fadeIn();
      } else if(jQuery("#tdCore-bgType").val() == "video") {
				jQuery("#tdCore-bgImg-td").fadeOut(200);
        jQuery("#tdCore-bgImg-tr").fadeOut(200);
				jQuery("#tdCore-bgUrl-td").fadeOut(200);
        jQuery("#tdCore-bgUrl-tr").fadeOut(200);
				jQuery("#tdCore-bgMap-td").fadeOut(200);
        jQuery("#tdCore-bgMap-tr").fadeOut(200);
				jQuery("#tdCore-bgVid-td").fadeIn();
        jQuery("#tdCore-bgVid-tr").fadeIn();
      } else if(jQuery("#tdCore-bgType").val() == "url") {
				jQuery("#tdCore-bgImg-td").fadeOut(200);
        jQuery("#tdCore-bgImg-tr").fadeOut(200);
				jQuery("#tdCore-bgVid-td").fadeOut(200);
        jQuery("#tdCore-bgVid-tr").fadeOut(200);
				jQuery("#tdCore-bgMap-td").fadeOut(200);
        jQuery("#tdCore-bgMap-tr").fadeOut(200);
				jQuery("#tdCore-bgUrl-td").fadeIn();
        jQuery("#tdCore-bgUrl-tr").fadeIn();
			} else if(jQuery("#tdCore-bgType").val() == "map") {
				jQuery("#tdCore-bgImg-td").fadeOut(200);
        jQuery("#tdCore-bgImg-tr").fadeOut(200);
				jQuery("#tdCore-bgVid-td").fadeOut(200);
        jQuery("#tdCore-bgVid-tr").fadeOut(200);
				jQuery("#tdCore-bgUrl-td").fadeOut(200);
        jQuery("#tdCore-bgUrl-tr").fadeOut(200);
				jQuery("#tdCore-bgMap-td").fadeIn();
        jQuery("#tdCore-bgMap-tr").fadeIn();
			} else {
				jQuery("#tdCore-bgImg-td").fadeIn();
        jQuery("#tdCore-bgImg-tr").fadeIn();
				jQuery("#tdCore-bgVid-td").fadeOut(200);
        jQuery("#tdCore-bgVid-tr").fadeOut(200);
				jQuery("#tdCore-bgUrl-td").fadeOut(200);
        jQuery("#tdCore-bgUrl-tr").fadeOut(200);
				jQuery("#tdCore-bgMap-td").fadeOut(200);
        jQuery("#tdCore-bgMap-tr").fadeOut(200); 
	     }
    }
		function showBrickField() {
      if(jQuery("#_tdCore-brickFormat").val() == "brick6") {
				jQuery('#tdCore-brickVideo-tr').fadeIn();
      } else {
				jQuery('#tdCore-brickVideo-tr').fadeOut(200);
      }
    }
    
  </script>
  <?php
}


/* Update all Post/Page options */
add_action('save_post', 'themeDutchUpdateOptions');
function themeDutchUpdateOptions($post_id) {
	if(!wp_verify_nonce($_POST['theme-dutch_options_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}

	/* Check autosave */
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	/* Check permissions */
	if('page' == $_POST['post_type']) {
		if(!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif(!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
  tdCoreUpdateOptions($post_id);
}

/* Add the options on the Page and Post edit page */
add_action('admin_menu', 'teamDutchAddOptions');
function teamDutchAddOptions() {
  add_meta_box('tdCore_options', 'JAMES PAGE OPTIONS', 'placeSensitiveOptions', 'page', 'normal', 'high');
  add_meta_box('tdCore_options', 'JAMES POST OPTIONS', 'placeSensitivePostOptions', 'post', 'normal', 'high');  
}
?>