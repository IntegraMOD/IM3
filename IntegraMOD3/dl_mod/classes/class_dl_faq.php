<?php

/**
*
* @mod package		Download Mod 6
* @file				class_dl_faq.php 3 2012/03/18 OXPUS
* @copyright		(c) 2005 oxpus (Karsten Ude) <webmaster@oxpus.de> http://www.oxpus.de
* @copyright mod	(c) hotschi / demolition fabi / oxpus
* @license			http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/*
* connect to phpBB
*/
if ( !defined('IN_PHPBB') )
{
	exit;
}

class dl_faq
{
	public function __construct()
	{
		return;
	}

	public function __destruct()
	{
		return;
	}

	public static function dl_faq_format($text)
	{
		global $user, $phpbb_root_path, $phpEx;

		$dl_url = append_sid("{$phpbb_root_path}downloads.$phpEx");

		$text = str_replace('{DL_FAQ_URL}',		$dl_url,					$text);

		$text = str_replace('{DL_IMG_BLUE}',	dl_status::icon('dl_blue'),		$text);
		$text = str_replace('{DL_IMG_RED}',		dl_status::icon('dl_red'),		$text);
		$text = str_replace('{DL_IMG_GREY}',	dl_status::icon('dl_grey'),		$text);
		$text = str_replace('{DL_IMG_WHITE}',	dl_status::icon('dl_white'),		$text);
		$text = str_replace('{DL_IMG_YELLOW}',	dl_status::icon('dl_yellow'),	$text);
		$text = str_replace('{DL_IMG_GREEN}',	dl_status::icon('dl_green'),		$text);

		return $text;
	}
}

?>