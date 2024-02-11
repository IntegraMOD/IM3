<?php if (!defined('IN_PHPBB')) exit; ?><!-- quickreply_buttons.html (SGP) 16 September 2009 start -->
<div id="format-buttons_bbc" style="float:left; width:75%">
	<input type="button" class="bbb-bold" accesskey="b" name="addbbcode0" style="" onclick="bbstyle(0)" title="<?php echo ((isset($this->_rootref['L_BBCODE_B_HELP'])) ? $this->_rootref['L_BBCODE_B_HELP'] : ((isset($user->lang['BBCODE_B_HELP'])) ? $user->lang['BBCODE_B_HELP'] : '{ BBCODE_B_HELP }')); ?>" />
	<input type="button" class="bbb-italic" accesskey="i" name="addbbcode2" style="" onclick="bbstyle(2)" title="<?php echo ((isset($this->_rootref['L_BBCODE_I_HELP'])) ? $this->_rootref['L_BBCODE_I_HELP'] : ((isset($user->lang['BBCODE_I_HELP'])) ? $user->lang['BBCODE_I_HELP'] : '{ BBCODE_I_HELP }')); ?>" />
	<input type="button" class="bbb-under_line" accesskey="u" name="addbbcode4" style="" onclick="bbstyle(4)" title="<?php echo ((isset($this->_rootref['L_BBCODE_U_HELP'])) ? $this->_rootref['L_BBCODE_U_HELP'] : ((isset($user->lang['BBCODE_U_HELP'])) ? $user->lang['BBCODE_U_HELP'] : '{ BBCODE_U_HELP }')); ?>" />
	<?php if (($this->_rootref['S_BBCODE_QUOTE'] ?? null)) {  ?>

		<input type="button" class="bbb-quote" accesskey="q" name="addbbcode6" style="" onclick="bbstyle(6)" title="<?php echo ((isset($this->_rootref['L_BBCODE_Q_HELP'])) ? $this->_rootref['L_BBCODE_Q_HELP'] : ((isset($user->lang['BBCODE_Q_HELP'])) ? $user->lang['BBCODE_Q_HELP'] : '{ BBCODE_Q_HELP }')); ?>" />
	<?php } ?>

	<input type="button" class="bbb-code" accesskey="c" name="addbbcode8" style="" onclick="bbstyle(8)" title="<?php echo ((isset($this->_rootref['L_BBCODE_C_HELP'])) ? $this->_rootref['L_BBCODE_C_HELP'] : ((isset($user->lang['BBCODE_C_HELP'])) ? $user->lang['BBCODE_C_HELP'] : '{ BBCODE_C_HELP }')); ?>" />
	<input type="button" class="bbb-list" accesskey="l" name="addbbcode10" style="" onclick="bbstyle(10)" title="<?php echo ((isset($this->_rootref['L_BBCODE_L_HELP'])) ? $this->_rootref['L_BBCODE_L_HELP'] : ((isset($user->lang['BBCODE_L_HELP'])) ? $user->lang['BBCODE_L_HELP'] : '{ BBCODE_L_HELP }')); ?>" />
	<input type="button" class="bbb-ordered_list" accesskey="o" name="addbbcode12" style="" onclick="bbstyle(12)" title="<?php echo ((isset($this->_rootref['L_BBCODE_O_HELP'])) ? $this->_rootref['L_BBCODE_O_HELP'] : ((isset($user->lang['BBCODE_O_HELP'])) ? $user->lang['BBCODE_O_HELP'] : '{ BBCODE_O_HELP }')); ?>" />
	<input type="button" class="bbb-add_list_item" accesskey="t" name="addlitsitem" style="" onclick="bbstyle(-1)" title="<?php echo ((isset($this->_rootref['L_BBCODE_LISTITEM_HELP'])) ? $this->_rootref['L_BBCODE_LISTITEM_HELP'] : ((isset($user->lang['BBCODE_LISTITEM_HELP'])) ? $user->lang['BBCODE_LISTITEM_HELP'] : '{ BBCODE_LISTITEM_HELP }')); ?>" />
	<?php if (($this->_rootref['S_BBCODE_IMG'] ?? null)) {  ?>

		<input type="button" class="bbb-image" accesskey="p" name="addbbcode14" style="" onclick="bbstyle(14)" title="<?php echo ((isset($this->_rootref['L_BBCODE_P_HELP'])) ? $this->_rootref['L_BBCODE_P_HELP'] : ((isset($user->lang['BBCODE_P_HELP'])) ? $user->lang['BBCODE_P_HELP'] : '{ BBCODE_P_HELP }')); ?>" />
	<?php } if (($this->_rootref['S_LINKS_ALLOWED'] ?? null)) {  ?>

		<input type="button" class="bbb-url" accesskey="w" name="addbbcode16" style="" onclick="bbstyle(16)" title="<?php echo ((isset($this->_rootref['L_BBCODE_W_HELP'])) ? $this->_rootref['L_BBCODE_W_HELP'] : ((isset($user->lang['BBCODE_W_HELP'])) ? $user->lang['BBCODE_W_HELP'] : '{ BBCODE_W_HELP }')); ?>" />
	<?php } if (($this->_rootref['S_BBCODE_FLASH'] ?? null)) {  ?>

		<input type="button" class="bbb-flash" accesskey="f" name="addbbcode18" onclick="bbstyle(18)" title="<?php echo ((isset($this->_rootref['L_BBCODE_D_HELP'])) ? $this->_rootref['L_BBCODE_D_HELP'] : ((isset($user->lang['BBCODE_D_HELP'])) ? $user->lang['BBCODE_D_HELP'] : '{ BBCODE_D_HELP }')); ?>" />
	<?php } ?>

	<select style="height:20px;" name="addbbcode20" onchange="bbfontstyle('[size=' + this.form.addbbcode20.options[this.form.addbbcode20.selectedIndex].value + ']', '[/size]');this.form.addbbcode20.selectedIndex = 2;" title="<?php echo ((isset($this->_rootref['L_FONT_SIZE'])) ? $this->_rootref['L_FONT_SIZE'] : ((isset($user->lang['FONT_SIZE'])) ? $user->lang['FONT_SIZE'] : '{ FONT_SIZE }')); ?>">
	<option class="style_bg_color" value="100" selected="selected"><?php echo ((isset($this->_rootref['L_FONT_SIZE'])) ? $this->_rootref['L_FONT_SIZE'] : ((isset($user->lang['FONT_SIZE'])) ? $user->lang['FONT_SIZE'] : '{ FONT_SIZE }')); ?></option>
	<option class="style_bg_color" style="font-size:8px;"  value="60"> <?php echo ((isset($this->_rootref['L_FONT_TINY'])) ? $this->_rootref['L_FONT_TINY'] : ((isset($user->lang['FONT_TINY'])) ? $user->lang['FONT_TINY'] : '{ FONT_TINY }')); ?></option>
	<option class="style_bg_color" style="font-size:10px;" value="85"> <?php echo ((isset($this->_rootref['L_FONT_SMALL'])) ? $this->_rootref['L_FONT_SMALL'] : ((isset($user->lang['FONT_SMALL'])) ? $user->lang['FONT_SMALL'] : '{ FONT_SMALL }')); ?></option>
	<option class="style_bg_color" style="font-size:12px;" value="100"><?php echo ((isset($this->_rootref['L_FONT_NORMAL'])) ? $this->_rootref['L_FONT_NORMAL'] : ((isset($user->lang['FONT_NORMAL'])) ? $user->lang['FONT_NORMAL'] : '{ FONT_NORMAL }')); ?></option>
	<option class="style_bg_color" style="font-size:18px;" value="130"><?php echo ((isset($this->_rootref['L_FONT_LARGE'])) ? $this->_rootref['L_FONT_LARGE'] : ((isset($user->lang['FONT_LARGE'])) ? $user->lang['FONT_LARGE'] : '{ FONT_LARGE }')); ?></option>
	<option class="style_bg_color" style="font-size:24px;" value="170"><?php echo ((isset($this->_rootref['L_FONT_HUGE'])) ? $this->_rootref['L_FONT_HUGE'] : ((isset($user->lang['FONT_HUGE'])) ? $user->lang['FONT_HUGE'] : '{ FONT_HUGE }')); ?></option>
	</select>
	<?php $_custom_tags_count = (isset($this->_tpldata['custom_tags']) && is_array($this->_tpldata['custom_tags'])) ? count($this->_tpldata['custom_tags']) : 0;if ($_custom_tags_count) {for ($_custom_tags_i = 0; $_custom_tags_i < $_custom_tags_count; ++$_custom_tags_i){$_custom_tags_val = &$this->_tpldata['custom_tags'][$_custom_tags_i]; ?>

		<input type="button" class="bbb-<?php echo $_custom_tags_val['BBCODE_TAG']; ?>" name="addbbcode<?php echo $_custom_tags_val['BBCODE_ID']; ?>" onclick="bbstyle(<?php echo $_custom_tags_val['BBCODE_ID']; ?>)" title="<?php echo $_custom_tags_val['BBCODE_HELPLINE']; ?>" />
	<?php }} ?>

</div>
<!-- quickreply_buttons.html (SGP) 16 September 2009 end -->