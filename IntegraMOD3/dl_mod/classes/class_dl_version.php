<?php

/**
*
* @mod package		Download Mod 6
* @file				class_dl_version.php 3 2012/05/19 OXPUS
* @copyright		(c) 2005 oxpus (Karsten Ude) <webmaster@oxpus.de> http://www.oxpus.de
* @copyright mod	(c) hotschi / demolition fabi / oxpus
* @license			http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

class dl_version extends dl_mod
{
	public function __construct()
	{
		return;
	}

	public function __destruct()
	{
		return;
	}

	public static function dl_mod_version($art = 'acp')
	{
		global $user, $template, $config;

		if (!function_exists('get_remote_file'))
		{
			if (!function_exists('recalc_nested_sets'))
			{
				include(dl_init::phpbb_root_path() . 'includes/functions_admin' . dl_init::phpEx());
			}
		}

		if ($art == 'acp')
		{
			$template->assign_block_vars('mods', array(
				'ANNOUNCEMENT'		=> $data['announcement'],
				'AUTHOR'			=> $var['author'],
				'CURRENT_VERSION'	=> $version,
				'DESCRIPTION'		=> $data['description'],
				'DOWNLOAD'			=> $data['download'],
				'LATEST_VERSION'	=> $mod_version,
				'TITLE'				=> $data['title'],
	
				'UP_TO_DATE'		=> sprintf((!$version_compare) ? $user->lang['DL_NOT_UP_TO_DATE'] : $user->lang['DL_UP_TO_DATE'], $data['title']),
	
				'S_UP_TO_DATE'		=> $version_compare,
	
				'U_AUTHOR'			=> 'http://www.phpbb.com/community/memberlist.php?mode=viewprofile&un=' . $var['author'],
			));
		}
	}

	/**
	 * Internal function for dl_mod_version();
	 * private - not for public uses!
	 */
	private static function _dl_setup_array($xml)
	{
		// Fire up the built-in XML parser
		$values = $index = array();
		$parser = xml_parser_create();
		xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);

		// this takes care of one possible xml error
		$xml = str_replace('&', '&amp;', (string) $xml);

		// Set tag names and values
		xml_parse_into_struct($parser, $xml, $values, $index);

		// Close down XML parser
		xml_parser_free($parser);

		$ary = array();

		foreach ($values as $value)
		{
			switch (trim((string) $value['level']))
			{
				case 1:
					if ($value['type'] == 'open')
					{
						$one = $value['tag'];
					}
					else if ($value['type'] == 'complete')
					{
						$ary[$value['tag']] = $value['value'];
					}
				break;

				case 2:
					if ($value['type'] == 'open')
					{
						$two = $value['tag'];
					}
					else if ($value['type'] == 'complete')
					{
						$ary[$one][$value['tag']] = $value['value'];
					}
				break;

				case 3:
					if ($value['type'] == 'open')
					{
						$three = $value['tag'];
					}
					else if ($value['type'] == 'complete')
					{
						$ary[$one][$two][$value['tag']] = $value['value'];
					}
				break;

				case 4:
					if ($value['type'] == 'complete')
					{
						$ary[$one][$two][$three][$value['tag']] = isset($value['value']) ? $value['value'] : '';
					}
				break;
			}
		}
		return $ary;
	}
}
 