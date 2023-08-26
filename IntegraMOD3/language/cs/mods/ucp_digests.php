<?php
/** 
*
* ucp_digests.php [English]
*
* @package language
* @version $Id: v3_modules.xml 52 2007-12-09 19:45:45Z jelly_doughnut $
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
		
global $config;
				
$lang = array_merge($lang, array(
	'DIGEST_ALL_FORUMS'					=> 'Všechny',
	'DIGEST_AUTHOR'						=> 'Autor',
	'DIGEST_BOARD_LIMIT'				=> '%s (Limit fóra)',
	'DIGEST_BY'							=> 'Od',
	'DIGEST_CONNECT_SOCKET_ERROR'		=> 'Nemohu navázat spojení se stránkou phpBB Smartfeed, chyba je:<br />%s',
	'DIGEST_COUNT_LIMIT'				=> 'Maximální počet zpráv v souhrnu',
	'DIGEST_COUNT_LIMIT_EXPLAIN'		=> 'Pokud chceze omezit počet příspěvků v souhrnu, vložte číslo větší než nula.',
	'DIGEST_CURRENT_VERSION_INFO'		=> 'Vaše verze Souhrnu e-mailem (Digests): <strong>%s</strong>.',
	'DIGEST_DAILY'						=> 'Denně',
	'DIGEST_DATE'						=> 'Datum',
	'DIGEST_DISABLED_MESSAGE'			=> 'Pokud chcete zaktivovat tato políčka, vyberte sekci "Základní" a vyberte typ souhrnu.',
	'DIGEST_DISCLAIMER'					=> 'Tento souhrn je zaslán registrovaným členům fóra <a href="%s">%s</a>. Zasílání souhrnu e-mailem můžete vypnout nebo upravit nastavení v <a href="%sucp.%s">Uživatelském panelu</a>. Máte-li nějaké dotazy či připomínky k souhrnům, obraťe se na <a href="mailto:%s">%s správce fóra</a>.',
	'DIGEST_EXPLANATION'				=> 'Souhrny e-mailem jsou emailové souhrny příspěvků z fóra, zasílané v pravidelných intervalech. Mohou být zasílány denně, týdně či měsíčně ve vámi zadanou hodinu. Můžete si vybrat fóra, která mají být v souhrnu zahrnuta nebo si nechat zasalat příspěvky ze všech fór, do kterých máte přístup. Můžete samozřejmě kdykoliv zasílání zrušit. Mnoho uživatelů shledává souhrny velmi užitečnými. Určitě je také vyzkoušejte!',
	'DIGEST_FILTER_ERROR'				=> "mail_digests.$phpEx byl zavolán s neplatným user_digest_filter_type = %s",
	'DIGEST_FILTER_FOES'				=> 'Neposílat příspěvky mých nepřátel',
	'DIGEST_FILTER_TYPE'				=> 'Typ příspěvků v souhrnu',
	'DIGEST_FORMAT_ERROR'				=> "mail_digests.$phpEx byl zavolán s neplatným user_digest_format of %s",
	'DIGEST_FORMAT_FOOTER' 				=> 'Formát souhrnu:',
	'DIGEST_FORMAT_HTML'				=> 'HTML',
	'DIGEST_FORMAT_HTML_EXPLAIN'		=> 'HTML obsahuje formátování, BBCode a podpisy (pokud jsou povoleny). Pokud to váš emailový klient umožňuje, použije se styl vzhledu fóra.',
	'DIGEST_FORMAT_HTML_CLASSIC'		=> 'HTML Klasik',
	'DIGEST_FORMAT_HTML_CLASSIC_EXPLAIN'	=> 'Podobně jako HTML, jen témata jsou zobrazena v tabulkách',
	'DIGEST_FORMAT_PLAIN'				=> 'Prosté HTML',
	'DIGEST_FORMAT_PLAIN_EXPLAIN'		=> 'Prosté HTML nezobrazuje styly a barvy',
	'DIGEST_FORMAT_PLAIN_CLASSIC'		=> 'Prosté HTML Klasik',
	'DIGEST_FORMAT_PLAIN_CLASSIC_EXPLAIN'	=> 'Podobně jako prosté HTML, pouze jsou témata v tabulkách',
	'DIGEST_FORMAT_STYLING'				=> 'Formát souhrnu',
	'DIGEST_FORMAT_STYLING_EXPLAIN'		=> 'Upozornění - výsledný vzhled záleží také na schopnostech a nastavení vašeho emailového klienta. Najedete-li ukazatelem myši nad formát, zobrazí se jeho popis.',
	'DIGEST_FORMAT_TEXT'				=> 'Text',
	'DIGEST_FORMAT_TEXT_EXPLAIN'		=> 'Zobrazí jen prostý text, bez HTML formátování.',
	'DIGEST_FREQUENCY'					=> 'Frekvence zasílání',
	'DIGEST_FREQUENCY_EXPLAIN'			=> "Den pro zasílání týdenních souhrnů: %s. Měsíční se posílají vždy prvního v měsíci. Pro určení dne v týdnu se používá GMT čas (nulový posun).",
	'DIGEST_INSTALL_MOD_CONFIRM'		=> 'Ano, chci nainstalovat Souhrn emailem (phpBB Digests)',
	'DIGEST_INTRODUCTION' 				=> 'Zde je souhrn nejnovějších příspěvků zaslaných do fóra %s. Buďte vítáni a zapojte se do diskuze!',
	'DIGEST_LASTVISIT_RESET'			=> 'Označit čas zaslání souhrnu jako datum mé poslední návštěvy na fóru',
	'DIGEST_LATEST_VERSION_INFO'		=> 'Nejnovější dostupná verze je <strong>%s</strong>.',
	'DIGEST_LINK'						=> 'Odkaz',
	'DIGEST_MAIL_FREQUENCY' 			=> 'Frekvence zasílání',
	'DIGEST_MARK_READ'					=> 'Označit příspěvky jako přečtené, když jsou mi zaslány v souhrnu',
	'DIGEST_MAX_SIZE'					=> 'Maximální počet slov z příspěvku',
	'DIGEST_MAX_SIZE_EXPLAIN'			=> 'Upozornění: Aby nedošlo k chybě formátování, tak se v případě krácení HTML formátování z příspěvku odstraní. Chcete-li zobrazit příspěvek celý, nechte políčko prázdné. Políčko ignorováno, pokud je nastavena volna "Vůbec nezobrazovat text příspěvků".',
	'DIGEST_MAX_WORDS_NOTIFIER'			=> '... ',
	'DIGEST_MIN_SIZE'					=> 'Minimální počet slov, aby se příspěvek zobrazil v souhrnu',
	'DIGEST_MIN_SIZE_EXPLAIN'			=> 'Necháte-li pole volné, zahrnou se všechny příspěvky bez ohledu na délku',
	'DIGEST_MONTHLY'					=> 'Měsíčně',
	'DIGEST_NEW'						=> 'Nové',
	'DIGEST_NEW_POSTS_ONLY'				=> 'Zobrazit jen nové příspěvky',
	'DIGEST_NEW_POSTS_ONLY_EXPLAIN'		=> 'Toto odfiltruje všechny příspěvky, které byly zaslány před časem vaší poslední návštěvy fóra. Pokud navštěvujete fórum často a čtete většinu příspěvků, zamezíte zahrnutí vámi již přečtených příspěvků. Můžete tím ale také vynechat příspěvky, které jste ještě nečetl.',
	'DIGEST_NO_CONSTRAINT'				=> 'Bez omezení',
	'DIGEST_NO_FORUMS_CHECKED' 			=> 'Musíte zaškrtnout alespoň jedno fórum',
	'DIGEST_NO_LIMIT'					=> 'Bez limitu',
	'DIGEST_NO_POSTS'					=> 'Nejsou žádné nové příspěvky.',
	'DIGEST_NO_POST_TEXT'				=> 'Vůbec nezobrazovat text příspěvků',
	'DIGEST_NO_PRIVATE_MESSAGES'		=> 'Nemáte žádné nové ani nepřečtené soukromé zprávy.',
	'DIGEST_NONE'						=> 'Žádné (neposílat)',
	'DIGEST_ON'							=> 'dne',
	'DIGEST_POST_TEXT'					=> 'Text příspěvku', 
	'DIGEST_POST_TIME'					=> 'Čas příspěvku', 
	'DIGEST_POST_SIGNATURE_DELIMITER'	=> '<br />____________________<br />', // Place here whatever code (make sure it is valid XHTML) you want to use to distinguish the end of a post from the beginning of the signature line
	'DIGEST_POSTS_TYPE_ANY'				=> 'Všechny příspěvky',
	'DIGEST_POSTS_TYPE_FIRST'			=> 'Z každého fóra jen jeden příspěvek',
	'DIGEST_POWERED_BY'					=> 'Používáte',
	'DIGEST_PRIVATE_MESSAGES_IN_DIGEST'	=> 'Přidat mé nepřečtené soukromé zprávy',
	'DIGEST_PUBLISH_DATE'				=> 'Souhrn vytvořený přímo pro vás: %s',
	'DIGEST_REMOVE_YOURS'				=> 'Vynechat mé příspěvky',
	'DIGEST_ROBOT'						=> 'Robot',
	'DIGEST_SALUTATION' 				=> 'Milá/Milý',
	'DIGEST_SELECT_FORUMS'				=> 'Zahrnout příspěvky z těchto fór',
	'DIGEST_SELECT_FORUMS_EXPLAIN'		=> 'Zde jsou zobrazena jen ta fóra, ke kterým máte oprávnění číst. Výběr fór není dostupný, pokud jste zvolili odběr pouze témat v záložkách.',
	'DIGEST_SEND_HOUR' 					=> 'Hodina posílání',
	'DIGEST_SEND_HOUR_EXPLAIN'			=> 'Čas odesílání příspěvků je přizpůsoben vaší časové zóně a letnímu či zimnímu času podle vašeho nastavení ve fóru.',
	'DIGEST_SEND_IF_NO_NEW_MESSAGES'	=> 'Poslat souhrn i pokud nejsou žádné nové nové zprávy:',
	'DIGEST_SEND_ON_NO_POSTS'	 		=> 'Poslat souhrn i pokud nejsou žádné nové příspěvky',
	'DIGEST_SHOW_MY_MESSAGES' 			=> 'Zobrazit mé příspěvky v souhrnu:',
	'DIGEST_SHOW_NEW_POSTS_ONLY' 		=> 'Zobrazit jen nové zprávy',
	'DIGEST_SHOW_PMS' 					=> 'Zobrazit mé soukromé zprávy',
	'DIGEST_SIZE_ERROR'					=> "Toto políčko je povinné. Musíte zadat celé kladné číslo, nejvíce však: %s. Je-li hodnota 0, není limit administrátorem omezen.",
	'DIGEST_SIZE_ERROR_MIN'				=> 'Musíte zadat číslo větší než nula nebo políčko ponechat prázdné',
	'DIGEST_SOCKET_FUNCTIONS_DISABLED'	=> 'Síťové funkce jsou momentálně nedostupné.',
	'DIGEST_SORT_BY'					=> 'Třídění příspěvků',
	'DIGEST_SORT_BY_ERROR'				=> "mail_digests.$phpEx byl zavolán se špatným user_digest_sortby = %s",
	'DIGEST_SORT_BY_EXPLAIN'			=> 'Všechny příspěvky jsou seřazeny podle kategorií a fór, stejně jako na hlavní stránce fóra. Třídění ovlivní pořadí příspěvků v rámci témat. Tradiční pořadí je podle phpBB 2, kde je kritériem řazení témat čas nejnovějšího příspěvku v tématu a pak čas příspěvků v rámci tématu (od nejnovějšího).',
	'DIGEST_SORT_FORUM_TOPIC'			=> 'Tradiční pořadí',
	'DIGEST_SORT_FORUM_TOPIC_DESC'		=> 'Tradiční pořadí, nejnovější příspěvek nahoře',
	'DIGEST_SORT_POST_DATE'				=> 'Od nejstaršího',
	'DIGEST_SORT_POST_DATE_DESC'		=> 'Od nejnovějšího',
	'DIGEST_SORT_USER_ORDER'			=> 'Použít mé nastavení fóra',
	'DIGEST_SQL_PMS'					=> 'SQL použité pro soukromé zprávy uživatele %s: %s',
	'DIGEST_SQL_PMS_NONE'				=> 'Žádné SQL nebylo vytvořeno pro soukromé zprávy, protože %s si je v nastavení nevyžádal.',
	'DIGEST_SQL_POSTS_USERS'			=> 'SQL použité pro výběr příspěvků uživatele %s: %s',
	'DIGEST_SQL_USERS'					=> 'SQL použité k výběru uživatelů odebírající souhrny: %s',
	'DIGEST_SUBJECT_LABEL'				=> 'Předmět',
	'DIGEST_SUBJECT_TITLE'				=> '%s %s Souhrn e-mailem',
	'DIGEST_TIME_ERROR'					=> "mail_digests.$phpEx spočetl špatnou hodinu odeslání: %s",
	'DIGEST_TOTAL_POSTS'				=> 'Celkový počet příspěvků v souhrnu:',
	'DIGEST_TOTAL_UNREAD_PRIVATE_MESSAGES'	=> 'Celkem nepřečtených soukromých zpráv:',
	'DIGEST_UNREAD'						=> 'Nepřečtené',
	'DIGEST_UPDATED'					=> 'Vaše nastavení pro Souhrny e-mailem bylo uloženo.',
	'DIGEST_USE_BOOKMARKS'				=> 'Jen témata v záložkách',
	'DIGEST_VERSION_NOT_UP_TO_DATE'		=> 'Upozornění pro administrátora: tato verze phpBB Digests (Souhrny e-mailem) není aktuální. Aktualizace jsou k dispozici na <a href="%s">www stránkách Digests</a>.',
	'DIGEST_VERSION_UP_TO_DATE'			=> 'Tato verze je aktuální, není k dispozici žádná novější verze.',
	'DIGEST_WEEKDAY' => array(
		0	=> 'Neděle',
		1	=> 'Pondělí',
		2	=> 'Úterý',
		3	=> 'Středa',
		4	=> 'Čtvrtek',
		5	=> 'Pátek',
		6	=> 'Sobota'),
	'DIGEST_WEEKLY'						=> 'Týdně',
	'DIGEST_YOU_HAVE_PRIVATE_MESSAGES' 	=>	'Máte soukromé zprávy.',
	'DIGEST_YOUR_DIGEST_OPTIONS' 		=> 'Vaše nastavení souhrnů:',
	'S_DIGEST_TITLE'					=> (isset($config['digests_digests_title'])) ? $config['digests_digests_title'] : 'Souhrn e-mailem',
	'UCP_DIGESTS_MODE_ERROR'			=> 'Souhrny e-mailem byly zavolány v neplatném módu: %s',
));

?>
