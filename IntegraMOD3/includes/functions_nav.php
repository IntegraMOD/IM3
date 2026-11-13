<?php
/**
*
* Primary navigation links: portal, forum, and extra pages.
*
* @package IntegraMOD
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
* Create the nav tables and default order settings on existing boards.
*/
function im3_nav_ensure_schema()
{
	global $db, $config, $phpbb_root_path, $phpEx;

	static $done = false;

	if ($done || !defined('NAV_LINKS_TABLE') || !empty($config['nav_links_ready']))
	{
		return;
	}

	$done = true;

	if (!class_exists('phpbb_db_tools'))
	{
		include($phpbb_root_path . 'includes/db/db_tools.' . $phpEx);
	}

	$db_tools = new phpbb_db_tools($db);

	if (!$db_tools->sql_table_exists(NAV_LINKS_TABLE))
	{
		$db_tools->sql_create_table(NAV_LINKS_TABLE, array(
			'COLUMNS'		=> array(
				'nav_id'		=> array('UINT', null, 'auto_increment'),
				'nav_order'		=> array('UINT', 0),
				'nav_active'	=> array('BOOL', 1),
				'nav_url'		=> array('VCHAR', ''),
				'nav_page_id'	=> array('UINT', 0),
				'nav_title'		=> array('VCHAR_UNI', ''),
			),
			'PRIMARY_KEY'	=> 'nav_id',
		));
	}

	if (!$db_tools->sql_table_exists(NAV_LINK_LANG_TABLE))
	{
		$db_tools->sql_create_table(NAV_LINK_LANG_TABLE, array(
			'COLUMNS'		=> array(
				'nav_id'		=> array('UINT', 0),
				'lang_iso'		=> array('VCHAR:30', ''),
				'nav_title'		=> array('VCHAR_UNI', ''),
			),
			'PRIMARY_KEY'	=> array('nav_id', 'lang_iso'),
		));
	}

	if (!isset($config['portal_nav_order']))
	{
		set_config('portal_nav_order', '1');
	}

	if (!isset($config['portal_nav_active']))
	{
		set_config('portal_nav_active', '1');
	}

	if (!isset($config['forum_nav_order']))
	{
		set_config('forum_nav_order', '2');
	}

	if (!isset($config['forum_nav_active']))
	{
		set_config('forum_nav_active', '1');
	}

	set_config('nav_links_ready', '1');
}

/**
* Extra page links and their per-language titles.
*/
function im3_nav_load_extra()
{
	global $db, $cache;

	im3_nav_ensure_schema();

	if (isset($cache) && is_object($cache))
	{
		$cached = $cache->get('_im3_nav_links');

		if ($cached !== false && is_array($cached))
		{
			return $cached;
		}
	}

	$links = array();
	$sql = 'SELECT nav_id, nav_order, nav_active, nav_url, nav_page_id, nav_title
		FROM ' . NAV_LINKS_TABLE . '
		ORDER BY nav_order ASC, nav_id ASC';
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		$row['langs'] = array();
		$row['page_title'] = '';
		$row['page_url'] = '';
		$links[(int) $row['nav_id']] = $row;
	}
	$db->sql_freeresult($result);

	if (!sizeof($links))
	{
		if (isset($cache) && is_object($cache))
		{
			$cache->put('_im3_nav_links', $links);
		}

		return $links;
	}

	$sql = 'SELECT nav_id, lang_iso, nav_title
		FROM ' . NAV_LINK_LANG_TABLE . '
		WHERE ' . $db->sql_in_set('nav_id', array_keys($links));
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		$links[(int) $row['nav_id']]['langs'][$row['lang_iso']] = $row['nav_title'];
	}
	$db->sql_freeresult($result);

	$page_ids = array();
	foreach ($links as $link)
	{
		if ((int) $link['nav_page_id'] > 0)
		{
			$page_ids[] = (int) $link['nav_page_id'];
		}
	}

	if (sizeof($page_ids) && defined('PAGES_TABLE'))
	{
		$sql = 'SELECT page_id, page_title, page_url
			FROM ' . PAGES_TABLE . '
			WHERE ' . $db->sql_in_set('page_id', $page_ids);
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			foreach ($links as $nav_id => $link)
			{
				if ((int) $link['nav_page_id'] === (int) $row['page_id'])
				{
					$links[$nav_id]['page_title'] = $row['page_title'];
					$links[$nav_id]['page_url'] = $row['page_url'];
				}
			}
		}
		$db->sql_freeresult($result);
	}

	if (isset($cache) && is_object($cache))
	{
		$cache->put('_im3_nav_links', $links);
	}

	return $links;
}

/**
* True when the numbers are exactly 1..N with no gaps or duplicates.
*/
function im3_nav_orders_valid($orders)
{
	$seen = array();

	foreach ($orders as $order)
	{
		$order = (int) $order;

		if ($order < 1 || isset($seen[$order]))
		{
			return false;
		}

		$seen[$order] = true;
	}

	$total = sizeof($seen);

	if ($total < 1)
	{
		return false;
	}

	for ($i = 1; $i <= $total; $i++)
	{
		if (!isset($seen[$i]))
		{
			return false;
		}
	}

	return true;
}

/**
* Order numbers posted for links that are not marked for deletion.
*/
function im3_nav_posted_orders($cfg_array)
{
	$orders = array();

	if (isset($cfg_array['portal_nav_order']))
	{
		$orders[] = (int) $cfg_array['portal_nav_order'];
	}

	if (isset($cfg_array['forum_nav_order']))
	{
		$orders[] = (int) $cfg_array['forum_nav_order'];
	}

	foreach ($cfg_array as $key => $value)
	{
		if (!preg_match('/^navlink_([0-9]+)_order$/', $key, $match))
		{
			continue;
		}

		if (!empty($cfg_array['navlink_' . $match[1] . '_delete']))
		{
			continue;
		}

		$orders[] = (int) $value;
	}

	return $orders;
}

/**
* Board-relative public path for a Pages MOD page.
*/
function im3_nav_page_path($page_id, $title = '', $page_url = '')
{
	global $db, $phpbb_root_path, $phpEx;

	$page_id = (int) $page_id;

	if ($page_id < 1)
	{
		return '';
	}

	if (($title === '' && $page_url === '') && defined('PAGES_TABLE'))
	{
		$sql = 'SELECT page_title, page_url
			FROM ' . PAGES_TABLE . '
			WHERE page_id = ' . $page_id;
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		if ($row)
		{
			$title = $row['page_title'];
			$page_url = $row['page_url'];
		}
	}

	if (!function_exists('static_page_url'))
	{
		include_once($phpbb_root_path . 'includes/functions_pages.' . $phpEx);
	}

	$absolute = static_page_url($page_id, $title, $page_url);
	$board = rtrim(generate_board_url(), '/');

	if (strpos($absolute, $board) === 0)
	{
		return ltrim(substr($absolute, strlen($board)), '/');
	}

	return $absolute;
}

/**
* Value shown in the ACP URL field.
*/
function im3_nav_display_url($link)
{
	if ((int) $link['nav_page_id'] > 0)
	{
		$path = im3_nav_page_path((int) $link['nav_page_id'], $link['page_title'], $link['page_url']);

		if ($path !== '')
		{
			return $path;
		}
	}

	return $link['nav_url'];
}

/**
* Public href for one stored link.
*/
function im3_nav_public_url($link)
{
	global $phpbb_root_path, $phpEx;

	if ((int) $link['nav_page_id'] > 0)
	{
		if (!function_exists('static_page_url'))
		{
			include_once($phpbb_root_path . 'includes/functions_pages.' . $phpEx);
		}

		return static_page_url((int) $link['nav_page_id'], $link['page_title'], $link['page_url']);
	}

	$url = trim($link['nav_url']);

	if ($url === '')
	{
		return '';
	}

	if (preg_match('#^[a-z][a-z0-9+.-]*://#i', $url))
	{
		return $url;
	}

	$url = ltrim($url, '/');

	if (strpos($url, '?') !== false)
	{
		list($script, $query) = explode('?', $url, 2);

		return append_sid($phpbb_root_path . $script, $query);
	}

	return append_sid($phpbb_root_path . $url);
}

/**
* Whether the current request is this extra link.
*/
function im3_nav_link_active($link)
{
	global $user, $phpEx;

	$page_id = (int) $link['nav_page_id'];

	if ($page_id > 0)
	{
		$route = (isset($GLOBALS['im3_seo_route']) && is_array($GLOBALS['im3_seo_route'])) ? $GLOBALS['im3_seo_route'] : array();

		if (!empty($route['type']) && $route['type'] === 'page' && isset($route['id']) && (int) $route['id'] === $page_id)
		{
			return true;
		}

		if (!empty($route['type']) && $route['type'] === 'page-name' && $link['page_url'] !== '' && isset($route['slug']) && strtolower($route['slug']) === strtolower($link['page_url']))
		{
			return true;
		}

		return ($user->page['page_name'] === 'page.' . $phpEx && request_var('id', 0) === $page_id);
	}

	$url = trim($link['nav_url']);

	if ($url === '')
	{
		return false;
	}

	$path = parse_url($url, PHP_URL_PATH);
	$base = basename(($path) ? $path : $url);

	return ($base !== '' && $base === $user->page['page_name']);
}

/**
* Label for an extra link in the visitor's language.
*/
function im3_nav_extra_label($link, $user_lang)
{
	if (!empty($link['langs'][$user_lang]))
	{
		return $link['langs'][$user_lang];
	}

	if ($link['nav_title'] !== '')
	{
		return $link['nav_title'];
	}

	return $link['page_title'];
}

/**
* Assign the ordered primary menu. Inactive links and a disabled portal are omitted.
*/
function im3_nav_assign()
{
	global $template, $config, $user, $phpbb_root_path, $phpEx;

	im3_nav_ensure_schema();

	$user_lang = $user->data['user_lang'];
	$portal_label = (!empty($config['portal_name_' . $user_lang])) ? $config['portal_name_' . $user_lang] : ((isset($config['portal_name']) && $config['portal_name'] !== 'Portal') ? $config['portal_name'] : $user->lang['PORTAL']);
	$forum_label = (!empty($config['forum_name_' . $user_lang])) ? $config['forum_name_' . $user_lang] : ((isset($config['forum_name']) && $config['forum_name'] !== 'Forum') ? $config['forum_name'] : $user->lang['FORUM']);
	$items = array();

	if (!isset($config['portal_nav_active']) || $config['portal_nav_active'])
	{
		if (!empty($config['portal_enabled']))
		{
			$items[] = array(
				'order'		=> isset($config['portal_nav_order']) ? (int) $config['portal_nav_order'] : 1,
				'tie'		=> 0,
				'label'		=> $portal_label,
				'url'		=> append_sid("{$phpbb_root_path}portal.$phpEx"),
				'active'	=> ($user->page['page_name'] === 'portal.' . $phpEx),
				'index'		=> false,
			);
		}
	}

	if (!isset($config['forum_nav_active']) || $config['forum_nav_active'])
	{
		$items[] = array(
			'order'		=> isset($config['forum_nav_order']) ? (int) $config['forum_nav_order'] : 2,
			'tie'		=> 1,
			'label'		=> $forum_label,
			'url'		=> append_sid("{$phpbb_root_path}index.$phpEx"),
			'active'	=> ($user->page['page_name'] === 'index.' . $phpEx),
			'index'		=> true,
		);
	}

	foreach (im3_nav_load_extra() as $link)
	{
		if (!(int) $link['nav_active'])
		{
			continue;
		}

		$label = im3_nav_extra_label($link, $user_lang);
		$url = im3_nav_public_url($link);

		if ($label === '' || $url === '')
		{
			continue;
		}

		$items[] = array(
			'order'		=> (int) $link['nav_order'],
			'tie'		=> 1000 + (int) $link['nav_id'],
			'label'		=> $label,
			'url'		=> $url,
			'active'	=> im3_nav_link_active($link),
			'index'		=> false,
		);
	}

	usort($items, 'im3_nav_sort_items');

	foreach ($items as $item)
	{
		$template->assign_block_vars('nav_primary', array(
			'U_LINK'		=> $item['url'],
			'LINK_LABEL'	=> $item['label'],
			'S_ACTIVE'		=> $item['active'],
			'S_INDEX'		=> $item['index'],
		));
	}
}

/**
* usort callback for public and ACP groups.
*/
function im3_nav_sort_items($a, $b)
{
	if ($a['order'] == $b['order'])
	{
		return ($a['tie'] < $b['tie']) ? -1 : (($a['tie'] > $b['tie']) ? 1 : 0);
	}

	return ($a['order'] < $b['order']) ? -1 : 1;
}

/**
* Pages MOD choices for the ACP URL field.
*/
function im3_nav_page_choices()
{
	global $db;

	static $choices = null;

	if ($choices !== null)
	{
		return $choices;
	}

	$choices = array();

	if (!defined('PAGES_TABLE'))
	{
		return $choices;
	}

	$sql = 'SELECT page_id, page_title, page_url
		FROM ' . PAGES_TABLE . '
		ORDER BY page_title ASC';
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		$choices[] = array(
			'id'	=> (int) $row['page_id'],
			'title'	=> $row['page_title'],
			'url'	=> im3_nav_page_path((int) $row['page_id'], $row['page_title'], $row['page_url']),
		);
	}
	$db->sql_freeresult($result);

	return $choices;
}

/**
* URL input plus the Pages MOD list. Free-typed URLs are kept.
*/
function im3_nav_url_field($value, $key, $page_id)
{
	global $user;

	$page_key = str_replace('_url', '_page_id', $key);
	$html = '<input class="nav-url" id="' . $key . '" type="text" size="40" maxlength="255" name="config[' . $key . ']" value="' . htmlspecialchars($value, ENT_QUOTES, 'UTF-8') . '" autocomplete="off" />';
	$html .= '<input type="hidden" class="nav-page-id" name="config[' . $page_key . ']" value="' . (int) $page_id . '" />';
	$html .= '<div class="nav-page-list" style="display:none;margin-top:4px;">';
	$html .= '<select class="nav-page-select" size="8" style="width:100%;">';
	$html .= '<option value="">' . htmlspecialchars($user->lang['NAV_LINK_URL_CUSTOM'], ENT_QUOTES, 'UTF-8') . '</option>';

	foreach (im3_nav_page_choices() as $choice)
	{
		$html .= '<option value="' . (int) $choice['id'] . '" data-url="' . htmlspecialchars($choice['url'], ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($choice['title'] . ' — ' . $choice['url'], ENT_QUOTES, 'UTF-8') . '</option>';
	}

	$html .= '</select></div>';

	return $html;
}

/**
* Label shown on the ACP order button, in the board default language.
*/
function im3_nav_default_label($which, $link, $default_lang)
{
	global $config, $user;

	if ($which === 'portal')
	{
		if (!empty($config['portal_name_' . $default_lang]))
		{
			return $config['portal_name_' . $default_lang];
		}

		return (isset($config['portal_name']) && $config['portal_name'] !== 'Portal') ? $config['portal_name'] : $user->lang['PORTAL'];
	}

	if ($which === 'forum')
	{
		if (!empty($config['forum_name_' . $default_lang]))
		{
			return $config['forum_name_' . $default_lang];
		}

		return (isset($config['forum_name']) && $config['forum_name'] !== 'Forum') ? $config['forum_name'] : $user->lang['FORUM'];
	}

	if (!empty($link['langs'][$default_lang]))
	{
		return $link['langs'][$default_lang];
	}

	return ($link['nav_title'] !== '') ? $link['nav_title'] : $user->lang['NAV_PAGE_NAME'];
}

/**
* Insert the portal, forum, and extra-page groups into Board settings.
* Groups are reordered only when the stored numbers are exactly 1..N.
*/
function im3_nav_apply_settings_vars(&$display_vars, $languages)
{
	global $config, $user, $template;

	im3_nav_ensure_schema();

	$links = im3_nav_load_extra();
	$groups = array();
	$defaults = array(
		'portal_nav_order'	=> isset($config['portal_nav_order']) ? (int) $config['portal_nav_order'] : 1,
		'portal_nav_active'	=> isset($config['portal_nav_active']) ? (int) $config['portal_nav_active'] : 1,
		'forum_nav_order'	=> isset($config['forum_nav_order']) ? (int) $config['forum_nav_order'] : 2,
		'forum_nav_active'	=> isset($config['forum_nav_active']) ? (int) $config['forum_nav_active'] : 1,
	);

	$groups[] = array(
		'order'	=> $defaults['portal_nav_order'],
		'tie'	=> 0,
		'vars'	=> im3_nav_builtin_group('portal', $languages, $config),
	);
	$groups[] = array(
		'order'	=> $defaults['forum_nav_order'],
		'tie'	=> 1,
		'vars'	=> im3_nav_builtin_group('forum', $languages, $config),
	);

	foreach ($links as $link)
	{
		$id = (int) $link['nav_id'];
		$defaults['navlink_' . $id . '_order'] = (int) $link['nav_order'];
		$defaults['navlink_' . $id . '_active'] = (int) $link['nav_active'];
		$defaults['navlink_' . $id . '_title'] = $link['nav_title'];
		$defaults['navlink_' . $id . '_url'] = im3_nav_display_url($link);
		$defaults['navlink_' . $id . '_page_id'] = (int) $link['nav_page_id'];
		$defaults['navlink_' . $id . '_delete'] = 0;

		foreach ($languages as $lang_iso => $lang_name)
		{
			$defaults['navlink_' . $id . '_title_' . $lang_iso] = isset($link['langs'][$lang_iso]) ? $link['langs'][$lang_iso] : '';
		}

		$groups[] = array(
			'order'	=> (int) $link['nav_order'],
			'tie'	=> 1000 + $id,
			'vars'	=> im3_nav_extra_group($link, $languages),
		);
	}

	$orders = array();
	foreach ($groups as $group)
	{
		$orders[] = $group['order'];
	}

	if (im3_nav_orders_valid($orders))
	{
		usort($groups, 'im3_nav_sort_items');
	}

	$temp = array();
	$inserted = false;

	foreach ($display_vars['vars'] as $key => $value)
	{
		if (!$inserted && $key === 'portal_enabled')
		{
			foreach ($groups as $group)
			{
				foreach ($group['vars'] as $gkey => $gval)
				{
					$temp[$gkey] = $gval;
				}
			}
			$inserted = true;
		}

		$temp[$key] = $value;
	}

	if (!$inserted)
	{
		foreach ($groups as $group)
		{
			foreach ($group['vars'] as $gkey => $gval)
			{
				$temp[$gkey] = $gval;
			}
		}
	}

	$display_vars['vars'] = $temp;
	$GLOBALS['im3_nav_form_defaults'] = $defaults;
	$GLOBALS['im3_nav_languages'] = $languages;

	$default_lang = (isset($config['default_lang']) && isset($languages[$config['default_lang']])) ? $config['default_lang'] : 'en';
	$buttons = array(
		array(
			'key'		=> 'portal',
			'order'		=> $defaults['portal_nav_order'],
			'tie'		=> 0,
			'label'		=> im3_nav_default_label('portal', array(), $default_lang),
			'active'	=> $defaults['portal_nav_active'],
		),
		array(
			'key'		=> 'forum',
			'order'		=> $defaults['forum_nav_order'],
			'tie'		=> 1,
			'label'		=> im3_nav_default_label('forum', array(), $default_lang),
			'active'	=> $defaults['forum_nav_active'],
		),
	);

	foreach ($links as $link)
	{
		$id = (int) $link['nav_id'];
		$buttons[] = array(
			'key'		=> 'navlink_' . $id,
			'order'		=> (int) $link['nav_order'],
			'tie'		=> 1000 + $id,
			'label'		=> im3_nav_default_label('extra', $link, $default_lang),
			'active'	=> (int) $link['nav_active'],
		);
	}

	$button_orders = array();
	foreach ($buttons as $button)
	{
		$button_orders[] = $button['order'];
	}

	if (im3_nav_orders_valid($button_orders))
	{
		usort($buttons, 'im3_nav_sort_items');
	}

	$html = '<div id="nav-order-bar" role="list">';

	foreach ($buttons as $button)
	{
		$key = $button['key'];
		$field = ($key === 'portal' || $key === 'forum') ? $key . '_nav_order' : $key . '_order';
		$html .= '<span class="nav-order-item' . (empty($button['active']) ? ' is-off' : '') . '" role="listitem" draggable="true" data-nav-key="' . htmlspecialchars($key, ENT_QUOTES, 'UTF-8') . '">';
		$html .= '<span class="nav-order-grip" aria-hidden="true"></span>';
		$html .= '<span class="nav-order-label">' . htmlspecialchars($button['label'], ENT_QUOTES, 'UTF-8') . '</span>';
		$html .= '<input type="hidden" id="' . $field . '" name="config[' . $field . ']" value="' . (int) $button['order'] . '" />';
		$html .= '</span>';
	}

	$html .= '</div>';

	if (isset($template) && is_object($template))
	{
		$template->assign_var('NAV_ORDER_BUTTONS', $html);
	}
}

/**
* Portal or forum fields: name, active, then per-language names.
*/
function im3_nav_builtin_group($which, $languages, $config)
{
	global $user;

	$prefix = ($which === 'portal') ? 'portal' : 'forum';
	$sentinel = ($which === 'portal') ? 'Portal' : 'Forum';
	$name_key = ($which === 'portal') ? 'PORTAL_NAME' : 'FORUM_NAME';
	$lang_key = ($which === 'portal') ? 'PORTAL_NAME_LANG' : 'FORUM_NAME_LANG';
	$vars = array();

	$vars[$prefix . '_name'] = array(
		'lang'		=> $name_key,
		'validate'	=> 'string',
		'type'		=> 'text:20:255',
		'explain'	=> true,
	);
	$vars[$prefix . '_nav_active'] = array(
		'lang'		=> 'NAV_LINK_ACTIVE',
		'validate'	=> 'bool',
		'type'		=> 'radio:yes_no',
		'explain'	=> true,
	);

	if (isset($config[$prefix . '_name']) && $config[$prefix . '_name'] !== $sentinel)
	{
		foreach ($languages as $lang_iso => $lang_name)
		{
			$vars[$prefix . '_name_' . $lang_iso] = array(
				'lang'		=> sprintf($user->lang[$lang_key], $lang_name),
				'validate'	=> 'string',
				'type'		=> 'text:20:255',
				'explain'	=> false,
				'localized'	=> true,
			);
		}
	}

	return $vars;
}

/**
* One extra page link.
*/
function im3_nav_extra_group($link, $languages)
{
	global $user;

	$id = (int) $link['nav_id'];
	$prefix = 'navlink_' . $id;
	$vars = array();

	$vars[$prefix . '_title'] = array(
		'lang'		=> 'NAV_PAGE_NAME',
		'validate'	=> 'string',
		'type'		=> 'text:20:255',
		'explain'	=> true,
	);
	$vars[$prefix . '_active'] = array(
		'lang'		=> 'NAV_LINK_ACTIVE',
		'validate'	=> 'bool',
		'type'		=> 'radio:yes_no',
		'explain'	=> true,
	);

	foreach ($languages as $lang_iso => $lang_name)
	{
		$vars[$prefix . '_title_' . $lang_iso] = array(
			'lang'		=> sprintf($user->lang['NAV_PAGE_NAME_LANG'], $lang_name),
			'validate'	=> 'string',
			'type'		=> 'text:20:255',
			'explain'	=> false,
			'localized'	=> true,
		);
	}

	$vars[$prefix . '_url'] = array(
		'lang'		=> 'NAV_LINK_URL',
		'validate'	=> 'string',
		'type'		=> 'custom',
		'method'	=> 'nav_url_field',
		'explain'	=> true,
	);
	$vars[$prefix . '_delete'] = array(
		'lang'		=> 'NAV_LINK_DELETE',
		'validate'	=> 'bool',
		'type'		=> 'radio:yes_no',
		'explain'	=> true,
	);

	return $vars;
}

/**
* Defaults merged into the ACP form. Not written to the config table.
*/
function im3_nav_form_defaults()
{
	return (isset($GLOBALS['im3_nav_form_defaults']) && is_array($GLOBALS['im3_nav_form_defaults'])) ? $GLOBALS['im3_nav_form_defaults'] : array();
}

/**
* Write extra links from the posted form. Optionally append one empty link.
*/
function im3_nav_save_posted($cfg_array, $add_new)
{
	global $db, $cache;

	$languages = (isset($GLOBALS['im3_nav_languages']) && is_array($GLOBALS['im3_nav_languages'])) ? $GLOBALS['im3_nav_languages'] : array();
	$existing = im3_nav_load_extra();

	if (isset($cfg_array['portal_nav_order']))
	{
		set_config('portal_nav_order', (int) $cfg_array['portal_nav_order']);
	}

	if (isset($cfg_array['forum_nav_order']))
	{
		set_config('forum_nav_order', (int) $cfg_array['forum_nav_order']);
	}

	foreach ($existing as $link)
	{
		$id = (int) $link['nav_id'];

		if (!isset($cfg_array['navlink_' . $id . '_title']) && !isset($cfg_array['navlink_' . $id . '_order']))
		{
			continue;
		}

		if (!empty($cfg_array['navlink_' . $id . '_delete']))
		{
			$db->sql_query('DELETE FROM ' . NAV_LINKS_TABLE . ' WHERE nav_id = ' . $id);
			$db->sql_query('DELETE FROM ' . NAV_LINK_LANG_TABLE . ' WHERE nav_id = ' . $id);
			continue;
		}

		$page_id = isset($cfg_array['navlink_' . $id . '_page_id']) ? (int) $cfg_array['navlink_' . $id . '_page_id'] : 0;
		$url = isset($cfg_array['navlink_' . $id . '_url']) ? trim($cfg_array['navlink_' . $id . '_url']) : '';

		if ($page_id > 0)
		{
			$url = im3_nav_page_path($page_id);
		}

		$sql_ary = array(
			'nav_order'		=> isset($cfg_array['navlink_' . $id . '_order']) ? (int) $cfg_array['navlink_' . $id . '_order'] : (int) $link['nav_order'],
			'nav_active'	=> empty($cfg_array['navlink_' . $id . '_active']) ? 0 : 1,
			'nav_title'		=> isset($cfg_array['navlink_' . $id . '_title']) ? $cfg_array['navlink_' . $id . '_title'] : '',
			'nav_url'		=> $url,
			'nav_page_id'	=> $page_id,
		);
		$db->sql_query('UPDATE ' . NAV_LINKS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . ' WHERE nav_id = ' . $id);

		$db->sql_query('DELETE FROM ' . NAV_LINK_LANG_TABLE . ' WHERE nav_id = ' . $id);

		foreach ($languages as $lang_iso => $lang_name)
		{
			$title = isset($cfg_array['navlink_' . $id . '_title_' . $lang_iso]) ? trim($cfg_array['navlink_' . $id . '_title_' . $lang_iso]) : '';

			if ($title === '')
			{
				continue;
			}

			$db->sql_query('INSERT INTO ' . NAV_LINK_LANG_TABLE . ' ' . $db->sql_build_array('INSERT', array(
				'nav_id'	=> $id,
				'lang_iso'	=> $lang_iso,
				'nav_title'	=> $title,
			)));
		}
	}

	if ($add_new)
	{
		$orders = im3_nav_posted_orders($cfg_array);
		$next = sizeof($orders) ? (max($orders) + 1) : 1;

		$db->sql_query('INSERT INTO ' . NAV_LINKS_TABLE . ' ' . $db->sql_build_array('INSERT', array(
			'nav_order'		=> $next,
			'nav_active'	=> 1,
			'nav_url'		=> '',
			'nav_page_id'	=> 0,
			'nav_title'		=> '',
		)));
	}

	if (isset($cache) && is_object($cache))
	{
		$cache->destroy('_im3_nav_links');
	}
}
