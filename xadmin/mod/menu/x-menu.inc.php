<?php	
function exlinkDD($seoUri=""){	
	return '<li><input type="text" name="seoUri" value="'.$seoUri.'" title="External Link" class="text" style="width:353px;" /> '.$v.'</li>';
}

function categoryDD($seouri=""){
	global $DB;
	$DB->dbRows("SELECT categoryID,categoryTitle,parentID,seoUri FROM `mx_category` WHERE 1");
	$arr = getDepthArray($DB->rows,"parentID","categoryID");
	$str = "";

	if($arr){
		foreach($arr as $v) {
			//if($v["parentID"]) {
				$chk = '';								

				if($seouri == $v["seoUri"])
					$chk = ' checked="checked"';
				if($v["depth"])
					$str .= '<li><input type="radio" name="seoUri" value="'.$v["seoUri"].'"'.$chk.' /> '.str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$v["depth"])."|&rArr; ".$v["categoryTitle"].' (<small>'.$v["seoUri"].'</small>)</li>';
				else
					$str .= '<li><input type="radio" name="seoUri" value="'.$v["seoUri"].'"'.$chk.' /> '.$v["categoryTitle"].' (<small>'.$v["seoUri"].'</small>)</li>';
			//} else {
				//$str .= '<li>&nbsp;&nbsp;'.$v["categoryTitle"].'</li>';
			//}
		}
	} else {
		$str = "<li>Nothing found</li>";
	}
	return $str;
}

function pageDD($seoUri=""){
	global $DB;
	$arr = getDataArray("mx_page","seoUri","pageTitle");
	$str = "";

	if($arr){
		foreach($arr as $k=>$v) {
			$chk = '';			
			if($seoUri == $k)
				$chk = ' checked="checked"';
			
			$str .= '<li><input type="radio" name="seoUri" value="'.$k.'"'.$chk.' /> '.$v.'</li>';
		}
	} else {
		$str = "<li>Nothing found</li>";
	}
	return $str;
}

function moduleDD($currID=""){				
	return getModTree(ABSPATH."/mod/",$currID);
}

function recreateMenu(){
	global $DB,$SKIPMOD;
	if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '".$DB->pre."category'"))==1){
		$DB->dbQuery("DELETE FROM ".$DB->pre."menu WHERE seoUri NOT IN(SELECT DISTINCT(seoUri) FROM ".$DB->pre."category WHERE 1) AND menuType='category'");		
	}
	
	if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '".$DB->pre."page'"))==1) {
		$DB->dbQuery("DELETE FROM ".$DB->pre."menu WHERE seoUri NOT IN(SELECT DISTINCT(seoUri) FROM ".$DB->pre."page WHERE 1) AND menuType='page'");
	}
	$arr = getArrayMods(ABSPATH."/mod/");
	
	$arr = array_merge((array)$SKIPMOD, (array)$arr);
	if($arr){
		$strMods = "'".implode("','",$arr)."'";		
	}		
	$DB->dbQuery("DELETE FROM ".$DB->pre."menu WHERE seoUri NOT IN($strMods) AND menuType='module'");
}

//==================================================================================

$MXPGINFO["PK"]  = "menuID"; $MXPGINFO["TBL"] =  "menu"; $MXTOTREC = 0; 

function addAdminMenu() {	
	global $DB,$TPL;
	$_POST["status"] = 1;
	$_POST["synopsis"] = addslashes( $_POST["synopsis"] );
	$DB->table = $DB->pre."menu";
	$DB->data  = $_POST;
	
	if($DB->dbInsert()){
		$menuID = $DB->insertID; 								
		
		if($menuID) {
			mxMsg("Menu added successfully.");	
			header("location:".ASITEURL."/$TPL->modName-edit/?id=$menuID"); exit;
		}
	}
}

function updateAdminMenu() {
	global $DB,$TPL;
	$_POST["synopsis"] = addslashes( $_POST["synopsis"] );
	$menuID = sprintf("%d",$_POST["menuID"]); 
	$DB->table = $DB->pre."menu";
	$DB->data  = $_POST;
	if($DB->dbUpdate("menuID='$menuID'")){				
		mxMsg("Menu updated successfully.");							
		header("location:".ASITEURL."/$TPL->modName-edit/?id=$menuID"); exit;
	}			
}

if($_GET['pageType']){
	include("../../../connectdb.inc.php");
	echo call_user_func($_GET['pageType']."DD");
}

if($_REQUEST["xAction"]) {
	switch($_REQUEST["xAction"]) {		
		case "ADD":
			if(!$VERR)
				addAdminMenu();
		break;
		
		case "UPDATE":			
			if(!$VERR)
				updateAdminMenu();
		break;
		
		case "recreateMenu":			
			include("../../../connectdb.inc.php");
			echo recreateMenu();
		break;
	}
}
?>