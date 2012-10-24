<?php

// ---------- POPULAR POSTS ----------//

global $wpdb;
$raw_pp_tablename = $wpdb->prefix .'post_views';
  
function raw_create_popular_table(){  
    global $wpdb, $raw_pp_tablename;  
    $pp_table = $wpdb->get_results("SHOW TABLES LIKE '{$raw_pp_tablename}'" , ARRAY_N);
    if( $wpdb->get_var("SHOW TABLES LIKE $raw_pp_tablename'") != $raw_pp_tablename) { 
        $create_table = "CREATE TABLE ". $raw_pp_tablename ." ( 
            id BIGINT(50) NOT NULL AUTO_INCREMENT, 
            post_id VARCHAR(255) NOT NULL,	
            views BIGINT(50) NOT NULL, 
            PRIMARY KEY (id), 
            UNIQUE (id) 
        );";
        $wpdb->query($create_table); 
    }  
}

function raw_page_viewed(){  
    if( is_single() && get_post_type() == 'post' ){ 
        global $wpdb, $post, $raw_pp_tablename;
        $wpdb->flush();
        $data = $wpdb->get_row("SELECT * FROM {$raw_pp_tablename} WHERE post_id='{$post->ID}'", ARRAY_A);  
        
		if( !is_null($data) ){ 
            $new_views = $data['views'] + 1; 
            $wpdb->query("UPDATE {$raw_pp_tablename} SET views='{$new_views}' WHERE post_id='{$post->ID}';"); 
            $wpdb->flush();
        } else {
            $wpdb->query("INSERT INTO {$raw_pp_tablename} (post_id, views) VALUES ('{$post->ID}','1');");
            $wpdb->flush();
        }  
    }  
}  
add_action('wp_head', 'raw_page_viewed');


// SIDEBAR WIDGET //
class raw_widget_popular_posts extends WP_Widget {

	function raw_widget_popular_posts() {
		$widget_ops = array( 'classname' => 'raw_popular_posts', 'description' => __( "A list of most viewed blog posts.", 'raw_theme' ) );
		$this->WP_Widget( false, 'Raw Popular Posts', $widget_ops );
	}

	function widget($args, $instance) {
		
		global $wpdb, $raw_pp_tablename;
		
		extract($args);
		
		$title = apply_filters('widget_title', $instance['title']);
		$number = $instance['number_of_posts'];
		
		echo $before_widget;
		echo $before_title . $title . $after_title;
		echo "<ol id='raw_popular_posts'>";
			
		$popular_posts = $wpdb->get_results("SELECT * FROM {$raw_pp_tablename} ORDER BY views DESC LIMIT 0,{$number}",ARRAY_N);
			
		foreach( $popular_posts as $post ){
			$ID = $post[1];
			$views = number_format( $post[2] );
			$post_url = get_permalink( $ID );
			$title = get_the_title( $ID );
			
			echo '<li>';
				if (get_the_post_thumbnail($ID)) {
					echo '<a href="'. $post_url .'">'.get_the_post_thumbnail( $ID, '55x55' ).'</a>';
				}
				
				if($title == ''){
					echo '<h5>Deleted Post</h5>';
				} else {
					echo'<h5><a href="'. $post_url .'">'. $title .'</a></h5>';
				}
			
				echo '<em>'. $views .' '. __("views", "raw_theme").'</em>
					
			</li>';
		} 
		
		echo "</ol>";
		echo $after_widget;
        
	}

	function update($new_instance, $old_instance) {
	
		return $new_instance;
		
	}

	function form($instance) {
		
		// Title
		$title = esc_attr( $instance['title'] );
		echo '<p><label for="'. $this->get_field_id( 'title' ) .'">'. _e( 'Title:', 'raw_theme' ) .'<input class="widefat" id="'. $this->get_field_id('title') .'" name="'. $this->get_field_name('title') .'" type="text" value="'. $title .'" /></label></p>';
		
		// Number of posts to output
		echo '<p><label for="'. $this->get_field_id( 'number_of_posts' ) .'">'. _e( 'Number of Posts:', 'raw_theme' ) .'<input id="'. $this->get_field_id('number_of_posts') .'" name="'. $this->get_field_name('number_of_posts') .'" type="text" value="'. $instance['number_of_posts'] .'" /></label></p>';
	
	}

}

add_action('widgets_init', create_function('', 'return register_widget("raw_widget_popular_posts");'));


// ---------- RELATED POSTS ----------//

class raw_widget_related_posts extends WP_Widget {

	function raw_widget_related_posts() {
		$widget_ops = array( 'classname' => 'raw_related_posts', 'description' => __( "A list of posts related to the current page by first category.", 'raw_theme' ) );
		$this->WP_Widget( false, 'Raw Related Posts', $widget_ops );
	}

	function widget($args, $instance) {
		
		extract($args);
		
		if ( is_single() ) {
		
			$cat = get_the_category();
			$cat = $cat[0];
			$query_args = array(
				'posts_per_page' => $instance['number_of_posts'],
				'category' => $cat->cat_ID
			);
		
			$releated_posts = get_posts($query_args); //gets arguments from array above
			
			$title = apply_filters('widget_title', $instance['title']);
				
			echo $before_widget;
			echo $before_title . $title . $after_title;
			echo "<ol id='raw_related_posts'>";
				
			foreach($releated_posts as $post) { //loops through posts 
				
				setup_postdata($post); //sets up posts ?>
				
				<li>
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( '55x55' ); ?></a>
					<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
					<em><?php the_time( get_option( 'date_format' ) ); ?></em>
				</li>

			<?php }
				
			echo "</ol>";
			echo $after_widget;
	
		}
        
	}

	function update($new_instance, $old_instance) {
	
		return $new_instance;
		
	}

	function form($instance) {
		
		// Title
		$title = esc_attr( $instance['title'] );
		echo '<p><label for="'. $this->get_field_id( 'title' ) .'">'. _e( 'Title:', 'raw_theme' ) .'<input class="widefat" id="'. $this->get_field_id('title') .'" name="'. $this->get_field_name('title') .'" type="text" value="'. $title .'" /></label></p>';
		
		// Number of posts to output
		echo '<p><label for="'. $this->get_field_id( 'number_of_posts' ) .'">'. _e( 'Number of Posts:', 'raw_theme' ) .'<input id="'. $this->get_field_id('number_of_posts') .'" name="'. $this->get_field_name('number_of_posts') .'" type="text" value="'. $instance['number_of_posts'] .'" /></label></p>';
	
	}

}

//add_action('widgets_init', create_function('', 'return register_widget("raw_widget_related_posts");'));


// ---------- TWITTER FEED ----------//


class raw_widget_twitter extends WP_Widget {

	function raw_widget_twitter() {
		$widget_ops = array( 'classname' => 'raw_twitter', 'description' => __( "A stream of latest tweets from the specified twitter account.", 'raw_theme' ) );
		$this->WP_Widget( false, 'Raw Twitter', $widget_ops );
	}

	function widget($args, $instance) {
		
		extract($args);

		$title = apply_filters('widget_title', $instance['title']);
		$count = $instance['count'];
		$id = $instance['username'];
		
		$output = $before_widget . $before_title . $title . $after_title;
		
		$container = 'tweets-'. rand(0,9999);
		
		//output script
		$output .= '<script type="text/javascript" charset="utf-8">
		getTwitters(\''.$container.'\', {
        id: \''.$id.'\',
		prefix: \'\',
        clearContents: true,
        count: '.$count.', 
        ignoreReplies: false,
        newwindow: true,
        template: \'<span>%text%</span> <a href="http://twitter.com/%user_screen_name%/statuses/%id_str%/"" style="font-size:85%">%time%</a>\'
		});
		</script>';
	
		//output container
		$output .= '<div class="twitter-feed" id="'.$container.'"></div>';

		$output .= '<a href="http://www.twitter.com/'.$id.'" class="button right">'.__("Follow", "raw_theme").'</a>';
		$output .= $after_widget;
		
		echo $output;
        
	}

	function update($new_instance, $old_instance) {
	
		return $new_instance;
		
	}

	function form($instance) {
		
		// Title
		$title = esc_attr( $instance['title'] );
		echo '<p><label for="'. $this->get_field_id( 'title' ) .'">'. _e( 'Title:', 'raw_theme' ) .'<input class="widefat" id="'. $this->get_field_id('title') .'" name="'. $this->get_field_name('title') .'" type="text" value="'. $title .'" /></label></p>';
		
		// Twitter Username
		$username = esc_attr( $instance['username'] );
		echo '<p><label for="'. $this->get_field_id( 'username' ) .'">'. _e( 'Twitter Username:', 'raw_theme' ) .'<input class="widefat" id="'. $this->get_field_id('username') .'" name="'. $this->get_field_name('username') .'" type="text" value="'. $username .'" /></label></p>';
		
		// Number of tweets
		$count = esc_attr( $instance['count'] );
		echo '<p><label for="'. $this->get_field_id( 'count' ) .'">'. _e( 'Number of Tweets:', 'raw_theme' ) .'<input id="'. $this->get_field_id('count') .'" name="'. $this->get_field_name('count') .'" type="text" value="'. $count .'" /></label></p>';
	
	}

}

add_action('widgets_init', create_function('', 'return register_widget("raw_widget_twitter");'));


// ---------- SOCIAL BUTTONS ----------//

class raw_widget_social extends WP_Widget {

	function raw_widget_social() {
		$widget_ops = array( 'classname' => 'raw_social', 'description' => __( "Buttons linking to social network pages." ) );
		$this->WP_Widget( false, 'Raw Social Network Buttons', $widget_ops );
	}

	function widget($args, $instance) {
		
		global $theme_options, $shortname;
		
		extract($args);

		$title = apply_filters('widget_title', $instance['title']);
		
		$output = $before_widget . $before_title . $title . $after_title;
		
		$output .= '<ul class="social-button-holder">';
		
			if ($theme_options[$shortname.'_email'] != '') {
				$output .= '<li><a class="email-button" title="'.__("Contact Page", "raw_theme").'" href="'. $theme_options[$shortname.'_email'] .'">Contact</a></li>';
			}
			if ($theme_options[$shortname.'_rss'] == 'true') {
				$output .= '<li><a class="rss-button" title="'.__("Follow the RSS", "raw_theme").'" href="'. get_bloginfo('rss2_url') .'">Feed</a></li>';
			}			
			if ($theme_options[$shortname.'_facebook'] != '') {
				$output .= '<li><a class="facebook-button" title="'.__("Follow on Facebook", "raw_theme").'" href="'. $theme_options[$shortname.'_facebook'] .'">facebook</a></li>';
			}
			if ($theme_options[$shortname.'_twitter'] != '') {
				$output .= '<li><a class="twitter-button" title="'.__("Follow on Twitter", "raw_theme").'" href="'. $theme_options[$shortname.'_twitter'] .'">twitter</a></li>';
			}			
			if ($theme_options[$shortname.'_google_plus'] != '') {
				$output .= '<li><a class="google-button" title="'.__("Follow on Google+", "raw_theme").'" href="'. $theme_options[$shortname.'_google_plus'] .'">Google+</a></li>';
			}
			if ($theme_options[$shortname.'_digg'] != '') {
				$output .= '<li><a class="digg-button" title="'.__("Follow on Digg", "raw_theme").'" href="'. $theme_options[$shortname.'_digg'] .'">Digg</a></li>';
			}
			if ($theme_options[$shortname.'_myspace'] != '') {
				$output .= '<li><a class="myspace-button" title="'.__("Follow on Myspace", "raw_theme").'" href="'. $theme_options[$shortname.'_myspace'] .'">Myspace</a></li>';
			}
			if ($theme_options[$shortname.'_dribbble'] != '') {
				$output .= '<li><a class="dribbble-button" title="'.__("Follow on Dribbble", "raw_theme").'" href="'. $theme_options[$shortname.'_dribbble'] .'">Dribbble</a></li>';
			}
			if ($theme_options[$shortname.'_flickr'] != '') {
				$output .= '<li><a class="flickr-button" title="'.__("Follow on Flickr", "raw_theme").'" href="'. $theme_options[$shortname.'_flickr'] .'">Flickr</a></li>';
			}
			if ($theme_options[$shortname.'_linkedin'] != '') {
				$output .= '<li><a class="linkedin-button" title="'.__("Follow on LinkedIn", "raw_theme").'" href="'. $theme_options[$shortname.'_linkedin'] .'">LinkedIn</a></li>';
			}			
			if ($theme_options[$shortname.'_vimeo'] != '') {
				$output .= '<li><a class="vimeo-button" title="'.__("Follow on Vimeo", "raw_theme").'" href="'. $theme_options[$shortname.'_vimeo'] .'">Vimeo</a></li>';
			}
			if ($theme_options[$shortname.'_youtube'] != '') {
				$output .= '<li><a class="youtube-button" title="'.__("Follow on YouTube", "raw_theme").'" href="'. $theme_options[$shortname.'_youtube'] .'">YouTube</a></li>';
			}
			
		
		$output .= '</ul>';
		
		$output .= $after_widget;
		
		echo $output;
        
	}

	function update($new_instance, $old_instance) {
	
		return $new_instance;
		
	}

	function form($instance) {
		
		// Title
		$title = esc_attr( $instance['title'] );
		echo '<p><label for="'. $this->get_field_id( 'title' ) .'">'. _e( 'Title:', 'raw_theme' ) .'<input class="widefat" id="'. $this->get_field_id('title') .'" name="'. $this->get_field_name('title') .'" type="text" value="'. $title .'" /></label></p>';
		
	}

}

add_action('widgets_init', create_function('', 'return register_widget("raw_widget_social");'));


// ---------- RECENT POSTS ----------//

class raw_widget_recent_posts extends WP_Widget {

	function raw_widget_recent_posts() {
		$widget_ops = array( 'classname' => 'raw_recent_posts', 'description' => __( "A list of recent blog posts", "raw_theme" ) );
		$this->WP_Widget( false, 'Raw Recent Posts', $widget_ops );
	}

	function widget($args, $instance) {
		
		extract($args);
	
		$query_args = array(
			'posts_per_page' => $instance['number_of_posts'],
			'post__not_in' => array( $post->ID ),
		);
		$recent_posts = new WP_query();
		$recent_posts->query($query_args);
		
		$title = apply_filters('widget_title', $instance['title']);

		echo $before_widget . $before_title . $title . $after_title;
		
		echo '<ol id="raw_recent_posts">';
		
			if ($recent_posts->have_posts()) {
				
				while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
					
					<li>
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( '55x55' ); ?></a>
						<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
						<em><?php the_time( get_option( 'date_format' ) );  ?></em>
					</li>

				<?php endwhile;
				
			} else {
				
				echo '<li><h6>'._e("No recent posts.", "raw_theme").'</h6></li>';
				
			}
			
		echo '</ol>';
		
		echo $after_widget;
		
	}

	function update($new_instance, $old_instance) {
	
		return $new_instance;
		
	}

	function form($instance) {
		
		// Title
		$title = esc_attr( $instance['title'] );
		echo '<p><label for="'. $this->get_field_id( 'title' ) .'">'. _e( 'Title:', 'raw_theme' ) .'<input class="widefat" id="'. $this->get_field_id('title') .'" name="'. $this->get_field_name('title') .'" type="text" value="'. $title .'" /></label></p>';
		
		// Number of posts to output
		echo '<p><label for="'. $this->get_field_id( 'number_of_posts' ) .'">'. _e( 'Number of Posts:', 'raw_theme' ) .'<input id="'. $this->get_field_id('number_of_posts') .'" name="'. $this->get_field_name('number_of_posts') .'" type="text" value="'. $instance['number_of_posts'] .'" /></label></p>';
	
	}

}
add_action('widgets_init', create_function('', 'return register_widget("raw_widget_recent_posts");'));

// ---------- CONTACT DETAILS WIDGET ----------//

class raw_widget_contact_details extends WP_Widget {

	function raw_widget_contact_details() {
		$widget_ops = array( 'classname' => 'raw_contact', 'description' => __( "Contact details" ) );
		$this->WP_Widget( false, 'Raw Contact Details', $widget_ops );
	}

	function widget($args, $instance) {
		
		extract($args);

		$title = apply_filters('widget_title', $instance['title']);
		
		$output = $before_widget . $before_title . $title . $after_title;
		
		$output .= '<div class="raw_contact_holder">';
		
			$address = false;
			
			// Address
			if ($instance['address_line_1'] != '') {
				$output .= '<p>'.$instance['address_line_1'].'</p>';
				$address = true;
			}
			if ($instance['address_line_2'] != '') {
				$output .= '<p>'.$instance['address_line_2'].'</p>';
				$address = true;
			}
			if ($instance['address_line_3'] != '') {
				$output .= '<p>'.$instance['address_line_3'].'</p>';
				$address = true;
			}
			if ($instance['address_line_4'] != '') {
				$output .= '<p>'.$instance['address_line_4'].'</p>';
				$address = true;
			}
			if ($instance['address_line_5'] != '') {
				$output .= '<p>'.$instance['address_line_5'].'</p>';
				$address = true;
			}
			if ($instance['address_line_6'] != '') {
				$output .= '<p>'.$instance['address_line_6'].'</p>';
				$address = true;
			}
			
			if ($address == true) {
				$output .= '<br/>';
			}
			
			// Phone
			if ($instance['phone'] != '') {
				$output .= '<p>'.__('Tel', 'raw_theme').': '.$instance['phone'].'</p>';
				$phone = true;
			}
			if ($instance['mobile'] != '') {
				$output .= '<p>'.__('Mobile', 'raw_theme').': '.$instance['mobile'].'</p>';
				$phone = true;
			}
			if ($instance['fax'] != '') {
				$output .= '<p>'.__('Fax', 'raw_theme').': '.$instance['fax'].'</p>';
				$phone = true;
			}
			
			if ($phone = true) {
				$output .= '<br/>';
			}
			
			//Website
			if ($instance['website'] != '') {
				$output .= '<p>'.$instance['website'].'</p>';
			}
			if ($instance['email'] != '') {
				$output .= '<p>'.$instance['email'].'</p>';
			}
			
		
		$output .= '</div>';
		
		$output .= $after_widget;
		
		echo $output;
        
	}

	function update($new_instance, $old_instance) {
	
		return $new_instance;
		
	}

	function form($instance) {
		
		// Title
		$title = esc_attr( $instance['title'] );
		echo '<p><label for="'. $this->get_field_id( 'title' ) .'">'. _e( 'Title:', 'raw_theme' ) .'<input class="widefat" id="'. $this->get_field_id('title') .'" name="'. $this->get_field_name('title') .'" type="text" value="'. $title .'" /></label></p>';
		
		// Address
		echo '<p><label for="'. $this->get_field_id( 'address_line_1' ) .'">'. _e( 'Address:', 'raw_theme' ) .'<input class="widefat" id="'. $this->get_field_id('address_line_1') .'" name="'. $this->get_field_name('address_line_1') .'" type="text" value="'. $instance['address_line_1'] .'" /></label></p>';
		echo'<input class="widefat" id="'. $this->get_field_id('address_line_2') .'" name="'. $this->get_field_name('address_line_2') .'" type="text" value="'. $instance['address_line_2'] .'" /></p>';
		echo'<input class="widefat" id="'. $this->get_field_id('address_line_3') .'" name="'. $this->get_field_name('address_line_3') .'" type="text" value="'. $instance['address_line_3'] .'" /></p>';
		echo'<input class="widefat" id="'. $this->get_field_id('address_line_4') .'" name="'. $this->get_field_name('address_line_4') .'" type="text" value="'. $instance['address_line_4'] .'" /></p>';
		echo'<input class="widefat" id="'. $this->get_field_id('address_line_5') .'" name="'. $this->get_field_name('address_line_5') .'" type="text" value="'. $instance['address_line_5'] .'" /></p>';
		echo'<input class="widefat" id="'. $this->get_field_id('address_line_6') .'" name="'. $this->get_field_name('address_line_6') .'" type="text" value="'. $instance['address_line_6'] .'" /></p>';
		
		// Phone
		echo '<p><label for="'. $this->get_field_id( 'phone' ) .'">'. _e( 'Phone:', 'raw_theme' ) .'<input class="widefat" id="'. $this->get_field_id('phone') .'" name="'. $this->get_field_name('phone') .'" type="text" value="'. $instance['phone'] .'" /></label></p>';
		echo '<p><label for="'. $this->get_field_id( 'mobile' ) .'">'. _e( 'Mobile:', 'raw_theme' ) .'<input class="widefat" id="'. $this->get_field_id('mobile') .'" name="'. $this->get_field_name('mobile') .'" type="text" value="'. $instance['mobile'] .'" /></label></p>';
		echo '<p><label for="'. $this->get_field_id( 'fax' ) .'">'. _e( 'Fax:', 'raw_theme' ) .'<input class="widefat" id="'. $this->get_field_id('fax') .'" name="'. $this->get_field_name('fax') .'" type="text" value="'. $instance['fax'] .'" /></label></p>';
		
		//Website
		echo '<p><label for="'. $this->get_field_id( 'website' ) .'">'. _e( 'Website:', 'raw_theme' ) .'<input class="widefat" id="'. $this->get_field_id('website') .'" name="'. $this->get_field_name('website') .'" type="text" value="'. $instance['website'] .'" /></label></p>';
		echo '<p><label for="'. $this->get_field_id( 'email' ) .'">'. _e( 'Email:', 'raw_theme' ) .'<input class="widefat" id="'. $this->get_field_id('email') .'" name="'. $this->get_field_name('email') .'" type="text" value="'. $instance['email'] .'" /></label></p>';
		
	}

}
add_action('widgets_init', create_function('', 'return register_widget("raw_widget_contact_details");'));


?>