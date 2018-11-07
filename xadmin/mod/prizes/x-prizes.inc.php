<?php
if($TPL->pageType == "list" || $TPL->pageType == "trash")
	header("location:".ASITEURL."/prizes-edit/");

function updateSetting() {
	global $DB;
	$prize_desc = $_POST[ 'prize-desc' ];
	$_q ="update mx_prizes set prize_desc='$prize_desc';";
	if( $DB->dbQuery( $_q ) )
	{
		mxMsg("Prize Description updated successfully.");						
		header("location:".ASITEURL."/prizes-edit/"); exit;
	}
}

if($_REQUEST["xAction"]) {
	switch($_REQUEST["xAction"]) {
		case "UPDATE":										
			if(!$VERR)
				updateSetting();			
		break;
	}
}
?>