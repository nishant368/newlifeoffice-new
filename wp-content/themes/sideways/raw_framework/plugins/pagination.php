<?php

// PAGINATION
// Pagination code by Kriesi (http://www.kriesi.at).

function pagination($pages = '', $range = 2){
  
    $showitems = ($range * 2)+1;  

    global $paged;
    if(empty($paged)) $paged = 1;

    if($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        
		if(!$pages) {
            $pages = 1;
        }
		
    }   

    if(1 != $pages) {
        echo "<div class='pagination'>";
        if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'><span>&laquo;</span></a>";
        if($paged > 1) echo "<a href='".get_pagenum_link($paged - 1)."'><span>Prev</span></a>";

        for ($i=1; $i <= $pages; $i++) {
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
                echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' ><span>".$i."</span></a>";
            }
        }

        if ($paged < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'><span>Next</span></a>";  
        if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'><span>&raquo;</span></a>";
        echo "</div>\n";
    }
}

// ---------- END PAGINATION ---------- //

?>