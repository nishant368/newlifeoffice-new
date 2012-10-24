<?php get_header(); ?>
<div class="container">
<div class="shadowTop"><h2 class="entry-title"><?php _e( 'Tag Archives: ', 'tdCore' ); echo '<span>'.single_tag_title( '', false ).'</span>'; ?></h2><div class="clickHide"></div></div>
<div class="content">
<div class="main-content">

<?php while ( have_posts() ) : the_post(); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
$image_id = get_post_thumbnail_id();  
$image_url = wp_get_attachment_image_src($image_id,'large');  
$image_url = $image_url[0];
$commentscount = get_comments_number();
$tags_list = get_the_tag_list( '', ', ' );
$metaSwitch = get_option('_tdCore-metaSwitch');
if($metaSwitch == '') { $metaSwitch = 'on'; }
?>
<div class="entry-content">
<div class="entry-title">
<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
</div>
<?php if($metaSwitch == 'on') { ?>
<div class="entry-bar">
<span class="bar-icon date"></span><span class="bar-float"><?php the_time('M j, Y') ?> | </span><span class="bar-icon author"></span><span class="bar-float"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_link(); ?></a> | </span><span class="bar-icon cat"></span><span class="bar-float"><?php the_category(', ') ?> | </span><span class="bar-icon comment"></span><span class="bar-float"><a href="<?php the_permalink(); ?>#comments"><?php echo $commentscount; ?></a><?php if ( $tags_list ) { ?> | </span><span class="bar-icon tag"></span><span class="bar-float"><?php  echo $tags_list; ?></span><?php } else { echo '</span>'; } ?><span class="clearFloat"></span>
</div>
<?php } ?>
<?php if($image_url != '') { echo '<img class="contentImageFull" src="'.get_bloginfo("template_url").'/lib/img.php?f='.$image_url.'&w=600&h=200&a=c" />'; } ?>

<?php get_template_part( 'slider' ); ?>
<div class="entry-content-text">
<?php if(get_option('rss_use_excerpt') == 1) {
	the_excerpt('');
} else {
	the_content();
}
?>
<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'tdCore' ), 'after' => '' ) ); ?>
<?php //edit_post_link( __( 'Edit', 'tdCore' ), '<span class="edit-link">', '</span>' ); ?>
</div>
</div>
</div>
<?php require_once(TEMPLATEPATH . '/contact.php'); ?>
<?php comments_template( '', true ); ?>
<?php 
endwhile;
?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
<div id="nav-below" class="navigation">
<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'tdCore' ) ); ?></div>
<div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'tdCore' ) ); ?></div>
</div>
<?php endif; ?>
<br style="clear: both;" />
</div>
</div>
<div class="contentShadowBottom"></div>
</div>
<?php get_footer(); ?>