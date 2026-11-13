<?php
/**
*
* Static Pages SEO helpers
*
* @package IntegraMOD
* @copyright (c) 2009 Vojtěch Vondra
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
* Build the public, session-free URL for a static page.
* Uses the page name, for example /chat, when SEO URLs are enabled.
*/
function static_page_url($page_id, $title = '', $page_url = '')
{
	global $phpEx;

	$page_id = (int) $page_id;
	$board_url = rtrim(generate_board_url(), '/');

	if ($page_url !== '' && function_exists('im3_seo_enabled') && im3_seo_enabled())
	{
		return $board_url . '/' . rawurlencode($page_url);
	}

	return $board_url . '/page.' . $phpEx . '?id=' . $page_id;
}

/**
* Prepare a page description for use in meta and structured data.
*/
function static_page_meta_description($page_desc)
{
	$description = html_entity_decode(strip_tags((string) $page_desc), ENT_QUOTES, 'UTF-8');
	$description = preg_replace('/\s+/u', ' ', $description);
	$description = trim($description);

	if (utf8_strlen($description) > 300)
	{
		$description = utf8_substr($description, 0, 297) . '...';
	}

	return htmlspecialchars($description, ENT_QUOTES, 'UTF-8');
}

/**
* Build JSON-LD for the page and its breadcrumb trail.
*/
function static_page_jsonld($row, $url, $description, $image = '')
{
	global $config, $user;

	$updated = !empty($row['page_updated']) ? (int) $row['page_updated'] : time();
	$modified = gmdate('Y-m-d\TH:i:s\Z', $updated);
	$home_url = rtrim(generate_board_url(), '/') . '/';
	$pages_url = append_sid(rtrim(generate_board_url(), '/') . '/page.' . $GLOBALS['phpEx'], false, true, 0);
	$title = !empty($row['page_seo_title']) ? $row['page_seo_title'] : $row['page_title'];

	$page = array(
		'@type'			=> 'WebPage',
		'name'			=> $title,
		'headline'		=> $row['page_title'],
		'description'	=> html_entity_decode($description, ENT_QUOTES, 'UTF-8'),
		'url'			=> $url,
		'dateModified'	=> $modified,
		'inLanguage'	=> $config['default_lang'],
		'isPartOf'		=> array(
			'@type'	=> 'WebSite',
			'name'	=> $config['sitename'],
			'url'	=> $home_url,
		),
		'publisher'		=> array(
			'@type'	=> 'Organization',
			'name'	=> $config['sitename'],
		),
	);

	if ($image !== '')
	{
		$page['image'] = $image;
	}

	$data = array(
		'@context'	=> 'https://schema.org',
		'@graph'	=> array(
			$page,
			array(
				'@type'				=> 'BreadcrumbList',
				'itemListElement'	=> array(
					array(
						'@type'		=> 'ListItem',
						'position'	=> 1,
						'name'		=> $config['sitename'],
						'item'		=> $home_url,
					),
					array(
						'@type'		=> 'ListItem',
						'position'	=> 2,
						'name'		=> $user->lang['PAGES'],
						'item'		=> $pages_url,
					),
					array(
						'@type'		=> 'ListItem',
						'position'	=> 3,
						'name'		=> $row['page_title'],
						'item'		=> $url,
					),
				),
			),
		),
	);

	$flags = 0;
	if (defined('JSON_UNESCAPED_SLASHES'))
	{
		$flags |= JSON_UNESCAPED_SLASHES;
	}
	if (defined('JSON_UNESCAPED_UNICODE'))
	{
		$flags |= JSON_UNESCAPED_UNICODE;
	}

	return str_replace('</', '<\/', json_encode($data, $flags));
}
