<?php
/**
*
* acp [English]
*
* @package acp_user_details
* @version 1.0.0
* @copyright (c) 2008 david63
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang = array_merge($lang, array(
	'ACP_USER_DETAILS'				=> 'User details',
	'USER_DETAILS_SELECT'			=> 'From here you can select the User attributes that you want to display.<br />The maximum number of attributes is defined by the "Attribute Column Size" which is set at %1$s.<br />The "Can Filter" column indicates which columns you will be able to filter.',
	'USER_DETAILS_DISPLAY'			=> 'This is the display of the User attributes that you have selected.',
	'INSTALL_NOT_DELETED'			=> 'The install file for this mod has not been deleted',
	'OPTS_TOO_LONG'					=> 'Unable to save the options. There were too many options to be saved.',

	'ATTRIBUTE'						=> 'Attribute',
	'ATTRIBUTE_EXPLAIN'				=> 'Attribute description',
	'SIZE'							=> 'Attribute column size',
	'CAN_FILTER'					=> 'Can filter',
	'NO_ATTRIBUTES_SELECTED'		=> 'No attributes selected',
	'TOO_MANY_ATTRIBUTES'			=> 'You have selected %1$s attribute columns.<br />The maximum available is %2$s',
	'CLEAR_ATTRIB'					=> 'Clear attributes',

	'USER_ID'						=> 'User id',
	'USER_ID_EXPLAIN'				=> 'The user’s id on this board.',
	'USER_TYPE'						=> 'User type',
	'USER_TYPE_EXPLAIN'				=> 'The user’s type.',
	'USER_GROUP'					=> 'Group',
	'USER_GROUP_EXPLAIN'			=> 'The user’s default group.',
	'USER_IP'						=> 'User ip',
	'USER_IP_EXPLAIN'				=> 'The user’s ip address upon registration on this board.',
	'USER_REGDATE'					=> 'Regdate',
	'USER_REGDATE_EXPLAIN'			=> 'The date that the user registered on this board.',
	'USER_PASS_CHANGE'				=> 'Password change',
	'USER_PASS_CHANGE_EXPLAIN'		=> 'The date when the user’s password is due to be changed.',
	'USER_EMAIL'					=> 'Email',
	'USER_EMAIL_EXPLAIN'			=> 'The user’s email address.',
	'USER_BIRTHDAY'					=> 'Birthday',
	'USER_BIRTHDAY_EXPLAIN'			=> 'The user’s date of birth, if entered, and age.',
	'USER_LASTVISIT'				=> 'Last visit',
	'USER_LASTVISIT_EXPLAIN'		=> 'The date &amp; time of the user’s last visit to this board.',
	'USER_LASTMARK'					=> 'Last mark',
	'USER_LASTMARK_EXPLAIN'			=> 'The last time that the user marked all forums as read.',
	'USER_LASTPOST_TIME'			=> 'Last post time',
	'USER_LASTPOST_TIME_EXPLAIN'	=> 'The date &amp; time that the user last posted on this board.',
	'USER_LAST_PAGE'				=> 'Last page',
	'USER_LAST_PAGE_EXPLAIN'		=> 'The last page that the user visited.',
	'USER_LAST_SEARCH'				=> 'Last search',
	'USER_LAST_SEARCH_EXPLAIN'		=> 'The date &amp; time that the user last used the search.',
	'USER_WARNINGS'					=> 'Warnings',
	'USER_WARNINGS_EXPLAIN'			=> 'The number of warnings that the user has been given.',
	'USER_LAST_WARNING'				=> 'Last warning',
	'USER_LAST_WARNING_EXPLAIN'		=> 'The date that the user received their last warning.',
	'USER_LOGIN_ATTEMPTS'			=> 'Login attempts',
	'USER_LOGIN_ATTEMPTS_EXPLAIN'	=> 'The number of failed login attempts that the user has made.',
	'USER_INACTIVE_REASON'			=> 'Inactive reason',
	'USER_INACTIVE_REASON_EXPLAIN'	=> 'The reason why this user’s account is inactive.',
	'USER_INACTIVE_TIME'			=> 'Inactive time',
	'USER_INACTIVE_TIME_EXPLAIN'	=> 'The date &amp; time that the user’s account became inactive.',
	'USER_POSTS'					=> 'Posts',
	'USER_POSTS_EXPLAIN'			=> 'The number of posts that the user has made on this board.',
	'USER_LANG'						=> 'Language',
	'USER_LANG_EXPLAIN'				=> 'The user’s language.',
	'USER_TIMEZONE'					=> 'Timezone',
	'USER_TIMEZONE_EXPLAIN'			=> 'The user’s timezone.',
	'USER_DST'						=> 'DST',
	'USER_DST_EXPLAIN'				=> 'Does the user have daylight Saving Time set?',
	'USER_DATE_FORMAT'				=> 'Date format',
	'USER_DATE_FORMAT_EXPLAIN'		=> 'The format that the user sees the date &amp; time.',
	'USER_STYLE'					=> 'Style',
	'USER_STYLE_EXPLAIN'			=> 'The user’s style.<br />NOTE: This may not be the style that the user sees - it depends on whether override user style has been set at board level.',
	'USER_RANK'						=> 'Rank',
	'USER_RANK_EXPLAIN'				=> 'The user’s rank.',
	'USER_NEW_PRIVMSG'				=> 'New private messages',
	'USER_NEW_PRIVMSG_EXPLAIN'		=> 'The number of new private messages that the user has.',
	'USER_UNREAD_PRIVMSG'			=> 'Unread private messages',
	'USER_UNREAD_PRIVMSG_EXPLAIN'	=> 'The number of unread private messages that the user has.',
	'USER_LAST_PRIVMSG'				=> 'Last private message',
	'USER_LAST_PRIVMSG_EXPLAIN'		=> 'The date &amp; time of the user’s last private message.',
	'USER_EMAILTIME'				=> 'Email time',
	'USER_EMAILTIME_EXPLAIN'		=> 'The date &amp; time of the user’s last email.',
	'USER_NOTIFY'					=> 'Notify post',
	'USER_NOTIFY_EXPLAIN'			=> 'Does the user receive notifications for new posts in forums that they are subscribed to?',
	'USER_NOTIFY_PM'				=> 'Notify PM',
	'USER_NOTIFY_PM_EXPLAIN'		=> 'Does the user receive notifications for PM’s?',
	'USER_NOTIFY_TYPE'				=> 'Notify type',
	'USER_NOTIFY_TYPE_EXPLAIN'		=> 'What type of notifications does the user receive?',
	'USER_ALLOW_PM'					=> 'Allow PM',
	'USER_ALLOW_PM_EXPLAIN'			=> 'Allow other users to send this user a private message.',
	'USER_ALLOW_VIEWONLINE'			=> 'View online',
	'USER_ALLOW_VIEWONLINE_EXPLAIN'	=> 'Does the user hide their online status?',
	'USER_ALLOW_VIEWEMAIL'			=> 'View email',
	'USER_ALLOW_VIEWEMAIL_EXPLAIN'	=> 'Can a user contact this user by email?',
	'USER_ALLOW_MASSEMAIL'			=> 'Mass email',
	'USER_ALLOW_MASSEMAIL_EXPLAIN'	=>  'Can the user be contacted by mass email from an Admin?',
	'USER_AVATAR'					=> 'Avatar',
	'USER_AVATAR_EXPLAIN'			=> 'Display the user’s avatar.',
	'USER_AVATAR_TYPE'				=> 'Avatar type',
	'USER_AVATAR_TYPE_EXPLAIN'		=> 'The user’s avatar type.',
	'USER_SIG'						=> 'Signature',
	'USER_SIG_EXPLAIN'				=> 'Display the user’s signature.',
	'USER_FROM'						=> 'From',
	'USER_FROM_EXPLAIN'				=> 'Where is the user from?',
	
	'USER_FB'						=> 'Facebook',
	'USER_FB_EXPLAIN'				=> 'Facebook-Kontakt oder Profil-Link des Benutzers.',
	'USER_IG'						=> 'Instagram',
	'USER_IG_EXPLAIN'				=> 'Instagram-Benutzername oder Profil-Link des Benutzers.',
	'USER_PT'						=> 'Pinterest',
	'USER_PT_EXPLAIN'				=> 'Pinterest-Benutzername oder Profil-Link des Benutzers.',
	'USER_TWR'						=> 'Twitter',
	'USER_TWR_EXPLAIN'				=> 'Twitter-Benutzername oder Profil-Link des Benutzers.',
	'USER_SKP'						=> 'Skype',
	'USER_SKP_EXPLAIN'				=> 'Skype-Benutzername des Benutzers. Skype muss installiert und konfiguriert sein.',
	'USER_TG'						=> 'Telegram',
	'USER_TG_EXPLAIN'				=> 'Telegram-Benutzername oder Kontakt-Link des Benutzers.',
	'USER_LI'						=> 'LinkedIn',
	'USER_LI_EXPLAIN'				=> 'LinkedIn-Profil-URL des Benutzers.',
	'USER_TT'						=> 'TikTok',
	'USER_TT_EXPLAIN'				=> 'TikTok-Benutzername oder Profil-Link des Benutzers.',
	'USER_DC'						=> 'Discord',
	'USER_DC_EXPLAIN'				=> 'Discord-Tag des Benutzers (z. B. benutzer#1234).',
	
	'USER_ICQ'						=> 'ICQ',
	'USER_ICQ_EXPLAIN'				=> 'The user’s ICQ address.',
	'USER_AIM'						=> 'AIM',
	'USER_AIM_EXPLAIN'				=> 'The user’s AIM address.',
	'USER_YIM'						=> 'YIM',
	'USER_YIM_EXPLAIN'				=> 'The user’s YIM address.',
	'USER_MSNM'						=> 'MSMN',
	'USER_MSNM_EXPLAIN'				=> 'The user’s MSNM address.',
	'USER_JABBER'					=> 'Jabber',
	'USER_JABBER_EXPLAIN'			=> 'The user’s Jabber address.',
	'USER_WEBSITE'					=> 'Website',
	'USER_WEBSITE_EXPLAIN'			=> 'The user’s website.',
	'USER_OCC'						=> 'Occupation',
	'USER_OCC_EXPLAIN'				=> 'The user’s occupation.',
	'USER_INTERESTS'				=> 'Interests',
	'USER_INTERESTS_EXPLAIN'		=> 'The user’s interests.',

	'USER_NORMAL'					=> 'Normal',
	'USER_INACTIVE'					=> 'Inactive',
	'USER_IGNORE'					=> 'Ignoreed',
	'USER_FOUNDER'					=> 'Founder',

	'HOUR'							=> 'hour',
	'HOURS'							=> 'hours',

	'EMAIL_JABBER'					=> 'E-mail &amp; Jabber',

	'ALL'							=> 'All',
	'FILTER_BY'						=> 'Filter by',
	'FILTER_CHAR'					=> 'character',
	'TOTAL_USERS'					=> 'Total users',

	'AVATAR_UPLOAD'					=> 'Uploaded avatar',
	'AVATAR_REMOTE'					=> 'Remote avatar',
	'AVATAR_GALLERY'				=> 'Gallery avatar',

	// Board config
	'MAX_ATTRIBUTE_COLS'			=> 'Maximum attribute columns',
	'MAX_ATTRIBUTE_COLS_EXPLAIN'	=> 'The maximum number of attribute column sizes that you can display on the User Data list.<br />Setting this to 999 will disable this check.',
	'SAVE_OPTS'						=> 'Save user details selected options',
	'SAVE_OPTS_EXPLAIN'				=> 'Save the selected options for user details so that they will be available for the next request.',
));

// Install
$lang = array_merge($lang, array(
	'NO_FOUNDER'					=> 'You are not authorised to install this mod - you need Founder status.',
	'INSTALL_USER_DETAILS'			=> 'Installing User Details Mod',
	'UPDATE_USER_DETAILS'			=> 'Updating User Details Mod',
	'COMPLETE'						=> 'Install complete ...',
));

?>