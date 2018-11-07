<?php
$MXTOTREC = 0;
$MXPGINFO["PK"] = "productID";
$MXPGINFO["TBL"] = "product";
function addProduct() {	
	global $DB,$TPL;
	$_POST["productImg1"] = uploadFile("productImg1");
	$_POST["productImg2"] = uploadFile("productImg2");
	$_POST["productImg3"] = uploadFile("productImg3");
	$_POST["productImg4"] = uploadFile("productImg4");	
	$_POST["dateAdded"] = date("Y-m-d H:i:s");
	$_POST["seoUri"] = makeSeoUri($_POST["productTitle"]);
	$_POST["synopsis"] = addslashes( $_POST["synopsis"] );
	$DB->table = $DB->pre."product";	
	$DB->data  = $_POST;
	if($DB->dbInsert()){
		$productID = $DB->insertID; 								
		if($productID) {					
		    mxMsg("Product added successfully.");	
			header("location:".ASITEURL."/$TPL->modName-edit/?id=$productID"); exit;
		}
	}
}

function updateProduct() {
	global $DB,$TPL;	
	$_POST["productImg1"] = uploadFile("productImg1");
	$_POST["productImg2"] = uploadFile("productImg2");
	$_POST["productImg3"] = uploadFile("productImg3");
	$_POST["productImg4"] = uploadFile("productImg4");	
	$_POST["dateModified"] = date("Y-m-d H:i:s");
    $_POST["seoUri"] = makeSeoUri($_POST["productTitle"]);	
	$_POST["synopsis"] = addslashes( $_POST["synopsis"] );
	$productID = sprintf("%d",$_POST["productID"]);
	$DB->table = $DB->pre."product";
	$DB->data  = $_POST;
	if($DB->dbUpdate("productID='$productID'")){						
		mxMsg("Product updated successfully.");						
		header("location:".ASITEURL."/$TPL->modName-edit/?id=$productID"); exit;
	}			
}

if($_REQUEST["xAction"]) {
	switch($_REQUEST["xAction"]) {
		
		case "ADD":
			if(!$VERR)
				addProduct();
		break;
		
		case "UPDATE":			
			if(!$VERR)
				updateProduct();			
		break;
	}
}
?>