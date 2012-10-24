<?php if ( ! have_posts() ) : ?>
<div id="post-0" class="post error404 not-found">
<h1 class="entry-title"><?php _e( 'Not Found', 'tdCore' ); ?></h1>
<div class="entry-content">
<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'tdCore' ); ?></p>
<?php get_search_form(); ?>
</div>
</div>
<?php endif; ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php if ( ( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) ) || in_category( _x( 'gallery', 'gallery category slug', 'tdCore' ) ) ) : ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'tdCore' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
<div class="entry-content">
<?php if ( post_password_required() ) : ?>
<?php the_content(); ?>
<?php else : ?>
<?php
$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
if ( $images ) :
$total_images = count( $images );
$image = array_shift( $images );
$image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
?>
<div class="gallery-thumb">
<a class="size-thumbnail" href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
</div>
<p><em><?php printf( _n( 'This gallery contains <a %1$s>%2$s photo</a>.', 'This gallery contains <a %1$s>%2$s photos</a>.', $total_images, 'tdCore' ),
'href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'tdCore' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
number_format_i18n( $total_images )
); ?></em></p>
<?php endif; ?>
<?php the_excerpt(); ?>
<?php endif; ?>
</div>
<div class="entry-utility">
<?php if ( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) ) : ?>
<a href="<?php echo get_post_format_link( 'gallery' ); ?>" title="<?php esc_attr_e( 'View Galleries', 'tdCore' ); ?>"><?php _e( 'More Galleries', 'tdCore' ); ?></a>
<span class="meta-sep">|</span>
<?php elseif ( in_category( _x( 'gallery', 'gallery category slug', 'tdCore' ) ) ) : ?>
<a href="<?php echo get_term_link( _x( 'gallery', 'gallery category slug', 'tdCore' ), 'category' ); ?>" title="<?php esc_attr_e( 'View posts in the Gallery category', 'tdCore' ); ?>"><?php _e( 'More Galleries', 'tdCore' ); ?></a>
<span class="meta-sep">|</span>
<?php endif; ?>
<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'tdCore' ), __( '1 Comment', 'tdCore' ), __( '% Comments', 'tdCore' ) ); ?></span>
<?php edit_post_link( __( 'Edit', 'tdCore' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
</div>
</div>
<?php elseif ( ( function_exists( 'get_post_format' ) && 'aside' == get_post_format( $post->ID ) ) || in_category( _x( 'asides', 'asides category slug', 'tdCore' ) )  ) : ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if ( is_archive() || is_search() ) : ?>
<div class="entry-summary">
<?php the_excerpt(); ?>
</div>
<?php else : ?>
<div class="entry-content">
<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'tdCore' ) ); ?>
</div>
<?php endif; ?>
<div class="entry-utility">
<?php tdCore_posted_on(); ?>
<span class="meta-sep">|</span>
<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'tdCore' ), __( '1 Comment', 'tdCore' ), __( '% Comments', 'tdCore' ) ); ?></span>
<?php edit_post_link( __( 'Edit', 'tdCore' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
</div>
</div>
<?php else : ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="blog-top">
<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php _e( 'Permalink to ', 'tdCore' ); echo the_title_attribute( 'echo=0' ); ?>" rel="bookmark"><span class="vAlign"><?php the_title(); ?></span></a></h1>
<div class="blog-date">
<span class="full-day"><?php the_time('d'); ?></span>
<span class="full-month"><?php the_time('M'); ?></span>
</div>
<div class="blog-comments">
<span class="comment-cloud">
<?php
$commentscount = get_comments_number();
if($commentscount == 1): $commenttext = 'comment'; endif;
if($commentscount > 1 || $commentscount == 0): $commenttext = 'comments'; endif;
echo $commentscount;
?>
</span>
</div>
</div>
<?php if ( is_archive() || is_search() ) : ?>
<div class="entry-summary">
<?php the_excerpt(); ?>
</div>
<?php else : ?>
<div class="entry-content">
<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'tdCore' ) ); ?>
<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'tdCore' ), 'after' => '</div>' ) ); ?>
</div>
<?php endif; ?>
<div class="entry-utility">
<?php if ( count( get_the_category() ) ) : ?>
<span class="cat-links">
<span class="entry-utility-prep entry-utility-prep-cat-links"><?php _e( 'Posted in ', 'tdCore' ); echo get_the_category_list( ', ' ); ?></span>
</span>
<span class="meta-sep">|</span>
<?php endif; ?>
<?php
$tags_list = get_the_tag_list( '', ', ' );
if ( $tags_list ):
?>
<span class="tag-links">
<span class="entry-utility-prep entry-utility-prep-tag-links"><?php _e( 'Tagged ', 'tdCore' ); echo $tags_list; ?></span>
</span>
<span class="meta-sep">|</span>
<?php endif; ?>
<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'tdCore' ), __( '1 Comment', 'tdCore' ), __( '% Comments', 'tdCore' ) ); ?></span>
<?php edit_post_link( __( 'Edit', 'tdCore' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
</div>
</div>
<?php comments_template( '', true ); ?>
<?php endif; ?>
<?php endwhile; ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
<div id="nav-below" class="navigation">
<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'tdCore' ) ); ?></div>
<div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'tdCore' ) ); ?></div>
</div>
<?php endif; ?>