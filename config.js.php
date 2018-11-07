<?php include("config.inc.php"); 
$const = get_defined_constants(true);  
if($const['user']){
	foreach($const['user'] as $k=>$v){
		echo "var $k = '$v';";
	}
}
?>