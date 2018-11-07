<?php 
if(!$_SESSION["SITEUSERID"]){ 
	echo '<script language="javascript">location.href="'.SITEURL.'";</script>'; exit; 
} 
?>
<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/mod/user/inc/js/ajaxfileupload.js"></script>
<script type="text/javascript" src="<?php echo SITEURL; ?>/mod/user/x-user.inc.js"></script>
<?php
$siteUserID = $TPL->modID;

$sql = "SELECT U.*, C.countryName FROM `".$DB->pre."site_user` U LEFT JOIN ".$DB->pre."country AS C ON(U.countryID=C.countryID) WHERE U.status='1' AND U.siteUserID='".sprintf("%d",$siteUserID)."'";
$result = mysql_query($sql);
$D = $DB->dbRow($sql);
$MXTOTREC = $DB->numRows;

include("profile.php");
?>

