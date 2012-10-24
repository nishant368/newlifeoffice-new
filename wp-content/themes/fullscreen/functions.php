<?php
require_once( 'inc/custom.php' );
require_once( 'inc/description-walker.php' );
require_once( 'lib/load.php' );
require_once( 'conf/admin-page.php' );

define( 'FULL_NAME', 'Fullscreen' );
define( 'SHORT_NAME', 'Fullscreen' );

define( 'TEMPLATE_DIR', get_template_directory_uri() );
include'lib/yaml/sfYamlOutline.php';

/**
 * Load own jQuery
 */
function load_jquery() {
 
    // only use this method is we're not in wp-admin
    if (!is_admin()) {
 
        // deregister the original version of jQuery
        wp_deregister_script('jquery');
 
        // discover the correct protocol to use
        $protocol='http:';
        if($_SERVER['HTTPS']=='on') {
            $protocol='https:';
        }
 
        // register the Google CDN version
        wp_register_script('jquery', $protocol.'//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js', false, '1.5.1');
 
        // add it back into the queue
        wp_enqueue_script('jquery');
 
    }
 
}

/**
 * Hook init()
 */
add_action('init', 'theme_init');
function theme_init () {
	
	load_jquery();
	
    wp_enqueue_script('admin-js', TEMPLATE_DIR . '/js/' . 'jquery.colorpicker.js', array('jquery'));
    wp_enqueue_style('admin-css-colorpicker', TEMPLATE_DIR .'/css/jquery.colorpicker.css');
	
	if (is_admin()) {
		wp_enqueue_script('admin-js-sheepItPlugin', TEMPLATE_DIR . '/js/' . 'jquery.sheepItPlugin.js', array('jquery'));
		wp_enqueue_script('admin-js-colorpicker', TEMPLATE_DIR . '/js/' . 'admin.js', array('jquery'));
        wp_enqueue_style('admin-css', TEMPLATE_DIR .'/css/admin.css');
	}
    elseif (!is_admin()) {
    
       wp_enqueue_style('theme-reset-css', TEMPLATE_DIR .'/css/reset.css');
       wp_enqueue_style('theme-comments', TEMPLATE_DIR .'/css/comments.css');
       wp_enqueue_style('theme-contact', TEMPLATE_DIR .'/css/contact.css');
       wp_enqueue_style('theme-portfolio', TEMPLATE_DIR .'/css/portfolio.css');
       wp_enqueue_style('theme-fancybox-css', TEMPLATE_DIR .'/css/jquery.fancybox.css');
       wp_enqueue_style('theme-anythingslider-css', TEMPLATE_DIR .'/css/anythingslider.css');
	   wp_enqueue_style('theme-mCustomScrollbar-css', TEMPLATE_DIR .'/css/jquery.mCustomScrollbar.css');
    
		wp_enqueue_script('theme-mCustomScrollbar', TEMPLATE_DIR . '/js/' . 'jquery.mCustomScrollbar.js', array('jquery'), true);
		wp_enqueue_script('theme-jquery-ui', TEMPLATE_DIR . '/js/' . 'jquery-ui.min.js', array('jquery'), true);
		wp_enqueue_script('theme-easing', TEMPLATE_DIR . '/js/' . 'jquery.easing.1.3.js', array('jquery'), true);
		wp_enqueue_script('theme-mousewheel', TEMPLATE_DIR . '/js/' . 'jquery.mousewheel.min.js', array('jquery'), true);
    
        wp_enqueue_script('theme-cufon', TEMPLATE_DIR . '/js/' . 'cufon.js', array('jquery'), true);
        wp_enqueue_script('theme-calibri', TEMPLATE_DIR . '/js/' . 'calibri.js', array('jquery'), true);
        wp_enqueue_script('theme-cookie', TEMPLATE_DIR . '/js/' . 'jquery.cookie.js', array('jquery'), true);
        wp_enqueue_script('theme-fancybox', TEMPLATE_DIR . '/js/' . 'jquery.fancybox.js', array('jquery'), true);
        wp_enqueue_script('theme-themebox', TEMPLATE_DIR . '/js/' . 'themebox.js', array('jquery'), true);
        wp_enqueue_script('theme-anythingslider', TEMPLATE_DIR . '/js/' . 'jquery.anythingslider.js', array('jquery'), true);
		wp_enqueue_script('theme-resize', TEMPLATE_DIR . '/js/' . 'jquery.ba-resize.min.js', array('jquery'), true);
        wp_enqueue_script('theme-infieldlabel', TEMPLATE_DIR . '/js/' . 'jquery.infieldlabel.js', array('jquery'), true);
		wp_enqueue_script('theme-scrollTo', TEMPLATE_DIR . '/js/' . 'jquery.scrollTo.js', array('jquery'), true);
        
		wp_enqueue_script('theme-script', TEMPLATE_DIR . '/js/' . 'script.js', array('jquery'), true);
    }
}

/**
 * Hook widgets_init() 
 */
add_action( 'widgets_init', 'theme_widgets_init' );
function theme_widgets_init() {
    add_filter('widget_text', 'do_shortcode');
    
    // Rightbox widget area
	register_sidebar(array(
		'name' 			=> __( 'Rightbox Widget Area', 'theme' ),
		'id' 			=> 'primary-widget-area',
		'description' 	=> __( 'The rightbox widget area', 'theme' ),
		'before_widget' => '<div id="%1$s" class="sidebox %2$s"><div class="sidewrap"><div class="sideinner clear">',
		'after_widget' 	=> '</div></div></div>',
		'before_title' 	=> '<h2 class="widget-title">',
		'after_title' 	=> '</h2>',
	));
	
	// Leftbox widget area
	register_sidebar(array(
		'name' 			=> __( 'Leftbox Widget Area', 'theme' ),
		'id' 			=> 'leftbox-widget-area',
		'description' 	=> __( 'The leftbox widget area', 'theme' ),
		'before_widget' => '<div id="%1$s" class="sidebox %2$s"><div class="sidewrap"><div class="sideinner clear">',
		'after_widget' 	=> '</div></div></div>',
		'before_title' 	=> '<h2 class="widget-title">',
		'after_title' 	=> '</h2>',
	));
	
	// Footer Widget Area
	register_sidebar(array(
		'name' 			=> __( 'Footer Widget Area', 'theme' ),
		'id' 			=> 'footer-widget-area',
		'description' 	=> __( 'The footer widget area', 'theme' ),
		'before_widget' => '<div id="%1$s" class="col-widget %2$s"><div class="wrap">',
		'after_widget' 	=> '</div></div>',
		'before_title' 	=> '<h2 class="widget-title">',
		'after_title' 	=> '</h2>',
	));
}

/**
 * Hook admin_menu() 
 */
add_action('admin_menu', 'theme_admin_menu');    
function theme_admin_menu() {
        $options = get_admin_options ();
        if ( $_GET['page'] == "Fullscreen" ) {
            if ( 'save' == $_REQUEST['action'] ) {
				
                foreach ( $options[$_REQUEST['slug']] as $key => $value )  {
                    if($key=="home_page_slider_images"){
						// templates numbers from hidden input
						$numbers = $_REQUEST[$key];
						$numArray = explode(",",$numbers);
						
						$images = array();
						
						for($i=0;$i<count($numArray);$i++){ 
							$inputSrc = "img_src_".$numArray[$i];
							$inputLink = "img_link_".$numArray[$i];
							$inputDesc = "img_desc_".$numArray[$i];
							$inputBackgroundSrc = "img_background_".$numArray[$i];
							
							$images[$i] = array($_REQUEST[$inputSrc],$_REQUEST[$inputLink],$_REQUEST[$inputDesc],$_REQUEST[$inputBackgroundSrc]);
						}
						update_option($key, json_encode($images));
						
						// disable default values
						update_option('home_slider_default_values','no');
					}
					elseif($key=="footer_clone_picture"){
						// templates numbers from hidden input
						$numbers = $_REQUEST[$key];
						$numArray = explode(",",$numbers);
						
						$images = array();
						
						for($i=0;$i<count($numArray);$i++){ 
							$inputSrc = "image_src_".$numArray[$i];
							$inputLink = "image_link_".$numArray[$i];
							$inputDesc = "image_desc_".$numArray[$i];
							
							$images[$i] = array($_REQUEST[$inputSrc],$_REQUEST[$inputLink],$_REQUEST[$inputDesc]);
						}
						update_option($key, json_encode($images));
						
						// disable default values
						update_option('footer_gallery_default_values','no');
					}
                    elseif( isset( $_REQUEST[$key] ) ) {
                        update_option( $key, $_REQUEST[$key] );
                    }
                    else
                        delete_option( $key );
                }

                header("Location: admin.php?page=" . $_GET['page'] . "&saved=true");
                die;
            }
        }
        add_object_page(FULL_NAME, SHORT_NAME, 'administrator', SHORT_NAME, 'theme_admin');
}

function theme_admin () {
	?>
	<div class="wrap">
		<h2>
			<?php echo FULL_NAME; ?> - Options
		</h2>
		
		<?php echo get_admin_form('general'); ?>
	
	</div><!-- /.wrap -->
	<?php
}

/**
 * Prints HTML with meta information for the current post—date/time and author.
 */
if ( ! function_exists( 'theme_posted_on' ) ) {

    function theme_posted_on() {
        printf( __( 'Posted  %1$s ago by %2$s' ),
            sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
                get_permalink(),
                esc_attr( get_the_time() ),
                human_time_diff(get_the_time('U'), current_time('timestamp'))
            ),
            sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
                get_author_posts_url( get_the_author_meta( 'ID' ) ),
                sprintf( esc_attr__( 'View all posts by %s', 'theme' ), get_the_author() ),
                get_the_author()
            )
        );
    }
}

/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 */
if ( ! function_exists( 'theme_posted_in' ) ) {
    function theme_posted_in() {
        // Retrieves tag list of current post, separated by commas.
        $tag_list = get_the_tag_list( '', ', ' );
        if ( $tag_list ) {
            $posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'theme' );
        } elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
            $posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'theme' );
        } else {
            $posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'theme' );
        }
        // Prints the string, replacing the placeholders.
        printf(
            $posted_in,
            get_the_category_list( ', ' ),
            $tag_list,
            get_permalink(),
            the_title_attribute( 'echo=0' )
        );
    }
}

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 */
function theme_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'theme_remove_recent_comments_style' );

if ( ! function_exists( 'theme_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own theme_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function theme_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
        
		<div class="comment-author vcard">
        	<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>', 'theme' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'theme' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'theme' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'theme' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php __( 'Pingback:', 'fullscreen' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Remove inline styles printed when the gallery shortcode is used.
 */
function theme_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'theme_remove_gallery_css' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and theme_continue_reading_link().
 */
function theme_auto_excerpt_more( $more ) {
	return ' &hellip;' . theme_continue_reading_link();
}
add_filter( 'excerpt_more', 'theme_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 */
function theme_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= theme_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'theme_custom_excerpt_more' );

/**
 * Sets the post excerpt length to 40 characters.
 */
function theme_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'theme_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 */
function theme_continue_reading_link() {
	//return ' <br /><a href="'. get_permalink() . '" class="more-link">' . __( 'Continue reading', 'theme' ) . '</a>';
    return '';
}


/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function simplicus_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'simplicus_page_menu_args' );

add_action( 'after_setup_theme', 'theme_setup' );
if ( ! function_exists( 'theme_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function theme_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );
  
	register_nav_menu('main', 'Main Navigation');  

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'theme', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	//register_nav_menus( array(
	//	'primary' => __( 'Primary Navigation', 'theme' ),
	//) );
}
endif;

add_filter( 'show_admin_bar', '__return_false' );

add_filter('get_comment_link', 'redirect_after_comment');
function redirect_after_comment($location)
{
	return preg_replace("/#comment-([\d]+)/", "", $location);
}

add_filter( 'wp_get_attachment_link' , 'add_fancybox_rel' );
function add_fancybox_rel( $attachment_link ) {
	if( strpos( $attachment_link , 'a href') != false && strpos( $attachment_link , 'img') != false && (strpos( $attachment_link , '.jpg') != false || strpos( $attachment_link , '.png') != false || strpos( $attachment_link , '.gif') != false))
		$attachment_link = str_replace( 'a href' , 'a rel="fancybox" href' , $attachment_link );
	return $attachment_link;
}

function theme_filter_wp_title( $title, $separator ) {
        // Don't affect wp_title() calls in feeds.
        if ( is_feed() )
                return $title;

        // The $paged global variable contains the page number of a listing of posts.
        // The $page global variable contains the page number of a single post that is paged.
        // We'll display whichever one applies, if we're not looking at the first page.
        global $paged, $page;

        if ( is_search() ) {
                // If we're a search, let's start over:
                $title = sprintf( __( 'Search results for %s', 'fullscreen' ), '"' . get_search_query() . '"' );
                // Add a page number if we're on page 2 or more:
                if ( $paged >= 2 )
                        $title .= " $separator " . sprintf( __( 'Page %s', 'fullscreen' ), $paged );
                // Add the site name to the end:
                $title .= " $separator " . get_bloginfo( 'name', 'display' );
                // We're done. Let's send the new title back to wp_title():
                return $title;
        }

        // Otherwise, let's start by adding the site name to the end:
        $title .= get_bloginfo( 'name', 'display' );

        // If we have a site description and we're on the home/front page, add the description:
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) )
                $title .= " $separator " . $site_description;

        // Add a page number if necessary:
        if ( $paged >= 2 || $page >= 2 )
                $title .= " $separator " . sprintf( __( 'Page %s', 'fullscreen' ), max( $paged, $page ) );

        // Return the new title to wp_title():
        return $title;
}
add_filter( 'wp_title', 'theme_filter_wp_title', 10, 2 );

if ( ! function_exists( 'add_custom_image_header' ) ) {
    function add_custom_image_header() {
       
    }
}
if ( ! function_exists( 'add_custom_background' ) ) {
    function add_custom_background() {
       
    }
}

// upload image admin
function my_admin_scripts() {
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_register_script('my-upload', TEMPLATE_DIR.'/js/admin.selectImage.js', array('jquery','media-upload','thickbox'));
wp_enqueue_script('my-upload');
}

function my_admin_styles() {
wp_enqueue_style('thickbox');
}

if (isset($_GET['page']) && $_GET['page'] == 'Fullscreen') {
add_action('admin_print_scripts', 'my_admin_scripts');
add_action('admin_print_styles', 'my_admin_styles');
}