jQuery(document).ready(function()
{
	
	jQuery(".navbar-toggle" ).click(function()
	{
    	if(jQuery('#popout').offset().right > jQuery('#popout').width())
    	{
	    	jQuery('#popout').stop().animate({ right: 0 }, 'fast');
jQuery('body:not(#popout)').css({'opacity':'0'});
	    }
			else jQuery('#popout').stop().animate({ right: 0 }, 'fast');
jQuery(document).mousedown(function (e)
{
    var container = jQuery("#popout");

    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        container.stop().animate({right: -jQuery('#popout').outerWidth() }, 'fast');
    }
});			
	});

	jQuery('.navbar-close').click(function()
	{
		jQuery('#popout').stop().animate({ right: -jQuery('#popout').outerWidth() }, 'fast');
	});
	jQuery(window).resize(function()
	{
		jQuery('#popout').stop().animate({right:-jQuery('#popout').outerWidth() },'fast');
	});
	/*jQuery("#popout ul li").hover(function(){
    jQuery('#popout ul li ul').stop().animate({height:40},150);
  },function(){
    
    
  });*/
  
});

