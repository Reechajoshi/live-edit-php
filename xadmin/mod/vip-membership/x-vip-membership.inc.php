<?php
$MXTOTREC = 0;
$MXPGINFO["PK"] = "vipMemberID";
$MXPGINFO["TBL"] = "vip_membership";

function updateVipMember() {
	global $DB,$TPL;
	$_POST["dateModified"] = date("Y-m-d H:i:s");
	$_POST["vipMemberTitle"] = cleanTitle($_POST["vipMemberTitle"]);
	$_POST["vipMemberDesc"] = cleanHtml($_POST["vipMemberDesc"]);
		
	$vipMemberID    = sprintf("%d",$_POST["vipMemberID"]);
	$DB->table = $DB->pre."vip_membership";	
	$DB->data  = $_POST;
	if($DB->dbUpdate("vipMemberID='$vipMemberID'")){
		//resetSeoUri($vipMemberID);						
		mxMsg("Vip Membership updated successfully.");						
		header("location:".ASITEURL."/$TPL->modName-edit/?id=$vipMemberID"); exit;
	}			
}

if($_REQUEST["xAction"]) {
	switch($_REQUEST["xAction"]) {
		
		case "UPDATE":			
			if(!$VERR)
				updateVipMember();			
		break;
	}
}
?>