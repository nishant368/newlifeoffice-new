<?php get_header(); ?>
<?php
foreach((get_the_category()) as $category) {
$postcat = $category->cat_ID;
$catname = $category->cat_name;
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
		}
	endif;
endforeach;
switch($count) {
case 'Bricks':
?>
<div id="brick-holder">
<?php query_posts( 'posts_per_page=-1' ); 
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php if ( in_category($catname) ) { ?>
<?php $brickFormat = get_post_meta($post->ID, '_tdCore-brickFormat', true); ?>
<?php $brickVideo = get_post_meta($post->ID, '_tdCore-brickVideo', true); ?>
<div class="box <?php echo $brickFormat; ?>">
<?php 
$image_id = get_post_thumbnail_id();  
$image_url = wp_get_attachment_image_src($image_id,'large');  
$image_url = $image_url[0];
switch ($brickFormat) {
    case 'brick1':
        $w = 150;
				$h = 150;
				$shorten = galleryShorten(get_the_content(), 300, '...');
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
				$content .= '<img src="'.get_template_directory_uri().'/lib/img.php?f='.$image_url.'&amp;w='.$w.'&amp;h='.$h.'&amp;a=c" />';
        break;
    case 'brick2':
        $w = 300;
				$h = 150;
				$shorten = galleryShorten(get_the_content(), 300, '...');
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
				$content .= '<img src="'.get_template_directory_uri().'/lib/img.php?f='.$image_url.'&amp;w='.$w.'&amp;h='.$h.'&amp;a=c" />';
        break;
    case 'brick3':
        $w = 300;
				$h = 300;
				$shorten = galleryShorten(get_the_content(), 700, '...');
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
				$content .= '<img src="'.get_template_directory_uri().'/lib/img.php?f='.$image_url.'&amp;w='.$w.'&amp;h='.$h.'&amp;a=c" />';
        break;
		case 'brick4':
        $w = 600;
				$h = 300;
				$shorten = galleryShorten(get_the_content(), 1500, '...');
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
				$content .= '<img src="'.get_template_directory_uri().'/lib/img.php?f='.$image_url.'&amp;w='.$w.'&amp;h='.$h.'&amp;a=c" />';
        break;
		case 'brick5':
        $w = 150;
				$h = 300;
				$shorten = galleryShorten(get_the_content(), 300, '...');
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
				$content .= '<img src="'.get_template_directory_uri().'/lib/img.php?f='.$image_url.'&amp;w='.$w.'&amp;h='.$h.'&amp;a=c" />';
        break;
		case 'brick6':
        $w = 600;
				$h = 300;
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
endif;
wp_reset_query();
?>
</div>
<?php
if($videoOn == true) { $transform = 'false'; } else { $transform = 'true'; }
?>
<script type="text/javascript">
	$(function(){  
      var $container = $('#brick-holder');
      $container.isotope({
				transformsEnabled: <?php echo $transform; ?>,
        itemSelector: '.box',
				masonry: {
        columnWidth: 150,
				isFitWidth: true
      }
      });  
  });
</script>
<?php
break;
case 'Gallery':
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
}
if($rasterEffect != '') {
	if($rasterEffect != 'off') {
echo '<div class="rasterize" style="background: url(\''.get_template_directory_uri().'/images/'.$rasterEffect.'.png\');"></div>';
	}
}
?>
<?php query_posts( 'posts_per_page=-1' );
$imgEnd = '';
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php if ( in_category($postcat) ) { ?>
<?php
$PagegalleryCount = get_post_meta($post->ID, '_tdCore-galleryCount', true);
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
$shorten = galleryShorten(get_the_content(), 300, '...');
$imageTitle = '<a href=\"'.get_permalink().'\">'.get_the_title().'</a>';
$imageTitle .= '<br />'.$shorten;
$image_id = get_post_thumbnail_id();  
$image_url = wp_get_attachment_image_src($image_id,'large');  
$image_url = $image_url[0];
$imgEnd .= '{ image: "'.$image_url.'", title: "'.$imageTitle.'" }, ';
?>
<?php
}
endwhile;
endif;
wp_reset_query();
$imgEnd = substr($imgEnd,0,-2);
?>
<div id="supersized"></div>
<div id="controls-close"><div class="galleryTooltip">Gallery</div><div id="controls-icon"></div><div id="close-bar"></div></div>
<div id="galleryNav">
<div id="galleryInside">
<div id="prevthumb"></div>

<div id="nextthumb"></div>
<!--Control Bar-->
<div id="controls-wrapper">
	
	<div id="controls">
  <div id="slidecaption"></div>
		<!--Navigation-->
		<div id="navigation">
    <div class="hiddenLink"><?php echo get_template_directory_uri(); ?>/images/</div>
			<img id="prevslide" src="<?php echo get_template_directory_uri(); ?>/images/back_dull.png"/><img id="pauseplay" src="<?php echo get_template_directory_uri(); ?>/images/pause_dull.png"/><img id="nextslide" src="<?php echo get_template_directory_uri(); ?>/images/forward_dull.png"/>
		</div>
	</div>
  
</div>
<!--Slide counter-->
		<div id="slidecounter">
			<span class="slidenumber"></span>/<span class="totalslides"></span>
		</div>
</div>
</div>
<script type="text/javascript">		
jQuery(document).ready(function () { jQuery.supersized({ slideshow : 1, autoplay : 1, start_slide : 1, slide_interval : <?php echo $PageBgGalSpeed; ?>, transition : <?php echo $PageBgGalEffect; ?>, transition_speed : 1500, new_window : 1, pause_hover : 0, keyboard_nav : 1, performance : 1, image_protect : 1, min_width : 0, min_height : 0, vertical_center : 1, horizontal_center : 1, fit_portrait : 1, fit_landscape : 0, navigation : 1, thumbnail_navigation : 1, slide_counter : 1, slide_captions : 1, slides : [
<?php echo $imgEnd; ?>]}); });
</script>
<?php
break;
case 'Posts':
$metaSwitch = get_option('_tdCore-metaSwitch');
if($metaSwitch == '') { $metaSwitch = 'on'; }
?>
<div class="container">
<div class="shadowTop"><h2 class="entry-title"><?php single_cat_title(); ?></h2><div class="clickHide"></div></div>
<div class="content">
<div class="main-content">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php if ( in_category($catname) ) { ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
$image_id = get_post_thumbnail_id();  
$image_url = wp_get_attachment_image_src($image_id,'large');  
$image_url = $image_url[0];
$commentscount = get_comments_number();
$tags_list = get_the_tag_list( '', ', ' );
?>
<div class="entry-content">
<div class="entry-title">
<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
</div>
<?php if($metaSwitch == 'on') { ?>
<div class="entry-bar">
<span class="bar-icon date"></span><span class="bar-float"><?php the_time('M j, Y') ?> | </span><span class="bar-icon author"></span><span class="bar-float"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_link(); ?></a> | </span><span class="bar-icon cat"></span><span class="bar-float"><?php the_category(', ') ?> | </span><span class="bar-icon comment"></span><span class="bar-float"><a href="<?php the_permalink(); ?>#comments"><?php echo $commentscount; ?></a><?php if ( $tags_list ) { ?> | </span><span class="bar-icon tag"></span><span class="bar-float"><?php  echo $tags_list; ?></span><?php } else { echo '</span>'; } ?><span class="clearFloat"></span>
</div>
<?php } ?>
<?php if($image_url != '') { echo '<img class="contentImageFull" src="'.get_template_directory_uri().'/lib/img.php?f='.$image_url.'&w=600&h=200&a=c" />'; } ?>
<?php get_template_part( 'slider' ); ?>
<div class="entry-content-text">
<?php if(get_option('rss_use_excerpt') == 1) {
	the_excerpt('');
} else {
	the_content();
}
?>
<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'tdCore' ), 'after' => '' ) ); ?>
<?php //edit_post_link( __( 'Edit', 'tdCore' ), '<span class="edit-link">', '</span>' ); ?>
</div>
</div>
</div>
<?php require_once(TEMPLATEPATH . '/contact.php'); ?>
<?php comments_template( '', true ); ?>
<?php }
endwhile;
endif;
?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
<div id="nav-below" class="navigation">
<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'tdCore' ) ); ?></div>
<div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'tdCore' ) ); ?></div>
</div>
<?php endif; ?>
<br style="clear: both;" />
</div>
</div>
<div class="contentShadowBottom"></div>
</div>
<?php
break;
case 'Sales';
?>
<div class="container">
<div class="shadowTop"><h2 class="entry-title"><?php single_cat_title(); ?></h2><div class="clickHide"></div></div>
<div class="content">
<div class="main-content">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php if ( in_category($catname) ) { ?>
<?php 
/* GET SALE OPTIONS */
$saleCount = 0;
$salePrice = get_post_meta($post->ID, '_tdCore-salePrice', true);
$saleThumb1 = get_post_meta($post->ID, '_tdCore-saleThumb1', true);
$saleThumb2 = get_post_meta($post->ID, '_tdCore-saleThumb2', true);
$saleThumb3 = get_post_meta($post->ID, '_tdCore-saleThumb3', true);
$saleThumb4 = get_post_meta($post->ID, '_tdCore-saleThumb4', true);
if ($saleThumb1 != '') { $saleCount += 1; } 
if ($saleThumb2 != '') { $saleCount += 1; } 
if ($saleThumb3 != '') { $saleCount += 1; } 
if ($saleThumb4 != '') { $saleCount += 1; } 
if($saleThumb1 != '') { $saleThumb1 = get_template_directory_uri().'/lib/img.php?f='.$saleThumb1.'&w=160&h=160&a=c'; }
if($saleThumb2 != '') { $saleThumb2 = get_template_directory_uri().'/lib/img.php?f='.$saleThumb2.'&w=160&h=160&a=c'; }
if($saleThumb3 != '') { $saleThumb3 = get_template_directory_uri().'/lib/img.php?f='.$saleThumb3.'&w=160&h=160&a=c'; }
if($saleThumb4 != '') { $saleThumb4 = get_template_directory_uri().'/lib/img.php?f='.$saleThumb4.'&w=160&h=160&a=c'; }
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="entry-content">
<div class="entry-title">
<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
</div>
<div class="saleCategory">
<?php if($saleCount > 0) {
$saleCount = 'contentSaleImgOn'; ?>

<div class="saleImgWrap">
<span class="salePrice"><?php echo $salePrice; ?></span>
<div class="saleImages">
<?php 
if($saleThumb1 != '') { echo '<img src='.$saleThumb1.') />'; }
if($saleThumb2 != '') { echo '<img src='.$saleThumb2.') />'; }
if($saleThumb3 != '') { echo '<img src='.$saleThumb3.') />'; }
if($saleThumb4 != '') { echo '<img src='.$saleThumb4.') />'; }
?>
</div>
</div>
<?php } ?>
<div class="entry-content-text <?php echo $saleCount; ?>">
<?php if(get_option('rss_use_excerpt') == 1) {
	the_excerpt('');
} else {
	the_content();
}
?>
<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'tdCore' ), 'after' => '' ) ); ?>
<?php //edit_post_link( __( 'Edit', 'tdCore' ), '<span class="edit-link">', '</span>' ); ?>
</div>
<div class="clearAll"></div>
<span class="readmore"><div class="readmoreButton"><a href="<?php the_permalink(); ?>">Read more..</a></div></span>
<div class="clearAll"></div>
</div>
</div>
<?php }
echo '</div>';
endwhile;
endif;
?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
<div id="nav-below" class="navigation">
<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'tdCore' ) ); ?></div>
<div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'tdCore' ) ); ?></div>
</div>
<?php endif; ?>
<br style="clear: both;" />
</div>
</div>
<div class="contentShadowBottom"></div>
</div>
<?php
break;
}
?>
<?php get_footer(); ?>