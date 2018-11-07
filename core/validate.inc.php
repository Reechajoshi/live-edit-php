<?php
function required($value) { return preg_replace('/^\s*|\s*$/','',$value); }
function checked($value,$param) { if(!$value) return false;	if(is_array($value)) return count($value) >= $param; else return $value; }
function minlen($value, $param) { return (intval(strlen($value)) >= intval($param)); }
function maxlen($value, $param) { return (intval(strlen($value)) <= intval($param)); }
/*function maxlen($value, $element, $param) { return (parseFloat($value.length) <= parseFloat($param) && parseFloat($value.length) > 0);}
function rangelen($value, $element, $param) { var range = $param.split("~"); return ((parseFloat($value.length) >= parseFloat(range[0])) && (parseFloat($value.length) <= parseFloat(range[1]))); }
function min($value, $element, $param) { if(isNaN($value)) return false; return (parseFloat($value) >= parseFloat($param)); }
function max($value, $element, $param) { if(isNaN($value)) return false; return (parseFloat($value) <= parseFloat($param)); }
function range($value, $element, $param) { if(isNaN($value)) return false; var range = $param.split("~"); return (parseFloat($value) >= parseFloat(range[0]) && parseFloat($value) <= parseFloat(range[1])); }*/
function alpha($value) { return preg_match("/^[a-z ._\-]+$/i",$value);	}
function number($value) { return preg_match("/^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/",$value);	}
function digits($value) { return preg_match("/^\d+$/",$value); }
function alphanum($value) { return preg_match("/^[a-z\d ._\-]+$/i",$value); }
function equalto($value, $param) { return $value == $_REQUEST[$param] && $value != ""; }
function name($value) { return strlen($value) >= 4 && preg_match('/^[a-z0-9 ]+$/i',$value);	}
function email($value) { return preg_match("/^([a-zA-Z\d_\.\-\+%])+\@(([a-zA-Z\d\-])+\.)+([a-zA-Z\d]{2,4})+$/",$value);}
function loginname($value) { return  preg_match("/^[A-Za-z0-9_]{3,100}$/",$value); }
function password($value) { return preg_match("/^[A-Za-z0-9!@#$%^&*()_]{5,100}$/",$value); }
function image($value) { return preg_match("/\.(jpg|jpeg|png|gif|bmp)$/i",$value); }
//function date($value) { return !/Invalid|NaN/.test(new Date($value));	},
function dateISO($value) { return preg_match("/^\d{4}[\/-]\d{1,2}[\/-]\d{1,2}$/",$value);	}						
//function accept($value, $element, $param) { $param = typeof $param == "string" ? $param.replace(/,/g, '|') : "png|jpe?g|gif|bmp"; return $value.match(new RegExp(".(" + $param + ")$", "i")); }
function url($value) { return preg_match("/^(http|https|ftp)\:\/\/[a-z\d\-\.]+\.[a-z]{2,3}(:[a-z\d]*)?\/?([a-z\d\-\._\?\,\'\/\\\+&amp;%\$#\=~])*$/i",$value); }

class mxValidate{
	var $arrV; var $msg; var $mxerr = array();
	function mxValidate($arrV){		
		$this->arrV = $arrV; 
		$this->msg = array(
			'required' => '{TITLE} cannot be blank',
			'checked'  => 'Please select atleast {0} {TITLE}',
			'minlen'   => '{TITLE} length must be at least {0} characters',
			'maxlen'   => '{TITLE} length must be at max {0} characters',
			'rangelen' => '{TITLE} length must be between {0} and {1}',
			'min'  	   => '{TITLE} should be a number greater than or equal to {0}',
			'max'      => '{TITLE} should be a number less than or equal to {0}',
			'range'    => '{TITLE} should be a number between {0} and {1}.',		
			'alpha'    => '{TITLE} should be alphabetic characters only.',
			'number'   => '{TITLE} should be number[0-9]',
			'digit'    => '{TITLE} should be only digits.',
			'alphanum' => '{TITLE} should be alphanumeric characters only.',	
			'equalto'  => '{TITLE} should be equals to {0}',
			'name'     => '{TITLE} can contain only letters and numbers and space',
			'email'    => '{TITLE} is not a valid email',
			'loginname'=> '{TITLE} should be more than 3 characters, can contain only letters, numbers, and underscores',
			'password' => '{TITLE} should be more than five characters, should not contain any space',	
			'image'    => '{TITLE} should only contain image types',
			'date'     => '{TITLE} should be a valid date.',
			'dateISO'  => '{TITLE} should be a valid date (ISO).',
			'time'     => '{TITLE} is not a valid time',				
			'url'      => '{TITLE} is not a valid url'		
		);
	
		if($this->arrV) {			
			foreach($this->arrV as $fld => $vali){
				$fld = str_replace("-set","",$fld);
				$arrF = explode(",",$vali->func);				
				$arrMsg = array();
				foreach($arrF as $arr){
					list($func,$arrp) = explode(":",$arr);															
					if($func) {
						$val = $_POST[$fld];
						if($_FILES[$fld])
							$val = trim($_FILES[$fld]["name"]);
						
						if(strstr($vali->func,"required")){							
							$ret = call_user_func($func,$val,$arrp);	
						} else {
							if($val)
								$ret = call_user_func($func,$val,$arrp);																								
						}
						
						if($ret == false) {
							$msg = $this->msg[$func];
							if($arrp){								
								$params = explode("~",$arrp);
								foreach($params as $i=>$param) {																	
									$msg = str_replace( '{'.$i.'}',$param,$msg);									
								}								
							}
							array_push($arrMsg,$msg);
						}						
					}
				}
				if(count($arrMsg) > 0)
					$this->mxerr[$fld] = implode(", ",$arrMsg);													
			}			
		}		
	}
}

if($_POST["mxValidate"]){
	$arrV = json_decode((urldecode($_POST["mxValidate"])));	
	$OBJERR = new mxValidate($arrV);
	$VERR = $OBJERR->mxerr;	
}
?>