<?php
session_start();

$siteUserID = $_SESSION['SITEUSERID'];
if($TPL->urlBase == "step-2"){
	if($siteUserID){header('location: '.SITEURL.'/checkout/step-1/');}
	if(!$_SESSION['totProCartCount']){ header('location: '.SITEURL.'/checkout/step-1/');}
}else if($TPL->urlBase == "step-3"){
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
	if($flag == 0){
		if(!$siteUserID){
			header('location: '.SITEURL.'/checkout/step-2/');
		}else{
			header('location: '.SITEURL.'/checkout/step-4/');
		}
		if(!$_SESSION['totProCartCount']){ header('location: '.SITEURL.'/checkout/step-1/');}
	}else{
		if(!$siteUserID){header('location: '.SITEURL.'/checkout/step-2/');}
		if(!$_SESSION['totProCartCount']){ header('location: '.SITEURL.'/checkout/step-1/');}
	}
}else if($TPL->urlBase == "step-4"){
	if(!$_SESSION['SITEUSERID']){
		header('Location: '.SITEURL.'/checkout/step-1/');
	}else if(!$_SESSION['PRODUCTCART']){
		header('Location: '.SITEURL.'/checkout/step-1/');
	}
}
function addAddr(){
	global $DB,$TPL;
	
	$userName = $_REQUEST['userName'];
	$userEmail = $_REQUEST['userEmail'];
	$userContact = $_REQUEST['userContact'];
	$userCity = $_REQUEST['userCity'];
	$userState = $_REQUEST['userState'];
	$countryID = $_REQUEST['countryID'];
	$userAddress = $_REQUEST['userAddress'];
	
	$DB->table = $DB->pre."site_user";
	$DB->data = array("userName"=>$userName,'userEmail'=>$userEmail,'userContact'=>$userContact,'userCity'=>$userCity,'userState'=>$userState,'countryID'=>$countryID,'userAddress'=>$userAddress);
	if($DB->dbInsert()){
		$siteUserID = $DB->insertID;
		if($siteUserID) {
		    $DB->table = $DB->pre."billing_address";
			$DB->data = array('siteUserID'=>$siteUserID,'userContact'=>$userContact,'userCity'=>$userCity,'userState'=>$userState,'countryID'=>$countryID,'billingAddress'=>$userAddress);
			if($DB->dbInsert()){
				$DB->table = $DB->pre."shipping_address";
				$DB->data = array('siteUserID'=>$siteUserID,'userContact'=>$userContact,'userCity'=>$userCity,'userState'=>$userState,'countryID'=>$countryID,'shipping_address'=>$userAddress);
				$DB->dbInsert();
				$str = 'OK'; 
			}
		}
	}
	echo $str;
}

function addBillingAddr(){
	global $DB,$TPL;
	
	$DB->table = $DB->pre."billing_address";
	$_REQUEST['siteUserID'] = $_REQUEST['SITEUSERID'];
	$DB->data = $_REQUEST;
	if($DB->dbInsert()){
		$str = 'OK'; 
	}
	return $str;
}

function addShippingAddr(){
	global $DB,$TPL;
	$_REQUEST['SITEUSERID'] = $_REQUEST['SITEUSERID'];
	$DB->table = $DB->pre."shipping_address";
	$DB->data = $_REQUEST;
	$DB->dbInsert();
	$str = shippingAddresList();
	return $str;
}

function updateShippingAddr(){
	global $DB,$TPL;
	$_REQUEST['SITEUSERID'] = $_REQUEST['SITEUSERID'];
	$DB->table = $DB->pre."shipping_address";
	$DB->data = $_REQUEST;
	$DB->dbUpdate("shippingAddressID='".$_REQUEST['shippingAddressID']."'");
	$str = shippingAddresList();
	return $str;
}

function shippingAddresList(){
	global $DB;
	$srt = "";
	echo $siteUserID;
	$sql = "SELECT U.userName,S.*,C.countryName FROM ".$DB->pre."shipping_address AS S LEFT JOIN ".$DB->pre."site_user AS U ON (S.siteUserID=U.siteUserID) LEFT JOIN ".$DB->pre."country AS C ON(S.countryID=C.countryID) WHERE S.userFirstName != '' AND S.userLastName != '' AND S.userCity != '' AND S.userContact != '' AND S.userState != '' AND C.countryName != '' AND S.shippingAddress != '' AND S.userZip != '' AND S.siteUserID = ".$_SESSION['SITEUSERID']." ORDER BY S.shippingAddressID DESC";
	$res = $DB->dbRows($sql);
	if($DB->numRows > 0){
		foreach($res as $d){
			$str.='
			<input type="radio" id="'.$d['shippingAddressID'].'" class="checkShipping" name="chckSihpAdd" value="'.$d['shippingAddressID'].'" />
			<a href="#" rel="'.$d['shippingAddressID'].'" class="aShippingAddress" id="shipping'.$d['shippingAddressID'].'">
				<span class="editAdd" shiprel="'.$d['shippingAddressID'].'">Edit</span>
				<span class="deleteAdd" style="float:right; display:none;" shipdelid="'.$d['shippingAddressID'].'">Delete</span>
				Full Name: '.$d['userFirstName'].' '.$d['userLastName'].'<br />
				Contact No: '.$d['userContact'].'<br />
				City: '.$d['userCity'].'<br />
				State: '.$d['userState'].'<br />
				Country: '.$d['countryName'].'<br />
				Address: '.$d['shippingAddress'].'<br />
				Zip Code: '.$d['userZip'].'
			</a>';
		}
	}else{
		$str ='<p class="noFound">No Address Found<br />Please Enter New Address</p>';
	}	
	return $str;
}

function addCartDetails(){
	session_start();
	global $DB,$TPL;
	
	$_SESSION['shipID'] = $_REQUEST['shippingAddressID'];
	$shippingAddressID = $_REQUEST['shippingAddressID'];
	$siteUserID = $_SESSION['SITEUSERID'];
	
	$_SESSION['cartDetails'][$siteUserID] = array('siteUserID'=>$siteUserID,'shippingAddressID'=>$shippingAddressID);
	
	if(isset($_SESSION['cartDetails'])){
		$str = 'OK';
	}else{
		$str = 'ERR';
	}
	return $str;
}

function editShippingAdd(){
	global $DB;
	$str = "";
	$shipAddressID = intval($_REQUEST['shippingAddressID']);
	
	$sql = "SELECT * FROM ".$DB->pre."shipping_address WHERE shippingAddressID = ".$shipAddressID." AND siteUserID = '".$_SESSION['SITEUSERID']."'";
	$DB->dbRow($sql);	
	if($DB->numRows > 0) {
		$str = json_encode($DB->row);
	}else{
		$str = "ERR"; 	
	}
	return $str;
}

function deleteShippingAdd(){
	global $DB;
	$str = "";
	$shipAddressID = intval($_REQUEST['shippingAddressID']);
	$sql = "DELETE FROM ".$DB->pre."shipping_address WHERE shippingAddressID = ".$shipAddressID." AND siteUserID = '".$_SESSION['SITEUSERID']."'";
	if($DB->dbQuery($sql)){
		$str = shippingAddresList();
	}else{
		$str = "ERR";	
	}
	return $str; 
}

if($_REQUEST["xAction"]){
	switch($_REQUEST["xAction"]){
		case "addAddr":
			include("../../connectdb.inc.php");
			echo addAddr();
		break;
		
		case "addBillingAddr":
			include("../../connectdb.inc.php");
			echo addBillingAddr();
		break;
		
		case "addShippingAddr":
			include("../../connectdb.inc.php");
			echo addShippingAddr();
		break;
		
		case "updateShippingAddr":
			include("../../connectdb.inc.php");
			echo updateShippingAddr();
		break;
				
		case "addCartDetails":
			include("../../connectdb.inc.php");
			echo addCartDetails();
		break;
		
		case "shippingAddresList":
			include("../../connectdb.inc.php");
			echo shippingAddresList();
		break;
		
		case "editShippingAdd":
			include("../../connectdb.inc.php");
			echo editShippingAdd();
		break;
		
		case "deleteShippingAdd":
			include("../../connectdb.inc.php");
			echo deleteShippingAdd();
		break;
	}
}
?>