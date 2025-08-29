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
	'ACP_USER_DETAILS'				=> 'Деталі користувача',
	'USER_DETAILS_SELECT'			=> 'Тут ви можете вибрати атрибути користувача, які бажаєте відображати.<br />Максимальна кількість атрибутів визначається параметром "Розмір стовпця атрибутів", який встановлено на %1$s.<br />Стовпець "Можна фільтрувати" вказує, які стовпці можна буде фільтрувати.',
	'USER_DETAILS_DISPLAY'			=> 'Це відображення атрибутів користувача, які ви вибрали.',
	'INSTALL_NOT_DELETED'			=> 'Файл установки для цього моду не було видалено',
	'OPTS_TOO_LONG'					=> 'Неможливо зберегти параметри. Занадто багато параметрів для збереження.',

	'ATTRIBUTE'						=> 'Атрибут',
	'ATTRIBUTE_EXPLAIN'				=> 'Опис атрибута',
	'SIZE'							=> 'Розмір стовпця атрибутів',
	'CAN_FILTER'					=> 'Можна фільтрувати',
	'NO_ATTRIBUTES_SELECTED'		=> 'Атрибути не вибрано',
	'TOO_MANY_ATTRIBUTES'			=> 'Ви вибрали %1$s стовпців атрибутів.<br />Максимально доступно — %2$s',
	'CLEAR_ATTRIB'					=> 'Очистити атрибути',

	'USER_ID'						=> 'ID користувача',
	'USER_ID_EXPLAIN'				=> 'Ідентифікатор користувача на цьому форумі.',
	'USER_TYPE'						=> 'Тип користувача',
	'USER_TYPE_EXPLAIN'				=> 'Тип користувача.',
	'USER_GROUP'					=> 'Група',
	'USER_GROUP_EXPLAIN'			=> 'Група за замовчуванням для користувача.',
	'USER_IP'						=> 'IP користувача',
	'USER_IP_EXPLAIN'				=> 'IP-адреса користувача під час реєстрації на цьому форумі.',
	'USER_REGDATE'					=> 'Дата реєстрації',
	'USER_REGDATE_EXPLAIN'			=> 'Дата реєстрації користувача на цьому форумі.',
	'USER_PASS_CHANGE'				=> 'Зміна пароля',
	'USER_PASS_CHANGE_EXPLAIN'		=> 'Дата, коли користувач має змінити пароль.',
	'USER_EMAIL'					=> 'Email',
	'USER_EMAIL_EXPLAIN'			=> 'Email-адреса користувача.',
	'USER_BIRTHDAY'					=> 'День народження',
	'USER_BIRTHDAY_EXPLAIN'			=> 'Дата народження користувача, якщо вказано, та вік.',
	'USER_LASTVISIT'				=> 'Останній візит',
	'USER_LASTVISIT_EXPLAIN'		=> 'Дата та час останнього візиту користувача на форум.',
	'USER_LASTMARK'					=> 'Остання позначка',
	'USER_LASTMARK_EXPLAIN'			=> 'Останній раз, коли користувач позначив усі форуми як прочитані.',
	'USER_LASTPOST_TIME'			=> 'Час останнього повідомлення',
	'USER_LASTPOST_TIME_EXPLAIN'	=> 'Дата та час останнього повідомлення користувача на форумі.',
	'USER_LAST_PAGE'				=> 'Остання сторінка',
	'USER_LAST_PAGE_EXPLAIN'		=> 'Остання сторінка, яку відвідав користувач.',
	'USER_LAST_SEARCH'				=> 'Останній пошук',
	'USER_LAST_SEARCH_EXPLAIN'		=> 'Дата та час останнього використання пошуку користувачем.',
	'USER_WARNINGS'					=> 'Попередження',
	'USER_WARNINGS_EXPLAIN'			=> 'Кількість попереджень, отриманих користувачем.',
	'USER_LAST_WARNING'				=> 'Останнє попередження',
	'USER_LAST_WARNING_EXPLAIN'		=> 'Дата отримання останнього попередження користувачем.',
	'USER_LOGIN_ATTEMPTS'			=> 'Спроби входу',
	'USER_LOGIN_ATTEMPTS_EXPLAIN'	=> 'Кількість невдалих спроб входу користувача.',
	'USER_INACTIVE_REASON'			=> 'Причина неактивності',
	'USER_INACTIVE_REASON_EXPLAIN'	=> 'Причина, чому обліковий запис користувача неактивний.',
	'USER_INACTIVE_TIME'			=> 'Час неактивності',
	'USER_INACTIVE_TIME_EXPLAIN'	=> 'Дата та час, коли обліковий запис користувача став неактивним.',
	'USER_POSTS'					=> 'Повідомлення',
	'USER_POSTS_EXPLAIN'			=> 'Кількість повідомлень, які користувач залишив на форумі.',
	'USER_LANG'						=> 'Мова',
	'USER_LANG_EXPLAIN'				=> 'Мова користувача.',
	'USER_TIMEZONE'					=> 'Часовий пояс',
	'USER_TIMEZONE_EXPLAIN'			=> 'Часовий пояс користувача.',
	'USER_DST'						=> 'Літній час',
	'USER_DST_EXPLAIN'				=> 'Чи встановлено літній час для користувача?',
	'USER_DATE_FORMAT'				=> 'Формат дати',
	'USER_DATE_FORMAT_EXPLAIN'		=> 'Формат, у якому користувач бачить дату та час.',
	'USER_STYLE'					=> 'Стиль',
	'USER_STYLE_EXPLAIN'			=> 'Стиль користувача.<br />ПРИМІТКА: Це може бути не той стиль, який бачить користувач — залежить від налаштувань на рівні форуму.',
	'USER_RANK'						=> 'Ранг',
	'USER_RANK_EXPLAIN'				=> 'Ранг користувача.',
	'USER_NEW_PRIVMSG'				=> 'Нові приватні повідомлення',
	'USER_NEW_PRIVMSG_EXPLAIN'		=> 'Кількість нових приватних повідомлень у користувача.',
	'USER_UNREAD_PRIVMSG'			=> 'Непрочитані приватні повідомлення',
	'USER_UNREAD_PRIVMSG_EXPLAIN'	=> 'Кількість непрочитаних приватних повідомлень у користувача.',
	'USER_LAST_PRIVMSG'				=> 'Останнє приватне повідомлення',
	'USER_LAST_PRIVMSG_EXPLAIN'		=> 'Дата та час останнього приватного повідомлення користувача.',
	'USER_EMAILTIME'				=> 'Час email',
	'USER_EMAILTIME_EXPLAIN'		=> 'Дата та час останнього email користувача.',
	'USER_NOTIFY'					=> 'Сповіщення про повідомлення',
	'USER_NOTIFY_EXPLAIN'			=> 'Чи отримує користувач сповіщення про нові повідомлення у форумах, на які він підписаний?',
	'USER_NOTIFY_PM'				=> 'Сповіщення про ПП',
	'USER_NOTIFY_PM_EXPLAIN'		=> 'Чи отримує користувач сповіщення про приватні повідомлення?',
	'USER_NOTIFY_TYPE'				=> 'Тип сповіщення',
	'USER_NOTIFY_TYPE_EXPLAIN'		=> 'Який тип сповіщень отримує користувач?',
	'USER_ALLOW_PM'					=> 'Дозволити ПП',
	'USER_ALLOW_PM_EXPLAIN'			=> 'Дозволити іншим користувачам надсилати приватні повідомлення цьому користувачу.',
	'USER_ALLOW_VIEWONLINE'			=> 'Видимість онлайн',
	'USER_ALLOW_VIEWONLINE_EXPLAIN'	=> 'Чи приховує користувач свій онлайн-статус?',
	'USER_ALLOW_VIEWEMAIL'			=> 'Видимість email',
	'USER_ALLOW_VIEWEMAIL_EXPLAIN'	=> 'Чи можуть інші користувачі зв’язатися з цим користувачем через email?',
	'USER_ALLOW_MASSEMAIL'			=> 'Масовий email',
	'USER_ALLOW_MASSEMAIL_EXPLAIN'	=> 'Чи може користувач отримувати масові email-повідомлення від адміністратора?',
	'USER_AVATAR'					=> 'Аватар',
	'USER_AVATAR_EXPLAIN'			=> 'Відображення аватара користувача.',
	'USER_AVATAR_TYPE'				=> 'Тип аватара',
	'USER_AVATAR_TYPE_EXPLAIN'		=>
	
	'USER_FB'						=> 'Facebook',
	'USER_FB_EXPLAIN'				=> 'Контакт або посилання на профіль Facebook користувача.',
	'USER_IG'						=> 'Instagram',
	'USER_IG_EXPLAIN'				=> 'Ім’я користувача або посилання на профіль Instagram користувача.',
	'USER_PT'						=> 'Pinterest',
	'USER_PT_EXPLAIN'				=> 'Ім’я користувача або посилання на профіль Pinterest користувача.',
	'USER_TWR'						=> 'Twitter',
	'USER_TWR_EXPLAIN'				=> 'Ім’я користувача або посилання на профіль Twitter користувача.',
	'USER_SKP'						=> 'Skype',
	'USER_SKP_EXPLAIN'				=> 'Ім’я користувача Skype. Skype має бути встановлено та налаштовано.',
	'USER_TG'						=> 'Telegram',
	'USER_TG_EXPLAIN'				=> 'Ім’я користувача або контактне посилання Telegram користувача.',
	'USER_LI'						=> 'LinkedIn',
	'USER_LI_EXPLAIN'				=> 'URL-адреса профілю LinkedIn користувача.',
	'USER_TT'						=> 'TikTok',
	'USER_TT_EXPLAIN'				=> 'Ім’я користувача або посилання на профіль TikTok користувача.',
	'USER_DC'						=> 'Discord',
	'USER_DC_EXPLAIN'				=> 'Тег Discord користувача (наприклад, користувач#1234).',
	
	'USER_FROM_EXPLAIN'				=> 'Звідки користувач?',
	'USER_ICQ'						=> 'ICQ',
	'USER_ICQ_EXPLAIN'				=> 'Адреса ICQ користувача.',
	'USER_AIM'						=> 'AIM',
	'USER_AIM_EXPLAIN'				=> 'Адреса AIM користувача.',
	'USER_YIM'						=> 'YIM',
	'USER_YIM_EXPLAIN'				=> 'Адреса YIM користувача.',
	'USER_MSNM'						=> 'MSMN',
	'USER_MSNM_EXPLAIN'				=> 'Адреса MSN Messenger користувача.',
	'USER_JABBER'					=> 'Jabber',
	'USER_JABBER_EXPLAIN'			=> 'Адреса Jabber користувача.',
	'USER_WEBSITE'					=> 'Вебсайт',
	'USER_WEBSITE_EXPLAIN'			=> 'Вебсайт користувача.',
	'USER_OCC'						=> 'Професія',
	'USER_OCC_EXPLAIN'				=> 'Професія користувача.',
	'USER_INTERESTS'				=> 'Інтереси',
	'USER_INTERESTS_EXPLAIN'		=> 'Інтереси користувача.',

	'USER_NORMAL'					=> 'Звичайний',
	'USER_INACTIVE'					=> 'Неактивний',
	'USER_IGNORE'					=> 'Ігнорований',
	'USER_FOUNDER'					=> 'Засновник',

	'HOUR'							=> 'година',
	'HOURS'							=> 'годин',

	'EMAIL_JABBER'					=> 'E-mail &amp; Jabber',

	'ALL'							=> 'Усі',
	'FILTER_BY'						=> 'Фільтрувати за',
	'FILTER_CHAR'					=> 'символ',
	'TOTAL_USERS'					=> 'Загальна кількість користувачів',

	'AVATAR_UPLOAD'					=> 'Завантажений аватар',
	'AVATAR_REMOTE'					=> 'Віддалений аватар',
	'AVATAR_GALLERY'				=> 'Аватар з галереї',

	// Board config
	'MAX_ATTRIBUTE_COLS'			=> 'Максимальна кількість стовпців атрибутів',
	'MAX_ATTRIBUTE_COLS_EXPLAIN'	=> 'Максимальна кількість стовпців атрибутів, які можна відобразити у списку даних користувача.<br />Встановлення значення 999 вимикає цю перевірку.',
	'SAVE_OPTS'						=> 'Зберегти вибрані параметри деталей користувача',
	'SAVE_OPTS_EXPLAIN'				=> 'Зберегти вибрані параметри деталей користувача, щоб вони були доступні при наступному запиті.',
));

// Install
$lang = array_merge($lang, array(
	'NO_FOUNDER'					=> 'Ви не маєте прав для встановлення цього моду — потрібен статус Засновника.',
	'INSTALL_USER_DETAILS'			=> 'Встановлення моду деталей користувача',
	'UPDATE_USER_DETAILS'			=> 'Оновлення моду деталей користувача',
	'COMPLETE'						=> 'Встановлення завершено ...',
));

?>