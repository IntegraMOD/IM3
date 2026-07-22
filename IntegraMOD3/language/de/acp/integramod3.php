<?php
/** 
*
* integramod3 [German]
*
* @package phpbb_seo
* @version $Id: integramod.php, 05/05/2008 13:48:48 fds Exp $
* @copyright (c) 2007 IntegraTeam
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

$lang = array_merge($lang, array(

    'IM3'                       => 'IntegraMOD3',
    'IMTEAM'                    => 'IntegraTeam',
    'INTEGRAMOD3_TITLE'	        => 'IntegraMOD3 Übersicht',
    'INTEGRAMOD3_SUPPORT_BODY'	=> 'Vollständige Unterstützung wird im <a href="http://www.integramod.com/forum/index.php?c=6" title="IntegraMOD3 Dev Site" target="_new"><b>IntegraMOD3 Development Forum</b></a> gegeben. Wir werden Antworten auf allgemeine Setup-Fragen, Konfigurationsprobleme und Unterstützung zur Bestimmung häufiger Probleme bereitstellen.</p><p>Besuche sicher unsere <a href="http://www.integramod.com" title="IntegraMOD" target="_new"><b>IntegraMOD</b></a> Home-Foren.</p><p>Du solltest dich <a href="http://www.integramod.com/forum/profile.php?mode=profil&sub=profile_prefer&mod=0" title="Register at IntegraMOD" target="_new"><b>registrieren</b></a>, einloggen und den <a href="http://www.integramod.com/forum/im3-news-f67.html" target="_new"><b>IM3 News </b></a>Thread abonnieren, um per E-Mail oder PN über jedes Update benachrichtigt zu werden.',
    'INTEGRAMOD3_BODY'	        => 'Willkommen bei der Alpha-Version von IntegraMOD3.</p><p>Bitte lies den <a href="http://www." title="Check the release thread" target="_new"><b>IM3 Dev Thread</b></a> für weitere Informationen</p><p><strong style="text-transform: uppercase;">Hinweis:</strong> IM3 enthält drei phpBB3 SEO Mod Rewrite-Versionen. Du kannst eine davon wählen.<br/><br/><b>Die drei verschiedenen URL-Rewriting-Standards verfügbar :</b><ul><li><a href="http://www.phpbb-seo.com/boards/simple-seo-url/simple-phpbb3-seo-url-vt1566.html" title="More details about the Simple mod"><b>Die Simple Mod</b></a>,</li><li><a href="http://www.phpbb-seo.com/boards/mixed-seo-url/mixed-phpbb3-seo-url-vt1565.html" title="More details about the Mixed mod"><b>Die Mixed Mod</b></a>,</li><li><a href="http://www.phpbb-seo.com/boards/advanced-seo-url/advanced-phpbb3-seo-url-vt1219.html" title="More details about the Advanced mod"><b>Advanced</b></a>.</li></ul>Diese Wahl ist sehr wichtig, wir empfehlen dir, dir die Zeit zu nehmen, die SEO-Funktionen dieser Premod vollständig zu entdecken, bevor du online gehst.<br/>Diese Premod ist genauso einfach zu installieren wie phpBB3, folge einfach dem regulären Prozess.<br/><br/>
              <p>Voraussetzungen für URL-Rewriting :</p>
                <ul>
                  <li>Apache Server (Linux OS) mit mod_rewrite Modul.</li>
                  <li>IIS Server (Windows OS) mit isapi_rewrite Modul, aber du musst die Rewrite-Regeln in der httpd.ini anpassen</li>
                </ul>
              <p>Nach der Installation musst du ins ACP gehen, um die Mod einzurichten und zu aktivieren.</p>
              <p>Für eine vollständige Liste der in IntegraMOD3 enthaltenen Mods lies den <a href="http://www.integramod.com/IntegraMOD/" title="IntegraMOD3 Included Mods" target="_new"><b>IntegraMOD3 Development</b></a> Thread.</p>',
));
