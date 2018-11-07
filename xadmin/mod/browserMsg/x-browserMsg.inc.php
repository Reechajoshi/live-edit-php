<?php

$MXTOTREC = 0;
$MXPGINFO["PK"] = "browser_name";
$MXPGINFO["TBL"] = "browserMsg";

function updateBrowserMessage()
{
	global $DB, $TPL;
	
	$pageID = $_GET[ "id" ];
	
	$DB->table = $DB->pre."browserMsg";
	$DB->data = $_POST;
	
	if($DB->dbUpdate(" browser_name = '$pageID'")){				
		mxMsg("Update Browser Message changed successfully.");						
		// header("location:".ASITEURL."/$TPL->modName-edit/?id=$pageID"); exit;
	}
}

if($_POST["xAction"]) {
		switch($_POST["xAction"]) {
			
			case "UPDATE":			
				if(!$VERR)
					updateBrowserMessage();			
			break;
		}
	}
?>