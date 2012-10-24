<?php get_header(); ?>

<?php get_left_box(); ?>

<?php get_right_box(); ?>

<div class="part2">
				<div class="box-center pgsize2  <?php echo $GLOBALS['set_style']; ?>">
					<div class="float">
					<div id="hide-box" class="show"></div>
					<div class="inside">
						
										<h1 class="page-title"><?php
											printf( __( 'Category Archives: %s'), '<span>' . single_cat_title( '', false ) . '</span>' );
										?></h1>

						<!-- scroller block -->
						<div id="mcs2_container">
						<div id="centerScrollBox" class="customScrollBox">
							<div class="container">
								<div class="content">
									<!-- CONTENT -->
																			
										<?php
											$category_description = category_description();
											if ( ! empty( $category_description ) )
												echo '<div class="archive-meta">' . $category_description . '</div>';

										/* Run the loop for the category page to output the posts.
										 * If you want to overload this in a child theme then include a file
										 * called loop-category.php and that will be used instead.
										 */
										get_template_part( 'loop', 'category' );
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
