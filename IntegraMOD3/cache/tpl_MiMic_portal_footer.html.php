<?php if (!defined('IN_PHPBB')) exit; if (($this->_rootref['STARGATE'] ?? null)) {  ?>


	</div><!-- close center --><?php if (($this->_rootref['S_SHOW_RIGHT_BLOCKS'] ?? null)) {  ?>

		<div class="r_block_vert_gap rtl" style="width:<?php echo $this->_rootref['BLOCK_WIDTH'] ?? ''; ?>;" id="right">
			<script type="text/javascript">
				// <![CDATA[
				if(GetCookie('right_blocks_col_hide') == '2')
				{
					ShowHide('right');
					ShowHide('right_blocks_col_hide');
					ShowHide('right_blocks_col_show');
				}
				// ]]>
			</script>
			<?php $this->_tpl_include('portal_layout_right.html'); ?>

		</div>
		<?php } ?>


	</div><!-- close p_row_ -->
</div><!-- close p_container_ -->


	<!-- Comment:
	We do not process the block move/arrange unless user select this option...
	This prevents js reports and ensures the scroll work correctly... Added: 09 March 2008 Mike.
	-->
	<?php if (($this->_rootref['S_IS_PORTAL'] ?? null) && ($this->_rootref['S_ARRANGE'] ?? null)) {  ?>

	<script type="text/javascript">
	// <![CDATA[
		var _left;
		var _right;
		var _center;

		$_left = GetCookie('<?php echo $this->_rootref['COOKIE_NAME'] ?? ''; ?>_sgp_left');
		$_center = GetCookie('<?php echo $this->_rootref['COOKIE_NAME'] ?? ''; ?>_sgp_center');
		$_right = GetCookie('<?php echo $this->_rootref['COOKIE_NAME'] ?? ''; ?>_sgp_right');

		SetCookie('<?php echo $this->_rootref['COOKIE_NAME'] ?? ''; ?>_sgp_block_cache', '0');

		Sortable.create("left",
			{tag:'div',dropOnEmpty:true,handle:'handle',containment:["left","center","right"],constraint:false,
			onChange:
				function()
				{
					$_left = $('leftdebug').innerHTML = Sortable.serialize('left');
					$_center = $('centerdebug').innerHTML = Sortable.serialize('center');
					$_right = $('rightdebug').innerHTML = Sortable.serialize('right');
					SetCookie('<?php echo $this->_rootref['COOKIE_NAME'] ?? ''; ?>_sgp_left', $_left);
					SetCookie('<?php echo $this->_rootref['COOKIE_NAME'] ?? ''; ?>_sgp_center', $_center);
					SetCookie('<?php echo $this->_rootref['COOKIE_NAME'] ?? ''; ?>_sgp_right', $_right);
				}
			});
		Sortable.create("center",
			{tag:'div',dropOnEmpty:true,handle:'handle',containment:["left","center","right"],constraint:false,
			onChange:
				function()
				{
					$_left = $('leftdebug').innerHTML = Sortable.serialize('left');
					$_center = $('centerdebug').innerHTML = Sortable.serialize('center');
					$_right = $('rightdebug').innerHTML = Sortable.serialize('right');
					SetCookie('<?php echo $this->_rootref['COOKIE_NAME'] ?? ''; ?>_sgp_left', $_left);
					SetCookie('<?php echo $this->_rootref['COOKIE_NAME'] ?? ''; ?>_sgp_center', $_center);
					SetCookie('<?php echo $this->_rootref['COOKIE_NAME'] ?? ''; ?>_sgp_right', $_right);
				}
			});
		Sortable.create("right",
			{tag:'div',dropOnEmpty:true,handle:'handle',containment:["left","center","right"],constraint:false,
			onChange:
				function()
				{
					$_left = $('leftdebug').innerHTML = Sortable.serialize('left');
					$_center = $('centerdebug').innerHTML = Sortable.serialize('center');
					$_right = $('rightdebug').innerHTML = Sortable.serialize('right');
					SetCookie('<?php echo $this->_rootref['COOKIE_NAME'] ?? ''; ?>_sgp_left', $_left);
					SetCookie('<?php echo $this->_rootref['COOKIE_NAME'] ?? ''; ?>_sgp_center', $_center);
					SetCookie('<?php echo $this->_rootref['COOKIE_NAME'] ?? ''; ?>_sgp_right', $_right);
				}
			});
	// ]]>
	</script>
		<!-- DO NOT DELETE THIS CODE -->
		<div style="display:none;">
			<pre id="leftdebug"></pre>
			<pre id="centerdebug"></pre>
			<pre id="rightdebug"></pre>
		</div>
	<?php } if (($this->_rootref['S_IS_PORTAL'] ?? null) && ! ($this->_rootref['S_ARRANGE'] ?? null)) {  ?>

	<script type="text/javascript">
	// <![CDATA[
		SetCookie('<?php echo $this->_rootref['COOKIE_NAME'] ?? ''; ?>_sgp_block_cache', '300');
	 // ]]>
	</script>
	<?php } if (($this->_rootref['S_CLEAR_CACHE'] ?? null)) {  ?>

	<script type="text/javascript">
	// <![CDATA[
		SetCookie('<?php echo $this->_rootref['COOKIE_NAME'] ?? ''; ?>_sgp_block_cache', '0');
		SetCookie('<?php echo $this->_rootref['COOKIE_NAME'] ?? ''; ?>_sgp_left', '', 0);
		SetCookie('<?php echo $this->_rootref['COOKIE_NAME'] ?? ''; ?>_sgp_center', '', 0);
		SetCookie('<?php echo $this->_rootref['COOKIE_NAME'] ?? ''; ?>_sgp_right', '', 0);
	 // ]]>
	</script>
	<?php } } ?>