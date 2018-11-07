<?php
if($TPL->pageType == "list" || $TPL->pageType == "trash")
	header("location:".ASITEURL."/nucards_steps-edit/");

function updateSetting() {
	global $DB;
	$continue = false;
	$pop_up_title_arr = $_POST[ 'pop_up_steps_txt' ];
	$page_title_arr = $_POST[ 'page_steps_txt' ];
	$pop_up_old_title_arr = $_POST[ 'pop_up_steps_old_title' ];
	$page_old_title_arr = $_POST[ 'page_steps_old_title' ];
	
	$page_html_arr = array();
	$popup_html_arr = array();
	
	for( $i = 0; $i < 5;$i++ )
	{
		$pop_up_html_arr[] = $_POST[ 'popup_step'.($i+1).'_html' ];
		$page_html_arr[] = $_POST[ 'page_step'.($i+1).'_html' ];
	}
	
	for( $i = 0; $i < 5; $i++ )
	{
		$pop_up_q = "update mx_nucards_steps set nucards_steps_id = '".$pop_up_title_arr[ $i ]."', description='".$pop_up_html_arr[ $i ]."' where nucards_steps_id = '".$pop_up_old_title_arr[ $i ]."' and steps_type='pop-up';";
		
		$page_q = "update mx_nucards_steps set nucards_steps_id = '".$page_title_arr[ $i ]."', description='".$page_html_arr[ $i ]."' where nucards_steps_id = '".$page_old_title_arr[ $i ]."' and steps_type='page';";
		
		if( ( $DB->dbQuery( $pop_up_q ) ) && ( $DB->dbQuery( $page_q ) ) )
		{
			$continue = true;
		}
	}
	
	if( $continue )
	{
		mxMsg("Steps to play Cards updated successfully.");						
		header("location:".ASITEURL."/nucards_steps-edit/"); exit;
	}
	else
	{
		mxMsg("Error occured while Updating Steps to play Cards.");						
		header("location:".ASITEURL."/nucards_steps-edit/"); exit;
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