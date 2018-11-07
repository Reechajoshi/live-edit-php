<?php
$arrP = array();
if($TPL->pageType == "edit"){
	$id = sprintf("%d",$_GET["id"]);	
	$D = $DB->dbRow("SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` WHERE status='1' AND ".$MXPGINFO["PK"]."='$id'");
	if($D["menuType"] == 1) {
		$strOpt = getTableDD($DB->pre."admin_menu","seoUri","menuTitle",$D["seoUri"],"status='1' AND adminMenuID != '".$D["adminMenuID"]."' AND menuType!='1'");
		$arrP = array("type"=>"select", "name"=>"seoUri", "value"=>$strOpt, "title"=>"Deafault Menu", "validate"=>"", "prop"=>' class="text"');
	} else {
		$strOpt = getTableDD($DB->pre."admin_menu","adminMenuID","menuTitle",$D["parentID"],"parentID='0' AND status='1' AND adminMenuID != '".$D["adminMenuID"]."'");
		$arrP = array("type"=>"select", "name"=>"parentID", "value"=>$strOpt, "title"=>"Menu Group", "validate"=>"", "prop"=>' class="text"');
			
	}
} else {
	$D = $_POST;
	$strOpt = getTableDD($DB->pre."admin_menu","seoUri","menuTitle",$D["seoUri"]," status='1' AND menuType = '0'");
	$arrP = array("type"=>"select", "name"=>"seoUri", "value"=>$strOpt, "title"=>"Deafault Menu", "validate"=>"", "prop"=>'');	
}

$arrFrom = array(
array("type"=>"text", "name"=>"menuTitle", "value"=>$D["menuTitle"], "title"=>"Menu Title", "validate"=>"required,name", "prop"=>' class="text"'),
array("type"=>"text", "name"=>"xOrder", "value"=>$D["xOrder"], "title"=>"Menu Order", "validate"=>"", "prop"=>' class="text"'));			
?>

<form name="frmAddEdit" id="frmAddEdit" action="" method="post">
<?php echo getPageNav(); ?>
  <div id="wrap-data">
    <div id="wrap-form">
      <table width="100%" border="0" cellpadding="7" cellspacing="0">
        <?php		 				
		if($arrP)
			array_unshift($arrFrom,$arrP);		
		$MXFRM = new mxForm();				
		echo $MXFRM->getForm($arrFrom);?>
      </table>
    </div>
    <div id="wrap-sub-form"> </div>
  </div>
</form>
