<?php
/*if(!$_SESSION['SITEUSERID']){
	header('Location: '.SITEURL.'/checkout/step-1/');
}else if(!$_SESSION['PRODUCTCART']){
	header('Location: '.SITEURL.'/checkout/step-1/');
}*/

if($_SESSION['PRODUCTCART']){
	$flag = 0;
	foreach($_SESSION['PRODUCTCART'] as $key=>$val){
		if($val['productType'] != 'nu-chips'){
			foreach($val as $k=>$v){
				$flag = 1;
			}
		}
	}
}

$cont_shop_btn_details = getButtons( "continue_shopping", "checkout_step_04" );	
$back_s1_btn_details = getButtons( "back_step1", "checkout_step_04" );	
$back_s3_btn_details = getButtons( "back_step3", "checkout_step_04" );	
$proceed_pmt_btn_details = getButtons( "proceed_to_payment", "checkout_step_04" );	

?>
<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/mod/checkout/checkout.inc.js"></script>
<div class="checkout-wrapp">
  <h1>CHECKOUT</h1>
  <ul class="steps-nav">
    <li><a onclick="return false;">Step 1</a></li>
    <li><a onclick="return false;">Step 2</a></li>
    <li><a onclick="return false;">Step 3</a></li>
    <li><a onclick="return false;" class="active">Step 4</a></li>
  </ul>
  <form action="<?php echo SITEURL.'/mod/checkout/inc/paypal/review-order.php';?>" method="POST">
    <div class="order-summary-wrapp-step-4" id="shipping-summary" style=" display:block;">
      <h3>SHOPPING CART SUMMARY</h3>
      <table class="table-order-summary" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <th width="118">ITEM</th>
          <th width="415">&nbsp;</th>
          <th width="115" align="left">SIZE</th>
          <th width="140" align="center">QUANTITY</th>
          <th width="115" align="center">PRICE</th>
          <th width="78" align="center">TOTAL</th>
        </tr>
        <?php
		if($_SESSION['PRODUCTCART']){
			foreach($_SESSION['PRODUCTCART'] as $key=>$val){
				$prodCost = $val['productPrice'] * $val['productQty'];
				if($val['productSize'] !="undefined"){
					foreach($val as $k=>$v){
						$prodSizeCost = $v['productPrice'] * $v['productQty'];
		 ?>
        <tr>
          <td width="118"><a class="thumb"><img src="<?php echo SITEURL;?>/core/image.inc.php?path=product/<?php echo $v['productImage'];?>&amp;w=60&amp;h=60&amp;type=crop" title="<?php echo $v['productTitle'];?>" /></a></td>
          <td width="415"><?php echo $v['productTitle'];?></td>
          <td width="415"><?php if($v['productSize']){echo $v['productSize'];}else{ echo "NULL";}?></td>
          <td width="140" align="center"><?php echo $v['productQty'];?></td>
          <td width="115" align="center">$<?php echo number_format($v['productPrice'], 2, '.', '');?></td>
          <td width="78" align="center">$<?php echo number_format($prodSizeCost, 2, '.', '');?></td>
        </tr>
        <input type="hidden" name="productTitle[]" value="<?php echo $v['productTitle']; ?>" />
        <input type="hidden" name="productPrice[]" value="<?php echo $v['productPrice']; ?>" />
        <input type="hidden" name="quantity[]" value="<?php echo $v['productQty'];?>">
        <?php			
						$totProdSizeCost = $totProdSizeCost + $prodSizeCost;
					}
				}else{
		?>
        <tr>
          <td width="118"><a class="thumb"><img src="<?php echo SITEURL;?>/core/image.inc.php?path=product/<?php echo $val['productImage'];?>&amp;w=60&amp;h=60&amp;type=crop" title="<?php echo $val['productTitle'];?>" /></a></td>
          <td width="415"><?php echo $val['productTitle'];?></td>
          <td width="415">N/A</td>
          <td width="140" align="center"><?php echo $val['productQty'];?></td>
          <td width="115" align="center">$<?php echo number_format($val['productPrice'], 2, '.', '');?></td>
          <td width="78" align="center">$<?php echo number_format($prodCost, 2, '.', '');?></td>
        </tr>
        <?php 
				}
				$totProdCost = $totProdCost + $prodCost;
		?>
        <?php if($val['productTitle']!=''){?>
        <input type="hidden" name="productTitle[]" value="<?php echo $val['productTitle']; ?>" />
        <input type="hidden" name="productPrice[]" value="<?php echo $val['productPrice']; ?>" />
        <input type="hidden" name="quantity[]" value="<?php echo $val['productQty'];?>">
        <?php   } 
			}
		}
        ?>
      </table>
      <div class="total-amount"> 
       <?php if($flag == 0){ ?>
        <span class="title">TOTAL :</span>
        <?php $total = $totProdSizeCost + $totProdCost;?>
        <p>$<?php echo number_format($total, 2, '.', '');?></p>
       <?php } else { ?>
		<span class="title">SHIPPING CHARGES :</span>
        <p>$5.00</p>
       <span class="title">TOTAL :</span>
        <?php $total = $totProdSizeCost + $totProdCost + 5;?>
        <p>$<?php echo number_format($total, 2, '.', '');?></p>
       <?php } ?>
      </div>
      <input type="hidden" name="L_TOTALAMT" size="5" maxlength="32" value="<?php echo $total; ?>" />
      <input type="hidden" name="paymentType" value="Sale" >
      <input type="hidden" name="cmd" value="_s-xclick">
      <input type="hidden" name="currencyCodeType" value="AUD">
      <input type="hidden" name="PERSONNAME" value="<?php echo $_SESSION['SITEUSERNAME'];?>">
      <input type="hidden" name="SHIPTOCOUNTRYCODE" value="US">
      <input type="hidden" name="hosted_button_id" value="F85B8QZRS86PA">
      <div class="chekout-btn"> 
      	<!-- <a href="<?php // echo SITEURL.'/shop/nu-chips/';?>" class="btn-back">Continue Shopping</a> -->
		<a href="<?php echo( $cont_shop_btn_details["link"] );?>" class="btn-back <?php echo($cont_shop_btn_details["color"] ); ?>"><?php echo($cont_shop_btn_details["button_txt"] ); ?></a>
        <?php if($flag == 0){ ?>
      	<!-- <a href="<?php // echo SITEURL.'/checkout/step-1/';?>" class="btn-back">Back</a> -->
		<a href="<?php echo( $back_s1_btn_details["link"] );?>" class="btn-back <?php echo( $back_s1_btn_details["color"] ); ?>"><?php echo( $back_s1_btn_details["button_txt"] ); ?></a>
        <?php } else { ?>
        <!-- <a href="<?php // echo SITEURL.'/checkout/step-3/';?>" class="btn-back">Back</a> -->
		<a href="<?php echo( $back_s3_btn_details["link"] );?>" class="btn-back <?php echo( $back_s3_btn_details["color"] );?>"><?php echo( $back_s3_btn_details["button_txt"] );?></a>
        <?php } ?>
        <!-- <input type="submit" border="0" class="btn-proceed-to-payment" name="submit" value="PROCEED TO PAYMENT"> -->
		<input type="submit" border="0" class="btn-proceed-to-payment <?php echo( $proceed_pmt_btn_details["color"] ); ?>" name="submit" value="<?php echo( $proceed_pmt_btn_details["button_txt"] ); ?>">
      </div>
    </div>
  </form>
  
  <div class="wait-moment-step-4" style="display:none;">
    <h2>PLEASE WAIT A MOMENT</h2>
    <p>You will shortly be taken to our payment gateway where you can complete your transaction.</p>
  </div>
</div>
