<?php
session_start();
if($_SESSION['token']==''){
	header("location:".SITEURL.'/');
}
 
$cont_shop_btn_details = getButtons( "continue_shopping", "success_payment" );	
 
?>
<div class="editor-data thanks-for-payment">
  <h1>Thank You for payment !</h1>
  <ul>
    <li>
      <label>Token :</label>
      <?php echo $_SESSION['token']; ?></li>
    <li>
      <label>Payer Id:</label>
      <?php echo $_SESSION['payer_id']; ?></li>
    <li>
      <label>Currncy Code Type</label>
      <?php echo $_SESSION['currCodeType']; ?></li>
    <li>
      <label>Payment Type:</label>
      <?php echo $_SESSION['paymentType']; ?></li>
    <li>
      <label>Total Amount:</label>
      $<?php echo $_SESSION['TotalAmount']; ?></li>
  </ul>
  <!-- <div class="chekout-btn"> <a class="btn-back" href="<?php // echo SITEURL; ?>/shop/nu-chips/"> CONTINUE SHOPPING</a> </div> -->
  <div class="chekout-btn"> <a class="btn-back <?php echo( $cont_shop_btn_details["color"] ); ?>" href="<?php echo( $cont_shop_btn_details["link"] ); ?>"> <?php echo( $cont_shop_btn_details["button_txt"] ); ?></a> </div>
</div>
