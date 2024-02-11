<?php if (!defined('IN_PHPBB')) exit; $this->_tpl_include('portal_footer.html'); ?>

<div id="p_footer"><!-- PUT FOOTER BLOCKS HERE --></div>
	</div>
<?php if (($this->_rootref['ADS_7'] ?? null)) {  ?>

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
			<?php echo $this->_rootref['ADS_7'] ?? ''; ?>

		</div>
	</div>
</div>
<?php } ?>


<div id="page-footer">

	<div class="navbar">
		<div class="inner">

		<ul class="linklist">
			<li class="icon-home"><?php if (($this->_rootref['STARGATE'] ?? null)) {  ?><a href="<?php echo $this->_rootref['U_PORTAL'] ?? ''; ?>"><?php echo ((isset($this->_rootref['L_PORTAL'])) ? $this->_rootref['L_PORTAL'] : ((isset($user->lang['PORTAL'])) ? $user->lang['PORTAL'] : '{ PORTAL }')); ?></a> &bull; <?php } ?><a href="<?php echo $this->_rootref['U_INDEX'] ?? ''; ?>" accesskey="h"><?php echo ((isset($this->_rootref['L_INDEX'])) ? $this->_rootref['L_INDEX'] : ((isset($user->lang['INDEX'])) ? $user->lang['INDEX'] : '{ INDEX }')); ?></a></li>
				<?php if (! ($this->_rootref['S_IS_BOT'] ?? null)) {  if (($this->_rootref['S_WATCH_FORUM_LINK'] ?? null)) {  ?><li <?php if (($this->_rootref['S_WATCHING_FORUM'] ?? null)) {  ?>class="icon-unsubscribe"<?php } else { ?>class="icon-subscribe"<?php } ?>><a href="<?php echo $this->_rootref['S_WATCH_FORUM_LINK'] ?? ''; ?>" title="<?php echo $this->_rootref['S_WATCH_FORUM_TITLE'] ?? ''; ?>"><?php echo $this->_rootref['S_WATCH_FORUM_TITLE'] ?? ''; ?></a></li><?php } if (($this->_rootref['U_WATCH_TOPIC'] ?? null)) {  ?><li <?php if (($this->_rootref['S_WATCHING_TOPIC'] ?? null)) {  ?>class="icon-unsubscribe"<?php } else { ?>class="icon-subscribe"<?php } ?>><a href="<?php echo $this->_rootref['U_WATCH_TOPIC'] ?? ''; ?>" title="<?php echo ((isset($this->_rootref['L_WATCH_TOPIC'])) ? $this->_rootref['L_WATCH_TOPIC'] : ((isset($user->lang['WATCH_TOPIC'])) ? $user->lang['WATCH_TOPIC'] : '{ WATCH_TOPIC }')); ?>"><?php echo ((isset($this->_rootref['L_WATCH_TOPIC'])) ? $this->_rootref['L_WATCH_TOPIC'] : ((isset($user->lang['WATCH_TOPIC'])) ? $user->lang['WATCH_TOPIC'] : '{ WATCH_TOPIC }')); ?></a></li><?php } if (($this->_rootref['U_BOOKMARK_TOPIC'] ?? null)) {  ?><li class="icon-bookmark"><a href="<?php echo $this->_rootref['U_BOOKMARK_TOPIC'] ?? ''; ?>" title="<?php echo ((isset($this->_rootref['L_BOOKMARK_TOPIC'])) ? $this->_rootref['L_BOOKMARK_TOPIC'] : ((isset($user->lang['BOOKMARK_TOPIC'])) ? $user->lang['BOOKMARK_TOPIC'] : '{ BOOKMARK_TOPIC }')); ?>"><?php echo ((isset($this->_rootref['L_BOOKMARK_TOPIC'])) ? $this->_rootref['L_BOOKMARK_TOPIC'] : ((isset($user->lang['BOOKMARK_TOPIC'])) ? $user->lang['BOOKMARK_TOPIC'] : '{ BOOKMARK_TOPIC }')); ?></a></li><?php } if (($this->_rootref['U_BUMP_TOPIC'] ?? null)) {  ?><li class="icon-bump"><a href="<?php echo $this->_rootref['U_BUMP_TOPIC'] ?? ''; ?>" title="<?php echo ((isset($this->_rootref['L_BUMP_TOPIC'])) ? $this->_rootref['L_BUMP_TOPIC'] : ((isset($user->lang['BUMP_TOPIC'])) ? $user->lang['BUMP_TOPIC'] : '{ BUMP_TOPIC }')); ?>"><?php echo ((isset($this->_rootref['L_BUMP_TOPIC'])) ? $this->_rootref['L_BUMP_TOPIC'] : ((isset($user->lang['BUMP_TOPIC'])) ? $user->lang['BUMP_TOPIC'] : '{ BUMP_TOPIC }')); ?></a></li><?php } } ?>

			<li class="rightside"><?php if (($this->_rootref['U_TEAM'] ?? null)) {  ?><a href="<?php echo $this->_rootref['U_TEAM'] ?? ''; ?>"><?php echo ((isset($this->_rootref['L_THE_TEAM'])) ? $this->_rootref['L_THE_TEAM'] : ((isset($user->lang['THE_TEAM'])) ? $user->lang['THE_TEAM'] : '{ THE_TEAM }')); ?></a> <?php if (($this->_rootref['S_MOD_DISPLAY'] ?? null)) {  ?> &bull; <a href="<?php echo $this->_rootref['U_MODS_DB'] ?? ''; ?>"><?php echo ((isset($this->_rootref['L_MODS_DB'])) ? $this->_rootref['L_MODS_DB'] : ((isset($user->lang['MODS_DB'])) ? $user->lang['MODS_DB'] : '{ MODS_DB }')); ?></a><?php } ?>   &bull; <?php } if (! ($this->_rootref['S_IS_BOT'] ?? null)) {  ?><a href="<?php echo $this->_rootref['U_DELETE_COOKIES'] ?? ''; ?>"><?php echo ((isset($this->_rootref['L_DELETE_COOKIES'])) ? $this->_rootref['L_DELETE_COOKIES'] : ((isset($user->lang['DELETE_COOKIES'])) ? $user->lang['DELETE_COOKIES'] : '{ DELETE_COOKIES }')); ?></a> &bull; <?php } echo $this->_rootref['S_TIMEZONE'] ?? ''; ?></li>
		</ul>

		</div>
	</div>

	<div class="copyright"><?php echo $this->_rootref['CREDIT_LINE'] ?? ''; ?>

		<?php if (($this->_rootref['STARGATE'] ?? null)) {  $this->_tpl_include('portal_copyright.html'); } if (($this->_rootref['TRANSLATION_INFO'] ?? null)) {  ?><br /><?php echo $this->_rootref['TRANSLATION_INFO'] ?? ''; } if (($this->_rootref['DEBUG_OUTPUT'] ?? null)) {  ?><br /><?php echo $this->_rootref['DEBUG_OUTPUT'] ?? ''; } if (($this->_rootref['U_ACP'] ?? null)) {  ?><br /><strong><a href="<?php echo $this->_rootref['U_ACP'] ?? ''; ?>"><?php echo ((isset($this->_rootref['L_ACP'])) ? $this->_rootref['L_ACP'] : ((isset($user->lang['ACP'])) ? $user->lang['ACP'] : '{ ACP }')); ?></a></strong><?php } ?>

	</div>
	<?php echo $this->_rootref['ADS_8'] ?? ''; ?>

</div>

</div>

<div>
	<a id="bottom" name="bottom" accesskey="z"></a>
	<?php if (! ($this->_rootref['S_IS_BOT'] ?? null)) {  echo $this->_rootref['RUN_CRON_TASK'] ?? ''; } ?>

</div>


<?php if (($this->_rootref['STARGATE'] ?? null)) {  ?>

</div><!-- stylewidth --><?php } if (($this->_rootref['S_REGISTRATION'] ?? null) || ($this->_rootref['S_CHANGE_PASSWORD'] ?? null)) {  $this->_tpl_include('password_strength.html'); } ?>

</body>
</html>