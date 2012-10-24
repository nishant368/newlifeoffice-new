<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * @package WordPress
 * @subpackage Fullscreen
 * @since Fullscreen 1.0
 */

get_header(); ?>

<?php get_left_box(); ?>

<?php get_right_box(); ?>

<div class="part2">
				<div class="box-center pgsize2 <?php echo $GLOBALS['set_style']; ?>">
					<div class="float">
					<div id="hide-box" class="show"></div>
					<div class="inside">
						
						<h1 class="page-title"><?php
							printf( __( 'Tag Archives: %s', 'fullscreen' ), '<span>' . single_tag_title( '', false ) . '</span>' );
						?></h1>
									
						<!-- scroller block -->
						<div id="mcs2_container">
						<div class="customScrollBox">
							<div class="container">
								<div class="content">
									<!-- CONTENT -->	

									<?php
									/* Run the loop for the tag archive to output the posts
									 * If you want to overload this in a child theme then include a file
									 * called loop-tag.php and that will be used instead.
									 */
									 get_template_part( 'loop', 'tag' );
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

<?php get_sidebar(); ?>
<?php get_footer(); ?>
