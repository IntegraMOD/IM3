<?php
/**
*
* @package acm
* @version $Id$
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* Class for grabbing/handling cached entries, extends acm_file or acm_db depending on the setup
* @package acm
*/
class cache extends acm
{

	/**
	* Get Ultimate Points config values
	*/
	function obtain_points_config()
	{
		global $db;

		if (($points_config = $this->get('pointsconfig')) !== false)
		{
			$sql = 'SELECT config_name, config_value
				FROM ' . POINTS_CONFIG_TABLE;
			$result = $db->sql_query($sql);

			while ($row = $db->sql_fetchrow($result))
			{
				$points_config[$row['config_name']] = $row['config_value'];
			}
			$db->sql_freeresult($result);
		}
		else
		{
			$points_config = $cached_points_config = array();

			$sql = 'SELECT config_name, config_value
				FROM ' . POINTS_CONFIG_TABLE;
			$result = $db->sql_query($sql);

			while ($row = $db->sql_fetchrow($result))
			{
				$points_config[$row['config_name']] = $row['config_value'];
			}
			$db->sql_freeresult($result);

			$this->put('points_config', $cached_points_config);
		}

		return $points_config;
	}
	
	/**
	* Get Ultimate Points config values
	*/
	function obtain_points_values()
	{
		global $db;

		$sql_array = array(
			'SELECT'    => '*',
			'FROM'      => array(
				POINTS_VALUES_TABLE => 'v',
			),
		);
		$sql = $db->sql_build_query('SELECT', $sql_array);
		$result = $db->sql_query($sql);
		$points_values = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		return $points_values;
	}
	/**
	* Get config values
	*/
	function obtain_config()
	{
		global $db;

		if (($config = $this->get('config')) !== false)
		{
			$sql = 'SELECT config_name, config_value
				FROM ' . CONFIG_TABLE . '
				WHERE is_dynamic = 1';
			$result = $db->sql_query($sql);

			while ($row = $db->sql_fetchrow($result))
			{
				$config[$row['config_name']] = $row['config_value'];
			}
			$db->sql_freeresult($result);
		}
		else
		{
			$config = $cached_config = array();

			$sql = 'SELECT config_name, config_value, is_dynamic
				FROM ' . CONFIG_TABLE;
			$result = $db->sql_query($sql);

			while ($row = $db->sql_fetchrow($result))
			{
				if (!$row['is_dynamic'])
				{
					$cached_config[$row['config_name']] = $row['config_value'];
				}

				$config[$row['config_name']] = $row['config_value'];
			}
			$db->sql_freeresult($result);

			$this->put('config', $cached_config);
		}

		return $config;
	}


	function obtain_k_config()
	{
		global $db;

		if (($k_config = $this->get('k_config')) !== false)
		{
			$sql = 'SELECT config_name, config_value
				FROM ' . K_BLOCKS_CONFIG_VAR_TABLE . '
				WHERE is_dynamic = 1';
			$result = $db->sql_query($sql);

			while ($row = $db->sql_fetchrow($result))
			{
				$k_config[$row['config_name']] = $row['config_value'];
			}
			$db->sql_freeresult($result);
		}
		else
		{
			$k_config = $k_cached_config = array();

			$sql = 'SELECT config_name, config_value, is_dynamic
				FROM ' . K_BLOCKS_CONFIG_VAR_TABLE;
			$result = $db->sql_query($sql);

			while ($row = $db->sql_fetchrow($result))
			{
				if (!$row['is_dynamic'])
				{
					$k_cached_config[$row['config_name']] = $row['config_value'];
				}
				$k_config[$row['config_name']] = $row['config_value'];
			}
			$db->sql_freeresult($result);

			$this->put('k_config', $k_cached_config);
		}

		return $k_config;
	}

	function obtain_block_data()
	{
		global $db;

		if (($k_blocks = $this->get('k_blocks')) !== false)
		{
			$sql = 'SELECT *
				FROM ' . K_BLOCKS_TABLE . '
				WHERE active = 1 AND is_static = 0 ORDER BY ndx ASC';
			$result = $db->sql_query($sql);

			while ($row = $db->sql_fetchrow($result))
			{
				if (!$row['is_static'])
				{
					$k_blocks[$row['id']]['id']				= $row['id'];
					$k_blocks[$row['id']]['ndx']			= $row['ndx'];
					$k_blocks[$row['id']]['title']			= $row['title'];
					$k_blocks[$row['id']]['position']		= $row['position'];
					$k_blocks[$row['id']]['type']			= $row['type'];
					$k_blocks[$row['id']]['view_groups']		= $row['view_groups'];
					$k_blocks[$row['id']]['scroll']			= $row['scroll'];
					$k_blocks[$row['id']]['block_height']	= $row['block_height'];
					$k_blocks[$row['id']]['html_file_name']	= $row['html_file_name'];
					$k_blocks[$row['id']]['html_file_name']	= $row['html_file_name'];
					$k_blocks[$row['id']]['img_file_name']	= $row['img_file_name'];
					$k_blocks[$row['id']]['block_cache_time']	= $row['block_cache_time'];
				}
			}
			$db->sql_freeresult($result);
		}
		else
		{
			$k_blocks = $k_cached_blocks = array();

			$sql = 'SELECT *
				FROM ' . K_BLOCKS_TABLE . '
				WHERE active = 1 ORDER BY ndx ASC';
			$result = $db->sql_query($sql);

			while ($row = $db->sql_fetchrow($result))
			{
				if ($row['is_static'])
				{
					$k_cached_blocks[$row['id']]['id']				= $row['id'];
					$k_cached_blocks[$row['id']]['ndx']				= $row['ndx'];
					$k_cached_blocks[$row['id']]['title']			= $row['title'];
					$k_cached_blocks[$row['id']]['position']		= $row['position'];
					$k_cached_blocks[$row['id']]['active']			= $row['active'];
					$k_cached_blocks[$row['id']]['type']			= $row['type'];
					$k_cached_blocks[$row['id']]['view_groups']			= $row['view_groups'];
					$k_cached_blocks[$row['id']]['scroll']			= $row['scroll'];
					$k_cached_blocks[$row['id']]['block_height']	= $row['block_height'];
					$k_cached_blocks[$row['id']]['html_file_name']	= $row['html_file_name'];
					$k_cached_blocks[$row['id']]['img_file_name']	= $row['img_file_name'];
					$k_cached_blocks[$row['id']]['block_cache_time']	= $row['block_cache_time'];
				}
				$k_blocks[$row['id']]['id']				= $row['id'];
				$k_blocks[$row['id']]['ndx']			= $row['ndx'];
				$k_blocks[$row['id']]['title']			= $row['title'];
				$k_blocks[$row['id']]['position']		= $row['position'];
				$k_blocks[$row['id']]['type']			= $row['type'];
				$k_blocks[$row['id']]['view_groups']		= $row['view_groups'];
				$k_blocks[$row['id']]['scroll']			= $row['scroll'];
				$k_blocks[$row['id']]['block_height']	= $row['block_height'];
				$k_blocks[$row['id']]['html_file_name']	= $row['html_file_name'];
				$k_blocks[$row['id']]['html_file_name']	= $row['html_file_name'];
				$k_blocks[$row['id']]['img_file_name']	= $row['img_file_name'];
				$k_blocks[$row['id']]['block_cache_time']	= $row['block_cache_time'];
			}
			$db->sql_freeresult($result);

			$this->put('k_blocks', $k_cached_blocks);
		}

		return $k_blocks;
	}

	function obtain_k_pages()
	{
		global $db;

		if (($k_pages = $this->get('k_pages')) !== false)
		{
			$sql = 'SELECT page_id, page_name
				FROM ' . K_PAGES_TABLE;

			$result = $db->sql_query($sql);

			while ($row = $db->sql_fetchrow($result))
			{
				$k_pages[$row['page_id']]['page_id'] = $row['page_id'];
				$k_pages[$row['page_id']]['page_name'] = $row['page_name'];
			}
			$db->sql_freeresult($result);
		}
		else
		{
			$k_pages = $k_pages_cache = array();

			$sql = 'SELECT page_id, page_name
				FROM ' . K_PAGES_TABLE;

			$result = $db->sql_query($sql);

			while ($row = $db->sql_fetchrow($result))
			{
				$k_pages[$row['page_id']]['page_id'] = $row['page_id'];
				$k_pages[$row['page_id']]['page_name'] = $row['page_name'];
			}
			$db->sql_freeresult($result);

			$this->put('k_pages', $k_pages_cache);
		}
		return $k_pages;
	}


	//
	// get all group names/id's (used to avoid problems with group ID's changing)
	//
	function obtain_k_groups()
	{
		global $db;

		if (($k_groups = $this->get('k_groups')) !== false)
		{
			// Get us all the groups
			$sql = 'SELECT group_id, group_name
				FROM ' . GROUPS_TABLE . '
				ORDER BY group_id ASC, group_name';
			$result = $db->sql_query($sql);

			while ($row = $db->sql_fetchrow($result))
			{
				$k_groups[$row['group_id']]['group_id'] = $row['group_id'];
				$k_groups[$row['group_id']]['group_name'] = $row['group_name'];
			}
			$db->sql_freeresult($result);
		}
		else
		{
			$k_groups = $k_cached_groups = array();

			// Get us all the groups
			$sql = 'SELECT group_id, group_name
				FROM ' . GROUPS_TABLE . '
				ORDER BY group_id ASC, group_name';
			$result = $db->sql_query($sql);

			while ($row = $db->sql_fetchrow($result))
			{
				$k_cached_groups[$row['group_id']]['group_id'] = $row['group_id'];
				$k_cached_groups[$row['group_id']]['group_name'] = $row['group_name'];
			}
			$db->sql_freeresult($result);

			$this->put('k_groups', $k_cached_groups);
		}
		return $k_groups;
	}

	function obtain_k_resources()
	{
		global $db;

		if (($k_resources = $this->get('k_resources')) !== false)
		{
			$sql = 'SELECT *
				FROM ' . K_RESOURCES_TABLE  . '
				ORDER BY word ASC';
			$result = $db->sql_query($sql);

			while ($row = $db->sql_fetchrow($result))
			{
				/*
				$k_resources['id'] = $row['id'];
				$k_resources['word'] = $row['word'];
				$k_resources['type'] = $row['type'];
				*/
				$k_resources[] = $row['word'];

			}
			$db->sql_freeresult($result);
		}
		else
		{
			$k_resources = $k_cached_resources = array();

			$sql = 'SELECT *
				FROM ' . K_RESOURCES_TABLE  . '
				ORDER BY word ASC';
			$result = $db->sql_query($sql);

			while ($row = $db->sql_fetchrow($result))
			{
				/*
				$k_resources['id'] = $row['id'];
				$k_resources['word'] = $row['word'];
				$k_resources['type'] = $row['type'];
				*/
				$k_resources[] = $row['word'];
			}
			$db->sql_freeresult($result);

			$this->put('k_resources', $k_cached_resources);
		}
		return $k_resources;
	}
	/**
	* Obtain list of naughty words and build preg style replacement arrays for use by the
	* calling script
	*/
	function obtain_word_list()
	{
		global $db;

		if (($censors = $this->get('_word_censors')) === false)
		{
			$sql = 'SELECT word, replacement
				FROM ' . WORDS_TABLE;
			$result = $db->sql_query($sql);

			$censors = array();
			while ($row = $db->sql_fetchrow($result))
			{
				$censors['match'][] = get_censor_preg_expression($row['word']);
				$censors['replace'][] = $row['replacement'];
			}
			$db->sql_freeresult($result);

			$this->put('_word_censors', $censors);
		}

		return $censors;
	}

	/**
	* Obtain currently listed icons
	*/
	function obtain_icons()
	{
		if (($icons = $this->get('_icons')) === false)
		{
			global $db;

			// Topic icons
			$sql = 'SELECT *
				FROM ' . ICONS_TABLE . '
				ORDER BY icons_order';
			$result = $db->sql_query($sql);

			$icons = array();
			while ($row = $db->sql_fetchrow($result))
			{
				$icons[$row['icons_id']]['img'] = $row['icons_url'];
				$icons[$row['icons_id']]['width'] = (int) $row['icons_width'];
				$icons[$row['icons_id']]['height'] = (int) $row['icons_height'];
				$icons[$row['icons_id']]['display'] = (bool) $row['display_on_posting'];
				$icons[$row['icons_id']]['group'] = (bool) $row['icons_group'];
			}
			$db->sql_freeresult($result);

			$this->put('_icons', $icons);
		}

		return $icons;
	}

	/**
	* Obtain ranks
	*/
	function obtain_ranks()
	{
		if (($ranks = $this->get('_ranks')) === false)
		{
			global $db;

			$sql = 'SELECT *
				FROM ' . RANKS_TABLE . '
				ORDER BY rank_min DESC';
			$result = $db->sql_query($sql);

			$ranks = array();
			while ($row = $db->sql_fetchrow($result))
			{
				if ($row['rank_special'])
				{
					$ranks['special'][$row['rank_id']] = array(
						'rank_title'	=>	$row['rank_title'],
						'rank_image'	=>	$row['rank_image']
					);
				}
				else
				{
					$ranks['normal'][] = array(
						'rank_title'	=>	$row['rank_title'],
						'rank_min'		=>	$row['rank_min'],
						'rank_image'	=>	$row['rank_image']
					);
				}
			}
			$db->sql_freeresult($result);

			$this->put('_ranks', $ranks);
		}

		return $ranks;
	}

	/**
	* Obtain allowed extensions
	*
	* @param mixed $forum_id If false then check for private messaging, if int then check for forum id. If true, then only return extension informations.
	*
	* @return array allowed extensions array.
	*/
	function obtain_attach_extensions($forum_id)
	{
		if (($extensions = $this->get('_extensions')) === false)
		{
			global $db;

			$extensions = array(
				'_allowed_post'	=> array(),
				'_allowed_pm'	=> array(),
			);

			// The rule is to only allow those extensions defined. ;)
			$sql = 'SELECT e.extension, g.*
				FROM ' . EXTENSIONS_TABLE . ' e, ' . EXTENSION_GROUPS_TABLE . ' g
				WHERE e.group_id = g.group_id
					AND (g.allow_group = 1 OR g.allow_in_pm = 1)';
			$result = $db->sql_query($sql);

			while ($row = $db->sql_fetchrow($result))
			{
				$extension = strtolower(trim($row['extension']));

				$extensions[$extension] = array(
					'display_cat'	=> (int) $row['cat_id'],
					'download_mode'	=> (int) $row['download_mode'],
					'upload_icon'	=> trim($row['upload_icon']),
					'max_filesize'	=> (int) $row['max_filesize'],
					'allow_group'	=> $row['allow_group'],
					'allow_in_pm'	=> $row['allow_in_pm'],
				);

				$allowed_forums = ($row['allowed_forums']) ? unserialize(trim($row['allowed_forums'])) : array();

				// Store allowed extensions forum wise
				if ($row['allow_group'])
				{
					$extensions['_allowed_post'][$extension] = (!sizeof($allowed_forums)) ? 0 : $allowed_forums;
				}

				if ($row['allow_in_pm'])
				{
					$extensions['_allowed_pm'][$extension] = 0;
				}
			}
			$db->sql_freeresult($result);

			$this->put('_extensions', $extensions);
		}

		// Forum post
		if ($forum_id === false)
		{
			// We are checking for private messages, therefore we only need to get the pm extensions...
			$return = array('_allowed_' => array());

			foreach ($extensions['_allowed_pm'] as $extension => $check)
			{
				$return['_allowed_'][$extension] = 0;
				$return[$extension] = $extensions[$extension];
			}

			$extensions = $return;
		}
		else if ($forum_id === true)
		{
			return $extensions;
		}
		else
		{
			$forum_id = (int) $forum_id;
			$return = array('_allowed_' => array());

			foreach ($extensions['_allowed_post'] as $extension => $check)
			{
				// Check for allowed forums
				if (is_array($check))
				{
					$allowed = (!in_array($forum_id, $check)) ? false : true;
				}
				else
				{
					$allowed = true;
				}

				if ($allowed)
				{
					$return['_allowed_'][$extension] = 0;
					$return[$extension] = $extensions[$extension];
				}
			}

			$extensions = $return;
		}

		if (!isset($extensions['_allowed_']))
		{
			$extensions['_allowed_'] = array();
		}

		return $extensions;
	}

	/**
	* Obtain active bots
	*/
	function obtain_bots()
	{
		if (($bots = $this->get('_bots')) === false)
		{
			global $db;

			switch ($db->sql_layer)
			{
				case 'mssql':
				case 'mssql_odbc':
				case 'mssqlnative':
					$sql = 'SELECT user_id, bot_agent, bot_ip
						FROM ' . BOTS_TABLE . '
						WHERE bot_active = 1
					ORDER BY LEN(bot_agent) DESC';
				break;

				case 'firebird':
					$sql = 'SELECT user_id, bot_agent, bot_ip
						FROM ' . BOTS_TABLE . '
						WHERE bot_active = 1
					ORDER BY CHAR_LENGTH(bot_agent) DESC';
				break;

				// LENGTH supported by MySQL, IBM DB2 and Oracle for sure...
				default:
					$sql = 'SELECT user_id, bot_agent, bot_ip
						FROM ' . BOTS_TABLE . '
						WHERE bot_active = 1
					ORDER BY LENGTH(bot_agent) DESC';
				break;
			}
			$result = $db->sql_query($sql);

			$bots = array();
			while ($row = $db->sql_fetchrow($result))
			{
				$bots[] = $row;
			}
			$db->sql_freeresult($result);

			$this->put('_bots', $bots);
		}

		return $bots;
	}

	/**
	* Obtain cfg file data
	*/
	function obtain_cfg_items($theme)
	{
		global $config, $phpbb_root_path;

		$parsed_items = array(
			'theme'		=> array(),
			'template'	=> array(),
			'imageset'	=> array()
		);

		foreach ($parsed_items as $key => $parsed_array)
		{
			$parsed_array = $this->get('_cfg_' . $key . '_' . $theme[$key . '_path']);

			if ($parsed_array === false)
			{
				$parsed_array = array();
			}

			$reparse = false;
			$filename = $phpbb_root_path . 'styles/' . $theme[$key . '_path'] . '/' . $key . '/' . $key . '.cfg';

			if (!file_exists($filename))
			{
				continue;
			}

			if (!isset($parsed_array['filetime']) || (($config['load_tplcompile'] && @filemtime($filename) > $parsed_array['filetime'])))
			{
				$reparse = true;
			}

			// Re-parse cfg file
			if ($reparse)
			{
				$parsed_array = parse_cfg_file($filename);
				$parsed_array['filetime'] = @filemtime($filename);

				$this->put('_cfg_' . $key . '_' . $theme[$key . '_path'], $parsed_array);
			}
			$parsed_items[$key] = $parsed_array;
		}

		return $parsed_items;
	}

	/**
	* Obtain disallowed usernames
	*/
	function obtain_disallowed_usernames()
	{
		if (($usernames = $this->get('_disallowed_usernames')) === false)
		{
			global $db;

			$sql = 'SELECT disallow_username
				FROM ' . DISALLOW_TABLE;
			$result = $db->sql_query($sql);

			$usernames = array();
			while ($row = $db->sql_fetchrow($result))
			{
				$usernames[] = str_replace('%', '.*?', preg_quote(utf8_clean_string($row['disallow_username']), '#'));
			}
			$db->sql_freeresult($result);

			$this->put('_disallowed_usernames', $usernames);
		}

		return $usernames;
	}

	/**
	* Obtain hooks...
	*/
	function obtain_hooks()
	{
		global $phpbb_root_path, $phpEx;

		if (($hook_files = $this->get('_hooks')) === false)
		{
			$hook_files = array();

			// Now search for hooks...
			$dh = @opendir($phpbb_root_path . 'includes/hooks/');

			if ($dh)
			{
				while (($file = readdir($dh)) !== false)
				{
					if (strpos($file, 'hook_') === 0 && substr($file, -(strlen($phpEx) + 1)) === '.' . $phpEx)
					{
						$hook_files[] = substr($file, 0, -(strlen($phpEx) + 1));
					}
				}
				closedir($dh);
			}

			$this->put('_hooks', $hook_files);
		}

		return $hook_files;
	}
	/**
	* Obtain list of albums
	*/
	function obtain_album_list()
	{
		static $albums;

		if (isset($albums))
		{
			return $albums;
		}

		if (($albums = $this->get('_albums')) === false)
		{
			if (class_exists('phpbb_gallery_integration'))
			{
				$albums = phpbb_gallery_integration::cache();
				$this->put('_albums', $albums);
			}
		}

		return $albums;
	}
}

?>