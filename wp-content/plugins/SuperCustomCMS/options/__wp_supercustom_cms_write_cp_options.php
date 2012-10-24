<?php
/**
 * @package SuperCustomCMS
 * @subpackage Custom Post type options
 * @author karim salim
 */
if ( ! function_exists( 'add_action' ) ) {
	echo "Hi there!  I'm just a part of plugin, not much I can do when called directly.";
	exit;
}

$args = array( 'public' => TRUE, '_builtin' => FALSE );
foreach ( get_post_types( $args ) as $post_type ) {
	$post_type_object = get_post_type_object($post_type);
?>

		<div class="supercustom_cms_section">
				<div class="supercustom_cms_title">
                <h3 class="hndle" id="config_edit_<?php echo $post_type; ?>">
					<img src="<?php _e(WP_SUPERCUSTOM_CMS_ADDRESS); ?>images/trans.png" class="inactive" alt=""/><?php _e('Write options', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); echo ' - ' . $post_type_object->label; ?>
				</h3>
                <span class="submitt"><input class="button-abc" type="submit" name="__wp_supercustom_cms_save" value="<?php //_e('Save changes', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?> " /></span>
				<div class="clearfix"></div></div>
                        <div class="supercustom_cms_options" style="display: none;">
                        <div class="inside">

					<table summary="config_edit_post" class="widefat">
						<thead>
							<tr>
								<th><?php _e('Write options', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); echo ' - ' . $post_type_object->label ?></th>
							<?php
							foreach ( $user_roles_names as $role_name ) { ?>
								<th><?php _e('Deactivate for', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); echo '<br/>' . $role_name; ?></th>
							<?php } ?>
							</tr>
						</thead>

						<tbody>
						<?php
							$metaboxes = array(
								'#contextual-help-link-wrap',
								'#screen-options-link-wrap',
								'#pageslugdiv',
								'#tagsdiv,#tagsdivsb,#tagsdiv-post_tag',
								'#formatdiv',
								'#categorydiv,#categorydivsb',
								'#category-add-toggle',
								'#passworddiv',
								'.side-info',
								'#notice',
								'#post-body h2',
								'#media-buttons',
								'#wp-word-count',
								'#slugdiv,#edit-slug-box',
								'#misc-publishing-actions',
								'#commentstatusdiv',
								'#editor-toolbar #edButtonHTML, #quicktags, #content-html'
							);
							
							foreach ( $GLOBALS['_wp_post_type_features'][$post_type] as $post_type_support => $key ) {
								if ( post_type_supports( $post_type, $post_type_support ) )
									if ( 'excerpt' === $post_type_support )
										$post_type_support = 'postexcerpt';
									if ( 'page-attributes' === $post_type_support )
										$post_type_support = 'pageparentdiv';
									if ( 'custom-fields' == $post_type_support )
										$post_type_support = 'postcustom';
									array_push( $metaboxes, '#' . $post_type_support . ', #' . $post_type_support . 'div' );
							}
							if ( function_exists('current_theme_supports') && 
								 current_theme_supports( 'post-thumbnails', $post_type )
								)
								array_push($metaboxes, '#postimagediv');
							if (function_exists('sticky_add_meta_box'))
								array_push($metaboxes, '#poststickystatusdiv');

							// quick edit areas, id and class
							$quickedit_areas = array(
								'div.row-actions .inline',
								'fieldset.inline-edit-col-left',
								'fieldset.inline-edit-col-left label',
								'fieldset.inline-edit-col-left label.inline-edit-author',
								'fieldset.inline-edit-col-left .inline-edit-group',
								'fieldset.inline-edit-col-center',
								'fieldset.inline-edit-col-center .inline-edit-categories-label',
								'fieldset.inline-edit-col-center .category-checklist',
								'fieldset.inline-edit-col-right',
								'fieldset.inline-edit-col-right .inline-edit-tags',
								'fieldset.inline-edit-col-right .inline-edit-group',
								'tr.inline-edit-save p.inline-edit-save'
							);
							$metaboxes = array_merge( $metaboxes, $quickedit_areas );

							$metaboxes_names = array(
								__('Help'),
								__('Screen Options'),
								__('Permalink', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ),
								__('Tags', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ),
								__('Format', FB_SUPERCUSTOM_CMS_TEXTDOMAIN),
								__('Categories', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ),
								__('Add New Category', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ),
								__('Password Protect This Post', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ),
								__('Related, Shortcuts', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ),
								__('Messages', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ),
								__('h2: Advanced Options', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ),
								__('Media Buttons (all)', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ),
								__('Word count', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ),
								__('Post Slug', FB_SUPERCUSTOM_CMS_TEXTDOMAIN),
								__('Publish Actions', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ),
								__('Discussion'),
								__('HTML Editor Button')
							);
							
							foreach ( $GLOBALS['_wp_post_type_features'][$post_type] as $post_type_support => $key ) {
								if ( post_type_supports( $post_type, $post_type_support ) )
									array_push( $metaboxes_names, ucfirst($post_type_support) );
							}
							if ( function_exists('current_theme_supports') && 
								 current_theme_supports( 'post-thumbnails', 'post' )
								)
								array_push($metaboxes_names, __('Post Thumbnail', FB_SUPERCUSTOM_CMS_TEXTDOMAIN) );
							if (function_exists('sticky_add_meta_box'))
								array_push($metaboxes_names, 'Post Sticky Status');
							
							// quick edit names
							$quickedit_names = array(
								'<strong>' .__('Quick Edit Link', FB_SUPERCUSTOM_CMS_TEXTDOMAIN) . '</strong>',
								__('QE', FB_SUPERCUSTOM_CMS_TEXTDOMAIN) . ' ' . __('Inline Edit Left', FB_SUPERCUSTOM_CMS_TEXTDOMAIN),
								'&emsp;QE &rArr;' . ' ' . __('All Labels', FB_SUPERCUSTOM_CMS_TEXTDOMAIN),
								'&emsp;QE &rArr;' . ' ' . __('Author'),
								'&emsp;QE &rArr;' . ' ' . __('Password and Private', FB_SUPERCUSTOM_CMS_TEXTDOMAIN),
								__('QE', FB_SUPERCUSTOM_CMS_TEXTDOMAIN) . ' ' . __('Inline Edit Center', FB_SUPERCUSTOM_CMS_TEXTDOMAIN),
								'&emsp;QE &rArr;' . ' ' . __('Categories Title', FB_SUPERCUSTOM_CMS_TEXTDOMAIN),
								'&emsp;QE &rArr;' . ' ' . __('Categories List', FB_SUPERCUSTOM_CMS_TEXTDOMAIN),
								__('QE', FB_SUPERCUSTOM_CMS_TEXTDOMAIN) . ' ' . __('Inline Edit Right', FB_SUPERCUSTOM_CMS_TEXTDOMAIN),
								'&emsp;QE &rArr;' . ' ' . __('Tags'),
								'&emsp;QE &rArr;' . ' ' . __('Status, Sticky', FB_SUPERCUSTOM_CMS_TEXTDOMAIN),
								__('QE', FB_SUPERCUSTOM_CMS_TEXTDOMAIN) . ' ' . __('Cancel/Save Button', FB_SUPERCUSTOM_CMS_TEXTDOMAIN)
							);
							$metaboxes_names = array_merge($metaboxes_names, $quickedit_names);
							
							// add own post options
							$__wp_supercustom_cms_own_values_[$post_type] = __wp_supercustom_cms_get_option_value(
								'__wp_supercustom_cms_own_values_' . $post_type
							);
							$__wp_supercustom_cms_own_values_[$post_type] = preg_split( "/\r\n/", $__wp_supercustom_cms_own_values_[$post_type] );
							foreach ( (array) $__wp_supercustom_cms_own_values_[$post_type] as $key => $__wp_supercustom_cms_own_value_[$post_type] ) {
								$__wp_supercustom_cms_own_value_[$post_type] = trim( $__wp_supercustom_cms_own_value_[$post_type] );
								array_push( $metaboxes, $__wp_supercustom_cms_own_value_[$post_type] );
							}
							
							$__wp_supercustom_cms_own_options_[$post_type] = __wp_supercustom_cms_get_option_value(
								'__wp_supercustom_cms_own_options_' . $post_type
							);
							$__wp_supercustom_cms_own_options_[$post_type] = preg_split( "/\r\n/", $__wp_supercustom_cms_own_options_[$post_type] );
							foreach ( (array) $__wp_supercustom_cms_own_options_[$post_type] as $key => $__wp_supercustom_cms_own_option_[$post_type] ) {
								$__wp_supercustom_cms_own_option_[$post_type] = trim( $__wp_supercustom_cms_own_option_[$post_type] );
								array_push( $metaboxes_names, $__wp_supercustom_cms_own_option_[$post_type] );
							}
							
							$x = 0;
							$class = '';
							foreach ($metaboxes as $index => $metabox) {
								if ( '' != $metabox ) {
									$class = ( ' class="alternate"' == $class ) ? '' : ' class="alternate"';
									$checked_user_role_ = array();
									foreach ($user_roles as $role) {
										$disabled_metaboxes_[$post_type . '_' . $role] = __wp_supercustom_cms_get_option_value(
											'wp_supercustom_cms_disabled_metaboxes_' . $post_type . '_' . $role . '_items'
										);
										$checked_user_role_[$post_type . '_' . $role] = ( 
											isset($disabled_metaboxes_[$post_type . '_' . $role]) && 
											in_array($metabox, $disabled_metaboxes_[$post_type . '_' . $role]) 
										) ? ' checked="checked"' : '';
									}
									echo '<tr' . $class . '>' . "\n";
									echo '<td>' . $metaboxes_names[$index] . 
										' <span style="color:#ccc; font-weight: 400;">(' . $metabox . ')</span> </td>' . "\n";
									foreach ($user_roles as $role) {
										echo '<td class="num"><input id="check_' . 
											$post_type . $role . $x .'" type="checkbox"' . 
											$checked_user_role_[$post_type . '_' . $role] . 
											' name="wp_supercustom_cms_disabled_metaboxes_' . $post_type . 
											'_'. $role .'_items[]" value="' . $metabox . '" /></td>' . "\n";
									}
									echo '</tr>' . "\n";
									$x ++;
								}
							}
						?>
						</tbody>
					</table>
					
					<?php
					//your own post options
					?>
					<br style="margin-top: 10px;" />
					<table summary="config_own_post" class="widefat">
						<thead>
							<tr>
								<th>
									<?php echo sprintf( __('Your own %s options', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ), $post_type_object->label ); 
									echo '<br />'; _e('ID or class', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?>
								</th>
								<th><?php echo '<br />'; _e('Option', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></th>
							</tr>
						</thead>

						<tbody>
							<tr valign="top">
								<td colspan="2">
								<?php _e('It is possible to add your own IDs or classes from elements and tags. You can find IDs and classes with the FireBug Add-on for Firefox. Assign a value and the associate name per line.', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?>
								</td>
							</tr>
							<tr valign="top">
								<td>
									<textarea name="__wp_supercustom_cms_own_options_<?php echo $post_type; ?>" 
										cols="60" rows="3" 
										id="__wp_supercustom_cms_own_options_<?php echo $post_type; ?>" 
										style="width: 95%;" ><?php echo __wp_supercustom_cms_get_option_value('__wp_supercustom_cms_own_' . $post_type . '_options'); ?></textarea>
									<br />
									<?php _e('Possible nomination for ID or class. Separate multiple nominations through a carriage return.', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?>
								</td>
								<td>
									<textarea class="code" name="__wp_supercustom_cms_own_values_<?php echo $post_type; ?>" 
										cols="60" rows="3" 
										id="__wp_supercustom_cms_own_values_<?php echo $post_type; ?>" 
										style="width: 95%;" >
										<?php echo __wp_supercustom_cms_get_option_value('__wp_supercustom_cms_own_' . $post_type . '_values'); ?></textarea>
									<br />
									<?php _e('Possible IDs or classes. Separate multiple values through a carriage return.', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?>
								</td>
							</tr>
						</tbody>
					</table>
					
					<p id="submitbutton">
						<input type="hidden" name="__wp_supercustom_cms_action" value="__wp_supercustom_cms_insert" />
					</p>
					<p><a class="alignright button" href="javascript:void(0);" 
							onclick="window.scrollTo(0,0);" style="margin:3px 0 0 30px;">
							<?php _e('scroll to top', FB_SUPERCUSTOM_CMS_TEXTDOMAIN); ?></a>
						<br class="clear" />
					</p>

				</div>
			</div>
		</div>

<?php } // end foreach ?>