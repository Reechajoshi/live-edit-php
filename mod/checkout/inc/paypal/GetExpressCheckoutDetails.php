<?php
session_start();
/********************************************************
GetExpressCheckoutDetails.php

This functionality is called after the buyer returns from
PayPal and has authorized the payment.

Displays the payer details returned by the
GetExpressCheckoutDetails response and calls
DoExpressCheckoutPayment.php to complete the payment
authorization.

Called by ReviewOrder.php.

Calls DoExpressCheckoutPayment.php and APIError.php.

********************************************************/

/* Collect the necessary information to complete the
   authorization for the PayPal payment
   */
$_SESSION['token'] = $_REQUEST['token'];
$_SESSION['payer_id'] = $_REQUEST['PayerID'];

$_SESSION['paymentAmount'] = $_REQUEST['paymentAmount'];
$_SESSION['currCodeType'] = $_REQUEST['currencyCodeType'];
$_SESSION['paymentType'] = $_REQUEST['paymentType'];

$resArray=$_SESSION['reshash'];


$_SESSION['TotalAmount']= $resArray['AMT'] + $resArray['SHIPDISCAMT'];

header("location:DoExpressCheckoutPayment.php");

