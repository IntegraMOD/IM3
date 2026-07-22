<?php
/** 
*
* integramod3 [Dutch]
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
    'INTEGRAMOD3_TITLE'	        => 'IntegraMOD3 overzicht',
    'INTEGRAMOD3_SUPPORT_BODY'	=> 'Volledige ondersteuning wordt gegeven op het <a href="http://www.integramod.com/forum/index.php?c=6" title="IntegraMOD3 Dev Site" target="_new"><b>IntegraMOD3 Development Forum</b></a>. We zullen antwoorden geven op algemene setup vragen, configuratieproblemen, en ondersteuning bieden voor het bepalen van veelvoorkomende problemen.</p><p>Bezoek zeker ons <a href="http://www.integramod.com" title="IntegraMOD" target="_new"><b>IntegraMOD</b></a> thuisforum.</p><p>Je zou je moeten <a href="http://www.integramod.com/forum/profile.php?mode=profil&sub=profile_prefer&mod=0" title="Register at IntegraMOD" target="_new"><b>registreren</b></a>, inloggen en je abonneren op de <a href="http://www.integramod.com/forum/im3-news-f67.html" target="_new"><b>IM3 Nieuws </b></a>thread om per e-mail of PM op de hoogte te worden gesteld van elke update.',
    'INTEGRAMOD3_BODY'	        => 'Welkom bij de Alpha release van IntegraMOD3.</p><p>Lees <a href="http://www." title="Check the release thread" target="_new"><b>de IM3 dev thread</b></a> voor meer informatie</p><p><strong style="text-transform: uppercase;">Let op:</strong> IM3 bevat drie phpBB3 SEO mod rewrite versies. Je kunt er een van kiezen.<br/><br/><b>De drie verschillende URL rewriting standaarden beschikbaar :</b><ul><li><a href="http://www.phpbb-seo.com/boards/simple-seo-url/simple-phpbb3-seo-url-vt1566.html" title="More details about the Simple mod"><b>De Simple mod</b></a>,</li><li><a href="http://www.phpbb-seo.com/boards/mixed-seo-url/mixed-phpbb3-seo-url-vt1565.html" title="More details about the Mixed mod"><b>De Mixed mod</b></a>,</li><li><a href="http://www.phpbb-seo.com/boards/advanced-seo-url/advanced-phpbb3-seo-url-vt1219.html" title="More details about the Advanced mod"><b>Advanced</b></a>.</li></ul>Deze keuze is erg belangrijk, we moedigen je aan de tijd te nemen om de SEO-functies van deze premod volledig te ontdekken voordat je online gaat.<br/>Deze premod is net zo eenvoudig te installeren als phpBB3, volg gewoon het reguliere proces.<br/><br/>
              <p>Vereisten voor URL rewriting :</p>
                <ul>
                  <li>Apache server (linux OS) met mod_rewrite module.</li>
                  <li>IIS server (windows OS) met isapi_rewrite module, maar je zult de rewriterules in de httpd.ini moeten aanpassen</li>
                </ul>
              <p>Eenmaal geïnstalleerd, moet je naar de ACP gaan om de mod in te stellen en te activeren.</p>
              <p>Voor een volledige lijst van mods die zijn opgenomen in IntegraMOD3, lees de <a href="http://www.integramod.com/IntegraMOD/" title="IntegraMOD3 Included Mods" target="_new"><b>IntegraMOD3 Development</b></a> thread.</p>',
));
