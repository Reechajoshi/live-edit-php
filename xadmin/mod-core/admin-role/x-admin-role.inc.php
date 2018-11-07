<?php
$MXPGINFO["TBL"] = "admin_role"; $MXPGINFO["PK"] = "roleAID"; $MXTOTREC = 0;
function getAccess($roleAID=0) {
	$arr = array(); global $DB;
	if($roleAID) {			
		$S = $DB->dbRows("SELECT * FROM `".$DB->pre."admin_user_access` WHERE roleAID='$roleAID'");
		foreach($S as $v)
			$arr[$v["adminMenuID"]] = json_decode($v["accessType"]);
	}
	return $arr;
}
function addUserAccess($roleAID=0) {
	global $DB;			
	if($_POST["access"]) {
		//ALTER TABLE XYZ AUTO_INCREMENT =
		$DB->table = $DB->pre."admin_user_access";
		foreach($_POST["access"] as $adminMenuID=>$v) {
			if($v) {
				$DB->data  = array("roleAID" =>$roleAID, "adminMenuID" =>$adminMenuID, "accessType" =>json_encode($v));				
				$DB->dbInsert();
			}		
		}																		
	}
}

function addAdminRole() {	
	global $DB,$TPL;
	resetAutoIncreament($DB->pre."admin_role","roleAID");				
	$DB->table = $DB->pre."admin_role";
	$DB->data  = array("roleName" => $_POST["roleName"],"status" => '1');
	if($DB->dbInsert()){
		$roleAID = $DB->insertID; 		
		mxMsg("Admin roleAdmin role added successfully.");				
		if($roleAID) {			
			addUserAccess($roleAID);
			header("location:".ASITEURL."/$TPL->modName-edit/?id=$roleAID"); exit;
		}
	}
}

function updateAdminRole() {
	global $DB,$TPL;
	resetAutoIncreament($DB->pre."admin_role","roleAID");
	$roleAID = intval($_POST["roleAID"]); 
	$DB->table = $DB->pre."admin_role";
	$DB->data  = array("roleName" => $_POST["roleName"],"status" => '1');
	if($DB->dbUpdate("roleAID='$roleAID'")){				
		mxMsg("Admin role updated successfully.");				
		if($roleAID) {			
			$DB->dbQuery("DELETE FROM `".$DB->pre."admin_user_access` WHERE roleAID='$roleAID'");						
			addUserAccess($roleAID);
			header("location:".ASITEURL."/$TPL->modName-edit/?id=$roleAID"); exit;
		}
	}			
}

if($_REQUEST["xAction"]) {
	switch($_REQUEST["xAction"]) {
		
		case "ADD":
			if(!$VERR)
				addAdminRole();
		break;
		
		case "UPDATE":			
			if(!$VERR)
				updateAdminRole();			
		break;
	}
}
?>