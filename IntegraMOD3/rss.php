<?php
/**
*
* @package phpBB3
* @version $Id$
* @copyright (c) 2008 Manchumahara(Sabuj Kundu)
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/

define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);


//Get the board url address
$board_url = generate_board_url();

// Start RSS output
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-type: application/rss+xml; charset=UTF-8");
header("Content-Disposition: inline; filename=Portal.xml");

print '<?xml version="1.0" encoding="UTF-8"?>'."\r\n";
print '<rss version="2.0"'."\n";
print 'xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
	xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
	xmlns:admin="http://webns.net/mvcb/"
	xmlns:atom="http://www.w3.org/2005/Atom"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:ev="http://purl.org/rss/1.0/modules/event/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"

	>'."\r\n";

print '<channel>'."\n";
print '<atom:link href="'.$board_url.'/rss.'.$phpEx.'" rel="self" type="application/rss+xml"/>'."\r\n";
print '<title>'.$config['sitename'].' - Calendar</title>'."\r\n";
print '<link>'.$board_url.'/calendar.'.$phpEx.'</link>'."\r\n";
print '<description>'.$config['site_desc'].'</description>'."\r\n";
print '<language>'.$config['default_lang'].'</language>'."\r\n";
print '<copyright>(c) Copyright by '.$config['sitename'].'</copyright>'."\r\n";
print '<managingEditor>'.$config['board_email'].'('.$config['sitename'].' Admin)</managingEditor>'."\r\n";
print '<generator>Stargate Portal</generator>'."\r\n";
print '<ttl>1</ttl>'."\r\n";

//Get plain events
 $sql = 'SELECT * FROM ' . CALENDAR_TABLE;
 $result = $db->sql_query($sql);
    if(!($result = $db->sql_query($sql)))
    {
	trigger_error('Could not get Events.', E_USER_ERROR);
    }
    else
    {
      $i = 0;
      while($prow = $db->sql_fetchrow($result))
      {
		$prow['bbcode_options'] =    (($prow['enable_bbcode']) ? OPTION_FLAG_BBCODE : 0) +
                                     (($prow['enable_smilies']) ? OPTION_FLAG_SMILIES : 0) +
                                     (($prow['enable_magic_url']) ? OPTION_FLAG_LINKS : 0);
		$clean_text = generate_text_for_display($prow['event_desc'], $prow['bbcode_uid'], $prow['bbcode_bitfield'], $prow['bbcode_options']);
		$rss1[$i]['DescDump'] = html_entity_decode($clean_text);
		$rss1[$i]['Name'] = $prow['event_name'];
		$rss1[$i]['rss1Start'] = gmdate("Ymd\THi00", $prow['event_start_time']);
		$rss1[$i]['rss1End'] =  gmdate("Ymd\THi00", $prow['event_end_time']);

		print '<item>'."\r\n";
		print '<title>'.$rss1[$i]['Name'].''."</title>\r\n";
		print '<ev:startdate>'.$rss1[$i]['rss1Start'].'</ev:startdate>'."\n";
		print '<ev:enddate>'.$rss1[$i]['rss1End'].'</ev:enddate>'."\n";
		print '<link>'.$phpbb_root_path.'calendar.'.$phpEx.'?mode=view'."</link>\r\n";
		print '<author>'."</author>\r\n";
		print '<category>'."</category>\r\n";
		print '<pubDate>'."</pubDate>\n";
		print '<description>'.$rss1[$i]['DescDump'].''."</description>\r\n";
		print '<ev:location>'."</ev:location>\n";
		print '</item>'."\r\n";
		  $i++;
      }
  	}
  	//Get Topic Events
 $sql = "SELECT *
 FROM phpbb_topics AS t
 INNER JOIN phpbb_posts p
 ON t.topic_first_post_id = p.post_id
 WHERE t.topic_status <> 2";
 $result = $db->sql_query($sql);
    if(!($result = $db->sql_query($sql)))
    {
	trigger_error('Could not get Topics Events.', E_USER_ERROR);
    }
    else
    {
      $i = 0;
      while($trow = $db->sql_fetchrow($result))
      {
	  $trow['bbcode_options'] =    (($trow['enable_bbcode']) ? OPTION_FLAG_BBCODE : 0) +
                                     (($trow['enable_smilies']) ? OPTION_FLAG_SMILIES : 0) +
                                     (($trow['enable_magic_url']) ? OPTION_FLAG_LINKS : 0);
 		$t_clean_text =  generate_text_for_display($trow['post_text'], $trow['bbcode_uid'], $trow['bbcode_bitfield'], $trow['bbcode_options']);
		$rss2[$i]['DescDump'] = html_entity_decode($t_clean_text);
		$rss2[$i]['Name'] = $trow['topic_title'];
		$rss2[$i]['rss2Start'] = gmdate("Ymd\THi00", $trow['topic_calendar_time']);
		$rss2[$i]['rss2End'] = gmdate("Ymd\THi00", $trow['topic_calendar_time'] + $trow['topic_calendar_duration']);
		$rss2[$i]['rss2PubDate'] = gmdate("Ymd\THi00", $trow['topic_time']);
		print '<item>'."\r\n";
		print '<title>'.$rss2[$i]['Name'].''."</title>\r\n";
		print '<ev:startdate>'.$rss2[$i]['rss2Start'].'</ev:startdate>'."\n";
		print '<ev:enddate>'.$rss2[$i]['rss2End'].'</ev:enddate>'."\n";
		print '<link>'.$phpbb_root_path.'calendar.'.$phpEx.'?mode=view'."</link>\r\n";
		print '<author>'."</author>\r\n";
		print '<category>'."</category>\r\n";
		print '<pubDate>'.$rss2[$i]['rss2PubDate'].'</pubDate>'."\n";
		print '<description>'.$rss2[$i]['DescDump'].''."</description>\r\n";
		print '<ev:location>'."</ev:location>\n";
		print '</item>'."\r\n";
	  $i++;
      }
  	}
  	$db->sql_freeresult($result);


print '</channel>'."\n";
print '</rss>'."\n";

?>
