<?php
function changeStatus($status=0) {		
	global $DB;
	$table  = mysql_real_escape_string($_REQUEST["TBL"]);
	$pk     = mysql_real_escape_string($_REQUEST["PK"]);
	$id     = mysql_real_escape_string($_REQUEST["id"]);
			
	$sql = "UPDATE `".$DB->pre."$table` SET status='$status' WHERE $pk IN($id)";
	if($DB->dbQuery($sql))  return true; else return false;		
}

if($_REQUEST["xAction"]) {
	session_start();
	require("../../connectdb.inc.php");
	require("settings.inc.php");
	require("common.inc.php");		
	$xAction = trim($_REQUEST["xAction"]);
	if($xAction != "xLogin"){
		if(!isAdminUser()){
			die("No cheating please."); exit;
		}
	}		
	
	switch($xAction){
		case "xLogin":				
			if(loginAdminUser($_REQUEST["userName"],$_REQUEST["userPass"])) {
				if($_REQUEST["XJSON"] == '1') {
					echo "OK";
				} else {
					$setting = getSetting("default-page");
					$redirect = "";
					if($_REQUEST["redirect"])
						$redirect = $_REQUEST["redirect"];
					else
						$redirect = $setting["default-page"]."-list/";
					header("location:".ASITEURL."/$redirect");
				}
			} else {
				echo "<p>Please login with valid username / password</p>";
			}
		break;
		
		case "trash":				
			if(changeStatus(0))
				echo "OK";
		break;
		
		case "restore":				
			if(changeStatus(1))
				echo "OK";
		break;
	}
}

/*class manageAjax {
	var $tablePre   = "";
	var $tableName  = "";
	var $whereCon   = "1";
	
	function activate() {		
		global $DB;	
		$tblNm  = $this->tablePre.$this->tableName;			
		$sql = "UPDATE `$tblNm` SET status='1' WHERE $this->whereCon";		
		if($DB->dbQuery($sql))  return true; else return false;		
	}
	
	function deactivate() {		
		global $DB;
		$tblNm  = $this->tablePre.$this->tableName;		
		$sql = "UPDATE `$tblNm` SET status='0' WHERE $this->whereCon";
		if($DB->dbQuery($sql))  return true; else return false;
	}
	
	function trash() {
		
		global $DB;		
		$tblNm  = "mx_".$this->tableName;
		$tblArc = "trash_".$this->tableName;		
		
		$sqlTbl = "CREATE TABLE IF NOT EXISTS `$tblArc` LIKE `$tblNm`";
		$DB->dbQuery($sqlTbl);
		
		$sqlArc = "INSERT INTO `$tblArc` SELECT * FROM `$tblNm` WHERE $this->whereCon";
		$sqlDel = "DELETE FROM `$tblNm` WHERE $this->whereCon";				
		
		if($DB->dbQuery($sqlArc)) {
			$DB->dbQuery($sqlDel);							
			return true;
		} else {
			return false;
		}	
	}
	
	function restore() {		
		global $DB;		
		$tblNm  = "mx_".$this->tableName;
		$tblArc = "trash_".$this->tableName;		
				
		$sqlArc = "INSERT INTO `$tblNm` SELECT * FROM `$tblArc` WHERE $this->whereCon";
		$sqlDel = "DELETE FROM `$tblArc` WHERE $this->whereCon";
		
		if($DB->dbQuery($sqlArc)) {
			$DB->dbQuery($sqlDel);							
			return true;
		} else {
			return false;
		}
	}
	
	function delete() {
		global $DB;
		$tblArc = "trash_".$this->tableName;
		$sqlDel = "DELETE FROM `$tblArc` WHERE $this->whereCon";
		
		if($DB->dbQuery($sqlDel)) return true; else return false;
	}
	
	function deleteImage() {
		global $DB;
		$tblNm  = "mx_".$this->tableName;		
		$sqlDel = "SELECT imageName FROM `$tblNm` WHERE $this->whereCon";	
		$DB->dbResult($sqlDel);
		if(!empty($DB->result)) {
			$path = ABSPATH."/uploads/".$this->tableName."/".$DB->result[0]["imageName"];
			if(deleteFile($path)) {
				$sql = "UPDATE `$tblNm` SET imageName = '' WHERE $this->whereCon";			
				if($DB->dbQuery($sql)) return true; else return false;
			}
		} else return false;
	}	
}

$xAction = trim($_GET["xAction"]);
if($xAction) {
	$PAGEINFO = array();
	
	$CHECKBFORE = array();


	$flg = 0;
	$pageUri    = sprintf("%s",mysql_real_escape_string(trim($_GET["pageUri"])));
	$mainTable  = sprintf("%s",mysql_real_escape_string(trim($_GET["tblName"])));		
	$fieldName  = sprintf("%s",mysql_real_escape_string(trim($_GET["fldName"])));
	$fieldValue = sprintf("%s",mysql_real_escape_string(trim($_GET["fldValue"])));	
				
	$parentFld  = sprintf("%s",mysql_real_escape_string(trim($_GET["parentFld"])));
	if($xAction == "trash") {
		if(!empty($CHECKBFORE[$pageUri])) {
			foreach($CHECKBFORE[$pageUri] as $table=>$where) {
				$sql = sprintf("SELECT `".$fieldName."ID` FROM $table WHERE $where",$fieldValue);			
				$DB->dbQuery($sql);
				if($DB->rowCount > 0) {
					echo "NO,".$table;
					return;
				}
			}
		}
	}
	
	$ajax = new manageAjax();
	$ajax->tablePre   = sprintf("%s",mysql_real_escape_string(trim($_GET["tblPre"])));										
			
	if($fieldValue) {
				
		if($parentFld != "") {
			$arrVal = getTreeID($ajax->tablePre.$mainTable,$fieldName."ID",$fieldValue,$parentFld);
			if(!empty($arrVal))
				$fieldValue = implode(",",$arrVal);			
		}
						
		if(!empty($PAGEINFO[$pageUri])) {
		
			foreach($PAGEINFO[$pageUri] as $table=>$where) {
				$ajax->tableName = $table;
				$ajax->whereCon  = sprintf($where,$fieldValue);				
				if(call_user_func(array($ajax, $xAction)))
					$flg++;
			}
		}			
		$ajax->tableName = $mainTable;
		$ajax->whereCon  = "`".$fieldName."ID` IN ($fieldValue)";
		if(call_user_func(array($ajax, $xAction)))
			$flg++;
				
	}
	
	if($flg == 0) echo "false"; else echo $fieldValue;
}*/
?>