<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<?php wp_head(); ?>
	
	<script type="text/javascript">
	<!--
		window.location.hash="";
		if(window.location.hash!="" && window.location.hash!="#"){ 
			var loc = window.location.toString();
			var locRep = loc.replace(/#.*/m,"");
			window.location = locRep;
		}
	-->
	</script>
    
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
    
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<!--[if IE 7]>
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie7.css" />
	<![endif]-->
	
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/reset.css" type="text/css"/>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/screen.css" type="text/css"/>
	
    <style type="text/css" id="imgMaxWidth"></style>
    
	<!-- colors from colorpicker -->
	<style type="text/css">
		<?php $background_color = get_option( 'background_color' ); ?>
        <?php if ( !empty( $background_color ) ) : ?>
            html { background-color: <?php echo $background_color; ?>; }
        <?php endif; ?>
        
        <?php $titles_color = get_option( 'titles_color' ); ?>
        <?php if ( !empty( $titles_color ) ) : ?>
            h1, h2, h3, h4, h5, h6,
            table#wp-calendar caption,
			.mainmenu li a,
			.mainmenu li.current_page_item li a,
			.mainmenu li.current-page-ancestor li a,
			.footer a, .header a,
			.part1 a, .part3 a,
			.sidetabs li span, 
			.service h3 a,
			.sidepost h3 a,
			table#wp-calendar tfoot a,
			.widget_nav_menu li.current_page_item li a,
			.widget_categories .current-cat	li a		{ color: <?php echo $titles_color; ?>; }
        <?php endif; ?>
        
        <?php $decor_lines_color = get_option( 'decor_lines_color' ); ?>
        <?php if ( !empty( $decor_lines_color ) ) : ?>
            .header .decor,
            .footer .decor						{background-color: <?php echo $decor_lines_color; ?>;}
        <?php endif; ?>
        
        <?php $left_box_height = get_option( 'left_box_height' ); ?>
        <?php if ( !empty( $left_box_height ) ) : ?>
            .pgsize1				{height: <?php echo $left_box_height; ?>px;}
        <?php endif; ?>
        
        <?php $center_box_height = get_option( 'center_box_height' ); ?>
        <?php if ( !empty( $center_box_height ) ) : ?>
        <?php if ( $center_box_height != 'auto' ) : ?>
            .pgsize2				{height: <?php echo $center_box_height; ?>px;}
			.box-center				{height: <?php echo $center_box_height; ?>px;}
            <?php
				$scrVal = (int)$center_box_height; 
				$scrVal = $scrVal - 25;
				$scrHeight = (string)$scrVal;
			?>
			#mcs2_container			{height: <?php echo $scrHeight; ?>px;}
		<?php endif; ?>
        <?php endif; ?>
        
        <?php $right_box_height = get_option( 'right_box_height' ); ?>
        <?php if ( !empty( $right_box_height ) ) : ?>
            .pgsize3				{height: <?php echo $right_box_height; ?>px;}
            <?php
				$topSearchVal = (int)$right_box_height;
				$topSearchVal = $topSearchVal - 30;
				$topSearch = (string)$topSearchVal;
			?>
			.sidepost div.search	{top: <?php echo $topSearch; ?>px;}
        <?php endif; ?>
        
        <?php
			// footer width
			$footer_clone_picture = get_option( 'footer_clone_picture' ); 
			if ( !empty( $footer_clone_picture ) ){
				$pictures = json_decode($footer_clone_picture);
				$imgFooterCount = count($pictures); 
				$imgFooterWidth = $imgFooterCount * 98;
        ?>
			#mcs5_container .content	{width:<?php echo $imgFooterWidth; ?>px;}
        <?php } ?>
        
        <?php $right_box_height = get_option( 'right_box_height' ); ?>
        <?php if ( !empty( $right_box_height ) ) : ?>
            .pgsize3				{height: <?php echo $right_box_height; ?>px;}
            <?php 
				$scrVal = (int)$right_box_height; 
				$scrVal = $scrVal - 40;
				$scrHeight = (string)$scrVal;
			?>
			#mcs_container			{height: <?php echo $scrHeight; ?>px;}
        <?php endif; ?>
        
        <?php $default_footer_height = get_option( 'default_footer_height' ); ?>
        <?php if ( !empty( $default_footer_height ) ) : ?>
            .footer				{height: <?php echo $default_footer_height; ?>px;}
            <?php 
				$insVal = (int)$default_footer_height; 
				$insVal = $insVal + 17;
				$insHeight = (string)$insVal;
			?>
			.footer .inside			{height: <?php echo $insHeight; ?>px;}
        <?php else: ?>
			.footer				{height: 90px;}
     
			.footer .inside			{height: 107px;}
        <?php endif; ?>
		
		<?php
		
        	/* Get page ID */
			$queried_object = $wp_query->get_queried_object(); 
			if ( $queried_object->ID == get_option( 'page_for_posts' ) ) {
				$current_id = get_option( 'page_for_posts' ); 
			}
			else { 
				$current_id = $wp_query->post->ID; 
			}
			
			$GLOBALS['set_style'] = "light";
			
			$light_title_color = '';
			$light_subtitles_color = '';
			$light_links_color = '';
			
			$dark_title_color = '';
			$dark_subtitles_color = '';
			$dark_links_color = '';
			
			// global setting
			if (trim(get_option( 'center_box_variant' )) == "dark"){

					$dark_title_color = get_option( 'center_box_dark_title_color' );
					$dark_subtitles_color = get_option( 'center_box_dark_subtitles_color' );
					$dark_links_color = get_option( 'center_box_dark_links_color' );

					$GLOBALS['set_style'] = "dark";
					
			} else if(trim(get_option( 'center_box_variant' )) == "light"){
									
					$light_title_color = get_option( 'center_box_light_title_color' );
					$light_subtitles_color = get_option( 'center_box_light_subtitles_color' );
					$light_links_color = get_option( 'center_box_light_links_color' );

					$GLOBALS['set_style'] = "light";	
			}
			
			// page settings	
			if ( is_single() || is_page() || ($queried_object->ID == get_option( 'page_for_posts' ) ) || is_front_page() ) {
				
				$center_box_bg_variant = get_post_meta( $current_id, 'center_box_bg_variant' );
				$center_box_bg_variant['0'] = trim($center_box_bg_variant['0']);
					
				if($center_box_bg_variant['0'] == 'Dark'){
					
					$dark_title_color = get_option( 'center_box_dark_title_color' );
					$dark_subtitles_color = get_option( 'center_box_dark_subtitles_color' );
					$dark_links_color = get_option( 'center_box_dark_links_color' );

					$GLOBALS['set_style'] = "dark";
					
				} else if($center_box_bg_variant['0'] == 'Light'){
					
					$light_title_color = get_option( 'center_box_light_title_color' );
					$light_subtitles_color = get_option( 'center_box_light_subtitles_color' );
					$light_links_color = get_option( 'center_box_light_links_color' );
					
					$GLOBALS['set_style'] = "light";
				}
			}
			// apply light version
			if($GLOBALS['set_style'] == "light"){
				
				/* echo ".box-center .float	{ background: url(".link_to("wp-content/themes/fullscreen/images/bck_FF-85.png")."); }"; */

				if ($light_links_color!=''){
					echo '.part2 a, .part2 a:hover { color: '.$light_links_color.'; }';
				}
				if ($light_title_color!=''){
					echo '.part2 h1, .part2 h1 a, .part2 h1 a:hover { color: '.$light_title_color.'; }';
				}
				if ($light_subtitles_color!=''){
					echo '.part2 h2, .part2 h3, .part2 h4, .part2 h5, .part2 h6	{ color: '.$light_subtitles_color.'; }';
					echo '.part2 h2 a, .part2 h3 a, .part2 h4 a, .part2 h5 a, .part2 h6 a { color: '.$light_subtitles_color.'; }';
					echo '.part2 h2 a:hover, .part2 h3 a:hover, .part2 h4 a:hover, .part2 h5 a:hover, .part2 h6 a:hover { color: '.$light_subtitles_color.'; }';
					echo '.website-name, .website-name a, .website-name a:hover	{ color: '.$light_subtitles_color.'; }';
				}

			// apply dark version	
			} else if($GLOBALS['set_style'] == "dark"){
				
				/* echo ".box-center .float	{ background: url(".link_to("wp-content/themes/fullscreen/images/bck_00-80.png")."); }"; */
				
				if ($dark_links_color!=''){
					echo '.part2 a, .part2 a:hover { color: '.$dark_links_color.'; }';
				}
				if ($dark_title_color!=''){
					echo '.part2 h1, .part2 h1 a, .part2 h1 a:hover { color: '.$dark_title_color.'; }';
				}
				if ($dark_subtitles_color!=''){
					echo '.part2 h2, .part2 h3, .part2 h4, .part2 h5, .part2 h6	{ color: '.$dark_subtitles_color.'; }';
					echo '.part2 h2 a, .part2 h3 a, .part2 h4 a, .part2 h5 a, .part2 h6 a { color: '.$dark_subtitles_color.'; }';
					echo '.part2 h2 a:hover, .part2 h3 a:hover, .part2 h4 a:hover, .part2 h5 a:hover, .part2 h6 a:hover { color: '.$dark_subtitles_color.'; }';
					echo '.website-name, .website-name a, .website-name a:hover	{ color: '.$dark_subtitles_color.'; }';
				}
				
			}
			// hide center box
			if ( is_single() || is_page() || ($queried_object->ID == get_option( 'page_for_posts' ) ) || is_front_page() ) {	
				$hide_cb_backgroud = get_post_meta( $current_id, 'page_hide_cb_background');
			
				$hide_cb_backgroud['0'] = trim($hide_cb_backgroud['0']);
					

				if($hide_cb_backgroud['0'] == 'yes'){
					echo ".box-center .float	{ background: url(".get_bloginfo('url')."/images/none.gif) !important; }";
					//echo ".box-center .hide-box	{ display: none; }";
				}
			}
			
		?>
		
		.header .logo .title				{color: #FFFFFF;}
		.header .logo .subtitle				{color: #BBBBBB;}
    </style>
    <script type="text/javascript">
		Cufon.replace('h1');
		Cufon.replace('h2');
    </script>
</head>
<?php

if ( ! isset( $content_width ) ) $content_width = 900;
 
?>

<body <?php body_class(); ?>>

<?php 
$cb_height = '';
if ( $center_box_height == 'auto' ) { $cb_height = 'auto'; }
?>
<div id="center-box-height" style="display:none"><?php echo $cb_height; ?></div>

<?php if ( get_option( 'show_themebox' ) ) : ?>

<div id="theme-box">
    <span id="theme-box-closer" class="opened">open/close</span>
    <a href="<?php echo home_url();?>/" id="theme-box-reset" class="not">Reset All</a>
    <a href="http://themeforest.net/user/ait/portfolio" id="theme-box-purchase">Purchase Now</a>
    <a href="http://themeforest.net/user/ait/follow" id="theme-box-follow">Follow Us</a>
    
    <h2>Theme Variant</h2>
    <ul id="themebox-images">
		<li><a href="http://www.ait.sk/fullscreen/wp/" id="theme-1" class="not"><img src="<?php echo get_template_directory_uri()."/images/thumbnail_cars.jpg"; ?>" alt="" /></a></li>
 		<li><a href="http://www.ait.sk/fullscreen/wp2/" id="theme-2" class="not"><img src="<?php echo get_template_directory_uri()."/images/thumbnail_furniture.jpg"; ?>" alt="" /></a></li>
 		<li><a href="http://www.ait.sk/fullscreen/wp3/" id="theme-3" class="not"><img src="<?php echo get_template_directory_uri()."/images/thumbnail_sports.jpg"; ?>" alt="" /></a></li>
    </ul>
    
    <h2>Our other Themes</h2>
    <select id="best-sellers">
	  <option value="select">- please select -</option>
	  <option value="corporate">Corporate</option>
	  <option value="simplicius">Simplicius</option>
	  <option value="universal-business">Universal business</option>
	  <option value="glamorous">Glamorous</option>
	  <option value="trademark">Trademark</option>
	  <option value="fullscreen">Fullscreen</option>
	</select>
     
</div><!-- /#theme-box  -->
<?php endif; ?>

<div class="screen">

<!-- background image -->
<div class="mainpic">
		<?php
			/* get background url from page metadata */
			$background_image_url = get_post_meta( $current_id, 'page_background_image' );
			$background_image_url['0'] = trim($background_image_url['0']);
			
			/* get background url from default value */
			$default_background_image_url = get_option( 'background_image' );
			
			// page setting			
			if(!empty($background_image_url['0'])) {
				echo '<img class="bottom-img" src="'.link_to($background_image_url['0']).'" alt="" />';
			// global setting
			} elseif (!empty( $default_background_image_url )) {
				echo '<img class="bottom-img" src="'.link_to($default_background_image_url).'" alt="" />';
			}
		?>
</div>

<div id="show_hide_content_button" class="show"></div>

<!-- full page -->
<div class="mainpage">

<?php
$blogname = get_option( 'blogname' );
$blogdesc = get_option( 'blogdescription' );
?>

<!-- header -->
<div class="header">
			<div class="inside">
				<div class="logo">
					
					<?php $logo_url = get_option('logo_url'); ?>
						
					<?php if ((get_option('show_logo')) && !(get_option('show_title')) && !empty($logo_url)): ?>
					<!-- 1. version LOGO + SUBTITLE -->
						<a href="<?php echo home_url(); ?>" class="ver1 <?php if(get_option('show_subtitle')) echo "subtit"; ?>">
							<img alt="<?php bloginfo( 'blogname' ); ?>" class="picture" src="<?php echo link_to( $logo_url ); ?>" />
							<span class="texted">
								<?php if(get_option('show_subtitle')): ?><span class="subtitle"><?php echo $blogdesc; ?></span><?php endif; ?>
							</span>
						</a>
					<?php endif; ?>
					
					<?php if ((get_option('show_logo')) && (get_option('show_title')) && !empty($logo_url)): ?>
					<!-- 2. version LOGO + TITLE + SUBTITLE -->
						<a href="<?php echo home_url(); ?>" class="ver2 <?php if(get_option('show_subtitle')) echo "subtit"; ?>">
							<img alt="<?php bloginfo( 'blogname' ); ?>" class="picture" src="<?php echo link_to( $logo_url ); ?>" />
							<span class="texted">
								<span class="title"><?php echo $blogname; ?></span>
								<?php if(get_option('show_subtitle')): ?><span class="subtitle"><?php echo $blogdesc; ?></span><?php endif; ?>
							</span>
						</a>
					<?php endif; ?>
					
					<?php if ((!get_option('show_logo')) && (get_option('show_title'))): ?>
					<!-- 3. version TITLE + SUBTITLE -->
						<a href="<?php echo home_url(); ?>" class="ver3 <?php if(get_option('show_subtitle')) echo "subtit"; ?>">
							<span class="texted">
								<span class="title"><?php echo $blogname; ?></span>
								<?php if(get_option('show_subtitle')): ?><span class="subtitle"><?php echo $blogdesc; ?></span><?php endif; ?>
							</span>
						</a>
					<?php endif; ?>
					
				</div>
			</div>
			<div class="decor"></div>
</div><!-- end of header -->
	
<div class="mainmenu">
			<?php
				$args = array(
				    'theme_location'=> 'main',
				    'link_before'   => '',
				    'link_after'    => '',
				);
				wp_nav_menu( $args ); 
				?>
</div>
		
<!-- central part -->
<div class="central">
	<div class="parts clear">