<?php if (!defined('IN_PHPBB')) exit; ?><script type="text/javascript">

	function countAdClick(id)
	{
	   loadXMLDoc('<?php echo $this->_rootref['ADS_CLICK_FILE'] ?? ''; ?>?a=' + id);
	}

	function countAdView(id)
	{
	   loadXMLDoc('<?php echo $this->_rootref['ADS_VIEW_FILE'] ?? ''; ?>?a=' + id);
	}

	function loadXMLDoc(url) {
	   req = false;
	   if(window.XMLHttpRequest) {
	      try {
	         req = new XMLHttpRequest();
	      } catch(e) {
	         req = false;
	      }
	   } else if(window.ActiveXObject) {
	      try {
	         req = new ActiveXObject("Msxml2.XMLHTTP");
	      } catch(e) {
	         try {
	            req = new ActiveXObject("Microsoft.XMLHTTP");
	         } catch(e) {
	            req = false;
	         }
	      }
	   }
	   if(req) {
	      req.open("GET", url, true);
	      req.send(null);
	   }
	}
</script>