<?php
$MXTOTREC = 0;
$MXPGINFO["PK"] = "userID";
$MXPGINFO["TBL"] = "admin_user";
function addUser() {	
	global $DB,$TPL;
	$_POST["imageName"] = uploadFile("imageName");	
	$_POST["dateAdded"] = date("Y-m-d H:i:s");	
	$_POST["userPass"]  = md5($_POST["userPass"]);
	$DB->table = $DB->pre."admin_user";	
	$DB->data  = $_POST;
	if($DB->dbInsert()){
		$userID = $DB->insertID; 								
		if($userID) {					
		    mxMsg("User added successfully.");	
			header("location:".ASITEURL."/$TPL->modName-edit/?id=$userID"); exit;
		}
	}
}

function updateUser() {
	global $DB,$TPL;	
	$_POST["imageName"] = uploadFile("imageName");		
	$_POST["dateModified"] = date("Y-m-d H:i:s");
	if($_POST["userPass"])
		$_POST["userPass"]  = md5($_POST["userPass"]);
	else
		unset($_POST["userPass"]);		
	$userID    = sprintf("%d",$_POST["userID"]);
	$DB->table = $DB->pre."admin_user";
	$DB->data  = $_POST;
	if($DB->dbUpdate("userID='$userID'")){						
		mxMsg("User updated successfully.");						
		header("location:".ASITEURL."/$TPL->modName-edit/?id=$userID"); exit;
	}			
}
if($_REQUEST["xAction"]) {
	
	switch($_REQUEST["xAction"]) {		
		case "ADD":
			if(!$VERR)
				addUser();
		break;
		
		case "UPDATE":			
			if(!$VERR)
				updateUser();			
		break;
	}
}
?>