<?php if (!defined('IN_PHPBB')) exit; ?><!-- IDTAG starts block_search.html 17 March 2008 copyright phpbbireland.com 2007 --><?php if (($this->_rootref['S_SEARCH'] ?? null)) {  ?>


<script type="text/javascript">
// <![CDATA[
function url_search()
{
	switch(document.forms['search_block'].search_engine.value)
	{
		case 'advanced':
						window.open('<?php echo $this->_rootref['U_SEARCH'] ?? ''; ?>', '_self', '');
						return false;
		case 'google':
						window.open('http://www.google.com/search?q=' + document.forms['search_block'].keywords.value, '_google', '');
						return false;
		case 'yahoo':
						window.open('http://search.yahoo.com/search?p=' + document.forms['search_block'].keywords.value, '_yahoo', '');
						return false;
		case 'altavista':
						window.open('http://www.altavista.com/web/results?itag=ody&q=' + document.forms['search_block'].keywords.value + '&kgs=0&kls=0', '_altavista', '');
						return false;
		case 'lycos':
						window.open('http://search.lycos.com/?query=' + document.forms['search_block'].keywords.value, '_lycos', '');
						return false;

		case 'site':	break;
		default:		break;
	}
	return true;
}
// ]]>
</script>

<form method="get" id="search_block" action="<?php echo $this->_rootref['U_SEARCH'] ?? ''; ?>" onsubmit="return url_search()">
	<div class="block_data">
		<div style="text-align:center;">
			<input class="inputbox search" type="text" name="keywords" size="21" /><?php echo $this->_rootref['S_HIDDEN_FIELDS'] ?? ''; ?>

		</div>
		<div style="padding-top:5px; width:99%;"></div>
		<div style="text-align:center;">
			<select class="inputbox full" style="font-size:11px; padding:2px; cursor: pointer;" name="search_engine">
                <optgroup label="<?php echo $this->_rootref['SITE_NAME'] ?? ''; ?>">
					<option value="site" style="font-size:11px;" ><?php echo $this->_rootref['SITE_NAME'] ?? ''; ?></option>
					<option value="site"><?php echo ((isset($this->_rootref['L_POSTS'])) ? $this->_rootref['L_POSTS'] : ((isset($user->lang['POSTS'])) ? $user->lang['POSTS'] : '{ POSTS }')); ?></option>
					<option value="advanced"><?php echo ((isset($this->_rootref['L_ADVANCED_SEARCH'])) ? $this->_rootref['L_ADVANCED_SEARCH'] : ((isset($user->lang['ADVANCED_SEARCH'])) ? $user->lang['ADVANCED_SEARCH'] : '{ ADVANCED_SEARCH }')); ?></option>
			    </optgroup>
                <optgroup style="font-size:12px;" label="Search Engine">
		            <option value="google">Google</option>
			        <option value="yahoo">Yahoo</option>
			        <option value="lycos">Lycos</option>
                </optgroup>
			</select>
		</div>
		<br />
		<div style="text-align:center;">
			<input type="hidden" name="search_fields" value="all" />
			<input type="hidden" name="show_results" value="topics" />
			<input class="button1" type="submit" value="<?php echo ((isset($this->_rootref['L_SEARCH'])) ? $this->_rootref['L_SEARCH'] : ((isset($user->lang['SEARCH'])) ? $user->lang['SEARCH'] : '{ SEARCH }')); ?>" />
			<br /><br />
			<a href="<?php echo $this->_rootref['U_SEARCH'] ?? ''; ?>"><?php echo ((isset($this->_rootref['L_ADVANCED_SEARCH'])) ? $this->_rootref['L_ADVANCED_SEARCH'] : ((isset($user->lang['ADVANCED_SEARCH'])) ? $user->lang['ADVANCED_SEARCH'] : '{ ADVANCED_SEARCH }')); ?></a>
		</div>
		<?php if (($this->_rootref['DEBUG_QUERIES'] ?? null)) {  ?><div class="block_data"><?php echo $this->_rootref['SEARCH_DEBUG'] ?? ''; ?></div><?php } ?>

	</div>
</form>
<?php } else { ?>

<?php echo ((isset($this->_rootref['L_LOGIN_TO_USE_SEARCH'])) ? $this->_rootref['L_LOGIN_TO_USE_SEARCH'] : ((isset($user->lang['LOGIN_TO_USE_SEARCH'])) ? $user->lang['LOGIN_TO_USE_SEARCH'] : '{ LOGIN_TO_USE_SEARCH }')); ?>

<?php } ?><!-- IDTAG ends block_search -->