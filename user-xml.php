<?php
session_start();
header('Content-type: text/xml');
require('config.inc.php');
require('connectdb.inc.php');

require('inc_mg/inc.sess.php');

error_log( "------------- USERNAME:".$_SESSION['SITEUSERID']."-- gameID:".$_SESSION['gameID'] );

if( isSessOK() )
{
	$siteUserID = $_SESSION['SITEUSERID'];
	$gameID = $_SESSION['gameID'];
	$sql = "SELECT userName, userChips, (SELECT gameTitle FROM ".$DB->pre."game WHERE gameID = '$gameID') as gameTitle  FROM ".$DB->pre."site_user WHERE siteUserID = '".$siteUserID."'";
	
	$data = $DB->dbRow($sql);
	$str.='<?xml version=\'1.0\' encoding=\'UTF-8\'?>
		<userDetails>';
	if($siteUserID){
		$str.='
		<userExists>
			<user userName="'.$data['userName'].'"/>
			<user userGame="'.$data['gameTitle'].'"/>
			<user userChips="'.$data['userChips'].'"/>
		</userExists>';
	}else{
		$str.='<userNotExists>
			<userError errorMessage="No user found"/>
		</userNotExists>';
	}
	$str.='</userDetails>';
	echo $str;
}
else
{
	$str ='<?xml version=\'1.0\' encoding=\'UTF-8\'?>
		<userDetails>
		<userNotExists>
		</userNotExists>
		</userDetails>';
		
	echo( $str );
}	
?>
