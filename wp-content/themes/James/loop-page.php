<?php 
$showContent = get_post_meta($post->ID, '_tdCore-showContent', true);
if($showContent != 'no') {
?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); 
$pageIcon = get_option('_tdCore-pageIcon'); ?>
<div class="shadowTop"><h2 class="entry-title"><?php the_title(); ?></h2><div class="clickHide"></div></div>
<div class="content">
<div class="main-content">
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php $image_id = get_post_thumbnail_id();  
$image_url = wp_get_attachment_image_src($image_id,'large');  
$image_url = $image_url[0];
if($image_url != '') { echo '<img class="contentImageFull" src="'.get_bloginfo("template_url").'/lib/img.php?f='.$image_url.'&w=600&h=200&a=c" />'; } 
get_template_part( 'slider' );  ?>
<div class="entry-content">
<div class="entry-content-text">
<?php the_content(); 
wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'tdCore' ), 'after' => '</div>' ) ); 
edit_post_link( __( 'Edit', 'tdCore' ), '<span class="edit-link">', '</span>' ); ?>
</div>
</div>
</div>
<?php require_once(TEMPLATEPATH . '/contact.php');
comments_template( '', true ); 
endwhile; ?>
</div>
</div>
<div class="contentShadowBottom"></div>
<?php } ?>