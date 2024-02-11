<?php if (!defined('IN_PHPBB')) exit; ?><!-- IDTAG starts block_menus.html 13 September 2007 copyright phpbbireland.com 2007 -->
<div class="block_data">
	<div id="menu_links" class="sdmenu">
		<div class="nav_menu">
			<?php $_portal_link_menus_row_count = (isset($this->_tpldata['portal_link_menus_row']) && is_array($this->_tpldata['portal_link_menus_row'])) ? count($this->_tpldata['portal_link_menus_row']) : 0;if ($_portal_link_menus_row_count) {for ($_portal_link_menus_row_i = 0; $_portal_link_menus_row_i < $_portal_link_menus_row_count; ++$_portal_link_menus_row_i){$_portal_link_menus_row_val = &$this->_tpldata['portal_link_menus_row'][$_portal_link_menus_row_i]; if ($_portal_link_menus_row_val['S_SUB_HEADING']) {  ?>

					<span class="sub_heading"><?php echo $_portal_link_menus_row_val['PORTAL_LINK_MENU_HEAD_NAME']; ?></span>
				<?php } else { ?>

					<span class="menu_item">
					<?php if ($_portal_link_menus_row_val['PORTAL_LINK_MENU_ICON']) {  echo $_portal_link_menus_row_val['PORTAL_LINK_MENU_ICON']; } ?>

						<a href="<?php echo $_portal_link_menus_row_val['U_PORTAL_LINK_MENU_LINK']; ?>" <?php echo $_portal_link_menus_row_val['LINK_OPTION']; ?> ><?php echo $_portal_link_menus_row_val['PORTAL_LINK_MENU_NAME']; ?></a>
					</span>
					<?php if ($_portal_link_menus_row_val['S_SOFT_HR'] == (1)) {  ?></div> <br /><img src="./images/soft_hr.gif" /><?php } } }} else { ?>

				<div style="text-align:center;"><?php echo ((isset($this->_rootref['L_NO_MENU'])) ? $this->_rootref['L_NO_MENU'] : ((isset($user->lang['NO_MENU'])) ? $user->lang['NO_MENU'] : '{ NO_MENU }')); ?></div>
			<?php } ?>

		</div>
	</div>
</div>
<?php if (($this->_rootref['DEBUG_QUERIES'] ?? null)) {  ?><div class="block_data"><?php echo $this->_rootref['SUB_MENUS_DEBUG'] ?? ''; ?></div><?php } ?><!-- IDTAG block_menus ends -->