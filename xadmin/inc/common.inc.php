<?php
function mxMsg($msg){ $_SESSION['MSG'] = $msg; }

function getListTitle($arrCol=array()){
	$str = '';
	if($arrCol){
		$str = getMAction("top"); 
		foreach ($arrCol as $v) {
			$str .= '<th'.$v[2].'><a href="#">'.$v[0].'</a></th>';
		} 
	}
	return $str;
}

function getAdminMenu(){
	global $MXADMINMENU1,$TPL; $str = ""; $class = ""; $classf = " first";
	if($MXADMINMENU1){
		foreach($MXADMINMENU1 as $k=>$v){
			if($TPL->mAccess[$v["seoUri"]]) {
			
				if( $v["seoUri"] === 'edit-on-page' )
				{
					$str .= ' <a class="'.$classf.' left" href="'.SITEURL.'" target="new" title="'.$v["menuTitle"].'">'.$v["menuTitle"].'</a>';
				}
				else
				{
					$class = str_replace("admin-","",$v["seoUri"]);
					$str .= ' <a class="'.$class.$classf.' left" href="'.ASITEURL.'/'.$v["seoUri"].'-list/" title="'.$v["menuTitle"].'">'.$v["menuTitle"].'</a>';
					$classf = '';
				}	
			}
		}
	}
	return $str;
}

function getAdminSMenu() {	
	global $DB,$TPL,$MXACCESS; $str = ""; $strS = "";
	$sql = "SELECT * FROM `mx_admin_menu` WHERE status='1' AND parentID='0' ORDER BY xOrder ASC";
	$DB->dbRows($sql);	
	if($DB->numRows > 0) {
		$main = $DB->rows;					
		foreach($main as $v) {								
			$sql  = "SELECT * FROM mx_admin_menu WHERE parentID='".$v['adminMenuID']."' ORDER BY xOrder ASC";			
			$DB->dbRows($sql);
			$strT = "";	$classM = ""; $strS = "";
			if($DB->numRows){
				$sub = $DB->rows;				
				foreach($sub as $d) {
					$TPL->mAccess[$d["seoUri"]] = $MXACCESS;					
					if($TPL->mAccess[$d["seoUri"]]) {
						$classA = ""; $classL = "";
						if($TPL->pageUri == $d["seoUri"]."-".$TPL->pageType) {
							if($TPL->pageType == "add") {
								$classA = ' aactive'; $classM = ' class="active"';
							} else {
								$classL = ' class="active"'; $classM = ' class="active"';
							}
						}
						$strAdd = "";
						if(in_array("add",$TPL->mAccess[$d["seoUri"]]))
							$strAdd = '<a href="'.ASITEURL.$menuPath.'/'.$d["seoUri"].'-add/" class="add'.$classA.'" title="Add New '.$d["menuTitle"].'">+</a>';
																				
						$strT .= '<li>'.$strAdd.'<a href="'.ASITEURL.$menuPath.'/'.$d["seoUri"].'-list/"'.$classL.'>'.$d["menuTitle"].'</a></li>';
					}
				}
				if($strT) {									
					$strS = '<ul>'.$strT.'</ul>';
					$str .= '<li><span></span><a href="'.ASITEURL.$menuPath.'/'.$v["seoUri"].'-list/"'.$classM.'>'.$v["menuTitle"].'</a>'.$strS.'</li>';
				}
			} else {
				if($TPL->mAccess[$v["seoUri"]])	{
					
					$classA = "";
					if($TPL->pageUri == $v["seoUri"]."-list" || $TPL->pageUri == $v["seoUri"]."-add" || $TPL->pageUri == $v["seoUri"]."-edit")
						$classM = ' class="active"';
					if($TPL->pageUri == $v["seoUri"]."-add" || $TPL->pageUri == $v["seoUri"]."-edit")
						$classA = ' aactive';
					$strAdd = '<a href="'.ASITEURL.$menuPath.'/'.$v["seoUri"].'-add/" class="add'.$classA.'" title="Add New '.$v["menuTitle"].'">+</a>';
											
					$str .= '<li>'.$strAdd.'<a href="'.ASITEURL.$menuPath.'/'.$v["seoUri"].'-list/"'.$classM.'>'.$v["menuTitle"].'</a>'.$strS.'</li>';
				}
			}			
		} 
	}	
	return $str;
}

function isAdminUser(){
	global $DB;	$flg = false;
	if(isset($_SESSION["MXID"])) {	
		if($_SESSION["MXID"] == "SUPER") {
			$flg = true;
		} else {
			$sql = "SELECT * FROM `".$DB->pre."admin_user` WHERE userID='".sprintf("%d",$_SESSION["MXID"])."' AND status='1'";			
			$DB->dbQuery($sql);	
			if($DB->numRows > 0) { $flg = true; }
		}
	}
	return $flg;
}

function loginAdminUser($userName="",$userPass="") {
	global $DB,$MXARRSUPER; $flg = false;
	
	if($userName && $userPass) {
		if(false && $userName == $MXARRSUPER["user"] && $userPass == $MXARRSUPER["pass"]){			
			$_SESSION['MXID'] = 	"SUPER";	
			$_SESSION['MXNAME'] = 	"Maxdigi Solutions";	
			$_SESSION['MXROLE'] = 	"SUPER";
			$flg = true;
		} else {
			
			$sql = "SELECT UR.displayName,UR.userID,UR.roleAID FROM `".$DB->pre."admin_user` AS UR LEFT JOIN `".$DB->pre."admin_role` AS UT ON UR.roleAID = UT.roleAID WHERE UR.userName='".mysql_real_escape_string($_REQUEST["userName"])."' AND UR.userPass='".mysql_real_escape_string(md5($_REQUEST["userPass"]))."' AND UR.status='1' AND UT.status='1'";
			
			$DB->dbRow($sql);
			$_d = false;
			if($DB->numRows > 0) {
				$_d = true;
			}
			else
			{	
				$sql = "SELECT UR.displayName,UR.userID,UR.roleAID FROM `".$DB->pre."admin_user` AS UR WHERE UR.userName='".mysql_real_escape_string($_REQUEST["userName"])."' AND UR.userPass='".mysql_real_escape_string(md5($_REQUEST["userPass"]))."' AND UR.status='1' and UR.roleAID = '0'";
				
				$DB->dbRow($sql);
				
				$_d = ($DB->numRows > 0);
			}	
				
			if( $_d )
			{
				if( intval( $DB->row["roleAID"] ) === 0 )
				{
					$_SESSION['MXID'] = 	'SUPER';	
					$_SESSION['MXNAME'] = 	$DB->row["displayName"];	
					$_SESSION['MXROLE'] = 	'SUPER';
				}
				else
				{
					$_SESSION['MXID'] = 	$DB->row["userID"];	
					$_SESSION['MXNAME'] = 	$DB->row["displayName"];	
					$_SESSION['MXROLE'] = 	$DB->row["roleAID"];
				}	
				
				$DB->dbQuery("UPDATE ".$DB->pre."admin_user SET dateLogin='".date("Y-m-d H:i:s")."' WHERE userID='".$DB->row["userID"]."'");
				$flg = true;
			}
		}
	}
	return $flg;
}

function getPageNav($moreNav=""){
	global $TPL,$MXPGMENU,$MXFRM,$MXTOTREC; $str = "";
	if($MXPGMENU[$TPL->pageType]) {
		foreach($MXPGMENU[$TPL->pageType] as $v) {
			if($TPL->access) {
				if($v == "add"){
					if(in_array("add",$TPL->access))
						$str .= '<a href="'.ASITEURL.'/'.$TPL->modName.'-'.$v.'/" class="'.$v.'" title="'.ucfirst($v).'"></a>';
				} else {
					$str .= '<a href="'.ASITEURL.'/'.$TPL->modName.'-'.$v.'/" class="'.$v.'" title="'.ucfirst($v).'"></a>';
				}				
			}
		}
		$strPg = ""; $strAct = "";
		if(($TPL->pageType == "trash" || $TPL->pageType == "list")){			
			$str .= '<a href="#" class="print" title="Print"></a>';
			if($MXFRM->where || $MXTOTREC > 0)
			$str = '<a href="#" class="search" title="Search"></a>'.$str;		
			$strAct = '<div id="page-action">'.getMAction("menu").$moreNav.'</div>';
			$strPg = getPaging($MXFRM->param);
		} 
		if(($TPL->pageType == "add" || $TPL->pageType == "edit")){
			if($TPL->pageType == "edit") $btnName = "UPDATE"; else $btnName = "SAVE";
			$mandatory = '<div class="mandatory">Fields with (<em>* </em>) are mandatory</div>';
			$str = '<input type="submit" name="btnSubmit" id="btnSubmit" class="btn-medium" value="'.$btnName.'" />'.$str;
		}
	}	
	return '<div id="page-nav">'.$mandatory.'<div id="navigate">'.$str.'</div>'.$strPg.$strAct.'</div>';
}

function getJsSettings(){	
	global $TPL,$MXPGINFO;
	$MXPGINFO["PGDEFAULT"] = $TPL->tplDefault;
	$MXPGINFO["PGTYPE"] = $TPL->pageType;
	$MXPGINFO["MODNAME"] = $TPL->modName;
	return urlencode(json_encode($MXPGINFO));
}

function getEditUrl($param,$val){	
	global $TPL,$MXPGINFO; $str = "";
	if($param && $val){
		$str = '<a href="'.ASITEURL.'/'.$TPL->modName.'-edit/?'.$param.'" class="edit" title="Click to Edit"><strong>'.$val.'</strong></a>';
	}
	return $str;
}

function getMAction($type="",$id=0){
	global $TPL,$MXMACTION; $str = "";		
	$arrA = array_intersect($MXMACTION[$TPL->pageType],$TPL->access);			
	if($arrA){
		if($type) {
			if($type=="top")
				$str = '<th width="1%"><input type="checkbox" class="chkAll" title="Select All" /></th>';
			if($type=="mid"){
				if($id == $_SESSION['MXID'] || $id == '1' && $TPL->modName == "admin-user")
					$str = '<td align="center" width="1%">&nbsp;</td>';
				else
					$str = '<td align="center" width="1%"><input type="checkbox" value="'.$id.'" /></td>';
			}
			if($type=="menu") {				
				foreach($arrA as $a)
					$str .= '<a href="#" class="'.$a.' action" rel="'.$a.'">'.strtoupper($a).'</a>';				
			}
		}	
	}
	return $str;
}

function getSetting($seoUri=""){
	global $DB; $arr = array();
	$where = '1';
	if($seoUri)
		$where = " seoUri='$seoUri'";
	$DB->dbRows("SELECT * FROM `".$DB->pre."admin_setting` WHERE $where");
	foreach($DB->rows as $v){
		$arr[$v["seoUri"]] = $v["settingVal"];
	}
	return $arr;
}

function getunqid($s)
{
	return(md5(uniqid(time(),true).$s));
}

function remove_spaces( $s )
{
	return( str_replace( ' ', '_', strtolower( $s ) ) );
}

function add_spaces( $s )
{
	return( str_replace( '_', ' ', ucwords( $s ) ) );
}


?>