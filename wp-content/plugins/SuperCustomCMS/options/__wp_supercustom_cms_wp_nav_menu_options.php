<?php
/**
 * @package SuperCustomCMS
 * @subpackage Nav Menu Options
 * @author karim salim
 */
if ( ! function_exists( 'add_action' ) ) {
	echo "Hi there!  I'm just a part of plugin, not much I can do when called directly.";
	exit;
}
?>
		<div class="supercustom_cms_section">
				<div class="supercustom_cms_title">
                <h3 class="hndle" id="nav_menu_options"><img src="<?php _e(WP_SUPERCUSTOM_CMS_ADDRESS); ?>images/trans.png" class="inactive" alt=""/><?php _e('WP Nav Menu options', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></h3>                                                                                
                <span class="submitt"><input class="button-abc" type="submit" name="__wp_supercustom_cms_save" value="<?php //_e('Save changes', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?> " /></span>
				<div class="clearfix"></div></div>
                        <div class="supercustom_cms_options" style="display: none;">
                        <div class="inside">

					<table summary="config_nav_menu" class="widefat">
						<thead>
							<tr>
								<th><?php _e('Option', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></th>
								<?php
									foreach ($user_roles_names as $role_name) { ?>
										<th><?php _e('Deactivate for', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); echo '<br/>' . $role_name; ?></th>
								<?php } ?>
							</tr>
						</thead>

						<tbody>
						<?php
							foreach ($user_roles as $role) {
								$disabled_nav_menu_option_[$role] = __wp_supercustom_cms_get_option_value('wp_supercustom_cms_disabled_nav_menu_option_'. $role .'_items');
							}
							
							$nav_menu_options = array(
								'#contextual-help-link-wrap',
								'#screen-options-link-wrap',
								'#nav-menu-theme-locations',
								'#add-custom-links',
								'.menu-add-new'
							);
							
							if ( wp_get_nav_menus() )
								array( $nav_menu_options, '#nav-menu-theme-locations' );
								
							$nav_menu_options_names = array(
								__('Help', FB_SUPERCUSTOM_CMS_TEXTDOMAIN),
								__('Screen Options'),
								__('Theme Locations', FB_SUPERCUSTOM_CMS_TEXTDOMAIN),
								__('Custom Links', FB_SUPERCUSTOM_CMS_TEXTDOMAIN),
								'#(' . __('Add menu', FB_SUPERCUSTOM_CMS_TEXTDOMAIN) . ')'
							);
							
							if ( wp_get_nav_menus() )
								array( $nav_menu_options_names, __( 'Theme Locations' ) );
							
							// taxonomies
							$taxonomies = get_taxonomies( array( 'show_in_nav_menus' => true ), 'object' );
							if ($taxonomies) {
								foreach ( $taxonomies as $tax ) {
									if ( $tax ) {
										array_push($nav_menu_options, '#add-' . $tax->name);
										array_push($nav_menu_options_names, $tax->labels->name);
									}
								}
							}
							
							// post types
							$post_types = get_post_types( array( 'show_in_nav_menus' => true ), 'object' );
							if ($post_types) {
								foreach ( $post_types as $post_type ) {
									if ( $post_type ) {
										array_push($nav_menu_options, '#add-' . $post_type->name);
										array_push($nav_menu_options_names, $post_type->labels->name);
									}
								}
							}
							
							$__wp_supercustom_cms_own_nav_menu_values  = __wp_supercustom_cms_get_option_value('__wp_supercustom_cms_own_nav_menu_values');
							$__wp_supercustom_cms_own_nav_menu_values = preg_split( "/\r\n/", $__wp_supercustom_cms_own_nav_menu_values );
							foreach ( (array) $__wp_supercustom_cms_own_nav_menu_values as $key => $__wp_supercustom_cms_own_nav_menu_value ) {
								$__wp_supercustom_cms_own_nav_menu_value = trim($__wp_supercustom_cms_own_nav_menu_value);
								array_push($nav_menu_options, $__wp_supercustom_cms_own_nav_menu_value);
							}
							
							$__wp_supercustom_cms_own_nav_menu_options = __wp_supercustom_cms_get_option_value('__wp_supercustom_cms_own_nav_menu_options');
							$__wp_supercustom_cms_own_nav_menu_options = preg_split( "/\r\n/", $__wp_supercustom_cms_own_nav_menu_options );
							foreach ( (array) $__wp_supercustom_cms_own_nav_menu_options as $key => $__wp_supercustom_cms_own_nav_menu_option ) {
								$__wp_supercustom_cms_own_nav_menu_option = trim($__wp_supercustom_cms_own_nav_menu_option);
								array_push($nav_menu_options_names, $__wp_supercustom_cms_own_nav_menu_option);
							}
							
							$x = 0;
							foreach ($nav_menu_options as $index => $nav_menu_option) {
								if ( $nav_menu_option != '') {
									$checked_user_role_ = array();
									foreach ($user_roles as $role) {
										$checked_user_role_[$role]  = ( isset($disabled_nav_menu_option_[$role]) && in_array($nav_menu_option, $disabled_nav_menu_option_[$role]) ) ? ' checked="checked"' : '';
									}
									echo '<tr>' . "\n";
									echo '<td>' . $nav_menu_options_names[$index] . ' <span style="color:#ccc; font-weight: 400;">(' . $nav_menu_option . ')</span> </td>' . "\n";
									foreach ($user_roles as $role) {
										echo '<td class="num"><input id="check_post'. $role . $x .'" type="checkbox"' . $checked_user_role_[$role] . ' name="wp_supercustom_cms_disabled_nav_menu_option_'. $role .'_items[]" value="' . $nav_menu_option . '" /></td>' . "\n";
									}
									echo '</tr>' . "\n";
									$x++;
								}
							}
						?>
						</tbody>
					</table>
					
					<?php
					//your own global options
					?>
					<br style="margin-top: 10px;" />
					<table summary="config_edit_post" class="widefat">
						<thead>
							<tr>
								<th><?php _e('Your own Nav Menu options', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); echo '<br />'; _e('ID or class', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></th>
								<th><?php echo '<br />'; _e('Option', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></th>
							</tr>
						</thead>

						<tbody>
							<tr valign="top">
								<td colspan="2"><?php _e('It is possible to add your own IDs or classes from elements and tags. You can find IDs and classes with the FireBug Add-on for Firefox. Assign a value and the associate name per line.', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></td>
							</tr>
							<tr valign="top">
								<td>
									<textarea name="__wp_supercustom_cms_own_nav_menu_options" cols="60" rows="3" id="__wp_supercustom_cms_own_nav_menu_options" style="width: 95%;" ><?php echo __wp_supercustom_cms_get_option_value('__wp_supercustom_cms_own_nav_menu_options'); ?></textarea>
									<br />
									<?php _e('Possible nomination for ID or class. Separate multiple nominations through a carriage return.', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?>
								</td>
								<td>
									<textarea class="code" name="__wp_supercustom_cms_own_nav_menu_values" cols="60" rows="3" id="__wp_supercustom_cms_own_nav_menu_values" style="width: 95%;" ><?php echo __wp_supercustom_cms_get_option_value('__wp_supercustom_cms_own_nav_menu_values'); ?></textarea>
									<br />
									<?php _e('Possible IDs or classes. Separate multiple values through a carriage return.', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?>
								</td>
							</tr>
						</tbody>
					</table>
					
					<p id="submitbutton">
						<input type="hidden" name="__wp_supercustom_cms_action" value="__wp_supercustom_cms_insert" />
						 
					</p>
					<p><a class="alignright button" href="javascript:void(0);" onclick="window.scrollTo(0,0);" style="margin:3px 0 0 30px;"><?php _e('scroll to top', FB_SUPERCUSTOM_CMS_TEXTDOMAIN); ?></a><br class="clear" /></p>
				
				</div>
			</div>
		</div>