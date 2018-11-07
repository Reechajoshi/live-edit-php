<?php
$MXTOTREC = 0;
$MXPGINFO["PK"] = "postID";
$MXPGINFO["TBL"] = "post";

function addPost() {	
	global $DB,$TPL;
	$_POST["seoUri"] = makeSeoUri($_POST["postTitle"]);
	$_POST["postThumb"] = uploadFile("postThumb");
	$_POST["postImage"] = uploadFile("postImage");
	if(!$_POST['featuredPost'])
		$_POST['featuredPost'] = 0;
	$_POST["dateAdded"] = date("Y-m-d H:i:s");	
	$DB->table = $DB->pre."post";	
	$DB->data  = $_POST;
	if($DB->dbInsert()){
	$postID = $DB->insertID;
	mxMsg("Post added successfully.");	
	header("location:".ASITEURL."/$TPL->modName-edit/?id=$postID"); exit;
	}
}

function updatePost() { 
	global $DB,$TPL;
	$deleteArr = array();
	$insertArr = array();	
	$_POST["seoUri"] = makeSeoUri($_POST["postTitle"]);
	$_POST["postThumb"] = uploadFile("postThumb");
	$_POST["postImage"] = uploadFile("postImage");
	$_POST["dateModified"] = date("Y-m-d H:i:s");
	if(!$_POST['featuredPost'])
		$_POST['featuredPost'] = 0;	
	$postID    = sprintf("%d",$_POST["postID"]);
	$DB->table = $DB->pre."post";
	$DB->data  = $_POST;
	if($DB->dbUpdate("postID='$postID'")){
		mxMsg("Post updated successfully.");								
		header("location:".ASITEURL."/$TPL->modName-edit/?id=$postID"); exit;
	}			
}


if($_REQUEST["xAction"]) {
	switch($_REQUEST["xAction"]) {
		
		case "ADD":
			if(!$VERR)
				addPost();
		break;
		
		case "UPDATE":			
			if(!$VERR)
				updatePost();			
		break;
		
		case "deleteImage":
		require("../../../connectdb.inc.php");	
		require("../../inc/common.inc.php");				
			if(!$VERR)
				echo deleteImage($_REQUEST["imgName"],$_REQUEST["tableName"],$_REQUEST["imgFieldName"]);			
		break;
	}
}
?>