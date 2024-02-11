<?php if (!defined('IN_PHPBB')) exit; ?><script type="text/javascript">
// <![CDATA[
	function hide_qr(show)
	{
		dE('qr_editor_div');
		dE('qr_showeditor_div');
		if (show && document.getElementById('qr_editor_div').style.display != 'none')
		{
			document.getElementsByName('message')[0].focus();
		}
		return true;
	}


	function init_qr()
	{
		dE('qr_showeditor_div');
		return true;
	}
	onload_functions.push('init_qr();');
	// ]]>
</script>
<noscript>
	<form method="post" action="<?php echo $this->_rootref['U_QR_ACTION'] ?? ''; ?>">
		<div class="panel" id="qr_ns_editor_div">
			<div class="inner">
					<h2><?php echo ((isset($this->_rootref['L_QUICKREPLY'])) ? $this->_rootref['L_QUICKREPLY'] : ((isset($user->lang['QUICKREPLY'])) ? $user->lang['QUICKREPLY'] : '{ QUICKREPLY }')); ?></h2>
					<fieldset class="fields1">
						<dl style="clear: left;">
							<dt><label for="subject"><?php echo ((isset($this->_rootref['L_SUBJECT'])) ? $this->_rootref['L_SUBJECT'] : ((isset($user->lang['SUBJECT'])) ? $user->lang['SUBJECT'] : '{ SUBJECT }')); ?>:</label></dt>
							<dd><input type="text" name="subject" id="subject-ns" size="45" maxlength="64" tabindex="2" value="<?php echo $this->_rootref['SUBJECT'] ?? ''; ?>" class="inputbox autowidth" /></dd>
						</dl>
					<div id="message-box-ns">
						<textarea style="height: 9em;" name="message" rows="7" cols="76" tabindex="3" class="inputbox"></textarea>
					</div>
					</fieldset>
					<fieldset class="submit-buttons">
						<?php echo $this->_rootref['S_FORM_TOKEN'] ?? ''; ?>

						<?php echo $this->_rootref['QR_HIDDEN_FIELDS'] ?? ''; ?>

						<input type="submit" accesskey="s" tabindex="6" name="post" value="<?php echo ((isset($this->_rootref['L_SUBMIT'])) ? $this->_rootref['L_SUBMIT'] : ((isset($user->lang['SUBMIT'])) ? $user->lang['SUBMIT'] : '{ SUBMIT }')); ?>" class="button1" />&nbsp;
						<input type="submit" accesskey="f" tabindex="7" name="full_editor" value="<?php echo ((isset($this->_rootref['L_FULL_EDITOR'])) ? $this->_rootref['L_FULL_EDITOR'] : ((isset($user->lang['FULL_EDITOR'])) ? $user->lang['FULL_EDITOR'] : '{ FULL_EDITOR }')); ?>" class="button2" />&nbsp;
					</fieldset>
			</div>
		</div>
	</form>
</noscript>
<div class="fastreply" style="margin-top:8px;">
<form method="post" action="<?php echo $this->_rootref['U_QR_ACTION'] ?? ''; ?>">
	<div class="panel">
		<div class="inner">
				<h2><?php echo ((isset($this->_rootref['L_QUICKREPLY'])) ? $this->_rootref['L_QUICKREPLY'] : ((isset($user->lang['QUICKREPLY'])) ? $user->lang['QUICKREPLY'] : '{ QUICKREPLY }')); ?></h2>
				<fieldset class="fields1">
					<dl style="clear: left;">
						<dt><label for="subject"><?php echo ((isset($this->_rootref['L_SUBJECT'])) ? $this->_rootref['L_SUBJECT'] : ((isset($user->lang['SUBJECT'])) ? $user->lang['SUBJECT'] : '{ SUBJECT }')); ?>:</label></dt>
						<dd><input type="text" name="subject" id="subject" size="45" maxlength="64" tabindex="2" value="<?php echo $this->_rootref['SUBJECT'] ?? ''; ?>" class="inputbox autowidth" /></dd>
					</dl>
				<div id="message-box">
					<textarea style="height: 9em;" name="message" rows="7" cols="76" tabindex="3" class="inputbox"></textarea>
				</div>
				</fieldset>
				<fieldset class="submit-buttons">
					<?php echo $this->_rootref['S_FORM_TOKEN'] ?? ''; ?>

					<?php echo $this->_rootref['QR_HIDDEN_FIELDS'] ?? ''; ?>

					<input type="submit" accesskey="s" tabindex="6" name="post" value="<?php echo ((isset($this->_rootref['L_SUBMIT'])) ? $this->_rootref['L_SUBMIT'] : ((isset($user->lang['SUBMIT'])) ? $user->lang['SUBMIT'] : '{ SUBMIT }')); ?>" class="button1" />&nbsp;
					<input type="submit" accesskey="f" tabindex="7" name="full_editor" value="<?php echo ((isset($this->_rootref['L_FULL_EDITOR'])) ? $this->_rootref['L_FULL_EDITOR'] : ((isset($user->lang['FULL_EDITOR'])) ? $user->lang['FULL_EDITOR'] : '{ FULL_EDITOR }')); ?>" class="button2" />&nbsp;
						<input type="submit" accesskey="p" tabindex="8" name="preview" value="<?php echo ((isset($this->_rootref['L_PREVIEW'])) ? $this->_rootref['L_PREVIEW'] : ((isset($user->lang['PREVIEW'])) ? $user->lang['PREVIEW'] : '{ PREVIEW }')); ?>" class="button2" />&nbsp;
						<a href="javascript:void(0);" tabindex="9" class="button2 fast-reply" style="line-height: 10px; padding:4px 6px; text-decoration: none;"><?php echo ((isset($this->_rootref['L_COLLAPSE_QR'])) ? $this->_rootref['L_COLLAPSE_QR'] : ((isset($user->lang['COLLAPSE_QR'])) ? $user->lang['COLLAPSE_QR'] : '{ COLLAPSE_QR }')); ?></a>&nbsp;
				</fieldset>
				<a href="" class="right-box up" onclick="hide_qr(false); return false;" title="<?php echo ((isset($this->_rootref['L_COLLAPSE_QR'])) ? $this->_rootref['L_COLLAPSE_QR'] : ((isset($user->lang['COLLAPSE_QR'])) ? $user->lang['COLLAPSE_QR'] : '{ COLLAPSE_QR }')); ?>"><?php echo ((isset($this->_rootref['L_COLLAPSE_QR'])) ? $this->_rootref['L_COLLAPSE_QR'] : ((isset($user->lang['COLLAPSE_QR'])) ? $user->lang['COLLAPSE_QR'] : '{ COLLAPSE_QR }')); ?></a>
		</div>
	</div>
</form>
</div>