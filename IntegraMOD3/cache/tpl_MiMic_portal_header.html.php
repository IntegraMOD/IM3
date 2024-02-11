<?php if (!defined('IN_PHPBB')) exit; if (($this->_rootref['STARGATE'] ?? null)) {  ?>

	<div class="blocks_hide_show_gap">
		<?php if (($this->_rootref['S_SHOW_LEFT_BLOCKS'] ?? null)) {  ?>

			<span style="display:none;" id="left_blocks_col_hide">
				<a href="javascript:ShowHide('left','left_blocks_col_hide','left_blocks_col_hide');ShowHide('left_blocks_col_show');" title="Show Blocks"><img src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>images/slide1.png" width="12" height="12" alt="" class="left_blocks_col_show" /></a>
			</span>
			<span style="display:inline;" id="left_blocks_col_show">
				<a href="javascript:ShowHide('left','left_blocks_col_show','left_blocks_col_hide');ShowHide('left_blocks_col_hide');" title="Hide Blocks"><img src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>images/slide2.png" width="12" height="12"  alt="" class="left_blocks_col_show" /></a>
			</span>
		<?php } if (($this->_rootref['S_SHOW_RIGHT_BLOCKS'] ?? null)) {  ?>

			<span style="display:none; float:right;" id="right_blocks_col_hide">
				<a href="javascript:ShowHide('right','right_blocks_col_hide','right_blocks_col_hide');ShowHide('right_blocks_col_show');" title="Show Blocks"><img src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>images/slide2.png" width="12" height="12" alt="" class="right_blocks_col_show" /></a>
			</span>
			<span style="display:inline; float:right;" id="right_blocks_col_show">
				<a href="javascript:ShowHide('right','right_blocks_col_show','right_blocks_col_hide');ShowHide('right_blocks_col_hide');" title="Hide Blocks"><img src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>images/slide1.png" width="12" height="12" alt="" class="right_blocks_col_show" /></a>
			</span>
		<?php } ?>

	</div>
<?php } ?>


<div id="p_header_"><!-- PUT HEADER BLOCKS HERE --></div>
<div id="p_container_">
	<div id="p_row_">
		<?php if (($this->_rootref['S_SHOW_LEFT_BLOCKS'] ?? null)) {  ?>

		<div class="l_block_vert_gap rtl" style="width:<?php echo $this->_rootref['BLOCK_WIDTH'] ?? ''; ?>;" id="left">
			<script type="text/javascript">
				// <![CDATA[
				if(GetCookie('left_blocks_col_hide') == '2')
				{
					ShowHide('left');
					ShowHide('left_blocks_col_hide');
					ShowHide('left_blocks_col_show');
				}
				// ]]>
			</script>
			<?php $this->_tpl_include('portal_layout_left.html'); ?>

		</div>
		<?php } ?>

		<div id="center">