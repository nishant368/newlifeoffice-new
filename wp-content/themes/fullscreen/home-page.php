<?php
/**
 * Template Name: Homepage, no sidebar
 */
get_header();
 
?>

<?php get_left_box(); ?>

<?php get_right_box(); ?>

<?php if(have_posts()):while(have_posts()): the_post(); ?>
			<?php if(trim($post->post_content) != ""): ?>
									
			<div class="part2 home-page">
				<div class="box-center pgsize2  <?php echo $GLOBALS['set_style']; ?>">
					<div class="float">
					<?php 
						/* Title page */
						$queried_object = $wp_query->get_queried_object(); 
						if ( $queried_object->ID == get_option( 'page_for_posts' ) ) {
							$current_id = get_option( 'page_for_posts' ); 
						}
						else { 
							$current_id = $wp_query->post->ID; 
						}

						$page_hide_box = get_post_meta( $current_id, 'page_hide_box' );
					      	$page_hide_box['0'] = trim($page_hide_box['0']);
						if($page_hide_box['0'] != 'yes'){
							print '<div id="hide-box" class="show"></div>';
						}
					?>
					<div class="inside">
						
						<?php
							$page_hide_title = get_post_meta( $current_id, 'page_hide_title' );
							$page_hide_title['0'] = trim($page_hide_title['0']);
							
							$page_alternative_title = get_post_meta( $current_id, 'page_alternative_title' );
							$page_alternative_title['0'] = trim($page_alternative_title['0']);
						
							if($page_hide_title['0'] != 'yes'){
								echo '<h1>'; the_title(); echo '</h1>';
							} else if($page_alternative_title['0'] != ''){
								echo '<h1>'.$page_alternative_title['0'].'</h1>';
							} else {
								echo '<div class="notitle"></div>';	
							}
						?>
						
						<!-- scroller block -->
						<div id="mcs2_container">
						<div id="centerScrollBox" class="customScrollBox">
							<div class="container">
								<div class="content">
					
									<?php the_content(); ?>
			
								</div><!-- end of content -->
							</div><!-- end of container -->
							<div class="dragger_container">
								<div class="dragger">&#9618;</div>
							</div><!-- end of dragger_container -->
						</div><!-- end of customScrollBox -->
						</div><!-- end of mcs2_container -->
						
					</div><!-- end of inside -->
					</div><!-- end of float -->				
				</div><!-- end of box-center pgsize2 -->
			</div><!-- end of part2 -->
			
<?php else: ?> 
		<div class="part2 home-page">
			<div id="slider-container" class="pgsize2">
				
					<?php
						$home_page_slider_images = get_option( 'home_page_slider_images' ); 
						if ( !empty( $home_page_slider_images ) ){
							
							// slider delay
							$slider_delay = get_option( 'home_page_slider_delay' );
							if(!empty($slider_delay)){
								echo '<div id="slider-delay" style="display:none;">'.$slider_delay.'</div>';
							}
							
							// slider animation time
							$slider_animation_time = get_option( 'home_page_slider_animation_time' );
							if(!empty($slider_animation_time)){
								echo '<div id="slider-animation-time" style="display:none;">'.$slider_animation_time.'</div>';
							}
							// slider effect
							$slider_effect = get_option( 'home_page_bg_slider_effect' );
							if(!empty($slider_effect)){
								echo '<div id="slider-effect" style="display:none;">'.$slider_effect.'</div>';
							}
							
							$images = json_decode($home_page_slider_images);
							//var_dump($images);
							/* get center slider setting */
							$home_page_slider_show = get_option( 'home_page_slider_show' );
							
							// center slider
							if($home_page_slider_show == 'yes'){
								echo '<ul id="anything-slider">';
	
								for($i=0;$i<count($images);$i++) {
									echo '<li><a href="'.$images[$i][1].'"><img src="'.link_to($images[$i][0]).'" title="'.$images[$i][2].'" alt="'.$images[$i][2].'" /></a></li>';
								}
								
								echo '</ul>';
								
							}
							
							/* get bakground slider setting */
							$enable_full_slideshow = get_option('home_page_background_slider_enable');
								
							// background slider
							if($enable_full_slideshow == 'yes'){
								
									echo '<ul id="background-slider" style="display: none;">';
									
									for($i=0;$i<count($images);$i++) {
											echo '<li><img src="'.link_to($images[$i][3]).'" alt="'.$images[$i][2].'" /></li>';
									}
									
									echo '</ul>';
							}
							
						}

					?>
					
			</div>
		</div><!-- end of part2 -->
<?php endif; endwhile; endif; ?>

<?php get_footer(); ?>