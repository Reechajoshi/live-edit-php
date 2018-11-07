<?php
class manageTemplate {	
	var $tplInc     = "";
	var $tplFile    = "";	
	var $pageUri    = "";
	var $requestUri = "";
	var $tplDefault = "";
	var $tplTitle   = "";
	var $modName    = "";
	var $pageType   = "";
	var $access     = array();
	var $mAcces     = array();
	var $pageUrl    = "";
	
	public function getAccess($roleAID="") {
		$arr = array(); global $DB,$MXADMINMENU1;
		if($roleAID == "SUPER"){									
			global $MXACCESS;																
			foreach($MXADMINMENU1 as $v){
				if($this->modName == $v["seoUri"])
					$this->tplTitle = ucfirst($this->pageType)." ".$v["menuTitle"];
				$this->mAccess[$v["seoUri"]] = $MXACCESS;	
			}	
				
			$sql = "SELECT seoUri,menuTitle FROM `".$DB->pre."admin_menu` WHERE status = '1'";					
			$A = $DB->dbRows($sql);
			if($DB->numRows > 0) {
				foreach($DB->rows as $m){
					$this->mAccess[$m["seoUri"]] = $MXACCESS;
					if($m["seoUri"] == $this->modName)
					{
						if( strtolower( $m["menuTitle"] ) === 'font' )
							$this->tplTitle = $m["menuTitle"];
						else
							$this->tplTitle = ucfirst($this->pageType)." ".$m["menuTitle"];
					}	
				}
				$arr = $this->mAccess[$this->modName];
			}						
		} else {
			$arr=array();
			if(intval($roleAID)) {
				$sql = "SELECT A.adminMenuID,A.accessType,M.seoUri,M.menuTitle FROM `".$DB->pre."admin_user_access` AS A 
						LEFT JOIN `".$DB->pre."admin_menu` AS M ON M.adminMenuID=A.adminMenuID AND M.status = '1' 
						WHERE A.roleAID='".sprintf("%d",$roleAID)."'";
				$A = $DB->dbRows($sql);				
				if($DB->numRows > 0) {
					foreach($DB->rows as $m){
						if(array_key_exists($m["adminMenuID"],$MXADMINMENU1)){
							$m["seoUri"] = $MXADMINMENU1[$m["adminMenuID"]]["seoUri"];
							$m["menuTitle"] = $MXADMINMENU1[$m["adminMenuID"]]["menuTitle"];
						}
						
						$this->mAccess[$m["seoUri"]] = json_decode($m["accessType"]);
						if($m["seoUri"] == $this->modName)
							$this->tplTitle = ucfirst($this->pageType)." ".$m["menuTitle"];
					}
					if($this->mAccess[$this->modName])										
					$arr = $this->mAccess[$this->modName];
				}						
			}
		}
		return $arr;
	}
	
	private function setFiles(){
		global $MXPGFILE,$MXACTION; $fileName = ""; $this->tplFile = AABSPATH."/x-404.php"; $this->tplTitle = "404 : Page not found";		
		$this->access = $this->getAccess($_SESSION["MXROLE"]);
			
		if($this->access && $MXACTION[$this->pageType]) {
			if(in_array("view",$this->access)) {
				$arrC = array_intersect($MXACTION[$this->pageType],$this->access);
				if($arrC)
					$fileName = "x-".$this->modName."-".$MXPGFILE[$this->pageType].".php";			
			}
		}		
		if($fileName){
			$mUrl = AABSPATH."/mod/".$this->modName."/";
			$amUrl = AABSPATH."/mod-core/".$this->modName."/";	
			
			if(file_exists($amUrl.$fileName) && is_file($amUrl.$fileName)) {						
				$this->tplFile = $amUrl.$fileName;
				$this->tplInc  = $amUrl."x-".$this->modName.".inc.php";	
			} elseif(file_exists($mUrl.$fileName) && is_file($mUrl.$fileName)) {
				$this->tplFile = $mUrl.$fileName;
				$this->tplInc  = $mUrl."x-".$this->modName.".inc.php";
			} else {
				$this->tplFile = AABSPATH."/x-404.php"; $this->tplTitle = "404 : Page not found";
			}
			$this->pageUrl = ASITEURL."/".$this->pageUri."/";
		}		
	}
	
	public function setPage(){
		global $FOLDER;		
		$this->requestUri = str_replace($FOLDER."/xadmin/","",$this->requestUri);
		$arrU = parse_url($this->requestUri);		
		$this->pageUri = basename($arrU["path"]);
		if(isAdminUser()) {												
			if(!$this->pageUri || $this->pageUri=="login") { header("location:".ASITEURL."/$this->tplDefault/"); exit; }			
			$arrT = explode("-",$this->pageUri);
			$this->pageType = end($arrT);
			$this->modName  = str_replace("-".$this->pageType,"",$this->pageUri);								
			$this->setFiles();		
		} else if($this->pageUri != "login") {				
			header("location:".ASITEURL."/login/?redirect=".urlencode($this->requestUri)); exit;
		}		
	}	
}
?>