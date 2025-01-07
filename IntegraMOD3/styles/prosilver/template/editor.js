/**
	 * bbCode control by subBlue design [ www.subBlue.com ]
	 * Includes unixsafe colour palette selector by SHS`
	 */
	 
	(function($) {
	    // Startup variables
	    var imageTag = false;
	    var theSelection = false;
	 
	    var bbcodeEnabled = true;
	    // Check for Browser & Platform for PC & IE specific bits
	    // More details from: http://www.mozilla.org/docs/web-developer/sniffer/browser_type.html
	    var clientPC = navigator.userAgent.toLowerCase(); // Get client info
	    var clientVer = parseInt(navigator.appVersion); // Get browser version
	 
	    var is_ie = ((clientPC.indexOf('msie') != -1) && (clientPC.indexOf('opera') == -1));
	    var is_win = ((clientPC.indexOf('win') != -1) || (clientPC.indexOf('16bit') != -1));
	    var baseHeight;
	 
	    /**
	     * Shows the help messages in the helpline window
	     */
	    function helpline(help) {
	        $(`form[name="${form_name}"] [name="helpbox"]`).val(help_line[help]);
	    }
	 
	    /**
	     * Fix a bug involving the TextRange object. From
	     * http://www.frostjedi.com/terra/scripts/demo/caretBug.html
	     */ 
	    function initInsertions() {
	        var doc = document.forms[form_name] ? document : opener.document;
	        var textarea = $(`form[name="${form_name}"] [name="${text_name}"]`, doc);
	 
	        if (is_ie && typeof(baseHeight) != 'number') {
	            /* === mChat focus fix Start === */
	            var mChatFocus = window.mChatFocusFix || false;
	            if(!mChatFocus) {
	                textarea.focus();
	            }
	            baseHeight = doc.selection.createRange().duplicate().boundingHeight;
	            /* ==== mChat focus fix End ==== */
	            if (!document.forms[form_name]) {
	                $('body').focus();
	            }
	        }
	    }
	 
	    /**
	     * bbstyle
	     */
	    function bbstyle(bbnumber) {    
	        if (bbnumber != -1) {
	            bbfontstyle(bbtags[bbnumber], bbtags[bbnumber+1]);
	        } else {
	            insert_text('[*]');
	            $(`form[name="${form_name}"] [name="${text_name}"]`).focus();
	        }
	    }
	 
	    /**
	     * Apply bbcodes
	     */
	    function bbfontstyle(bbopen, bbclose) {
	        theSelection = false;
	 
	        var textarea = $(`form[name="${form_name}"] [name="${text_name}"]`);
	 
	        textarea.focus();
	 
	        if ((clientVer >= 4) && is_ie && is_win) {
	            // Get text selection
	            theSelection = document.selection.createRange().text;
	 
	            if (theSelection) {
	                // Add tags around selection
	                document.selection.createRange().text = bbopen + theSelection + bbclose;
	                textarea.focus();
	                theSelection = '';
	                return;
	            }
	        } else if (textarea[0].selectionEnd && (textarea[0].selectionEnd - textarea[0].selectionStart > 0)) {
	            mozWrap(textarea[0], bbopen, bbclose);
	            textarea.focus();
	            theSelection = '';
	            return;
	        }
	 
	        //The new position for the cursor after adding the bbcode
	        var caret_pos = getCaretPosition(textarea[0]).start;
	        var new_pos = caret_pos + bbopen.length;        
	 
	        // Open tag
	        insert_text(bbopen + bbclose);
	 
	        // Center the cursor when we don't have a selection
	        // Gecko and proper browsers
	        if (!isNaN(textarea[0].selectionStart)) {
	            textarea[0].selectionStart = new_pos;
	            textarea[0].selectionEnd = new_pos;
	        }    
	        // IE
	        else if (document.selection) {
	            var range = textarea[0].createTextRange(); 
	            range.move("character", new_pos); 
	            range.select();
	            storeCaret(textarea[0]);
	        }
	 
	        textarea.focus();
	    }
	 
	    // ... (rest of the functions)
	 
	    // Expose necessary functions globally
	    window.helpline = helpline;
	    window.initInsertions = initInsertions;
	    window.bbstyle = bbstyle;
	    window.bbfontstyle = bbfontstyle;
	    // ... (expose other necessary functions)
	 
	})(jQuery);