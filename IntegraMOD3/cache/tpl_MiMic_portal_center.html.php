<?php if (!defined('IN_PHPBB')) exit; if (($this->_rootref['PORTAL_MESSAGE'] ?? null)) {  ?>

	<div class="panel">
		<div class="inner">
			<span class="corners-top"><span></span></span>
				<div class="block_header"><div class="portal_message"><?php echo $this->_rootref['PORTAL_MESSAGE'] ?? ''; ?></div></div>
			<span class="corners-bottom"><span></span></span>
		</div>
	</div>
<?php } ?><!-- IDTAG START portal_layout_center 08 May 2011 --><?php $_center_block_files_count = (isset($this->_tpldata['center_block_files']) && is_array($this->_tpldata['center_block_files'])) ? count($this->_tpldata['center_block_files']) : 0;if ($_center_block_files_count) {for ($_center_block_files_i = 0; $_center_block_files_i < $_center_block_files_count; ++$_center_block_files_i){$_center_block_files_val = &$this->_tpldata['center_block_files'][$_center_block_files_i]; ?>

	<div id="<?php if (($this->_rootref['S_ARRANGE'] ?? null)) {  ?>BLOCK_<?php } echo $_center_block_files_val['CENTER_BLOCK_ID']; ?>">
		<div class="forabg" style="margin-bottom:8px;">
			<div class="inner">

				<div class="block_header <?php if (($this->_rootref['S_ARRANGE'] ?? null)) {  ?>handle<?php } ?>">
					<div class="block_title" style="text-align:<?php echo $this->_rootref['S_CONTENT_FLOW_BEGIN'] ?? ''; ?>;"><?php echo $_center_block_files_val['CENTER_BLOCK_TITLE']; ?>&nbsp;
						<div style="text-align:<?php echo $this->_rootref['S_CONTENT_FLOW_BEGIN'] ?? ''; ?>;" id="p_<?php echo $_center_block_files_val['CENTER_BLOCK_ID']; ?>">

							<?php if (($this->_rootref['S_ARRANGE'] ?? null)) {  ?>

								<span class="bmove rtl"><?php echo $this->_rootref['MOVE_IMG'] ?? ''; ?></span>
								<a href="javascript:ShowHide('<?php echo $_center_block_files_val['CENTER_BLOCK_ID']; ?>','_<?php echo $_center_block_files_val['CENTER_BLOCK_ID']; ?>','BLOCK_<?php echo $_center_block_files_val['CENTER_BLOCK_ID']; ?>');">
									<span class="bchide rtl"><?php echo $this->_rootref['HIDE_IMG'] ?? ''; ?></span>
								</a>
							<?php } else { ?>

								<span class="bcimage rtl"><img src="<?php echo $_center_block_files_val['CENTER_BLOCK_IMG']; ?>" alt = "" /></span>
							<?php } ?>

						</div>
					</div>
				</div>

				<div class="box catpanel" id="<?php if (! ($this->_rootref['S_ARRANGE'] ?? null)) {  ?>BLOCK_<?php } echo $_center_block_files_val['CENTER_BLOCK_ID']; ?>">
					<?php if ($_center_block_files_val['CENTER_BLOCK_SCROLL'] && ! ($this->_rootref['DISABLE_RT_SCROLL'] ?? null)) {  if (! ($this->_rootref['S_ARRANGE'] ?? null)) {  ?>

							<div class="scroll_outer" height="<?php echo $_center_block_files_val['CENTER_BLOCK_HEIGHT']; ?>" id="<?php echo $_center_block_files_val['CENTER_BLOCK_ID']; ?>_outer" onmouseover="do_speed(this, event)" onmousemove="do_speed(this, event)" onmouseout="set_defaults(this, event)"><div class="scroll_inner" id="<?php echo $_center_block_files_val['CENTER_BLOCK_ID']; ?>_inner"><?php echo $_center_block_files_val['CENTER_BLOCKS']; ?></div></div>
						<?php } else { ?>

							<?php echo ((isset($this->_rootref['L_SCROLLING_BLOCKS_DISABLED'])) ? $this->_rootref['L_SCROLLING_BLOCKS_DISABLED'] : ((isset($user->lang['SCROLLING_BLOCKS_DISABLED'])) ? $user->lang['SCROLLING_BLOCKS_DISABLED'] : '{ SCROLLING_BLOCKS_DISABLED }')); ?>

						<?php } } else { ?>

						<?php echo $_center_block_files_val['CENTER_BLOCKS']; ?>

					<?php } ?>

				</div>
			</div>
		</div>
		<script>
		// <![CDATA[
			if(GetCookie('BLOCK_<?php echo $_center_block_files_val['CENTER_BLOCK_ID']; ?>') == '2')
			{
				ShowHide('<?php echo $_center_block_files_val['CENTER_BLOCK_ID']; ?>','_<?php echo $_center_block_files_val['CENTER_BLOCK_ID']; ?>','BLOCK_<?php echo $_center_block_files_val['CENTER_BLOCK_ID']; ?>');
			}
		// ]]>
		</script>
	</div>
<?php }} ?><!-- IDTAG END portal_layout_center -->