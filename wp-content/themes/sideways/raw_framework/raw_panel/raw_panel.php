<?php

/* This page will produce a harmless PHP notice when you are not on a post or page edit screen where the $template variable is empty.
The below line suppresses this notice to prevent users who have particularly tight PHP security settings from being unable to use the theme.
error_reporting (E_ALL ^ E_NOTICE);*/

// ------------------------------------- META BOXES ------------------------------------- //

// Post categories
$args = array (
	'hide_empty' => 0,
	'orderby' => 'name'
);
$categories = get_categories($args);
$wp_cats = array();
foreach ($categories as $category ) {
	$wp_cats[$category->cat_ID] = $category->cat_name;
}
array_unshift($wp_cats, __("All Categories", "raw_theme") );

// Portfolio categories
$args = array(
	'taxonomy' => 'portfolio-categories',
	'hide_empty' => 0,
	'orderby' => 'name'
);
$portfolio_categories = get_categories($args);
$wp_portfolio_cats = array();
foreach ($portfolio_categories as $portfolio_category ) {
	$wp_portfolio_cats[$portfolio_category->cat_ID] = $portfolio_category->cat_name;
}
array_unshift($wp_portfolio_cats, __("All Categories", "raw_theme") );

$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
if(get_post_meta($post_id,'_wp_page_template',TRUE)){
	$template_file = get_post_meta($post_id,'_wp_page_template',TRUE);
}else{
	$template_file = '';
}

$meta_boxes = array();

// BACKGROUND IMAGE
$meta_boxes[] = array(
	'id' => 'background-options-box',
	'title' => __( 'Background Options', 'raw_theme' ),
	'pages' => array( 'page', 'post', 'portfolio' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
	
		array(
			'name' => __( 'Background Image', 'raw_theme' ),
			'desc' => __( 'Select which image to use as the page background', 'raw_theme' ),
			'id' => $shortname.'_background_image',
			'type' => 'select',
			'options' => array( __('Default', 'raw_theme'), __('Featured Image', 'raw_theme'), __('URL', 'raw_theme'), __('Slide Show', 'raw_theme'))
		),
		
		array(
			'name' => __('Background Image URL', 'raw_theme'),
			'desc' => __('Enter the URL to the page background image (Only used when "URL" is selected in the drop down box above).', 'raw_theme'),
			'id' => $shortname.'_background_image_url',
			'type' => 'text',
		)
		
	)
);

// PORTFOLIO INDEX
if(	$template_file == 'portfolio-horizontal.php' 
	|| $template_file == 'portfolio-grid.php'
){ 
	
	$meta_boxes[] = array(
		'id' => 'portfolio-index-options-box',
		'title' => __('Portfolio Index Options', 'raw_theme'),
		'pages' => array('page'),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			
			// Portfolio Category Selection
			array(
				"name" => __("Select Portfolio Category", 'raw_theme'),
				"desc" => __("Select which category to display in this portfolio.", 'raw_theme'),
				"id" => $shortname."_portfolio_category",
				"type" => "select",
				"options" => $wp_portfolio_cats
			),
			
			// Portfolio Sorting
			array(
				"name" => __("Enable Portfolio jQuery Filter", 'raw_theme'),
				"desc" => __("Check to enable jQuery sorting on portoflio index page.", 'raw_theme'),
				"id" => $shortname."_portfolio_filter",
				"type" => "checkbox",
				"std" => "false"
			),
			
			// Items Per Page
			array(
				"name" => __("Portfolio Items Per Page", 'raw_theme'),
				"desc" => __("Enter the number of portfolio items to show on each page. Pagination will not work if there are other page's have this page set as parent. '-1' will display all items without pagination.", 'raw_theme'),
				"id" => $shortname."_portfolio_post_per_page",
				"type" => "text",
				"std" => "-1"
			)			
		)
	);
	
}

// PORTFOLIO ITEMS
$meta_boxes[] = array(
	'id' => 'portfolio-options-box',
	'title' => __('Portfolio Options', 'raw_theme'),
	'pages' => array('portfolio'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('Portfolio Page Layout', 'raw_theme'),
			'desc' => __('Select the page layout to be used for this portfolio item.', 'raw_theme'),
			'id' => $shortname.'_portfolio_item_type',
			'type' => 'select',
			'options' => array( __('Default', 'raw_theme'),  __('Gallery', 'raw_theme'),  __('Full Width', 'raw_theme')  )
		),
		array(
			'name' => __('Video URL', 'raw_theme'),
			'desc' => __('Enter the URL to a Vimeo or YouTube video page to turn the post into a video post.', 'raw_theme'),
			'id' => $shortname.'_video_url',
			'type' => 'text',
		),
		array(
			'name' => __('Open In Lightbox', 'raw_theme'),
			'desc' => __('Select to open as a lightbox item (instead of navigating to the page) when the item\s image is clicked in the portfolio index.', 'raw_theme'),
			'id' => $shortname.'_open_lightbox',
			'type' => 'checkbox'
		),
		array(
			'name' =>  __('Show Featured Image', 'raw_theme'),
			'desc' =>  __('Select to show the featured image on the page. If you have added lightbox items to the textbox above the lightbox gallery will be opened by clicking the featured image.', 'raw_theme'),
			'id' => $shortname.'_show_feature_image',
			'type' => 'checkbox'
		),
	)
);

// PAGE
$meta_boxes[] = array(
	'id' => 'page-options-box',
    'title' => __('Page Options', 'raw_theme'),
    'pages' => array('page','portfolio'),
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
		array(
			'name' => __('Page Title', 'raw_theme'),
            'desc' => __('Enter the title as it will be displayed on the page.', 'raw_theme'),
            'id' => $shortname.'_page_title',
            'type' => 'text'
		),
		array(
			'name' => __('Subtitle', 'raw_theme'),
            'desc' => __('Enter any text you want to appear in the header below the page title.', 'raw_theme'),
            'id' => $shortname.'_page_subtitle',
            'type' => 'textarea'
		)
	)
);

// POSTS
$meta_boxes[] = array(
	'id' => 'post-options-box',
    'title' => __('Post Options', 'raw_theme'),
    'pages' => array('post'),
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
		array(
			'name' => __('Subtitle', 'raw_theme'),
            'desc' => __('Enter any text you want to below the post title.', 'raw_theme'),
            'id' => $shortname.'_page_subtitle',
            'type' => 'textarea'
		),
		array(
			'name' => __('Video URL', 'raw_theme'),
			'desc' => __('Enter the URL to a Vimeo or YouTube video page to turn the post into a video post.', 'raw_theme'),
			'id' => $shortname.'_video_url',
			'type' => 'text',
		),
		array(
			'name' => __('Disable Author Bio', 'raw_theme'),
			'desc' => __('Select to disable author bio at the end of this post.', 'raw_theme'),
			'id' => $shortname.'_disable_author_bio',
			'type' => 'checkbox',
		),
		array(
			'name' => __('Hide Featured Image', 'raw_theme'),
			'desc' => __('Select to hide the feature image on this post.', 'raw_theme'),
			'id' => $shortname.'_hide_feature_image',
			'type' => 'checkbox',
		)
	)
);


foreach ($meta_boxes as $meta_box) {
	$my_box = new raw_meta_box($meta_box);
}

class raw_meta_box {

	protected $_meta_box;

	function __construct($meta_box) {
		if (!is_admin()) return;
	
		$this->_meta_box = $meta_box;

		$current_page = substr(strrchr($_SERVER['PHP_SELF'], '/'), 1, -4);
		if ($current_page == 'page' || $current_page == 'page-new' || $current_page == 'post' || $current_page == 'post-new') {
			add_action('admin_head', array(&$this, 'add_post_enctype'));
		}
		
		add_action('admin_menu', array(&$this, 'raw_add_meta_box'));

		add_action('save_post', array(&$this, 'raw_save_meta_box'));
	}
	
	function add_post_enctype() {
		echo '
		<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery("#post").attr("enctype", "multipart/form-data");
			jQuery("#post").attr("encoding", "multipart/form-data");
		});
		</script>';
	}

	function raw_add_meta_box() {
		foreach ($this->_meta_box['pages'] as $page) {
			add_meta_box($this->_meta_box['id'], $this->_meta_box['title'], array(&$this, 'show'), $page, $this->_meta_box['context'], $this->_meta_box['priority']);
		}
	}

	function show() {
		global $post;

		echo '<input type="hidden" name="raw_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
		echo '<table class="form-table">';

		foreach ($this->_meta_box['fields'] as $field) {
			
			$meta = get_post_meta($post->ID, $field['id'], true);
		
			echo '<tr>',
					'<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
					'<td>';
			switch ($field['type']) {
				case 'text':
					echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',
						'<br />', $field['desc'];
					break;
				case 'textarea':
					echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>',
						'<br />', $field['desc'];
					break;
				case 'select':
					echo '<select name="', $field['id'], '" id="', $field['id'], '">';
					foreach ($field['options'] as $option) {
						echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
					}
					echo '</select>',
						'<br />', $field['desc'];
					break;
				case 'radio':
					foreach ($field['options'] as $option) {
						echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
					}
					break;
				case 'checkbox':
					echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
					break;
				case 'file':
					echo $meta ? "$meta<br />" : '', '<input type="file" name="', $field['id'], '" id="', $field['id'], '" />',
						'<br />', $field['desc'];
					break;
				case 'image':
					echo $meta ? "<img src=\"$meta\" width=\"150\" height=\"150\" /><br />$meta<br />" : '', '<input type="file" name="', $field['id'], '" id="', $field['id'], '" />',
						'<br />', $field['desc'];
					break;
			}
			echo 	'<td>',
				'</tr>';
		}
	
		echo '</table>';
	}

	function raw_save_meta_box($post_id) {
		
		if (!wp_verify_nonce($_POST['raw_meta_box_nonce'], basename(__FILE__))) {
			return $post_id;
		}

		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}

		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}

		foreach ($this->_meta_box['fields'] as $field) {
			$name = $field['id'];
			
			$old = get_post_meta($post_id, $name, true);
			$new = $_POST[$field['id']];
			
			if ($field['type'] == 'file' || $field['type'] == 'image') {
				$file = wp_handle_upload($_FILES[$name], array('test_form' => false));
				$new = $file['url'];
			}
			
			if ($new && $new != $old) {
				update_post_meta($post_id, $name, $new);
			} elseif ('' == $new && $old && $field['type'] != 'file' && $field['type'] != 'image') {
				delete_post_meta($post_id, $name, $old);
			}
		}
	}
}

// ------------------------------------- OPTIONS ------------------------------------- //

if ( get_option( $shortname.'_theme_options' ) ) {
	$theme_options = get_option( $shortname.'_theme_options' );
} else {
	add_option( $shortname.'_theme_options', array() );
	$theme_options = get_option( $shortname.'_theme_options' );
}

$sections = array(
	
	'General' => array(
	
		//////////////// GENERAL /////////////////////
		"name" => __("General", "raw_theme"),
		"id" => "general",		
		"icon" => "general_icon.png",
		'tabs' => array(
			
			//////////////// GENERAL - SETTINGS /////////////////////
			"Settings" => array(
				
				"name" => __("Settings", "raw_theme"),
				"id" => "settings",
				"fields" => array(
					
					// Contact Form Address
					array(
						"label" => __("Contact Form Address", "raw_theme"),
						"description" => __("Enter the email address that contact form submissions should be sent to", "raw_theme"),
						"id" => $shortname."_address",
						"type" => "text",
						"std" => get_bloginfo('admin_email')					
					),
					
					// Analytics code
					array(
						"label" => __("Analytics Code", "raw_theme"),
						"description" => __("Place here any HTML you wish to add to the bottom of all pages", "raw_theme"),
						"id" => $shortname."_analytics_code",
						"type" => "textarea"
					)					
				)
			),
			
			//////////////// GENERAL - JQUERY PLUGINS /////////////////////
			"jQuery Plugins" => array(
				
				"name" => __("jQuery Plugins", "raw_theme"),
				"id" => "plugins",
				"fields" => array(
				
					// Smooth Scroll
					array(
						"label" => __("Smooth Scroll", "raw_theme"),
						"description" => __("Check to enable Smooth Scroll jQuery plugin.", "raw_theme"),
						"id" => $shortname."_smoothscroll",
						"type" => "checkbox",
						"std" => "false"
					),
					
					// Pretty Photo Lightbox
					array(
						"label" => __("PrettyPhoto Lightbox", "raw_theme"),
						"description" => __("Check to enable Pretty Photo Lightbox jQuery plugin.", "raw_theme"),
						"id" => $shortname."_prettyphoto",
						"type" => "checkbox",
						"std" => "false"
					),
					
					// Lightbox Thumbnail Overlay
					array(
						"label" => __("Lightbox Thumbnail Overlay", "raw_theme"),
						"description" => __("Check to enable small image thumbnail on Pretty Photo Lightbox galleries.", "raw_theme"),
						"id" => $shortname."_lightbox_overlay",
						"type" => "checkbox",
						"std" => "false"
					),
						
					// Lightbox Style Scheme
					array(
						"label" => __("Lightbox Style", "raw_theme"),
						"description" => __("Select the styling used for lightbox galleries", "raw_theme"),
						"id" => $shortname."_lightbox_style",
						"type" => "select",
						"options" => array( __("Light Rounded", "raw_theme"), __("Dark Rounded", "raw_theme"), __("Light Square", "raw_theme"), __("Dark Square", "raw_theme"), __("Facebook", "raw_theme") ),
						"std" => __("Light Rounded", "raw_theme")
					)			
				)			
			)
		)
	),
	
	'Appearance' => array(
	
		//////////////// APPEARANCE /////////////////////
		"name" => __("Appearance", "raw_theme"),
		"id" => "appearance",		
		"icon" => "appearance_icon.png",
		'tabs' => array(
			
			//////////////// APPEARANCE - GENERAL /////////////////////
			"General" => array(
				
				"name" => __("General", "raw_theme"),
				"id" => "appearance_general",
				"fields" => array(
					
					// Default Background
					array(
						"label" => __("Default Background URL", "raw_theme"),
						"description" => __("Enter the URL to the website default background image (1440px x 900px recommended)", "raw_theme"),
						"id" => $shortname."_default_background",
						"type" => "text"
					),
					
					// Logo URL
					array(
						"label" => __("Logo URL", "raw_theme"),
						"description" => __("Enter the URL to your logo image (100px x 100px recommended)", "raw_theme"),
						"id" => $shortname."_logo",
						"type" => "text"
					),
					
					// Favicon URL
					array(
						"label" => __("Custom Favicon", "raw_theme"),
						"description" => __("A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the website favicon", "raw_theme"),
						"id" => $shortname."_favicon",
						"type" => "text"
					),
					
					// Apple Icon URL
					array(
						"label" => __("Apple Bookmark Icon URL", "raw_theme"),
						"description" => __("An icon used by apple devices (iPhone, iPod, iPad)", "raw_theme"),
						"id" => $shortname."_apple_bookmark",
						"type" => "text"
					),

					// Accent Colour
					array(
						"label" => __("Accent Colour", "raw_theme"),
						"description" => __("Enter the hex value of the colour to be used for links and buttons (e.g. #FF0000)", "raw_theme"),
						"id" => $shortname."_accent_colour",
						"type" => "colour",
						"std" => "C20125"
					),
					
					// Custom CSS	
					array(
						"label" => __("Custom CSS", "raw_theme"),
						"description" => __("Place any custom CSS above. This overrides any other stylesheets. eg: a.button{color: #FFF}", "raw_theme"),
						"id" => $shortname."_custom_css",
						"type" => "textarea"
					),
					
					// Header Search Form
					array(
						"label" => __("Enable Header Search Form", "raw_theme"),
						"description" => __("Check to enable search form in page header.", "raw_theme"),
						"id" => $shortname."_header_search",
						"type" => "checkbox",
						"std" => "false"
					)
				)			
			),			
			
			//////////////// APPEARANCE - BLOG /////////////////////
			"Blog" => array(
				
				"name" => __("Blog", "raw_theme"),
				"id" => "appearance_blog",
				"fields" => array(
					
					// Blog Background
					array(
						"label" => __("Blog Page background Image", "raw_theme"),
						"description" => __("Enter URL of the blog page background. Leave blank to use the website default background", "raw_theme"),
						"id" => $shortname."_blog_background",
						"type" => "text",
					),		
					
					// Blog Template
					array(
						"label" => __("Blog Index Layout", "raw_theme"),
						"description" => __("Select the preferred blog index layout", "raw_theme"),
						"id" => $shortname."_blog_layout",
						"type" => "select",
						"options" => array( __("Horizontal Layout", "raw_theme"), __("Vertical Layout", "raw_theme" ) ),
						"std" => __("Horizontal Search", "raw_theme")
					),
					
					// Author Name
					array(
						"label" => __("Enable Author Name Post Meta", "raw_theme"),
						"description" => __("Displays the author of a post in the post meta", "raw_theme"),
						"id" => $shortname."_enable_meta_author",
						"type" => "checkbox",
						"std" => "false"
					),
						
					// Date Post
					array(
						"label" => __("Enable Date Post Meta", "raw_theme"),
						"description" => __("Displays the date of a post in the post meta", "raw_theme"),
						"id" => $shortname."_enable_meta_date",
						"type" => "checkbox",
						"std" => "false"
					),
					
					// Ccategories
					array(
						"label" => __("Enable Categories Post Meta", "raw_theme"),
						"description" => __("Displays the post's categories in the post meta", "raw_theme"),
						"id" => $shortname."_enable_meta_categories",
						"type" => "checkbox",
						"std" => "false"
					)
				
				)
			),	
			
			//////////////// APPEARANCE - 404 /////////////////////
			"404" => array(
				
				"name" => __("404", "raw_theme"),
				"id" => "appearance_404",
				"fields" => array(
					
					// 404 Background
					array(
						"label" => __("404 Page background Image", "raw_theme"),
						"description" => __("Enter URL of the 404 page background. Leave blank to use the website default background", "raw_theme"),
						"id" => $shortname."_404_background",
						"type" => "text",
					),	
					
					// 404 Title	
					array(
						"label" => __("404 Page Title", "raw_theme"),
						"description" => __("The title displayed on the 404 error page.", "raw_theme"),
						"id" => $shortname."_404_title",
						"type" => "text"
					),
					
					// 404 Content	
					array(
						"label" => __("404 message", "raw_theme"),
						"description" => __("The message displayed on the 404 error page.", "raw_theme"),
						"id" => $shortname."_404_message",
						"type" => "textarea"
					)					
				)				
			),
				
			//////////////// APPEARANCE - Search /////////////////////
			"search" => array(
				
				"name" => __("Search", "raw_theme"),
				"id" => "appearance_search",
				"fields" => array(
					
					// Searcg Background
					array(
						"label" => __("Search Page background Image", "raw_theme"),
						"description" => __("Enter URL of the search page background. Leave blank to use the website default background", "raw_theme"),
						"id" => $shortname."_search_background",
						"type" => "text",
					),	
					
					// Search Template
					array(
						"label" => __("Search Layout", "raw_theme"),
						"description" => __("Select the preferred search results page layout", "raw_theme"),
						"id" => $shortname."_search_layout",
						"type" => "select",
						"options" => array( __("Horizontal Layout", "raw_theme"), __("Vertical Layout", "raw_theme" ) ),
						"std" => __("Horizontal Search", "raw_theme")
					)					
				)				
			),
			
			//////////////// APPEARANCE - Archive /////////////////////
			"Archive" => array(
				
				"name" => __("Archive", "raw_theme"),
				"id" => "appearance_archive",
				"fields" => array(
					
					// Archive Background
					array(
						"label" => __("Archive Page background Image", "raw_theme"),
						"description" => __("Enter URL of the archive page background. Leave blank to use the website default background", "raw_theme"),
						"id" => $shortname."_archive_background",
						"type" => "text",
					),	
					
					// Archive Template
					array(
						"label" => __("Archive Layout", "raw_theme"),
						"description" => __("Select the preferred archive layout", "raw_theme"),
						"id" => $shortname."_archive_layout",
						"type" => "select",
						"options" => array( __("Horizontal Layout", "raw_theme"), __("Vertical Layout", "raw_theme") ),
						"std" => __("Horizontal Layout", "raw_theme")
					)
					
				)				
			),
			
			//////////////// APPEARANCE - FOOTER /////////////////////
			"Footer" => array(
				
				"name" => __("Footer", "raw_theme"),
				"id" => "footer",
				"fields" => array(
					
					//Footer text
					array(
						"label" => __("Footer Text", "raw_theme"),
						"description" => __("Enter text shown beside copyright symbol in the footer", "raw_theme"),
						"id" => $shortname."_footer_text",
						"type" => "text"
					)
				)			
			)
		)
	),
	
	'Social' => array(
	
		//////////////// SOCIAL /////////////////////
		"name" => __("Social Networks", "raw_theme"),
		"id" => "social",		
		"icon" => "social_icon.png",
		'tabs' => array(
			
			//////////////// Social - GENERAL /////////////////////
			"Links" => array(
				
				"name" => __("General", "raw_theme"),
				"id" => "social_general",
				"fields" => array(
					
					// INFO
					array(
						"label" => "",
						"description" => __("If possible make sure you are not logged into any accounts when you copy / paste your social network profile URLs.", "raw_theme"),
						"type" => "info"						
					),
					
					//Email
					array(
						"label" => __("Contact Page URL", "raw_theme"),
						"description" => __("Enter URL to contact page to display link to contact page in Social menu", "raw_theme"),
						"id" => $shortname."_email",
						"type" => "text"
					),
					
					//RSS
					array( 
						"label" => __("Enable RSS Link", "raw_theme"),
						"description" => __("Display RSS link in Social menu", "raw_theme"),
						"id" => $shortname."_rss",
						"type" => "checkbox"
					),
					
					//Facebook
					array(
						"label" => __("Facebook Page URL", "raw_theme"),
						"description" => __("Enter URL to facebook page to display link in Social menu", "raw_theme"),
						"id" => $shortname."_facebook",
						"type" => "text"
					),
						
					//Twitter
					array(
						"label" => __("Twitter Page URL", "raw_theme"),
						"description" => __("Enter URL to Twitter page to display link in Social menu", "raw_theme"),
						"id" => $shortname."_twitter",
						"type" => "text"
					),
					
					//Google+
					array( 
						"label" => __("Google+ Page URL", "raw_theme"),
						"description" => __("Enter URL to Google+ page to display link in Social menu", "raw_theme"),
						"id" => $shortname."_google_plus",
						"type" => "text"
					),
					
					//Digg
					array( 
						"label" => __("Digg Page URL", "raw_theme"),
						"description" => __("Enter URL to Digg page to display link in Social menu", "raw_theme"),
						"id" => $shortname."_digg",
						"type" => "text"
					),
					
					//Myspace
					array(
						"label" => __("Myspace Profile URL", "raw_theme"),
						"description" => __("Enter URL to MySpace page to display link in Social menu", "raw_theme"),
						"id" => $shortname."_myspace",
						"type" => "text"
					),
					
					//Dribble
					array(
						"label" => __("Dribbble Profile URL", "raw_theme"),
						"description" => __("Enter URL to Dribbble page to display link in Social menu", "raw_theme"),
						"id" => $shortname."_dribbble",
						"type" => "text"
					),
					
					//flickr
					array( 
						"label" => __("Flickr Stream URL", "raw_theme"),
						"description" => __("Enter URL to Flickr page to display link in Social menu", "raw_theme"),
						"id" => $shortname."_flickr",
						"type" => "text"
					),
					
					//LinkedIn
					array( 
						"label" => __("LinkedIn Page URL", "raw_theme"),
						"description" => __("Enter URL to LinkedIn page to display link in Social menu", "raw_theme"),
						"id" => $shortname."_linkedin",
						"type" => "text"
					),
					
					//Vimeo
					array( 
						"label" => __("Vimeo URL", "raw_theme"),
						"description" => __("Enter URL to Vimeo page to display link in Social menu", "raw_theme"),
						"id" => $shortname."_vimeo",
						"type" => "text"
					),
					
					//youtube
					array( 
						"label" => __("YouTube Channel URL", "raw_theme"),
						"description" => __("Enter URL to YouTube page to display link in Social menu", "raw_theme"),
						"id" => $shortname."_youtube",
						"type" => "text"
					)
				)
			)			
		)
	)
);

function raw_first_setup() {
	
	global $sections, $shortname, $theme_options;
	
	// Create popular post table.
	raw_create_popular_table();
	
	// If theme options do not yet exist.
	if ( $theme_options  == NULL || $theme_options  == '' ) {
		
		$updated_theme_options = array();
		
		foreach ( $sections as $section ) {
			
			if( $section['tabs'] != NULL ) {
				
				foreach ( $section['tabs'] as $tab ) {
					
					if ( $tab['fields'] != NULL ) {
						
						foreach ( $tab['fields'] as $field ) {
						
							if ( $field['type'] != 'info' ){
							
								$updated_theme_options[ $field['id'] ] =  $field['std'] ;
							
							}
							
						}							
					}
				}					
			}
		}
		
		update_option( $shortname.'_theme_options', $updated_theme_options );
	
	}	
}

function raw_add_admin() {
 
	global $sections, $themename, $shortname;
	 
	if ( $_GET['page'] == basename(__FILE__) ) {
	 
		if ( 'save' == $_REQUEST['action'] ) {
			
			$updated_theme_options = array();
				
			foreach ( $sections as $section ) {
				
				if( $section['tabs'] != NULL ) {
					
					foreach ( $section['tabs'] as $tab ) {
						
						if ( $tab['fields'] != NULL ) {
							
							foreach ( $tab['fields'] as $field ) {
							
								if ( $field['type'] != 'info' ){
								
									$updated_theme_options[ $field['id'] ] = $_REQUEST[ $field['id'] ] ;
								
								}
								
							}							
						}
					}					
				}
			}
			
			update_option( $shortname.'_theme_options', $updated_theme_options );
			
			header("Location: admin.php?page=raw_panel.php&saved=true");
			die;
		
		} elseif ( 'reset' == $_REQUEST['action'] ) {
			
			$updated_theme_options = array();
			
			foreach ( $sections as $section ) {
				
				if( $section['tabs'] != NULL ) {
					
					foreach ( $section['tabs'] as $tab ) {
						
						if ( $tab['fields'] != NULL ) {
							
							foreach ( $tab['fields'] as $field ) {
							
								if ( $field['type'] != 'info' ){
								
									$updated_theme_options[ $field['id'] ] =  $field['std'] ;
								
								}
								
							}							
						}
					}					
				}
			}
			
			
			update_option( $shortname.'_theme_options', $updated_theme_options );
			
			header("Location: admin.php?page=raw_panel.php&reset=true");
			die;
	 
		}

	}
 
	add_menu_page($themename.' settings', $themename, 'administrator', basename(__FILE__), 'raw_admin');
	
}

function raw_add_init() {

	$file_dir = get_bloginfo('template_directory');
	wp_enqueue_style("raw_panel", $file_dir."/raw_framework/raw_panel/raw_panel.css", false, "1.0", "all");
	wp_enqueue_style("colorpicker", $file_dir."/raw_framework/raw_panel/colorpicker.css", false, "1.0", "all");

}

function raw_admin() {
 
	global $sections, $themename, $shortname, $theme_options;

?>

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/raw_framework/raw_panel/raw_panel.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/raw_framework/raw_panel/colorpicker.js"></script>

<script type="text/javascript">

	jQuery(document).ready(function($) {
		
		// Set active section
		sectionSelection();
		
		// Set active tab
		tabSelection();
		
		// Show and Hide
		$('#raw_panel_left > li:first').addClass('active');
		$('#raw_panel_right > li').hide();
		$('#raw_panel_right > li:first').show().addClass('active');
		
 
		$('.cb-enable').live('click', function () {
			var parent = $(this).parents('.switch');
			$('.cb-disable', parent).removeClass('selected');
			$(this).addClass('selected');
			$('.checkbox', parent).attr('checked', true);
			$('.checkbox', parent).change();
		});
		$('.cb-disable').live('click',function () {
			var parent = $(this).parents('.switch');
			$('.cb-enable', parent).removeClass('selected');
			$(this).addClass('selected');
			$('.checkbox', parent).attr('checked', false);
			$('.checkbox', parent).change();
		});
		
		// COLOR PICKER
		$('.colorSelector').ColorPicker({
			
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},

			onSubmit: function(hsb, hex, rgb, el) {
				$(el).val(hex);
				$(el).ColorPickerHide();
				$(el).css({ 'background-color' : '#'+hex });
			},
			onBeforeShow: function () {
				$(this).ColorPickerSetColor(this.value);
			}
			
		})
	
	});

</script>

	<!-- START OF PAGE -->
	<div id="raw_panel_wrapper">
		
		<?php
		
			if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' '. __("settings saved.", "raw_theme") .'</strong></p></div>';
			if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' '. __("settings reset.", "raw_theme") .'</strong></p></div>';
			
		?>
		
		<!-- START OF PANEL -->
		<div id="raw_panel">
		
			<!-- PANEL HEADER -->
			<div id="raw_header">
				<p><?php _e("Welcome to the Raw Options panel. From here you can customise your WordPress website by configuring the options found below.", "raw_theme");?></p>

			</div>
		
			<!-- SECTIONS SIDEBAR -->
			<ul id="raw_panel_left">
				
				<?php
					
					$output = '';
				
					foreach( $sections as $section ) {
					
						$output .= '<li id="raw_section_'.$section['id'].'"><img src="'.get_bloginfo('template_directory').'/raw_framework/raw_panel/images/'.$section['icon'].'" alt="" />'.$section['name'].'</li>';
						
					}
					
					echo $output;
					
				?>
				
			</ul>
			
			<form method="post">
				
				<ul id="raw_panel_right">
		
					<?php
					
						$output = '';
						
						foreach( $sections as $section ) {
							
							// EACH SECTIONS TAB HOLDER
							$output .= '<li class="raw_section_'. $section['id'].'">';
								
								$output .= '<ul class="raw_section_tabs">';
								
								if($section['tabs'] != NULL) {
									
									foreach($section['tabs'] as $tab) {
										// INDIVIDUAL TABS
										$output .= '<li id="raw_tab_'.$tab['id'].'">'.$tab['name'].'</li>';
									
									}
								
								}
								
								$output .= '</ul>';
								
								// HOLDS ALL PANELS
								$output .= '<ul class="raw_section_panels">';
								
									if($section['tabs'] != NULL) {
										
										foreach($section['tabs'] as $tab) {
											
											// INDIVIDUAL TABS PANEL
											$output .= '<li class="raw_tab_'.$tab['id'].'">';
											
												if($tab['fields'] != NULL) {
													
													foreach($tab['fields'] as $field) {
														
														if ( $field['type'] == 'info' ) {
															
															// INFO
															
															$output .= '<div class="field">';
															
																$output .= '<p class="info">'.$field['description'].'</p>';
															
															$output .= '</div>';
															
														} else {
														
															$output .= '<div class="field">';
																
																$output .= '<div class="left-fields">';
																	
																	$output .= '<p>'.$field['label'].'</p>';
																	
																$output .= '</div>';
																	
																$output .= '<div class="right-fields">';
																	
																	switch ( $field['type'] ) {
																
																		// TEXT
																		case "text":															
																			
																			if ( $theme_options[ $field['id'] ] != "" ) {																			
																				$output .= '<input name="'.$field['id'].'" id="'.$field['id'].'" type="'.$field['type'].'" value="'. htmlspecialchars(stripslashes( $theme_options[ $field['id'] ] )).'" />';
																				
																			} else {
																			
																				$output .= '<input name="'.$field['id'].'" id="'.$field['id'].'" type="'.$field['type'].'" value="'.$field['std'].'" />';
																				
																			}
																		
																		break;
																
																		// TEXTAREA
																		case "textarea":	
																		
																			if ( $theme_options[ $field['id'] ] != "" ) {																			
																				$output .= '<textarea name="'.$field['id'].'" id="'.$field['id'].'" type="'.$field['type'].'">'. htmlspecialchars(stripslashes( $theme_options[ $field['id'] ] )).'</textarea>';
																				
																			} else {
																			
																				$output .= '<textarea name="'.$field['id'].'" id="'.$field['id'].'" type="'.$field['type'].'">'.$field['std'].'</textarea>';
																				
																			}
																		
																		break;
																
																		// SELECT
																		case "select":
																		
																			$output .= '<select name="'.$field['id'].'" id="'.$field['id'].'">';
																			
																				foreach ($field['options'] as $option) {
																					
																					if ( $theme_options[ $field['id'] ] == $option ) {																		
																						$output .= '<option selected="selected">'.$option.'</option>';																		
																					} else {																		
																						$output .= '<option>'.$option.'</option>';																		
																					}
																					
																				}
																			
																			$output .= '</select>';
																		
																		break;
																	
																		// CHECKBOX
																		case "checkbox":
																			
																			if( $theme_options[ $field['id'] ] ){
																			
																				$output .= '<div class="switch">
																					<label class="cb-enable selected"><span>'.__("On", "raw_theme").'</span></label>
																					<label class="cb-disable"><span>'.__("Off", "raw_theme").'</span></label>
																					<input type="checkbox" id="'.$field['id'].'" name="'.$field['id'].'" value="true" class="checkbox" checked="checked" />
																				</div>';
																			
																			}else{
																			
																				$output .= '<div class="switch">
																					<label class="cb-enable"><span>'.__("On", "raw_theme").'</span></label>
																					<label class="cb-disable selected"><span>'.__("Off", "raw_theme").'</span></label>
																					<input type="checkbox" id="'.$field['id'].'" name="'.$field['id'].'" value="true" class="checkbox" />
																				</div>';	
																			
																			}
																			
																		break;

																		// COLOUR PICKER
																		case "colour":
																		
																			if ( $theme_options[ $field['id'] ] != "" ) {
													
																				$output .= '<input type="text" value="'. stripslashes($theme_options[$field['id']]) .'" name="'.$field['id'].'" id="'.$field['id'].'" class="colorSelector" maxlength="6" style="background: #'. stripslashes($theme_options[$field['id']]) .';" />';
																				

																			} else {
																				
																				$output .= '<input type="text" value="'. $field['std'] .'" name="'.$field['id'].'" id="'.$field['id'].'" class="colorSelector" maxlength="6" style="background: #'. $field['std'] .';" />';
																			
																			}
																		
																		break;

																	}
															
																	$output .= '<span>'.$field['description'].'</span>';
															
																$output .= '</div>';
																
															$output .= '</div>';
														}
													}
												
												}
											
											$output .= '</li>';
										
										}
									
									}
									
									$output .= '<input type="submit" name="save-button" class="submit-button save" value="'. __("Save Changes", "raw_theme") .'" />';
								
								$output .= '</ul>';
					
							$output .= '</li>';
						
						}
						
						echo $output;
					
					?>
				
				</ul>
				
				<input type="hidden" name="action" value="save" />
				
			</form>
			
		</div>
		<!-- END OF PANEL -->
		
	</div>
	<!-- END OF PAGE -->
<?php }

add_action('admin_init', 'raw_add_init');
add_action('admin_menu', 'raw_add_admin');

?>