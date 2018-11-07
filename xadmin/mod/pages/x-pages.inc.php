<?php
	$MXTOTREC = 0;
	$MXPGINFO["PK"] = "pid";
	$MXPGINFO["TBL"] = "pages";
	
	function addPage() {	
		global $DB,$TPL;
		
		$_POST["phtml"] = cleanHtml($_POST["phtml"]);
		$_POST["pid"] = getunqid( $_POST["pname"] );
		
		$DB->table = $DB->pre."pages";		
		$DB->data  = $_POST;
		if($DB->dbInsert()){
			$pageID = $_POST["pid"]; 								
			if($pageID) {
				//resetSeoUri($pageID);					
			    mxMsg("Page added successfully.");	
				header("location:".ASITEURL."/$TPL->modName-edit/?id=$pageID"); exit;
			}
		}
	}
	
	function updatePage() {
		global $DB,$TPL;
		$_POST["phtml"] = cleanHtml($_POST["phtml"]);
			
		$pageID    = $_GET["id"];
		$DB->table = $DB->pre."pages";	
		$DB->data  = $_POST;
		if($DB->dbUpdate("pid='$pageID'")){
			//resetSeoUri($pageID);						
			mxMsg("Page updated successfully.");						
			header("location:".ASITEURL."/$TPL->modName-edit/?id=$pageID"); exit;
		}			
	}
	
	if($_POST["xAction"]) {
		switch($_POST["xAction"]) {
			
			case "ADD":
				if(!$VERR)
					addPage();
			break;
			
			case "UPDATE":			
				if(!$VERR)
					updatePage();			
			break;
		}
	}
	
?>