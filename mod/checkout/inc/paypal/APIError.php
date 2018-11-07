<?php
/*************************************************
APIError.php

Displays error parameters.

Called by DoDirectPaymentReceipt.php, TransactionDetails.php,
GetExpressCheckoutDetails.php and DoExpressCheckoutPayment.php.

*************************************************/

session_start();
$resArray=$_SESSION['reshash']; 

require("../../../../connectdb.inc.php");
require("../../../../inc/tpl.class.inc.php");  
require("../../../../inc/common.inc.php");
require("../../../../core/form.class.inc.php");
require("../../../../core/validate.inc.php");
require("../../../../inc/tplhook.inc.php");
require('../../../../header.php');
?>
<script type="text/javascript"  language="javascript">
$(function(){
	$('ul.side-nav li a:contains(ONLINE SALES)').addClass('active');
});
</script>

<div class="inside-page-conteiner">
  <div class="page-img"><img src="<?php echo SITEURL;?>/images/online-sales-of-tranning-guaide.jpg" /></div>
  <div class="coontent-small">
    <h2 class="title">Fail Transaction</h2>
    <table width="280">
    <?php  //it will print if any URL errors 
	if(isset($_SESSION['curl_error_no'])) { 
		$errorCode= $_SESSION['curl_error_no'] ;
		$errorMessage=$_SESSION['curl_error_msg'] ;	
		session_unset();	
	?>
      <tr>
        <td>Error Number:</td>
        <td><?php echo $errorCode; ?></td>
      </tr>
      <tr>
        <td>Error Message:</td>
        <td><?php echo $errorMessage; ?></td>
      </tr>
    </table>
    <!-- If there is no URL Errors, Construct the HTML page with  Response Error parameters.   -->
    <?php } else { ?>
    
    <table width="350" class="paypal-error" cellpadding="0" cellspacing="10">
      <tr>
        <td>Your transaction has been failed. The details are as follows:</td>
      </tr>
      <tr>
        <td><strong>CORRELATION ID :</strong> <?php echo $resArray['CORRELATIONID'];?></td>
      </tr>
      <tr>
        <td><strong>Time :</strong> <?php echo date('d-m-Y',strtotime($resArray['TIMESTAMP']));?></td>
      </tr>
      <tr>
        <td><a href="<?php echo SITEURL;?>/shop/nu-chips/">Click here </a>to continue shopping.</td>
      </tr>
      <?php  //require 'ShowAllResponse.php'; ?>
    </table>
    <?php } ?>
    </table>
  </div>
</div>
<?php require("../../../../footer.php"); ?>
