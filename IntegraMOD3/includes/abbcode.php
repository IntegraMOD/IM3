<?php
/**
*
* @package Advanced BBCode Box 3
* @version $Id$
* @copyright (c) 2010 leviatan21 (Gabriel Vazquez) and VSE (Matt Friedman)
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

global $abbcode;
$abbcode = new abbcode();

/**
* Advanced BBCode Box 3 class
* @package Advanced BBCode Box 3
*/
class abbcode
{
	var $abbcode_config = array();

	// HTML was deprecated in v1.0.11
	// UPLOAD was was deprecated in v3.0.7
	var $need_permissions = array('URL', 'FLASH', 'IMG', 'THUMBNAIL', 'IMGSHACK', 'WEB', 'ED2K', 'RAPIDSHARE', 'TESTLINK', 'FLV' ,'BBVIDEO' /* ,'HTML' */ /* ,'UPLOAD' */ );

	// [testlinks] and [rapidshare] Hide link/s from guest and bots ?
	var $hide_links	= false;	// Options true=hide / false=display, default false
	// [testlinks] and [rapidshare] Display the OK/WRONG image or use text ?
	var $img_links	= true;		// Options true=use image / false=use text, default true

	/**
	* Constructor
	* @version 3.0.7-PL1
	*/
	function abbcode()
	{
		if (!defined('IN_ABBC3'))
		{
			define('IN_ABBC3', true);
		}
		$this->abbcode_init();
	}

	/**
	* Initialize config vars...
	*
	* @param bool		$need_template
	* @return mixeed
	* @version 3.0.8
	*/
	function abbcode_init($need_template = true)
	{
		global $template, $user, $config, $phpbb_admin_path, $phpbb_root_path, $phpEx;

		// For overall_header.html
		$this->abbcode_config = array(
			'S_ABBC3_VERSION'		=> $config['ABBC3_VERSION'],
			'S_ABBC3_MOD'			=> $config['ABBC3_MOD'],

			'S_ABBC3_PATH'			=> $phpbb_root_path . 'styles/abbcode',

			'S_ABBC3_RESIZE'		=> ($config['ABBC3_RESIZE_METHOD'] != 'none') ? true : false,
			'S_ABBC3_RESIZE_METHOD'	=> $config['ABBC3_RESIZE_METHOD'],
			'S_ABBC3_RESIZE_BAR'	=> $config['ABBC3_RESIZE_BAR'],

			'S_ABBC3_MAX_IMG_WIDTH'		=> (isset($config['ABBC3_MAX_IMG_WIDTH'])) ? $config['ABBC3_MAX_IMG_WIDTH'] : $config['img_max_width'],
			'S_ABBC3_MAX_IMG_HEIGHT'	=> (isset($config['ABBC3_MAX_IMG_HEIGHT'])) ? $config['ABBC3_MAX_IMG_HEIGHT'] : $config['img_max_height'],

			'S_ABBC3_RESIZE_SIGNATURE'	=> $config['ABBC3_RESIZE_SIGNATURE'],
			'S_ABBC3_MAX_SIG_WIDTH'		=> (isset($config['ABBC3_MAX_SIG_WIDTH'])) ? $config['ABBC3_MAX_SIG_WIDTH'] : $config['img_max_width'],
			'S_ABBC3_MAX_SIG_HEIGHT'	=> (isset($config['ABBC3_MAX_SIG_HEIGHT'])) ? $config['ABBC3_MAX_SIG_HEIGHT'] : $config['img_max_height'],
		);
		/*
		// Styles and admin variables depends on locations
		$this->abbcode_config = array_merge($this->abbcode_config, array(
			// path from the very forum root
			'S_ABBC3_OVERALL_HEADER'	=> ((isset($phpbb_admin_path)) ? './../../' : './../../../') . str_replace($phpbb_root_path, '', $this->abbcode_config['S_ABBC3_PATH']) . '/abbcode_header.html',
			'S_ABBC3_POSTING_JAVASCRIPT'=> ((isset($phpbb_admin_path)) ? './../../' : './../../../') . str_replace($phpbb_root_path, '', $this->abbcode_config['S_ABBC3_PATH']) . '/posting_abbcode_buttons.js',
			'S_ABBC3_WIZARD_JAVASCRIPT'	=> ((isset($phpbb_admin_path)) ? './../../' : './../../../') . str_replace($phpbb_root_path, '', $this->abbcode_config['S_ABBC3_PATH']) . '/posting_abbcode_wizards.js',
		));
		*/
		// Display all _common_ variables that may be used at any point in a template.
		if ($need_template)
		{
			$template->assign_vars($this->abbcode_config);
		}

		// For posting_buttons.html -> posting_abbcode_buttons.html
		$this->abbcode_config = array_merge($this->abbcode_config, array(
			// Toolbar options
			'ABBC3_BG'				=> $config['ABBC3_BG'],
			'ABBC3_TAB'				=> $config['ABBC3_TAB'],
			'ABBC3_BOXRESIZE'		=> $config['ABBC3_BOXRESIZE'],
			'ABBC3_COMPACT'			=> $config['ABBC3_UCP_MODE'],
			'ABBC3_COLOR_MODE'		=> $config['ABBC3_COLOR_MODE'],
			'ABBC3_HIGHLIGHT_MODE'	=> $config['ABBC3_HIGHLIGHT_MODE'],
			'ABBC3_HELP_PAGE'		=> append_sid("{$phpbb_root_path}abbcode_page.$phpEx", 'mode=help'),
			'ABBC3_TIGRA_PAGE'		=> append_sid("{$phpbb_root_path}abbcode_page.$phpEx", 'mode=tigra'),
			// Thumbnails
			'ABBC3_MAX_THUM_WIDTH'	=> (isset($config['ABBC3_MAX_THUM_WIDTH'])) ? $config['ABBC3_MAX_THUM_WIDTH'] : $config['img_max_thumb_width'],
			'ABBC3_VIDEO_WIDTH'		=> $config['ABBC3_VIDEO_width'],
			'ABBC3_VIDEO_HEIGHT'	=> $config['ABBC3_VIDEO_height'],
			// ABBC3 wizards
			'ABBC3_WIZARD_PAGE'		=> append_sid("{$phpbb_root_path}abbcode_page.$phpEx", 'mode=wizards'),
			'ABBC3_WIZARD_MODE'		=> (int) $config['ABBC3_WIZARD_MODE'],
			'ABBC3_WIZARD_WIDTH'	=> $config['ABBC3_WIZARD_width'],
			'ABBC3_WIZARD_HEIGHT'	=> $config['ABBC3_WIZARD_height'],
			// Cookie
			'ABBC3_COOKIE_NAME'		=> $config['cookie_name'] . '_abbc3',
			// Usename posting
			'POST_AUTHOR'			=> (isset($user->data['username'])) ? $user->data['username'] : '',
		));
	}

	/**
	* Display posting page
	*
	* @param string $mode
	* @version 3.0.8
	*/
	function abbcode_display($mode)
	{
		global $db, $template, $user, $phpbb_admin_path, $phpbb_root_path, $post_id;

		$user->add_lang('mods/abbcode');

		/**
		* Get proper auth
		*	UCP page mode = signature
		* 	ACP page mode = sig
		* 	Posting page mode = post, edit, quote, reply
		* 	else should be PM
		*/
		$display = ($mode == 'signature' || $mode == 'sig') ? 'display_on_sig' : (($mode == 'post' || $mode == 'edit' || $mode == 'quote' || $mode == 'reply') ? 'display_on_posting' : 'display_on_pm');

		$sql = "SELECT abbcode, bbcode_tag, bbcode_order, bbcode_id, bbcode_group, bbcode_tag, bbcode_helpline, bbcode_image, display_on_posting
				FROM " . BBCODES_TABLE . "
				WHERE $display = 1
				ORDER BY bbcode_order";
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			// Some fixes
			$is_abbcode		= ($row['abbcode']) ? true : false;
			$abbcode_name	= (($is_abbcode) ? 'ABBC3_' : '') . strtoupper(str_replace('=', '', trim($row['bbcode_tag'])));
			$abbcode_name	= ($row['bbcode_helpline'] == 'ABBC3_ED2K_TIP') ? 'ABBC3_ED2K' : $abbcode_name;

			$abbcode_image	= trim($row['bbcode_image']);
			$abbcode_mover	= (isset($user->lang[$abbcode_name . '_MOVER']	)) ? $user->lang[$abbcode_name . '_MOVER']   : $abbcode_name;
			$abbcode_tip	= (isset($user->lang[$abbcode_name . '_TIP']	)) ? $user->lang[$abbcode_name . '_TIP']     : (($is_abbcode) ? '' : $row['bbcode_helpline']);
			$abbcode_note	= (isset($user->lang[$abbcode_name . '_NOTE']	)) ? $user->lang[$abbcode_name . '_NOTE']    : '';
			$abbcode_example= (isset($user->lang[$abbcode_name . '_EXAMPLE'])) ? $user->lang[$abbcode_name . '_EXAMPLE'] : '';

			// Check phpbb permissions status
			// Check ABBC3 groups permission
			// try to make it as quicky as it can be
			$auth_tag = preg_replace('#\=(.*)?#', '', strtoupper(trim($row['bbcode_tag'])));
			if ((isset($row['bbcode_group']) && $row['bbcode_group']) || in_array($auth_tag, $this->need_permissions))
			{
				if (!$this->abbcode_permissions($auth_tag, (isset($row['bbcode_group']) ? $row['bbcode_group'] : 0)))
				{
					continue;
				}
			}

			switch ($abbcode_name)
			{
				case 'ABBC3_FONT':
				case 'ABBC3_SIZE':
				case 'ABBC3_HIGHLIGHT':
				case 'ABBC3_COLOR':
					$template->assign_vars(array(
						'S_' . $abbcode_name	=> true,
						$abbcode_name . '_NAME'	=> strtolower($abbcode_name),
						$abbcode_name . '_MOVER'=> $abbcode_mover,
						$abbcode_name . '_TIP'	=> $abbcode_tip,
						$abbcode_name . '_NOTE'	=> $abbcode_note,
					));
				break;

				// Is a Line break ? -> abbc3_break(n)
				case (strpos($abbcode_name, 'ABBC3_BREAK') !== false) :
					$template->assign_block_vars('abbc3_tags', array('S_ABBC3_BREAK' => true));
				break;

				// Is a Division line ? -> abbc3_division(n)
				case (strpos($abbcode_name, 'ABBC3_DIVISION') !== false) :
					$template->assign_block_vars('abbc3_tags', array('S_ABBC3_DIVISION' => true));
				break;

				default:
					// Haven't image ? should be a phpbb3 custom bbcode from ACP, so let's phpbb3 take care of it
					if (!$abbcode_image)
					{
						break;
					}
					$template->assign_block_vars('abbc3_tags', array(
						'BBCODE_ABBC3'		=> ($is_abbcode) ? '1' : '0',
						'BBCODE_ID'			=> $row['bbcode_id'],
						'BBCODE_IMG'		=> $abbcode_image,
						'BBCODE_NAME'		=> strtolower($abbcode_name),
						'BBCODE_TAG'		=> "'[{$row['bbcode_tag']}]', '[/" . preg_replace('/(=.*)/i', '', $row['bbcode_tag']) . "]'",
						'BBCODE_MOVER'		=> $abbcode_mover,
						'BBCODE_TIP'		=> $abbcode_tip,
						'BBCODE_NOTE'		=> $abbcode_note,
						'BBCODE_EXAMPLE'	=> $abbcode_example,
					));
				break;
			}
		}
		$db->sql_freeresult($result);

		$template->assign_vars(array(
			'S_POST_ID'					=> ($post_id) ? $post_id : 0,
			'S_ABBC3_IN_WIZARD'			=> false,
			'S_ABBC3_IN_ADMIN'			=> (isset($phpbb_admin_path)) ? true : false,
			'S_ABBC3_BG'				=> $this->abbcode_config['ABBC3_BG'],
			'S_ABBC3_TAB'				=> $this->abbcode_config['ABBC3_TAB'],
			'S_ABBC3_BOXRESIZE'			=> $this->abbcode_config['ABBC3_BOXRESIZE'],
			'S_POST_AUTHOR'				=> (isset($user->data['username'])) ? $user->data['username'] : '',
			'S_ABBC3_VIDEO_WIDTH'		=> $this->abbcode_config['ABBC3_VIDEO_WIDTH'],
			'S_ABBC3_VIDEO_HEIGHT'		=> $this->abbcode_config['ABBC3_VIDEO_HEIGHT'],
			'S_ABBC3_TIGRA_PAGE'		=> $this->abbcode_config['ABBC3_TIGRA_PAGE'],
			'S_ABBC3_HELP_PAGE'			=> $this->abbcode_config['ABBC3_HELP_PAGE'],
			'S_ABBC3_WIZARD_PAGE'		=> $this->abbcode_config['ABBC3_WIZARD_PAGE'],
			'S_ABBC3_WIZARD_MODE'		=> $this->abbcode_config['ABBC3_WIZARD_MODE'],
			'S_ABBC3_WIZARD_WIDTH'		=> $this->abbcode_config['ABBC3_WIZARD_WIDTH'],
			'S_ABBC3_WIZARD_HEIGHT'		=> $this->abbcode_config['ABBC3_WIZARD_HEIGHT'],
			'S_ABBC3_COLOR_MODE'		=> $this->abbcode_config['ABBC3_COLOR_MODE'],
			'S_ABBC3_HIGHLIGHT_MODE'	=> $this->abbcode_config['ABBC3_HIGHLIGHT_MODE'],
			'S_ABBC3_COOKIE_NAME'		=> $this->abbcode_config['ABBC3_COOKIE_NAME'],
			'S_ABBC3_COMPACT'			=> ($this->abbcode_config['ABBC3_COMPACT'] && isset($user->data['user_abbcode_compact'])) ? $user->data['user_abbcode_compact'] : false,
		));
	}

	/**
	* Check group bbcodes permissions
	* Check some bbcodes status permissions
	* @param string		$abbcode_name
	* @param mix		$bbcode_group
	* @return boolean	true / false
	* @version 3.0.8-PL1
	*/
	function abbcode_permissions($auth_tag = '', $bbcode_group = '')
	{
		global $user, $db, $auth;
		global $config, $forum_id, $mode;

		$return_value = true;

		// Check group bbcodes permissions
		if ($bbcode_group)
		{
			// Always use arrays here ;)
			if (!is_array($bbcode_group))
			{
				$bbcode_group = explode(',', $bbcode_group);
			}

			// Do not run twice if it has already been executed earlier.
			if (!isset($user->data['agroup_id']))
			{
				$user->data['agroup_id'] = array();

				$sql = 'SELECT *
						FROM ' . USER_GROUP_TABLE . '
						WHERE user_id = ' . $user->data['user_id'] . '
						AND user_pending = 0 ';
				$result = $db->sql_query($sql);

				while ($row = $db->sql_fetchrow($result))
				{
					$user->data['agroup_id'][] = $row['group_id'];
				}
				$db->sql_freeresult($result);
			}

			if (!empty($bbcode_group) && !empty($user->data['agroup_id']))
			{
				$return_value = false;

				foreach ($user->data['agroup_id'] as $agroup_data)
				{
					if (in_array($agroup_data, $bbcode_group))
					{
						// If this group can use it, take me out of here quickly !
						$return_value = true;
						break;
					}
				}
			}

			// If this bbcode is not allowed, do not continue checking
			if (!$return_value)
			{
				return $return_value;
			}
		}

		// Check some bbcodes status permissions
		if ($auth_tag)
		{
			// if no mode is specified, use post settings
			$mode = (!$mode) ? request_var('mode', 'post') : $mode;

			switch ($auth_tag)
			{
				case 'THUMBNAIL':
				case 'IMGSHACK':
					$auth_tag = 'IMG';
				break;

				case 'WEB':
				case 'ED2K':
				case 'RAPIDSHARE':
				case 'TESTLINK':
					$auth_tag = 'URL';
				break;

				case 'FLV':
			//	Commented out, because we think bbvideo should not follow flash restrictions ;)
			//	case 'BBVIDEO':
					$auth_tag = 'FLASH';
				break;

				default:
				break;
			}

			// Get phpbb bbcodes status
			switch ($mode)
			{
				// POSTING
				case 'post' :
				case 'edit' :
				case 'quote':
				case 'reply':
					$bbcode_status	= ($config['allow_bbcode'] && (($forum_id) ? $auth->acl_get('f_bbcode', $forum_id) : true)) ? true : false;
					$status_ary  = array(
						'IMG'		=> ($bbcode_status && (($forum_id) ? $auth->acl_get('f_img', $forum_id) : true)) ? true : false,
						'URL'		=> ($config['allow_post_links']) ? true : false,
						'FLASH'		=> ($bbcode_status && (($forum_id) ? $auth->acl_get('f_flash', $forum_id) : true) && $config['allow_post_flash']) ? true : false,
					//	'QUOTE'		=> ($auth->acl_get('f_reply', $forum_id)) ? true : false,
						'MOD'		=> ($auth->acl_get('a_') || $auth->acl_get('m_') || $auth->acl_getf_global('m_')) ? true : false,
					);
				break;

				// ABBC3 HELP PAGE
				default :
				case 'help' :
					$bbcode_status = ($config['allow_bbcode']) ? true : false;
					$status_ary  = array(
						'IMG'		=> ($bbcode_status) ? true : false,
						'URL'		=> ($bbcode_status && $config['allow_post_links']) ? true : false,
						'FLASH'		=> ($bbcode_status && $config['allow_post_flash']) ? true : false,
					//	'QUOTE'		=> $bbcode_status,
						'MOD'		=> ($auth->acl_get('a_') || $auth->acl_get('m_') || $auth->acl_getf_global('m_')) ? true : false,
					);
				break;

				// SIG
				case 'signature' :
				case 'sig' :
					$bbcode_status = ($config['allow_sig_bbcode']) ? true : false;
					$status_ary  = array(
						'IMG'		=> ($bbcode_status && $config['allow_sig_img']) ? true : false,
						'URL'		=> ($bbcode_status && $config['allow_sig_links']) ? true : false,
						'FLASH'		=> ($bbcode_status && $config['allow_sig_flash']) ? true : false,
					//	'QUOTE'		=> $bbcode_status,
						'MOD'		=> ($auth->acl_get('a_') || $auth->acl_get('m_') || $auth->acl_getf_global('m_')) ? true : false,
					);
				break;

				// PM
				case 'compose' :
					$bbcode_status	= ($config['allow_bbcode'] && $config['auth_bbcode_pm'] && $auth->acl_get('u_pm_bbcode')) ? true : false;
					$status_ary  = array(
						'IMG'		=> ($config['auth_img_pm'] && $auth->acl_get('u_pm_img')) ? true : false,
						'URL'		=> ($config['allow_post_links']) ? true : false,
						'FLASH'		=> ($config['auth_flash_pm'] && $auth->acl_get('u_pm_flash')) ? true : false,
					//	'QUOTE'		=> $bbcode_status,
						'MOD'		=> ($auth->acl_get('a_') || $auth->acl_get('m_') || $auth->acl_getf_global('m_')) ? true : false ,
					);
				break;
			}

			foreach ($status_ary as $phpbb3_bbcode => $value)
			{
				if (strtoupper($auth_tag) == $phpbb3_bbcode)
				{
					// if I can not use it, take me out of here quickly !
					$return_value = $value;
					break;
				}
			}

			// If this bbcode was rejected, do not continue
			if (!$return_value)
			{
				return $return_value;
			}
		}

		return $return_value;
	}

	/**
	* Parsing the tables  - Second pass.
	*
	* @param string		$stx	table style
	* @param string		$in 	post text between [table] & [/table]
	* @return string	table
	* @version 3.0.8
	*/
	function table_pass($stx, $in)
	{
		global $user;

		// Check for unsafe html & css attributes only inside the style string
		$unsafe = array();

		$unsafe = $this->safehtml($stx);

		$matches = preg_match_all('#\[(tr|td)=(.*?)\]#', $in, $match);
		for ($i = 0; $i < $matches; $i++)
		{
			if (empty($match[2][$i]))
			{
				continue;
			}
			$unsafe = array_merge($unsafe, $this->safehtml($match[2][$i]));
		}

		if (sizeof($unsafe))
		{
			return  '[table=' . $stx . ']' . $in . '[/table] <p class="error">' . sprintf($user->lang['ABBC3_UNAUTHORISED'] , implode('<br />', $unsafe)) . '</p>';
		}

		$stx = str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($stx));
		$in	= str_replace(array("]\r\n", "]\r", "]\n", "\r\n[", "\r[", "\n[", '\"', '\'', '(', ')'), array("]\n", ']', ']', "\n[", '[', '[', '"', '&#39;', '&#40;', '&#41;'), trim($in));

		$table_ary = array(
			'#\[(tr)(?:\=(.*?))?\](.*?)\[/tr\]#is',
			'#\[(td)(?:\=(.*?))?\](.*?)\[/td\]#is',
		);

		foreach ($table_ary as $table_regex)
		{
			if (preg_match($table_regex, $in))
			{
				$in = preg_replace_callback($table_regex, array($this, 'parse_table_tags'), $in);
			}
		}

		return '<table ' . (($stx) ? 'style="' . $stx . '" ' : '') . 'cellspacing="0" cellpadding="0">' . $in .'</table>';
	}

	/**
	* Callback for parsing the tr and td table tags
	*
	* @param array		$matches
	* @return 			html string
	* @version 3.0.12
	*/
	function parse_table_tags($matches)
	{
		return '<' . $matches[1] . (!empty($matches[2]) ? ' style="' . trim($matches[2]) . '"' : '') . '>' . trim($matches[3]) . '</' . $matches[1] . '>';
	}

	/**
	* Parsing the anchor - Second pass.
	*
	* @param int		$a_id	anchor ID
	* @param string		$a_href	link to go
	* @param string		$string	Some text to display
	* @return 			html string
	* @version 1.0.12
	*/
	function anchor_pass($a_id, $a_href, $string)
	{
		$a_id	= str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($a_id));
		$a_href	= str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($a_href));
		$string	= str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($string));

		// If no id and no href, the bbcode is not well formed
		if (!$a_id && !$a_href)
		{
			return '[anchor= ]' . $string . '[/anchor]';
		}

		// Makes a id
		if (!$a_id)
		{
			global $post_id;
			$a_id = $post_id . $a_href;
		}

		// If it's an anchor
		if ($a_href != '')
		{
			// Fix for SEO MOD : http://www.phpbb-seo.com/en/phpbb-forum/article4493.html#p26303
			$extra = (class_exists('phpbb_seo')) ? 'onclick="document.location.hash = \'' .$a_href . '\'; return false;"' : '';

			return str_replace(array('{ANCHOR_ID}','{ANCHOR_HREF}', '{ANCHOR_TEXT}', '{ANCHOR_EXTRA}'), array($a_id, $a_href, $string, $extra), $this->bbcode_tpl('anchor_link'));
		}
		// Isn't an anchor
		else
		{
			return str_replace(array('{ANCHOR_ID}','{ANCHOR_TEXT}'), array($a_id, $string), $this->bbcode_tpl('anchor_element'));
		}
	}

	/**
	* Code based of : SafeHTML Parser 1.3.7
	* http://www.boonex.com/trac/dolphin/browser/tags/6.1/plugins/safehtml/safehtml.php
	* Updated by MSSTI
	* @version 3.0.7-PL1
	*/
	function safehtml($string)
	{
		// Sometimes users can write tags like m\o\z\-\b\i\n\d\i\n\g, this fix it
		$string = strtolower(str_replace(array("\\", '&#40;', '&#41;', '&amp;'), array("", '(', ')', '&'), $string));

		////
		// You can change this option to your liking, can delete or disable.
		// eg : if you want to disable url use /*'url',*/
		////

		// dangerous protocols
		$blackProtocols = array('url', 'about', 'chrome', 'data', 'disk', 'hcp', 'help', 'javascript', 'livescript', 'lynxcgi', 'lynxexec', 'ms-help', 'ms-its', 'mhtml', 'mocha', 'opera', 'res', 'resource', 'shell', 'vbscript', 'view-source', 'vnd.ms.radio', 'wysiwyg');

		// dangerous CSS keywords
		$cssKeywords = array('absolute', 'behavior', 'behaviour', 'content', 'expression', 'fixed', 'include-source', 'moz-binding', "(", ")", "?", "&");

		$search = array_merge($blackProtocols, $cssKeywords);

		$error = array();
		foreach ($search as $value)
		{
			$tmp_pos = strpos($string, $value);
			if ($tmp_pos !== false)
			{
				$error[] = $value;
				continue;
			}
		}
		return $error;
	}

	/**
	* Parsing the e-links  - Second pass.
	*
	* Inspired in :	MOD Title: eD2k links processing with availability statistics
	* 				MOD Author: Meithar, then updated by Bill Hicks, C0de_m0nkey and DonGato (current maintainer)
	*
	* @param string		$bbcode_id
	* @param string		$var1		ed2k url
	* @param string		$var2		ed2k name
	* @return bbcode 	template replacement
	* @version 3.0.8
	*
	* link eD2k basics					: ed2k://|file|>File Name<|>File size<|>File Hash<|/
	* link eD2k with set of hashes		: ed2k://|file|>File Name<|>File size<|>File Hash<|p=>set of hashes<|/
	* link eD2k with sources			: ed2k://|file|>File Name<|>File size<|>File Hash<|/|sources,>IP:PORT<|/
	* link eD2k with host				: ed2k://|file|>File Name<|>File size<|>File Hash<|/|sources,>Host Name:PORT<|/
	* link eD2k in HTML					: <a href= "ed2k://|file|>File Name<|>File size<|>File Hash<|/">File Name to display</a>
	* link eD2k with HTTP sources		: ed2k://|file|>File Name<|>File size<|>File Hash<|s=http://Web Adress/File|/
	* link eD2k with root hashe			: ed2k://|file|>File Name<|>File size<|>File Hash<|h=>Root hash<|/
	*/
	function ed2k_pass($bbcode_id, $var1, $var2)
	{
		global $user;

		if (empty($this->abbcode_config))
		{
			$this->abbcode_init(false);
		}

		$var1 = str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($var1));
		$var2 = str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($var2));
		$link = str_replace(array(' ', '%20'), array('',''), (($var1) ? $var1 : $var2));

		$ed2k_icon	= $this->abbcode_config['S_ABBC3_PATH'] . '/images/emule.gif';
		$ed2k_stat	= $this->abbcode_config['S_ABBC3_PATH'] . '/images/stats.gif';

		$matches = preg_match_all("#(^|(?<=[^\w\"']))(ed2k://\|(file|server|friend)\|([^\\/\|:<>\*\?\"]+?)\|(\d+?)\|([a-f0-9]{32})\|(.*?)/?)(?![\"'])(?=([,\.]*?[\s<\[])|[,\.]*?$)#i", $link, $match);

		if ($matches)
		{
			foreach ($match[0] as $i => $m)
			{
				$ed2k_link	= (isset($match[2][$i])) ? $match[2][$i] : '';
				// Only for testing propose, commented out so I do not loose the code.
			//	$ed2k_type	= (isset($match[3][$i])) ? $match[3][$i] : '';
				$ed2k_size	= (isset($match[5][$i])) ? $match[5][$i] : '';
				$ed2k_hash	= (isset($match[6][$i])) ? $match[6][$i] : '';

				$max_len	= 100;
				$ed2k_name	= (!$var2) ? (isset($match[4][$i])) ? $match[4][$i] : '' : $var2;

				if (!$var2)
				{
					$ed2k_name	= (strlen($ed2k_name) > $max_len) ? substr($ed2k_name, 0, $max_len - 19) . '...' . substr($ed2k_name, -16) : $ed2k_name;
				}
				return str_replace(array('{ED2K_ICON}', '{ED2K_URL}', '{ED2K_NAME}', '{ED2K_SIZE}', '{ED2K_HASH}', '{ED2K_STAT}'), array($ed2k_icon, $ed2k_link, $ed2k_name, abbc3_ed2k_humanize_size($ed2k_size), $ed2k_hash, $ed2k_stat), $this->bbcode_tpl('ed2k_file'));
			}
		}
		else
		{
			if(preg_match("#(^|(?<=[^\w\"']))(ed2k://\|server\|([\d\.]+?)\|(\d+?)\|/?)#i", $link))
			{
				return preg_replace("#(^|(?<=[^\w\"']))(ed2k://\|server\|([\d\.]+?)\|(\d+?)\|/?)#i", $user->lang['ABBC3_ED2K_SERVER'] . ': <a href="$2" class="postLink">$3:$4</a>', $link);
			}
			// ed2k://|serverlist|url
			else if(preg_match("#(^|(?<=[^\w\"']))(ed2k://\|serverlist\|". get_preg_expression('url') ."\|/?)#i", $link))
			{
				return preg_replace("#(^|(?<=[^\w\"']))(ed2k://\|serverlist\|". get_preg_expression('url') ."\|/?)#i", $user->lang['ABBC3_ED2K_SERVERLIST'] . ': <a href="$2" class="postLink">$2</a>', $link);
			}
			// ed2k://|friend|name|clientIP|clientPort
			else if(preg_match("#(^|(?<=[^\w\"']))(ed2k://\|friend\|([^\\/\|:<>\*\?\"]+?)\|([\d\.]+?)\|(\d+?)\|/?)#i", $link))
			{
				return preg_replace("#(^|(?<=[^\w\"']))(ed2k://\|friend\|([^\\/\|:<>\*\?\"]+?)\|([\d\.]+?)\|(\d+?)\|/?)#i", $user->lang['ABBC3_ED2K_FRIEND'] . ': <a href="$2" class="postLink">$3</a>', $link);
			}
			else
			{
				$var2 = ($var1) ? $var1 : $var2;
				return str_replace('$1', $var1, str_replace('$2', $var2, $this->bbcode_tpl('url', $bbcode_id, true)));
			}
		}
	}

	/**
	* Parsing the serch text - Second pass.
	*
	* @param string		$stx	have search name param?
	* @param string		$in		post text between [search] & [/search]
	* @param string		$search (bing|yahoo|google|altavista|wikipedia|lycos)
	* @return string	link
	* @version 1.0.12
	*/
	function search_pass($stx, $in , $search)
	{
		global $user;

		$search = str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($search));
		$in	 	= str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($in));

		switch ($in)
		{
			case 'bing' :
				$search_link = 'http://www.bing.com/search?q=' . str_replace(' ', '+', $search);
			break;

			case 'yahoo' :
				$search_link = 'http://search.yahoo.com/search?p=' . str_replace(' ', '+', $search);
			break;

			case 'google' :
				$search_link = 'http://www.google.com/search?q=' . str_replace(' ', '+', $search);
			break;

			case 'altavista':
				$search_link = 'http://www.altavista.com/web/results?itag=ody&amp;q=' . str_replace(' ', '+', $search); //&amp;mkt=tr-TR&amp;lf=1
			break;

			case 'wikipedia':
				// by default the search is in English language, but you can customize it,
				// simply replace    ->en<-     with your language prefix for wikipedia :)
				$search_link = 'http://en.wikipedia.org/wiki/Spezial:Search?search=' . str_replace(' ', '%20', $search);
			break;

			case 'lycos':
				$search_link = 'http://search.lycos.com/?query=' . str_replace(' ', '+', $search);
			break;

			default :
				global $config, $phpEx;
				$search_link = 'search.' . $phpEx . '?keywords=' . str_replace(' ', '%20', $search);
				$in = $config['sitename'];
			break;
		}
		return str_replace(array('{SEARCH_SITE}','{SEARCH_TEXT}', '{URL}' ,'{SEARCH_STRING}'), array(strtolower($in), strtolower($user->lang['SEARCH']), $search_link, $search), $this->bbcode_tpl('search'));
	}

	/**
	* Parsing thumbnail images - Second pass.
	*
	* @param string		$stx	align (left|center|right|float-left|float-right)
	* @param string		$in		URL = post text between [thumbnail=(left|center|right|float-left|float-right)] & [/thumbnail]
	* @return string	image
	* @version 3.0.8
	*/
	function thumb_pass($stx, $in)
	{
		global $user;

		if (empty($this->abbcode_config))
		{
			$this->abbcode_init(false);
		}

		$stx = str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($stx));
		$in	 = str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($in));
		$w	 = $this->abbcode_config['ABBC3_MAX_THUM_WIDTH'];

		// If the user choice do not see images, return a link
		if (!$user->optionget('viewimg'))
		{
			return str_replace(array('$1', '$2'), array($in, '[ img ]'), $this->bbcode_tpl('url', -1, true));
		}

		// Check for url_fopen
		if (@ini_get('allow_url_fopen') == '1' || strtolower(@ini_get('allow_url_fopen')) == 'on')
		{
			// Check if we can reach the image
 			$img_filesize = (file_exists($in)) ? @filesize($in) : false;
			if ($img_filesize)
			{
				// check image with timeout to ensure we don't wait quite long
				$timeout = @ini_get('default_socket_timeout');
				@ini_set('default_socket_timeout', 2);
				$dimension = @getimagesize($in);
				@ini_set('default_socket_timeout', $timeout);
				// If the dimensions could be determined check if we need to adjust the size
				if ($dimension !== false || !empty($dimension[0]))
				{
					if ($dimension[0] < $w)
					{
						$w = $dimension[0];
					}
				}
			}
		}

		switch (strtolower($stx))
		{
			case 'float-left':
			case 'float-right':
				$stx = str_replace('float-', '', $stx);
				return str_replace(array('{FLOAT}', '{URL}' ,'{WIDTH}'), array($stx, $in, $w), $this->bbcode_tpl('thumb_float'));
			break;
			// I know the ccs float:center doesn't exist, but just in case ;)
			case 'float-center':
				$stx = str_replace('float-', '', $stx);
			//	no break;
			case 'left':
			case 'right':
			case 'center':
				return str_replace(array('{ALIGN_TYPE}', '{URL}' ,'{WIDTH}'), array($stx, $in, $w), $this->bbcode_tpl('thumb_aligned'));
			break;

			default:
				return str_replace(array('{URL}' ,'{WIDTH}'), array($in, $w), $this->bbcode_tpl('thumb'));
			break;
		}

		// In case everything fails, return it as it was posted
		return "[thumbnail={$stx}]{$in}[/thumbnail]";
	}

	/**
	* Parsing the images aligned - Second pass.
	*
	* @param string		$stx	align (left|center|right|float-left|float-right)
	* @param string		$in		post text between [img=(left|center|right|float-left|float-right)] & [/img]
	* @return string	image
	* @version 3.0.8
	*/
	function img_pass($stx, $in)
	{
		global $user;

		$stx = str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($stx));
		$in	 = str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($in));

		// If the user choice do not see images, return a link
		if (!$user->optionget('viewimg'))
		{
			return str_replace(array('$1', '$2'), array($in, '[ img ]'), $this->bbcode_tpl('url', -1, true));
		}

		switch (strtolower($stx))
		{
			case 'float-left':
			case 'float-right':
				$stx = str_replace('float-', '', $stx);

				if (empty($this->abbcode_config))
				{
					$this->abbcode_init(false);
				}

				if ($this->abbcode_config['S_ABBC3_RESIZE'])
				{
					return str_replace(array('{FLOAT}', '{URL}'), array($stx, $in), $this->bbcode_tpl('img_float_bar'));
					break;
				}
				else
				{
					return str_replace(array('{FLOAT}', '{URL}'), array($stx, $in), $this->bbcode_tpl('img_float'));
					break;
				}
			// no break

			// I know the ccs float:center doesn't exist, but just in case ;)
			case 'float-center':
				$stx = str_replace('float-', '', $stx);
			//	no break;
			case 'left':
			case 'right':
			case 'center':
				return str_replace(array('{ALIGN_TYPE}', '{URL}'), array($stx, $in), $this->bbcode_tpl('img_aligned'));
			break;

			default:
				return str_replace(array('$1'), array($in), $this->bbcode_tpl('img', -1, true));
			break;

		}

		// In case everything fails, return it as it was posted
		return "[img={$stx}]{$in}[/img]";
	}

	/**
	* Parsing the Moderator tag - Second pass.
	*
	* @param string		$stx	have user name param?
	* @param string		$in		post text between [mod] & [/mod]
	* @return string	table with message data
	* @version 3.0.7-PL1
	*/
	function moderator_pass($stx, $in)
	{
		$stx = str_replace(array("\r\n", '\"', '\'', '(', ')', '&quot;'), array("\n", '', '&#39;', '&#40;', '&#41;', ''), trim($stx));
		$in	 = str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($in));

		return str_replace(array('{MOD_USER}', '{MOD_TEXT}'), array($stx, $in), $this->bbcode_tpl('moderator'));
	}

	/**
	* Parsing the offtopic tag - Second pass.
	*
	* @param string		$in		post text between [offtopic] & [/offtopic]
	* @return string	table with message data
	* @version 1.0.11
	*/
	function offtopic_pass($in)
	{
		global $user;

		$in	 = str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($in));
		return str_replace(array('{OFFTOPIC}', '{OFFTOPIC_TEXT}'), array($user->lang['OFFTOPIC'], $in), $this->bbcode_tpl('offtopic'));
	}

	/**
	* Parsing the spoiler tag - Second pass.
	*
	* @param string		$in		post text between [spoil] & [/spoil]
	* @version 3.0.6
	*/
	function spoil_pass($in)
	{
		global $user;

		$in	 = str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($in));
		return str_replace(array('{SPOILER_SHOW}', '{LA_SPOILER_SHOW}', '{LA_SPOILER_HIDE}', '{SPOILER_TEXT}'), array($user->lang['SPOILER_SHOW'], "'" . $user->lang['SPOILER_SHOW'] . "'", "'" . $user->lang['SPOILER_HIDE'] . "'", $in), $this->bbcode_tpl('spoiler'));
	}

	/**
	* Parsing the hidden tag - Second pass.
	* @param string		$in		post text between [hidden] & [/hidden]
	* @version 3.0.6
	*/
	function hidden_pass($in)
	{
		global $user;

		if ($user->data['user_id'] == ANONYMOUS || $user->data['is_bot'])
		{
			return str_replace(array('{HIDDEN_ON}', '{HIDDEN_TEXT}'), array($user->lang['HIDDEN_ON'], $user->lang['HIDDEN_EXPLAIN']), $this->bbcode_tpl('hidden'));
		}
		else
		{
		//	$in	= make_clickable(trim(str_replace('\"', '',preg_replace('#<!-- ([lmwe]) --><a class=(.*?) href=(.*?)>(.*?)</a><!-- ([lmwe]) -->#si','$3',$in))));
			$in	= make_clickable(trim(preg_replace('#<!-- ([lmwe]) --><a.*?href="(.*?)">.*?<\/a><!-- \1 -->#si','$2', $in)));
			$in	= str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($in));
			return str_replace(array('{HIDDEN_OFF}', '{UNHIDDEN_TEXT}'), array($user->lang['HIDDEN_OFF'], $in), $this->bbcode_tpl('unhidden'));
		}
	}

	/**
	* Parsing the NFO text - Second pass.
	*
	* @param string		$in		post text between [nfo] & [/nfo]
	* @return string	table with nfo data
	* @version 1.0.11
	*/
	function nfo_pass($in)
	{
		global $user;

		$in = htmlentities($in, ENT_NOQUOTES, 'UTF-8');
		return str_replace(array('{NFO_TITLE}', '{NFO_TEXT}'), array($user->lang['ABBC3_NFO_TITLE'], str_replace(" ", "&nbsp;", $in)), $this->bbcode_tpl('nfo'));
	}

	/**
	* Parsing the (x)HTML - Second pass.
	*
	* @param string		$in		post text between [html] & [/html]
	* @return string	(x)HTML data
	*
	* THIS FUNTION IS DEPRECATED SINCE VERSION 1.0.11 ! suggested by MOD Team
	* So warn the user about this if he is still using the old database
	*/
	function html_pass($in)
	{
		global $user;

		return sprintf($user->lang['ABBC3_DEPRECATED'], 'html', '1.0.11');
	}

	/**
	* Modifies screenplay format text for inclusion in posts
 	* Code based off :
	*	http://scrippets.org/
	*	http://johnaugust.com/archives/2008/scrippets-php-and-a-call-to-coders
 	* 	Drupal module by Matt Chapman http://drupal.org/user/143172
	* Test :
	* 	http://scrippet.net/wordpress/?p=87#comment-238
	* @version 1.0.12
 	*/
	function scrippets_pass($in)
	{
		$in				= str_replace(array('&#40;', '&#41;'), array('(', ')'), trim($in));
		$theText		= explode("\n", $in);
		$output			= '';
		$dialogueBlock	= false;
		$sceneHeaders	= array('INT', 'EXT', 'EST', 'I/E');
		$transitions	= array('CUT ', 'FADE', 'JUMP');

		foreach($theText as $line)
		{
			$trans = array('<br />' => '', '<p>' => '', '</p>' => '');
			$line = strtr(trim($line), $trans);

			if ($line == '')
			{
				continue;
			}

			// check for parenthical
			if($line[0] == '(')
			{
				$output .= '<p class="parenthetical">' . $line . '</p>';
				$dialogueBlock = true;
				continue;
			}

			// line must be dialogue
			if($dialogueBlock == true)
			{
				$output .= '<p class="dialogue">' . $line . '</p>';
				$dialogueBlock = false;
				continue;
			}

			// must be header, transition, or character
			if($line == strtoupper($line))
			{
				// check for header (INT or EXT or EST)
				if(in_array(substr($line, 0, 3), $sceneHeaders))
				{
					$output .= '<p class="sceneheader">' . $line . '</p>';
				}
				// check for transition (CUT or FADE or JUMP) or any uppercase line ended with a :
				else if(in_array(substr($line, 0, 4), $transitions) || substr($line, -1) === ':')
				{
					$output .= '<p class="transition">' . $line . '</p>';
				}
				// must be character
				else
				{
					$output .= '<p class="character">' . $line . '</p>';
					$dialogueBlock = true;
				}
			}
			// default to action
			else
			{
				$output .= '<p class="action">' . $line . '</p>';
			}
		}
		// Regular Expression Magic!
		$output = str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($output));

		return str_replace('{SCRIPPET_TEXT}', $output, $this->bbcode_tpl('scrippet'));
	}

	/**
	* Enter link checker
	*
	* @param string		$in 	post text between [testlink] &[/testlink]
	* @return string	link with text ok/wrong
	* @version 3.0.8
	*/
	function testlink_pass($in)
	{
		global $user;

		// If hide links is enabled and the user is a guest or a bots, do not display it !
		if ($this->hide_links && ($user->data['user_id'] == ANONYMOUS || $user->data['is_bot']))
		{
			return '<dl class="codebox codecontent" style="display:inline; padding: 0px;"><dd style="display:inline;color:#ff0000">'. $user->lang['LOGIN_EXPLAIN_VIEW'] . '</dd></dl>';
		}

		// Safety Check if CURL is present
		if (!function_exists ('curl_init'))
		{
			// Output an error message
			$linktest_echo = $user->lang['ABBC3_CURL_ERROR'];
		}
		else
		{
			if (empty($this->abbcode_config))
			{
				$this->abbcode_init(false);
			}

			$in	= trim($in);
			$ok_icon	= $this->abbcode_config['S_ABBC3_PATH'] . '/images/ok.gif';
			$error_icon	= $this->abbcode_config['S_ABBC3_PATH'] . '/images/error.gif';

			$linktest		 = new linktest();
			$linktest_links	 = explode("\n", $in);
			$linktest_result = array();
			$linktest_echo	 = '';

			foreach ($linktest_links as $linktest_value)
			{
				if (trim($linktest_value) !== '')
				{
					// undo make_clickable_callback(); and Remove Comments from post content
					$linktest_value	= trim(str_replace('\"', '', preg_replace('#<!-- ([lmwe]) --><a class=(.*?) href=(.*?)>(.*?)</a><!-- ([lmwe]) -->#si', '$3', $linktest_value)));
				//  After made changes in : http://www.phpbb.com/kb/article/links-opening-new-windows/
				//	$linktest_value	= trim(str_replace('\"', '', preg_replace('#<!-- ([lmwe]) --><a class=(.*?) href=(.*?) onclick=(.*?)>(.*?)</a><!-- ([lmwe]) -->#si', '$3', trim($linktest_value))));

					// if there is no scheme, then add http schema
					if (!preg_match('#^[a-z0-9]+://#i', $linktest_value))
					{
						$linktest_value = 'http://' . $linktest_value;
					}
					$linktest_return	= $linktest->test($linktest_value);

					if (!$linktest_return || (sizeof($linktest_return) && $linktest_return[0] === false))
					{
						$linktest_msg	= '<span class="abbc3_wrong">' . $user->lang['ABBC3_TESTLINK_WRONG'] . '</span>';
						$linktest_pic	= '<img src="' . $error_icon . '" style="vertical-align:bottom; padding:2px 0;" class="postimage" alt="' . $user->lang['ABBC3_TESTLINK_WRONG'] . '" title="' . $user->lang['ABBC3_TESTLINK_WRONG'] . '" />';
					}
					else
					{
						$linktest_msg	= '<span class="abbc3_good">' . $user->lang['ABBC3_TESTLINK_GOOD'] . '</span>';
						$linktest_pic	= '<img src="' . $ok_icon . '" style="vertical-align:bottom; padding:2px 0;" class="postimage" alt="' . $user->lang['ABBC3_TESTLINK_GOOD'] .'" title="' . $user->lang['ABBC3_TESTLINK_GOOD'] .'" />';
					}

					$linktest_value		= '<a href="' . $linktest_value . '" onclick="window.open(this.href);return false;" title="' . $linktest_value . '" >' . $linktest_value . '</a>';
					$linktest_result[]	= array('link' => $linktest_value, 'pic' => $linktest_pic, 'msg' => $linktest_msg);
				}
			}

			if (count($linktest_result) > 0)
			{
				foreach ($linktest_result as $linktest_data)
				{
					// If img_links is enabled use images, else use string
					$linktest_echo .= (($this->img_links) ? $linktest_data['pic'] . '&nbsp;' . $linktest_data['link'] : $linktest_data['link'] . '&nbsp;' . $linktest_data['msg']) . '<br />';
				}
			}
			unset($linktest, $linktest_result);
		}
		return '<dl class="testlink"><dd>'. $linktest_echo . '</dd></dl>';
	}

	/**
	* Enter rapidshare checker
	*
	* @param string		$in 	post text between [rapidshare] &[/rapidshare]
	* @return string	link with text ok/wrong
	* @version 3.0.12
	*/
	function rapidshare_pass($in)
	{
		global $user;

		// If hide links is enabled and the user is a guest or a bots, do not display it !
		if ($this->hide_links && ($user->data['user_id'] == ANONYMOUS || $user->data['is_bot']))
		{
			return '<dl class="codebox codecontent" style="display:inline; padding: 0px;"><dd style="display:inline;color:#ff0000">'. $user->lang['LOGIN_EXPLAIN_VIEW'] . '</dd></dl>';
		}

		if (empty($this->abbcode_config))
		{
			$this->abbcode_init(false);
		}

		$in = trim($in);
		$ok_icon	= $this->abbcode_config['S_ABBC3_PATH'] . '/images/ok.gif';
		$error_icon	= $this->abbcode_config['S_ABBC3_PATH'] . '/images/error.gif';
		$rapidshare_echo = '';

		// only 1 link allowed at a time. Display as broken bbcode if multiple links found
		$rapidshare_links = explode("\n", $in);
		if (sizeof($rapidshare_links) > 1)
		{
			// undo make_clickable_callback(); and Remove Comments from post content
			return '[rapidshare]' . str_replace('\"', '', preg_replace('#<!-- ([lmwe]) --><a class=(.*?) href=(.*?)>(.*?)</a><!-- ([lmwe]) -->#si','$3', $in)) . '[/rapidshare]';
		}

		$rapidshare_link = '<a href="' . $in . '" title="' . $in . '" onclick="window.open(this.href);return false;">' . $in . '</a>';
		$rapidshare_msg  = '<span class="abbc3_wrong">' . $user->lang['ABBC3_RAPIDSHARE_WRONG'] . '</span>';
		$rapidshare_pic  = '<img src="' . $error_icon . '" style="vertical-align:bottom; padding:2px 0;" class="postimage" alt="' . $user->lang['ABBC3_RAPIDSHARE_WRONG'] . '" title="' . $user->lang['ABBC3_RAPIDSHARE_WRONG'] . '" />';

		// get fileid and filename from the rapidshare url
		preg_match('/https?:\/\/(?:www.)?rapidshare.com\/.*\/([\d]+)\/(.*)/', $in, $matches);
		$rs_file_id = $matches[1];
		$rs_file_name = $matches[2];
		$rs_api_url = 'http://api.rapidshare.com/cgi-bin/rsapi.cgi?sub=checkfiles&files=' . $rs_file_id . '&filenames=' . $rs_file_name;

		// check if the file exists at rapidshare
		if (function_exists ('curl_init'))
		{
			$curl = curl_init($rs_api_url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_TIMEOUT, 30);
			$rapidshare_check = curl_exec($curl);
			curl_close($curl);
		}
		else
		{
			$rapidshare_check = @file_get_contents($rs_api_url);
		}

		if ($rapidshare_check !== false)
		{
			$resp_arr = explode(',', $rapidshare_check);
			if($resp_arr[4] == 1) // 1=File OK (Anonymous downloading)
			{
				$rapidshare_msg = '<span class="abbc3_good">' . $user->lang['ABBC3_RAPIDSHARE_GOOD'] . '</span>';
				$rapidshare_pic = '<img src="' . $ok_icon . '" style="vertical-align:bottom; padding:2px 0;" class="postimage" alt="' . $user->lang['ABBC3_RAPIDSHARE_GOOD'] . '" title="' . $user->lang['ABBC3_RAPIDSHARE_GOOD'] . '" />';
			}
		}

		// If img_links is enabled use images, else use string
		$rapidshare_echo .= (($this->img_links) ? $rapidshare_pic . '&nbsp;' . $rapidshare_link : $rapidshare_link . '&nbsp;' . $rapidshare_msg) . '<br />';

		return '<dl class="testlink"><dd>'. $rapidshare_echo . '</dd></dl>';
	}

	/**
	* Count the number of click on a link or image
	*
	* @param string		$var1	post text after [click(=(.*))]
	* @param string		$var2	post text between [click] &[/click]
	* @return string	link or none
	* @version 1.0.11
	*/
	function click_pass($var1, $var2)
	{
		global $db, $user, $phpbb_root_path, $phpEx;

		$var1 = str_replace("\r\n", "\n", str_replace('\"', '"', trim($var1)));
		$var2 = str_replace("\r\n", "\n", str_replace('\"', '"', trim($var2)));

		$url = ($var1) ? $var1 : $var2;

		if ($var1 && !$var2)
		{
			$var2 = $var1;
		}

		if (!$url)
		{
			return '[click' . (($var1) ? '=' . $var1 : '') . ']' . $var2 . '[/click]';
		}

		$valid = false;

		$url = str_replace(' ', '%20', $url);

		// Checking urls
		if (preg_match('#^' . get_preg_expression('url') . '$#i', $url) ||
			preg_match('#^' . get_preg_expression('www_url') . '$#i', $url) ||
			preg_match('#^' . preg_quote(generate_board_url(), '#') . get_preg_expression('relative_url') . '$#i', $url))
		{
			$valid	= true;
			$data	= array(
				'url' => str_replace(array('&#58;', '&#46;'), array(':', '.'), addslashes($url)),
			);
		}

		// Checking image urls/src
		if (preg_match("#<img((.*?))\/>#si", $url))
		{
			$valid	= true;
			$url	= str_replace('%20 ', ' ', $var2);
			$data	= array(
				'url' => preg_replace('#<img src="(.*?)"((.*?))\/>#si', '$1', $var2),
			);
		}

		if ($valid)
		{
			$sql = 'SELECT id, clicks FROM ' . CLICKS_TABLE . ' WHERE ' . $db->sql_build_array('SELECT', $data);
			$result = $db->sql_query($sql);

			if($row = $db->sql_fetchrow($result))
			{
				$clicks_id = $row['id'];
				$clicks_val= $row['clicks'];
			}
			else
			{
				$sql = 'INSERT INTO ' . CLICKS_TABLE . ' ' . $db->sql_build_array('INSERT', $data);
				$db->sql_query($sql);

				$clicks_id = $db->sql_nextid();
				$clicks_val= '0';
			}
			$db->sql_freeresult($result);

			$user->add_lang('mods/abbcode');
			// Link to ABBC3 simple redirect page
			$redirect = append_sid("{$phpbb_root_path}abbcode_page.$phpEx", "mode=click&amp;id=$clicks_id");
			return '<a href="' . $redirect . '" onclick="window.open(this.href); return false;" onkeypress="window.open(this.href); return false;" >' . (($var1) ? $var2 : $url) . '</a> ' . sprintf((($clicks_val == 1) ? $user->lang['ABBC3_CLICK_TIME'] : $user->lang['ABBC3_CLICK_TIMES']), $clicks_val);
		}
		return '[click' . (($var1) ? '=' . $var1 : '') . ']' . $var2 . '[/click]';
	}

	/**
	* Enter description here...
	* Code based off :
	* 	http://pirex.com.br/wordpress-plugins/post-tabs/
	* 	http://labs.komrade.gr/simpletabs/
	* @param string		$in 	post text between [tabs] &[/tabs]
	* @return string	html code
	* @version 1.0.12
	*/
	function simpleTabs_pass($in)
	{
		static $postTabs_pass;
		// Only remove the initial new line
		$posttext	= str_replace(array("]\r\n", "]\r", "]\n", '\"', '\'', '(', ')'), array("]\n", ']', ']', '"', '&#39;', '&#40;', '&#41;'), trim($in));
	//	$posttext	= str_replace(array("\r\n", "\r", "\n", '\"', '\'', '(', ')'), array("\n", '', '', '"', '&#39;', '&#40;', '&#41;'), trim($in));
	//	$posttext	= str_replace(array('\"', '\'', '(', ')'), array('"', '&#39;', '&#40;', '&#41;'), trim($in));
		$tag		= '[tabs:';
		$offset		= 0;

		// Search for tabs inside the post
		if (is_int(strpos($posttext, $tag, $offset)))
		{
			$postTabs_pass++;

			// Reset some default data
			$output_start		= '';
			$output				= '';
			$output_rest		= '';
			$vai				= true;
			$results_i			= array();
			$results_f			= array();
			$results_t			= array();

			// Find the begining, the end and the title for the tabs
			while ($vai)
			{
				$r = strpos($posttext, $tag, $offset);
				if (is_int($r))
				{
					array_push($results_i, $r);
					$offset = $r + 1;
					$f = strpos($posttext, ']', $offset);
					if ($f)
					{
						array_push($results_f, $f);
						// Deleting the $tag fom the title
						array_push($results_t, substr($posttext, $r+6, $f-($r+6)));
					}
				}
				else
				{
					$vai = false;
				}
			};
			$results_t_size = sizeof($results_t);

			// If there is text before the first tab, print it
			If ($results_i[0] > 0)
			{
				$output_start .= substr($posttext, 0, $results_i[0]);
			}

			$output .= '<div class="simpleTabs">';

			// Print the list of tabs
			$output .= '<ul class="simpleTabsNavigation">';
			for ($x = 0; $x < $results_t_size; $x++)
			{
				if(strtoupper($results_t[$x]) != 'END')
				{
					$output .= '<li><a href="#">' . $results_t[$x] .'</a></li>';
				}
			}

			$output .= '</ul>';
			// Print tabs content
			for ($x = 0; $x < $results_t_size; $x++)
			{
				// If tab title is END, just print the rest of the post
				if (strtoupper($results_t[$x]) == 'END')
				{
					// If there is text after the last tab, print it
					$output_rest .= substr($posttext, $results_f[$x] + 1);
					break;
				}
				$output .= '<div class="simpleTabsContent">';

				// This is the hidden title that only shows up on RSS feed or somewhere outside the context like a print page
				$output .= '<span class="simpleTabsTitles"><strong>' . $results_t[$x] .'&nbsp;:</strong>&nbsp;</span>';
				if ($results_t_size - $x == 1)
				{
					$output .= substr($posttext, $results_f[$x] + 1);
				}
				else
				{
					$output .= substr($posttext, $results_f[$x] + 1, $results_i[$x + 1] - $results_f[$x] -1);
				}
				$output .= '</div>';
			}
			$output .= '</div>';

			return $output_start . $output . $output_rest;
		}
		else
		{
			return $posttext;
		}
	}

	/**
	* Parsing the flash - Second pass.
	*
	* @param string		$width	value for video width
	* @param string		$height value for video Height
	* @return string	$link	value for video url
	* @version 3.0.8
	*/
	function flash_pass($width = 0, $height = 0, $link = '')
	{
		if ($link)
		{
			global $user;

			if (!$user->optionget('viewflash'))
			{
				return str_replace(array('$1', '$2'), array($link, '[ flash ]'), $this->bbcode_tpl('url', -1, true));
			}

			if (!$width || !$height)
			{
				if (empty($this->abbcode_config))
				{
					$this->abbcode_init(false);
				}
				$width = ($width) ? $width : $this->abbcode_config['ABBC3_VIDEO_WIDTH'];
				$height = ($height) ? $height : $this->abbcode_config['ABBC3_VIDEO_HEIGHT'];
			}
			return $this->auto_embed_video($link, $width, $height);
		}
		// In case everything fails, bbcode will take care of it ;)
	}

	/**
	* Parse text decoration effect
	*
	* @param string		$effect		(glow|shadow|dropshadow|blur|wave)
	* @param string		$colour		html colors
	* @param string		$in			post text between [glow]&[/glow] | [shadow]&[/shadow] | [dropshadow]&[/dropshadow] | [blur]&[/blur] | [wave]&[/wave]
	* @return string
	* @version 3.0.8
	*/
	function Text_effect_pass($effect, $colour, $in)
	{
		global $user;

		$effect = ucfirst(strtolower(trim($effect)));
		$colour = str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($colour));
		$in	 	= str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($in));
		$is_ie	= (strpos(strtolower($user->browser), 'msie') !== false);
		$style	= "display: inline-block; padding: " . (($is_ie) ? "0 0.2em; " : "0 0.5em; ");
		$shadow_colour = '#999999'; //  Default text shadow color #999999. You can change to another colour if desired.

		switch (strtoupper($effect))
		{
			case 'GLOW' :
				$style .= ($is_ie) ? "filter: glow(color=$colour, strength=4); color: #ffffff;" : "color: #ffffff; text-shadow: 0 0 1.0em $colour, 0 0 1.0em $colour, 0 0 1.2em $colour;";
			break;

			case 'SHADOW' :
				$style .= ($is_ie) ? "filter: shadow(color=$shadow_colour, strength=4); color:$colour;" : "color : $colour; text-shadow: -0.2em 0.2em 0.2em $shadow_colour;";
			break;

			case 'DROPSHADOW' :
				$style .= ($is_ie) ? "filter: dropshadow(color=$shadow_colour, strength=4); color:$colour;" : "color : $colour; text-shadow: -0.1em 0.1em 0.05em $shadow_colour;";
			break;

			case 'BLUR' :
				$style .= ($is_ie) ? "filter: blur(strength=7); color:$colour;" : "color: transparent; text-shadow: 0 0 0.2em $colour;";
			break;

			case 'WAVE' :
				$style .= ($is_ie) ? "filter: wave(strength=2); color: $colour;" : "";
			break;

			default:
				return '[' . $effect . '=' . $colour . ']' . $in . '[/' . $effect . ']';
			// no break
		}
		return str_replace(array('{CLASS}', '{STYLE}', '{TEXT}'), array($effect, $style, $in), $this->bbcode_tpl('decoration'));
	}

	/**
	* Initialize Video array
	* @version 3.0.8
	*/
	function video_init()
	{
		global $user;

		// Patterns and replacements for BBVIDEO bbcode processing
		return array(
			'video' => array(),
			'5min.com' => array(
				'id'		=> 41,
				'image'		=> '5min.gif',
				'example'	=> 'http://www.5min.com/Video/iPad-to-Embrace-New-Name-517297508',
				'match'		=> '#http://(?:.*)?5min.com/Video/(?:.*)-([0-9]+)#si',
				'replace'	=> 'http://embed.5min.com/$1/',
				'method'	=> 'flash',
			),
			'allocine.fr' => array(
				'id'		=> 46,
				'image'		=> 'allocine.gif',
				'example'	=> 'http://www.allocine.fr/video/player_gen_cmedia=19149857&cfilm=126693.html',
				'match'		=> '#http://www.allocine.fr/video/player_gen_cmedia=(\d+)?([^[]*)?#si',
				'replace'	=> '<iframe src="http://www.allocine.fr/_video/iblogvision.aspx?cmedia=$1" style="width:{WIDTH}px; height:{HEIGHT}px" frameborder="0"></iframe>',
			),
			'on.aol.com' => array(
				'id'		=> 58,
				'image'		=> 'onaol.gif',
				'example'	=> 'http://on.aol.com/video/ipad-to-embrace-new-name-517297508',
				'match'		=> '#http://on.aol.com/video/(?:.*)-([0-9]+)#si',
				'replace'	=> '<script type="text/javascript" src="http://pshared.5min.com/Scripts/PlayerSeed.js?sid=203&amp;width={WIDTH}&amp;height={HEIGHT}&amp;shuffle=0&amp;playList=$1"></script>',
			),
			'blip.tv' => array(
				'id'		=> 52,
				'image'		=> 'bliptv.gif',
				'example'	=> 'http://blip.tv/disenchanted/disenchanted-ep-101-once-upon-a-crackhouse-6063266',
				'match'		=> '#http://(.*?)blip.tv/([^[]*)?#si',
				'replace'	=> 'http://blip.tv/oembed/?url=$0&format=json',
				'method'	=> 'oEmbed',
			),
			'break.com' => array(
				'id'		=> 21,
				'image'		=> 'break.gif',
				'example'	=> 'http://www.break.com/index/wakeboarding-boss-level-2315925',
				'match'		=> '#http://(.*?)break.com/([^[]*)?-([0-9]+)?([^[]*)?#si',
				'replace'	=> 'http://embed.break.com/$3',
				'method'	=> 'flash',
			),
			'clipfish.de' => array(
				'id'		=> 2,
				'image'		=> 'clipfish.gif',
				'example'	=> 'http://www.clipfish.de/video/1856437/ac-dc-tnt/',
				'match'		=> '#http:\/\/www.clipfish.de\/(.*\/)?video\/([0-9]+)([^[]*)?#si',
				'replace'	=> 'http://www.clipfish.de/cfng/flash/clipfish_player_3.swf?as=0&vid=$2',
				'method'	=> 'flash',
			),
			'clipmoon.com' => array(
				'id'		=> 3,
				'image'		=> 'clipmoon.gif',
				'example'	=> 'http://www.clipmoon.com/videos/9194d9/animation-versus-animator.html',
				'match'		=> '#http://www.clipmoon.com/(.*?)/(([0-9A-Za-z-_]+)([0-9A-Za-z-_]{2}))/([^[]*)#si',
				'replace'	=> 'http://www.clipmoon.com/flvplayer.swf?config=http://www.clipmoon.com/flvplayer.php?viewkey=$2&external=yes&vimg=http://www.clipmoon.com/thumb/$3.jpg',
				'method'	=> 'flash',
			),
			'cnbc.com' => array(
				'id'		=> 47,
				'image'		=> 'nbc.gif',
				'example'	=> 'http://video.cnbc.com/gallery/?video=1548022077&play=1',
				'match'		=> '#http://.*\.cnbc.com/[^?]+\?video=(\d+)?[^[]*?#si',
				'replace'	=> '<iframe src="http://player.theplatform.com/p/gZWlPC/vcps_inline?byGuid=$1&size={WIDTH}_{HEIGHT}" width="{WIDTH}" height="{HEIGHT}" type="application/x-shockwave-flash" allowFullScreen="true"></iframe>',
			),
			'cnettv.cnet.com' => array(
				'id'		=> 27,
				'image'		=> 'cnet.gif',
				'example'	=> 'http://cnettv.cnet.com/kinect-controlled-motorized-skateboard/9742-1_53-50118306.html',
				'match'		=> '#http://cnettv\.cnet\.com/[a-z0-9\-]*\/[0-9]{4}-[0-9]_[0-9]{2}-([0-9]{5,9})\.html#si',
				'replace'	=> 'http://www.cnet.com/av/video/embed/player.swf',
				'method'	=> 'flash',
				'flashvars'	=> 'playerType=embedded&type=id&value=$1',
			),
			'colbertnation.com' => array(
				'id'		=> 63,
				'image'		=> 'comedycentral.gif',
				'example'	=> 'http://www.colbertnation.com/the-colbert-report-videos/180900/october-17-2005/intro---10-17-05',
				'match'		=> '#http://(?:.*?)colbertnation.com/the-colbert-report-videos/([0-9]+)/([^[]*)?#si',
				'replace'	=> '<iframe src="http://media.mtvnservices.com/embed/mgid:cms:video:colbertnation.com:$1" width="{WIDTH}" height="{HEIGHT}" frameborder="0"></iframe>',
			),
			'collegehumor.com' => array(
				'id'		=> 4,
				'image'		=> 'collegehumor.gif',
				'example'	=> 'http://www.collegehumor.com/video/6747386/skyrim-hoarders',
				'match'		=> '#http://www.collegehumor.com/video/([0-9]+)/([^[]*)#si',
				'replace'	=> '<iframe src="http://www.collegehumor.com/e/$1" width="{WIDTH}" height="{HEIGHT}" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>',
			),
			'comedycentral.com' => array(
				'id'		=> 1,
				'image'		=> 'comedycentral.gif',
				'example'	=> 'http://www.comedycentral.com/video-clips/l56fcp/futurama-trashy-robo-sluts',
				'match'		=> '#http://(?:.*?)comedycentral.com/video-clips/([^[]*)?#si',
				'replace'	=> '<div id="embed_{ID}"><script type="text/javascript">ogpEmbedVideo.init("$0", "{WIDTH}", "{HEIGHT}", "embed_{ID}");</script></div>',
			),
			'crackle.com' => array(
				'id'		=> 5,
				'image'		=> 'crackle.gif',
				'example'	=> 'http://www.crackle.com/c/The_Walking_Dead/TS-19/2483060/',
				'match'		=> '#http://((.*?)?)crackle.com/(.*?)/(.*?)/(.*?)/([0-9]+)?([^[]*)?#si',
				'replace'	=> 'http://www.crackle.com/p/$4/$5.swf',
				'method'	=> 'flash',
				'flashvars'	=> 'id=$6&mu=0&ap=0',
			),
			'dailymotion.com' => array(
				'id'		=> 6,
				'image'		=> 'dailymotion.gif',
				'example'	=> 'https://www.dailymotion.com/video/x4ez1x_alberto-contra-el-heliocentrismo_sport',
				'match'		=> '#https?:\/\/(?:.*?)dailymotion.com(?:.*?)\/video\/(([^[_]*)?([^[]*)?)?#si',
				'replace'	=> '<iframe frameborder="0" width="{WIDTH}" height="{HEIGHT}" src="//www.dailymotion.com/embed/video/$2"></iframe>',
			),
			'dotsub.com' => array(
				'id'		=> 60,
				'image'		=> 'dotsub.gif',
				'example'	=> 'http://dotsub.com/view/6a7db231-4d64-407d-8026-a845eaf6c4a9',
				'match'		=> '#http://dotsub.com/view/(.*)#si',
				'replace'	=> '<iframe src="http://dotsub.com/media/$1/embed/" frameborder="0" width="{WIDTH}" height="{HEIGHT}"></iframe>',
			),
			'ebaumsworld.com' => array(
				'id'		=> 32,
				'image'		=> 'ebaumsworld.gif',
				'example'	=> 'http://www.ebaumsworld.com/video/watch/82424906/',
				'match'		=> '#http://(.*?)ebaumsworld.com/video/watch/(.*?)/#si',
				'replace'	=> '<iframe src="http://www.ebaumsworld.com/media/embed/$2" width="{WIDTH}" height="{HEIGHT}" frameborder="0"></iframe>',
			),
			'facebook.com' => array(
				'id'		=> 50,
				'image'		=> 'facebook.gif',
				'example'	=> 'https://www.facebook.com/photo.php?v=2031763147233',
				'match'		=> '#https?://www.facebook.com/(?:.*)(video|photo).php\?v=([0-9A-Za-z-_]+)?(?:[^[]*)?#si',
				'replace'	=> '<iframe src="https://www.facebook.com/video/embed?video_id=$2" width="{WIDTH}" height="{HEIGHT}" frameborder="0"></iframe>',
			),
			'flickr.com' => array(
				'id'		=> 19,
				'image'		=> 'flickr.gif',
				'example'	=> 'http://www.flickr.com/photos/chrismar/3071009125',
				'match'		=> '#http://((.*?)?)flickr.com/(.*?)/(.*?)/([0-9]+)([^[]*)?#si',
				'replace'	=> 'http://www.flickr.com/services/oembed/?url=$0&format=json',
				'method'	=> 'oEmbed',
			),
			'funnyordie.com' => array(
				'id'		=> 20,
				'image'		=> 'funnyordie.gif',
				'example'	=> 'http://www.funnyordie.com/videos/5ef1adb57b/between-two-ferns-with-zach-galifianakis',
				'match'		=> '#http://(?:.*?)funnyordie.com/(.*?)/(.*?)/(?:[^[]*)?#si',
				'replace'	=> '<iframe src="http://www.funnyordie.com/embed/$2" width="{WIDTH}" height="{HEIGHT}" frameborder="0"></iframe>',
			),
			'g4tv.com' => array(
				'id'		=> 7,
				'image'		=> 'g4tv.gif',
				'example'	=> 'http://g4tv.com/videos/29265/Infamous-All-Access/',
				'match'		=> '#http://(?:www\.)?g4tv.com/(.*?videos)/([0-9]+)/([^[]*)?#si',
				'replace'	=> 'http://www.g4tv.com/lv3/$2',
				'method'	=> 'flash',
			),
			'gameprotv.com' => array(
				'id'		=> 9,
				'image'		=> 'gameprotv.gif',
				'example'	=> 'http://www.gameprotv.com/socom-4-us-navy-seals-trailer-video-6923.html',
				'match'		=> '#http://www.gameprotv.com/(.*)-video-([0-9]+)?.([^[]*)?#si',
				'replace'	=> 'http://www.gameprotv.com/player-viral.swf',
				'method'	=> 'flash',
				'flashvars'	=> 'file=http%3A%2F%2Fvideos.gameprotv.com%2Fvideos%2F$2.flv&linktarget=_self&image=http%3A%2F%2Fvideos.gameprotv.com%2Fvideos%2F$2.jpg&plugins=adtonomy,viral-1',
			),
			'gamespot.com' => array(
				'id'		=> 10,
				'image'		=> 'gamespot.gif',
				'example'	=> 'http://www.gamespot.com/video/928334/6185856/lost-odyssey-official-trailer-8',
				'match'		=> '#http://www.gamespot.com.*?(\d{7}?)([^[]*)?#si',
				'replace'	=> '<iframe width="{WIDTH}" height="{HEIGHT}" src="http://www.gamespot.com/videoembed/$1&mapp=false&ads=0&onsite=0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>',
			),
			'gametrailers.com' => array(
				'id'		=> 14,
				'image'		=> 'gametrailers.gif',
				'example'	=> 'http://www.gametrailers.com/videos/j3gx9q/facebreaker-world-premiere-exclusive-debut',
				'match'		=> '#http://www.gametrailers.com/(?:user\-movie|player|video|videos)/([\w\-]+)\/([\w\-]+).*#si',
				'replace'	=> '<div id="embed_{ID}"><script type="text/javascript">ogpEmbedVideo.init("$0", "{WIDTH}", "{HEIGHT}", "embed_{ID}");</script></div>',
			),
			'gamevideos.1up' => array(
				'id'		=> 15,
				'image'		=> 'gamevideos.gif',
				'example'	=> 'http://gamevideos.1up.com/video/id/17766',
				'match'		=> '#http://(?:www.)?gamevideos(?:.*?).com/video/id/([^[]*)?#si',
				'replace'	=> 'http://gamevideos.1up.com/swf/gamevideos12.swf?embedded=1&fullscreen=1&autoplay=0&src=http://gamevideos.1up.com/do/videoListXML%3Fid%3D$1%26adPlay%3Dfalse',
				'method'	=> 'flash',
			),
			'godtube.com' => array(
				'id'		=> 33,
				'image'		=> 'godtube.gif',
				'example'	=> 'http://www.godtube.com/watch/?v=9JJBE1NU',
				'match'		=> '#http://www.godtube.com/watch/\?v=([^[]*)?#si',
				'replace'	=> '<script type="text/javascript" src="http://www.godtube.com/embed/source/$1.js?w={WIDTH}&amp;h={HEIGHT}&amp;ap=false&amp;sl=false&amp;title=false"></script>',
			),
			'howcast.com' => array(
				'id'		=> 28,
				'image'		=> 'howcast.gif',
				'example'	=> 'http://www.howcast.com/videos/499089-How-to-Draw-Manga-How-to-Draw-Monsters',
				'match'		=> '#http://(.*?)howcast.com/videos/([0-9]+)?-([^[]*)?#si',
				'replace'	=> 'http://www.howcast.com/flash/howcast_player.swf?file=$2&theme=black',
				'method'	=> 'flash',
				'flashvars'	=> '&fs=true',
			),
			'hulu.com' => array(
				'id'		=> 53,
				'image'		=> 'hulu.gif',
				'example'	=> 'http://www.hulu.com/watch/675715',
				'match'		=> '#http://(.*?)hulu.com/([^[]*)?#si',
				'replace'	=> 'http://www.hulu.com/api/oembed?url=$0&format=json',
				'method'	=> 'oEmbed',
			),
			'ign.com' => array(
				'id'		=> 16,
				'image'		=> 'ign.gif',
				'example'	=> 'http://www.ign.com/videos/2012/04/05/double-dragon-neon-gameplay-trailer',
				'match'		=> '#http://(.*?)ign\.com/videos/([0-9]+)/([0-9]+)/([0-9]+)/([^?]*)?([^[]*)?#si',
				'replace'	=> '<iframe src="http://widgets.ign.com/video/embed/content.html?url=$0" width="{WIDTH}" height="{HEIGHT}" scrolling="no" frameborder="0" allowfullscreen></iframe>',
			),
			'liveleak.com' => array(
				'id'		=> 18,
				'image'		=> 'liveleak.gif',
				'example'	=> 'http://www.liveleak.com/view?i=166_1194290849',
				'match'		=> '#http://www.liveleak.com/view\?i=([0-9A-Za-z-_]+)?(&[^/]+)?#si',
				'replace'	=> '<iframe width="{WIDTH}" height="{HEIGHT}" src="http://www.liveleak.com/ll_embed?f=$1" frameborder="0" allowfullscreen></iframe>',
			),
			'metacafe.com' => array(
				'id'		=> 22,
				'image'		=> 'metacafe.gif',
				'example'	=> 'http://www.metacafe.com/watch/966360/merry_christmas_with_crazy_frog/',
				'match'		=> '#http://www.metacafe.com/watch/([0-9]+)?((/[^/]+)/?)?#si',
				'replace'	=> '<iframe src="http://www.metacafe.com/embed/$1/" width="{WIDTH}" height="{HEIGHT}" allowFullScreen frameborder=0></iframe>',
			),
			'moddb.com' => array(
				'id'		=> 59,
				'image'		=> 'moddb.gif',
				'example'	=> 'http://www.moddb.com/groups/humour-satire-parody/videos/flight-dc132-part-1',
				'match'		=> '#http://www.moddb.com/([^[]*)?#si',
				'replace'	=> '<div id="embed_{ID}"><script type="text/javascript">ogpEmbedVideo.init("$0", "{WIDTH}", "{HEIGHT}", "embed_{ID}");</script></div>',
			),
			'mpora.com' => array(
				'id'		=> 24,
				'image'		=> 'mpora.gif',
				'example'	=> 'http://mpora.com/videos/AAdihftgw4t7',
				'match'		=> '#http://(?:.*?)mpora.com/(?:.*?)/([^/]+)?#si',
				'replace'	=> '<iframe width="{WIDTH}" height="{HEIGHT}" src="http://mpora.com/videos/$1/embed" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>',
			),
			'msnbc.msn.com' => array(
				'id'		=> 48,
				'image'		=> 'nbc.gif',
				'example'	=> 'http://www.msnbc.msn.com/id/21134540/vp/41172078#41190910',
				'match'		=> '#http://www.msnbc.msn.com/id/(\d+)?/vp/(\d+)?\#(\d+)?([^[]*)?#si',
				'replace'	=> 'http://www.msnbc.msn.com/id/32545640',
				'method'	=> 'flash',
				'flashvars'	=> 'launch=$3&width={WIDTH}&height={HEIGHT}',
			),
			'myspace.com' => array(
				'id'		=> 51,
				'image'		=> 'vidsmyspace.gif',
				'example'	=> 'https://myspace.com/jasonmraz/video/-quot-lucky-quot-official-video-with-colbie-caillat/49776296',
				'match'		=> '#http(s)?://(www.)?myspace.com/.*/video/(.*)/([0-9]+)?#si',
				'replace'	=> '<iframe width="{WIDTH}" height="{HEIGHT}" src="http$1://myspace.com/play/video/$3-$4-$4" frameborder="0" allowtransparency="true" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>',
			),
			'myvideo.de' => array(
				'id'		=> 25,
				'image'		=> 'myvideo.gif',
				'example'	=> 'http://www.myvideo.de/watch/2668372',
				'match'		=> '#http://(.*?).myvideo.(.*?)/(.*?)/([^[]*)?#si',
				'replace'	=> '<iframe src="http://$1.myvideo.$2/embed/$4" style="width:{WIDTH}px;height:{HEIGHT}px;border:0 none;padding:0;margin:0;" width="{WIDTH}" height="{HEIGHT}" frameborder="0" scrolling="no"></iframe>',
			),
			'photobucket.com' => array(
				'id'		=> 26,
				'image'		=> 'photobucket.gif',
				'example'	=> 'http://s0006.photobucket.com/albums/0006/pbhomepage/Ice%20Age/?action=view&current=TFEIT301100-H264_Oct27.mp4',
				'match'		=> '#http://s(.*?).photobucket.com/(albums/[^[]*\/([0-9A-Za-z-_ ]*)?)?([^[]*=)+?([^[]*)?#si',
				'replace'	=> 'http://static.photobucket.com/player.swf?file=http://vid$1.photobucket.com/$2$5',
				'method'	=> 'flash',
			),
			'revision3.com' => array(
				'id'		=> 54,
				'image'		=> 'revision3.gif',
				'example'	=> 'http://revision3.com/scamschool/fortheladies2',
				'match'		=> '#http:\/\/(.*revision3\.com\/.*)#si',
				'replace'	=> 'http://revision3.com/api/oembed/?url=$0&format=json',
				'method'	=> 'oEmbed',
			),
			'rutube.ru' => array(
				'id'		=> 29,
				'image'		=> 'rutube.gif',
				'example'	=> 'http://rutube.ru/video/238973b0c167d0a9f4f26686e42407e4/',
				'match'		=> '#http://rutube.ru/(.*?)/([^[]*)?#si',
				'replace'	=> 'http://rutube.ru/api/oembed/?format=json&url=$0',
				'method'	=> 'oEmbed',
			),
			'sapo.pt' => array(
				'id'		=> 30,
				'image'		=> 'sapo.gif',
				'example'	=> 'http://videos.sapo.pt/LguPabwSWikK0wzBmU1o',
				'match'		=> '#http://(.*?)sapo.pt/(.*/)?([^[]*)?#si',
				'replace'	=> '<iframe src="http://videos.sapo.pt/playhtml?file=http://rd3.videos.sapo.pt/$3/mov/1" frameborder="0" scrolling="no" width="{WIDTH}" height="{HEIGHT}"></iframe>',
			),
			'screenr.com' => array(
				'id'		=> 17,
				'image'		=> 'screenr.gif',
				'example'	=> 'http://www.screenr.com/fTK',
				'match'		=> '#http://(?:.*?)\.screenr.com/([^[]*)?#si',
				'replace'	=> '<iframe src="http://www.screenr.com/embed/$1" width="{WIDTH}" height="{HEIGHT}" frameborder="0"></iframe>',
			),
			'scribd.com' => array(
				'id'		=> 45,
				'image'		=> 'scribd.gif',
				'example'	=> 'http://www.scribd.com/doc/26886617/Dexter-Investigating-Cutting-Edge-Television',
				'match'		=> '#https?:\/\/(?:www\.)?scribd\.com\/(mobile\/documents|doc)\/(.*?)\/([^[]*)?#si',
				'replace'	=> 'http://www.scribd.com/services/oembed?url=$0&format=json',
				'method'	=> 'oEmbed',
			),
			'sevenload.com' => array(
				'id'		=> 31,
				'image'		=> 'sevenload.gif',
				'example'	=> 'http://www.sevenload.com/videos/moskovskii-most-po-vantam-5129e95932b0c28c55000079',
				'match'		=> '#http://(?:.*?)\.sevenload.com/(?:.*?)(?:episodes|videos)/(?:.*)-([^[]*)?#si',
				'replace'	=> '<iframe src="http://embed.sevenload.com/widgets/singlePlayer/$1/?autoplay=false&env=slcom-ext" style="width:{WIDTH}px;height:{HEIGHT}px;overflow:hidden;border:0 solid #000;" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>',
			),
			'slideshare.net' => array(
				'id'		=> 55,
				'image'		=> 'slideshare.gif',
				'example'	=> 'http://www.slideshare.net/chrisbrogan/social-media-for-publishers-presentation',
				'match'		=> '#http://www.slideshare.net/(.*?)/([^[]*)?#si',
				'replace'	=> 'http://www.slideshare.net/api/oembed/2?url=$0&format=json',
				'method'	=> 'oEmbed',
			),
			'snotr.com' => array(
				'id'		=> 39,
				'image'		=> 'snotr.gif',
				'example'	=> 'http://www.snotr.com/video/8753/What_is_nothing',
				'match'		=> '#http://(?:.*?)snotr.com/video/([0-9]+)/.*#si',
				'replace'	=> '<iframe src="http://www.snotr.com/embed/$1" width="{WIDTH}" height="{HEIGHT}" frameborder="0"></iframe>',
			),
			'spike.com' => array(
				'id'		=> 66,
				'image'		=> 'spike.gif',
				'example'	=> 'http://www.spike.com/video-clips/32xg36/winter-passing-trailer',
				'match'		=> '#http://www.spike.com/([^[]*)?#si',
				'replace'	=> '<div id="embed_{ID}"><script type="text/javascript">ogpEmbedVideo.init("$0", "{WIDTH}", "{HEIGHT}", "embed_{ID}");</script></div>',
			),
			'streetfire.net' => array(
				'id'		=> 61,
				'image'		=> 'streetfire.gif',
				'example'	=> 'http://www.streetfire.net/video/standing-moto-double-fail_2381106.htm',
				'match'		=> '#http://(.*?)streetfire.net/video/([^[]*)?#si',
				'replace'	=> '<div id="embed_{ID}"><script type="text/javascript">ogpEmbedVideo.init("$0", "{WIDTH}", "{HEIGHT}", "embed_{ID}");</script></div>',
			),
			'ted.com' => array(
				'id'		=> 64,
				'image'		=> 'ted.gif',
				'example'	=> 'http://www.ted.com/talks/pranav_mistry_the_thrilling_potential_of_sixthsense_technology.html',
				'match'		=> '#https?:\/\/.*?ted.com\/talks\/([a-zA-Z0-9-_]+).html#si',
				'replace'	=> '<iframe src="//embed.ted.com/talks/$1.html" width="{WIDTH}" height="{HEIGHT}" frameborder="0" scrolling="no" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>',
			),
			'testtube.com' => array(
				'id'		=> 54,
				'image'		=> 'testtube.gif',
				'example'	=> 'http://testtube.com/scamschool/fortheladies2',
				'match'		=> '#http:\/\/(.*testtube\.com\/.*)#si',
				'replace'	=> 'http://testtube.com/api/oembed/?url=$0&format=json',
				'method'	=> 'oEmbed',
			),
			'thedailyshow.cc.com' => array(
				'id'		=> 11,
				'image'		=> 'comedycentral.gif',
				'example'	=> 'http://thedailyshow.cc.com/videos/9ec0d8/judgment-gay',
				'match'		=> '#http:\/\/(?:.*?)thedailyshow.cc.com\/videos\/([^[]*)?#si',
				'replace'	=> '<div id="embed_{ID}"><script type="text/javascript">ogpEmbedVideo.init("$0", "{WIDTH}", "{HEIGHT}", "embed_{ID}");</script></div>',
			),
			'theonion.com' => array(
				'id'		=> 34,
				'image'		=> 'theonion.gif',
				'example'	=> 'http://www.theonion.com/video/stephen-strasburg-ceremoniously-reinjures-arm-on-o,27866/',
				'match'		=> '#http://((.*?)?)theonion.com/([^,]+),([0-9]+)([^[]*)?#si',
				'replace'	=> '<iframe frameborder="no" width="{WIDTH}" height="{HEIGHT}" scrolling="no" src="http://www.theonion.com/video_embed/?id=$4"></iframe>',
			),
			'tu.tv' => array(
				'id'		=> 8,
				'image'		=> 'tutv.gif',
				'example'	=> 'http://tu.tv/videos/el-gato-boxeador',
				'match'		=> '#http://((.*?)?)tu.tv/videos/([^[]*)?#si',
				'replace'	=> 'http://tu.tv/oembed/?url=$0&format=json',
				'method'	=> 'oEmbed',
			),
			'twitch.tv' => array(
				'id'		=> 57,
				'image'		=> 'twitch.gif',
				'example'	=> 'http://www.twitch.tv/rzn732',
				'match'		=> '#http://(.*?)twitch.tv/([^[]*)?#si',
				'replace'	=> 'http://www.twitch.tv/widgets/live_embed_player.swf?channel=$2',
				'method'	=> 'flash',
				'flashvars'	=> 'hostname=www.twitch.tv&channel=$2&auto_play=false&start_volume=25',
			),
			'twitvid.com' => array(
				'id'		=> 12,
				'image'		=> 'twitvid.gif',
				'example'	=> 'http://twitvid.com/0U73M',
				'match'		=> '#http://twitvid.com/([^[]*)?#si',
				'replace'	=> '<iframe src="http://www.twitvid.com/embed.php?guid=$1&amp;autoplay=0" title="Twitvid video player" width="{WIDTH}" height="{HEIGHT}" frameborder="0"></iframe>',
			),
			'ustream.tv' => array(
				'id'		=> 23,
				'image'		=> 'ustream.gif',
				'example'	=> 'http://www.ustream.tv/channel/9948292',
				'match'		=> '#http://(?:www\.)ustream\.tv\/(?:channel/([0-9]{1,8}))#si',
				'replace'	=> '<iframe width="{WIDTH}" height="{HEIGHT}" src="http://www.ustream.tv/embed/$1" scrolling="no" frameborder="0" style="border: 0 none transparent;">    </iframe>',
			),
			'vbox7.com' => array(
				'id'		=> 35,
				'image'		=> 'vbox7.gif',
				'example'	=> 'http://www.vbox7.com/play:93ab2ba5',
				'match'		=> '#http://(?:.*?)vbox7.com/play:([^[]+)?#si',
				'replace'	=> '<iframe width="{WIDTH}" height="{HEIGHT}" src="http://vbox7.com/emb/external.php?vid=$1" frameborder="0" allowfullscreen></iframe>',
			),
			'veoh.com' => array(
				'id'		=> 36,
				'image'		=> 'veoh.gif',
				'example'	=> 'http://www.veoh.com/watch/v27458670er62wkCt',
				'match'		=> '#http://(.*?).veoh.com/([0-9A-Za-z-_\-/]+)?/([0-9A-Za-z-_]+)#si',
				'replace'	=> 'http://www.veoh.com/swf/webplayer/WebPlayer.swf?version=AFrontend.5.7.0.1361&permalinkId=$3&player=videodetailsembedded&videoAutoPlay=0&id=anonymous',
				'method'	=> 'flash',
			),
			'vevo.com' => array(
				'id'		=> 42,
				'image'		=> 'vevo.gif',
				'example'	=> 'http://www.vevo.com/watch/USUV71300904',
				'match'		=> '#http:\/\/(?:www\.)?vevo\.com\/watch\/([^?]*)?#si',
				'replace'	=> '<iframe width="{WIDTH}" height="{HEIGHT}" src="http://cache.vevo.com/m/html/embed.html?video=$1" frameborder="0" allowfullscreen></iframe>',
			),
			'viddler.com' => array(
				'id'		=> 56,
				'image'		=> 'viddler.gif',
				'example'	=> 'http://www.viddler.com/v/7a0d64f2',
				'match'		=> '#http://(?:.*?).viddler.com/v/([0-9A-Za-z-_]+)([^[]*)?#si',
				'replace'	=> '<iframe id="viddler-$1" src="//www.viddler.com/embed/$1/?f=1&amp;autoplay=0&amp;player=full&amp;loop=false&amp;nologo=false&amp;hd=false" width="{WIDTH}" height="{HEIGHT}" frameborder="0" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>',
			),
			'videogamer.com' => array(
				'id'		=> 13,
				'image'		=> 'videogamer.gif',
				'example'	=> 'http://www.videogamer.com/videos/dead_space_developer_diary_zero_gravity.html',
				'match'		=> '#http://www.videogamer.com/([^[]*)?#si',
				'replace'	=> '<div id="embed_{ID}"><script type="text/javascript">ogpEmbedVideo.init("$0", "{WIDTH}", "{HEIGHT}", "embed_{ID}");</script></div>',
			),
			'videu.de' => array(
				'id'		=> 37,
				'image'		=> 'videu.gif',
				'example'	=> 'http://www.videu.de/video/38',
				'match'		=> '#http://www.videu.de/video/([^[]*)?#si',
				'replace'	=> 'http://www.videu.de/flv/player2.swf?iid=$1',
				'method'	=> 'flash',
			),
			'vimeo.com' => array(
				'id'		=> 38,
				'image'		=> 'vimeo.gif',
				'example'	=> 'http://vimeo.com/3759030',
				'match'		=> '#https?://(?:.*?)vimeo.com(?:/groups/(?:.*)/videos/|/)([^[]*)?#si',
				'replace'	=> '<iframe src="//player.vimeo.com/video/$1" width="{WIDTH}" height="{HEIGHT}" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>',
			),
			'wat.tv' => array(
				'id'		=> 62,
				'image'		=> 'wattv.gif',
				'example'	=> 'http://www.wat.tv/video/mords-moi-sans-hesitation-2ykhj_2g5h3_.html',
				'match'		=> '#http://(.*?)wat.tv/video/([^[]*)?#si',
				'replace'	=> '<div id="embed_{ID}"><script type="text/javascript">ogpEmbedVideo.init("$0", "{WIDTH}", "{HEIGHT}", "embed_{ID}");</script></div>',
			),
			'xfire.com' => array(
				'id'		=> 44,
				'image'		=> 'xfire.gif',
				'example'	=> 'http://www.xfire.com/video/24c86/',
				'match'		=> '#http://www.xfire.com/video/(.*?)/#si',
				'replace'	=> 'http://media.xfire.com/swf/embedplayer.swf',
				'method'	=> 'flash',
				'flashvars'	=> 'videoid=$1',
			),
			'screen.yahoo.com' => array(
				'id'		=> 40,
				'image'		=> 'yahoovid.gif',
				'example'	=> 'http://screen.yahoo.com/man-steel-trailer-5-163029535.html',
				'match'		=> '#http://screen.yahoo.com/((([^-]+)?-)*)([0-9]+).html#si',
				'replace'	=> '<iframe width="{WIDTH}" height="{HEIGHT}" scrolling="no" frameborder="0" src="$0?format=embed&player_autoplay=false"></iframe>',
			),
			'youku.com' => array(
				'id'		=> 65,
				'image'		=> 'youku.gif',
				'example'	=> 'http://v.youku.com/v_show/id_XMzgxNzY3NTU2.html',
				'match'		=> '#http://v.youku.com/v_show/id_(.*)\.html.*#si',
				'replace'	=> '<iframe width="{WIDTH}" height="{HEIGHT}" src="http://player.youku.com/embed/$1" frameborder=0 allowfullscreen></iframe>',
			),
			'youtube.com' => array(
				'id'		=> 43,
				'image'		=> 'youtube.gif',
				'example'	=> 'http://www.youtube.com/watch?v=sP4NMoJcFd4',
				'match'		=> '#https?://(?:[0-9A-Z-]+\.)?(?:youtu\.be\/|youtube\.com\S*[^\w\-\s])([\w\-]{11})(?=[^\w\-]|$)([^[]*)?#i', // matches every youtube URL
				'replace'	=> '<iframe width="{WIDTH}" height="{HEIGHT}" src="//www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe>',
			),
			'youtu.be' => array(
				'id'		=> 49,
				'image'		=> 'youtube.gif',
				'example'	=> 'http://youtu.be/sP4NMoJcFd4',
				'match'		=> '#https?://(?:[0-9A-Z-]+\.)?(?:youtu\.be\/|youtube\.com\S*[^\w\-\s])([\w\-]{11})(?=[^\w\-]|$)([^[]*)?#i', // matches every youtube URL
				'replace'	=> '<iframe width="{WIDTH}" height="{HEIGHT}" src="//www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe>',
			),
			// available ids: 67-200

			'file' => array(),
			'(mpg|mpeg)' => array(
				'id'		=> 201,
				'image'		=> 'mpg.gif',
				'example'	=> 'http://www.ray3d.com/video/trn_anaglyph_adj.mpg',
				'match'		=> '#([^[]+)?\.(mpg|mpeg)#si',
				'replace'	=> (strpos(strtolower($user->browser), 'mac') ? '<object height="{HEIGHT}" width="{WIDTH}" type="video/quicktime" data="$0"><param name="src" value="$0" /><param name="scale" value="tofit" /><param name="controller" value="true" /><param name="autoplay" value="false" /></object>' : '<object height="{HEIGHT}" width="{WIDTH}" classid="clsid:6BF52A52-394A-11d3-B153-00C04F79FAA6"><param name="autostart" value="false" /><param name="uimode" value="full" /><param name="showcontrols" value="true" /><param name="url" value="$0" /><!--[if !IE]>--><object height="{HEIGHT}" width="{WIDTH}" type="video/x-ms-wmv" data="$0"><param name="autostart" value="false" /><param name="showcontrols" value="true" /><param name="url" value="$0" /></object><!--<![endif]--></object>'),
			),
			'swf' => array(
				'id'		=> 202,
				'image'		=> 'flash.gif',
				'example'	=> 'http://flash-clocks.com/free-flash-clocks-blog-topics/free-flash-clock-177.swf',
				'match'		=> '#([^[]+)?\.swf#si',
				'replace'	=> '$0',
				'method'	=> 'flash',
			),
			'flv' => array(
				'id'		=> 203,
				'image'		=> 'flashflv.gif',
				'example'	=> 'http://www.mediacollege.com/video-gallery/testclips/20051210-w50s.flv',
				'match'		=> '#([^[]+)?\.flv#si',
				'replace'	=> './flashplayer/flashplayer.swf',
				'method'	=> 'flash',
				'flashvars'	=> 'config={\'clip\':{\'autoPlay\':false,\'autoBuffering\':true,\'url\':\'$0\'},\'playerId\':\'flashplayer_{ID}\',\'plugins\':{\'controls\':{\'url\':\'flashplayer.controls.swf\'}}}',
			),
			'(avi|wmv)' => array(
				'id'		=> 204,
				'image'		=> 'wmv.gif',
				'example'	=> 'http://www.mediacollege.com/video/format/windows-media/streaming/videofilename.wmv',
				'match'		=> '#([^[]+)?\.(avi|wmv)#si',
				'replace'	=> (strpos(strtolower($user->browser), 'mac') ? '<object height="{HEIGHT}" width="{WIDTH}" type="video/quicktime" data="$0"><param name="src" value="$0" /><param name="scale" value="tofit" /><param name="controller" value="true" /><param name="autoplay" value="false" /></object>' : '<object height="{HEIGHT}" width="{WIDTH}" classid="clsid:6BF52A52-394A-11d3-B153-00C04F79FAA6"><param name="autostart" value="false" /><param name="uimode" value="full" /><param name="showcontrols" value="true" /><param name="url" value="$0" /><!--[if !IE]>--><object height="{HEIGHT}" width="{WIDTH}" type="video/x-ms-wmv" data="$0"><param name="autostart" value="false" /><param name="showcontrols" value="true" /><param name="url" value="$0" /></object><!--<![endif]--></object>'),
			),
			'(mov|dv|qt)' => array(
				'id'		=> 205,
				'image'		=> 'mov.gif',
				'example'	=> 'http://trailers.apple.com/movies/wb/suckerpunch/suckerpunch-tlr2_480p.mov',
				'match'		=> '#([^[]+)?\.(mov|dv|qt)#si',
				'replace'	=> '<object height="{HEIGHT}" width="{WIDTH}" ' . (strpos(strtolower($user->browser), 'msie') ? 'classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" codebase="http://www.apple.com/qtactivex/qtplugin.cab#version=6,0,2,0"' : 'type="video/quicktime" data="$0"') . '><param name="src" value="$0" /><param name="scale" value="tofit" /><param name="controller" value="true" /><param name="autoplay" value="false" /></object>',
			),
			'(mid|midi)' => array(
				'id'		=> 206,
				'image'		=> 'quicktime.gif',
				'example'	=> 'http://www.notz.com/music/jazz/midi/lazybird.mid',
				'match'		=> '#([^[]+)?\.(mid|midi)#si',
				'replace'	=> '<object width="{WIDTH}" height="27" classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B"><param name="src" value="$0" /><param name="controller" value="true" /><param name="autoplay" value="false" /><param name="loop" value="false" /><!--[if !IE]>--><object width="{WIDTH}" height="27" type="audio/midi" data="$0"><param name="src" value="$0" /><param name="controller" value="true" /><param name="autoplay" value="false" /><param name="loop" value="false" /></object><!--<![endif]--></object>'
			),
// 			'mp3' => array(
// 				'id'		=> 207,
// 				'image'		=> 'sound.gif',
// 				'example'	=> 'http://www.robtowns.com/music/first_noel.mp3',
// 				'match'		=> '#([^[]+)?\.mp3#si',
// 				'replace'	=> '<object width="{WIDTH}" height="27" type="application/x-shockwave-flash" data="http://www.google.com/reader/ui/3523697345-audio-player.swf" style="-moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; border:solid 1px #555; border-top:0"><param name="movie" value="http://www.google.com/reader/ui/3523697345-audio-player.swf" /><param name="quality" value="high" /><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="pluginspage" value="http://www.macromedia.com/go/getflashplayer" /><param name="autoplay" value="false" /><param name="autostart" value="false" /><param name="flashvars" value="audioUrl=$0" /></object>',
// 			),
// 			'ram' => array(
// 				'id'		=> 208,
// 				'image'		=> 'ram.gif',
// 				'example'	=> 'http://service.real.com/help/library/guides/realone/IntroToStreaming/samples/ramfiles/startend.ram',
// 				'match'		=> '#([^[]+)?\.ram#si',
// 				'replace'	=> '<object id="rmstream{ID}" width="{WIDTH}" height="{HEIGHT}" type="audio/x-pn-realaudio-plugin" data="$0"><param name="src" value="$0" /><param name="autostart" value="false" /><param name="controls" value="ImageWindow" /><param name="console" value="clip_{ID}" /><param name="prefetch" value="false" /></object><br /><object id="ctrls_{ID}" type="audio/x-pn-realaudio-plugin" width="{WIDTH}" height="36"><param name="controls" value="ControlPanel" /><param name="console" value="clip_{ID}" /></object>',
// 			),
			'(mp4|m4v)' => array(
				'id'		=> 209,
				'image'		=> 'mov.gif',
				'example'	=> 'http://www.mediacollege.com/video/format/mpeg4/videofilename.mp4',
				'match'		=> '#([^[]+)?\.(mp4|m4v)#si',
				'replace'	=> './flashplayer/flashplayer.swf',
				'method'	=> 'flash',
				'flashvars'	=> 'config={\'clip\':{\'autoPlay\':false,\'autoBuffering\':true,\'url\':\'$0\'},\'playerId\':\'flashplayer_{ID}\',\'plugins\':{\'controls\':{\'url\':\'flashplayer.controls.swf\'}}}',
			),
			// available ids: 207, 208, 210-300
		);
	}

	/**
	* Get embed code using oEmbed
	*
	* @param string $url
	* @param string $width
	* @param string $height
	* @return embed code
	* @version 3.0.11
	*
	* more examples of some popular oEmbed ready sites
	* dailymotion.com => http://www.dailymotion.com/api/oembed?url=$0&format=json,
	* funnyordie.com => http://www.funnyordie.com/oembed?url=$0&format=json,
	* photobucket.com => http://photobucket.com/oembed?url=$0&format=json,
	* smugmug.com => http://api.smugmug.com/services/oembed/?url=$0&format=json,
	* viddler.com => http://lab.viddler.com/services/oembed/?url=$0&format=json,
	* vimeo.com => http://vimeo.com/api/oembed.xml?url=$0&format=json,
	* wordpress.tv => http://wordpress.tv/oembed/?url=$0&format=json,
	* youtube.com => http://www.youtube.com/oembed?url=$0&format=json,
	* soundcloud.com => http://soundcloud.com/oembed?url=$0&format=json,
	* tu.tv => http://tu.tv/oembed/?url=$0&format=json
	*/
	function oembed_url($url, $width, $height)
	{
		$oembed_contents = @file_get_contents($url);
		$oembed_data 	 = @json_decode($oembed_contents);
		$embed_code 	 = (isset($oembed_data->html)) ? $oembed_data->html : '';
		$embed_code 	 = preg_replace(array('/width="([0-9]{1,4})"/i', '/height="([0-9]{1,4})"/i'), array('width="' . $width . '"', 'height="' . $height . '"'), $embed_code);
		return $embed_code;
	}

	/**
	* Build an XHTML compliant object tag
	*
	* @param string $url
	* @param string $width
	* @param string $height
	* @param string $flashvars
	* @return xhtml object tag
	* @version 3.0.8
	*/
	function auto_embed_video($url, $width, $height, $flashvars = '', $object_attribs_ary = array(), $object_params_ary = array())
	{
		global $config;

		// Try to cope with a common user error...
		if (preg_match('#^[a-z0-9]+://#i', $url))
		{
			$url = trim(str_replace(array(' ', '&'), array('%20', '&amp;'), $url));
		}

		$object_attribs_ary = array_merge(array(
			'id'				=> 'mov' . substr(base_convert(unique_id(), 16, 36), 0, 8),
			'width'				=> $width,
			'height'			=> $height,
			'type'				=> 'application/x-shockwave-flash',
			'data'				=> $url,
		), $object_attribs_ary);

		$object_params_ary = array_merge(array(
			'movie'				=> $url,
			'quality'			=> 'high',
			'allowFullScreen'	=> 'true',
			'allowScriptAccess'	=> 'always',
			'pluginspage'		=> 'http://www.macromedia.com/go/getflashplayer',
			'autoplay'			=> 'false',
			'autostart'			=> 'false',
		), $object_params_ary);

		// Add some optional params if needed
		if (isset($config['ABBC3_VIDEO_WMODE']) && $config['ABBC3_VIDEO_WMODE'])
		{
			$object_params_ary['wmode'] = 'transparent';
		}
		if (!empty($flashvars))
		{
			$object_params_ary['flashvars'] = trim(str_replace('&', '&amp;', $flashvars));
		}

		$object_attribs = '';
		foreach ($object_attribs_ary as $attrib => $value)
		{
			$object_attribs .= ' ' . $attrib . '="' . $value . '"';
		}

		$object_params = '';
		foreach ($object_params_ary as $param => $value)
		{
			$object_params .= '<param name="' . $param . '" value="' . $value . '" />';
		}

		return sprintf('<object%1$s>%2$s</object>', $object_attribs, $object_params);
	}

	/**
	* Parsing the web videos - Second pass.
	* '[BBvideo${1}${2}:$uid]'.trim('${3}').'[/BBvideo:$uid]'
	* @param string		$in		post text between [BBvideo] & [/BBvideo]
	* @param string		$w		value for video width
	* @param string		$h		value for video Height
	* @return embed video
	* @version 3.0.12
	*/
	function BBvideo_pass($in, $w, $h)
	{
		global $user, $config;

		if (empty($this->abbcode_config))
		{
			$this->abbcode_init(false);
		}

		// fill the bbvideo array (use static so it keeps its value after execution)
		static $abbcode_video_ary = array();
		if (empty($abbcode_video_ary))
		{
			$abbcode_video_ary = abbcode::video_init();
		}

		$allowed_videos 	= explode(';', $config['ABBC3_VIDEO_OPTIONS']);
		$video_unique_id	= substr(base_convert(unique_id(), 16, 36), 0, 8);
		$video_width		= (intval($w)) ? $w : $this->abbcode_config['ABBC3_VIDEO_WIDTH'];
		$video_height		= (intval($h)) ? $h : $this->abbcode_config['ABBC3_VIDEO_HEIGHT'];
		$video_image_path	= $this->abbcode_config['S_ABBC3_PATH'];
		$in					= trim($in);
		$video_link			= '';
		$video_content		= '';

		foreach ($abbcode_video_ary as $video_name => $video_data)
		{
			// only process BBvideos that have match, replace and id values
			if (!isset($video_data['match']) || $video_data['match'] == '' || !isset($video_data['replace']) || $video_data['replace'] == '' || !isset($video_data['id']) || $video_data['id'] == '')
			{
				continue;
			}
			// find a BBvideo match for the video url
			if (preg_match($video_data['match'], $in))
			{
				// if this BBvideo is not allowed, return a link
				if (!in_array($video_data['id'], $allowed_videos))
				{
					return make_clickable($in);
				}

				// if user has flash animations disabled in UCP, return as [ flash ] link
				if (!$user->optionget('viewflash'))
				{
					return str_replace(array('$1', '$2'), array($in, '[ flash ]'), $this->bbcode_tpl('url', -1, true));
				}

				// Construct XHTML compliant embed code for flash-based embeds
				if (isset($video_data['method']) && $video_data['method'] == 'flash')
				{
					$flashvars 	 = (isset($video_data['flashvars']) ? $video_data['flashvars'] : '');
					$params_ary  = (isset($video_data['params']) 	? $video_data['params']    : array());
					$attribs_ary = (isset($video_data['attribs']) 	? $video_data['attribs']   : array());
					$video_data['replace'] = $this->auto_embed_video($video_data['replace'], $video_width, $video_height, $flashvars, $attribs_ary, $params_ary);
				}

				// perform match/replace from input URL to output code
				$video_content = preg_replace($video_data['match'], $video_data['replace'], $in);

				// For oEmbed videos, now is the time to get the embed code
				if (isset($video_data['method']) && $video_data['method'] == 'oEmbed')
				{
					$video_content = $this->oembed_url($video_content, $video_width, $video_height);
				}

				// replace variables in the video content string with values
				$video_content = str_replace(array('{WIDTH}', '{HEIGHT}', '{ID}'), array($video_width, $video_height, $video_unique_id), $video_content);

				// create the icon image tag for the BBvideo info bar
				$video_image = $video_image_path . '/images/' . $video_data['image'];
				$video_image = (file_exists($video_image)) ? '<img src="' . $video_image . '" class="postimage" alt="" width="20" height="20" /> ' : '';

				//create a direct link to the embedded video site or file
				$video_link_string = '%1$s <a href="%2$s" onclick="window.open(this.href);return false;" >%3$s</a>';
				if ($video_data['id'] > 200)
				{
					// this is for direct file formats, they have an ID of 200+, get the extension
					$video_link = sprintf($video_link_string, $user->lang['ABBC3_BBVIDEO_FILE'] . ':', $in, pathinfo(parse_url($in, PHP_URL_PATH ), PATHINFO_EXTENSION));
				}
				else
				{
					// this is the link back to the video site
					$video_link = sprintf($video_link_string, $user->lang['ABBC3_BBVIDEO_WATCH'], $in, $video_name);
				}

				// Dump everything we've done into the BBvideo html template
				$video_content = str_replace(array('{BBVIDEO_WIDTH}', '{BBVIDEO_IMAGE}', '{BBVIDEO_LINK}', '{BBVIDEO_VIDEO}'), array($video_width, $video_image, $video_link, $video_content), $this->bbcode_tpl('bbvideo'));

				return $video_content;
			}
		}
		// if input did not match any BBvideos, return a link
		return make_clickable($in);
	}
}

/**
* Transform posted URLs from video sites into BBvideo embedded code
* Not used in default installation. Part of add-on “Auto Embed Video From URLs”
* Called only from hook_bbvideo.php when optionally installed
*
* @param  string	$text	string to transform
* @return string	$text	string with embed codes if applicable
* @version 3.0.13
*/
function url_to_bbvideo($text)
{
	// Check to see if we have any links to process
	if (strpos($text, '<a ') === false)
	{
		return($text);
	}

	global $bbcode;

	// if no BBCodes are on page, load them up
	if (empty($bbcode))
	{
		$bbcode = new bbcode();
		$bbcode->bbcode_cache_init();
	}

	// get array of all BBvideos
	static $abbcode_video_ary = array();
	if (empty($abbcode_video_ary))
	{
		$abbcode_video_ary = abbcode::video_init();
	}

	// Get all magic urls in the post text
	preg_match_all('#<!-- [lmw] --><a class="[^"]*" href="([^"]*)"[^>]*>.*?<\/a><!-- [lmw] -->#i', $text, $matches, PREG_SET_ORDER);
	foreach ($matches as $links)
	{
		$link = $links[0];
		$url  = $links[1];
		// Check for valid BBvideo sites
		foreach ($abbcode_video_ary as $video_name => $video_data)
		{
			if (isset($video_data['match']) && preg_match($video_data['match'], $url))
			{
				$video_links[] = $link;
				$embed_codes[] = $bbcode->BBvideo_pass($url, null, null);
				break;
			}
		}
	}

	// Replace video links with embed codes
	if (isset($video_links) && isset($embed_codes))
	{
		$text = str_replace($video_links, $embed_codes, $text);
	}

	return $text;
}

/**
* eD2k Add-on optionally called from viewtopic
*	display table with ed2k links features
*
* @param string		$text		post text
* @param int		$post_id	post id
* @return string
* @version 3.0.8
*/
function abbc3_add_all_ed2k_link($text, $post_id)
{
	// dig through the message for all ed2k links!
	$match = array();
	preg_match_all('/href="(ed2k:(.*?))"[^>]*>(.*?)</i', $text, $match);

	$ed2k_links = $match[1];
	$ed2k_names = $match[3];

	// no need to dig through it if there are not at least 2 links!
	if (sizeof($ed2k_links) > 1)
	{
		foreach ($ed2k_links as $ed2k_link => $item)
		{
			$t_ed2k_parts = explode("|", $ed2k_links[$ed2k_link]);
			$block_array[$post_id][] = array(
				'LINK_VALUE' 	=> $ed2k_links[$ed2k_link],
				'LINK_TEXT'		=> (isset($ed2k_names[$ed2k_link])) ? $ed2k_names[$ed2k_link] : $t_ed2k_parts[2],
			);
		}
	}
	return $block_array;
}

/**
* eD2k Add-on optionally called from viewtopic
* 	Replace magic urls and display ed2k links format
*	Cuts down displayed size of link if over 50 chars, turns absolute links
*
* @param string 	$link	post links with ed2k href
* @return string	display ed2k links format
* @version 3.0.8
*/
function abbc3_ed2k_make_clickable($link)
{
	global $abbcode, $user, $config, $phpbb_root_path;

	$ed2k_icon = $abbcode->abbcode_config['S_ABBC3_PATH'] . '/images/emule.gif';
	$ed2k_stat = $abbcode->abbcode_config['S_ABBC3_PATH'] . '/images/stats.gif';

	$matches = preg_match_all("#(^|(?<=[^\w\"']))(ed2k://\|(file|server|friend)\|([^\\/\|:<>\*\?\"]+?)\|(\d+?)\|([a-f0-9]{32})\|(.*?)/?)(?![\"'])(?=([,\.]*?[\s<\[])|[,\.]*?$)#i", $link, $match);

	if ($matches)
	{
		foreach ($match[0] as $i => $m)
		{
			$ed2k_link	= (isset($match[2][$i])) ? $match[2][$i] : '';

			// Only for testing propose, commented out so I do not loose the code.
		//	$ed2k_type	= (isset($match[3][$i])) ? $match[3][$i] : '';
			$ed2k_size	= (isset($match[5][$i])) ? $match[5][$i] : '';
			$ed2k_hash	= (isset($match[6][$i])) ? $match[6][$i] : '';

			$max_len	= 100;
			$ed2k_name	= (isset($match[4][$i])) ? $match[4][$i] : '';

			$ed2k_name	= (strlen($ed2k_name) > $max_len) ? substr($ed2k_name, 0, $max_len - 19) . '...' . substr($ed2k_name, -16) : $ed2k_name;
			return ' <img src="' . $ed2k_icon . '" class="ed2k_img" alt="" title="" />&nbsp;<a href="' . $ed2k_link . '" class="postlink">' . $ed2k_name . '</a>&nbsp;[' . abbc3_ed2k_humanize_size($ed2k_size) . ']&nbsp;<a href="http://ed2k.shortypower.org/?hash=' . $ed2k_hash . '" onclick="window.open(this.href);return false;"><img src="' . $ed2k_stat . '"  alt="" title="" /></a>';
		}
	}
}

/**
* Display ed2k size in a human readable way ;)
*
*/
function abbc3_ed2k_humanize_size($size, $rounder = 0)
{
	$sizes		= array('Bytes', 'Kb', 'Mb', 'Gb', 'Tb', 'Pb', 'Eb', 'Zb', 'Yb');
	$rounders	= array(0, 1, 2, 2, 2, 3, 3, 3, 3);
	$ext		= $sizes[0];
	$rnd		= $rounders[0];

	if ($size < 1024)
	{
		$rounder	= 0;
		$format		= '%.' . $rounder . 'f Bytes';
	}
	else
	{
		for ($i = 1, $cnt = count($sizes); ($i < $cnt && $size >= 1024); $i++)
		{
			$size	= $size / 1024;
			$ext	= $sizes[$i];
			$rnd	= $rounders[$i];
			$format	= '%.' . $rnd . 'f ' . $ext;
		}
	}

	if (!$rounder)
	{
		$rounder = $rnd;
	}
	return sprintf($format, round($size, $rounder));
}

/**
 * linktest class
 *
 * This class is used to check the validity of file host links (also called one-click hosts).
 * It does so by looking for the file size that the host displays. It requires that you have
 * curl installed and a version of PHP that supports preg_match and preg_replace.
 *
 * @license 	GPL license
 * @author	 	Max Power
 * @copyright	2008, Max Power
 */
class linktest
{
	// global variables shared by all methods
	var $url, $method, $format, $domain, $adjustment, $filters;

	// class constants
	var $PATTERN 	= "@([\d\.,\s]+)(KB|MB|GB)@i";
	var $CONVERSION = 1024;

	/**
	* The test method is the only public method and the only method necessary for interfacing
	* with this class. The list of supported hosts is in this method. Only six hosts are used
	* as default but many others are available as needed and need to be uncommented for use.
	*
	* @param string url (required) - must be a full url including http://
	* @param string format (optional) - only accepted strings are 'KB', 'MB', and 'GB'
	* @param boolean supported (optional) - to only allow supported hosts or not
	* @return array result - zero index is either a number or false
	*/
	function test($url, $format = 'MB', $supported = false)
	{
		// check for valid hostname in url
		$pattern = '@^https?://?([^/]+)@i';

		if (preg_match($pattern, $url, $matches))
		{
			$hostname = $matches[1];
		}
		else
		{
			$result[0] = false;
		//	Only for testing propose, commented out so I do not lose the code.
		//	$result[1] = 'invalid url';
		//	$result[2] = "The link provided is not a valid url";
			return $result;
		}

		// set format to 'MB' if variable is not KB, MB or GB
		$format = strtoupper($format);

		if ($format !== 'KB' && $format !== 'MB' && $format !== 'GB')
		{
			$format = 'MB';
		}

		// set supported to true if variable is not true or false
		if ($supported !== true && $supported !== false)
		{
			$supported = true;
		}

		// set global variables
		$this->url = $url;
		$this->format = $format;

		/** FILE HOST PROCESSING
		* array of hosts to check against url
		* important: do not change key names
		* the following is the format of the hosts array:
		* $hosts[method name][domain name] = array(domain pattern, url retrieve method, size adjustment, filters array);
		*/

		// most popular hosts
		$hosts['rapidshare']['rapidshare.com'] 		= array("@rapidshare\.com@i", 'curl', 1000 / $this->CONVERSION, array('@<u>100 MB</u>@i'));
		$hosts['rapidshare']['rapidshare.de'] 		= array("@rapidshare\.de@i", 'curl', 1, array('@>300 MB<@i'));
		$hosts['other']['depositfiles.com'] 		= array("@depositfiles\.com@i", 'file', 1);
		$hosts['other']['megashares.com'] 			= array("@megashares\.com@i", 'curl', 1, array('@ 10GB@i'));

		// lesser known hosts these hosts are commented out but can be used as needed
		//$hosts['other']['filefactory.com'] 		= array("@filefactory\.com@i", 'curl', 1);
		//$hosts['other']['sendspace.com'] 			= array("@sendspace\.com@i", 'file', 1);
		//$hosts['other']['badongo.com'] 			= array("@badongo\.com@i", 'curl', 1);
		//$hosts['other']['filecloud.com'] 			= array("@filecloud\.com@i", 'curl', 1);
		//$hosts['other']['gigasize.com'] 			= array("@gigasize\.com@i", 'curl', 1);
		//$hosts['other']['uploadmb.com'] 			= array("@uploadmb\.com@i", 'curl', pow(1000/self::CONVERSION, 2));
		//$hosts['other']['speedshare.org'] 		= array("@speedshare\.org@i", 'curl', 1);
		//$hosts['other']['uploading.com'] 			= array("@uploading\.com@i", 'curl', 1);
		//$hosts['other']['furk.net'] 				= array("@furk\.net@i", 'curl', 1);
		//$hosts['other']['savefile.info'] 			= array("@savefile\.info@i", 'curl', 1);
		//$hosts['other']['arbup.org'] 				= array("@arbup\.org@i", 'curl', 1, array('@x 120MB p@i'));
		//$hosts['other']['getupload.com']			= array("@getupload\.com@i", 'curl', 1);
		//$hosts['other']['turboupload.com'] 		= array("@turboupload\.com@i", 'curl', 1);
		//$hosts['other']['titanicshare.com'] 		= array("@titanicshare\.com@i", 'curl', 1);
		//$hosts['other']['file2you.net'] 			= array("@file2you\.net@i", 'curl', 1);
		//$hosts['other']['upitus.com'] 			= array("@upitus\.com@i", 'curl', 1, array('@o 80 MB \(@i'));
		//$hosts['other']['egoshare.com'] 			= array("@egoshare\.com@i", 'curl', 1);
		//$hosts['other']['tornadodrive.com'] 		= array("@tornadodrive\.com@i", 'curl', 1);
		//$hosts['other']['uploadpalace.com'] 		= array("@uploadpalace\.com@i", 'curl', 1);
		//$hosts['other']['4filehosting.com'] 		= array("@4filehosting\.com@i", 'curl', 1);
		//$hosts['other']['primeupload.com'] 		= array("@primeupload\.com@i", 'curl', 1);
		//$hosts['other']['yousendit.com'] 			= array("@yousendit\.com@i", 'file', 1);
		//$hosts['other']['transferbigfiles.com']	= array("@transferbigfiles\.com@i", 'file', 1, array('@o 1gb p@i', '@>~300kb<@i'));
		//$hosts['other']['mailbigfile.com'] 		= array("@mailbigfile\.com@i", 'curl', 1);
		//$hosts['other']['friendlyfiles.net'] 		= array("@friendlyfiles\.net@i", 'curl', 1);
		//$hosts['other']['bigupload.com'] 			= array("@bigupload\.com@i", 'file', 1);
		//$hosts['other']['axifile.com'] 			= array("@axifile\.com@i", 'curl', 1, array('@ 200 @i'));
		//$hosts['other']['speedyshare.com'] 		= array("@speedyshare\.com@i", 'curl', 1);
		//$hosts['other']['justupit.com'] 			= array("@justupit\.com@i", 'curl', 1, array('@>170mb!!<@i'));
		//$hosts['other']['momoshare.com'] 			= array("@momoshare\.com@i", 'curl', 1);
		//$hosts['other']['internetfiles.org'] 		= array("@internetfiles\.org@i", 'curl', 1);
		//$hosts['other']['ultrashare.net'] 		= array("@ultrashare\.net@i", 'curl', 1, array('@ 100MB P@i'));
		//$hosts['other']['upload2.net'] 			= array("@upload2\.net@i", 'curl', 1, array('@s 25Mb@i'));
		//$hosts['other']['webfilehost.com'] 		= array("@webfilehost\.com@i", 'curl', 1, array('@500\s?MB@i'));
		//$hosts['other']['rapidfile.net'] 			= array("@rapidfile\.net@i", 'file', 1, array('@o 300 MB U@i'));
		//$hosts['other']['zshare.net'] 			= array("@zshare\.net@i", 'file', 1);*/

		// No longer available hosts
		//$hosts['other']['filefront.com'] 			= array("@filefront\.com@i", 'curl', 1);
		//$hosts['other']['megaupload.com'] 		= array("@megaupload\.com@i", 'curl', 1);
		//$hosts['other']['megarotic.com'] 			= array("@megarotic\.com@i", 'curl', 1);

		// find out which host to check and set variables from array
		$host = false;

		foreach ($hosts as $key => $value)
		{
			foreach ($value as $domain => $pattern)
			{
				if (preg_match($pattern[0], $hostname, $matches))
				{
					$host = $key;
					$this->domain		= $domain;
					$this->method		= $pattern[1];
					$this->adjustment	= $pattern[2];
					$this->filters      = (isset($pattern[3])) ? $pattern[3] : '' ;	// (@$pattern[3]) ? $pattern[3] : '' ;
				}
			}
		}

		// return false if no supported hosts were matched or set default variables if supported is false
		if (!$host)
		{
			if ($supported == true)
			{
				$result[0] = false;
			//	Only for testing propose, commented out so I do not loose the code.
			//	$result[1] = 'invalid host';
			//	$result[2] = "The domain $hostname is not a supported host";
				return $result;
			}
			else
			{
				$host = 'other';
				$this->domain = $hostname;
				$this->method = 'curl';
				$this->adjustment = 1;
				$this->filters = null;
			}
		}

		// Delete the language folder from megaupload
		//if ($hostname == 'www.megaupload.com' && preg_match("#/(.*?)/#i", $this->url) != 0)
		//{
		//	$this->url = preg_replace('#(.*?)megaupload.com/(.*?)/(.*?)#si', '$1megaupload.com/$3', $this->url);
		//}

		// dynamic function call
		$result = $this->$host();

		return $result;
	}

	/**
	* Rapidshare requires a two step process in order to view the file size. To make it more
	* complicated, the second page can only be reached using POST. This method gathers the
	* information required to make the POST call and passes it to the other function, which
	* the other domains use. If other hosts require a two step process, this rapidshare method
	* can be used as a template.
	*
	* @return array result
	*/
	function rapidshare()
	{
		preg_match('/https?:\/\/(?:www.)?rapidshare.com\/.*\/([\d]+)\/(.*)/', $this->url, $pieces);
		$rs_file_id = $pieces[1];
		$rs_file_name = $pieces[2];
		$rs_api_url = 'http://api.rapidshare.com/cgi-bin/rsapi.cgi?sub=checkfiles&files=' . $rs_file_id . '&filenames=' . $rs_file_name;

		$pattern	= '/[^,]+,[^,]+,[^,]+,[^,]+,1,.*/i';
		$matches	= $this->match($rs_api_url, $pattern);

		/** get rapidshare submit form url **/
	//	$pattern	= '@<form.*.action="(.*)".*.method@i';
	//	$matches	= $this->match($this->url, $pattern);
	//	$url		= $matches[1];
	//	$params		= "dl.start=Free";

		// get rapidshare.de hidden param
	//	if ($this->domain == 'rapidshare.de')
	//	{
	//		$pattern	= '@<input.*.hidden.*.value="(.*)">@i';
	//		$matches	= $this->match($this->url, $pattern);
	//		$param		= $matches[1];
	//		if (!is_null($param))
	//		{
	//			$params = "$params&uri=$param";
	//		}
	//	}

		// get file size
	//	$this->url	= $url;
	//	$result		= $this->other($params);

	//	return $result;
		return $matches;
	}

	/**
	* The other method is used to get the file size by all domains other than rapidshare. It
	* contains the standard pattern for finding the file size and also makes the call to the
	* match method and convertSize method.
	*
	* @param string params (optional) - params is used for passing POST parameters
	* @return array result
	*/
	function other($params = null)
	{
		// get file size and format
		$pattern		= $this->PATTERN;
		$matches		= $this->match($this->url, $pattern, $params);
	//	$size			= $matches[1];
	//	$sourceFormat	= strtoupper($matches[2]);

	//	if (is_null($size) || rtrim($size) == '')
	//	{
	//		$result[0] = false;
	//		$result[1] = 'invalid link';
	//		$result[2] = "This link for $this->domain is invalid";
	//		return $result;
	//	}
	//	else
	//	{
	//		$result[0] = true;
	//		$result[1] = 'Valid link';
	//		$result[2] = "This link for $this->domain is valid !";
	//	}
		// convert size to requested format
	//	$result = $this->convertSize($size, $sourceFormat);

	//	return $result;
		return $matches;
	}

	/**
	* The match method is used by the other methods to get the HTML and perform the preg_replace
	* and preg_match. First, it gets the HTML using the curl or file_get_contents method accodding
	* to the global method variable. Next, the HTML is filtered for common problems and then for
	* the domain specific filters that are stored in the global fitlers array. Finally, the filtered
	* HTML is matched against the pattern that is passed into the method.
	*
	* @param string url (required) - this url may not always be the same as the global url so it must be passed
	* @param string params (optional) - params is used for passing POST parameters
	* @return array result
	*/
	function match($url, $pattern, $params = null)
	{
		// get html from url
		if ($this->method == 'curl')
		{
			$curl = curl_init();

			if (!is_null($params))
			{
				curl_setopt($curl, CURLOPT_POST, 1);
				curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
			}
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			$html = curl_exec($curl);
			curl_close($curl);
		}
		else
		{
			if (!is_null($params))
			{
				$options = array('http' => array('method' => 'POST', 'content' => $params));
				$context = stream_context_create($options);
				$html = file_get_contents($url, null, $context);
			}
			else
			{
				$html = file_get_contents($url);
			}
		}

		// uncomment line below to test unfiltered html
		// echo "<xmp>$html</xmp>"; exit;

		// setup patterns for preg_replace to remove common-problem text
		$patterns[] = '@<title>.*?</title>@i';
		$patterns[] = '@<meta.*?>@i';
		$patterns[] = '@<noscript>(.|\n)*?</noscript>@i';
		$patterns[] = '@&nbsp;@i';
		$patterns[] = '@</b>@i';

		// add custom patterns from filters array
		if (is_array($this->filters))
		{
			foreach ($this->filters as $value)
			{
				$patterns[] = $value;
			}
		}

		// process patterns with preg_replace
		foreach ($patterns as $value)
		{
			$test = preg_replace($value, ' ', $html);
			if (!is_null($test))
			{
				$html = $test;
			}
		}

		// uncomment line below to test filtered html
		// echo "<xmp>$html</xmp>"; exit;

		// check html against pattern and return result
		if (preg_match($pattern, $html, $matches))
		{
			return $matches;
		}
		else
		{
			return false;
		}
	}

	/**
	* The convertSize method is used to change the file size from the format that the host
	* uses (KB, MB, or GB) to the file size format that was requested from the test method.
	* It also uses the adjustment variable, which is used if the host converts their file
	* sizes wrong (the most noteable example is rapidshare.com, which needs adjustment).
	*
	* @param number size (required) - the file size that was matched from the host
	* @param string sourceFormat (required) - the format that the host uses (not the requested format)
	* @return array result
	*/
	function convertSize($size, $sourceFormat)
	{
		// set variables for equation
		$size				= str_replace(',', '', $size);
		$conversion			= $this->CONVERSION;
		$adjustment			= $this->adjustment;
		$format['source']	= $sourceFormat;
		$format['final']	= $this->format;

		// set multiplier and divsor for equation
		foreach ($format as $key => $value)
		{
			switch ($value)
			{
				case 'KB':
					$x[$key] = 1;
				break;
				case 'MB':
					$x[$key] = $conversion;
				break;
				case 'GB':
					$x[$key] = $conversion * $conversion;
				break;
			}
		}

		// convert size to KB then convert to final format
		$size = $size * $adjustment;
		$size = ($size * $x['source']) / $x['final'];
		$result[0] = $size;

		return $result;
	}
}

/**
* Process template blocks - This code block from ReIMG (c) 2011 DavidIQ.com
* Not used in default installation. Part of add-on “Auto Embed Video From URLs”
* Called only from hook_bbvideo.php
*
* @param  string	$block_name
* @param  string	$block_section
* @version 3.0.12
*/
function process_template_block_bbvideo($block_name, $block_section)
{
	global $template;

	if (!empty($block_name) && !empty($block_section))
	{
		if (!empty($template->_tpldata[$block_name]))
		{
			foreach ($template->_tpldata[$block_name] as $row => $data)
			{
				// Alter the array
				$template->alter_block_array($block_name, array(
					$block_section => url_to_bbvideo($data[$block_section]),
				), $row, 'change');
			}
		}
	}

	if (!empty($block_section))
	{
		if (isset($template->_tpldata['.'][0][$block_section]))
		{
			$template->assign_var($block_section, url_to_bbvideo($template->_tpldata['.'][0][$block_section]));
		}
	}
}

?>