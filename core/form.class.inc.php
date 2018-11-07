<?php 
class mxForm{
 	var $validate; var $where;
	
	public function mxForm($formType = "table"){			
		$this->validate = array();
		$this->where    = "";
		$this->param    = "";
		$this->formType = $formType;
		$this->errMsg   = array();
		$this->incJs    = "";
		$this->xAction = "";
	}
	
	private function mxFormJs($eleType="") {		
		$arrJs = array(
			'mxselect'=>'<script language="javascript" type="text/javascript" src="'.SITEURL.'/core/js/mxselect.inc.js"></script>',
			'editor' =>'<script type="text/javascript" src="'.SITEURL.'/lib/js/ckeditor/ckeditor.js"></script>',
			'date'=> '<link rel="stylesheet" href="'.SITEURL.'/lib/js/ui/themes/base/jquery.ui.all.css">
					  <script src="'.SITEURL.'/lib/js/ui/jquery.ui.core.min.js"></script>
					  <script src="'.SITEURL.'/lib/js/ui/jquery.ui.widget.min.js"></script>
					  <script src="'.SITEURL.'/lib/js/ui/jquery.ui.datepicker.min.js"></script>',
			'datetime' => '<link rel="stylesheet" href="'.SITEURL.'/lib/js/ui/themes/base/jquery.ui.all.css">
						   <script src="'.SITEURL.'/lib/js/ui/jquery.ui.core.min.js"></script>
						   <script src="'.SITEURL.'/lib/js/ui/jquery.ui.widget.min.js"></script>
						   <script src="'.SITEURL.'/lib/js/ui/jquery.ui.datepicker.min.js"></script>
						   <link rel="stylesheet" href="'.SITEURL.'/lib/js/ui/jquery-ui-timepicker-addon.css">
						   <script src="'.SITEURL.'/lib/js/ui/jquery.ui.mouse.min.js"></script>
						   <script src="'.SITEURL.'/lib/js/ui/jquery.ui.slider.min.js"></script>
						   <script src="'.SITEURL.'/lib/js/ui/jquery-ui-timepicker-addon.js"></script>'
		);
		if($eleType){
			if($arrJs[$eleType])
			$this->incJs .= $arrJs[$eleType];
		}
	}	
	
	private function text($d) {	
		return '<input type="text" name="'.$d["name"].'" id="'.$d["name"].'" value="'.$d["value"].'"'.$d["prop"].' title="'.$d["title"].'" />';
	}
	
	private function textarea($d) {		
		return '<textarea name="'.$d["name"].'" id="'.$d["name"].'"'.$d["prop"].' title="'.$d["title"].'">'.$d['value'].'</textarea>';
	}
	
	private function editor($d) {
		global $MXSETTINGS;	
		if(!$MXSETTINGS["editor"]) $MXSETTINGS["editor"] = "Full";	
		$str  = '<textarea name="'.$d["name"].'" id="'.$d["name"].'"'.$d["prop"].' title="'.$d["title"].'">'.$d['value'].'</textarea>';					
		$this->incJs .= '<script type="text/javascript"> CKEDITOR.replace("'.$d["name"].'",{width:"98%",height:"300",toolbar:"'.$MXSETTINGS["editor"].'"});</script>';		
		return $str;						
	}
	
	private function file($d) {	
		return '<div class="file-box"><span></span><div>BROWSE<input type="file" size="1" id="'.$d["name"].'" name="'.$d["name"].'" value=""'.$d["prop"].' title="'.$d["title"].'" /><input type="hidden" name="'.$d["name"].'O" id="'.$d["name"].'O" value="'.$d["value"].'" /></div></div>';
	}
	
	private function select($d) {
		return '<div class="select-box"><select name="'. $d['name'].'" id="'. $d['name'].'" '. $d['prop'].' title="'.$d["title"].'"><option value="">--'. $d['title'].'--</option>'. $d['value'].'</select></div>';
	}
	
	private function mxselect($d) {		
		return '<div class="mxdd">
				  <span></span><input type="text" name="ddtext" value="Select dd val" title="Select dd val" />
				  <input type="hidden" name="ddval" value="" />
				  <ul>
					<li id="1">DD TEXT1</li>
					<li id="2">DD TEXT2</li>
					<li id="3">DD TEXT3</li>
					<li id="4">DD TEXT4</li>
					<li id="5">DD TEXT5</li>
					<li id="6">DD TEXT6</li>
					<li id="7">DD TEXT7</li>
					<li id="8">DD TEXT8</li>
				  </ul>
				</div>';			
	}
	
	public function checkbox($d){
		if(is_array($d["value"])) {
			$str = "";
			foreach($d['value'][0] as $k=>$v) {				
				$chkd = "";
				if($d['value'][1] && in_array($k,$d['value'][1])) $chkd = ' checked="checked"';
				$str.= '<li><input type="checkbox" name="'. $d['name'].'[]" id="'. $d['name'].$k.'" value="'.$k.'"  '.$chkd.$d['prop'].' /> '.$v.'</li>';
			}						
		} else {						
			$str.= '<li><input type="checkbox" name="'.$d["name"].'" id="'.$d["name"].'" value="'.$d["value"].'"'.$d['prop'].' /> '.$d['title'].'</li>';			
		}
		return '<ul id="'.$d['name'].'-set" title="'.$d["title"].'" class="mx-list mx-group">'.$str.'</ul>';		
	}
	
	public function radio($d) {		
		$str = "";			
		if(($d['value'][0])) {
			foreach($d['value'][0] as $k=>$v) {			
				$chkd = "";
				if(trim($d['value'][1]) != "" && trim($d['value'][1]) == "$k") { $chkd = ' checked="checked"'; }
				$str.= '<li><input type="radio" name="'. $d['name'].'" id="'. $d['name'].$k.'" value="'.$k.'"'.$chkd.$d['prop'].' /> '.$v.'</li>';
			}
		}
		return '<ul id="'.$d['name'].'-set" title="'.$d["title"].'" class="mx-list mx-group">'.$str.'</ul>';
	}
	
	private function password($d) {
		return '<input type="password" name="'.$d["name"].'" id="'.$d["name"].'" value="'.$d["value"].'"'.$d["prop"].' title="'.$d["title"].'" />';
	}
	
	
	private function date($d) {
		if(!$d["format"])
			$d["format"] = "yy-mm-dd";	
		$str .= '<input type="text" name="'.$d["name"].'" id="'.$d["name"].'" value="'.$d["value"].'"'.$d["prop"].' title="'.$d["title"].'" /><script>$(function() { $("input#'.$d["name"].'").datepicker({ dateFormat:"'.$d["format"].'", numberOfMonths: 2, changeMonth: true, changeYear: true });});</script>';		
		return $str;
	}

	private function datetime($d) {
		if(!$d["format"])
			$d["format"] = "yy-mm-dd";
		$str .= '<input type="text" name="'.$d["name"].'" id="'.$d["name"].'" value="'.$d["value"].'"'.$d["prop"].' title="'.$d["title"].'" /><script>$(function() { $("input#'.$d["name"].'").datetimepicker({ dateFormat:"'.$d["format"].'", numberOfMonths: 2, changeMonth: true, changeYear: true });});</script>';
		return $str;
	}
	
	private function datedd($d){
		$str = "";			
		$currYear = (date("Y")); 
		$starYearFrom = 1950;
		$arrDay = array(); 
		$arrYr = array();
		$arrMon = array("01"=>"Jan","02"=>"Feb","03"=>"Mar","04"=>"Apr","05"=>"May","06"=>"Jun","07"=>"July","08"=>"Aug","09"=>"Sep","10"=>"Oct","11"=>"Nov","12"=>"Dec");
		
		for ($i=1; $i<=31; $i++){if($i<=9) $str = '0'; else $str = ''; $i = $str.$i; $arrDay[$i] = $i; }
		for ($i=$currYear; $i>=$starYearFrom; $i--){ $arrYr[$i] = $i; }	
		$str  = '<div class="select-box"><div class="'.$d["name"].'DDWrap"><select id="'.$d["name"].'DD" name="'.$d["name"].'DD"'.$d["prop"].'><option value="">Day</option>'.getArrayDD($arrDay,$d['value'][0]).'</select></div>';
		$str .= '<div class="'.$d["name"].'MMWrap"><select id="'.$d["name"].'MM" name="'.$d["name"].'MM"'.$d["prop"].'><option value="">Month</option>'.getArrayDD($arrMon,$d['value'][1]).'</select></div>';
		$str .= '<div class="'.$d["name"].'YYWrap"><select id="'.$d["name"].'YY" name="'.$d["name"].'YY"'.$d["prop"].'><option value="">Year</option>'.getArrayDD($arrYr,$d['value'][2]).'</select></div></div>';
		$str .='<p class="e datemsg" style="display: none;">Please select valid date</p>';
		return $str;
	}
	
	private function captcha(){
		return '<input type="text" name="'.$d["name"].'" id="'.$d["name"].'" value="'.$d["value"].'"'.$d["prop"].' title="'.$d["title"].'" />';
	}
	
	private function hidden($d) {	
		return '<input type="hidden" name="'.$d["name"].'" id="'.$d["name"].'" value="'.$d["value"].'" />';
	}
	
	private function string($d) {
		return $d["value"];
	}
	
	public function getSearch($arr=array()){
		$strFrm = ""; global $MXSHOWREC;
		if($arr){			
			foreach($arr as $v){
				if($v) {
					$this->mxFormJs($v["type"]);					
					if($v["type"] != "select") {
						if($v["type"] == "text" || $v["type"] == "date")
							if($_GET[$v["name"]])
								$v["value"] = $_GET[$v["name"]];
							else
								$v["value"] = $v["title"];								
						if($_GET[$v["name"]] && $_GET[$v["name"]] != $v["title"]) {
							$this->where .= str_replace("SVAL",mysql_real_escape_string($_GET[$v["name"]]),$v["where"]);
							$this->param .= "&".$v["name"]."=".$_GET[$v["name"]];
						}							
					} else {							
						if($_GET[$v["name"]]) {
							$this->where .= str_replace("SVAL",mysql_real_escape_string($_GET[$v["name"]]),$v["where"]);
							$this->param .= "&".$v["name"]."=".$_GET[$v["name"]];
						}
					}							
					$strFrm .= "<li>".$this->{$v["type"]}($v).'</li>';				
				}					
			}				
			if($strFrm)
				$strFrm = '<div id="search-data"><form name="frmSearch" id="frmSearch" action="" method="get"><ul id="wrap-list-search">'.$this->incJs.'
								'.$strFrm.'<li><input type="submit" name="btnSearch" id="btnSearch" value="" class="search" /></li><li><input type="button" name="btnRest" id="btnReset" value="" class="refresh" /><input type="hidden" name="showRec" id="showRec" value="'.$MXSHOWREC.'" /></li>
							</ul></form></div>';
		}	
		return $strFrm;
	}
		
	public function getForm($arr=array(),$last=true){
		global $TPL;	
		$strFrm = ""; $this->where = ""; global $VERR; $arrTitle = "";		
		if($arr){													
			foreach($arr as $v){
				if($v) {					
					$this->mxFormJs($v["type"]);
					$em = ""; $err = ""; $sm = "";  $inf = "";
					if($v["validate"]) {
						$vNm = $v["name"];
						if($v["type"] == "file") {
							if($TPL->pageType == "edit")
								$vNm = $vNm."O";
						}
						if($v["type"] == "radio" || $v["type"] == "checkbox")
							$vNm = $vNm."-set";
						$this->validate[$vNm] = array("func"=>$v["validate"],"msg"=>$this->errMsg[$vNm]);

						if(strpos($v["validate"],"required") !== false)
							$em = ' <em>*</em>';
					}
												
					$arrTitle[$v["name"]] = $v["title"];					
					if($VERR[$v["name"]]){
						if($this->errMsg[$v["name"]])
							$VERR[$v["name"]] = $this->errMsg[$v["name"]];
												
						$VERR[$v["name"]] = preg_replace("/{TITLE}/",$v["title"],$VERR[$v["name"]],1);
						$VERR[$v["name"]] = str_replace("{TITLE}","",$VERR[$v["name"]]);
						
						$err = "<p class='e'>".$VERR[$v["name"]]."</p>";	
					}
					
					$strTmp = "";
					$strT = $this->{$v["type"]}($v);	
					if($strT) {																			
						$strTitle = $v["title"].$em.$v["info"];
						
						if($v["type"]=="checkbox" && !is_array($v["value"])){ $strTitle = "";}
														
						if($this->formType == "table"){
							$strTmp = '<tr'.$v['tclass'].'><th class="title" nowrap="nowrap" width="1%">'.$strTitle.'</th><td>'.$strT.$err.'</td></tr>';								
						} elseif($this->formType == "sub"){
							$strFrm .= '<tr'.$v['tclass'].'><td><span class="title">'.$strTitle.'</span>'.$strT.$err.'</td></tr>';	
						} else {
							$strTmp = '<li'.$v['tclass'].'>'.$strTitle.$strT.$err.'</li>';	
						}								
								
					}							
					$strFrm .= $strTmp;							
				}								
			}
			
			if($last){
				global $MXPGINFO;
				
				if(!$this->xAction){ if($TPL->pageType == "edit") $this->xAction = "UPDATE"; else $this->xAction = "ADD"; }
		
				$strBtn ='<input type="hidden" name="xAction" id="xAction" value="'.$this->xAction.'" />
						   <input type="hidden" name="TBL" value="'.$MXPGINFO["TBL"].'" />
						   <input type="hidden" name="PK" value="'.$MXPGINFO["PK"].'" />';
				if($_GET["id"])	
					$strBtn .= '<input type="hidden" name="'.$MXPGINFO["PK"].'" id="'.$MXPGINFO["PK"].'" value="'.$_GET["id"].'" />';
			
				if($this->validate);			
					$strBtn .='<input type="hidden" name="mxValidate" id="mxValidate" value="'.urlencode(json_encode($this->validate)).'" />';
				
				if(($this->formType == "table" || $this->formType == "sub")){
					$strFrm .= '<tr style="display:none;"><th colspan="2">'.$this->incJs.$strBtn.'</th></tr>';
				} else {
					$strFrm .= '<li style="display:none;">'.$this->incJs.$strBtn.'</li>';
				}
			}
		}	
		return $strFrm;
	}
}
?>