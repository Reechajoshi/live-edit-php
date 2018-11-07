<?php

/********************************************
ReviewOrder.php

This file is called after the user clicks on a button during
the checkout process to use PayPal's Express Checkout. The
user logs in to their PayPal account.

This file is called twice.

On the first pass, the code executes the if statement:

if (! isset ($token))

The code collects transaction parameters from the form
displayed by SetExpressCheckout.html then constructs and
sends a SetExpressCheckout request string to the PayPal
server. The paymentType variable becomes the PAYMENTACTION
parameter of the request string. The RETURNURL parameter
is set to this file; this is how ReviewOrder.php is called
twice.

On the second pass, the code executes the else statement.

On the first pass, the buyer completed the authorization in
their PayPal account; now the code gets the payer details
by sending a GetExpressCheckoutDetails request to the PayPal
server. Then the code calls GetExpressCheckoutDetails.php.

Note: Be sure to check the value of PAYPAL_URL. The buyer is
sent to this URL to authorize payment with their PayPal
account. For testing purposes, this should be set to the
PayPal sandbox.

Called by SetExpressCheckout.html.

Calls GetExpressCheckoutDetails.php, CallerService.php,
and APIError.php.

********************************************/
	session_start();
	
	/*	
	echo "<pre>";
	print_r($_REQUEST);
	print_r($_SESSION);
	die;
	*/
	
	require_once('caller-service.php');

	/* 
	   An express checkout transaction starts with a token, that
	   identifies to PayPal your transaction
	   In this example, when the script sees a token, the script
	   knows that the buyer has already authorized payment through
	   paypal.  If no token was found, the action is to send the buyer
	   to PayPal to first authorize payment
   */

	$token = $_REQUEST['token'];

	if(!isset($token)){
		/* 
		   The servername and serverport tells PayPal where the buyer
		   should be directed back to after authorizing payment.
		   In this case, its the local webserver that is running this script
		   Using the servername and serverport, the return URL is the first
		   portion of the URL that buyers will return to after authorizing payment
	   	*/
		
	   	$serverName 		= 	$_SERVER['SERVER_NAME'];
	   	$serverPort 		= 	$_SERVER['SERVER_PORT'];
	   	$url 				= 	dirname('http://'.$serverName.':'.$serverPort.$_SERVER['REQUEST_URI']);
	   	$currencyCodeType 	= 	$_REQUEST['currencyCodeType'];
	   	$paymentType 		= 	'Sale';
	   	$personName        	= 	$_REQUEST['PERSONNAME'];
	   	$SHIPTOSTREET      	= 	$_REQUEST['SHIPTOSTREET'];
	   	$SHIPTOCITY        	= 	$_REQUEST['SHIPTOCITY'];
	   	$SHIPTOSTATE	    = 	$_REQUEST['SHIPTOSTATE'];
	   	$SHIPTOCOUNTRYCODE 	= 	$_REQUEST['SHIPTOCOUNTRYCODE'];
	   	$SHIPTOZIP         	= 	$_REQUEST['SHIPTOZIP'];
	   	$L_TOTALAMT         =  	$_REQUEST['L_TOTALAMT'];
		$productTitle 		= 	$_REQUEST['productTitle'];
		$productPrice 		= 	$_REQUEST['productPrice'];
		$productQty 		= 	$_REQUEST['quantity'];
		$strTitle = "";
		
		//if(!$_SESSION['VIPMEMBERSHIPCART']['memberType']){
			if($productTitle){
				foreach($productTitle as $PTkey=>$PTValue){
					$strTitle.= '&L_NAME'.$PTkey.'='.$PTValue;
					$strPrice.= '&L_AMT'.$PTkey.'='.$productPrice[$PTkey];
					$strQty.= 	'&L_QTY'.$PTkey.'='.$productQty[$PTkey];
				}
			}
		//}
		/* 	The returnURL is the location where buyers return when a
			payment has been succesfully authorized.
			The cancelURL is the location buyers are sent to when they hit the
			cancel button during authorization of payment during the PayPal flow
		*/

		if($_SESSION['VIPMEMBERSHIPCART']['memberType'] == 'vipMembership'){
			$returnURL =	urlencode($url.'/review-order.php?currencyCodeType='.$currencyCodeType.'&paymentType='.$paymentType);
			//$cancelURL =urlencode("$url/SetExpressCheckout.php?paymentType=$paymentType" );
			$cancelURL =	urlencode("$url/checkout/");
		}else{
			$returnURL =	urlencode($url.'/review-order.php?currencyCodeType='.$currencyCodeType.'&paymentType='.$paymentType);
			//$cancelURL =urlencode("$url/SetExpressCheckout.php?paymentType=$paymentType" );
			$cancelURL =	urlencode("$url/checkout/");
		}
		/*  Construct the parameter string that describes the PayPal payment
			the varialbes were set in the web form, and the resulting string
			is stored in $nvpstr
		*/
		/*if(!$_SESSION['VIPMEMBERSHIPCART']['memberType']){
			$flag = 0;
			foreach($_SESSION['PRODUCTCART'] as $key=>$val){
				if($val['productType'] != 'nu-chips'){
					foreach($val as $k=>$v){
						$flag = 1;
					}
				}
			}
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

		if($_SESSION['VIPMEMBERSHIPCART']['memberType'] == 'vipMembership'){
			$itemamt = 0.00;
			$itemamt = $_SESSION['VIPMEMBERSHIPCART']['vipMemberAmt'];
			$amt = $itemamt+5;
			$maxamt= $_SESSION['VIPMEMBERSHIPCART']['vipMemberAmt']+5;
			$nvpstr="";
			/** 
			Setting up the Shipping address details
			*/
			$shiptoAddress = "&SHIPTONAME=".$_SESSION['SITEUSERNAME']."&SHIPTOSTREET=$SHIPTOSTREET&SHIPTOCITY=$SHIPTOCITY&SHIPTOSTATE=$SHIPTOSTATE&SHIPTOCOUNTRYCODE=$SHIPTOCOUNTRYCODE&SHIPTOZIP=$SHIPTOZIP";
		  	$nvpstr="&ADDRESSOVERRIDE=1$shiptoAddress&L_NAME0=VIP Membership&L_AMT0=".$itemamt."&&L_QTY0=1&MAXAMT=".(string)$maxamt."&AMT=".(string)$amt."&ITEMAMT=".(string)$itemamt."&CALLBACKTIMEOUT=4&L_SHIPPINGOPTIONAMOUNT1=5.00&L_SHIPPINGOPTIONlABEL1=UPS Next Day Air&L_SHIPPINGOPTIONNAME1=UPS Air&L_SHIPPINGOPTIONISDEFAULT1=false&L_SHIPPINGOPTIONAMOUNT0=5.00&L_SHIPPINGOPTIONLABEL0=UPS Ground 7 Days&L_SHIPPINGOPTIONNAME0=Ground&L_SHIPPINGOPTIONISDEFAULT0=true&INSURANCEAMT=0.00&INSURANCEOPTIONOFFERED=false&CALLBACK=https://www.ppcallback.com/callback.pl&SHIPPINGAMT=5.00&PAYMENTREQUEST_0_SHIPPINGAMT=0.00&PAYMENTREQUEST_0_HANDLINGAMT=0.00&ReturnUrl=".$returnURL."&CANCELURL=".$cancelURL ."&CURRENCYCODE=".$currencyCodeType."&PAYMENTACTION=".$paymentType;
		}elseif($flag == 0){
			$itemamt = 0.00;
			$itemamt = $L_TOTALAMT;
			$amt = $itemamt;
			$maxamt= $amt;
			$nvpstr="";
			/** 
			Setting up the Shipping address details
			*/
			$shiptoAddress = "&SHIPTONAME=$personName&SHIPTOSTREET='1 Main St'&SHIPTOCITY='San Jose'&SHIPTOSTATE='CA'&SHIPTOCOUNTRYCODE='US'&SHIPTOZIP='95131'";
		  	$nvpstr="&ADDRESSOVERRIDE=1$shiptoAddress".$strTitle."".$strPrice."".$strQty."&MAXAMT=".(string)$maxamt."&AMT=".(string)$amt."&ITEMAMT=".(string)$itemamt."&CALLBACKTIMEOUT=4&L_SHIPPINGOPTIONAMOUNT1=0.00&L_SHIPPINGOPTIONlABEL1=UPS Next Day Air&L_SHIPPINGOPTIONNAME1=UPS Air&L_SHIPPINGOPTIONISDEFAULT1=true&L_SHIPPINGOPTIONAMOUNT0=0.00&L_SHIPPINGOPTIONLABEL0=UPS Ground 7 Days&L_SHIPPINGOPTIONNAME0=Ground&L_SHIPPINGOPTIONISDEFAULT0=false&INSURANCEAMT=0.00&INSURANCEOPTIONOFFERED=false&CALLBACK=https://www.ppcallback.com/callback.pl&SHIPPINGAMT=0.00&PAYMENTREQUEST_0_SHIPPINGAMT=5.00&PAYMENTREQUEST_0_HANDLINGAMT=0.00&ReturnUrl=".$returnURL."&CANCELURL=".$cancelURL ."&CURRENCYCODE=".$currencyCodeType."&PAYMENTACTION=".$paymentType;
		}else{
			$itemamt = 0.00;
			$itemamt = $L_TOTALAMT-5;
			$amt = $itemamt+5;
			$maxamt= $amt+5.00;
			$nvpstr="";
			/** 
			Setting up the Shipping address details
			*/
			$shiptoAddress = "&SHIPTONAME=$personName&SHIPTOSTREET=$SHIPTOSTREET&SHIPTOCITY=$SHIPTOCITY&SHIPTOSTATE=$SHIPTOSTATE&SHIPTOCOUNTRYCODE=$SHIPTOCOUNTRYCODE&SHIPTOZIP=$SHIPTOZIP";
			$nvpstr="&ADDRESSOVERRIDE=1$shiptoAddress".$strTitle."".$strPrice."".$strQty."&MAXAMT=".(string)$maxamt."&AMT=".(string)$amt."&ITEMAMT=".(string)$itemamt."&CALLBACKTIMEOUT=4&L_SHIPPINGOPTIONAMOUNT1=0.00&L_SHIPPINGOPTIONlABEL1=UPS Next Day Air&L_SHIPPINGOPTIONNAME1=UPS Air&L_SHIPPINGOPTIONISDEFAULT1=false&L_SHIPPINGOPTIONAMOUNT0=5.00&L_SHIPPINGOPTIONLABEL0=UPS Ground 7 Days&L_SHIPPINGOPTIONNAME0=Ground&L_SHIPPINGOPTIONISDEFAULT0=true&INSURANCEAMT=0.00&INSURANCEOPTIONOFFERED=false&CALLBACK=https://www.ppcallback.com/callback.pl&SHIPPINGAMT=5.00&PAYMENTREQUEST_0_SHIPPINGAMT=0.00&PAYMENTREQUEST_0_HANDLINGAMT=0.00&ReturnUrl=".$returnURL."&CANCELURL=".$cancelURL ."&CURRENCYCODE=".$currencyCodeType."&PAYMENTACTION=".$paymentType;
			
		}
		
	   	$nvpstr = $nvpHeader.$nvpstr;

	 	/* Make the call to PayPal to set the Express Checkout token
		If the API call succeded, then redirect the buyer to PayPal
		to begin to authorize payment.  If an error occured, show the
		resulting errors
		*/
 		$resArray=hash_call("SetExpressCheckout",$nvpstr);
	  	$_SESSION['reshash'] = $resArray;
	   	$ack = strtoupper($resArray["ACK"]);
		echo "<pre>";
		
	   if($ack=="SUCCESS") {
			// Redirect to paypal.com here
			$token = urldecode($resArray["TOKEN"]);
			$payPalURL = PAYPAL_URL.$token;
			//header("Location: ".$payPalURL);
			echo '<script language="javascript">location.href="'.$payPalURL.'";</script>'; exit;
	   } else {
	 		//Redirecting to APIError.php to display errors.
			$location = "APIError.php";
			//header("Location: $location");
			echo '<script language="javascript">location.href="'.$location.'";</script>'; exit;
		}
	}else {
	
		print_r( $_GET );
		print_r( $_POST );
		
		die( '--2--' );
		/* At this point, the buyer has completed in authorizing payment
		at PayPal.  The script will now call PayPal with the details
		of the authorization, incuding any shipping information of the
		buyer.  Remember, the authorization is not a completed transaction
		at this state - the buyer still needs an additional step to finalize
		the transaction
		*/
		
		$token =urlencode( $_REQUEST['token']);
		
		/* Build a second API request to PayPal, using the token as the
		ID to get the details on the payment authorization
		*/
		$nvpstr="&TOKEN=".$token;
		
		$nvpstr = $nvpHeader.$nvpstr;
		/* Make the API call and store the results in an array.  If the
		call was a success, show the authorization details, and provide
		an action to complete the payment.  If failed, show the error
		*/
		$resArray=hash_call("GetExpressCheckoutDetails",$nvpstr);
		$_SESSION['reshash']=$resArray;
		$ack = strtoupper($resArray["ACK"]);
		
		if($ack == 'SUCCESS' || $ack == 'SUCCESSWITHWARNING'){
			require_once "GetExpressCheckoutDetails.php";
		} else  {
			//Redirecting to APIError.php to display errors.
			$location = "APIError.php";

			//header("Location: $location");
			echo '<script language="javascript">location.href="'.$location.'";</script>'; exit;
		}
}
?>