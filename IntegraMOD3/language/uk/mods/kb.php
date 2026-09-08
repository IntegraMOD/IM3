<?php
/**
*
* Knowledge Base [Ukrainian]
* @author Tobi Schaefer http://www.tas2580.de/
*
* @package language
* @version $Id$
* @copyright (c) 2007 SEO phpBB http://www.phpbb-seo.de
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
	'VIEW_KB_TOPIC'				=> 'Переглянути тему на форумі',
	'EDIT_REASON'				=> 'Причина редагування цієї статті',
	'ACL_TYPE_KB_'				=> '',
	'ACP_KB_ROLES'				=> 'Ролі бази знань',
	'ACP_KB_ROLES_EXPLAIN'		=> '',
	'KB_CATEGORIE_PERMISSIONS'	=> 'Права доступу до категорій бази знань',
	'KB_CATEGORIE_PERMISSIONS_DESC'	=> 'Тут можна змінити, які користувачі та групи мають доступ до якої категорії.',
	'LOOK_UP_CATEGORIE'			=> 'Виберіть категорію',
	'LOOK_UP_FORUMS_EXPLAIN'	=> 'Ви можете вибрати більше ніж одну категорію',
	'ACL_TYPE_LOCAL_KB_'		=> 'Права доступу бази знань',
	'PERMISSION_TYPE'			=> 'Права доступу бази знань',
	'ALL_CATEGORIES'			=> 'Усі категорії',
	'SELECT_CATEGORIE_SUBFORUM_EXPLAIN'	=> 'Вибрана тут категорія також включить усі підкатегорії.',
	'USER'						=> 'Користувач',
	'ACTIVATE_RATING'			=> 'Дозволити оцінювання',
	'ACTIVATE_RATING_DESC'		=> 'Дозволити користувачам оцінювати статті',
	'YOU_RATED'					=> 'Власна оцінка',
	'ALREADY_RATED'				=> 'ПОМИЛКА!!! Ви вже оцінили',
	'ARTICLE_RATED'				=> 'Ви оцінили цю статтю',
	'RATING'					=> 'Оцінка',
	'RATINGS'					=> 'Оцінки',
	'RATE_GOOD'					=> 'дуже добре',
	'RATE_ACCEPTABLE'			=> 'прийнятно',
	'RATE_BAD'					=> 'погано',
	'RATE_ARTICLE'				=> 'Оцінити статтю',
	'RATE'						=> 'Оцінити',
	'ACTIVATE_POST'				=> 'Створити повідомлення',
	'ACTIVATE_POST_DESC'		=> 'Створювати повідомлення на форумі під час додавання статті',
	'ACTIVATE_DIFF'				=> 'Увімкнути історію',
	'ACTIVATE_DIFF_DESC'		=> 'Під час редагування статті буде збережено попередню версію',
	'ACTION'					=> 'Дія',
	'ACTIVATE_SIMILAR'			=> 'Увімкнути схожі статті',
	'ACTIVATE_SIMILAR_DESC'		=> '',
	'DIFFERENCE'				=> 'Відмінність між версією: %s і поточною статтею',
	'DIFF_DEL'					=> 'Видалити стару версію?',
	'DIFF_RESTORE'				=> 'Відновити стару версію',
	'ARTICLE_RESTORED'			=> 'Статтю відновлено',
	'SIMILAR_ARTICLES'			=> 'Схожі статті',
	'OLD_VERSIONS'				=> 'Старі версії',
	'RESTORE'					=> 'Відновити',
	'ARTICLE_DETAIL'			=> 'Подробиці статті',
	'ARTICLE_REPORTED'			=> 'Цю статтю було повідомлено',
	'DISPLAY_ON_INDEX'			=> 'Показувати в головній категорії',
	'DISPLAY_ON_INDEX_DESC'		=> '',
	'DELETED'					=> 'Запис видалено',
	'MCP_REPORT_TITLE'			=> 'Повідомлені статті',
	'MCP_REPORT_EXPLAIN'		=> '',
	'REALY_DELETE'				=> 'Справді видалити цей запис?',
	'VIEW_REPORTS_OLD'			=> 'Переглянути закриті скарги',
	'VIEW_REPORTS_NEW'			=> 'Переглянути відкриті скарги',
	'SHOW_ARTICLE'				=> 'Показати статтю',
	'SORT_ORDER'				=> 'Порядок сортування',
	'SORT_ORDER_DESC'			=> 'Сортування статей у категоріях',
	'SUB_CATGEGORIES'			=> 'Підкатегорії',
	'SEARCH_CATEGORIE'			=> 'Шукати категорію',
	'ACP_TYPES'					=> 'Типи статей',
	'ACP_TYPES_DESC'			=> 'Тут можна додавати та редагувати типи статей',
	'ACP_CATEGORIE'				=> 'Категорія',
	'ACP_CATEGORIE_DESC'		=> 'Тут можна додавати або редагувати категорії бази знань.',
	'ACP_CONFIG'				=> 'Налаштування',
	'ACP_CONFIG_DESC'			=> 'Тут можна змінити налаштування бази знань.',
	'ARTICLE_ACTIVATED'			=> 'Статтю опубліковано!',
	'ARTICLE_DELETED'			=> 'Статтю видалено!',
	'ARTICLE_ADDED'				=> 'Статтю надіслано; після перевірки її буде опубліковано в базі знань.',
	'ARTICLE_HISTORY'			=> 'Журнал статті',
	'ARTICLE_ADD'				=> 'Додати статтю',
	'ARTICLE_TITLE'				=> 'Заголовок',
	'ARTICLE_TITLE_LANG_EXPLAIN'	=> 'Щоб використати локалізований рядок каталогу, введіть усе поле як {L_KEY}. Ключі зберігаються в language/{iso}/kb/articles.php. Збережіть цей PHP-файл як UTF-8 без BOM (Notepad++: Encoding → Convert to UTF-8 without BOM, потім Save). Блокнот Windows може додати BOM і зірвати форум помилкою headers already sent. Звичайні заголовки зберігаються так, як їх введено.',
	'ARTICLE_DESCRIPTION'		=> 'Опис',
	'ARTICLE_DESCRIPTION_LANG_EXPLAIN'	=> 'Необов’язково. Використовуйте {L_KEY} для локалізованого опису або звичайний текст. Файли каталогу треба зберігати як UTF-8 без BOM.',
	'ARTICLE_LANG_EXPLAIN'		=> 'Щоб локалізувати текст статті, введіть у цьому полі лише {L_KEY}. Інакше пишіть статтю як завжди. Редагуйте language/{iso}/kb/articles.php у Notepad++ або іншому редакторі, який уміє створювати UTF-8 без BOM. Не використовуйте Блокнот Windows.',
	'KB_LANG_KEY_MISSING'		=> 'Мовний ключ %s не знайдено в language/en/kb/articles.php.',
	'ARTICLE'					=> 'Стаття',
	'ARTICLE_TYPES'				=> 'Типи статей',
	'ARTICLE_TYPES_DESC'		=> 'У яких типах статей ви хочете шукати? Утримуйте клавішу Ctrl, щоб вибрати кілька типів. Не вибирайте тип, щоб шукати в усіх типах.',
	'ARTICLE_CONT'				=> 'Статті в базі даних',
	'ARTICLE_DEL'				=> 'Справді видалити статтю?',
	'ARTICLE_EDIT'				=> 'Редагувати статтю',
	'ARTICLE_EDITED'			=> 'Статтю відредаговано!',
	'ARTICLE_DEACTIVATED'		=> 'Заблокована стаття',
	'ARTICLE_POSTET'			=> 'Статтю опубліковано',
	'AKTIVATE'					=> 'Активувати',

	'BACK_ARTICLE'				=> 'Назад до статті',
	'BACK_KB'					=> 'Повернутися до бази знань',
	'BACK_TO_ARTICLE'			=> 'Натисніть %sтут%s, щоб переглянути статтю.',
	'BACK_TO_POSTING'			=> 'Натисніть %sтут%s, щоб повернутися.',
	'BACK_TO_KB'				=> 'Натисніть %sтут%s, щоб повернутися до бази знань.',
	'BACK_TO_LOG'				=> 'Натисніть %sтут%s, щоб повернутися до журналу статті.',

	'CATEGORIE'					=> 'Категорія',
	'CHANGED_AT'				=> 'Змінено',
	'CONT_CAT'					=> 'Категорії',
	'CATEGORIES'				=> 'категорії',
	'CATEGORIES_DESC'			=> 'У яких категоріях ви хочете шукати? Утримуйте клавішу Ctrl, щоб вибрати кілька категорій. Не вибирайте категорію, щоб шукати в усіх.',
	'CAT_NOT_EMPTY'				=> 'Категорія не порожня!',
	'NO_CAT'					=> 'Вибраної категорії не існує.',
	'CAT_NAME'					=> 'Назва категорії',
	'CAT_NAME_DESC'				=> 'Назва категорії',
	'CAT_IMAGE'					=> 'Зображення категорії',
	'CAT_IMAGE_DESC'			=> 'Введіть тут URL зображення для категорії.',
	'CAT_DECRIPTION_DESC'		=> 'Вкажіть опис категорії',
	'CAT_MAIN'					=> 'Головна категорія',
	'CAT_SELECT_MAIN'			=> 'Виберіть головну категорію',
	'CAT_ADDED'					=> 'Категорію додано',
	'CAT_DELETED'				=> 'Категорію видалено.',
	'CAT_UPDATED'				=> 'Категорію оновлено.',
	'CAT_REALY_DELETE'			=> 'Справді видалити категорію?',
	'CAT_CREATE_NEW'			=> 'Нова категорія',
	'DESCRIPTION'				=> 'Опис',


	'FIENAME'				=> 'Ім’я файлу',
	'FOUND_IN'				=> 'Знайдено в',
	'INDEX_POSTS'			=> 'Статті на головній сторінці',
	'INDEX_POSTS_DESC'		=> 'Скільки статей показувати на головній сторінці?',
	'KB_NAME'				=> 'База знань',
	'KB_NAME_DESC'			=> 'Назва бази знань',
	'KB_DECRIPTION_DESC'	=> 'Введіть опис бази знань.',
	'KBASE'					=> 'База знань',
	'KB_DESCRIPTION'		=> 'Якщо ви написали статтю, її можна переглянути внизу сторінки та надіслати на перевірку. Після схвалення статтю буде опубліковано в базі знань. ',

	'LOG_TITEL'				=> 'Журнал статті',
	'LOG_DESCRIPTION'		=> 'Тут можна побачити, коли статтю було відредаговано і яким користувачем.',
	'LOG_DELETED'			=> 'Журнал статті видалено.',

	'MAINCAT_DESC'			=> 'Тут можна створювати головні категорії, у яких потім створюються підкатегорії для статей.',
	'MODE'					=> 'Режим',
	'MODE_DESC'				=> 'Який режим використовувати для головної сторінки?',
	'MODE_MODERN'			=> 'Сучасний',
	'MODE_CLASSIC'			=> 'Класичний',
	'NO_ARTICLE'			=> 'Бажаної статті не існує!',
	'NEED_INPUT'			=> 'Введіть заголовок і текст статті!',
	'ARTICLE_NEW'			=> 'Неопубліковані статті',
	'ARTICLE_NEW_DESC'		=> 'Наступні статті ще не опубліковано або їх заблоковано',
	'NAME'					=> 'Назва категорії',
	'NEED_NAME'				=> 'Вкажіть назву категорії',
	'ARTICLE_NEWEST'		=> 'Найновіша стаття —',
	'NO_TYPE'				=> 'Без типу',
	'POST_FORUM'			=> 'Форум для посилання на статтю',
	'POST_TEMPLATE'			=> 'Шаблон повідомлення',
	'POST_MESSAGE'			=> 'Текст повідомлення',
	'POST_USER'				=> 'ID користувача',
	'POST_NORMAL'			=> 'Звичайне',
	'POST_TOPIC_GLOBAL'		=> 'Глобальне оголошення',
	'POST_TOPIC_AS'			=> 'Створити тему як',
	'POST_TOPIC_AS_DESC'	=> 'Який тип теми буде створено?',
	'POST_USER_DESC'		=> 'ID користувача, який створює повідомлення',
	'POST_SUBJECT'			=> 'Назва теми',
	'POST_SUBJECT_DESC'		=> 'Назва теми, яку буде створено',
	'POST_FORUM_DESC'		=> 'Вкажіть ID форуму, у якому слід створити посилання на статтю. Введіть «0», щоб не створювати посилання на нові статті.',
	'POST_MESSAGE_DESC'		=> '{TITLE} = Заголовок статті <br />{DESCRIPTION} = Опис статті<br />{POST_TIME} = Час написання<br />{TYPE} = Тип статті<br />{SUB_CAT} = Категорія<br />{URL} = URL статті<br />{AUTHOR} = Автор статті<br />{AUTHOR_ID} = ID користувача автора.',
	'RELASED'				=> 'Опубліковано',
	'READ_MORE'				=> 'Показати всі %s статей',


	'SEARCH_KEYWORDS_DESC'	=> 'Тут можна шукати в базі знань.',
	'SHOW_EDITS'			=> 'Показувати редагування',
	'SHOW_EDITS_DESC'		=> 'Чи показувати редагування в статті?',
	'TYPE'					=> 'Тип статті',
	'TYPE_DESC'				=> 'Вкажіть назву типу статті',
	'TYPE_ADDED'			=> 'Тип додано',
	'TYPE_UPDATED'			=> 'Тип видалено',

	'NO_SUBCAT_IN_MAINCAT'	=> 'Не можна створювати підкатегорії на головній сторінці!',
	'CAT_TYPE'				=> 'Тип категорії',
	'CAT_TYPE_DESC'			=> 'Виберіть тип категорії',
	'IN_INDEX'				=> 'На головній',
	'CAT_SUB'				=> 'Підкатегорія',

	'CACHE_TIME'			=> 'Час кешування',
	'CACHE_TIME_DESC'		=> 'Час, протягом якого типи та категорії зберігаються в кеші',
	'SECONDS'				=> 'Секунди',
	'ACTIVATE_TYPES'		=> 'Використовувати типи статей?',
	'ACTIVATE_TYPES_DESC'	=> 'Чи можна призначати тип статті?',
	'UPDATE_POST'			=> 'Оновити повідомлення',
	'UPDATE_POST_DESC'		=> 'Чи оновлювати повідомлення про статтю, коли статтю оновлено?',
	'POST_UPDATE_MESSAGE'	=> 'Статтю оновлено',
	'POST_ID'				=> 'ID повідомлення на форумі',
	'ARTICLE_ADDED_AKTIV'	=> 'Статтю збережено в базі даних і активовано',
	'SHOW_POST_EDIT'		=> 'Показувати оновлення',
	'SHOW_POST_EDIT_DESC'	=> 'Чи показувати оновлення в повідомленні?',

	'PRINT_TOPIC'			=> 'Друкувати статтю',
	'SEARCH_CATEGORIE'		=> 'Шукати в категорії...',

	'ADS'					=> 'Реклама',
	'KB_COPYRIGHT'			=> 'База знань від Tobi Schaefer',
	'ADS_DESC'				=> 'Тут можна вставити код вашої реклами.',
	'URI_IN_USE'			=> 'Цей URL уже використовується',
	'USER_CHANGED'			=> 'Користувача змінено',

));

?>
