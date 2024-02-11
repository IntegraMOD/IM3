<?php if (!defined('IN_PHPBB')) exit; if (($this->_rootref['S_ABBC3_MOD'] ?? null)) {  ?>

<script type="text/javascript" src="<?php echo $this->_rootref['S_ABBC3_PATH'] ?? ''; ?>/abbcode.js?<?php echo $this->_rootref['S_ABBC3_VERSION'] ?? ''; ?>" charset="<?php echo $this->_rootref['S_CONTENT_ENCODING'] ?? ''; ?>"></script>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $this->_rootref['S_ABBC3_PATH'] ?? ''; ?>/abbcode.css?<?php echo $this->_rootref['S_ABBC3_VERSION'] ?? ''; ?>" />

<?php if (($this->_rootref['S_ABBC3_RESIZE'] ?? null) && ( ($this->_rootref['S_NEW_MESSAGE'] ?? null) || ($this->_rootref['S_EDIT_POST'] ?? null) || ($this->_rootref['S_VIEWTOPIC'] ?? null) || ($this->_rootref['S_DISPLAY_PREVIEW'] ?? null) || ($this->_rootref['S_POST_REVIEW'] ?? null) || ($this->_rootref['S_DISPLAY_REVIEW'] ?? null) || ($this->_rootref['SIGNATURE'] ?? null) ) || ( ($this->_rootref['U_MCP'] ?? null) && ( ($this->_rootref['U_MCP_POST'] ?? null) || ($this->_rootref['U_MCP_TOPIC'] ?? null) || ($this->_rootref['U_MCP_FORUM'] ?? null) ) ) || ( ($this->_rootref['S_PRIVMSGS'] ?? null) && ( ($this->_rootref['S_VIEW_MESSAGE'] ?? null) || ($this->_rootref['S_DISPLAY_HISTORY'] ?? null) ) ) || ( ($this->_rootref['SEARCH_TITLE'] ?? null) || ($this->_rootref['SEARCH_MATCHES'] ?? null) )) {  if (($this->_rootref['S_ABBC3_RESIZE_METHOD'] ?? null) == ('HighslideBox')) {  ?>

	<script type="text/javascript" src="<?php echo $this->_rootref['S_ABBC3_PATH'] ?? ''; ?>/highslide/highslide-full.js?<?php echo $this->_rootref['S_ABBC3_VERSION'] ?? ''; ?>"></script>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo $this->_rootref['S_ABBC3_PATH'] ?? ''; ?>/highslide/highslide.css?<?php echo $this->_rootref['S_ABBC3_VERSION'] ?? ''; ?>" />
	<style type="text/css">.controls-in-heading .highslide-controls { top: 25px; }</style>
	<!--[if lt IE 7]><link rel="stylesheet" type="text/css" href="<?php echo $this->_rootref['S_ABBC3_PATH'] ?? ''; ?>/highslide/highslide-ie6.css?<?php echo $this->_rootref['S_ABBC3_VERSION'] ?? ''; ?>" /><![endif]-->
	<?php } if (($this->_rootref['S_ABBC3_RESIZE_METHOD'] ?? null) == ('Lightview')) {  ?><!-- Please, do not change these files, which have been adjusted to work with ABBC3 //-->
	<script type='text/javascript' src='<?php echo $this->_rootref['S_ABBC3_PATH'] ?? ''; ?>/lightview/prototype.js?<?php echo $this->_rootref['S_ABBC3_VERSION'] ?? ''; ?>'></script>
	<script type='text/javascript' src='<?php echo $this->_rootref['S_ABBC3_PATH'] ?? ''; ?>/lightview/scriptaculous.js?load=effects'></script>
	<script type='text/javascript' src='<?php echo $this->_rootref['S_ABBC3_PATH'] ?? ''; ?>/lightview/js/lightview.js?<?php echo $this->_rootref['S_ABBC3_VERSION'] ?? ''; ?>'></script>
	<link rel="stylesheet" type="text/css" href="<?php echo $this->_rootref['S_ABBC3_PATH'] ?? ''; ?>/lightview/css/lightview.css?<?php echo $this->_rootref['S_ABBC3_VERSION'] ?? ''; ?>" />
	<style type="text/css" media="screen, projection">#lightview .clearfix { height: auto; }</style>
	<?php } if (($this->_rootref['S_ABBC3_RESIZE_METHOD'] ?? null) == ('prettyPhoto')) {  ?>

	<link rel="stylesheet" type="text/css" media="all" href="<?php echo $this->_rootref['S_ABBC3_PATH'] ?? ''; ?>/prettyPhoto/css/prettyPhoto.css?<?php echo $this->_rootref['S_ABBC3_VERSION'] ?? ''; ?>" />
	<script type="text/javascript">
		window.jQuery || document.write(unescape('%3Cscript src="<?php echo $this->_rootref['S_ABBC3_PATH'] ?? ''; ?>/prettyPhoto/js/jquery.min.js" type="text/javascript"%3E%3C/script%3E'));
	</script>
	<script type="text/javascript" src="<?php echo $this->_rootref['S_ABBC3_PATH'] ?? ''; ?>/prettyPhoto/js/jquery.prettyPhoto.js?<?php echo $this->_rootref['S_ABBC3_VERSION'] ?? ''; ?>"></script>
	<?php } if (($this->_rootref['S_ABBC3_RESIZE_METHOD'] ?? null) == ('Shadowbox')) {  ?>

	<link rel="stylesheet" type="text/css" media="all" href="<?php echo $this->_rootref['S_ABBC3_PATH'] ?? ''; ?>/shadowbox/shadowbox.css?<?php echo $this->_rootref['S_ABBC3_VERSION'] ?? ''; ?>" />
	<script type="text/javascript" src="<?php echo $this->_rootref['S_ABBC3_PATH'] ?? ''; ?>/shadowbox/shadowbox.js?<?php echo $this->_rootref['S_ABBC3_VERSION'] ?? ''; ?>"></script>
	<?php } ?>


	<script type="text/javascript">
	// <![CDATA[
		var ImageResizerUseBar				= <?php echo $this->_rootref['S_ABBC3_RESIZE_BAR'] ?? ''; ?>;
		var ImageResizerMode				= "<?php echo $this->_rootref['S_ABBC3_RESIZE_METHOD'] ?? ''; ?>";
		var ImageResizerMaxWidth_post		= <?php echo $this->_rootref['S_ABBC3_MAX_IMG_WIDTH'] ?? ''; ?>;
		var ImageResizerMaxHeight_post		= <?php echo $this->_rootref['S_ABBC3_MAX_IMG_HEIGHT'] ?? ''; ?>;
		var ImageResizerSignature			= <?php echo $this->_rootref['S_ABBC3_RESIZE_SIGNATURE'] ?? ''; ?>;
		var ImageResizerMaxWidth_sig		= <?php echo $this->_rootref['S_ABBC3_MAX_SIG_WIDTH'] ?? ''; ?>;
		var ImageResizerMaxHeight_sig		= <?php echo $this->_rootref['S_ABBC3_MAX_SIG_HEIGHT'] ?? ''; ?>;
		var ImageResizerWarningSmall		= "<?php echo ((isset($this->_rootref['LA_ABBC3_RESIZE_SMALL'])) ? $this->_rootref['LA_ABBC3_RESIZE_SMALL'] : ((isset($this->_rootref['L_ABBC3_RESIZE_SMALL'])) ? addslashes($this->_rootref['L_ABBC3_RESIZE_SMALL']) : ((isset($user->lang['ABBC3_RESIZE_SMALL'])) ? addslashes($user->lang['ABBC3_RESIZE_SMALL']) : '{ ABBC3_RESIZE_SMALL }'))); ?>";
		var ImageResizerWarningFullsize		= "<?php echo ((isset($this->_rootref['LA_ABBC3_RESIZE_FULLSIZE'])) ? $this->_rootref['LA_ABBC3_RESIZE_FULLSIZE'] : ((isset($this->_rootref['L_ABBC3_RESIZE_FULLSIZE'])) ? addslashes($this->_rootref['L_ABBC3_RESIZE_FULLSIZE']) : ((isset($user->lang['ABBC3_RESIZE_FULLSIZE'])) ? addslashes($user->lang['ABBC3_RESIZE_FULLSIZE']) : '{ ABBC3_RESIZE_FULLSIZE }'))); ?>";
		var ImageResizerWarningFilesize		= "<?php echo ((isset($this->_rootref['LA_ABBC3_RESIZE_FILESIZE'])) ? $this->_rootref['LA_ABBC3_RESIZE_FILESIZE'] : ((isset($this->_rootref['L_ABBC3_RESIZE_FILESIZE'])) ? addslashes($this->_rootref['L_ABBC3_RESIZE_FILESIZE']) : ((isset($user->lang['ABBC3_RESIZE_FILESIZE'])) ? addslashes($user->lang['ABBC3_RESIZE_FILESIZE']) : '{ ABBC3_RESIZE_FILESIZE }'))); ?>";
		var ImageResizerWarningNoFilesize	= "<?php echo ((isset($this->_rootref['LA_ABBC3_RESIZE_NOFILESIZE'])) ? $this->_rootref['LA_ABBC3_RESIZE_NOFILESIZE'] : ((isset($this->_rootref['L_ABBC3_RESIZE_NOFILESIZE'])) ? addslashes($this->_rootref['L_ABBC3_RESIZE_NOFILESIZE']) : ((isset($user->lang['ABBC3_RESIZE_NOFILESIZE'])) ? addslashes($user->lang['ABBC3_RESIZE_NOFILESIZE']) : '{ ABBC3_RESIZE_NOFILESIZE }'))); ?>";
		var ImageResizerMaxWidth			= 0;
		var ImageResizerMaxHeight			= 0;
	<?php if (($this->_rootref['S_ABBC3_RESIZE_METHOD'] ?? null) == ('AdvancedBox')) {  ?>

	/** Image Resizer JS and AdvancedBox JS - Start **/
		var ImageResizerNumberOf			= "<?php echo ((isset($this->_rootref['LA_ABBC3_RESIZE_NUMBER'])) ? $this->_rootref['LA_ABBC3_RESIZE_NUMBER'] : ((isset($this->_rootref['L_ABBC3_RESIZE_NUMBER'])) ? addslashes($this->_rootref['L_ABBC3_RESIZE_NUMBER']) : ((isset($user->lang['ABBC3_RESIZE_NUMBER'])) ? addslashes($user->lang['ABBC3_RESIZE_NUMBER']) : '{ ABBC3_RESIZE_NUMBER }'))); ?>";
		var ImageResizerNextAlt				= "<?php echo ((isset($this->_rootref['LA_NEXT'])) ? $this->_rootref['LA_NEXT'] : ((isset($this->_rootref['L_NEXT'])) ? addslashes($this->_rootref['L_NEXT']) : ((isset($user->lang['NEXT'])) ? addslashes($user->lang['NEXT']) : '{ NEXT }'))); ?>";
		var ImageResizerPrevtAlt			= "<?php echo ((isset($this->_rootref['LA_PREVIOUS'])) ? $this->_rootref['LA_PREVIOUS'] : ((isset($this->_rootref['L_PREVIOUS'])) ? addslashes($this->_rootref['L_PREVIOUS']) : ((isset($user->lang['PREVIOUS'])) ? addslashes($user->lang['PREVIOUS']) : '{ PREVIOUS }'))); ?>";
		var ImageResizerPlayAlt				= "<?php echo ((isset($this->_rootref['LA_ABBC3_RESIZE_PLAY'])) ? $this->_rootref['LA_ABBC3_RESIZE_PLAY'] : ((isset($this->_rootref['L_ABBC3_RESIZE_PLAY'])) ? addslashes($this->_rootref['L_ABBC3_RESIZE_PLAY']) : ((isset($user->lang['ABBC3_RESIZE_PLAY'])) ? addslashes($user->lang['ABBC3_RESIZE_PLAY']) : '{ ABBC3_RESIZE_PLAY }'))); ?>";
		var ImageResizerPauseAlt			= "<?php echo ((isset($this->_rootref['LA_ABBC3_RESIZE_PAUSE'])) ? $this->_rootref['LA_ABBC3_RESIZE_PAUSE'] : ((isset($this->_rootref['L_ABBC3_RESIZE_PAUSE'])) ? addslashes($this->_rootref['L_ABBC3_RESIZE_PAUSE']) : ((isset($user->lang['ABBC3_RESIZE_PAUSE'])) ? addslashes($user->lang['ABBC3_RESIZE_PAUSE']) : '{ ABBC3_RESIZE_PAUSE }'))); ?>";
		var ImageResizerZoomInAlt			= "<?php echo ((isset($this->_rootref['LA_ABBC3_RESIZE_ZOOM_IN'])) ? $this->_rootref['LA_ABBC3_RESIZE_ZOOM_IN'] : ((isset($this->_rootref['L_ABBC3_RESIZE_ZOOM_IN'])) ? addslashes($this->_rootref['L_ABBC3_RESIZE_ZOOM_IN']) : ((isset($user->lang['ABBC3_RESIZE_ZOOM_IN'])) ? addslashes($user->lang['ABBC3_RESIZE_ZOOM_IN']) : '{ ABBC3_RESIZE_ZOOM_IN }'))); ?>";
		var ImageResizerZoomOutAlt			= "<?php echo ((isset($this->_rootref['LA_ABBC3_RESIZE_ZOOM_OUT'])) ? $this->_rootref['LA_ABBC3_RESIZE_ZOOM_OUT'] : ((isset($this->_rootref['L_ABBC3_RESIZE_ZOOM_OUT'])) ? addslashes($this->_rootref['L_ABBC3_RESIZE_ZOOM_OUT']) : ((isset($user->lang['ABBC3_RESIZE_ZOOM_OUT'])) ? addslashes($user->lang['ABBC3_RESIZE_ZOOM_OUT']) : '{ ABBC3_RESIZE_ZOOM_OUT }'))); ?>";
		var ImageResizerCloseAlt			= "<?php echo ((isset($this->_rootref['LA_ABBC3_RESIZE_CLOSE'])) ? $this->_rootref['LA_ABBC3_RESIZE_CLOSE'] : ((isset($this->_rootref['L_ABBC3_RESIZE_CLOSE'])) ? addslashes($this->_rootref['L_ABBC3_RESIZE_CLOSE']) : ((isset($user->lang['ABBC3_RESIZE_CLOSE'])) ? addslashes($user->lang['ABBC3_RESIZE_CLOSE']) : '{ ABBC3_RESIZE_CLOSE }'))); ?>";
		var ImageResizerBlankImage			= "<?php echo $this->_rootref['S_ABBC3_PATH'] ?? ''; ?>/advancedbox_blank.gif";
	/** Image Resizer JS and AdvancedBox JS - End **/
	<?php } if (($this->_rootref['S_ABBC3_RESIZE_METHOD'] ?? null) == ('HighslideBox')) {  ?>

	/** Image Resizer JS with Highslide JS - End **/
		// Language strings
		hs.lang = {
			loadingText:		"<?php echo ((isset($this->_rootref['LA_ABBC3_HIGHSLIDE_LOADINGTEXT'])) ? $this->_rootref['LA_ABBC3_HIGHSLIDE_LOADINGTEXT'] : ((isset($this->_rootref['L_ABBC3_HIGHSLIDE_LOADINGTEXT'])) ? addslashes($this->_rootref['L_ABBC3_HIGHSLIDE_LOADINGTEXT']) : ((isset($user->lang['ABBC3_HIGHSLIDE_LOADINGTEXT'])) ? addslashes($user->lang['ABBC3_HIGHSLIDE_LOADINGTEXT']) : '{ ABBC3_HIGHSLIDE_LOADINGTEXT }'))); ?>",
			loadingTitle:		"<?php echo ((isset($this->_rootref['LA_ABBC3_HIGHSLIDE_LOADINGTITLE'])) ? $this->_rootref['LA_ABBC3_HIGHSLIDE_LOADINGTITLE'] : ((isset($this->_rootref['L_ABBC3_HIGHSLIDE_LOADINGTITLE'])) ? addslashes($this->_rootref['L_ABBC3_HIGHSLIDE_LOADINGTITLE']) : ((isset($user->lang['ABBC3_HIGHSLIDE_LOADINGTITLE'])) ? addslashes($user->lang['ABBC3_HIGHSLIDE_LOADINGTITLE']) : '{ ABBC3_HIGHSLIDE_LOADINGTITLE }'))); ?>",
			focusTitle:			"<?php echo ((isset($this->_rootref['LA_ABBC3_HIGHSLIDE_FOCUSTITLE'])) ? $this->_rootref['LA_ABBC3_HIGHSLIDE_FOCUSTITLE'] : ((isset($this->_rootref['L_ABBC3_HIGHSLIDE_FOCUSTITLE'])) ? addslashes($this->_rootref['L_ABBC3_HIGHSLIDE_FOCUSTITLE']) : ((isset($user->lang['ABBC3_HIGHSLIDE_FOCUSTITLE'])) ? addslashes($user->lang['ABBC3_HIGHSLIDE_FOCUSTITLE']) : '{ ABBC3_HIGHSLIDE_FOCUSTITLE }'))); ?>",
			fullExpandTitle:	"<?php echo ((isset($this->_rootref['LA_ABBC3_HIGHSLIDE_FULLEXPANDTITLE'])) ? $this->_rootref['LA_ABBC3_HIGHSLIDE_FULLEXPANDTITLE'] : ((isset($this->_rootref['L_ABBC3_HIGHSLIDE_FULLEXPANDTITLE'])) ? addslashes($this->_rootref['L_ABBC3_HIGHSLIDE_FULLEXPANDTITLE']) : ((isset($user->lang['ABBC3_HIGHSLIDE_FULLEXPANDTITLE'])) ? addslashes($user->lang['ABBC3_HIGHSLIDE_FULLEXPANDTITLE']) : '{ ABBC3_HIGHSLIDE_FULLEXPANDTITLE }'))); ?>",
			fullExpandText:		"<?php echo ((isset($this->_rootref['LA_ABBC3_HIGHSLIDE_FULLEXPANDTEXT'])) ? $this->_rootref['LA_ABBC3_HIGHSLIDE_FULLEXPANDTEXT'] : ((isset($this->_rootref['L_ABBC3_HIGHSLIDE_FULLEXPANDTEXT'])) ? addslashes($this->_rootref['L_ABBC3_HIGHSLIDE_FULLEXPANDTEXT']) : ((isset($user->lang['ABBC3_HIGHSLIDE_FULLEXPANDTEXT'])) ? addslashes($user->lang['ABBC3_HIGHSLIDE_FULLEXPANDTEXT']) : '{ ABBC3_HIGHSLIDE_FULLEXPANDTEXT }'))); ?>",
			creditsText:		"<?php echo ((isset($this->_rootref['LA_ABBC3_HIGHSLIDE_CREDITSTEXT'])) ? $this->_rootref['LA_ABBC3_HIGHSLIDE_CREDITSTEXT'] : ((isset($this->_rootref['L_ABBC3_HIGHSLIDE_CREDITSTEXT'])) ? addslashes($this->_rootref['L_ABBC3_HIGHSLIDE_CREDITSTEXT']) : ((isset($user->lang['ABBC3_HIGHSLIDE_CREDITSTEXT'])) ? addslashes($user->lang['ABBC3_HIGHSLIDE_CREDITSTEXT']) : '{ ABBC3_HIGHSLIDE_CREDITSTEXT }'))); ?>",
			creditsTitle:		"<?php echo ((isset($this->_rootref['LA_ABBC3_HIGHSLIDE_CREDITSTITLE'])) ? $this->_rootref['LA_ABBC3_HIGHSLIDE_CREDITSTITLE'] : ((isset($this->_rootref['L_ABBC3_HIGHSLIDE_CREDITSTITLE'])) ? addslashes($this->_rootref['L_ABBC3_HIGHSLIDE_CREDITSTITLE']) : ((isset($user->lang['ABBC3_HIGHSLIDE_CREDITSTITLE'])) ? addslashes($user->lang['ABBC3_HIGHSLIDE_CREDITSTITLE']) : '{ ABBC3_HIGHSLIDE_CREDITSTITLE }'))); ?>",
			previousText:		"<?php echo ((isset($this->_rootref['LA_ABBC3_HIGHSLIDE_PREVIOUSTEXT'])) ? $this->_rootref['LA_ABBC3_HIGHSLIDE_PREVIOUSTEXT'] : ((isset($this->_rootref['L_ABBC3_HIGHSLIDE_PREVIOUSTEXT'])) ? addslashes($this->_rootref['L_ABBC3_HIGHSLIDE_PREVIOUSTEXT']) : ((isset($user->lang['ABBC3_HIGHSLIDE_PREVIOUSTEXT'])) ? addslashes($user->lang['ABBC3_HIGHSLIDE_PREVIOUSTEXT']) : '{ ABBC3_HIGHSLIDE_PREVIOUSTEXT }'))); ?>",
			previousTitle:		"<?php echo ((isset($this->_rootref['LA_ABBC3_HIGHSLIDE_PREVIOUSTITLE'])) ? $this->_rootref['LA_ABBC3_HIGHSLIDE_PREVIOUSTITLE'] : ((isset($this->_rootref['L_ABBC3_HIGHSLIDE_PREVIOUSTITLE'])) ? addslashes($this->_rootref['L_ABBC3_HIGHSLIDE_PREVIOUSTITLE']) : ((isset($user->lang['ABBC3_HIGHSLIDE_PREVIOUSTITLE'])) ? addslashes($user->lang['ABBC3_HIGHSLIDE_PREVIOUSTITLE']) : '{ ABBC3_HIGHSLIDE_PREVIOUSTITLE }'))); ?>",
			nextText:			"<?php echo ((isset($this->_rootref['LA_ABBC3_HIGHSLIDE_NEXTTEXT'])) ? $this->_rootref['LA_ABBC3_HIGHSLIDE_NEXTTEXT'] : ((isset($this->_rootref['L_ABBC3_HIGHSLIDE_NEXTTEXT'])) ? addslashes($this->_rootref['L_ABBC3_HIGHSLIDE_NEXTTEXT']) : ((isset($user->lang['ABBC3_HIGHSLIDE_NEXTTEXT'])) ? addslashes($user->lang['ABBC3_HIGHSLIDE_NEXTTEXT']) : '{ ABBC3_HIGHSLIDE_NEXTTEXT }'))); ?>",
			nextTitle:			"<?php echo ((isset($this->_rootref['LA_ABBC3_HIGHSLIDE_NEXTTITLE'])) ? $this->_rootref['LA_ABBC3_HIGHSLIDE_NEXTTITLE'] : ((isset($this->_rootref['L_ABBC3_HIGHSLIDE_NEXTTITLE'])) ? addslashes($this->_rootref['L_ABBC3_HIGHSLIDE_NEXTTITLE']) : ((isset($user->lang['ABBC3_HIGHSLIDE_NEXTTITLE'])) ? addslashes($user->lang['ABBC3_HIGHSLIDE_NEXTTITLE']) : '{ ABBC3_HIGHSLIDE_NEXTTITLE }'))); ?>",
			moveTitle:			"<?php echo ((isset($this->_rootref['LA_ABBC3_HIGHSLIDE_MOVETITLE'])) ? $this->_rootref['LA_ABBC3_HIGHSLIDE_MOVETITLE'] : ((isset($this->_rootref['L_ABBC3_HIGHSLIDE_MOVETITLE'])) ? addslashes($this->_rootref['L_ABBC3_HIGHSLIDE_MOVETITLE']) : ((isset($user->lang['ABBC3_HIGHSLIDE_MOVETITLE'])) ? addslashes($user->lang['ABBC3_HIGHSLIDE_MOVETITLE']) : '{ ABBC3_HIGHSLIDE_MOVETITLE }'))); ?>",
			moveText:			"<?php echo ((isset($this->_rootref['LA_ABBC3_HIGHSLIDE_MOVETEXT'])) ? $this->_rootref['LA_ABBC3_HIGHSLIDE_MOVETEXT'] : ((isset($this->_rootref['L_ABBC3_HIGHSLIDE_MOVETEXT'])) ? addslashes($this->_rootref['L_ABBC3_HIGHSLIDE_MOVETEXT']) : ((isset($user->lang['ABBC3_HIGHSLIDE_MOVETEXT'])) ? addslashes($user->lang['ABBC3_HIGHSLIDE_MOVETEXT']) : '{ ABBC3_HIGHSLIDE_MOVETEXT }'))); ?>",
			closeText:			"<?php echo ((isset($this->_rootref['LA_ABBC3_HIGHSLIDE_CLOSETEXT'])) ? $this->_rootref['LA_ABBC3_HIGHSLIDE_CLOSETEXT'] : ((isset($this->_rootref['L_ABBC3_HIGHSLIDE_CLOSETEXT'])) ? addslashes($this->_rootref['L_ABBC3_HIGHSLIDE_CLOSETEXT']) : ((isset($user->lang['ABBC3_HIGHSLIDE_CLOSETEXT'])) ? addslashes($user->lang['ABBC3_HIGHSLIDE_CLOSETEXT']) : '{ ABBC3_HIGHSLIDE_CLOSETEXT }'))); ?>",
			closeTitle:			"<?php echo ((isset($this->_rootref['LA_ABBC3_HIGHSLIDE_CLOSETITLE'])) ? $this->_rootref['LA_ABBC3_HIGHSLIDE_CLOSETITLE'] : ((isset($this->_rootref['L_ABBC3_HIGHSLIDE_CLOSETITLE'])) ? addslashes($this->_rootref['L_ABBC3_HIGHSLIDE_CLOSETITLE']) : ((isset($user->lang['ABBC3_HIGHSLIDE_CLOSETITLE'])) ? addslashes($user->lang['ABBC3_HIGHSLIDE_CLOSETITLE']) : '{ ABBC3_HIGHSLIDE_CLOSETITLE }'))); ?>",
			resizeTitle:		"<?php echo ((isset($this->_rootref['LA_ABBC3_HIGHSLIDE_RESIZETITLE'])) ? $this->_rootref['LA_ABBC3_HIGHSLIDE_RESIZETITLE'] : ((isset($this->_rootref['L_ABBC3_HIGHSLIDE_RESIZETITLE'])) ? addslashes($this->_rootref['L_ABBC3_HIGHSLIDE_RESIZETITLE']) : ((isset($user->lang['ABBC3_HIGHSLIDE_RESIZETITLE'])) ? addslashes($user->lang['ABBC3_HIGHSLIDE_RESIZETITLE']) : '{ ABBC3_HIGHSLIDE_RESIZETITLE }'))); ?>",
			number:				"<?php echo ((isset($this->_rootref['LA_ABBC3_HIGHSLIDE_NUMBER'])) ? $this->_rootref['LA_ABBC3_HIGHSLIDE_NUMBER'] : ((isset($this->_rootref['L_ABBC3_HIGHSLIDE_NUMBER'])) ? addslashes($this->_rootref['L_ABBC3_HIGHSLIDE_NUMBER']) : ((isset($user->lang['ABBC3_HIGHSLIDE_NUMBER'])) ? addslashes($user->lang['ABBC3_HIGHSLIDE_NUMBER']) : '{ ABBC3_HIGHSLIDE_NUMBER }'))); ?>",
			playText:			"<?php echo ((isset($this->_rootref['LA_ABBC3_HIGHSLIDE_PLAYTEXT'])) ? $this->_rootref['LA_ABBC3_HIGHSLIDE_PLAYTEXT'] : ((isset($this->_rootref['L_ABBC3_HIGHSLIDE_PLAYTEXT'])) ? addslashes($this->_rootref['L_ABBC3_HIGHSLIDE_PLAYTEXT']) : ((isset($user->lang['ABBC3_HIGHSLIDE_PLAYTEXT'])) ? addslashes($user->lang['ABBC3_HIGHSLIDE_PLAYTEXT']) : '{ ABBC3_HIGHSLIDE_PLAYTEXT }'))); ?>",
			playTitle:			"<?php echo ((isset($this->_rootref['LA_ABBC3_HIGHSLIDE_PLAYTITLE'])) ? $this->_rootref['LA_ABBC3_HIGHSLIDE_PLAYTITLE'] : ((isset($this->_rootref['L_ABBC3_HIGHSLIDE_PLAYTITLE'])) ? addslashes($this->_rootref['L_ABBC3_HIGHSLIDE_PLAYTITLE']) : ((isset($user->lang['ABBC3_HIGHSLIDE_PLAYTITLE'])) ? addslashes($user->lang['ABBC3_HIGHSLIDE_PLAYTITLE']) : '{ ABBC3_HIGHSLIDE_PLAYTITLE }'))); ?>",
			pauseText:			"<?php echo ((isset($this->_rootref['LA_ABBC3_HIGHSLIDE_PAUSETEXT'])) ? $this->_rootref['LA_ABBC3_HIGHSLIDE_PAUSETEXT'] : ((isset($this->_rootref['L_ABBC3_HIGHSLIDE_PAUSETEXT'])) ? addslashes($this->_rootref['L_ABBC3_HIGHSLIDE_PAUSETEXT']) : ((isset($user->lang['ABBC3_HIGHSLIDE_PAUSETEXT'])) ? addslashes($user->lang['ABBC3_HIGHSLIDE_PAUSETEXT']) : '{ ABBC3_HIGHSLIDE_PAUSETEXT }'))); ?>",
			pauseTitle:			"<?php echo ((isset($this->_rootref['LA_ABBC3_HIGHSLIDE_PAUSETITLE'])) ? $this->_rootref['LA_ABBC3_HIGHSLIDE_PAUSETITLE'] : ((isset($this->_rootref['L_ABBC3_HIGHSLIDE_PAUSETITLE'])) ? addslashes($this->_rootref['L_ABBC3_HIGHSLIDE_PAUSETITLE']) : ((isset($user->lang['ABBC3_HIGHSLIDE_PAUSETITLE'])) ? addslashes($user->lang['ABBC3_HIGHSLIDE_PAUSETITLE']) : '{ ABBC3_HIGHSLIDE_PAUSETITLE }'))); ?>",
			restoreTitle:		"<?php echo ((isset($this->_rootref['LA_ABBC3_HIGHSLIDE_RESTORETITLE'])) ? $this->_rootref['LA_ABBC3_HIGHSLIDE_RESTORETITLE'] : ((isset($this->_rootref['L_ABBC3_HIGHSLIDE_RESTORETITLE'])) ? addslashes($this->_rootref['L_ABBC3_HIGHSLIDE_RESTORETITLE']) : ((isset($user->lang['ABBC3_HIGHSLIDE_RESTORETITLE'])) ? addslashes($user->lang['ABBC3_HIGHSLIDE_RESTORETITLE']) : '{ ABBC3_HIGHSLIDE_RESTORETITLE }'))); ?>"
		};

		// override the settings defined at the top of the highslide.js file.
		hs.graphicsDir = "<?php echo $this->_rootref['S_ABBC3_PATH'] ?? ''; ?>/highslide/graphics/";
		hs.align = 'center';
		hs.transitions = ['expand', 'crossfade'];
		hs.outlineType = 'rounded-white' /* 'glossy-dark' */;
		hs.wrapperClassName = 'dark' /* 'controls-in-heading' */;
		hs.fadeInOut = true;
		hs.dimmingOpacity = 0.75;
		hs.marginTop = 25;
		hs.thumbnailId = null;
		hs.showCredits = false;
		hs.numberPosition = 'caption';
		hs.captionEval = 'this.a.title';
		hs.useBox = false /* true */;
		hs.width = 600;
		hs.height = 400;

		// Add the controlbar
		if (hs.addSlideshow) hs.addSlideshow({
			slideshowGroup: 'gallery',
			interval: 5000,
			repeat: false,
			useControls: true,
			fixedControls: false /* 'fit' */,
			overlayOptions: {
				position: 'bottom right',
				hideOnMouseOut: true /* false */,
				opacity: 0.75
		//	},
		//	thumbstrip: {
		//		position: 'above',
		//		mode: 'horizontal',
		//		relativeTo: 'expander'
			}
		});
	/** Image Resizer JS with Highslide JS - End **/
	<?php } ?>


	// ]]>
	</script>

	<?php if (($this->_rootref['S_ABBC3_RESIZE_METHOD'] ?? null) == ('AdvancedBox')) {  ?>

	<script type="text/javascript" src="<?php echo $this->_rootref['S_ABBC3_PATH'] ?? ''; ?>/AdvancedBox.js?<?php echo $this->_rootref['S_ABBC3_VERSION'] ?? ''; ?>"></script>
	<?php } ?>


	<script type="text/javascript" src="<?php echo $this->_rootref['S_ABBC3_PATH'] ?? ''; ?>/abbcode_ImgResizer.js?<?php echo $this->_rootref['S_ABBC3_VERSION'] ?? ''; ?>"></script>
	
	<?php if (($this->_rootref['S_ABBC3_RESIZE_BAR'] ?? null)) {  ?>

	<style type="text/css">.attach-image img { border: 0; }</style>
	<?php } } } ?>