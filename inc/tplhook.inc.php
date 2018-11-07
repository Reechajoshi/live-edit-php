<?php
function isPage(){
	global $DB,$TPL;		
	
	$DB->dbRow("SELECT * FROM ".$DB->pre."page WHERE seoUri = '".$TPL->urlBase."' AND status='1'");
	if($DB->numRows){		
		$TPL->data = $DB->row;
		$TPL->modPath = ABSPATH."/mod/page";
		$TPL->modUrl  = SITEURL."/mod/page";
		$TPL->pageType = "page";
		$TPL->tplInc = $TPL->modPath."/x-page.inc.php";	
		if($DB->row["templateFile"] && file_exists($TPL->modPath.'/x-'.$DB->row["templateFile"].'.php')){
			$TPL->tplFile = $TPL->modPath.'/x-'.$DB->row["templateFile"].'.php';
		} else {
			$TPL->tplFile = $TPL->modPath.'/x-page.php';
		}
		$TPL->metaKeyword = $DB->row["synopsis"];
		if($TPL->currMenu["metaKeyword"])
			$TPL->metaKeyword = $TPL->currMenu["metaKeyword"];				
		$TPL->metaDesc = $DB->row["synopsis"];
		if($TPL->currMenu["metaDesc"])
			$TPL->metaDesc = $TPL->currMenu["metaDesc"];
		$TPL->pageType   = "page";							
	}
}

function isCategory(){
	global $TPL,$DB;	
	$DB->dbRow("SELECT * FROM ".$DB->pre."category WHERE seoUri = '".$TPL->pageUri."' AND status='1'");
	if($DB->numRows){
		$TPL->data = $DB->row;		
		$TPL->pageType = "category";		
		$TPL->modPath = ABSPATH."/mod/category";
		$TPL->modUrl  = SITEURL."/mod/category";
		$TPL->tplInc = $TPL->modPath."/x-category.inc.php";		
		if($DB->row["templateFile"] && file_exists($TPL->modPath.'/'.$DB->row["templateFile"])){
			$TPL->tplFile = $TPL->modPath.'/'.$DB->row["templateFile"];
		} else {
			$TPL->tplFile = $TPL->modPath.'/x-category.php';
		}
		$TPL->tplTitle   = $DB->row["categoryTitle"];
		$TPL->pageType   = "category";
		
		return true;						
	} else {
		return false;
	}
}

if($TPL->pageType=='404'){
	if($TPL->currMenu) {
		$funcName = "is".ucfirst($TPL->currMenu["menuType"]);
		if(function_exists($funcName)){				
			call_user_func($funcName);
			$TPL->tplTitle = $TPL->currMenu["menuTitle"];
		}
	} else {
		if(!isCategory() && !isPage()) {	
			if(is_numeric($TPL->uriArr[0]) && is_numeric($TPL->uriArr[1]) && is_numeric($TPL->uriArr[2])){			
				$DB->dbRow("SELECT * FROM ".$DB->pre."post WHERE seoUri = '".$TPL->urlBase."' AND status='1'");
				if($DB->numRows){
					$TPL->data = $DB->row;
					$TPL->modPath = ABSPATH."/mod/post";
					$TPL->modUrl  = SITEURL."/mod/post";
					$TPL->tplInc = $TPL->modPath."/x-post.inc.php";				
					$TPL->tplFile = $TPL->modPath.'/x-post.php';
					$TPL->tplTitle = $DB->row["postTitle"];				
					$TPL->pageType   = "post";										
				}						
			}
		}
	}
}
?>