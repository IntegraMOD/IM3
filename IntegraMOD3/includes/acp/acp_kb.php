<?php
/** 
*
* @author Tobi Schaefer http://www.tas2580.de/
*
* @package Knowledge_Base
* @version $Id$
* @copyright (c) 2007 SEO phpBB http://www.phpbb-seo.de
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @package acp
*/


class acp_kb
{
	var $u_action;

	function get_cat_info($id)
	{
		global $db, $kb_config;
		$sql = 'SELECT *
			FROM ' . KB_CATEGORIE_TABLE . '
			WHERE cat_id = ' . (int) $id;
		$result = $db->sql_query($sql, $kb_config['cache_time']);
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
		return $row;
	}

	function move_cat($id)
	{
		global $db;

		$moving = $this->get_cat_info($id);
		$move = request_var('move', '', true);
		$sql = 'SELECT cat_id, left_id, right_id
			FROM ' . KB_CATEGORIE_TABLE . "
			WHERE parent_id = {$moving['parent_id']}
				AND " . (($move == 'up') ? "right_id < {$moving['right_id']} ORDER BY right_id DESC" : "left_id > {$moving['left_id']} ORDER BY left_id ASC");
		$result = $db->sql_query_limit($sql, 1);
		$target = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$target = $row;
		}
		$db->sql_freeresult($result);

		if (!sizeof($target))
		{
			// The categorie is already on top or bottom
			return false;
		}

		if ($move == 'up')
		{
			$left_id = $target['left_id'];
			$right_id = $moving['right_id'];

			$diff_up = $moving['left_id'] - $target['left_id'];
			$diff_down = $moving['right_id'] + 1 - $moving['left_id'];

			$move_up_left = $moving['left_id'];
			$move_up_right = $moving['right_id'];
		}
		else
		{
			$left_id = $moving['left_id'];
			$right_id = $target['right_id'];

			$diff_up = $moving['right_id'] + 1 - $moving['left_id'];
			$diff_down = $target['right_id'] - $moving['right_id'];

			$move_up_left = $moving['right_id'] + 1;
			$move_up_right = $target['right_id'];
		}

		// Now do the dirty job
		$sql = 'UPDATE ' . KB_CATEGORIE_TABLE . "
			SET left_id = left_id + CASE
				WHEN left_id BETWEEN {$move_up_left} AND {$move_up_right} THEN -{$diff_up}
				ELSE {$diff_down}
			END,
			right_id = right_id + CASE
				WHEN right_id BETWEEN {$move_up_left} AND {$move_up_right} THEN -{$diff_up}
				ELSE {$diff_down}
			END,
			cat_parents = ''
			WHERE
				left_id BETWEEN {$left_id} AND {$right_id}
				AND right_id BETWEEN {$left_id} AND {$right_id}";
		$db->sql_query($sql);
	}

	function delete_cat($id)
	{
		global $db, $user;
		$sql = 'SELECT cat_id
			FROM ' . KB_CATEGORIE_TABLE . '
			WHERE parent_id = ' . (int) $id;
		$result = $db->sql_query($sql);
		if ($db->sql_affectedrows($result) != 0)
		{
			trigger_error($user->lang['CAT_NOT_EMPTY'] . adm_back_link($this->u_action));
		}

		$sql = 'SELECT article_id
			FROM ' . KB_ARTICLE_TABLE . '
			WHERE cat_id = ' . (int) $id;
		$result = $db->sql_query($sql);
		if ($db->sql_affectedrows($result) != 0)
		{
			trigger_error($user->lang['CAT_NOT_EMPTY'] . adm_back_link($this->u_action));
		}

		if (confirm_box(true))
		{
			$cat_data = $this->get_cat_info($id);
			$sql = 'UPDATE ' . KB_CATEGORIE_TABLE . "
				SET left_id = left_id - 2
				WHERE left_id > " . (int) $cat_data['left_id'];
			$db->sql_query($sql);
			//right_id
			$sql = 'UPDATE ' . KB_CATEGORIE_TABLE . "
				SET right_id = right_id - 2
				WHERE right_id > " . (int) $cat_data['left_id'];
			$db->sql_query($sql);

			$sql = 'DELETE FROM ' . KB_CATEGORIE_TABLE . '
				WHERE cat_id  = ' . (int) $id;
			$db->sql_query($sql);


			$sql = 'DELETE FROM ' . ACL_GROUPS_TABLE . '
				WHERE forum_id = ' . (int) $id . '
				AND is_kb = 1';
			$db->sql_query($sql);

			$sql = 'DELETE FROM ' . ACL_USERS_TABLE . '
				WHERE forum_id = ' . (int) $id . '
				AND is_kb = 1';
			$db->sql_query($sql);

			return true;
		}
		else
		{
			confirm_box(false, $user->lang['CAT_REALY_DELETE'], build_hidden_fields(array(
				'id'		=> $id,
				'parent_id'	=> request_var('parent_id', 0),
				'action'	=> 'delete',
			)));
		}
	}


	function main($id, $mode)
	{
		global $cache, $phpbb_root_path, $db, $user, $template, $phpEx, $kb_config;

		include($phpbb_root_path . 'includes/functions_kb.' . $phpEx);
		$user->add_lang('mods/kb');
		$action = (!isset($_GET['action'])) ? '' : $_GET['action'];
		$id = request_var('id', 0);
		$parent_id = request_var('parent_id', 0);
		$form_action = $this->u_action . '&amp;action=add';

		switch ($mode)
		{
			case 'main':
				$this->tpl_name = 'acp_kb_categories';
				$this->page_title = $user->lang['KBASE'];
	
				switch ($action)
				{
					// Make SQL array
					case 'add':
					case 'update':
						$description = utf8_normalize_nfc(request_var('description', '', true));
						$title	= utf8_normalize_nfc(request_var('title', '', true));
						$cat_mode = request_var('cat_mode', 0);
						$parent_id = request_var('parent_id', 0);
						$ads = utf8_normalize_nfc(request_var('ads', ''));
						if (empty($title))
						{
							trigger_error($user->lang['NEED_NAME'] . adm_back_link($this->u_action), E_USER_WARNING);
						}
						$uid = $bitfield = $options = 0;
						generate_text_for_storage($description, $uid, $bitfield, $options, request_var('desc_parse_bbcode', false), request_var('desc_parse_urls', false), request_var('desc_parse_smilies', false));

						$sql_ary = array(
							'cat_mode'			=> $cat_mode,
							'cat_title'			=> $title,
							'ads'				=> $ads,
							'description'		=> $description,
							'bbcode_uid'		=> $uid,
							'bbcode_bitfield'	=> $bitfield,
							'bbcode_options'	=> $options,
							'display_on_index'	=> request_var('display_on_index', 0),
							'image'				=> request_var('image', ''),
							'show_edits'		=> request_var('show_edits', 0),
							'parent_id'			=> $parent_id,
							'post_forum'		=> request_var('post_forum', 0),
						);
					break;

					// Edit categorie
					case 'edit':
						$sql = 'SELECT *
							FROM ' . KB_CATEGORIE_TABLE . '
							WHERE cat_id = ' . (int) $id;
						$result = $db->sql_query($sql);
						$row = $db->sql_fetchrow($result);
						$desc_data = generate_text_for_edit($row['description'], $row['bbcode_uid'], $row['bbcode_options']);
						$template->assign_vars(array(
							'POST_ADS'					=> $row['ads'],
							'CAT_MODE'					=> $row['cat_mode'],
							'POST_SELECT'				=> '<option value="0">' . $user->lang['IN_INDEX'] . '</option>' . make_cat_select($row['parent_id'], 2, $id),
							'U_ACTION'					=> $this->u_action. '&amp;action=update&amp;id=' . $id,
							'S_SHOW_FORM'				=> true, 
							'POST_DESCRIPTION'			=> $desc_data['text'],
							'S_DESC_BBCODE_CHECKED'		=> ($desc_data['allow_bbcode']) ? true : false,
							'S_DESC_SMILIES_CHECKED'	=> ($desc_data['allow_smilies']) ? true : false,
							'S_DESC_URLS_CHECKED'		=> ($desc_data['allow_urls']) ? true : false,
							'POST_IMAGE'				=> $row['image'],
							'S_NEW_CATEGORIE'			=> false,
							'S_SUB_CATEGORIE'			=> ($row['cat_mode'] == 1) ? true : false,
							'POST_POST_FORUM'			=> $row['post_forum'],
							'POST_NAME'					=> $row['cat_title'],
							'SHOW_EDITS'				=> ($row['show_edits'] == '1') ? true : false,
							'DISPLAY_ON_INDEX'			=> ($row['display_on_index'] == '1') ? true : false,
						));
					break;

					// Add a categorie
					case 'new_cat':
						$sql = 'SELECT cat_mode
							FROM ' . KB_CATEGORIE_TABLE . '
							WHERE cat_id = ' . (int) $parent_id;
						$result = $db->sql_query($sql);
						$row = $db->sql_fetchrow($result);
						$template->assign_vars(array(
							'MAIN_ID'			=> $parent_id,
							'S_SUB_CATEGORIE'	=> true,
							'S_NEW_CATEGORIE'	=> true,
							'CAT_MODE'			=> ($row['cat_mode'] == 0 AND $parent_id != 0) ? 1 : 0,
							'POST_SELECT'		=> '<option value="0">' . $user->lang['IN_INDEX'] . '</option>' . make_cat_select($parent_id, 2),
							'U_ACTION'			=> $this->u_action . '&amp;action=add',
							'S_SHOW_FORM'		=> true,
							'SHOW_EDITS0'		=> ' checked="checked"',
							'DISPLAY_ON_INDEX0'	=> ' checked="checked"',
							'POST_NAME'			=> request_var('title', '', true),
						));
					break;
				}

				switch ($action)
				{
					// Add categorie
					case 'add':

						if ($parent_id = request_var('parent_id', 0))
						{
							$sql = 'SELECT left_id, right_id
								FROM ' . KB_CATEGORIE_TABLE . '
								WHERE cat_id = ' . (int) $parent_id;
							$result = $db->sql_query($sql);
							$row = $db->sql_fetchrow($result);
							$db->sql_freeresult($result);
							$sql = 'UPDATE ' . KB_CATEGORIE_TABLE . '
								SET left_id = left_id + 2, right_id = right_id + 2
								WHERE left_id > ' . $row['right_id'];
							$db->sql_query($sql);
							$sql = 'UPDATE ' . KB_CATEGORIE_TABLE . '
								SET right_id = right_id + 2
								WHERE ' . $row['left_id'] . ' BETWEEN left_id AND right_id';
							$db->sql_query($sql);
							$left_id = $row['right_id'];
							$right_id = $row['right_id'] + 1;
						}
						else
						{
							$sql = 'SELECT MAX(right_id) AS right_id
								FROM ' . KB_CATEGORIE_TABLE;
							$result = $db->sql_query($sql);
							$row = $db->sql_fetchrow($result);
							$db->sql_freeresult($result);
							$left_id = $row['right_id'] + 1;
							$right_id = $row['right_id'] + 2;
						}

						$sql_ary2 = array(
							'left_id'		=> $left_id,
							'right_id'		=> $right_id,
						);

						$sql_ary = array_merge ($sql_ary, $sql_ary2);
						$db->sql_query('INSERT INTO ' . KB_CATEGORIE_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary));
						$cache->destroy('sql', KB_CATEGORIE_TABLE);
						trigger_error($user->lang['CAT_ADDED'] . adm_back_link($this->u_action . '&amp;parent_id=' . request_var('parent_id', 0)));
					break;


					// Update Subcat
					case 'update':
						$row = $this->get_cat_info($id);
						if ($row['parent_id'] != request_var('parent_id', 0))
						{
							$moving_ids = ($row['right_id'] - $row['left_id']) + 1;
							$sql = 'SELECT MAX(right_id) AS right_id
								FROM ' . KB_CATEGORIE_TABLE;
							$result = $db->sql_query($sql);
							$highest = $db->sql_fetchrow($result);
							$db->sql_freeresult($result);
							$moving_distance = ($highest['right_id'] - $row['left_id']) + 1;
							$stop_updating = $moving_distance + $row['left_id'];
				
							$sql = 'UPDATE ' . KB_CATEGORIE_TABLE . '
								SET right_id = right_id + ' . $moving_distance . ',
									left_id = left_id + ' . $moving_distance . '
								WHERE left_id >= ' . $row['left_id'] . '
									AND right_id <= ' . $row['right_id'];
							$db->sql_query($sql);
							$new['left_id'] = $row['left_id'] + $moving_distance;
							$new['right_id'] = $row['right_id'] + $moving_distance;
				
							//close the gap, we got
							if (request_var('parent_id', 0) == 0)
							{//we move to root
								//left_id
								$sql = 'UPDATE ' . KB_CATEGORIE_TABLE . '
									SET left_id = left_id - ' . $moving_ids . '
									WHERE left_id >= ' . $row['left_id'];
								$db->sql_query($sql);
								//right_id
								$sql = 'UPDATE ' . KB_CATEGORIE_TABLE . '
									SET right_id = right_id - ' . $moving_ids . '
									WHERE right_id >= ' . $row['left_id'];
								$db->sql_query($sql);
							}
							else
							{
								//close the gap
								//left_id
								$sql = 'UPDATE ' . KB_CATEGORIE_TABLE . '
									SET left_id = left_id - ' . $moving_ids . '
									WHERE left_id >= ' . $row['left_id'] . '
										AND right_id <= ' . $stop_updating;
								$db->sql_query($sql);
								//right_id
								$sql = 'UPDATE ' . KB_CATEGORIE_TABLE . '
									SET right_id = right_id - ' . $moving_ids . '
									WHERE right_id >= ' . $row['left_id'] . '
										AND right_id <= ' . $stop_updating;
								$db->sql_query($sql);
				
								//create new gap
								//need parent_information
								$parent = $this->get_cat_info(request_var('parent_id', 0));
								//left_id
								$sql = 'UPDATE ' . KB_CATEGORIE_TABLE . '
									SET left_id = left_id + ' . $moving_ids . '
									WHERE left_id >= ' . $parent['right_id'] . '
										AND right_id <= ' . $stop_updating;
								$db->sql_query($sql);
								//right_id
								$sql = 'UPDATE ' . KB_CATEGORIE_TABLE . '
									SET right_id = right_id + ' . $moving_ids . '
									WHERE right_id >= ' . $parent['right_id'] . '
										AND right_id <= ' . $stop_updating;
								$db->sql_query($sql);
				
								//close the gap again
								//new parent right_id!!!
								$parent['right_id'] = $parent['right_id'] + $moving_ids;
								$move_back = ($new['right_id'] - $parent['right_id']) + 1;
								$sql = 'UPDATE ' . KB_CATEGORIE_TABLE . '
									SET left_id = left_id - ' . $move_back . ',
										right_id = right_id - ' . $move_back . '
									WHERE left_id >= ' . $stop_updating;
								$db->sql_query($sql);
							}
						}

						$db->sql_query('UPDATE ' . KB_CATEGORIE_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . ' WHERE cat_id = ' . $id);
						$cache->destroy('sql', KB_CATEGORIE_TABLE); 
						trigger_error($user->lang['CAT_UPDATED'] . adm_back_link($this->u_action . '&amp;parent_id=' . request_var('parent_id', 0)));
					break;

					// Delete Subcat
					case 'delete':
						if ($this->delete_cat($id))
						{
							$db->sql_query('UPDATE ' . KB_ARTICLE_TABLE . ' SET activ = "0" WHERE cat_id = ' . $id);
							$cache->destroy('sql', KB_CATEGORIE_TABLE); 
							trigger_error($user->lang['CAT_DELETED'] . adm_back_link($this->u_action . '&amp;parent_id=' . request_var('parent_id', 0)));
						}
					break;

					// Move
					case 'move':
						$this->move_cat($id);
						$cache->destroy('sql', KB_CATEGORIE_TABLE); 
					break;
				}

				// List all categories in the System
				if (!$parent_id)
				{
					$navigation = $user->lang['KBASE'];
				}
				else
				{
					$navigation = '<a href="' . $this->u_action . '">' . $user->lang['KBASE'] . '</a>';
		
					$categorie_nav = get_categorie_branch($parent_id, 'parents', 'descending');
					foreach ($categorie_nav as $row)
					{
						if ($row['cat_id'] == $parent_id)
						{
							$navigation .= ' -&gt; ' . $row['cat_title'];
						}
						else
						{
							$navigation .= ' -&gt; <a href="' . $this->u_action . '&amp;parent_id=' . $row['cat_id'] . '">' . $row['cat_title'] . '</a>';
						}
					}
				}

				$sql = 'SELECT cat_id, cat_title, cat_mode, description, image, left_id, right_id
					FROM ' . KB_CATEGORIE_TABLE . '
					WHERE parent_id = ' . (int) $parent_id . '
					ORDER BY left_id ASC';
				$result = $db->sql_query($sql, $kb_config['cache_time']);
				while ($row = $db->sql_fetchrow($result))
				{
					$folder_image = ($row['left_id'] + 1 != $row['right_id']) ? '<img src="images/icon_subfolder.gif" alt="' . $user->lang['SUBFORUM'] . '" />' : '<img src="images/icon_folder.gif" alt="' . $user->lang['FOLDER'] . '" />';
					$template->assign_block_vars('in_system', array(
						'U_EDIT'		=> $this->u_action . '&amp;parent_id=' . $parent_id . '&amp;action=edit&amp;id=' . $row['cat_id'],
						'U_DELETE'		=> $this->u_action . '&amp;parent_id=' . $parent_id . '&amp;action=delete&amp;id=' . $row['cat_id'],
						'U_MOVE_UP'		=> $this->u_action . '&amp;action=move&amp;move=up&amp;parent_id=' . $parent_id . '&amp;id=' . $row['cat_id'],
						'U_MOVE_DOWN'	=> $this->u_action . '&amp;action=move&amp;move=down&amp;parent_id=' . $parent_id . '&amp;id=' . $row['cat_id'],
						'U_CATEGORIE'	=> $this->u_action . '&amp;parent_id=' . $row['cat_id'],
						'S_MAIN_CAT'	=> ($row['cat_mode'] == 0) ? true : false,
						'NAME'			=> $row['cat_title'],
						'DESCRIPTION'	=> $row['description'],
						'FOLDER_IMAGE'	=> $folder_image,
						'IMAGE'			=> $row['image'],
					));
				}
				$db->sql_freeresult($result);

				$template->assign_vars(array(
					'S_FORM_ACTION'		=> $this->u_action . '&amp;parent_id=' . $parent_id . '&amp;action=new_cat',
					'NAVIGATION'		=> $navigation,
				));

			break;
			

			// Config
			case 'config':
				$submit = (isset($_POST['submit'])) ? true: false;
				$this->tpl_name = 'acp_kb_config';
				$this->page_title = $user->lang['KBASE'];

				if($submit == true)
				{
					$sql = "SELECT *
						FROM " . KB_CONFIG_TABLE;
					$result = $db->sql_query($sql);
					while($row = $db->sql_fetchrow($result))
					{
						$config_name = $row['config_name'];
						$config_value = ($row['config_type'] == 1) ? request_var($config_name, '', true) : request_var($config_name, 0);
						$sql = 'UPDATE ' . KB_CONFIG_TABLE . " SET
							config_value = '$config_value'
							WHERE config_name = '$config_name'";
						$db->sql_query($sql);
					}
					$cache->destroy('sql', KB_CONFIG_TABLE);
					trigger_error($user->lang['CONFIG_UPDATED'] . adm_back_link($this->u_action));
				}

				$sql = 'SELECT config_name, config_value
					FROM ' . KB_CONFIG_TABLE;
				$result = $db->sql_query($sql, $kb_config['cache_time']);
				while($row = $db->sql_fetchrow($result))
				{
					$kb_config[$row['config_name']] = $row['config_value'];
				}

				$index_topics = '';
				for($i = 1; $i <= 20; $i++)
				{
					$index_topics .= ($i == $kb_config['index_topics']) ? '<option selected="selected" value="' . $kb_config['index_topics'] . '">' . $kb_config['index_topics'] . '</option>' : '<option value="' . $i . '">' . $i . '</option>';
				}

				$sort_order = ($kb_config['sort_order'] == 'titel') ?  '<option value="titel" selected="selected">' . $user->lang['ARTICLE_TITLE'] . '</option>' :  '<option value="titel">' . $user->lang['ARTICLE_TITLE'] . '</option>';
				$sort_order .= ($kb_config['sort_order'] == 'user_id') ?  '<option value="user_id" selected="selected">' . $user->lang['USERNAME'] . '</option>' :  '<option value="user_id">' . $user->lang['USERNAME'] . '</option>';
				$sort_order .= ($kb_config['sort_order'] == 'type_id') ?  '<option value="type_id" selected="selected">' . $user->lang['TYPE'] . '</option>' :  '<option value="type_id">' . $user->lang['TYPE'] . '</option>';
				$sort_order .= ($kb_config['sort_order'] == 'post_time') ?  '<option value="post_time" selected="selected">' . $user->lang['ARTICLE_POSTET'] . '</option>' :  '<option value="post_time">' . $user->lang['ARTICLE_POSTET'] . '</option>';
				$sort_order .= ($kb_config['sort_order'] == 'hits') ?  '<option value="hits" selected="selected">' . $user->lang['VIEWED'] . '</option>' :  '<option value="hits">' . $user->lang['VIEWED'] . '</option>';
				$sort_order .= ($kb_config['sort_order'] == 'ratig') ?  '<option value="ratig" selected="selected">' . $user->lang['RATING'] . '</option>' :  '<option value="ratig">' . $user->lang['RATING'] . '</option>';


				$kb_config['index_topics'] = $index_topics;
				$kb_config['sort_order'] = $sort_order;

				// Send to template
				foreach($kb_config as $config_key => $config_value)
				{
   					 $array[strtoupper($config_key)] = $config_value;
				}
   				$array['U_ACTION'] = $this->u_action;
				$template->assign_vars($array);

			break;


			// Typs
			case 'types':
				$submit = (isset($_POST['submit'])) ? true: false;
				$this->tpl_name = 'acp_kb_types';
				$this->page_title = $user->lang['KBASE'];

				switch ($action)
				{
					// Add Type
					case 'add':
						$name	= utf8_normalize_nfc(request_var('name', '', true));
						if (empty($name))
						{
							trigger_error($user->lang['NEED_NAME'] . adm_back_link($this->u_action), E_USER_WARNING);
						}
						$sql_ary = array(
							'name'	=> $name,
						);
						$db->sql_query('INSERT INTO ' . KB_TYPES_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary));
						$cache->destroy('sql', KB_TYPES_TABLE);
						trigger_error($user->lang['TYPE_ADDED'] . adm_back_link($this->u_action));
					break;

					// Edit Types
					case 'edit':
						$form_action = $this->u_action . '&amp;action=update&amp;id=' . $id;
						$sql = 'SELECT name
							FROM ' . KB_TYPES_TABLE . '
							WHERE type_id = ' . (int) $id;
						$result = $db->sql_query($sql);
						$row = $db->sql_fetchrow($result);
						$template->assign_vars(array(
							'POST_TYPE_NAME' => $row['name'])
						);
					break;

					// Delete Types
					case 'delete':
						if (confirm_box(true))
						{
							$sql = 'DELETE FROM ' . KB_TYPES_TABLE . '
								WHERE type_id  = ' . (int) $id;
							$db->sql_query($sql);
							$db->sql_query('UPDATE ' . KB_ARTICLE_TABLE . ' SET type_id = "0" WHERE type_id = ' . $id);
							$cache->destroy('sql', KB_TYPES_TABLE);
							trigger_error($user->lang['DELETED'] . adm_back_link($this->u_action));
						}
						else
						{
							confirm_box(false, $user->lang['REALY_DELETE'], build_hidden_fields(array(
								'id'		=> $id,
								'action'	=> 'delete',
							)));
						}
					break;

					// Update Types
					case 'update':
						$name = utf8_normalize_nfc(request_var('name', '', true));
						if (empty($name))
						{
							trigger_error($user->lang['NEED_NAME'] . adm_back_link($this->u_action), E_USER_WARNING);
						}
						$sql_ary = array(
							'name'	=> $name,
						);
						$db->sql_query('UPDATE ' . KB_TYPES_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . ' WHERE type_id = ' . $id);
						$cache->destroy('sql', KB_TYPES_TABLE);
						trigger_error($user->lang['TYPE_UPDATED'] . adm_back_link($this->u_action));
					break;
				}

				// List Types in the System
				$sql = 'SELECT type_id, name
					FROM ' . KB_TYPES_TABLE;
				$result = $db->sql_query($sql, $kb_config['cache_time']);
				while ($row = $db->sql_fetchrow($result))
				{
					$template->assign_block_vars('types', array(
						'U_TYPEEDIT'	=> $this->u_action . '&amp;action=edit&amp;id=' . $row['type_id'],
						'U_TYPEDEL'		=> $this->u_action . '&amp;action=delete&amp;id=' . $row['type_id'],
						'NAME'			=> $row['name'])
					);
				}
				$db->sql_freeresult($result);

				$template->assign_vars(array(
					'U_ACTION'	=> $form_action )
				);
			break;
		}
	}
}

?>