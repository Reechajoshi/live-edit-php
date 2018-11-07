<?php
$MXTOTREC = 0;
$MXPGINFO["PK"] = "gameID";
$MXPGINFO["TBL"] = "game";
set_time_limit(0);
function addGame() {	
	global $DB,$TPL;
	$_POST["gameTipImage"] = uploadFile("gameTipImage");
	$_POST["imageName"] = uploadFile("imageName");
	$_POST["gameTitleImage"] = uploadFile( "gameTitleImage" );
	$_POST["gameFile"] = uploadCustomFile("gameFile");
	$_POST["xmlFile"] = uploadCustomFile("xmlFile");
	
	$_POST["dateAdded"] = date("Y-m-d H:i:s");
	$_POST["seoUri"] = makeSeoUri($_POST["gameTitle"]);
	$DB->table = $DB->pre."game";	
	$DB->data  = $_POST;
	if($DB->dbInsert()){
		$gameID = $DB->insertID; 								
		if($gameID) {					
		    mxMsg("Game added successfully.");	
			header("location:".ASITEURL."/$TPL->modName-edit/?id=$gameID"); exit;
		}
	}
}

function updateGame() {
	global $DB,$TPL;	
	$_POST["gameTipImage"] = uploadFile("gameTipImage");	
	$_POST["imageName"] = uploadFile("imageName");
	$_POST["gameTitleImage"] = uploadFile( "gameTitleImage" );
	$_POST["gameFile"] = uploadCustomFile("gameFile");
	$_POST["xmlFile"] = uploadCustomFile("xmlFile");	
	
	$_POST["dateModified"] = date("Y-m-d H:i:s");	
	$_POST["seoUri"] = makeSeoUri($_POST["gameTitle"]);
	$gameID = sprintf("%d",$_POST["gameID"]);
	$DB->table = $DB->pre."game";
	$DB->data  = $_POST;
	if($DB->dbUpdate("gameID='$gameID'")){						
		mxMsg("Game updated successfully.");						
		header("location:".ASITEURL."/$TPL->modName-edit/?id=$gameID"); exit;
	}			
}

function uploadCustomFile($fldName,$uploadTo=""){
	global 	$MXPGINFO;
	$file = $_FILES[$fldName];
	
	if(!$uploadTo)
		$uploadTo = "uploads/".$MXPGINFO["TBL"];
	
	$oldFile = $_REQUEST[$fldName."O"];
	
	if($file['name']!="") {				
		if($file["error"] == 0) {
			set_time_limit(0);										
			if(!file_exists(ABSPATH."/".$uploadTo)){ mkdir(ABSPATH."/".$uploadTo,0777);	}								
			$fileName = $file['name'];		
			if(copy($file["tmp_name"],ABSPATH."/".$uploadTo."/".$fileName)){								 	 				
				if($oldFile) { deleteFile(ABSPATH."/".$uploadTo."/". $oldFile); }
			}  else {
				$fileName = "";
			}
		} 
	} else {
		$fileName = $oldFile;
	}
	return $fileName;
}

if($_REQUEST["xAction"]) {
	switch($_REQUEST["xAction"]) {
		
		case "ADD":
			if(!$VERR)
				addGame();
		break;
		
		case "UPDATE":			
			if(!$VERR)
				updateGame();			
		break;
	}
}
?>