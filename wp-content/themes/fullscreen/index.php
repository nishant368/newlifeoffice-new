<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Fullscreen
 * @since Fullscreen 1.0
 */

get_header(); ?>

<?php get_left_box(); ?>

<?php get_right_box(); ?>

<div class="part2">
				<div class="box-center pgsize2  <?php echo $GLOBALS['set_style']; ?>">
					<div class="float">
					<?php 
						/* Title page
						$queried_object = $wp_query->get_queried_object(); 
						if ( $queried_object->ID == get_option( 'page_for_posts' ) ) {
							$current_id = get_option( 'page_for_posts' ); 
						}
						else { 
							$current_id = $wp_query->post->ID; 
						}
						*/
						$current_id = get_the_ID();

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
									$title_curr = wp_title('=',false,'right');
									$title_arr = split('=',$title_curr);
									echo '<h1>'; echo $title_arr[0]; echo '</h1>';
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
									<!-- CONTENT -->	
										
										<?php
										/* Run the loop to output the posts.
										 * If you want to overload this in a child theme then include a file
										 * called loop-index.php and that will be used instead.
										 */
										 get_template_part( 'loop', 'index' );
										?>
								</div>
							</div>
							<div class="dragger_container">
								<div class="dragger">&#9618;</div>
							</div><!-- end of dragger_container -->
						</div><!-- end of customScrollBox -->
						</div><!-- end of mcs2_container -->
						
					</div><!-- end of inside -->
					</div><!-- end of float -->			
				</div><!-- end of box-center pgsize2 -->
</div><!-- end of part2 -->

<?php get_footer(); ?>
