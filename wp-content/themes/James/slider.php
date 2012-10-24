<?php
$slideHeight = get_post_meta($post->ID, '_tdCore-slideHeight', true);
if($slideHeight == '') {
	$slideHeight = 290;
}
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
	if ($slideCount == '') {
	} else if ($slideCount == 0) {
	} else {
?>
<div id='coin-slider-<?php echo $post->ID; ?>'>
<?php
$count = $slideCount;
		  for ($i = 1; $i <= $count; $i++) {
			  $n = $i;
				$slideImg = get_post_meta($post->ID, '_tdCore-slideImg_'.$n.'', true);
				$slideLink = get_post_meta($post->ID, '_tdCore-slideLink_'.$n.'', true);
				$slideText = get_post_meta($post->ID, '_tdCore-slideText_'.$n.'', true);
				echo "<a href=\"".$slideLink."\"><img src=\"".$slideImg."\"><span>".$slideText."</span></a>";
		  }
?>
</div>
<?php } ?>
<script type="text/javascript">
jQuery(document).ready(function() {	
	/* Slider */
	$('#coin-slider-<?php echo $post->ID; ?>').coinslider({ height: <?php echo $slideHeight; ?>, width: 600 });
});
</script>