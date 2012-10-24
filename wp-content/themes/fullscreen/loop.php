<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php __( 'Not Found', 'fullscreen' ); ?></h1>
		<div class="entry-content">
			<p><?php __( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'fullscreen' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>



<?php while ( have_posts() ) : the_post(); ?>
    <?php /* How to display posts in the Gallery category. */ ?>
	<?php if ( in_category( __('gallery', 'gallery category slug') ) ) : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="post-header clear">
                <h2 class="entry-title">
                    <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                </h2>
                
                <small><?php theme_posted_on(); ?></small>
            </div><!-- /.post-header -->

			<div class="entry-content">
<?php if ( post_password_required() ) : ?>
				<?php the_content(); ?>
<?php else : ?>
				<div class="gallery-thumb">
<?php
	$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
	$total_images = count( $images );
	$image = array_shift( $images );
	$image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
?>
					<a class="size-thumbnail" href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
				</div><!-- .gallery-thumb -->
				<p><em><?php printf( __( 'This gallery contains <a %1$s>%2$s photos</a>.', 'theme' ),
						'href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'theme' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
						$total_images
					); ?></em></p>

				<?php the_excerpt(); ?>
<?php endif; ?>
			</div><!-- .entry-content -->

			<div class="entry-utility">
				<a href="<?php echo get_term_link( _x('gallery', 'gallery category slug', 'theme'), 'category' ); ?>" title="<?php esc_attr_e( 'View posts in the Gallery category', 'theme' ); ?>"><?php _e( 'More Galleries', 'theme' ); ?></a>
				<span class="meta-sep">|</span>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'theme' ), __( '1 Comment', 'theme' ), __( '% Comments', 'theme' ) ); ?></span>
				<?php edit_post_link( __( 'Edit', 'theme' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-utility -->
		</div><!-- #post-## -->

    <?php /* How to display posts in the asides category */ ?>
	<?php elseif ( in_category( __('asides', 'asides category slug', 'theme') ) ) : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php if ( is_archive() || is_search() ) : ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		<?php else : ?>
			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'simplcius' ) ); ?>
                <?php //the_content( '', false, ''); ?>
			</div><!-- .entry-content -->
		<?php endif; ?>

			<div class="entry-utility">
				<?php theme_posted_on(); ?>
				<span class="meta-sep">|</span>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'theme' ), __( '1 Comment', 'theme' ), __( '% Comments', 'theme' ) ); ?></span>
				<?php edit_post_link( __( 'Edit', 'theme' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-utility -->
		</div><!-- #post-## -->

<?php /* How to display all other posts. */ ?>

	<?php else : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <div class="post-header clear">
                <h2 class="entry-title">
                    <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                </h2>
                
                <small><?php theme_posted_on(); ?></small>
            </div><!-- /.post-header -->
            
            <?php if ( get_the_post_thumbnail( get_the_ID(), 'large' ) && !is_search()) : ?>
                <?php
                $thumbnail_id = get_post_thumbnail_id( get_the_ID () );
                $thumbnail_args = wp_get_attachment_image_src( $thumbnail_id, 'large' );
                ?>
                <div class="post-image">
                    <a href="<?php the_permalink(); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/lib/timthumb/timthumb.php?src=<?php echo $thumbnail_args['0']; ?>&amp;w=570&amp;h=200" alt="" />
                    </a>
                </div>
            <?php endif; ?>
            
        	<?php if ( is_archive() || is_search() ) : ?>
        			<div class="post-text entry-summary">
        				<?php the_excerpt (); ?>
        			</div><!-- .entry-summary -->
        	<?php else : ?>
        			<div class="post-text entry-content">                
                        <?php the_content( '', false, '' ); ?>
        			</div><!-- .entry-content -->
        	<?php endif; ?>

            <div class="rule_light post-rule"></div>
            
            <?php if (!is_search () ) :?>
                <p class="more-link-wrap">
                    <a href="<?php echo get_permalink( get_the_ID() ); ?>" class="bold">
                        <?php echo __( 'Continue reading', 'theme' ); ?>
                    </a>
                </p>      
                      
    			<div class="post-info entry-utility">
                    <small>
                        <?php if ( count( get_the_category() ) ) : ?>
                            <span class="cat-links">
                                <?php printf( __( '<span class="%1$s">Posted in</span> %2$s', 'theme' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
                            </span>
                            <span class="meta-sep">|</span>
                        <?php endif; ?>

                        <?php edit_post_link( __( 'Edit', 'theme' ), '<span class="edit-link"> ', ' <span class="meta-sep">|</span></span>' ); ?>

                        <?php
                            $tags_list = get_the_tag_list( '', ', ' );
                            if ( $tags_list ):
                        ?>
                            <span class="tag-links">
                                <?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'theme' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
                            </span>
                            <span class="meta-sep">|</span>
                        <?php endif; ?>
                        <span class="comments-link"><?php str_replace('%', comments_number(), __( '% Comments', 'theme' )); ?></span>
                    
                   </small>
    			</div><!-- .entry-utility -->
                <div class="rule_light post-rule"></div>
            <?php endif; ?>
		</div><!-- #post-## -->

		<?php comments_template( '', true ); ?>

	<?php endif; // This was the if statement that broke the loop into three parts based on categories. ?>

<?php endwhile; // End the loop. Whew. ?>



<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
    <div id="nav-below" class="navigation">
    	<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts' ) ); ?></div>
    	<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>' ) ); ?></div>
    </div><!-- #nav-below -->
<?php endif; ?>