<?php if (!defined('IN_PHPBB')) exit; ?><!-- IDTAG block_calendar starts -->
<span class="block_data_calc">
<form id="hidden">
    <input type="hidden" id="cal_h_month" name="cal_h_month" value="<?php echo $this->_rootref['HIDDEN_MONTH'] ?? ''; ?>" />
    <input type="hidden" id="cal_h_year" name="cal_h_year" value="<?php echo $this->_rootref['HIDDEN_YEAR'] ?? ''; ?>" />
</form>
<table width="100%" cellpadding="1" cellspacing="1" border="0">
	<tr>
		<td id="cal_month_prev" align="left" onclick="populateTable('block_calendar:populate_table', 'hidden', 'prev');" style="cursor:pointer;"><img src="<?php echo $this->_rootref['T_IMAGESET_PATH'] ?? ''; ?>/arrowleftmonth.png"></td>
		<td id="cal_month_name" align="center"></td>
		<td id="cal_month_next" align="right" onclick="populateTable('block_calendar:populate_table', 'hidden', 'next');" style="cursor:pointer;"><img src="<?php echo $this->_rootref['T_IMAGESET_PATH'] ?? ''; ?>/arrowrightmonth.png"></td>
	</tr>
	<tr>
		<td align="center" colspan="3">
			<table class="calendar" width="100%" cellpadding="0" cellspacing="0" border="0"><?php echo $this->_rootref['CALENDAR_TABLE'] ?? ''; ?></table>
		</td>
    </tr>
</table>
<?php if (($this->_rootref['S_SHOW_UPCOMING_EVENTS'] ?? null) || ($this->_rootref['S_SHOW_UPCOMING_BIRTHDAYS'] ?? null)) {  ?>

<br />
<table width="100%" cellpadding="1" cellspacing="1" border="0">
<tr><td>
    <div class="panel bg2" id="bday-panel">
        <div class="inner"><span class="corners-top"><span></span></span>
            <?php if (($this->_rootref['S_SHOW_UPCOMING_EVENTS'] ?? null)) {  ?>

                <strong><?php echo ((isset($this->_rootref['L_UPCOMING_EVENTS'])) ? $this->_rootref['L_UPCOMING_EVENTS'] : ((isset($user->lang['UPCOMING_EVENTS'])) ? $user->lang['UPCOMING_EVENTS'] : '{ UPCOMING_EVENTS }')); echo ((isset($this->_rootref['L_EVENTS_TIMEFRAME'])) ? $this->_rootref['L_EVENTS_TIMEFRAME'] : ((isset($user->lang['EVENTS_TIMEFRAME'])) ? $user->lang['EVENTS_TIMEFRAME'] : '{ EVENTS_TIMEFRAME }')); ?>:</strong><hr />
                <div>
                    <?php if (($this->_rootref['S_IS_EVENTS'] ?? null)) {  $_event_list_count = (isset($this->_tpldata['event_list']) && is_array($this->_tpldata['event_list'])) ? count($this->_tpldata['event_list']) : 0;if ($_event_list_count) {for ($_event_list_i = 0; $_event_list_i < $_event_list_count; ++$_event_list_i){$_event_list_val = &$this->_tpldata['event_list'][$_event_list_i]; echo $_event_list_val['TITLE']; ?> (<?php echo ((isset($this->_rootref['L_ON'])) ? $this->_rootref['L_ON'] : ((isset($user->lang['ON'])) ? $user->lang['ON'] : '{ ON }')); ?> <?php echo $_event_list_val['DATE']; ?> <?php echo ((isset($this->_rootref['L_AT'])) ? $this->_rootref['L_AT'] : ((isset($user->lang['AT'])) ? $user->lang['AT'] : '{ AT }')); ?> <?php echo $_event_list_val['TIME']; ?>)<?php if (! $_event_list_val['S_LAST_ROW']) {  ?><hr /><?php } }} } else { ?>

                        <?php echo ((isset($this->_rootref['L_NO_UPCOMING_EVENTS'])) ? $this->_rootref['L_NO_UPCOMING_EVENTS'] : ((isset($user->lang['NO_UPCOMING_EVENTS'])) ? $user->lang['NO_UPCOMING_EVENTS'] : '{ NO_UPCOMING_EVENTS }')); ?>

                    <?php } ?>

                </div>
                <br />
            <?php } if (($this->_rootref['S_SHOW_UPCOMING_BIRTHDAYS'] ?? null)) {  ?>

                <strong><?php echo ((isset($this->_rootref['L_UPCOMING_BIRTHDAYS'])) ? $this->_rootref['L_UPCOMING_BIRTHDAYS'] : ((isset($user->lang['UPCOMING_BIRTHDAYS'])) ? $user->lang['UPCOMING_BIRTHDAYS'] : '{ UPCOMING_BIRTHDAYS }')); echo ((isset($this->_rootref['L_BIRTHDAYS_TIMEFRAME'])) ? $this->_rootref['L_BIRTHDAYS_TIMEFRAME'] : ((isset($user->lang['BIRTHDAYS_TIMEFRAME'])) ? $user->lang['BIRTHDAYS_TIMEFRAME'] : '{ BIRTHDAYS_TIMEFRAME }')); ?>:</strong><hr />
                <div>
                    <?php if (($this->_rootref['S_IS_BIRTHDAYS'] ?? null)) {  ?>

                        <?php echo ((isset($this->_rootref['L_CONGRATULATIONS'])) ? $this->_rootref['L_CONGRATULATIONS'] : ((isset($user->lang['CONGRATULATIONS'])) ? $user->lang['CONGRATULATIONS'] : '{ CONGRATULATIONS }')); ?>: <?php $_bday_list_count = (isset($this->_tpldata['bday_list']) && is_array($this->_tpldata['bday_list'])) ? count($this->_tpldata['bday_list']) : 0;if ($_bday_list_count) {for ($_bday_list_i = 0; $_bday_list_i < $_bday_list_count; ++$_bday_list_i){$_bday_list_val = &$this->_tpldata['bday_list'][$_bday_list_i]; echo $_bday_list_val['USERNAME_FULL']; ?> (<?php echo $_bday_list_val['AGE']; ?> <?php echo ((isset($this->_rootref['L_ON'])) ? $this->_rootref['L_ON'] : ((isset($user->lang['ON'])) ? $user->lang['ON'] : '{ ON }')); ?> <?php echo $_bday_list_val['ON_DAY']; ?>)<?php if (! $_bday_list_val['S_LAST_ROW']) {  ?><hr /><?php } }} } else { ?>

                        <?php echo ((isset($this->_rootref['L_NO_UPCOMING_BIRTHDAYS'])) ? $this->_rootref['L_NO_UPCOMING_BIRTHDAYS'] : ((isset($user->lang['NO_UPCOMING_BIRTHDAYS'])) ? $user->lang['NO_UPCOMING_BIRTHDAYS'] : '{ NO_UPCOMING_BIRTHDAYS }')); ?>

                    <?php } ?>

                </div>
            <?php } ?>

        <span class="corners-bottom"><span></span></span>
		</div>
	</div>
</tr></td>
</table>
<?php } if (($this->_rootref['S_NEW_EVENT'] ?? null)) {  ?>

		<div style="width:100%;">
			<a class="button_event_new_icon" href="calendar.php?mode=main#tabs;" title="<?php echo ((isset($this->_rootref['L_CALENDAR'])) ? $this->_rootref['L_CALENDAR'] : ((isset($user->lang['CALENDAR'])) ? $user->lang['CALENDAR'] : '{ CALENDAR }')); ?>"><span><?php echo ((isset($this->_rootref['L_CALENDAR'])) ? $this->_rootref['L_CALENDAR'] : ((isset($user->lang['CALENDAR'])) ? $user->lang['CALENDAR'] : '{ CALENDAR }')); ?></span></a>
		</div>
	<?php } ?>

</span>

<script type="text/javascript">
populateTable('block_calendar:populate_table', 'hidden', '');
</script>
<!-- IDTAG block_calendar ends -->