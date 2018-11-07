<?php

$MXTOTREC = 0;
$MXPGINFO["PK"] = "buttonId";
$MXPGINFO["TBL"] = "buttons";

function updateError()
{
	global $DB, $TPL;
	
	$buttonID = $_POST[ "buttonId" ];
	$category = $_POST[ "button_category" ];
	
	$DB->table = $DB->pre."buttons";
	$DB->data = $_POST;
	
	if($DB->dbUpdate(" buttonId = '$buttonID' and category = '$category'")){	
		mxMsg("Button updated successfully.");						
		// header("location:".ASITEURL."/$TPL->modName-edit/?id=$pageID"); exit;
	};
	
}

if($_POST["xAction"]) {
		switch($_POST["xAction"]) {
			
			case "UPDATE":			
				if(!$VERR)
					updateError();			
			break;
		}
	}
?>