
<?php while ( have_posts() ) : the_post(); ?>
<div class="blog-post">
<?php
$slideHeight = get_post_meta($post->ID, '_tdCore-slideHeight', true);
if($slideHeight == '') {
$slideHeight = 290;
}
$slideCount = get_post_meta($post->ID, 'td-slideCount', true);
if ($slideCount == '') {
	} else if ($slideCount == 0) {
	} else {
?>
<div id='coin-slider-<?php echo $post->ID; ?>'>
<?php
$count = $slideCount;
for ($i = 1; $i <= $count; $i++) {
$n = $i;
$slideImg = get_post_meta($post->ID, '_tdCore-slideImg_'.$n.'', true);
$slideLink = get_post_meta($post->ID, '_tdCore-slideLink_'.$n.'', true);
$slideText = get_post_meta($post->ID, '_tdCore-slideText_'.$n.'', true);
echo "<a href=\"".$slideLink."\"><img src=\"".$slideImg."\"><span>".$slideText."</span></a>";
}
?>
</div>
<?php } ?>
<script type="text/javascript">
jQuery(document).ready(function() {	$('#coin-slider-<?php echo $post->ID; ?>').coinslider({ height: <?php echo $slideHeight; ?> }); });
</script>
<?php echo get_the_post_thumbnail( ); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="blog-top">
<h1 class="entry-title"><span class="vAlign"><a href="<?php the_permalink(); ?>" title="<?php _e( 'Permalink to ', 'tdCore' ); echo the_title_attribute( 'echo=0' ); ?>" rel="bookmark"><?php the_title(); ?></a></span></h1>
<div class="blog-date">
<span class="full-day"><?php the_time('d'); ?>/<?php the_time('M'); ?></span>
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
<?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
<div class="entry-summary">
<?php if(get_option('rss_use_excerpt') == 1) {
	the_excerpt('');
} else {
	the_content();
}
?>
</div>
<?php else : ?>
<div class="entry-content">
<?php the_content( __( '', 'tdCore' ) ); ?>
<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'tdCore' ), 'after' => '</div>' ) ); ?>
</div>
<?php endif; ?>
</div>
<?php comments_template( '', true ); ?>
</div>
<?php endwhile; ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
<div id="nav-below" class="navigation">
<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'tdCore' ) ); ?></div>
<div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'tdCore' ) ); ?></div>
</div>
<?php endif; ?>