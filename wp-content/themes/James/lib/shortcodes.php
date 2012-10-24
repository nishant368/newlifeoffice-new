<?php
@ini_set('pcre.backtrack_limit', 500000);


remove_filter('the_content',	'wpautop');
remove_filter('the_content',	'wptexturize');
add_filter('the_content', 'teamDutchShortcodeConverter', 99);

/* Shortcode conversion functions */
function teamDutchButton($atts, $content = null) {
  extract(shortcode_atts(array(
    'link' => '#',
    'target' => ''
  ), $atts));
	$target = ($target == 'blank' || $target == 'parent' || $target == 'self' || $target == 'top') ? $target : '';
	$target = ($target == 'blank') ? ' target="_blank"' : $target;
	$target = ($target == 'parent') ? ' target="_parent"' : $target;
	$target = ($target == 'self') ? ' target="_self"' : $target;
	$target = ($target == 'top') ? ' target="_top"' : $target;
	$out = '<a' .$target. ' class="td-button" href="' . $link . '"><span>' . do_shortcode($content) . '</span></a>';
  return $out;
}
add_shortcode('button', 'teamDutchButton');

function teamDutchTDLink( $atts, $content = null ) {
  extract(shortcode_atts(array(
    'link' => '#',
	  'target'  => ''
  ), $atts));
	$target = ($target == 'blank' || $target == 'parent' || $target == 'self' || $target == 'top') ? $target : '';
	$target = ($target == 'blank') ? ' target="_blank"' : $target;
	$target = ($target == 'parent') ? ' target="_parent"' : $target;
	$target = ($target == 'self') ? ' target="_self"' : $target;
	$target = ($target == 'top') ? ' target="_top"' : $target;
	$out = '<a' .$target. ' class="td-link" href="' .$link. '">' .do_shortcode($content). '</a>';
  return $out;
}
add_shortcode('td_link', 'teamDutchTDLink');

function teamDutchDownloadLink( $atts, $content = null ) {
  extract(shortcode_atts(array(
    'link' => '#'
  ), $atts));
	$out = '<a class="download-link" href="' .$link. '">' .do_shortcode($content). '</a>';  
  return $out;
}
add_shortcode('download_link', 'teamDutchDownloadLink');

function teamDutchEmailLink( $atts, $content = null ) {
  extract(shortcode_atts(array(
    'email' => '#',
	  'variation' => ''
  ), $atts));
	$out = '<a class="email-link" href="mailto:' . $email . '">' .do_shortcode($content). '</a>';
  return $out;
}
add_shortcode('email_link', 'teamDutchEmailLink');

function teamDutchDownloadBox( $atts, $content = null ) {
  return '<div class="download-box">' . do_shortcode($content) . '</div>';
}
add_shortcode('download_box', 'teamDutchDownloadBox');

function teamDutchInfoBox( $atts, $content = null ) {
  return '<div class="info-box">' . do_shortcode($content) . '</div>';
}
add_shortcode('info_box', 'teamDutchInfoBox');

function teamDutchTDTitledBox( $atts, $content = null ) {
	extract(shortcode_atts(array(
    'title' => ''
  ), $atts));
	$out .= '<div class="td-titled-box">';
	$out .= '<h4 class="td-titled-box-header">' .$title. '</h4>';
	$out .= '<div class="td-titled-box-content">';
	$out .= do_shortcode($content);
	$out .= '</div>';
	$out .= '</div>';
	return $out;
}
add_shortcode('td_titled_box', 'teamDutchTDTitledBox');

function teamDutchHeaderBox( $atts, $content = null ) {
	extract(shortcode_atts(array(
    'title' => ''
  ), $atts));
	$out .= '<div class="box">';
	$out .= '<h6 class="box-header' .$style. '"><span>' .$title. '</span></h6>';
	$out .= '<div class="box-content">';
	$out .= do_shortcode($content);
	$out .= '</div>';
	$out .= '</div>';
	return $out;
}
add_shortcode('header_box', 'teamDutchHeaderBox');

//LIST ITEMS//
function teamDutchCheckList( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="check-list">', do_shortcode($content));
	$content = str_replace('<li>', '<li>', do_shortcode($content));
	return $content;
}
add_shortcode('check_list', 'teamDutchCheckList');

function teamDutchBulletList( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="bullet-list">', do_shortcode($content));
	return $content;	
}
add_shortcode('bullet_list', 'teamDutchBulletList');

function teamDutchBarcodeBlackList( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="barcode-black-list">', do_shortcode($content));
	return $content;	
}
//barcode//
add_shortcode('barcode_black_list', 'teamDutchBarcodeBlackList');

function teamDutchBarcodeRedList( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="barcode-red-list">', do_shortcode($content));
	return $content;	
}
add_shortcode('barcode_red_list', 'teamDutchBarcodeRedList');

function teamDutchBarcodeGreenList( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="barcode-green-list">', do_shortcode($content));
	return $content;	
}
add_shortcode('barcode_green_list', 'teamDutchBarcodeGreenList');

function teamDutchBarcodeBlueList( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="barcode-blue-list">', do_shortcode($content));
	return $content;	
}
add_shortcode('barcode_blue_list', 'teamDutchBarcodeBlueList');

function teamDutchBarcodeOrangeList( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="barcode-orange-list">', do_shortcode($content));
	return $content;	
}
add_shortcode('barcode_orange_list', 'teamDutchBarcodeOrangeList');

//chat//
function teamDutchChatBlackList( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="chat-black-list">', do_shortcode($content));
	return $content;	
}
add_shortcode('chat_black_list', 'teamDutchChatBlackList');

function teamDutchChatRedList( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="chat-red-list">', do_shortcode($content));
	return $content;	
}
add_shortcode('chat_red_list', 'teamDutchChatRedList');

function teamDutchChatGreenList( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="chat-green-list">', do_shortcode($content));
	return $content;	
}
add_shortcode('chat_green_list', 'teamDutchChatGreenList');

function teamDutchChatBlueList( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="chat-blue-list">', do_shortcode($content));
	return $content;	
}
add_shortcode('chat_blue_list', 'teamDutchChatBlueList');

function teamDutchChatOrangeList( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="chat-orange-list">', do_shortcode($content));
	return $content;	
}
add_shortcode('chat_orange_list', 'teamDutchChatOrangeList');

//chat//
function teamDutchCheckBlackList( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="check-black-list">', do_shortcode($content));
	return $content;	
}
add_shortcode('check_black_list', 'teamDutchCheckBlackList');

function teamDutchCheckRedList( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="check-red-list">', do_shortcode($content));
	return $content;	
}
add_shortcode('check_red_list', 'teamDutchCheckRedList');

function teamDutchCheckGreenList( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="check-green-list">', do_shortcode($content));
	return $content;	
}
add_shortcode('check_green_list', 'teamDutchCheckGreenList');

function teamDutchCheckBlueList( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="check-blue-list">', do_shortcode($content));
	return $content;	
}
add_shortcode('check_blue_list', 'teamDutchCheckBlueList');

function teamDutchCheckOrangeList( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="check-orange-list">', do_shortcode($content));
	return $content;	
}
add_shortcode('check_orange_list', 'teamDutchCheckOrangeList');

//link//
function teamDutchLinkBlackList( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="link-black-list">', do_shortcode($content));
	return $content;	
}
add_shortcode('link_black_list', 'teamDutchLinkBlackList');

function teamDutchLinkRedList( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="link-red-list">', do_shortcode($content));
	return $content;	
}
add_shortcode('link_red_list', 'teamDutchLinkRedList');

function teamDutchLinkGreenList( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="link-green-list">', do_shortcode($content));
	return $content;	
}
add_shortcode('link_green_list', 'teamDutchLinkGreenList');

function teamDutchLinkBlueList( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="link-blue-list">', do_shortcode($content));
	return $content;	
}
add_shortcode('link_blue_list', 'teamDutchLinkBlueList');

function teamDutchLinkOrangeList( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="link-orange-list">', do_shortcode($content));
	return $content;	
}
add_shortcode('link_orange_list', 'teamDutchLinkOrangeList');

//link//
function teamDutchMapBlackList( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="map-black-list">', do_shortcode($content));
	return $content;	
}
add_shortcode('map_black_list', 'teamDutchMapBlackList');

function teamDutchMapRedList( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="map-red-list">', do_shortcode($content));
	return $content;	
}
add_shortcode('map_red_list', 'teamDutchMapRedList');

function teamDutchMapGreenList( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="map-green-list">', do_shortcode($content));
	return $content;	
}
add_shortcode('map_green_list', 'teamDutchMapGreenList');

function teamDutchMapBlueList( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="map-blue-list">', do_shortcode($content));
	return $content;	
}
add_shortcode('map_blue_list', 'teamDutchMapBlueList');

function teamDutchMapOrangeList( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="map-orange-list">', do_shortcode($content));
	return $content;	
}
add_shortcode('map_orange_list', 'teamDutchMapOrangeList');

//LIST ITEMS//


function teamDutchToggleContent( $atts, $content = null ) {
	extract(shortcode_atts(array(
    'title' => ''
  ), $atts));	
	$out .= '<h4 class="toggle"><a href="javascript:;">' .$title. '</a></h4>';
	$out .= '<div class="toggle-content" style="display: none;">';
	$out .= do_shortcode($content);
	$out .= '</div>';	
  return $out;
}
add_shortcode('toggle', 'teamDutchToggleContent');

function teamDutchToggleFramedContent( $atts, $content = null ) {
	extract(shortcode_atts(array(
    'title' => ''
  ), $atts));	
	$out .= '<div class="toggle-frame">';
	$out .= '<h4 class="toggle"><a href="javascript:;">' .$title. '</a></h4>';
	$out .= '<div class="toggle-content" style="display: none;">';
	$out .= '<div class="block">';
	$out .= do_shortcode($content);
	$out .= '</div>';
	$out .= '</div>';
	$out .= '</div>';
	return $out;
}
add_shortcode('toggle_framed', 'teamDutchToggleFramedContent');

function teamDutchFramedTabsSet($atts, $content = null) {
	extract(shortcode_atts(array(), $atts));
	$out .= '[raw]<div class="framed-tab-set">[/raw]';
	$out .= '<ul class="tabs">';
	foreach ($atts as $tab) {
		$out .= '<li><a href="javascript:;">' .$tab. '</a></li>';
	}
	$out .= '</ul>';
	$out .= do_shortcode($content) .'[raw]</div>[/raw]';	
	return $out;
}
add_shortcode('framed_tabs', 'teamDutchFramedTabsSet');

function teamDutchCustomTabs( $atts, $content = null ) {
	extract(shortcode_atts(array(), $atts));	
	$out .= '[raw]<div class="tab-content">[/raw]' . do_shortcode($content) .'</div>';
	return $out;
}
add_shortcode('tab', 'teamDutchCustomTabs');

function teamDutchContactInfo($atts) {
	extract(shortcode_atts(array(
	  'name' => '',
		'address' => '',
		'city' => '',
		'state' => '',
		'zip' => '',
		'phone' => '',
		'email' => ''		
  ), $atts));
	$out .= '[raw]';
	$out .= '<span class="contact-widget-name">' .$name. '</span><br />';
	$out .= '<span class="contact-widget-address">' .$address. '</span><br />';
	$out .= '<span class="contact-widget-city">' .$city. ',&nbsp;' .$state. '</span>&nbsp;';
	$out .= '<span class="contact-widget-zip">' .$zip. '</span><br />';
	$out .= '<span class="contact-widget-phone">' .$phone. '</span><br />';
	$out .= '<span class="contact-widget-email"><a href="mailto:' . $email . '" class="email-widget">' . $email. '</a></span><br />';
	$out .= '[/raw]';
	return $out;	
}
add_shortcode('contact_info', 'teamDutchContactInfo');

function teamDutchDropcap1( $atts, $content = null ) {
   return '<span class="dropcap1">' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap1', 'teamDutchDropcap1');

function teamDutchDropcap2( $atts, $content = null ) {
   return '<span class="dropcap2">' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap2', 'teamDutchDropcap2');

function teamDutchDropcap3( $atts, $content = null ) {
   return '<span class="dropcap3">' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap3', 'teamDutchDropcap3');

function teamDutchPullquoteRight( $atts, $content = null ) {
   return '<span class="pullquote-right">' . do_shortcode($content) . '</span>';
}
add_shortcode('pullquote_right', 'teamDutchPullquoteRight');

function teamDutchPullquoteLeft( $atts, $content = null ) {
   return '<span class="pullquote-left">' . do_shortcode($content) . '</span>';
}
add_shortcode('pullquote_left', 'teamDutchPullquoteLeft');

function teamDutchOneThird( $atts, $content = null ) {
   return '<div class="one-third">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'teamDutchOneThird');

function teamDutchOneThirdLast( $atts, $content = null ) {
   return '<div class="one-third last">' . do_shortcode($content) . '</div><div class="floatfix"></div>';
}
add_shortcode('one_third_last', 'teamDutchOneThirdLast');

function teamDutchTwoThird( $atts, $content = null ) {
   return '<div class="two-third">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_third', 'teamDutchTwoThird');

function teamDutchTwoThirdLast( $atts, $content = null ) {
   return '<div class="two-third last">' . do_shortcode($content) . '</div><div class="floatfix"></div>';
}
add_shortcode('two_third_last', 'teamDutchTwoThirdLast');

function teamDutchOneHalf( $atts, $content = null ) {
   return '<div class="one-half">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'teamDutchOneHalf');

function teamDutchOneHalfLast( $atts, $content = null ) {
   return '<div class="one-half last">' . do_shortcode($content) . '</div><div class="floatfix"></div>';
}
add_shortcode('one_half_last', 'teamDutchOneHalfLast');

//Fourth, fifth and sixth//
function teamDutchOneFourth( $atts, $content = null ) {
   return '<div class="one-fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'teamDutchOneFourth');

function teamDutchOneFourthLast( $atts, $content = null ) {
   return '<div class="one-fourth last">' . do_shortcode($content) . '</div><div class="floatfix"></div>';
}
add_shortcode('one_fourth_last', 'teamDutchOneFourthLast');

function teamDutchOneFifth( $atts, $content = null ) {
   return '<div class="one-fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fifth', 'teamDutchOneFifth');

function teamDutchOneFifthLast( $atts, $content = null ) {
   return '<div class="one-fifth last">' . do_shortcode($content) . '</div><div class="floatfix"></div>';
}
add_shortcode('one_fifth_last', 'teamDutchOneFifthLast');

function teamDutchOneSixth( $atts, $content = null ) {
   return '<div class="one-sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 'teamDutchOneSixth');

function teamDutchOneSixthLast( $atts, $content = null ) {
   return '<div class="one-sixth last">' . do_shortcode($content) . '</div><div class="floatfix"></div>';
}
add_shortcode('one_sixth_last', 'teamDutchOneSixthLast');


function teamDutchImage($atts) {
	extract(shortcode_atts(array(
	  	'src' => '',
		'width' => '',
		'height' => '',
		'title' => ''
  	), $atts));
	if($width == '' && $height == '')
		return "<img src='$src' alt='$title' />";

	$theme = get_template_directory_uri();
	$out = "<a href='$src' class='lightbox_image' title='$title'><img src='$theme/lib/imgthumb.php?src={$src}&h={$height}&w={$width}' title='$title' alt='$title' class='lightbox_thumb' /></a>";

	return $out;
}
add_shortcode('image', 'teamDutchImage');

$numLocalGallery = 0;
function teamDutchGalleryImage($atts, $content = null) {
	global $numLocalGallery;
	extract(shortcode_atts(array(
	  'transition' => 'fade',
		'width' => '800',
		'height' => '400',
		'autoplay' => 'false'
  	), $atts));

	$ID = "lb_gallary_".$numLocalGallery;
	$numLocalGallery += 1;

	$imgs = strip_tags(do_shortcode($content), '<img>');
	$imgs = str_replace(array("\r\n", "\n"), '', $imgs);
	
	$height += 42;

	$out = "<div width='100%' style='overflow: hidden;'><div id='$ID'>$imgs</div></div>
			<script type='text/javascript'>
				var $ID = jQuery('#$ID').galleria({height:$height, width: $width, transition: '$transition', autoplay: $autoplay});
			</script>
			";
	
	return str_replace(array("\r\n", "\n"), '', $out);
}
add_shortcode('image_gallery', 'teamDutchGalleryImage');

$numLocalVideo = 0;
function teamDutchLightboxLocalVideo($atts, $content = 'video') {
	global $numLocalVideo;

	extract(shortcode_atts(array(
	  	'src' => '',
		'width' => '',
		'height' => '',
		'title' => ''
  	), $atts));

	$videoID = "inline_video".$numLocalVideo;
	$numLocalVideo += 1;

	$theme = get_template_directory_uri();

	$out .= "
	<a class='lightbox_video' href='#' onclick=\"jQuery.colorbox({href:'#$videoID', inline:true, title: '$title', width:$width + 40, height:$height + 70}); return false;\">$content</a>
	<div style='display:none'>
		<div id='$videoID' style='background:#fff;'>
			<object id='lb_$videoID' ></object>
        <script type='text/javascript'>
        var params = {};
        var attrs = {};
        var flashvars = {};
        attrs.id = '#lb_$videoID';
        flashvars.moviefile = encodeURIComponent('$src');
        flashvars.autoplay = 1;
        flashvars.wmode = 'transparent';
        params.moviefile = encodeURIComponent('$src');
        params.autoplay = 1;
        params.wmode = 'transparent';
        var swf_file = '$theme/tdplayer.swf';
        swfobject.embedSWF(swf_file, 'lb_$videoID', $width, $height, '9', false, flashvars, params, attrs);
        </script>
		</div>
	</div>";
	return $out;
}

function teamDutchVideo($atts, $content = 'video') {
	extract(shortcode_atts(array(
	  'src' => '',
		'width' => '',
		'height' => '',
		'title' => '',
		'thumb_src' => '',
		'video_src' => ''
  	), $atts));

	if($src == '') $src = $video_src;

	if (strpos($src, 'youtube.com') !== false) {
		if (strpos($src, '/watch?v=') !== false) {
			$src = str_replace('/watch?v=', '/v/', $src);
		}
	}
	elseif (strpos($src, 'vimeo.com') !== false) {
		if (strpos($src, 'player.vimeo.com/video/') === false) {
			$src = str_replace('vimeo.com/', 'player.vimeo.com/video/', $src);
		}
	}

	$video_src = $src;

	if($thumb_src != '' && $video_src != ''){
		return "<img src='$thumb_src?video=$video_src' />";
	}

	$type = substr($src, -4);
	if( in_array($type, array('.flv', '.f4v', '.mp4', '.mov')) ) {
		return teamDutchLightboxLocalVideo($atts, $content);
	} else {
		$out .= "<a class='lightbox_video' href='#' onclick=\"jQuery.colorbox({href:'$src', title: '$title', iframe:true, innerWidth:$width, innerHeight:$height}); return false;\">$content</a>";
		return $out;
	}
}
add_shortcode('video', 'teamDutchVideo');

function teamDutchVideoGallery($atts, $content = 'video') {
	global $numLocalGallery;

	extract(shortcode_atts(array(
		'width' => '800',
		'height' => '400',
		'autoplay' => 'false'
  	), $atts));

	$ID = "frame_gallary_".$numLocalGallery;

	$imgs = strip_tags(do_shortcode($content), '<img>');
	$imgs = str_replace(array("\r\n", "\n"), '', $imgs);

	$out .= "<div width='100%' style='overflow: hidden;'><div id='$ID'>$imgs</div></div>
			<script type='text/javascript'>
				jQuery('#$ID').galleria({
       				width: $width,
					height: $height,
					transition: 'fade'
    			});
				var gl = Galleria.get($numLocalGallery);
				gl.bind( Galleria.IMAGE, function() {showGalleryFrame('$ID');} );
			</script>
			";
	$numLocalGallery += 1;
	return $out;
}
add_shortcode('video_gallery', 'teamDutchVideoGallery');

function teamDutchDividerLarge( $atts ) {
  return '<div class="divider-896"></div>';
}
add_shortcode('divider_large', 'teamDutchDividerLarge');

function teamDutchDividerLargeWhite( $atts ) {
  return '<div class="divider-896-white"></div>';
}
add_shortcode('divider_large_white', 'teamDutchDividerLargeWhite');

function teamDutchDividerLargeGray( $atts ) {
  return '<div class="divider-896-gray"></div>';
}
add_shortcode('divider_large_gray', 'teamDutchDividerLargeGray');


function teamDutchDividerShort( $atts ) {
  return '<div class="divider-550"></div>';
}
add_shortcode('divider_short', 'teamDutchDividerShort');

function teamDutchDividerShortWhite( $atts ) {
  return '<div class="divider-550-white"></div>';
}
add_shortcode('divider_short_white', 'teamDutchDividerShortWhite');

function teamDutchDividerShortGray( $atts ) {
  return '<div class="divider-550-gray"></div>';
}
add_shortcode('divider_short_gray', 'teamDutchDividerShortGray');
?>