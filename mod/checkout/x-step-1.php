<?php 
	session_start();
	require("inc/site.inc.php");
?>
<script type="text/javascript" src="<?php echo SITEURL?>/mod/checkout/checkout.inc.js"></script>

<input type="hidden" name="SITEUSERID" id="SITEUSERID" value="<?php $_SESSION['SITEUSERID'];?>" />
<div class="checkout-wrapp">
  <div class="loader"></div>
  <h1>CHECKOUT</h1>
  <ul class="steps-nav">
    <li><a class="active">Step 1</a></li>
    <li><a onclick="return false;">Step 2</a></li>
    <li><a onclick="return false;">Step 3</a></li>
    <li><a onclick="return false;">Step 4</a></li>
  </ul>
  <div class="order-summary-wrapp-step-4"  > <?php echo checkOutForm(); ?> </div>
</div>
