<?php
/** 
*
* integramod3 [English]
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
	'INTEGRAMOD3_TITLE'	        => 'IntegraMOD3 overview',
	'INTEGRAMOD3_SUPPORT_BODY'	=> 'Full support will be given in the <a href="http://www.integramod.com/forum/index.php?c=6" title="IntegraMOD3 Dev Site" target="_new"><b>IntegraMOD3 Development Forum</b></a>. We will provide answers to general setup questions, configuration problems, and support for determining common problems.</p><p>Be sure to visit our <a href="http://www.integramod.com" title="IntegraMOD" target="_new"><b>IntegraMOD</b></a> home forums.</p><p>You should <a href="http://www.integramod.com/forum/profile.php?mode=profil&sub=profile_prefer&mod=0" title="Register at IntegraMOD" target="_new"><b>register</b></a>, log in and subscribe to the <a href="http://www.integramod.com/forum/im3-news-f67.html" target="_new"><b>IM3 News </b></a>thread to be notified by email or PM about each update.',
	'INTEGRAMOD3_BODY'	        => 'Welcome to the Alpha release  of IntegraMOD3.</p><p>Please read <a href="http://www." title="Check the release thread" target="_new"><b>the IM3 dev thread</b></a> for more information</p><p><strong style="text-transform: uppercase;">Note:</strong> IM3 includes three phpBB3 SEO mod rewrite versions. You will be able to choose one of them.<br/><br/><b>The three different URL rewriting standards available :</b><ul><li><a href="http://www.phpbb-seo.com/boards/simple-seo-url/simple-phpbb3-seo-url-vt1566.html" title="More details about the Simple mod"><b>The Simple mod</b></a>,</li><li><a href="http://www.phpbb-seo.com/boards/mixed-seo-url/mixed-phpbb3-seo-url-vt1565.html" title="More details about the Mixed mod"><b>The Mixed mod</b></a>,</li><li><a href="http://www.phpbb-seo.com/boards/advanced-seo-url/advanced-phpbb3-seo-url-vt1219.html" title="More details about the Advanced mod"><b>Advanced</b></a>.</li></ul>This choice is very important, we encourage you to take the time to fully discover the SEO features of this premod before you go online.<br/>This premod is as simple to install as phpBB3, just follow the regular process.<br/><br/>
	          <p>Requirements for URL rewriting :</p>
	            <ul>
		          <li>Apache server (linux OS) with mod_rewrite module.</li>
		          <li>IIS server (windows OS) with isapi_rewrite module, but you will need to adapt the rewriterules in the httpd.ini</li>
	            </ul>
	          <p>Once installed, you will need to go to the ACP to set up and activate the mod.</p>
	          <p>For a complete list of mods included in IntegraMOD3, read the <a href="http://www.integramod.com/IntegraMOD/" title="IntegraMOD3 Included Mods" target="_new"><b>IntegraMOD3 Development</b></a> thread.</p>',
));
?>