<?php get_header(); ?>

<?php get_left_box(); ?>

<?php get_right_box(); ?>

<div class="part2">
				<div class="box-center pgsize2  <?php echo $GLOBALS['set_style']; ?>">
					<div class="float">
					<div id="hide-box" class="show"></div>
					<div class="inside">
						
										<?php
											if ( have_posts() )
												the_post();
										?>

													<h1 class="page-title">
										<?php if ( is_day() ) : ?>
														<?php printf( __( 'Daily Archives: <span>%s</span>' ), get_the_date() ); ?>
										<?php elseif ( is_month() ) : ?>
														<?php printf( __( 'Monthly Archives: <span>%s</span>' ), get_the_date('F Y') ); ?>
										<?php elseif ( is_year() ) : ?>
														<?php printf( __( 'Yearly Archives: <span>%s</span>' ), get_the_date('Y') ); ?>
										<?php else : ?>
														<?php _e( 'Blog Archives', 'fullscreen' ); ?>
										<?php endif; ?>
													</h1>

						<!-- scroller block -->
						<div id="mcs2_container">
						<div id="centerScrollBox" class="customScrollBox">
							<div class="container">
								<div class="content">
									<!-- CONTENT -->
																			
										<?php

											rewind_posts();

											get_template_part( 'loop', 'archive' );
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
