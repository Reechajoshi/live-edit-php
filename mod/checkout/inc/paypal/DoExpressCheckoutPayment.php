<?php 
session_start();
//ob_start();
	
/**********************************************************
DoExpressCheckoutPayment.php

This functionality is called to complete the payment with
PayPal and display the result to the buyer.

The code constructs and sends the DoExpressCheckoutPayment
request string to the PayPal server.

Called by GetExpressCheckoutDetails.php.

Calls CallerService.php and APIError.php.

**********************************************************/
	require("../../../../connectdb.inc.php");
	require_once('caller-service.php');
	require(ABSPATH."/lib/class.phpmailer.inc.php");
	ini_set('session.bug_compat_42',0);
	ini_set('session.bug_compat_warn',0);

	/* 
		Gather the information to make the final call to
   		finalize the PayPal payment.  The variable nvpstr
   		holds the name value pairs
   	*/
	
	$token = urlencode( $_SESSION['token']);
	$paymentAmount = urlencode ($_SESSION['TotalAmount']);
	$paymentType = urlencode($_SESSION['paymentType']);
	$currCodeType = urlencode($_SESSION['currCodeType']);
	$payerID = urlencode($_SESSION['payer_id']);
	$serverName = urlencode($_SERVER['SERVER_NAME']);

	$nvpstr='&TOKEN='.$token.'&PAYERID='.$payerID.'&PAYMENTACTION='.$paymentType.'&AMT='.$paymentAmount.'&CURRENCYCODE='.$currCodeType.'&IPADDRESS='.$serverName ;


 	/* 
 		Make the call to PayPal to finalize payment
    	If an error occured, show the resulting errors
    */
 		
	$resArray = hash_call("DoExpressCheckoutPayment",$nvpstr);

	/* 
		Display the API response back to the browser.
	   	If the response from PayPal was a success, display the response parameters'
	   	If the response was an error, display the errors received using APIError.php.
   	*/
	
	$ack = strtoupper($resArray["ACK"]);

	if($ack != 'SUCCESS' && $ack != 'SUCCESSWITHWARNING'){
		$_SESSION['reshash'] = $resArray;
		$location = "APIError.php";
		//header("Location: $location");
		echo '<script language="javascript">location.href="'.$location.'";</script>'; exit;
	}else{
		global $DB;

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
		if($_SESSION['VIPMEMBERSHIPCART']['memberType'] == 'vipMembership'){
			$sql = "UPDATE ".$DB->pre."site_user SET isVip = '1', isVipAmt = '".$_SESSION['VIPMEMBERSHIPCART']['vipMemberAmt']."'  WHERE siteUserID='".$_SESSION['SITEUSERID']."' AND status = 1";
			$DB->dbQuery($sql);
			
			$sql = "SELECT S.*, C.countryName FROM ".$DB->pre."shipping_address  AS S LEFT JOIN ".$DB->pre."country AS C ON (S.countryID = C.countryID) WHERE S.shippingAddressID = '".intval($_SESSION['cartDetails'][1]['shippingAddressID'])."' AND siteUserID = '".intval($_SESSION['SITEUSERID'])."'";
			$S = $DB->dbRow($sql);
			$_POST['siteUserID'] = $_SESSION['SITEUSERID'];
			$_POST['payerID'] = $_SESSION['payer_id'];
			$_POST['token'] = $_SESSION['token'];
			$_POST['shippingAddressID'] = $_SESSION['cartDetails'][1]['shippingAddressID'];
			$_POST['userFirstName'] = $S['userFirstName'];
			$_POST['userLastName'] = $S['userLastName'];
			$_POST['userContact'] = $S['userContact'];
			$_POST['userCity'] = $S['userCity'];
			$_POST['userState'] = $S['userState'];
			$_POST['countryName'] = $S['countryName'];
			$_POST['shippingAddress'] = $S['shippingAddress'];
			$_POST['userZip'] = $S['userZip'];
			$_POST['shippingAmt'] = $_SESSION['reshash']['SHIPPINGAMT'];
			$_POST['totalAmount'] = $_SESSION['VIPMEMBERSHIPCART']['vipMemberAmt']+5;
			$_POST['orderType'] = "Membership";
			$_POST['dateAdded'] = date("Y-m-d H:i:s");
			$DB->table = $DB->pre."order";
			$DB->data  = $_POST;
			if($DB->dbInsert()){
				$orderID = $DB->insertID;	
				$arrData = array("orderID"=>$orderID,"productID"=>'0',"productSize"=>'',"productQty"=>'',"orderStatus"=>$_SESSION['reshash']['ACK'],"productAmount"=>'',"currencyCode"=>'');
				$DB->table = $DB->pre."order_product";
				$DB->data  = $arrData;
				$DB->dbInsert();
				
				$mail = new PHPMailer();						
				$mail->From = "sourabh@maxdigi.com";
				$mail->FromName = "NU Team";
				$mail->AddAddress(trim($_REQUEST["userEmail"]),trim($_REQUEST["userName"]));
				$mail->Subject = "VIP Membership Upgraded Successfully";
				$mail->Body = "
					<p style='font-weight:bold;'>Dear ".$_SESSION['SITEUSERNAME'].",<br /></p>
					<p>Thank you for Upgrading your Membership on NU.</p>
					<p>We hope you will be able to enjoy the complete range of services at : <a href='".SITEURL."/' target='_blank'>NU</a>:</p>
					<p>Sincerely,</p>
					<p>The NU Team</p>
				";
				$mail->ContentType = "text/html";
				//$mail->Send();
			}
			unset($_SESSION['VIPMEMBERSHIPCART']);
			
			header('location:'.SITEURL.'/user/'.$_SESSION['SITEUSERURI'].'/'.$_SESSION['SITEUSERID'].'/');
			exit;
		}else{
			$sql = "SELECT S.*, C.countryName FROM ".$DB->pre."shipping_address  AS S LEFT JOIN ".$DB->pre."country AS C ON (S.countryID = C.countryID) WHERE S.shippingAddressID = '".intval($_SESSION['cartDetails'][1]['shippingAddressID'])."' AND siteUserID = '".intval($_SESSION['SITEUSERID'])."'";
			$S = $DB->dbRow($sql);
			
			$_POST['siteUserID'] = $_SESSION['SITEUSERID'];
			$_POST['payerID'] = $_SESSION['payer_id'];
			$_POST['token'] = $_SESSION['token'];
			if($flag == 0){
				$_POST['shippingAddressID'] = "0";
			}else{
				$_POST['shippingAddressID'] = $_SESSION['cartDetails'][1]['shippingAddressID'];
			}
			$_POST['userFirstName'] = $S['userFirstName'];
			$_POST['userLastName'] = $S['userLastName'];
			$_POST['userContact'] = $S['userContact'];
			$_POST['userCity'] = $S['userCity'];
			$_POST['userState'] = $S['userState'];
			$_POST['countryName'] = $S['countryName'];
			$_POST['shippingAddress'] = $S['shippingAddress'];
			$_POST['userZip'] = $S['userZip'];
			$_POST['shippingAmt'] = $_SESSION['reshash']['SHIPPINGAMT'];
			$_POST['totalAmount'] = $_SESSION['TotalAmount'];
			$_POST['orderType'] = "Product";
			$_POST['dateAdded'] = date("Y-m-d H:i:s");
			$DB->table = $DB->pre."order";
			$DB->data  = $_POST;
			if($DB->dbInsert()){
				$orderID = $DB->insertID;	
				if($_SESSION['PRODUCTCART']){
					foreach($_SESSION['PRODUCTCART'] as $key=>$value){
						if($value['productSize'] !="undefined"){
							foreach($value as $k=>$v){
								if($v['productSize']){
									$productSize = $v['productSize'];
								}else{ 
									$productSize =  "";
								}
								$arrData = array("orderID"=>$orderID,"productID"=>$v['productID'],"productSize"=>$productSize,"productQty"=>$v['productQty'],"orderStatus"=>$_SESSION['reshash']['ACK'],"productAmount"=>$v['productPrice'],"currencyCode"=>$_SESSION['currCodeType']);
								$DB->table = $DB->pre."order_product";
								$DB->data  = $arrData;
								$DB->dbInsert();
								$sql = "UPDATE ".$DB->pre."qty SET soldQty = '".$v['productQty']."'  WHERE productID='".$v['productID']."' AND size = '".$productSize."'";
								$DB->dbQuery($sql);
							}
						}else{
							$arrData = array("orderID"=>$orderID,"productID"=>$value['productID'],"productSize"=>"","productQty"=>$value['productQty'],"orderStatus"=>$_SESSION['reshash']['ACK'],"productAmount"=>$value['productPrice'],"currencyCode"=>$_SESSION['currCodeType']);
							$DB->table = $DB->pre."order_product";
							$DB->data  = $arrData;
							$DB->dbInsert();
						}
					}
					$purchaseUserChip = 0;
					foreach($_SESSION['PRODUCTCART'] as $key=>$val){
						if($val['productType'] == 'nu-chips'){
							foreach($val as $k=>$v){
								if($k == "productPrice"){
									$purchaseUserChip = $purchaseUserChip + $v;
								}
							}
						}
					}
					$purchaseUserChip;
					$updateUserChip = "UPDATE ".$DB->pre."site_user SET userChips = userChips+".$purchaseUserChip ." WHERE siteUserID = '".$_SESSION['SITEUSERID']."'";
					$DB->dbQuery($updateUserChip);
				}
			}
			$_SESSION['PRODUCTCART'] = '';
			$_SESSION['totProCartCount'] = '';
			unset($_SESSION['PRODUCTCART']);
			unset($_SESSION['totProCartCount']);
			unset($_SESSION['shipID']);
			header('location:'.SITEURL.'/checkout/success-payment/');
			exit;
		}
	}
?>

