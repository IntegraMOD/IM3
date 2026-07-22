<?php
/**
*
* common [Ukrainian]
*
* @package language
* @version $Id: calendar.php,v ALPHA 3.5 2007/10/02 12:00:00 jcc264 Exp $
* @copyright (c) 2007 M and J Media
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* DO NOT CHANGE
*/
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
//
// Some characters you may want to copy&paste:
// ' » " " …
//
// Board Settings
$lang = array_merge($lang, array(
    'ACP_CALENDAR_SETTINGS'					=> 'Налаштування Календаря',
    'ACP_CALENDAR_SETTINGS_EXPLAIN'			=> 'Тут ви можете визначити загальні налаштування для календаря.<br />Деякі з цих параметрів також будуть доступні для користувачів на індивідуальній основі. Однак у вас є можливість перевизначити налаштування користувача',
    'ACP_CALENDAR_USER_SETTINGS'			=> 'Налаштування Користувача Календаря',
    'ACP_CALENDAR_USER_SETTINGS_EXPLAIN'	=> 'Тут ви можете керувати налаштуваннями користувачів для календаря',
    'OVERRIDE_USER'							=> 'Перевизначити Налаштування Користувача',
    'OVERRIDE_USER_EXPLAIN'					=> 'Ви можете вирішити, чи використовувати ваші налаштування для всіх користувачів, або дозволити їм налаштовувати параметри',
    'ALLOW_PRIV_EVENTS'						=> 'Дозволити Приватні Події',
    'ALLOW_PRIV_EVENTS_EXPLAIN'				=> 'Приватні події не можуть бути переглянуті жодними користувачами, крім тих, яких вказує автор події',
    'ALLOW_INDEX_MINICAL'					=> 'Дозволити Міні Календар на Головній',
    'SHOW_WEEK_NUMS'						=> 'Показувати Номери Тижнів',
    'SHOW_WEEK_NUMS_EXPLAIN'				=> 'Ви можете опціонально відображати номери тижнів ISO-8601 в основному вигляді календаря',
    'MONDAY_FIRST'							=> 'День Початку Календаря',
    'MONDAY_FIRST_EXPLAIN'					=> 'Відображати тижні календаря починаючи з неділі або понеділка',
    'SHOW_EVENTS_LIST'						=> 'Показувати Список Подій',
    'SHOW_EVENTS_LIST_EXPLAIN'				=> 'Опціонально відображати список майбутніх подій під основним виглядом календаря. Ви можете визначити, за скільки днів наперед повинні відображатися події',
    'SHOW_BIRTHDAYS_LIST'					=> 'Показувати Список Днів Народження',
    'SHOW_BIRTHDAYS_LIST_EXPLAIN'			=> 'Опціонально відображати список майбутніх днів народження під основним виглядом календаря. Ви можете визначити, за скільки днів наперед повинні відображатися дні народження',
    'SHOW_BIRTHDAYS_MAIN'					=> 'Показувати Дні Народження У Календарі',
    'SHOW_BIRTHDAYS_MAIN_EXPLAIN'			=> 'Опціонально відображати дні народження в основному вигляді календаря',
    'MAX_EVENTS_LIST_DAYS'					=> 'Максимум Днів Для Списку Подій',
    'MAX_EVENTS_LIST_DAYS_EXPLAIN'			=> 'Визначте максимальну кількість днів, яку користувач може вказати для відображення майбутніх подій у списку подій під основним виглядом календаря',
    'DEFAULT_EVENTS_LIST_DAYS'				=> 'Стандартні Дні Для Списку Подій',
    'DEFAULT_EVENTS_LIST_DAYS_EXPLAIN'		=> 'Визначте стандартне налаштування для того, скільки днів майбутніх подій повинно відображатися у списку майбутніх подій під основним виглядом календаря',
    'MAX_BDAYS_LIST_DAYS'					=> 'Максимум Днів Для Списку Днів Народження',
    'MAX_BDAYS_LIST_DAYS_EXPLAIN'			=> 'Визначте максимальну кількість днів, яку користувач може вказати для відображення майбутніх днів народження у списку майбутніх днів народження під основним виглядом календаря',
    'DEFAULT_BDAYS_LIST_DAYS'				=> 'Стандартні Дні Для Списку Днів Народження',
    'DEFAULT_BDAYS_LIST_DAYS_EXPLAIN'		=> 'Визначте стандартне налаштування для того, скільки днів майбутніх днів народження повинно відображатися у списку майбутніх днів народження під основним виглядом календаря',
    'CALENDAR_VERSION'						=> 'Версія Календаря',
    'CALENDAR_VERSION_EXPLAIN'				=> 'Поточна встановлена версія календарного модуля.<br />Для підтримки відвідайте: www.stargate-portal.com',
    'SUNDAY'								=> 'Неділя',
    'MONDAY'								=> 'Понеділок',
));
