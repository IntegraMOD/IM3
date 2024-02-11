<?php if (!defined('IN_PHPBB')) exit; ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="<?php echo $this->_rootref['S_CONTENT_DIRECTION'] ?? ''; ?>" lang="<?php echo $this->_rootref['S_USER_LANG'] ?? ''; ?>" xml:lang="<?php echo $this->_rootref['S_USER_LANG'] ?? ''; ?>">
<head>

<meta http-equiv="content-type" content="text/html; charset=<?php echo $this->_rootref['S_CONTENT_ENCODING'] ?? ''; ?>" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-language" content="<?php echo $this->_rootref['S_USER_LANG'] ?? ''; ?>" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="resource-type" content="document" />
<meta name="distribution" content="global" />
<meta name="keywords" content="" />
<meta name="description" content="" />
<?php echo $this->_rootref['META'] ?? ''; ?>

<title><?php echo $this->_rootref['SITENAME'] ?? ''; ?> &bull; <?php if (($this->_rootref['S_IN_MCP'] ?? null)) {  echo ((isset($this->_rootref['L_MCP'])) ? $this->_rootref['L_MCP'] : ((isset($user->lang['MCP'])) ? $user->lang['MCP'] : '{ MCP }')); ?> &bull; <?php } else if (($this->_rootref['S_IN_UCP'] ?? null)) {  echo ((isset($this->_rootref['L_UCP'])) ? $this->_rootref['L_UCP'] : ((isset($user->lang['UCP'])) ? $user->lang['UCP'] : '{ UCP }')); ?> &bull; <?php } echo $this->_rootref['PAGE_TITLE'] ?? ''; ?></title>
<link rel="icon" type="image/x-icon" href="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>images/favicon.ico">
<link rel="stylesheet" type="text/css" href="<?php echo $this->_rootref['T_THEME_PATH'] ?? ''; ?>/style_wide.css" />
<link rel="alternate stylesheet" type="text/css" media="screen" title="fixed" href="<?php echo $this->_rootref['T_THEME_PATH'] ?? ''; ?>/style_fixed.css" />

<?php if (($this->_rootref['S_ENABLE_FEEDS'] ?? null)) {  if (($this->_rootref['S_ENABLE_FEEDS_OVERALL'] ?? null)) {  ?><link rel="alternate" type="application/atom+xml" title="<?php echo ((isset($this->_rootref['L_FEED'])) ? $this->_rootref['L_FEED'] : ((isset($user->lang['FEED'])) ? $user->lang['FEED'] : '{ FEED }')); ?> - <?php echo $this->_rootref['SITENAME'] ?? ''; ?>" href="<?php echo $this->_rootref['U_FEED'] ?? ''; ?>" /><?php } if (($this->_rootref['S_ENABLE_FEEDS_NEWS'] ?? null)) {  ?><link rel="alternate" type="application/atom+xml" title="<?php echo ((isset($this->_rootref['L_FEED'])) ? $this->_rootref['L_FEED'] : ((isset($user->lang['FEED'])) ? $user->lang['FEED'] : '{ FEED }')); ?> - <?php echo ((isset($this->_rootref['L_FEED_NEWS'])) ? $this->_rootref['L_FEED_NEWS'] : ((isset($user->lang['FEED_NEWS'])) ? $user->lang['FEED_NEWS'] : '{ FEED_NEWS }')); ?>" href="<?php echo $this->_rootref['U_FEED'] ?? ''; ?>?mode=news" /><?php } if (($this->_rootref['S_ENABLE_FEEDS_FORUMS'] ?? null)) {  ?><link rel="alternate" type="application/atom+xml" title="<?php echo ((isset($this->_rootref['L_FEED'])) ? $this->_rootref['L_FEED'] : ((isset($user->lang['FEED'])) ? $user->lang['FEED'] : '{ FEED }')); ?> - <?php echo ((isset($this->_rootref['L_ALL_FORUMS'])) ? $this->_rootref['L_ALL_FORUMS'] : ((isset($user->lang['ALL_FORUMS'])) ? $user->lang['ALL_FORUMS'] : '{ ALL_FORUMS }')); ?>" href="<?php echo $this->_rootref['U_FEED'] ?? ''; ?>?mode=forums" /><?php } if (($this->_rootref['S_ENABLE_FEEDS_TOPICS'] ?? null)) {  ?><link rel="alternate" type="application/atom+xml" title="<?php echo ((isset($this->_rootref['L_FEED'])) ? $this->_rootref['L_FEED'] : ((isset($user->lang['FEED'])) ? $user->lang['FEED'] : '{ FEED }')); ?> - <?php echo ((isset($this->_rootref['L_FEED_TOPICS_NEW'])) ? $this->_rootref['L_FEED_TOPICS_NEW'] : ((isset($user->lang['FEED_TOPICS_NEW'])) ? $user->lang['FEED_TOPICS_NEW'] : '{ FEED_TOPICS_NEW }')); ?>" href="<?php echo $this->_rootref['U_FEED'] ?? ''; ?>?mode=topics" /><?php } if (($this->_rootref['S_ENABLE_FEEDS_TOPICS_ACTIVE'] ?? null)) {  ?><link rel="alternate" type="application/atom+xml" title="<?php echo ((isset($this->_rootref['L_FEED'])) ? $this->_rootref['L_FEED'] : ((isset($user->lang['FEED'])) ? $user->lang['FEED'] : '{ FEED }')); ?> - <?php echo ((isset($this->_rootref['L_FEED_TOPICS_ACTIVE'])) ? $this->_rootref['L_FEED_TOPICS_ACTIVE'] : ((isset($user->lang['FEED_TOPICS_ACTIVE'])) ? $user->lang['FEED_TOPICS_ACTIVE'] : '{ FEED_TOPICS_ACTIVE }')); ?>" href="<?php echo $this->_rootref['U_FEED'] ?? ''; ?>?mode=topics_active" /><?php } if (($this->_rootref['S_ENABLE_FEEDS_FORUM'] ?? null) && ($this->_rootref['S_FORUM_ID'] ?? null)) {  ?><link rel="alternate" type="application/atom+xml" title="<?php echo ((isset($this->_rootref['L_FEED'])) ? $this->_rootref['L_FEED'] : ((isset($user->lang['FEED'])) ? $user->lang['FEED'] : '{ FEED }')); ?> - <?php echo ((isset($this->_rootref['L_FORUM'])) ? $this->_rootref['L_FORUM'] : ((isset($user->lang['FORUM'])) ? $user->lang['FORUM'] : '{ FORUM }')); ?> - <?php echo $this->_rootref['FORUM_NAME'] ?? ''; ?>" href="<?php echo $this->_rootref['U_FEED'] ?? ''; ?>?f=<?php echo $this->_rootref['S_FORUM_ID'] ?? ''; ?>" /><?php } if (($this->_rootref['S_ENABLE_FEEDS_TOPIC'] ?? null) && ($this->_rootref['S_TOPIC_ID'] ?? null)) {  ?><link rel="alternate" type="application/atom+xml" title="<?php echo ((isset($this->_rootref['L_FEED'])) ? $this->_rootref['L_FEED'] : ((isset($user->lang['FEED'])) ? $user->lang['FEED'] : '{ FEED }')); ?> - <?php echo ((isset($this->_rootref['L_TOPIC'])) ? $this->_rootref['L_TOPIC'] : ((isset($user->lang['TOPIC'])) ? $user->lang['TOPIC'] : '{ TOPIC }')); ?> - <?php echo $this->_rootref['TOPIC_TITLE'] ?? ''; ?>" href="<?php echo $this->_rootref['U_FEED'] ?? ''; ?>?f=<?php echo $this->_rootref['S_FORUM_ID'] ?? ''; ?>&amp;t=<?php echo $this->_rootref['S_TOPIC_ID'] ?? ''; ?>" /><?php } } ?>


<!--
	phpBB style name: MiMic
	Based on style:   prosilver (this is the default phpBB3 style)
	Original author:  Tom Beddard ( http://www.subBlue.com/ )
	Modified by:	  Helter
-->

<script>
// <![CDATA[
	var jump_page = '<?php echo ((isset($this->_rootref['LA_JUMP_PAGE'])) ? $this->_rootref['LA_JUMP_PAGE'] : ((isset($this->_rootref['L_JUMP_PAGE'])) ? addslashes($this->_rootref['L_JUMP_PAGE']) : ((isset($user->lang['JUMP_PAGE'])) ? addslashes($user->lang['JUMP_PAGE']) : '{ JUMP_PAGE }'))); ?>:';
	var on_page = '<?php echo $this->_rootref['ON_PAGE'] ?? ''; ?>';
	var per_page = '<?php echo $this->_rootref['PER_PAGE'] ?? ''; ?>';
	var base_url = '<?php echo $this->_rootref['A_BASE_URL'] ?? ''; ?>';
	var style_cookie = 'phpBBstyle';
	var style_cookie_settings = '<?php echo $this->_rootref['A_COOKIE_SETTINGS'] ?? ''; ?>';
	var onload_functions = new Array();
	var onunload_functions = new Array();

	<?php if (($this->_rootref['S_USER_PM_POPUP'] ?? null) && ($this->_rootref['S_NEW_PM'] ?? null)) {  ?>

		var url = '<?php echo $this->_rootref['UA_POPUP_PM'] ?? ''; ?>';
		window.open(url.replace(/&amp;/g, '&'), '_phpbbprivmsg', 'height=225,resizable=yes,scrollbars=yes, width=400');
	<?php } ?>


	/**
	* Find a member
	*/
	function find_username(url)
	{
		popup(url, 760, 570, '_usersearch');
		return false;
	}

	/**
	* New function for handling multiple calls to window.onload and window.unload by pentapenguin
	*/
	window.onload = function()
	{
		for (var i = 0; i < onload_functions.length; i++)
		{
			eval(onload_functions[i]);
		}
	};

	window.onunload = function()
	{
		for (var i = 0; i < onunload_functions.length; i++)
		{
			eval(onunload_functions[i]);
		}
	};

// ]]>
</script>
<script src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>assets/js/styleswitcher.js"></script>
<script src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>assets/js/forum_fn.js"></script>
<script src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>assets/js/jquery/jquery-1.10.2.min.js"></script>
<script src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>assets/js/jquery/jquery-migrate-1.2.1.min.js"></script>

<?php if (($this->_rootref['S_MCHAT_ENABLE'] ?? null) && ( ($this->_rootref['S_MCHAT_ON_INDEX'] ?? null) || ($this->_rootref['U_MCHAT'] ?? null) )) {  ?>

<script src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>assets/js/jquery/jquery_cookie_mini.js"></script>
<?php } if (($this->_rootref['S_NEW_DL_POPUP'] ?? null)) {  ?>

<script>
// <![CDATA[
	window.open('<?php echo $this->_rootref['U_NEW_DOWNLOAD_POPUP'] ?? ''; ?>', '_blank', 'HEIGHT=225,resizable=yes,WIDTH=400');
// ]] >
</script>
<?php } if (($this->_rootref['S_DL_LYTEBOX'] ?? null)) {  ?>

<script src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>assets/js/lytebox/lytebox.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>assets/js/lytebox/lytebox.css" />
<?php } if (($this->_rootref['S_TOTAL_IMAGES'] ?? null)) {  ?>

<script src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>assets/js/jquery/jquery-1.6.min.js"></script>
<script src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>assets/js/jquery/jquery.jcarousel.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>assets/js/jquery/skins/tango/skin.css" />
<?php } ?>


<link href="<?php echo $this->_rootref['T_THEME_PATH'] ?? ''; ?>/print.css" rel="stylesheet" type="text/css" media="print" title="printonly" />
<link href="<?php echo $this->_rootref['T_STYLESHEET_LINK'] ?? ''; ?>" rel="stylesheet" type="text/css" media="screen, projection" />

<link href="<?php echo $this->_rootref['T_THEME_PATH'] ?? ''; ?>/normal.css" rel="stylesheet" type="text/css" title="A" />
<link href="<?php echo $this->_rootref['T_THEME_PATH'] ?? ''; ?>/medium.css" rel="alternate stylesheet" type="text/css" title="A+" />
<link href="<?php echo $this->_rootref['T_THEME_PATH'] ?? ''; ?>/large.css" rel="alternate stylesheet" type="text/css" title="A++" />
<!-- fontawesome 6.4.0 CSS-->  
<link rel="stylesheet" type="text/css" href="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>styles/assets/css/all.css">

<?php if (($this->_rootref['S_CONTENT_DIRECTION'] ?? null) == ('rtl')) {  ?>

	<link href="<?php echo $this->_rootref['T_THEME_PATH'] ?? ''; ?>/bidi.css" rel="stylesheet" type="text/css" media="screen, projection" />
<?php } if (($this->_rootref['STARGATE'] ?? null)) {  $this->_tpl_include('set-width.html'); $this->_tpl_include('portal_scripts.html'); } $this->_tpl_include('js.html'); ?>


<script> 
// <![CDATA[
function notes() { 
	window.open("<?php echo $this->_rootref['U_PERS_NOTES_POPUP'] ?? ''; ?>", "_blank", "width=800,height=600,scrollbars=yes,resizable=no");
} 
// ]] >
</script>

<?php $this->_tpl_include('ads/ads.js'); ?><!-- MOD : MSSTI ABBC3 (v<?php echo $this->_rootref['S_ABBC3_VERSION'] ?? ''; ?>) - Start //--><?php $this->_tpl_include('./../../abbcode/abbcode_header.html'); ?><!-- MOD : MSSTI ABBC3 (v<?php echo $this->_rootref['S_ABBC3_VERSION'] ?? ''; ?>) - End //-->
</head>

<body id="phpbb" class="section-<?php echo $this->_rootref['SCRIPT_NAME'] ?? ''; ?> <?php echo $this->_rootref['S_CONTENT_DIRECTION'] ?? ''; ?>">
<?php if (($this->_rootref['STARGATE'] ?? null)) {  ?>

<div id="page-width" class="stylewidth">
<?php } ?>


<div id="wrap">
	<a id="top" name="top" accesskey="t"></a>
	<div id="page-header">
		<?php echo $this->_rootref['ADS_1'] ?? ''; ?>

		<div class="headerbar">
			<div class="inner">

			<div id="site-description">
				<?php if (($this->_rootref['STARGATE'] ?? null)) {  ?>

					<a href="<?php echo $this->_rootref['U_PORTAL'] ?? ''; ?>" title="<?php echo ((isset($this->_rootref['L_PORTAL'])) ? $this->_rootref['L_PORTAL'] : ((isset($user->lang['PORTAL'])) ? $user->lang['PORTAL'] : '{ PORTAL }')); ?>" id="logo"><?php echo $this->_rootref['SITE_LOGO_IMG'] ?? ''; ?></a>
				<?php } else { ?>

					<a href="<?php echo $this->_rootref['U_INDEX'] ?? ''; ?>" title="<?php echo ((isset($this->_rootref['L_INDEX'])) ? $this->_rootref['L_INDEX'] : ((isset($user->lang['INDEX'])) ? $user->lang['INDEX'] : '{ INDEX }')); ?>" id="logo"><?php echo $this->_rootref['SITE_LOGO_IMG'] ?? ''; ?></a>
				<?php } ?>

				<h1><?php echo $this->_rootref['SITENAME'] ?? ''; ?></h1>
				<p><?php echo $this->_rootref['SITE_DESCRIPTION'] ?? ''; ?></p>
				<p class="skiplink"><a href="#start_here"><?php echo ((isset($this->_rootref['L_SKIP'])) ? $this->_rootref['L_SKIP'] : ((isset($user->lang['SKIP'])) ? $user->lang['SKIP'] : '{ SKIP }')); ?></a></p>
			</div>

		<?php if (($this->_rootref['S_DISPLAY_SEARCH'] ?? null) && ! ($this->_rootref['S_IN_SEARCH'] ?? null)) {  ?>

			<div id="search-box">
				<form action="<?php echo $this->_rootref['U_SEARCH'] ?? ''; ?>" method="get" id="search">
				<fieldset>
					<input name="keywords" id="keywords" type="text" maxlength="128" title="<?php echo ((isset($this->_rootref['L_SEARCH_KEYWORDS'])) ? $this->_rootref['L_SEARCH_KEYWORDS'] : ((isset($user->lang['SEARCH_KEYWORDS'])) ? $user->lang['SEARCH_KEYWORDS'] : '{ SEARCH_KEYWORDS }')); ?>" class="inputbox search" value="<?php if (($this->_rootref['SEARCH_WORDS'] ?? null)) {  echo $this->_rootref['SEARCH_WORDS'] ?? ''; } else { echo ((isset($this->_rootref['L_SEARCH_MINI'])) ? $this->_rootref['L_SEARCH_MINI'] : ((isset($user->lang['SEARCH_MINI'])) ? $user->lang['SEARCH_MINI'] : '{ SEARCH_MINI }')); } ?>" onclick="if(this.value=='<?php echo ((isset($this->_rootref['LA_SEARCH_MINI'])) ? $this->_rootref['LA_SEARCH_MINI'] : ((isset($this->_rootref['L_SEARCH_MINI'])) ? addslashes($this->_rootref['L_SEARCH_MINI']) : ((isset($user->lang['SEARCH_MINI'])) ? addslashes($user->lang['SEARCH_MINI']) : '{ SEARCH_MINI }'))); ?>')this.value='';" onblur="if(this.value=='')this.value='<?php echo ((isset($this->_rootref['LA_SEARCH_MINI'])) ? $this->_rootref['LA_SEARCH_MINI'] : ((isset($this->_rootref['L_SEARCH_MINI'])) ? addslashes($this->_rootref['L_SEARCH_MINI']) : ((isset($user->lang['SEARCH_MINI'])) ? addslashes($user->lang['SEARCH_MINI']) : '{ SEARCH_MINI }'))); ?>';" />
					<input class="button2" value="<?php echo ((isset($this->_rootref['L_SEARCH'])) ? $this->_rootref['L_SEARCH'] : ((isset($user->lang['SEARCH'])) ? $user->lang['SEARCH'] : '{ SEARCH }')); ?>" type="submit" /><br />
					<a href="<?php echo $this->_rootref['U_SEARCH'] ?? ''; ?>" title="<?php echo ((isset($this->_rootref['L_SEARCH_ADV_EXPLAIN'])) ? $this->_rootref['L_SEARCH_ADV_EXPLAIN'] : ((isset($user->lang['SEARCH_ADV_EXPLAIN'])) ? $user->lang['SEARCH_ADV_EXPLAIN'] : '{ SEARCH_ADV_EXPLAIN }')); ?>"><?php echo ((isset($this->_rootref['L_SEARCH_ADV'])) ? $this->_rootref['L_SEARCH_ADV'] : ((isset($user->lang['SEARCH_ADV'])) ? $user->lang['SEARCH_ADV'] : '{ SEARCH_ADV }')); ?></a> <?php echo $this->_rootref['S_SEARCH_HIDDEN_FIELDS'] ?? ''; ?>

				</fieldset>
				</form>
			</div>
		<?php } ?>

			</div>
		</div>

		<div class="navbar">
			<div class="inner">

			<ul class="linklist navlinks">
			    <?php if (($this->_rootref['STARGATE'] ?? null)) {  ?>

				<li class="icon-home"><a href="<?php echo $this->_rootref['U_PORTAL'] ?? ''; ?>" accesskey="h"><?php echo ((isset($this->_rootref['L_PORTAL'])) ? $this->_rootref['L_PORTAL'] : ((isset($user->lang['PORTAL'])) ? $user->lang['PORTAL'] : '{ PORTAL }')); ?></a> &bull; <a href="<?php echo $this->_rootref['U_INDEX'] ?? ''; ?>" accesskey="h"><?php echo ((isset($this->_rootref['L_INDEX'])) ? $this->_rootref['L_INDEX'] : ((isset($user->lang['INDEX'])) ? $user->lang['INDEX'] : '{ INDEX }')); ?></a><?php $_navlinks_count = (isset($this->_tpldata['navlinks']) && is_array($this->_tpldata['navlinks'])) ? count($this->_tpldata['navlinks']) : 0;if ($_navlinks_count) {for ($_navlinks_i = 0; $_navlinks_i < $_navlinks_count; ++$_navlinks_i){$_navlinks_val = &$this->_tpldata['navlinks'][$_navlinks_i]; ?> <strong>&#8249;</strong> <a href="<?php echo $_navlinks_val['U_VIEW_FORUM']; ?>"><?php echo $_navlinks_val['FORUM_NAME']; ?></a><?php }} $_dl_nav_count = (isset($this->_tpldata['dl_nav']) && is_array($this->_tpldata['dl_nav'])) ? count($this->_tpldata['dl_nav']) : 0;if ($_dl_nav_count) {for ($_dl_nav_i = 0; $_dl_nav_i < $_dl_nav_count; ++$_dl_nav_i){$_dl_nav_val = &$this->_tpldata['dl_nav'][$_dl_nav_i]; ?> <strong>&#8249;</strong> <a href="<?php echo $_dl_nav_val['U_DOWNLOAD']; ?>"><?php echo $_dl_nav_val['L_DOWNLOAD']; ?></a><?php }} ?></li>
			    <?php } else { ?>

				<li class="icon-home"><a href="<?php echo $this->_rootref['U_INDEX'] ?? ''; ?>" accesskey="h"><?php echo ((isset($this->_rootref['L_INDEX'])) ? $this->_rootref['L_INDEX'] : ((isset($user->lang['INDEX'])) ? $user->lang['INDEX'] : '{ INDEX }')); ?></a> <?php $_navlinks_count = (isset($this->_tpldata['navlinks']) && is_array($this->_tpldata['navlinks'])) ? count($this->_tpldata['navlinks']) : 0;if ($_navlinks_count) {for ($_navlinks_i = 0; $_navlinks_i < $_navlinks_count; ++$_navlinks_i){$_navlinks_val = &$this->_tpldata['navlinks'][$_navlinks_i]; ?> <strong>&#8249;</strong> <a href="<?php echo $_navlinks_val['U_VIEW_FORUM']; ?>"><?php echo $_navlinks_val['FORUM_NAME']; ?></a><?php }} $_dl_nav_count = (isset($this->_tpldata['dl_nav']) && is_array($this->_tpldata['dl_nav'])) ? count($this->_tpldata['dl_nav']) : 0;if ($_dl_nav_count) {for ($_dl_nav_i = 0; $_dl_nav_i < $_dl_nav_count; ++$_dl_nav_i){$_dl_nav_val = &$this->_tpldata['dl_nav'][$_dl_nav_i]; ?> <strong>&#8249;</strong> <a href="<?php echo $_dl_nav_val['U_DOWNLOAD']; ?>"><?php echo $_dl_nav_val['L_DOWNLOAD']; ?></a><?php }} ?></li>
			    <?php } ?>

				<li class="rightside"><a href="#" onclick="fontsizeup(); return false;" onkeypress="return fontsizeup(event);" class="fontsize" title="<?php echo ((isset($this->_rootref['L_CHANGE_FONT_SIZE'])) ? $this->_rootref['L_CHANGE_FONT_SIZE'] : ((isset($user->lang['CHANGE_FONT_SIZE'])) ? $user->lang['CHANGE_FONT_SIZE'] : '{ CHANGE_FONT_SIZE }')); ?>"><?php echo ((isset($this->_rootref['L_CHANGE_FONT_SIZE'])) ? $this->_rootref['L_CHANGE_FONT_SIZE'] : ((isset($user->lang['CHANGE_FONT_SIZE'])) ? $user->lang['CHANGE_FONT_SIZE'] : '{ CHANGE_FONT_SIZE }')); ?></a></li>
				<?php if (($this->_rootref['STARGATE'] ?? null)) {  ?>

					<li class="rightside">
						<?php $this->_tpl_include('style_change_width.html'); if (($this->_rootref['S_ARRANGE'] ?? null)) {  ?>

						<span style="display:inline;" id="OFF_">
							&nbsp;<a href="<?php echo $this->_rootref['U_PORTAL'] ?? ''; ?>" onclick="ShowHide('ON_'); ShowHide('OFF_');" style="float:left" title="<?php echo ((isset($this->_rootref['L_ARRANGE_OFF'])) ? $this->_rootref['L_ARRANGE_OFF'] : ((isset($user->lang['ARRANGE_OFF'])) ? $user->lang['ARRANGE_OFF'] : '{ ARRANGE_OFF }')); ?>"><img src="<?php echo $this->_rootref['T_PORTAL_THEME_PATH'] ?? ''; ?>/images/save_changes.png" width="15" height="15" alt=" <?php echo ((isset($this->_rootref['L_ARRANGE_OFF'])) ? $this->_rootref['L_ARRANGE_OFF'] : ((isset($user->lang['ARRANGE_OFF'])) ? $user->lang['ARRANGE_OFF'] : '{ ARRANGE_OFF }')); ?>" title="<?php echo ((isset($this->_rootref['L_ARRANGE_OFF'])) ? $this->_rootref['L_ARRANGE_OFF'] : ((isset($user->lang['ARRANGE_OFF'])) ? $user->lang['ARRANGE_OFF'] : '{ ARRANGE_OFF }')); ?>" /></a>
						</span>
						<?php } else { ?>

						<span style="display:inline;" id="ON_">
							&nbsp;<a href="<?php echo $this->_rootref['U_PORTAL_ARRANGE'] ?? ''; ?>" onclick="ShowHide('OFF_'); ShowHide('ON_'); " style="float:left" title="<?php echo ((isset($this->_rootref['L_ARRANGE_ON'])) ? $this->_rootref['L_ARRANGE_ON'] : ((isset($user->lang['ARRANGE_ON'])) ? $user->lang['ARRANGE_ON'] : '{ ARRANGE_ON }')); ?>"><img src="<?php echo $this->_rootref['T_PORTAL_THEME_PATH'] ?? ''; ?>/images/arrange.png" width="15" height="15" alt=" <?php echo ((isset($this->_rootref['L_ARRANGE_ON'])) ? $this->_rootref['L_ARRANGE_ON'] : ((isset($user->lang['ARRANGE_ON'])) ? $user->lang['ARRANGE_ON'] : '{ ARRANGE_ON }')); ?>" title="<?php echo ((isset($this->_rootref['L_ARRANGE_ON'])) ? $this->_rootref['L_ARRANGE_ON'] : ((isset($user->lang['ARRANGE_ON'])) ? $user->lang['ARRANGE_ON'] : '{ ARRANGE_ON }')); ?>" /></a>
						</span>
						<?php } ?>

					</li>
				<?php } if (($this->_rootref['U_EMAIL_TOPIC'] ?? null)) {  ?><li class="rightside"><a href="<?php echo $this->_rootref['U_EMAIL_TOPIC'] ?? ''; ?>" title="<?php echo ((isset($this->_rootref['L_EMAIL_TOPIC'])) ? $this->_rootref['L_EMAIL_TOPIC'] : ((isset($user->lang['EMAIL_TOPIC'])) ? $user->lang['EMAIL_TOPIC'] : '{ EMAIL_TOPIC }')); ?>" class="sendemail"><?php echo ((isset($this->_rootref['L_EMAIL_TOPIC'])) ? $this->_rootref['L_EMAIL_TOPIC'] : ((isset($user->lang['EMAIL_TOPIC'])) ? $user->lang['EMAIL_TOPIC'] : '{ EMAIL_TOPIC }')); ?></a></li><?php } if (($this->_rootref['U_EMAIL_PM'] ?? null)) {  ?><li class="rightside"><a href="<?php echo $this->_rootref['U_EMAIL_PM'] ?? ''; ?>" title="<?php echo ((isset($this->_rootref['L_EMAIL_PM'])) ? $this->_rootref['L_EMAIL_PM'] : ((isset($user->lang['EMAIL_PM'])) ? $user->lang['EMAIL_PM'] : '{ EMAIL_PM }')); ?>" class="sendemail"><?php echo ((isset($this->_rootref['L_EMAIL_PM'])) ? $this->_rootref['L_EMAIL_PM'] : ((isset($user->lang['EMAIL_PM'])) ? $user->lang['EMAIL_PM'] : '{ EMAIL_PM }')); ?></a></li><?php } if (($this->_rootref['U_PRINT_TOPIC'] ?? null)) {  ?><li class="rightside"><a href="<?php echo $this->_rootref['U_PRINT_TOPIC'] ?? ''; ?>" title="<?php echo ((isset($this->_rootref['L_PRINT_TOPIC'])) ? $this->_rootref['L_PRINT_TOPIC'] : ((isset($user->lang['PRINT_TOPIC'])) ? $user->lang['PRINT_TOPIC'] : '{ PRINT_TOPIC }')); ?>" accesskey="p" class="print"><?php echo ((isset($this->_rootref['L_PRINT_TOPIC'])) ? $this->_rootref['L_PRINT_TOPIC'] : ((isset($user->lang['PRINT_TOPIC'])) ? $user->lang['PRINT_TOPIC'] : '{ PRINT_TOPIC }')); ?></a></li><?php } if (($this->_rootref['U_PRINT_PM'] ?? null)) {  ?><li class="rightside"><a href="<?php echo $this->_rootref['U_PRINT_PM'] ?? ''; ?>" title="<?php echo ((isset($this->_rootref['L_PRINT_PM'])) ? $this->_rootref['L_PRINT_PM'] : ((isset($user->lang['PRINT_PM'])) ? $user->lang['PRINT_PM'] : '{ PRINT_PM }')); ?>" accesskey="p" class="print"><?php echo ((isset($this->_rootref['L_PRINT_PM'])) ? $this->_rootref['L_PRINT_PM'] : ((isset($user->lang['PRINT_PM'])) ? $user->lang['PRINT_PM'] : '{ PRINT_PM }')); ?></a></li><?php } ?>

			</ul>

			<?php if (! ($this->_rootref['S_IS_BOT'] ?? null) && ($this->_rootref['S_USER_LOGGED_IN'] ?? null)) {  ?>

			<ul class="linklist leftside">
				<li>
					<?php if (($this->_rootref['S_DISPLAY_PM'] ?? null)) {  ?> <a href="<?php echo $this->_rootref['U_PRIVATEMSGS'] ?? ''; ?>"><i class="fa-regular fa-message fa-lg"></i> <?php echo $this->_rootref['PRIVATE_MESSAGE_INFO'] ?? ''; ?></a><?php } ?>

                    <a href="<?php echo $this->_rootref['U_SEARCH_NEW'] ?? ''; ?>"><?php echo ((isset($this->_rootref['L_NEW_POST'])) ? $this->_rootref['L_NEW_POST'] : ((isset($user->lang['NEW_POST'])) ? $user->lang['NEW_POST'] : '{ NEW_POST }')); ?></a>					
					<?php if (($this->_rootref['S_SHOW_MEETING'] ?? null) && ($this->_rootref['L_MEETING_LINK_N'] ?? null)) {  ?> &bull;
				    <a href="<?php echo $this->_rootref['U_MEETING_LINK_N'] ?? ''; ?>" title="<?php echo ((isset($this->_rootref['L_MEETING'])) ? $this->_rootref['L_MEETING'] : ((isset($user->lang['MEETING'])) ? $user->lang['MEETING'] : '{ MEETING }')); ?>"><?php echo ((isset($this->_rootref['L_MEETING_LINK_N'])) ? $this->_rootref['L_MEETING_LINK_N'] : ((isset($user->lang['MEETING_LINK_N'])) ? $user->lang['MEETING_LINK_N'] : '{ MEETING_LINK_N }')); ?></a>
				    <?php } if (($this->_rootref['U_RESTORE_PERMISSIONS'] ?? null)) {  ?> &bull;
					<a href="<?php echo $this->_rootref['U_RESTORE_PERMISSIONS'] ?? ''; ?>"><?php echo ((isset($this->_rootref['L_RESTORE_PERMISSIONS'])) ? $this->_rootref['L_RESTORE_PERMISSIONS'] : ((isset($user->lang['RESTORE_PERMISSIONS'])) ? $user->lang['RESTORE_PERMISSIONS'] : '{ RESTORE_PERMISSIONS }')); ?></a>
					<?php } if (($this->_rootref['U_USER_FLAG_NEW'] ?? null)) {  ?> &bull;
					<a href="<?php echo $this->_rootref['U_USER_FLAG_NEW'] ?? ''; ?>" style="color: red; font-weight: bold;"><?php echo ((isset($this->_rootref['L_USER_FLAG_NEW'])) ? $this->_rootref['L_USER_FLAG_NEW'] : ((isset($user->lang['USER_FLAG_NEW'])) ? $user->lang['USER_FLAG_NEW'] : '{ USER_FLAG_NEW }')); ?></a>
					<?php } if (($this->_rootref['S_HACKLIST_ON'] ?? null)) {  ?><li class="icon-hacklist"><a href="<?php echo $this->_rootref['U_HACKLIST'] ?? ''; ?>" title="<?php echo ((isset($this->_rootref['L_HACKLIST'])) ? $this->_rootref['L_HACKLIST'] : ((isset($user->lang['HACKLIST'])) ? $user->lang['HACKLIST'] : '{ HACKLIST }')); ?>"><?php echo ((isset($this->_rootref['L_HACKLIST'])) ? $this->_rootref['L_HACKLIST'] : ((isset($user->lang['HACKLIST'])) ? $user->lang['HACKLIST'] : '{ HACKLIST }')); ?></a></li><?php } if (($this->_rootref['S_BUGTRACKER_ON'] ?? null)) {  ?><li class="icon-tracker"><a href="<?php echo $this->_rootref['U_BUG_TRACKER'] ?? ''; ?>" title="<?php echo ((isset($this->_rootref['L_BUG_TRACKER'])) ? $this->_rootref['L_BUG_TRACKER'] : ((isset($user->lang['BUG_TRACKER'])) ? $user->lang['BUG_TRACKER'] : '{ BUG_TRACKER }')); ?>"><?php echo ((isset($this->_rootref['L_BUG_TRACKER'])) ? $this->_rootref['L_BUG_TRACKER'] : ((isset($user->lang['BUG_TRACKER'])) ? $user->lang['BUG_TRACKER'] : '{ BUG_TRACKER }')); ?></a></li><?php } ?>

				</li>
			</ul>
			<?php } if (! ($this->_rootref['S_IS_BOT'] ?? null) && ($this->_rootref['S_USER_LOGGED_IN'] ?? null)) {  ?>

			<div class="dropdown" tabindex="0">
			<button class="dropdown-btn" aria-haspopup="membermenu"><span class="username"><?php echo $this->_rootref['S_USERNAME'] ?? ''; ?>&nbsp;</span><span class="arrow"></span></button>
			<ul class="dropdown-content" role="membermenu">
				<li style="--delay: 1;"><a href="<?php echo $this->_rootref['U_PROFILE'] ?? ''; ?>" title="<?php echo ((isset($this->_rootref['L_PROFILE'])) ? $this->_rootref['L_PROFILE'] : ((isset($user->lang['PROFILE'])) ? $user->lang['PROFILE'] : '{ PROFILE }')); ?>" accesskey="e"><i class="fa-solid fa-user-gear fa-lg"></i> <?php echo ((isset($this->_rootref['L_PROFILE'])) ? $this->_rootref['L_PROFILE'] : ((isset($user->lang['PROFILE'])) ? $user->lang['PROFILE'] : '{ PROFILE }')); ?></a></li>
				<li style="--delay: 2;"><a href="<?php echo $this->_rootref['U_USER_PROFILE'] ?? ''; ?>" title="<?php echo ((isset($this->_rootref['L_READ_PROFILE'])) ? $this->_rootref['L_READ_PROFILE'] : ((isset($user->lang['READ_PROFILE'])) ? $user->lang['READ_PROFILE'] : '{ READ_PROFILE }')); ?>"><i class="fa-solid fa-user fa-lg"></i> <?php echo ((isset($this->_rootref['L_READ_PROFILE'])) ? $this->_rootref['L_READ_PROFILE'] : ((isset($user->lang['READ_PROFILE'])) ? $user->lang['READ_PROFILE'] : '{ READ_PROFILE }')); ?></a></li>
				<?php if (($this->_rootref['S_DISPLAY_SEARCH'] ?? null)) {  ?>

				<li style="--delay: 3;"><a href="<?php echo $this->_rootref['U_SEARCH_SELF'] ?? ''; ?>"><i class="fa-regular fa-file fa-lg"></i> <?php echo ((isset($this->_rootref['L_SEARCH_SELF'])) ? $this->_rootref['L_SEARCH_SELF'] : ((isset($user->lang['SEARCH_SELF'])) ? $user->lang['SEARCH_SELF'] : '{ SEARCH_SELF }')); ?></a></li>
				<?php } if (($this->_rootref['S_SHOW_NOTES'] ?? null)) {  ?>

				<li style="--delay: 4;"><a href="<?php echo $this->_rootref['U_PERS_NOTES'] ?? ''; ?>"><i class="fa-solid fa-note-sticky"></i> <?php echo ((isset($this->_rootref['L_PERS_NOTES'])) ? $this->_rootref['L_PERS_NOTES'] : ((isset($user->lang['PERS_NOTES'])) ? $user->lang['PERS_NOTES'] : '{ PERS_NOTES }')); ?></a></li>
				<?php } ?><!-- Start Ultimate Points --><?php if (($this->_rootref['S_POINTS_ENABLE'] ?? null)) {  ?>

				<li style="--delay: 5;"><a href="<?php echo $this->_rootref['U_POINTS'] ?? ''; ?>" title="<?php echo ((isset($this->_rootref['L_POINTS_EXPLAIN'])) ? $this->_rootref['L_POINTS_EXPLAIN'] : ((isset($user->lang['POINTS_EXPLAIN'])) ? $user->lang['POINTS_EXPLAIN'] : '{ POINTS_EXPLAIN }')); ?>"><i class="fa-solid fa-sack-dollar fa-lg"></i> <?php echo $this->_rootref['POINTS_LINK'] ?? ''; if (($this->_rootref['S_USER_LOGGED_IN'] ?? null) && ($this->_rootref['S_USE_POINTS'] ?? null)) {  ?> [ <?php echo $this->_rootref['USER_POINTS'] ?? ''; ?> ] <?php } ?></a></li>
				<?php } ?><!-- End Ultimate Points -->
				<li style="--delay: 6;"><a href="<?php echo $this->_rootref['U_LOGIN_LOGOUT'] ?? ''; ?>" title="<?php echo ((isset($this->_rootref['L_LOGIN_LOGOUT'])) ? $this->_rootref['L_LOGIN_LOGOUT'] : ((isset($user->lang['LOGIN_LOGOUT'])) ? $user->lang['LOGIN_LOGOUT'] : '{ LOGIN_LOGOUT }')); ?>" accesskey="x"><i class="fa-solid fa-power-off fa-lg"></i> <?php echo ((isset($this->_rootref['L_LOGIN_LOGOUT'])) ? $this->_rootref['L_LOGIN_LOGOUT'] : ((isset($user->lang['LOGIN_LOGOUT'])) ? $user->lang['LOGIN_LOGOUT'] : '{ LOGIN_LOGOUT }')); ?></a></li>
			</ul>
			</div>
			<?php } ?>


			<div class="dropdown" tabindex="1">
			<button class="dropdown-btn" aria-haspopup="menu"><span><b><i class="fa-solid fa-bars fa-lg"></i></b> <?php echo ((isset($this->_rootref['L_LINKS'])) ? $this->_rootref['L_LINKS'] : ((isset($user->lang['LINKS'])) ? $user->lang['LINKS'] : '{ LINKS }')); ?></span></button>
			<ul class="dropdown-content" role="menu">
				<?php if (! ($this->_rootref['S_IS_BOT'] ?? null) && ! ($this->_rootref['S_USER_LOGGED_IN'] ?? null) && ($this->_rootref['S_REGISTER_ENABLED'] ?? null) && ! ( ($this->_rootref['S_SHOW_COPPA'] ?? null) || ($this->_rootref['S_REGISTRATION'] ?? null) )) {  ?>

				<li style="--delay: 1;"><a href="<?php echo $this->_rootref['U_REGISTER'] ?? ''; ?>" title="<?php echo ((isset($this->_rootref['L_REGISTER'])) ? $this->_rootref['L_REGISTER'] : ((isset($user->lang['REGISTER'])) ? $user->lang['REGISTER'] : '{ REGISTER }')); ?>"><i class="fa-regular fa-handshake fa-lg"></i> <?php echo ((isset($this->_rootref['L_REGISTER'])) ? $this->_rootref['L_REGISTER'] : ((isset($user->lang['REGISTER'])) ? $user->lang['REGISTER'] : '{ REGISTER }')); ?></a></li>
				<?php } if (! ($this->_rootref['S_IS_BOT'] ?? null) && ! ($this->_rootref['S_USER_LOGGED_IN'] ?? null)) {  ?> 
				<li style="--delay: 1;"><a href="<?php echo $this->_rootref['U_LOGIN_LOGOUT'] ?? ''; ?>" title="<?php echo ((isset($this->_rootref['L_LOGIN_LOGOUT'])) ? $this->_rootref['L_LOGIN_LOGOUT'] : ((isset($user->lang['LOGIN_LOGOUT'])) ? $user->lang['LOGIN_LOGOUT'] : '{ LOGIN_LOGOUT }')); ?>" accesskey="x"><i class="fa-solid fa-power-off fa-lg"></i> <?php echo ((isset($this->_rootref['L_LOGIN_LOGOUT'])) ? $this->_rootref['L_LOGIN_LOGOUT'] : ((isset($user->lang['LOGIN_LOGOUT'])) ? $user->lang['LOGIN_LOGOUT'] : '{ LOGIN_LOGOUT }')); ?></a></li>
				<?php } if (($this->_rootref['S_SHOW_CAL'] ?? null)) {  ?>

				<li style="--delay: 1;"><a href="<?php echo $this->_rootref['U_CALENDAR'] ?? ''; ?>" title="<?php echo ((isset($this->_rootref['L_CALENDAR'])) ? $this->_rootref['L_CALENDAR'] : ((isset($user->lang['CALENDAR'])) ? $user->lang['CALENDAR'] : '{ CALENDAR }')); ?>"><i class="fa-regular fa-calendar-days fa-lg"></i> <?php echo ((isset($this->_rootref['L_LANG_CALENDAR'])) ? $this->_rootref['L_LANG_CALENDAR'] : ((isset($user->lang['LANG_CALENDAR'])) ? $user->lang['LANG_CALENDAR'] : '{ LANG_CALENDAR }')); ?></a></li>
				<?php } if (($this->_rootref['S_SHOW_CHT'] ?? null) && ($this->_rootref['S_MCHAT_ENABLE'] ?? null) && ($this->_rootref['U_MCHAT'] ?? null)) {  ?>

				<li style="--delay: 3;"><a href="<?php echo $this->_rootref['U_MCHAT'] ?? ''; ?>#mChat" title="<?php echo ((isset($this->_rootref['L_CHAT_EXPLAIN'])) ? $this->_rootref['L_CHAT_EXPLAIN'] : ((isset($user->lang['CHAT_EXPLAIN'])) ? $user->lang['CHAT_EXPLAIN'] : '{ CHAT_EXPLAIN }')); ?>"><i class="fa-solid fa-comment fa-lg"></i> <?php echo ((isset($this->_rootref['L_CHAT'])) ? $this->_rootref['L_CHAT'] : ((isset($user->lang['CHAT'])) ? $user->lang['CHAT'] : '{ CHAT }')); ?></a></li>
				<?php } if (($this->_rootref['S_SHOW_CONTACT'] ?? null) && ($this->_rootref['S_CONTACT_ENABLED'] ?? null)) {  ?>

				<li style="--delay: 5;"><a href="<?php echo $this->_rootref['U_CONTACT'] ?? ''; ?>" title="<?php echo ((isset($this->_rootref['L_CONTACT_BOARD_ADMIN'])) ? $this->_rootref['L_CONTACT_BOARD_ADMIN'] : ((isset($user->lang['CONTACT_BOARD_ADMIN'])) ? $user->lang['CONTACT_BOARD_ADMIN'] : '{ CONTACT_BOARD_ADMIN }')); ?>"><i class="fa-solid fa-message fa-lg"></i> <?php echo ((isset($this->_rootref['L_CONTACT_BOARD_ADMIN_SHORT'])) ? $this->_rootref['L_CONTACT_BOARD_ADMIN_SHORT'] : ((isset($user->lang['CONTACT_BOARD_ADMIN_SHORT'])) ? $user->lang['CONTACT_BOARD_ADMIN_SHORT'] : '{ CONTACT_BOARD_ADMIN_SHORT }')); ?></a></li>
				<?php } if (($this->_rootref['S_SHOW_DLS'] ?? null) && ($this->_rootref['S_SHOW_DL_LINK'] ?? null)) {  ?>

				<li style="--delay: 7;"><a href="<?php echo $this->_rootref['U_DL_NAVS'] ?? ''; ?>" title="<?php echo ((isset($this->_rootref['L_DOWNLOADS'])) ? $this->_rootref['L_DOWNLOADS'] : ((isset($user->lang['DOWNLOADS'])) ? $user->lang['DOWNLOADS'] : '{ DOWNLOADS }')); ?>"><i class="fa-solid fa-file-arrow-down fa-lg"></i> <?php echo ((isset($this->_rootref['L_DOWNLOADS'])) ? $this->_rootref['L_DOWNLOADS'] : ((isset($user->lang['DOWNLOADS'])) ? $user->lang['DOWNLOADS'] : '{ DOWNLOADS }')); ?></a></li>
				<?php } if (($this->_rootref['S_SHOW_FAQ'] ?? null)) {  ?>

				<li style="--delay: 8;"><a href="<?php echo $this->_rootref['U_FAQ'] ?? ''; ?>" title="<?php echo ((isset($this->_rootref['L_FAQ_EXPLAIN'])) ? $this->_rootref['L_FAQ_EXPLAIN'] : ((isset($user->lang['FAQ_EXPLAIN'])) ? $user->lang['FAQ_EXPLAIN'] : '{ FAQ_EXPLAIN }')); ?>"><i class="fa-solid fa-circle-question fa-lg"></i> <?php echo ((isset($this->_rootref['L_FAQ'])) ? $this->_rootref['L_FAQ'] : ((isset($user->lang['FAQ'])) ? $user->lang['FAQ'] : '{ FAQ }')); ?></a></li>
				<?php } if (($this->_rootref['S_SHOW_GALL'] ?? null)) {  ?>

				<li style="--delay: 6;"><a href="<?php echo $this->_rootref['U_GALLERY_MOD'] ?? ''; ?>" title="<?php echo ((isset($this->_rootref['L_GALLERY_EXPLAIN'])) ? $this->_rootref['L_GALLERY_EXPLAIN'] : ((isset($user->lang['GALLERY_EXPLAIN'])) ? $user->lang['GALLERY_EXPLAIN'] : '{ GALLERY_EXPLAIN }')); ?>"><i class="fa-regular fa-image fa-lg"></i> <?php echo ((isset($this->_rootref['L_GALLERY'])) ? $this->_rootref['L_GALLERY'] : ((isset($user->lang['GALLERY'])) ? $user->lang['GALLERY'] : '{ GALLERY }')); ?></a></li>
				<?php } if (($this->_rootref['S_SHOW_KB'] ?? null)) {  ?>

				<li style="--delay: 4;"><a href="<?php echo $this->_rootref['U_KB'] ?? ''; ?>" title="<?php echo ((isset($this->_rootref['L_KNOWLEDGE_BASE'])) ? $this->_rootref['L_KNOWLEDGE_BASE'] : ((isset($user->lang['KNOWLEDGE_BASE'])) ? $user->lang['KNOWLEDGE_BASE'] : '{ KNOWLEDGE_BASE }')); ?>" accesskey="k"><i class="fa-solid fa-book-open-reader fa-lg"></i> <?php echo ((isset($this->_rootref['L_KNOWLEDGE_BASE'])) ? $this->_rootref['L_KNOWLEDGE_BASE'] : ((isset($user->lang['KNOWLEDGE_BASE'])) ? $user->lang['KNOWLEDGE_BASE'] : '{ KNOWLEDGE_BASE }')); ?></a></li>
				<?php } if (($this->_rootref['S_SHOW_MEM'] ?? null) && ($this->_rootref['S_DISPLAY_MEMBERLIST'] ?? null)) {  ?>

				<li style="--delay: 2;"><a href="<?php echo $this->_rootref['U_MEMBERLIST'] ?? ''; ?>" title="<?php echo ((isset($this->_rootref['L_MEMBERLIST_EXPLAIN'])) ? $this->_rootref['L_MEMBERLIST_EXPLAIN'] : ((isset($user->lang['MEMBERLIST_EXPLAIN'])) ? $user->lang['MEMBERLIST_EXPLAIN'] : '{ MEMBERLIST_EXPLAIN }')); ?>"><i class="fa-solid fa-user-group fa-lg"></i> <?php echo ((isset($this->_rootref['L_MEMBERLIST'])) ? $this->_rootref['L_MEMBERLIST'] : ((isset($user->lang['MEMBERLIST'])) ? $user->lang['MEMBERLIST'] : '{ MEMBERLIST }')); ?></a></li>
				<?php } ?>

		    </ul>
		    </div>
			</div>
		</div>
	</div>




	<?php if (($this->_rootref['ADS_2'] ?? null)) {  ?>

	<br />
	<div class="forabg">
		<div class="inner">
			<ul class="topiclist">
				<li class="header">
					<dl class="icon">
						<dt><?php echo ((isset($this->_rootref['L_ADVERTISEMENT'])) ? $this->_rootref['L_ADVERTISEMENT'] : ((isset($user->lang['ADVERTISEMENT'])) ? $user->lang['ADVERTISEMENT'] : '{ ADVERTISEMENT }')); ?></dt>
					</dl>
				</li>
			</ul>
			<div style="padding: 5px 5px 2px 5px; font-size: 1.1em; background-color: #ECF1F3; margin: 0px auto; text-align: center;">
				<?php echo $this->_rootref['ADS_2'] ?? ''; ?>

			</div>
		</div>
	</div>
	<?php } ?>

	<a name="start_here"></a>
	<div id="page-body">

		<?php if (($this->_rootref['S_NEW_DL_MESSAGE'] ?? null)) {  ?>

			<div id="message" class="rules">
				<div class="inner">
					<?php echo $this->_rootref['NEW_DOWNLOAD_MESSAGE'] ?? ''; ?>

				</div>
			</div>
		<?php } if (($this->_rootref['S_NOTES_MEM'] ?? null)) {  ?>

			<div id="message" class="rules">
				<div class="inner">
					<?php echo $this->_rootref['NOTES_MEM'] ?? ''; ?>

				</div>
			</div>
		<?php } if (($this->_rootref['S_BOARD_DISABLED'] ?? null) && ($this->_rootref['S_USER_LOGGED_IN'] ?? null) && ( ($this->_rootref['U_MCP'] ?? null) || ($this->_rootref['U_ACP'] ?? null) )) {  ?>

		<div id="information" class="rules">
			<div class="inner">
				<strong><?php echo ((isset($this->_rootref['L_INFORMATION'])) ? $this->_rootref['L_INFORMATION'] : ((isset($user->lang['INFORMATION'])) ? $user->lang['INFORMATION'] : '{ INFORMATION }')); ?>:</strong> <?php echo ((isset($this->_rootref['L_BOARD_DISABLED'])) ? $this->_rootref['L_BOARD_DISABLED'] : ((isset($user->lang['BOARD_DISABLED'])) ? $user->lang['BOARD_DISABLED'] : '{ BOARD_DISABLED }')); ?>

			</div>
		</div>
		<?php } if (($this->_rootref['STARGATE'] ?? null)) {  $this->_tpl_include('portal_header.html'); } ?>