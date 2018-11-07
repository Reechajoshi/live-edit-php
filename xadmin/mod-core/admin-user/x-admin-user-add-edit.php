<?php
$vPass = "required,"; 
$vCPass = "required,";

if($TPL->pageType == "edit"){	
	$id = sprintf("%d",$_GET["id"]);	
	$D = $DB->dbRow("SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` WHERE status='1' AND ".$MXPGINFO["PK"]."='$id'");
	$vPass = ""; 
	$vCPass = "";
} else {
	$D = $_POST;	
}
$strOpt = getTableDD($DB->pre."admin_role","roleAID","roleName",$D["roleAID"]);

$arrFrom = array(
array("type"=>"select", "name"=>"roleAID", "value"=>$strOpt, "title"=>"User Type", "validate"=>"required", "prop"=>' class="text"'),
array("type"=>"text", "name"=>"displayName", "value"=>$D["displayName"], "title"=>"Full Name", "validate"=>"required,name,minlen:5", "prop"=>' class="text"'),
array("type"=>"text", "name"=>"userName", "value"=>$D["userName"], "title"=>"Login Name", "validate"=>"required,loginname", "prop"=>' class="text"'),
array("type"=>"password", "name"=>"userPass", "value"=>"", "title"=>"Password", "validate"=>$vPass."password", "prop"=>' class="text"'),
array("type"=>"password", "name"=>"userPass1", "value"=>"", "title"=>"Varify Password", "validate"=>$vCPass."password,equalto:userPass", "prop"=>' class="text"'),
array("type"=>"text", "name"=>"userEmail", "value"=>$D["userEmail"], "title"=>"Email", "validate"=>"required,email", "prop"=>' class="text"'));

$arrFromS = array(
array("type"=>"text","title"=>"Image Dimensions" , "value"=>"Height: 0px Width: 0px", "prop"=>"disabled"),
array("type"=>"file", "name"=>"imageName", "value"=>$D["imageName"], "title"=>"Photo", "validate"=>"image", "prop"=>' class="text"'),
array("type"=>"string", "value"=>getImage($D["imageName"],$MXPGINFO["TBL"],$D["displayName"],250,180,"98%","auto")));
?>
<form name="frmAddEdit" id="frmAddEdit" action="" method="post" enctype="multipart/form-data">
  <?php echo getPageNav(); ?>
  <div id="wrap-data">
    <div id="wrap-form">
      <table width="100%" border="0" cellpadding="7" cellspacing="0">
        <?php		 
		$MXFRM = new mxForm();	
		echo $MXFRM->getForm($arrFrom,false);				
		?>
      </table>
    </div>
    <div id="wrap-sub-form"> <table width="100%" border="0" cellpadding="7" cellspacing="0">
        <?php 
			$MXFRM->formType = "sub";					
			echo $MXFRM->getForm($arrFromS); ?>
      </table></div>
  </div>
</form>
<?php echo getPrettyJs(); ?> 