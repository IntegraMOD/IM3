<?php
/**
*
* Moderator action undo [Nederlands — Informeel]
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
	'ACP_MOD_UNDO'						=> 'Moderatoracties ongedaan maken',
	'ACP_MOD_UNDO_LIST'					=> 'Moderatoracties',
	'ACP_MOD_UNDO_LIST_EXPLAIN'			=> 'Acties van moderators: verwijderingen, bewerkingen, verplaatsingen, splitsingen, samenvoegingen, sloten, auteurswijzigingen, verbanningen en waarschuwingen. Herstellen zet de inhoud terug naar de toestand vóór de actie. Meerdere acties worden van nieuw naar oud ongedaan gemaakt.',
	'ACP_MOD_UNDO_SETTINGS'				=> 'Instellingen ongedaan maken',
	'ACP_MOD_UNDO_SETTINGS_EXPLAIN'		=> 'Houdt moderatoracties bij zodat een beheerder ze ongedaan kan maken.',

	'MOD_UNDO_ENABLE'					=> 'Moderatoracties vastleggen',
	'MOD_UNDO_ENABLE_EXPLAIN'			=> 'Verwijderingen, bewerkingen van berichten van anderen, verplaatsingen, splitsingen, samenvoegingen, sloten, auteurswijzigingen, verbanningen en waarschuwingen worden vastgelegd zodat ze ongedaan gemaakt kunnen worden.',
	'MOD_UNDO_ADMINS'					=> 'Ook beheerders vastleggen',
	'MOD_UNDO_ADMINS_EXPLAIN'			=> 'Legt ook acties vast van gebruikers met beheerderspermissies. Beschermt tegen een gekaapt beheerdersaccount.',
	'MOD_UNDO_DAYS'						=> 'Registraties bewaren voor',
	'MOD_UNDO_DAYS_EXPLAIN'				=> 'Oudere registraties worden verwijderd, samen met hun bewaarde bijlagen. 0 bewaart ze voor altijd.',

	'MOD_UNDO_ACTION_DELETE_POST'		=> 'Bericht(en) verwijderd',
	'MOD_UNDO_ACTION_DELETE_TOPIC'		=> 'Onderwerp(en) verwijderd',
	'MOD_UNDO_ACTION_EDIT'				=> 'Bericht bewerkt',
	'MOD_UNDO_ACTION_LOCK'				=> 'Onderwerp(en) gesloten',
	'MOD_UNDO_ACTION_UNLOCK'			=> 'Onderwerp(en) geopend',
	'MOD_UNDO_ACTION_LOCK_POST'			=> 'Bericht(en) vergrendeld',
	'MOD_UNDO_ACTION_UNLOCK_POST'		=> 'Bericht(en) ontgrendeld',
	'MOD_UNDO_ACTION_MOVE'				=> 'Onderwerp(en) verplaatst',
	'MOD_UNDO_ACTION_SPLIT'				=> 'Onderwerp gesplitst',
	'MOD_UNDO_ACTION_MERGE'				=> 'Berichten/onderwerpen samengevoegd',
	'MOD_UNDO_ACTION_CHANGE_POSTER'		=> 'Auteur gewijzigd',
	'MOD_UNDO_ACTION_BAN'				=> 'Verbanning',
	'MOD_UNDO_ACTION_UNBAN'				=> 'Verbanning opgeheven',
	'MOD_UNDO_ACTION_WARNING'			=> 'Waarschuwing',

	'MOD_UNDO_MODERATOR'				=> 'Moderator',
	'MOD_UNDO_SUMMARY'					=> 'Inhoud',
	'MOD_UNDO_STATUS'					=> 'Status',
	'MOD_UNDO_PENDING'					=> 'Herstelbaar',
	'MOD_UNDO_RESTORED_ON'				=> 'Hersteld',
	'MOD_UNDO_ALL'						=> 'Alle',
	'MOD_UNDO_FILTER_USER'				=> 'Gebruikersnaam moderator',
	'MOD_UNDO_VIEW'						=> 'Bekijken',
	'MOD_UNDO_DISABLED'					=> 'Vastleggen is momenteel uitgeschakeld. Bestaande registraties kunnen nog steeds hersteld worden.',
	'MOD_UNDO_NO_ENTRIES'				=> 'Geen vastgelegde moderatoracties.',

	'MOD_UNDO_RESTORE_MARKED'			=> 'Gemarkeerde herstellen',
	'MOD_UNDO_REVERT_USER'				=> 'Alle acties van een moderator terugdraaien',
	'MOD_UNDO_REVERT_USER_EXPLAIN'		=> 'Herstelt alle openstaande acties van deze moderator binnen het gekozen aantal dagen, de nieuwste eerst. Gebruik dit als een account gekaapt is.',
	'MOD_UNDO_REVERT_DAYS'				=> 'Dagen terug',
	'MOD_UNDO_REVERT'					=> 'Terugdraaien',

	'MOD_UNDO_RESTORED'					=> '%d actie(s) hersteld.',
	'MOD_UNDO_ERRORS'					=> 'Deze acties konden niet hersteld worden:',
	'MOD_UNDO_NOTHING_MARKED'			=> 'Er zijn geen acties gemarkeerd.',
	'MOD_UNDO_NOTHING_FOUND'			=> 'Geen openstaande acties gevonden voor deze moderator in die periode.',
	'MOD_UNDO_NO_USER'					=> 'Vul een bestaande gebruikersnaam en een aantal dagen in.',
	'MOD_UNDO_NOT_FOUND'				=> 'De registratie bestaat niet meer.',
	'MOD_UNDO_ALREADY'					=> 'Deze actie is al hersteld.',
	'MOD_UNDO_BAD_DATA'					=> 'De opgeslagen gegevens zijn onleesbaar.',
	'MOD_UNDO_FORUM_GONE'				=> 'Een forum waartoe deze inhoud behoorde bestaat niet meer.',
	'MOD_UNDO_TOPIC_GONE'				=> 'Een onderwerp waartoe deze inhoud behoorde bestaat niet meer en maakte geen deel uit van deze registratie.',
	'MOD_UNDO_POST_GONE'				=> 'Het bericht bestaat niet meer.',
	'MOD_UNDO_STATE_CHANGED'			=> 'De inhoud is na deze actie opnieuw gewijzigd; maak eerst de nieuwere actie ongedaan.',

	'LOG_MOD_UNDO_RESTORE'				=> '<strong>Moderatoractie hersteld</strong><br />» %1$s: %2$s',
));
