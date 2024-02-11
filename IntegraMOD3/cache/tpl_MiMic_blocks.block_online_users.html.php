<?php if (!defined('IN_PHPBB')) exit; ?><!-- IDTAG start block_online_users.html 17 March 2008 copyright phpbbireland.com 2007 -->
<div class="block_data">
	<?php if (($this->_rootref['IN_FORUMS'] ?? null)) {  ?><p><?php echo $this->_rootref['TOTAL_USERS_ONLINE_SITEWIDE'] ?? ''; ?></p><?php } else { ?><p><?php echo $this->_rootref['TOTAL_USERS_ONLINE'] ?? ''; ?></p><?php } ?>

	<p><?php echo $this->_rootref['RECORD_USERS'] ?? ''; ?><br /></p>
	<p><?php echo $this->_rootref['LOGGED_IN_USER_LIST'] ?? ''; ?> <?php echo ((isset($this->_rootref['L_ONLINE_EXPLAIN'])) ? $this->_rootref['L_ONLINE_EXPLAIN'] : ((isset($user->lang['ONLINE_EXPLAIN'])) ? $user->lang['ONLINE_EXPLAIN'] : '{ ONLINE_EXPLAIN }')); ?><br /></p>
	<div style="text-align:center;"><a href="<?php echo $this->_rootref['U_VIEWONLINE'] ?? ''; ?>"><?php echo ((isset($this->_rootref['L_ONLINE_USERS_SHOW'])) ? $this->_rootref['L_ONLINE_USERS_SHOW'] : ((isset($user->lang['ONLINE_USERS_SHOW'])) ? $user->lang['ONLINE_USERS_SHOW'] : '{ ONLINE_USERS_SHOW }')); ?></a></div>
</div>
<?php if (($this->_rootref['DEBUG_QUERIES'] ?? null)) {  ?><div class="block_data"><?php echo $this->_rootref['ONLINE_USERS_DEBUG'] ?? ''; ?></div><?php } ?><!-- IDTAG ends block_online_users -->