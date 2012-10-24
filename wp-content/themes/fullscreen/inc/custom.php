<?php
/**
 * Get most popular posts
 *
 * @param int $limit Number of displayed posts
 * @return string List of posts
 */
function get_popular_posts ( $limit = 5 ) {
	$sql = "SELECT id, post_title FROM {$wpdb->prefix}posts ORDER BY comment_count DESC LIMIT 0, $limit";
	$popular_posts = $wpdb->get_results($sql);

	$output = '<ul class="popular-posts">';
	foreach ( $popular_posts as $post )
		$output = '<li><a href="' . get_permalink( $post->id ) . '">' . $post->post_title . '</a></li>';

	$output = '</ul>';

	return $output;
}

/**
 * Different sidebar types
 */
function ait_sidebar($page, $block) {
	$type = get_option($page);

	if ($type) {
		if ($block == "header") {
				switch ($type) {
					case "sidebar_two":
						print '<div class="narrow-group clear">';
						break;
				}
		}
		if ($block == "footer") {
				switch ($type) {
					case "sidebar_none":
						break;
					case "sidebar_primary":
						get_sidebar();
						break;
					case "sidebar_secondary":
						get_sidebar("secondary");
						break;
					case "sidebar_two":
						get_sidebar("narrow1");
						print "</div>";
						get_sidebar("narrow2");
						break;
				}
		}
	}
}

/**
 * Prints better page title
 */
function perfect_title () {
	echo '<title>';

	if ( function_exists( 'is_tag' ) && is_tag() ) {
		single_tag_title( __('Tag Archive for') . '&quot;' );
		$output .= '&quot; - ';
	}
	elseif ( is_archive() ) {
		wp_title( '' );
		echo __('Archive') . ' - ';
	}
	elseif ( is_search() ) {
		echo __('Search for') . '&quot;' . esc_html( $s ) . '&quot; - ';
	}
	elseif ( !( is_404() ) && ( is_single() ) || ( is_page() ) ) {
		wp_title( '' );
		echo ' - ';
	}
	elseif ( is_404() ) {
		echo __('Not Found') . '-';
	}

	if (is_home()) {
		bloginfo( 'name' );
		echo ' - ';
		bloginfo( 'description' ); }
	else {
		bloginfo('name');
	}
	if ($paged > 1) {
		echo ' - ' . __('page') . ' ' . $paged;
	}

	echo '</title>';
}

/**
 * Process better link
 */
function link_to ( $link = null) {
    if ( $link == null ) return;

    if ( strpos($link, 'http://') !== false) {
        return $link;
    }
    elseif ( strpos($link, '/') == 0  ) {
        return get_option( 'siteurl' ) . $link;
    }
    else {
        return get_option( 'siteurl' ) . '/' . $link;
    }
}

/**
 * Parse YAML admin options
 */
function get_admin_options () {
	$dir = dirname(__FILE__) . '/../conf/admin-form.yaml';
	$options = sfYaml::load($dir);

    return $options;
}

/**
 * Generates admin form
 */
function get_admin_form( $menu_slug = null ) {
	$options = get_admin_options ();
	$form = '';

    if ($_REQUEST['saved']) {
    	$form .= '<div class="updated settings-error" id="setting-error-settings_updated">';
        $form .= '<p><strong>Settings saved.</strong></p>';
        $form .= '</div>';
    }

	// If menu_slug is empty return empty form
	if (!$menu_slug)
		return 'Empty form';

	// Start the form
	$form .= '<form method="post" action="?page=' . $_GET['page'] . '&slug=' . $menu_slug . '">';

	// Open table
	$form .= '<div class="theme-admin">';

	if ( !is_array ( $options[$menu_slug] ) ) return;
	//echo "<pre>" . print_r($options) . "</pre>";
	// Cycle over the all form options
	foreach ($options[$menu_slug] as $key => $value) {
			$opt = get_option($key,"OptionWasNotSet");

			if ( $opt != "OptionWasNotSet")
				$option_value = stripslashes(get_option($key));
			elseif ( !empty( $value['default'] ) )
			    $option_value = $value['default'];
			else
			    $option_value = '';

			switch ($value['type']) {
                    case 'box_start':
                        $form .= '<div class="theme-admin-box">';
                        $form .= '<div class="theme-admin-head">';
                        $form .= '<div class="expander"><div class="expander-wrap">Open</div></div>';
                        $form .= '<h3>' . $value['name'] . '</h3>';

                    	// Submit form
	                   	$form .= '<p class="submit">';
                    	$form .= '<input type="hidden" name="action" value="save" />';
                    	$form .= '<input name="save" type="submit" value="Save changes" class="button-primary"/>';
                    	$form .= '</p>';
              			if ($value['show_weight']) {
                    		$form .= '<p class="weight">Order: <input type="text" id="'.$key.'" name="'.$key.'" value="'. $option_value .'"></p>';
                    	}

                        $form .= '</div>';
                        $form .= '<div class="theme-admin-content">';
                        $has_box = true;
                        break;
                    case 'box_end':
                        $form .= '</div>';
                        $form .= '</div>';
                        break;
                    case 'header':
                        $form .= '<h4>' . $value['name'] . '</h4>';
                        break;
                    // Description
					case 'description':
						$form .= '<div class="theme-admin-row theme-admin-description clearfix">';
						$form .= '    <div class="theme-admin-row-input">' . $value['name'] . '</div>';
						$form .= '</div><!-- /.theme-admin-row -->';
					break;
                    // Textfield
					case 'textfield':
						$form .= '<div class="theme-admin-row theme-admin-textfield clearfix">';
						$form .= '    <div class="theme-admin-row-title"><label for="' . $key . '">' . $value['name']. '</label></div>';
						$form .= '    <div class="theme-admin-row-input">';
						$form .= '        <input type="text" class="regular-text ' . $value['class'] . '" value="' . htmlspecialchars($option_value, ENT_QUOTES, 'UTF-8') . '" id="' . $key . '" name="' . $key . '" />';
						$form .= '        <span class="description">&nbsp;&nbsp;' . $value['desc'] . '</span>';
						$form .= '    </div><!-- /.theme-admin-row-input -->';
						$form .= '</div><!-- /.theme-admin-row -->';
					break;
					// Image URL
					case 'image_url':
						$form .= '<div class="theme-admin-row theme-admin-textfield clearfix">';
						$form .= '    <div class="theme-admin-row-title"><label for="' . $key . '">' . $value['name']. '</label></div>';
						$form .= '    <div class="theme-admin-row-input">';
						$form .= '        <input type="text" class="regular-image ' . $value['class'] . '" value="' . htmlspecialchars($option_value, ENT_QUOTES, 'UTF-8') . '" id="' . $key . '" name="' . $key . '" />';
						$form .= '        <input type="button" value="Select Image" class="media-select" id="' . $key . '_selectMedia" name="' . $key . '_button" />';
						$form .= '        <span class="description">&nbsp;&nbsp;' . $value['desc'] . '</span>';
						$form .= '    </div><!-- /.theme-admin-row-input -->';
						$form .= '</div><!-- /.theme-admin-row -->';
					break;
					// Textarea
					case 'textarea':
						$form .= '<div class="theme-admin-row theme-admin-textarea clearfix">';
						$form .= '    <div class="theme-admin-row-title"><label for="' . $key . '">' . $value['name']. '</label></div>';
						$form .= '    <div class="theme-admin-row-input">';
						$form .= '        <textarea cols="40" rows="4" class="large-text ' . $value['class'] . '" id="' . $key . '" name="' . $key . '">' . $option_value . '</textarea>';
						$form .= '        <span class="description">' . $value['desc'] . '</span>';
						$form .= '    </div><!-- /.theme-admin-row-input -->';
						$form .= '</div><!-- /.theme-admin-row -->';
					break;
					// Checkbox
					case 'checkbox':
						$form .= '<div class="theme-admin-row theme-admin-checkbox clearfix">';
						$form .= '    <div class="theme-admin-row-title">' . $value['name']. '</div>';
						$form .= '    <div class="theme-admin-row-input"><fieldset><label for="' . $key . '">';

						if ( $option_value == '1' )
				            $form .= '<input type="checkbox" name="' . $key . '" id="' . $key. '" value="1" checked="checked" />';
						else
				            $form .= '<input type="checkbox" name="' . $key . '" id="' . $key. '" value="1" />';
						unset($option_value);

						$form .= '<span class="description">' . $value['desc'] . '</span>';
						$form .= '</label></fieldset></div>';
						$form .= '</div><!-- /.theme-admin-row -->';
					break;
					// Select
					case 'select':
						$form .= '<div class="theme-admin-row clearfix">';
						$form .= '    <div class="theme-admin-row-title"><label for="' . $key . '">' . $value['name']. '</label></div>';
						$form .= '    <div class="theme-admin-row-input">';
						$form .= '        <select name="' . $key . '">';
							foreach ($value['options'] as $option_key => $name) {
								if ($option_value == $option_key)
									$form .= '<option value="' . $option_key . '" selected="selected">' . $name . '</option>';
								else
									$form .= '<option value="' . $option_key . '">' . $name . '</option>';
							}
						$form .= '</select>';
						$form .= '<span class="description">' . $value['desc'] . '</span>';
						$form .= '    </div><!-- /.theme-admin-row-input -->';
						$form .= '</div><!-- /.theme-admin-row -->';
					break;
					// Clone footer picture
					case 'clone_picture':

						$form .='		<!-- sheepIt Form Pictures -->';
						$form .='		<div id="sheepItFormPictures">';
						$form .='			<input type="hidden" id="'.$key.'" name="'.$key.'" value="" />';
						$form .='			<div id="inputJSON" style="display:none;"><!--'.$option_value.'--></div>';
						$form .='			<script type="text/template" class="inputJSON">'.$option_value.'</script>';
						// default values
						$defValues = get_option('footer_gallery_default_values','yes');
						$form .='			<script type="text/template" class="initValues">'.$defValues.'</script>';
						$form .='			<!-- Form template-->';
						$form .='			<div id="sheepItFormPictures_template" class="sheepItFormPictures_template">';

						$form .='				<input type="hidden" id="index_number" name="index_number" value="#index#" />';

						$form .='				<h4>Image</h4>';

						$form .= '				<div class="theme-admin-row clearfix">';
						$form .='					<div class="theme-admin-row-title">Image Source URL</div>';
						$form .='					<div class="theme-admin-row-input">';
						$form .= '        				<input type="text" class="regular-image ' . $value['class'] . '" value="" id="image_src_#index#" name="image_src_#index#" />';
						$form .= '        				<input type="button" value="Select Image" class="media-select" id="image_src_#index#_selectMedia" name="image_src_#index#_selectMedia" />';
						$form .='					</div><!-- /theme-admin-row-input -->';
						$form .='				</div><!-- /admin-row clearfix -->';

						$form .= '				<div class="theme-admin-row clearfix">';
						$form .='					<div class="theme-admin-row-title">Link</div>';
						$form .='					<div class="theme-admin-row-input">';
						$form .= '        				<input type="text" class="regular-text ' . $value['class'] . '" value="" id="image_link_#index#" name="image_link_#index#" />';
						$form .='					</div><!-- /theme-admin-row-input -->';
						$form .='				</div><!-- /admin-row clearfix -->';

						$form .= '				<div class="theme-admin-row clearfix">';
						$form .='					<div class="theme-admin-row-title">Description</div>';
						$form .='					<div class="theme-admin-row-input">';
						$form .= '        				<input type="text" class="regular-text ' . $value['class'] . '" value="" id="image_desc_#index#" name="image_desc_#index#" />';
						$form .='					</div><!-- /theme-admin-row-input -->';
						$form .='				</div><!-- /admin-row clearfix -->';

						$form .='			  </div><!-- /Form template-->';
						$form .='			  <div id="sheepItFormPictures_noforms_template" class="theme-admin-row clearfix">No panels</div>';
						$form .= '			<div class="theme-admin-row clearfix">';
						$form .='				<!-- Controls -->';
						$form .='			  	<div id="sheepItFormPictures_controls">';
						$form .='					<div id="sheepItFormPictures_add" ><span><a class="button-primary">Add picture</a></span></div>';
						$form .='					<div id="sheepItFormPictures_remove_last"><span><a class="button-primary">Remove picture</a></span></div>';
						$form .='			  	</div><!-- /Controls -->';
						$form .='			</div><!-- /admin-row clearfix -->';
						$form .='		</div><!-- /sheepIt Form -->';

					break;
					// Clone slider home page
					case 'clone_home_slider':

						$form .='		<!-- sheepIt Form Home Slider -->';
						$form .='		<div id="sheepItFormHomeSlider">';
						$form .='			<input type="hidden" id="'.$key.'" name="'.$key.'" value="" />';
						$form .='			<div id="inputJSON" style="display:none;"><!--'.$option_value.'--></div>';
						$form .='			<script type="text/template" class="inputJSON">'.$option_value.'</script>';
						// default values
						$defValues = get_option('home_slider_default_values','yes');
						$form .='			<script type="text/template" class="initValues">'.$defValues.'</script>';
						$form .='			<!-- Form template-->';
						$form .='			<div id="sheepItFormHomeSlider_template" class="sheepItFormHomeSlider_template">';

						$form .='				<input type="hidden" id="index_number_home_slider" name="index_number_home_slider" value="#index#" />';

						$form .='				<h4>Image</h4>';

						$form .= '				<div class="theme-admin-row clearfix">';
						$form .='					<div class="theme-admin-row-title">Center image URL</div>';
						$form .='					<div class="theme-admin-row-input">';
						$form .= '        				<input type="text" class="regular-image ' . $value['class'] . '" value="" id="img_src_#index#" name="img_src_#index#" />';
						$form .= '        				<input type="button" value="Select Image" class="media-select" id="img_src_#index#_selectMedia" name="img_src_#index#_selectMedia" />';
						$form .='					</div><!-- /theme-admin-row-input -->';
						$form .='				</div><!-- /admin-row clearfix -->';

						$form .= '				<div class="theme-admin-row clearfix">';
						$form .='					<div class="theme-admin-row-title">Background image URL</div>';
						$form .='					<div class="theme-admin-row-input">';
						$form .= '        				<input type="text" class="regular-image ' . $value['class'] . '" value="" id="img_background_#index#" name="img_background_#index#" />';
						$form .= '        				<input type="button" value="Select Image" class="media-select" id="img_background_#index#_selectMedia" name="img_background_#index#_selectMedia" />';
						$form .='					</div><!-- /theme-admin-row-input -->';
						$form .='				</div><!-- /admin-row clearfix -->';

						$form .= '				<div class="theme-admin-row clearfix">';
						$form .='					<div class="theme-admin-row-title">Link (center image)</div>';
						$form .='					<div class="theme-admin-row-input">';
						$form .= '        				<input type="text" class="regular-text ' . $value['class'] . '" value="" id="img_link_#index#" name="img_link_#index#" />';
						$form .='					</div><!-- /theme-admin-row-input -->';
						$form .='				</div><!-- /admin-row clearfix -->';

						$form .= '				<div class="theme-admin-row clearfix">';
						$form .='					<div class="theme-admin-row-title">Description</div>';
						$form .='					<div class="theme-admin-row-input">';
						$form .= '        				<input type="text" class="regular-text ' . $value['class'] . '" value="" id="img_desc_#index#" name="img_desc_#index#" />';
						$form .='					</div><!-- /theme-admin-row-input -->';
						$form .='				</div><!-- /admin-row clearfix -->';

						$form .='			  </div><!-- /Form template-->';
						$form .='			  <div id="sheepItFormHomeSlider_noforms_template" class="theme-admin-row clearfix">No panels</div>';
						$form .= '			<div class="theme-admin-row clearfix">';
						$form .='				<!-- Controls -->';
						$form .='			  	<div id="sheepItFormHomeSlider_controls">';
						$form .='					<div id="sheepItFormHomeSlider_add" ><span><a class="button-primary">Add picture</a></span></div>';
						$form .='					<div id="sheepItFormHomeSlider_remove_last"><span><a class="button-primary">Remove picture</a></span></div>';
						$form .='			  	</div><!-- /Controls -->';
						$form .='			</div><!-- /admin-row clearfix -->';
						$form .='		</div><!-- /sheepIt Form -->';

					break;
			}
	}
	// Close table
	$form .= '</div><!-- /.theme-admin -->';

	// Submit form
	if (!$has_box) {
    	$form .= '<p class="submit">';
    	$form .= '<input type="hidden" name="action" value="save" />';
    	$form .= '<input name="save" type="submit" value="Save changes" class="button-primary"/>';
    	$form .= '</p>';
	}

	// Close the form
	$form .= '</form>';
	return $form;
}

function strip_string ( $string, $limit, $end = '...' ) {
    if ( empty( $limit ) || empty( $string ) ) return;

    $my_text = substr( $string, 0, $limit );
    $pos = strrpos( $my_text, ' ' );
    $my_post_text = substr( $my_text, 0, ( $pos ? $pos : -1 ) ) . $end;
    $result = strip_tags( $my_post_text );

    return $result;
}

function get_left_box(){

	$left_box_show = get_option( 'left_box_show' );
	if ( trim($left_box_show) != "no" ){

		$left_box_show_content = get_option( 'left_box_show_content' );
		if ( trim($left_box_show_content) == "yes" ){

		$left_box_title = get_option( 'left_box_title' );
		if(empty($left_box_title)){
			$left_box_title = "Left box";
		}
		$left_box_image = get_option( 'left_box_image' );

		$left_box_1_service_title = get_option( 'left_box_1_service_title' );
		$left_box_2_service_title = get_option( 'left_box_2_service_title' );
		$left_box_3_service_title = get_option( 'left_box_3_service_title' );
		$left_box_1_service_subtitle = get_option( 'left_box_1_service_subtitle' );
		$left_box_2_service_subtitle = get_option( 'left_box_2_service_subtitle' );
		$left_box_3_service_subtitle = get_option( 'left_box_3_service_subtitle' );
		$left_box_1_service_icon = get_option( 'left_box_1_service_icon' );
		$left_box_2_service_icon = get_option( 'left_box_2_service_icon' );
		$left_box_3_service_icon = get_option( 'left_box_3_service_icon' );


		$form .='		<div class="part1">';
		$form .='				<div class="box-left pgsize1">';
		$form .='					<div class="inside">';
		$form .='						<h2 class="special">'.$left_box_title.'</h2>';
		if(!empty($left_box_image)){
		$form .='						<div class="special">';
		$form .='							<img src="'.link_to($left_box_image).'" class="spcimg" alt="" />';
		$form .='							<div class="ribon">more</div>';
		$form .='							<div class="spcdesc">';
		$form .='								'.get_option( 'left_box_image_description');
		$form .='								<br/>';
		$form .='								<a href="'.link_to(get_option( ' left_box_image_description_more_link' )).'" class="button">read more</a>';
		$form .='							</div>';
		$form .='						</div>';
		}
		if(!empty($left_box_1_service_title)){
		$form .='						<div class="services">';
		$form .='						<div class="service">';
		$form .='							<h3><a href="'.link_to(get_option( 'left_box_1_service_link' )).'">';
		if(!empty($left_box_1_service_icon)){
		$form .='							<img src="'.link_to($left_box_1_service_icon).'" alt="" />';
		}
		$form .='							<span class="title">'.$left_box_1_service_title.'</span>';
		$form .='							<span class="descr">'.$left_box_1_service_subtitle.'</span>';
		$form .='							</a></h3>';
		$form .='						</div>';
		}
		if(!empty($left_box_2_service_title)){
		$form .='						<div class="service">';
		$form .='							<h3><a href="'.link_to(get_option( 'left_box_2_service_link' )).'">';
		if(!empty($left_box_2_service_icon)){
		$form .='							<img src="'.link_to($left_box_2_service_icon).'" alt="" />';
		}
		$form .='							<span class="title">'.$left_box_2_service_title.'</span>';
		$form .='							<span class="descr">'.$left_box_2_service_subtitle.'</span>';
		$form .='							</a></h3>';
		$form .='						</div>';
		}
		if(!empty($left_box_3_service_title)){
		$form .='						<div class="service">';
		$form .='							<h3><a href="'.link_to(get_option( 'left_box_3_service_link' )).'">';
		if(!empty($left_box_3_service_icon)){
		$form .='							<img src="'.link_to($left_box_3_service_icon).'" alt="" />';
		}
		$form .='							<span class="title">'.$left_box_3_service_title.'</span>';
		$form .='							<span class="descr">'.$left_box_3_service_subtitle.'</span>';
		$form .='							</a></h3>';
		$form .='						</div>';
		}
		if(!empty($left_box_1_service_title)){
		$form .='						</div>';
		}
		$form .='					</div><!-- end of inside -->';
		$form .='				</div><!-- end of box -->';
		$form .='			</div><!-- end of part1 -->';

		echo $form;

		} else {
			$form_before .='		<div class="part1">';
			$form_before .='				<div class="box-left pgsize1">';
			$form_before .='					<div class="inside">';
			$form_before .='					<div class="leftbox-widget-container">';
			$form_before .='						<div class="leftbox-widget-area">';
			$form_before .='						<!-- scroller block -->';
			$form_before .='						<div id="mcs_container_left">';
			$form_before .='							<div id="leftScrollBox" class="customScrollBox">';
			$form_before .='								<div class="container">';
			$form_before .='									<div class="content">';
																// leftbox widget area
			$form_after .='										</div><!-- end of content -->';
			$form_after .='									</div><!-- end of container -->';
			$form_after .='									<div class="dragger_container">';
			$form_after .='										<div class="dragger">&#9618;</div>';
			$form_after .='									</div><!-- end of dragger_container -->';
			$form_after .='								</div><!-- end of customScrollBox -->';
			$form_after .='							</div><!-- end of mcs_container -->';
			$form_after .='							</div>';
			$form_after .='						</div>';
			$form_after .='					</div><!-- end of inside -->';
			$form_after .='				</div><!-- end of box -->';
			$form_after .='			</div><!-- end of part1 -->';

			echo $form_before; dynamic_sidebar( 'leftbox-widget-area' ); echo $form_after;
		}
	} else {
		echo '<div class="part1"></div>';
	}
}

function get_right_box(){

	$right_box_show = get_option( 'right_box_show' );

	if ( trim($right_box_show) != "no" ){
		$form_before .='			<div class="part3">';
		$form_before .='				<div class="thumb_container">';
		$form_before .='					<div class="thumb"><div class="crop"><img src="'.get_bloginfo( 'template_directory' ).'/lib/timthumb/timthumb.php?src='.link_to("wp-content/themes/fullscreen/images/thumbnail.jpg").'&amp;w=84&amp;h=84" alt="'.get_bloginfo( 'template_directory' ).'" /></div></div>';
		$form_before .='				</div>';
		$form_before .='				<div class="box-right pgsize3">';
		$form_before .='					<div class="inside">';
		$form_before .='						<div class="sidetabs">';
		$form_before .='							<span class="moretab">more</span>';
		$form_before .='							<ul><li></li>';
		$form_before .='							</ul>';
		$form_before .='						</div>';
		$form_before .='						<div class="sidepost">';
		$form_before .='						<h2>Rightbox</h2>';
		$form_before .='						<!-- scroller block -->';
		$form_before .='						<div id="mcs_container">';
		$form_before .='							<div id="rightScrollBox" class="customScrollBox">';
		$form_before .='								<div class="container">';
		$form_before .='									<div class="content">';
																//get_sidebar();
		$form_after .='										</div><!-- end of content -->';
		$form_after .='									</div><!-- end of container -->';
		$form_after .='									<div class="dragger_container">';
		$form_after .='										<div class="dragger">&#9618;</div>';
		$form_after .='									</div><!-- end of dragger_container -->';
		$form_after .='								</div><!-- end of customScrollBox -->';
		$form_after .='							</div><!-- end of mcs_container -->';

		$form_end .='						</div>';
		$form_end .='					</div>';
		$form_end .='				</div>';
		$form_end .='			</div>';

		echo $form_before; get_sidebar(); echo $form_after; get_search_form(); echo $form_end;

	} else {
		$form_before .='			<div class="part3">';
		$form_end .='			</div>';

		echo $form_before; echo $form_end;
	}



}
