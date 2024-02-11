<?php if (!defined('IN_PHPBB')) exit; if (($this->_rootref['S_GALLERY_FEEDS'] ?? null)) {  ?><link rel="alternate" type="application/atom+xml" title="<?php echo ((isset($this->_rootref['L_FEED'])) ? $this->_rootref['L_FEED'] : ((isset($user->lang['FEED'])) ? $user->lang['FEED'] : '{ FEED }')); ?> - <?php echo ((isset($this->_rootref['L_GALLERY'])) ? $this->_rootref['L_GALLERY'] : ((isset($user->lang['GALLERY'])) ? $user->lang['GALLERY'] : '{ GALLERY }')); ?>" href="<?php echo $this->_rootref['U_GALLERY_FEED'] ?? ''; ?>" /><?php } if (($this->_rootref['S_GALLERY_FEEDS'] ?? null) && ($this->_rootref['S_ENABLE_FEEDS_ALBUM'] ?? null) && ($this->_rootref['ALBUM_ID'] ?? null)) {  ?><link rel="alternate" type="application/atom+xml" title="<?php echo ((isset($this->_rootref['L_FEED'])) ? $this->_rootref['L_FEED'] : ((isset($user->lang['FEED'])) ? $user->lang['FEED'] : '{ FEED }')); ?> - <?php echo ((isset($this->_rootref['L_ALBUM'])) ? $this->_rootref['L_ALBUM'] : ((isset($user->lang['ALBUM'])) ? $user->lang['ALBUM'] : '{ ALBUM }')); ?> - <?php echo $this->_rootref['ALBUM_NAME'] ?? ''; ?>" href="<?php echo $this->_rootref['U_GALLERY_FEED'] ?? ''; ?>?album_id=<?php echo $this->_rootref['ALBUM_ID'] ?? ''; ?>" /><?php } if (($this->_rootref['S_GP_HIGHSLIDE'] ?? null)) {  ?>

	<script type="text/javascript" src="<?php echo $this->_rootref['S_GP_HIGHSLIDE'] ?? ''; ?>highslide-full.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo $this->_rootref['S_GP_HIGHSLIDE'] ?? ''; ?>highslide.css" />
	<script type="text/javascript">
		hs.graphicsDir = '<?php echo $this->_rootref['S_GP_HIGHSLIDE'] ?? ''; ?>graphics/';
		hs.align = 'center';
		hs.transitions = ['expand', 'crossfade'];
		hs.fadeInOut = true;
		hs.dimmingOpacity = 0.8;
		hs.outlineType = 'rounded-white';
		hs.captionEval = 'this.thumb.title';
		// This value needs to be set to false, to solve the issue with the highly increasing view counts.
		hs.continuePreloading = false;

		// Add the slideshow providing the controlbar and the thumbstrip
		hs.addSlideshow({
			interval: 5000,
			repeat: false,
			useControls: true,
			fixedControls: 'fit',
			overlayOptions: {
				opacity: .75,
				position: 'top center',
				hideOnMouseOut: true
			}
		});
	</script>
<?php } if (($this->_rootref['S_GP_LYTEBOX'] ?? null)) {  ?>

	<script type="text/javascript" src="<?php echo $this->_rootref['S_GP_LYTEBOX'] ?? ''; ?>lytebox.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo $this->_rootref['S_GP_LYTEBOX'] ?? ''; ?>lytebox.css" />
	<script type="text/javascript">
		if (window.addEventListener) {
			window.addEventListener("load",initLytebox,false);
		} else if (window.attachEvent) {
			window.attachEvent("onload",initLytebox);
		} else {
			window.onload = function() {initLytebox();}
		}
		function initLytebox() {
			var imgMaxWidth = 1280;
			var imgWarning = '';
			myLytebox = new LyteBox(imgMaxWidth, imgWarning);
		}
	</script>
<?php } if (($this->_rootref['S_GP_SHADOWBOX'] ?? null)) {  ?>

	<script type="text/javascript" src="<?php echo $this->_rootref['S_GP_SHADOWBOX'] ?? ''; ?>shadowbox.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo $this->_rootref['S_GP_SHADOWBOX'] ?? ''; ?>shadowbox.css" />
	<script type="text/javascript">
		Shadowbox.init();
	</script>
<?php } ?>