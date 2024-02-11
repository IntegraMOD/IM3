<?php if (!defined('IN_PHPBB')) exit; if (($this->_rootref['RESIZE'] ?? null)) {  ?>

<script type="text/javascript">
// <![CDATA[
	var trigger = Get_Cookie('styletrigger');
	var wvalue = Get_Cookie('stylewidth');
	jQuery("#page-width").css("width:", wvalue + '%');
// ]]>
</script>
<div id="slider" style="width:96%; margin:10px auto;"></div>
<?php } ?>