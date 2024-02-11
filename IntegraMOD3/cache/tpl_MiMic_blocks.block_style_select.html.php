<?php if (!defined('IN_PHPBB')) exit; ?><span class="block_data">
	<div style="text-align:center; font-size:10px; padding:2px;">

		<?php if (($this->_rootref['S_USER_LOGGED_IN'] ?? null)) {  ?>

		<form method="post" id="style_select" action="<?php echo $this->_rootref['S_SELECT_ACTION'] ?? ''; ?>">
			<?php if (($this->_rootref['S_SHOW_PERM'] ?? null)) {  ?>

			<select id="style_select" onchange="document.location.href = this.options[this.selectedIndex].value + '&amp;y=' + y.checked;">
				<?php echo $this->_rootref['STYLE_SELECT'] ?? ''; ?>

			</select>
			<div style="padding-top: 4px; text-align:center;"><?php echo ((isset($this->_rootref['L_PERMANENT'])) ? $this->_rootref['L_PERMANENT'] : ((isset($user->lang['PERMANENT'])) ? $user->lang['PERMANENT'] : '{ PERMANENT }')); ?> <input type="checkbox" title="<?php echo ((isset($this->_rootref['L_MAKE_PERMANENT'])) ? $this->_rootref['L_MAKE_PERMANENT'] : ((isset($user->lang['MAKE_PERMANENT'])) ? $user->lang['MAKE_PERMANENT'] : '{ MAKE_PERMANENT }')); ?>" class="radio" id="y" name="y" value="" /></div>
			<?php } else { ?>

			<select id="style_select" onchange="document.location.href = this.options[this.selectedIndex].value;">
				<?php echo $this->_rootref['STYLE_SELECT'] ?? ''; ?>

			</select>
			<?php } ?>

		</form>
		<?php } ?>


	</div>
	<div style="padding:2px; text-align:center;"><?php echo ((isset($this->_rootref['L_TOTAL_STYLES'])) ? $this->_rootref['L_TOTAL_STYLES'] : ((isset($user->lang['TOTAL_STYLES'])) ? $user->lang['TOTAL_STYLES'] : '{ TOTAL_STYLES }')); ?>: <?php echo $this->_rootref['STYLE_COUNT'] ?? ''; ?></div>
</span>