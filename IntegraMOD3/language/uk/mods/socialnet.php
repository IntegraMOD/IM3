<?php
/**
 * - [Ukrainian]
 *
 * @package phpBB Social Network
 * @version 1.0.0
 * @copyright (c) phpBB Social Network Team 2010-2012 http://phpbbsocialnetwork.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (!isset($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	/**
	 * Edit these two lines write your own Welcome text for unregistered guests on Activity page.
	 */
	'SN_AP_WELCOME_TITLE'					 => 'Ласкаво просимо на наш сайт!',
	'SN_AP_WELCOME_TEXT'					 => 'Зареєструйтеся, щоб користуватися всіма можливостями нашого сайту.<br /><br />З повагою,<br />Адміністрація',

	'SN_MODULE_IM_NAME'						 => 'Миттєві повідомлення',
	'SN_MODULE_USERSTATUS_NAME'				 => 'Статус користувача',
	'SN_MODULE_APPROVAL_NAME'				 => 'Система керування друзями',

	'SN_IM_CHAT'							 => 'Чат',
	'SN_IM_NO_ONLINE_USER'					 => 'Немає користувачів онлайн',
	'SN_IM_YOU_ARE_OFFLINE'					 => 'Ви офлайн',
	'SN_IM_SOUND'							 => 'Звук',
	'SN_IM_SELECT_NAME'						 => 'Оберіть звук',
	'SN_IM_NEW_MESSAGE'						 => 'Нове повідомлення',
	'SN_IM_LOGIN'							 => 'Онлайн',
	'SN_IM_LOGOUT'							 => 'Офлайн',
	'SN_IM_PRESS_TO_CLOSE'					 => 'Натисніть %1$s, щоб закрити вікно чату',
	'SN_IM_PRESS_TO_SEND'					 => 'Натисніть %1$s, щоб надіслати повідомлення',

	'SN_US_SHARE_STATUS'					 => 'Поділитися',
	'SN_US_WHATS_ON_YOUR_MIND'				 => 'Про що ви думаєте?',
	'SN_US_EMPTY_STATUS'					 => 'Ви не можете надіслати порожній статус',
	'SN_US_COMMENT'							 => 'Коментувати',
	'SN_US_EMPTY_COMMENT'					 => 'Ви не можете надіслати порожній коментар',
	'SN_US_USER_STATUS_WALL'				 => 'Активність',
	'SN_US_WRITE_COMMENT'					 => 'Написати коментар...',
	'SN_US_COMMENT_STATUS'					 => 'Коментувати',
	'SN_US_HAS_NO_STATUS'					 => 'не має статусу',
	'SN_US_HAS_DELETED_STATUS'				 => 'Цей статус видалено',
	'SN_STATUS_NOT_EXISTS'					 => 'Цей статус не існує',
	'SN_US_HAS_NO_ACTIVITY'					 => 'не має активності',
	'SN_US_SHARED_STATUS'					 => 'Ви поділилися статусом',
	'SN_US_DELETE_STATUS'					 => 'Видалити',
	'SN_US_LOAD_MORE'						 => 'Попередні публікації',
	'SN_US_VIEW'						 	 => 'Перегляд',
	'SN_US_LOAD_MORE_COMMENT'				 => 'ще коментар',
	'SN_US_LOAD_MORE_COMMENTS'				 => 'ще коментарі',
	'SN_US_CONFIRM'							 => 'Підтвердити',
	'SN_US_CLOSE'							 => 'Закрити',
	'SN_US_CANCEL'							 => 'Скасувати',
	'SN_US_SHARED_A'						 => 'поділився(-лася)',
	'SN_US_LINK'							 => 'посиланням',

	//
	// FETCH PAGE
	//
	'SN_US_FETCH_PAGE'						 => 'Отримати сторінку',
	'SN_US_FETCH_CLEAR'						 => 'Очистити завантажену сторінку',
	'SN_US_NO_VIDEO_THUMB'					 => 'Немає попереднього перегляду відео',
	'LOADER'								 => 'Завантажувач',
	'NEXT_IMAGE'							 => 'Наступне зображення',
	'PREVIOUS_IMAGE'						 => 'Попереднє зображення',
	'OF'									 => 'з',
	'SN_US_NO_IMG_THUMB'					 => 'Немає попереднього перегляду зображення',
	'SN_US_CHOOSE_THUMB'					 => 'зображення',
	'SN_CB_FETCH_ERROR'						 => 'Під час завантаження веб-сторінки сталася помилка',

	'SN_AP_ACTIVITYPAGE'					 => 'Моя мережа',
	'SN_AP_AND'								 => 'і',
	'SN_AP_ARE_FRIENDS'						 => 'тепер друзі',
	'SN_AP_ADD_AS_FRIEND'					 => 'Додати у друзі',
	'SN_AP_PRIVATE_MESSAGE'					 => 'Повідомлення',
	'SN_AP_MANAGE_PROFILE'					 => 'Редагувати мій профіль',
	'SN_AP_VIEW_FRIENDS'					 => 'Переглянути моїх друзів',
	'SN_AP_VIEW_SUGGESTIONS'				 => 'Можливі знайомі',
	'SN_AP_MANAGE_FRIENDS'					 => 'Керування друзями',
	'SN_AP_BOARD'							 => 'Форум',
	'SN_AP_VIEW_MEMBERLIST'					 => 'Список користувачів',
	'SN_AP_LOG_OUT'							 => 'Вийти',
	'SN_AP_LAST_POSTS'						 => 'Останні обговорення',
	'SN_AP_TOTAL_FRIEND'					 => 'У вас 1 друг',
	'SN_AP_TOTAL_FRIENDS'					 => 'У вас %s друзів',
	'SN_AP_FRIEND_SUGGESTIONS'				 => 'Можливі знайомі',
	'SN_AP_REQUESTS_LIST'					 => 'Запити',
	'SN_AP_ONLINE_FRIENDS'					 => 'Друзі онлайн',
	'SN_AP_NO_ONLINE_USER'					 => 'Немає користувачів онлайн',
	'SN_AP_NO_DISCUSSION'					 => 'Немає останніх обговорень',
	'SN_AP_NO_BIRTHDAY'					 	 => 'Найближчим часом немає днів народження',
	'SN_AP_NO_ENTRY'						 => 'Тут немає нічого нового',
	'SN_AP_LOAD_NEWS'						 => 'Оновити',
	'SN_AP_SEE_ALL'							 => 'Переглянути всі',
	'SN_AP_NO_FRIENDS'						 => 'У вас немає друзів',
	'SN_AP_KEEP_LOGGEDIN'					 => 'Запам\'ятати мене',
	'SN_AP_STATISTICS'						 => 'Статистика',
	'SN_AP_TOTAL_USERS'						 => '<strong>%d</strong> користувачів',
	'SN_AP_TOTAL_POSTS'						 => '<strong>%d</strong> повідомлень',
	'SN_AP_TOTAL_TOPICS'					 => '<strong>%d</strong> тем',
	'SN_AP_TOPICS_PER_DAY'					 => '<strong>%d</strong> тем на день',
	'SN_AP_POSTS_PER_DAY'					 => '<strong>%d</strong> повідомлень на день',
	'SN_AP_USERS_PER_DAY'					 => '<strong>%d</strong> користувачів на день',
	'SN_AP_BIRTHDAY'						 => 'День народження',
	'SN_AP_BIRTHDAY_1'						 => 'день народження <span class="sn-ap-textNoWrap">%1$s</span>',
	'SN_AP_BIRTHDAY_2'						 => 'день народження <span class="sn-ap-textNoWrap">%1$s</span>',
	'SN_AP_BIRTHDAY_USERNAME'				 => '%1$s',
	'SN_AP_WELCOME'							 => 'Ласкаво просимо',
	'SN_AP_VIEWING_ACTIVITYPAGE'			 => 'Перегляд сторінки активності',
	'SN_AP_NO_SUGGESTIONS'					 => 'Наразі для вас немає пропозицій дружби',
	'SN_AP_SEARCH'							 => 'Пошук…',
	'SN_AP_CHANGED_PROFILE_HIS'				 => 'оновив свій профіль',
	'SN_AP_CHANGED_PROFILE_HER'				 => 'оновила свій профіль',
	'SN_AP_CHANGED_PROFILE_THEIR'			 => 'оновили свій профіль',
	'SN_UP_CHANGED_AVATAR_HIS'				 => 'змінив аватар',
	'SN_UP_CHANGED_AVATAR_HER'				 => 'змінила аватар',
	'SN_UP_CHANGED_AVATAR_THEIR'			 => 'змінили аватар',
	'SN_AP_ADDED_NEW_FAMILY_MEMBER_HIS'		 => 'додав %1$s (%2$s) як нового члена родини до свого профілю',
	'SN_AP_ADDED_NEW_FAMILY_MEMBER_HER'		 => 'додала %1$s (%2$s) як нового члена родини до свого профілю',
	'SN_AP_ADDED_NEW_FAMILY_MEMBER_THEIR'	 => 'додали %1$s (%2$s) як нового члена родини до свого профілю',
	'SN_AP_CHANGED_RELATIONSHIP_HIS'		 => 'додав інформацію про стосунки до свого профілю',
	'SN_AP_CHANGED_RELATIONSHIP_HER'		 => 'додала інформацію про стосунки до свого профілю',
	'SN_AP_CHANGED_RELATIONSHIP_THEIR'		 => 'додали інформацію про стосунки до свого профілю',
	'SN_UP_SEND_EMOTE'						 => 'надіслав(-ла) емоцію',

	'SN_PROFILE'							 => 'Профіль',
	'SN_MYPROFILE'							 => 'Мій профіль',

	// User profile
	'SN_UP_PROFILE_UPDATED'					 => 'Ваш профіль успішно оновлено.',
	'SN_UP_HOMETOWN'						 => 'Рідне місто',
	'SN_UP_SEX'								 => 'Стать',
	'SN_UP_INTERESTED_IN'					 => 'Цікавлять',
	'SN_UP_PRIVACY_LEVEL'					 => 'Рівень приватності',
	'SN_UP_PRIVACY_PRIVATE'					 => 'Приватно (лише адміністратори)',
	'SN_UP_PRIVACY_FRIENDS'					 => 'Лише друзі',
	'SN_UP_PRIVACY_DEFAULT'					 => 'За замовчуванням (усі)',
	'SN_UP_ALLOW_FRIEND_REQUESTS'			 => 'Дозволити учасникам надсилати мені запити у друзі',
	'SN_UP_PRIVACY_LOCKED'					 => 'Адміністратор форуму не дозволяє учасникам змінювати їхню політику приватності.',
	'SN_UP_PRIVACY_DEFAULT_NOTICE'			 => 'Політика приватності форуму за замовчуванням: <strong>%s</strong>.',
	'SN_UP_LANGUAGES'						 => 'Мови',
	'SN_UP_ABOUT_ME'						 => 'Про мене',
	'SN_UP_EMPLOYER'						 => 'Роботодавець',
	'SN_UP_UNIVERSITY'						 => 'Університет',
	'SN_UP_HIGH_SCHOOL'						 => 'Школа',
	'SN_UP_OCCUPATION'						 => 'Рід занять',
	'SN_UP_RELIGION'						 => 'Релігійні погляди',
	'SN_UP_POLITICAL_VIEWS'					 => 'Політичні погляди',
	'SN_UP_QUOTATIONS'						 => 'Улюблені цитати',
	'SN_UP_INTERESTS'						 => 'Інтереси',
	'SN_UP_MUSIC'							 => 'Музика',
	'SN_UP_BOOKS'							 => 'Книги',
	'SN_UP_MOVIES'							 => 'Фільми',
	'SN_UP_GAMES'							 => 'Ігри',
	'SN_UP_FOODS'							 => 'Улюблена їжа',
	'SN_UP_SPORTS'							 => 'Види спорту',
	'SN_UP_SPORT_TEAMS'						 => 'Улюблені спортивні команди',
	'SN_UP_ACTIVITIES'						 => 'Захоплення',
	'SN_UP_SKYPE'							 => 'Skype',
	'SN_UP_FACEBOOK'						 => 'Facebook',
	'SN_UP_TWITTER'							 => 'Twitter',
	'SN_UP_YOUTUBE'							 => 'Youtube',
	'SN_UP_USER_ICQ'						 => 'Номер ICQ',
	'SN_UP_USER_AIM'						 => 'AOL Instant Messenger',
	'SN_UP_USER_MSNM'						 => 'WL/MSN Messenger',
	'SN_UP_USER_YIM'						 => 'Yahoo Messenger',
	'SN_UP_USER_JABBER'						 => 'Адреса Jabber',
	'SN_UP_USER_WEBSITE'					 => 'Веб-сайт',
	'SN_UP_USER_FROM'						 => 'Звідки',
	'SN_UP_USER_INTERESTS'					 => 'Інтереси',
	'SN_UP_BDAY_MONTH'						 => 'Місяць народження',
	'SN_UP_BDAY_DAY'						 => 'День народження',
	'SN_UP_BDAY_YEAR'						 => 'Рік народження',
	'SN_UP_USERNAME'						 => 'Ім\'я користувача',
	'SN_UP_USER_EMAIL'						 => 'E-mail',
	'SN_UP_USER_BIRTHDAY'					 => 'День народження',
	'SN_UP_USER_OCC'						 => 'Рід занять',
	'SN_UP_USER_SIG'						 => 'Підпис',
	'SN_UP_PROFILE_VIEWS'					 => 'Переглядів профілю',
	'SN_UP_X_TIMES'							 => 'раз(ів)',
	'SN_UP_PROFILE_VISITORS'				 => 'Відвідувачі профілю',
	'SN_UP_LAST_CHANGE'						 => 'Останнє оновлення профілю',
	'SN_UP_MALE'							 => 'Чоловіча',
	'SN_UP_MALES'							 => 'Чоловіки',
	'SN_UP_FEMALE'							 => 'Жіноча',
	'SN_UP_FEMALES'							 => 'Жінки',
	'SN_UP_BOTH'							 => 'Обидві',
	'SN_UP_RELATIONSHIP'					 => 'Сімейний стан',
	'SN_UP_SINGLE'							 => 'Неодружений / Незаміжня',
	'SN_UP_IN_RELATIONSHIP'					 => 'У стосунках',
	'SN_UP_ENGAGED'							 => 'Заручений(-а)',
	'SN_UP_MARRIED'							 => 'Одружений / Заміжня',
	'SN_UP_ITS_COMPLICATED'					 => 'Все складно',
	'SN_UP_OPEN_RELATIONSHIP'				 => 'У вільних стосунках',
	'SN_UP_WIDOWED'							 => 'Вдівець / Вдова',
	'SN_UP_SEPARATED'						 => 'Проживаємо окремо',
	'SN_UP_DIVORCED'						 => 'Розлучений(-а)',
	'SN_UP_TO'								 => 'з',
	'SN_UP_WITH'							 => 'з',
	'SN_UP_ANNIVERSARY'						 => 'Річниця',
	'SN_UP_ANNIVERSARY_ON'					 => 'Річниця',
	'SN_UP_BIRTHDAY'						 => 'Дата народження',
	'SN_UP_SUNDAY'							 => 'Неділя',
	'SN_UP_MONDAY'							 => 'Понеділок',
	'SN_UP_TUESDAY'							 => 'Вівторок',
	'SN_UP_WEDNESDAY'						 => 'Середа',
	'SN_UP_THURSDAY'						 => 'Четвер',
	'SN_UP_FRIDAY'							 => 'П\'ятниця',
	'SN_UP_SATURDAY'						 => 'Субота',
	'SN_UP_SUNDAY_MIN'						 => 'Нд',
	'SN_UP_MONDAY_MIN'						 => 'Пн',
	'SN_UP_TUESDAY_MIN'						 => 'Вт',
	'SN_UP_WEDNESDAY_MIN'					 => 'Ср',
	'SN_UP_THURSDAY_MIN'					 => 'Чт',
	'SN_UP_FRIDAY_MIN'						 => 'Пт',
	'SN_UP_SATURDAY_MIN'					 => 'Сб',
	'SN_UP_JANUARY_MIN'						 => 'Січ',
	'SN_UP_FEBRUARY_MIN'					 => 'Лют',
	'SN_UP_MARCH_MIN'						 => 'Бер',
	'SN_UP_APRIL_MIN'						 => 'Кві',
	'SN_UP_MAY_MIN'							 => 'Тра',
	'SN_UP_JUNE_MIN'						 => 'Чер',
	'SN_UP_JULY_MIN'						 => 'Лип',
	'SN_UP_AUGUST_MIN'						 => 'Сер',
	'SN_UP_SEPTEMBER_MIN'					 => 'Вер',
	'SN_UP_OCTOBER_MIN'						 => 'Жов',
	'SN_UP_NOVEMBER_MIN'					 => 'Лис',
	'SN_UP_DECEMBER_MIN'					 => 'Гру',
	'SN_UP_FAMILY'							 => 'Родина',
	'SN_UP_SELECT_RELATIONSHIP'				 => 'Додати стосунки',
	'SN_UP_SELECT_FAMILY_RELATION'			 => 'Додати члена родини',
	'SN_UP_SISTER'							 => 'Сестра',
	'SN_UP_BROTHER'							 => 'Брат',
	'SN_UP_DAUGHTER'						 => 'Донька',
	'SN_UP_SON'								 => 'Син',
	'SN_UP_MOTHER'							 => 'Мати',
	'SN_UP_FATHER'							 => 'Батько',
	'SN_UP_AUNT'							 => 'Тітка',
	'SN_UP_UNCLE'							 => 'Дядько',
	'SN_UP_NIECE'							 => 'Племінниця',
	'SN_UP_NEPHEW'							 => 'Племінник',
	'SN_UP_COUSIN_FEMALE'					 => 'Двоюрідна сестра',
	'SN_UP_COUSIN_MALE'						 => 'Двоюрідний брат',
	'SN_UP_GRANDDAUGHTER'					 => 'Онука',
	'SN_UP_GRANDSON'						 => 'Онук',
	'SN_UP_GRANDMOTHER'						 => 'Бабуся',
	'SN_UP_GRANDFATHER'						 => 'Дідусь',
	'SN_UP_SISTER_IN_LAW'					 => 'Невістка / Зовиця / Своячка',
	'SN_UP_BROTHER_IN_LAW'					 => 'Зять / Девер / Шурин',
	'SN_UP_MOTHER_IN_LAW'					 => 'Теща / Свекруха',
	'SN_UP_FATHER_IN_LAW'					 => 'Тесть / Свекор',
	'SN_UP_DAUGHTER_IN_LAW'					 => 'Невістка',
	'SN_UP_SON_IN_LAW'						 => 'Зять',
	'SN_UP_ADD_FAMILY_MEMBER'				 => 'Додати члена родини',
	'SN_UP_ADD_FAMILY_ERR_MEMBER_EMPTY'		 => 'Порожнє ім\'я члена родини',
	'SN_UP_APPROVE'							 => 'Підтвердити',
	'SN_UP_IGNORE'							 => 'Ігнорувати',
	'SN_UP_APPROVE_RELATION_SUBJECT'		 => '%1$s зазначив(-ла) стосунки з вами',
	'SN_UP_APPROVE_RELATION_TEXT'			 => '%2$s вказав(-ла) стосунки з вами: <strong>%3$s %2$s</strong>.<br /><br />%1$sВи можете підтвердити цей зв\'язок тут%4$s',
	'SN_UP_APPROVE_RELATION_CONFIRM'		 => 'Ви впевнені, що хочете підтвердити ці стосунки?',
	'SN_UP_REFUSE_RELATION_CONFIRM'			 => 'Ви впевнені, що хочете відхилити ці стосунки?',
	'SN_UP_APPROVE_RELATION_ERROR_CANCELED'	 => 'Ці стосунки було скасовано',
	'SN_UP_APPROVE_RELATION_ERROR_MYSELF'	 => 'Ви не можете створити стосунки з самим собою',
	'SN_UP_APPROVE_RELATION_ERROR_APPROVED'	 => 'Ці стосунки вже підтверджено',
	'SN_UP_APPROVE_RELATION_ERROR_REFUSED'	 => 'Ці стосунки вже відхилено',
	'SN_UP_APPROVE_RELATION_VICE_VERSA'		 => 'Я також хочу додати ці стосунки до свого профілю.',
	'SN_UP_DELETE_RELATIONSHIP_CONFIRM'		 => 'Ви впевнені, що хочете видалити ці стосунки?',
	'SN_UP_APPROVE_RELATION_NO_RELATIONSHIP' => 'Немає статусу стосунків',
	'SN_UP_APPROVE_FAMILY_SUBJECT'			 => '%1$s додає вас як %2$s',
	'SN_UP_APPROVE_FAMILY_TEXT'				 => '%2$s додає вас як: <strong>%3$s</strong>.<br /><br />%1$sВи можете підтвердити це тут%4$s',
	'SN_UP_APPROVE_FAMILY_CONFIRM'			 => 'Ви впевнені, що хочете підтвердити ці родинні зв\'язки?',
	'SN_UP_REFUSE_FAMILY_CONFIRM'			 => 'Ви впевнені, що хочете відхилити ці родинні зв\'язки?',
	'SN_UP_APPROVE_FAMILY_ERROR_CANCELED'	 => 'Цей родинний зв\'язок було скасовано',
	'SN_UP_APPROVE_FAMILY_ERROR_MYSELF'		 => 'Ви не можете додати себе як члена своєї родини',
	'SN_UP_APPROVE_FAMILY_ERROR_APPROVED'	 => 'Цей родинний зв\'язок вже підтверджено.',
	'SN_UP_APPROVE_FAMILY_ERROR_REFUSED'	 => 'Цей родинний зв\'язок вже відхилено.',
	'SN_UP_APPROVE_FAMILY_ERROR_EXIST'		 => '%1$s вже додано до вашої родини',
	'SN_UP_APPROVE_FAMILY_VICE_VERSA'		 => 'Я також хочу додати %1$s до членів моєї родини.',
	'SN_UP_APPROVE_FAMILY_USERNAME'			 => '%1$s є моїм / моєю',
	'SN_UP_APPROVE_NO_FAMILY_MEMBER'		 => 'Немає членів родини',
	'SN_UP_DELETE_FAMILY_CONFIRM'			 => 'Ви впевнені, що хочете видалити <strong>%1$s</strong> зі списку родини?',
	'SN_UP_USERNAME_NOT_EXIST'				 => 'Вказане ім\'я користувача не існує',
	'SN_UP_NOT_APPROVED'					 => 'ще не підтверджено',
	'SN_UP_RELATION_REFUSED'				 => 'відхилено',
	'SN_UP_RELATION_REQUESTS'				 => 'Запити',
	'SN_UP_APPROVE_REQUESTS'				 => 'Підтвердити стосунки',
	'WRONG_DATA_FACEBOOK'					 => 'Адреса Facebook має бути дійсним URL-посиланням, включаючи протокол http. Наприклад: http://www.facebook.com/<нікнейм>/',
	'WRONG_DATA_TWITTER'					 => 'Адреса Twitter має бути дійсним URL-посиланням, включаючи протокол http. Наприклад: http://twitter.com/<нікнейм>/',
	'WRONG_DATA_YOUTUBE'					 => 'Адреса Youtube має бути дійсним URL-посиланням, включаючи протокол http. Наприклад: http://www.youtube.com/user/<нікнейм>/',
	'WRONG_DATA_FAMILY_USER'				 => 'Один із вказаних членів родини не існує',
	'WRONG_DATA_RELATION_USER'				 => 'Вказаний для стосунків користувач не існує',
	'WRONG_DATA_ANNIVERSARY'				 => 'Річниця має бути дійсною датою у форматі дд-мм-рррр. Наприклад: 01-12-2011',
	'TOO_SHORT_FACEBOOK'					 => 'Введена адреса Facebook занадто коротка, мінімум 12 символів.',
	'TOO_SHORT_TWITTER'						 => 'Введена адреса Twitter занадто коротка, мінімум 12 символів.',
	'TOO_SHORT_YOUTUBE'						 => 'Введена адреса Youtube занадто коротка, мінімум 12 символів.',
	'TOO_SHORT_ANNIVERSARY'					 => 'Введена річниця занадто коротка, мінімум 8 символів.',
	'TOO_SHORT_SKYPE'						 => 'Введене ім\'я Skype занадто коротке, мінімум 6 символів.',
	'SN_UP_WALL'							 => 'Активність',
	'SN_UP_INFO'							 => 'Інформація',
	'SN_UP_FRIENDS'							 => 'Друзі',
	'SN_UP_STATS'							 => 'Статистика',
	'SN_UP_BASIC_INFO'						 => 'Основна інформація',
	'SN_UP_EDU_WORK'						 => 'Освіта та робота',
	'SN_UP_PHILOSOPHY'						 => 'Погляди',
	'SN_UP_ENT_ACT'							 => 'Розваги та захоплення',
	'SN_UP_CONTACT_INFO'					 => 'Контактні дані',
	'SN_UP_OTHER_INFO'						 => 'Інша інформація',
	'SN_UP_LAST_VISITORS'					 => 'Останні відвідувачі профілю',
	'SN_UP_PROFILE_VIEWED'					 => 'Профіль переглянуто',
	'SN_UP_ADD_FRIEND'						 => 'Додати в друзі',
	'SN_UP_ADD_FRIEND_TO_GROUP'				 => 'Додати до групи',
	'SN_UP_EDIT_PROFILE'					 => 'Редагувати профіль',
	'SN_UP_EDIT_FRIENDS'					 => 'Керування друзями',
	'SN_UP_EDIT_RELATIONS'					 => 'Керування стосунками',
	'SN_UP_REPORT_PROFILE'					 => 'Поскаржитися на користувача',
	'SN_UP_EMPTY_REPORT'					 => 'Ви повинні вказати причину скарги',
	'SN_UP_REPORT_SUCCESS'					 => 'Скаргу на користувача успішно надіслано',
	'SN_UP_CAN_LEAVE_BLANK'					 => 'Це поле можна залишити порожнім.',
	'SN_UP_MORE_INFO'						 => 'Додаткова інформація',
	'SN_UP_RETURN_TO_PROFILE'				 => '%1$sПовернутися до профілю%2$s',
	'SN_UP_TABS_SPINNER'					 => '<em>Завантаження&#8230;<\/em>',
	'SN_UP_EMOTES'							 => 'Надіслати емоцію',

	'SN_LIKED_POSTS'						 => 'Отримані вподобання',
	'SN_SEARCH_LIKED_POSTS'					 => 'Пошук дописів, які вподобав користувач',
	'SN_LIKES_SENT'         				 => 'Надіслані вподобання',
	'SN_SEARCH_LIKES_SENT'  				 => 'Пошук дописів, які ви вподобали',

	'SN_UP_PROFILE_VALUE_DELETED'			 => '<em>Видалено</em>',

	'SN_NTF_EMOTE_CB_TITLE'					 => 'Емоцію надіслано',
	'SN_NTF_EMOTE_CB_TEXT'					 => 'Емоцію %2$s %3$s успішно надіслано для %1$s',

	'SN_IN'									 => 'в',

	'AVATAR'								 => 'Аватар',

	'FOES'									 => 'Недруги',
	'MUTUAL'								 => 'Спільні друзі',
	'SUGGESTIONS'							 => 'Пропозиції',

	// This patterns are used for various date labels.
	// Each language should have convention how to display dates,
	// this is where you specify it for each user browsing the labels in
	// this language.
	'SN_DAY_MONTH_YEAR_PATTERN'				 => 'j F Y',
	'SN_DAY_MONTH_PATTERN'						 => 'j F',
	'SN_MONTH_YEAR_PATTERN'					 => 'F Y',
	'SN_YEAR_PATTERN'							 => 'Y',

	/**
	 * CONFIRM BOXES
	 */
	'SN_CB_DELETE_STATUS_TITLE'				 => 'Видалити статус',
	'SN_CB_DELETE_STATUS_TEXT'				 => 'Ви впевнені, що хочете видалити цей статус?',
	'SN_CB_DELETE_COMMENT_TITLE'			 => 'Видалити коментар',
	'SN_CB_DELETE_COMMENT_TEXT'				 => 'Ви впевнені, що хочете видалити цей коментар?',
	'SN_CB_DELETE_ACTIVITY_TITLE'			 => 'Видалити активність',
	'SN_CB_DELETE_ACTIVITY_TEXT'			 => 'Ви впевнені, що хочете видалити цю активність?',

	/**
	 * SOCIALNET TIME AGO
	 */
	'SN_TIME_AGO'							 => '%1$u %2$s тому',
	'SN_TIME_FROM_NOW'						 => 'через %1$u %2$s',
	'SN_TIME_PERIODS'						 => array(
		'SECOND'	 => 'секунда',
		'SECONDS'	 => 'секунд(и)',
		'MINUTE'	 => 'хвилина',
		'MINUTES'	 => 'хвилин(и)',
		'HOUR'		 => 'година',
		'HOURS'		 => 'годин(и)',
		'DAY'		 => 'день',
		'DAYS'		 => 'днів/дні',
		'WEEK'		 => 'тиждень',
		'WEEKS'		 => 'тижнів/тижні',
		'MONTH'		 => 'місяць',
		'MONTHS'	 => 'місяців/місяці',
		'YEAR'		 => 'рік',
		'YEARS'		 => 'років/роки',
		'DECADE'	 => 'десятиліття',
		'DECADES'	 => 'десятиліть',
	)
));

// UCP
$lang = array_merge($lang, array(
	// UCP
	'UCP_SOCIALNET'							 => 'Соціальна мережа',
	'UCP_SOCIALNET_SETTINGS'				 => 'Налаштування соціальної мережі',
	'UCP_SN_IM'								 => 'Налаштування миттєвих повідомлень',
	'UCP_SN_IM_SETTINGS'					 => 'Налаштування миттєвих повідомлень',
	'UCP_SN_IM_HISTORY'						 => 'Історія миттєвих повідомлень',
	'UCP_SN_APPROVAL_UFG'					 => 'Групи друзів',
	'UCP_SOCIALNET_IM_PURGE_MESSAGES'		 => 'Очистити історію повідомлень',
	'UCP_SOCIALNET_USERSTATUS'				 => 'Налаштування статусу користувача',
	'UCP_SN_PROFILE'						 => 'Редагувати особисту інформацію',
	'UCP_SN_PROFILE_RELATIONS'				 => 'Стосунки та родина',

	// Instant Messenger
	'IM_ONLINE'								 => 'Я онлайн',
	'IM_ONLINE_EXPLAIN'						 => 'Якщо так, друзі бачитимуть вас у списку онлайн і зможуть спілкуватися з вами.',
	'IM_ALLOW_SOUND'						 => 'Відтворювати звук під час отримання повідомлення',
	'IM_ALLOW_SOUND_EXPLAIN'				 => 'Ця опція вмикає/вимикає звук під час отримання нового повідомлення',

	'IM_HISTORY_PURGED_AT'					 => 'Історію повідомлень було очищено адміністратором %1$s',
	'IM_NO_HISTORY'							 => 'У вас немає повідомлень',
	//'IM_HISTORY_WITH'						 => 'Історія з',
	'IM_MSG_TOTAL'							 => '1 повідомлення',
	'IM_MSGS_TOTAL'							 => '%1$s повідомлень',
	'IM_CONVERSATION_TOTAL'					 => '1 бесіда',
	'IM_CONVERSATIONS_TOTAL'				 => '%1$s бесід',
	'IM_SOUND_SELECT_NAME'					 => 'Оберіть звук',
	'EXPORT_IM_HISTORY'						 => 'Експорт бесіди з %s',
	//'IM_HISTORY_SELECT_USER'				 => 'Оберіть користувача',
	'IM_GROUP_UNDECIDED'					 => 'Без категорії',

	// Friends approval
	'ADD_FRIEND'							 => 'Додати нового друга',
	'ACCEPT_FRIEND'							 => 'Прийняти запит на дружбу',

	'SN_APPROVAL_FRIENDS'					 => 'Підтвердження дружби',
	'SN_APPROVALS_FRIENDS_EXPLAIN'			 => 'Тут ви можете підтвердити запити користувачів, які хочуть стати вашими друзями.',

	'SN_APPROVE'							 => 'Прийняти',
	'SN_NO_APPROVE'							 => 'Відхилити',
	'SN_REFUSE'								 => 'Відмовити',

	'SN_APPROVAL_REQUESTS'					 => 'Ваші запити',
	'SN_APPROVAL_REQUESTS_EXPLAIN'			 => 'Тут ви можете скасувати надіслані вами запити.',

	'SN_VIEW_PROFILE'						 => 'Переглянути профіль',

	'SN_CANCEL_REQUEST'						 => 'Скасувати запит',

	'SN_REMOVE_FRIEND'						 => 'Видалити з друзів',
	'SN_REMOVE_FRIENDS'						 => 'Ваші друзі',
	'SN_REMOVE_FRIENDS_EXPLAIN'				 => 'Тут ви можете бачити всіх ваших друзів і видаляти їх зі списку',

	'SN_USING_AVATARS_1_EXPLAIN'			 => 'Клацніть на користувачах для вибору, потім підтвердіть дію',

	'FRIENDS_APPROVALS_SUCCESS'				 => ' додано до списку ваших друзів',
	'FRIENDS_APPROVALS_REQUEST_EXIST'		 => 'Ви вже надіслали запит до',
	'FRIENDS_APPROVALS_DENY'				 => 'Запит на дружбу скасовано',
	'FRIENDS_APPROVALS_REMOVE'				 => 'Користувача успішно видалено з друзів',
	'FRIENDS_APPROVALS_ADDED'				 => 'Запит на дружбу успішно надіслано',

	'SN_FAS_FRIEND_LIST'					 => 'Список друзів',
	'SN_FAS_COMMON_FRIEND_LIST'				 => 'Спільні друзі',
	'SN_FAS_REMOVE'							 => 'Друга видалено',

	'FAS_FRIEND_TOTAL'						 => 'Один друг',
	'FAS_FRIENDS_TOTAL'						 => '%1$s друзів',
	'FAS_FRIEND_NO_TOTAL'					 => 'Немає друзів',
	'FAS_FRIENDGROUP_TOTAL'					 => 'Один друг',
	'FAS_FRIENDGROUPS_TOTAL'				 => '%1$s друзів',
	'FAS_FRIENDGROUP_NO_TOTAL'				 => 'Немає друзів',
	'FAS_APPROVE_TOTAL'						 => 'Одне підтвердження',
	'FAS_APPROVES_TOTAL'					 => '%1$s підтверджень',
	'FAS_APPROVE_NO_TOTAL'					 => 'Немає підтверджень',
	'FAS_CANCEL_TOTAL'						 => 'Один запит',
	'FAS_CANCELS_TOTAL'						 => '%1$s запитів',
	'FAS_CANCEL_NO_TOTAL'					 => 'Немає запитів',
	'FAS_COMMON_TOTAL'						 => 'Один спільний друг',
	'FAS_COMMONS_TOTAL'						 => '%1$s спільних друзів',
	'FAS_COMMON_NO_TOTAL'					 => 'Немає спільних друзів',
	'FAS_MUTUAL_NO_TOTAL'					 => 'Немає спільних друзів',
	'FAS_MUTUAL_TOTAL'						 => 'Один спільний друг',
	'FAS_MUTUALS_TOTAL'						 => '%1$s спільних друзів',
	'FAS_SUGGESTION_NO_TOTAL'				 => 'Немає пропозицій',
	'FAS_SUGGESTION_TOTAL'					 => 'Одна пропозиція',
	'FAS_SUGGESTIONS_TOTAL'					 => '%1$s пропозицій',

	'SN_FAS_NOT_ADDED_FRIENDS_IN_APPROVAL'	 => 'Користувача вже додано',
	'SN_FAS_NOT_ADDED_FRIENDS_IN_FOES'		 => 'Користувач вже у списку недругів',
	'SN_FAS_NOT_ADDED_FRIENDS_IN_FRIENDS'	 => 'Користувач вже у вас у друзях',

	// Friends groups
	'UFG_CREATE'							 => 'Створити нову групу друзів',
	'UFG_NAME'								 => 'Назва групи друзів',
	'UFG_CREATE_EXPLAIN'					 => 'Тут ви можете створити групу друзів для розподілу ваших контактів.',
	'UFG_MANAGE'							 => 'Групи друзів',
	'UFG_DRAG_FRIENDS_INTO_UFG'				 => 'Перетягніть користувачів до групи друзів',
	'SN_CREATE_NEW_GROUP'					 => 'Створити нову групу',
	//'CONFIRM_CREATE_UFG'					 => 'Ви впевнені, що хочете створити групу друзів <strong>%1$s</strong>?',
	'CONFIRM_DELETE_UFG'					 => 'Ви впевнені, що хочете видалити групу друзів <strong>%1$s</strong>?',
	'FMS_DELETE_UFG'						 => 'Видалити групу друзів',
	'FMS_DELETE_UFG_TEXT'					 => 'Ви впевнені, що хочете видалити цю групу друзів?',

	'ADD_FRIEND_TO_GROUP'					 => 'Додати друга до групи друзів',
	'ERROR_GROUP_EMPTY_NAME'				 => 'Порожня назва групи',
	'ERROR_GROUP_ALREADY_EXISTS'			 => 'Ви вже створили цю групу',
));

// NTF MESSAGE TITLES FOR PMs
$lang = array_merge($lang, array(
	'SN_NTF_FRIENDSHIP_REQUEST_PM_TITLE'		=> '%1$s надіслав(-ла) вам запит на дружбу',
	'SN_NTF_FRIENDSHIP_CANCEL_PM_TITLE'			=> '%1$s скасував(-ла) свій запит на дружбу',
	'SN_NTF_FRIENDSHIP_DENY_PM_TITLE'				=> '%1$s відхилив(-ла) ваш запит на дружбу',
	'SN_NTF_FRIENDSHIP_ACCEPT_PM_TITLE'			=> '%1$s прийняв(-ла) ваш запит на дружбу',

	'SN_NTF_STATUS_FRIEND_WALL_PM_TITLE'	 	=> '%1$s залишив(-ла) повідомлення у вашому профілі',
	'SN_NTF_STATUS_USER_COMMENT_PM_TITLE'	 	=> '%1$s прокоментував(-ла) статус користувача %2$s',
	'SN_NTF_STATUS_AUTHOR_COMMENT_PM_TITLE'	=> '%1$s прокоментував(-ла) ваш статус',

	'SN_NTF_APPROVE_FAMILY_PM_TITLE'				=> '%1$s додає вас як %2$s',
	'SN_NTF_APPROVE_RELATIONSHIP_PM_TITLE'	=> '%1$s зазначив(-ла) стосунки з вами',

	'SN_NTF_EMOTE_PM_TITLE'					 				=> '%1$s надіслав(-ла) вам емоцію',

	'SN_NTF_RELATIONSHIP_APPROVED_PM_TITLE'	=> '%1$s підтвердив(-ла) стосунки з вами',
	'SN_NTF_FAMILY_APPROVED_PM_TITLE'		 		=> '%1$s підтвердив(-ла) родинні зв\'язки з вами',

	'SN_NTF_RELATIONSHIP_REFUSED_PM_TITLE'	=> '%1$s відхилив(-ла) стосунки з вами',
	'SN_NTF_FAMILY_REFUSED_PM_TITLE'				=> '%1$s відхилив(-ла) родинні зв\'язки з вами',

	'SN_NTF_STATUS_FRIEND_MENTION_PM_TITLE' => '%1$s згадав(-ла) вас у своєму статусі',
));

// MCP
$lang = array_merge($lang, array(
	'MCP_SOCIALNET'					 => 'Соціальна мережа',
	'MCP_SN_REPORTUSER'				 => 'Користувачі зі скаргами',

	'POSTS_IN_QUEUE'				 => 'Повідомлення на модерації',

	'SN_UP_REPORTED_USER'			 => 'Користувач зі скаргою',
	'SN_UP_REPORT_TEXT'				 => 'Деталі',
	'SN_UP_REASON'					 => 'Причина',
	'SN_UP_VIEW_REPORTS'			 => 'Переглянути скарги',
	'SN_UP_CLOSE_REPORT_CONFIRM'	 => 'Ви впевнені, що хочете закрити цю скаргу?',
	'SN_UP_CLOSE_REPORTS_CONFIRM'	 => 'Ви впевнені, що хочете закрити ці скарги?',
	'SN_UP_CLOSE_REPORT_SUCCESS'	 => 'Скаргу успішно закрито.',
	'SN_UP_CLOSE_REPORTS_SUCCESS'	 => 'Скарги успішно закрито.',
	'SN_UP_DELETE_REPORT_CONFIRM'	 => 'Ви впевнені, що хочете видалити цю скаргу?',
	'SN_UP_DELETE_REPORTS_CONFIRM'	 => 'Ви впевнені, що хочете видалити ці скарги?',
	'SN_UP_DELETE_REPORT_SUCCESS'	 => 'Скаргу успішно видалено.',
	'SN_UP_DELETE_REPORTS_SUCCESS'	 => 'Скарги успішно видалено.',
));

// NOTIFY
$lang = array_merge($lang, array(
	'SN_AP_NOTIFY'					 => 'Сповіщення',
	'SN_NO_NOTIFY'					 => 'У вас немає сповіщень',
	'SN_NTF_FRIENDSHIP_ACCEPT'		 => '%1$s прийняв(-ла) ваш <a href="%2$s">запит на дружбу</a>',
	'SN_NTF_FRIENDSHIP_DENY'		 => '%1$s відхилив(-ла) ваш <a href="%2$s">запит на дружбу</a>',
	'SN_NTF_FRIENDSHIP_REQUEST'		 => '%1$s надіслав(-ла) вам <a href="%2$s">запит на дружбу</a>',
	'SN_NTF_FRIENDSHIP_CANCEL'		 => '%1$s скасував(-ла) свій <a href="%2$s">запит на дружбу</a>',

	'SN_NTF_STATUS_AUTHOR_COMMENT'	 => '%1$s прокоментував(-ла) <a href="%2$s">ваш статус</a>',
	'SN_NTF_STATUS_USER_COMMENT'		 => '%1$s прокоментував(-ла) статус користувача <a href="%3$s">%2$s</a>',
	'SN_NTF_STATUS_FRIEND_WALL'		 	=> '%1$s залишив(-ла) повідомлення у <a href="%2$s">вашому профілі</a>',

	'SN_NTF_APPROVE_FAMILY'			 => '%1$s додає вас як %2$s. Ви можете <a href="%3$s">підтвердити цей зв\'язок тут</a>',
	'SN_NTF_APPROVE_RELATIONSHIP'	 => '%1$s зазначив(-ла) стосунки з вами. Ви можете <a href="%2$s">підтвердити їх тут</a>',

	'SN_NTF_EMOTE'					 => '%1$s надіслав(-ла) вам емоцію: %2$s %3$s',

	'SN_NTF_RELATIONSHIP_APPROVED'	 => '%1$s підтвердив(-ла) <a href="%2$s">стосунки</a> з вами',
	'SN_NTF_FAMILY_APPROVED'		 => '%1$s підтвердив(-ла) <a href="%2$s">родинні зв\'язки</a> з вами',

	'SN_NTF_RELATIONSHIP_VICEVERSA'	 => '%1$s підтвердив(-ла) <a href="%2$s">стосунки</a> з вами та додав(-ла) їх до свого профілю',
	'SN_NTF_FAMILY_VICEVERSA'		 => '%1$s підтвердив(-ла) <a href="%2$s">родинні зв\'язки</a> з вами та додав(-ла) їх до свого профілю',

	'SN_NTF_RELATIONSHIP_REFUSED'	 => '%1$s відхилив(-ла) <a href="%2$s">стосунки</a> з вами',
	'SN_NTF_FAMILY_REFUSED'			 => '%1$s відхилив(-ла) <a href="%2$s">родинні зв\'язки</a> з вами',

	'SN_NTF_STATUS_FRIEND_MENTION' => '%1$s згадав(-ла) вас у <a href="%2$s">своєму статусі</a>',
));

// EMOTES
$lang = array_merge($lang, array(
	'SN_UP_EMOTES_USER'	 => 'Емоції',
));

// EXPANDER
$lang = array_merge($lang, array(
	'SN_EXPANDER_READ_MORE'	 => 'Показати більше',
	'SN_EXPANDER_READ_LESS'	 => 'Згорнути',
));

// OUTDATED BROWSER
$lang = array_merge($lang, array(
	'BROWSER_OUTDATED_TITLE'	 => 'Ваш браузер застарів',
	'BROWSER_OUTDATED'	 => 'Деякі функції не працюватимуть у вашому браузері. Ми наполегливо рекомендуємо оновити його.',

	// Missing variables
	'SN_UP_USER_FB'		=> 'Facebook',
	'SN_UP_USER_IG'		=> 'Instagram',
	'SN_UP_USER_PT'		=> 'Pinterest',
	'SN_UP_USER_TWR'	=> 'Twitter',
	'SN_UP_USER_SKP'	=> 'Skype',
	'SN_UP_USER_TG'		=> 'Telegram',
	'SN_UP_USER_LI'		=> 'LinkedIn',
	'SN_UP_USER_TT'		=> 'TikTok',
	'SN_UP_USER_DC'		=> 'Discord',
));

