<?php get_header(); ?>

<?php get_left_box(); ?>

<?php get_right_box(); ?>

<div class="part2">
				<div class="box-center pgsize2 <?php echo $GLOBALS['set_style']; ?>">
					<div class="float">
					<div id="hide-box" class="show"></div>
					<div class="inside">
						
						<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'fullscreen' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
									
						<!-- scroller block -->
						<div id="mcs2_container">
						<div id="centerScrollBox" class="customScrollBox">
							<div class="container">
								<div class="content">
									<!-- CONTENT -->
										
										<?php if ( have_posts() ) : ?>									
										<?php
														 get_template_part( 'loop', 'search' );
														?>
										<?php else : ?>
														<div id="post-0" class="post no-results not-found">
															<h2 class="entry-title"><?php echo __( 'Nothing Found', 'fullscreen' ); ?></h2>
															<div class="entry-content">
																<p><?php echo __( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'fullscreen' ); ?></p>
																<?php get_search_form(); ?>
															</div><!-- .entry-content -->
														</div><!-- #post-0 -->
										<?php endif; ?>
			
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
