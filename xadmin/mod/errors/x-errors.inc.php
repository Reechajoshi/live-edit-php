<?php

$MXTOTREC = 0;
$MXPGINFO["PK"] = "errid";
$MXPGINFO["TBL"] = "errors";

function updateError()
{
	global $DB, $TPL;
	
	$pageID = $_GET[ "id" ];
	$errid = $_POST[ 'errid' ];
	
	foreach( $_POST[ 'err_message' ] as $key => $row )
	{
		$DB->table = $DB->pre."errors";
		$DB->data = array( "title" => $key, "error_msg" => $row );
	
		if($DB->dbUpdate(" errid = '$errid' and title = '$key'")){				
			mxMsg("Error Message updated successfully.");						
			// header("location:".ASITEURL."/$TPL->modName-edit/?id=$pageID"); exit;
		}
	}
	
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