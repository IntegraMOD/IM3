<?php
define('IN_PHPBB', true);
if (!defined('IN_PHPBB'))
{
	die("Hacking attempt");
}
$phpbb_root_path = './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.'.$phpEx);

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Type: application/unknown");
header("Content-Disposition: inline; filename=Portal.csv");
header("Content-Transfer-Encoding: binary");

echo('"Subject","Start Date","Start Time","End Date","End Time","All day event",'.
	   '"Location","Description"'."\r\n");
$quote = '"';
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
		$ical[$i]['DescDump'] = str_replace(array("\r\n","\r",'<p>','<P>','<br>','<BR>','<br />','<BR />'), "\r\n",$clean_text);
		//$ical[$i]['Location'] = $prow['event_location'];
		$ical[$i]['Name'] = $prow['event_name'];
		$ical[$i]['iDateStart'] = gmdate("Y-n-j", $prow['event_start_time']);
		$ical[$i]['iDateEnd'] =  gmdate("Y-n-j", $prow['event_end_time']);
		$ical[$i]['iCalStart'] = gmdate("g:i:00 A", $prow['event_start_time']);
		$ical[$i]['iCalEnd'] =  gmdate("g:i:00 A", $prow['event_end_time']);
		$iCalNow = date("Ymd\THi00");
		echo "$quote".$ical[$i]['Name']."$quote,";
		echo "$quote".$ical[$i]['iDateStart']."$quote,";
		echo "$quote".$ical[$i]['iCalStart']."$quote,";
		echo "$quote".$ical[$i]['iDateEnd']."$quote,";
		echo "$quote".$ical[$i]['iCalEnd']."$quote,";
		// echo all day
		echo "$quote";
		echo "$quote,";
		//echo location
		echo "$quote";
		echo "$quote,";
		echo "$quote".$ical[$i]['DescDump']."$quote\r\n";

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
		$icalt[$i]['DescDump'] = str_replace(array("\r\n","\r",'<p>','<P>','<br>','<BR>','<br />','<BR />'), "\r\n",$t_clean_text);
		//$icalt[$i]['Location'] = $trow['event_location'];
		$icalt[$i]['Name'] = $trow['topic_title'];
		$icalt[$i]['iDateStart'] = gmdate("Y-n-j", $trow['topic_calendar_time']);
		$icalt[$i]['iDateEnd'] =  gmdate("Y-n-j", $trow['topic_calendar_time'] + $trow['topic_calendar_duration']);
		$icalt[$i]['iCalStart'] = gmdate("g:i:00 A", $trow['topic_calendar_time']);
		$icalt[$i]['iCalEnd'] = gmdate("g:i:00 A", $trow['topic_calendar_time'] + $trow['topic_calendar_duration']);
		$iCalNowT = date("Ymd\THi00");
		echo "$quote".$icalt[$i]['Name']."$quote,";
		echo "$quote".$icalt[$i]['iDateStart']."$quote,";
		echo "$quote".$icalt[$i]['iCalStart']."$quote,";
		echo "$quote".$icalt[$i]['iDateEnd']."$quote,";
		echo "$quote".$icalt[$i]['iCalEnd']."$quote,";
		// echo all day
		echo "$quote";
		echo "$quote,";
		//echo location
		echo "$quote";
		echo "$quote,";
		echo "$quote".$icalt[$i]['DescDump']."$quote\r\n";

	  $i++;
      }
  	}
  	$db->sql_freeresult($result);

?>