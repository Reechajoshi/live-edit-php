<?php
function startsWith($needle, $haystack) { return preg_match('/^'.preg_quote($needle)."/", $haystack); }
function endsWith($needle, $haystack) {   return preg_match("/".preg_quote($needle) .'$/', $haystack); }

function getArrayMods($path="",$arr=array(),$prevDir=""){
	if($dir = @opendir($path)){
		global $SKIPMOD;		
		while (false !== ($file = readdir($dir))) {
			if($file!="." && $file!=".." && $file != 'inc') {
				if(!in_array($file,$SKIPMOD)) {
					$relPath = str_replace(ABSPATH."/mod/","",$path."/".$file);	
					if (is_dir($path."/".$file)){
							$prevDir = $file;																														
					} else {									
						if(startsWith("x-",$file) && endsWith(".php",$file) && !endsWith("inc.php",$file) && $file !='x-detail.php'){
							if($file != "x-".$prevDir.".inc.php" && $file != "x-".$prevDir.".php")
								$relPath = str_replace(array("x-",".php"),"",$relPath);
							else
								$relPath = "";
						} else $relPath = "";
					}				
					if($relPath) {
						$arr[] = $relPath;						
						$arr = getArrayMods($path."/".$file,$arr,$prevDir);
					}
				}
			}
		}
		closedir($dir);
	}
	return $arr;
}

function getModTree($path="",$selected="",$str="",$prevDir = ""){
	$str="";
	$arr = getArrayMods(ABSPATH."/mod/");
	if($arr){
		foreach($arr as $d){
			$chk = "";
			if("$d" == "$selected")
				$chk = ' checked="checked"';						
			$str .= '<li><input type="radio" name="seoUri" value="'.$d.'"'.$chk.' /> '.$d.'</li>';
		}
	}	
	return $str;
}

function datetoMysql($dateTime) {	
	if($dateTime) {
		$format = "Y-m-d H:i:s";
		list($date,$time,$ap)    = explode(" ",$dateTime);
		if($date) { list($dD,$dM,$dY)    = explode("-",$date); }
		if($time) { list($tH,$tM,$tS)    = explode(":",$time); } else {$format = "Y-m-d";}
		
		if(trim($ap) == "PM" && $tH < 12) {	
			$tH = ($tH+12); 
		} else if(trim($ap) == "AM" && $tH > 11) { 
			$tH = ($tH-12);
		}
		$newDT = date($format, @mktime($tH,$tM,$tS,$dM,$dD,$dY));
		return $newDT;
	}
}

function getTreeDD($arrD=array(), $val="adminMenuID", $text="menuTitle", $nmParent="parentID",$selected=""){
	$options = "";
	$arr = getDepthArray($arrD, $nmParent, $val);
	if(!empty($arr) && sizeof($arr)>=1 && is_array($arr)) {		
		foreach($arr as $k=>$v) {
			if($v) {				
				$sel = "";				
				if($v[$val] == $selected) $sel=' selected="selected"';
				if($v["depth"])
					$v[$text] = str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$v["depth"])."&rArr; ".$v[$text];
				$options.= "\n<option value=\"".$v[$val]."\"".$sel.">".$v[$text]."</option>";	 
			}
		}
	}
	return $options; 
}

function getArrayDD($arr=array(),$selected="") {	
	$options = "";	
	if(!empty($arr) && sizeof($arr)>=1 && is_array($arr)) {		
		foreach($arr as $k=>$v) {
			if($v!="") {				
				$sel = "";				
				if($k == $selected) $sel=' selected="selected"';
				$options.= "\n<option value=\"".$k."\"".$sel.">".$v."</option>";	 
			}
		}
	}
	return $options; 
}

function getTableDD($table="",$key="",$val="",$selected="",$where="1") {	
	global $DB; $options = "";
	$sql = "SELECT $key,$val FROM `$table` WHERE $where";
	$DB->dbRows($sql);	
	
	if($DB->numRows > 0) {
		$arrTemp = array();
		foreach($DB->rows as $arrV) {
			$arrTemp[$arrV[$key]] =  $arrV[$val];
		}
		$options = getArrayDD($arrTemp, $selected);
	}	
	return $options;
}


function getArrTree(&$arr,$nmID="adminMenuID", $nmParent="parentID", $id = 0){
    $result = array();
    foreach ($arr as $a) {
        if ($id == $a[$nmParent]) {
            $a['childs']  = getArrTree($arr,$nmID,$nmParent,$a[$nmID]);
            $result[] = $a;
        }
    }
    return $result;
}


function getDataArray($tableName="", $fieldKey="", $fieldValue="", $where="1", $orderby="") {
	global $DB; $arrData = array();
	if($tableName && $fieldKey && $fieldValue) {
		if(!$orderby){ $orderby = $fieldValue; }
		$sql = "SELECT `$fieldKey`,`$fieldValue` FROM `$tableName` WHERE ".$where." ORDER BY $orderby";		
		$DB->dbRows($sql);
		if($DB->numRows > 0) {
			foreach($DB->rows as $v) {
				$arrData[$v[$fieldKey]] = $v[$fieldValue];
			}			
		}
	}	
	return $arrData;
}

function getDepthArray($result, $fldParent="", $fldId="", $parent=0, $level=0, $finalArr=array(),$rt=true){
	if(sizeof($result)>0 && $fldParent && $fldId){
		foreach($result as $rs){
			if($rs[$fldParent]== $parent){
				$rs['depth']=$level++;								
				$finalArr[]=$rs;
				$rt=false;
				$finalArr = getDepthArray($result,$fldParent,$fldId,$rs[$fldId],$level,$finalArr,$rt);
				$level--;
			}
		}
	}
	return $rt ? $result : $finalArr;
}

function getCheckbox($arrD=array(),$val="",$text="",$select=array()){
	$str  = "";
	if($arrD) {
		foreach($arrD as $k=>$v) {
			$chk = "";
			if(in_array($k,$select))
				$chk = ' checked="checked"';
			$str .= '<li><input type="checkbox" name="'.$val.'[]" class="radio" value="'.$k.'"'.$chk.' > '.$v.'</li>';		
		}
	}
	return $str;
}

function getRadio($arrD=array(),$val="",$text="",$select=array()){
	$str  = "";
	if($arrD) {
		foreach($arrD as $k=>$v) {
			$chk = "";
			if(in_array($k,$select))
				$chk = ' checked="checked"';
			$str .= '<li><input type="radio" name="'.$val.'" class="radio" value="'.$k.'"'.$chk.' > '.$v.'</li>';		
		}
	}
	return $str;
}

function getCheckboxTree($arrD=array(),$val="",$text="",$nmParent="",$select=array()) {
	if($arrD) {
		$arr = getArrTree($arrD, $val,$nmParent);
		$str .= '<ul class="tree-list">';
		foreach($arr as $v) {
			$str .= '<li><input type="checkbox" name="checkbox" class="checkbox" value="'.$v[$val].'"> '.$v[$text];
			if($v["childs"]) { $str .= getCheckboxTree($v["childs"]);	}
			$str .= '</li>';
		}
		$str .= '</ul>';
	}
	return $str;
}

function getRadioTree($arr=array(),$val="",$text="",$select=array()) {
	if($arr) {
		$str .= '<ul class="tree-list">';
		foreach($arr as $v) {
			$str .= '<li><a href="#">' . $v["categoryTitle"] . '</a>';
			if($v["childs"]) { $str .= getRadioTree($v["childs"]);	}
			$str .= '</li>';
		}
		$str .= '</ul>';
	}
	return $str;
}

function resetAutoIncreament($tbl="",$pk=""){
	if($tbl && $pk){
		global $DB;
		$maxVal = '1';
		$DB->dbRow("SELECT MAX($pk) AS maxVal FROM `$tbl` WHERE 1");			
		if($DB->row["maxVal"]){ $maxVal = ($DB->row["maxVal"]+1); }
		$DB->dbQuery("ALTER TABLE `$tbl` AUTO_INCREMENT = $maxVal");
	}
}

// === Other Functions ===
function generateKey($len=7) {
    $chars = "abcdefghijkmnopqrstuvwxyz023456789";
    srand((double)microtime()*1000000);
    $i = 0; $key = '' ;
	
    while ($i <= $len) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $key = $key.$tmp;
        $i++;
    }
    return $key;
}

function getTimeDateDiff($date1){
	$date2   = date('Y-m-d H:i:s');
	$diff    = abs(strtotime($date2) - strtotime($date1)); 
	$years   = floor($diff / (365*60*60*24)); 
	$months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
	$days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));	
	$hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 	
	$minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 	
	$seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minuts*60)); 
	
	if($years)
		if($years==1) $str = $years.' year ago'; else $str = $years.' years ago';
	elseif($months)
		if($months==1) $str = $months.' month ago';	else $str = $months.' months ago';
	elseif($days)
		if($days==1) $str = $days.' day ago'; else $str = $days.' days ago';
	elseif($hours)
		if($hours==1) $str = $hours.' hour ago'; else $str = $hours.' hours ago';
	elseif($minuts)	
		if($minuts==1) $str = $minuts.' minute ago'; else $str = $minuts.' minutes ago';
	else
		if($seconds==1)	$str = $seconds.' second ago'; else $str = $seconds.' seconds ago';
	return $str;
}

function ordinalSuffix($value, $sup = 0){
    is_numeric($value) or trigger_error("<b>\"$value\"</b> is not a number!, The value must be a number in the function <b>ordinal_suffix()</b>", E_USER_ERROR);
    if(substr($value, -2, 2) == 11 || substr($value, -2, 2) == 12 || substr($value, -2, 2) == 13){ $suffix = "th";  }
    else if (substr($value, -1, 1) == 1){ $suffix = "st"; }
    else if (substr($value, -1, 1) == 2){ $suffix = "nd"; }
    else if (substr($value, -1, 1) == 3){ $suffix = "rd"; }
    else { $suffix = "th"; }
    if($sup){ $suffix = $suffix; }
    return $value . $suffix;
}

function deleteFile($file) {	
	if(file_exists($file) && is_file($file)) { 
		if(unlink($file))
			return true;			
	}
}

function uploadFile($fldName,$uploadTo=""){
	global 	$MXPGINFO;
	$file = $_FILES[$fldName];
	
	if(!$uploadTo)
		$uploadTo = "uploads/".$MXPGINFO["TBL"];
	
	$oldFile = $_REQUEST[$fldName."O"];
	
	if($file['name']!="") {				
		if($file["error"] == 0) {
			set_time_limit(0);										
			if(!file_exists(ABSPATH."/".$uploadTo)){ mkdir(ABSPATH."/".$uploadTo,0777);	}								
			$info = pathinfo($file['name']);			
			$ext  = $info['extension'];							
			$fileName = str_replace(array("."," "),"",microtime()).".".$ext;				
			if(copy($file["tmp_name"],ABSPATH."/".$uploadTo."/".$fileName)){								 	 				
				if($oldFile) { deleteFile(ABSPATH."/".$uploadTo."/". $oldFile); }
			}  else {
				$fileName = "";
			}
		} 
	} else {
		$fileName = $oldFile;
	}
	return $fileName;
}

function uploadFileARR($fldName,$uploadTo="",$key){
	global 	$MXPGINFO;
	$file = $_FILES[$fldName];
	
	if(!$uploadTo)
		$uploadTo = "uploads/".$MXPGINFO["TBL"];
	
	$oldFile = $_REQUEST[$fldName."O"];
	$fileName = $oldFile;	
	if($file['name'][$key]!="") {				
		if($file["error"][$key] == 0) {
			set_time_limit(0);		
			if(!file_exists(ABSPATH."/".$uploadTo)){ mkdir(ABSPATH."/".$uploadTo,0777);	}								
			$info = pathinfo($file['name'][$key]);			
			$ext  = $info['extension'];					
			$fileName = str_replace(array("."," "),"",microtime()).".".$ext;
			
			if(copy($file["tmp_name"][$key],ABSPATH."/".$uploadTo."/".$fileName)){
				
				if(required($oldFile)) { deleteFile(ABSPATH."/".$uploadTo."/". $oldFile); }
			}  else {
				$fileName = "";
			}
		} 																				
	} else {
		$fileName = $oldFile;
	}	
	return $fileName;
}

function getImage($img="",$dir="",$title="unknown",$w=40,$h=40,$bw="",$bh=""){
	global $TPL;
	$str = '';
	if($img) {
		$file = $dir.'/'.$img;
		if(file_exists(ABSPATH.'/uploads/'.$file) && is_file(ABSPATH.'/uploads/'.$file)) {
			$str = '<a href="'.SITEURL.'/uploads/'.$dir.'/'.$img.'" rel="prettyPhoto" class="thumb"><img src="'.SITEURL.'/core/image.inc.php?path='.$file.'&w='.$w.'&h='.$h.'" title="'.$title.'" class="img" /></a>';						
			if($TPL->pageType == "edit") {				
				$str .= '<a href="#" rel="'.$_GET["id"].'" class="delete-me" title="Delete Me"></a>';				
			}
		} else {
			$str = 'NO IMAGE';
		}
	}
	if(!$bw) $bw = $w."px"; if(!$bh) $bh = $h."px";
	return '<div class="wrap-img" style="min-width:'.$bw.'; min-height:'.$bh.'">'.$str.'</div>';
}

function getPrettyJs(){
	echo '<link rel="stylesheet" type="text/css" href="'.SITEURL.'/lib/js/prettyPhoto/css/prettyPhoto.css" />
	<script src="'.SITEURL.'/lib/js/prettyPhoto/js/jquery.prettyPhoto.js" type="text/javascript"></script>
	<script type="text/javascript"> $(document).ready( function(){ $("a[rel^=\'prettyPhoto\']").prettyPhoto({theme:\'light_square\'}); });</script>';
}

function getPaging($param="" , $type="short"){
	global $DB,$TPL,$MXTOTREC,$MXSHOWREC,$MXOFFSET;	
	if($MXTOTREC > $MXSHOWREC) {
		include_once(ABSPATH."/core/paging.class.inc.php");
		$pageUrl  = $TPL->pageUrl."?orderBy=".$_GET["orderBy"]."&order=$order&showRec=$MXSHOWREC".$param;										
		$paging   = new Paging($pageUrl,$MXTOTREC,$MXSHOWREC,"10",'offset',$type); 
		$pageNav  = $paging->GetPaging($MXOFFSET);
		return '<div class="mxpaging"><input type="text" name="showRec" id="showRec" value="'.$MXSHOWREC.'" class="show-rec" title="Show Records" />'.$pageNav.'</div>';			
	}
}
?>
