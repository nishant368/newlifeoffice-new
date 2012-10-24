<?php
/**
 * Creates widget with posts
 */
class Posts_Widget extends WP_Widget {	
	/**
	 * Widget constructor 
     *
	 * @desc sets default options and controls for widget
	 */
	function Posts_Widget () {
		/* Widget settings */
		$widget_ops = array (
			'classname' => 'sidepost',
			'description' => __('Customize displaying posts')			
		);

		/* Create the widget */
		$this->WP_Widget('posts-widget', __('Theme &rarr; Posts'), $widget_ops);
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
		echo $before_widget;

        if ( !empty( $instance['number_of_posts'] )) 
            $query_string .= '&showposts=' . $instance['number_of_posts']; 
        else     
            $query_string .= '&showposts=1';
		/* START Widget body */
        //if ( isset( $instance['title'] ) ) echo $before_title . $instance['title'] . $after_title;
        if ( !empty( $instance['title'] ) )
            echo '<h2>' . $instance['title'] . '</h2>'; ?>

        <?php
        query_posts( $query_string );
        if (have_posts()) : while (have_posts()): the_post();
            //if (!empty($instance['excerpt_length'])) 
            //    $text = strip_string( strip_tags( get_the_content() ), $instance['excerpt_length'] );
            //else 
                $text = get_the_excerpt();
                
            $thumbnail_id = get_post_thumbnail_id( get_the_ID () );
             $thumbnail_args = wp_get_attachment_image_src( $thumbnail_id );
            
            /*  
            switch ( $instance['thumbnail_position'] ) {
                case 'left': $thumbnail_class = 'fl-space10'; break; 
                case 'right': $thumbnail_class = 'fr-space10'; break;
                default: $thumbnail_class = ''; break;
            }
            */
                           
            ?>
            <!-- post item -->
            <div class="postitem clear">
                <?php if ( has_post_thumbnail ( get_the_ID() ) && $instance['show_thumbnails'] ) : ?>
					<div class="thumbnailSrc" style="display:none;"><?php echo $thumbnail_args[0]; ?></div>
                <?php endif; ?>                             
                <h3><a href="<?php the_permalink(); ?>"><?php the_title_attribute(); ?></a></h3>                           
                <p>          
					<?php echo $text; ?>
                </p>
            </div><!-- /.item -->
            <?php
        endwhile; else: 
            echo __('No posts', 'fullscreen');
        endif;
        ?>
		
		<?php
		/* END Widget body*/
		wp_reset_query();
		
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
	    print_r($new_instance);
		$old_instance['title'] = strip_tags( $new_instance['title'] );
		$old_instance['number_of_posts'] = $new_instance['number_of_posts'];
		$old_instance['show_thumbnails'] = $new_instance['show_thumbnails'];
		$old_instance['show_read_more'] = $new_instance['show_read_more'];
		$old_instance['excerpt_length'] = $new_instance['excerpt_length'];
		$old_instance['thumbnail_width'] = $new_instance['thumbnail_width'];
		$old_instance['thumbnail_height'] = $new_instance['thumbnail_height'];
		$old_instance['thumbnail_position'] = $new_instance['thumbnail_position'];
		
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
			<label for="<?php echo $this->get_field_id( 'number_of_posts' ); ?>"><?php echo __( 'Number of posts', 'fullscreen' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'number_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'number_of_posts' ); ?>" value="<?php echo $instance['number_of_posts']?>" size="2" />
        </p>

		<!--
		<p>
			<label for="<?php echo $this->get_field_id( 'excerpt_length' ); ?>"><?php echo __( 'Excerpt length', 'fullscreen' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'excerpt_length' ); ?>" name="<?php echo $this->get_field_name( 'excerpt_length' ); ?>" value="<?php echo $instance['excerpt_length']?>" size="2" />
        </p>
        -->

		<!--
        <p>
            <?php if ( $instance['show_read_more'] ) $checked = 'checked="checked"'; ?>
			<input type="checkbox" <?php echo $checked; ?> id="<?php echo $this->get_field_id( 'show_read_more' ); ?>" name="<?php echo $this->get_field_name( 'show_read_more' ); ?>" class="checkbox" />
			<label for="<?php echo $this->get_field_id( 'show_read_more' ); ?>"><?php echo __( 'Show read more', 'fullscreen' ); ?></label>
        </p>
        -->
                        
        <p>
            <?php if ( $instance['show_thumbnails'] ) $checked = 'checked="checked"'; else $checked = ''; ?>
			<input type="checkbox" <?php echo $checked; ?> id="<?php echo $this->get_field_id( 'show_thumbnails' ); ?>" name="<?php echo $this->get_field_name( 'show_thumbnails' ); ?>" class="checkbox" />
			<label for="<?php echo $this->get_field_id( 'show_thumbnails' ); ?>"><?php echo __( 'Show thumbnails', 'fullscreen' ); ?></label>
        </p>

		<!--
		<p>
			<label for="<?php echo $this->get_field_id( 'thumbnail_width' ); ?>"><?php echo __( 'Thumbnail width', 'fullscreen' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'thumbnail_width' ); ?>" name="<?php echo $this->get_field_name( 'thumbnail_width' ); ?>" value="<?php echo $instance['thumbnail_width']; ?>" size="3" />px
        </p>
        -->

		<!--
		<p>
			<label for="<?php echo $this->get_field_id( 'thumbnail_height' ); ?>"><?php echo __( 'Thumbnail height', 'fullscreen' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'thumbnail_height' ); ?>" name="<?php echo $this->get_field_name( 'thumbnail_height' ); ?>" value="<?php echo $instance['thumbnail_height']; ?>" size="3"/>px
        </p>
        -->

		<!--
		<p>
			<label for="<?php echo $this->get_field_id( 'thumbnail_position' ); ?>"><?php echo __( 'Thumbnail position', 'fullscreen' ); ?>:</label>
			<select id="<?php echo $this->get_field_id( 'thumbnail_position' ); ?>" name="<?php echo $this->get_field_name( 'thumbnail_position' ); ?>">
				<option <?php if ( 'left' == $instance['thumbnail_position'] ) echo 'selected="selected"'; ?> value="left">Left</option>
				<option <?php if ( 'right' == $instance['thumbnail_position'] ) echo 'selected="selected"'; ?> value="right">Right</option>
				<option <?php if ( 'top' == $instance['thumbnail_position'] ) echo 'selected="selected"'; ?> value="top">Top</option>
			</select>			        
		</p>
		-->
		<?php
	}
}
register_widget( 'Posts_Widget' );
?>
