$(document).ready(function(){
	$('ul.video-list li a.img-box').live('click',function(){
		var videoLink = $(this).attr('rel');
	// wmode=transparent&rel=0&autohide=1&showinfo=0&autoplay=1&loop=1&controls=0
		$(this).html(' <iframe width="391" height="208" src="http://www.youtube.com/embed/'+videoLink+'?&autoplay=1&rel=0" frameborder="0" allowfullscreen > </iframe>');
		return false;
			
	});
});

;
