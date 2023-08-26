<?php
/**
*
* posting [Ukrainian]
*
* @package language
* @version $Id: posting.php 9902 2009-08-01 11:07:48Z acydburn $
* @copyright (c) 2005 phpBB Group
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

// BBCodes
// Note to translators: you can translate everything but what's between { and }
$lang = array_merge($lang, array(
	'ACP_BBCODES_EXPLAIN'		=> 'BBCode  - це особлива реалізація HTML, яка забезпечує кращий контроль над тим, що і як відображається. На цій сторінці ви можете додавати, видаляти та редагувати власні коди BBCode.',
	'ADD_BBCODE'				=> 'Додати новий код BBCode',

 	'BBCODE_DANGER'				=> 'BBCode, який ви намагаєтесь додати, здається, використовує лексему {TEXT} всередині атрибуту HTML. Це може призвести до проблем з безпекою, пов\'язаних з XSS. Спробуйте використати лексеми {SIMPLETEXT} або {INTTEXT}, які використовують більше перевірок. Продовжуйте лише у тому випадку, якщо ви цілком розумієте можливі ризики та використання лексеми {TEXT} абсолютно необхідне.',
 	'BBCODE_DANGER_PROCEED'		=> 'Продовжити', //'I understand the risk',

	'BBCODE_ADDED'				=> 'BBCode успішно додано.',
	'BBCODE_EDITED'				=> 'BBCode успішно відредаговано.',
	'BBCODE_NOT_EXIST'			=> 'Обраний вами код BBCode не існує.',
	'BBCODE_HELPLINE'			=> 'Підказка',
	'BBCODE_HELPLINE_EXPLAIN'	=> 'Це поле містить текст, який буду з\'являтись при наведенні курсора на текст BBCode.',
	'BBCODE_HELPLINE_TEXT'		=> 'Текст підказки',
	'BBCODE_HELPLINE_TOO_LONG'   => 'Введена вами підказка занадто довга.',

	'BBCODE_INVALID_TAG_NAME'	=> 'Обрана вами назва тегу BBCode вже існує.',
	'BBCODE_INVALID'			=> 'Ваш BBCode побудовано в невірній формі.',
	'BBCODE_OPEN_ENDED_TAG'		=> 'BBCode повинен містити відкривний та закривний теги.',
	'BBCODE_TAG'				=> 'Тег',
	'BBCODE_TAG_TOO_LONG'		=> 'Обрана вами назва тегу надто довга.',
	'BBCODE_TAG_DEF_TOO_LONG'	=> 'Введений опис тегу надто довгий, будь-ласка, скоротіть його.',
	'BBCODE_USAGE'				=> 'Використання BBCode',
	'BBCODE_USAGE_EXAMPLE'		=> '[highlight={COLOR}]{TEXT}[/highlight]<br /><br />[font={SIMPLETEXT1}]{SIMPLETEXT2}[/font]',
	'BBCODE_USAGE_EXPLAIN'		=> 'Тут визначається використання BBCode. Будь-яка змінна, що вводиться, може бути замінена на відповідну лексему (%sдивіться нижче%s).',

	'EXAMPLE'						=> 'Приклад:',
	'EXAMPLES'						=> 'Приклади:',

	'HTML_REPLACEMENT'				=> 'Заміна HTML',
	'HTML_REPLACEMENT_EXAMPLE'		=> '&lt;span style="background-color: {COLOR};"&gt;{TEXT}&lt;/span&gt;<br /><br />&lt;span style="font-family: {SIMPLETEXT1};"&gt;{SIMPLETEXT2}&lt;/span&gt;',
	'HTML_REPLACEMENT_EXPLAIN'		=> 'Тут визначаються заміни HTML. Не забудьте додати лексеми, які ви використали вище!',

	'TOKEN'					=> 'Лексема',
	'TOKENS'				=> 'Лексеми',
	'TOKENS_EXPLAIN'		=> 'Лексеми - це мітки, які призначенні для вводу користувачем. Правильність введеного вмісту буде підтверджено лише у випадку, якщо він відповідає відповідному визначенню. При потребі ви можете нумерувати їх шляхом додавання номеру в кінці лексеми всередині фігурних дужок. Наприклад {TEXT1}, {TEXT2}.<br /><br />Окрім лексем, в якості заміни HTML ви також можете використовувати будь-яку з мовних змінних, присутніх в вашій директорії language/, наприклад: {L_<em>&lt;STRINGNAME&gt;</em>}, де <em>&lt;STRINGNAME&gt;</em> - ім\'я перекладеної стрічки, яку ви хочете додати. Наприклад, {L_WROTE} буде відображатись як &quot;wrote&quot; або як переклад відповідно до мови, встановленої користувачем.<br /><br /><strong>Зауважте, що лише нижчевказані лексеми можуть використовуватись в користувацьких кодах BBCode.</strong>',
	'TOKEN_DEFINITION'		=> 'Опис',
	'TOO_MANY_BBCODES'		=> 'Ви не можете створити більше кодів BBCode. Будь-ласка, видаліть один або декілька кодів BBCode, і спробуйте ще раз.',

	'tokens'	=>	array(
	'TEXT'			=> 'Будь-який текст, який містить символи різних мов, цифри та ін. Ви не можете використовувати ці лексеми в тегах HTML. Замість цього використовуйте IDENTIFIER, INTTEXT або SIMPLETEXT.',
	'SIMPLETEXT'	=> 'Букви латинського алфавіту (A-Z), цифри, пробіл, коми, крапка, мінус, плюс, дефіс та підкреслення',
	'INTTEXT'		=> 'Букви Unicode, цифри, пробіли, коми, крапки, мінус, плюс, дефіс та підкреслення',		
	'IDENTIFIER'	=> 'Букви латинського алфавіту (A-Z), цифри, дефіс та підкреслення',
	'NUMBER'		=> 'Будь-який набір цифр',
	'EMAIL'			=> 'Правильна адреса e-mail',
	'URL'			=> 'Правильна адреса URL з використанням будь-якого протоколу (http, ftp та ін. не можуть використовуватись для деструктивних дій javascript). Якщо нічого не задано, буде автоматично додано префікс &quot;http://&quot;',
	'LOCAL_URL'		=> 'Локальна адреса URL. URL-адреса повинна бути відносною до сторінки теми та не може містити ім\'я серверу або протоколу, як посилання, які починаються на “%s”.',
  'RELATIVE_URL'	=> 'Відносна адреса URL. Ви можете використовувати її для підстановки окремих частин адреси URL, але з обережністю: повна вдреса URL є правильною відносною адресою URL. Якщо ви хочете використовувати відносні адреси URL на своєму форумі, використовуйте лексему LOCAL_URL.',

	'COLOR'			=> 'Колір HTML. Може бути заданий в числовій формі  <samp>#FF1234</samp> або <a href="http://www.w3.org/TR/CSS21/syndata.html#value-def-color">ключовим словом кольору CSS</a>, наприклад <samp>fuchsia</samp> або <samp>InactiveBorder</samp>'
	)
));

// Smilies and topic icons
$lang = array_merge($lang, array(
	'ACP_ICONS_EXPLAIN'		=> 'На цій сторінці ви можете додавати, видаляти та редагувати значки, які користувачі можуть додавати до своїх назв тем та повідомлень. Ці значки відображаються поряд з назвами тем на сторінках перегляду форумів або поряд з назвами повідомлень на сторінках перегляду тем. Крім того, ви можете встановлювати та створювати нові пакети значків.',
	'ACP_SMILIES_EXPLAIN'	=> 'Смайлики - це маленькі, інколи анімовані, зображення, які використовуються для передачі емоцій та почуттів. На цій сторінці ви можете додавати, видаляти та редагувати смайлики, які користувачі можуть використовувати в своїх повідомленнях та приватних повідомленнях. Крім того, ви можете встановлювати та створювати нові пакети смайликів.',
	'ADD_SMILIES'			=> 'Додати декілька смайликів',
	'ADD_SMILEY_CODE'		=> 'Додати додатковий код смайлика',
	'ADD_ICONS'				=> 'Додати декілька значків',
	'AFTER_ICONS'			=> 'Після %s',
	'AFTER_SMILIES'			=> 'Після %s',

	'CODE'						=> 'Код',
	'CURRENT_ICONS'				=> 'Встановлені значки',
	'CURRENT_ICONS_EXPLAIN'		=> 'Оберіть дію для встановлених значків.',
	'CURRENT_SMILIES'			=> 'Встановлені смайлики',
	'CURRENT_SMILIES_EXPLAIN'	=> 'Оберіть дію для встановлених смайликів.',

	'DISPLAY_ON_POSTING'		=> 'Відображати на сторінці розміщення повідомлення',
	'DISPLAY_POSTING'			=> 'На сторінці розміщення повідомлення',
	'DISPLAY_POSTING_NO'		=> 'Не на сторінці розміщення повідомлення',
 
	'EDIT_ICONS'				=> 'Редагувати значки',
	'EDIT_SMILIES'				=> 'Редагувати смайлики',
	'EMOTION'					=> 'Емоція',
	'EXPORT_ICONS'				=> 'Експортувати та завантажити icons.pak',
	'EXPORT_ICONS_EXPLAIN'		=> '%sПісля натиснення на це посилання, конфігурацію встановлених значків буде запаковано в файл <samp>icons.pak</samp>, який після завантаження можна використовувати для створення архіву <samp>.zip</samp> або <samp>.tgz</samp>, який буде містити усі ваші значки та файл конфігурації <samp>icons.pak</samp>%s.',
	'EXPORT_SMILIES'			=> 'Експортувати та завантажити smilies.pak',
	'EXPORT_SMILIES_EXPLAIN'	=> '%sПісля натиснення на це посилання, конфігурацію встановлених смайликів буде запаковано в файл <samp>smilies.pak</samp>, який після завантаження можна використовувати для створення архіву <samp>.zip</samp> або <samp>.tgz</samp>, який буде містити усі ваші смайлики та файл конфігурації <samp>smilies.pak</samp>%s.',

	'FIRST'			=> 'Перший',

	'ICONS_ADD'				=> 'Додати новий значок',
	'ICONS_ONE_ADDED'		=> 'Значок успішно додано.',
	'ICONS_ADDED'			=> 'Значки успішно додано.',
	'ICONS_CONFIG'			=> 'Конфігурація значка',
	'ICONS_DELETED'			=> 'Значок успішно видалено.',
	'ICONS_EDIT'			=> 'Редагувати значок',
	'ICONS_ONE_EDITED'		=> 'Значок успішно оновлено.',
	'ICONS_EDITED'			=> 'Значки успішно оновлено.',
	'ICONS_HEIGHT'			=> 'Висота значка',
	'ICONS_IMAGE'			=> 'Зображення значка',
	'ICONS_IMPORTED'		=> 'Пакет значків успішно встановлено.',
	'ICONS_IMPORT_SUCCESS'	=> 'Пакет значків успішно імпортовано.',
	'ICONS_LOCATION'		=> 'Розміщення значка',
	'ICONS_NONE_ADDED' 	=> 'Значків не додано. ',
	'ICONS_NONE_EDITED' 	=> 'Значки не оновлено.', 

	'ICONS_NOT_DISPLAYED'	=> 'Наступні значки не відображаються на сторінці розміщення повідомлень',
	'ICONS_ORDER'			=> 'Порядок значків',
	'ICONS_URL'				=> 'Файл зображення значка',
	'ICONS_WIDTH'			=> 'Ширина значка',
	'IMPORT_ICONS'			=> 'Встановити пакет значків',
	'IMPORT_SMILIES'		=> 'Встановити пакет смайликів',

	'KEEP_ALL'			=> 'Зберегти всі',

	'MASS_ADD_SMILIES'	=> 'Додати декілька смайликів',

	'NO_ICONS_ADD'		=> 'Немає значків, доступних для додавання.',
	'NO_ICONS_EDIT'		=> 'Немає значків, доступних для редагування.',
	'NO_ICONS_EXPORT'	=> 'Значки для створення пакету відсутні.',
	'NO_ICONS_PAK'		=> 'Пакет значків не знайдено.',
	'NO_SMILIES_ADD'	=> 'Немає смайликів, доступних для додавання.',
	'NO_SMILIES_EDIT'	=> 'Немає смайликів, доступних для редагування.',
	'NO_SMILIES_EXPORT'	=> 'Смайлики для створення пакету відсутні.',
	'NO_SMILIES_PAK'	=> 'Пакети смайликів не знайдено.',

	'PAK_FILE_NOT_READABLE'		=> 'Не вдається прочитати файл <samp>.pak</samp>.',

	'REPLACE_MATCHES'	=> 'Замінити matches',

	'SELECT_PACKAGE'			=> 'Оберіть файл пакету',
	'SMILIES_ADD'				=> 'Додати новий смайлик',
	'SMILIES_NONE_ADDED'		=> 'Смайликів не додано.',
	'SMILIES_ONE_ADDED'			=> 'Смайлик успішно додано.',
	'SMILIES_ADDED'				=> 'Смайлики успішно додано.',
	'SMILIES_CODE'				=> 'Код смайлика',
	'SMILIES_CONFIG'			=> 'Конфігурація смайлика',
	'SMILIES_DELETED'			=> 'Смайлик успішно видалено.',
	'SMILIES_EDIT'				=> 'Редагувати смайлик',
	'SMILIE_NO_CODE'         => 'Смайл “%s”  було проігноровано, оскільки не було введено його код.',
	'SMILIE_NO_EMOTION'         => 'Смайл “%s” було проігноровано, оскільки не було додано емоції.',
  'SMILIE_NO_FILE'			=> 'Смайл “%s”  було проігноровано, оскільки файл відсутній.',
	'SMILIES_NONE_EDITED'		=> 'Смайлики не оновлено.',
	'SMILIES_ONE_EDITED'		=> 'Смайлик успішно оновлено.',
	'SMILIES_EDITED'			=> 'Смайлики успішно оновлено.',
	'SMILIES_EMOTION'			=> 'Емоція',
	'SMILIES_HEIGHT'			=> 'Висота смайлика',
	'SMILIES_IMAGE'				=> 'Зображення смайлика',
	'SMILIES_IMPORTED'			=> 'Пакет смайликів успішно встановлено.',
	'SMILIES_IMPORT_SUCCESS'	=> 'Пакет смайликів успішно імпортовано.',
	'SMILIES_LOCATION'			=> 'Розміщення смайлика',
	'SMILIES_NOT_DISPLAYED'		=> 'Наступні смайлики не відображаються на сторінці розміщення повідомлень',
	'SMILIES_ORDER'				=> 'Порядок смайлика',
	'SMILIES_URL'				=> 'Файл зображення смайлика',
	'SMILIES_WIDTH'				=> 'Ширина смайлика',

 	'TOO_MANY_SMILIES'			=> 'Перевищено межу в кількості %d смайликів.',
	'WRONG_PAK_TYPE'	=> 'Вказаний пакет не містить відповідних даних.',
));

// Word censors
$lang = array_merge($lang, array(
	'ACP_WORDS_EXPLAIN'		=> 'З цієї панелі керування ви можете додавати, редагувати та видаляти слова, які будуть автоматично підлягати цензурі на ваших форумах. Користувачі зможуть зареєструватись з іменами, які містять дані слова. Дозволяється використання маски (*) в словах, наприклад *тест* буде відповідати слову "протестований", тест* буде відповідати слову "тестування", *тест - слову "протест".',
	'ADD_WORD'				=> 'Додати нове слово',

	'EDIT_WORD'		=> 'Редагувати слово',
	'ENTER_WORD'	=> 'Вам необхідно ввести слово і його заміну.',

	'NO_WORD'	=> 'Не обране слово для редагування.',

	'REPLACEMENT'	=> 'Заміна',

	'UPDATE_WORD'	=> 'Оновити слово',

	'WORD'				=> 'Слово',
	'WORD_ADDED'		=> 'Слово успішно додано.',
	'WORD_REMOVED'		=> 'Обране слово успішно видалено.',
	'WORD_UPDATED'		=> 'Обране слово успішно оновлено.',
));

// Ranks
$lang = array_merge($lang, array(
	'ACP_RANKS_EXPLAIN'		=> 'За допомогою даної форми ви можете додавати, редагувати та видаляти звання. Крім того, ви можете створювати спеціальні звання, які можуть присвоюватись користувачам на сторінці керування користувачами.',
	'ADD_RANK'				=> 'Додати нове звання',

	'MUST_SELECT_RANK'		=> 'Вам необхідно обрати звання.',
	
	'NO_ASSIGNED_RANK'		=> 'Спеціальне звання не присвоєно.',
	'NO_RANK_TITLE'			=> 'Ви не вказали назву для звання.',
	'NO_UPDATE_RANKS'		=> 'Звання успішно видалено. Проте, облікові записи користувачів, які використовують це звання, не оновлено. Вам необхідно вручну змінити звання в цих облікових записах.',

	'RANK_ADDED'			=> 'Звання успішно додано.',
	'RANK_IMAGE'			=> 'Зображення для звання',
	'RANK_IMAGE_EXPLAIN'	=> 'Використайте для присвоєння маленького малюнка для асоціації з званням. Шлях вказуйте відносно кореневої папки phpBB.',
 	'RANK_IMAGE_IN_USE'		=> '(використовується)',
	'RANK_MINIMUM'			=> 'Мінімум повідомлень',
	'RANK_REMOVED'			=> 'Звання успішно видалено.',
	'RANK_SPECIAL'			=> 'Спеціальне звання',
	'RANK_TITLE'			=> 'Назва звання',
	'RANK_UPDATED'			=> 'Звання успішно оновлено.',
));

// Disallow Usernames
$lang = array_merge($lang, array(
	'ACP_DISALLOW_EXPLAIN'	=> 'Тут ви можете керувати іменами користувачів, які не дозволяється використовувати. В заборонених іменах користувачів дозволяється використання маски *.',
	'ADD_DISALLOW_EXPLAIN'	=> 'Ви можете заборонити ім\'я користувача. Використовуйте маску * для заміни будь-яких символів в імені.',
	'ADD_DISALLOW_TITLE'	=> 'Додати заборонене ім\'я',

	'DELETE_DISALLOW_EXPLAIN'	=> 'Ви можете видалити заборонене ім\'я, обравши його з списку та натиснувши "Відправити".',
	'DELETE_DISALLOW_TITLE'		=> 'Видалити заборонене ім\'я',
	'DISALLOWED_ALREADY'		=> 'Введене вами ім\'я не може бути заборонено.',
	'DISALLOWED_DELETED'		=> 'Заборонене ім\'я успішно видалено.',
	'DISALLOW_SUCCESSFUL'		=> 'Заборонене ім\'я успішно додано.',

	'NO_DISALLOWED'				=> 'Немає заборонених імен користувачів',
	'NO_USERNAME_SPECIFIED'		=> 'Ви не обрали або не ввели ім\'я користувача.',
));

// Reasons
$lang = array_merge($lang, array(
	'ACP_REASONS_EXPLAIN'	=> 'Тут ви можете керувати причинами, які використовуються в скаргах та в повідомленнях про відхилення повідомлень користувачів. Причина за замовчуванням (позначена *) не може бути видаленою. Зазвичай ця причина використовується у випадку, коли інші причини не підходять.',
	'ADD_NEW_REASON'		=> 'Додати нову причину',
	'AVAILABLE_TITLES'		=> 'Доступні причини на інших мовах',
	
	'IS_NOT_TRANSLATED'			=> 'Причину <strong>не</strong> перекладено.',
	'IS_NOT_TRANSLATED_EXPLAIN'	=> 'Причину <strong>не</strong> перекладено. Якщо ви хочете надати локалізовану форму, вкажіть вірний ключ з файлів мови розділу причин так скарг.',
	'IS_TRANSLATED'				=> 'Причину перекладено.',
	'IS_TRANSLATED_EXPLAIN'		=> 'Причину перекладено. Якщо заголовок, введений вами тут, вказаний в файлах мови в розділі причин і скарг, то буде використовуватись локалізована форма заголовку та опису.',
	
	'NO_REASON'					=> 'Причину не знайдено.',
	'NO_REASON_INFO'			=> 'Вкажіть заголовок та опис для цієї причини.',
	'NO_REMOVE_DEFAULT_REASON'	=> 'Ви не можете видалити причину за замовчуванням "Інше".',

	'REASON_ADD'				=> 'Додати причину скарги/відмови',
	'REASON_ADDED'				=> 'Причину скарги/відмови успішно додано.',
	'REASON_ALREADY_EXIST'		=> 'Причина з таким заголовком вже існує, будь-ласка, введіть інший заголовок для цієї причини.',
	'REASON_DESCRIPTION'		=> 'Опис причини',
	'REASON_DESC_TRANSLATED'	=> 'Опис причини, який буде відображатись',
	'REASON_EDIT'				=> 'Редагувати причину скарги/відмови',
	'REASON_EDIT_EXPLAIN'		=> 'Тут ви маєте можливість додавати та редагувати причину. Якщо причина перекладена, то використовується локалізована версія, замість введеного тут опису.',
	'REASON_REMOVED'			=> 'Причину скарги/відмови успішно видалено.',
	'REASON_TITLE'				=> 'Заголовок причини',
	'REASON_TITLE_TRANSLATED'	=> 'Заголовок причини, який буде відображатись',
	'REASON_UPDATED'			=> 'Причину скарги/відмови успішно оновлено.',

	'USED_IN_REPORTS'		=> 'Використовується в скаргах',
));

?>