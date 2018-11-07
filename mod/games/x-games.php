<script language="javascript" type="text/javascript" src="<?php echo $TPL->modUrl; ?>/x-games.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/mod/games/x-games.inc.js"></script>
<script>
$(document).ready(function(){
	$("ul.game-list li:first div.game-description h2").css('text-shadow','0 3px 0 #E0C973');	
	$("ul.game-list li:first div.game-description a.button").removeClass('button');	
	$("ul.game-list li:first div.game-description a:first").addClass('btn-yellow');	
	
	<?php
		if( isset( $_SESSION[ 'SITEUSERID' ] ) )
		{
			$_q = "select msg from ".$DB->pre."site_user where siteUserID=".$_SESSION[ 'SITEUSERID' ];
			$_row = $DB->dbRow($_q);
			
			if( strlen( trim( $_row[ 'msg' ] ) ) > 0 )
			{
				echo( 'showMsg( "Congratulations", "'.$_row[ 'msg' ].'");' );
				$upd_query = "update ".$DB->pre."site_user set msg='' where siteUserID = ".$_SESSION[ 'SITEUSERID' ].";";
				$DB->dbQuery( $upd_query );
			}	
		}	
	?>
	
	return false;
});
</script>
<div class="banner-730-90">
	<?php echo( getBanner( 'banner_ad_3_nu_games' ) ); ?>
</div>
<ul class="game-list">
<?php 
echo getGamesList(0,0);
 ?>
 <!--div class="game-list-loader">
  <a><img src="<?php echo SITEURL;?>/images/text-game-list-scroller.png"></a>
 </div-->
</ul>
