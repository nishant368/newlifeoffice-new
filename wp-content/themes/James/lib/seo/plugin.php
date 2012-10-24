<?php

/**
We are making use of the smartSeo plugin from AA-Team
http://codecanyon.net/user/AA-Team

Modified by: Theme-dutch
http://themeforest.net/user/themedutch/portfolio
**/
class smartSeo {

    public $prefix = 'smartSeo';
    public $admin_options;
    public $utils = array(
        'shortname' => 'SEO Module',
        'icon' => 'smart_framework/images/td-icon.png',
    );

    function __construct() {
        $this->constants();

        // globals utils
        $this->functions();

        // admin framework
        $this->admin();

        // admin frontpage
        $this->frontpage();

        /* Plugin init hook. */
        do_action("{$this->prefix}_init");

        // try redirect
        $this->my_plugin_redirect();
    }

    // Defines the constant paths for use within the theme.
    function constants() {
        global $wpdb;

        define('PLUGIN_NAME', 'seo');
        define('PLUGIN_DIR', ABSPATH . '/wp-content/themes/James/lib/' . PLUGIN_NAME . '/');
        define('PLUGIN_URI', home_url() . '/wp-content/themes/James/lib/' . PLUGIN_NAME . '/');

        define('PLUGIN_LIBRARY', PLUGIN_DIR . '/');
        define('PLUGIN_INSTALL', PLUGIN_DIR . '/install');
        define('SMART_FRAMEWORK', PLUGIN_DIR . '/smart_framework');
        define('SMART_MODS', PLUGIN_DIR . '/smart_mods');

        define('PLUGIN_FRONTPAGE', PLUGIN_DIR . '/frontpage');
        define('PLUGIN_FRONTPAGE_URI', PLUGIN_URI . 'frontpage/');

        define('PLUGIN_ADMIN', SMART_FRAMEWORK . '/admin');
        define('PLUGIN_FUNCTIONS', SMART_FRAMEWORK . '/functions');

        define('PLUGIN_OPTIONS', SMART_MODS . '/options');

        define('ADMIN_IMAGES', PLUGIN_URI . '/smart_framework/images');
        define('ADMIN_CSS', PLUGIN_URI . '/smart_framework/css');
        define('ADMIN_JS', PLUGIN_URI . '/smart_framework/js');
        define('PLUGIN_IMAGES', PLUGIN_URI . '/images');
        define('PLUGIN_CSS', PLUGIN_URI . '/css');
        define('PLUGIN_JS', PLUGIN_URI . '/js');
    }

    // Loads the core frontpage functions.
    function functions() {
        // utils
        require_once( PLUGIN_FUNCTIONS . '/array_walk_recursive.php' );
        require_once( PLUGIN_FUNCTIONS . '/core.php' );
        require_once( PLUGIN_FUNCTIONS . '/get_image.php' );
        require_once( PLUGIN_FUNCTIONS . '/ajax_upload.php' );
        require_once( PLUGIN_FUNCTIONS . '/upload.php' );
        require_once( PLUGIN_FUNCTIONS . '/options_generator.php' );
        require_once( PLUGIN_FUNCTIONS . '/save_options.php' );
    }

    // Load admin files.
    function admin() {
        if (is_admin()) {
            require_once( PLUGIN_ADMIN . '/admin.php' );
            require_once( PLUGIN_ADMIN . '/init_options.php' );
            require_once( PLUGIN_OPTIONS . '/admin_options.php' );
            require_once( PLUGIN_OPTIONS . '/post_options.php' );
            require_once( PLUGIN_ADMIN . '/admin_interface_page.php' );
            require_once( PLUGIN_ADMIN . '/options_page_content.php' );
            require_once( PLUGIN_ADMIN . '/support_interface_page.php' );
            require_once( PLUGIN_ADMIN . '/save_options.php' );
            require_once( PLUGIN_ADMIN . '/post_block.php' );
        }
    }

    // [smartSeo]
    function smartSeo_function($atts=array()) {
        require_once( PLUGIN_FRONTPAGE . '/slider.php' );
        return $slider_content;
    }

    // Load frontpage
    function frontpage() {
        if (!is_admin()) {
            add_action('wp_head', array(&$this, 'addMeta'));
            add_filter('wp_title', array(&$this, 'addTitle'), 9, 3);
        }
    }

    function addMeta(){
        global $post;
        $values = array('description', 'keywords');
        foreach ($values AS $name) {
            $content = get_post_meta($post->ID, $this->prefix . "_" . $name, true);
            echo "<meta name='".$name."' content='".esc_attr($content)."' />\r\n"; 
        }   
    }
    
    function addTitle(){
        global $wppm_title, $post;
				$title = '';
        
        $sep = get_option($this->prefix . '_separator', false);
        $seplocation = get_option($this->prefix . '_position', false);
        $custom = isset($wppm_title) ? $wppm_title : get_post_meta($post->ID, $this->prefix . "_title", true);
       
        if ($custom) {
            return ($seplocation == '1') ? $custom.' '.$sep.' ' : $custom . ' ' . $sep;
        }
        return $title;
    }
        
    function my_plugin_redirect() {
        if (get_option($this->prefix . '_redirect', false)) {
            delete_option($this->prefix . '_redirect');
            header('location: admin.php?page=' . $this->prefix);
        }
    }

    public function getRealIpAddr() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    // call on activate
    // reset all settings to default values
    function activate() {
        global $wpdb;

        // load sql file as binary
        $mySQL = PLUGIN_INSTALL . "/default.sql";

        $handle = @fopen($mySQL, "r");
        if ($handle) {
            while (($theQUERY = fgets($handle, 99999)) !== false) {
                // replace content table 
                $theQUERY = str_replace("option_table", $wpdb->prefix . "options", $theQUERY);
				// execute query 
				$wpdb->query(str_replace("wp-content/", home_url() . "/wp-content/", $theQUERY));
            }
            if (!feof($handle)) {
                echo "Error: unexpected fgets() fail (default install)\n";
            }
            fclose($handle);
        }

        // set redirect true
        add_option($this->prefix . '_redirect', true);
    }

    function deactivate() {
        global $wpdb;
        
        var_dump('<pre>',get_option($this->prefix . '_deactivate_remove', false) ,'</pre>'); 
        if(get_option($this->prefix . '_deactivate_remove', false) == true){
            // execute query
            $wpdb->query("delete from " . $wpdb->prefix . "options" . " where 1=1 and `option_name` like '%smartSeo_%'");
        }
    }

}

/* Initialize plugin and the smart framework. */
$smartSeo = new smartSeo();

if (is_admin ()) {
    if(get_option($smartSeo->prefix . '_' . 'showScoreSeo') == "true"){
        add_filter('manage_posts_columns', 'smartSeo_add_post_columns');
        function smartSeo_add_post_columns($my_columns) {
            $new_my_columns['cb'] = '<input type="checkbox" />';
            $new_my_columns['seoScore'] = __('SEO Score');
            $new_my_columns['title'] = __('Title');
            $new_my_columns['author'] = __('Author');
            $new_my_columns['categories'] = __('Category');
            $new_my_columns['tags'] = __('Tags');
            $new_my_columns['comments'] = __('Comments');
            $new_my_columns['date'] = _x('Date', 'column name');
            return $new_my_columns;
        }

        // Add to admin_init function
        add_action('manage_posts_custom_column', 'smartSeo_manage_my_columns');
         function smartSeo_manage_my_columns($column){
            global $post;
            switch($column):
                case 'seoScore':
                    $curr_hits = get_post_meta($post->ID,  'smartSeo_lastScore', true);
                    if(trim($curr_hits == "")) $curr_hits = 0;
                    echo "<div class='smartSeoPoints'>" . $curr_hits . "%</div>";
                    break;
            endswitch;
        }
        function smartSeo_custom_cols_css() {
            echo '<style type="text/css">
            th#seoScore {
                width: 80px;
            }
            .smartSeoPoints {
               width: 80%;
               height: 21px;
               margin: 10px;
               text-align: center;
               padding: 0;
               font-size: 12px;
               text-shadow: 1px 1px 1px #fff;
               font-weight: bold;
               background: #648aae;
               box-shadow: 0 1px 5px #0061aa, inset 0 10px 20px #b6f9ff;
               -o-box-shadow: 0 1px 5px #0061aa, inset 0 10px 20px #b6f9ff;
               -webkit-box-shadow: 0 1px 5px #0061aa, inset 0 10px 20px #b6f9ff;
               -moz-box-shadow: 0 1px 5px #0061aa, inset 0 10px 20px #b6f9ff;
            }
            </style>';
        }
        add_action('admin_head', 'smartSeo_custom_cols_css');
    }

    /* Make the class works first */
    if (isset($smartSeo)) {
        register_activation_hook(dirname(__FILE__) . '/plugin.php', array($smartSeo, 'activate'));
        register_deactivation_hook(dirname(__FILE__) . '/plugin.php', array($smartSeo, 'deactivate'));
    }
}