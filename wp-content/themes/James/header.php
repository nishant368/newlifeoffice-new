<?php session_start(); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<title><?php global $page, $paged; wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>
<?php
echo '<meta name="description" content="' . get_bloginfo ( 'description' ) . '" />';
$style = get_option('_tdCore-style');
$style = strtolower($style);
if($style == '') {$style = 'black';} 
$pFont = get_option('_tdCore-p-font');
$hFont = get_option('_tdCore-h-font');
$pFontjs = $pFont;
$hFontjs = $hFont;
if ($pFont == 'Cabin Sketch') { $pFontjs = 'Cabin Sketch:bold'; }
if ($hFont == 'Cabin Sketch') { $hFontjs = 'Cabin Sketch:bold'; }
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
$favicon = get_option('_tdCore-favicon');
$hoverColor = get_option('_td-hoverColor');
?>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php if($favicon != '') { ?><link rel="icon" href="<?php echo $favicon; ?>"><?php } ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/<?php echo $style; ?>.css" type="text/css" media="screen" />
<style type="text/css"> a:hover, li a:hover, #footer a:hover, .saleCategory.odd a:hover { color: #<?php echo $hoverColor; ?>; } .wf-active p, .textwidget, .copyright, .copyright a, .contact-label, .contact-field, input[type="submit"], #contact-submit, #searchsubmit, .entry-meta, .entry-utility, #nav-below, a, #cboxTitle, #cboxCurrent, li, #author-description, .recentcomments, .cs-title, body { font-family: '<?php echo $pFont; ?>', calibri; } .wf-active h1, h2, h3, h4, h5, h6, .menu-header a, .menu-footer a, .blog-date, .comment-cloud, .homeTitle, #td-dropcap, h1 a, p.intro-text { font-family: '<?php echo $hFont; ?>', calibri; } h1 { font-size: <?php echo $fontH1; ?>; } h2 { font-size: <?php echo $fontH2; ?>; } h3, h3#comments-title, h3#reply-title { font-size: <?php echo $fontH3; ?>; } h4 { font-size: <?php echo $fontH4; ?>; } h5 { font-size: <?php echo $fontH5; ?>; } h6 { font-size: <?php echo $fontH6; ?>; } p, ul li, li, a, .menu-footer ul li a { font-size: <?php echo $fontP; ?>; } .menu-header a { font-size: <?php echo $fontMenu; ?>; } .copyright a { font-size: <?php echo $fontCopy; ?>; } .headerUrl { font-size: <?php echo $fontLogo; ?>; } </style>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
if ( is_singular() && get_option( 'thread_comments' ) )
wp_enqueue_script( 'comment-reply' );
wp_deregister_script('jquery');
wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"), false, '1.5');
wp_enqueue_script('jquery');
wp_head();
?>
<script type="text/javascript">
WebFontConfig = { google: { families: [ '<?php echo $pFontjs ?>' , '<?php echo $hFontjs ?>' ] } }; (function() { var wf = document.createElement('script'); wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js'; wf.type = 'text/javascript'; wf.async = 'true'; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(wf, s); })();
</script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/main.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/functions.min.js"></script>
<script type="text/javascript">Galleria.loadTheme("<?php echo get_template_directory_uri(); ?>/js/gl/themes/classic/galleria.classic.js");</script>
<script type="text/javascript">var themeDir = "<?php echo get_template_directory_uri(); ?>";</script>
</head>
<body <?php body_class(); ?>>
<div class="inputColor"></div>
<div class="inputHoverColor"></div>