<?php
/**
 * @package SuperCustomCMS
 * @subpackage Backend Options
 * @author karim salim
 */
if ( ! function_exists( 'add_action' ) ) {
	echo "Hi there!  I'm just a part of plugin, not much I can do when called directly.";
	exit;
}
?>
			<div class="supercustom_cms_section">
				<div class="supercustom_cms_title"><h3><img src="<?php _e(WP_SUPERCUSTOM_CMS_ADDRESS); ?>images/trans.png" class="inactive" alt=""/><?php _e('Backend Options', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></h3>                                                                                
                <span class="submitt"><input class="button-abc" type="submit" name="__wp_supercustom_cms_save" value="<?php //_e('Save changes', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?> " /></span>
                    <div class="clearfix"></div></div>
                        <div class="supercustom_cms_options" style="display: none;">
                        <div class="inside">

					<?php wp_nonce_field('wp_supercustom_cms_nonce'); ?>
					<br class="clear" />
					<table summary="config" class="widefat">
						<tbody>
							<?php if ( function_exists('is_super_admin') ) { ?>
							<tr valign="top" class="form-invalid">
								<td><?php _e('Exclude Super Admin', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></td>
								<td>
									<?php $__wp_supercustom_cms_exclude_super_admin = __wp_supercustom_cms_get_option_value('__wp_supercustom_cms_exclude_super_admin'); ?>
									<select name="__wp_supercustom_cms_exclude_super_admin">
										<option value="0"<?php if ($__wp_supercustom_cms_exclude_super_admin == '0') { echo ' selected="selected"'; } ?>><?php _e('Default', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></option>
										<option value="1"<?php if ($__wp_supercustom_cms_exclude_super_admin == '1') { echo ' selected="selected"'; } ?>><?php _e('Activate', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></option>
									</select> <?php _e('Exclude the Super Admin on a WP Multisite Install from all limitations of this plugin.', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?>
								</td>
							</tr>
							<?php } ?>
							<tr valign="top">
								<td><?php _e('User-Info', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></td>
								<td>
									<?php $__wp_supercustom_cms_user_info = __wp_supercustom_cms_get_option_value('__wp_supercustom_cms_user_info'); ?>
									<select name="__wp_supercustom_cms_user_info">
										<option value="0"<?php if ($__wp_supercustom_cms_user_info == '0') { echo ' selected="selected"'; } ?>><?php _e('Default', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></option>
										<option value="1"<?php if ($__wp_supercustom_cms_user_info == '1') { echo ' selected="selected"'; } ?>><?php _e('Hide', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></option>
										<option value="2"<?php if ($__wp_supercustom_cms_user_info == '2') { echo ' selected="selected"'; } ?>><?php _e('Only logout', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></option>
										<option value="3"<?php if ($__wp_supercustom_cms_user_info == '3') { echo ' selected="selected"'; } ?>><?php _e('User &amp; Logout', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></option>
									</select> <?php _e('The &quot;User-Info-area&quot; is on the top right side of the backend. You can hide or reduced show.', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?>
								</td>
							</tr>
							<?php if ( ($__wp_supercustom_cms_user_info == '') || ($__wp_supercustom_cms_user_info == '1') || ($__wp_supercustom_cms_user_info == '0') ) $disabled_item = ' disabled="disabled"' ?>
							<tr valign="top" class="form-invalid">
								<td><?php _e('Change User-Info, redirect to', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></td>
								<td>
									<?php $__wp_supercustom_cms_ui_redirect = __wp_supercustom_cms_get_option_value('__wp_supercustom_cms_ui_redirect'); ?>
									<select name="__wp_supercustom_cms_ui_redirect" <?php if ( isset($disabled_item) ) echo $disabled_item; ?>>
										<option value="0"<?php if ($__wp_supercustom_cms_ui_redirect == '0') { echo ' selected="selected"'; } ?>><?php _e('Default', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></option>
										<option value="1"<?php if ($__wp_supercustom_cms_ui_redirect == '1') { echo ' selected="selected"'; } ?>><?php _e('Frontpage of the Blog', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?>
									</select> <?php _e('When the &quot;User-Info-area&quot; change it, then it is possible to change the redirect.', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?>
								</td>
							</tr>
							<tr valign="top">
								<td><?php _e('Footer', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></td>
								<td>
									<?php $__wp_supercustom_cms_footer = __wp_supercustom_cms_get_option_value('__wp_supercustom_cms_footer'); ?>
									<select name="__wp_supercustom_cms_footer">
										<option value="0"<?php if ($__wp_supercustom_cms_footer == '0') { echo ' selected="selected"'; } ?>><?php _e('Default', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></option>
										<option value="1"<?php if ($__wp_supercustom_cms_footer == '1') { echo ' selected="selected"'; } ?>><?php _e('Hide', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></option>
									</select> <?php _e('The Footer-area can hide, include all links and details.', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?>
								</td>
							</tr>
							<tr valign="top">
								<td><?php _e('Header', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></td>
								<td>
									<?php $__wp_supercustom_cms_header = __wp_supercustom_cms_get_option_value('__wp_supercustom_cms_header'); ?>
									<select name="__wp_supercustom_cms_header">
										<option value="0"<?php if ($__wp_supercustom_cms_header == '0') { echo ' selected="selected"'; } ?>><?php _e('Default', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></option>
										<option value="1"<?php if ($__wp_supercustom_cms_header == '1') { echo ' selected="selected"'; } ?>><?php _e('Hide', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></option>
									</select> <?php _e('The Header-area can hide, include all links and details.', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?>
								</td>
							</tr>
							<tr valign="top">
								<td><?php _e('WriteScroll', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></td>
								<td>
									<?php $__wp_supercustom_cms_writescroll = __wp_supercustom_cms_get_option_value('__wp_supercustom_cms_writescroll'); ?>
									<select name="__wp_supercustom_cms_writescroll">
										<option value="0"<?php if ($__wp_supercustom_cms_writescroll == '0') { echo ' selected="selected"'; } ?>><?php _e('Default', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></option>
										<option value="1"<?php if ($__wp_supercustom_cms_writescroll == '1') { echo ' selected="selected"'; } ?>><?php _e('Activate', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></option>
									</select> <?php _e('With the WriteScroll option active, these pages will automatically scroll to an optimal position for editing, when you visit Write Post or Write Page.', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?>
								</td>
							</tr>
							<tr valign="top">
								<td><?php _e('Timestamp', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></td>
								<td>
									<?php $__wp_supercustom_cms_timestamp = __wp_supercustom_cms_get_option_value('__wp_supercustom_cms_timestamp'); ?>
									<select name="__wp_supercustom_cms_timestamp">
										<option value="0"<?php if ($__wp_supercustom_cms_timestamp == '0') { echo ' selected="selected"'; } ?>><?php _e('Default', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></option>
										<option value="1"<?php if ($__wp_supercustom_cms_timestamp == '1') { echo ' selected="selected"'; } ?>><?php _e('Activate', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></option>
									</select> <?php _e('Opens the post timestamp editing fields without you having to click the "Edit" link every time.', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?>
								</td>
							</tr>
							<tr valign="top">
								<td><?php _e('Thickbox FullScreen', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></td>
								<td>
									<?php $__wp_supercustom_cms_tb_window = __wp_supercustom_cms_get_option_value('__wp_supercustom_cms_tb_window'); ?>
									<select name="__wp_supercustom_cms_tb_window">
										<option value="0"<?php if ($__wp_supercustom_cms_tb_window == '0') { echo ' selected="selected"'; } ?>><?php _e('Default', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></option>
										<option value="1"<?php if ($__wp_supercustom_cms_tb_window == '1') { echo ' selected="selected"'; } ?>><?php _e('Activate', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></option>
									</select> <?php _e('All Thickbox-function use the full area of the browser. Thickbox is for example in upload media-files.', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?>
								</td>
							</tr>
							<tr valign="top">
								<td><?php _e('Flashuploader', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></td>
								<td>
									<?php $__wp_supercustom_cms_control_flashloader = __wp_supercustom_cms_get_option_value('__wp_supercustom_cms_control_flashloader'); ?>
									<select name="__wp_supercustom_cms_control_flashloader">
										<option value="0"<?php if ($__wp_supercustom_cms_control_flashloader == '0') { echo ' selected="selected"'; } ?>><?php _e('Default', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></option>
										<option value="1"<?php if ($__wp_supercustom_cms_control_flashloader == '1') { echo ' selected="selected"'; } ?>><?php _e('Activate', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></option>
									</select> <?php _e('Disable the flashuploader and users use only the standard uploader.', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?>
								</td>
							</tr>
							<tr valign="top">
								<td><?php _e('Category Height', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></td>
								<td>
									<?php $__wp_supercustom_cms_cat_full = __wp_supercustom_cms_get_option_value('__wp_supercustom_cms_cat_full'); ?>
									<select name="__wp_supercustom_cms_cat_full">
										<option value="0"<?php if ($__wp_supercustom_cms_cat_full == '0') { echo ' selected="selected"'; } ?>><?php _e('Default', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></option>
										<option value="1"<?php if ($__wp_supercustom_cms_cat_full == '1') { echo ' selected="selected"'; } ?>><?php _e('Activate', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></option>
									</select> <?php _e('View the Meta Box with Categories in the full height, no scrollbar or whitespace.', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?>
								</td>
							</tr>
							<tr valign="top">
								<td><?php _e('Advice in Footer', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></td>
								<td>
									<?php $__wp_supercustom_cms_advice = __wp_supercustom_cms_get_option_value('__wp_supercustom_cms_advice'); ?>
									<select name="__wp_supercustom_cms_advice">
										<option value="0"<?php if ($__wp_supercustom_cms_advice == '0') { echo ' selected="selected"'; } ?>><?php _e('Default', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></option>
										<option value="1"<?php if ($__wp_supercustom_cms_advice == '1') { echo ' selected="selected"'; } ?>><?php _e('Activate', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></option>
									</select>
									<textarea style="width: 85%;" class="code" rows="1" cols="60" name="__wp_supercustom_cms_advice_txt" id="__wp_supercustom_cms_advice_txt" ><?php echo htmlspecialchars(stripslashes(__wp_supercustom_cms_get_option_value('__wp_supercustom_cms_advice_txt'))); ?></textarea><br /><?php _e('In the Footer you can display an  advice for changing the Default-design, (x)HTML is possible.', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?>
								</td>
							</tr>
							<?php
							// when remove dashboard
							foreach ($user_roles as $role) {
								$disabled_menu_[$role] = __wp_supercustom_cms_get_option_value('wp_supercustom_cms_disabled_menu_'. $role .'_items');
								$disabled_submenu_[$role] = __wp_supercustom_cms_get_option_value('wp_supercustom_cms_disabled_submenu_'. $role .'_items');
							}

							$disabled_menu_all = array();
							foreach ($user_roles as $role) {
								array_push($disabled_menu_all, $disabled_menu_[$role]);
								array_push($disabled_menu_all, $disabled_submenu_[$role]);
							}

							if ( '' != $disabled_menu_all ) {
								if ( ! __wp_supercustom_cms_recursive_in_array('index.php', $disabled_menu_all) ) {
									$disabled_item2 = ' disabled="disabled"';
								}
								?>
								<tr valign="top" class="form-invalid">
									<td><?php _e('Dashboard deactivate, redirect to', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></td>
									<td>
										<?php $__wp_supercustom_cms_db_redirect = __wp_supercustom_cms_get_option_value('__wp_supercustom_cms_db_redirect'); ?>
										<select name="__wp_supercustom_cms_db_redirect"<?php if ( isset($disabled_item2) ) echo $disabled_item2; ?>>
											<option value="0"<?php if ($__wp_supercustom_cms_db_redirect == '0') { echo ' selected="selected"'; } ?>><?php _e('Default', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?> (profile.php)</option>
											<option value="1"<?php if ($__wp_supercustom_cms_db_redirect == '1') { echo ' selected="selected"'; } ?>><?php _e('Manage Posts', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?> (edit.php)</option>
											<option value="2"<?php if ($__wp_supercustom_cms_db_redirect == '2') { echo ' selected="selected"'; } ?>><?php _e('Manage Pages', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?> (edit-pages.php)</option>
											<option value="3"<?php if ($__wp_supercustom_cms_db_redirect == '3') { echo ' selected="selected"'; } ?>><?php _e('Write Post', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?> (post-new.php)</option>
											<option value="4"<?php if ($__wp_supercustom_cms_db_redirect == '4') { echo ' selected="selected"'; } ?>><?php _e('Write Page', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?> (page-new.php)</option>
											<option value="5"<?php if ($__wp_supercustom_cms_db_redirect == '5') { echo ' selected="selected"'; } ?>><?php _e('Comments', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?> (edit-comments.php)</option>
											<option value="6"<?php if ($__wp_supercustom_cms_db_redirect == '6') { echo ' selected="selected"'; } ?>><?php _e('other Page', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?></option>
										</select>
										<textarea style="width: 85%;" class="code" rows="1" cols="60" name="__wp_supercustom_cms_db_redirect_txt" id="__wp_supercustom_cms_db_redirect_txt" ><?php echo htmlspecialchars(stripslashes(__wp_supercustom_cms_get_option_value('__wp_supercustom_cms_db_redirect_txt'))); ?></textarea>
										<br /><?php _e('You have deactivated the Dashboard, please select a page for redirection or define custom url, include http://?', FB_SUPERCUSTOM_CMS_TEXTDOMAIN ); ?>
									</td>
								</tr>
								<?php
							}
							?>
						</tbody>
					</table>
					<p id="submitbutton">
						 
					</p>
					<p><a class="alignright button" href="javascript:void(0);" onclick="window.scrollTo(0,0);" style="margin:3px 0 0 30px;"><?php _e('scroll to top', FB_SUPERCUSTOM_CMS_TEXTDOMAIN); ?></a><br class="clear" /></p>

				</div>
			</div>
		</div>
		