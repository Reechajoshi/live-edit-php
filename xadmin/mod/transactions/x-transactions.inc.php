<?php
	$MXTOTREC = 0;
	$MXPGINFO["PK"][ 0 ] = "tid";
	$MXPGINFO["PK"][ 1 ] = "tuserName";
	$MXPGINFO["TBL"] = "trans";
	
	function addEmail() {	
		global $DB,$TPL;
		
		$_POST["ehtml"] = cleanHtml($_POST["ehtml"]);
		$_POST["eid"] = getunqid( $_POST["ename"] );
		
		$DB->table = $DB->pre."emails";		
		$DB->data  = $_POST;
		if($DB->dbInsert()){
			$pageID = $_POST["eid"]; 								
			if($pageID) {
				//resetSeoUri($pageID);					
			    mxMsg("Email added successfully.");	
				header("location:".ASITEURL."/$TPL->modName-edit/?id=$pageID"); exit;
			}
		}
	}
	
	function updateEmail() {
		global $DB,$TPL;
		$_POST["ehtml"] = cleanHtml($_POST["ehtml"]);
			
		$pageID    = $_GET["id"];
		$DB->table = $DB->pre."emails";	
		$DB->data  = $_POST;
		if($DB->dbUpdate("eid='$pageID'")){
			//resetSeoUri($pageID);						
			mxMsg("Emails updated successfully.");						
			header("location:".ASITEURL."/$TPL->modName-edit/?id=$pageID"); exit;
		}			
	}
	
	if($_POST["xAction"]) {
		switch($_POST["xAction"]) {
			
			case "ADD":
				if(!$VERR)
					addEmail();
			break;
			
			case "UPDATE":			
				if(!$VERR)
					updateEmail();			
			break;
		}
	}
	
?>