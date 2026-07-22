<?php
/**
*
* donate.php [Ukrainian]
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

$lang = array_merge($lang, array(
    // Notice
    'DONATION_DISABLED'				=> 'Вибачте, сторінка пожертв наразі недоступна.',
    'DONATION_NOT_INSTALLED'		=> 'Записи бази даних Paypal Donation MOD відсутні.<br />Будь ласка, запустіть %sінсталятор%s щоб внести зміни до бази даних для MOD.',
    'DONATION_INSTALL_MISSING'		=> 'Файл встановлення, здається, відсутній. Будь ласка, перевірте ваше встановлення !',
    'DONATION_ADDRESS_MISSING'		=> 'Вибачте, Paypal Donation увімкнено, але деякі налаштування відсутні. Будь ласка, повідомте засновника форуму.',
    'SANDBOX_ADDRESS_MISSING'		=> 'Вибачте, Paypal Sandbox увімкнено, але деякі налаштування відсутні. Будь ласка, повідомте засновника форуму.',

    // Image alternative text
    'IMG_DONATE'		=> 'пожертвувати',
    'IMG_LOADER'		=> 'завантаження',

    // Default Currency
    'CURRENCY_DEFAULT'		=> 'USD', // Note : If you remove from ACP ALL currencies, this value will be defined as the default currency.

    // Stats
    //----------------------------->	%1$d = donation raised; %2$s = currency
    'DONATE_RECEIVED'			=> 'Ми отримали <strong>%1$d</strong> %2$s у вигляді пожертв.',
    'DONATE_NOT_RECEIVED'		=> 'Ми ще не отримали жодних пожертв.',

    //----------------------------->	%1$d = donation goal; %2$s = currency
    'DONATE_GOAL_RAISE'			=> 'Наша мета зібрати <strong>%1$d</strong> %2$s.',
    'DONATE_GOAL_REACHED'		=> 'Нашу мету пожертв було досягнуто.',
    'DONATE_NO_GOAL'			=> 'Ми не визначили мету пожертв.',

    //----------------------------->	%1$d = donation used; %2$s = currency; %3$d = donation raised;
    'DONATE_USED'				=> 'Ми використали <strong>%1$d</strong> %2$s ваших пожертв із <strong>%3$d</strong> %2$s вже отриманих.',
    'DONATE_USED_EXCEEDED'		=> 'Ми використали <strong>%1$d</strong> %2$s. Всі ваші пожертви були використані.',
    'DONATE_NOT_USED'			=> 'Ми ще не використали жодних пожертв.',

    // Pages
    'DONATION_TITLE'			=> 'Зробити Пожертву',
    'DONATION_TITLE_HEAD'		=> 'Зробити Пожертву Для',
    'DONATION_CANCEL_TITLE'		=> 'Пожертву Скасовано',
    'DONATION_SUCCESS_TITLE'	=> 'Пожертва Успішна',
    'DONATION_CONTACT_PAYPAL'	=> 'Підключення до Paypal - Будь Ласка, Зачекайте…',
    'SANDBOX_TITLE'				=> 'Тестувати Paypal Donation з Paypal Sandbox',

    'DONATION_INDEX'			=> 'Пожертви',
));

/*
* UMIL
*/
$lang = array_merge($lang, array(
    'INSTALL_DONATION_MOD'				=> 'Встановити Donation Mod',
    'INSTALL_DONATION_MOD_CONFIRM'		=> 'Ви готові встановити Donation Mod?',
    'INSTALL_DONATION_MOD_WELCOME'		=> 'Основні зміни з версії 1.0.3',
    'INSTALL_DONATION_MOD_WELCOME_NOTE'	=> 'Мовні ключі, що використовуються \"Donation pages\", були перенесені в базу даних.
                                            <br />Якщо ви використовуєте цю функцію, зробіть резервну копію ваших мовних файлів перед оновленням MOD до цього нового випуску.
                                            <br /><br />Додано новий дозвіл.
                                            <br />Не забудьте налаштувати цей новий дозвіл у <strong>ACP >> Дозволи >> Глобальні дозволи >> Дозволи користувачів</strong>
                                            <br />Щоб дозволити гостям робити пожертву, позначте прапорець "Вибрати анонімного користувача"',

    'DONATION_MOD'						=> 'Donation Mod',
    'DONATION_MOD_EXPLAIN'				=> 'Встановити зміни бази даних Donation Mod за допомогою автоматичного методу UMIL.',

    'UNINSTALL_DONATION_MOD'			=> 'Видалити Donation Mod',
    'UNINSTALL_DONATION_MOD_CONFIRM'	=> 'Ви готові видалити Donation Mod? Усі налаштування та дані, збережені цим модом, будуть видалені!',

    'UPDATE_DONATION_MOD'				=> 'Оновити Donation Mod',
    'UPDATE_DONATION_MOD_CONFIRM'		=> 'Ви готові оновити Donation Mod?',

    'UNUSED_LANG_FILES_TRUE'			=> 'Видалення невикористовуваних мовних файлів.',
    'UNUSED_LANG_FILES_FALSE'			=> 'Видалення невикористовуваних файлів не потрібне.',
));
