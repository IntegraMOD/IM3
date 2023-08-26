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

/**
* valid external constants:
* PHPBB_MSG_HANDLER
* PHPBB_DB_NEW_LINK
* PHPBB_ROOT_PATH
* PHPBB_ADMIN_PATH
*/

// phpBB Version
define('PHPBB_VERSION', '3.0.14');

// QA-related
// define('PHPBB_QA', 1);

// User related
define('ANONYMOUS', 1);

define('USER_ACTIVATION_NONE', 0);
define('USER_ACTIVATION_SELF', 1);
define('USER_ACTIVATION_ADMIN', 2);
define('USER_ACTIVATION_DISABLE', 3);

define('AVATAR_UPLOAD', 1);
define('AVATAR_REMOTE', 2);
define('AVATAR_GALLERY', 3);

define('USER_NORMAL', 0);
define('USER_INACTIVE', 1);
define('USER_IGNORE', 2);
define('USER_FOUNDER', 3);

define('INACTIVE_REGISTER', 1);
define('INACTIVE_PROFILE', 2);
define('INACTIVE_MANUAL', 3);
define('INACTIVE_REMIND', 4);

// ACL
define('ACL_NEVER', 0);
define('ACL_YES', 1);
define('ACL_NO', -1);

// Login error codes
define('LOGIN_CONTINUE', 1);
define('LOGIN_BREAK', 2);
define('LOGIN_SUCCESS', 3);
define('LOGIN_SUCCESS_CREATE_PROFILE', 20);
define('LOGIN_ERROR_USERNAME', 10);
define('LOGIN_ERROR_PASSWORD', 11);
define('LOGIN_ERROR_ACTIVE', 12);
define('LOGIN_ERROR_ATTEMPTS', 13);
define('LOGIN_ERROR_EXTERNAL_AUTH', 14);
define('LOGIN_ERROR_PASSWORD_CONVERT', 15);

// Maximum login attempts
// The value is arbitrary, but it has to fit into the user_login_attempts field.
define('LOGIN_ATTEMPTS_MAX', 100);

// Group settings
define('GROUP_OPEN', 0);
define('GROUP_CLOSED', 1);
define('GROUP_HIDDEN', 2);
define('GROUP_SPECIAL', 3);
define('GROUP_FREE', 4);

// Forum/Topic states
define('FORUM_CAT', 0);
define('FORUM_POST', 1);
define('FORUM_LINK', 2);
define('ITEM_UNLOCKED', 0);
define('ITEM_LOCKED', 1);
define('ITEM_MOVED', 2);

// Forum Flags
define('FORUM_FLAG_LINK_TRACK', 1);
define('FORUM_FLAG_PRUNE_POLL', 2);
define('FORUM_FLAG_PRUNE_ANNOUNCE', 4);
define('FORUM_FLAG_PRUNE_STICKY', 8);
define('FORUM_FLAG_ACTIVE_TOPICS', 16);
define('FORUM_FLAG_POST_REVIEW', 32);
define('FORUM_FLAG_QUICK_REPLY', 64);

// Forum Options... sequential order. Modifications should begin at number 10 (number 29 is maximum)
define('FORUM_OPTION_FEED_NEWS', 1);
define('FORUM_OPTION_FEED_EXCLUDE', 2);

// Optional text flags
define('OPTION_FLAG_BBCODE', 1);
define('OPTION_FLAG_SMILIES', 2);
define('OPTION_FLAG_LINKS', 4);

// Topic types
define('POST_NORMAL', 0);
define('POST_STICKY', 1);
define('POST_ANNOUNCE', 2);
define('POST_GLOBAL', 3);
define('POST_NEWS', 4);
define('POST_NEWS_GLOBAL', 5);

// Lastread types
define('TRACK_NORMAL', 0);
define('TRACK_POSTED', 1);

// Notify methods
define('NOTIFY_EMAIL', 0);
define('NOTIFY_IM', 1);
define('NOTIFY_BOTH', 2);

// Notify status
define('NOTIFY_YES', 0);
define('NOTIFY_NO', 1);

// Email Priority Settings
define('MAIL_LOW_PRIORITY', 4);
define('MAIL_NORMAL_PRIORITY', 3);
define('MAIL_HIGH_PRIORITY', 2);

// Log types
define('LOG_ADMIN', 0);
define('LOG_MOD', 1);
define('LOG_CRITICAL', 2);
define('LOG_USERS', 3);
define('LOG_GALLERY', 4);

// Private messaging - Do NOT change these values
define('PRIVMSGS_HOLD_BOX', -4);
define('PRIVMSGS_NO_BOX', -3);
define('PRIVMSGS_OUTBOX', -2);
define('PRIVMSGS_SENTBOX', -1);
define('PRIVMSGS_INBOX', 0);

// Full Folder Actions
define('FULL_FOLDER_NONE', -3);
define('FULL_FOLDER_DELETE', -2);
define('FULL_FOLDER_HOLD', -1);

// Download Modes - Attachments
define('INLINE_LINK', 1);
// This mode is only used internally to allow modders extending the attachment functionality
define('PHYSICAL_LINK', 2);

// Confirm types
define('CONFIRM_REG', 1);
define('CONFIRM_LOGIN', 2);
define('CONFIRM_POST', 3);
define('CONFIRM_REPORT', 4);

// Categories - Attachments
define('ATTACHMENT_CATEGORY_NONE', 0);
define('ATTACHMENT_CATEGORY_IMAGE', 1); // Inline Images
define('ATTACHMENT_CATEGORY_WM', 2); // Windows Media Files - Streaming
define('ATTACHMENT_CATEGORY_RM', 3); // Real Media Files - Streaming
define('ATTACHMENT_CATEGORY_THUMB', 4); // Not used within the database, only while displaying posts
define('ATTACHMENT_CATEGORY_FLASH', 5); // Flash/SWF files
define('ATTACHMENT_CATEGORY_QUICKTIME', 6); // Quicktime/Mov files

// BBCode UID length
define('BBCODE_UID_LEN', 8);

// Number of core BBCodes
define('NUM_CORE_BBCODES', 12);

// BBCode hard limit
define('BBCODE_LIMIT', 1511);

// Smiley hard limit
define('SMILEY_LIMIT', 1000);

// Magic url types
define('MAGIC_URL_EMAIL', 1);
define('MAGIC_URL_FULL', 2);
define('MAGIC_URL_LOCAL', 3);
define('MAGIC_URL_WWW', 4);

// Profile Field Types
define('FIELD_INT', 1);
define('FIELD_STRING', 2);
define('FIELD_TEXT', 3);
define('FIELD_BOOL', 4);
define('FIELD_DROPDOWN', 5);
define('FIELD_DATE', 6);
define('FIELD_MULTI', 10);
define('FIELD_SEPARATOR', ';');

// referer validation
define('REFERER_VALIDATE_NONE', 0);
define('REFERER_VALIDATE_HOST', 1);
define('REFERER_VALIDATE_PATH', 2);

// phpbb_chmod() permissions
@define('CHMOD_ALL', 7);
@define('CHMOD_READ', 4);
@define('CHMOD_WRITE', 2);
@define('CHMOD_EXECUTE', 1);

// Captcha code length
define('CAPTCHA_MIN_CHARS', 4);
define('CAPTCHA_MAX_CHARS', 7);

// Additional constants
// Begin phpBB Digests Modification
define('DIGEST_ALL', 'ALL');
define('DIGEST_BOOKMARKS', 'BM');
define('DIGEST_DAILY_VALUE', 'DAY');
define('DIGEST_DEFAULT_VALUE', 'DFLT');
define('DIGEST_FIRST', '1ST');
define('DIGEST_HTML_VALUE', 'HTML');
define('DIGEST_HTML_CLASSIC_VALUE', 'HTMC');
define('DIGEST_MODE_BASICS', 'basics');
define('DIGEST_MODE_FORUMS_SELECTION', 'forums_selection');
define('DIGEST_MODE_POST_FILTERS', 'post_filters');
define('DIGEST_MODE_ADDITIONAL_CRITERIA', 'additional_criteria');
define('DIGEST_MONTHLY_VALUE', 'MNTH');
define('DIGEST_NONE_VALUE', 'NONE');
define('DIGEST_PLAIN_VALUE', 'PHTM');
define('DIGEST_PLAIN_CLASSIC_VALUE', 'PHTC');
define('DIGEST_SORTBY_BOARD', 'board');
define('DIGEST_SORTBY_POSTDATE', 'postdate');
define('DIGEST_SORTBY_POSTDATE_DESC', 'postdate_desc');
define('DIGEST_SORTBY_STANDARD', 'standard');
define('DIGEST_SORTBY_STANDARD_DESC', 'standard_desc');
define('DIGEST_TEXT_VALUE', 'TEXT');
define('DIGEST_WEEKLY_VALUE', 'WEEK');
define('DIGESTS_SUBSCRIBED_FORUMS_TABLE',	$table_prefix . 'digests_subscribed_forums');
// End phpBB Digests Modification

//---BEGIN CALENDAR MOD---
define('EVENT_VIEW_BY_PUBLIC', 1);
define('EVENT_VIEW_BY_PRIVATE', 2);
define('EVENT_VIEW_BY_GROUPS', 3);

define('EVENT_INITIAL_INSTANCE', 1);
define('EVENT_IS_REPEAT', 2);
define('EVENT_HAS_REPEATS', 4);
define('EVENT_IS_CONTINUED', 8);
define('EVENT_INFO_ONLY', 16);
//---END CALENDAR MOD---
define('VOTE_CONVERTED', 127);

// Table names
define('ACL_GROUPS_TABLE',			$table_prefix . 'acl_groups');
define('ACL_OPTIONS_TABLE',			$table_prefix . 'acl_options');
define('ACL_ROLES_DATA_TABLE',		$table_prefix . 'acl_roles_data');
define('ACL_ROLES_TABLE',			$table_prefix . 'acl_roles');
define('ACL_USERS_TABLE',			$table_prefix . 'acl_users');
define('ATTACHMENTS_TABLE',			$table_prefix . 'attachments');
define('BANLIST_TABLE',				$table_prefix . 'banlist');
define('BBCODES_TABLE',				$table_prefix . 'bbcodes');
define('BOOKMARKS_TABLE',			$table_prefix . 'bookmarks');
define('BOTS_TABLE',				$table_prefix . 'bots');
//---BEGIN CALENDAR MOD---
define('CALENDAR_TABLE',            $table_prefix . 'calendar');
define('CALENDAR_REPEATS_TABLE',    $table_prefix . 'calendar_repeat_events');
//---END CALENDAR MOD---
define('CONFIG_TABLE',				$table_prefix . 'config');
define('CONFIRM_TABLE',				$table_prefix . 'confirm');
define('DISALLOW_TABLE',			$table_prefix . 'disallow');
define('DRAFTS_TABLE',				$table_prefix . 'drafts');
define('EXTENSIONS_TABLE',			$table_prefix . 'extensions');
define('EXTENSION_GROUPS_TABLE',	$table_prefix . 'extension_groups');
define('FORUMS_TABLE',				$table_prefix . 'forums');
define('FORUMS_ACCESS_TABLE',		$table_prefix . 'forums_access');
define('FORUMS_TRACK_TABLE',		$table_prefix . 'forums_track');
define('FORUMS_WATCH_TABLE',		$table_prefix . 'forums_watch');
define('GROUPS_TABLE',				$table_prefix . 'groups');
define('ICONS_TABLE',				$table_prefix . 'icons');
define('LANG_TABLE',				$table_prefix . 'lang');
define('LOG_TABLE',					$table_prefix . 'log');
define('LOGIN_ATTEMPT_TABLE',		$table_prefix . 'login_attempts');
define('MODERATOR_CACHE_TABLE',		$table_prefix . 'moderator_cache');
define('MODS_DATABASE_TABLE',		$table_prefix . 'mods_database'); //lefty74  modsdatabase
define('MODULES_TABLE',				$table_prefix . 'modules');
define('POLL_OPTIONS_TABLE',		$table_prefix . 'poll_options');
define('POLL_VOTES_TABLE',			$table_prefix . 'poll_votes');
define('POSTS_TABLE',				$table_prefix . 'posts');
define('PRIVMSGS_TABLE',			$table_prefix . 'privmsgs');
define('PRIVMSGS_FOLDER_TABLE',		$table_prefix . 'privmsgs_folder');
define('PRIVMSGS_RULES_TABLE',		$table_prefix . 'privmsgs_rules');
define('PRIVMSGS_TO_TABLE',			$table_prefix . 'privmsgs_to');
define('PROFILE_FIELDS_TABLE',		$table_prefix . 'profile_fields');
define('PROFILE_FIELDS_DATA_TABLE',	$table_prefix . 'profile_fields_data');
define('PROFILE_FIELDS_LANG_TABLE',	$table_prefix . 'profile_fields_lang');
define('PROFILE_LANG_TABLE',		$table_prefix . 'profile_lang');
define('RANKS_TABLE',				$table_prefix . 'ranks');
define('REPORTS_TABLE',				$table_prefix . 'reports');
define('REPORTS_REASONS_TABLE',		$table_prefix . 'reports_reasons');
define('SEARCH_RESULTS_TABLE',		$table_prefix . 'search_results');
define('SEARCH_WORDLIST_TABLE',		$table_prefix . 'search_wordlist');
define('SEARCH_WORDMATCH_TABLE',	$table_prefix . 'search_wordmatch');
define('SESSIONS_TABLE',			$table_prefix . 'sessions');
define('SESSIONS_KEYS_TABLE',		$table_prefix . 'sessions_keys');
define('SITELIST_TABLE',			$table_prefix . 'sitelist');
define('SMILIES_TABLE',				$table_prefix . 'smilies');
define('STYLES_TABLE',				$table_prefix . 'styles');
define('STYLES_TEMPLATE_TABLE',		$table_prefix . 'styles_template');
define('STYLES_TEMPLATE_DATA_TABLE',$table_prefix . 'styles_template_data');
define('STYLES_THEME_TABLE',		$table_prefix . 'styles_theme');
define('STYLES_IMAGESET_TABLE',		$table_prefix . 'styles_imageset');
define('STYLES_IMAGESET_DATA_TABLE',$table_prefix . 'styles_imageset_data');
define('TOPICS_TABLE',				$table_prefix . 'topics');
define('TOPICS_POSTED_TABLE',		$table_prefix . 'topics_posted');
define('TOPICS_TRACK_TABLE',		$table_prefix . 'topics_track');
define('TOPICS_WATCH_TABLE',		$table_prefix . 'topics_watch');
define('USER_GROUP_TABLE',			$table_prefix . 'user_group');
define('USERS_TABLE',				$table_prefix . 'users');
define('WARNINGS_TABLE',			$table_prefix . 'warnings');
define('WORDS_TABLE',				$table_prefix . 'words');
define('ZEBRA_TABLE',				$table_prefix . 'zebra');

// Additional tables
// Ultimate Points
define('IN_ULTIMATE_POINTS', true);
define('POINTS_BANK_TABLE',				$table_prefix . 'points_bank');
define('POINTS_CONFIG_TABLE',			$table_prefix . 'points_config');
define('POINTS_LOG_TABLE',				$table_prefix . 'points_log');
define('POINTS_LOTTERY_HISTORY_TABLE',	$table_prefix . 'points_lottery_history');
define('POINTS_LOTTERY_TICKETS_TABLE',	$table_prefix . 'points_lottery_tickets');
define('POINTS_VALUES_TABLE',			$table_prefix . 'points_values');
// MOD : MSSTI ABBC3 Clicks Counter - Start
define('CLICKS_TABLE',				$table_prefix . 'clicks');
// mChat MOD
define('MCHAT_TABLE',				$table_prefix . 'mchat');
define('MCHAT_CONFIG_TABLE',		$table_prefix . 'mchat_config');
define('MCHAT_SESSIONS_TABLE',			$table_prefix . 'mchat_sessions');
// Meeting MOD 2
define('MEETING_COMMENT_TABLE', 	$table_prefix . 'meeting_comment');
define('MEETING_DATA_TABLE', 		$table_prefix . 'meeting_data');
define('MEETING_GUESTNAMES_TABLE', 	$table_prefix . 'meeting_guestnames');
define('MEETING_USER_TABLE', 		$table_prefix . 'meeting_user');
define('MEETING_USERGROUP_TABLE', 	$table_prefix . 'meeting_usergroup');
// User Notes
define('NOTES_TABLE',				$table_prefix . 'notes');
// Pages MOD
define('PAGES_TABLE',				$table_prefix . 'pages');

// Download MOD 6
define('DL_AUTH_TABLE',				$table_prefix . 'dl_auth');
define('DL_CAT_TABLE',				$table_prefix . 'downloads_cat');
define('DL_REM_TRAF_TABLE',			$table_prefix . 'dl_rem_traf');
define('DL_CAT_TRAF_TABLE',			$table_prefix . 'dl_cat_traf');
define('DL_EXT_BLACKLIST',			$table_prefix . 'dl_ext_blacklist');
define('DL_RATING_TABLE',			$table_prefix . 'dl_ratings');
define('DOWNLOADS_TABLE',			$table_prefix . 'downloads');
define('DL_STATS_TABLE',			$table_prefix . 'dl_stats');
define('DL_COMMENTS_TABLE',			$table_prefix . 'dl_comments');
define('DL_BANLIST_TABLE',			$table_prefix . 'dl_banlist');
define('DL_FAVORITES_TABLE',		$table_prefix . 'dl_favorites');
define('DL_NOTRAF_TABLE',			$table_prefix . 'dl_notraf');
define('DL_HOTLINK_TABLE',			$table_prefix . 'dl_hotlink');
define('DL_BUGS_TABLE',				$table_prefix . 'dl_bug_tracker');
define('DL_BUG_HISTORY_TABLE',		$table_prefix . 'dl_bug_history');
define('DL_VERSIONS_TABLE',			$table_prefix . 'dl_versions');
define('DL_FIELDS_TABLE',			$table_prefix . 'dl_fields');
define('DL_FIELDS_DATA_TABLE',		$table_prefix . 'dl_fields_data');
define('DL_FIELDS_LANG_TABLE',		$table_prefix . 'dl_fields_lang');
define('DL_LANG_TABLE',				$table_prefix . 'dl_lang');
define('DL_IMAGES_TABLE',			$table_prefix . 'dl_images');
define('GALLERY_ALBUMS_TABLE',		$table_prefix . 'gallery_albums');
define('GALLERY_ATRACK_TABLE',		$table_prefix . 'gallery_albums_track');
define('GALLERY_COMMENTS_TABLE',	$table_prefix . 'gallery_comments');
define('GALLERY_CONFIG_TABLE',		$table_prefix . 'gallery_config');
define('GALLERY_CONTESTS_TABLE',	$table_prefix . 'gallery_contests');
define('GALLERY_FAVORITES_TABLE',	$table_prefix . 'gallery_favorites');
define('GALLERY_IMAGES_TABLE',		$table_prefix . 'gallery_images');
define('GALLERY_MODSCACHE_TABLE',	$table_prefix . 'gallery_modscache');
define('GALLERY_PERMISSIONS_TABLE',	$table_prefix . 'gallery_permissions');
define('GALLERY_RATES_TABLE',		$table_prefix . 'gallery_rates');
define('GALLERY_REPORTS_TABLE',		$table_prefix . 'gallery_reports');
define('GALLERY_ROLES_TABLE',		$table_prefix . 'gallery_roles');
define('GALLERY_USERS_TABLE',		$table_prefix . 'gallery_users');
define('GALLERY_WATCH_TABLE',		$table_prefix . 'gallery_watch');

// Stargate Portal (Kiss II) tables //
define('WELCOME_MESSAGE', 1);
define('UN_ALLOC_MENUS', 0);
define('NAV_MENUS', 1);
define('SUB_MENUS', 2);
define('HEAD_MENUS', 3);
define('FOOT_MENUS', 4);
define('LINKS_MENUS', 5);
define('ALL_MENUS', 90);
define('UNALLOC_MENUS', 99);

define('K_MENUS_TABLE',				$table_prefix . 'k_menus');
define('K_BLOCKS_TABLE',			$table_prefix . 'k_blocks');
define('K_BLOCKS_CONFIG_TABLE',		$table_prefix . 'k_blocks_config');
define('K_BLOCKS_CONFIG_VAR_TABLE',	$table_prefix . 'k_config_vars');
define('K_RESOURCES_TABLE',			$table_prefix . 'k_resources');
define('K_PAGES_TABLE',				$table_prefix . 'k_pages');
define('K_ACRONYMS_TABLE',			$table_prefix . 'k_acronyms');

define('SHOUTBOX_TABLE', $table_prefix . 'shoutbox');

/*
IntegraMod3 bitfields for storage of user preferences.
Using bitfields we can store all of the settings in a single 32 bit variable, thus avoiding excessive db bloat
00000000000000000000000000000000
-------------------------------x - im_show_cal_index
------------------------------x- - im_show_shout_index
-----------------------------x-- - reserved
----------------------------x--- - reserved
---------------------------x---- - reserved
--------------------------x----- - reserved
-------------------------x------ - reserved
------------------------x------- - reserved
-----------------------x-------- - reserved
----------------------x--------- - reserved
---------------------x---------- - reserved
--------------------x----------- - reserved
-------------------x------------ - reserved
------------------x------------- - reserved
-----------------x-------------- - reserved
----------------x--------------- - reserved
---------------x---------------- - reserved
--------------x----------------- - reserved
-------------x------------------ - reserved
------------x------------------- - reserved
xxxxxx-------------------------- - an_example_number_embedded (6 bits = max value of 64)
------xxxxxx-------------------- - another_example_number_embedded (6 bits = max value of 64)
*/

define('USER_IM3_SHOW_CAL_INDEX',				0x00000001);
define('USER_IM3_SHOW_SHOUT_INDEX',				0x00000002);

/*
define('USER_CAL_RESERVED',						0x00000004);
define('USER_CAL_RESERVED',						0x00000008);
define('USER_CAL_RESERVED',						0x00000010);
define('USER_CAL_RESERVED',						0x00000020);
define('USER_CAL_RESERVED',						0x00000040);
define('USER_CAL_RESERVED',						0x00000080);
define('USER_CAL_RESERVED',						0x00000100);
define('USER_CAL_RESERVED',						0x00000200);
define('USER_CAL_RESERVED',						0x00000400);
define('USER_CAL_RESERVED',						0x00000800);
define('USER_CAL_RESERVED',						0x00001000);
define('USER_CAL_RESERVED',						0x00002000);
define('USER_CAL_RESERVED',						0x00004000);
define('USER_CAL_RESERVED',						0x00008000);
define('USER_CAL_RESERVED',						0x00010000);
define('USER_CAL_RESERVED',						0x00020000);
define('USER_CAL_RESERVED',						0x00040000);
define('USER_CAL_RESERVED',						0x00080000);
*/
define('USER_IM3_EXAMPLE_NUMBER',				0xFC000000);
define('USER_IM3_ANOTHER_EXAMPLE_NUMBER',		0x03F00000);

// Integramod Tables
define('IMOD_CONFIG_TABLE',				$table_prefix . 'imod_config');

define('KB_ARTICLE_TABLE',            	$table_prefix . 'kb_article');
define('KB_CATEGORIE_TABLE',    		$table_prefix . 'kb_categorie');
define('KB_CONFIG_TABLE',               $table_prefix . 'kb_config');
define('KB_LOG_TABLE',                  $table_prefix . 'kb_changelog');
define('KB_TYPES_TABLE',                $table_prefix . 'kb_types');
define('KB_REPORTS_TABLE',              $table_prefix . 'kb_reports');
define('KB_ARTICLE_DIFF_TABLE', 		$table_prefix . 'kb_article_diff');
define('KB_ARTICLE_TRACK_TABLE',        $table_prefix . 'kb_article_track');
define('KB_RATING_TABLE',               $table_prefix . 'kb_rating');
define('KB_FOLDER',                     'knowledge');

?>