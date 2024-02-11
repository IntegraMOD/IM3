<?php if (!defined('IN_PHPBB')) exit; ?><table width="100%" class="extra" cellspacing="0" cellpadding="0" border="0">
	<tr>
<?php if (($this->_rootref['S_SHOW_MINICAL'] ?? null)) {  ?>

		<td id="minical" align="left" valign="top"  style="padding-right: 5px;">
			<div class="forabg" style="width:200px;">
				<div class="inner">
					<ul class="topiclist">
						<li class="header">
							<dl>
								<dt><a href="<?php echo $this->_rootref['U_CALENDAR'] ?? ''; ?>"><?php echo ((isset($this->_rootref['L_LANG_CALENDAR'])) ? $this->_rootref['L_LANG_CALENDAR'] : ((isset($user->lang['LANG_CALENDAR'])) ? $user->lang['LANG_CALENDAR'] : '{ LANG_CALENDAR }')); ?></a></dt>
							</dl>
						</li>
					</ul>
					<div style="padding: 5px 4px 2px 4px; font-size: 1.1em; background-color: #ECF1F3; margin: 0px auto; text-align: center;" class="panel">
					<?php $this->_tpl_include('blocks/block_calendar.html'); ?>

					</div>
				</div>
			</div>
		</td>
<?php } if (($this->_rootref['S_MCHAT_ENABLE'] ?? null) && ($this->_rootref['S_MCHAT_ON_INDEX'] ?? null) && ! ($this->_rootref['S_MCHAT_LOCATION'] ?? null)) {  ?>

		<td width="100%" valign="top"><?php $this->_tpl_include('mchat_body.html'); ?></td>
<?php } ?>

	</tr>
</table>