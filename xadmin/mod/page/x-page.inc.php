<?php
	$MXTOTREC = 0;
	$MXPGINFO["PK"] = "pageID";
	$MXPGINFO["TBL"] = "page";
	
	function addPage() {	
		global $DB,$TPL;
		$_POST["seoUri"] = makeSeoUri($_POST["pageTitle"]);
		$_POST["dateAdded"] = date("Y-m-d H:i:s");	
		$_POST["pageImage"] = uploadFile("pageImage");
		$_POST["pageTitle"] = cleanTitle($_POST["pageTitle"]);
		$_POST["synopsis"] = addslashes($_POST["synopsis"]);
		$_POST["pageContent"] = cleanHtml($_POST["pageContent"]);
		
		$DB->table = $DB->pre."page";		
		$DB->data  = $_POST;
		if($DB->dbInsert()){
			$pageID = $DB->insertID; 								
			if($pageID) {
				//resetSeoUri($pageID);					
			    mxMsg("Page added successfully.");	
				header("location:".ASITEURL."/$TPL->modName-edit/?id=$pageID"); exit;
			}
		}
	}
	
	function updatePage() {
		global $DB,$TPL;
		$_POST["seoUri"] = makeSeoUri($_POST["pageTitle"]);		
		$_POST["dateModified"] = date("Y-m-d H:i:s");
		$_POST["pageImage"] = uploadFile("pageImage");
		$_POST["pageTitle"] = cleanTitle($_POST["pageTitle"]);
		$_POST["synopsis"] = addslashes($_POST["synopsis"]);
		$_POST["pageContent"] = cleanHtml($_POST["pageContent"]);
			
		$pageID    = sprintf("%d",$_POST["pageID"]);
		$DB->table = $DB->pre."page";	
		$DB->data  = $_POST;
		if($DB->dbUpdate("pageID='$pageID'")){
			//resetSeoUri($pageID);						
			mxMsg("Page updated successfully.");						
			header("location:".ASITEURL."/$TPL->modName-edit/?id=$pageID"); exit;
		}			
	}
	
	if($_REQUEST["xAction"]) {
		switch($_REQUEST["xAction"]) {
			
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