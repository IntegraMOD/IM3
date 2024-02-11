<?php if (!defined('IN_PHPBB')) exit; $this->_tpl_include('overall_header.html'); if (($this->_rootref['U_MCP'] ?? null)) {  ?><p>[&nbsp;<a href="<?php echo $this->_rootref['U_MCP'] ?? ''; ?>"><?php echo ((isset($this->_rootref['L_MCP'])) ? $this->_rootref['L_MCP'] : ((isset($user->lang['MCP'])) ? $user->lang['MCP'] : '{ MCP }')); ?></a>&nbsp;]</p><?php } ?>

<h2><a href="<?php echo $this->_rootref['U_VIEW_TOPIC'] ?? ''; ?>"><?php echo $this->_rootref['TOPIC_TITLE'] ?? ''; ?></a></h2>
<!-- NOTE: remove the style="display: none" when you want to have the forum description on the topic body --><?php if (($this->_rootref['FORUM_DESC'] ?? null)) {  ?><div style="display: none !important;"><?php echo $this->_rootref['FORUM_DESC'] ?? ''; ?><br /></div><?php } if (($this->_rootref['MODERATORS'] ?? null)) {  ?>

<p>
	<strong><?php if (($this->_rootref['S_SINGLE_MODERATOR'] ?? null)) {  echo ((isset($this->_rootref['L_MODERATOR'])) ? $this->_rootref['L_MODERATOR'] : ((isset($user->lang['MODERATOR'])) ? $user->lang['MODERATOR'] : '{ MODERATOR }')); } else { echo ((isset($this->_rootref['L_MODERATORS'])) ? $this->_rootref['L_MODERATORS'] : ((isset($user->lang['MODERATORS'])) ? $user->lang['MODERATORS'] : '{ MODERATORS }')); } ?>:</strong> <?php echo $this->_rootref['MODERATORS'] ?? ''; ?>

</p>
<?php } if (($this->_rootref['S_FORUM_RULES'] ?? null)) {  ?>

	<div class="rules">
		<div class="inner">

		<?php if (($this->_rootref['U_FORUM_RULES'] ?? null)) {  ?>

			<a href="<?php echo $this->_rootref['U_FORUM_RULES'] ?? ''; ?>"><?php echo ((isset($this->_rootref['L_FORUM_RULES'])) ? $this->_rootref['L_FORUM_RULES'] : ((isset($user->lang['FORUM_RULES'])) ? $user->lang['FORUM_RULES'] : '{ FORUM_RULES }')); ?></a>
		<?php } else { ?>

			<strong><?php echo ((isset($this->_rootref['L_FORUM_RULES'])) ? $this->_rootref['L_FORUM_RULES'] : ((isset($user->lang['FORUM_RULES'])) ? $user->lang['FORUM_RULES'] : '{ FORUM_RULES }')); ?></strong><br />
			<?php echo $this->_rootref['FORUM_RULES'] ?? ''; ?>

		<?php } ?>


		</div>
	</div>
<?php } if (($this->_rootref['ADS_3'] ?? null)) {  ?>

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
			<?php echo $this->_rootref['ADS_3'] ?? ''; ?>

		</div>
	</div>
</div>
<br />
<?php } ?>

<div class="topic-actions">

	<div class="buttons">
	<?php if (! ($this->_rootref['S_IS_BOT'] ?? null) && ($this->_rootref['S_DISPLAY_REPLY_INFO'] ?? null)) {  ?>

		<div class="<?php if (($this->_rootref['S_IS_LOCKED'] ?? null)) {  ?>locked-icon<?php } else { ?>reply-icon<?php } ?>"><a href="<?php echo $this->_rootref['U_POST_REPLY_TOPIC'] ?? ''; ?>" ><span></span><?php if (($this->_rootref['S_IS_LOCKED'] ?? null)) {  echo ((isset($this->_rootref['L_TOPIC_LOCKED_SHORT'])) ? $this->_rootref['L_TOPIC_LOCKED_SHORT'] : ((isset($user->lang['TOPIC_LOCKED_SHORT'])) ? $user->lang['TOPIC_LOCKED_SHORT'] : '{ TOPIC_LOCKED_SHORT }')); } else { echo ((isset($this->_rootref['L_POST_REPLY'])) ? $this->_rootref['L_POST_REPLY'] : ((isset($user->lang['POST_REPLY'])) ? $user->lang['POST_REPLY'] : '{ POST_REPLY }')); } ?></a></div>
	<?php } ?>

	</div>

	<?php if (($this->_rootref['S_DISPLAY_SEARCHBOX'] ?? null)) {  ?>

		<div class="search-box">
			<form method="get" id="topic-search" action="<?php echo $this->_rootref['S_SEARCHBOX_ACTION'] ?? ''; ?>">
			<fieldset>
				<input class="inputbox search tiny"  type="text" name="keywords" id="search_keywords" size="20" value="<?php echo ((isset($this->_rootref['L_SEARCH_TOPIC'])) ? $this->_rootref['L_SEARCH_TOPIC'] : ((isset($user->lang['SEARCH_TOPIC'])) ? $user->lang['SEARCH_TOPIC'] : '{ SEARCH_TOPIC }')); ?>" onclick="if(this.value=='<?php echo ((isset($this->_rootref['LA_SEARCH_TOPIC'])) ? $this->_rootref['LA_SEARCH_TOPIC'] : ((isset($this->_rootref['L_SEARCH_TOPIC'])) ? addslashes($this->_rootref['L_SEARCH_TOPIC']) : ((isset($user->lang['SEARCH_TOPIC'])) ? addslashes($user->lang['SEARCH_TOPIC']) : '{ SEARCH_TOPIC }'))); ?>')this.value='';" onblur="if(this.value=='')this.value='<?php echo ((isset($this->_rootref['LA_SEARCH_TOPIC'])) ? $this->_rootref['LA_SEARCH_TOPIC'] : ((isset($this->_rootref['L_SEARCH_TOPIC'])) ? addslashes($this->_rootref['L_SEARCH_TOPIC']) : ((isset($user->lang['SEARCH_TOPIC'])) ? addslashes($user->lang['SEARCH_TOPIC']) : '{ SEARCH_TOPIC }'))); ?>';" />
				<input class="button2" type="submit" value="<?php echo ((isset($this->_rootref['L_SEARCH'])) ? $this->_rootref['L_SEARCH'] : ((isset($user->lang['SEARCH'])) ? $user->lang['SEARCH'] : '{ SEARCH }')); ?>" />
				<?php echo $this->_rootref['S_SEARCH_LOCAL_HIDDEN_FIELDS'] ?? ''; ?>

			</fieldset>
			</form>
		</div>
	<?php } if (($this->_rootref['PAGINATION'] ?? null) || ($this->_rootref['TOTAL_POSTS'] ?? null)) {  ?>

		<div class="pagination">
			<?php if (($this->_rootref['U_VIEW_UNREAD_POST'] ?? null) && ! ($this->_rootref['S_IS_BOT'] ?? null)) {  ?><a href="<?php echo $this->_rootref['U_VIEW_UNREAD_POST'] ?? ''; ?>"><?php echo ((isset($this->_rootref['L_VIEW_UNREAD_POST'])) ? $this->_rootref['L_VIEW_UNREAD_POST'] : ((isset($user->lang['VIEW_UNREAD_POST'])) ? $user->lang['VIEW_UNREAD_POST'] : '{ VIEW_UNREAD_POST }')); ?></a> &bull; <?php } echo $this->_rootref['TOTAL_POSTS'] ?? ''; ?>

			<?php if (($this->_rootref['PAGE_NUMBER'] ?? null)) {  if (($this->_rootref['PAGINATION'] ?? null)) {  ?> &bull; <a href="#" onclick="jumpto(); return false;" title="<?php echo ((isset($this->_rootref['L_JUMP_TO_PAGE'])) ? $this->_rootref['L_JUMP_TO_PAGE'] : ((isset($user->lang['JUMP_TO_PAGE'])) ? $user->lang['JUMP_TO_PAGE'] : '{ JUMP_TO_PAGE }')); ?>"><?php echo $this->_rootref['PAGE_NUMBER'] ?? ''; ?></a> &bull; <span><?php echo $this->_rootref['PAGINATION'] ?? ''; ?></span><?php } else { ?> &bull; <?php echo $this->_rootref['PAGE_NUMBER'] ?? ''; } } ?>

		</div>
	<?php } ?>


</div>
<div class="clear"></div>


<?php if (($this->_rootref['S_HAS_EVENT'] ?? null)) {  ?>

    <div class="panel bg2">
        <div class="inner">
            <a href="<?php echo $this->_rootref['U_ASSOCIATED_EVENT'] ?? ''; ?>"><h4><?php echo ((isset($this->_rootref['L_HAS_ASSOCIATED_EVENT'])) ? $this->_rootref['L_HAS_ASSOCIATED_EVENT'] : ((isset($user->lang['HAS_ASSOCIATED_EVENT'])) ? $user->lang['HAS_ASSOCIATED_EVENT'] : '{ HAS_ASSOCIATED_EVENT }')); ?></h4></a><hr /><br />
            <div>
                <dl style="clear: left;">
                     <dt><?php echo ((isset($this->_rootref['L_STARTS'])) ? $this->_rootref['L_STARTS'] : ((isset($user->lang['STARTS'])) ? $user->lang['STARTS'] : '{ STARTS }')); ?>:</dt>
                     <dd><strong><?php echo $this->_rootref['START_TIME'] ?? ''; ?></strong></dd>
                     <dt><?php echo ((isset($this->_rootref['L_ENDS'])) ? $this->_rootref['L_ENDS'] : ((isset($user->lang['ENDS'])) ? $user->lang['ENDS'] : '{ ENDS }')); ?>:</dt>
                     <dd><strong><?php echo $this->_rootref['END_TIME'] ?? ''; ?></strong></dd>
                     <dt><?php echo ((isset($this->_rootref['L_DURATION'])) ? $this->_rootref['L_DURATION'] : ((isset($user->lang['DURATION'])) ? $user->lang['DURATION'] : '{ DURATION }')); ?>:</dt>
                     <dd><strong><?php echo $this->_rootref['DURATION'] ?? ''; ?></strong></dd>
                     <?php if (($this->_rootref['S_HAS_REPEATS'] ?? null)) {  ?>

                         <dt><?php echo ((isset($this->_rootref['L_REPEATED'])) ? $this->_rootref['L_REPEATED'] : ((isset($user->lang['REPEATED'])) ? $user->lang['REPEATED'] : '{ REPEATED }')); ?>:</dt>
                         <dd><strong><?php echo $this->_rootref['REPEAT_LIST'] ?? ''; ?></strong></dd>
                     <?php } ?>

                  </dl>
            </div>
            <hr />
            <?php if (($this->_rootref['S_IS_INVITED'] ?? null) && ($this->_rootref['S_USER_LOGGED_IN'] ?? null)) {  ?>

                  <div class="rules">
                  <?php if (($this->_rootref['S_IS_SIGNED_UP'] ?? null)) {  ?>

                        <p style="color:#00AA00; text-align:center;"><?php echo ((isset($this->_rootref['L_CALENDAR_SIGNED_UP'])) ? $this->_rootref['L_CALENDAR_SIGNED_UP'] : ((isset($user->lang['CALENDAR_SIGNED_UP'])) ? $user->lang['CALENDAR_SIGNED_UP'] : '{ CALENDAR_SIGNED_UP }')); ?>&nbsp;&nbsp;&nbsp;<a href="<?php echo $this->_rootref['U_UNREG'] ?? ''; ?>"><?php echo ((isset($this->_rootref['L_CALENDAR_UN_SIGN_UP'])) ? $this->_rootref['L_CALENDAR_UN_SIGN_UP'] : ((isset($user->lang['CALENDAR_UN_SIGN_UP'])) ? $user->lang['CALENDAR_UN_SIGN_UP'] : '{ CALENDAR_UN_SIGN_UP }')); ?></a></p>
                  <?php } else if (($this->_rootref['S_IS_SIGNED_DOWN'] ?? null)) {  ?>

                        <p style="color:#BC2A4D; text-align:center;"><?php echo ((isset($this->_rootref['L_CALENDAR_SIGNED_DOWN'])) ? $this->_rootref['L_CALENDAR_SIGNED_DOWN'] : ((isset($user->lang['CALENDAR_SIGNED_DOWN'])) ? $user->lang['CALENDAR_SIGNED_DOWN'] : '{ CALENDAR_SIGNED_DOWN }')); ?>&nbsp;&nbsp;&nbsp;<a href="<?php echo $this->_rootref['U_UNREG'] ?? ''; ?>"><?php echo ((isset($this->_rootref['L_CALENDAR_UN_SIGN_UP'])) ? $this->_rootref['L_CALENDAR_UN_SIGN_UP'] : ((isset($user->lang['CALENDAR_UN_SIGN_UP'])) ? $user->lang['CALENDAR_UN_SIGN_UP'] : '{ CALENDAR_UN_SIGN_UP }')); ?></a></p>
                  <?php } else { ?>

                        <p style="color:#00AA00; text-align:center;"><?php echo ((isset($this->_rootref['L_CALENDAR_SIGN_UP_INVITATION'])) ? $this->_rootref['L_CALENDAR_SIGN_UP_INVITATION'] : ((isset($user->lang['CALENDAR_SIGN_UP_INVITATION'])) ? $user->lang['CALENDAR_SIGN_UP_INVITATION'] : '{ CALENDAR_SIGN_UP_INVITATION }')); ?>&nbsp;&nbsp;&nbsp;<a href="<?php echo $this->_rootref['U_SIGN_UP'] ?? ''; ?>"><?php echo ((isset($this->_rootref['L_CALENDAR_SIGN_UP_ACCEPT'])) ? $this->_rootref['L_CALENDAR_SIGN_UP_ACCEPT'] : ((isset($user->lang['CALENDAR_SIGN_UP_ACCEPT'])) ? $user->lang['CALENDAR_SIGN_UP_ACCEPT'] : '{ CALENDAR_SIGN_UP_ACCEPT }')); ?></a> &bull; <a href="<?php echo $this->_rootref['U_SIGN_DOWN'] ?? ''; ?>"><?php echo ((isset($this->_rootref['L_CALENDAR_SIGN_UP_DECLINE'])) ? $this->_rootref['L_CALENDAR_SIGN_UP_DECLINE'] : ((isset($user->lang['CALENDAR_SIGN_UP_DECLINE'])) ? $user->lang['CALENDAR_SIGN_UP_DECLINE'] : '{ CALENDAR_SIGN_UP_DECLINE }')); ?></a></p>
                  <?php } ?>

                  </div>
                  <?php if (($this->_rootref['S_SHOW_ATTENDEES_LIST'] ?? null)) {  ?>

                      <h4><?php echo ((isset($this->_rootref['L_CALENDAR_EVENT_MEMBERS_SIGNED'])) ? $this->_rootref['L_CALENDAR_EVENT_MEMBERS_SIGNED'] : ((isset($user->lang['CALENDAR_EVENT_MEMBERS_SIGNED'])) ? $user->lang['CALENDAR_EVENT_MEMBERS_SIGNED'] : '{ CALENDAR_EVENT_MEMBERS_SIGNED }')); ?></h4>
                      <?php if (($this->_rootref['SIGNED_UP_LIST'] ?? null)) {  echo $this->_rootref['SIGNED_UP_LIST'] ?? ''; } else { echo ((isset($this->_rootref['L_CALENDAR_EVENT_MEMBERS_SIGNED_NONE'])) ? $this->_rootref['L_CALENDAR_EVENT_MEMBERS_SIGNED_NONE'] : ((isset($user->lang['CALENDAR_EVENT_MEMBERS_SIGNED_NONE'])) ? $user->lang['CALENDAR_EVENT_MEMBERS_SIGNED_NONE'] : '{ CALENDAR_EVENT_MEMBERS_SIGNED_NONE }')); } ?>

                      <hr />
                      <h4><?php echo ((isset($this->_rootref['L_CALENDAR_EVENT_MEMBERS_NOT_SIGNED'])) ? $this->_rootref['L_CALENDAR_EVENT_MEMBERS_NOT_SIGNED'] : ((isset($user->lang['CALENDAR_EVENT_MEMBERS_NOT_SIGNED'])) ? $user->lang['CALENDAR_EVENT_MEMBERS_NOT_SIGNED'] : '{ CALENDAR_EVENT_MEMBERS_NOT_SIGNED }')); ?></h4>
                      <?php if (($this->_rootref['SIGNED_DOWN_LIST'] ?? null)) {  echo $this->_rootref['SIGNED_DOWN_LIST'] ?? ''; } else { echo ((isset($this->_rootref['L_CALENDAR_EVENT_MEMBERS_NOT_SIGNED_NONE'])) ? $this->_rootref['L_CALENDAR_EVENT_MEMBERS_NOT_SIGNED_NONE'] : ((isset($user->lang['CALENDAR_EVENT_MEMBERS_NOT_SIGNED_NONE'])) ? $user->lang['CALENDAR_EVENT_MEMBERS_NOT_SIGNED_NONE'] : '{ CALENDAR_EVENT_MEMBERS_NOT_SIGNED_NONE }')); } ?>

                      <hr />
                      <br />
                  <?php } } ?>

            <a href="<?php echo $this->_rootref['U_ASSOCIATED_EVENT'] ?? ''; ?>"><?php echo ((isset($this->_rootref['L_GO_TO_EVENT'])) ? $this->_rootref['L_GO_TO_EVENT'] : ((isset($user->lang['GO_TO_EVENT'])) ? $user->lang['GO_TO_EVENT'] : '{ GO_TO_EVENT }')); ?></a>
        </div>
    </div>
<?php } if (($this->_rootref['S_HAS_POLL'] ?? null)) {  ?>

	<form method="post" action="<?php echo $this->_rootref['S_POLL_ACTION'] ?? ''; ?>">

	<div class="panel">
		<div class="inner">

		<div class="content">
			<h2><?php echo $this->_rootref['POLL_QUESTION'] ?? ''; ?></h2>
			<p class="author"><?php echo ((isset($this->_rootref['L_POLL_LENGTH'])) ? $this->_rootref['L_POLL_LENGTH'] : ((isset($user->lang['POLL_LENGTH'])) ? $user->lang['POLL_LENGTH'] : '{ POLL_LENGTH }')); if (($this->_rootref['S_CAN_VOTE'] ?? null) && ($this->_rootref['L_POLL_LENGTH'] ?? null)) {  ?><br /><?php } if (($this->_rootref['S_CAN_VOTE'] ?? null)) {  echo ((isset($this->_rootref['L_MAX_VOTES'])) ? $this->_rootref['L_MAX_VOTES'] : ((isset($user->lang['MAX_VOTES'])) ? $user->lang['MAX_VOTES'] : '{ MAX_VOTES }')); } ?></p>

			<fieldset class="polls">
			<?php $_poll_option_count = (isset($this->_tpldata['poll_option']) && is_array($this->_tpldata['poll_option'])) ? count($this->_tpldata['poll_option']) : 0;if ($_poll_option_count) {for ($_poll_option_i = 0; $_poll_option_i < $_poll_option_count; ++$_poll_option_i){$_poll_option_val = &$this->_tpldata['poll_option'][$_poll_option_i]; ?>

				<dl class="<?php if ($_poll_option_val['POLL_OPTION_VOTED']) {  ?>voted<?php } ?>"<?php if ($_poll_option_val['POLL_OPTION_VOTED']) {  ?> title="<?php echo ((isset($this->_rootref['L_POLL_VOTED_OPTION'])) ? $this->_rootref['L_POLL_VOTED_OPTION'] : ((isset($user->lang['POLL_VOTED_OPTION'])) ? $user->lang['POLL_VOTED_OPTION'] : '{ POLL_VOTED_OPTION }')); ?>"<?php } ?>>
					<dt><?php if (($this->_rootref['S_CAN_VOTE'] ?? null)) {  ?><label for="vote_<?php echo $_poll_option_val['POLL_OPTION_ID']; ?>"><?php echo $_poll_option_val['POLL_OPTION_CAPTION']; ?></label><?php } else { echo $_poll_option_val['POLL_OPTION_CAPTION']; } ?></dt>
					<?php if (($this->_rootref['S_CAN_VOTE'] ?? null)) {  ?><dd style="width: auto;"><?php if (($this->_rootref['S_IS_MULTI_CHOICE'] ?? null)) {  ?><input type="checkbox" name="vote_id[]" id="vote_<?php echo $_poll_option_val['POLL_OPTION_ID']; ?>" value="<?php echo $_poll_option_val['POLL_OPTION_ID']; ?>"<?php if ($_poll_option_val['POLL_OPTION_VOTED']) {  ?> checked="checked"<?php } ?> /><?php } else { ?><input type="radio" name="vote_id[]" id="vote_<?php echo $_poll_option_val['POLL_OPTION_ID']; ?>" value="<?php echo $_poll_option_val['POLL_OPTION_ID']; ?>"<?php if ($_poll_option_val['POLL_OPTION_VOTED']) {  ?> checked="checked"<?php } ?> /><?php } ?></dd><?php } if (($this->_rootref['S_DISPLAY_RESULTS'] ?? null)) {  ?><dd class="resultbar"><div class="<?php if ($_poll_option_val['POLL_OPTION_PCT'] < (20)) {  ?>pollbar1<?php } else if ($_poll_option_val['POLL_OPTION_PCT'] < (40)) {  ?>pollbar2<?php } else if ($_poll_option_val['POLL_OPTION_PCT'] < (60)) {  ?>pollbar3<?php } else if ($_poll_option_val['POLL_OPTION_PCT'] < (80)) {  ?>pollbar4<?php } else { ?>pollbar5<?php } ?>" style="width:<?php echo $_poll_option_val['POLL_OPTION_PERCENT']; ?>;"><?php echo $_poll_option_val['POLL_OPTION_RESULT']; ?></div></dd>
					<dd><?php if ($_poll_option_val['POLL_OPTION_RESULT'] == 0) {  echo ((isset($this->_rootref['L_NO_VOTES'])) ? $this->_rootref['L_NO_VOTES'] : ((isset($user->lang['NO_VOTES'])) ? $user->lang['NO_VOTES'] : '{ NO_VOTES }')); } else { echo $_poll_option_val['POLL_OPTION_PERCENT']; } ?></dd><?php } ?>

				</dl>
			<?php }} if (($this->_rootref['S_DISPLAY_RESULTS'] ?? null)) {  ?>

				<dl>
					<dt>&nbsp;</dt>
					<dd class="resultbar"><?php echo ((isset($this->_rootref['L_TOTAL_VOTES'])) ? $this->_rootref['L_TOTAL_VOTES'] : ((isset($user->lang['TOTAL_VOTES'])) ? $user->lang['TOTAL_VOTES'] : '{ TOTAL_VOTES }')); ?> : <?php echo $this->_rootref['TOTAL_VOTES'] ?? ''; ?></dd>
				</dl>
			<?php } if (($this->_rootref['S_CAN_VOTE'] ?? null)) {  ?>

				<dl style="border-top: none;">
					<dt>&nbsp;</dt>
					<dd class="resultbar"><input type="submit" name="update" value="<?php echo ((isset($this->_rootref['L_SUBMIT_VOTE'])) ? $this->_rootref['L_SUBMIT_VOTE'] : ((isset($user->lang['SUBMIT_VOTE'])) ? $user->lang['SUBMIT_VOTE'] : '{ SUBMIT_VOTE }')); ?>" class="button1" /></dd>
				</dl>
			<?php } if (! ($this->_rootref['S_DISPLAY_RESULTS'] ?? null)) {  ?>

				<dl style="border-top: none;">
					<dt>&nbsp;</dt>
					<dd class="resultbar"><a href="<?php echo $this->_rootref['U_VIEW_RESULTS'] ?? ''; ?>"><?php echo ((isset($this->_rootref['L_VIEW_RESULTS'])) ? $this->_rootref['L_VIEW_RESULTS'] : ((isset($user->lang['VIEW_RESULTS'])) ? $user->lang['VIEW_RESULTS'] : '{ VIEW_RESULTS }')); ?></a></dd>
				</dl>
			<?php } ?>

			</fieldset>
		</div>

		</div>
		<?php echo $this->_rootref['S_FORM_TOKEN'] ?? ''; ?>

		<?php echo $this->_rootref['S_HIDDEN_FIELDS'] ?? ''; ?>

	</div>


	</form>
	<hr />
<?php } $_postrow_count = (isset($this->_tpldata['postrow']) && is_array($this->_tpldata['postrow'])) ? count($this->_tpldata['postrow']) : 0;if ($_postrow_count) {for ($_postrow_i = 0; $_postrow_i < $_postrow_count; ++$_postrow_i){$_postrow_val = &$this->_tpldata['postrow'][$_postrow_i]; ?>


	<span class="<?php if ($_postrow_val['S_ONLINE'] && ! $_postrow_val['S_IGNORE_POST']) {  ?>online_member" title="<?php echo ((isset($this->_rootref['L_ONLINE'])) ? $this->_rootref['L_ONLINE'] : ((isset($user->lang['ONLINE'])) ? $user->lang['ONLINE'] : '{ ONLINE }')); ?>"<?php } else { ?>offline_member" title="<?php echo ((isset($this->_rootref['L_OFFLINE'])) ? $this->_rootref['L_OFFLINE'] : ((isset($user->lang['OFFLINE'])) ? $user->lang['OFFLINE'] : '{ OFFLINE }')); ?>"<?php } ?>></span>
	<?php if ($_postrow_val['S_FIRST_UNREAD']) {  ?><a id="unread"></a><?php } ?>

	<div id="p<?php echo $_postrow_val['POST_ID']; ?>" class="post <?php if (($_postrow_val['S_ROW_COUNT'] & 1)  ) {  ?>bg1<?php } else { ?>bg2<?php } if ($_postrow_val['S_UNREAD_POST']) {  ?> unreadpost<?php } if ($_postrow_val['S_POST_REPORTED']) {  ?> reported<?php } ?>">
		<div class="inner">

		<div class="postbody">
			<?php if ($_postrow_val['S_IGNORE_POST']) {  ?>

				<div class="ignore"><?php echo $_postrow_val['L_IGNORE_POST']; ?></div>
			<?php } else { if (! ($this->_rootref['S_IS_BOT'] ?? null)) {  if ($_postrow_val['U_EDIT'] || $_postrow_val['U_DELETE'] || $_postrow_val['U_REPORT'] || $_postrow_val['U_WARN'] || $_postrow_val['U_INFO'] || $_postrow_val['U_QUOTE']) {  ?>

				<ul class="profile-icons">
					<?php if ($_postrow_val['U_EDIT']) {  ?><li class="edit-icon"><a href="<?php echo $_postrow_val['U_EDIT']; ?>" title="<?php echo ((isset($this->_rootref['L_EDIT_POST'])) ? $this->_rootref['L_EDIT_POST'] : ((isset($user->lang['EDIT_POST'])) ? $user->lang['EDIT_POST'] : '{ EDIT_POST }')); ?>"><?php echo ((isset($this->_rootref['L_EDIT'])) ? $this->_rootref['L_EDIT'] : ((isset($user->lang['EDIT'])) ? $user->lang['EDIT'] : '{ EDIT }')); ?></a></li><?php } if ($_postrow_val['U_DELETE']) {  ?><li class="delete-icon"><a href="<?php echo $_postrow_val['U_DELETE']; ?>" title="<?php echo ((isset($this->_rootref['L_DELETE_POST'])) ? $this->_rootref['L_DELETE_POST'] : ((isset($user->lang['DELETE_POST'])) ? $user->lang['DELETE_POST'] : '{ DELETE_POST }')); ?>"><span><?php echo ((isset($this->_rootref['L_DELETE_POST'])) ? $this->_rootref['L_DELETE_POST'] : ((isset($user->lang['DELETE_POST'])) ? $user->lang['DELETE_POST'] : '{ DELETE_POST }')); ?></span></a></li><?php } if ($_postrow_val['U_REPORT']) {  ?><li class="report-icon"><a href="<?php echo $_postrow_val['U_REPORT']; ?>" title="<?php echo ((isset($this->_rootref['L_REPORT_POST'])) ? $this->_rootref['L_REPORT_POST'] : ((isset($user->lang['REPORT_POST'])) ? $user->lang['REPORT_POST'] : '{ REPORT_POST }')); ?>"><span><?php echo ((isset($this->_rootref['L_REPORT_POST'])) ? $this->_rootref['L_REPORT_POST'] : ((isset($user->lang['REPORT_POST'])) ? $user->lang['REPORT_POST'] : '{ REPORT_POST }')); ?></span></a></li><?php } if ($_postrow_val['U_WARN']) {  ?><li class="warn-icon"><a href="<?php echo $_postrow_val['U_WARN']; ?>" title="<?php echo ((isset($this->_rootref['L_WARN_USER'])) ? $this->_rootref['L_WARN_USER'] : ((isset($user->lang['WARN_USER'])) ? $user->lang['WARN_USER'] : '{ WARN_USER }')); ?>"><span><?php echo ((isset($this->_rootref['L_WARN_USER'])) ? $this->_rootref['L_WARN_USER'] : ((isset($user->lang['WARN_USER'])) ? $user->lang['WARN_USER'] : '{ WARN_USER }')); ?></span></a></li><?php } if ($_postrow_val['U_INFO']) {  ?><li class="info-icon"><a href="<?php echo $_postrow_val['U_INFO']; ?>" title="<?php echo ((isset($this->_rootref['L_INFORMATION'])) ? $this->_rootref['L_INFORMATION'] : ((isset($user->lang['INFORMATION'])) ? $user->lang['INFORMATION'] : '{ INFORMATION }')); ?>"><span><?php echo ((isset($this->_rootref['L_INFORMATION'])) ? $this->_rootref['L_INFORMATION'] : ((isset($user->lang['INFORMATION'])) ? $user->lang['INFORMATION'] : '{ INFORMATION }')); ?></span></a></li><?php } if ($_postrow_val['U_QUOTE']) {  ?><li class="quote-icon"><a href="<?php echo $_postrow_val['U_QUOTE']; ?>" title="<?php echo ((isset($this->_rootref['L_REPLY_WITH_QUOTE'])) ? $this->_rootref['L_REPLY_WITH_QUOTE'] : ((isset($user->lang['REPLY_WITH_QUOTE'])) ? $user->lang['REPLY_WITH_QUOTE'] : '{ REPLY_WITH_QUOTE }')); ?>"><?php echo ((isset($this->_rootref['L_QUOTE'])) ? $this->_rootref['L_QUOTE'] : ((isset($user->lang['QUOTE'])) ? $user->lang['QUOTE'] : '{ QUOTE }')); ?></a></li><?php } ?>

				</ul>
			<?php } } ?>


			<h3 <?php if ($_postrow_val['S_FIRST_ROW']) {  ?>class="first"<?php } ?>><?php if ($_postrow_val['POST_ICON_IMG']) {  ?><img src="<?php echo $this->_rootref['T_ICONS_PATH'] ?? ''; echo $_postrow_val['POST_ICON_IMG']; ?>" width="<?php echo $_postrow_val['POST_ICON_IMG_WIDTH']; ?>" height="<?php echo $_postrow_val['POST_ICON_IMG_HEIGHT']; ?>" alt="" /> <?php } ?><a href="#p<?php echo $_postrow_val['POST_ID']; ?>"><?php echo $_postrow_val['POST_SUBJECT']; ?></a></h3>
			<p class="author"><?php if (($this->_rootref['S_IS_BOT'] ?? null)) {  echo $_postrow_val['MINI_POST_IMG']; } else { ?><a href="<?php echo $_postrow_val['U_MINI_POST']; ?>"><?php echo $_postrow_val['MINI_POST_IMG']; ?></a><?php } echo ((isset($this->_rootref['L_POST_BY_AUTHOR'])) ? $this->_rootref['L_POST_BY_AUTHOR'] : ((isset($user->lang['POST_BY_AUTHOR'])) ? $user->lang['POST_BY_AUTHOR'] : '{ POST_BY_AUTHOR }')); ?> <strong><?php echo $_postrow_val['POST_AUTHOR_FULL']; ?></strong> &raquo; <?php echo $_postrow_val['POST_DATE']; ?> </p>

			<?php if ($_postrow_val['S_POST_UNAPPROVED'] || $_postrow_val['S_POST_REPORTED']) {  ?>

				<p class="rules">
					<?php if ($_postrow_val['S_POST_UNAPPROVED']) {  echo $this->_rootref['UNAPPROVED_IMG'] ?? ''; ?> <a href="<?php echo $_postrow_val['U_MCP_APPROVE']; ?>"><strong><?php echo ((isset($this->_rootref['L_POST_UNAPPROVED'])) ? $this->_rootref['L_POST_UNAPPROVED'] : ((isset($user->lang['POST_UNAPPROVED'])) ? $user->lang['POST_UNAPPROVED'] : '{ POST_UNAPPROVED }')); ?></strong></a><br /><?php } if ($_postrow_val['S_POST_REPORTED']) {  echo $this->_rootref['REPORTED_IMG'] ?? ''; ?> <a href="<?php echo $_postrow_val['U_MCP_REPORT']; ?>"><strong><?php echo ((isset($this->_rootref['L_POST_REPORTED'])) ? $this->_rootref['L_POST_REPORTED'] : ((isset($user->lang['POST_REPORTED'])) ? $user->lang['POST_REPORTED'] : '{ POST_REPORTED }')); ?></strong></a><?php } ?>

				</p>
			<?php } ?>


			<div class="content"><?php echo $_postrow_val['MESSAGE']; ?></div>

			<?php if ($_postrow_val['S_HAS_ATTACHMENTS']) {  ?>

				<dl class="attachbox">
					<dt><?php echo ((isset($this->_rootref['L_ATTACHMENTS'])) ? $this->_rootref['L_ATTACHMENTS'] : ((isset($user->lang['ATTACHMENTS'])) ? $user->lang['ATTACHMENTS'] : '{ ATTACHMENTS }')); ?></dt>
					<?php $_attachment_count = (isset($_postrow_val['attachment']) && is_array($_postrow_val['attachment'])) ? count($_postrow_val['attachment']) : 0;if ($_attachment_count) {for ($_attachment_i = 0; $_attachment_i < $_attachment_count; ++$_attachment_i){$_attachment_val = &$_postrow_val['attachment'][$_attachment_i]; ?>

						<dd><?php echo $_attachment_val['DISPLAY_ATTACHMENT']; ?></dd>
					<?php }} ?>

				</dl>
			<?php } if ($_postrow_val['S_DISPLAY_NOTICE']) {  ?><div class="rules"><?php echo ((isset($this->_rootref['L_DOWNLOAD_NOTICE'])) ? $this->_rootref['L_DOWNLOAD_NOTICE'] : ((isset($user->lang['DOWNLOAD_NOTICE'])) ? $user->lang['DOWNLOAD_NOTICE'] : '{ DOWNLOAD_NOTICE }')); ?></div><?php } if ($_postrow_val['EDITED_MESSAGE'] || $_postrow_val['EDIT_REASON']) {  ?>

				<div class="notice"><?php echo $_postrow_val['EDITED_MESSAGE']; ?>

					<?php if ($_postrow_val['EDIT_REASON']) {  ?><br /><strong><?php echo ((isset($this->_rootref['L_REASON'])) ? $this->_rootref['L_REASON'] : ((isset($user->lang['REASON'])) ? $user->lang['REASON'] : '{ REASON }')); ?>:</strong> <em><?php echo $_postrow_val['EDIT_REASON']; ?></em><?php } ?>

				</div>
			<?php } if ($_postrow_val['BUMPED_MESSAGE']) {  ?><div class="notice"><br /><br /><?php echo $_postrow_val['BUMPED_MESSAGE']; ?></div><?php } if ($_postrow_val['SIGNATURE']) {  ?><div id="sig<?php echo $_postrow_val['POST_ID']; ?>" class="signature"><?php echo $_postrow_val['SIGNATURE']; ?></div><?php } } ?>


		</div>

		<?php if (! $_postrow_val['S_IGNORE_POST']) {  ?>

			<dl class="postprofile" id="profile<?php echo $_postrow_val['POST_ID']; ?>">
			<dt>
				<?php if ($_postrow_val['POSTER_AVATAR']) {  if ($_postrow_val['U_POST_AUTHOR']) {  ?><a href="<?php echo $_postrow_val['U_POST_AUTHOR']; ?>"><?php echo $_postrow_val['POSTER_AVATAR']; ?></a><?php } else { echo $_postrow_val['POSTER_AVATAR']; } ?><br />
				<?php } if (! $_postrow_val['U_POST_AUTHOR']) {  ?><strong><?php echo $_postrow_val['POST_AUTHOR_FULL']; ?></strong><?php } else { echo $_postrow_val['POST_AUTHOR_FULL']; } ?>

			</dt>

			<?php if ($_postrow_val['RANK_TITLE'] || $_postrow_val['RANK_IMG']) {  ?><dd><?php echo $_postrow_val['RANK_TITLE']; if ($_postrow_val['RANK_TITLE'] && $_postrow_val['RANK_IMG']) {  ?><br /><?php } echo $_postrow_val['RANK_IMG']; ?></dd><?php } ?>


		<dd>&nbsp;</dd>

		<?php if ($_postrow_val['POSTER_POSTS'] != ('')) {  ?><dd><strong><?php echo ((isset($this->_rootref['L_POSTS'])) ? $this->_rootref['L_POSTS'] : ((isset($user->lang['POSTS'])) ? $user->lang['POSTS'] : '{ POSTS }')); ?>:</strong> <?php echo $_postrow_val['POSTER_POSTS']; ?></dd><?php } if ($_postrow_val['GALLERY_IMAGES'] != ('')) {  ?><dd><strong><?php echo ((isset($this->_rootref['L_IMAGES'])) ? $this->_rootref['L_IMAGES'] : ((isset($user->lang['IMAGES'])) ? $user->lang['IMAGES'] : '{ IMAGES }')); ?>:</strong> <?php if ($_postrow_val['U_GALLERY_SEARCH']) {  ?><a href="<?php echo $_postrow_val['U_GALLERY_SEARCH']; ?>"><?php echo $_postrow_val['GALLERY_IMAGES']; ?></a><?php } else { echo $_postrow_val['GALLERY_IMAGES']; } ?></dd><?php } if ($_postrow_val['POSTER_JOINED']) {  ?><dd><strong><?php echo ((isset($this->_rootref['L_JOINED'])) ? $this->_rootref['L_JOINED'] : ((isset($user->lang['JOINED'])) ? $user->lang['JOINED'] : '{ JOINED }')); ?>:</strong> <?php echo $_postrow_val['POSTER_JOINED']; ?></dd><?php } ?><!-- Begin Ultimate Points --><?php if (($this->_rootref['USE_POINTS'] ?? null)) {  ?><dd><strong><?php echo ((isset($this->_rootref['L_POINTS_CASH_ON_HAND'])) ? $this->_rootref['L_POINTS_CASH_ON_HAND'] : ((isset($user->lang['POINTS_CASH_ON_HAND'])) ? $user->lang['POINTS_CASH_ON_HAND'] : '{ POINTS_CASH_ON_HAND }')); ?>:</strong> <?php if ($_postrow_val['POSTER_LOCK']) {  echo ((isset($this->_rootref['L_POINTS_LOCKED'])) ? $this->_rootref['L_POINTS_LOCKED'] : ((isset($user->lang['POINTS_LOCKED'])) ? $user->lang['POINTS_LOCKED'] : '{ POINTS_LOCKED }')); } else { echo $_postrow_val['POSTER_POINTS']; ?> <?php if (($this->_rootref['USE_IMAGES_POINTS'] ?? null)) {  ?><img src="<?php echo $this->_rootref['T_THEME_PATH'] ?? ''; ?>/images/money.png" width="11px" height="11px" alt="" /><?php } else { echo $this->_rootref['P_NAME'] ?? ''; } if (! $_postrow_val['S_IS_OWN_POST'] && ($this->_rootref['S_USER_LOGGED_IN'] ?? null)) {  ?><br /><a href="<?php echo $_postrow_val['U_POINTS_DONATE']; ?>"><?php echo $_postrow_val['L_DONATE']; ?></a><?php } else { ?><br /><?php } ?><a href="<?php echo $_postrow_val['U_POINTS_MODIFY']; ?>"><?php echo $_postrow_val['L_MOD_USER_POINTS']; ?></a><?php } ?></dd>
		<?php if (($this->_rootref['USE_BANK'] ?? null)) {  if ($_postrow_val['BANK_ACCOUNT']) {  ?><dd><strong><?php echo ((isset($this->_rootref['L_BANK_TITLE_MAIN'])) ? $this->_rootref['L_BANK_TITLE_MAIN'] : ((isset($user->lang['BANK_TITLE_MAIN'])) ? $user->lang['BANK_TITLE_MAIN'] : '{ BANK_TITLE_MAIN }')); ?>:</strong><?php if ($_postrow_val['POSTER_BANK_LOCK']) {  ?> <?php echo ((isset($this->_rootref['L_POINTS_LOCKED'])) ? $this->_rootref['L_POINTS_LOCKED'] : ((isset($user->lang['POINTS_LOCKED'])) ? $user->lang['POINTS_LOCKED'] : '{ POINTS_LOCKED }')); } else { ?> <?php echo $_postrow_val['BANK_GOLD']; ?> <?php if (($this->_rootref['USE_IMAGES_POINTS'] ?? null)) {  ?><img src="<?php echo $this->_rootref['T_THEME_PATH'] ?? ''; ?>/images/money.png" width="11px" height="11px" alt="" /><?php } else { echo $this->_rootref['P_NAME'] ?? ''; } ?><br /><a href="<?php echo $_postrow_val['U_BANK_MODIFY']; ?>"><?php echo $_postrow_val['L_MOD_USER_POINTS']; ?></a><?php } ?></dd><?php } } } ?><!-- End Ultimate Points --><?php if ($_postrow_val['POSTER_FROM']) {  ?><dd><strong><?php echo ((isset($this->_rootref['L_LOCATION'])) ? $this->_rootref['L_LOCATION'] : ((isset($user->lang['LOCATION'])) ? $user->lang['LOCATION'] : '{ LOCATION }')); ?>:</strong> <?php echo $_postrow_val['POSTER_FROM']; ?></dd><?php } if ($_postrow_val['S_PROFILE_FIELD1']) {  ?><!-- Use a construct like this to include admin defined profile fields. Replace FIELD1 with the name of your field. -->
			<dd><strong><?php echo $_postrow_val['PROFILE_FIELD1_NAME']; ?>:</strong> <?php echo $_postrow_val['PROFILE_FIELD1_VALUE']; ?></dd>
		<?php } $_custom_fields_count = (isset($_postrow_val['custom_fields']) && is_array($_postrow_val['custom_fields'])) ? count($_postrow_val['custom_fields']) : 0;if ($_custom_fields_count) {for ($_custom_fields_i = 0; $_custom_fields_i < $_custom_fields_count; ++$_custom_fields_i){$_custom_fields_val = &$_postrow_val['custom_fields'][$_custom_fields_i]; ?>

			<dd><strong><?php echo $_custom_fields_val['PROFILE_FIELD_NAME']; ?>:</strong> <?php echo $_custom_fields_val['PROFILE_FIELD_VALUE']; ?></dd>
		<?php }} if (! ($this->_rootref['S_IS_BOT'] ?? null)) {  if ($_postrow_val['U_PM'] || $_postrow_val['U_EMAIL'] || $_postrow_val['U_WWW'] || $_postrow_val['U_MSN'] || $_postrow_val['U_ICQ'] || $_postrow_val['U_YIM'] || $_postrow_val['U_AIM'] || $_postrow_val['U_JABBER']) {  ?>

			<dd>
				<ul class="profile-icons">
					<?php if ($_postrow_val['U_PM']) {  ?><li class="pm-icon"><a href="<?php echo $_postrow_val['U_PM']; ?>" title="<?php echo ((isset($this->_rootref['L_PRIVATE_MESSAGE'])) ? $this->_rootref['L_PRIVATE_MESSAGE'] : ((isset($user->lang['PRIVATE_MESSAGE'])) ? $user->lang['PRIVATE_MESSAGE'] : '{ PRIVATE_MESSAGE }')); ?>"><?php echo ((isset($this->_rootref['L_PM'])) ? $this->_rootref['L_PM'] : ((isset($user->lang['PM'])) ? $user->lang['PM'] : '{ PM }')); ?></a></li><?php } if ($_postrow_val['U_EMAIL']) {  ?><li class="email-icon"><a href="<?php echo $_postrow_val['U_EMAIL']; ?>" title="<?php echo ((isset($this->_rootref['L_SEND_EMAIL_USER'])) ? $this->_rootref['L_SEND_EMAIL_USER'] : ((isset($user->lang['SEND_EMAIL_USER'])) ? $user->lang['SEND_EMAIL_USER'] : '{ SEND_EMAIL_USER }')); ?> <?php echo $_postrow_val['POST_AUTHOR']; ?>"><span><?php echo ((isset($this->_rootref['L_SEND_EMAIL_USER'])) ? $this->_rootref['L_SEND_EMAIL_USER'] : ((isset($user->lang['SEND_EMAIL_USER'])) ? $user->lang['SEND_EMAIL_USER'] : '{ SEND_EMAIL_USER }')); ?> <?php echo $_postrow_val['POST_AUTHOR']; ?></span></a></li><?php } if ($_postrow_val['U_WWW']) {  ?><li class="web-icon"><a href="<?php echo $_postrow_val['U_WWW']; ?>" title="<?php echo ((isset($this->_rootref['L_VISIT_WEBSITE'])) ? $this->_rootref['L_VISIT_WEBSITE'] : ((isset($user->lang['VISIT_WEBSITE'])) ? $user->lang['VISIT_WEBSITE'] : '{ VISIT_WEBSITE }')); ?>: <?php echo $_postrow_val['U_WWW']; ?>"><span><?php echo ((isset($this->_rootref['L_WEBSITE'])) ? $this->_rootref['L_WEBSITE'] : ((isset($user->lang['WEBSITE'])) ? $user->lang['WEBSITE'] : '{ WEBSITE }')); ?></span></a></li><?php } if ($_postrow_val['U_MSN']) {  ?><li class="msnm-icon"><a href="<?php echo $_postrow_val['U_MSN']; ?>" onclick="popup(this.href, 550, 320); return false;" title="<?php echo ((isset($this->_rootref['L_MSNM'])) ? $this->_rootref['L_MSNM'] : ((isset($user->lang['MSNM'])) ? $user->lang['MSNM'] : '{ MSNM }')); ?>"><span><?php echo ((isset($this->_rootref['L_MSNM'])) ? $this->_rootref['L_MSNM'] : ((isset($user->lang['MSNM'])) ? $user->lang['MSNM'] : '{ MSNM }')); ?></span></a></li><?php } if ($_postrow_val['U_ICQ']) {  ?><li class="icq-icon"><a href="<?php echo $_postrow_val['U_ICQ']; ?>" onclick="popup(this.href, 550, 320); return false;" title="<?php echo ((isset($this->_rootref['L_ICQ'])) ? $this->_rootref['L_ICQ'] : ((isset($user->lang['ICQ'])) ? $user->lang['ICQ'] : '{ ICQ }')); ?>"><span><?php echo ((isset($this->_rootref['L_ICQ'])) ? $this->_rootref['L_ICQ'] : ((isset($user->lang['ICQ'])) ? $user->lang['ICQ'] : '{ ICQ }')); ?></span></a></li><?php } if ($_postrow_val['U_YIM']) {  ?><li class="yahoo-icon"><a href="<?php echo $_postrow_val['U_YIM']; ?>" onclick="popup(this.href, 780, 550); return false;" title="<?php echo ((isset($this->_rootref['L_YIM'])) ? $this->_rootref['L_YIM'] : ((isset($user->lang['YIM'])) ? $user->lang['YIM'] : '{ YIM }')); ?>"><span><?php echo ((isset($this->_rootref['L_YIM'])) ? $this->_rootref['L_YIM'] : ((isset($user->lang['YIM'])) ? $user->lang['YIM'] : '{ YIM }')); ?></span></a></li><?php } if ($_postrow_val['U_AIM']) {  ?><li class="aim-icon"><a href="<?php echo $_postrow_val['U_AIM']; ?>" onclick="popup(this.href, 550, 320); return false;" title="<?php echo ((isset($this->_rootref['L_AIM'])) ? $this->_rootref['L_AIM'] : ((isset($user->lang['AIM'])) ? $user->lang['AIM'] : '{ AIM }')); ?>"><span><?php echo ((isset($this->_rootref['L_AIM'])) ? $this->_rootref['L_AIM'] : ((isset($user->lang['AIM'])) ? $user->lang['AIM'] : '{ AIM }')); ?></span></a></li><?php } if ($_postrow_val['U_JABBER']) {  ?><li class="jabber-icon"><a href="<?php echo $_postrow_val['U_JABBER']; ?>" onclick="popup(this.href, 550, 320); return false;" title="<?php echo ((isset($this->_rootref['L_JABBER'])) ? $this->_rootref['L_JABBER'] : ((isset($user->lang['JABBER'])) ? $user->lang['JABBER'] : '{ JABBER }')); ?>"><span><?php echo ((isset($this->_rootref['L_JABBER'])) ? $this->_rootref['L_JABBER'] : ((isset($user->lang['JABBER'])) ? $user->lang['JABBER'] : '{ JABBER }')); ?></span></a></li><?php } if ($_postrow_val['U_GALLERY']) {  ?><li class="gallery-icon"><a href="<?php echo $_postrow_val['U_GALLERY']; ?>" title="<?php echo ((isset($this->_rootref['L_PERSONAL_ALBUM'])) ? $this->_rootref['L_PERSONAL_ALBUM'] : ((isset($user->lang['PERSONAL_ALBUM'])) ? $user->lang['PERSONAL_ALBUM'] : '{ PERSONAL_ALBUM }')); ?>"><span><?php echo ((isset($this->_rootref['L_PERSONAL_ALBUM'])) ? $this->_rootref['L_PERSONAL_ALBUM'] : ((isset($user->lang['PERSONAL_ALBUM'])) ? $user->lang['PERSONAL_ALBUM'] : '{ PERSONAL_ALBUM }')); ?></span></a></li><?php } ?>

				</ul>
			</dd>
		<?php } } ?>


		</dl>
	<?php } ?>


		<div class="back2top"><a href="#wrap" class="top" title="<?php echo ((isset($this->_rootref['L_BACK_TO_TOP'])) ? $this->_rootref['L_BACK_TO_TOP'] : ((isset($user->lang['BACK_TO_TOP'])) ? $user->lang['BACK_TO_TOP'] : '{ BACK_TO_TOP }')); ?>"><?php echo ((isset($this->_rootref['L_BACK_TO_TOP'])) ? $this->_rootref['L_BACK_TO_TOP'] : ((isset($user->lang['BACK_TO_TOP'])) ? $user->lang['BACK_TO_TOP'] : '{ BACK_TO_TOP }')); ?></a></div>

		</div>
	</div>

	<hr class="divider" />

	<?php if (( ($this->_rootref['ADS_5'] ?? null) && $_postrow_val['S_FIRST_ROW'] ) || ( ($this->_rootref['ADS_6'] ?? null) && ! $_postrow_val['S_FIRST_ROW'] )) {  ?>

	<div class="post bg3">
		<div class="inner">
			<div class="postbody" style="width: 100%;">
				<h3><?php echo ((isset($this->_rootref['L_ADVERTISEMENT'])) ? $this->_rootref['L_ADVERTISEMENT'] : ((isset($user->lang['ADVERTISEMENT'])) ? $user->lang['ADVERTISEMENT'] : '{ ADVERTISEMENT }')); ?></h3>

				<div style="font-size: 1.1em; margin: 0px auto; text-align: center;">
					<?php if ($_postrow_val['S_FIRST_ROW']) {  echo $this->_rootref['ADS_5'] ?? ''; } else { echo $this->_rootref['ADS_6'] ?? ''; } ?>

				</div>
			</div>
		</div>
	</div>
	<?php } }} if (($this->_rootref['S_QUICK_REPLY'] ?? null) && ! ($this->_rootref['S_K_QUICK_REPLY'] ?? null)) {  $this->_tpl_include('quickreply_editor.html'); } if (($this->_rootref['S_NUM_POSTS'] ?? null) > (1) || ($this->_rootref['PREVIOUS_PAGE'] ?? null)) {  ?>

	<form id="viewtopic" method="post" action="<?php echo $this->_rootref['S_TOPIC_ACTION'] ?? ''; ?>">

	<fieldset class="display-options" style="margin-top: 0; ">
		<?php if (($this->_rootref['PREVIOUS_PAGE'] ?? null)) {  ?><a href="<?php echo $this->_rootref['PREVIOUS_PAGE'] ?? ''; ?>" class="left-box <?php echo $this->_rootref['S_CONTENT_FLOW_BEGIN'] ?? ''; ?>"><?php echo ((isset($this->_rootref['L_PREVIOUS'])) ? $this->_rootref['L_PREVIOUS'] : ((isset($user->lang['PREVIOUS'])) ? $user->lang['PREVIOUS'] : '{ PREVIOUS }')); ?></a><?php } if (($this->_rootref['NEXT_PAGE'] ?? null)) {  ?><a href="<?php echo $this->_rootref['NEXT_PAGE'] ?? ''; ?>" class="right-box <?php echo $this->_rootref['S_CONTENT_FLOW_END'] ?? ''; ?>"><?php echo ((isset($this->_rootref['L_NEXT'])) ? $this->_rootref['L_NEXT'] : ((isset($user->lang['NEXT'])) ? $user->lang['NEXT'] : '{ NEXT }')); ?></a><?php } if (! ($this->_rootref['S_IS_BOT'] ?? null)) {  ?>

		<label><?php echo ((isset($this->_rootref['L_DISPLAY_POSTS'])) ? $this->_rootref['L_DISPLAY_POSTS'] : ((isset($user->lang['DISPLAY_POSTS'])) ? $user->lang['DISPLAY_POSTS'] : '{ DISPLAY_POSTS }')); ?>: <?php echo $this->_rootref['S_SELECT_SORT_DAYS'] ?? ''; ?></label>
		<label><?php echo ((isset($this->_rootref['L_SORT_BY'])) ? $this->_rootref['L_SORT_BY'] : ((isset($user->lang['SORT_BY'])) ? $user->lang['SORT_BY'] : '{ SORT_BY }')); ?> <?php echo $this->_rootref['S_SELECT_SORT_KEY'] ?? ''; ?></label> <label><?php echo $this->_rootref['S_SELECT_SORT_DIR'] ?? ''; ?> <input type="submit" name="sort" value="<?php echo ((isset($this->_rootref['L_GO'])) ? $this->_rootref['L_GO'] : ((isset($user->lang['GO'])) ? $user->lang['GO'] : '{ GO }')); ?>" class="button2" /></label>
		<?php } ?>

	</fieldset>

	</form>
	<hr />
<?php } ?>


<div class="topic-actions">
	<div class="buttons">
	<?php if (! ($this->_rootref['S_IS_BOT'] ?? null) && ($this->_rootref['S_DISPLAY_REPLY_INFO'] ?? null)) {  ?>

		<div class="<?php if (($this->_rootref['S_IS_LOCKED'] ?? null)) {  ?>locked-icon<?php } else { ?>reply-icon<?php } ?>"><a href="<?php echo $this->_rootref['U_POST_REPLY_TOPIC'] ?? ''; ?>"><span></span><?php if (($this->_rootref['S_IS_LOCKED'] ?? null)) {  echo ((isset($this->_rootref['L_TOPIC_LOCKED_SHORT'])) ? $this->_rootref['L_TOPIC_LOCKED_SHORT'] : ((isset($user->lang['TOPIC_LOCKED_SHORT'])) ? $user->lang['TOPIC_LOCKED_SHORT'] : '{ TOPIC_LOCKED_SHORT }')); } else { echo ((isset($this->_rootref['L_POST_REPLY'])) ? $this->_rootref['L_POST_REPLY'] : ((isset($user->lang['POST_REPLY'])) ? $user->lang['POST_REPLY'] : '{ POST_REPLY }')); } ?></a></div>
	<?php } if (($this->_rootref['S_K_QUICK_REPLY'] ?? null)) {  if (! ($this->_rootref['S_IS_BOT'] ?? null) && ($this->_rootref['S_DISPLAY_REPLY_INFO'] ?? null) && ! ($this->_rootref['S_IS_LOCKED'] ?? null)) {  ?>

		<div class="qreply-icon"><a class="fast-reply" href="javascript:void(0);" ><span></span><?php echo ((isset($this->_rootref['L_FAST_REPLY'])) ? $this->_rootref['L_FAST_REPLY'] : ((isset($user->lang['FAST_REPLY'])) ? $user->lang['FAST_REPLY'] : '{ FAST_REPLY }')); ?></a></div>
		<?php } } ?>

	</div>
	<?php if (($this->_rootref['PAGINATION'] ?? null) || ($this->_rootref['TOTAL_POSTS'] ?? null)) {  ?>

		<div class="pagination">
			<?php echo $this->_rootref['TOTAL_POSTS'] ?? ''; ?>

			<?php if (($this->_rootref['PAGE_NUMBER'] ?? null)) {  if (($this->_rootref['PAGINATION'] ?? null)) {  ?> &bull; <a href="#" onclick="jumpto(); return false;" title="<?php echo ((isset($this->_rootref['L_JUMP_TO_PAGE'])) ? $this->_rootref['L_JUMP_TO_PAGE'] : ((isset($user->lang['JUMP_TO_PAGE'])) ? $user->lang['JUMP_TO_PAGE'] : '{ JUMP_TO_PAGE }')); ?>"><?php echo $this->_rootref['PAGE_NUMBER'] ?? ''; ?></a> &bull; <span><?php echo $this->_rootref['PAGINATION'] ?? ''; ?></span><?php } else { ?> &bull; <?php echo $this->_rootref['PAGE_NUMBER'] ?? ''; } } ?>

		</div>
	<?php } ?>

</div>
<?php if (($this->_rootref['S_K_QUICK_REPLY'] ?? null)) {  $this->_tpl_include('sgp_quickreply_editor.html'); } if (($this->_rootref['ADS_4'] ?? null)) {  ?>

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
			<?php echo $this->_rootref['ADS_4'] ?? ''; ?>

		</div>
	</div>
</div>
<br />
<?php } $this->_tpl_include('jumpbox.html'); if (($this->_rootref['S_TOPIC_MOD'] ?? null)) {  ?>

	<form method="post" action="<?php echo $this->_rootref['S_MOD_ACTION'] ?? ''; ?>">
	<fieldset class="quickmod">
		<label for="quick-mod-select"><?php echo ((isset($this->_rootref['L_QUICK_MOD'])) ? $this->_rootref['L_QUICK_MOD'] : ((isset($user->lang['QUICK_MOD'])) ? $user->lang['QUICK_MOD'] : '{ QUICK_MOD }')); ?>:</label> <?php echo $this->_rootref['S_TOPIC_MOD'] ?? ''; ?> <input type="submit" value="<?php echo ((isset($this->_rootref['L_GO'])) ? $this->_rootref['L_GO'] : ((isset($user->lang['GO'])) ? $user->lang['GO'] : '{ GO }')); ?>" class="button2" />
		<?php echo $this->_rootref['S_FORM_TOKEN'] ?? ''; ?>

	</fieldset>
	</form>
<?php } if (($this->_rootref['S_DISPLAY_ONLINE_LIST'] ?? null)) {  ?>

	<h3><?php if (($this->_rootref['U_VIEWONLINE'] ?? null)) {  ?><a href="<?php echo $this->_rootref['U_VIEWONLINE'] ?? ''; ?>"><?php echo ((isset($this->_rootref['L_WHO_IS_ONLINE'])) ? $this->_rootref['L_WHO_IS_ONLINE'] : ((isset($user->lang['WHO_IS_ONLINE'])) ? $user->lang['WHO_IS_ONLINE'] : '{ WHO_IS_ONLINE }')); ?></a><?php } else { echo ((isset($this->_rootref['L_WHO_IS_ONLINE'])) ? $this->_rootref['L_WHO_IS_ONLINE'] : ((isset($user->lang['WHO_IS_ONLINE'])) ? $user->lang['WHO_IS_ONLINE'] : '{ WHO_IS_ONLINE }')); } ?></h3>
	<p><?php echo $this->_rootref['LOGGED_IN_USER_LIST'] ?? ''; ?></p>
<?php } $this->_tpl_include('overall_footer.html'); ?>