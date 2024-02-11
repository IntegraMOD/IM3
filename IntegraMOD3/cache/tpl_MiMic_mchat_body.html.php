<?php if (!defined('IN_PHPBB')) exit; if (($this->_rootref['MCHAT_ARCHIVE_MODE'] ?? null) || ($this->_rootref['MCHAT_CUSTOM_PAGE'] ?? null)) {  $this->_tpl_include('overall_header.html'); } if (($this->_rootref['MCHAT_ARCHIVE_MODE'] ?? null)) {  ?>

<!--**
*
* @package mChat
* @version $Id: mchat_body.html
* @copyright (c) 2010 Rich McGirr
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/-->
<ul class="linklist">
	<li class="rightside pagination"><?php echo $this->_rootref['MCHAT_TOTAL_MESSAGES'] ?? ''; ?> &bull; <?php if (($this->_rootref['MCHAT_PAGINATION'] ?? null)) {  ?><a href="#" onclick="jumpto(); return false;" title="<?php echo ((isset($this->_rootref['L_JUMP_TO_PAGE'])) ? $this->_rootref['L_JUMP_TO_PAGE'] : ((isset($user->lang['JUMP_TO_PAGE'])) ? $user->lang['JUMP_TO_PAGE'] : '{ JUMP_TO_PAGE }')); ?>"><?php echo $this->_rootref['MCHAT_PAGE_NUMBER'] ?? ''; ?></a> &bull; <span><?php echo $this->_rootref['MCHAT_PAGINATION'] ?? ''; ?></span><?php } else { echo $this->_rootref['MCHAT_PAGE_NUMBER'] ?? ''; } ?></li>
</ul>
<?php } if (! ($this->_rootref['MCHAT_READ_MODE'] ?? null)) {  ?>

<div class="forabg">
	<div class="inner"><span><a name="mChat"></a></span>
		<ul class="topiclist">
			<li class="header">
				<dl class="icon">
					<dt><?php if (($this->_rootref['MCHAT_ARCHIVE_MODE'] ?? null)) {  echo ((isset($this->_rootref['L_MCHAT_ARCHIVE_PAGE'])) ? $this->_rootref['L_MCHAT_ARCHIVE_PAGE'] : ((isset($user->lang['MCHAT_ARCHIVE_PAGE'])) ? $user->lang['MCHAT_ARCHIVE_PAGE'] : '{ MCHAT_ARCHIVE_PAGE }')); } else { echo ((isset($this->_rootref['L_MCHAT_TITLE'])) ? $this->_rootref['L_MCHAT_TITLE'] : ((isset($user->lang['MCHAT_TITLE'])) ? $user->lang['MCHAT_TITLE'] : '{ MCHAT_TITLE }')); } ?></dt>
				</dl>
			</li>
		</ul>
		<div class="panel">
<?php } if (($this->_rootref['MCHAT_ENABLE'] ?? null)) {  if (! ($this->_rootref['MCHAT_READ_MODE'] ?? null)) {  ?>

			<script>
			// <![CDATA[
			// Define mChat setting
			var mChatNoMessage = '<?php echo $this->_rootref['MCHAT_NOMESSAGE_MODE'] ?? ''; ?>';
			var mChatFile = '<?php echo $this->_rootref['MCHAT_FILE_NAME'] ?? ''; ?>';
			var mChatForumRoot = '<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>';
			var mChatCustomPage = '<?php echo $this->_rootref['MCHAT_CUSTOM_PAGE'] ?? ''; ?>';
			<?php if (! ($this->_rootref['MCHAT_ARCHIVE_MODE'] ?? null)) {  ?>

			var mChatPause = '<?php echo $this->_rootref['MCHAT_PAUSE_ON_INPUT'] ?? ''; ?>';
			var mChatRefresh = '<?php echo $this->_rootref['MCHAT_REFRESH_JS'] ?? ''; ?>';
			<?php } else { ?>

			var mChatPause = false;
			var mChatRefresh = false;
			<?php } if (($this->_rootref['MCHAT_USER_TIMEOUT'] ?? null)) {  ?>

			var mChatUserTimeout = '<?php echo $this->_rootref['MCHAT_USER_TIMEOUT'] ?? ''; ?>';
			<?php } else { ?>

			var mChatUserTimeout = false;
			<?php } ?>

			var mChatNoMessageInput = '<?php echo ((isset($this->_rootref['LA_MCHAT_NOMESSAGEINPUT'])) ? $this->_rootref['LA_MCHAT_NOMESSAGEINPUT'] : ((isset($this->_rootref['L_MCHAT_NOMESSAGEINPUT'])) ? addslashes($this->_rootref['L_MCHAT_NOMESSAGEINPUT']) : ((isset($user->lang['MCHAT_NOMESSAGEINPUT'])) ? addslashes($user->lang['MCHAT_NOMESSAGEINPUT']) : '{ MCHAT_NOMESSAGEINPUT }'))); ?>';
			var mChatNoMessage = '<?php echo ((isset($this->_rootref['LA_MCHAT_NOMESSAGE'])) ? $this->_rootref['LA_MCHAT_NOMESSAGE'] : ((isset($this->_rootref['L_MCHAT_NOMESSAGE'])) ? addslashes($this->_rootref['L_MCHAT_NOMESSAGE']) : ((isset($user->lang['MCHAT_NOMESSAGE'])) ? addslashes($user->lang['MCHAT_NOMESSAGE']) : '{ MCHAT_NOMESSAGE }'))); ?>';
			var mChatEditInfo = '<?php echo ((isset($this->_rootref['LA_MCHAT_EDITINFO'])) ? $this->_rootref['LA_MCHAT_EDITINFO'] : ((isset($this->_rootref['L_MCHAT_EDITINFO'])) ? addslashes($this->_rootref['L_MCHAT_EDITINFO']) : ((isset($user->lang['MCHAT_EDITINFO'])) ? addslashes($user->lang['MCHAT_EDITINFO']) : '{ MCHAT_EDITINFO }'))); ?>';
			var mChatNoAccess = '<?php echo ((isset($this->_rootref['LA_MCHAT_NOACCESS'])) ? $this->_rootref['LA_MCHAT_NOACCESS'] : ((isset($this->_rootref['L_MCHAT_NOACCESS'])) ? addslashes($this->_rootref['L_MCHAT_NOACCESS']) : ((isset($user->lang['MCHAT_NOACCESS'])) ? addslashes($user->lang['MCHAT_NOACCESS']) : '{ MCHAT_NOACCESS }'))); ?>';
			var mChatFlood = '<?php echo ((isset($this->_rootref['LA_MCHAT_FLOOD'])) ? $this->_rootref['LA_MCHAT_FLOOD'] : ((isset($this->_rootref['L_MCHAT_FLOOD'])) ? addslashes($this->_rootref['L_MCHAT_FLOOD']) : ((isset($user->lang['MCHAT_FLOOD'])) ? addslashes($user->lang['MCHAT_FLOOD']) : '{ MCHAT_FLOOD }'))); ?>';
			var mChatDelConfirm = '<?php echo ((isset($this->_rootref['LA_MCHAT_DELCONFIRM'])) ? $this->_rootref['LA_MCHAT_DELCONFIRM'] : ((isset($this->_rootref['L_MCHAT_DELCONFIRM'])) ? addslashes($this->_rootref['L_MCHAT_DELCONFIRM']) : ((isset($user->lang['MCHAT_DELCONFIRM'])) ? addslashes($user->lang['MCHAT_DELCONFIRM']) : '{ MCHAT_DELCONFIRM }'))); ?>';
			var mChatReset = '<?php echo ((isset($this->_rootref['LA_MCHAT_RESET_QUESTION'])) ? $this->_rootref['LA_MCHAT_RESET_QUESTION'] : ((isset($this->_rootref['L_MCHAT_RESET_QUESTION'])) ? addslashes($this->_rootref['L_MCHAT_RESET_QUESTION']) : ((isset($user->lang['MCHAT_RESET_QUESTION'])) ? addslashes($user->lang['MCHAT_RESET_QUESTION']) : '{ MCHAT_RESET_QUESTION }'))); ?>';
			var mChatRefreshing = '<?php echo ((isset($this->_rootref['LA_MCHAT_REFRESHING'])) ? $this->_rootref['LA_MCHAT_REFRESHING'] : ((isset($this->_rootref['L_MCHAT_REFRESHING'])) ? addslashes($this->_rootref['L_MCHAT_REFRESHING']) : ((isset($user->lang['MCHAT_REFRESHING'])) ? addslashes($user->lang['MCHAT_REFRESHING']) : '{ MCHAT_REFRESHING }'))); ?>';
			var mChatSessOut = '<?php echo ((isset($this->_rootref['LA_MCHAT_SESSION_OUT'])) ? $this->_rootref['LA_MCHAT_SESSION_OUT'] : ((isset($this->_rootref['L_MCHAT_SESSION_OUT'])) ? addslashes($this->_rootref['L_MCHAT_SESSION_OUT']) : ((isset($user->lang['MCHAT_SESSION_OUT'])) ? addslashes($user->lang['MCHAT_SESSION_OUT']) : '{ MCHAT_SESSION_OUT }'))); ?>';
			var mChatSessEnds = '<?php echo ((isset($this->_rootref['LA_MCHAT_SESSION_ENDS'])) ? $this->_rootref['LA_MCHAT_SESSION_ENDS'] : ((isset($this->_rootref['L_MCHAT_SESSION_ENDS'])) ? addslashes($this->_rootref['L_MCHAT_SESSION_ENDS']) : ((isset($user->lang['MCHAT_SESSION_ENDS'])) ? addslashes($user->lang['MCHAT_SESSION_ENDS']) : '{ MCHAT_SESSION_ENDS }'))); ?>';
			var mChatRefreshYes = '<?php echo $this->_rootref['MCHAT_REFRESH_YES'] ?? ''; ?>';
			var mChatRefreshNo = '<?php echo ((isset($this->_rootref['LA_MCHAT_REFRESH_NO'])) ? $this->_rootref['LA_MCHAT_REFRESH_NO'] : ((isset($this->_rootref['L_MCHAT_REFRESH_NO'])) ? addslashes($this->_rootref['L_MCHAT_REFRESH_NO']) : ((isset($user->lang['MCHAT_REFRESH_NO'])) ? addslashes($user->lang['MCHAT_REFRESH_NO']) : '{ MCHAT_REFRESH_NO }'))); ?>';
			var mChatMssgLngthLong = '<?php echo $this->_rootref['MCHAT_MESS_LONG'] ?? ''; ?>';
			<?php if (($this->_rootref['MCHAT_MESSAGE_LNGTH'] ?? null)) {  ?>

			var mChatMssgLngth = '<?php echo $this->_rootref['MCHAT_MESSAGE_LNGTH'] ?? ''; ?>';
			<?php } else { ?>

			var mChatMssgLngth = false;
			<?php } if (($this->_rootref['S_MCHAT_SOUND_YES'] ?? null)) {  ?>

			var mChatSound = true;
			<?php } else { ?>

			var mChatSound = false;
			<?php } if (($this->_rootref['MCHAT_WHOIS'] ?? null)) {  ?>

			var mChatWhois = true;
			var mChatWhoisRefresh = '<?php echo $this->_rootref['MCHAT_WHOIS_REFRESH'] ?? ''; ?>';
			<?php } else { ?>

			var mChatWhois = false;
			var mChatWhoisRefresh = false;
			<?php } if (($this->_rootref['MCHAT_ARCHIVE_MODE'] ?? null)) {  ?>

			var mChatArchiveMode = true;
			<?php } else { ?>

			var mChatArchiveMode = false;
			var form_name = 'postform';
			var text_name = 'message';
			var mChatFocusFix = true;
			<?php } ?>

			// ]]>
			</script>
			<?php if (! ($this->_rootref['MCHAT_ARCHIVE_MODE'] ?? null)) {  ?>

            <script src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>assets/js/editor.js"></script>
			<div id="mChatmain" <?php if (($this->_rootref['MCHAT_CUSTOM_PAGE'] ?? null)) {  ?>class="mChatRowLimitCustom" style="height: <?php echo $this->_rootref['MCHAT_CUSTOM_HEIGHT'] ?? ''; ?>px;"<?php } else { ?>class="mChatRowLimit" style="height: <?php echo $this->_rootref['MCHAT_INDEX_HEIGHT'] ?? ''; ?>px;"<?php } ?>>
			<?php } ?>

			<div id="mChatData">
	<?php } if (($this->_rootref['S_MCHAT_AVATARS'] ?? null)) {  $this->_tpl_include('mchat_avatars.html'); } else { $this->_tpl_include('mchat_no_avatars.html'); } if (! ($this->_rootref['MCHAT_READ_MODE'] ?? null)) {  if (($this->_rootref['MCHAT_NOMESSAGE_MODE'] ?? null)) {  ?><div id="mChatNoMessage"><?php echo ((isset($this->_rootref['L_MCHAT_NOMESSAGE'])) ? $this->_rootref['L_MCHAT_NOMESSAGE'] : ((isset($user->lang['MCHAT_NOMESSAGE'])) ? $user->lang['MCHAT_NOMESSAGE'] : '{ MCHAT_NOMESSAGE }')); ?></div><?php } ?>

			</div>
			<?php if (! ($this->_rootref['MCHAT_ARCHIVE_MODE'] ?? null)) {  ?>			
			</div>
			<?php if (($this->_rootref['MCHAT_STATIC_MESS'] ?? null)) {  ?><div class="mChatStatic"><strong><?php echo ((isset($this->_rootref['L_MCHAT_ANNOUNCEMENT'])) ? $this->_rootref['L_MCHAT_ANNOUNCEMENT'] : ((isset($user->lang['MCHAT_ANNOUNCEMENT'])) ? $user->lang['MCHAT_ANNOUNCEMENT'] : '{ MCHAT_ANNOUNCEMENT }')); ?>:</strong> <span style="color:#990000;"><?php echo $this->_rootref['MCHAT_STATIC_MESS'] ?? ''; ?></span></div><?php } if (! ( ($this->_rootref['MCHAT_ARCHIVE_MODE'] ?? null) || ($this->_rootref['MCHAT_CUSTOM_PAGE'] ?? null) ) && ($this->_rootref['MCHAT_WHOIS'] ?? null) && ($this->_rootref['S_MCHAT_INDEX_STATS'] ?? null)) {  ?><div class="mChatStats" id="mChatStats"><?php if (($this->_rootref['MCHAT_USERS_LIST'] ?? null)) {  ?><a href="#" onclick="mChat.toggle('UserList'); return false;"><?php echo $this->_rootref['MCHAT_USERS_COUNT'] ?? ''; ?></a><?php } else { echo $this->_rootref['MCHAT_USERS_COUNT'] ?? ''; } ?>&nbsp;<?php echo ((isset($this->_rootref['L_MCHAT_ONLINE_EXPLAIN'])) ? $this->_rootref['L_MCHAT_ONLINE_EXPLAIN'] : ((isset($user->lang['MCHAT_ONLINE_EXPLAIN'])) ? $user->lang['MCHAT_ONLINE_EXPLAIN'] : '{ MCHAT_ONLINE_EXPLAIN }')); ?><br /><span id="mChatUserList"><?php echo $this->_rootref['MCHAT_USERS_LIST'] ?? ''; ?></span></div><?php } ?>			
			<form method="post" action="javascript://" onsubmit="mChat.add();" id="postform">
			<div class="mChatPanel">
				<noscript><div class="mchat_alert"><?php echo ((isset($this->_rootref['L_MCHAT_NOJAVASCRIPT'])) ? $this->_rootref['L_MCHAT_NOJAVASCRIPT'] : ((isset($user->lang['MCHAT_NOJAVASCRIPT'])) ? $user->lang['MCHAT_NOJAVASCRIPT'] : '{ MCHAT_NOJAVASCRIPT }')); ?></div></noscript>
				<?php if (($this->_rootref['MCHAT_ADD_MESSAGE'] ?? null)) {  ?>

				<input type="hidden" name="mode" value="add" />
				<?php if (($this->_rootref['MCHAT_INPUT_TYPE'] ?? null)) {  ?><input type="text" name="message" class="inputbox medium mChatText" id="mChatMessage" /><?php } else { ?>

				<textarea name="message" class="inputbox mChatText" id="mChatMessage" onkeypress="mChat.key(event);" cols="32" rows="5" style="width: 50em;height: 6em;"></textarea><?php } ?><br />
				<input id="submit_button" type="button" class="button2" onclick="mChat.add();" value="<?php echo ((isset($this->_rootref['L_MCHAT_ADD'])) ? $this->_rootref['L_MCHAT_ADD'] : ((isset($user->lang['MCHAT_ADD'])) ? $user->lang['MCHAT_ADD'] : '{ MCHAT_ADD }')); ?>" />
				<input id="mChatClear" type="button" class="button2" onclick="mChat.clear();" value="<?php echo ((isset($this->_rootref['L_MCHAT_CLEAR_INPUT'])) ? $this->_rootref['L_MCHAT_CLEAR_INPUT'] : ((isset($user->lang['MCHAT_CLEAR_INPUT'])) ? $user->lang['MCHAT_CLEAR_INPUT'] : '{ MCHAT_CLEAR_INPUT }')); ?>" />
				<?php if (($this->_rootref['MCHAT_ALLOW_SMILES'] ?? null) && !empty($this->_tpldata['smiley'])) {  ?>

				<input type="button" class="button2" onclick="mChat.toggle('Smiles');" value="<?php echo ((isset($this->_rootref['L_MCHAT_SMILES'])) ? $this->_rootref['L_MCHAT_SMILES'] : ((isset($user->lang['MCHAT_SMILES'])) ? $user->lang['MCHAT_SMILES'] : '{ MCHAT_SMILES }')); ?>" />
				<?php } if (($this->_rootref['MCHAT_ALLOW_BBCODES'] ?? null)) {  ?>

				<input type="button" class="button2" onclick="mChat.toggle('BBCodes');" value="<?php echo ((isset($this->_rootref['L_MCHAT_BBCODES'])) ? $this->_rootref['L_MCHAT_BBCODES'] : ((isset($user->lang['MCHAT_BBCODES'])) ? $user->lang['MCHAT_BBCODES'] : '{ MCHAT_BBCODES }')); ?>" />
				<?php } } if (($this->_rootref['MCHAT_READ_ARCHIVE_BUTTON'] ?? null)) {  ?>

				<input type="button" class="button2" onclick="window.location.href = '<?php echo $this->_rootref['MCHAT_ARCHIVE_URL'] ?? ''; ?>';" value="<?php echo ((isset($this->_rootref['L_MCHAT_ARCHIVE'])) ? $this->_rootref['L_MCHAT_ARCHIVE'] : ((isset($user->lang['MCHAT_ARCHIVE'])) ? $user->lang['MCHAT_ARCHIVE'] : '{ MCHAT_ARCHIVE }')); ?>" />
				<?php } if (($this->_rootref['MCHAT_FOUNDER'] ?? null)) {  ?>

				<input type="button" class="button2" onclick="window.location.href = '<?php echo $this->_rootref['MCHAT_CLEAN_URL'] ?? ''; ?>';" value="<?php echo ((isset($this->_rootref['L_MCHAT_CLEAN'])) ? $this->_rootref['L_MCHAT_CLEAN'] : ((isset($user->lang['MCHAT_CLEAN'])) ? $user->lang['MCHAT_CLEAN'] : '{ MCHAT_CLEAN }')); ?>" />
				<?php } if (($this->_rootref['MCHAT_ADD_MESSAGE'] ?? null)) {  if (($this->_rootref['MCHAT_RULES'] ?? null)) {  ?>

				<input type="button" class="button2" onclick="popup('<?php echo $this->_rootref['U_MCHAT_RULES'] ?? ''; ?>', 450, 275); return false;" value="<?php echo ((isset($this->_rootref['L_MCHAT_HELP'])) ? $this->_rootref['L_MCHAT_HELP'] : ((isset($user->lang['MCHAT_HELP'])) ? $user->lang['MCHAT_HELP'] : '{ MCHAT_HELP }')); ?>" />
				<?php } if (($this->_rootref['MCHAT_ALLOW_BBCODES'] ?? null)) {  $this->_tpl_include('mchat_bbcodes.html'); } } ?>

				<?php echo $this->_rootref['S_FORM_TOKEN'] ?? ''; ?>

				<?php if (($this->_rootref['MCHAT_ALLOW_SMILES'] ?? null) && !empty($this->_tpldata['smiley'])) {  ?>

				<div id="mChatSmiles" style="padding: 5px; display: none;">					
					<?php $_smiley_count = (isset($this->_tpldata['smiley']) && is_array($this->_tpldata['smiley'])) ? count($this->_tpldata['smiley']) : 0;if ($_smiley_count) {for ($_smiley_i = 0; $_smiley_i < $_smiley_count; ++$_smiley_i){$_smiley_val = &$this->_tpldata['smiley'][$_smiley_i]; ?>

					<a href="#" onclick="insert_text('<?php echo $_smiley_val['A_SMILEY_CODE']; ?>', true); return false;"><img src="<?php echo $_smiley_val['SMILEY_IMG']; ?>" width="<?php echo $_smiley_val['SMILEY_WIDTH']; ?>" height="<?php echo $_smiley_val['SMILEY_HEIGHT']; ?>" alt="<?php echo $_smiley_val['SMILEY_CODE']; ?>" title="<?php echo $_smiley_val['SMILEY_DESC']; ?>" /></a>
					<?php }} ?>

					<a href="<?php echo $this->_rootref['U_MORE_SMILIES'] ?? ''; ?>" onclick="popup(this.href, 300, 350, '_phpbbsmilies'); return false;"><?php echo ((isset($this->_rootref['L_MORE_SMILIES'])) ? $this->_rootref['L_MORE_SMILIES'] : ((isset($user->lang['MORE_SMILIES'])) ? $user->lang['MORE_SMILIES'] : '{ MORE_SMILIES }')); ?></a>					
				</div>
				<?php } ?>

				<div style="padding: 3px;">
					<img src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>mchat/load.gif" alt="<?php echo ((isset($this->_rootref['L_MCHAT_LOAD'])) ? $this->_rootref['L_MCHAT_LOAD'] : ((isset($user->lang['MCHAT_LOAD'])) ? $user->lang['MCHAT_LOAD'] : '{ MCHAT_LOAD }')); ?>" title="<?php echo ((isset($this->_rootref['L_MCHAT_LOAD'])) ? $this->_rootref['L_MCHAT_LOAD'] : ((isset($user->lang['MCHAT_LOAD'])) ? $user->lang['MCHAT_LOAD'] : '{ MCHAT_LOAD }')); ?>" id="mChatLoadIMG" class="mChatImageLoad" />
					<img src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>mchat/ok.gif" alt="<?php echo ((isset($this->_rootref['L_MCHAT_OK'])) ? $this->_rootref['L_MCHAT_OK'] : ((isset($user->lang['MCHAT_OK'])) ? $user->lang['MCHAT_OK'] : '{ MCHAT_OK }')); ?>" title="<?php echo ((isset($this->_rootref['L_MCHAT_OK'])) ? $this->_rootref['L_MCHAT_OK'] : ((isset($user->lang['MCHAT_OK'])) ? $user->lang['MCHAT_OK'] : '{ MCHAT_OK }')); ?>" id="mChatOkIMG" class="mChatImageOk" />
					<img src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>mchat/error.gif" alt="<?php echo ((isset($this->_rootref['L_MCHAT_ERROR'])) ? $this->_rootref['L_MCHAT_ERROR'] : ((isset($user->lang['MCHAT_ERROR'])) ? $user->lang['MCHAT_ERROR'] : '{ MCHAT_ERROR }')); ?>" title="<?php echo ((isset($this->_rootref['L_MCHAT_ERROR'])) ? $this->_rootref['L_MCHAT_ERROR'] : ((isset($user->lang['MCHAT_ERROR'])) ? $user->lang['MCHAT_ERROR'] : '{ MCHAT_ERROR }')); ?>" id="mChatErrorIMG" class="mChatImageHideImg" />
					<img src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>mchat/paused.gif" alt="<?php echo ((isset($this->_rootref['L_MCHAT_PAUSE'])) ? $this->_rootref['L_MCHAT_PAUSE'] : ((isset($user->lang['MCHAT_PAUSE'])) ? $user->lang['MCHAT_PAUSE'] : '{ MCHAT_PAUSE }')); ?>" title="<?php echo ((isset($this->_rootref['L_MCHAT_PAUSE'])) ? $this->_rootref['L_MCHAT_PAUSE'] : ((isset($user->lang['MCHAT_PAUSE'])) ? $user->lang['MCHAT_PAUSE'] : '{ MCHAT_PAUSE }')); ?>" id="mChatPauseIMG" class="mChatImageHideImg" />
					<span id="mChatRefreshText"><?php echo $this->_rootref['MCHAT_REFRESH_YES'] ?? ''; ?></span><?php if (($this->_rootref['MCHAT_USER_TIMEOUT'] ?? null)) {  ?> &bull; <span id="mChatSessMess">&nbsp;</span><?php } ?> &bull; <label for="mChatUseSound"><?php echo ((isset($this->_rootref['L_MCHAT_USESOUND'])) ? $this->_rootref['L_MCHAT_USESOUND'] : ((isset($user->lang['MCHAT_USESOUND'])) ? $user->lang['MCHAT_USESOUND'] : '{ MCHAT_USESOUND }')); ?> <input type="checkbox" id="mChatUseSound" <?php if (($this->_rootref['S_MCHAT_SOUND_YES'] ?? null)) {  ?>checked="checked"<?php } ?> /></label>
				</div>
			</div>
			</form>
			<?php } ?>

			<div id="mChatSound" class="mChatSound"></div>
			<script src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>mchat/mchat_ajax_mini.js?v=<?php echo $this->_rootref['S_MCHAT_VERSION'] ?? ''; ?>"></script>
		<?php } } else { ?>

	<div class="mchat_alert"><?php echo ((isset($this->_rootref['L_MCHAT_ENABLE'])) ? $this->_rootref['L_MCHAT_ENABLE'] : ((isset($user->lang['MCHAT_ENABLE'])) ? $user->lang['MCHAT_ENABLE'] : '{ MCHAT_ENABLE }')); ?></div>
	<?php } if (! ($this->_rootref['MCHAT_READ_MODE'] ?? null)) {  ?>

		</div>
	</div>
</div>
	<?php } if (($this->_rootref['MCHAT_ARCHIVE_MODE'] ?? null)) {  ?>

<ul class="linklist">
	<li class="rightside pagination"><?php echo $this->_rootref['MCHAT_TOTAL_MESSAGES'] ?? ''; ?> &bull; <?php if (($this->_rootref['MCHAT_PAGINATION'] ?? null)) {  ?><a href="#" onclick="jumpto(); return false;" title="<?php echo ((isset($this->_rootref['L_JUMP_TO_PAGE'])) ? $this->_rootref['L_JUMP_TO_PAGE'] : ((isset($user->lang['JUMP_TO_PAGE'])) ? $user->lang['JUMP_TO_PAGE'] : '{ JUMP_TO_PAGE }')); ?>"><?php echo $this->_rootref['MCHAT_PAGE_NUMBER'] ?? ''; ?></a> &bull; <span><?php echo $this->_rootref['MCHAT_PAGINATION'] ?? ''; ?></span><?php } else { echo $this->_rootref['MCHAT_PAGE_NUMBER'] ?? ''; } ?></li>
</ul>
<?php } if (($this->_rootref['MCHAT_CUSTOM_PAGE'] ?? null) && ($this->_rootref['MCHAT_WHOIS'] ?? null)) {  ?>

<h3><?php echo ((isset($this->_rootref['L_WHO_IS_CHATTING'])) ? $this->_rootref['L_WHO_IS_CHATTING'] : ((isset($user->lang['WHO_IS_CHATTING'])) ? $user->lang['WHO_IS_CHATTING'] : '{ WHO_IS_CHATTING }')); ?></h3>
	<div class="mChatStats" id="mChatStats"><?php if (($this->_rootref['MCHAT_USERS_LIST'] ?? null)) {  ?><a href="#" onclick="mChat.toggle('UserList'); return false;"><?php echo $this->_rootref['MCHAT_USERS_COUNT'] ?? ''; ?></a><?php } else { echo $this->_rootref['MCHAT_USERS_COUNT'] ?? ''; } ?>&nbsp;<?php echo ((isset($this->_rootref['L_MCHAT_ONLINE_EXPLAIN'])) ? $this->_rootref['L_MCHAT_ONLINE_EXPLAIN'] : ((isset($user->lang['MCHAT_ONLINE_EXPLAIN'])) ? $user->lang['MCHAT_ONLINE_EXPLAIN'] : '{ MCHAT_ONLINE_EXPLAIN }')); ?><br /><span id="mChatUserList"><?php echo $this->_rootref['MCHAT_USERS_LIST'] ?? ''; ?></span></div>
	<div class="mChatRefresh"><span id="mChatRefresh"><?php echo ((isset($this->_rootref['L_MCHAT_WHOIS_REFRESH_EXPLAIN'])) ? $this->_rootref['L_MCHAT_WHOIS_REFRESH_EXPLAIN'] : ((isset($user->lang['MCHAT_WHOIS_REFRESH_EXPLAIN'])) ? $user->lang['MCHAT_WHOIS_REFRESH_EXPLAIN'] : '{ MCHAT_WHOIS_REFRESH_EXPLAIN }')); ?></span><span id="mChatRefreshN" style="display: none;"><?php echo ((isset($this->_rootref['L_MCHAT_REFRESHING'])) ? $this->_rootref['L_MCHAT_REFRESHING'] : ((isset($user->lang['MCHAT_REFRESHING'])) ? $user->lang['MCHAT_REFRESHING'] : '{ MCHAT_REFRESHING }')); ?></span>
<?php if (($this->_rootref['LEGEND'] ?? null)) {  ?><br /><em><?php echo ((isset($this->_rootref['L_LEGEND'])) ? $this->_rootref['L_LEGEND'] : ((isset($user->lang['LEGEND'])) ? $user->lang['LEGEND'] : '{ LEGEND }')); ?>: <?php echo $this->_rootref['LEGEND'] ?? ''; ?></em><?php } ?></div>
<?php } if (($this->_rootref['MCHAT_ARCHIVE_MODE'] ?? null) || ($this->_rootref['MCHAT_CUSTOM_PAGE'] ?? null)) {  $this->_tpl_include('overall_footer.html'); } ?>