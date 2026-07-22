<?php
/**
*
* info_acp_donation.php [Ukrainian]
*
* @package Paypal Donation MOD
* @copyright (c) 2013 Skouat
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
//
// Some characters you may want to copy&paste:
// ' « » " " …
//


/**
* mode: main
*/
$lang = array_merge($lang, array(
    'ACP_DONATION_MOD' => 'Paypal Donation',
));

/**
* mode: overview
*/
$lang = array_merge($lang, array(
    'DONATION_OVERVIEW'			=> 'Огляд',
    'DONATION_WELCOME'			=> 'Ласкаво просимо до Paypal Donation MOD',
    'DONATION_WELCOME_EXPLAIN'	=> '',

    'DONATION_STATS'			=> 'Статистика пожертв',
    'DONATION_INSTALL_DATE'		=> 'Дата встановлення <strong>Paypal Donation MOD</strong>',
    'DONATION_VERSION'			=> 'Версія <strong>Paypal Donation</strong>',

    'INFO_FSOCKOPEN'			=> 'Fsockopen',
    'INFO_CURL'					=> 'cURL',
    'INFO_DETECTED'				=> 'Виявлено',
    'INFO_NOT_DETECTED'			=> 'Не виявлено',
    'DONATION_VERSION_NOT_UP_TO_DATE_TITLE'	=> 'Ваша установка Paypal Donation застаріла.',

    'STAT_RESET_DATE'					=> 'Скинути Дату Встановлення MOD',
    'STAT_RESET_DATE_EXPLAIN'			=> 'Скидання встановлення впливає на статистику про розрахунок загальної суми',
    'STAT_RESET_DATE_CONFIRM'			=> 'Ви впевнені, що бажаєте скинути дату встановлення MOD?',
));

/**
* mode: configuration
*/
$lang = array_merge($lang, array(
    'DONATION_CONFIG'			=> 'Конфігурація',
    'DONATION_CONFIG_EXPLAIN'	=> '',
    'DONATION_SAVED'			=> 'Налаштування пожертв збережено',
    'MODE_CURRENCY'				=> 'валюта',
    'MODE_DONATION_PAGES'		=> 'сторінки пожертв',

    // Global Donation settings
    'DONATION_ENABLE'						=> 'Увімкнути Paypal Donation',
    'DONATION_ENABLE_EXPLAIN'				=> 'Увімкнути або вимкнути Paypal Donation MOD',
    'DONATION_ACCOUNT_ID'					=> 'ID облікового запису Paypal',
    'DONATION_ACCOUNT_ID_EXPLAIN'			=> 'Введіть вашу адресу електронної пошти Paypal або ID облікового запису продавця',
    'DONATION_DEFAULT_CURRENCY'				=> 'Валюта за замовчуванням',
    'DONATION_DEFAULT_CURRENCY_EXPLAIN'		=> 'Визначте, яка валюта буде вибрана за замовчуванням',
    'DONATION_DEFAULT_VALUE'				=> 'Значення пожертви за замовчуванням',
    'DONATION_DEFAULT_VALUE_EXPLAIN'		=> 'Визначте, яке значення пожертви буде запропоновано за замовчуванням',
    'DONATION_DROPBOX_ENABLE'				=> 'Увімкнути випадаючий список',
    'DONATION_DROPBOX_ENABLE_EXPLAIN'		=> 'Якщо увімкнено, текстове поле буде замінено випадаючим списком.',
    'DONATION_DROPBOX_VALUE'				=> 'Значення випадаючого списку',
    'DONATION_DROPBOX_VALUE_EXPLAIN'		=> 'Визначте числа, які ви хочете бачити у випадаючому списку.<br />Використовуйте <strong>кому</strong> (",") <strong>без пробілів</strong> для розділення кожного значення.',

    // Paypal sandbox settings
    'SANDBOX_SETTINGS'						=> 'Налаштування Paypal sandbox',
    'SANDBOX_ENABLE'						=> 'Тестування Sandbox',
    'SANDBOX_ENABLE_EXPLAIN'				=> 'Увімкніть цю опцію, якщо ви хочете використовувати Paypal Sandbox замість Paypal Services.<br />Корисно для розробників/тестувальників. Всі транзакції фіктивні.',
    'SANDBOX_FOUNDER_ENABLE'				=> 'Sandbox тільки для засновників',
    'SANDBOX_FOUNDER_ENABLE_EXPLAIN'		=> 'Якщо увімкнено, Paypal Sandbox буде відображатися лише засновниками форуму.',
    'SANDBOX_ADDRESS'						=> 'Адреса PayPal sandbox',
    'SANDBOX_ADDRESS_EXPLAIN'				=> 'Визначте тут вашу електронну адресу продавця Paypal Sandbox',

    // Stats Donation settings
    'DONATION_STATS_SETTINGS'				=> 'Конфігурація статистики пожертв',
    'DONATION_STATS_INDEX_ENABLE'			=> 'Відображати статистику пожертв на головній',
    'DONATION_STATS_INDEX_ENABLE_EXPLAIN'	=> 'Увімкніть це, якщо ви хочете відображати статистику пожертв на головній',
    'DONATION_RAISED_ENABLE'				=> 'Увімкнути зібрані пожертви',
    'DONATION_RAISED'						=> 'Зібрані пожертви',
    'DONATION_RAISED_EXPLAIN'				=> 'Поточна сума, зібрана через пожертви',
    'DONATION_GOAL_ENABLE'					=> 'Увімкнути мету пожертв',
    'DONATION_GOAL'							=> 'Мета пожертв',
    'DONATION_GOAL_EXPLAIN'					=> 'Загальна сума, яку ви хочете зібрати',
    'DONATION_USED_ENABLE'					=> 'Увімкнути використані пожертви',
    'DONATION_USED'							=> 'Використані пожертви',
    'DONATION_USED_EXPLAIN'					=> 'Сума пожертв, яку ви вже використали',

    'DONATION_CURRENCY_ENABLE'				=> 'Увімкнути валюту пожертв',
    'DONATION_CURRENCY_ENABLE_EXPLAIN'		=> 'Увімкніть цю опцію, якщо ви хочете відображати код ISO 4217 валюти за замовчуванням у Статистиці.',
));

/**
* mode: donation pages
* Info: language keys are prefixed with 'DONATION_DP_' for 'DONATION_DONATION_PAGES_'
*/
$lang = array_merge($lang, array(
    // Donation Page settings
    'DONATION_DP_CONFIG'		=> 'Сторінки пожертв',
    'DONATION_DP_CONFIG_EXPLAIN'=> 'Дозволяє покращити відображення настроюваних сторінок MOD.',

    'DONATION_DP_PAGE'			=> 'Тип сторінки',
    'DONATION_DP_LANG'			=> 'Мова',

    // Donation Page Body settings
    'DONATION_BODY_SETTINGS'	=> 'Конфігурація головної сторінки пожертв',
    'DONATION_BODY'				=> 'Головна сторінка пожертв',
    'DONATION_BODY_EXPLAIN'		=> 'Введіть текст, який ви хочете відобразити на головній сторінці пожертв.',

    // Donation Success settings
    'DONATION_SUCCESS_SETTINGS'	=> 'Конфігурація успіху пожертви',
    'DONATION_SUCCESS'			=> 'Успіх пожертви',
    'DONATION_SUCCESS_EXPLAIN'	=> 'Введіть текст, який ви хочете відобразити на сторінці успіху.',

    // Donation Cancel settings
    'DONATION_CANCEL_SETTINGS'	=> 'Конфігурація скасування пожертви',
    'DONATION_CANCEL'			=> 'Скасування пожертви',
    'DONATION_CANCEL_EXPLAIN'	=> 'Введіть текст, який ви хочете відобразити на сторінці скасування.',

    // Donation Page Template vars
    'DONATION_DP_PREDEFINED_VARS'=> 'Попередньо визначені змінні',
    'DONATION_DP_VAR_EXAMPLE'	=> 'Приклад',
    'DONATION_DP_VAR_NAME'		=> 'Назва',
    'DONATION_DP_VAR_VAR'		=> 'Змінна',

    'DONATION_DP_BOARD_CONTACT'	=> 'Контакт форуму',
    'DONATION_DP_BOARD_EMAIL'	=> 'Email форуму',
    'DONATION_DP_BOARD_SIG'		=> 'Підпис форуму',
    'DONATION_DP_SITE_DESC'		=> 'Опис сайту',
    'DONATION_DP_SITE_NAME'		=> 'Назва сайту',
    'DONATION_DP_USER_ID'		=> 'ID користувача',
    'DONATION_DP_USERNAME'		=> 'Ім\'я користувача',
));

/**
* mode: currency
* Info: language keys are prefixed with 'DONATION_DC_' for 'DONATION_DONATION_CURRENCY_'
*/
$lang = array_merge($lang, array(
    // Currency Management
    'DONATION_DC_CONFIG'			=> 'Управління валютою',
    'DONATION_DC_CONFIG_EXPLAIN'	=> 'Тут ви можете керувати валютою',
    'DONATION_DC_NAME'				=> 'Назва валюти',
    'DONATION_DC_NAME_EXPLAIN'		=> 'Назва валюти.<br />(наприклад, Євро)',
    'DONATION_DC_ISO_CODE'			=> 'Код ISO 4217',
    'DONATION_DC_ISO_CODE_EXPLAIN'	=> 'Алфавітний код валюти.<br />Більше про ISO 4217… дивіться <a href="http://www.phpbb.com/customise/db/mod/paypal_donation_mod/faq/f_746" title="Paypal Donation MOD FAQ">Paypal Donation MOD FAQ</a> (зовнішнє посилання)',
    'DONATION_DC_SYMBOL'			=> 'Символ валюти',
    'DONATION_DC_SYMBOL_EXPLAIN'	=> 'Визначте символ валюти.<br />(наприклад, € для Євро, $ для Долара США)',
    'DONATION_DC_ENABLED'			=> 'Увімкнути валюту',
    'DONATION_DC_ENABLED_EXPLAIN'	=> 'Якщо увімкнено, валюта буде відображатися у випадаючому списку',
    'DONATION_DC_CREATE_CURRENCY'	=> 'Додати нову валюту',
));

/**
* logs
*/
$lang = array_merge($lang, array(
    //logs
    'LOG_DONATION_UPDATED'		=> '<strong>Paypal Donation: Налаштування оновлено.</strong>',
    'LOG_DONATION_PAGES_UPDATED'=> '<strong>Paypal Donation: Сторінки пожертв оновлено.</strong>',
    'LOG_ITEM_ADDED'			=> '<strong>Paypal Donation: %1$s додано</strong><br />» %2$s',
    'LOG_ITEM_UPDATED'			=> '<strong>Paypal Donation: %1$s оновлено</strong><br />» %2$s',
    'LOG_ITEM_REMOVED'			=> '<strong>Paypal Donation: %1$s видалено</strong>',
    'LOG_ITEM_MOVE_DOWN'		=> '<strong>Paypal Donation: Переміщено %1$s. </strong> %2$s <strong>нижче</strong> %3$s',
    'LOG_ITEM_MOVE_UP'			=> '<strong>Paypal Donation: Переміщено %1$s. </strong> %2$s <strong>вище</strong> %3$s',
    'LOG_ITEM_ENABLED'			=> '<strong>Paypal Donation: %1$s увімкнено</strong><br />» %2$s',
    'LOG_ITEM_DISABLED'			=> '<strong>Paypal Donation: %1$s вимкнено</strong><br />» %2$s',
    'LOG_STAT_RESET_DATE'		=> '<strong>Paypal Donation: Дату встановлення скинуто</strong>',

    // Confirm box
    'DONATION_DC_ENABLED'		=> 'Валюту увімкнено',
    'DONATION_DC_DISABLED'		=> 'Валюту вимкнено.',
    'DONATION_DC_ADDED'			=> 'Додано нову валюту.',
    'DONATION_DC_UPDATED'		=> 'Валюту оновлено.',
    'DONATION_DC_REMOVED'		=> 'Валюту видалено.',
    'DONATION_DP_LANG_ADDED'	=> 'Додано мову сторінки пожертв',
    'DONATION_DP_LANG_UPDATED'	=> 'Оновлено мову сторінки пожертв',
    'DONATION_DP_LANG_REMOVED'	=> 'Видалено мову сторінки пожертв',

    // Errors
    'MUST_SELECT_ITEM'			=> 'Вибраний елемент не існує',
    'DONATION_DC_ENTER_NAME'	=> 'Введіть назву валюти',
));
