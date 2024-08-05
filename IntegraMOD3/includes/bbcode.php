<?php
/**
*
* @package phpBB3
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

// MOD : MSSTI ABBC3 - Start
if (!class_exists('abbcode'))
{
	include($phpbb_root_path . 'includes/abbcode.' . $phpEx);
}
/**
* BBCode class
* @package phpBB3
*/
// class bbcode
class bbcode extends abbcode
// MOD : MSSTI ABBC3 - end
{
	var $bbcode_uid = '';
	var $bbcode_bitfield = '';
	var $bbcode_cache = array();
	var $bbcode_template = array();

	var $bbcodes = array();

	var $template_bitfield;
	var $template_filename = '';

	/**
	* Constructor
	* Init bbcode cache entries if bitfield is specified
	*/
	function __construct($bitfield = '') {
		if ($bitfield)
		{
			$this->bbcode_bitfield = $bitfield;
			$this->bbcode_cache_init();
		}
	}

	/**
	* Second pass bbcodes
	*/
	function bbcode_second_pass(&$message, $bbcode_uid = '', $bbcode_bitfield = false)
	{
		if ($bbcode_uid)
		{
			$this->bbcode_uid = $bbcode_uid;
		}

		if ($bbcode_bitfield !== false)
		{
			$this->bbcode_bitfield = $bbcode_bitfield;

			// Init those added with a new bbcode_bitfield (already stored codes will not get parsed again)
			$this->bbcode_cache_init();
		}

		if (!$this->bbcode_bitfield)
		{
			// Remove the uid from tags that have not been transformed into HTML
			if ($this->bbcode_uid)
			{
				$message = str_replace(':' . $this->bbcode_uid, '', $message);
			}

			return;
		}

		$str = array('search' => array(), 'replace' => array());
		$preg = array('search' => array(), 'replace' => array());
		$callback = array('search' => array(), 'replace' => array());

		$bitfield = new bitfield($this->bbcode_bitfield);
		$bbcodes_set = $bitfield->get_all_set();


// MOD : MSSTI ABBC3 - Start
		// Try to avoid duplicates anchor ID's inside quotes
		if (preg_match('#\[quote(?:=&quot;(.*?)&quot;)?:' . $this->bbcode_uid . '\](.*?)\[anchor=(.*?)?\sgoto=(.*?)?:' . $this->bbcode_uid . '\](.*?)\[/anchor:' . $this->bbcode_uid . '\](.*?)\[/quote:' . $this->bbcode_uid . '\]#is', $message))
		{
			$message = preg_replace('#(\[anchor=(.*?)(\s)goto=(.*?):' . $this->bbcode_uid . '\](.*?)\[/anchor:' . $this->bbcode_uid . '\]?)#is', "[anchor=quoted$2 goto=quoted$4:" . $this->bbcode_uid . "]$5[/anchor:" . $this->bbcode_uid . "]", $message);
		}
// MOD : MSSTI ABBC3 - End
		$undid_bbcode_specialchars = false;
		foreach ($bbcodes_set as $bbcode_id)
		{
			if (!empty($this->bbcode_cache[$bbcode_id]))
			{
				foreach ($this->bbcode_cache[$bbcode_id] as $type => $array)
				{
					foreach ($array as $search => $replace)
					{
						${$type}['search'][] = str_replace('$uid', $this->bbcode_uid, $search);
						${$type}['replace'][] = $replace;
					}

					if (sizeof($str['search']))
					{
						$message = str_replace($str['search'], $str['replace'], $message);
						$str = array('search' => array(), 'replace' => array());
					}

					if (sizeof($preg['search']))
					{
						// we need to turn the entities back into their original form to allow the
						// search patterns to work properly
						if (!$undid_bbcode_specialchars)
						{
							$message = str_replace(array('&#58;', '&#46;'), array(':', '.'), $message);
							$undid_bbcode_specialchars = true;
						}

						$message = preg_replace($preg['search'], $preg['replace'], $message);
					
						// Start Text_effect_pass
						$regex = "/(\\$)(this->Text_effect_pass)(\().*?(\')(,)( )(\').*?(\')(,)( )(\').*?(\'\))/is";

						if (preg_match_all($regex, $message, $matches)) {
								foreach ($matches[0] as $key => $func) {
										$bracket = preg_split("/(\\$)(this->Text_effect_pass)/", $func);
										$param = explode("', '", $bracket[1]);
										$param[0] = substr($param[0], 2);
										$param[2] = substr($param[2], 0, strrpos($param[2], "')"));
										$effect = $this->Text_effect_pass($param[0], $param[1], $param[2]);
										if ($key == 0) {
												$init = $message;
										} else {
												$init = $mess;
										}
										$mess = str_replace($matches[0][$key], $effect, $init);
								}
								$message = $mess;
						} // End Text_effect_pass

						// Start moderator_pass
						$regex = "/(\\$)(this->moderator_pass)(\().*?(\')(,).*?(\').*?(\'\))/is";

						if (preg_match_all($regex, $message, $matches)) {
								foreach ($matches[0] as $key => $func) {
										$bracket = "/(\\$)(this->moderator_pass)/";
										$bracket = preg_split($bracket, $func);
										$param = explode("', '", $bracket[1]);
										$param[0] = substr($param[0], 2);
										$param[1] = substr($param[1], 0, strrpos($param[1], "')"));

										$effect = $this->moderator_pass($param[0], $param[1]);
										if ($key == 0) {
												$init = $message;
										} else {
												$init = $mess;
										}
										$mess = str_replace($matches[0][$key], $effect, $init);
								}
								$message = $mess;
						} // End moderator_pass

						// Start table_pass
						$regex = "/(\\$)(this->table_pass)(\().*?(\')(,).*?(\').*?(\'\))/is";

						if (preg_match_all($regex, $message, $matches)) {
								foreach ($matches[0] as $key => $func) {
										$bracket = "/(\\$)(this->table_pass)/";
										$bracket = preg_split($bracket, $func);
										$param = explode("', '", $bracket[1]);
										$param[0] = substr($param[0], 2);
										$param[1] = substr($param[1], 0, strrpos($param[1], "')"));

										$effect = $this->table_pass($param[0], $param[1]);
										if ($key == 0) {
												$init = $message;
										} else {
												$init = $mess;
										}
										$mess = str_replace($matches[0][$key], $effect, $init);
								}
								$message = $mess;
						} // End table_pass

						// Start BBvideo_pass
						$regex = "/(\\$)(this->BBvideo_pass)(\().*?(\')(,)( )(\').*?(\')(,)( )(\').*?(\'\))/is";

						if (preg_match_all($regex, $message, $matches)) {
								foreach ($matches[0] as $key => $func) {
										$bracket = preg_split("/(\\$)(this->BBvideo_pass)/", $func);
										$param = explode("', '", $bracket[1]);
										$param[0] = substr($param[0], 2);
										$param[2] = substr($param[2], 0, strrpos($param[2], "')"));
										$effect = $this->BBvideo_pass($param[0], $param[1], $param[2]);
										if ($key == 0) {
												$init = $message;
										} else {
												$init = $mess;
										}
										$mess = str_replace($matches[0][$key], $effect, $init);
								}
								$message = $mess;
						} // End BBvideo_pass

						// Start anchor_pass
						$regex = "/(\\$)(this->anchor_pass)(\().*?(\')(,)( )(\').*?(\')(,)( )(\').*?(\'\))/is";

						if (preg_match_all($regex, $message, $matches)) {
								foreach ($matches[0] as $key => $func) {
										$bracket = preg_split("/(\\$)(this->anchor_pass)/", $func);
										$param = explode("', '", $bracket[1]);
										$param[0] = substr($param[0], 2);
										$param[2] = substr($param[2], 0, strrpos($param[2], "')"));
										$effect = $this->anchor_pass($param[0], $param[1], $param[2]);
										if ($key == 0) {
												$init = $message;
										} else {
												$init = $mess;
										}
										$mess = str_replace($matches[0][$key], $effect, $init);
								}
								$message = $mess;
						} // End anchor_pass

						// Start ed2k_pass
						$regex = "/(\\$)(t)(h)(i)(s)(-)(>)(e)(d)(2)(k)(_)(p)(a)(s)(s)(\()( ).*?(,)( )(\').*?(\')(,)( )(\').*?(\')( )(\))/is";

						if (preg_match_all($regex, $message, $matches)) {
								foreach ($matches[0] as $key => $func) {
										$bracket = preg_split("/(\\$)(this->ed2k_pass)/", $func);
										$param = explode("', '", $bracket[1]);
										$param[0] = explode(", 'ed2k:", $param[0]);
										$param[0][0] = substr($param[0][0], 2);
										$param[1] = substr($param[1], 0, strrpos($param[1], "' )"));
										$effect = $this->ed2k_pass($param[0][0], "ed2k:" . $param[0][1], $param[1]);
										if ($key == 0) {
												$init = $message;
										} else {
												$init = $mess;
										}
										$mess = str_replace($matches[0][$key], $effect, $init);
								}
								$message = $mess;
						} // End ed2k_pass

						// Start search_pass
						$regex = "/(\\$)(this->search_pass)(\().*?(\')(,)( )(\').*?(\')(,)( )(\').*?(\'\))/is";

						if (preg_match_all($regex, $message, $matches)) {
								foreach ($matches[0] as $key => $func) {
										$bracket = preg_split("/(\\$)(this->search_pass)/", $func);
										$param = explode("', '", $bracket[1]);
										$param[0] = substr($param[0], 2);
										$param[2] = substr($param[2], 0, strrpos($param[2], "')"));
										$effect = $this->search_pass($param[0], $param[1], $param[2]);
										if ($key == 0) {
												$init = $message;
										} else {
												$init = $mess;
										}
										$mess = str_replace($matches[0][$key], $effect, $init);
								}
								$message = $mess;
						} // End search_pass
						// Start thumb_pass
						$regex = "/(\\$)(this->thumb_pass)(\().*?(\')(,).*?(\').*?(\'\))/is";

						if (preg_match_all($regex, $message, $matches)) {
								foreach ($matches[0] as $key => $func) {
										$bracket = "/(\\$)(this->thumb_pass)/";
										$bracket = preg_split($bracket, $func);
										$param = explode("', '", $bracket[1]);
										$param[0] = substr($param[0], 2);
										$param[1] = substr($param[1], 0, strrpos($param[1], "')"));

										$effect = $this->thumb_pass($param[0], $param[1]);
										if ($key == 0) {
												$init = $message;
										} else {
												$init = $mess;
										}
										$mess = str_replace($matches[0][$key], $effect, $init);
								}
								$message = $mess;
						} // End thumb_pass

						// Start img_pass
						$regex = "/(\\$)(this->img_pass)(\().*?(\')(,).*?(\').*?(\'\))/is";

						if (preg_match_all($regex, $message, $matches)) {
								foreach ($matches[0] as $key => $func) {
										$bracket = "/(\\$)(this->img_pass)/";
										$bracket = preg_split($bracket, $func);
										$param = explode("', '", $bracket[1]);
										$param[0] = substr($param[0], 2);
										$param[1] = substr($param[1], 0, strrpos($param[1], "')"));

										$effect = $this->img_pass($param[0], $param[1]);
										if ($key == 0) {
												$init = $message;
										} else {
												$init = $mess;
										}
										$mess = str_replace($matches[0][$key], $effect, $init);
								}
								$message = $mess;
						} // End img_pass

						// Start offtopic_pass
						$regex = "/(\\$)(this->offtopic_pass)(\(\').*?(\'\))/is";

						if (preg_match_all($regex, $message, $matches)) {
								foreach ($matches[0] as $key => $func) {
										$bracket = "/(\\$)(this->offtopic_pass)/";
										$param = preg_split($bracket, $func);
										$param[1] = substr($param[1], 2);
										$param[1] = substr($param[1], 0, strrpos($param[1], "')"));

										$effect = $this->offtopic_pass($param[1]);
										if ($key == 0) {
												$init = $message;
										} else {
												$init = $mess;
										}
										$mess = str_replace($matches[0][$key], $effect, $init);
								}
								$message = $mess;
						} // End offtopic_pass

						// Start spoil_pass
						$regex = "/(\\$)(this->spoil_pass)(\(\').*?(\'\))/is";

						if (preg_match_all($regex, $message, $matches)) {
								foreach ($matches[0] as $key => $func) {
										$bracket = "/(\\$)(this->spoil_pass)/";
										$param = preg_split($bracket, $func);
										$param[1] = substr($param[1], 2);
										$param[1] = substr($param[1], 0, strrpos($param[1], "')"));

										$effect = $this->spoil_pass($param[1]);
										if ($key == 0) {
												$init = $message;
										} else {
												$init = $mess;
										}
										$mess = str_replace($matches[0][$key], $effect, $init);
								}
								$message = $mess;
						} // End spoil_pass

						// Start hidden_pass
						$regex = "/(\\$)(this->hidden_pass)(\(\').*?(\'\))/is";

						if (preg_match_all($regex, $message, $matches)) {
								foreach ($matches[0] as $key => $func) {
										$bracket = "/(\\$)(this->hidden_pass)/";
										$param = preg_split($bracket, $func);
										$param[1] = substr($param[1], 2);
										$param[1] = substr($param[1], 0, strrpos($param[1], "')"));

										$effect = $this->hidden_pass($param[1]);
										if ($key == 0) {
												$init = $message;
										} else {
												$init = $mess;
										}
										$mess = str_replace($matches[0][$key], $effect, $init);
								}
								$message = $mess;
						} // End hidden_pass

						// Start nfo_pass
						$regex = "/(\\$)(this->nfo_pass)(\(\').*?(\'\))/is";

						if (preg_match_all($regex, $message, $matches)) {
								foreach ($matches[0] as $key => $func) {
										$bracket = "/(\\$)(this->nfo_pass)/";
										$param = preg_split($bracket, $func);
										$param[1] = substr($param[1], 2);
										$param[1] = substr($param[1], 0, strrpos($param[1], "')"));

										$effect = $this->nfo_pass($param[1]);
										if ($key == 0) {
												$init = $message;
										} else {
												$init = $mess;
										}
										$mess = str_replace($matches[0][$key], $effect, $init);
								}
								$message = $mess;
						} // End nfo_pass

						// Start scrippets_pass
						$regex = "/(\\$)(this->scrippets_pass)(\(\').*?(\'\))/is";

						if (preg_match_all($regex, $message, $matches)) {
								foreach ($matches[0] as $key => $func) {
										$bracket = "/(\\$)(this->scrippets_pass)/";
										$param = preg_split($bracket, $func);
										$param[1] = substr($param[1], 2);
										$param[1] = substr($param[1], 0, strrpos($param[1], "')"));

										$effect = $this->scrippets_pass($param[1]);
										if ($key == 0) {
												$init = $message;
										} else {
												$init = $mess;
										}
										$mess = str_replace($matches[0][$key], $effect, $init);
								}
								$message = $mess;
						} // End scrippets_pass

						// Start testlink_pass
						$regex = "/(\\$)(this->testlink_pass)(\(\').*?(\'\))/is";

						if (preg_match_all($regex, $message, $matches)) {
								foreach ($matches[0] as $key => $func) {
										$bracket = "/(\\$)(this->testlink_pass)/";
										$param = preg_split($bracket, $func);
										$param[1] = substr($param[1], 2);
										$param[1] = substr($param[1], 0, strrpos($param[1], "')"));

										$effect = $this->testlink_pass($param[1]);
										if ($key == 0) {
												$init = $message;
										} else {
												$init = $mess;
										}
										$mess = str_replace($matches[0][$key], $effect, $init);
								}
								$message = $mess;
						} // End testlink_pass

						// Start rapidshare_pass
						$regex = "/(\\$)(this->rapidshare_pass)(\(\').*?(\'\))/is";

						if (preg_match_all($regex, $message, $matches)) {
								foreach ($matches[0] as $key => $func) {
										$bracket = "/(\\$)(this->rapidshare_pass)/";
										$param = preg_split($bracket, $func);
										$param[1] = substr($param[1], 2);
										$param[1] = substr($param[1], 0, strrpos($param[1], "')"));

										$effect = $this->rapidshare_pass($param[1]);
										if ($key == 0) {
												$init = $message;
										} else {
												$init = $mess;
										}
										$mess = str_replace($matches[0][$key], $effect, $init);
								}
								$message = $mess;
						} // End rapidshare_pass

						// Start click_pass
						$regex = "/(\\$)(this->click_pass)(\().*?(\')(,).*?(\').*?(\'\))/is";

						if (preg_match_all($regex, $message, $matches)) {
								foreach ($matches[0] as $key => $func) {
										$bracket = "/(\\$)(this->click_pass)/";
										$bracket = preg_split($bracket, $func);
										$param = explode("', '", $bracket[1]);
										$param[0] = substr($param[0], 2);
										$param[1] = substr($param[1], 0, strrpos($param[1], "')"));

										$effect = $this->click_pass($param[0], $param[1]);
										if ($key == 0) {
												$init = $message;
										} else {
												$init = $mess;
										}
										$mess = str_replace($matches[0][$key], $effect, $init);
								}
								$message = $mess;
						} // End click_pass

						// Start simpleTabs_pass
						$regex = "/(\\$)(this->simpleTabs_pass)(\(\').*?(\'\))/is";

						if (preg_match_all($regex, $message, $matches)) {
								foreach ($matches[0] as $key => $func) {
										$bracket = "/(\\$)(this->simpleTabs_pass)/";
										$param = preg_split($bracket, $func);
										$param[1] = substr($param[1], 2);
										$param[1] = substr($param[1], 0, strrpos($param[1], "')"));

										$effect = $this->simpleTabs_pass($param[1]);
										if ($key == 0) {
												$init = $message;
										} else {
												$init = $mess;
										}
										$mess = str_replace($matches[0][$key], $effect, $init);
								}
								$message = $mess;
						} // End simpleTabs_pass

						// Start flash_pass
						$regex = "/(\\$)(this->flash_pass)(\().*?(\')(,)( )(\').*?(\')(,)( )(\').*?(\'\))/is";

						if (preg_match_all($regex, $message, $matches)) {
								foreach ($matches[0] as $key => $func) {
										$bracket = preg_split("/(\\$)(this->flash_pass)/", $func);
										$param = explode("', '", $bracket[1]);
										$param[0] = substr($param[0], 2);
										$param[2] = substr($param[2], 0, strrpos($param[2], "')"));
										$effect = $this->flash_pass($param[0], $param[1], $param[2]);
										if ($key == 0) {
												$init = $message;
										} else {
												$init = $mess;
										}
										$mess = str_replace($matches[0][$key], $effect, $init);
								}
								$message = $mess;
						} // End flash_pass
						
						// Add new preg_match_all() above						
						
						$preg = array('search' => array(), 'replace' => array());
					}
					$cb = sizeof($callback['search']);
					if ($cb) {
						// we need to turn the entities back into their original form to allow the
						// search patterns to work properly
						if (!$undid_bbcode_specialchars)
						{
							$message = str_replace(array('&#58;', '&#46;'), array(':', '.'), $message);
							$undid_bbcode_specialchars = true;
						}

						for ($i=0; $i<$cb; $i++) {
							$message = preg_replace_callback($callback['search'][$i], $callback['replace'][$i], $message);
						}
						$callback = array('search' => array(), 'replace' => array());
					}
				}
			}
		}

		// Remove the uid from tags that have not been transformed into HTML
		$message = str_replace(':' . $this->bbcode_uid, '', $message);
	}

	/**
	* Init bbcode cache
	*
	* requires: $this->bbcode_bitfield
	* sets: $this->bbcode_cache with bbcode templates needed for bbcode_bitfield
	*/
	function bbcode_cache_init()
	{
		global $phpbb_root_path, $template, $user;

		if (empty($this->template_filename))
		{
			$this->template_bitfield = new bitfield($user->theme['bbcode_bitfield']);
			$this->template_filename = $phpbb_root_path . 'styles/' . $user->theme['template_path'] . '/template/bbcode.html';

			if (empty($user->theme['template_inherits_id']) && !empty($template->orig_tpl_inherits_id))
			{
				$user->theme['template_inherits_id'] = $template->orig_tpl_inherits_id;
			}

			if (!@file_exists($this->template_filename))
			{
				if (isset($user->theme['template_inherits_id']) && $user->theme['template_inherits_id'])
				{
					$this->template_filename = $phpbb_root_path . 'styles/' . $user->theme['template_inherit_path'] . '/template/bbcode.html';
					if (!@file_exists($this->template_filename))
					{
						trigger_error('The file ' . $this->template_filename . ' is missing.', E_USER_ERROR);
					}
				}
				else
				{
					trigger_error('The file ' . $this->template_filename . ' is missing.', E_USER_ERROR);
				}
			}

// MOD : MSSTI ABBC3 - Start
			$this->template_filename2 = $phpbb_root_path . 'styles/' . $user->theme['template_path'] . '/template/abbcode.html';

			if (!@file_exists($this->template_filename2))
			{
				if (isset($user->theme['template_inherits_id']) && $user->theme['template_inherits_id'])
				{
					$this->template_filename2 = $phpbb_root_path . 'styles/' . $user->theme['template_inherit_path'] . '/template/abbcode.html';
					if (!@file_exists($this->template_filename2))
					{
						trigger_error('The file ' . $this->template_filename2 . ' is missing.', E_USER_ERROR);
					}
				}
				else
				{
					trigger_error('The file ' . $this->template_filename2 . ' is missing.', E_USER_ERROR);
				}
			}
// MOD : MSSTI ABBC3 - End
		}

		$bbcode_ids = $rowset = $sql = array();


// MOD : MSSTI ABBC3 - Start
		$abbcode = new abbcode();
// MOD : MSSTI ABBC3 - end
		$bitfield = new bitfield($this->bbcode_bitfield);
		$bbcodes_set = $bitfield->get_all_set();

		foreach ($bbcodes_set as $bbcode_id)
		{
			if (isset($this->bbcode_cache[$bbcode_id]))
			{
				// do not try to re-cache it if it's already in
				continue;
			}
			$bbcode_ids[] = $bbcode_id;

			if ($bbcode_id > NUM_CORE_BBCODES)
			{
				$sql[] = $bbcode_id;
			}
		}

		if (sizeof($sql))
		{
			global $db;

			$sql = 'SELECT *
				FROM ' . BBCODES_TABLE . '
				WHERE ' . $db->sql_in_set('bbcode_id', $sql);
// MOD : MSSTI ABBC3 - Start
			$sql .= " AND bbcode_match <> '.'";
// MOD : MSSTI ABBC3 - End
			$result = $db->sql_query($sql, 3600);

			while ($row = $db->sql_fetchrow($result))
			{
				// To circumvent replacing newlines with <br /> for the generated html,
				// we use carriage returns here. They are later changed back to newlines
				$row['bbcode_tpl'] = str_replace("\n", "\r", $row['bbcode_tpl']);
				$row['second_pass_replace'] = str_replace("\n", "\r", $row['second_pass_replace']);

				$rowset[$row['bbcode_id']] = $row;
			}
			$db->sql_freeresult($result);
		}

		foreach ($bbcode_ids as $bbcode_id)
		{
			switch ($bbcode_id)
			{
				case 0:
					$this->bbcode_cache[$bbcode_id] = array(
						'str' => array(
							'[/quote:$uid]'	=> $this->bbcode_tpl('quote_close', $bbcode_id)
						),
						'callback' => array(
							'#\[quote(?:=&quot;(.*?)&quot;)?:$uid\]((?!\[quote(?:=&quot;.*?&quot;)?:$uid\]).)?#is'	=> function($matches){if(empty($matches[2])){$quote = '';}else{$quote = $matches[2];}return $this->bbcode_second_pass_quote($matches[1], $quote);}
						)
					);
				break;

				case 1:
					$this->bbcode_cache[$bbcode_id] = array(
						'str' => array(
							'[b:$uid]'	=> $this->bbcode_tpl('b_open', $bbcode_id),
							'[/b:$uid]'	=> $this->bbcode_tpl('b_close', $bbcode_id),
						)
					);
				break;

				case 2:
					$this->bbcode_cache[$bbcode_id] = array(
						'str' => array(
							'[i:$uid]'	=> $this->bbcode_tpl('i_open', $bbcode_id),
							'[/i:$uid]'	=> $this->bbcode_tpl('i_close', $bbcode_id),
						)
					);
				break;

				case 3:
					$this->bbcode_cache[$bbcode_id] = array(
						'preg' => array(

// MOD : MSSTI ABBC3 - Start
							'#\[url:$uid\](ed2k://\|(file|server|serverlist|friend)(|\|[^\\/\|:<>\*\?\"]+?)\|(.*?)\|/?)\[/url:$uid\]#si'		=> "\$this->ed2k_pass( \$bbcode_id, '\$1', '' )",
							'#\[url=(ed2k://\|(file|server|serverlist|friend)(|\|[^\\/\|:<>\*\?\"]+?)\|(.*?)\|/?):$uid\](.*?)\[/url:$uid\]#si'	=> "\$this->ed2k_pass( \$bbcode_id, '\$1', '\$5' )",
// MOD : MSSTI ABBC3 - End
							'#\[url:$uid\]((.*?))\[/url:$uid\]#s'			=> $this->bbcode_tpl('url', $bbcode_id),
							'#\[url=([^\[]+?):$uid\](.*?)\[/url:$uid\]#s'	=> $this->bbcode_tpl('url', $bbcode_id),
						)
					);
				break;

				case 4:
					if ($user->optionget('viewimg'))
					{
						$this->bbcode_cache[$bbcode_id] = array(
							'preg' => array(
								'#\[img:$uid\](.*?)\[/img:$uid\]#s'		=> $this->bbcode_tpl('img', $bbcode_id),
							)
						);
					}
					else
					{
						$this->bbcode_cache[$bbcode_id] = array(
							'preg' => array(
								'#\[img:$uid\](.*?)\[/img:$uid\]#s'		=> str_replace('$2', '[ img ]', $this->bbcode_tpl('url', $bbcode_id, true)),
							)
						);
					}
				break;

				case 5:
					$this->bbcode_cache[$bbcode_id] = array(
						'preg' => array(
							'#\[size=([\-\+]?\d+):$uid\](.*?)\[/size:$uid\]#s'	=> $this->bbcode_tpl('size', $bbcode_id),
						)
					);
				break;

				case 6:
					$this->bbcode_cache[$bbcode_id] = array(
						'preg' => array(
							'!\[color=(#[0-9a-f]{3}|#[0-9a-f]{6}|[a-z\-]+):$uid\](.*?)\[/color:$uid\]!is'	=> $this->bbcode_tpl('color', $bbcode_id),
						)
					);
				break;

				case 7:
					$this->bbcode_cache[$bbcode_id] = array(
						'str' => array(
							'[u:$uid]'	=> $this->bbcode_tpl('u_open', $bbcode_id),
							'[/u:$uid]'	=> $this->bbcode_tpl('u_close', $bbcode_id),
						)
					);
				break;

				case 8:
					$this->bbcode_cache[$bbcode_id] = array(
						'callback' => array(
                            '#\[code(?:=([a-z]+))?:$uid\](.*?)\[/code:$uid\]#is' => function($matches){return $this->bbcode_second_pass_code($matches[1], $matches[2]);},
						)
					);
				break;

				case 9:
					$this->bbcode_cache[$bbcode_id] = array(
						'preg' => array(
							'#(\[\/?(list|\*):[mou]?:?$uid\])[\n]{1}#'	=> "\$1",
							'#(\[list=([^\[]+):$uid\])[\n]{1}#'			=> "\$1",
						),
						'callback' => array(
							'#\[list=([^\[]+):$uid\]#' => function($matches){return $this->bbcode_list($matches[1]);},
						),
						'str' => array(
							'[list:$uid]'		=> $this->bbcode_tpl('ulist_open_default', $bbcode_id),
							'[/list:u:$uid]'	=> $this->bbcode_tpl('ulist_close', $bbcode_id),
							'[/list:o:$uid]'	=> $this->bbcode_tpl('olist_close', $bbcode_id),
							'[*:$uid]'			=> $this->bbcode_tpl('listitem', $bbcode_id),
							'[/*:$uid]'			=> $this->bbcode_tpl('listitem_close', $bbcode_id),
							'[/*:m:$uid]'		=> $this->bbcode_tpl('listitem_close', $bbcode_id)
						),
					);
				break;

				case 10:
					$this->bbcode_cache[$bbcode_id] = array(
						'preg' => array(
							'#\[email:$uid\]((.*?))\[/email:$uid\]#is'			=> $this->bbcode_tpl('email', $bbcode_id),
							'#\[email=([^\[]+):$uid\](.*?)\[/email:$uid\]#is'	=> $this->bbcode_tpl('email', $bbcode_id)
						)
					);
				break;

				case 11:
					if ($user->optionget('viewflash'))
					{
						$this->bbcode_cache[$bbcode_id] = array(
							'preg' => array(
								'#\[flash=([0-9]+),([0-9]+):$uid\](.*?)\[/flash:$uid\]#'	=> $this->bbcode_tpl('flash', $bbcode_id),
							)
						);
					}
					else
					{
						$this->bbcode_cache[$bbcode_id] = array(
							'preg' => array(
								'#\[flash=([0-9]+),([0-9]+):$uid\](.*?)\[/flash:$uid\]#'	=> str_replace('$1', '$3', str_replace('$2', '[ flash ]', $this->bbcode_tpl('url', $bbcode_id, true)))
							)
						);
					}
				break;

				case 12:
					$this->bbcode_cache[$bbcode_id] = array(
						'str'	=> array(
							'[/attachment:$uid]'	=> $this->bbcode_tpl('inline_attachment_close', $bbcode_id)
						),
						'preg'	=> array(
							'#\[attachment=([0-9]+):$uid\]#'	=> $this->bbcode_tpl('inline_attachment_open', $bbcode_id)
						)
					);
				break;
				
				default:
					if (isset($rowset[$bbcode_id]))
					{
						if ($this->template_bitfield->get($bbcode_id))
						{
							// The bbcode requires a custom template to be loaded
							if (!$bbcode_tpl = $this->bbcode_tpl($rowset[$bbcode_id]['bbcode_tag'], $bbcode_id))
							{
								// For some reason, the required template seems not to be available, use the default template
								$bbcode_tpl = (!empty($rowset[$bbcode_id]['second_pass_replace'])) ? $rowset[$bbcode_id]['second_pass_replace'] : $rowset[$bbcode_id]['bbcode_tpl'];
							}
							else
							{
								// In order to use templates with custom bbcodes we need
								// to replace all {VARS} to corresponding backreferences
								// Note that backreferences are numbered from bbcode_match
								if (preg_match_all('/\{(URL|LOCAL_URL|EMAIL|TEXT|SIMPLETEXT|INTTEXT|IDENTIFIER|COLOR|NUMBER)[0-9]*\}/', $rowset[$bbcode_id]['bbcode_match'], $m))
								{
									foreach ($m[0] as $i => $tok)
									{
										$bbcode_tpl = str_replace($tok, '$' . ($i + 1), $bbcode_tpl);
									}
								}
							}
						}
						else
						{
							// Default template
							$bbcode_tpl = (!empty($rowset[$bbcode_id]['second_pass_replace'])) ? $rowset[$bbcode_id]['second_pass_replace'] : $rowset[$bbcode_id]['bbcode_tpl'];
						}

						// Replace {L_*} lang strings
// MOD : MSSTI ABBC3 - Start
						$user->add_lang('mods/abbcode');
// MOD : MSSTI ABBC3 - End
						$bbcode_tpl = preg_replace_callback('/{L_([A-Z0-9_]+)}/', function($matches){global $user; return (!empty($user->lang[$matches[1]])) ? $user->lang[$matches[1]] : ucwords(strtolower(str_replace('_', ' ', $matches[1])));}, $bbcode_tpl);

						if (!empty($rowset[$bbcode_id]['second_pass_replace']))
						{
							// The custom BBCode requires second-pass pattern replacements
							$this->bbcode_cache[$bbcode_id] = array(
								'preg' => array($rowset[$bbcode_id]['second_pass_match'] => $bbcode_tpl)
							);
						}
						else
						{
							$this->bbcode_cache[$bbcode_id] = array(
								'str' => array($rowset[$bbcode_id]['second_pass_match'] => $bbcode_tpl)
							);
						}
					}
					else
					{
						$this->bbcode_cache[$bbcode_id] = false;
					}
				break;
			}
		}
	}

	/**
	* Return bbcode template
	*/
	function bbcode_tpl($tpl_name, $bbcode_id = -1, $skip_bitfield_check = false)
	{
		static $bbcode_hardtpl = array();
		if (empty($bbcode_hardtpl))
		{
			global $user;

			$bbcode_hardtpl = array(
				'b_open'	=> '<span style="font-weight: bold">',
				'b_close'	=> '</span>',
				'i_open'	=> '<span style="font-style: italic">',
				'i_close'	=> '</span>',
				'u_open'	=> '<span style="text-decoration: underline">',
				'u_close'	=> '</span>',
				'img'		=> '<img src="$1" alt="' . $user->lang['IMAGE'] . '" class="resize_me" />',
				'size'		=> '<span style="font-size: $1%; line-height: normal">$2</span>',
				'color'		=> '<span style="color: $1">$2</span>',
				'email'		=> '<a href="mailto:$1">$2</a>'
			);
		}

		if ($bbcode_id != -1 && !$skip_bitfield_check && !$this->template_bitfield->get($bbcode_id))
		{
			return (isset($bbcode_hardtpl[$tpl_name])) ? $bbcode_hardtpl[$tpl_name] : false;
		}

		if (empty($this->bbcode_template))
		{
			if (($tpl = file_get_contents($this->template_filename)) === false)
			{
				trigger_error('Could not load bbcode template', E_USER_ERROR);
			}
// MOD : MSSTI ABBC3 - Start
			if (($tpl2 = file_get_contents($this->template_filename2)) === false)
			{
				trigger_error('Could not load abbcode template', E_USER_ERROR);
			}
			else
			{
				$tpl .= $tpl2;
			}
// MOD : MSSTI ABBC3 - End

			// replace \ with \\ and then ' with \'.
			$tpl = str_replace('\\', '\\\\', $tpl);
			$tpl = str_replace("'", "\'", $tpl);

			// strip newlines and indent
			$tpl = preg_replace("/\n[\n\r\s\t]*/", '', $tpl);

			// Turn template blocks into PHP assignment statements for the values of $bbcode_tpl..
			$this->bbcode_template = array();

			$matches = preg_match_all('#<!-- BEGIN (.*?) -->(.*?)<!-- END (?:.*?) -->#', $tpl, $match);

			for ($i = 0; $i < $matches; $i++)
			{
				if (empty($match[1][$i]))
				{
					continue;
				}

				$this->bbcode_template[$match[1][$i]] = $this->bbcode_tpl_replace($match[1][$i], $match[2][$i]);
			}
		}

		return (isset($this->bbcode_template[$tpl_name])) ? $this->bbcode_template[$tpl_name] : ((isset($bbcode_hardtpl[$tpl_name])) ? $bbcode_hardtpl[$tpl_name] : false);
	}

	/**
	* Return bbcode template replacement
	*/
	function bbcode_tpl_replace($tpl_name, $tpl)
	{
		global $user;

		static $replacements = array(
			'quote_username_open'	=> array('{USERNAME}'	=> '$1'),
			'color'					=> array('{COLOR}'		=> '$1', '{TEXT}'			=> '$2'),
			'size'					=> array('{SIZE}'		=> '$1', '{TEXT}'			=> '$2'),
			'img'					=> array('{URL}'		=> '$1'),
			'flash'					=> array('{WIDTH}'		=> '$1', '{HEIGHT}'			=> '$2', '{URL}'	=> '$3'),
			'url'					=> array('{URL}'		=> '$1', '{DESCRIPTION}'	=> '$2'),
			'email'					=> array('{EMAIL}'		=> '$1', '{DESCRIPTION}'	=> '$2')
		);

		$tpl = preg_replace_callback('/{L_([A-Z0-9_]+)}/', function($matches){global $user; return (!empty($user->lang[$matches[1]])) ? $user->lang[$matches[1]] : ucwords(strtolower(str_replace('_', ' ', $matches[1])));}, $tpl);

		if (!empty($replacements[$tpl_name]))
		{
			$tpl = strtr($tpl, $replacements[$tpl_name]);
		}

		return trim($tpl);
	}

	/**
	* Second parse list bbcode
	*/
	function bbcode_list($type)
	{
		if ($type == '')
		{
			$tpl = 'ulist_open_default';
			$type = 'default';
		}
		else if ($type == 'i')
		{
			$tpl = 'olist_open';
			$type = 'lower-roman';
		}
		else if ($type == 'I')
		{
			$tpl = 'olist_open';
			$type = 'upper-roman';
		}
		else if (preg_match('#^(disc|circle|square)$#i', $type))
		{
			$tpl = 'ulist_open';
			$type = strtolower($type);
		}
		else if (preg_match('#^[a-z]$#', $type))
		{
			$tpl = 'olist_open';
			$type = 'lower-alpha';
		}
		else if (preg_match('#[A-Z]#', $type))
		{
			$tpl = 'olist_open';
			$type = 'upper-alpha';
		}
		else if (is_numeric($type))
		{
			$tpl = 'olist_open';
			$type = 'decimal';
		}
		else
		{
			$tpl = 'olist_open';
			$type = 'decimal';
		}

		return str_replace('{LIST_TYPE}', $type, $this->bbcode_tpl($tpl));
	}

	/**
	* Second parse quote tag
	*/
	function bbcode_second_pass_quote($username, $quote)
	{
		// when using the /e modifier, preg_replace slashes double-quotes but does not
		// seem to slash anything else
		$quote = str_replace('\"', '"', $quote);
		$username = str_replace('\"', '"', $username);

		// remove newline at the beginning
		if ($quote == "\n")
		{
			$quote = '';
		}

		$quote = (($username) ? str_replace('$1', $username, $this->bbcode_tpl('quote_username_open')) : $this->bbcode_tpl('quote_open')) . $quote;

		return $quote;
	}

	/**
	* Second parse code tag
	*/
	function bbcode_second_pass_code($type, $code)
	{
		// when using the /e modifier, preg_replace slashes double-quotes but does not
		// seem to slash anything else
		$code = str_replace('\"', '"', $code);

		switch ($type)
		{
			case 'php':
				// Not the english way, but valid because of hardcoded syntax highlighting
				if (strpos($code, '<span class="syntaxdefault"><br /></span>') === 0)
				{
					$code = substr($code, 41);
				}

			// no break;

			default:
				$code = str_replace("\t", '&nbsp; &nbsp;', $code);
				$code = str_replace('  ', '&nbsp; ', $code);
				$code = str_replace('  ', ' &nbsp;', $code);
				$code = str_replace("\n ", "\n&nbsp;", $code);

				// keep space at the beginning
				if (!empty($code) && $code[0] == ' ')
				{
					$code = '&nbsp;' . substr($code, 1);
				}

				// remove newline at the beginning
				if (!empty($code) && $code[0] == "\n")
				{
					$code = substr($code, 1);
				}
			break;
		}

		$code = $this->bbcode_tpl('code_open') . $code . $this->bbcode_tpl('code_close');

		return $code;
	}
}
