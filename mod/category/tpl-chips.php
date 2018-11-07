<script type="text/javascript" src="<?php echo SITEURL;?>/lib/js/jscrollpane/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php echo SITEURL;?>/lib/js/jscrollpane/jquery.jscrollpane.min.js"></script>
<link type="text/css" href="<?php echo SITEURL;?>/lib/js/jscrollpane/jquery.jscrollpane.css" rel="stylesheet" media="all" />
<script type="text/javascript" language="javascript">
$(document).ready(function(){
	$('.scroll-pane').jScrollPane();
	$("ul.list li:last").addClass('last');
	$('html, body').animate({ scrollTop: $('#showMiddle').offset().top }, 'fast');
});
</script>
<h1 class="title-nu-shop" style="width:75% !important;">Nu Shop</h1>
<?php require("inc/header-slider.php");?>
<!--<div class="home-spotlight"><img src="<?php echo SITEURL;?>/images/trash/shop-spotlight.jpg" /> </div>-->
<div class="shop-wrapp">
  <div class="loader"></div>
  <div class="sidebar">
    <h2>NU CATEGORIES</h2>
    <ul class="sidebar-nav">
      <?php echo getCategoryMenu($TPL->data['parentID'],$TPL->data['categoryID']);?> 
      <script>
      	$("a#nu-vip-membership").attr('href',SITEURL+"/user/vip-membership/");
      </script>
    </ul>
  </div>
  <div id="showMiddle"></div>
  <div class="shop-conainer">
    <h2><?php echo $TPL->data['categoryTitle']; ?></h2>
    <div><?php echo $TPL->data['synopsis']; ?></div>
    <div class="shoping-landing">
      <ul class="list">
        <?php
			$sql = 'SELECT productID FROM '.$DB->pre.'product WHERE status=1 AND categoryID = "'.$TPL->data['categoryID'].'"';
			$DB->dbQuery($sql);
			$MXTOTREC = $DB->numRows;
			if($MXTOTREC > 0)
			{
				$sql = "SELECT P.*, C.categoryTitle FROM ".$DB->pre."product P LEFT JOIN ".$DB->pre."category AS C ON(P.categoryID=C.categoryID) WHERE P.status=1 AND P.categoryID = '".$TPL->data['categoryID']."'";
				$DB->dbRows($sql);
				$REC = $DB->dbRows($sql);
				if($REC)
				{
					$_c = 0;
					
					$_sessOK = isSessOK();
					
					foreach($REC as $d)
					{ 
						list( $_p ) = explode( " ", $d['productPrice'] );
						
						if( $d['discount'] > 0 )
							$_p = round( ( $_p - ( $_p * ( $d['discount'] / 100 ) ) ), 2 );
						
						echo( '<li>
								'.( ( $_sessOK )?( '<form action="'.SITEURL.'/inc_mg/paypal/checkout.php" METHOD="POST">' ):( '' ) ).'
								<a class="img-box"> <img src="'.SITEURL.'/core/image.inc.php?path=product/'.$d['productImg1'].'&w=66&h=66&type=crop" /> </a>
									<div class="details">
										<span class="name">'.$d['productTitle'].'</span>
											<div class="btns"><a class="prodPrice addCart"> <span>$'.$d['productPrice'].'</span> </a> <!--a class="button addCart buynow" producttype="'.makeSeoUri( $d[ 'categoryTitle' ] ).'" href="#"  rel="'.$d['productID'].'"> BUY NOW </a></div-->
					
											<input type="hidden" name="cost" value="'.$_p.'" />
											<input type="hidden" name="pname" value="'.$d['productTitle'].'" />
					
											<input type="image" name="paypal_submit_'.$_c.'" id="paypal_submit_'.$_c .'"  src="https://www.paypal.com/en_US/i/btn/btn_dg_pay_w_paypal.gif" border="0" align="top" alt="Pay with PayPal" '.( ( !$_sessOK )?( ' onClick="showLogin(); return( false );" ' ):( '' ) ).' />' );
					
						if($d['discount']>0)
							echo( '<p style="padding-top: 20px; padding-left: 10px;" >SAVE '.$d['discount'].'%</p>' );
						
						echo( '</div></div>'.( ( $_sessOK )?( '</form>' ):( '' ) ).'</li>' );
						$_c++;
					} 
			
					if( $_sessOK )
					{
						echo( '<script src="https://www.paypalobjects.com/js/external/dg.js" type="text/javascript"></script>
								<script>');
						$_i = 0;
						for( $_i = 0; $_i <= $_c; $_i++ )
						{
							echo( "var dg".$_i." = new PAYPAL.apps.DGFlow(
									{
										trigger: 'paypal_submit_".$_i."',
										expType: 'instant'
										 //PayPal will decide the experience type for the buyer based on his/her 'Remember me on your computer' option.
									});" );
						}
						
						echo( '</script>' );
					}	

				}
			}
		?>
      </ul>
    </div>
  </div>
</div>
