<img src="http://www.nu-casino.com/temp/core/image.inc.php?path=game/0949415001351517015.png&w=202&h=402&type=ratio" />
<?php
set_time_limit(0);
phpinfo();
die;
session_start();
header('Content-type: text/xml');
require('config.inc.php');
require('connectdb.inc.php');

$siteUserID = intval($_SESSION['SITEUSERID']);

$str.='<?xml version=\'1.0\' encoding=\'UTF-8\'?>
	<userDetails>';
$sql = "SELECT UG.*, U.userName, U.userChips, G.gameTitle FROM user_game UG LEFT JOIN mx_game AS G ON(UG.gameID=G.gameID) LEFT JOIN mx_site_user AS U ON(UG.siteUserID=U.siteUserID) WHERE U.siteUserID = '".$siteUserID."'";
$DB->dbRows($sql);
if($DB->numRows > 0){
	foreach($DB->rows as $d){
$str.='
	<userExists>
		<user userName="'.$d['userName'].'"/>
		<user userGame="'.$d['gameTitle'].'"/>
		<user userChips="'.$d['userChips'].'"/>
		<user gameTime="'.$d['timeIN'].'"/>
	</userExists>';
	}
}else{
	$str.='<userNotExists>
		<userError errorMessage="No user found"/>
	</userNotExists>';
}
$str.='</userDetails>';
echo $str;
?>
