<?php

global $shortname, $theme_options;
	
// Set default background source.
$background_url = '"'.$theme_options[$shortname.'_default_background'].'"';

if ( is_home() ) { // If blog
	
	if ( $theme_options[$shortname.'_blog_background'] != '' ) {
		$background_url = '"'.$theme_options[$shortname.'_blog_background'].'"';
	}
	
} elseif ( is_archive() ) { // If archive page
	
	if ( $theme_options[$shortname.'_archive_background'] != '' ) {
		$background_url = '"'.$theme_options[$shortname.'_archive_background'].'"';
	}
	
} elseif ( is_search() ) { // If search results page

	if ( $theme_options[$shortname.'_search_background'] != '' ) {
		$background_url = '"'.$theme_options[$shortname.'_search_background'].'"';
	}
	
} elseif ( is_404() ) { // If page not found
	
	if ( $theme_options[$shortname.'_404_background'] != '' ) {
		$background_url = '"'.$theme_options[$shortname.'_404_background'].'"';
	}
	
} else { // If post, page or portfolio item

	$post_type = get_post_type();	
	
	if( $post_type == 'post' || $post_type == 'page' || $post_type == 'portfolio') {
		
		if ( get_post_meta( $post->ID, $shortname.'_background_image', true ) == 'Slide Show' ) { // If background option set to slideshow
			
			// Get all attached images
			$args = array(
				'post_type' => 'attachment',
				'numberposts' => -1,
				'post_status' => null,
				'post_parent' => $post->ID,
				'orderby' => 'menu_order',
				'order' => 'ASC'
			); 
		
			$attachments = get_posts($args);
				
			if ($attachments) {						
				
				$background_url = "";
				$counter = 1;

				foreach ($attachments as $attachment) {
				
					$attachurl = wp_get_attachment_url($attachment->ID);
					$title = apply_filters('the_title',$attachment->post_title);
					
					if ( count($attachments) != $counter ){
						$background_url .= '"'. $attachurl .'",';
					} else { 
						$background_url .= '"'. $attachurl .'"';
					}
					
					$counter++;
					
				}
			}
			
		} elseif ( get_post_meta( $post->ID, $shortname.'_background_image', true ) == 'URL' ) { // If background option set to URL
			
			$background_url = '"'. get_post_meta( $post->ID, $shortname.'_background_image_url', true ) .'"';
			
		} elseif ( get_post_meta( $post->ID, $shortname.'_background_image', true ) == 'Featured Image' && has_post_thumbnail( $post->ID ) ) { // If background option set to featured image
		
			$src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'Full' );
			$background_url = '"'. $src[0] .'"';
			
		} 
		
	}
	
} ?>	

<!-- BACKSTRETCH -->
<script>
	
	// Create image array
	var images = [<?php echo $background_url; ?>];
	
	// Preloading the images
	jQuery(images).each(function(){
	   jQuery('<img/>')[0].src = this; 
	});

	// The index variable tracks current image
	var index = 0;
	
	// Call backstretch and set fadeIn speed. Speed must be equal or greater than 1000.
	jQuery.backstretch(images[index], {speed: 1000});
	
	// Set slide interval
	setInterval(function() {
		index = (index >= images.length - 1) ? 0 : index + 1;
		jQuery.backstretch(images[index]);
	}, 5000);		

</script>