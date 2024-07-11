<?php
/**
*
* @package phpBB3 User Blog
* @version $Id: download.php 485 2008-08-15 23:33:57Z exreaction@gmail.com $
* @copyright (c) 2008 EXreaction, Lithium Studios
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

include($phpbb_root_path . 'blog/includes/functions_attachments.' . $phpEx);
$blog_attachment = new blog_attachment();

$user->add_lang('viewtopic');
$download_id = request_var('id', 0);
$mode = request_var('mode', '');

if (!$download_id)
{
	trigger_error('NO_ATTACHMENT_SELECTED');
}

if (!$config['allow_attachments'] && !$config['allow_pm_attach'])
{
	trigger_error('ATTACHMENT_FUNCTIONALITY_DISABLED');
}

$sql = 'SELECT *
	FROM ' . BLOGS_ATTACHMENT_TABLE . "
	WHERE attach_id = $download_id";
$result = $db->sql_query_limit($sql, 1);
$attachment = $db->sql_fetchrow($result);
$db->sql_freeresult($result);

if (!$attachment)
{
	trigger_error('ERROR_NO_ATTACHMENT');
}

$row = array();

if ($attachment['is_orphan'])
{
	if ($attachment['poster_id'] != $user->data['user_id'])
	{
		trigger_error('ERROR_NO_ATTACHMENT');
	}
}

if (!$auth->acl_get('u_download'))
{
	trigger_error('SORRY_AUTH_VIEW_ATTACH');
}

blog_plugins::plugin_do('download_start');

// Obtain all extensions...
$extensions = $blog_attachment->obtain_blog_attach_extensions(true);

// disallowed?
if (!isset($extensions['_allowed_'][$attachment['extension']]))
{
	trigger_error(sprintf($user->lang['EXTENSION_DISABLED_AFTER_POSTING'], $attachment['extension']));
}

if (!download_allowed())
{
	trigger_error($user->lang['LINKAGE_FORBIDDEN']);
}

$download_mode = (int) $extensions[$attachment['extension']]['download_mode'];

$attachment['physical_filename'] = basename($attachment['physical_filename']);
$display_cat = $extensions[$attachment['extension']]['display_cat'];

if (($display_cat == ATTACHMENT_CATEGORY_IMAGE || $display_cat == ATTACHMENT_CATEGORY_THUMB) && !$user->optionget('viewimg'))
{
	$display_cat = ATTACHMENT_CATEGORY_NONE;
}

if ($display_cat == ATTACHMENT_CATEGORY_FLASH && !$user->optionget('viewflash'))
{
	$display_cat = ATTACHMENT_CATEGORY_NONE;
}

if ($mode == 'thumbnail')
{
	$attachment['physical_filename'] = 'thumb_' . $attachment['physical_filename'];
}
else if (($display_cat == ATTACHMENT_CATEGORY_NONE || $display_cat == ATTACHMENT_CATEGORY_IMAGE) && !$attachment['is_orphan'])
{
	// Update download count
	$sql = 'UPDATE ' . BLOGS_ATTACHMENT_TABLE . '
		SET download_count = download_count + 1
		WHERE attach_id = ' . $attachment['attach_id'];
	$db->sql_query($sql);
}

blog_plugins::plugin_do('download_before_send');

if ($display_cat == ATTACHMENT_CATEGORY_IMAGE && $mode === 'view' && (strpos($attachment['mimetype'], 'image') === 0) && strpos(strtolower($user->browser), 'msie') !== false)
{
	wrap_img_in_html(append_sid('./blog.' . $phpEx, 'page=download&amp;id=' . $attachment['attach_id']), $attachment['real_filename']);
}
else
{
	// Determine the 'presenting'-method
	if ($download_mode == PHYSICAL_LINK)
	{
		// This presenting method should no longer be used
		if (!@is_dir($phpbb_root_path . $config['upload_path']))
		{
			trigger_error($user->lang['PHYSICAL_DOWNLOAD_NOT_POSSIBLE']);
		}

		redirect($phpbb_root_path . $config['upload_path'] . '/' . $attachment['physical_filename']);
		exit;
	}
	else
	{
		send_file_to_browser($attachment, $config['upload_path'] . '/blog_mod', $display_cat);
		exit;
	}
}

blog_plugins::plugin_do('download_end');

/**
* Wraps an url into a simple html page. Used to display attachments in IE.
* this is a workaround for now; might be moved to template system later
* direct any complaints to 1 Microsoft Way, Redmond
*/
function wrap_img_in_html($src, $title)
{
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-Strict.dtd">';
	echo '<html>';
	echo '<head>';
	echo '<meta http-equiv="content-type" content="text/html; charset=UTF-8" />';
	echo '<title>' . $title . '</title>';
	echo '</head>';
	echo '<body>';
	echo '<div>';
	echo '<img src="' . $src . '" alt="' . $title . '" />';
	echo '</div>';
	echo '</body>';
	echo '</html>';
}

/**
* Send file to browser
*/
function send_file_to_browser($attachment, $upload_dir, $category)
{
	global $user, $db, $config, $phpbb_root_path;

	$filename = $phpbb_root_path . $upload_dir . '/' . $attachment['physical_filename'];

	if (!@file_exists($filename))
	{
		trigger_error($user->lang['ERROR_NO_ATTACHMENT'] . '<br /><br />' . sprintf($user->lang['FILE_NOT_FOUND_404'], $filename));
	}

	// Correct the mime type - we force application/octetstream for all files, except images
	// Please do not change this, it is a security precaution
	if ($category != ATTACHMENT_CATEGORY_IMAGE || strpos($attachment['mimetype'], 'image') !== 0)
	{
		$attachment['mimetype'] = (strpos(strtolower($user->browser), 'msie') !== false || strpos(strtolower($user->browser), 'opera') !== false) ? 'application/octetstream' : 'application/octet-stream';
	}

	if (@ob_get_length())
	{
		@ob_end_clean();
	}

	// Now send the File Contents to the Browser
	$size = @filesize($filename);

	// To correctly display further errors we need to make sure we are using the correct headers for both (unsetting content-length may not work)

	// Check if headers already sent or not able to get the file contents.
	if (headers_sent() || !@file_exists($filename) || !@is_readable($filename))
	{
		// PHP track_errors setting On?
		if (!empty($php_errormsg))
		{
			trigger_error($user->lang['UNABLE_TO_DELIVER_FILE'] . '<br />' . sprintf($user->lang['TRACKED_PHP_ERROR'], $php_errormsg));
		}

		trigger_error('UNABLE_TO_DELIVER_FILE');
	}

	// Now the tricky part... let's dance
	header('Pragma: public');

	/**
	* Commented out X-Sendfile support. To not expose the physical filename within the header if xsendfile is absent we need to look into methods of checking it's status.
	*
	* Try X-Sendfile since it is much more server friendly - only works if the path is *not* outside of the root path...
	* lighttpd has core support for it. An apache2 module is available at http://celebnamer.celebworld.ws/stuff/mod_xsendfile/
	*
	* Not really ideal, but should work fine...
	* <code>
	*	if (strpos($upload_dir, '/') !== 0 && strpos($upload_dir, '../') === false)
	*	{
	*		header('X-Sendfile: ' . $filename);
	*	}
	* </code>
	*/

	// Send out the Headers. Do not set Content-Disposition to inline please, it is a security measure for users using the Internet Explorer.
	header('Content-Type: ' . $attachment['mimetype']);

	if (empty($user->browser) || (strpos(strtolower($user->browser), 'msie') !== false))
	{
		header('Content-Disposition: attachment; ' . header_filename(htmlspecialchars_decode($attachment['real_filename'])));
		if (empty($user->browser) || (strpos(strtolower($user->browser), 'msie 6.0') !== false))
		{
			header('expires: -1');
		}
	}
	else
	{
		header('Content-Disposition: ' . ((strpos($attachment['mimetype'], 'image') === 0) ? 'inline' : 'attachment') . '; ' . header_filename(htmlspecialchars_decode($attachment['real_filename'])));
	}

	if ($size)
	{
		header("Content-Length: $size");
	}

	// Try to deliver in chunks
	@set_time_limit(0);

	$fp = @fopen($filename, 'rb');

	if ($fp !== false)
	{
		while (!feof($fp))
		{
			echo fread($fp, 8192);
		}
		fclose($fp);
	}
	else
	{
		@readfile($filename);
	}

	flush();
	exit;
}

/**
* Get a browser friendly UTF-8 encoded filename
*/
function header_filename($file)
{
	$user_agent = (!empty($_SERVER['HTTP_USER_AGENT'])) ? htmlspecialchars((string) $_SERVER['HTTP_USER_AGENT']) : '';

	// There be dragons here.
	// Not many follows the RFC...
	if (strpos($user_agent, 'MSIE') !== false || strpos($user_agent, 'Safari') !== false || strpos($user_agent, 'Konqueror') !== false)
	{
		return "filename=" . rawurlencode($file);
	}

	// follow the RFC for extended filename for the rest
	return "filename*=UTF-8''" . rawurlencode($file);
}

/**
* Check if downloading item is allowed
*/
function download_allowed()
{
	global $config, $user, $db;

	if (!$config['secure_downloads'])
	{
		return true;
	}

	$url = (!empty($_SERVER['HTTP_REFERER'])) ? trim($_SERVER['HTTP_REFERER']) : trim(getenv('HTTP_REFERER'));

	if (!$url)
	{
		return ($config['secure_allow_empty_referer']) ? true : false;
	}

	// Split URL into domain and script part
	$url = @parse_url($url);

	if ($url === false)
	{
		return ($config['secure_allow_empty_referer']) ? true : false;
	}

	$hostname = $url['host'];
	unset($url);

	$allowed = ($config['secure_allow_deny']) ? false : true;
	$iplist = array();

	if (($ip_ary = @gethostbynamel($hostname)) !== false)
	{
		foreach ($ip_ary as $ip)
		{
			if ($ip)
			{
				$iplist[] = $ip;
			}
		}
	}

	// Check for own server...
	$server_name = (!empty($_SERVER['SERVER_NAME'])) ? $_SERVER['SERVER_NAME'] : getenv('SERVER_NAME');

	// Forcing server vars is the only way to specify/override the protocol
	if ($config['force_server_vars'] || !$server_name)
	{
		$server_name = $config['server_name'];
	}

	if (preg_match('#^.*?' . preg_quote($server_name, '#') . '.*?$#i', $hostname))
	{
		$allowed = true;
	}

	// Get IP's and Hostnames
	if (!$allowed)
	{
		$sql = 'SELECT site_ip, site_hostname, ip_exclude
			FROM ' . SITELIST_TABLE;
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$site_ip = trim($row['site_ip']);
			$site_hostname = trim($row['site_hostname']);

			if ($site_ip)
			{
				foreach ($iplist as $ip)
				{
					if (preg_match('#^' . str_replace('\*', '.*?', preg_quote($site_ip, '#')) . '$#i', $ip))
					{
						if ($row['ip_exclude'])
						{
							$allowed = ($config['secure_allow_deny']) ? false : true;
							break 2;
						}
						else
						{
							$allowed = ($config['secure_allow_deny']) ? true : false;
						}
					}
				}
			}

			if ($site_hostname)
			{
				if (preg_match('#^' . str_replace('\*', '.*?', preg_quote($site_hostname, '#')) . '$#i', $hostname))
				{
					if ($row['ip_exclude'])
					{
						$allowed = ($config['secure_allow_deny']) ? false : true;
						break;
					}
					else
					{
						$allowed = ($config['secure_allow_deny']) ? true : false;
					}
				}
			}
		}
		$db->sql_freeresult($result);
	}

	return $allowed;
}

?>