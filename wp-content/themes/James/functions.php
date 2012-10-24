<?php
require_once('lib/theme_options.php');
require_once('lib/post_options.php');
require_once 'lib/seo/plugin.php';
if(is_admin()){
wp_enqueue_style('advertise', 'http://www.theme-dutch.com/advertise/tdadvertise.css',array(),'1.0.0');
}
add_action( 'after_setup_theme', 'tdCore_setup' );
if ( ! isset( $content_width ) ) $content_width = 900;
if ( ! function_exists( 'tdCore_setup' ) ):
function tdCore_setup() {
add_editor_style();
add_theme_support( 'post-thumbnails' );
add_theme_support('automatic-feed-links');
load_theme_textdomain( 'tdCore', TEMPLATEPATH . '/languages' );
$locale = get_locale();
$locale_file = TEMPLATEPATH . "/languages/$locale.php";
if ( is_readable( $locale_file ) )
require_once( $locale_file );
register_nav_menus( array(
'primary' => __( 'Main navigation', 'tdCore' ),
) );
register_nav_menus( array(
'footer' => __( 'Secondary menu', 'tdCore' ),
) );
}
endif;
//--SWS IN A THEME--------------------------------------------------------------------------------------------------------------------
if(!defined('WPCSS')):
define('WPCSS','1.0.2'); 
define('WPCSS_PATH', dirname( __FILE__ ). "/lib/shortcodes/" ); 
define("WPCSS_URL", get_stylesheet_directory_uri() . '/lib/shortcodes/' );
require_once 'lib/shortcodes.php';
require_once('lib/shortcodes/tinymce.php');
//prevent a php fatal error is the plugin is activated in combination with the theme.
require WPCSS_PATH.'styles-with-shortcodes.php';
global $sws_plugin;
$sws_plugin = new custom_shortcode_styling();
$sws_plugin->plugins_loaded();
//-- SWS Bundle Installation script:---------------------------------
function sws_install(){
global $bundle;
require_once WPCSS_PATH.'includes/bundle.php';	
require_once WPCSS_PATH.'includes/class.ImportExport.php';
require_once WPCSS_PATH.'includes/class.CSShortcodes.php';
CSShortcodes::init_taxonomy();
CSShortcodes::init_post_type();
$o = new ImportExport(); 
$o->import_bundle($bundle,$error);
return true;
}
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
//workaround until finding a hook for activation of themes.
sws_install();
}
//-------------------------------------------------------- 
endif;
//--------------------------------------------------------------------------------------------------------------------
function tdCore_page_menu_args( $args ) {
$args['show_home'] = true;
return $args;
}
// Add hometype most likely used in bricks for homepage
add_filter('body_class','homeType');
function homeType($classes) {
	// Add the class when needed
	$HomebgType = get_option('_tdCore-home-bgType');
	$iC = '';
	$end = '';
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
    foreach($categories as $cat):
		$iC++;
        if($cat->name != ''):
						if($end == $cat->cat_ID) {
						$catname = $cat->name;
						$count = get_option('portfolioType'.$iC);
						$count = strtolower($count);
						$classes[] = 'body-'.$count;
						}
				endif;
    endforeach;
	if(is_front_page()) {
	$classes[] = 'body-'.$HomebgType;
	}
	return $classes;
}
add_filter( 'wp_page_menu_args', 'tdCore_page_menu_args' );
function tdCore_excerpt_length( $length ) {
return 60;
}
add_filter( 'excerpt_length', 'tdCore_excerpt_length' );
function tdCore_continue_reading_link() {
return ' <a href="'. get_permalink() . '">' . __( 'Read more', 'tdCore' ) . '</a>';
}
function tdCore_auto_excerpt_more( $more ) {
return ' &hellip;' . tdCore_continue_reading_link();
}
add_filter( 'excerpt_more', 'tdCore_auto_excerpt_more' );
function tdCore_custom_excerpt_more( $output ) {
if ( has_excerpt() && ! is_attachment() ) {
$output .= tdCore_continue_reading_link();
}
return $output;
}
add_filter( 'get_the_excerpt', 'tdCore_custom_excerpt_more' );
add_filter( 'use_default_gallery_style', '__return_false' );
function tdCore_remove_gallery_css( $css ) {
return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )
add_filter( 'gallery_style', 'tdCore_remove_gallery_css' );
if ( ! function_exists( 'tdCore_comment' ) ) :
function tdCore_comment( $comment, $args, $depth ) {
$myavatar = get_template_directory_uri() . '/images/userIcon.png';
$GLOBALS['comment'] = $comment;
switch ( $comment->comment_type ) :
case '' :
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
<div id="comment-<?php comment_ID(); ?>">
<div class="comment-author vcard">
<?php echo get_avatar( $comment, 60, $default = $myavatar ); ?>
<cite class="fn"> <?php echo get_comment_author_link(); ?></cite> <span class="says"><?php _e( 'says:', 'tdCore'); ?></span>
</div>
<?php if ( $comment->comment_approved == '0' ) : ?>
<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'tdCore' ); ?></em>
<br />
<?php endif; ?>
<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
<?php
echo get_comment_date(); _e( ' at ', 'tdCore' ); echo get_comment_time(); ?></a><?php edit_comment_link( __( '(Edit)', 'tdCore' ), ' ' );
?>
</div>
<div class="comment-body"><?php comment_text(); ?></div>
<div class="reply">
<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
</div>
</div>
<?php
break;
case 'pingback'  :
case 'trackback' :
?>
<li class="post pingback">
<p><?php _e( 'Pingback:', 'tdCore' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'tdCore' ), ' ' ); ?></p>
<?php
break;
endswitch;
}
endif;
function tdCore_widgets_init() {
register_sidebar( array(
'name' => __( 'Primary Widget Area', 'tdCore' ),
'id' => 'primary-widget-area',
'description' => __( 'The primary widget area', 'tdCore' ),
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => '</li>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
add_action( 'widgets_init', 'tdCore_widgets_init' );
function tdCore_remove_recent_comments_style() {
add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'tdCore_remove_recent_comments_style' );
if ( ! function_exists( 'tdCore_posted_on' ) ) :
function tdCore_posted_on() {
printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'tdCore' ),
'meta-prep meta-prep-author',
sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
get_permalink(),
esc_attr( get_the_time() ),
get_the_date()
),
sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
get_author_posts_url( get_the_author_meta( 'ID' ) ),
sprintf( esc_attr__( 'View all posts by %s', 'tdCore' ), get_the_author() ),
get_the_author()
)
);
}
endif;
if ( ! function_exists( 'tdCore_posted_in' ) ) :
function tdCore_posted_in() {
$tag_list = get_the_tag_list( '', ', ' );
if ( $tag_list ) {
$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'tdCore' );
} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'tdCore' );
} else {
$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'tdCore' );
}
printf(
$posted_in,
get_the_category_list( ', ' ),
$tag_list,
get_permalink(),
the_title_attribute( 'echo=0' )
);
}
endif;
function td_dashboard_widget() { 
echo '<iframe class="iframeTD" src="http://www.theme-dutch.com/advertise" width="100%" height="100%" style="margin: 0px; padding:0px;">
<p>Your browser does not support iframes.</p>
</iframe>';
}
function add_td_dashboard_widgets() {
wp_add_dashboard_widget('td_dashboard_widget', 'Theme Dutch', 'td_dashboard_widget');
global $wp_meta_boxes;
$normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
$td_widget = array('td_dashboard_widget' => $normal_dashboard['td_dashboard_widget']);
unset($normal_dashboard['td_dashboard_widget']);
$sorted_dashboard = array_merge($td_widget, $normal_dashboard);
$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
} 
add_action('wp_dashboard_setup', 'add_td_dashboard_widgets' );
function makePathAbsolute($str) {
if(trim($str) != '' && strpos(strtolower($str), 'http://') === false && strpos(strtolower($str), 'https://') === false) {
$str = get_template_directory_uri() . '/' . $str;
}
return $str;
}
function safeUrl($str) {
if($str != '') {
$bad = array("http://", "www.", "https://");
$good   = array("", "", "");
$str = str_replace($bad, $good, $str);
$str = 'http://'.$str;
}
return $str;
}
/* Converts shortcodes */
function teamDutchShortcodeConverter($content) {
	$new_content = '';
	
	/* Matches the contents and the open and closing tags */
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	
	/* Matches just the contents */
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	
	/* Divide content into pieces */
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

	/* Loop over pieces */
	foreach($pieces as $piece) {
		/* Look for presence of the shortcode */
		if(preg_match($pattern_contents, $piece, $matches)) {
			/* Append to content (no formatting) */
			$new_content .= $matches[1];
		} else {
			/* Format and append to content */
			$new_content .= wptexturize(wpautop($piece));
		}
	}
	return $new_content;
}
function galleryShorten($str, $max, $replacement) {
if($max != '') { } else { $max = 20; }
if($replacement != '') { } else { $replacement = '...'; }
if($str != '') {
$str = teamDutchShortcodeConverter(str_replace(']]>', ']]&gt;', apply_filters('the_content', stripslashes_deep($str))));
$str = str_replace("\n", "<br />", $str);
$str = str_replace("<br />", "", $str);
$str = preg_replace("'\s+'", ' ', $str);
$str = preg_replace("/<img[^>]+\>/i", "", $str); 
$str = preg_replace('/<a href="([^<]*)">([^<]*)<\/a>/', '', $str);
//Removed following line for special chars bottom line fixes this, may there be problems recreate this
//$str = htmlentities($str, ENT_QUOTES, "UTF-8");
$str = strip_tags(html_entity_decode($str));
if(strlen($str) <= $max) {
	return $str;
}
$str = substr_replace($str, $replacement, $max);
}
return $str;
}

function fixYoutubeContent($content) {
	$content = $content;
	$content = str_replace('allowscriptaccess="always"', 'allowscriptaccess="always" wmode="transparent"', $content);
	return $content;
}
add_filter('the_content', 'fixYoutubeContent', 98);


function decodeVideo($str) {
if($str != '') {
$bad = array("http://", "www.", "https://");
$good   = array("", "", "");
$str = str_replace($bad, $good, $str);
$haystack = $str;
$vimeo = 'vimeo.com/';
$youtube = 'youtube.com/watch?v=';
$pos = strripos($haystack, $vimeo);
if ($pos === false) {
	$str = $str;
		$pos = strripos($haystack, $youtube);
		if ($pos === false) {
			$str = 'http://'.$str;
			$str = '<object
type="application/x-shockwave-flash" data="'.get_template_directory_uri().'/tdplayer.swf?moviefile='.$str.'&amp;autoplay=1" 
width="594" height="294">
<param name="wmode" value="transparent" />
<param name="movie" wmode="transparent" value="'.get_template_directory_uri().'/tdplayer.swf?moviefile='.$str.'&amp;autoplay=1" />
</object>';
		} else {
			$str = str_replace($youtube, '', $str);
			$str = '<iframe width="595" height="295" src="http://www.youtube.com/embed/'.$str.'" frameborder="0" allowfullscreen></iframe>';
		}
} else {
$str = str_replace($vimeo, '', $str);
$str = '<iframe width="595" height="295" src="http://player.vimeo.com/video/'.$str.'?title=0&amp;byline=0&amp;portrait=0" frameborder="0" allowfullscreen></iframe>';
}
}
return $str;
}
function urlsafe($str) {
$str = utf8_decode(html_entity_decode(html_entity_decode($str)));
$str = str_replace(array(' ', ',', '.', '"', "'", '/', "\\", '+', '=', ')', '(', '*', '&', '^', '%', '$', '#', '@', '!', '~', '`', '<', '>', '?', '[', ']', '{', '}', '|', ':'), '', $str);
$bad = utf8_decode('ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýýþÿŔŕ');
$bad_arr = array();
for($i = 0; $i < strlen($bad); $i++) {
$bad_arr[] = htmlentities($bad[$i]);
}
$good = 'AAAAAAACEEEEIIIIDNOOOOOOUUUUYbsaaaaaaaceeeeiiiidnoooooouuuuyybyRr';
for($i = 0; $i < strlen($str); $i++) {
for($j = 0; $j < count($bad_arr); $j++) {
if(htmlentities($str[$i]) == $bad_arr[$j]) {
$str[$i] = $good{$j};
}
}
}
for($i = 0; $i < strlen($str); $i++) {
if(!ereg('[a-zA-Z0-9\-]', $str[$i])) {
$str = str_replace($str[$i], '', $str);
}
}
return $str;
}
add_filter( 'comment_form_defaults', 'my_comment_defaults');
function my_comment_defaults($defaults) {
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$post_id = '';
	global $current_user;
      get_currentuserinfo();
      $user_identity = $current_user->display_name;
			global $commenter;
	$defaults = array(
		'fields'        	   => array(
		'author' => '<div>' . '<input id="author" name="author" placeholder="'. __('Your name', 'tdCore') . ( $req ? '*' : '' ) .'" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
		'email' => '<div>' . '<input id="email" name="email" placeholder="'.__('Your email', 'tdCore') . ( $req ? '*' : '' ) .'" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>' ),
		'comment_field' => '<div><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"  placeholder="'.__('Your comment', 'tdCore').'"></textarea></div>',
		'must_log_in'          => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'title_reply'          => __( 'Leave a Comment', 'tdCore' ),
		'title_reply_to'       => __( 'Leave a Reply %s', 'tdCore' ),
		'cancel_reply_link'    => __( 'Cancel reply', 'tdCore' ),
		'label_submit'         => __( 'Leave comment', 'tdCore' ),
                );
    return $defaults;
}