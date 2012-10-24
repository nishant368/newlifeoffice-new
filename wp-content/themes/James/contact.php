<?php
if(!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
die('Please do not load this page directly. Thanks!');
}
/* CHECK IF CONTACT FORM SHOULD BE DISPLAYD ON THIS PAGE/POST */
if(get_post_meta($post->ID, '_tdCore-showContact', true) == 'true') {
$contactTitle = get_post_meta($post->ID, '_tdCore-contact-title', true);
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
if(isset($_POST['contact-sent'])) {
if($contactCaptcha == 'false' || md5(strtoupper($_POST['captcha'])) == $_SESSION['captchatxt']) {
$emailTo = get_post_meta($post->ID, '_tdCore-contact-emailto', true);
$subject =  'This message was sent from' . ' ' . get_bloginfo('name') . ' (' . home_url() . ')';
$mailText = $subject . '
------------------------------------------------

';
if(isset($_POST['contact-gender'])) {
$mailText .=  'Gender' . ': ';
if($_POST['contact-gender'] == 'm') {
$mailText .=  'Male' . '
';
} else {
$mailText .=  'Female' . '
';
}
}
if(isset($_POST['contact-name'])) {
$mailText .=  'Name' . ': ' . $_POST['contact-name'] . '
';
}
if(isset($_POST['contact-address'])) {
$mailText .=  'Address' . ': ' . $_POST['contact-address'] . '
';
}
if(isset($_POST['contact-postalcode'])) {
$mailText .=  'Postal code' . ': ' . $_POST['contact-postalcode'] . '
';
}
if(isset($_POST['contact-city'])) {
$mailText .=  'City' . ': ' . $_POST['contact-city'] . '
';
}
if(isset($_POST['contact-country'])) {
$mailText .=  'Country' . ': ' . $_POST['contact-country'] . '
';
}
if(isset($_POST['contact-telephone'])) {
$mailText .=  'Telephone' . ': ' . $_POST['contact-telephone'] . '
';
}
if(isset($_POST['contact-email'])) {
$mailText .=  'E-mail' . ': ' . $_POST['contact-email'] . '
';
}
if(isset($_POST['contact-message'])) {
$mailText .=  'Message' . ':
' . $_POST['contact-message'];
}
$mailText .= '

------------------------------------------------
Powered by Theme Dutch (www.theme-dutch.com)';
$message = '';
$headers = 'From: ' . get_bloginfo('name') . '<' . get_bloginfo('admin_email') . '>' . "\r\n" .
'Reply-To: ' . get_bloginfo('admin_email') . "\r\n" .
'X-Mailer: PHP/' . phpversion();
if(mail($emailTo, $subject, $mailText, $headers)) {
$message =  'Your information has been successfully sent.';
} else {
$message =  'Something went wrong whilst sending your information. Please try again at a later time.';
}
} else {
$message =  'Wrong CAPTCHA code entered.';
}
}
?>
<form method="post" action="#" name="contactform" id="contactform">
<?php
if(trim($contactTitle) != '') {
?>
<h3 id="reply-title"><?php echo $contactTitle; ?></h3>
<?php
}
if(isset($message)) {
?>
<div id="contact-message"><p><?php echo $message; ?></p></div>
<?php
}
?>
<div id="contact-error"><?php echo '<p>Please fill in all required (<span class="required">*</span>) fields.</p>'; ?></div>
<?php
if($showGender == 'true') {
$fSel = (isset($_POST['contact-gender']) == 'f') ? ' checked' : '';
$mSel = ($fSel == '') ? ' checked' : '';
?>
<div class="contact-row">
<div class="contact-label"><?php echo  'Gender'; ?>:</div>
<div class="contact-field"><input type="radio" name="contact-gender" value="m"<?php echo $mSel; ?> /> <?php echo 'Male'; ?><input type="radio" name="contact-gender" value="f"<?php echo $fSel; ?> /> <?php echo  'Female'; ?></div>
</div>
<?php
}
if($showName == 'true') {
?>
<div class="contact-row">
<div class="contact-label"><?php echo  'Name'; ?><?php if($contactNameRequired == 'true') { ?> <span class="required"><span class="required">*</span></span><?php } ?></div>
<div class="contact-field"><input type="text" name="contact-name" value="<?php echo $_POST['contact-name']; ?>"<?php if($contactNameRequired == 'true') { ?> class="required-field"<?php } ?> /></div>
</div>
<?php
}
if($showAddress == 'true') {
?>
<div class="contact-row">
<div class="contact-label"><?php echo  'Address'; ?><?php if($contactAddressRequired == 'true') { ?> <span class="required">*</span><?php } ?></div>
<div class="contact-field"><input type="text" name="contact-address" value="<?php echo $_POST['contact-address']; ?>"<?php if($contactAddressRequired == 'true') { ?> class="required-field"<?php } ?> /></div>
</div>
<?php
}
if($showPostalcode == 'true') {
?>
<div class="contact-row">
<div class="contact-label"><?php echo  'Postal code'; ?><?php if($contactPostalcodeRequired == 'true') { ?> <span class="required">*</span><?php } ?></div>
<div class="contact-field"><input type="text" name="contact-postalcode" value="<?php echo $_POST['contact-postalcode']; ?>"<?php if($contactPostalcodeRequired == 'true') { ?> class="required-field"<?php } ?> /></div>
</div>
<?php
}
if($showCity == 'true') {
?>
<div class="contact-row">
<div class="contact-label"><?php echo  'City'; ?><?php if($contactCityRequired == 'true') { ?> <span class="required">*</span><?php } ?></div>
<div class="contact-field"><input type="text" name="contact-city" value="<?php echo $_POST['contact-city']; ?>"<?php if($contactCityRequired == 'true') { ?> class="required-field"<?php } ?> /></div>
</div>
<?php
}
if($showCountry == 'true') {
?>
<div class="contact-row">
<div class="contact-label"><?php echo  'Country'; ?><?php if($contactCountryRequired == 'true') { ?> <span class="required">*</span><?php } ?></div>
<div class="contact-field"><input type="text" name="contact-country" value="<?php echo $_POST['contact-country']; ?>"<?php if($contactCountryRequired == 'true') { ?> class="required-field"<?php } ?> /></div>
</div>
<?php
}
if($showTelephone == 'true') {
?>
<div class="contact-row">
<div class="contact-label"><?php echo  'Telephone'; ?><?php if($contactTelephoneRequired == 'true') { ?> <span class="required">*</span><?php } ?></div>
<div class="contact-field"><input type="text" name="contact-telephone" value="<?php echo $_POST['contact-telephone']; ?>"<?php if($contactTelephoneRequired == 'true') { ?> class="required-field"<?php } ?> /></div>
</div>
<?php
}
if($showEmail == 'true') {
?>
<div class="contact-row">
<div class="contact-label"><?php echo  'E-mail'; ?><?php if($contactEmailRequired == 'true') { ?> <span class="required">*</span><?php } ?></div>
<div class="contact-field"><input type="text" name="contact-email" value="<?php echo $_POST['contact-email']; ?>"<?php if($contactEmailRequired == 'true') { ?> class="required-field"<?php } ?> /></div>
</div>
<?php
}
if($showMessage == 'true') {
?>
<div class="contact-row">
<div class="contact-label"><?php echo  'Message'; ?><?php if($contactMessageRequired == 'true') { ?> <span class="required">*</span><?php } ?></div>
<div class="contact-field"><textarea name="contact-message" <?php if($contactMessageRequired == 'true') { ?> class="required-field"<?php } ?>><?php echo $_POST['contact-message']; ?></textarea></div>
</div>
<?php
}
if($contactCaptcha == 'true') {
?>
<div class="contact-row">
<div class="contact-field"><img src="<?php echo get_template_directory_uri(); ?>/lib/captcha/captcha.php" style="margin:2px 16px 0 0; float:left;" /><input style="float: left;" type="text" name="captcha" value="" class="required-field" /></div>
</div>
<?php } ?>
<div class="contact-row">
<div class="contact-label"><input type="hidden" name="contact-sent" value="1" />&nbsp;</div>
<div class="contact-field"><a href="javascript:void(0)"  class="contact-submit tdN-button sws_btn_black sws_btn_black_bg" id="sws-button18"><span><?php echo  'Submit'; ?></span></a></div>
</div>
<div class="floatfix"></div>
</form>
<?php
}
?>