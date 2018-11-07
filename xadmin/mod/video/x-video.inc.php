<?php
$MXTOTREC = 0;
$MXPGINFO["PK"] = "videoID";
$MXPGINFO["TBL"] = "video";
function addVideo() {	
	global $DB,$TPL;
	$_POST["videoImage"] = uploadFile("videoImage");
	$_POST["dateAdded"] = date("Y-m-d H:i:s");
	error_log( " VIdeo Post Value: ".print_r( $_POST, true ) );
	$DB->table = $DB->pre."video";	
	$DB->data  = $_POST;
	if($DB->dbInsert()){
		$videoID = $DB->insertID; 								
		if($videoID) {					
		    mxMsg("Video added successfully.");	
			header("location:".ASITEURL."/$TPL->modName-edit/?id=$videoID"); exit;
		}
	}
}

function updateVideo() {
	global $DB,$TPL;	
	$_POST["videoImage"] = uploadFile("videoImage");
	$_POST["dateModified"] = date("Y-m-d H:i:s");	
	$videoID = sprintf("%d",$_POST["videoID"]);
	$DB->table = $DB->pre."video";
	$DB->data  = $_POST;
	if($DB->dbUpdate("videoID='$videoID'")){						
		mxMsg("Video updated successfully.");						
		header("location:".ASITEURL."/$TPL->modName-edit/?id=$videoID"); exit;
	}			
}

if($_REQUEST["xAction"]) {
	switch($_REQUEST["xAction"]) {
		
		case "ADD":
			if(!$VERR)
				addVideo();
		break;
		
		case "UPDATE":			
			if(!$VERR)
				updateVideo();			
		break;
	}
}
?>