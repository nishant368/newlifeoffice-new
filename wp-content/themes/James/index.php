<?php get_header(); ?>
<?php 
$HomebgType = get_option('_tdCore-home-bgType');
$homeCat = get_option('_td-homeCat');
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
if($HomebgType == 'bricks') {
/* FUNCTIONS FOR THE BRICKS */
if($homeCat == '' || $homeCat == "-1") { $homeCat = get_all_category_ids(); } ?>
<div id="brick-holder">
<?php
query_posts( 'posts_per_page=-1' ); 
if ( have_posts() ) while ( have_posts() ) : the_post(); 
if ( in_category($homeCat) ) { 
$brickFormat = get_post_meta($post->ID, '_tdCore-brickFormat', true); 
$brickVideo = get_post_meta($post->ID, '_tdCore-brickVideo', true); 
?>
<div class="box <?php echo $brickFormat; ?>">
<?php 
$image_id = get_post_thumbnail_id();  
$image_url = wp_get_attachment_image_src($image_id,'large');  
$image_url = $image_url[0];
switch ($brickFormat) {
    case 'brick1':
        $w = 144;
				$h = 144;
				$shorten = esc_html( get_the_content() );
				$shorten = galleryShorten($shorten, 300, '...');
				$content = '
				<div class="colorInside"></div>
				<a title="'.get_the_title().'" class="lightbox_image" href="'.$image_url.'"></a>
				<div class="boxInside">
				<div class="boxMargin">
				<div class="brickTitle">'.get_the_title().'</div>
				'.$shorten.'
				</div>
				<a class="brickMore" href="'.get_permalink().'"></a>
				</div>';
				$content .= '<img alt="'.get_the_title().'" src="'.get_bloginfo("template_url").'/lib/img.php?f='.$image_url.'&amp;w='.$w.'&amp;h='.$h.'&amp;a=c" />';
        break;
    case 'brick2':
        $w = 294;
				$h = 144;
				$shorten = esc_html( get_the_content() );
				$shorten = galleryShorten($shorten, 300, '...');
				$content = '
				<div class="colorInside"></div>
				<a title="'.get_the_title().'" class="lightbox_image" href="'.$image_url.'"></a>
				<div class="boxInside">
				<div class="boxMargin">
				<div class="brickTitle">'.get_the_title().'</div>
				'.$shorten.'
				</div>
				<a class="brickMore" href="'.get_permalink().'"></a>
				</div>';
				$content .= '<img alt="'.get_the_title().'" src="'.get_bloginfo("template_url").'/lib/img.php?f='.$image_url.'&amp;w='.$w.'&amp;h='.$h.'&amp;a=c" />';
        break;
    case 'brick3':
        $w = 294;
				$h = 294;
				$shorten = esc_html( get_the_content() );
				$shorten = galleryShorten($shorten, 300, '...');
				$content = '
				<div class="colorInside"></div>
				<a title="'.get_the_title().'" class="lightbox_image" href="'.$image_url.'"></a>
				<div class="boxInside">
				<div class="boxMargin">
				<div class="brickTitle">'.get_the_title().'</div>
				'.$shorten.'
				</div>
				<a class="brickMore" href="'.get_permalink().'"></a>
				</div>';
				$content .= '<img alt="'.get_the_title().'" src="'.get_bloginfo("template_url").'/lib/img.php?f='.$image_url.'&amp;w='.$w.'&amp;h='.$h.'&amp;a=c" />';
        break;
		case 'brick4':
        $w = 594;
				$h = 294;
				$shorten = esc_html( get_the_content() );
				$shorten = galleryShorten($shorten, 300, '...');
				$content = '
				<div class="colorInside"></div>
				<a title="'.get_the_title().'" class="lightbox_image" href="'.$image_url.'"></a>
				<div class="boxInside">
				<div class="boxMargin">
				<div class="brickTitle">'.get_the_title().'</div>
				'.$shorten.'
				</div>
				<a class="brickMore" href="'.get_permalink().'"></a>
				</div>';
				$content .= '<img alt="'.get_the_title().'" src="'.get_bloginfo("template_url").'/lib/img.php?f='.$image_url.'&amp;w='.$w.'&amp;h='.$h.'&amp;a=c" />';
        break;
		case 'brick5':
        $w = 144;
				$h = 294;
				$shorten = esc_html( get_the_content() );
				$shorten = galleryShorten($shorten, 300, '...');
				$content = '
				<div class="colorInside"></div>
				<a title="'.get_the_title().'" class="lightbox_image" href="'.$image_url.'"></a>
				<div class="boxInside">
				<div class="boxMargin">
				<div class="brickTitle">'.get_the_title().'</div>
				'.$shorten.'
				</div>
				<a class="brickMore" href="'.get_permalink().'"></a>
				</div>';
				$content .= '<img alt="'.get_the_title().'" src="'.get_bloginfo("template_url").'/lib/img.php?f='.$image_url.'&amp;w='.$w.'&amp;h='.$h.'&amp;a=c" />';
        break;
		case 'brick6':
        $w = 594;
				$h = 294;
				$content = $brickVideo;	
				$content = decodeVideo($content);
				$content .= '<a class="brickMore" href="'.get_permalink().'"></a>';
				$videoOn = true;
        break;
}
echo $content;
?>
</div>
<?php 
}
endwhile; 
?>
</div>
<?php
if($videoOn == true) { $transform = 'false'; } else { $transform = 'true'; }
?>
<script type="text/javascript">
$(function(){ var $container = $('#brick-holder'); $container.isotope({ transformsEnabled: <?php echo $transform; ?>, itemSelector: '.box', masonry: { columnWidth: 150, isFitWidth: true } }); });
</script>
<?php } else if($HomebgType == 'gallery') {
echo '<div id="supersized"></div>';
if($rasterEffect != '') {
	if($rasterEffect != 'off') {
echo '<div class="rasterize" style="background: url(\''.get_template_directory_uri().'/images/'.$rasterEffect.'.png\');"></div>';
	}
}
$galleryCount = get_option('td-galleryCount');
$homeBgGalSpeed = get_option('_td-home-bgGal-speed');
if($homeBgGalSpeed != '') {
$homeBgGalSpeed = $homeBgGalSpeed * 2000;
} else {
$homeBgGalSpeed = '4000';
}
$homeBgGalEffect = get_option('_td-home-bgGalEffect');
if($homeBgGalEffect != '') {
switch ($homeBgGalEffect) {
case "Fade":
$homeBgGalEffect = '1';
break;
case "Slide top":
$homeBgGalEffect = '2';
break;
case "Slide right":
$homeBgGalEffect = '3';
break;
case "Slide bottom":
$homeBgGalEffect = '4';
break;
case "Slide left":
$homeBgGalEffect = '5';
break;
case "Carousel right":
$homeBgGalEffect = '6';
break;
case "Carousel left":
$homeBgGalEffect = '7';
break;
}
} 
else {
$homeBgGalEffect = '1';
}
?>
<script type="text/javascript">		
jQuery(document).ready(function () { jQuery.supersized({ slideshow : 1, autoplay : 1, start_slide : 1, slide_interval : <?php echo $homeBgGalSpeed; ?>, transition : <?php echo $homeBgGalEffect; ?>, transition_speed : 1500, new_window : 1, pause_hover : 0, keyboard_nav : 1, performance : 1, image_protect : 1, image_path : 'img/', min_width : 0, min_height : 0, vertical_center : 1, horizontal_center : 1, fit_portrait : 1, fit_landscape : 0, navigation : 1, thumbnail_navigation : 1, slide_counter : 1, slide_captions : 1, slides : [
<?php
$galLast = $galleryCount - 2;
for ($i = 0; $i <= $galLast; $i++) {
$n = $i+1;
$homeBgGal = get_option('_tdCore-galleryImg_'.$n.'');
?>{image : '<?php echo $homeBgGal; ?>'},  
<?php } $homeBgGalLast = get_option('_tdCore-galleryImg_'.$galleryCount.''); ?>
{image : '<?php echo $homeBgGalLast; ?>'}]}); });
</script>
<?php } else if($HomebgType == 'video') {
	if($rasterEffect != '') {
	if($rasterEffect != 'off') {
echo '<div class="rasterize" style="background: url(\''.get_template_directory_uri().'/images/'.$rasterEffect.'.png\');"></div>';
	}
}
$HomebgVid = get_option('_tdCore-home-bgVid');
?>
<div id="bgholder" style="display:block;">
  <object classid="" codebase="" width="100%" height="100%" id="myfile" align="middle">
    <param name="allowScriptAccess" value="sameDomain" />
    <param name="movie" value="<?php echo get_template_directory_uri(); ?>/tdplayer.swf?moviefile=<?php echo $HomebgVid; ?>&autoplay=1" />
    <param name="quality" value="high" />
    <param name="scale" value="noscale" />
    <param name="bgcolor" value="#000" />
    <param name="wmode" value="transparent" />
    <embed src="<?php echo get_template_directory_uri(); ?>/tdplayer.swf?moviefile=<?php echo $HomebgVid; ?>&autoplay=1" wmode="transparent" quality="high" scale="noscale" bgcolor="#ffffff" width="100%" height="100%" name="myfile" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go
/getflashplayer" />
  </object>
</div>
<?php
}
get_footer(); 
?>