<?php

// ---------- TIDYUP ---------- //

remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_filter('the_content', 'wptexturize');  
remove_filter('comment_text', 'wptexturize'); 

if(function_exists('add_theme_support')){
    add_theme_support('automatic-feed-links');
}


// ---------- SETUP ---------- //

function check_theme_install() {

	if ( get_option('sideways_installation_check') != "set" ) {
		
		raw_first_setup();

		add_option('sideways_installation_check', "set");
	
	}
	
}
add_action('admin_head', 'check_theme_install');


// Language Files
load_theme_textdomain( 'raw_theme', TEMPLATEPATH .'/lang' );

// Content Width
if ( !isset( $content_width ) ) $content_width = 524;

// Queue Scripts
add_action('template_redirect', 'enqueueScripts');
	
function enqueueScripts() {
	
	global $shortname, $theme_options;
	
	if(!is_admin()) {
		
		// jQuery
		wp_enqueue_script('jquery');
		
		// AJAX Comments
		wp_enqueue_script('comment-reply');
	
		//raw.js
		wp_enqueue_script('raw', get_template_directory_uri() .'/js/raw.js', array('jquery'), false, 1 );
		
		//prettyphoto			
		if ( $theme_options[$shortname.'_prettyphoto'] == 'true') {
			
			wp_enqueue_script('prettyPhoto', get_template_directory_uri() .'/js/jquery.prettyPhoto.js', array('jquery'), false, 1 );
		
		}
		
		# Backstretch
		wp_enqueue_script('backstretch', get_template_directory_uri() .'/js/jquery.backstretch.min.js', array('jquery'), false, 0 );
		
		//Smoothscroll			
		if ( $theme_options[$shortname.'_smoothscroll'] == 'true') {
		
			wp_enqueue_script('smoothscroll', get_template_directory_uri() .'/js/smoothscroll.js', array('jquery'), false, 1 );
		
		}	
		
		if (is_page_template('contact.php')) {
			
			// Validation
			wp_enqueue_script('validate','http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js', array('jquery'), false, 1 );
			
		}
		
		//Twitter
		wp_enqueue_script('raw_twitter', 'http://twitterjs.googlecode.com/svn/trunk/src/twitter.min.js', array('jquery') );
		
	}

}

// Function to output prettyPhoto JS trigger and footer analytics code from theme option.
function theme_footer_scripts() {
	
	global $shortname, $theme_options;
	
	if ( $theme_options[$shortname.'_prettyphoto'] == 'true' ) {
	
		$output = "<script>
			jQuery( document ).ready( function( $ ) {
				$( \"a[rel^='prettyPhoto'], a[rel^='prettyphoto'], .gallery-item a \").prettyPhoto( {
					show_title: false,";
					
		if ( $theme_options[$shortname.'_lightbox_overlay'] == 'true' ) {
			$output .= "overlay_gallery: true,";
		} else {
			$output .= "overlay_gallery: false,";
		}
		
		switch ( $theme_options[ $shortname.'_lightbox_style' ] ) {
			case __( 'Light Rounded', 'raw_theme' ):
				$output .= "theme:'light_rounded'";
			break;
			case __( 'Dark Rounded', 'raw_theme' ):
				$output .= "theme:'dark_rounded'";
			break;
			case __( 'Light Square', 'raw_theme' ):
				$output .= "theme:'light_square'";
			break;
			case __( 'Dark Square', 'raw_theme' ):
				$output .= "theme:'dark_square'";
			break;
			case __( 'Facebook', 'raw_theme' ):
				$output .= "theme:'facebook'";
			break;
		}
	
		$output .= "});
			});
		</script>";
		
		echo $output;
		
	}
	
	echo stripslashes( $theme_options[ $shortname.'_analytics_code' ] );
	
}
add_action('wp_footer','theme_footer_scripts');


// ---------- THUMBNAILS ---------- //

if ( function_exists( 'add_theme_support' ) ) {

	add_theme_support( 'post-thumbnails' );
	
	set_post_thumbnail_size( 200, 200, true ); // Set thumbnail size.
	
	add_image_size( '55x55', 55, 55, true ); // Widgets
	add_image_size( 'type-gallery-landscape', 620, 430, true );	// Galleries (landscape)
	add_image_size( 'type-gallery-portrait', 300, 430, true );	// Galleries (portrait)
	add_image_size( 'feature_image_524x373', 524, 373, true );	// Vertical indexes
	add_image_size( 'feature_image_524', 524, 99999, false );	// Post page feature image
	add_image_size( 'feature_image_800x373', 800, 373, true );	// Full width portfolio items featured image
	
}


// ---------- EXCERPT LENGTH ---------- //

function excerptlength_portfolio($length) {
    return 40;
}
function excerptlength_blog($length) {
    return 50;
}
function excerptlength_blog_long($length) {
    return 150;
}
function excerptmore($more) {
    return '...';
}

function raw_excerpt($length_callback='', $more_callback='') {
    global $post;
    if(function_exists($length_callback)){
        add_filter('excerpt_length', $length_callback);
    }
    if(function_exists($more_callback)){
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>'.$output.'</p>';
    echo $output;
}


// ---------- EXCERPT FOR POSTS AND PORTFOLIO ITEMS ---------- //

function add_excerpts_to_post_types() {
    add_post_type_support( 'portfolio', 'excerpt');
}
add_action( 'init', 'add_excerpts_to_post_types' );


// ---------- REGISTER SIDEBARS ---------- //

add_action('widgets_init', 'raw_register_sidebars');
function raw_register_sidebars () {

	register_sidebar(array(
		'name' => __('Page Sidebar', 'raw_theme'),
		'description' => __( 'Sidebar used on pages.' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => __('404 Sidebar', 'raw_theme'),
		'description' => __( 'Sidebar used on 404 page.' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => __('Article Sidebar', 'raw_theme'),
		'description' => __( 'Sidebar used on blog index page and posts.' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => __('Contact Sidebar', 'raw_theme'),
		'description' => __( 'Sidebar used on contact template.' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>'
	));
	
}


// ---------- TRUNCATION ---------- //

function truncate($string, $length) {
	
	$trailing = '...';
	
	if (strlen($string) <= $length) {
		return $string;
	} else {
		$length-=mb_strlen($trailing);
		$res = substr($string, 0, strpos(wordwrap($string, $length), "\n"));
		
		return $res.$trailing;
	}	
}

// ---------- GET YouTube ID ---------- //
function getYTid($ytURL) {
 
	$ytvIDlen = 11;	// This is the length of YouTube's video IDs

	// The ID string starts after "v=", which is usually right after 
	// "youtube.com/watch?" in the URL
	$idStarts = strpos($ytURL, "?v=");

	// In case the "v=" is NOT right after the "?" (not likely, but I like to keep my 
	// bases covered), it will be after an "&":
	if($idStarts === FALSE)
		$idStarts = strpos($ytURL, "&v=");
	// If still FALSE, URL doesn't have a vid ID
	if($idStarts === FALSE)
		die("YouTube video ID not found. Please double-check your URL.");

	// Offset the start location to match the beginning of the ID string
	$idStarts +=3;

	// Get the ID string and return it
	$ytvID = substr($ytURL, $idStarts, $ytvIDlen);

	return $ytvID;

}

// ---------- REMOVE AUTO PARAGRAPHYS --------- //
function remove_wpautop($content) {

    $content = do_shortcode( shortcode_unautop($content) ); 
    $content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );
    return $content;
	
}

// ---------- PORTFOLIO POST TYPE --------- //

add_action('init', 'create_portfolio_post_type');
 
function create_portfolio_post_type() {
 
	$labels = array(
		'name' => __('Portfolio Items', 'raw_theme'), 'post type general name',
		'singular_name' => __('Portfolio Item', 'raw_theme'), 'post type singular name',
		'add_new' => __('Add New', 'raw_theme'), 'portfolio item',
		'add_new_item' => __('Add New Portfolio Item', 'raw_theme'),
		'edit_item' => __('Edit Portfolio Item', 'raw_theme'),
		'new_item' => __('New Portfolio Item', 'raw_theme'),
		'view_item' => __('View Portfolio Item', 'raw_theme'),
		'search_items' => __('Search Portfolio', 'raw_theme'),
		'not_found' =>  __('Nothing found', 'raw_theme'),
		'not_found_in_trash' => __('Nothing found in Trash', 'raw_theme'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'portfolio-item', 'with_front' => false ),
		'capability_type' => 'post',
		'hierarchical' => true,
		'menu_position' => null,
		'supports' => array('title', 'editor', 'page-attributes', 'thumbnail', 'comments')
	  ); 
 
	register_post_type( 'portfolio' , $args );
	
}

$category_labels = array(
	'name' => __( 'Portfolio Category', 'raw_theme' ),
	'singular_name' => __( 'Portfolio Category', 'raw_theme'),
	'search_items' =>  __( 'Search Category', 'raw_theme' ),
	'popular_items' => __( 'Popular Categories', 'raw_theme' ),
	'all_items' => __( 'All Categories', 'raw_theme' ),
	'edit_item' => __( 'Edit Category', 'raw_theme' ), 
	'update_item' => __( 'Update Category', 'raw_theme' ),
	'add_new_item' => __( 'Add New Category', 'raw_theme' ),
	'new_item_name' => __( 'New Category Name', 'raw_theme' ),
	'add_or_remove_items' => __( 'Add or remove category', 'raw_theme' ),
	'choose_from_most_used' => __( 'Choose from the most used categories', 'raw_theme' ),
	'menu_name' => __( 'Portfolio Categories', 'raw_theme' ),
);

register_taxonomy( 'portfolio-categories', array("portfolio"), array("hierarchical" => true, "labels" => $category_labels, "show_in_nav_menus" => false, "rewrite" => true ) );


// Remove admin bar
if(function_exists( 'show_admin_bar' )) {
	add_action( 'show_admin_bar', '__return_false' );
}

/* ----- POST TYPE ICONS ----- */

add_action( 'admin_head', 'post_type_icons' );
function post_type_icons() { ?>

    <style type="text/css" media="screen">
        #menu-posts-portfolio .wp-menu-image {
            background: url(<?php echo get_template_directory_uri() ?>/images/television--pencil.png) no-repeat 6px -17px !important;
        }
		#menu-posts-portfolio:hover .wp-menu-image, #menu-posts-portfolio.wp-has-current-submenu .wp-menu-image {
            background-position:6px 7px!important;
        }
	</style>
<?php } ?>