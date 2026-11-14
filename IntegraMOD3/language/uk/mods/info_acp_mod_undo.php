<?php
/**
*
* Moderator action undo [Українська]
*
* @package language
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'ACP_MOD_UNDO'						=> 'Скасування дій модераторів',
	'ACP_MOD_UNDO_LIST'					=> 'Дії модераторів',
	'ACP_MOD_UNDO_LIST_EXPLAIN'			=> 'Дії модераторів: видалення, редагування, переміщення, розділення, об’єднання, блокування, зміна автора, бани та попередження. Відновлення повертає вміст до стану перед дією. Кілька дій скасовуються від найновішої до найстарішої.',
	'ACP_MOD_UNDO_SETTINGS'				=> 'Налаштування скасування дій',
	'ACP_MOD_UNDO_SETTINGS_EXPLAIN'		=> 'Зберігає записи про дії модераторів, щоб адміністратор міг їх скасувати.',

	'MOD_UNDO_ENABLE'					=> 'Записувати дії модераторів',
	'MOD_UNDO_ENABLE_EXPLAIN'			=> 'Видалення, редагування чужих повідомлень, переміщення, розділення, об’єднання, блокування, зміна автора, бани та попередження записуються, щоб їх можна було скасувати.',
	'MOD_UNDO_ADMINS'					=> 'Записувати також адміністраторів',
	'MOD_UNDO_ADMINS_EXPLAIN'			=> 'Записувати також дії користувачів з будь-якими правами адміністратора. Захищає від викраденого облікового запису адміністратора.',
	'MOD_UNDO_DAYS'						=> 'Зберігати записи протягом',
	'MOD_UNDO_DAYS_EXPLAIN'				=> 'Старіші записи видаляються разом зі збереженими вкладеннями. 0 — зберігати назавжди.',

	'MOD_UNDO_ACTION_DELETE_POST'		=> 'Видалено повідомлення',
	'MOD_UNDO_ACTION_DELETE_TOPIC'		=> 'Видалено теми',
	'MOD_UNDO_ACTION_EDIT'				=> 'Відредаговано повідомлення',
	'MOD_UNDO_ACTION_LOCK'				=> 'Закрито теми',
	'MOD_UNDO_ACTION_UNLOCK'			=> 'Відкрито теми',
	'MOD_UNDO_ACTION_LOCK_POST'			=> 'Заблоковано повідомлення',
	'MOD_UNDO_ACTION_UNLOCK_POST'		=> 'Розблоковано повідомлення',
	'MOD_UNDO_ACTION_MOVE'				=> 'Переміщено теми',
	'MOD_UNDO_ACTION_SPLIT'				=> 'Розділено тему',
	'MOD_UNDO_ACTION_MERGE'				=> 'Об’єднано повідомлення/теми',
	'MOD_UNDO_ACTION_CHANGE_POSTER'		=> 'Змінено автора',
	'MOD_UNDO_ACTION_BAN'				=> 'Бан',
	'MOD_UNDO_ACTION_UNBAN'				=> 'Зняття бану',
	'MOD_UNDO_ACTION_WARNING'			=> 'Попередження',

	'MOD_UNDO_MODERATOR'				=> 'Модератор',
	'MOD_UNDO_SUMMARY'					=> 'Вміст',
	'MOD_UNDO_STATUS'					=> 'Стан',
	'MOD_UNDO_PENDING'					=> 'Можна відновити',
	'MOD_UNDO_RESTORED_ON'				=> 'Відновлено',
	'MOD_UNDO_ALL'						=> 'Усі',
	'MOD_UNDO_FILTER_USER'				=> 'Ім’я модератора',
	'MOD_UNDO_VIEW'						=> 'Переглянути',
	'MOD_UNDO_DISABLED'					=> 'Запис наразі вимкнено. Наявні записи все ще можна відновити.',
	'MOD_UNDO_NO_ENTRIES'				=> 'Немає записаних дій модераторів.',

	'MOD_UNDO_RESTORE_MARKED'			=> 'Відновити позначені',
	'MOD_UNDO_REVERT_USER'				=> 'Скасувати всі дії модератора',
	'MOD_UNDO_REVERT_USER_EXPLAIN'		=> 'Відновлює всі незавершені дії цього модератора за вибрану кількість днів, починаючи з найновішої. Використовуйте, якщо обліковий запис було викрадено.',
	'MOD_UNDO_REVERT_DAYS'				=> 'Днів тому',
	'MOD_UNDO_REVERT'					=> 'Скасувати',

	'MOD_UNDO_RESTORED'					=> 'Відновлено дій: %d.',
	'MOD_UNDO_ERRORS'					=> 'Ці дії не вдалося відновити:',
	'MOD_UNDO_NOTHING_MARKED'			=> 'Жодної дії не позначено.',
	'MOD_UNDO_NOTHING_FOUND'			=> 'Для цього модератора за цей період не знайдено незавершених дій.',
	'MOD_UNDO_NO_USER'					=> 'Введіть наявне ім’я користувача та кількість днів.',
	'MOD_UNDO_NOT_FOUND'				=> 'Запис більше не існує.',
	'MOD_UNDO_ALREADY'					=> 'Цю дію вже відновлено.',
	'MOD_UNDO_BAD_DATA'					=> 'Збережені дані неможливо прочитати.',
	'MOD_UNDO_FORUM_GONE'				=> 'Форум, до якого належав цей вміст, більше не існує.',
	'MOD_UNDO_TOPIC_GONE'				=> 'Тема, до якої належав цей вміст, більше не існує і не входила до цього запису.',
	'MOD_UNDO_POST_GONE'				=> 'Повідомлення більше не існує.',
	'MOD_UNDO_STATE_CHANGED'			=> 'Вміст було змінено після цієї дії; спочатку скасуйте новішу дію.',

	'LOG_MOD_UNDO_RESTORE'				=> '<strong>Відновлено дію модератора</strong><br />» %1$s: %2$s',
));
