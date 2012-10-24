<?php
/**
 * @package SuperCustomCMS
 * @subpackage Backend Theme options
 * @author karim salim
 */
if ( ! function_exists( 'add_action' ) ) {
	echo "Hi there!  I'm just a part of plugin, not much I can do when called directly.";
	exit;
}
?>
		<div class="supercustom_cms_section">
				<div class="supercustom_cms_title">
                <h3 class="hndle" id="set_theme"><img src="<?php _e(WP_SUPERCUSTOM_CMS_ADDRESS); ?>images/trans.png" class="inactive" alt=""/><?php _e('Set Theme', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ) ?></h3>                                                                                
                <span class="submitt"><input class="button-abc" type="submit" name="__wp_supercustom_cms_save" value="<?php //_e('Save changes', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?> " /></span>
				<div class="clearfix"></div></div>
                        <div class="supercustom_cms_options" style="display: none;">
                        <div class="inside">
					
					<?php if ( ! isset($_POST['__wp_supercustom_cms_action']) || !($_POST['__wp_supercustom_cms_action'] == '__wp_supercustom_cms_load_theme') ) { ?>
					<form name="set_theme" method="post" id="__wp_supercustom_cms_set_theme" action="?page=<?php echo esc_attr( $_GET['page'] ); ?>" >
							<?php wp_nonce_field('wp_supercustom_cms_nonce'); ?>
							<p><?php _e('For better peformance with many users on your blog; load only userlist, when you will change the theme options for users.', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></p>
							<p id="submitbutton">
								<input type="hidden" name="__wp_supercustom_cms_action" value="__wp_supercustom_cms_load_theme" />
								<input type="submit" name="__wp_supercustom_cms_load" value="<?php //_e('Load User Data', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?> " class="button-abcx" />
							</p>
					</form>
					<?php }
					if (  isset($_POST['__wp_supercustom_cms_action']) && ($_POST['__wp_supercustom_cms_action'] == '__wp_supercustom_cms_load_theme') ) { ?>
						<form name="set_theme" method="post" id="__wp_supercustom_cms_set_theme" action="?page=<?php echo esc_attr( $_GET['page'] ); ?>" >
							<?php wp_nonce_field('wp_supercustom_cms_nonce'); ?>
							<table class="widefat">
								<thead>
									<tr class="thead">
										<th>&nbsp;</th>
										<th class="num"><?php _e('User-ID') ?></th>
										<th><?php _e('Username') ?></th>
										<th><?php _e('Display name publicly as') ?></th>
										<th><?php _e('Admin-Color Scheme') ?></th>
										<th><?php _e('User Level') ?></th>
										<th><?php _e('Role') ?></th>
									</tr>
								</thead>
								<tbody id="users" class="list:user user-list">
									<?php
									$wp_user_search = $wpdb->get_results("SELECT ID, user_login, display_name FROM $wpdb->users ORDER BY ID");
	
									$style = '';
									foreach ( $wp_user_search as $userid ) {
										$user_id       = (int) $userid->ID;
										$user_login    = stripslashes($userid->user_login);
										$display_name  = stripslashes($userid->display_name);
										$current_color = get_user_option('admin_color', $user_id);
										$user_level    = (int) get_user_option($table_prefix . 'user_level', $user_id);
										$user_object   = new WP_User($user_id);
										$roles         = $user_object->roles;
										$role          = array_shift($roles);
										if ( function_exists('translate_user_role') )
											$role_name   = translate_user_role( $wp_roles->role_names[$role] );
										elseif ( function_exists('before_last_bar') )
											$role_name   = before_last_bar( $wp_roles->role_names[$role], 'User role' );
										else
											$role_name   = strrpos( $wp_roles->role_names[$role], '|' );
										
										$style = ( ' class="alternate"' == $style ) ? '' : ' class="alternate"';
										$return  = '';
										$return .= '<tr>' . "\n";
										$return .= "\t" . '<td><input type="checkbox" name="wp_supercustom_cms_theme_items[]" value="' . $user_id . '" /></td>' . "\n";
										$return .= "\t" . '<td class="num">'. $user_id .'</td>' . "\n";
										$return .= "\t" . '<td>'. $user_login .'</td>' . "\n";
										$return .= "\t" . '<td>'. $display_name .'</td>' . "\n";
										$return .= "\t" . '<td>'. $current_color . '</td>' . "\n";
										$return .= "\t" . '<td class="num">'. $user_level . '</td>' . "\n";
										$return .= "\t" . '<td>'. $role_name . '</td>' . "\n";
										$return .= '</tr>' . "\n";
	
										echo $return;
									}
									?>
										<tr valign="top">
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>
												<select name="__wp_supercustom_cms_set_theme">
													<?php foreach ( $_wp_admin_css_colors as $color => $color_info ): ?>
														<option value="<?php echo $color; ?>"><?php echo $color_info->name . ' (' . $color . ')' ?></option>
													<?php endforeach; ?>
													</select>
											</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
								</tbody>
							</table>
							<p id="submitbutton">
								<input type="hidden" name="__wp_supercustom_cms_action" value="__wp_supercustom_cms_set_theme" />
								<input type="hidden" name="__wp_supercustom_cms_load" value="__wp_supercustom_cms_load_theme" />
							</p>
						</form>
					<?php } ?>
					
					<p><a class="alignright button" href="javascript:void(0);" onclick="window.scrollTo(0,0);" style="margin:3px 0 0 30px;"><?php _e('scroll to top', FB_SUPERCUSTOM_CMS_TEXTDOMAIN); ?></a><br class="clear" /></p>
				</div>
			</div>
		</div>