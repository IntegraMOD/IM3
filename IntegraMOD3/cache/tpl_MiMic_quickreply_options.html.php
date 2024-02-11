<?php if (!defined('IN_PHPBB')) exit; ?><!-- quickreply_options.html (SGP) 16 September 2009 start -->
<div style="text-align:left; padding:5px; padding-left:3px; width:75%;">
	<div style="padding-bottom: 3px;"><strong><?php echo ((isset($this->_rootref['L_OPTIONS'])) ? $this->_rootref['L_OPTIONS'] : ((isset($user->lang['OPTIONS'])) ? $user->lang['OPTIONS'] : '{ OPTIONS }')); ?></strong></div>
	<span style="float:left; width:70%;">
		<?php if (($this->_rootref['S_BBCODE_ALLOWED'] ?? null)) {  ?>

		<label for="disable_bbcode"><input type="checkbox" name="disable_bbcode" id="disable_bbcode"<?php echo $this->_rootref['S_BBCODE_CHECKED'] ?? ''; ?> /> <?php echo ((isset($this->_rootref['L_DISABLE_BBCODE'])) ? $this->_rootref['L_DISABLE_BBCODE'] : ((isset($user->lang['DISABLE_BBCODE'])) ? $user->lang['DISABLE_BBCODE'] : '{ DISABLE_BBCODE }')); ?></label><br />
		<?php } if (($this->_rootref['S_SMILIES_ALLOWED'] ?? null)) {  ?>

		<label for="disable_smilies"><input type="checkbox" name="disable_smilies" id="disable_smilies"<?php echo $this->_rootref['S_SMILIES_CHECKED'] ?? ''; ?> /> <?php echo ((isset($this->_rootref['L_DISABLE_SMILIES'])) ? $this->_rootref['L_DISABLE_SMILIES'] : ((isset($user->lang['DISABLE_SMILIES'])) ? $user->lang['DISABLE_SMILIES'] : '{ DISABLE_SMILIES }')); ?></label><br />
		<?php } if (($this->_rootref['S_LINKS_ALLOWED'] ?? null)) {  ?>

		<label for="disable_magic_url"><input type="checkbox" name="disable_magic_url" id="disable_magic_url"<?php echo $this->_rootref['S_MAGIC_URL_CHECKED'] ?? ''; ?> /> <?php echo ((isset($this->_rootref['L_DISABLE_MAGIC_URL'])) ? $this->_rootref['L_DISABLE_MAGIC_URL'] : ((isset($user->lang['DISABLE_MAGIC_URL'])) ? $user->lang['DISABLE_MAGIC_URL'] : '{ DISABLE_MAGIC_URL }')); ?></label><br />
		<?php } if (($this->_rootref['S_SIG_ALLOWED'] ?? null)) {  ?>

		<label for="attach_sig"><input type="checkbox" name="attach_sig" id="attach_sig"<?php echo $this->_rootref['S_SIGNATURE_CHECKED'] ?? ''; ?> /> <?php echo ((isset($this->_rootref['L_ATTACH_SIG'])) ? $this->_rootref['L_ATTACH_SIG'] : ((isset($user->lang['ATTACH_SIG'])) ? $user->lang['ATTACH_SIG'] : '{ ATTACH_SIG }')); ?></label><br />
		<?php } if (($this->_rootref['S_NOTIFY_ALLOWED'] ?? null)) {  ?>

		<label for="notify"><input type="checkbox" name="notify" id="notify"<?php echo $this->_rootref['S_NOTIFY_CHECKED'] ?? ''; ?> /> <?php echo ((isset($this->_rootref['L_NOTIFY_REPLY'])) ? $this->_rootref['L_NOTIFY_REPLY'] : ((isset($user->lang['NOTIFY_REPLY'])) ? $user->lang['NOTIFY_REPLY'] : '{ NOTIFY_REPLY }')); ?></label><br />
		<?php } if (($this->_rootref['SUBSCRIBE'] ?? null)) {  ?>

		<label for="notify"><input type="checkbox" name="subscribe" class="radio"<?php echo $this->_rootref['S_SUBSCRIBE'] ?? ''; ?> /> <?php echo ((isset($this->_rootref['L_START_WATCHING_TOPIC'])) ? $this->_rootref['L_START_WATCHING_TOPIC'] : ((isset($user->lang['START_WATCHING_TOPIC'])) ? $user->lang['START_WATCHING_TOPIC'] : '{ START_WATCHING_TOPIC }')); ?></label><br />
		<?php } ?>

	</span>
</div>
<!-- quickreply_options.html (SGP) 16 September 2009 ends -->