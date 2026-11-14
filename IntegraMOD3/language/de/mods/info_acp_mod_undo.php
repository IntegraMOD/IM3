<?php
/**
*
* Moderator action undo [Deutsch — Du]
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
	'ACP_MOD_UNDO'						=> 'Moderatoren-Rückgängig',
	'ACP_MOD_UNDO_LIST'					=> 'Moderatoren-Aktionen',
	'ACP_MOD_UNDO_LIST_EXPLAIN'			=> 'Aktionen von Moderatoren: Löschungen, Bearbeitungen, Verschiebungen, Teilungen, Zusammenführungen, Sperrungen, Autorenänderungen, Sperren von Benutzern und Verwarnungen. Beim Wiederherstellen wird der Zustand vor der Aktion zurückgesetzt. Mehrere Aktionen werden von der neuesten zur ältesten rückgängig gemacht.',
	'ACP_MOD_UNDO_SETTINGS'				=> 'Einstellungen Moderatoren-Rückgängig',
	'ACP_MOD_UNDO_SETTINGS_EXPLAIN'		=> 'Speichert Moderatoren-Aktionen, damit ein Administrator sie rückgängig machen kann.',

	'MOD_UNDO_ENABLE'					=> 'Moderatoren-Aktionen aufzeichnen',
	'MOD_UNDO_ENABLE_EXPLAIN'			=> 'Löschungen, Bearbeitungen fremder Beiträge, Verschiebungen, Teilungen, Zusammenführungen, Sperrungen, Autorenänderungen, Sperren und Verwarnungen werden aufgezeichnet, damit sie rückgängig gemacht werden können.',
	'MOD_UNDO_ADMINS'					=> 'Auch Administratoren aufzeichnen',
	'MOD_UNDO_ADMINS_EXPLAIN'			=> 'Zeichnet auch Aktionen von Benutzern mit Administratorrechten auf. Schützt vor einem gekaperten Administratorkonto.',
	'MOD_UNDO_DAYS'						=> 'Einträge aufbewahren für',
	'MOD_UNDO_DAYS_EXPLAIN'				=> 'Ältere Einträge werden zusammen mit den gesicherten Dateianhängen entfernt. 0 bewahrt sie unbegrenzt auf.',

	'MOD_UNDO_ACTION_DELETE_POST'		=> 'Beitrag/Beiträge gelöscht',
	'MOD_UNDO_ACTION_DELETE_TOPIC'		=> 'Thema/Themen gelöscht',
	'MOD_UNDO_ACTION_EDIT'				=> 'Beitrag bearbeitet',
	'MOD_UNDO_ACTION_LOCK'				=> 'Thema/Themen gesperrt',
	'MOD_UNDO_ACTION_UNLOCK'			=> 'Thema/Themen entsperrt',
	'MOD_UNDO_ACTION_LOCK_POST'			=> 'Beitrag/Beiträge gesperrt',
	'MOD_UNDO_ACTION_UNLOCK_POST'		=> 'Beitrag/Beiträge entsperrt',
	'MOD_UNDO_ACTION_MOVE'				=> 'Thema/Themen verschoben',
	'MOD_UNDO_ACTION_SPLIT'				=> 'Thema geteilt',
	'MOD_UNDO_ACTION_MERGE'				=> 'Beiträge/Themen zusammengeführt',
	'MOD_UNDO_ACTION_CHANGE_POSTER'		=> 'Autor geändert',
	'MOD_UNDO_ACTION_BAN'				=> 'Sperre',
	'MOD_UNDO_ACTION_UNBAN'				=> 'Sperre aufgehoben',
	'MOD_UNDO_ACTION_WARNING'			=> 'Verwarnung',

	'MOD_UNDO_MODERATOR'				=> 'Moderator',
	'MOD_UNDO_SUMMARY'					=> 'Inhalt',
	'MOD_UNDO_STATUS'					=> 'Status',
	'MOD_UNDO_PENDING'					=> 'Wiederherstellbar',
	'MOD_UNDO_RESTORED_ON'				=> 'Wiederhergestellt',
	'MOD_UNDO_ALL'						=> 'Alle',
	'MOD_UNDO_FILTER_USER'				=> 'Benutzername des Moderators',
	'MOD_UNDO_VIEW'						=> 'Anzeigen',
	'MOD_UNDO_DISABLED'					=> 'Die Aufzeichnung ist derzeit deaktiviert. Vorhandene Einträge können weiterhin wiederhergestellt werden.',
	'MOD_UNDO_NO_ENTRIES'				=> 'Keine aufgezeichneten Moderatoren-Aktionen.',

	'MOD_UNDO_RESTORE_MARKED'			=> 'Markierte wiederherstellen',
	'MOD_UNDO_REVERT_USER'				=> 'Alle Aktionen eines Moderators rückgängig machen',
	'MOD_UNDO_REVERT_USER_EXPLAIN'		=> 'Stellt alle offenen Aktionen dieses Moderators innerhalb der gewählten Anzahl Tage wieder her, die neueste zuerst. Verwende dies, wenn ein Konto gekapert wurde.',
	'MOD_UNDO_REVERT_DAYS'				=> 'Tage zurück',
	'MOD_UNDO_REVERT'					=> 'Rückgängig machen',

	'MOD_UNDO_RESTORED'					=> '%d Aktion(en) wiederhergestellt.',
	'MOD_UNDO_ERRORS'					=> 'Diese Aktionen konnten nicht wiederhergestellt werden:',
	'MOD_UNDO_NOTHING_MARKED'			=> 'Es wurden keine Aktionen markiert.',
	'MOD_UNDO_NOTHING_FOUND'			=> 'Für diesen Moderator wurden in diesem Zeitraum keine offenen Aktionen gefunden.',
	'MOD_UNDO_NO_USER'					=> 'Gib einen existierenden Benutzernamen und eine Anzahl Tage ein.',
	'MOD_UNDO_NOT_FOUND'				=> 'Der Eintrag existiert nicht mehr.',
	'MOD_UNDO_ALREADY'					=> 'Diese Aktion wurde bereits wiederhergestellt.',
	'MOD_UNDO_BAD_DATA'					=> 'Die gespeicherten Daten sind nicht lesbar.',
	'MOD_UNDO_FORUM_GONE'				=> 'Ein Forum, zu dem dieser Inhalt gehörte, existiert nicht mehr.',
	'MOD_UNDO_TOPIC_GONE'				=> 'Ein Thema, zu dem dieser Inhalt gehörte, existiert nicht mehr und war nicht Teil dieses Eintrags.',
	'MOD_UNDO_POST_GONE'				=> 'Der Beitrag existiert nicht mehr.',
	'MOD_UNDO_STATE_CHANGED'			=> 'Der Inhalt wurde nach dieser Aktion erneut geändert; mache zuerst die neuere Aktion rückgängig.',

	'LOG_MOD_UNDO_RESTORE'				=> '<strong>Moderatoren-Aktion wiederhergestellt</strong><br />» %1$s: %2$s',
));
