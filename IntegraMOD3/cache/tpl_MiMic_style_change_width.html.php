<?php if (!defined('IN_PHPBB')) exit; ?><span style="display:none;" id="alt">
	<a href="javascript:StyleSwitchCookie('mystyle', 'default', '<?php echo $this->_rootref['T_THEME_PATH'] ?? ''; ?>', 'alt', 'default');">
		<img style="margin-left:2px; margin-top:1px;" src="<?php echo $this->_rootref['T_THEME_PATH'] ?? ''; ?>/images/portal/wide.png" width="15" height="15" alt="<?php echo ((isset($this->_rootref['L_DEFAULT_WIDTH'])) ? $this->_rootref['L_DEFAULT_WIDTH'] : ((isset($user->lang['DEFAULT_WIDTH'])) ? $user->lang['DEFAULT_WIDTH'] : '{ DEFAULT_WIDTH }')); ?>" title="<?php echo ((isset($this->_rootref['L_DEFAULT_WIDTH'])) ? $this->_rootref['L_DEFAULT_WIDTH'] : ((isset($user->lang['DEFAULT_WIDTH'])) ? $user->lang['DEFAULT_WIDTH'] : '{ DEFAULT_WIDTH }')); ?>" />
	</a>
</span>
<span style="display:none;" id="default">
	<a href="javascript:StyleSwitchCookie('mystyle', 'alt', '<?php echo $this->_rootref['T_THEME_PATH'] ?? ''; ?>', 'default', 'alt');">
		<img style="margin-left:2px; margin-top:1px;" src="<?php echo $this->_rootref['T_THEME_PATH'] ?? ''; ?>/images/portal/narrow.png" width="15" height="15" alt="<?php echo ((isset($this->_rootref['L_ALT_WIDTH'])) ? $this->_rootref['L_ALT_WIDTH'] : ((isset($user->lang['ALT_WIDTH'])) ? $user->lang['ALT_WIDTH'] : '{ ALT_WIDTH }')); ?>" title="<?php echo ((isset($this->_rootref['L_ALT_WIDTH'])) ? $this->_rootref['L_ALT_WIDTH'] : ((isset($user->lang['ALT_WIDTH'])) ? $user->lang['ALT_WIDTH'] : '{ ALT_WIDTH }')); ?>" />
	</a>
</span>

<script type="text/javascript">
// <![CDATA[
	var value = Get_Cookie('mystyle');

	if(value == null || value == 'undefined')
	{
		Show('default');
		Load_css_file('<?php echo $this->_rootref['T_THEME_PATH'] ?? ''; ?>','default');
	}
	else
	{
		Show(value);
		Load_css_file('<?php echo $this->_rootref['T_THEME_PATH'] ?? ''; ?>', value);
	}

// ]]>
</script>