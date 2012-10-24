<?php
/**
 * Template Name: Simple page, no div scrollbar
 */
?> 

<?php get_header(); ?>

<?php get_left_box(); ?>

<?php get_right_box(); ?>

<div class="part2">
				<div class="box-center simple pgsize2 <?php echo $GLOBALS['set_style']; ?>">
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
							}
						?>
						
						<div class="content">
							<?php if(have_posts()):while(have_posts()): the_post(); ?>
							<?php the_content(); ?>
							<?php endwhile; endif; ?>
						</div>
						
					</div><!-- end of inside -->
					</div><!-- end of float -->			
				</div><!-- end of box-center pgsize2 -->
</div><!-- end of part2 -->

<?php get_footer(); ?>
