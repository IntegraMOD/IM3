<?php if (!defined('IN_PHPBB')) exit; ?><!-- IDTAG starts block_last_online.html 4 November 2008 copyright phpbbireland.com 2008 -->
<div class="block_data">
<?php if (($this->_rootref['VIEWONLINE'] ?? null)) {  ?>

	<div>
		<span style="position: relative; float:left; text-align:left; width:70%;"><b><?php echo ((isset($this->_rootref['L_USERNAME'])) ? $this->_rootref['L_USERNAME'] : ((isset($user->lang['USERNAME'])) ? $user->lang['USERNAME'] : '{ USERNAME }')); ?></b></span>
		<span style="position: relative; float:right; text-align:right; width:30%;"><b><?php echo ((isset($this->_rootref['L_ONLINE'])) ? $this->_rootref['L_ONLINE'] : ((isset($user->lang['ONLINE'])) ? $user->lang['ONLINE'] : '{ ONLINE }')); ?></b></span>
	</div>
	<div class="top_poster">
	<?php $_last_online_count = (isset($this->_tpldata['last_online']) && is_array($this->_tpldata['last_online'])) ? count($this->_tpldata['last_online']) : 0;if ($_last_online_count) {for ($_last_online_i = 0; $_last_online_i < $_last_online_count; ++$_last_online_i){$_last_online_val = &$this->_tpldata['last_online'][$_last_online_i]; ?>

		<span class="bg2" style="position: relative; float:left; text-align:left; width:100%; padding:0; font-size: 9px;" >
			<?php if ($_last_online_val['USER_AVATAR_IMG']) {  ?>

				<?php echo $_last_online_val['USER_AVATAR_IMG']; ?>

			<?php } else { ?>

				<img src="<?php echo $this->_rootref['T_THEME_PATH'] ?? ''; ?>/images/no_avatar.gif" width="16" height="16" alt="" />
			<?php } ?>

			<?php echo $_last_online_val['USERNAME_FULL']; ?>

		</span>
		<span class="bg3" style="position: relative; float:left; text-align:center; width:100%; padding-bottom:3px; font-size: 9px;">
			<?php echo $_last_online_val['ONLINE_TIME']; ?>

		</span>
		<br style="clear:both;" />
	<?php }} ?>

	<br />
	</div>
<?php } if (($this->_rootref['NO_VIEWONLINE_R'] ?? null)) {  ?>

	<div style="text-align:center;">
          <strong><?php echo ((isset($this->_rootref['L_NO_VIEW_USERS_R'])) ? $this->_rootref['L_NO_VIEW_USERS_R'] : ((isset($user->lang['NO_VIEW_USERS_R'])) ? $user->lang['NO_VIEW_USERS_R'] : '{ NO_VIEW_USERS_R }')); ?></strong>
		<br />
	</div>
<?php } if (($this->_rootref['NO_VIEWONLINE_A'] ?? null)) {  ?>

	<div style="text-align:center;">
		<form method="post" action="<?php echo $this->_rootref['S_LOGIN_ACTION'] ?? ''; ?>" class="headerspace">
		<div>
			<strong><?php echo ((isset($this->_rootref['L_NO_VIEW_USERS_A'])) ? $this->_rootref['L_NO_VIEW_USERS_A'] : ((isset($user->lang['NO_VIEW_USERS_A'])) ? $user->lang['NO_VIEW_USERS_A'] : '{ NO_VIEW_USERS_A }')); ?></strong>
			<br /><br />
			<input type="submit" class="button2" name="<?php echo ((isset($this->_rootref['L_LOGIN'])) ? $this->_rootref['L_LOGIN'] : ((isset($user->lang['LOGIN'])) ? $user->lang['LOGIN'] : '{ LOGIN }')); ?>" value="<?php echo ((isset($this->_rootref['L_LOGIN'])) ? $this->_rootref['L_LOGIN'] : ((isset($user->lang['LOGIN'])) ? $user->lang['LOGIN'] : '{ LOGIN }')); ?>"></input>
			<br /><br />
			<p><?php echo ((isset($this->_rootref['L_DONT_HAVE_ACCOUNT'])) ? $this->_rootref['L_DONT_HAVE_ACCOUNT'] : ((isset($user->lang['DONT_HAVE_ACCOUNT'])) ? $user->lang['DONT_HAVE_ACCOUNT'] : '{ DONT_HAVE_ACCOUNT }')); ?></p>
			<a href="ucp.php?cid=&amp;mode=register"><?php echo ((isset($this->_rootref['L_REGISTRATION'])) ? $this->_rootref['L_REGISTRATION'] : ((isset($user->lang['REGISTRATION'])) ? $user->lang['REGISTRATION'] : '{ REGISTRATION }')); ?></a>
		</div>
		</form>
		<br />
	</div>
<?php } ?>

</div>
<?php if (($this->_rootref['DEBUG_QUERIES'] ?? null)) {  ?><div class="block_data"><?php echo $this->_rootref['LAST_ONLINE_DEBUG'] ?? ''; ?></div><?php } ?><!-- IDTAG ends block_last_online.html -->