<?php
class manageTemplate {
	var $tplTitle     = "";
	var $tplInc       = "";
	var $tplFile      = "";	
	var $pageUri      = "";
	var $requestUri   = "";		
	var $pageType     = "";
	var $uriArr       = "";
	var $urlBase      = "";
	var $data         = array();
	var $currMenu     = array();
	var $modID        = 0;
	var $metaKeyword  = "";
	var $metaDesc     = "";
	var $modUrl       = "";
	var $modPath      = "";
	
	private function isModule() {	
		$arrT = array_values($this->uriArr);
		$module = $arrT[0];
		$folder = $arrT[0];		
		$seouri = "";	
		if($this->pageUri){
			$cnt = 0;
			foreach($this->uriArr as $f){				
				$fPath  = ABSPATH."/mod/$folder/x-$f.php";
				$fPath1 = ABSPATH."/mod/$folder/$f/x-$f.php";
				
				if(file_exists($fPath1) && is_file($fPath1)) {
					$cnt++;
					$this->tplFile = $fPath1;
					$this->modPath = ABSPATH."/mod/$folder/$f";
					$this->modUrl  = SITEURL."/mod/$folder/$f";
					$folder = $f;						
				} elseif (file_exists($fPath) && is_file($fPath)) {
					$cnt++;
					$this->tplFile = $fPath;					
					$this->modPath = ABSPATH."/mod/$folder";
					$this->modUrl  = SITEURL."/mod/$folder";	
					$folder = $f;
				}
			}
			if($this->tplFile){
				$this->pageType   = "module";		
				$iPath = ABSPATH."/mod/$module/x-$module.inc.php";									
				if(file_exists($iPath) && is_file($iPath))
					$this->tplInc = $iPath;
						
				if(count($this->uriArr)>$cnt){
					$fPath  = ABSPATH."/mod/$folder/x-detail.php";			
					if(file_exists($fPath) && is_file($fPath)){
						$this->tplFile = $fPath;
						$id = trim(end($arrT));					
						if($id && is_numeric($id)) {							
							$this->modID  = $id;						
						}						
					}
					
				}
			}
		}								
		return true;									
	}
	
	private function getSetMenu($seoUri, $arr,$flg=0){		
    	foreach ($arr as $arrC) {					
			if($arrC['seoUri']) {
				if(strstr($seoUri,$arrC['seoUri'])) {
					if($seoUri == $arrC['seoUri']) {
						$this->currMenu =  $arrC;
						return $this->currMenu;
					} else {
						$this->currMenu =  $arrC;
					}				
				}	
			} else if(empty($this->currMenu) && is_array($arrC["childs"])){						
					$arrTemp = $this->getSetMenu($seoUri, $arrC["childs"],$flg);
				
			}
		}		
	}
						
	private function setFiles(){
		$this->tplFile = "";
		$this->isModule();		
		
		if(!$this->tplFile){
			$this->tplTitle = "404 : Page not found";
			$this->pageType = "404";
			$this->tplFile  = ABSPATH."/x-404.php";
		}			
	}
	
	public function setPage(){	
		global $FOLDER;	
		
		if($this->requestUri == "/")
			$this->requestUri = "";
		if($FOLDER)	
			$this->requestUri = str_replace($FOLDER."/","",$this->requestUri);		
		if($this->requestUri) {
			$arrU = parse_url($this->requestUri);
			
			if($arrU["path"]) {																
				$this->uriArr  = array_filter(explode("/",$arrU["path"]));
				$this->pageUri = "/".implode("/",$this->uriArr);						
				$this->urlBase = end($this->uriArr);											
				$this->setFiles();
			}
		}
	}	
}
?>