<?php
/**
 * @package   	OneAll Social Login Mod
 * @copyright 	Copyright 2011-Present http://www.oneall.com - All rights reserved.
 * @license   	GNU/GPL 2 or later
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307,USA.
 *
 * The "GNU General Public License" (GPL) is available at
 * http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 */
if (!defined ('IN_PHPBB'))
{
	exit;
}

if (!isset ($lang) || !is_array ($lang))
{
	$lang = array ();
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
// in a URL you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
$lang = array_merge ($lang,
	array (
		'OASL_DO_AVATARS' => 'Увімкнути завантаження аватарів із соціальної мережі?',
		'OASL_DO_AVATARS_DESC' => 'Дозволяє отримувати аватар із профілю користувача в соціальній мережі та зберігати його в теці аватарів phpBB.',
		'OASL_DO_AVATARS_ENABLE_YES' => 'Так, використовувати аватари із соціальних мереж',
		'OASL_DO_AVATARS_ENABLE_NO' => 'Ні, не використовувати аватари із соціальних мереж',
		'OASL_PROFILE_TITLE' => 'Social Login',
		'OASL_PROFILE_DESC' => 'Прив’яжіть свій обліковий запис до соціальної мережі',
		'OASL_WIDGET_TITLE' => 'Увійти за допомогою соціальної мережі:',
		'OASL_SETTNGS_UPDATED' => 'Налаштування успішно оновлено.',
		'OASL_INTRO' => 'Дозвольте відвідувачам входити та реєструватися за допомогою соціальних мереж, таких як Twitter, Facebook, LinkedIn, Hyves, VKontakte, Google та Yahoo, серед інших. Social Login <strong>підвищує рівень реєстрації користувачів</strong>, спрощуючи процес реєстрації, і надає засновані на дозволах соціальні <strong>дані, отримані з профілів соціальних мереж</strong>. Social Login інтегрується з наявною системою реєстрації, тож вам і вашим користувачам не доведеться починати з нуля.',
		'OASL_TITLE' => 'OneAll Social Login',
		'OASL_TITLE_HELP' => 'Довідка, оновлення &amp; документація',
		'OASL_FOLLOW_US_TWITTER' => '<a href="http://www.twitter.com/oneall" class="external">Стежте за нами</a> у Twitter, щоб бути в курсі оновлень;',
		'OASL_READ_DOCS' => '<a href="http://docs.oneall.com/plugins/" class="external">Прочитайте</a> онлайн-документацію для отримання додаткової інформації про цей плагін;',
		'OASL_DISCOVER_PLUGINS' => '<a href="http://docs.oneall.com/plugins/" class="external">Відкрийте для себе</a> наші готові плагіни для Drupal, Joomla, WordPress;',
		'OASL_GET_HELP' => '<a href="http://www.oneall.com/company/contact-us/" class="external">Зв’яжіться з нами</a>, якщо у вас є відгуки або потрібна допомога!',
		'OASL_CREATE_ACCOUNT_FIRST' => 'Щоб користуватися Social Login, спершу потрібно створити безкоштовний обліковий запис на <a href="https://app.oneall.com/signup/" class="external">http://www.oneall.com</a> та налаштувати сайт.',
		'OASL_SETUP_FREE_ACCOUNT' => '<a href="https://app.oneall.com/signup/" class="button1 external">Налаштувати мій безкоштовний обліковий запис</a>',
		'OASL_VIEW_CREDENTIALS' => '<a href="https://app.oneall.com/applications/" class="button1 external">Створити та переглянути мої облікові дані API</a>',
		'OASL_API_CONNECTION' => 'З’єднання API',
		'OASL_API_CONNECTION_HANDLER' => 'Обробник з’єднання API:',
		'OASL_CURL' => 'PHP CURL',
		'OASL_CURL_DESC' => 'Використання CURL рекомендовано, але на деяких серверах воно може бути вимкнене.',
		'OASL_CURL_DOCS' => '<a href="http://www.php.net/manual/en/book.curl.php" class="external">Посібник CURL</a>',
		'OASL_FSOCKOPEN' => 'PHP FSOCKOPEN',
		'OASL_FSOCKOPEN_DESC' => 'Використовуйте FSOCKOPEN лише в разі проблем із CURL.',
		'OASL_FSOCKOPEN_DOCS' => '<a href="http://www.php.net/manual/en/function.fsockopen.php" class="external">Посібник FSOCKOPEN</a>',
		'OASL_API_PORT' => 'Порт з’єднання API:',
		'OASL_PORT_443' => 'Зв’язок через HTTPS на порту 443',
		'OASL_PORT_443_DESC' => 'Використання порту 443 рекомендовано, але вам, можливо, доведеться встановити OpenSSL на сервері.',
		'OASL_PORT_80' => 'Зв’язок через HTTP на порту 80',
		'OASL_PORT_80_DESC' => 'Використання порту 80 трохи швидше, не потребує OpenSSL, але менш безпечне.',
		'OASL_API_AUTODETECT' => 'Автоматично визначити з’єднання API',
		'OASL_API_CREDENTIALS_TITLE' => 'Облікові дані API - <a href="https://app.oneall.com/applications/" class="external">Натисніть тут, щоб створити або переглянути ваші облікові дані API</a>',
		'OASL_API_SUBDOMAIN' => 'Піддомен API:',
		'OASL_API_PUBLIC_KEY' => 'Публічний ключ API:',
		'OASL_API_PRIVATE_KEY' => 'Приватний ключ API:',
		'OASL_API_VERIFY' => 'Перевірити налаштування API',
		'OASL_ENABLE_NETWORKS' => 'Увімкніть соціальні мережі/постачальників ідентифікації на ваш вибір',
		'OASL_DO_ENABLE' => 'Увімкнути Social Login?',
		'OASL_DO_ENABLE_DESC' => 'Дозволяє тимчасово вимкнути Social Login, не видаляючи його.',
		'OASL_DO_ENABLE_YES' => 'Увімкнути Social Login',
		'OASL_DO_ENABLE_NO' => 'Вимкнути Social Login',
		'OASL_DEFAULT' => 'За замовчуванням',
		'OASL_DO_LINKING' => 'Увімкнути прив’язку облікових записів соціальних мереж?',
		'OASL_DO_LINKING_ASK' => 'Автоматично прив’язувати облікові записи соціальних мереж до наявних облікових записів користувачів?',
		'OASL_DO_LINKING_DESC' => 'Якщо увімкнено, облікові записи соціальних мереж із підтвердженою адресою електронної пошти прив’язуватимуться до наявних облікових записів phpBB із такою ж адресою.',
		'OASL_DO_LINKING_YES' => 'Увімкнути прив’язку облікових записів',
		'OASL_DO_LINKING_NO' => 'Вимкнути прив’язку облікових записів',
		'OASL_DO_REDIRECT' => 'Налаштувати перенаправлення',
		'OASL_DO_REDIRECT_ASK' => 'Перенаправляти користувачів на цю сторінку після того, як вони підключилися зі своїм обліковим записом соціальної мережі:',
		'OASL_DO_REDIRECT_DESC' => 'Введіть повну URL-адресу сторінки вашого phpBB. Якщо залишити порожнім, користувач залишається на тій самій сторінці.',
		'OASL_API_DETECT_CURL' => 'Виявлено CURL на порту %s - не забудьте зберегти зміни!',
		'OASL_API_DETECT_FSOCKOPEN' => 'Виявлено FSOCKOPEN на порту %s - не забудьте зберегти зміни!',
		'OASL_API_DETECT_NONE' => 'Не вдалося встановити з’єднання! Ваш брандмауер має дозволяти вихідні запити на порту 80 або 443.',
		'OASL_API_CREDENTIALS_FILL_OUT' => 'Будь ласка, заповніть кожне з наведених вище полів.',
		'OASL_API_CREDENTIALS_USE_AUTO' => 'Обробник з’єднання, схоже, не працює. Будь ласка, скористайтеся автовизначенням.',
		'OASL_API_CREDENTIALS_SUBDOMAIN_WRONG' => 'Піддомен не існує. Чи правильно ви його заповнили?',
		'OASL_API_CREDENTIALS_KEYS_WRONG' => 'Облікові дані API неправильні, будь ласка, перевірте ваш публічний/приватний ключ.',
		'OASL_API_CREDENTIALS_CHECK_COM' => 'Не вдалося зв’язатися з API. Чи правильно налаштовано з’єднання API?',
		'OASL_API_CREDENTIALS_UNKNOW_ERROR' => 'Невідома відповідь - будь ласка, переконайтеся, що ви увійшли в систему!',
		'OASL_API_CREDENTIALS_OK' => 'Налаштування правильні - не забудьте зберегти зміни!',
		'OASL_SETTINGS' => 'Налаштування OneAll Social Login',
		'OASL_ENABLE_SOCIAL_NETWORK' => 'Ви маєте увімкнути хоча б одну соціальну мережу',
		'OASL_ENTER_CREDENTIALS' => 'Ви маєте налаштувати ваші облікові дані API',
		'OASL_ACCOUNT_ALREADY_LINKED' => 'Цей обліковий запис соціальної мережі вже прив’язано до іншого користувача форуму.',
		'OASL_ACCOUNT_INACTIVE_OTHER' => 'Обліковий запис створено. Проте налаштування форуму вимагають активації облікового запису.<br />Ключ активації надіслано на вашу адресу електронної пошти.',
		'OASL_ACCOUNT_INACTIVE_ADMIN' => 'Обліковий запис створено. Проте налаштування форуму вимагають активації облікового запису адміністратором.<br />Адміністраторам надіслано електронний лист, і вас буде повідомлено електронною поштою, щойно ваш обліковий запис буде активовано.'
	));
