<?php
/**
*
* acp_search [Ukrainian]
*
* @package language
* @version $Id: search.php,v 1.21 2007/10/04 15:07:24 acydburn Exp $
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

$lang = array_merge($lang, array(
	'ACP_SEARCH_INDEX_EXPLAIN'				=> 'Тут ви можете керувати індексацією пошуку. Оскільки використовується лише один механізм, видаліть усі індекси, які ви не використовуєте. Після зміни деяких налаштувань пошуку (наприклад кількості мінімуму/максимуму символів) є зміст повторно створити індекс для відтворення цих змін.',
	'ACP_SEARCH_SETTINGS_EXPLAIN'			=> 'Тут ви можете встановити, який механізм пошуку буде використовуватись для індексування повідомлень та здійснення пошуку. Ви можете задавати різні налаштування, які можуть впливати на кількість ресурсів необхідних для цих дій. Деякі з цих налаштувань однакові для усіх механізмів пошуку.',

	'COMMON_WORD_THRESHOLD'					=> 'Поріг загальних слів',
	'COMMON_WORD_THRESHOLD_EXPLAIN'			=> 'Слова, які найчастіше зустрічаються в повідомленнях, будуть прийматись за загальні. Загальні слова ігноруються в пошукових запитах. Встановіть значення нуль для вимкнення. Працює при кількості повідомлень більше 100. Якщо ви хочете, щоб слова, котрі наразі визначені як загальні, були переглянуті, вам необхідно створити заново індекс.',
	'CONFIRM_SEARCH_BACKEND'				=> 'Ви впевнені, що бажаєте перемикнутись на інший механізм пошуку? Після зміни механізму пошуку вам потрібно створити індекс для нового механізму. Якщо ви не плануєте переключатись назад на старий механізм пошуку, ви можете видалити індекс попереднього механізму для зменшення розміру бази даних.',
	'CONTINUE_DELETING_INDEX'				=> 'Продовжити попередній процес видалення індексу',
	'CONTINUE_DELETING_INDEX_EXPLAIN'		=> 'Процес видалення індексу розпочато. Для доступу до сторінки індексування пошуку, вам необхідно дочекатись завершення процесу або відмінити його.',
	'CONTINUE_INDEXING'						=> 'Продовжити попередній процес індексування',
	'CONTINUE_INDEXING_EXPLAIN'				=> 'Процес індексування розпочато. Для доступу до сторінки індексування пошуку, вам необхідно дочекатись завершення процесу або відмінити його.',
	'CREATE_INDEX'							=> 'Створити індекси',

	'DELETE_INDEX'							=> 'Видалити індекси',
	'DELETING_INDEX_IN_PROGRESS'			=> 'Видалення індексу в процесі',
	'DELETING_INDEX_IN_PROGRESS_EXPLAIN'	=> 'Відбувається видалення пошукового індексу. Це може тривати декілька хвилин.',

	'FULLTEXT_MYSQL_INCOMPATIBLE_VERSION'	=> 'Повнотекстовий механізм пошуку MySQL може використовуватись з MySQL4 та вище.',
  'FULLTEXT_MYSQL_NOT_SUPPORTED'			=> 'Повнотекстові індекси MySQL можуть використовуватись лише з таблицями MyISAM або InnoDB. Для повнотекстових індексів таблиць InnoDB необхідний MySQL версії 5.6.4 або пізнішої.',
	'FULLTEXT_MYSQL_TOTAL_POSTS'			=> 'Загальна кількість проіндексованих повідомлень',
	'FULLTEXT_MYSQL_MBSTRING'				=> 'Підтримка нелатинcьких символів UTF-8 за допомогою mbstring:',
	'FULLTEXT_MYSQL_PCRE'					=> 'Підтримка нелатинcьких символів UTF-8 за допомогою PCRE:',
	'FULLTEXT_MYSQL_MBSTRING_EXPLAIN'		=> 'Якщо PCRE не має властивостей символів унікода, механізм пошуку буде намагатись використати механізм регулярних виразів mbstring.',
	'FULLTEXT_MYSQL_PCRE_EXPLAIN'			=> 'Для цього пошукового механізму вимагає властивостей символів юнікод PCRE, які підтримуються лише в PHP 4.4, 5.1 та вище, якщо вам потрібно здійснювати пошук нелатинських символів.',
   'FULLTEXT_MYSQL_MIN_SEARCH_CHARS_EXPLAIN'   => 'Слова з такою мінімальною кількістю символів буде проіндексовано для пошуку. Лише ви або ваш хостер може змінювати це налаштування, змінюючи конфігурацію MySQL.',
  'FULLTEXT_MYSQL_MAX_SEARCH_CHARS_EXPLAIN'   => 'Слова з кількістю символів більше вказаної не буде проіндексовано  для пошуку. Лише ви або ваш хостер може змінювати це налаштування, змінюючи конфігурацію MySQL.',

	'GENERAL_SEARCH_SETTINGS'				=> 'Загальні налаштування пошуку',
	'GO_TO_SEARCH_INDEX'					=> 'Перейти на сторінку індексування пошуку',

	'INDEX_STATS'							=> 'Статистика індексування',
	'INDEXING_IN_PROGRESS'					=> 'Індексування в процесі',
	'INDEXING_IN_PROGRESS_EXPLAIN'			=> 'Відбувається індексування усіх повідомлень форуму. Це може тривати від декількох хвилин до декількох годин залежно від розмірів бази даних вашого форуму.',

	'LIMIT_SEARCH_LOAD'						=> 'Обмеження пошуку при високому завантаженні системи',
	'LIMIT_SEARCH_LOAD_EXPLAIN'				=> 'Якщо завантаження системи протягом 1 хвилини перевищить це значення, сторінка пошуку перейде в офлайн, 1.0 відповідає ~100% завантаженню процесора. Це функціонує лише на UNIX-серверах.',

	'MAX_SEARCH_CHARS'						=> 'Максимальна кількість символів для індексування',
	'MAX_SEARCH_CHARS_EXPLAIN'				=> 'Слова з такою або меншою кількістю символів будуть проіндексовані для пошуку.',
        'MAX_NUM_SEARCH_KEYWORDS'            => 'Максимальна кількість ключових слів',
	'MAX_NUM_SEARCH_KEYWORDS_EXPLAIN'      => 'Максимальна кількість слів, які користувач може використовувати для пошуку. Значення 0 відповідає необмеженій кількості слів.',
	'MIN_SEARCH_CHARS'						=> 'Мінімальна кількість символів для індексування',
	'MIN_SEARCH_CHARS_EXPLAIN'				=> 'Слова з такою або більшою кількістю символів будуть проіндексовані для пошуку.',
	'MIN_SEARCH_AUTHOR_CHARS'				=> 'Мінімальне число символів в іменах',
	'MIN_SEARCH_AUTHOR_CHARS_EXPLAIN'		=> 'Користувачі повинні ввести не менше вказаної кількості символів при здійсненні пошуку за маскою. Якщо ім\'я автора коротше за це значення, ви можете здійснювати пошук повідомлень автора, ввівши ім\'я автора повністю.',

	'PROGRESS_BAR'							=> 'Індикатор виконання',

	'SEARCH_GUEST_INTERVAL'					=> 'Інтервал між запитами для гостей',
	'SEARCH_GUEST_INTERVAL_EXPLAIN'			=> 'Час в секундах, через який гості зможуть здійснювати наступний пошук. Якщо один гість здійснює пошук, усі інші чекають, поки не пройде цей інтервал часу.',
	'SEARCH_INDEX_CREATE_REDIRECT'			=> 'Усі повідомлення до повідомлення під номером %1$d проіндексовано, з яких %2$d повідомлень проіндексовано на даному кроці.<br />Поточна швидкість індексування - близько %3$.1f повідомлень в секунду.<br />Індексування в процесі…',
	'SEARCH_INDEX_DELETE_REDIRECT'			=> 'Усі повідомлення до повідомлення під номером %1$d видалено з пошукового індексу.<br />Видалення в процесі…',
	'SEARCH_INDEX_CREATED'					=> 'Успішно проіндексовано усі повідомлення в базі даних форуму.',
	'SEARCH_INDEX_REMOVED'					=> 'Успішно видалено пошуковий індекс для цього механізму.',
	'SEARCH_INTERVAL'						=> 'Інтервал між пошуковими запитами',
	'SEARCH_INTERVAL_EXPLAIN'				=> 'Час в секундах, через який користувачі зможуть здійснювати наступний пошук. Цей інтервал перевіряється окремо для кожного користувача.',
	'SEARCH_STORE_RESULTS'					=> 'Тривалість дії кешу результатів пошуку',
	'SEARCH_STORE_RESULTS_EXPLAIN'			=> 'Закешовані результати пошуку будуть дійсні протягом цього часу (в секундах). Встановіть 0, якщо ви хочете вимкнути кешування пошуку.',
	'SEARCH_TYPE'							=> 'Пошуковий механізм',
	'SEARCH_TYPE_EXPLAIN'					=> 'phpBB дозволяє вам обрати механізм, який буде використовуватись для пошуку тексту в повідомленнях. За замовчуванням пошук буде використовувати власний повнотекстовий пошук phpBB.',
	'SWITCHED_SEARCH_BACKEND'				=> 'Ви змінили механізм пошуку. Для використання нового пошукового механізму переконайтесь, що індекс для обраного вами механізму створено.',

	'TOTAL_WORDS'							=> 'Загальна кількість проіндексованих слів',
	'TOTAL_MATCHES'							=> 'Загальна кількість проіндексованих слів, пов\'язаних з повідомленнями',

	'YES_SEARCH'							=> 'Увімкнути пошукові можливості',
	'YES_SEARCH_EXPLAIN'					=> 'Вмикає функції пошуку, включаючи пошук учасників.',
	'YES_SEARCH_UPDATE'						=> 'Увімкнути повнотекстове оновлення',
	'YES_SEARCH_UPDATE_EXPLAIN'				=> 'Оновлення повнотекстових індексів при розміщенні повідомлень, не працює при вимкненій функції пошуку.',
));

