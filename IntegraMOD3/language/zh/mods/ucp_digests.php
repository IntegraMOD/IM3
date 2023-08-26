<?php
/**
*
* mods_ucp_digests.php [Mandarin Chinese (Traditional script)‎]
*
* @package language
* @version $Id: $
* @copyright (c) 2009 phpBB Group
* @author 2009-08-06 - yoshika
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
	'DIGEST_ALL_FORUMS'	=> '所有',
	'DIGEST_AUTHOR'	=> '作者',
	'DIGEST_BAD_EOL'	=> '行尾價值  %s 是無效的.',
	'DIGEST_BOARD_LIMIT'	=> '%s (委員會極限)',
	'DIGEST_BY'	=> '由',
	'DIGEST_CONNECT_SOCKET_ERROR'	=> '無法打開與phpBB Smartfeed站點的連接，報告錯誤是:<br />%s',
	'DIGEST_COUNT_LIMIT'	=> '崗位的最大數字在文摘',
	'DIGEST_COUNT_LIMIT_EXPLAIN'	=> '如果您在文摘，想要限制崗位的數量進入數字大於零.',
	'DIGEST_CURRENT_VERSION_INFO'	=> '您跑版本 <strong>%s</strong>.',
	'DIGEST_DAILY'	=> '每日',
	'DIGEST_DATE'	=> '日期',
	'DIGEST_DISABLED_MESSAGE'	=> '使能領域，精選的基本和選擇文摘類型',
	'DIGEST_DISCLAIMER'	=> '這本文摘寄發到登記的成員  <a href="%s">%s</a> 論壇。 您能從改變或刪除您的捐款 <a href="%sucp.%s">User Control Panel</a>. 如果您在這本文摘格式請安排問題或反饋送它到 <a href="mailto:%s">%s Web站點管理員</a>.',
	'DIGEST_EXPLANATION'	=> '文摘是週期性地寄發到您這裡被宣佈的消息的電子郵件總結。 可以送文摘每日，每週或月度在天的1小時您精選。 您能指定您想要消息總結的那些特殊論壇(精選的崗位選擇)，默認情況下或者您能決定收到所有消息為您考慮到通入的所有論壇。 您能，當然，通過簡單回來任何時候取消您的文摘捐款對這頁。 多數用戶發現文摘是非常有用的。 我們鼓勵您試一試!',
	'DIGEST_FILTER_ERROR'	=> 'mail_digests.php 叫與無效 user_digest_filter_type = %s',
	'DIGEST_FILTER_FOES'	=> '從我的仇敵去除崗位',
	'DIGEST_FILTER_TYPE'	=> '崗位的類型在文摘',
	'DIGEST_FORMAT_ERROR'	=> 'mail_digests.php 叫與無效 user_digest_format of %s',
	'DIGEST_FORMAT_FOOTER'	=> '文摘格式:',
	'DIGEST_FORMAT_HTML'	=> 'HTML',
	'DIGEST_FORMAT_HTML_EXPLAIN'	=> 'HTML 將提供格式化、BBCode和署名(如果允許)。 如果您的電子郵件程序准許， Stylesheets是應用的.',
	'DIGEST_FORMAT_HTML_CLASSIC'	=> 'HTML 經典',
	'DIGEST_FORMAT_HTML_CLASSIC_EXPLAIN'	=> '相似於HTML除了題目崗位被列出在桌裡面',
	'DIGEST_FORMAT_PLAIN'	=> '平原 HTML',
	'DIGEST_FORMAT_PLAIN_EXPLAIN'	=> '平原 HTML 不申請樣式或顏色',
	'DIGEST_FORMAT_PLAIN_CLASSIC'	=> '平原 HTML 經典',
	'DIGEST_FORMAT_PLAIN_CLASSIC_EXPLAIN'	=> '相似 平原 HTML 除了題目崗位被列出在桌裡面',
	'DIGEST_FORMAT_STYLING'	=> '文摘稱呼',
	'DIGEST_FORMAT_STYLING_EXPLAIN'	=> '请注意:實際上被回報的稱呼取決於您的電子郵件程序的能力。 移動游標稱呼的類型學會更多關於每樣式.',
	'DIGEST_FORMAT_TEXT'	=> '文本',
	'DIGEST_FORMAT_TEXT_EXPLAIN'	=> 'HTML不會出現於文摘。 仅文本將顯示.',
	'DIGEST_FREQUENCY'	=> '被要的文摘的類型',
	'DIGEST_FREQUENCY_EXPLAIN'	=> '送得每週文摘出 %s. 月度文摘在第一个被送月時候。 世界時為確定星期使用.',
	'DIGEST_INTRODUCTION'	=> '這被宣佈的消息最新的文摘  %s 論壇。 請來加入討論!',
	'DIGEST_LASTVISIT_RESET'	=> '送我文摘，重新設置我的最後參觀日期',
	'DIGEST_LATEST_VERSION_INFO'	=> '最新的可利用的版本是 <strong>%s</strong>.',
	'DIGEST_LINK'	=> '鏈接',
	'DIGEST_LOG_WRITE_ERROR'	=> '無法給日誌寫用道路，道路 = %s. 這由缺乏公眾在這個文件頻繁地造成寫作許可.',
	'DIGEST_MAIL_FREQUENCY'	=> '文摘頻率',
	'DIGEST_MARK_READ'	=> '標記如讀，當他們出現於文摘',
	'DIGEST_MAX_SIZE'	=> '顯示的最大詞在崗位',
	'DIGEST_MAX_SIZE_EXPLAIN'	=> '通知： 要保證一致的翻譯，如果必須削崗位， HTML從崗位將被去除.',
	'DIGEST_MAX_WORDS_NOTIFIER'	=> '... ',
	'DIGEST_MIN_SIZE'	=> '在崗位要求的極小的詞為崗位出現於文摘',
	'DIGEST_MIN_SIZE_EXPLAIN'	=> '如果您任此空白，崗位與詞的所有數字文本是包括的',
	'DIGEST_MONTHLY'	=> '月度',
	'DIGEST_NEW'	=> '新',
	'DIGEST_NEW_POSTS_ONLY'	=> '顯示仅新的崗位',
	'DIGEST_NEW_POSTS_ONLY_EXPLAIN'	=> '這將過濾掉在您最後拜訪這個委員會的日期和時間之前被張貼的任何崗位。 如果您頻繁地拜訪委員會并且讀大多崗位，這在您的文摘將保留重複崗位從出現。 它也許也意味您在您沒有讀的論壇將錯過有些崗位.',
	'DIGEST_NO_CONSTRAINT'	=> '沒有限制',
	'DIGEST_NO_FORUMS_CHECKED'	=> '必須檢查至少一個論壇',
	'DIGEST_NO_LIMIT'	=> '沒有極限',
	'DIGEST_NO_POSTS'	=> '沒有新的崗位.',
	'DIGEST_NO_PRIVATE_MESSAGES'	=> '您沒有新或未經閱讀的私有消息.',
	'DIGEST_NONE'	=> '什么都(取消預訂)',
	'DIGEST_ON'	=> '在',
	'DIGEST_POST_TEXT'	=> '崗位 文本',
	'DIGEST_POST_TIME'	=> '崗位 時間',
	'DIGEST_POST_SIGNATURE_DELIMITER'	=> '<br />____________________<br />',
	'DIGEST_POSTS_TYPE_ANY'	=> '所有崗位',
	'DIGEST_POSTS_TYPE_FIRST'	=> '仅題目第一崗 ',
	'DIGEST_POWERED_BY'	=> 'Powered by',
	'DIGEST_PRIVATE_MESSAGES_IN_DIGEST'	=> '增加我未經閱讀的私有消息',
	'DIGEST_PUBLISH_DATE'	=> '文摘為您具體地被出版了  %s',
	'DIGEST_REMOVE_YOURS'	=> '去除我的崗位',
	'DIGEST_ROBOT'	=> '機器人',
	'DIGEST_SALUTATION'	=> '親愛',
	'DIGEST_SELECT_FORUMS'	=> '包括崗位為這些論壇',
	'DIGEST_SELECT_FORUMS_EXPLAIN'	=> '请注意顯示的類別和論壇是為您允許只讀的那些。 當您選擇仅時，按書簽的題目論壇選擇是殘疾.',
	'DIGEST_SEND_HOUR'	=> '被送的小時',
	'DIGEST_SEND_HOUR_EXPLAIN'	=> '文摘到達時間是根據時區和夏令時或您在您的委員會特選設置的夏時的時間.',
	'DIGEST_SEND_IF_NO_NEW_MESSAGES'	=> '送文摘，如果沒有新的消息:',
	'DIGEST_SEND_ON_NO_POSTS'	=> '如果沒有新的崗位，送一本文摘',
	'DIGEST_SHOW_MY_MESSAGES'	=> '顯示我的崗位在文摘:',
	'DIGEST_SHOW_NEW_POSTS_ONLY'	=> '顯示仅新的崗位',
	'DIGEST_SHOW_PMS'	=> '顯示我的私有消息',
	'DIGEST_SIZE_ERROR'	=> '這個領域是一個必需的領域。 您必須進入一個正面整數，小於或等於論壇管理員允許的最大值。 允許的最大值是 %s. 如果這價值是零，沒有極限.',
	'DIGEST_SIZE_ERROR_MIN'	=> '您必須進入正面價值或留下領域空白',
	'DIGEST_SOCKET_FUNCTIONS_DISABLED'	=> '插口作用當前失去能力.',
	'DIGEST_SORT_BY'	=> '崗位排序順序',
	'DIGEST_SORT_BY_ERROR'	=> 'mail_digests.php 叫與無效 user_digest_sortby = %s',
	'DIGEST_SORT_BY_EXPLAIN'	=> '如他們在主要索引，顯示所有文摘排序按照類別然後由論壇。 排序選擇適用於怎樣崗位在題目之內被安排。 傳統命令是phpBB使用的缺省順序2，是最後題目崗位次(下降)在題目之內以郵寄然後計時.',
	'DIGEST_SORT_FORUM_TOPIC'	=> '傳統命令',
	'DIGEST_SORT_FORUM_TOPIC_DESC'	=> '傳統順序，首先最新的崗位',
	'DIGEST_SORT_POST_DATE'	=> '從最老到最新',
	'DIGEST_SORT_POST_DATE_DESC'	=> '從最新到最老',
	'DIGEST_SORT_USER_ORDER'	=> '使用我的委員會顯示特選',
	'DIGEST_SQL_PMS'	=> '用於私有消息的SQL為 %s: %s',
	'DIGEST_SQL_PMS_NONE'	=> '沒有SQL發布為 private_messages 為 %s 因為用戶在文摘選擇不顯示私有消息.',
	'DIGEST_SQL_POSTS_USERS'	=> '用於崗位的SQL為 %s: %s',
	'DIGEST_SQL_USERS'	=> '用於的SQL檢索得到文摘的用戶： %s',
	'DIGEST_SUBJECT_LABEL'	=> '主題',
	'DIGEST_SUBJECT_TITLE'	=> '%s %s 文摘',
	'DIGEST_TIME_ERROR'	=> 'mail_digests.php 計算了一本壞文摘送小時  %s',
	'DIGEST_TOTAL_POSTS'	=> '總崗位在這中文摘:',
	'DIGEST_TOTAL_UNREAD_PRIVATE_MESSAGES'	=> '總未經閱讀的私有消息:',
	'DIGEST_UNREAD'	=> '未經閱讀',
	'DIGEST_UPDATED'	=> '您的文摘設置被保存了',
	'DIGEST_USE_BOOKMARKS'	=> '仅按書簽的題目',
	'DIGEST_VERSION_NOT_UP_TO_DATE'	=> '管理員通知： phpBB文摘的這個版本不當前。 更新是可利用的在 <a href="%s">消化網站</a>.',
	'DIGEST_VERSION_UP_TO_DATE'	=> 'phpBB文摘的這個版本是 up-to-date, 沒有更新可利用.',

	'DIGEST_WEEKDAY'	=> array(
		'0'	=> '星期天',
		'1'	=> '星期一',
		'2'	=> '星期二',
		'3'	=> '星期三',
		'4'	=> '星期四',
		'5'	=> '星期五',
		'6'	=> '星期六',
	),

	'DIGEST_WEEKLY'	=> '每週',
	'DIGEST_YOU_HAVE_PRIVATE_MESSAGES'	=> '您有私有消息',
	'DIGEST_YOUR_DIGEST_OPTIONS'	=> '您的文摘選擇:',
	'S_DIGEST_TITLE'					=> (isset($config['digests_digests_title'])) ? $config['digests_digests_title'] : 'phpBB Digests',
	'UCP_DIGESTS_MODE_ERROR'	=> '文摘叫以一個無效方式  %s',
));

?>