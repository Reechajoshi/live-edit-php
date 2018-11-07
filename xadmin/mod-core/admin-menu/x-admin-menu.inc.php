<?php
function getFModules($mPath = "") {
	global $menuPath;
	$mDir = dir($mPath);
	while (false !== ($m = $mDir->read())) {
		if(is_dir($mPath."/".$m) && $m != "." && $m != "..") {
		    $menuArr[]=$m;
			$menuPath[$m]=str_replace(AABSPATH,"",$mPath."/".$m); 
		    $tmp=getFModules($mPath."/".$m);
		  	if(!empty($tmp)) {$menuArr[sizeof($menuArr)-1]=array($m=>$tmp);}
		 }
	}
	$mDir->close();
	if(empty($menuArr)) return false; else return $menuArr;
}

function recreateAdminMenu() {
	global $DB;
	$arrFModules = getFModules(AABSPATH."/mod");
	if($arrFModules){
		$seoUri = "'".implode("','",$arrFModules)."'";
		$sql = "DELETE FROM mx_admin_user_access WHERE adminMenuID IN(SELECT DISTINCT(adminMenuID) FROM mx_admin_menu WHERE seoUri NOT IN($seoUri))";
		$DB->dbQuery($sql);
		$sql = "DELETE FROM mx_admin_menu WHERE seoUri NOT IN($seoUri) AND menuType='0'";
		$DB->dbQuery($sql);
		
		$DB->dbRows("SELECT DISTINCT(parentID) AS parentID FROM mx_admin_menu WHERE menuType='0'");
		if($DB->numRows > 0){
			$arrPID = array();
			foreach($DB->rows as $d){
				$arrPID[] = $d["parentID"];
			}
			if($arrPID){
				$sql = "DELETE FROM mx_admin_menu WHERE menuType='1' AND adminMenuID NOT IN(".implode(",",$arrPID).")";
				$DB->dbQuery($sql);
			}
		}
		//$DB->dbQuery("ALTER TABLE mx_admin_menu AUTO_INCREMENT = (SELECT MAX(adminMenuID) FROM mx_admin_menu )+1");
		$arrAModules = getDataArray("mx_admin_menu", "adminMenuID", "seoUri", "seoUri IN ($seoUri)");		
		if($arrAModules){
			$arrInsert = array_diff($arrAModules,$arrFModules);
			if(!$arrInsert)
				$arrInsert = array_diff($arrFModules,$arrAModules);									
		} else {
			$arrInsert =$arrFModules;
		}
		
		if($arrInsert) {
			resetAutoIncreament($DB->pre."admin_menu","adminMenuID");
			foreach($arrInsert as $m){
				$DB->data  = array("menuType"=>"0","menuTitle"=>ucfirst(str_replace("-"," ",$m)) ,"parentID"=>"0","seoUri"=>"$m","status"=>"1"); 
				$DB->table = $DB->pre."admin_menu";
				$DB->dbInsert();
			}
		}
	}
}

//==================================================================================
$MXTOTREC = 0;
$MXPGINFO["PK"]  = "adminMenuID"; $MXPGINFO["TBL"] =  "admin_menu";

function addAdminMenu() {	
	global $DB,$TPL;
	resetAutoIncreament($DB->pre."admin_menu","adminMenuID");
	$_POST["status"] = 1; $_POST["menuType"] = 1;	
	$DB->table = $DB->pre."admin_menu";
	$DB->data  = $_POST;
	if($DB->dbInsert()){
		$adminMenuID = $DB->insertID; 								
		if($adminMenuID) {
			mxMsg("Menu added successfully.");	
			header("location:".ASITEURL."/$TPL->modName-edit/?id=$adminMenuID"); exit;
		}
	}
}

function updateAdminMenu() {
	global $DB,$TPL;
	resetAutoIncreament($DB->pre."admin_menu","adminMenuID");
	$adminMenuID = sprintf("%d",$_POST["adminMenuID"]); 
	$DB->table = $DB->pre."admin_menu";
	$DB->data  = $_POST;
	if($DB->dbUpdate("adminMenuID='$adminMenuID'")){				
		mxMsg("Menu updated successfully.");							
		header("location:".ASITEURL."/$TPL->modName-edit/?id=$adminMenuID"); exit;
	}			
}

if($_REQUEST["xAction"]) {
	switch($_REQUEST["xAction"]) {		
		case "ADD":
			if(!$VERR)
				addAdminMenu();
		break;
		
		case "UPDATE":			
			if(!$VERR)
				updateAdminMenu();
		break;
		
		case "recreateAdminMenu":
				include("../../../connectdb.inc.php");			
				recreateAdminMenu();
		break;
	}
}
?>