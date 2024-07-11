<?php
/** 
*
* @author MarkDHamill (Mark D Hamill) mark@phpbbservices.com
* @version $Id digests_install.php 2.2.27 2016-02-19 00:00:00GMT MarkDHamill $
* @copyright (c) 2016 Mark D. Hamill
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
* This is the digest user interface for the Digests mod.
*/
			
/**
* @package ucp
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

class ucp_digests
{
	var $u_action;
					
	function main($id, $mode)
	{
		global $db, $user, $auth, $template;
		global $config, $phpbb_root_path, $phpEx;
					
		$s_hidden_fields = '';
		$submit = (isset($_POST['submit'])) ? true : false;
		
		// Attach the language file
		$user->add_lang('mods/ucp_digests');
							
		// Set up the page
		$this->tpl_name 	= 'ucp_digests';
		
		/* There are four modes for the Digest user interface. By chunking the user interface into relatively
		small screens it is not so intimidating. */
		switch ($mode)
		{
			case DIGEST_MODE_BASICS:
				$this->page_title 	= $user->lang['UCP_DIGESTS_BASICS'];
				break;
			case DIGEST_MODE_FORUMS_SELECTION:
				$this->page_title 	= $user->lang['UCP_DIGESTS_FORUMS_SELECTION'];
				break;
			case DIGEST_MODE_POST_FILTERS:
				$this->page_title 	= $user->lang['UCP_DIGESTS_POST_FILTERS'];
				break;
			case DIGEST_MODE_ADDITIONAL_CRITERIA:
				$this->page_title 	= $user->lang['UCP_DIGESTS_ADDITIONAL_CRITERIA'];
				break;
			default:
				trigger_error(sprintf($user->lang['UCP_DIGESTS_MODE_ERROR'], $mode));
				break;
		}
							 
		if ($submit)
		{
		
			// Verify the form key is unchanged
			if (!check_form_key('digests'))
			{
				trigger_error('FORM_INVALID');
			}
			
			// Handle the form processing by storing digest settings
			
			switch ($mode)
			{

				case DIGEST_MODE_BASICS:
				
					// Note: user_digest_send_hour_gmt is stored in UTC and translated to local time (as set in the profile). 
					// This is different than in phpBB 2, when all times were stored in server time.
					$local_send_hour = request_var('send_hour', (int) $user->data['user_digest_send_hour_gmt']) - ((int) $user->data['user_timezone'] + (int) $user->data['user_dst']);
					if ($local_send_hour >= 24)
					{
						$local_send_hour = $local_send_hour - 24;
					}
					else if ($local_send_hour < 0)
					{
						$local_send_hour = $local_send_hour + 24;
					}
					
					$sql_ary = array(
						'user_digest_type'				=> request_var('digest_type', $user->data['user_digest_type']),
						'user_digest_format'			=> request_var('style', $user->data['user_digest_format']),
						'user_digest_send_hour_gmt'		=> $local_send_hour,
					);
				
					// If a user chooses to unsubscribe, keep track of this so the admin cannot automatically resubscribe him or her
					// in the Administration Control Panel at some other date. That would be counterproductive.
					if (request_var('digest_type', $user->data['user_digest_type']) == DIGEST_NONE_VALUE)
					{
						$sql_ary['user_digest_has_unsubscribed'] = 1;
					}
					
				break;
					
				case DIGEST_MODE_FORUMS_SELECTION:
				
					$sql_ary = array(
						'user_digest_filter_type'		=> request_var('filtertype', $user->data['user_digest_filter_type']));
					
				break;

				case DIGEST_MODE_POST_FILTERS:
				
					$mark_read = (request_var('mark_read', '') == 'on') ? 1 : 0;
					$sql_ary = array(
						'user_digest_max_posts'			=> request_var('count_limit', 0),
						'user_digest_min_words'			=> request_var('min_word_size', 0),
						'user_digest_new_posts_only'	=> request_var('new_posts', (int) $user->data['user_digest_new_posts_only']),
						'user_digest_show_mine'			=> request_var('show_mine', (int) $user->data['user_digest_show_mine']),
						'user_digest_remove_foes'		=> request_var('filter_foes', (int) $user->data['user_digest_remove_foes']),
						'user_digest_show_pms'			=> request_var('pms', (int) $user->data['user_digest_show_pms']),
						'user_digest_pm_mark_read'		=> $mark_read);

				break;
					
				case DIGEST_MODE_ADDITIONAL_CRITERIA:
				
					$no_post_text = (request_var('no_post_text', '') == 'on') ? 1 : 0;
					$sql_ary = array(
						'user_digest_sortby'			=> request_var('sort_by', $user->data['user_digest_sortby']),
						'user_digest_max_display_words'	=> request_var('max_word_size', 0),
						'user_digest_no_post_text'		=> $no_post_text,
						'user_digest_send_on_no_posts'	=> request_var('send_on_no_posts', (int) $user->data['user_digest_send_on_no_posts']),
						'user_digest_reset_lastvisit'	=> request_var('lastvisit', (int) $user->data['user_digest_reset_lastvisit']),
						'user_digest_attachments'		=> request_var('attachments', (int) $user->data['user_digest_attachments']),
						'user_digest_block_images'		=> request_var('blockimages', (int) $user->data['user_digest_block_images']),
						'user_digest_toc'				=> request_var('toc', (int) $user->data['user_digest_toc']));
					
				break;
					
				default:
				
					trigger_error(sprintf($user->lang['UCP_DIGESTS_MODE_ERROR'], $mode));
					
				break;
					
			}
			
			// Update the user's digest settings
			$sql = 'UPDATE ' . USERS_TABLE . '
				SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
				WHERE user_id = ' . (int) $user->data['user_id'];
			$db->sql_query($sql);
			$result = $db->sql_query($sql);
			
			// If no subscription is desired, remove any individual forum subscriptions and save some disk space!
			if (($mode == DIGEST_MODE_BASICS) && (request_var('digest_type', DIGEST_DAILY_VALUE) == DIGEST_NONE_VALUE))
			{
				$sql = 'DELETE FROM ' . DIGESTS_SUBSCRIBED_FORUMS_TABLE . ' 
						WHERE user_id = ' . (int) $user->data['user_id'];
				$result = $db->sql_query($sql);
			}
			
			if ($mode == DIGEST_MODE_FORUMS_SELECTION)
			{
				// If there are any individual forum subscriptions, remove the old ones and create the new ones
				$sql = 'DELETE FROM ' . DIGESTS_SUBSCRIBED_FORUMS_TABLE . ' 
						WHERE user_id = ' . (int) $user->data['user_id'];
				$result = $db->sql_query($sql);

				// Note that if "all_forums" is unchecked and bookmarks is unchecked, there are individual forum subscriptions, so they must be saved.
				$all_forums = request_var('all_forums', $user->data['user_digest_filter_type']);
				$digest_type = request_var('digest_type', $user->data['user_digest_type']);
				if (($all_forums !== 'on') && (trim((string) $digest_type) !== DIGEST_BOOKMARKS)) 
				{
					foreach ($_POST as $key => $value) 
					{
						if (str_starts_with(htmlspecialchars($key), 'elt_')) 
						{
							$forum_id = intval(substr(htmlspecialchars($key), 4, strpos($key, '_', 4) - 4));

							$sql_ary = array(
								'user_id'		=> (int) $user->data['user_id'],
								'forum_id'		=> $forum_id);
							$sql = 'INSERT INTO ' . DIGESTS_SUBSCRIBED_FORUMS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);

							$result = $db->sql_query($sql);
						}
					}
				}
			}
					
			// Generate confirmation page. It will redirect back to the calling page
			meta_refresh(3, $this->u_action);
			$message = $user->lang['DIGEST_UPDATED'] . '<br /><br />' . sprintf($user->lang['RETURN_UCP'], '<a href="' . $this->u_action . '">', '</a>');
			trigger_error($message);
		}
		
		else
		
		{
		
			// GET processing logic
			add_form_key('digests');

			// Don't show submit or reset buttons if there is no digest subscription
			$show_buttons = ($user->data['user_digest_type'] == DIGEST_NONE_VALUE) ? false : true;
			if ($mode == DIGEST_MODE_BASICS)
			{
				$show_buttons = true; // Buttons must appear in basics mode otherwise there is no way to resubscribe
			}

			// These template variables are used on all the pages
			$template->assign_vars(array(
				'DISABLED_MESSAGE' 		=> ($user->data['user_digest_type'] == DIGEST_NONE_VALUE) ? '<p><em>' . $user->lang['DIGEST_DISABLED_MESSAGE'] . '</em></p>' : '',
				'S_CONTROL_DISABLED' 	=> ($user->data['user_digest_type'] == DIGEST_NONE_VALUE),
				'S_DIGEST_HOME'			=> $config['digests_digests_title'],
				'S_DIGEST_PAGE_URL'		=> $config['digests_page_url'],
				'S_SHOW_BUTTONS'		=> $show_buttons,
				'U_ACTION'  			=> $this->u_action,
				)
			);

			switch ($mode)
			{
			
				case DIGEST_MODE_BASICS:
					
					if ($user->data['user_digest_type'] == DIGEST_NONE_VALUE)
					{
						if ($config['digests_user_digest_send_hour_gmt'] == -1)
						{
							// Pick a random hour, since this is a new digest and the administrator requested this to even out digest server processing
							$local_send_hour = random_int(0,23);
						}
						else
						{
							$local_send_hour = $config['digests_user_digest_send_hour_gmt'];
						}
					}
					else
					{
						// Transform user_digest_send_hour_gmt to local time
						$local_send_hour = (int) $user->data['user_digest_send_hour_gmt'] + ((int) $user->data['user_timezone'] + (int) $user->data['user_dst']);
					}
					
					// Adjust time if outside of hour range
					if ($local_send_hour >= 24)
					{
						$local_send_hour = $local_send_hour - 24;
					}
					else if ($local_send_hour < 0)
					{
						$local_send_hour = $local_send_hour + 24;
					}
					
					// Set other form fields using board defaults if necessary, otherwise pull from the user's settings
					// Note, setting an administator configured default for digest type is a bad idea because
					// the user might think they have a digest subscription when they do not.
					
					if ($user->data['user_digest_type'] == DIGEST_NONE_VALUE)
					{
						$styling_html = ($config['digests_user_digest_format'] == DIGEST_HTML_VALUE);
						$styling_html_classic = ($config['digests_user_digest_format'] == DIGEST_HTML_CLASSIC_VALUE);
						$styling_plain = ($config['digests_user_digest_format'] == DIGEST_PLAIN_VALUE);
						$styling_plain_classic = ($config['digests_user_digest_format'] == DIGEST_PLAIN_CLASSIC_VALUE);
						$styling_text = ($config['digests_user_digest_format'] == DIGEST_TEXT_VALUE);
					}
					else
					{
						$styling_html = ($user->data['user_digest_format'] == DIGEST_HTML_VALUE);
						$styling_html_classic = ($user->data['user_digest_format'] == DIGEST_HTML_CLASSIC_VALUE);
						$styling_plain = ($user->data['user_digest_format'] == DIGEST_PLAIN_VALUE);
						$styling_plain_classic = ($user->data['user_digest_format'] == DIGEST_PLAIN_CLASSIC_VALUE);
						$styling_text = ($user->data['user_digest_format'] == DIGEST_TEXT_VALUE);
					}
					
					$template->assign_vars(array(
						'DIGEST_TITLE'						=> $user->lang['UCP_DIGESTS_BASICS'],
						'L_DIGEST_FREQUENCY_EXPLAIN'		=> sprintf($user->lang['DIGEST_FREQUENCY_EXPLAIN'], $user->lang['DIGEST_WEEKDAY'][$config['digests_weekly_digest_day']]),
						'L_DIGEST_HTML_CLASSIC_VALUE'		=> DIGEST_HTML_CLASSIC_VALUE,
						'L_DIGEST_HTML_VALUE'				=> DIGEST_HTML_VALUE,
						'L_DIGEST_PLAIN_CLASSIC_VALUE'		=> DIGEST_PLAIN_CLASSIC_VALUE,
						'L_DIGEST_PLAIN_VALUE'				=> DIGEST_PLAIN_VALUE,
						'L_DIGEST_TEXT_VALUE'				=> DIGEST_TEXT_VALUE,
						'S_BASICS'							=> true,
						'S_DIGEST_DAY_CHECKED' 				=> ($user->data['user_digest_type'] == DIGEST_DAILY_VALUE),
						'S_DIGEST_HTML_CHECKED' 			=> $styling_html,
						'S_DIGEST_HTML_CLASSIC_CHECKED' 	=> $styling_html_classic,
						'S_DIGEST_MONTH_CHECKED' 			=> ($user->data['user_digest_type'] == DIGEST_MONTHLY_VALUE),
						'S_DIGEST_NONE_CHECKED' 			=> ($user->data['user_digest_type'] == DIGEST_NONE_VALUE),
						'S_DIGEST_PLAIN_CHECKED' 			=> $styling_plain,
						'S_DIGEST_PLAIN_CLASSIC_CHECKED' 	=> $styling_plain_classic,
						'S_DIGEST_TEXT_CHECKED' 			=> $styling_text,
						'S_DIGEST_WEEK_CHECKED' 			=> ($user->data['user_digest_type'] == DIGEST_WEEKLY_VALUE),
						)
					);
					
					// Populated the Hour Sent select control
					for($i=0;$i<24;$i++)
					{
						$template->assign_block_vars('hour_loop',array(
							'COUNT' 						=>	$i,
							'SELECTED'						=>	($local_send_hour == $i) ? ' selected="selected"' : '',
							'DISPLAY_HOUR'					=>	make_hour_string($i, $user->data['user_dateformat']),
						));
					}
		
				break;
					
				case DIGEST_MODE_FORUMS_SELECTION:
				
					// Create a list of required and excluded forum_ids
					$required_forum_ids = isset($config['digests_include_forums']) ? explode(',',(string) $config['digests_include_forums']) : array();
					$excluded_forum_ids = isset($config['digests_exclude_forums']) ? explode(',',(string) $config['digests_exclude_forums']) : array();

					// Individual forum checkboxes should be disabled if bookmarks are requested/expected
					if ((($user->data['user_digest_type'] == DIGEST_NONE_VALUE) && ($config['digests_user_digest_filter_type'] == DIGEST_BOOKMARKS)) ||
						(($user->data['user_digest_type'] != DIGEST_NONE_VALUE) && ($user->data['user_digest_filter_type'] == DIGEST_BOOKMARKS)))
					{
						$disabled = true;
					}
					else
					{
						$disabled = false;
					}

					// Get current subscribed forums for this user, if any. If none, all allowed forums are assumed
					$rowset = array();
					$sql = 'SELECT forum_id 
							FROM ' . DIGESTS_SUBSCRIBED_FORUMS_TABLE . ' 
							WHERE user_id = ' . (int) $user->data['user_id'];
					$result = $db->sql_query($sql);
					$rowset = $db->sql_fetchrowset($result);
					$db->sql_freeresult();

					$all_by_default = ((sizeof($rowset) == 0) && $config['digests_user_check_all_forums']) ? true : false;

					$forum_read_ary = array();
					$allowed_forums = array();
					
					$forum_read_ary = $auth->acl_getf('f_read');
					
					// Get a list of parent_ids for each forum and put them in an array.
					$parent_array = array();
					$sql = 'SELECT forum_id, parent_id 
						FROM ' . FORUMS_TABLE . '
						ORDER BY 1';
					$result = $db->sql_query($sql);
					while ($row = $db->sql_fetchrow($result))
					{
						$parent_array[$row['forum_id']] = $row['parent_id'];
					}
					$db->sql_freeresult();

					foreach ($forum_read_ary as $forum_id => $allowed)
					{
						if ($allowed['f_read'])
						{
							// Since this user has read access to this forum, add it to the $allowed_forums array
							$allowed_forums[] = (int) $forum_id;
							
							// Also add to $allowed_forums the parents, if any, of this forum. Actually we have to find the parent's parents, etc., going up as far as necesary because 
							// $auth->act_getf does not return the parents for which the user has access, yet parents must be shown are on the interface
							$there_are_parents = true;
							$this_forum_id = (int) $forum_id;
							
							while ($there_are_parents)
							{
								if ($parent_array[$this_forum_id] == 0)
								{
									$there_are_parents = false;
								}
								else
								{
									// Do not add this parent to the list of allowed forums if it is already in the array
									if (!in_array((int) $parent_array[$this_forum_id], $allowed_forums))
									{
										$allowed_forums[] = (int) $parent_array[$this_forum_id];
									} 
									$this_forum_id = (int) $parent_array[$this_forum_id];	// Keep looping...
								}
							}
						}
					}
							
					// Get a list of forums as they appear on the main index for this user. For presentation purposes indent them so they show the natural phpBB3 hierarchy.
					// Indenting is cleverly handled by nesting <div> tags inside of other <div> tags, and the template defines the relative offset (20 pixels).
					
					$template->assign_vars(array(
						'DIGEST_TITLE'			=> $user->lang['UCP_DIGESTS_FORUMS_SELECTION'],
						'S_FORUMS_SELECTION'		=> true,
						)
					);

					if (sizeof($allowed_forums) > 0)
					
					{
					
						// Set a flag in case no forums should be checked
						$uncheck = ($user->data['user_digest_type'] == DIGEST_NONE_VALUE) && ($config['digests_user_check_all_forums'] == 0);
					
						$sql = 'SELECT forum_name, forum_id, parent_id, forum_type
								FROM ' . FORUMS_TABLE . ' 
								WHERE ' . $db->sql_in_set('forum_id', $allowed_forums) . ' AND forum_type <> ' . FORUM_LINK . "
								AND forum_password = ''
								ORDER BY left_id ASC";
						$result = $db->sql_query($sql);
						
						$template->assign_block_vars('show_forums', array());
						
						$current_level = 0;			// How deeply nested are we at the moment
						$parent_stack = array();	// Holds a stack showing the current parent_id of the forum
						$parent_stack[] = 0;		// 0, the first value in the stack, represents the <div_0> element, a container holding all the categories and forums in the template
						
						while ($row = $db->sql_fetchrow($result))
						{
						
							if ((int) $row['parent_id'] != (int) end($parent_stack) || (end($parent_stack) == 0))
							{
								if (in_array($row['parent_id'],$parent_stack))
								{
									// If parent is in the stack, then pop the stack until the parent is found, otherwise push stack adding the current parent. This creates a </div>
									while ((int) $row['parent_id'] != (int) end($parent_stack))
									{
										array_pop($parent_stack);
										$current_level--;
										// Need to close a category level here
										$template->assign_block_vars('forums', array( 
											'S_DIV_CLOSE' 	=> true,
											'S_DIV_OPEN' 	=> false,
											'S_PRINT' 		=> false,
											)
										);
									}
								}
								else
								{
									// If the parent is not in the stack, then push the parent_id on the stack. This is also a trigger to indent the block. This creates a <div>
									array_push($parent_stack, (int) $row['parent_id']);
									$current_level++;
									// Need to add a category level here
									$template->assign_block_vars('forums', array( 
										'CAT_ID' 			=> 'div_' . $row['parent_id'],
										'S_DIV_CLOSE' 		=> false,
										'S_DIV_OPEN' 		=> true,
										'S_PRINT' 			=> false
										)
									);
								}
							}
							
							// This section contains logic to handle forums that are either required or excluded by the Administrator
							
							// Is the forum either required or excluded from digests?
							$required_forum = (in_array((int) $row['forum_id'], $required_forum_ids)) ? true : false;
							$excluded_forum = (in_array((int) $row['forum_id'], $excluded_forum_ids)) ? true : false;
							$forum_disabled = $required_forum || $excluded_forum;
							
							// Markup to visually show required or excluded forums
							if ($required_forum)
							{
								$prefix = '<strong>';
								$suffix = '</strong>';
							}
							else
							{
								if ($excluded_forum)
								{
									$prefix = '<span style="text-decoration:line-through">';
									$suffix = '</span>';
								}
								else
								{
									$prefix = '';
									$suffix = '';
								}
							}
							
							// This code prints the forum or category, which will exist inside the previously created <div> block
							
							// Check this forum's checkbox? Only if they have forum subscriptions
							if (!$all_by_default)
							{
								$check = false;
								foreach($rowset as $this_row)
								{
									if ($this_row['forum_id'] == $row['forum_id'])
									{
										$check = true;
										break;
									}
								}
							}
							else
							{
								$check = true;
							}
							
							// Let's make the check logic more complicated. If "All Forums" is unchecked and there is no digest subscription
							// then we must make sure every forum is also unchecked. Also need to uncheck if bookmarks are turned on
							if ($check || $all_by_default)
							{
								$check = true;
							}

							// Make sure required forums are checked
							if ($required_forum)
							{
								$check = true;
							}
							
							// Make sure excluded forums are unchecked
							if ($excluded_forum)
							{
								$check = false;
							}
								
							$template->assign_block_vars('forums', array( 
								'FORUM_LABEL' 			=> $row['forum_name'],
								'FORUM_NAME' 			=> 'elt_' . (int) $row['forum_id'] . '_' . (int) $row['parent_id'],
								'FORUM_PREFIX' 			=> $prefix,
								'FORUM_SUFFIX' 			=> $suffix,
								'S_FORUM_DISABLED' 		=> ($disabled || $forum_disabled || $user->data['user_digest_type'] == DIGEST_NONE_VALUE),
								'S_FORUM_SUBSCRIBED' 	=> ($check),
								'S_IS_FORUM' 			=> !($row['forum_type'] == FORUM_CAT),
								'S_PRINT' 				=> true,
								)
							);
							
						}
					
						$db->sql_freeresult($result);
						
						// Now out of the loop, it is important to remember to close any open <div> tags. Typically there is at least one.
						while ((int) $row['parent_id'] != (int) is_null(end($parent_stack)))
						{
							array_pop($parent_stack);
							$current_level--;
							// Need to close the <div> tag
							$template->assign_block_vars('forums', array( 
								'S_DIV_CLOSE' 	=> true,
								'S_DIV_OPEN' 	=> false,
								'S_PRINT' 		=> false,
								)
							);
						}
						
						$template->assign_vars(array(
							'DIGEST_NO_FORUMS_CHECKED'	=> $user->lang['DIGEST_NO_FORUMS_CHECKED'],
							'S_ALL_BY_DEFAULT'			=> $all_by_default,
							'S_ALL_DISABLED'			=> ($disabled || $user->data['user_digest_type'] == DIGEST_NONE_VALUE),
							'S_DIGEST_POST_ANY'			=> ($user->data['user_digest_filter_type'] == DIGEST_ALL),
							'S_DIGEST_POST_BM'			=> ($user->data['user_digest_filter_type'] == DIGEST_BOOKMARKS),
							'S_DIGEST_POST_FIRST'		=> ($user->data['user_digest_filter_type'] == DIGEST_FIRST),
							'S_NO_FORUMS' 				=> false, 
							)
						);
					}
						
					else
						
					{
						// No forums to show!
						$template->assign_vars(array(
							'L_NO_FORUMS_MESSAGE' 	=> $user->lang['DIGEST_NO_FORUMS_AVAILABLE'],
							'S_NO_FORUMS' 			=> true, 
							)
						);
					}				
				
				break;
					
				case DIGEST_MODE_POST_FILTERS:

					if ($config['digests_max_items'] > 0)
					{
						$max_posts = min((int) $user->data['user_digest_max_posts'], $config['digests_max_items']);
					}
					else
					{
						$max_posts = (int) $user->data['user_digest_max_posts'];
					}
					$template->assign_vars(array(
						'DIGEST_TITLE'								=> $user->lang['UCP_DIGESTS_POST_FILTERS'],
						'L_DIGEST_COUNT_LIMIT_EXPLAIN'				=> sprintf($user->lang['DIGEST_SIZE_ERROR'],$config['digests_max_items']),
						'LA_DIGEST_SIZE_ERROR'						=> sprintf($user->lang['DIGEST_SIZE_ERROR'],$config['digests_max_items']),
						'S_DIGEST_FILTER_FOES_CHECKED_NO' 			=> ($user->data['user_digest_remove_foes'] == 0),
						'S_DIGEST_FILTER_FOES_CHECKED_YES' 			=> ($user->data['user_digest_remove_foes'] == 1),
						'S_DIGEST_MARK_READ_CHECKED' 				=> ($user->data['user_digest_pm_mark_read'] == 1),
						'S_DIGEST_MAX_ITEMS' 						=> $max_posts,
						'S_DIGEST_MIN_SIZE' 						=> ($user->data['user_digest_min_words'] == 0) ? '' : (int) $user->data['user_digest_min_words'],
						'S_DIGEST_NEW_POSTS_ONLY_CHECKED_NO' 		=> ($user->data['user_digest_new_posts_only'] == 0),
						'S_DIGEST_NEW_POSTS_ONLY_CHECKED_YES' 		=> ($user->data['user_digest_new_posts_only'] == 1),
						'S_DIGEST_PRIVATE_MESSAGES_IN_DIGEST_NO' 	=> ($user->data['user_digest_show_pms'] == 0),
						'S_DIGEST_PRIVATE_MESSAGES_IN_DIGEST_YES' 	=> ($user->data['user_digest_show_pms'] == 1),
						'S_DIGEST_REMOVE_YOURS_CHECKED_NO' 			=> ($user->data['user_digest_show_mine'] == 1),
						'S_DIGEST_REMOVE_YOURS_CHECKED_YES' 		=> ($user->data['user_digest_show_mine'] == 0),
						'S_POST_FILTERS'							=> true,
						)
					);
					
				break;
					
				case DIGEST_MODE_ADDITIONAL_CRITERIA:
					$template->assign_vars(array(
						'DIGEST_MAX_SIZE' 						=> ($user->data['user_digest_max_display_words'] == 0) ? '' : (int) $user->data['user_digest_max_display_words'],
						'DIGEST_TITLE'							=> $user->lang['UCP_DIGESTS_ADDITIONAL_CRITERIA'],
						'S_ADDITIONAL_CRITERIA'					=> true,
						'S_ATTACHMENTS_NO_CHECKED' 				=> ($user->data['user_digest_attachments'] == 0),
						'S_ATTACHMENTS_YES_CHECKED' 			=> ($user->data['user_digest_attachments'] == 1),
						'S_BLOCK_IMAGES' 						=> ($config['digests_block_images'] == 1),
						'S_BLOCK_IMAGES_NO_CHECKED' 			=> ($user->data['user_digest_block_images'] == 0),
						'S_BLOCK_IMAGES_YES_CHECKED' 			=> ($user->data['user_digest_block_images'] == 1),
						'S_BOARD_SELECTED' 						=> ($user->data['user_digest_sortby'] == DIGEST_SORTBY_BOARD),
						'S_DIGEST_NO_POST_TEXT_CHECKED'			=> ($user->data['user_digest_no_post_text'] == 1),
						'S_DIGEST_SEND_ON_NO_POSTS_NO_CHECKED' 	=> ($user->data['user_digest_send_on_no_posts'] == 0),
						'S_DIGEST_SEND_ON_NO_POSTS_YES_CHECKED' => ($user->data['user_digest_send_on_no_posts'] == 1),
						'S_LASTVISIT_NO_CHECKED' 				=> ($user->data['user_digest_reset_lastvisit'] == 0),
						'S_LASTVISIT_YES_CHECKED' 				=> ($user->data['user_digest_reset_lastvisit'] == 1),
						'S_POSTDATE_DESC_SELECTED' 				=> ($user->data['user_digest_sortby'] == DIGEST_SORTBY_POSTDATE_DESC),
						'S_POSTDATE_SELECTED' 					=> ($user->data['user_digest_sortby'] == DIGEST_SORTBY_POSTDATE),
						'S_STANDARD_DESC_SELECTED' 				=> ($user->data['user_digest_sortby'] == DIGEST_SORTBY_STANDARD_DESC),
						'S_STANDARD_SELECTED' 					=> ($user->data['user_digest_sortby'] == DIGEST_SORTBY_STANDARD),
						'S_TOC_NO_CHECKED' 						=> ($user->data['user_digest_toc'] == 0),
						'S_TOC_YES_CHECKED' 					=> ($user->data['user_digest_toc'] == 1),
						)
					);
					
				break;
					
				default:
					trigger_error(sprintf($user->lang['UCP_DIGESTS_MODE_ERROR'], $mode));
				break;
					
			}
			
		}
	}
}
