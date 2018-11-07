<?php
	$MXTOTREC = 0;
	$MXPGINFO["PK"] = "bid";
	$MXPGINFO["TBL"] = "banner";
	
	function addBanner() {	
		global $DB,$TPL;
		
		$_POST["bid"] = getunqid( $_POST["bname"] );
		$_POST["bim1"] = uploadFile("bim1");
		$_POST["bim2"] = uploadFile("bim2");
		$_POST["bim3"] = uploadFile("bim3");
		
		$DB->table = $DB->pre."banner";		
		$DB->data  = $_POST;
		if($DB->dbInsert()){
			$pageID = $_POST["bid"]; 								
			if($pageID) {
				//resetSeoUri($pageID);					
			    mxMsg("Banner added successfully.");	
				header("location:".ASITEURL."/$TPL->modName-edit/?id=$pageID"); exit;
			}
		}
	}
	
	function updateBanner() {
		global $DB,$TPL;
			
		$pageID    = $_GET["id"];
		$_POST["bim1"] = uploadFile("bim1");
		$_POST["bim2"] = uploadFile("bim2");
		$_POST["bim3"] = uploadFile("bim3");
		
		$DB->table = $DB->pre."banner";	
		$DB->data  = $_POST;
		if($DB->dbUpdate("bid='$pageID'")){
			//resetSeoUri($pageID);						
			mxMsg("Banner updated successfully.");						
			header("location:".ASITEURL."/$TPL->modName-edit/?id=$pageID"); exit;
		}			
	}
	
	if($_POST["xAction"]) {
		switch($_POST["xAction"]) {
			
			case "ADD":
				if(!$VERR)
					addBanner();
			break;
			
			case "UPDATE":			
				if(!$VERR)
					updateBanner();			
			break;
		}
	}
	
?>