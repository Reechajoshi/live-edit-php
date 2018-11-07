<?php
$MXTOTREC = 0;
$MXPGINFO["PK"] = "HTPID";
$MXPGINFO["TBL"] = "how_to_play";
function addHTP() {	
	global $DB,$TPL;
	$_POST["dateAdded"] = date("Y-m-d H:i:s");
	$DB->table = $DB->pre."how_to_play";	
	$DB->data  = $_POST;
	if($DB->dbInsert()){
		$HTPID = $DB->insertID; 								
		if($HTPID) {					
		    mxMsg("How to play added successfully.");	
			header("location:".ASITEURL."/$TPL->modName-edit/?id=$HTPID"); exit;
		}
	}
}

function updateHTP() {
	global $DB,$TPL;	
	$_POST["dateModified"] = date("Y-m-d H:i:s");	
	$HTPID = sprintf("%d",$_POST["HTPID"]);
	$DB->table = $DB->pre."how_to_play";
	$DB->data  = $_POST;
	if($DB->dbUpdate("HTPID='$HTPID'")){						
		mxMsg("How to play updated successfully.");						
		header("location:".ASITEURL."/$TPL->modName-edit/?id=$HTPID"); exit;
	}			
}

if($_REQUEST["xAction"]) {
	switch($_REQUEST["xAction"]) {
		
		case "ADD":
			if(!$VERR)
				addHTP();
		break;
		
		case "UPDATE":			
			if(!$VERR)
				updateHTP();			
		break;
	}
}
?>