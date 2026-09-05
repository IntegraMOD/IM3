/*
	ajaxlike MOD
	javascript functions
*/

// added again for backward compatiblity
function JQuery_loader(url)
{
    if (typeof(jQuery) == 'undefined') {
            document.write("<scr" + "ipt type=\"text/javascript\" src=\""+url+"\"></scr" + "ipt>");
    }

}


function load_tips(id)
{
			jQuery.noConflict();
			jQuery(id).tipsy({
    			delayIn: 0,
    			delayOut: 0,
    			fade: false,
    			gravity: 's',    // gravity
    			html: true,
    			offset: 0,
    			opacity: 0.8,
    			trigger: 'hover'
		});
}

function ajaxlike_prepare_dialog()
{
	jQuery(this).parent().find('.ui-dialog-titlebar-close').each(function()
	{
		jQuery(this).contents().filter(function()
		{
			return this.nodeType === 3;
		}).remove();
	});
}

function ajaxlike_like(post_id, topic_id, forum_id, user_id, callback_url)
{
	
	var rv = new Date().getTime();
	
		jQuery.get(callback_url, {
		ajaxlike_rnd : rv,
		//f: forum_id, // Senko say it is not useful :D
		t: topic_id, 
		p: post_id, 
		like_from : user_id,
		ajaxlike_action: 'like', 
		ajaxlike_data: ''
		},   function(data){
		
	 		document.getElementById('ajaxlike_content'+post_id).innerHTML = data;
	 		load_tips('#ajaxlike_tooltip'+post_id);
		}
	);

}

function ajaxlike_unlike(post_id, topic_id, forum_id, user_id, callback_url)
{

	var rv = new Date().getTime();
	
	jQuery.get(callback_url, {
		ajaxlike_rnd : rv,
		//f: forum_id, // Senko say it is not useful :D
		t: topic_id, 
		p: post_id, 
		like_from : user_id,
		ajaxlike_action: 'unlike', 
		ajaxlike_data: ''
		},   function(data){
		
	 		document.getElementById('ajaxlike_content'+post_id).innerHTML = data;
	 		load_tips('#ajaxlike_tooltip'+post_id);
		}
	);
}

function ajaxlike_fulllistbox(post_id, topic_id, forum_id, callback_url, like_on_text)
{

	jQuery(function() {
		
		document.getElementById('ajaxlike-dialog').innerHTML = "<p>loading...</p>";
		
		jQuery( "#dialog:ui-dialog" ).dialog("destroy");
		
		jQuery( "#ajaxlike-dialog" ).dialog({
			width: '500',
			height: '400',
			modal: true,
			dialogClass: 'ajaxlike-dialog-window',
			create: ajaxlike_prepare_dialog,
			position: 'center',
			show: "fade",
			hide: "fade",
			buttons: {
				OK: function() {
					jQuery( this ).dialog( "close" );
				}
			},
 			beforeClose: function(event, ui) { 
  				jQuery("body").css({ overflow: 'inherit' }); 
			}, 
			open: function(event, ui) {
  				jQuery("body").css({ overflow: 'hidden' });
				
				jQuery('.ui-widget-overlay').bind('click',function(){ 
                	jQuery('#ajaxlike-dialog').dialog('close'); 
            	});
            	
				var rv = new Date().getTime();
				
				jQuery.getJSON(callback_url, {
					ajaxlike_rnd : rv,
					//f: forum_id, // Jakub say it is not useful :D
					t: topic_id, 
					p: post_id, 
					ajaxlike_action: 'fulllist', 
					ajaxlike_data: ''
				},   function(data){
				
				document.getElementById('ajaxlike-dialog').innerHTML = "";
				
				for(i=0;i<data.length;i++){
					
					
					document.getElementById('ajaxlike-dialog').innerHTML += '<div class="ajaxlike_listing_item"><div class="ajaxlike_listing_avatar">'+data[i].avatar+'</div><div class="ajaxlike_listing_content">'+data[i].username_full+'<br /><span class="ajaxlike_listing_item_date">'+like_on_text+' <i>'+data[i].date+'</i></span></div><div style="clear: both;">&nbsp;</div></div>';
					
				}
				
				
				});
				
			}
		});
		
	});

}

function ajaxlike_bind_actions()
{
	if (typeof jQuery === 'undefined')
	{
		return;
	}

	jQuery(document).off('click.ajaxlike', 'a[data-ajaxlike-action]').on('click.ajaxlike', 'a[data-ajaxlike-action]', function(event)
	{
		event.preventDefault();

		var link = jQuery(this);
		var action = link.data('ajaxlike-action');
		var postId = link.data('post-id');
		var topicId = link.data('topic-id');
		var forumId = link.data('forum-id');
		var callbackUrl = link.data('callback');

		if (action === 'like')
		{
			ajaxlike_like(postId, topicId, forumId, link.data('like-from'), callbackUrl);
		}
		else if (action === 'unlike')
		{
			ajaxlike_unlike(postId, topicId, forumId, link.data('like-from'), callbackUrl);
		}
		else if (action === 'list')
		{
			ajaxlike_fulllistbox(postId, topicId, forumId, callbackUrl, link.data('list-title'));
		}
	});

	jQuery(document).off('click.ajaxlikeNotify', 'a[data-ajaxlike-list]').on('click.ajaxlikeNotify', 'a[data-ajaxlike-list]', function(event)
	{
		event.preventDefault();

		var callbackUrl = jQuery(this).data('ajaxlike-callback');

		if (callbackUrl)
		{
			ajaxlike_liked_listbox(callbackUrl);
		}
	});
}

jQuery(function()
{
	ajaxlike_bind_actions();
});

/*
	ajaxlike notifications
*/
function ajaxlike_notificationsbox(callback_url)
{

				
		       var rv = new Date().getTime();
				
				jQuery.getJSON(callback_url, {
					ajaxlike_rnd : rv,
					ajaxlike_action: 'notifications', 
					ajaxlike_data: ''
				},   function(data){
					
			if(data!=null)
			{
				var nlikes = (data[0].new_likes);
				var ninfo = (data[0].like_new);
				

				document.getElementById('ajaxlike_not-dialog').innerHTML = "";
				
				for(i=0;i<data.length;i++){
					document.getElementById('ajaxlike_not-dialog').innerHTML += '<div class="ajaxlike_not_listing_item" like_id="'+data[i].like_id+'" id="box'+data[i].like_id+'"><div class="ajaxlike_noti ajaxlike_noti_Top ajaxlike_noti_Bottom ajaxlike_noti_Selected" style="opacity: 1; "><span id="ajaxlike_not_x" class="close'+data[i].like_id+'">&nbsp;</span><div class="ajaxlike_not_listing_item_avatar">'+data[i].avatar+(data[i].avatar!=''?"</div>":"")+data[i].username_full+'<br />'+data[i].like_info+'<a href="'+data[i].post+'">'+data[i].like_text+'</a><br /><span class="ajaxlike_not_listing_item_date"><i>'+data[i].date+'</i></span></div></div>';
			 	 
					jQuery('#ajaxlike_not_new .ajaxlike-notification-count').text(nlikes);
					jQuery('#ajaxlike_not_new .ajaxlike-notification-text').text(ninfo);
	  				jQuery("#ajaxlike_not-dialog").fadeIn("slow");	
	   				jQuery('div').on('hover',function() {  
         			hoveredId = jQuery(this).attr('like_id');
         			var like_id =(hoveredId);
		 			jQuery(".close" + like_id).click(function () {
        			//close notification when the close button is clicked
        			jQuery("#box" + like_id).fadeOut();
          			});
		  			
		  			}); 
		  		  	
       				setTimeout(function(){
      				jQuery("#ajaxlike_not-dialog" ).fadeOut(3000);
	  	 			},5000); 
				
			}
			
		}
			
			});


}

function ajaxlike_init_notify(interval, callback_url)
{

ajaxlike_notificationsbox(callback_url); // page load notify

setInterval(function(){ajaxlike_notificationsbox(callback_url)},interval);

}

//Read notifications

	
function ajaxlike_liked_listbox(callback_url)
{   

	jQuery(function() {
			var dialogElement = document.getElementById('ajaxlike-not-dialog') || document.getElementById('ajaxlike_not-dialog');

			if (!dialogElement)
			{
				return;
			}
		
			// show something until load complete in slow connection...
			dialogElement.innerHTML = "<p>loading...</p>";
				

		jQuery( "#dialog:ui-dialog" ).dialog("destroy");

			jQuery(dialogElement).dialog({
			width: '500',
			height: '400',
			modal: true,
			dialogClass: 'ajaxlike-dialog-window ajaxlike-not-dialog-window',
			create: ajaxlike_prepare_dialog,
			show: "fade",
			hide: "fade",
			buttons: {
				OK: function() {
					jQuery( this ).dialog( "close" );
				}
			},
 			beforeClose: function(event, ui) { 
  				jQuery("body").css({ overflow: 'inherit' });
			}, 
			open: function(event, ui) {
  				jQuery("body").css({ overflow: 'hidden' });
    				
				
				jQuery('.ui-widget-overlay').bind('click',function(){ 
					jQuery(dialogElement).dialog('close'); 
            	});

			var rv = new Date().getTime();
				
				jQuery.getJSON(callback_url, {
					ajaxlike_rnd : rv,
					ajaxlike_action: 'liked_list', 
					ajaxlike_data: ''
				},   function(data){
					
				var ninfo = (data[0].like_new);
				dialogElement.innerHTML = "";
				
				for(i=0;i<data.length;i++){
					
				dialogElement.innerHTML += '<div class="ajaxlike_listing_item ajaxlike_post_'+data[i].item_class+'"><div class="ajaxlike_not_listing_item_avatar">'+data[i].avatar+'</div><div class="ajaxlike_listing_content">'+data[i].username_full+'<br />'+data[i].like_info+'<a href="'+data[i].post+'" class="ajaxlike_link">'+data[i].like_text+'</a><br /><span class="ajaxlike_not_listing_item_date"><i>'+data[i].date+'</i></span><br /><span class="ajaxlike_listing_item_date"><i>'+data[i].post_text+'</i></span></div><div style="clear: both;">&nbsp;</div></div>';
					
				jQuery('#ajaxlike_not_new .ajaxlike-notification-count').text(0);
				jQuery('#ajaxlike_not_new .ajaxlike-notification-text').text(ninfo);
				
				}
			});

            }
            
		});

	});
}