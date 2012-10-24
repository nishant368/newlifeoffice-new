<?php get_header(); ?>

<?php get_left_box(); ?>

<?php get_right_box(); ?>

<div class="part2">
				<div class="box-center pgsize2 <?php echo $GLOBALS['set_style']; ?>">
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
									<!-- CONTENT -->
    								
                                    <?php $show_featured_image = get_post_meta( $current_id, 'page_show_featured_image' ); ?>
									<?php $show_featured_image['0'] = trim($show_featured_image['0']); ?>
								  	<?php if ( get_the_post_thumbnail( get_the_ID(), 'large' ) && ($show_featured_image['0']== 'yes') && !is_search()) : ?>
                                      <?php 
                                      $thumbnail_id = get_post_thumbnail_id( get_the_ID () );
                                      $thumbnail_args = wp_get_attachment_image_src( $thumbnail_id, 'large' );
                                      ?>  
                                      <div class="post-image">
                                          <a href="<?php the_permalink(); ?>">
                                              <img src="<?php echo get_template_directory_uri(); ?>/lib/timthumb/timthumb.php?src=<?php echo $thumbnail_args['0']; ?>&amp;w=580&amp;h=200" alt="" />
                                          </a>
                                      </div>
                                 	<?php endif; ?>
                                    
									<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
										<!--
										<div id="nav-above" class="navigation">
											<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . __( '&larr;', 'Previous post link') . '</span> %title' ); ?></div>
											<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . __( '&rarr;', 'Next post link' ) . '</span>' ); ?></div>
										</div>
										-->
										<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

											<?php /* if ( get_the_post_thumbnail( get_the_ID(), 'large' ) ) :
												<div class="post-image">
													<?php echo get_the_post_thumbnail( get_the_ID(), 'large' ); ?>
												</div>
											endif; */ ?>
														
											<div class="entry-content">
												<?php the_content(); ?>
												<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:'), 'after' => '</div>' ) ); ?>
											</div><!-- .entry-content -->

											<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
												<div id="entry-author-info">
													<div id="author-avatar">
														<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'theme_author_bio_avatar_size', 60 ) ); ?>
													</div><!-- #author-avatar -->

													<div id="author-description">
														<h2><?php printf( esc_attr__( 'About %s', 'theme' ), get_the_author() ); ?></h2>

														<?php the_author_meta( 'description' ); ?>
														<div id="author-link">
															<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
																<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'theme' ), get_the_author() ); ?>
															</a>
														</div><!-- #author-link	-->
													</div><!-- #author-description -->
												</div><!-- #entry-author-info -->
											<?php endif; ?>

											<div class="rule"></div>
											<div id="post-infobox">
												<div class="entry-meta">
													<?php theme_posted_on(); ?>
												</div><!-- .entry-meta -->

												<div class="entry-utility">
													<?php theme_posted_in(); ?>
													<?php edit_post_link( __( 'Edit', 'theme' ), '<span class="edit-link">', '</span>' ); ?>
												</div><!-- .entry-utility -->
											</div><!-- /#post-infobox -->
											<div class="rule"></div>
										</div><!-- #post-## -->
										<!--
										<div id="nav-below" class="navigation">
											<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'theme' ) . '</span> %title' ); ?></div>
											<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'theme' ) . '</span>' ); ?></div>
										</div>
										-->

									<?php endwhile; // end of the loop. ?>
									
                                    <?php comments_template( '', true ); ?>
                                    
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
