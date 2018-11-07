<?php
//function mxMsg($msg){ $_SESSION['MSG'] = $msg; }
function parse_youtube_url($url,$return='embed',$width='',$height='',$rel=0){
    $urls = parse_url($url);
   
    //url is http://youtu.be/xxxx
    if($urls['host'] == 'youtu.be'){
        $id = ltrim($urls['path'],'/');
    }
    //url is http://www.youtube.com/embed/xxxx
    else if(strpos($urls['path'],'embed') == 1){
        $id = end(explode('/',$urls['path']));
    }
     //url is xxxx only
    else if(strpos($url,'/')===false){
        $id = $url;
    }
    //http://www.youtube.com/watch?feature=player_embedded&v=m-t4pcO99gI
    //url is http://www.youtube.com/watch?v=xxxx
    else{
        parse_str($urls['query']);
        $id = $v;
        if(!empty($feature)){
            $id = end(explode('v=',$urls['query']));
        }
    }
    //return embed iframe
    if($return == 'embed'){
        return '<iframe width="'.($width?$width:560).'" height="'.($height?$height:349).'" src="http://www.youtube.com/embed/'.$id.'?rel='.$rel.'" frameborder="0" allowfullscreen></iframe>';
    }
    //return normal thumb
    else if($return == 'thumb'){
        return 'http://i1.ytimg.com/vi/'.$id.'/default.jpg';
    }
    //return hqthumb
    else if($return == 'hqthumb'){
        return 'http://i1.ytimg.com/vi/'.$id.'/hqdefault.jpg';
    }
    // else return id
    else{
        return $id;
    }
}


function mxGetMeta(){
	global $DB,$TPL; $str = "";	
    $urlB = $TPL->urlBase;
	if($TPL->pageType == 'module')
		$urlB = '/'.$TPL->urlBase;
	
	$sql = "SELECT * FROM ".$DB->pre."menu   WHERE seoUri = '".$urlB."' AND status='1'"; 
	$D = $DB->dbRow($sql); 
	$TPL->metaTitle = $D['metaTitle'];
	$TPL->metaKeyword = $D['metaKeyword'];
	$TPL->metaDesc = $D['metaDesc'];
	if($TPL->metaDesc)
		$str = '<meta name="DESCRIPTION" content="'.mx_strip_all_tags($TPL->metaDesc,true).'" />';
	if($TPL->metaKeyword)
		$str .= "\n".'<meta name="KEYWORDS" content="'.$TPL->metaKeyword.'" />';
	
	return $str;
}

function createMenu($menuID=0,$depth=100,$level=0){
	global $TPL,$DB;
	if($menuID){
		$sql  ="SELECT * FROM ".$DB->pre."menu WHERE status='1' AND parentID = '$menuID' ORDER BY xOrder ASC";
		$DB->dbRows($sql);
		if($DB->numRows){						
			if($level)
				$str .= '<ul class="tree-list">';
				foreach($DB->rows as $v) {
					$class = ''; $target = ''; $url = '';			
					if($v["seoUri"])
						if(strpos($TPL->pageUri,$v["seoUri"]) !== false) { $class = ' class="active"'; }	
					if($v["menuType"] == 'exlink') { 
						$url =  $v["seoUri"]; $target = ' target="_blank"';
					} else if($v["menuType"] == 'page') { 
						$url = SITEURL."/".$v["seoUri"]."/"; 
					} else { $url = SITEURL.$v["seoUri"]."/"; }
					
					$str .= '<li class="'.$v["menuClass"].'"><a'.$class.' href="'.$url.'"'.$target.'>' . $v["menuTitle"] . '</a>';
					$str .= createMenu($v["menuID"],$depth,$level+1); $level-1;
					$str .= '</li>';
				}
				if($level)
					$str .= '</ul>';				
			}
	}
	return $str;
}

function getMenu($menuTitle="",$depth=100){
	global $DB; $str = "";
	if($menuTitle){ 
		$sql = "SELECT menuID FROM ".$DB->pre."menu WHERE status='1' AND menuTitle = '$menuTitle'";
		$d = $DB->dbRow($sql);
		if($DB->numRows){
			$str = createMenu($d["menuID"],$depth);
		}
	}
	return $str;
}

function getPostCatId($postID="") {
	global $DB;	
	$sql = "SELECT categoryID  FROM ".$DB->pre."post_category WHERE postID= '$postID'";	
	$DB->dbRows($sql);
	$arrCat = array();
	
	if($DB->numRows > 0){
		foreach($DB->rows as $cat){
			$arrCat[] = $cat['categoryID'];
		}		
	}
	return $arrCat;
}

function getCatTree($parentID=0,$type="",$arrCurr=array(),$maxLevel=100,$level=0,$strUri="",$strMenu = ""){
	global $DB;	
	if(($level+1)<= $maxLevel){			
		$sql  ="SELECT * FROM ".$DB->pre."category WHERE parentID='".$parentID."' ORDER BY categoryID ASC";	
		$DB->dbRows($sql);		
		if($DB->numRows > 0) {
			if($level > 0 && $type != "")
				$strMenu.="<ul class='level-".($level-1)."'>";
				
			foreach($DB->rows as $ct){						
				$curr = "";											
				if(!$arrCurr) 
					$arrCurr = array();
					
				if($type == "checkbox") {				
					if(in_array($ct['categoryID'],$arrCurr))
						$curr = ' checked="checked"';
					$strMenu.= '<li><input type="checkbox" id="categoryID'.$ct['categoryID'].'" name="categoryID[]" value="'.$ct['categoryID'].'" '.$curr.' class="checkbox" /> '.$ct['categoryTitle'];	
				} else if($type == "radio") {
					if(in_array($ct['categoryID'],$arrCurr))
						$curr = ' checked="checked"';
					$strMenu.= '<li><input type="radio" id="categoryID'.$ct['categoryID'].'" name="categoryID" value="'.$ct['categoryID'].'" '.$curr.' class="radio" /> '.$ct['categoryTitle'];	
				} else if($type == "treelist") {
					$newUri = $strUri."/".$ct['seoUri'];
					if(in_array($ct['categoryID'],$arrCurr)){$curr = ' class="active"';}
					$strMenu.="<li$curr><a $curr href='".SITEURL.$ct['seoUri']."/' rel='".$ct['categoryID']."'>".$ct['categoryTitle']."</a>";
				} else {				
					if(in_array($ct['categoryID'],$arrCurr))
						$curr = ' selected="selected"';
					$strMenu.= "<option value='".$ct['categoryID']."'$curr>".str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$level).$ct['categoryTitle']."</option>";
				}
																			
				$strMenu = getCatTree($ct["categoryID"],$type,$arrCurr,$maxLevel,$level+1,$newUri,$strMenu);
				$level-1;
				
			}
			if($level > 0 && $type != "")
				$strMenu.="</ul></li>";	
				
		} else {		
			if($type != "")
				$strMenu.="</li>"; $strUri = "";
		}	
	}
	if($strMenu) return $strMenu;
}

function queryString($params, $name=null) {
	$ret = "";
	foreach($params as $key=>$val) {
		if(is_array($val)) {
			if($name==null) $ret .= queryString($val, $key);
			else $ret .= queryString($val, $name."[$key]");   
		} else {
			if($name!=null)
				$ret.=$name."[$key]"."=$val&";
			else $ret.= "$key=$val&";
		}
	}
	return $ret;   
}

function getCatParents($categoryID=0,$arrCats=array()){
	if($categoryID){
		global $DB;
		$sql  ="SELECT parentID FROM ".$DB->pre."category WHERE categoryID='".$categoryID."' AND parentID!='0'";	
		//echo "<br>".$sql;
		$DB->dbRow($sql);		
		if($DB->numRows > 0) {						
			$arrCats[] = $DB->row["parentID"];
			$arrCats = getCatParents($DB->row["parentID"],$arrCats);			
		}
	}	
	return $arrCats;
}

function getCategoryMenu($parentID,$categoryID){
		global $DB;
		$sql  ="SELECT * FROM ".$DB->pre."category WHERE parentID='".$parentID."' ORDER BY categoryID ASC";	
		$DB->dbRows($sql);
		if($DB->numRows > 0) {						
			foreach($DB->rows as $ct){
				$curr = '';
				if($ct['categoryID']==$categoryID){
					$curr = ' class="active"';
				}
				$strMenu.="<li$curr><a $curr href='".SITEURL.$ct['seoUri']."/' rel='".$ct['categoryID']."' id='".makeSeoUri($ct['categoryTitle'])."'>".$ct['categoryTitle']."</a></li>";
			}
		}
	return $strMenu;
}

function getCatUrl($categoryID=0){
	$str = "";
	if($categoryID){
		global $DB;
		$sql  ="SELECT seoUri FROM ".$DB->pre."category WHERE categoryID='".$categoryID."'";	
		//echo "<br>".$sql;
		$DB->dbRow($sql);		
		if($DB->numRows > 0) {						
			$str = SITEURL.$DB->row["seoUri"]."/";					
		}
	}	
	return $str;
}
?>