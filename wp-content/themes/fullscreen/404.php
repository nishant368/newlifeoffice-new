<?php get_header(); ?>

<?php get_left_box(); ?>

<?php get_right_box(); ?>

<div class="part2">
				<div class="box-center pgsize2  <?php echo $GLOBALS['set_style']; ?>">
					<div class="float">
					<div id="hide-box" class="show"></div>
					<div class="inside">
						
						<h1 class="entry-title"><?php echo __( 'Not Found', 'fullscreen'); ?></h1>
						<!-- scroller block -->
						<div id="mcs2_container">
						<div id="centerScrollBox" class="customScrollBox">
							<div class="container">
								<div class="content">
									<!-- CONTENT -->
									
											<div id="post-0" class="post error404 not-found">
												<div class="entry-content">
													<p><?php echo __( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'fullscreen'); ?></p>
													<?php get_search_form(); ?>
												</div><!-- .entry-content -->
											</div><!-- #post-0 -->

									<script type="text/javascript">
										// focus on search field after it has loaded
										document.getElementById('s') && document.getElementById('s').focus();
									</script>
			
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
