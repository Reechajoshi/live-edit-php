<?php 
	session_start(); 
	$_SESSION['gameID'] = $TPL->modID;
?>

<script language="javascript" type="text/javascript" src="<?php echo $TPL->modUrl; ?>/x-games.js"></script>
<script type="text/javascript" src="<?php echo SITEURL;?>/inc/js/jcarousel/jquery.jcarousel.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo SITEURL;?>/inc/js/jcarousel/game-tips.css" />
<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/lib/js/swfobject.js"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
	try{
		jQuery('#mycarousel').jcarousel({
			scroll:1
		});
	}catch(Err){}	
	
	$("div.game-details a.btn-green").mouseover(function(){
		$("div.game-tips-pop").show();
	});
	
	$("div.game-tips-pop").mouseout(function(){
		$(this).hide();
	});
	
	$("div.game-details a.btn-feedback").click(function(){
		$("div.game-details div.game-feedback-pop").show();
		return false;	
	});
	
	$("div.game-tips-pop a.btnkeep").click(function(){
		$("div.game-tips-pop").unbind('mouseout');
		return false;
	});
	
	$("div.game-tips-pop a.btnclose").click(function(){
		$("div.game-tips-pop").bind('mouseout',function(){
			$(this).hide();
		});
		$("div.game-tips-pop").hide('fast',function(){
			$("div.game-details a.btn-green").unbind('mouseover',function(){
				setTimeout(function(){
					$("div.game-details a.btn-green").bind('mouseover');		
				},2000);
			});
		});
		return false;
	});
	
	$("div.game-feedback-pop a.btnclose").click(function(){
		$("div.game-feedback-pop").hide('fast',function(){});
		return false;
	});
	
	// when how to play button is clicked, display video, remove swf file
	$("#how_to_play_btn").click(function() {
		embedVideo();
		removeSWFObject();
		return false;
	});
	
	embedSWFObject();
	removeVideo();
});
</script>
<div id="wrapper" style="padding-top: 40px;" >
  <div class="msg-jackpot-grabs">$1,000,0000 Chips<br />
    JACKPOT STILL UP FOR GRABS !</div>
  <div class="game-inner-wrapp">
    <?php 
	global $TPL;
	$gameID = $TPL->modID;
	$sql = "SELECT * FROM ".$DB->pre."game WHERE status = 1 AND gameID = '".$gameID."' ";
	$data = $DB->dbRow($sql);
	
	$how_to_play_btn_details = getButtons( "how_to_play", "in_game" );	
	$buy_chips_btn_details = getButtons( "buy_more_chips", "in_game" );	
	$earn_chips_btn_details = getButtons( "earn_free_chips", "in_game" );	
	$invite_frnd_btn_details = getButtons( "invite_friends", "in_game" );	
	$game_tips_btn_details = getButtons( "nu_games_tips", "in_game" );	
	$feedback_btn_details = getButtons( "nu_feedback", "in_game" );	
	
	$play_now_btn_details[0] = getButtons( "play_now_01", "in_game" );	
	$play_now_btn_details[1] = getButtons( "play_now_02", "in_game" );	
	$play_now_btn_details[2] = getButtons( "play_now_03", "in_game" );	
	
	$video_url = $data['video_url'];
	$vidName = explode("=",$video_url);
	
	?>
    <script type="text/javascript">
	var flashvars = {}
	var attributes = { }
	var params = {wmode:"transparent"};
	initSWFVars( '<?php echo SITEURL.'/uploads/game/'.$data['gameFile'];?>', "<?php echo SITEURL; ?>/expressInstall.swf", "<?php echo( "http://www.youtube.com/embed/".$vidName[ count( $vidName ) - 1 ]."?rel=0"); ?>" );
	
	
	/* swfobject.embedSWF('<?php echo SITEURL.'/uploads/game/'.$data['gameFile'];?>', 'swfFiles', '721', '626', "10", "<?php echo SITEURL; ?>/expressInstall.swf", flashvars, params, attributes); */
	</script>
    <div class="game-window" id="game-window">
	<div id="how_to_play_video" style="background:black;width:721px;height:626px;display:none;"><!-- <a href="#" id="video_close_btn"><img src="<?php // echo SITEURL; ?>/images/close.png" /></a> --><!-- <iframe id="video_iframe" src="http://www.youtube.com/embed/u_WvfY--XaI?rel=0"></iframe> --></div>
	<div id="game_div" style="width:100%;height:100%;">
      <?php if($isSessOK && $_SESSION['SITEUSERID']){ ?>
      <div id="swfFiles" style="float:left; width:618px;"></div>
      <?php }else{ ?>
      <h2>Please Login / Register to play this game.</h2>
      <br  />
      <a href="#" id="gameLogin">Login / Register</a> 
      <script>$("div.game-window").css({'background':'none'});</script>
      <?php }?>
	</div> <!-- game div end -->
	</div> <!-- game window end -->
    
    <div class="game-details">
      <h2><img src="<?php echo SITEURL.'uploads/game/'.$data['gameTitleImage'] ?>" style="height:50px;width:100%;" /></h2>
	  
      <!-- <a href="<?php // echo SITEURL.'/how-to-play/';?>" class="btn-gray">HOW TO PLAY</a>  -->
	  <a id = "how_to_play_btn" href="#<?php // echo( $how_to_play_btn_details["link"] );?>" class="btn-gray <?php echo( $how_to_play_btn_details["color"] ); ?>"  ><?php echo( $how_to_play_btn_details["button_txt"] ); ?></a> 
	  
	  <!-- <a href="<?php // echo SITEURL.'/shop/nu-chips/';?>" class="button"><img src="<?php // echo SITEURL.'/images/icon-piggy-bank.png';?>" />BUY MORE CHIPS </a>  -->
	  <a href="<?php echo( $buy_chips_btn_details["link"] );?>" class="button <?php echo( $buy_chips_btn_details["color"] );?>"><img src="<?php echo SITEURL.'/images/icon-piggy-bank.png';?>" /><?php echo( $buy_chips_btn_details["button_txt"] );?></a> 
	  
	  <!-- <a href="#" class="btn-blue"><img src="<?php // echo SITEURL.'/images/icon-star.png';?>" /> EARN FREE CHIPS</a>  -->
	  <a href="#" class="btn-blue <?php echo( $earn_chips_btn_details["color"] ); ?>"><img src="<?php echo SITEURL.'/images/icon-star.png';?>" /><?php echo( $earn_chips_btn_details["button_txt"] ); ?></a> 
	  
	  <!-- <a href="#" class="btn-dark-yellow"><img src="<?php // echo SITEURL.'/images/icon-invite-friend.png';?>" /> INVITE FRIENDS</a> -->
	  <a href="#" class="btn-dark-yellow <?php echo( $invite_frnd_btn_details["color"] ); ?>"><img src="<?php echo SITEURL.'/images/icon-invite-friend.png';?>" /> <?php echo( $invite_frnd_btn_details["button_txt"] ); ?></a>
	  
      <div class="btn-tip-wrapp"> 
		<!-- <a href="#" class="btn-green">Nu Games Tips</a> -->
		<a href="#" class="btn-green <?php echo( $game_tips_btn_details["color"] ); ?>"><?php echo( $game_tips_btn_details["button_txt"] ); ?></a>
        <div class="game-tips-pop" style="display:none;"> <a href="#" class="btnclose"><img src="<?php echo SITEURL.'/images/btn-close-with-cross.png';?> " /></a> <a href="#" class="btnkeep"><img src="<?php echo SITEURL.'/images/btn-keep-with-cross.png';?> " /></a> <img src="<?php echo SITEURL.'/core/image.inc.php?path=game/'.$data['gameTipImage'].'&w=192&h=337&type=crop' ;?>" /> </div>
      </div>
	  
	<?php if( isSessOK() )
		{
	?>
	  <div class="btn-tip-wrapp"> 
	  <!-- <a href="#" class="btn-feedback">Nu FeedBack</a> -->
	  <a href="#" class="btn-feedback <?php echo( $feedback_btn_details["color"] ); ?>"><?php echo( $feedback_btn_details["button_txt"] ); ?></a>
	  
        <div class="game-feedback-pop" style="display:none;"> <a href="#" class="btnclose"><img src="<?php echo SITEURL.'/images/btn-close-with-cross.png';?> " /></a> 
			<div style="padding: 5px; padding-top: 30px;" >
				<div style="font-size: 16px;" >NU FEEDBACK</div>
				<div style="padding-top: 10px; font-size: 13px;" class="editable" id="texts-FEEDBACK_TEXT" ><?php echo( getFeedbackText() ); ?></div>
				
				<div style="margin-top: 10px; font-size: 13px;border: #000 solid 1px; text-align: left;" >
					<div style="font-size: 12px;" ><b>USERNAME:</b><?php echo( $_SESSION[ 'SITEUSERNAME' ] ); ?></div>
					<div style="font-size: 12px;" ><b>Table:</b><span id="feedback_table"></span></div>
					<div style="font-size: 12px;" ><b>NU TIME:</b><span id="feedback_time"></span></div>
				</div>
				
				<div style="margin-top: 10px; font-size: 11px; border: #000 solid 1px; text-align: left;" >
					<textarea id="feedback_desc" placeholder="Type feedback here......." cols="20" rows="8" ></textarea>
				</div>
				
				<div style="margin-top: 10px;" id="feedback_send" >
					<a class="button" style="width: 100px;" onClick="sendFeedBack(); return(false);" href="#"  >Send</a>
				</div>
				
			</div> 
		</div>
      </div>
	<?php
		}
	?>  
	  
      <div class="btn-social-like" style="padding-bottom: 20px;" >
        <div class="btn-gplus">
          <div class="g-plusone" data-size="medium"></div>
          <script type="text/javascript">
              (function() {
                var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;
                po.src = "https://apis.google.com/js/plusone.js";
                var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);
              })();
            </script> 
        </div>
        <div class="fb-like" style="padding-bottom: 5px;" data-href="<?php echo SITEURL.'/product/'.$data['seoUri'].'/'.$data['gameID'].'/';?>" data-send="false" data-layout="button_count" data-width="150" data-show-faces="true"></div>
		
		<div class="tweet-like" >
			<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://a.stage.nu-casino.com" data-text="NU Casino">Tweet</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>
		<div class="btn-linked-in">
			<script src="//platform.linkedin.com/in.js" type="text/javascript">lang: en_US</script><script type="IN/Share"></script>
		</div>
		<div><button style="background-color: #35609e; color: #FFFFFF; border: none;" onClick="FacebookInviteFriends(); return( false );" >Facebook Invite</button></div>
      </div>
	  
	  <div class="banner-198x165" style="position: relative;" >
		<?php echo( getBanner( 'banner_ad_4_in_game', true ) ); ?>
	  </div>
    </div>
  </div>
  <?php require( 'x-leaderboard.php' ); ?>
  <?php	
$sql = "SELECT * FROM ".$DB->pre."game WHERE status = 1 AND seoUri != '".$gameTitle."' ORDER BY RAND() LIMIT 0,3 ";
echo '
	<div class="product-list-wrapp game-inner-product">
    <h2 class="product-list-title01" style="width: 100%; padding: 0px;" ><span class="text-gradiant01"></span>CHECK OUT THESE NU GAMES</h2>
    <ul class="product-list">';
	$data = $DB->dbRows($sql);
	$TOTREC = $DB->numRows;
	if($TOTREC){		
		/* foreach($data as $key=>$value){
		echo '<li>
				<div class="img-box"><img src="'.SITEURL.'/uploads/game/'.$value['imageName'].'" height = "190px" width="294px" /></div>
				<span class="title">'.$value['gameTitle'].'</span>
				<div style="float: left;width: 264px;min-height: 48px;padding: 5px 15px 0px 15px;line-height: 16px;color: #565555;">'.$value['synopsis'].'</div>
				<a href="'.SITEURL.'/games/'.$value['seoUri'].'/'.$value['gameID'].'/" class="button"> Play Now ! </a>
			  </li>';
		} */
		for( $i = 0; $i < count( $data ); $i++ ){
		echo ( '<li>
				<div class="img-box"><img src="'.SITEURL.'/uploads/game/'.$data[$i]['imageName'].'" height = "190px" width="294px" /></div>
				<span class="title">'.$data[$i]['gameTitle'].'</span>
				<div style="float: left;width: 264px;min-height: 48px;padding: 5px 15px 0px 15px;line-height: 16px;color: #565555;">'.$data[$i]['synopsis'].'</div>
				<a href="'.$play_now_btn_details[$i]["link"].'" class="button '.$play_now_btn_details[$i]["color"].'"> '.$play_now_btn_details[$i]["button_txt"].' </a>
			  </li>' );
		}
	}
	echo '</ul>';
?>
</div>
<div class="banner-730-90 game-list-inner-banner">
	<?php echo( getBanner( 'banner_ad_5_in_game' ) ); ?>
</div>
</div>
