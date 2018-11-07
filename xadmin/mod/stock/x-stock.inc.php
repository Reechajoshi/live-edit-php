<?php
$MXTOTREC = 0;
$MXPGINFO["PK"] = "stockID";
$MXPGINFO["TBL"] = "stock";
function addStock() {	
	global $DB,$TPL;
	$_POST["dateAdded"] = date("Y-m-d H:i:s");
	$DB->table = $DB->pre."stock";	
	$DB->data  = $_POST;
	if($DB->dbInsert()){
		$stockID = $DB->insertID;							
		if($stockID) {
			echo addQty();  
		    mxMsg("Stock added successfully.");	
			header("location:".ASITEURL."/$TPL->modName-edit/?id=$stockID"); exit;
		}
	}
}
function addQty(){
	include("../../../connectdb.inc.php");
	global $DB,$TPL;
	$productID = $_POST['productID'];
	$totQty = $_POST['qty'];
	$size = $_POST['size'];

   	$DB->table = $DB->pre."qty";
   	$DB->data = array("productID"=>$productID,'soldQty'=>0,'size'=>$size,'totQty'=>$totQty);
   	$DB->dbInsert();	
}

function updateStock() {
	global $DB,$TPL;	
	$_POST["dateModified"] = date("Y-m-d H:i:s");	
	$stockID = sprintf("%d",$_POST["stockID"]);
	$DB->table = $DB->pre."stock";
	$DB->data  = $_POST;
	if($DB->dbUpdate("stockID='$stockID'")){
		echo updateQty();			
		mxMsg("Stock updated successfully.");
		header("location:".ASITEURL."/$TPL->modName-edit/?id=$stockID"); exit;
	}			
}

function updateQty(){
	global $DB,$TPL;
	$productID = intval($_REQUEST['productID']);
	$size = $_REQUEST['size'];
	$totQty = $_REQUEST['qty'];

   	$sql = "UPDATE ".$DB->pre."qty SET totQty = '$totQty'  WHERE productID='$productID' AND size = '$size'";
	$DB->dbQuery($sql);
}

function getProduct(){
	$str = "";
	global $DB,$TPL;
	$categoryID = intval($_REQUEST["categoryID"]);
	if($categoryID){
		global $DB;
		$str = '<option value="">Select Product</option>'.getTableDD($DB->pre."product","productID","productTitle",""," categoryID='".$categoryID."' AND status=1");
	}
	return $str;
}



/*function addQty(){
	include("../../../connectdb.inc.php");
	global $DB,$TPL;
	$sql = "SELECT totQty,size FROM `mx_qty` WHERE productID=".$_POST['productID'].""; 
	$Data=$DB->dbRow($sql);
	$MXTOTREC = $DB->numRows;
	
	$productID = $_POST['productID'];
	$totQty = $_POST['qty'];
	$size = $_POST['size'];
	
	if($MXTOTREC > 0 && $Data['size']==$size){
		$totQty1 = $Data['totQty']+$totQty;
		$DB->table = $DB->pre."qty";
		$DB->data = array('totQty'=>$totQty1);
		$DB->dbUpdate("productID='$productID' and size='$size'");			 
	}else{
	   $DB->table = $DB->pre."qty";
	   $DB->data = array("productID"=>$productID,'soldQty'=>0,'size'=>$size,'totQty'=>$totQty);
	   $DB->dbInsert();	
	}	
}
*/
if($_REQUEST["xAction"]) {
	switch($_REQUEST["xAction"]) {
		
		case "ADD":
			if(!$VERR)
				addStock();
		break;
		
		case "UPDATE":			
			if(!$VERR)
				updateStock();			
		break;
		case "getProduct":	
			include("../../../connectdb.inc.php");		
			echo getProduct();			
		break;
	}
}
?>