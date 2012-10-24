<?php
/**
 * Creates widget with submenu
 */
class Submenu_Widget extends WP_Widget {	
	/**
	 * Widget constructor 
     *
	 * @desc sets default options and controls for widget
	 */
	function SubMenu_Widget () {
		/* Widget settings */
		$widget_ops = array (
			'classname' => 'submenu',
			'description' => __( 'Show submenu' )			
		);

		/* Create the widget */
		$this->WP_Widget( 'submenu-widget', __( 'Theme &rarr; Submenu' ), $widget_ops );
	}
	
	/**
	 * Displaying the widget
	 *
	 * Handle the display of the widget
	 * @param array
	 * @param array
	 */
	function widget ( $args, $instance ) {
		extract ($args);		
		global $wp_query;
		/* Before widget(defined by theme)*/
		echo str_replace('sidebox', 'sidebox ' . $instance['theme'], $before_widget);
		
		/* START Widget body */
        $pid = $id = $wp_query->post->ID;

        $pages1 = get_pages('child_of=' . $id . '&sort_order=desc&sort_column=menu_order');
        if (is_array($pages1)) {
	        $post = get_post($id);
	        $pages = get_pages('child_of=' . $post->post_parent . '&sort_column=post_date&sort_order=asc');
	        $pid = $post->post_parent;
        }
        ?>
        
        <?php if ( !empty( $instance['show_stamp'] ) && !empty( $instance['text_stamp'] ) ) : ?>
            <div class="stamp">
    			<?php if ( !empty( $instance['link_stamp'] ) ) : ?>
    			    <a href="<?php echo $instance['link_stamp']; ?>">
    			<?php endif; ?>
			
    			<span class="inside"><?php echo $instance['text_stamp']; ?></span>
			
    			<?php if ( !empty( $instance['link_stamp'] ) ) : ?>
    			    </a>
    			<?php endif; ?>
    		</div>
		<?php endif;  ?>
		
        <?php							
        if (is_array($pages)) {
			if (!is_page() || (sizeof($pages1) == 0 && $pid == 0)) {
			    if ( !empty( $instance['title'] ) )
				    echo $before_title . $instance['title'] . $after_title;
			}
            elseif ($pid != 0 ) {
           		$post_id_B = get_post($pid);
           		$ntitle = $post_id_B->post_title;
           		$url = get_permalink( $pid );
				echo $before_title . "<a href=\"$url\">$ntitle</a>" . $after_title;
            }
			else {
           		$post_id_B = get_post($id);
           		$ntitle = $post_id_B->post_title;
           		$url = get_permalink( $pid );
				echo $before_title . "<a href=\"$url\">$ntitle</a>" . $after_title;
			}			

			if (sizeof($pages1) == 0 && $pid == 0) {
				$id = 0;
                $depth = '1';
            }
            elseif (sizeof($pages1) != 0 && $pid == 0) {
                $depth = '2';
            }
            else {
                $depth = '2';
                $id = $pid;
            }

			echo '<ul class="menu">';
			wp_list_pages(array(
				'title_li' 	=> null,
				'depth' 	=> $depth,
				'child_of'	=> $id
			));
			
			echo "</ul>";
		}
		/* END Widget body*/
		
		/* After widget(defined by theme)*/
		echo $after_widget;
	}
	
	/**
	 * Update and save widget
	 *
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array New widget values
	 */
	function update ( $new_instance, $old_instance ) {	
		$old_instance['title'] = strip_tags( $new_instance['title'] );
		$old_instance['show_stamp'] = $new_instance['show_stamp'];
		$old_instance['text_stamp'] = $new_instance['text_stamp'];
		$old_instance['link_stamp'] = $new_instance['link_stamp'];
	    	
		return $old_instance;
	}
	
	/**
	 * Creates widget controls or settings
	 *
	 * @param array Return widget options form
	 */
	function form ( $instance ) { ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo __( 'Title', 'fullscreen' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"class="widefat" style="width:100%;" />
        </p>
        <p>
            <?php if ( $instance['show_stamp'] ) $checked = 'checked="checked"'; ?>
			<input type="checkbox" <?php echo $checked; ?> id="<?php echo $this->get_field_id( 'show_stamp' ); ?>" name="<?php echo $this->get_field_name( 'show_stamp' ); ?>" class="checkbox" />
			<label for="<?php echo $this->get_field_id( 'show_stamp' ); ?>"><?php echo __( 'Show stamp', 'fullscreen' ); ?></label>
        </p> 
 
 		<p>
			<label for="<?php echo $this->get_field_id( 'link_stamp' ); ?>"><?php echo __( 'Link to', 'fullscreen' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'link_stamp' ); ?>" name="<?php echo $this->get_field_name( 'link_stamp' ); ?>" value="<?php echo $instance['link_stamp']; ?>"class="widefat" style="width:100%;" />
        </p>

       
		<p>
			<label for="<?php echo $this->get_field_id( 'text_stamp' ); ?>"><?php echo __( 'Text for stamp', 'fullscreen' ); ?>:</label>
			<textarea id="<?php echo $this->get_field_id( 'text_stamp' ); ?>" name="<?php echo $this->get_field_name( 'text_stamp' ); ?>" class="widefat" cols="20" rows="16">
			    <?php echo $instance['text_stamp']; ?>
			</textarea>
        </p> 
        <?php
	}
}
register_widget( 'Submenu_Widget' ); 
