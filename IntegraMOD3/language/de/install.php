<?php
/**
 *
 * install [German]
 *
 * @package language
 * @version $Id$
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
    'ADMIN_CONFIG'				=> 'Administratorkonfiguration',
    'ADMIN_PASSWORD'			=> 'Administratorpasswort',
    'ADMIN_PASSWORD_CONFIRM'	=> 'Administratorpasswort bestätigen',
    'ADMIN_PASSWORD_EXPLAIN'	=> 'Bitte geben Sie ein Passwort zwischen 6 und 30 Zeichen Länge ein.',
    'ADMIN_TEST'				=> 'Administratoreinstellungen überprüfen',
    'ADMIN_USERNAME'			=> 'Administratorbenutzername',
    'ADMIN_USERNAME_EXPLAIN'	=> 'Bitte geben Sie einen Benutzernamen zwischen 3 und 20 Zeichen Länge ein.',
    'APP_MAGICK'				=> 'Imagemagick-Unterstützung [ Anhänge ]',
    'AUTHOR_NOTES'				=> 'Autorennotizen<br />» %s',
    'AVAILABLE'					=> 'Verfügbar',
    'AVAILABLE_CONVERTORS'		=> 'Verfügbare Konverter',

    'BEGIN_CONVERT'					=> 'Konvertierung starten',
    'BLANK_PREFIX_FOUND'			=> 'Eine Überprüfung Ihrer Tabellen hat eine gültige Installation ohne Tabellenprefix gezeigt.',
    'BOARD_NOT_INSTALLED'			=> 'Keine Installation gefunden',
    'BOARD_NOT_INSTALLED_EXPLAIN'	=> 'Das phpBB Unified Convertor Framework benötigt eine Standard-Installation von phpBB3 zum Funktionieren. Bitte <a href="%s">führen Sie zunächst phpBB3 ein</a>.',
    'BACKUP_NOTICE'					=> 'Bitte sichern Sie Ihr Forum vor der Aktualisierung für den Fall, dass während des Aktualisierungsprozesses Probleme auftreten.',

    'CATEGORY'					=> 'Kategorie',
    'CACHE_STORE'				=> 'Cache-Typ',
    'CACHE_STORE_EXPLAIN'		=> 'Der physikalische Ort, wo Daten zwischengespeichert werden. Dateibasierter Cache ist einfach und zuverlässig; memcache/memcached und redis bieten schnelleres speicherinternes Caching über Prozesse oder Server hinweg.',
    'CACHE_FILE'				=> 'Datei (Standard)',
    'CACHE_MEMCACHE'			=> 'Memcache (pecl)',
    'CACHE_MEMCACHED'			=> 'Memcached (pecl)',
    'CACHE_REDIS'				=> 'Redis',
    'CACHE_APC'					=> 'APC',
    'CACHE_WINCACHE'			=> 'WinCache',
    'CACHE_MEMORY'				=> 'Speicher (nur Prozess)',
    'CACHE_NULL'				=> 'Kein Cache',
    'CACHE_FILE_EXPLAIN'		=> 'Datei-Cache speichert zwischengespeicherte Daten auf der Festplatte im Verzeichnis store/. Es ist einfach und zuverlässig, aber langsamer als speicherinterne Systeme.',
    'CACHE_MEMCACHE_EXPLAIN'	=> 'Memcache (PHP-Erweiterung) bietet schnelles verteiltes speicherinternes Caching. Erfordert die memcache-Erweiterung und einen memcached-Server.',
    'CACHE_MEMCACHED_EXPLAIN'	=> 'Memcached (PHP-Erweiterung) bietet leistungsstarkes verteiltes speicherinternes Object-Caching. Erfordert die memcached-Erweiterung und einen Server.',
    'CACHE_REDIS_EXPLAIN'		=> 'Redis ist ein fortgeschrittener speicherinterner Datenspeicher mit Persistenz und vielfältigen Datentypen. Erfordert die redis-Erweiterung und einen redis-Server.',
    'CACHE_APC_EXPLAIN'			=> 'APC/APCu bietet lokales Shared-Memory-Caching innerhalb von PHP-Prozessen. Gut für Einzelserver-Setups.',
    'CACHE_WINCACHE_EXPLAIN'	=> 'WinCache ist ein PHP-Opcode- und Datencache auf Windows-basierten Hosts verfügbar.',
    'CACHE_MEMORY_EXPLAIN'		=> 'Memory-Cache speichert Daten nur im Prozess; schnell, aber nicht zwischen Prozessen oder Servern freigegeben.',
    'CAT_CONVERT'				=> 'Konvertieren',
    'CAT_INSTALL'				=> 'Installieren',
    'CAT_OVERVIEW'				=> 'Überblick',
    'CAT_UPDATE'				=> 'Aktualisieren',
    'CHANGE'					=> 'Ändern',
    'CHECK_TABLE_PREFIX'		=> 'Bitte überprüfen Sie Ihren Tabellenprefix und versuchen Sie es erneut.',
    'CLEAN_VERIFY'				=> 'Bereinigung und Überprüfung der endgültigen Struktur',
    'CLEANING_USERNAMES'		=> 'Benutzernamen werden bereinigt',
    'COLLIDING_CLEAN_USERNAME'	=> '<strong>%s</strong> ist der bereinigte Benutzername für:',
    'COLLIDING_USERNAMES_FOUND'	=> 'Kollidierende Benutzernamen wurden auf Ihrem alten Forum gefunden. Um die Konvertierung abzuschließen, löschen oder benennen Sie diese Benutzer bitte um, so dass es nur einen Benutzer auf Ihrem alten Forum für jeden bereinigten Benutzernamen gibt.',
    'COLLIDING_USER'			=> '» Benutzer-ID: <strong>%d</strong> Benutzername: <strong>%s</strong> (%d Beiträge)',
    'CONFIG_CONVERT'			=> 'Konfiguration wird konvertiert',
    'CONFIG_FILE_UNABLE_WRITE'	=> 'Es war nicht möglich, die Konfigurationsdatei zu schreiben. Alternative Methoden zum Erstellen dieser Datei werden unten angezeigt.',
    'CONFIG_FILE_WRITTEN'		=> 'Die Konfigurationsdatei wurde geschrieben. Sie können jetzt zum nächsten Schritt der Installation fortfahren.',
    'CONFIG_PHPBB_EMPTY'		=> 'Die phpBB3-Konfigurationsvariable für "%s" ist leer.',
    'CONFIG_RETRY'				=> 'Erneut versuchen',
    'CONTACT_EMAIL_CONFIRM'		=> 'Kontakt-E-Mail bestätigen',
    'CONTINUE_CONVERT'			=> 'Konvertierung fortsetzen',
    'CONTINUE_CONVERT_BODY'		=> 'Ein vorheriger Konvertierungsversuch wurde ermittelt. Sie können jetzt zwischen dem Start einer neuen Konvertierung oder dem Fortsetzen der Konvertierung wählen.',
    'CONTINUE_LAST'				=> 'Letzte Anweisungen fortsetzen',
    'CONTINUE_OLD_CONVERSION'	=> 'Zuvor gestartete Konvertierung fortsetzen',
    'CONVERT'					=> 'Konvertieren',
    'CONVERT_COMPLETE'			=> 'Konvertierung abgeschlossen',
    'CONVERT_COMPLETE_EXPLAIN'	=> 'Sie haben Ihr Forum erfolgreich zu phpBB 3.0 konvertiert. Sie können sich jetzt anmelden und <a href="../">auf Ihr Forum zugreifen</a>. Stellen Sie bitte sicher, dass die Einstellungen vor dem Aktivieren Ihres Forums korrekt übertragen wurden, indem Sie das Install-Verzeichnis löschen. Denken Sie daran, dass Hilfe zur Verwendung von phpBB online über die <a href="https://www.phpbb.com/support/documentation/3.0/">Dokumentation</a> und die <a href="https://www.phpbb.com/community/viewforum.php?f=46">Support-Foren</a> verfügbar ist.',
    'CONVERT_INTRO'				=> 'Willkommen beim phpBB Unified Convertor Framework',
    'CONVERT_INTRO_BODY'		=> 'Von hier aus können Sie Daten aus anderen (installierten) Board-Systemen importieren. Die untenstehende Liste zeigt alle derzeit verfügbaren Konvertierungsmodule. Wenn für die Board-Software, von der Sie konvertieren möchten, kein Konverter in dieser Liste angezeigt wird, überprüfen Sie bitte unsere Website, auf der möglicherweise weitere Konvertierungsmodule zum Download verfügbar sind.',
    'CONVERT_NEW_CONVERSION'	=> 'Neue Konvertierung',
    'CONVERT_NOT_EXIST'			=> 'Der angegebene Konverter existiert nicht.',
    'CONVERT_OPTIONS'			=> 'Optionen',
    'CONVERT_SETTINGS_VERIFIED'	=> 'Die eingegebenen Informationen wurden überprüft. Um den Konvertierungsprozess zu starten, klicken Sie bitte auf die Schaltfläche unten.',
    'CONV_ERR_FATAL'			=> 'Schwerwiegender Konvertierungsfehler',

    'CONV_ERROR_ATTACH_FTP_DIR'			=> 'FTP-Upload für Anhänge ist auf dem alten Forum aktiviert. Bitte deaktivieren Sie die FTP-Upload-Option und stellen Sie sicher, dass ein gültiges Upload-Verzeichnis angegeben ist. Kopieren Sie dann alle Anhang-Dateien in dieses neue Web-verfügbare Verzeichnis. Starten Sie dann den Konverter neu.',
    'CONV_ERROR_CONFIG_EMPTY'			=> 'Für die Konvertierung sind keine Konfigurationsinformationen verfügbar.',
    'CONV_ERROR_FORUM_ACCESS'			=> 'Kann Forum-Zugriffsinformationen nicht abrufen.',
    'CONV_ERROR_GET_CATEGORIES'			=> 'Kann Kategorien nicht abrufen.',
    'CONV_ERROR_GET_CONFIG'				=> 'Kann Ihre Forum-Konfiguration nicht abrufen.',
    'CONV_ERROR_COULD_NOT_READ'			=> 'Kann "%s" nicht zugreifen/lesen.',
    'CONV_ERROR_GROUP_ACCESS'			=> 'Kann Gruppen-Authentifizierungsinformationen nicht abrufen.',
    'CONV_ERROR_INCONSISTENT_GROUPS'	=> 'Inkonsistenz in der Gruppen-Tabelle erkannt in add_bots() - Sie müssen alle speziellen Gruppen hinzufügen, wenn Sie dies manuell tun.',
    'CONV_ERROR_INSERT_BOT'				=> 'Kann Bot nicht in Benutzer-Tabelle einfügen.',
    'CONV_ERROR_INSERT_BOTGROUP'		=> 'Kann Bot nicht in Bots-Tabelle einfügen.',
    'CONV_ERROR_INSERT_USER_GROUP'		=> 'Kann Benutzer nicht in Benutzergruppen-Tabelle einfügen.',
    'CONV_ERROR_MESSAGE_PARSER'			=> 'Nachrichtenparser-Fehler',
    'CONV_ERROR_NO_AVATAR_PATH'			=> 'Hinweis für den Entwickler: Sie müssen $convertor[\'avatar_path\'] angeben, um %s zu verwenden.',
    'CONV_ERROR_NO_FORUM_PATH'			=> 'Der relative Pfad zum Quellboard wurde nicht angegeben.',
    'CONV_ERROR_NO_GALLERY_PATH'		=> 'Hinweis für den Entwickler: Sie müssen $convertor[\'avatar_gallery_path\'] angeben, um %s zu verwenden.',
    'CONV_ERROR_NO_GROUP'				=> 'Gruppe "%1$s" konnte nicht in %2$s gefunden werden.',
    'CONV_ERROR_NO_RANKS_PATH'			=> 'Hinweis für den Entwickler: Sie müssen $convertor[\'ranks_path\'] angeben, um %s zu verwenden.',
    'CONV_ERROR_NO_SMILIES_PATH'		=> 'Hinweis für den Entwickler: Sie müssen $convertor[\'smilies_path\'] angeben, um %s zu verwenden.',
    'CONV_ERROR_NO_UPLOAD_DIR'			=> 'Hinweis für den Entwickler: Sie müssen $convertor[\'upload_path\'] angeben, um %s zu verwenden.',
    'CONV_ERROR_PERM_SETTING'			=> 'Kann Berechtigungseinstellung nicht einfügen/aktualisieren.',
    'CONV_ERROR_PM_COUNT'				=> 'Kann Ordner-PM-Anzahl nicht auswählen.',
    'CONV_ERROR_REPLACE_CATEGORY'		=> 'Kann neues Forum als Ersatz für alte Kategorie nicht einfügen.',
    'CONV_ERROR_REPLACE_FORUM'			=> 'Kann neues Forum als Ersatz für altes Forum nicht einfügen.',
    'CONV_ERROR_USER_ACCESS'			=> 'Kann Benutzer-Authentifizierungsinformationen nicht abrufen.',
    'CONV_ERROR_WRONG_GROUP'			=> 'Falsche Gruppe "%1$s" definiert in %2$s.',
    'CONV_OPTIONS_BODY'					=> 'Diese Seite sammelt die erforderlichen Daten für den Zugriff auf das Quellboard. Geben Sie die Datenbankdetails Ihres ehemaligen Forums ein; der Konverter wird nichts in der unten angegebenen Datenbank ändern. Das Quellboard sollte deaktiviert sein, um eine konsistente Konvertierung zu ermöglichen.',
    'CONV_SAVED_MESSAGES'				=> 'Gespeicherte Nachrichten',

    'COULD_NOT_COPY'			=> 'Konnte Datei <strong>%1$s</strong> nicht in <strong>%2$s</strong> kopieren<br /><br />Bitte überprüfen Sie, dass das Zielverzeichnis existiert und vom Webserver beschreibbar ist.',
    'COULD_NOT_FIND_PATH'		=> 'Konnte Pfad zu Ihrem früheren Forum nicht finden. Bitte überprüfen Sie Ihre Einstellungen und versuchen Sie es erneut.<br />» %s wurde als Quellpfad angegeben.',

    'DBMS'						=> 'Datenbanktyp',
    'DB_CONFIG'					=> 'Datenbankkonfiguration',
    'DB_CONNECTION'				=> 'Datenbankverbindung',
    'DB_ERR_INSERT'				=> 'Fehler beim Verarbeiten der <code>INSERT</code>-Abfrage.',
    'DB_ERR_LAST'				=> 'Fehler beim Verarbeiten von <var>query_last</var>.',
    'DB_ERR_QUERY_FIRST'		=> 'Fehler beim Ausführen von <var>query_first</var>.',
    'DB_ERR_QUERY_FIRST_TABLE'	=> 'Fehler beim Ausführen von <var>query_first</var>, %s ("%s").',
    'DB_ERR_SELECT'				=> 'Fehler beim Ausführen der <code>SELECT</code>-Abfrage.',
    'DB_HOST'					=> 'Datenbankserver-Hostname oder DSN',
    'DB_HOST_EXPLAIN'			=> 'DSN steht für Data Source Name und ist nur für ODBC-Installationen relevant. Verwenden Sie auf PostgreSQL localhost, um sich über UNIX-Domain-Socket mit dem lokalen Server zu verbinden, und 127.0.0.1, um sich über TCP zu verbinden. Für SQLite geben Sie den vollständigen Pfad zu Ihrer Datenbankdatei ein.',
    'DB_NAME'					=> 'Datenbankname',
    'DB_PASSWORD'				=> 'Datenbankpasswort',
    'DB_PORT'					=> 'Datenbankserver-Port',
    'DB_PORT_EXPLAIN'			=> 'Lassen Sie dies leer, es sei denn, Sie wissen, dass der Server an einem nicht-standardmäßigen Port läuft.',
    'DB_UPDATE_NOT_SUPPORTED'	=> 'Es tut uns leid, aber dieses Skript unterstützt keine Aktualisierung von Versionen von phpBB vor "%1$s" nicht. Die derzeit installierte Version ist "%2$s". Bitte aktualisieren Sie auf eine frühere Version, bevor Sie dieses Skript ausführen. Hilfe ist auf dem Support-Forum auf phpBB.com verfügbar.',
    'DB_USERNAME'				=> 'Datenbankbenutzername',
    'DB_TEST'					=> 'Verbindung testen',
    'DEFAULT_LANG'				=> 'Standard-Board-Sprache',
    'DEFAULT_PREFIX_IS'			=> 'Der Konverter konnte keine Tabellen mit dem angegebenen Präfix finden. Bitte stellen Sie sicher, dass Sie die richtigen Details für das Forum eingegeben haben, das Sie konvertieren möchten. Das Standardtabellenprefix für %1$s ist <strong>%2$s</strong>.',
    'DEV_NO_TEST_FILE'			=> 'Für die Konverter-Variable test_file wurde kein Wert angegeben. Wenn Sie ein Benutzer dieses Konverters sind, sollten Sie diesen Fehler nicht sehen. Bitte melden Sie diese Nachricht dem Konverter-Autor. Wenn Sie ein Konverter-Autor sind, müssen Sie den Namen einer Datei angeben, die im Quellboard vorhanden ist, um den Pfad dazu zu überprüfen.',
    'DIRECTORIES_AND_FILES'		=> 'Verzeichnis- und Datei-Setup',
    'DISABLE_KEYS'				=> 'Schlüssel werden deaktiviert',
    'DLL_FIREBIRD'				=> 'Firebird',
    'DLL_FTP'					=> 'Remote-FTP-Unterstützung [ Installation ]',
    'DLL_GD'					=> 'GD-Grafikunterstützung [ Visuelle Bestätigung ]',
    'DLL_MBSTRING'				=> 'Mehrbyte-Zeichenunterstützung',
    'DLL_MSSQL'					=> 'MSSQL Server 2000+',
    'DLL_MSSQL_ODBC'			=> 'MSSQL Server 2000+ über ODBC',
    'DLL_MSSQLNATIVE'			=> 'MSSQL Server 2005+ [ Nativ ]',
    'DLL_MYSQL'					=> 'MySQL',
    'DLL_MYSQLI'				=> 'MySQL mit MySQLi-Erweiterung',
    'DLL_ORACLE'				=> 'Oracle',
    'DLL_POSTGRES'				=> 'PostgreSQL',
    'DLL_SQLITE'				=> 'SQLite',
    'DLL_XML'					=> 'XML-Unterstützung [ Jabber ]',
    'DLL_ZLIB'					=> 'zlib-Komprimierungsunterstützung [ gz, .tar.gz, .zip ]',
    'DL_CONFIG'					=> 'Konfiguration herunterladen',
    'DL_CONFIG_EXPLAIN'			=> 'Sie können die komplette config.php auf Ihren eigenen PC herunterladen. Sie müssen die Datei dann manuell hochladen und jede vorhandene config.php in Ihrem phpBB 3.0-Stammverzeichnis ersetzen. Bitte denken Sie daran, die Datei im ASCII-Format hochzuladen (siehe Dokumentation Ihrer FTP-Anwendung, wenn Sie unsicher sind). Wenn Sie die config.php hochgeladen haben, klicken Sie auf "Fertig", um zur nächsten Phase zu gehen.',
    'DL_DOWNLOAD'				=> 'Herunterladen',
    'DONE'						=> 'Fertig',

    'ENABLE_KEYS'				=> 'Schlüssel werden erneut aktiviert. Dies kann eine Weile dauern.',

    'FILES_OPTIONAL'			=> 'Optionale Dateien und Verzeichnisse',
    'FILES_OPTIONAL_EXPLAIN'	=> '<strong>Optional</strong> - Diese Dateien, Verzeichnisse oder Berechtigungseinstellungen sind nicht erforderlich. Das Installationssystem versucht, verschiedene Techniken zu verwenden, um sie zu erstellen, falls sie nicht vorhanden sind oder nicht beschreibbar sind. Das Vorhandensein dieser wird die Installation jedoch beschleunigen.',
    'FILES_REQUIRED'			=> 'Dateien und Verzeichnisse',
    'FILES_REQUIRED_EXPLAIN'	=> '<strong>Erforderlich</strong> - Damit phpBB korrekt funktioniert, muss es auf bestimmte Dateien oder Verzeichnisse zugreifen oder in diese schreiben können. Wenn Sie "Nicht gefunden" sehen, müssen Sie die relevante Datei oder das Verzeichnis erstellen. Wenn Sie "Nicht beschreibbar" sehen, müssen Sie die Berechtigungen für die Datei oder das Verzeichnis ändern, um phpBB das Schreiben zu ermöglichen.',
    'FILLING_TABLE'				=> 'Füllen der Tabelle <strong>%s</strong>',
    'FILLING_TABLES'			=> 'Tabellen werden gefüllt',

    'FIREBIRD_DBMS_UPDATE_REQUIRED'		=> 'phpBB unterstützt Firebird/Interbase vor Version 2.1 nicht mehr. Bitte aktualisieren Sie Ihre Firebird-Installation mindestens auf 2.1.0, bevor Sie mit der Aktualisierung fortfahren.',

    'FINAL_STEP'				=> 'Finalen Schritt verarbeiten',
    'FORUM_ADDRESS'				=> 'Board-Adresse',
    'FORUM_ADDRESS_EXPLAIN'		=> 'Dies ist die URL Ihres früheren Boards, z. B. <samp>http://www.example.com/phpBB2/</samp>. Wenn hier eine Adresse eingegeben wird und nicht leer gelassen wird, wird jeder Fall dieser Adresse innerhalb von Nachrichten, Privatnachrichten und Signaturen durch Ihre neue Board-Adresse ersetzt.',
    'FORUM_PATH'				=> 'Board-Pfad',
    'FORUM_PATH_EXPLAIN'		=> 'Dies ist der <strong>relative</strong> Pfad auf der Festplatte zu Ihrem früheren Board vom <strong>Stammverzeichnis dieser phpBB3-Installation</strong>.',
    'FOUND'						=> 'Gefunden',
    'FTP_CONFIG'				=> 'Konfiguration per FTP übertragen',
    'FTP_CONFIG_EXPLAIN'		=> 'phpBB hat das Vorhandensein des FTP-Moduls auf diesem Server erkannt. Sie können versuchen, Ihre config.php über diese zu installieren, wenn Sie möchten. Sie müssen die unten aufgeführten Informationen angeben. Denken Sie daran, dass Ihr Benutzername und Passwort diejenigen für Ihren Server sind! (fragen Sie Ihren Hosting-Provider um Rat, wenn Sie unsicher sind).',
    'FTP_PATH'					=> 'FTP-Pfad',
    'FTP_PATH_EXPLAIN'			=> 'Dies ist der Pfad von Ihrem Stammverzeichnis zu dem von phpBB, z. B. <samp>htdocs/phpBB3/</samp>.',
    'FTP_UPLOAD'				=> 'Hochladen',

    'GPL'						=> 'General Public License',

    'INITIAL_CONFIG'			=> 'Grundkonfiguration',
    'INITIAL_CONFIG_EXPLAIN'	=> 'Da die Installation festgestellt hat, dass Ihr Server phpBB ausführen kann, müssen Sie jetzt spezifische Informationen bereitstellen. Wenn Sie nicht wissen, wie Sie sich mit Ihrer Datenbank verbinden, kontaktieren Sie zunächst Ihren Hosting-Provider oder nutzen Sie die phpBB-Support-Foren. Bitte überprüfen Sie die Daten beim Eingeben gründlich, bevor Sie fortfahren.',
    'INSTALL_CONGRATS'			=> 'Herzlichen Glückwunsch!',
    'INSTALL_CONGRATS_EXPLAIN'	=> '
        Sie haben IntegraMOD %1$s erfolgreich installiert. Bitte fahren Sie fort, indem Sie eine der folgenden Optionen wählen:</p>
        <h2>Konvertieren Sie ein bestehendes Board zu IntegraMOD3</h2>
        <p>Das phpBB Unified Convertor Framework unterstützt die Konvertierung von phpBB 2.0.x und anderen Board-Systemen zu IntegraMOD3. Wenn Sie ein bestehendes Board haben, das Sie konvertieren möchten, <a href="%2$s">gehen Sie zum Konverter</a>.</p>
        <h2>Machen Sie IntegraMOD3 live!</h2>
        <p><strong>Bitte löschen, verschieben oder benennen Sie das Install-Verzeichnis um, bevor Sie Ihr Board verwenden. Solange dieses Verzeichnis existiert, ist nur das Administration Control Panel (ACP) zugänglich.</strong>',
    'INSTALL_INTRO'				=> 'Willkommen zur Installation',

    'INSTALL_INTRO_BODY'		=> 'Mit dieser Option ist es möglich, IntegraMOD auf Ihrem Server zu installieren.</p><p>Um fortzufahren, benötigen Sie Ihre Datenbankeinstellungen. Wenn Sie Ihre Datenbankeinstellungen nicht kennen, wenden Sie sich bitte an Ihren Host und fragen Sie danach. Sie können ohne diese nicht fortfahren. Sie benötigen:</p>

    <ul>
        <li>Den Datenbanktyp - die Datenbank, die Sie verwenden werden.</li>
        <li>Den Datenbankserver-Hostnamen oder DSN - die Adresse des Datenbankservers.</li>
        <li>Den Datenbankserver-Port - den Port des Datenbankservers (meistens nicht erforderlich).</li>
        <li>Den Datenbanknamen - den Namen der Datenbank auf dem Server.</li>
        <li>Den Datenbankbenutzernamen und das Datenbankpasswort - die Anmeldedaten für den Zugriff auf die Datenbank.</li>
    </ul>

    <p><strong>Hinweis:</strong> Wenn Sie mit SQLite installieren, geben Sie den vollständigen Pfad zu Ihrer Datenbankdatei im DSN-Feld ein und lassen Sie die Felder für Benutzernamen und Passwort leer. Aus Sicherheitsgründen sollten Sie sicherstellen, dass die Datenbankdatei nicht an einem von der Web-erreichbaren Ort gespeichert ist.</p>

    <p>IntegraMOD unterstützt die folgenden Datenbanken:</p>
    <ul>
        <li>MySQL 3.23 oder höher (MySQLi unterstützt)</li>
        <li>PostgreSQL 7.3+</li>
        <li>SQLite 2.8.2+</li>
        <li>Firebird 2.1+</li>
        <li>MS SQL Server 2000 oder höher (direkt oder über ODBC)</li>
        <li>MS SQL Server 2005 oder höher (nativ)</li>
        <li>Oracle</li>
    </ul>

    <p>Nur die Datenbanken, die auf Ihrem Server unterstützt werden, werden angezeigt.',
    'INSTALL_INTRO_NEXT'		=> 'Um die Installation zu beginnen, klicken Sie bitte auf die Schaltfläche unten.',
    'INSTALL_LOGIN'				=> 'Anmelden',
    'INSTALL_NEXT'				=> 'Nächste Phase',
    'INSTALL_NEXT_FAIL'			=> 'Einige Tests sind fehlgeschlagen und Sie sollten diese Probleme beheben, bevor Sie zur nächsten Phase übergehen. Dies kann zu einer unvollständigen Installation führen.',
    'INSTALL_NEXT_PASS'			=> 'Alle grundlegenden Tests wurden bestanden und Sie können zur nächsten Phase der Installation übergehen. Wenn Sie Berechtigungen, Module usw. geändert haben und erneut testen möchten, können Sie dies tun.',
    'INSTALL_PANEL'				=> 'Installationsfeld',
    'INSTALL_SEND_CONFIG'		=> 'Leider konnte phpBB die Konfigurationsinformationen nicht direkt in Ihre config.php schreiben. Dies kann sein, weil die Datei nicht existiert oder nicht beschreibbar ist. Eine Reihe von Optionen wird unten aufgelistet, mit denen Sie die Installation von config.php abschließen können.',
    'INSTALL_START'				=> 'Installation starten',
    'INSTALL_TEST'				=> 'Erneut testen',
    'INST_ERR'					=> 'Installationsfehler',
    'INST_ERR_DB_CONNECT'		=> 'Konnte keine Verbindung zur Datenbank herstellen, siehe Fehlermeldung unten.',
    'INST_ERR_DB_FORUM_PATH'	=> 'Die angegebene Datenbankdatei befindet sich in Ihrem Board-Verzeichnisbaum. Sie sollten diese Datei an einem nicht Web-zugänglichen Ort platzieren.',
    'INST_ERR_DB_INVALID_PREFIX'=> 'Das eingegebene Präfix ist ungültig. Es muss mit einem Buchstaben beginnen und darf nur Buchstaben, Zahlen und Unterstriche enthalten.',
    'INST_ERR_DB_NO_ERROR'		=> 'Keine Fehlermeldung gegeben.',
    'INST_ERR_DB_NO_MYSQLI'		=> 'Die Version von MySQL, die auf dieser Maschine installiert ist, ist inkompatibel mit der Option "MySQL mit MySQLi-Erweiterung", die Sie ausgewählt haben. Versuchen Sie stattdessen die Option "MySQL".',
    'INST_ERR_DB_NO_SQLITE'		=> 'Die Version der SQLite-Erweiterung, die Sie installiert haben, ist zu alt und muss auf mindestens 2.8.2 aktualisiert werden.',
    'INST_ERR_DB_NO_ORACLE'		=> 'Die Version von Oracle, die auf dieser Maschine installiert ist, erfordert, dass Sie den Parameter <var>NLS_CHARACTERSET</var> auf <var>UTF8</var> setzen. Führen Sie ein Upgrade auf 9.2+ durch oder ändern Sie den Parameter.',
    'INST_ERR_DB_NO_FIREBIRD'	=> 'Die Version von Firebird, die auf dieser Maschine installiert ist, ist älter als 2.1. Bitte führen Sie ein Upgrade auf eine neuere Version durch.',
    'INST_ERR_DB_NO_FIREBIRD_PS'=> 'Die Datenbank, die Sie für Firebird ausgewählt haben, hat eine Seitengröße von weniger als 8192 und muss mindestens 8192 sein.',
    'INST_ERR_DB_NO_POSTGRES'	=> 'Die Datenbank, die Sie ausgewählt haben, wurde nicht in <var>UNICODE</var> oder <var>UTF8</var>-Kodierung erstellt. Versuchen Sie die Installation mit einer Datenbank in <var>UNICODE</var> oder <var>UTF8</var>-Kodierung.',
    'INST_ERR_DB_NO_NAME'		=> 'Kein Datenbankname angegeben.',
    'INST_ERR_EMAIL_INVALID'	=> 'Die eingegebene E-Mail-Adresse ist ungültig.',
    'INST_ERR_EMAIL_MISMATCH'	=> 'Die eingegebenen E-Mails stimmen nicht überein.',
    'INST_ERR_FATAL'			=> 'Schwerwiegender Installationsfehler',
    'INST_ERR_FATAL_DB'			=> 'Ein schwerwiegender und nicht behebbarer Datenbankfehler ist aufgetreten. Dies kann daran liegen, dass der angegebene Benutzer nicht über die erforderlichen Berechtigungen zum <code>CREATE TABLES</code> oder <code>INSERT</code> Daten usw. verfügt. Weitere Informationen können unten aufgeführt sein. Wenden Sie sich zunächst an Ihren Hosting-Provider oder an die Support-Foren von phpBB für weitere Hilfe.',
    'INST_ERR_FTP_PATH'			=> 'Konnte nicht in das angegebene Verzeichnis wechseln. Bitte überprüfen Sie den Pfad.',
    'INST_ERR_FTP_LOGIN'		=> 'Konnte sich nicht beim FTP-Server anmelden. Überprüfen Sie Ihren Benutzernamen und Ihr Passwort.',
    'INST_ERR_MISSING_DATA'		=> 'Sie müssen alle Felder in diesem Block ausfüllen.',
    'INST_ERR_NO_DB'			=> 'Kann das PHP-Modul für den ausgewählten Datenbanktyp nicht laden.',
    'INST_ERR_PASSWORD_MISMATCH'	=> 'Die eingegebenen Passwörter stimmen nicht überein.',
    'INST_ERR_PASSWORD_TOO_LONG'	=> 'Das eingegebene Passwort ist zu lang. Die maximale Länge beträgt 30 Zeichen.',
    'INST_ERR_PASSWORD_TOO_SHORT'	=> 'Das eingegebene Passwort ist zu kurz. Die Mindestlänge beträgt 6 Zeichen.',
    'INST_ERR_PREFIX'			=> 'Tabellen mit dem angegebenen Präfix existieren bereits. Bitte wählen Sie eine Alternative.',
    'INST_ERR_PREFIX_INVALID'	=> 'Das angegebene Tabellenprefix ist für Ihre Datenbank ungültig. Bitte versuchen Sie ein anderes und entfernen Sie Zeichen wie den Bindestrich.',
    'INST_ERR_PREFIX_TOO_LONG'	=> 'Das angegebene Tabellenprefix ist zu lang. Die maximale Länge beträgt %d Zeichen.',
    'INST_ERR_USER_TOO_LONG'	=> 'Der eingegebene Benutzername ist zu lang. Die maximale Länge beträgt 20 Zeichen.',
    'INST_ERR_USER_TOO_SHORT'	=> 'Der eingegebene Benutzername ist zu kurz. Die Mindestlänge beträgt 3 Zeichen.',
    'INVALID_PRIMARY_KEY'		=> 'Ungültiger Primärschlüssel: %s',

    'LONG_SCRIPT_EXECUTION'		=> 'Bitte beachten Sie, dass dies eine Weile dauern kann ... Bitte stoppen Sie das Skript nicht.',

    // mbstring
    'MBSTRING_CHECK'						=> '<samp>mbstring</samp>-Erweiterungsprüfung',
    'MBSTRING_CHECK_EXPLAIN'				=> '<strong>Erforderlich</strong> - <samp>mbstring</samp> ist eine PHP-Erweiterung, die Funktionen für mehrbyte-Zeichenketten bereitstellt. Bestimmte Funktionen von mbstring sind nicht mit phpBB kompatibel und müssen deaktiviert werden.',
    'MBSTRING_FUNC_OVERLOAD'				=> 'Funktionsüberladung',
    'MBSTRING_FUNC_OVERLOAD_EXPLAIN'		=> '<var>mbstring.func_overload</var> muss auf 0 oder 4 gesetzt werden.',
    'MBSTRING_ENCODING_TRANSLATION'			=> 'Transparente Zeichenkodierungskonvertierung',
    'MBSTRING_ENCODING_TRANSLATION_EXPLAIN'	=> '<var>mbstring.encoding_translation</var> muss auf 0 gesetzt werden.',
    'MBSTRING_HTTP_INPUT'					=> 'HTTP-Eingabezeichenkonvertierung',
    'MBSTRING_HTTP_INPUT_EXPLAIN'			=> '<var>mbstring.http_input</var> muss auf <samp>pass</samp> gesetzt werden.',
    'MBSTRING_HTTP_OUTPUT'					=> 'HTTP-Ausgabezeichenkonvertierung',
    'MBSTRING_HTTP_OUTPUT_EXPLAIN'			=> '<var>mbstring.http_output</var> muss auf <samp>pass</samp> gesetzt werden.',

    'MAKE_FOLDER_WRITABLE'		=> 'Bitte stellen Sie sicher, dass dieser Ordner existiert und vom Webserver beschreibbar ist. Versuchen Sie es dann erneut:<br />»<strong>%s</strong>.',
    'MAKE_FOLDERS_WRITABLE'		=> 'Bitte stellen Sie sicher, dass diese Ordner existieren und vom Webserver beschreibbar sind. Versuchen Sie es dann erneut:<br />»<strong>%s</strong>.',

    'MYSQL_SCHEMA_UPDATE_REQUIRED'	=> 'Ihr MySQL-Datenbankschema für phpBB ist veraltet. phpBB hat ein Schema für MySQL 3.x/4.x erkannt, aber der Server läuft auf MySQL %2$s.<br /><strong>Bevor Sie das Update fortsetzen, müssen Sie das Schema aktualisieren.</strong><br /><br />Bitte beachten Sie den <a href="https://www.phpbb.com/kb/article/doesnt-have-a-default-value-errors/">Knowledge Base-Artikel zum Upgrade des MySQL-Schemas</a>. Wenn Sie auf Probleme stoßen, verwenden Sie bitte <a href="https://www.phpbb.com/community/viewforum.php?f=46">unsere Support-Foren</a>.',

    'NAMING_CONFLICT'			=> 'Namenskonflikt: %s und %s sind beide Aliase<br /><br />%s',
    'NEXT_STEP'					=> 'Zum nächsten Schritt übergehen',
    'NOT_FOUND'					=> 'Kann nicht finden',
    'NOT_UNDERSTAND'			=> 'Konnte %s #%d, Tabelle %s ("%s") nicht verstehen',
    'NO_CONVERTORS'				=> 'Es sind keine Konverter zur Verwendung verfügbar.',
    'NO_CONVERT_SPECIFIED'		=> 'Kein Konverter angegeben.',
    'NO_LOCATION'				=> 'Kann Ort nicht bestimmen. Wenn Sie wissen, dass Imagemagick installiert ist, können Sie den Ort später in Ihrem Verwaltungs-Control-Panel angeben',
    'NO_TABLES_FOUND'			=> 'Keine Tabellen gefunden.',

    'OVERVIEW_BODY' => 'Willkommen bei IntegraMOD3!<br /><br />IntegraMOD3 ist eine vollständig integrierte phpBB3.0.x-Distribution, die auf phpBB3.0.15 basiert. Es kombiniert phpBB mit einer großen Sammlung von sorgfältig integrierten Modifikationen, Portal-Funktionalität und Community-Verbesserungen in einem einheitlichen Paket. phpBB® ist eine der am häufigsten verwendeten Open-Source-Bulletin-Board-Lösungen der Welt und ist für ihre Stabilität, Flexibilität und umfangreiche Funktionalität bekannt.<br /><br />IntegraMOD3 enthält KISS Portal©, das ursprüngliche phpBB3-Portalsystem und eines der frühesten großen Modifikationen, die während der phpBB3-Alpha- und Beta-Stadien entwickelt wurden. KISS Portal ist seit 2005 unter kontinuierlicher Entwicklung und bleibt eines der vollständigsten und am besten integrierten Portalsysteme für phpBB3. Trotz seiner umfangreichen Fähigkeiten können die meisten Funktionen problemlos über das Administrations-Control-Panel konfiguriert werden, ohne Code-Änderungen zu erfordern.<br /><br />IntegraMOD3 enthält auch zahlreiche vorinstallierte Funktionen und Verbesserungen, die eine vollständige Community-Plattform ab dem Werk bieten sollen und gleichzeitig die Kompatibilität mit dem phpBB3.0.x-Framework beibehalten.<br /><br />Dieses Installationssystem führt Sie durch die Installation von IntegraMOD3, das Aktualisieren von vorherigen Versionen oder die Konvertierung von einem anderen Diskussionsforum-System (einschließlich phpBB2). Weitere Informationen finden Sie unter <a href="../docs/INSTALL.html">dem Installationshandbuch</a>.<br /><br />Um die phpBB3-Lizenz zu lesen oder Informationen zum Erhalten von Unterstützung zu erhalten, wählen Sie bitte die entsprechenden Optionen aus dem Seitenmenü. Um fortzufahren, wählen Sie bitte die entsprechende Registerkarte oben.',

    'PCRE_UTF_SUPPORT'				=> 'PCRE-UTF-8-Unterstützung',
    'PCRE_UTF_SUPPORT_EXPLAIN'		=> 'phpBB wird <strong>nicht</strong> ausgeführt, wenn Ihre PHP-Installation nicht mit UTF-8-Unterstützung in der PCRE-Erweiterung kompiliert wurde.',
    'PHP_GETIMAGESIZE_SUPPORT'			=> 'PHP-Funktion getimagesize() ist verfügbar',
    'PHP_GETIMAGESIZE_SUPPORT_EXPLAIN'	=> '<strong>Erforderlich</strong> - Damit phpBB korrekt funktioniert, muss die Funktion getimagesize verfügbar sein.',
    'PHP_OPTIONAL_MODULE'			=> 'Optionale Module',
    'PHP_OPTIONAL_MODULE_EXPLAIN'	=> '<strong>Optional</strong> - Diese Module oder Anwendungen sind optional. Wenn sie jedoch verfügbar sind, werden zusätzliche Funktionen aktiviert.',
    'PHP_SUPPORTED_DB'				=> 'Unterstützte Datenbanken',
    'PHP_SUPPORTED_DB_EXPLAIN'		=> '<strong>Erforderlich</strong> - Sie müssen Unterstützung für mindestens eine kompatible Datenbank in PHP haben. Wenn keine Datenbankmodule als verfügbar angezeigt werden, wenden Sie sich an Ihren Hosting-Provider oder konsultieren Sie die relevante PHP-Installationsdokumentation um Rat.',
    'PHP_REGISTER_GLOBALS'			=> 'PHP-Einstellung <var>register_globals</var> ist deaktiviert',
    'PHP_REGISTER_GLOBALS_EXPLAIN'	=> 'phpBB wird weiterhin ausgeführt, wenn diese Einstellung aktiviert ist. Es wird jedoch empfohlen, dass register_globals in Ihrer PHP-Installation deaktiviert ist, um Sicherheit zu gewährleisten.',
    'PHP_SAFE_MODE'					=> 'Sicherer Modus',
    'PHP_SETTINGS'					=> 'PHP-Version und Einstellungen',
    'PHP_SETTINGS_EXPLAIN'			=> '<strong>Erforderlich</strong> - Sie müssen mindestens Version 7.0 von PHP ausführen, um IntegraMOD zu installieren. Wenn <var>Sicherer Modus</var> unten angezeigt wird, läuft Ihre PHP-Installation in diesem Modus. Dies wird Einschränkungen bei der Remote-Verwaltung und ähnlichen Funktionen verursachen.',
    'PHP_URL_FOPEN_SUPPORT'			=> 'PHP-Einstellung <var>allow_url_fopen</var> ist aktiviert',
    'PHP_URL_FOPEN_SUPPORT_EXPLAIN'	=> '<strong>Optional</strong> - Diese Einstellung ist optional. Allerdings funktionieren bestimmte phpBB-Funktionen wie Off-Site-Avatare ohne sie nicht ordnungsgemäß.',
    'PHP_VERSION_REQD'				=> 'PHP-Version >= 7.0',
    'POST_ID'						=> 'Beitrag-ID',
    'PREFIX_FOUND'					=> 'Eine Überprüfung Ihrer Tabellen zeigt eine gültige Installation mit <strong>%s</strong> als Tabellenprefix.',
    'PREPROCESS_STEP'				=> 'Vor-Verarbeitungsfunktionen/Abfragen werden ausgeführt',
    'PRE_CONVERT_COMPLETE'			=> 'Alle Vor-Konvertierungsschritte wurden erfolgreich abgeschlossen. Sie können nun mit dem eigentlichen Konvertierungsprozess beginnen. Beachten Sie, dass Sie mehrere Dinge möglicherweise manuell anpassen müssen. Überprüfen Sie nach der Konvertierung besonders die zugeordneten Berechtigungen, bauen Sie Ihren Suchindex neu auf, der nicht konvertiert wird, und stellen Sie sicher, dass Dateien korrekt kopiert wurden, z. B. Avatare und Smilies.',
    'PROCESS_LAST'					=> 'Letzte Anweisungen werden verarbeitet',

    'REFRESH_PAGE'				=> 'Seite aktualisieren um Konvertierung fortzusetzen',
    'REFRESH_PAGE_EXPLAIN'		=> 'Wenn auf ja gesetzt, aktualisiert der Konverter die Seite, um die Konvertierung nach dem Abschluss eines Schritts fortzusetzen. Wenn dies Ihre erste Konvertierung zu Testzwecken ist und um Fehler im Voraus zu bestimmen, empfehlen wir, dies auf Nein zu setzen.',
    'REQUIREMENTS_TITLE'		=> 'Installationskompatibilität',
    'REQUIREMENTS_EXPLAIN'		=> 'Vor dem Fortfahren mit der vollständigen Installation führt IntegraMOD einige Tests auf Ihrer Serverkonfiguration und -dateien durch, um sicherzustellen, dass Sie IntegraMOD installieren und ausführen können. Bitte stellen Sie sicher, dass Sie die Ergebnisse vollständig durchgelesen haben und nicht fortfahren, bis alle erforderlichen Tests bestanden sind. Wenn Sie die Funktionen verwenden möchten, die von den optionalen Tests abhängen, stellen Sie sicher, dass diese Tests ebenfalls bestanden werden.',
    'RETRY_WRITE'				=> 'Konfiguration erneut schreiben',
    'RETRY_WRITE_EXPLAIN'		=> 'Wenn Sie möchten, können Sie die Berechtigungen für config.php ändern, um phpBB das Schreiben zu ermöglichen. Wenn Sie das tun möchten, können Sie unten auf Wiederholung klicken, um es erneut zu versuchen. Denken Sie daran, die Berechtigungen für config.php nach Abschluss der phpBB-Installation wiederherzustellen.',

    'SCRIPT_PATH'				=> 'Skriptpfad',
    'SCRIPT_PATH_EXPLAIN'		=> 'Der Pfad, in dem phpBB relativ zum Domain-Namen vorhanden ist, z. B. <samp>/phpBB3</samp>.',
    'SELECT_LANG'				=> 'Sprache wählen',
    'SERVER_CONFIG'				=> 'Serverkonfiguration',
    'SEARCH_INDEX_UNCONVERTED'	=> 'Suchindex wurde nicht konvertiert',
    'SEARCH_INDEX_UNCONVERTED_EXPLAIN'	=> 'Ihr alter Suchindex wurde nicht konvertiert. Die Suche wird immer ein leeres Ergebnis liefern. Um einen neuen Suchindex zu erstellen, gehen Sie zum Administrations-Control-Panel, wählen Sie Wartung und wählen Sie dann Suchindex aus dem Untermenü.',
    'SOFTWARE'					=> 'Board-Software',
    'SPECIFY_OPTIONS'			=> 'Konvertierungsoptionen angeben',
    'STAGE_ADMINISTRATOR'		=> 'Administrator-Details',
    'STAGE_ADVANCED'			=> 'Erweiterte Einstellungen',
    'STAGE_ADVANCED_EXPLAIN'	=> 'Die Einstellungen auf dieser Seite sind nur erforderlich, wenn Sie wissen, dass Sie etwas anderes als die Standardeinstellung benötigen. Wenn Sie unsicher sind, fahren Sie einfach zur nächsten Seite fort, da diese Einstellungen später über das Administrations-Control-Panel geändert werden können.',
    'STAGE_CONFIG_FILE'			=> 'Konfigurationsdatei',
    'STAGE_CREATE_TABLE'		=> 'Datenbänk-Tabellen erstellen',
    'STAGE_CREATE_TABLE_EXPLAIN'	=> 'Die von integraMOD3 verwendeten Datenbänk-Tabellen wurden erstellt und mit einigen Anfangsdaten gefüllt. Fahren Sie zum nächsten Bildschirm fort, um die phpBB-Installation abzuschließen.',
    'STAGE_DATABASE'			=> 'Datenbankeinstellungen',
    'STAGE_SN_INSTALL'          => 'Soziales Netzwerk installieren',
    'STAGE_FINAL'				=> 'Endphase',
    'STAGE_INTRO'				=> 'Einführung',
    'STAGE_IN_PROGRESS'			=> 'Konvertierung läuft',
    'STAGE_REQUIREMENTS'		=> 'Anforderungen',
    'STAGE_SETTINGS'			=> 'Einstellungen',
    'STARTING_CONVERT'			=> 'Konvertierungsprozess wird gestartet',
    'STEP_PERCENT_COMPLETED'	=> 'Schritt <strong>%d</strong> von <strong>%d</strong>',
    'SUB_INTRO'					=> 'Einführung',
    'SUB_LICENSE'				=> 'Lizenz',
    'SUB_SUPPORT'				=> 'Support',
    'SUCCESSFUL_CONNECT'		=> 'Erfolgreiche Verbindung',
    'SUPPORT_BODY'				=> 'Vollständiger Support wird für die aktuelle stabile Version von IntegraMOD3 kostenlos bereitgestellt. Dies schließt Folgendes ein:</p><ul><li>Installation</li><li>Konfiguration</li><li>technische Fragen</li><li>Probleme mit potenziellen Softwarefehlern</li><li>Aktualisierung von Release Candidate (RC)-Versionen auf die neueste stabile Version</li><li>Konvertierung von phpBB 2.0.x zu IntegraMOD3</li><li>Konvertierung von anderer Diskussionsforum-Software zu IntegraMOD3 (siehe <a href="https://www.phpbb.com/community/viewforum.php?f=65">Konverter-Forum</a>)</li></ul><p>Wir ermutigen Benutzer, die immer noch Beta-Versionen von IntegraMOD3 ausführen, ihre Installation durch eine frische Kopie der neuesten Version zu ersetzen.</p><h2>MODs / Stile</h2><p>Für Probleme bezüglich MODs veröffentlichen Sie bitte im entsprechenden <a href="https://integramod.com/forum/viewforum.php?f=84">Modifications-Forum</a>.<br />Für Probleme bezüglich Stile, Templates und Imagesets veröffentlichen Sie bitte im entsprechenden <a href="https://www.phpbb.com/community/viewforum.php?f=80">Stile-Forum</a>.<br /><br />Wenn Ihre Frage sich auf ein bestimmtes Paket bezieht, veröffentlichen Sie bitte direkt im Thema des Pakets.</p><h2>Support erhalten</h2><p><a href="https://www.phpbb.com/community/viewtopic.php?f=14&amp;t=571070">Das phpBB-Willkommenspaket</a><br /><a href="https://www.phpbb.com/support/">Support-Bereich</a><br /><a href="https://www.phpbb.com/support/documentation/3.0/quickstart/">Schnellstartanleitung</a><br /><br />Um die neuesten Nachrichten und Versionen zu verfolgen, <a href="https://www.phpbb.com/support/">melden Sie sich für unsere Mailingliste an</a>?<br /><br />',
    'SYNC_FORUMS'				=> 'Foren beginnen zu synchronisieren',
    'SYNC_POST_COUNT'			=> 'Synchronisieren von Beitragszählern',
    'SYNC_POST_COUNT_ID'		=> 'Synchronisierung der Beitragszähler von <var>Eintrag</var> %1$s bis %2$s.',
    'SYNC_TOPICS'				=> 'Themen beginnen zu synchronisieren',
    'SYNC_TOPIC_ID'				=> 'Synchronisierung von Themen von <var>Thema-ID</var> %1$s bis %2$s.',

    'TABLES_MISSING'			=> 'Diese Tabellen konnten nicht gefunden werden<br />» <strong>%s</strong>.',
    'TABLE_PREFIX'				=> 'Präfix für Tabellen in der Datenbank',
    'TABLE_PREFIX_EXPLAIN'		=> 'Das Präfix muss mit einem Buchstaben beginnen und darf nur Buchstaben, Zahlen und Unterstriche enthalten.',
    'TABLE_PREFIX_SAME'			=> 'Das Tabellenprefix muss das gleiche sein wie das der Software, die Sie konvertieren.<br />» Das angegebene Tabellenprefix war %s.',
    'TESTS_PASSED'				=> 'Tests bestanden',
    'TESTS_FAILED'				=> 'Tests fehlgeschlagen',

    'UNABLE_WRITE_LOCK'			=> 'Kann Sperrdatei nicht schreiben.',
    'UNAVAILABLE'				=> 'Nicht verfügbar',
    'UNWRITABLE'				=> 'Nicht beschreibbar',
    'UPDATE_TOPICS_POSTED'		=> 'Generieren von Informationen zu veröffentlichten Themen',
    'UPDATE_TOPICS_POSTED_ERR'	=> 'Beim Generieren von Informationen zu veröffentlichten Themen ist ein Fehler aufgetreten. Sie können diesen Schritt im ACP nach Abschluss des Konvertierungsprozesses erneut versuchen.',
    'VERIFY_OPTIONS'			=> 'Konvertierungsoptionen werden überprüft',
    'VERSION'					=> 'Version',

    'WELCOME_INSTALL'			=> 'Willkommen zur IntegraMOD-Installation',
    'WRITABLE'					=> 'Beschreibbar',
));

// Updater
$lang = array_merge($lang, array(
    'ALL_FILES_UP_TO_DATE'		=> 'Alle Dateien sind auf dem neuesten Stand der phpBB-Version. Sie sollten sich jetzt <a href="../ucp.php?mode=login">auf Ihrem Board anmelden</a> und prüfen, ob alles einwandfrei funktioniert. Vergessen Sie nicht, Ihr Install-Verzeichnis zu löschen, umzubenennen oder zu verschieben! Bitte senden Sie uns aktualisierte Informationen über Ihre Server- und Board-Konfiguration über das Modul <a href="../ucp.php?mode=login&amp;redirect=adm/index.php%3Fi=send_statistics%26mode=send_statistics">Statistiken senden</a> im ACP.',
    'ARCHIVE_FILE'				=> 'Quelldatei im Archiv',

    'BACK'				=> 'Zurück',
    'BINARY_FILE'		=> 'Binärdatei',
    'BOT'				=> 'Spider/Robot',

    'CHANGE_CLEAN_NAMES'			=> 'Die Methode zur Gewährleistung, dass ein Benutzername nicht von mehreren Benutzern verwendet wird, wurde geändert. Es gibt einige Benutzer, die den gleichen Namen haben, wenn sie mit der neuen Methode verglichen werden. Sie müssen diese Benutzer löschen oder umbenennen, um sicherzustellen, dass jeder Name nur von einem Benutzer verwendet wird, bevor Sie fortfahren können.',
    'CHECK_FILES'					=> 'Dateien überprüfen',
    'CHECK_FILES_AGAIN'				=> 'Dateien erneut überprüfen',
    'CHECK_FILES_EXPLAIN'			=> 'Im nächsten Schritt werden alle Dateien gegen die Update-Dateien überprüft. Dies kann lange dauern, wenn dies die erste Dateiprüfung ist.',
    'CHECK_FILES_UP_TO_DATE'		=> 'Nach Ihrer Datenbank ist Ihre Version auf dem neuesten Stand. Sie können die Dateiprüfung durchführen, um sicherzustellen, dass alle Dateien wirklich auf dem neuesten Stand der phpBB-Version sind.',
    'CHECK_UPDATE_DATABASE'			=> 'Aktualisierungsprozess fortsetzen',
    'COLLECTED_INFORMATION'			=> 'Dateiinformationen',
    'COLLECTED_INFORMATION_EXPLAIN'	=> 'Die folgende Liste zeigt Informationen zu den zu aktualisierenden Dateien. Bitte lesen Sie die Informationen vor jedem Statusblock, um zu verstehen, was sie bedeuten und was Sie möglicherweise tun müssen, um ein erfolgreiches Update durchzuführen.',
    'COLLECTING_FILE_DIFFS'			=> 'Dateieinträge werden erfasst',
    'COMPLETE_LOGIN_TO_BOARD'		=> 'Sie sollten sich jetzt <a href="../ucp.php?mode=login">auf Ihrem Board anmelden</a> und prüfen, ob alles einwandfrei funktioniert. Vergessen Sie nicht, Ihr Install-Verzeichnis zu löschen, umzubenennen oder zu verschieben!',
    'CONTINUE_UPDATE_NOW'			=> 'Aktualisierungsprozess jetzt fortsetzen',		// Shown within the database update script at the end if called from the updater
    'CONTINUE_UPDATE'				=> 'Update jetzt fortsetzen',					// Shown after file upload to indicate the update process is not yet finished
    'CURRENT_FILE'					=> 'Anfang des Konflikts - Original-Dateicode vor dem Update',
    'CURRENT_VERSION'				=> 'Aktuelle Version',

    'DATABASE_TYPE'						=> 'Datenbanktyp',
    'DATABASE_UPDATE_INFO_OLD'			=> 'Die Datenbankupdates-Datei im Install-Verzeichnis ist veraltet. Bitte stellen Sie sicher, dass Sie die richtige Version der Datei hochgeladen haben.',
    'DELETE_USER_REMOVE'				=> 'Benutzer löschen und Beiträge entfernen',
    'DELETE_USER_RETAIN'				=> 'Benutzer löschen, aber Beiträge behalten',
    'DESTINATION'						=> 'Zieldatei',
    'DIFF_INLINE'						=> 'Inline',
    'DIFF_RAW'							=> 'Raw Unified Diff',
    'DIFF_SEP_EXPLAIN'					=> 'Code-Block, das in der aktualisierten/neuen Datei verwendet wird',
    'DIFF_SIDE_BY_SIDE'					=> 'Nebeneinander',
    'DIFF_UNIFIED'						=> 'Unified Diff',
    'DO_NOT_UPDATE'						=> 'Diese Datei nicht aktualisieren',
    'DONE'								=> 'Fertig',
    'DOWNLOAD'							=> 'Herunterladen',
    'DOWNLOAD_AS'						=> 'Herunterladen als',
    'DOWNLOAD_UPDATE_METHOD_BUTTON'		=> 'Archiv mit geänderten Dateien herunterladen (empfohlen)',
    'DOWNLOAD_CONFLICTS'				=> 'Konflikte für diese Datei herunterladen',
    'DOWNLOAD_CONFLICTS_EXPLAIN'		=> 'Suchen Sie nach &lt;&lt;&lt; um Konflikte zu erkennen',
    'DOWNLOAD_UPDATE_METHOD'			=> 'Archiv mit geänderten Dateien herunterladen',
    'DOWNLOAD_UPDATE_METHOD_EXPLAIN'	=> 'Nachdem Sie die Archiv heruntergeladen haben, sollten Sie es entpacken. Sie finden die geänderten Dateien, die Sie in Ihr phpBB-Stammverzeichnis hochladen müssen. Laden Sie die Dateien bitte an ihre jeweilige Stelle hoch. Nachdem Sie alle Dateien hochgeladen haben, überprüfen Sie die Dateien bitte erneut mit der anderen Schaltfläche unten.',

    'ERROR'			=> 'Fehler',
    'EDIT_USERNAME'	=> 'Benutzernamen bearbeiten',

    'FILE_ALREADY_UP_TO_DATE'		=> 'Datei ist bereits auf dem neuesten Stand.',
    'FILE_DIFF_NOT_ALLOWED'			=> 'Datei darf nicht zur Diff-Anzeige verwendet werden.',
    'FILE_USED'						=> 'Informationen verwendet von',			// Single file
    'FILES_CONFLICT'				=> 'Konflikt-Dateien',
    'FILES_CONFLICT_EXPLAIN'		=> 'Die folgenden Dateien werden geändert und stellen nicht die ursprünglichen Dateien aus der alten Version dar. phpBB hat festgestellt, dass diese Dateien Konflikte verursachen, wenn versucht wird, sie zusammenzuführen. Bitte untersuchen Sie die Konflikte und versuchen Sie, sie manuell zu beheben, oder fahren Sie mit dem Update fort und wählen Sie die bevorzugte Zusammenführungsmethode. Wenn Sie die Konflikte manuell beheben, überprüfen Sie die Dateien erneut, nachdem Sie sie geändert haben. Sie können auch die bevorzugte Zusammenführungsmethode für jede Datei wählen. Die erste führt zu einer Datei, bei der die in Konflikt stehenden Zeilen aus Ihrer alten Datei verloren gehen. Die andere führt zum Verlust der Änderungen aus der neueren Datei.',
    'FILES_MODIFIED'				=> 'Geänderte Dateien',
    'FILES_MODIFIED_EXPLAIN'		=> 'Die folgenden Dateien werden geändert und stellen nicht die ursprünglichen Dateien aus der alten Version dar. Die aktualisierte Datei ist eine Zusammenführung zwischen Ihren Änderungen und der neuen Datei.',
    'FILES_NEW'						=> 'Neue Dateien',
    'FILES_NEW_EXPLAIN'				=> 'Die folgenden Dateien existieren derzeit nicht in Ihrer Installation. Diese Dateien werden Ihrer Installation hinzugefügt.',
    'FILES_NEW_CONFLICT'			=> 'Neue Konflikt-Dateien',
    'FILES_NEW_CONFLICT_EXPLAIN'	=> 'Die folgenden Dateien sind in der neuesten Version neu. Es wurde jedoch festgestellt, dass eine Datei mit dem gleichen Namen an der gleichen Position bereits vorhanden ist. Diese Datei wird durch die neue Datei überschrieben.',
    'FILES_NOT_MODIFIED'			=> 'Nicht geänderte Dateien',
    'FILES_NOT_MODIFIED_EXPLAIN'	=> 'Die folgenden Dateien wurden nicht geändert und repräsentieren die ursprünglichen phpBB-Dateien der Version, von der Sie aktualisieren möchten.',
    'FILES_UP_TO_DATE'				=> 'Bereits aktualisierte Dateien',
    'FILES_UP_TO_DATE_EXPLAIN'		=> 'Die folgenden Dateien sind bereits auf dem neuesten Stand und müssen nicht aktualisiert werden.',
    'FTP_SETTINGS'					=> 'FTP-Einstellungen',
    'FTP_UPDATE_METHOD'				=> 'FTP-Upload',

    'INCOMPATIBLE_UPDATE_FILES'		=> 'Die gefundenen Update-Dateien sind mit Ihrer installierten Version nicht kompatibel. Ihre installierte Version ist %1$s und die Update-Datei ist für die Aktualisierung von phpBB %2$s auf %3$s.',
    'INCOMPLETE_UPDATE_FILES'		=> 'Die Update-Dateien sind unvollständig.',
    'INLINE_UPDATE_SUCCESSFUL'		=> 'Das Datenbankupdate war erfolgreich. Jetzt müssen Sie den Aktualisierungsprozess fortsetzen.',

    'KEEP_OLD_NAME'		=> 'Alten Benutzernamen behalten',

    'LATEST_VERSION'		=> 'Neueste Version',
    'LINE'					=> 'Zeile',
    'LINE_ADDED'			=> 'Hinzugefügt',
    'LINE_MODIFIED'			=> 'Geändert',
    'LINE_REMOVED'			=> 'Entfernt',
    'LINE_UNMODIFIED'		=> 'Ungeändert',
    'LOGIN_UPDATE_EXPLAIN'	=> 'Um Ihre Installation zu aktualisieren, müssen Sie sich zuerst anmelden.',

    'MAPPING_FILE_STRUCTURE'	=> 'Um den Upload zu erleichtern, hier sind die Dateispeicherorte, die Ihre phpBB-Installation zuordnen.',

    'MERGE_MODIFICATIONS_OPTION'	=> 'Änderungen zusammenführen',

    'MERGE_NO_MERGE_NEW_OPTION'	=> 'Nicht zusammenführen - neue Datei verwenden',
    'MERGE_NO_MERGE_MOD_OPTION'	=> 'Nicht zusammenführen - derzeit installierte Datei verwenden',
    'MERGE_MOD_FILE_OPTION'		=> 'Änderungen zusammenführen (entfernt neuen phpBB-Code im Konfliktblock)',
    'MERGE_NEW_FILE_OPTION'		=> 'Änderungen zusammenführen (entfernt geänderten Code im Konfliktblock)',
    'MERGE_SELECT_ERROR'		=> 'Konflikt-Datei-Zusammenführungsmodi sind nicht korrekt ausgewählt.',
    'MERGING_FILES'				=> 'Einträge werden zusammengeführt',
    'MERGING_FILES_EXPLAIN'		=> 'Derzeit werden die abschließenden Dateiänderungen erfasst.<br /><br />Bitte warten Sie, bis phpBB alle Operationen an geänderten Dateien abgeschlossen hat.',

    'NEW_FILE'						=> 'Ende des Konflikts',
    'NEW_USERNAME'					=> 'Neuer Benutzername',
    'NO_AUTH_UPDATE'				=> 'Nicht berechtigt zum Update',
    'NO_ERRORS'						=> 'Keine Fehler',
    'NO_UPDATE_FILES'				=> 'Die folgenden Dateien werden nicht aktualisiert',
    'NO_UPDATE_FILES_EXPLAIN'		=> 'Die folgenden Dateien sind neu oder geändert. Das Verzeichnis, in dem sie normalerweise residieren, konnte jedoch in Ihrer Installation nicht gefunden werden. Wenn diese Liste Dateien zu anderen Verzeichnissen als language/ oder styles/ enthält, haben Sie möglicherweise Ihre Verzeichnisstruktur geändert und das Update kann unvollständig sein.',
    'NO_UPDATE_FILES_OUTDATED'		=> 'Es wurde kein gültiges Update-Verzeichnis gefunden. Bitte stellen Sie sicher, dass Sie die relevanten Dateien hochgeladen haben.<br /><br />Ihre Installation scheint <strong>nicht</strong> auf dem neuesten Stand zu sein. Updates sind für Ihre Version von phpBB %1$s verfügbar. Bitte besuchen Sie <a href="https://www.phpbb.com/downloads/" rel="external">https://www.phpbb.com/downloads/</a> um das richtige Paket zum Aktualisieren von Version %2$s auf Version %3$s zu erhalten.',
    'NO_UPDATE_FILES_UP_TO_DATE'	=> 'Ihre Version ist auf dem neuesten Stand. Das Update-Tool muss nicht ausgeführt werden. Wenn Sie eine Integritätsprüfung Ihrer Dateien durchführen möchten, stellen Sie sicher, dass Sie die richtigen Update-Dateien hochgeladen haben.',
    'NO_UPDATE_INFO'				=> 'Update-Dateiinformationen konnten nicht gefunden werden.',
    'NO_UPDATES_REQUIRED'			=> 'Keine Updates erforderlich',
    'NO_VISIBLE_CHANGES'			=> 'Keine sichtbaren Änderungen',
    'NOTICE'						=> 'Hinweis',
    'NUM_CONFLICTS'					=> 'Anzahl der Konflikte',
    'NUMBER_OF_FILES_COLLECTED'		=> 'Derzeit werden Unterschiede von %1$d von %2$d Dateien überprüft.<br />Bitte warten Sie, bis alle Dateien überprüft sind.',

    'OLD_UPDATE_FILES'		=> 'Update-Dateien sind veraltet. Die gefundenen Update-Dateien sind für die Aktualisierung von phpBB %1$s auf phpBB %2$s, aber die neueste Version von phpBB ist %3$s.',

    'PACKAGE_UPDATES_TO'				=> 'Aktuelles Paket aktualisiert zu Version',
    'PERFORM_DATABASE_UPDATE'			=> 'Datenbankupdate durchführen',
    'PERFORM_DATABASE_UPDATE_EXPLAIN'	=> 'Unten finden Sie eine Schaltfläche zum Datenbankupdate-Skript. Das Datenbankupdate kann eine Weile dauern. Bitte stoppen Sie die Ausführung nicht, wenn sie zu hängen scheint. Nachdem das Datenbankupdate durchgeführt wurde, folgen Sie den Anweisungen, um den Aktualisierungsprozess fortzusetzen.',
    'PREVIOUS_VERSION'					=> 'Frühere Version',
    'PROGRESS'							=> 'Fortschritt',

    'RESULT'					=> 'Ergebnis',
    'RUN_DATABASE_SCRIPT'		=> 'Meine Datenbank jetzt aktualisieren',

    'SELECT_DIFF_MODE'			=> 'Diff-Modus wählen',
    'SELECT_DOWNLOAD_FORMAT'	=> 'Download-Archivformat wählen',
    'SELECT_FTP_SETTINGS'		=> 'FTP-Einstellungen wählen',
    'SHOW_DIFF_CONFLICT'		=> 'Unterschiede/Konflikte anzeigen',
    'SHOW_DIFF_FINAL'			=> 'Resultierende Datei anzeigen',
    'SHOW_DIFF_MODIFIED'		=> 'Zusammengeführte Unterschiede anzeigen',
    'SHOW_DIFF_NEW'				=> 'Dateiinhalt anzeigen',
    'SHOW_DIFF_NEW_CONFLICT'	=> 'Unterschiede anzeigen',
    'SHOW_DIFF_NOT_MODIFIED'	=> 'Unterschiede anzeigen',
    'SOME_QUERIES_FAILED'		=> 'Einige Abfragen sind fehlgeschlagen. Die Anweisungen und Fehler sind unten aufgelistet.',
    'SQL'						=> 'SQL',
    'SQL_FAILURE_EXPLAIN'		=> 'Dies ist wahrscheinlich nichts zum Sorgen. Das Update wird fortgesetzt. Sollte dies fehlschlagen, müssen Sie möglicherweise Rat in unseren Support-Foren suchen. Siehe <a href="../docs/README.html">README</a> für Details zum Erhalten von Rat.',
    'STAGE_FILE_CHECK'			=> 'Dateien überprüfen',
    'STAGE_UPDATE_DB'			=> 'Datenbank aktualisieren',
    'STAGE_UPDATE_FILES'		=> 'Dateien aktualisieren',
    'STAGE_VERSION_CHECK'		=> 'Versionsüberprüfung',
    'STATUS_CONFLICT'			=> 'Geänderte Datei verursacht Konflikte',
    'STATUS_MODIFIED'			=> 'Geänderte Datei',
    'STATUS_NEW'				=> 'Neue Datei',
    'STATUS_NEW_CONFLICT'		=> 'Neue Konflikt-Datei',
    'STATUS_NOT_MODIFIED'		=> 'Nicht geänderte Datei',
    'STATUS_UP_TO_DATE'			=> 'Bereits aktualisierte Datei',

    'TOGGLE_DISPLAY'			=> 'Dateiliste anzeigen/ausblenden',
    'TRY_DOWNLOAD_METHOD'		=> 'Sie können die Methode zum Herunterladen geänderter Dateien versuchen.<br />Diese Methode funktioniert immer und ist auch der empfohlene Aktualisierungsweg.',
    'TRY_DOWNLOAD_METHOD_BUTTON'=> 'Versuchen Sie diese Methode jetzt',

    'UPDATE_COMPLETED'				=> 'Update abgeschlossen',
    'UPDATE_DATABASE'				=> 'Datenbank aktualisieren',
    'UPDATE_DATABASE_EXPLAIN'		=> 'Im nächsten Schritt wird die Datenbank aktualisiert.',
    'UPDATE_DATABASE_SCHEMA'		=> 'Datenbankschema wird aktualisiert',
    'UPDATE_FILES'					=> 'Dateien aktualisieren',
    'UPDATE_FILES_NOTICE'			=> 'Bitte stellen Sie sicher, dass Sie auch Ihre Board-Dateien aktualisiert haben. Diese Datei aktualisiert nur Ihre Datenbank.',
    'UPDATE_INSTALLATION'			=> 'phpBB-Installation aktualisieren',
    'UPDATE_INSTALLATION_EXPLAIN'	=> 'Mit dieser Option ist es möglich, Ihre phpBB-Installation auf die neueste Version zu aktualisieren.<br />Während des Prozesses werden alle Ihre Dateien auf ihre Integrität überprüft. Sie können alle Unterschiede und Dateien vor dem Update überprüfen.<br /><br />Die Dateiaktualisierung selbst kann auf zwei verschiedene Arten durchgeführt werden.</p><h2>Manuelles Update</h2><p>Bei diesem Update laden Sie nur Ihren persönlichen Satz von geänderten Dateien herunter, um sicherzustellen, dass Sie Ihre möglicherweise vorgenommenen Dateiänderungen nicht verlieren. Nachdem Sie dieses Paket heruntergeladen haben, müssen Sie die Dateien manuell an ihre richtige Position unter Ihrem phpBB-Stammverzeichnis hochladen. Danach können Sie die Dateiprüfungsphase erneut durchführen, um zu sehen, ob Sie die Dateien an ihre richtige Position verschoben haben.</p><h2>Automatisches Update mit FTP</h2><p>Diese Methode ähnelt der ersten, erfordert jedoch nicht, dass Sie die geänderten Dateien selbst herunterladen und hochladen. Dies wird für Sie erledigt. Um diese Methode zu verwenden, müssen Sie Ihre FTP-Anmeldedaten kennen, da Sie danach gefragt werden. Nach dem Abschluss werden Sie zur Dateiprüfung weitergeleitet, um sicherzustellen, dass alles korrekt aktualisiert wurde.<br /><br />',
    'UPDATE_INSTRUCTIONS'			=> '

        <h1>Release-Ankündigung</h1>

        <p>Bitte lesen Sie <a href="%1$s" title="%1$s"><strong>die Release-Ankündigung für die neueste Version</strong></a>, bevor Sie Ihren Aktualisierungsprozess fortsetzen. Sie kann nützliche Informationen enthalten. Sie enthält auch vollständige Download-Links sowie die Änderungsprotokoll.</p>

        <br />

        <h1>So aktualisieren Sie Ihre Installation mit dem automatischen Update-Paket</h1>

        <p>Die empfohlene Methode zur Aktualisierung Ihrer Installation, die hier aufgeführt ist, ist nur für das automatische Update-Paket gültig. Sie können Ihre Installation auch mit den im INSTALL.html-Dokument aufgeführten Methoden aktualisieren. Die Schritte zur automatischen Aktualisierung von phpBB3 sind:</p>

        <ul style="margin-left: 20px; font-size: 1.1em;">
            <li>Gehen Sie zur <a href="https://www.phpbb.com/downloads/" title="https://www.phpbb.com/downloads/">phpBB.com-Download-Seite</a> und laden Sie das Archiv "Automatisches Update-Paket" herunter.<br /><br /></li>
            <li>Entpacken Sie das Archiv.<br /><br /></li>
            <li>Laden Sie das komplette unkomprimierte Install-Verzeichnis in Ihr phpBB-Stammverzeichnis hoch (wo sich Ihre config.php-Datei befindet).<br /><br /></li>
        </ul>

        <p>Nachdem Sie hochgeladen haben, ist Ihr Board für normale Benutzer offline, da das von Ihnen hochgeladene Install-Verzeichnis jetzt vorhanden ist.<br /><br />
        <strong><a href="%2$s" title="%2$s">Starten Sie jetzt den Aktualisierungsprozess, indem Sie mit Ihrem Browser auf den Install-Ordner verweisen</a>.</strong><br />
        <br />
        Sie werden dann durch den Aktualisierungsprozess geführt. Sie werden benachrichtigt, sobald das Update abgeschlossen ist.
        </p>
    ',
    'UPDATE_INSTRUCTIONS_INCOMPLETE'	=> '

        <h1>Unvollständiges Update erkannt</h1>

        <p>phpBB hat ein unvollständiges automatisches Update erkannt. Bitte stellen Sie sicher, dass Sie jeden Schritt im automatischen Update-Tool befolgt haben. Unten finden Sie den Link erneut oder gehen Sie direkt zu Ihrem Install-Verzeichnis.</p>
    ',
    'UPDATE_METHOD'					=> 'Update-Methode',
    'UPDATE_METHOD_EXPLAIN'			=> 'Sie können jetzt Ihre bevorzugte Update-Methode wählen. Mit dem FTP-Upload werden Sie mit einem Formular präsentiert, in das Sie Ihre FTP-Kontodaten eingeben müssen. Bei dieser Methode werden die Dateien automatisch an die neue Position verschoben und Sicherungen der alten Dateien erstellt, indem .bak an den Dateinamen angehängt wird. Wenn Sie die geänderten Dateien herunterladen möchten, können Sie sie später entpacken und manuell an ihre richtige Position hochladen.',
    'UPDATE_REQUIRES_FILE'			=> 'Das Update-Tool erfordert, dass die folgende Datei vorhanden ist: %s',
    'UPDATE_SUCCESS'				=> 'Update war erfolgreich',
    'UPDATE_SUCCESS_EXPLAIN'		=> 'Alle Dateien erfolgreich aktualisiert. Der nächste Schritt besteht darin, alle Dateien erneut zu überprüfen, um sicherzustellen, dass die Dateien korrekt aktualisiert wurden.',
    'UPDATE_VERSION_OPTIMIZE'		=> 'Version wird aktualisiert und Tabellen optimiert',
    'UPDATING_DATA'					=> 'Daten werden aktualisiert',
    'UPDATING_TO_LATEST_STABLE'		=> 'Datenbank wird zur neuesten stabilen Version aktualisiert',
    'UPDATED_VERSION'				=> 'Aktualisierte Version',
    'UPGRADE_INSTRUCTIONS'			=> 'Eine neue Feature-Version <strong>%1$s</strong> ist verfügbar. Bitte lesen Sie <a href="%2$s" title="%2$s"><strong>die Release-Ankündigung</strong></a>, um zu erfahren, was sie bietet und wie Sie ein Upgrade durchführen.',
    'UPLOAD_METHOD'					=> 'Upload-Methode',

    'UPDATE_DB_SUCCESS'				=> 'Datenbankupdate war erfolgreich.',
    'USER_ACTIVE'					=> 'Aktiver Benutzer',
    'USER_INACTIVE'					=> 'Inaktiver Benutzer',

    'VERSION_CHECK'					=> 'Versionsüberprüfung',
    'VERSION_CHECK_EXPLAIN'			=> 'Überprüft, ob Ihre phpBB-Installation auf dem neuesten Stand ist.',
    'VERSION_NOT_UP_TO_DATE'		=> 'Ihre phpBB-Installation ist nicht auf dem neuesten Stand. Bitte fahren Sie mit dem Aktualisierungsprozess fort.',
    'VERSION_NOT_UP_TO_DATE_ACP'	=> 'Ihre phpBB-Installation ist nicht auf dem neuesten Stand.<br />Unten ist ein Link zur Release-Ankündigung, die weitere Informationen sowie Aktualisierungsanweisungen enthält.',
    'VERSION_NOT_UP_TO_DATE_TITLE'	=> 'Ihre phpBB-Installation ist nicht auf dem neuesten Stand.',
    'VERSION_UP_TO_DATE'			=> 'Ihre phpBB-Installation ist auf dem neuesten Stand. Obwohl derzeit keine Updates verfügbar sind, können Sie fortfahren, um eine Gültigkeitsprüfung für Ihre Dateien durchzuführen.',
    'VERSION_UP_TO_DATE_ACP'		=> 'Ihre phpBB-Installation ist auf dem neuesten Stand. Es gibt derzeit keine verfügbaren Updates.',
    'VIEWING_FILE_CONTENTS'			=> 'Dateiinhalt wird angezeigt',
    'VIEWING_FILE_DIFF'				=> 'Dateieinträge werden angezeigt',

    'WRONG_INFO_FILE_FORMAT'	=> 'Falsches Informationsdateiformat',
));

// Default database schema entries...
$lang = array_merge($lang, array(
    'CONFIG_BOARD_EMAIL_SIG'		=> 'Mit freundlichen Grüßen, Die Geschäftsleitung',
    'CONFIG_SITE_DESC'				=> 'Ein kurzer Text zur Beschreibung Ihres Forums',
    'CONFIG_SITENAME'				=> 'yourdomain.com',

    'DEFAULT_INSTALL_POST'			=> 'Dies ist ein Beispielpost in Ihrer IntegraMOD-Installation. Alles scheint zu funktionieren. Sie können diesen Post löschen, wenn Sie möchten, und mit der Einrichtung Ihres Boards fortfahren. Während des Installationsprozesses werden Ihre erste Kategorie und Ihr erstes Forum mit einem passenden Berechtigungssatz für die vordefinierten Benutzergruppen Administratoren, Bots, Global Moderators, Gäste, registrierte Benutzer und registrierte COPPA-Benutzer zugewiesen. Wenn Sie auch Ihre erste Kategorie und Ihr erstes Forum löschen möchten, vergessen Sie nicht, Berechtigungen für alle diese Benutzergruppen für alle neuen Kategorien und Foren zuzuweisen, die Sie erstellen. Es wird empfohlen, Ihre erste Kategorie und Ihr erstes Forum umzubenennen und Berechtigungen von diesen zu kopieren, während Sie neue Kategorien und Foren erstellen. Viel Spaß!',

    'FORUMS_FIRST_CATEGORY'			=> 'Ihre erste Kategorie',
    'FORUMS_TEST_FORUM_DESC'		=> 'Beschreibung Ihres ersten Forums.',
    'FORUMS_TEST_FORUM_TITLE'		=> 'Ihr erstes Forum',

    'RANKS_SITE_ADMIN_TITLE'		=> 'Site-Administrator',
    'REPORT_WAREZ'					=> 'Der Post enthält Links zu illegaler oder raubkopierter Software.',
    'REPORT_SPAM'					=> 'Der gemeldete Post verfolgt nur den Zweck der Werbung für eine Website oder ein anderes Produkt.',
    'REPORT_OFF_TOPIC'				=> 'Der gemeldete Post ist off-topic.',
    'REPORT_OTHER'					=> 'Der gemeldete Post passt nicht in eine andere Kategorie. Bitte verwenden Sie das Feld für weitere Informationen.',

    'SMILIES_ARROW'					=> 'Pfeil',
    'SMILIES_CONFUSED'				=> 'Verwirrt',
    'SMILIES_COOL'					=> 'Kühl',
    'SMILIES_CRYING'				=> 'Weinen oder sehr traurig',
    'SMILIES_EMARRASSED'			=> 'Verlegen',
    'SMILIES_EVIL'					=> 'Böse oder sehr wütend',
    'SMILIES_EXCLAMATION'			=> 'Ausrufezeichen',
    'SMILIES_GEEK'					=> 'Geek',
    'SMILIES_IDEA'					=> 'Idee',
    'SMILIES_LAUGHING'				=> 'Lachen',
    'SMILIES_MAD'					=> 'Wütend',
    'SMILIES_MR_GREEN'				=> 'Herr Grün',
    'SMILIES_NEUTRAL'				=> 'Neutral',
    'SMILIES_QUESTION'				=> 'Frage',
    'SMILIES_RAZZ'					=> 'Razz',
    'SMILIES_ROLLING_EYES'			=> 'Mit den Augen rollend',
    'SMILIES_SAD'					=> 'Traurig',
    'SMILIES_SHOCKED'				=> 'Schockiert',
    'SMILIES_SMILE'					=> 'Lächeln',
    'SMILIES_SURPRISED'				=> 'Überrascht',
    'SMILIES_TWISTED_EVIL'			=> 'Verdreht böse',
    'SMILIES_UBER_GEEK'				=> 'Über Geek',
    'SMILIES_VERY_HAPPY'			=> 'Sehr glücklich',
    'SMILIES_WINK'					=> 'Zwinkern',

    'TOPICS_TOPIC_TITLE'			=> 'Willkommen bei IntegraMOD',

));

?>
