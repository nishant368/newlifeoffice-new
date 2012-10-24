<?php
function get_custom_post( $params ) {
    extract( shortcode_atts( array (
        'id' => '',
    ), $params ) );
    if ($id) {
        $latest_post['0'] = get_post($id);
    }
    else {
        $latest_post = get_posts( 'numberposts=1' );
    }

    $author = get_the_author_meta('nickname', $latest_post['0']->post_author );
    $post_link = get_permalink( $latest_post['0']->ID );
    $date = mysql2date(get_option('date_format'), $latest_post['0']->post_date);
    $category = get_the_category_list( ', ', $parents = '', $latest_post['0']->ID );
    
    $result .= '<div class="sc-page"><div class="item clearfix">';
    // POST THUMBNAIL
    if (get_the_post_thumbnail( $latest_post['0']->ID, 'thumbnail' )) {
        $result .= '<div class="image">';
        $result .= '<a href="' . $post_link . '">';
        $result .= get_the_post_thumbnail( $latest_post['0']->ID, 'thumbnail' );
        $result .= '</a>';
        $result .= '</div>';
    }
    
    // POST BODY
    $result .= '<div class="text">';
    $result .= '<div class="title"><h2><a href="' . $post_link. '">' . $latest_post['0']->post_title . '</a></h2></div>';
    if ( $latest_post['0']->post_excerpt ) {
        $result .= '<p>' . $latest_post['0']->post_excerpt . '</p>';
    }
    else {
        $limit = 200;
        $my_text = substr($latest_post['0']->post_content, 0, $limit);
        $pos = strrpos($my_text, " "); 
        $my_post_text = substr($my_text, 0, ($pos ? $pos : -1)) . "...";
        $result .= '<p>' . strip_tags($my_post_text) . '</p>';
        //$result .= '<p>' . substr_replace( $latest_post['0']->post_content, '...', 350 ) . '</p>';
    }
    $result .= '</div><!-- /.text -->';
    
    $result .= '</div></div>';
    
    return $result;
}
add_shortcode( "get_post", "get_custom_post" );

function get_custom_posts( $params ) {
    extract( shortcode_atts( array (
        'number' => '1',
    ), $params ) );
    
    $latest_posts = get_posts( 'numberposts=' . $number );
    
    $result .= '<div class="latest-posts">';
    $count = count($latest_posts);
    foreach ($latest_posts as $key => $latest_post) {
      $author = get_the_author_meta('nickname', $latest_post->post_author );
      $post_link = get_permalink( $latest_post->ID );
      $date = mysql2date(get_option('date_format'), $latest_post->post_date);
      $category = get_the_category_list( ', ', $parents = '', $latest_post->ID );
      
      $result .= '<div class="sc-page"><div class="item clearfix">';
      // POST THUMBNAIL
      if (get_the_post_thumbnail( $latest_post->ID, 'thumbnail' )) {
          $result .= '<div class="image">';
          $result .= '<a href="' . $post_link . '">';
          $result .= get_the_post_thumbnail( $latest_post->ID, 'thumbnail' );
          $result .= '</a>';
          $result .= '</div>';
      }
      
      // POST BODY
      $result .= '<div class="text">';
      $result .= '<div class="title"><h2><a href="' . $post_link. '">' . $latest_post->post_title . '</a></h2></div>';
      if ( $latest_post->post_excerpt ) {
          $result .= '<p>' . $latest_post->post_excerpt . '</p>';
      }
      else {
          $limit = 200;
          $my_text = substr($latest_post->post_content, 0, $limit);
          $pos = strrpos($my_text, " "); 
          $my_post_text = substr($my_text, 0, ($pos ? $pos : -1)) . "...";
          $result .= '<p>' . strip_tags($my_post_text) . '</p>';
          //$result .= '<p>' . substr_replace( $latest_post['0']->post_content, '...', 350 ) . '</p>';
      }
      $result .= '</div><!-- /.text -->';
      
      $result .= '</div></div>';

      if ($count - 1 != $key)
      $result .= do_shortcode('[rule]');
    }
    $result .= '</div>';
    
    return $result;
}
add_shortcode( "get_posts", "get_custom_posts" );

function get_category_posts( $params ) {
    extract( shortcode_atts( array (
        'category' => '1',
    ), $params ) );
    
    $latest_posts = get_posts( 'category=' . $category );
    
    $result .= '<div class="latest-posts">';
    $count = count($latest_posts);
    foreach ($latest_posts as $key => $latest_post) {
      $author = get_the_author_meta('nickname', $latest_post->post_author );
      $post_link = get_permalink( $latest_post->ID );
      $date = mysql2date(get_option('date_format'), $latest_post->post_date);
      $category = get_the_category_list( ', ', $parents = '', $latest_post->ID );
      
      $result .= '<div class="sc-page"><div class="item clearfix">';
      // POST THUMBNAIL
      if (get_the_post_thumbnail( $latest_post->ID, 'thumbnail' )) {
          $result .= '<div class="image">';
          $result .= '<a href="' . $post_link . '">';
          $result .= get_the_post_thumbnail( $latest_post->ID, 'thumbnail' );
          $result .= '</a>';
          $result .= '</div>';
      }
      
      // POST BODY
      $result .= '<div class="text">';
      $result .= '<div class="title"><h2><a href="' . $post_link. '">' . $latest_post->post_title . '</a></h2></div>';
      if ( $lates_post->post_excerpt ) {
          $result .= '<p>' . $lates_post->post_excerpt . '</p>';
      }
      else {
          $limit = 200;
          $my_text = substr($latest_post->post_content, 0, $limit);
          $pos = strrpos($my_text, " "); 
          $my_post_text = substr($my_text, 0, ($pos ? $pos : -1)) . "...";
          $result .= '<p>' . strip_tags($my_post_text) . '</p>';
          //$result .= '<p>' . substr_replace( $latest_post['0']->post_content, '...', 350 ) . '</p>';
      }
      $result .= '</div><!-- /.text -->';
      
      $result .= '</div></div>';

      if ($count - 1 != $key)
      $result .= do_shortcode('[rule]');
    }
    $result .= '</div>';
    
    return $result;
}
add_shortcode( "get_category", "get_category_posts" );
