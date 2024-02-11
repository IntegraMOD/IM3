<?php if (!defined('IN_PHPBB')) exit; ?><script>
// <![CDATA[
	/**
	* New function for handling multiple calls to window.onload and window.unload by pentapenguin
	*/

	var onload_functions = new Array();
	var onunload_functions = new Array();

	window.onload = function()
	{
		for (var i = 0; i < onload_functions.length; i++)
		{
			eval(onload_functions[i]);
		}
	}

	window.onunload = function()
	{
		for (var i = 0; i < onunload_functions.length; i++)
		{
			eval(onunload_functions[i]);
		}
	}

	onload_functions.push('init_scrollers()');
// ]]>
</script>

<script src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>assets/js/scroller.js"></script>

<?php if (($this->_rootref['S_IS_PORTAL'] ?? null) && ($this->_rootref['S_ARRANGE'] ?? null) || ($this->_rootref['S_SGP_AJAX'] ?? null)) {  ?>

<script src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>assets/js/drag_n_drop/prototype.js"></script>
<script src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>assets/js/calendar.js"></script>
<script src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>assets/js/php.js"></script>
<script src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>assets/js/sgp_ajax.js"></script>
<?php } if (($this->_rootref['S_IS_PORTAL'] ?? null) && ($this->_rootref['S_ARRANGE'] ?? null)) {  ?>

<script src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>assets/js/drag_n_drop/scriptaculous.js"></script>
<script src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>assets/js/drag_n_drop/builder.js"></script>
<script src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>assets/js/drag_n_drop/dragdrop.js"></script>
<script src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>assets/js/drag_n_drop/effects.js"></script>
<script src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>assets/js/drag_n_drop/controls.js"></script>
<script src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>assets/js/drag_n_drop/slider.js"></script>
<script src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>assets/js/drag_n_drop/unittest.js"></script>
<?php } ?>


<script src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>assets/js/portal.js"></script>

<?php if (($this->_rootref['S_HIGHSLIDE'] ?? null)) {  ?>

<script src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>assets/js/highslide/highslide-full.packed.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>assets/js/highslide/highslide.css" />

<script>
// <![CDATA[
	hs.graphicsDir = '<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>assets/js/highslide/graphics/';
	hs.align = 'center';
	hs.transitions = ['expand', 'crossfade'];
	hs.outlineType = 'glossy-dark';
	hs.wrapperClassName = 'dark';
	hs.fadeInOut = true;
	//hs.dimmingOpacity = 0.75;

	// Add the controlbar
	if (hs.addSlideshow) hs.addSlideshow({
		//slideshowGroup: 'group1',
		interval: 5000,
		repeat: false,
		useControls: true,
		fixedControls: 'fit',
		overlayOptions: {
			opacity: .6,
			position: 'bottom center',
			hideOnMouseOut: true
		}
	});
// ]]>
</script>
<?php } ?>


<link rel="stylesheet" href="<?php echo $this->_rootref['T_STYLESHEET_PORTAL_COMMON'] ?? ''; ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->_rootref['T_STYLESHEET_PORTAL_OVERLOAD'] ?? ''; ?>" type="text/css" />

<script src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>assets/js/jquery/jquery.hoverIntent.js"></script>
<script src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>assets/js/jquery/imgbubbles.js"></script>

<script>
//<![CDATA[

	var $css_file_append = 'fix_ff.css';

	if (/MSIE (\d+\.\d+);/.test(navigator.userAgent))
	{
		var ieversion = new Number(RegExp.$1)
		$css_file_append = 'fix_ie_' + ieversion + '.css';
	}
	else if (/Firefox[\/\s](\d+\.\d+)/.test(navigator.userAgent))
	{
		var ffversion=new Number(RegExp.$1)
		$css_file_append = 'fix_ff.css';
	}
	else if (/Opera[\/\s](\d+\.\d+)/.test(navigator.userAgent))
	{
		var oprversion=new Number(RegExp.$1)
		$css_file_append = 'fix_opera.css';
	}
	else if (/Safari[\/\s](\d+\.\d+)/.test(navigator.userAgent))
	{
		var oprversion=new Number(RegExp.$1)
		$css_file_append = 'fix_mac.css';
	}

	jQuery.noConflict();
	jQuery(document).ready(function(){
		jQuery('<link rel="stylesheet" href="<?php echo $this->_rootref['T_THEME_PATH'] ?? ''; ?>/' + $css_file_append + '" type="text/css" />').appendTo('body');
	});

//]]>
</script>

<!-- agent script end --><?php if (($this->_rootref['S_VIEWTOPIC'] ?? null)) {  ?>

<script>
// <![CDATA[
	jQuery.noConflict();
	jQuery(document).ready(function()
	{
		var i = 0;

		// hides the quick reply box as soon as the DOM is ready - (a little sooner than page load)
		jQuery('.fastreply').hide();

		// toggles the quick reply box on clicking the quick reply button
		jQuery('a.qreply-icon').click(function()
		{
			jQuery('.fastreply').toggle(400);
/**
*			// lets toggle the image the easy way ;)
*			if (i == 0)
*			{
*				jQuery(this).css({'background' : 'url("<?php echo $this->_rootref['T_IMAGESET_LANG_PATH'] ?? ''; ?>/button_topic_qreply_no.gif") 0 0 no-repeat'});
*				i++;
*			}
*			else if (i == 1)
*			{
*				jQuery(this).css({'background' : 'url("<?php echo $this->_rootref['T_IMAGESET_LANG_PATH'] ?? ''; ?>/button_topic_qreply.gif") 0 0 no-repeat'});
*				i = 0
*			}
*			return false;
*/
		});
	});
//]]>
</script>
<?php } ?>


<script>
// <![CDATA[

	jQuery.noConflict();
	jQuery(document).ready(function($){
	jQuery(".hidden_part").hide();

	jQuery(".bg1a").mousedown(function(){
		//jQuery('#T'+this.id).fadeIn(900);
		jQuery('#T'+this.id).delay(100).toggle(600);
		}).mouseleave(function(){

		// Option #1: To close expand on mouse out use //
		//jQuery('#T'+this.id).delay(500).fadeOut(400);

		// Option #2: Leave open on mouseout, close on click //
		jQuery('#T'+this.id).delay(600);
		});
	});

	jQuery(function(){
		jQuery('a[rel="external"]').attr('target','_blank');
	});

//]]>
</script>

<script>
// <![CDATA[

	jQuery.noConflict();
	jQuery(document).ready(function($){
		jQuery('.ximg').imgbubbles({factor:5});
	})

	jQuery(document).ready(function(){
	jQuery(".vido").click(function () {
		jQuery("#vdo").hide("slide", {}, 1000);
		});
	});

	jQuery(document).ready(function(){
		jQuery('.accordion').click(function() {
			$(this).next().toggle('slow');
			return false;
		}).next().hide();
	});

//]]>
</script>

<?php if (($this->_rootref['RESIZE'] ?? null)) {  ?>

<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>

<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

<script>
// <![CDATA[

var w = 100;
x = Get_Cookie('stylewidth');
if(x)
{
	w = x;
}

jQuery.noConflict();
jQuery(document).ready(function(){
	jQuery(function() {
		jQuery("#slider").slider({
			orientation: "horizontal",
			range: "min",
			max: 100,
			value: 50,
			slide: refreshWidth,
			change: refreshWidth
		});
		jQuery("#page-width").css("width", w + '%');
	});
	function refreshWidth()
	{
		w = jQuery("#slider").slider("value");
		pc = ((w/100) * 100);
		w = pc;

		jQuery("#page-width").css("width", w + '%');
	}
	jQuery("#slider").slider({
	   stop: function(event) {
		   Set_Cookie('stylewidth', w);
		   jQuery("#slider").css("display", 'none');
	   }
	});

});
//]]>
</script>
<?php } if (($this->_rootref['S_SHOW_SHOUTBOX'] ?? null) && ($this->_rootref['S_CAN_VIEW_AS'] ?? null)) {  ?>

<script src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>assets/js/static.js"></script>
<script src="<?php echo $this->_rootref['ROOT_PATH'] ?? ''; ?>assets/js/editor.js"></script>
<script src="<?php echo $this->_rootref['U_SHOUT'] ?? ''; ?>"></script>
<?php } $this->_tpl_include('gallery/plugins_header.html'); ?>