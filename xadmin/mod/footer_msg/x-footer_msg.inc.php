<?php
if($TPL->pageType == "list" || $TPL->pageType == "trash")
	header("location:".ASITEURL."/footer_msg-edit/");
	
function updateSetting() {
	global $DB;
	$footer_msg_01 = addslashes( $_POST[ 'footer_message_01' ] );
	$footer_msg_02 = htmlentities( $_POST[ 'footer_message_02' ], ENT_QUOTES, "UTF-8" );
	/* $F_msg01_fontSize = $_POST[ 'footer_msg_01_size' ]; */
	$F_msg02_fontSize = $_POST[ 'footer_msg_02_size' ];
	
	$_q ="update mx_footer_msg set message01 = '$footer_msg_01', message02 = '$footer_msg_02', message02_font_size = $F_msg02_fontSize;";
	
	if( $DB->dbQuery( $_q ) )
	{
		mxMsg("Footer message updated successfully.");						
		header("location:".ASITEURL."/footer_msg-edit/"); exit;
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