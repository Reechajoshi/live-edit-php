<?php
$MXTOTREC = 0;
$MXPGINFO["PK"] = "gameTipID";
$MXPGINFO["TBL"] = "game_tips";

function addGameTip() {	
	global $DB,$TPL;
	$_POST["gameTipImage"] = uploadFile("gameTipImage");
	$_POST["dateAdded"] = date("Y-m-d H:i:s");
	$_POST["gameTipText"] = addslashes( $_POST["gameTipText"] );
	$DB->table = $DB->pre."game_tips";	
	$DB->data  = $_POST;
	if($DB->dbInsert()){
		$gameTipID = $DB->insertID; 								
		if($productID) {					
		    mxMsg("Game Tips added successfully.");	
			header("location:".ASITEURL."/$TPL->modName-edit/?id=$gameTipID"); exit;
		}
	}
}

function updateGameTip() {
	global $DB,$TPL;	
	$_POST["gameTipImage"] = uploadFile("gameTipImage");
	$_POST["dateModified"] = date("Y-m-d H:i:s");
	$_POST["gameTipText"] = addslashes( $_POST["gameTipText"] );
	$gameTipID = sprintf("%d",$_POST["gameTipID"]);
	$DB->table = $DB->pre."game_tips";
	$DB->data  = $_POST;
	if($DB->dbUpdate("gameTipID='$gameTipID'")){						
		mxMsg("Game Tip updated successfully.");						
		header("location:".ASITEURL."/$TPL->modName-edit/?id=$gameTipID"); exit;
	}			
}

if($_REQUEST["xAction"]) {
	switch($_REQUEST["xAction"]) {
		
		case "ADD":
			if(!$VERR)
				addGameTip();
		break;
		
		case "UPDATE":			
			if(!$VERR)
				updateGameTip();			
		break;
	}
}
?>