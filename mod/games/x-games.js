var WINWIDTH   = 0;
var WINHEIGHT  = 0;
var POSTLOADING = 0;
var gameFile = "";
var swfFile = "";
var youtubeURL = "";

// function FacebookInviteFriends(){
	// FB.ui({ method: 'apprequests', message: 'VISIT THIS WEB SITE'});
// }

function embedSWFObject() // attaches swf file to div with id('swfFiles')
{
	var game_div_element = document.getElementById('game_div');
	swfobject.embedSWF(gameFile, 'swfFiles', '721', '626', "10", swfFile, flashvars, params, attributes);
	game_div_element.style.display = 'block';
}

function removeSWFObject() // removes the swf file
{
	var swfDIV_html = '<div id="swfFiles" style="float:left; width:618px;"></div>';
	var game_div_element = document.getElementById('game_div');
	swfobject.removeSWF( 'swfFiles' );
	game_div_element.innerHTML = swfDIV_html;
	game_div_element.style.display = 'none';
}

function embedVideo() // attaches the video
{
	var videoHTML = "<a href='#' id='video_close_btn' onclick = 'close_video()'><img src='"+SITEURL+"/images/close.png' /></a><iframe id='video_iframe' src='"+youtubeURL+"'></iframe>";
	var video_div = document.getElementById('how_to_play_video');
	video_div.innerHTML = videoHTML;
	video_div.style.display = "block";
}

function removeVideo() // removes the video
{
	var video_div = document.getElementById('how_to_play_video');
	video_div.innerHTML = "";
	video_div.style.display = "none";
}

function FacebookInviteFriends()
{
	FB.ui({
		method: "apprequests",
		message: "NU Games, come and join me."
	});
}

function initSWFVars( gameFileName, swfFileName, youtubeURLAddr )
{
	gameFile = gameFileName;
	swfFile = swfFileName;
	youtubeURL = youtubeURLAddr
}
	
function close_video() // when close button is clicked of how to play video, rmeoves video attaches swf
{
	removeVideo();
	embedSWFObject();
	return false;
}

function getGamesList(albumID,offset) {
	//alert('photos ajax');
	POSTLOADING = 1;
	var aUrl = SITEURL+"/mod/games/x-games.inc.php";
//		alert(isSet);
	var aData = "xAction=getGamesList&albumID="+albumID+"&offset="+offset;
//	alert(aUrl+"?"+aData);
	$.ajax({
		type: "GET",
		url: aUrl,
		data: aData,
		success: function(data){			
			if(data) {
				if(data){
					$("li.gameScroller:last[total]").after(data);
					POSTLOADING = 0;
				} else {
					POSTLOADING = 1;
				}
			}
			Aloha.jQuery('.editable').aloha();
			$('div.game-list-loader').fadeOut(1000);
			return false;
		}
	});
}
$(document).ready(function(e) {
	
	$("a.btn-dark-yellow").click(function(){
		//alert("HELLO");
		//FacebookInviteFriends();
		return false;
	});
	
	$("div.btn-gplus").css('width','60px !important');
    $(window).scroll(function(){
			if($(window).scrollTop() == $(document).height() - $(window).height()){			
			if(POSTLOADING == 0){
				var offset = parseInt($("li.gameScroller:last[offset]").attr('offset'));
				var total  = parseInt($("li.gameScroller:last[total]").attr('total'));
				var gameID  = parseInt($("li.gameScroller:last[total]").attr('gameID'));
				//alert(offset+"total"+total+"albumID"+gameID);
				if(offset < total) {
					$("div.game-list-loader").fadeIn(1000);
					getGamesList(gameID,offset);
				}else {
					$("div.game-list-loader").fadeOut(1000);
				}
			}else {
				$("div.game-list-loader").fadeOut(1000);
			}
		}
	});
});