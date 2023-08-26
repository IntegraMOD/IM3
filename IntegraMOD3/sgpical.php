<?php
define('IN_PHPBB', true);
if (!defined('IN_PHPBB'))
{
	die("Hacking attempt");
}
$phpbb_root_path = './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.'.$phpEx);

header("Content-Type: text/Calendar");
header("Content-Disposition: inline; filename=Portal.ics");
echo "BEGIN:VCALENDAR\r\n";
//echo "VERSION:2.0\r\n";
echo "PRODID:Stargate Portal\r\n";
echo "X-WR-CALNAME:SGP Web Calendar\r\n";
echo "TZ:-07\r\n";
echo "METHOD:PUBLISH\r\n";
echo "UID:".rand()."\r\n";
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
		$ical[$i]['DescDump'] = str_replace(array("\r\n","\r",'<p>','<P>','<BR>','<br>'), "\\n",$clean_text);
		//$ical[$i]['Location'] = $prow['event_location'];
		$ical[$i]['Name'] = $prow['event_name'];
		$ical[$i]['iCalStart'] = date("Ymd\THi00", $prow['event_start_time']);
		$ical[$i]['iCalEnd'] = date("Ymd\THi00", $prow['event_end_time']);
		$iCalNow = date("Ymd\THi00");
		echo "BEGIN:VEVENT\r\n";
		echo "DTSTART:".$ical[$i]['iCalStart']."Z\r\n";
		echo "DTEND:".$ical[$i]['iCalEnd']."Z\r\n";
		echo "TRANSP:OPAQUE\r\n";
		# SEQUENCE:0
		# echo "DTSTAMP:".$iCalNow."Z\r\n";
		echo "DESCRIPTION:".$ical[$i]['DescDump']."\r\n";
		echo "SUMMARY:".$ical[$i]['Name']."\r\n";
		echo "PRIORITY:1\r\n";
		echo "X-MICROSOFT-CDO-IMPORTANCE:2\r\n";
		echo "CLASS:PUBLIC\r\n";
		echo "BEGIN:VALARM\r\n";
		echo "TRIGGER:-PT60M\r\n";
		echo "ACTION:DISPLAY\r\n";
		echo "DESCRIPTION:Reminder\r\n";
		echo "END:VALARM\r\n";
		echo "END:VEVENT\r\n";
	  $i++;
      }
  	}
  	$db->sql_freeresult($result);
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
		$icalt[$i]['DescDump'] = str_replace(array("\r\n","\r",'<p>','<P>','<BR>','<br>'), "\\n",$t_clean_text);
		//$icalt[$i]['Location'] = $trow['event_location'];
		$icalt[$i]['Name'] = $trow['topic_title'];
		$icalt[$i]['iCalStart'] = date("Ymd\THi00", $trow['topic_calendar_time']);
		$icalt[$i]['iCalEnd'] = date("Ymd\THi00", $trow['topic_calendar_time'] + $trow['topic_calendar_duration']);
		$iCalNowT = date("Ymd\THi00");
		echo "BEGIN:VEVENT\r\n";
		echo "DTSTART:".$icalt[$i]['iCalStart']."Z\r\n";
		echo "DTEND:".$icalt[$i]['iCalEnd']."Z\r\n";
		echo "TRANSP:OPAQUE\r\n";
		# SEQUENCE:0
		# echo "DTSTAMP:".$iCalNowT."Z\r\n";
		echo "DESCRIPTION:".$icalt[$i]['DescDump']."\r\n";
		echo "SUMMARY:".$icalt[$i]['Name']."\r\n";
		echo "PRIORITY:1\r\n";
		echo "X-MICROSOFT-CDO-IMPORTANCE:2\r\n";
		echo "CLASS:PUBLIC\r\n";
		echo "BEGIN:VALARM\r\n";
		echo "TRIGGER:-PT60M\r\n";
		echo "ACTION:DISPLAY\r\n";
		echo "DESCRIPTION:Reminder\r\n";
		echo "END:VALARM\r\n";
		echo "END:VEVENT\r\n";
	  $i++;
      }
  	}
  	$db->sql_freeresult($result);

echo "END:VCALENDAR\r\n";
?>