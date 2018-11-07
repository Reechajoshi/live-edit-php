<?php
include("config.inc.php");
$domain = $_SERVER['SERVER_NAME'];
function checkForSubdomain($domain){
	if(!substr_count($domain, '.'))
		return false;
	elseif(substr_count($domain, '.') == 1){
		return true;
	}
	elseif(substr_count($domain, '.') > 1){
		$found = substr($domain, 0,strpos($domain,"."));
		if($found){
			return false;
		}
	}
}
if(!substr_count($domain, 'www.')){
	if(checkForSubdomain($domain)){
		header("Location:http://www.$domain".$_SERVER['REQUEST_URI']);
	}
}
if($CONN = @mysql_connect($DBHOST, $DBUSER, $DBPASS)){
	mysql_query("SET CHARACTER SET 'gbk'", $CONN);
	if(!@mysql_select_db($DBNAME, $CONN)) {	
		@mysql_close($conn); 	
		die("Cannot select database $DBNAME"); 
	}
} else {
	die("Cannot connect to mySql Server."); 
}
require("core/db.class.inc.php");
require("core/formating.inc.php");
$DB = new mxDb();
require("core/common.inc.php");
?>