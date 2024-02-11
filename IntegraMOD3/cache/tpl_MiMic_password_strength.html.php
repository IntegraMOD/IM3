<?php if (!defined('IN_PHPBB')) exit; ?><script type="text/javascript">
var ps_text1 = "<?php echo ((isset($this->_rootref['LA_PS_VERY_WEAK'])) ? $this->_rootref['LA_PS_VERY_WEAK'] : ((isset($this->_rootref['L_PS_VERY_WEAK'])) ? addslashes($this->_rootref['L_PS_VERY_WEAK']) : ((isset($user->lang['PS_VERY_WEAK'])) ? addslashes($user->lang['PS_VERY_WEAK']) : '{ PS_VERY_WEAK }'))); ?>",
	ps_text2 = "<?php echo ((isset($this->_rootref['LA_PS_WEAK'])) ? $this->_rootref['LA_PS_WEAK'] : ((isset($this->_rootref['L_PS_WEAK'])) ? addslashes($this->_rootref['L_PS_WEAK']) : ((isset($user->lang['PS_WEAK'])) ? addslashes($user->lang['PS_WEAK']) : '{ PS_WEAK }'))); ?>",
	ps_text3 = "<?php echo ((isset($this->_rootref['LA_PS_GOOD'])) ? $this->_rootref['LA_PS_GOOD'] : ((isset($this->_rootref['L_PS_GOOD'])) ? addslashes($this->_rootref['L_PS_GOOD']) : ((isset($user->lang['PS_GOOD'])) ? addslashes($user->lang['PS_GOOD']) : '{ PS_GOOD }'))); ?>",
	ps_text4 = "<?php echo ((isset($this->_rootref['LA_PS_STRONG'])) ? $this->_rootref['LA_PS_STRONG'] : ((isset($this->_rootref['L_PS_STRONG'])) ? addslashes($this->_rootref['L_PS_STRONG']) : ((isset($user->lang['PS_STRONG'])) ? addslashes($user->lang['PS_STRONG']) : '{ PS_STRONG }'))); ?>",
	ps_text5 = "<?php echo ((isset($this->_rootref['LA_PS_VERY_STRONG'])) ? $this->_rootref['LA_PS_VERY_STRONG'] : ((isset($this->_rootref['L_PS_VERY_STRONG'])) ? addslashes($this->_rootref['L_PS_VERY_STRONG']) : ((isset($user->lang['PS_VERY_STRONG'])) ? addslashes($user->lang['PS_VERY_STRONG']) : '{ PS_VERY_STRONG }'))); ?>",
	ps_color1 = "#f5a9a9", // 1 red, very weak
	ps_color2 = "#f5d0a9", // 2 orange, weak
	ps_color3 = "#f3f781", // 3 yellow, good
	ps_color4 = "#a9f5a9", // 4 light green, strong
	ps_color5 = "#00ff00"; // 5 green, very strong
window.jQuery || document.write(unescape('%3Cscript src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>password_strength/jquery.js" type="text/javascript"%3E%3C/script%3E'));
</script>
<script type="text/javascript" src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>password_strength/password_strength_min.js"></script>