<?php
/**
*
* Static Pages MOD acp module info file
*
* @version $Id$
* @copyright (c) 2009 Vojtěch Vondra
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

class acp_pages_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_pages',
			'title'		=> 'ACP_PAGES',
			'version'	=> '1.0.5',
			'modes'		=> array(
				'pages'		=> array('title' => 'ACP_MANAGE_PAGES', 'auth' => '', 'cat' => array('ACP_IMOD_CONFIG')),
			),
		);
	}

	function install()
	{
		$this->update_schema();
	}

	function update($u_action)
	{
		global $cache, $user;

		$this->update_schema();

		$cache->destroy('sql', PAGES_TABLE);
		trigger_error(sprintf($user->lang['STATIC_PAGES_MOD_UPDATED'], '1.0.5') . adm_back_link($u_action));
	}

	function uninstall()
	{
	}

	/**
	* Add SEO columns and settings without assuming a fresh install.
	*/
	function update_schema()
	{
		global $db, $cache, $config, $phpbb_root_path, $phpEx;

		if (!class_exists('phpbb_db_tools'))
		{
			include($phpbb_root_path . 'includes/db/db_tools.' . $phpEx);
		}

		$db_tools = new phpbb_db_tools($db);
		$columns = array(
			'page_show_title'	=> array('BOOL', 1),
			'page_seo_title'	=> array('VCHAR_UNI:70', ''),
			'page_og_image'		=> array('VCHAR_UNI', ''),
			// TIMESTAMP, not UINT: UINT maps to mediumint(8) which overflows on a unix timestamp
			'page_updated'		=> array('TIMESTAMP', 0),
			'page_html'			=> array('BOOL', 0),
		);

		foreach ($columns as $column_name => $column_data)
		{
			if (!$db_tools->sql_column_exists(PAGES_TABLE, $column_name))
			{
				$db_tools->sql_column_add(PAGES_TABLE, $column_name, $column_data);
			}
		}

		// Widen a column created by the earlier UINT definition, which overflowed.
		// page_id also lost its auto increment on this install, so every new page inserted 0.
		switch ($db->sql_layer)
		{
			case 'mysql':
			case 'mysql4':
			case 'mysqli':
				$db->sql_query('ALTER TABLE ' . PAGES_TABLE . ' MODIFY page_updated INT(11) UNSIGNED NOT NULL DEFAULT 0');

				// A failed insert can leave page_id 0, which blocks adding auto increment
				$sql = 'UPDATE ' . PAGES_TABLE . '
					SET page_id = (SELECT next_id FROM (SELECT MAX(page_id) + 1 AS next_id FROM ' . PAGES_TABLE . ') AS ids)
					WHERE page_id = 0';
				$db->sql_query($sql);
				$db->sql_query('ALTER TABLE ' . PAGES_TABLE . ' MODIFY page_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT');
			break;
		}

		$sql = 'UPDATE ' . PAGES_TABLE . '
			SET page_updated = ' . (int) time() . '
			WHERE page_updated = 0';
		$db->sql_query($sql);

		if (!isset($config['static_pages_seo_urls']))
		{
			set_config('static_pages_seo_urls', '0');
		}

		if (!isset($config['static_pages_og_image']))
		{
			set_config('static_pages_og_image', '');
		}

		set_config('static_pages_version', '1.0.5');
		$cache->destroy('sql', PAGES_TABLE);
	}
}