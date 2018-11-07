$(document).ready(function(){
	$('ul.game-list li div.flash-box').click(function(){
		var videoLink = $(this).attr('rel');
		
		$(this).html(' <iframe width="'+$(this).width()+'" height="'+$(this).height()+'" src="http://www.youtube.com/embed/'+videoLink+'?&autoplay=1&autohide=1&rel=0" frameborder="0" allowfullscreen > </iframe>');
		
		return false;
	});	
});