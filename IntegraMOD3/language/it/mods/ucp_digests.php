<?php
/** 
*
* ucp_digests.php [Italian]
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
	'DIGEST_ALL_FORUMS'					=> 'Tutto',
	'DIGEST_AUTHOR'						=> 'Autore',
	'DIGEST_BAD_EOL'					=> 'La fine di riveste il valore di %s è l invalido.', 
	'DIGEST_BOARD_LIMIT'				=> '%s (Imbarcarsi sul limite)',
	'DIGEST_BY'							=> 'Da',
	'DIGEST_CONNECT_SOCKET_ERROR'		=> 'Incapace per aprire il collegamento al luogo di Smartfeed di phpBB, l errore riferito è: <br />%s',
	'DIGEST_COUNT_LIMIT'				=> 'Il numero massimo di pali nel compendio',
	'DIGEST_COUNT_LIMIT_EXPLAIN'		=> 'Entrare un numero più grande di zero se lei vuole limitare il numero di pali nel compendio.',
	'DIGEST_CURRENT_VERSION_INFO'		=> 'Lei corre la versione <strong>%s</strong>.',
	'DIGEST_DAILY'						=> 'Quotidianamente',
	'DIGEST_DATE'						=> 'Data',
	'DIGEST_DISABLED_MESSAGE'			=> 'Per permettere i campi, scegliere le Basi e scegliere un tipo di compendio',
	'DIGEST_DISCLAIMER'					=> 'Questo compendio è inviato ai membri iscritti di <a href="%s">%s</a> Fori. Lei può cambiare o può cancellare la sua sottoscrizione dal <a href="%sucp.%s">Quadro dei comandi di operatore</a>. Se lei ha delle domande o la reazione sul formato di questo compendio l invia per favore al <a href="mailto:%s">%s Webmaster</a>.',
	'DIGEST_EXPLANATION'				=> 'I compendi sono i sommari di email di messaggi affissi che sono qui inviati a lei periodicamente. I compendi possono essere inviati quotidiano, settimanale o mensile a un ora del giorno che lei sceglie. Lei può specificare quei fori particolari per cui lei vuole i sommari di messaggio (sceglie la Selezione di Pali), o dalla mancanza che lei può eleggere per ricevere tutti i messaggi per tutti i fori per cui lei è consentito l accesso. Lei può, certo, annulla la sua sottoscrizione di compendio a qualunque tempo ritornando semplicemente a questa pagina. La maggior parte degli operatori trova i compendi per essere molto utili. L incoraggiamo a lo dare un prova!',
	'DIGEST_FILTER_ERROR'				=> "mail_digests.$phpEx era chiamato con un invalido user_digest_filter_type = %s",
	'DIGEST_FILTER_FOES'				=> 'Togliere i pali dai miei nemici',
	'DIGEST_FILTER_TYPE'				=> 'I tipi di pali nel compendio',
	'DIGEST_FORMAT_ERROR'				=> "mail_digests.$phpEx era chiamato con un invalido user_digest_format of %s",
	'DIGEST_FORMAT_FOOTER' 				=> 'Digerire il Formato:',
	'DIGEST_FORMAT_HTML'				=> 'HTML',
	'DIGEST_FORMAT_HTML_EXPLAIN'		=> 'HTML fornirà formatta, BBCode e le firme (se consentito). Lo Stylesheets sono applicati se il suo programma di email consente.',
	'DIGEST_FORMAT_HTML_CLASSIC'		=> 'Classico di HTML',
	'DIGEST_FORMAT_HTML_CLASSIC_EXPLAIN'	=> 'Simile a HTML eccetto i pali di soggetto sono elencato l interno di tavole',
	'DIGEST_FORMAT_PLAIN'				=> 'HTML semplice',
	'DIGEST_FORMAT_PLAIN_EXPLAIN'		=> 'HTML semplice non applica gli stili o i colori',
	'DIGEST_FORMAT_PLAIN_CLASSIC'		=> 'Il Classico di HTML semplice',
	'DIGEST_FORMAT_PLAIN_CLASSIC_EXPLAIN'	=> 'Simile a HTML Semplice eccetto i pali di soggetto sono elencato l interno di tavole',
	'DIGEST_FORMAT_STYLING'				=> 'Il compendio disegna',
	'DIGEST_FORMAT_STYLING_EXPLAIN'		=> 'Per favore di notare che il di disegnare effettivamente reso dipende dalle capacità del suo programma di email. Muovere il suo cursore sopra il disegna il tipo per imparare più di ogni stile.',
	'DIGEST_FORMAT_TEXT'				=> 'Testo',
	'DIGEST_FORMAT_TEXT_EXPLAIN'		=> 'Nessuno HTML apparirà nel compendio. Solo il testo sarà mostrato.',
	'DIGEST_FREQUENCY'					=> 'Il tipo di compendio ha voluto',
	'DIGEST_FREQUENCY_EXPLAIN'			=> "I compendi settimanali sono inviati su %s. I compendi mensili sono inviati sul primo del mese. Il Tempo universale è usato per determinare il giorno della settimana.",
	'DIGEST_INTRODUCTION' 				=> 'È qui il compendio recentissimo di messaggi affissi su %s Fori. Per favore di venire ed unire la discussione!',
	'DIGEST_LASTVISIT_RESET'			=> 'Ripristinare la mia ultima data di visita quando sono inviato un compendio',
	'DIGEST_LATEST_VERSION_INFO'		=> 'La versione recentissima disponibile è <strong>%s</strong>.',
	'DIGEST_LINK'						=> 'Maglia',
	'DIGEST_LOG_WRITE_ERROR'			=> 'Incapace per scrivere per abbattere col sentiero, il sentiero = %s. Questo è frequentemente causato dalla mancanza di pubblico scrive i permessi su questo file.',
	'DIGEST_MAIL_FREQUENCY' 			=> 'Digerire la Frequenza',
	'DIGEST_MARK_READ'					=> 'Marcare come leggere quando appaiono nel compendio',
	'DIGEST_MAX_SIZE'					=> 'Le parole massime di mostrare in un palo',
	'DIGEST_MAX_SIZE_EXPLAIN'			=> 'L avviso: Per assicurare rendere conforme, se un palo deve essere troncato, l HTML sarà tolto dal palo.',
	'DIGEST_MAX_WORDS_NOTIFIER'			=> '... ',
	'DIGEST_MIN_SIZE'					=> 'Le parole minime hanno richiesto nel palo per il palo di apparire in un compendio',
	'DIGEST_MIN_SIZE_EXPLAIN'			=> 'Se lei lascia questo spazio vuoto, questi pali col testo di qualunque numero di parole sono inclusi',
	'DIGEST_MONTHLY'					=> 'Mensilmente',
	'DIGEST_NEW'						=> 'Nuovo',
	'DIGEST_NEW_POSTS_ONLY'				=> 'Mostrare i nuovi pali solo',
	'DIGEST_NEW_POSTS_ONLY_EXPLAIN'		=> 'Questo filtrerà qualunque pali affissi prima della data e la cronometra dura ha visitata quest asse. Se lei visita l asse e legge frequentemente la maggior parte dei pali, questo terrà dei pali sovrabbondanti da apparire nel suo compendio. Potrebbe significare anche che lei mancherà dei pali nei fori che lei non hanno letto.',
	'DIGEST_NO_CONSTRAINT'				=> 'Nessuna costrizione',
	'DIGEST_NO_FORUMS_CHECKED' 			=> 'Almeno un foro deve essere controllato',
	'DIGEST_NO_LIMIT'					=> 'Nessuno limite',
	'DIGEST_NO_POSTS'					=> 'Ci sono nessuni nuovi pali.',
	'DIGEST_NO_PRIVATE_MESSAGES'		=> 'Lei ha di messaggi no nuovi o incolti privati.',
	'DIGEST_NONE'						=> 'Nessuno (annulla la sottoscrizione)',
	'DIGEST_ON'							=> 'su',
	'DIGEST_POST_TEXT'					=> 'Affiggere il Testo', 
	'DIGEST_POST_TIME'					=> 'Affiggere il Tempo', 
	'DIGEST_POST_SIGNATURE_DELIMITER'	=> '<br />____________________<br />', // Place here whatever code (make sure it is valid XHTML) you want to use to distinguish the end of a post from the beginning of the signature line
	'DIGEST_POSTS_TYPE_ANY'				=> 'Tutto affigge',
	'DIGEST_POSTS_TYPE_FIRST'			=> 'I primi pali di soggetti solo',
	'DIGEST_POWERED_BY'					=> 'Ha alimentato da',
	'DIGEST_PRIVATE_MESSAGES_IN_DIGEST'	=> 'Aggiungere i miei messaggi incolti privati',
	'DIGEST_PUBLISH_DATE'				=> 'Il compendio era specificatamente pubblicato per lei su %s',
	'DIGEST_REMOVE_YOURS'				=> 'Togliere i miei pali',
	'DIGEST_ROBOT'						=> 'Robot',
	'DIGEST_SALUTATION' 				=> 'Caro',
	'DIGEST_SELECT_FORUMS'				=> 'Includere i pali per questi fori',
	'DIGEST_SELECT_FORUMS_EXPLAIN'		=> 'Per favore di notare le categorie ed i fori mostrati sono per quei lei è consentito leggere solo. La selezione di foro è stata incapace quando lei sceglie i soggetti di bookmarked solo.',
	'DIGEST_SEND_HOUR' 					=> 'L ora ha inviato',
	'DIGEST_SEND_HOUR_EXPLAIN'			=> 'Il tempo di arrivo di compendio è il tempo basato sulla risparmio/ora legale di fuso orario e luce del giorno lei regola nelle sue preferenze di asse.',
	'DIGEST_SEND_IF_NO_NEW_MESSAGES'	=> 'Inviare il compendio se nessuni nuovi messaggi:',
	'DIGEST_SEND_ON_NO_POSTS'	 		=> 'Inviare un compendio se ci sono nessuni nuovi pali',
	'DIGEST_SHOW_MY_MESSAGES' 			=> 'Mostrare i miei pali nel compendio:',
	'DIGEST_SHOW_NEW_POSTS_ONLY' 		=> 'Mostrare i nuovi pali solo',
	'DIGEST_SHOW_PMS' 					=> 'Mostrare i miei messaggi privati',
	'DIGEST_SIZE_ERROR'					=> "Questo campo è un campo richiesto. Lei deve entrare un numero positivo intero, meno di o uguaglia al massimo consentito dall'Amministratore di Foro. Il massimo consentito è %s. Se questo valore è lo zero, non ci è limite.",
	'DIGEST_SIZE_ERROR_MIN'				=> 'Lei deve entrare un valore positivo o lascia lo spazio vuoto di campo',
	'DIGEST_SOCKET_FUNCTIONS_DISABLED'	=> 'Le funzioni di presa attualmente sono state incapace.',
	'DIGEST_SORT_BY'					=> 'Affiggere il tipo di ordinamento',
	'DIGEST_SORT_BY_ERROR'				=> "mail_digests.$phpEx era chiamato con un invalido user_digest_sortby = %s",
	'DIGEST_SORT_BY_EXPLAIN'			=> 'Tutti i compendi sono classificati dalla categoria e poi dal foro, come sono mostrati sull indice principale. Le opzioni di genere applicano a come i pali sono disposti dentro i soggetti. L Ordine tradizionale è l ordine predefinito usato dal phpBB 2, che è l ultimo tempo di palo di soggetto (discendendo) poi dal tempo di palo dentro il soggetto.',
	'DIGEST_SORT_FORUM_TOPIC'			=> 'Ordine tradizionale',
	'DIGEST_SORT_FORUM_TOPIC_DESC'		=> 'L Ordine tradizionale, i Pali Recentissimi Dapprima',
	'DIGEST_SORT_POST_DATE'				=> 'Dal più vecchio al più nuovo',
	'DIGEST_SORT_POST_DATE_DESC'		=> 'Dal più nuovo al più vecchio',
	'DIGEST_SORT_USER_ORDER'			=> 'Usare le mie preferenze di mostra di asse',
	'DIGEST_SQL_PMS'					=> 'SQL ha usato per i messaggi privati per %s: %s',
	'DIGEST_SQL_PMS_NONE'				=> 'Nessuno SQL ha emesso per private_messages per %s Perché l operatore ha optato per non di mostrare i messaggi privati nel compendio. ',
	'DIGEST_SQL_POSTS_USERS'			=> 'SQL ha usato per i pali per %s: %s',
	'DIGEST_SQL_USERS'					=> 'SQL ricuperava gli operatori prendendo dei compendi: %s',
	'DIGEST_SUBJECT_LABEL'				=> 'Soggetto',
	'DIGEST_SUBJECT_TITLE'				=> '%s %s Compendio',
	'DIGEST_TIME_ERROR'					=> "mail_digests.$phpEx calcolato un compendio cattivo invia l'ora di %s",
	'DIGEST_TOTAL_POSTS'				=> 'I pali totali in questo compendio:',
	'DIGEST_TOTAL_UNREAD_PRIVATE_MESSAGES'	=> 'Messaggi totali, incolti privati:',
	'DIGEST_UNREAD'						=> 'Incolto',
	'DIGEST_UPDATED'					=> 'I suoi montaggi di compendio erano risparmiati',
	'DIGEST_USE_BOOKMARKS'				=> 'I soggetti di Bookmarked solo',
	'DIGEST_VERSION_NOT_UP_TO_DATE'		=> 'L Avviso di amministratore: questa versione di Compendi di phpBB non è attuale. Gli aggiornamenti sono disponibili sul <a href="%s">Digere il sito web</a>.',
	'DIGEST_VERSION_UP_TO_DATE'			=> 'Questa versione di Compendi di phpBB è up-to-date, nessuno aggiornamento disponibile.',
	'DIGEST_WEEKDAY' => array(
		0	=> 'Domenica',
		1 	=> 'Lunedì',
		2	=> 'Martedì',
		3	=> 'Mercoledì',
		4	=> 'Giovedì',
		5	=> 'Venerdì',
		6	=> 'Sabato'),
	'DIGEST_WEEKLY'						=> 'Settimanalmente',
	'DIGEST_YOU_HAVE_PRIVATE_MESSAGES' 	=>	'Lei ha dei messaggi privati',
	'DIGEST_YOUR_DIGEST_OPTIONS' 		=> 'Le sue opzioni di compendio:',
	'S_DIGEST_TITLE'					=> (isset($config['digests_digests_title'])) ? $config['digests_digests_title'] : 'phpBB Digests',
	'UCP_DIGESTS_MODE_ERROR'			=> 'I compendi era chiamato con un modo di invalido di %s',
				
));
			
?>