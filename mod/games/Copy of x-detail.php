<?php session_start(); ?>
<script language="javascript" type="text/javascript" src="<?php echo $TPL->modUrl; ?>/x-games.js"></script>
<script type="text/javascript" src="<?php echo SITEURL;?>/inc/js/jcarousel/jquery.jcarousel.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo SITEURL;?>/inc/js/jcarousel/game-tips.css" />
<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('#mycarousel').jcarousel({
        scroll:1
    });
	
	$("div.game-details a.btn-green").hover(function(){
		$("div.game-details div.game-tips-pop").show();
		return false;	
	},function(){
		$("div.game-details div.game-tips-pop").hide();
		return false;	
	});
	
	$("div.game-details div.game-tips-pop").hover(function(){
		$(this).show();
		return false;	
	},function(){
		$(this).hide();
		return false;
	});
});
</script>
<div id="wrapper">
  <div class="msg-jackpot-grabs">$1,000,0000 Chips<br />
    JACKPOT STILL UP FOR GRABS !</div>
  <div class="game-inner-wrapp">
    <?php 
global $TPL;
$gameID = $TPL->modID;
$sql = "SELECT * FROM ".$DB->pre."game WHERE status = 1 AND gameID = '".$gameID."' ";
$data = $DB->dbRow($sql);
?>
<div class="game-window">
	<?php if($_SESSION['SITEUSERID']){ ?>
	<img src="<?php echo SITEURL.'/uploads/game/'.$data['imageName'];?>" height="618px"  width="712px" />
    <?php }else{ ?>
    	<h2>Please Login / Register to play this game.</h2><br  />
        <a href="#" id="gameLogin">Login / Register</a>
        <script>$("div.game-window").css({'background':'none'});</script>
    <?php }?>
</div>
  <div class="game-details">
    <h2><?php echo $data['gameTitle'];?></h2>
    <a href="<?php echo SITEURL.'/how-to-play/';?>" class="btn-gray">HOW TO PLAY</a> 
    <a href="#" class="btn-green">Nu Games Tips</a>
    <div class="game-tips-pop" style="display:none;">
        <ul id="mycarousel" class="jcarousel-skin-tango">
        <?php
		$sql = "SELECT * FROM ".$DB->pre."game_tips WHERE status = 1 and gameID = '".$gameID."'";
		$DB->dbRows($sql);
		if($DB->numRows > 0 ){
			foreach($DB->rows as $d){
		?>
        	<li>
        	<h3><?php echo $d['gameTipTitle']; ?></h3>
            <?php
				if($d['gameTipText'] != ""){
					echo '<p>'.limitChars($d['gameTipText'],30).'</p>
					<img src="'.SITEURL.'/core/image.inc.php?path=game_tips/'.$d['gameTipImage'].'&w=205&h=80&type=crop" alt="'.$d['gameTipTitle'].'" />';
					
				}else{
					echo '<p><img src="'.SITEURL.'/core/image.inc.php?path=game_tips/'.$d['gameTipImage'].'&w=205&h=105&type=crop" alt="'.$d['gameTipTitle'].'" /></p>';
				}
			?>
        	</li>
        <?php 
			}
		}else{
			echo '<li class="not-found">No tips found</li>';	
		}
		?>
        </ul>
    </div>
    <a href="<?php echo SITEURL.'/shop/nu-chips/';?>" class="button"><img src="<?php echo SITEURL.'/images/icon-piggy-bank.png';?>" />BUY MORE CHIPS </a> 
    <a href="#" class="btn-blue"><img src="<?php echo SITEURL.'/images/icon-star.png';?>" /> EARN FREE CHIPS</a> 
    <a href="#" class="btn-dark-yellow"><img src="<?php echo SITEURL.'/images/icon-invite-friend.png';?>" /> INVITE FRIENDS</a>
    <div class="btn-social-like">
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
        <div class="fb-like" data-href="<?php echo SITEURL.'/product/'.$data['seoUri'].'/'.$data['gameID'].'/';?>" data-send="false" data-layout="button_count" data-width="150" data-show-faces="true"></div>				
    </div>
    <div class="banner-198x165"><img src="<?php echo SITEURL.'/images/trash/ad-banner.jpg';?>" /></div>
  </div>
</div>
<?php	
$sql = "SELECT * FROM ".$DB->pre."game WHERE status = 1 AND seoUri != '".$gameTitle."' ORDER BY RAND() LIMIT 0,3 ";
echo '
	<div class="product-list-wrapp game-inner-product">
    <h2 class="product-list-title"><span class="text-gradiant"></span>CHECK OUT THESE GAMES</h2>
    <ul class="product-list">';
	$data = $DB->dbRows($sql);
	$TOTREC = $DB->numRows;
	if($TOTREC){		
		foreach($data as $key=>$value){
		echo '<li>
				<div class="img-box"><img src="'.SITEURL.'/uploads/game/'.$value['imageName'].'" height = "190px" width="294px" /></div>
				<span class="title">'.$value['gameTitle'].'</span>
				<p>'.limitChars($value['synopsis'],100).'</p>
				<a href="'.SITEURL.'/games/'.$value['seoUri'].'/'.$value['gameID'].'/" class="button"> Play Now ! </a>
			  </li>';
		}
	}
	echo '</ul>';
?>
  </div>
  <div class="banner-730-90 game-list-inner-banner"></div>
</div>
