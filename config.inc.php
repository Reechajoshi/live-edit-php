<?php
putenv("TZ=Asia/Calcutta");

/*$FOLDER ='/nu-games';
$DBHOST ='localhost';
$DBNAME ='foxy70_nu_dev';
$DBUSER = "foxy70_maxdigi"; // Database user
$DBPASS = "maxFoxy2011"; // Database password	
$DOMAIN ='demos.foxymoron.co.in';
define("APPID","180956982037311");
define("SECRET","5450a6cf147dcad1fd0fcb043fe2bdae");*/

/*$FOLDER ='/nu';
$DBHOST ='localhost';
$DBNAME ='nu_dev';
$DBUSER ='root';
$DBPASS ='';
define("APPID","124255414274987");
define("SECRET","6109bd2e4f5480077f7fa3b04092c13c");*/

$FOLDER ='/';
$DBHOST ='localhost';
$DBNAME ='nucasino_uat';
$DBUSER ='root';
$DBPASS ='db38cool7backA';
$DOMAIN ='nu-casino.com';
// define("APPID","417782604943198");
define("APPID","484251621653312");
// define("SECRET","edd66856d1c06c725e50a8963fe214fa");
define("SECRET","3a1f4804fff6afc2c03ba5fb7c57bff0");

$SKIPMOD = array("post","page","category","home");

//PLEASE DONOT EDIT LINES BELOW
if($_SERVER['HTTP_HOST']) $DOMAIN = $_SERVER['HTTP_HOST']; else $DOMAIN = $_SERVER['SERVER_NAME'];
if($_SERVER['HTTPS']) $SERV = "https"; else $SERV = "http";
define("ABSPATH",$_SERVER["DOCUMENT_ROOT"]."/".$FOLDER);
define("SITEURL",$SERV."://$DOMAIN".$FOLDER);define("AABSPATH",ABSPATH."/xadmin");
define("AABSPATH",ABSPATH."/xadmin");
define("ASITEURL",SITEURL."/xadmin");
?>