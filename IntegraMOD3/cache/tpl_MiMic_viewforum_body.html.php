<?php if (!defined('IN_PHPBB')) exit; $this->_tpl_include('overall_header.html'); if (($this->_rootref['U_MCP'] ?? null)) {  ?><p>[&nbsp;<a href="<?php echo $this->_rootref['U_MCP'] ?? ''; ?>"><?php echo ((isset($this->_rootref['L_MCP'])) ? $this->_rootref['L_MCP'] : ((isset($user->lang['MCP'])) ? $user->lang['MCP'] : '{ MCP }')); ?></a>&nbsp;]</p><?php } ?>

<h2><a href="<?php echo $this->_rootref['U_VIEW_FORUM'] ?? ''; ?>"><?php echo $this->_rootref['FORUM_NAME'] ?? ''; ?></a></h2>

<?php if (($this->_rootref['FORUM_DESC'] ?? null) || ($this->_rootref['MODERATORS'] ?? null) || ($this->_rootref['U_MCP'] ?? null)) {  ?>

<div>
	<!-- NOTE: remove the style="display: none" when you want to have the forum description on the forum body --><?php if (($this->_rootref['FORUM_DESC'] ?? null)) {  ?><div style="display: none !important;"><?php echo $this->_rootref['FORUM_DESC'] ?? ''; ?><br /></div><?php } if (($this->_rootref['MODERATORS'] ?? null)) {  ?><p><strong><?php if (($this->_rootref['S_SINGLE_MODERATOR'] ?? null)) {  echo ((isset($this->_rootref['L_MODERATOR'])) ? $this->_rootref['L_MODERATOR'] : ((isset($user->lang['MODERATOR'])) ? $user->lang['MODERATOR'] : '{ MODERATOR }')); } else { echo ((isset($this->_rootref['L_MODERATORS'])) ? $this->_rootref['L_MODERATORS'] : ((isset($user->lang['MODERATORS'])) ? $user->lang['MODERATORS'] : '{ MODERATORS }')); } ?>:</strong> <?php echo $this->_rootref['MODERATORS'] ?? ''; ?></p><?php } ?>

</div>
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
<?php } if (($this->_rootref['S_HAS_SUBFORUM'] ?? null)) {  if (! ($this->_rootref['S_IS_BOT'] ?? null) && ($this->_rootref['U_MARK_FORUMS'] ?? null)) {  ?>

<ul class="linklist">
	<li class="rightside"><a href="<?php echo $this->_rootref['U_MARK_FORUMS'] ?? ''; ?>"><?php echo ((isset($this->_rootref['L_MARK_SUBFORUMS_READ'])) ? $this->_rootref['L_MARK_SUBFORUMS_READ'] : ((isset($user->lang['MARK_SUBFORUMS_READ'])) ? $user->lang['MARK_SUBFORUMS_READ'] : '{ MARK_SUBFORUMS_READ }')); ?></a></li>
</ul>
<?php } $this->_tpl_include('forumlist_body.html'); } if (($this->_rootref['S_DISPLAY_POST_INFO'] ?? null) || ($this->_rootref['PAGINATION'] ?? null) || ($this->_rootref['TOTAL_POSTS'] ?? null) || ($this->_rootref['TOTAL_TOPICS'] ?? null)) {  ?>

	<div class="topic-actions" <?php if (($this->_rootref['S_HAS_SUBFORUM'] ?? null)) {  ?>style="margin-top: 2em;"<?php } ?>>

	<?php if (! ($this->_rootref['S_IS_BOT'] ?? null) && ($this->_rootref['S_DISPLAY_POST_INFO'] ?? null)) {  ?>

		<div class="buttons">
			<div class="<?php if (($this->_rootref['S_IS_LOCKED'] ?? null)) {  ?>locked-icon<?php } else { ?>post-icon<?php } ?>" ><a href="<?php echo $this->_rootref['U_POST_NEW_TOPIC'] ?? ''; ?>"><span></span><?php if (($this->_rootref['S_IS_LOCKED'] ?? null)) {  echo ((isset($this->_rootref['L_FORUM_LOCKED'])) ? $this->_rootref['L_FORUM_LOCKED'] : ((isset($user->lang['FORUM_LOCKED'])) ? $user->lang['FORUM_LOCKED'] : '{ FORUM_LOCKED }')); } else { echo ((isset($this->_rootref['L_POST_TOPIC'])) ? $this->_rootref['L_POST_TOPIC'] : ((isset($user->lang['POST_TOPIC'])) ? $user->lang['POST_TOPIC'] : '{ POST_TOPIC }')); } ?></a></div>
		</div>
	<?php } if (($this->_rootref['S_DISPLAY_SEARCHBOX'] ?? null)) {  ?>

		<div class="search-box">
			<form method="get" id="forum-search" action="<?php echo $this->_rootref['S_SEARCHBOX_ACTION'] ?? ''; ?>">
			<fieldset>
				<input class="inputbox search tiny" type="text" name="keywords" id="search_keywords" size="20" value="<?php echo ((isset($this->_rootref['L_SEARCH_FORUM'])) ? $this->_rootref['L_SEARCH_FORUM'] : ((isset($user->lang['SEARCH_FORUM'])) ? $user->lang['SEARCH_FORUM'] : '{ SEARCH_FORUM }')); ?>" onclick="if (this.value == '<?php echo ((isset($this->_rootref['LA_SEARCH_FORUM'])) ? $this->_rootref['LA_SEARCH_FORUM'] : ((isset($this->_rootref['L_SEARCH_FORUM'])) ? addslashes($this->_rootref['L_SEARCH_FORUM']) : ((isset($user->lang['SEARCH_FORUM'])) ? addslashes($user->lang['SEARCH_FORUM']) : '{ SEARCH_FORUM }'))); ?>') this.value = '';" onblur="if (this.value == '') this.value = '<?php echo ((isset($this->_rootref['LA_SEARCH_FORUM'])) ? $this->_rootref['LA_SEARCH_FORUM'] : ((isset($this->_rootref['L_SEARCH_FORUM'])) ? addslashes($this->_rootref['L_SEARCH_FORUM']) : ((isset($user->lang['SEARCH_FORUM'])) ? addslashes($user->lang['SEARCH_FORUM']) : '{ SEARCH_FORUM }'))); ?>';" />
				<input class="button2" type="submit" value="<?php echo ((isset($this->_rootref['L_SEARCH'])) ? $this->_rootref['L_SEARCH'] : ((isset($user->lang['SEARCH'])) ? $user->lang['SEARCH'] : '{ SEARCH }')); ?>" />
				<?php echo $this->_rootref['S_SEARCH_LOCAL_HIDDEN_FIELDS'] ?? ''; ?>

			</fieldset>
			</form>
		</div>
	<?php } if (($this->_rootref['PAGINATION'] ?? null) || ($this->_rootref['TOTAL_POSTS'] ?? null) || ($this->_rootref['TOTAL_TOPICS'] ?? null)) {  ?>

		<div class="pagination">
			<?php if (! ($this->_rootref['S_IS_BOT'] ?? null) && ($this->_rootref['U_MARK_TOPICS'] ?? null)) {  ?><a href="<?php echo $this->_rootref['U_MARK_TOPICS'] ?? ''; ?>" accesskey="m"><?php echo ((isset($this->_rootref['L_MARK_TOPICS_READ'])) ? $this->_rootref['L_MARK_TOPICS_READ'] : ((isset($user->lang['MARK_TOPICS_READ'])) ? $user->lang['MARK_TOPICS_READ'] : '{ MARK_TOPICS_READ }')); ?></a> &bull; <?php } if (($this->_rootref['TOTAL_TOPICS'] ?? null)) {  echo $this->_rootref['TOTAL_TOPICS'] ?? ''; } if (($this->_rootref['PAGE_NUMBER'] ?? null)) {  if (($this->_rootref['PAGINATION'] ?? null)) {  ?> &bull; <a href="#" onclick="jumpto(); return false;" title="<?php echo ((isset($this->_rootref['L_JUMP_TO_PAGE'])) ? $this->_rootref['L_JUMP_TO_PAGE'] : ((isset($user->lang['JUMP_TO_PAGE'])) ? $user->lang['JUMP_TO_PAGE'] : '{ JUMP_TO_PAGE }')); ?>"><?php echo $this->_rootref['PAGE_NUMBER'] ?? ''; ?></a> &bull; <span><?php echo $this->_rootref['PAGINATION'] ?? ''; ?></span><?php } else { ?> &bull; <?php echo $this->_rootref['PAGE_NUMBER'] ?? ''; } } ?>

		</div>
	<?php } ?>


	</div>
<?php } if (($this->_rootref['S_NO_READ_ACCESS'] ?? null)) {  ?>


	<div class="panel">
		<div class="inner">
		<strong><?php echo ((isset($this->_rootref['L_NO_READ_ACCESS'])) ? $this->_rootref['L_NO_READ_ACCESS'] : ((isset($user->lang['NO_READ_ACCESS'])) ? $user->lang['NO_READ_ACCESS'] : '{ NO_READ_ACCESS }')); ?></strong>
		</div>
	</div>

	<?php if (! ($this->_rootref['S_USER_LOGGED_IN'] ?? null) && ! ($this->_rootref['S_IS_BOT'] ?? null)) {  ?>


		<form action="<?php echo $this->_rootref['S_LOGIN_ACTION'] ?? ''; ?>" method="post">

		<div class="panel">
			<div class="inner">

			<div class="content">
				<h3><a href="<?php echo $this->_rootref['U_LOGIN_LOGOUT'] ?? ''; ?>"><?php echo ((isset($this->_rootref['L_LOGIN_LOGOUT'])) ? $this->_rootref['L_LOGIN_LOGOUT'] : ((isset($user->lang['LOGIN_LOGOUT'])) ? $user->lang['LOGIN_LOGOUT'] : '{ LOGIN_LOGOUT }')); ?></a><?php if (($this->_rootref['S_REGISTER_ENABLED'] ?? null)) {  ?>&nbsp; &bull; &nbsp;<a href="<?php echo $this->_rootref['U_REGISTER'] ?? ''; ?>"><?php echo ((isset($this->_rootref['L_REGISTER'])) ? $this->_rootref['L_REGISTER'] : ((isset($user->lang['REGISTER'])) ? $user->lang['REGISTER'] : '{ REGISTER }')); ?></a><?php } ?></h3>

				<fieldset class="fields1">
				<dl>
					<dt><label for="username"><?php echo ((isset($this->_rootref['L_USERNAME'])) ? $this->_rootref['L_USERNAME'] : ((isset($user->lang['USERNAME'])) ? $user->lang['USERNAME'] : '{ USERNAME }')); ?>:</label></dt>
					<dd><input type="text" tabindex="1" name="username" id="username" size="25" value="<?php echo $this->_rootref['USERNAME'] ?? ''; ?>" class="inputbox autowidth" /></dd>
				</dl>
				<dl>
					<dt><label for="password"><?php echo ((isset($this->_rootref['L_PASSWORD'])) ? $this->_rootref['L_PASSWORD'] : ((isset($user->lang['PASSWORD'])) ? $user->lang['PASSWORD'] : '{ PASSWORD }')); ?>:</label></dt>
					<dd><input type="password" tabindex="2" id="password" name="password" size="25" class="inputbox autowidth" /></dd>
					<?php if (($this->_rootref['S_AUTOLOGIN_ENABLED'] ?? null)) {  ?><dd><label for="autologin"><input type="checkbox" name="autologin" id="autologin" tabindex="3" /> <?php echo ((isset($this->_rootref['L_LOG_ME_IN'])) ? $this->_rootref['L_LOG_ME_IN'] : ((isset($user->lang['LOG_ME_IN'])) ? $user->lang['LOG_ME_IN'] : '{ LOG_ME_IN }')); ?></label></dd><?php } ?>

					<dd><label for="viewonline"><input type="checkbox" name="viewonline" id="viewonline" tabindex="4" /> <?php echo ((isset($this->_rootref['L_HIDE_ME'])) ? $this->_rootref['L_HIDE_ME'] : ((isset($user->lang['HIDE_ME'])) ? $user->lang['HIDE_ME'] : '{ HIDE_ME }')); ?></label></dd>
				</dl>
				<dl>
					<dt>&nbsp;</dt>
					<dd><input type="submit" name="login" tabindex="5" value="<?php echo ((isset($this->_rootref['L_LOGIN'])) ? $this->_rootref['L_LOGIN'] : ((isset($user->lang['LOGIN'])) ? $user->lang['LOGIN'] : '{ LOGIN }')); ?>" class="button1" /></dd>
				</dl>
				<?php echo $this->_rootref['S_LOGIN_REDIRECT'] ?? ''; ?>

				</fieldset>
			</div>

			</div>
		</div>

		</form>

	<?php } } $_topicrow_count = (isset($this->_tpldata['topicrow']) && is_array($this->_tpldata['topicrow'])) ? count($this->_tpldata['topicrow']) : 0;if ($_topicrow_count) {for ($_topicrow_i = 0; $_topicrow_i < $_topicrow_count; ++$_topicrow_i){$_topicrow_val = &$this->_tpldata['topicrow'][$_topicrow_i]; if (! $_topicrow_val['S_TOPIC_TYPE_SWITCH'] && ! $_topicrow_val['S_FIRST_ROW']) {  ?>

		</ul>
		</div>
	</div>
	<?php } if ($_topicrow_val['S_FIRST_ROW'] || ! $_topicrow_val['S_TOPIC_TYPE_SWITCH']) {  ?>

		<div class="forumbg<?php if ($_topicrow_val['S_TOPIC_TYPE_SWITCH'] && ( $_topicrow_val['S_POST_ANNOUNCE'] || $_topicrow_val['S_POST_GLOBAL'] )) {  ?> announcement<?php } ?>">
		<div class="inner">
		<ul class="topiclist">
			<li class="header">
				<dl class="icon">
					<dt><?php if (($this->_rootref['S_DISPLAY_ACTIVE'] ?? null)) {  echo ((isset($this->_rootref['L_ACTIVE_TOPICS'])) ? $this->_rootref['L_ACTIVE_TOPICS'] : ((isset($user->lang['ACTIVE_TOPICS'])) ? $user->lang['ACTIVE_TOPICS'] : '{ ACTIVE_TOPICS }')); } else if ($_topicrow_val['S_TOPIC_TYPE_SWITCH'] && ( $_topicrow_val['S_POST_ANNOUNCE'] || $_topicrow_val['S_POST_GLOBAL'] || $_topicrow_val['S_POST_NEWS'] || $_topicrow_val['S_POST_NEWS_GLOBAL'] )) {  echo ((isset($this->_rootref['L_ANNOUNCEMENTS_AND_NEWS'])) ? $this->_rootref['L_ANNOUNCEMENTS_AND_NEWS'] : ((isset($user->lang['ANNOUNCEMENTS_AND_NEWS'])) ? $user->lang['ANNOUNCEMENTS_AND_NEWS'] : '{ ANNOUNCEMENTS_AND_NEWS }')); } else { echo ((isset($this->_rootref['L_TOPICS'])) ? $this->_rootref['L_TOPICS'] : ((isset($user->lang['TOPICS'])) ? $user->lang['TOPICS'] : '{ TOPICS }')); } ?></dt>
					<dd class="posts"><?php echo ((isset($this->_rootref['L_REPLIES'])) ? $this->_rootref['L_REPLIES'] : ((isset($user->lang['REPLIES'])) ? $user->lang['REPLIES'] : '{ REPLIES }')); ?></dd>
					<dd class="views"><?php echo ((isset($this->_rootref['L_VIEWS'])) ? $this->_rootref['L_VIEWS'] : ((isset($user->lang['VIEWS'])) ? $user->lang['VIEWS'] : '{ VIEWS }')); ?></dd>
					<dd class="lastpost"><span><?php echo ((isset($this->_rootref['L_LAST_POST'])) ? $this->_rootref['L_LAST_POST'] : ((isset($user->lang['LAST_POST'])) ? $user->lang['LAST_POST'] : '{ LAST_POST }')); ?></span></dd>
				</dl>
			</li>
		</ul>
		<ul class="topiclist topics catpanel">
	<?php } ?>


		<li class="row panel<?php if (!($_topicrow_val['S_ROW_COUNT'] & 1)  ) {  ?> bg1<?php } else { ?> bg2<?php } if ($_topicrow_val['S_POST_GLOBAL']) {  ?> global-announce<?php } if ($_topicrow_val['S_POST_ANNOUNCE']) {  ?> announce<?php } if ($_topicrow_val['S_POST_STICKY']) {  ?> sticky<?php } if ($_topicrow_val['S_TOPIC_REPORTED']) {  ?> reported<?php } ?>">
			<dl class="icon" style="background-image: url(<?php echo $_topicrow_val['TOPIC_FOLDER_IMG_SRC']; ?>); background-repeat: no-repeat;">
				<dt<?php if ($_topicrow_val['TOPIC_ICON_IMG'] && ($this->_rootref['S_TOPIC_ICONS'] ?? null)) {  ?> style="background-image: url(<?php echo $this->_rootref['T_ICONS_PATH'] ?? ''; echo $_topicrow_val['TOPIC_ICON_IMG']; ?>); background-repeat: no-repeat;"<?php } ?> title="<?php echo $_topicrow_val['TOPIC_FOLDER_IMG_ALT']; ?>"><?php if ($_topicrow_val['S_UNREAD_TOPIC']) {  ?><a href="<?php echo $_topicrow_val['U_NEWEST_POST']; ?>"><?php echo $this->_rootref['NEWEST_POST_IMG'] ?? ''; ?></a> <?php } ?><a href="<?php echo $_topicrow_val['U_VIEW_TOPIC']; ?>" <?php if (($this->_rootref['STARGATE'] ?? null)) {  ?>title="<?php echo $_topicrow_val['TOOLTIP']; ?>"<?php } ?> class="topictitle"><?php echo $_topicrow_val['TOPIC_TITLE']; ?></a>
					<?php if ($_topicrow_val['S_TOPIC_UNAPPROVED'] || $_topicrow_val['S_POSTS_UNAPPROVED']) {  ?><a href="<?php echo $_topicrow_val['U_MCP_QUEUE']; ?>"><?php echo $_topicrow_val['UNAPPROVED_IMG']; ?></a> <?php } if ($_topicrow_val['S_TOPIC_REPORTED']) {  ?><a href="<?php echo $_topicrow_val['U_MCP_REPORT']; ?>"><?php echo $this->_rootref['REPORTED_IMG'] ?? ''; ?></a><?php } ?><br />
					<?php if ($_topicrow_val['PAGINATION']) {  ?><strong class="pagination"><span><?php echo $_topicrow_val['PAGINATION']; ?></span></strong><?php } if ($_topicrow_val['ATTACH_ICON_IMG']) {  echo $_topicrow_val['ATTACH_ICON_IMG']; ?> <?php } echo ((isset($this->_rootref['L_POST_BY_AUTHOR'])) ? $this->_rootref['L_POST_BY_AUTHOR'] : ((isset($user->lang['POST_BY_AUTHOR'])) ? $user->lang['POST_BY_AUTHOR'] : '{ POST_BY_AUTHOR }')); ?> <?php echo $_topicrow_val['TOPIC_AUTHOR_FULL']; ?> &raquo; <?php echo $_topicrow_val['FIRST_POST_TIME']; ?>

				</dt>
				<dd class="posts"><a href="<?php echo $_topicrow_val['U_WHO_POSTED']; ?>" onclick="window.open(this.href,'','statusbar=no,menubar=no,toolbar=no,scrollbars=yes,resizable=yes,width=500,height=300'); return false;"><?php echo $_topicrow_val['REPLIES']; ?></a> <dfn><?php echo ((isset($this->_rootref['L_REPLIES'])) ? $this->_rootref['L_REPLIES'] : ((isset($user->lang['REPLIES'])) ? $user->lang['REPLIES'] : '{ REPLIES }')); ?></dfn></dd>
				<dd class="views"><?php echo $_topicrow_val['VIEWS']; ?> <dfn><?php echo ((isset($this->_rootref['L_VIEWS'])) ? $this->_rootref['L_VIEWS'] : ((isset($user->lang['VIEWS'])) ? $user->lang['VIEWS'] : '{ VIEWS }')); ?></dfn></dd>
				<dd class="lastpost"><span><dfn><?php echo ((isset($this->_rootref['L_LAST_POST'])) ? $this->_rootref['L_LAST_POST'] : ((isset($user->lang['LAST_POST'])) ? $user->lang['LAST_POST'] : '{ LAST_POST }')); ?> </dfn><?php echo ((isset($this->_rootref['L_POST_BY_AUTHOR'])) ? $this->_rootref['L_POST_BY_AUTHOR'] : ((isset($user->lang['POST_BY_AUTHOR'])) ? $user->lang['POST_BY_AUTHOR'] : '{ POST_BY_AUTHOR }')); ?> <?php echo $_topicrow_val['LAST_POST_AUTHOR_FULL']; ?>

					<?php if (! ($this->_rootref['S_IS_BOT'] ?? null)) {  ?><a href="<?php echo $_topicrow_val['U_LAST_POST']; ?>"><?php echo $this->_rootref['LAST_POST_IMG'] ?? ''; ?></a> <?php } ?><br /><?php echo $_topicrow_val['LAST_POST_TIME']; ?></span>
				</dd>
			</dl>
		</li>

	<?php if ($_topicrow_val['S_LAST_ROW']) {  ?>

			</ul>
		</div>
	</div>
	<?php } }} else { if (($this->_rootref['S_IS_POSTABLE'] ?? null)) {  ?>

	<div class="panel">
		<div class="inner">
		<strong><?php echo ((isset($this->_rootref['L_NO_TOPICS'])) ? $this->_rootref['L_NO_TOPICS'] : ((isset($user->lang['NO_TOPICS'])) ? $user->lang['NO_TOPICS'] : '{ NO_TOPICS }')); ?></strong>
		</div>
	</div>
	<?php } } if (($this->_rootref['S_SELECT_SORT_DAYS'] ?? null) && ! ($this->_rootref['S_DISPLAY_ACTIVE'] ?? null)) {  ?>

	<form method="post" action="<?php echo $this->_rootref['S_FORUM_ACTION'] ?? ''; ?>">
		<fieldset class="display-options">
			<?php if (($this->_rootref['PREVIOUS_PAGE'] ?? null)) {  ?><a href="<?php echo $this->_rootref['PREVIOUS_PAGE'] ?? ''; ?>" class="left-box <?php echo $this->_rootref['S_CONTENT_FLOW_BEGIN'] ?? ''; ?>"><?php echo ((isset($this->_rootref['L_PREVIOUS'])) ? $this->_rootref['L_PREVIOUS'] : ((isset($user->lang['PREVIOUS'])) ? $user->lang['PREVIOUS'] : '{ PREVIOUS }')); ?></a><?php } if (($this->_rootref['NEXT_PAGE'] ?? null)) {  ?><a href="<?php echo $this->_rootref['NEXT_PAGE'] ?? ''; ?>" class="right-box <?php echo $this->_rootref['S_CONTENT_FLOW_END'] ?? ''; ?>"><?php echo ((isset($this->_rootref['L_NEXT'])) ? $this->_rootref['L_NEXT'] : ((isset($user->lang['NEXT'])) ? $user->lang['NEXT'] : '{ NEXT }')); ?></a><?php } if (! ($this->_rootref['S_IS_BOT'] ?? null)) {  ?>

			<label><?php echo ((isset($this->_rootref['L_DISPLAY_TOPICS'])) ? $this->_rootref['L_DISPLAY_TOPICS'] : ((isset($user->lang['DISPLAY_TOPICS'])) ? $user->lang['DISPLAY_TOPICS'] : '{ DISPLAY_TOPICS }')); ?>: <?php echo $this->_rootref['S_SELECT_SORT_DAYS'] ?? ''; ?></label>
			<label><?php echo ((isset($this->_rootref['L_SORT_BY'])) ? $this->_rootref['L_SORT_BY'] : ((isset($user->lang['SORT_BY'])) ? $user->lang['SORT_BY'] : '{ SORT_BY }')); ?> <?php echo $this->_rootref['S_SELECT_SORT_KEY'] ?? ''; ?></label>
			<label><?php echo $this->_rootref['S_SELECT_SORT_DIR'] ?? ''; ?> <input type="submit" name="sort" value="<?php echo ((isset($this->_rootref['L_GO'])) ? $this->_rootref['L_GO'] : ((isset($user->lang['GO'])) ? $user->lang['GO'] : '{ GO }')); ?>" class="button2" /></label>
	<?php } ?>

		</fieldset>
	</form>
	<hr />
<?php } if (!empty($this->_tpldata['topicrow']) && ! ($this->_rootref['S_DISPLAY_ACTIVE'] ?? null)) {  ?>

	<div class="topic-actions">
		<?php if (! ($this->_rootref['S_IS_BOT'] ?? null) && ($this->_rootref['S_DISPLAY_POST_INFO'] ?? null)) {  ?>

		<div class="buttons">
			<div class="<?php if (($this->_rootref['S_IS_LOCKED'] ?? null)) {  ?>locked-icon<?php } else { ?>post-icon<?php } ?>" ><a href="<?php echo $this->_rootref['U_POST_NEW_TOPIC'] ?? ''; ?>"><span></span><?php if (($this->_rootref['S_IS_LOCKED'] ?? null)) {  echo ((isset($this->_rootref['L_FORUM_LOCKED'])) ? $this->_rootref['L_FORUM_LOCKED'] : ((isset($user->lang['FORUM_LOCKED'])) ? $user->lang['FORUM_LOCKED'] : '{ FORUM_LOCKED }')); } else { echo ((isset($this->_rootref['L_POST_TOPIC'])) ? $this->_rootref['L_POST_TOPIC'] : ((isset($user->lang['POST_TOPIC'])) ? $user->lang['POST_TOPIC'] : '{ POST_TOPIC }')); } ?></a></div>
		</div>
		<?php } if (($this->_rootref['PAGINATION'] ?? null) || ($this->_rootref['TOTAL_POSTS'] ?? null) || ($this->_rootref['TOTAL_TOPICS'] ?? null)) {  ?>

		<div class="pagination">
			<?php if (($this->_rootref['TOTAL_TOPICS'] ?? null) && ! ($this->_rootref['S_IS_BOT'] ?? null) && ($this->_rootref['U_MARK_TOPICS'] ?? null)) {  ?><a href="<?php echo $this->_rootref['U_MARK_TOPICS'] ?? ''; ?>"><?php echo ((isset($this->_rootref['L_MARK_TOPICS_READ'])) ? $this->_rootref['L_MARK_TOPICS_READ'] : ((isset($user->lang['MARK_TOPICS_READ'])) ? $user->lang['MARK_TOPICS_READ'] : '{ MARK_TOPICS_READ }')); ?></a> &bull;  <?php } if (($this->_rootref['TOTAL_POSTS'] ?? null) && ! ($this->_rootref['NEWEST_USER'] ?? null)) {  ?> <?php echo $this->_rootref['TOTAL_POSTS'] ?? ''; } else if (($this->_rootref['TOTAL_TOPICS'] ?? null) && ! ($this->_rootref['NEWEST_USER'] ?? null)) {  ?> <?php echo $this->_rootref['TOTAL_TOPICS'] ?? ''; } if (($this->_rootref['TOTAL_USERS'] ?? null)) {  echo $this->_rootref['TOTAL_USERS'] ?? ''; } if (($this->_rootref['PAGINATION'] ?? null)) {  ?> &bull;  <a href="#" onclick="jumpto(); return false;" title="<?php echo ((isset($this->_rootref['L_JUMP_TO_PAGE'])) ? $this->_rootref['L_JUMP_TO_PAGE'] : ((isset($user->lang['JUMP_TO_PAGE'])) ? $user->lang['JUMP_TO_PAGE'] : '{ JUMP_TO_PAGE }')); ?>"><?php echo $this->_rootref['PAGE_NUMBER'] ?? ''; ?></a>
			 &bull;  <span><?php echo $this->_rootref['PAGINATION'] ?? ''; ?></span><?php } else { ?> &bull; <?php echo $this->_rootref['PAGE_NUMBER'] ?? ''; } ?>

		</div>
		<?php } ?>

	</div>
<?php } $this->_tpl_include('jumpbox.html'); if (($this->_rootref['S_DISPLAY_ONLINE_LIST'] ?? null)) {  ?>

	<h3><?php if (($this->_rootref['U_VIEWONLINE'] ?? null)) {  ?><a href="<?php echo $this->_rootref['U_VIEWONLINE'] ?? ''; ?>"><?php echo ((isset($this->_rootref['L_WHO_IS_ONLINE'])) ? $this->_rootref['L_WHO_IS_ONLINE'] : ((isset($user->lang['WHO_IS_ONLINE'])) ? $user->lang['WHO_IS_ONLINE'] : '{ WHO_IS_ONLINE }')); ?></a><?php } else { echo ((isset($this->_rootref['L_WHO_IS_ONLINE'])) ? $this->_rootref['L_WHO_IS_ONLINE'] : ((isset($user->lang['WHO_IS_ONLINE'])) ? $user->lang['WHO_IS_ONLINE'] : '{ WHO_IS_ONLINE }')); } ?></h3>
	<p><?php echo $this->_rootref['LOGGED_IN_USER_LIST'] ?? ''; ?></p>
<?php } if (($this->_rootref['S_DISPLAY_POST_INFO'] ?? null)) {  ?>

	<h3><?php echo ((isset($this->_rootref['L_FORUM_PERMISSIONS'])) ? $this->_rootref['L_FORUM_PERMISSIONS'] : ((isset($user->lang['FORUM_PERMISSIONS'])) ? $user->lang['FORUM_PERMISSIONS'] : '{ FORUM_PERMISSIONS }')); ?></h3>
	<p><?php $_rules_count = (isset($this->_tpldata['rules']) && is_array($this->_tpldata['rules'])) ? count($this->_tpldata['rules']) : 0;if ($_rules_count) {for ($_rules_i = 0; $_rules_i < $_rules_count; ++$_rules_i){$_rules_val = &$this->_tpldata['rules'][$_rules_i]; echo $_rules_val['RULE']; ?><br /><?php }} ?></p>
<?php } $this->_tpl_include('overall_footer.html'); ?>