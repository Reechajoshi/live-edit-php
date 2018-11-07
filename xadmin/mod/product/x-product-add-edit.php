<?php
$vPass = "isPassword"; 
$vCPass = "isPassword,isEqual:userPass";

/*$arrMeta = array();
$arrMeta = $DB->dbRows("SELECT * FROM `".$DB->pre."property_meta` WHERE propertyID='".$D["propertyID"]."'");*/
if($TPL->pageType == "edit"){	
	$id = sprintf("%d",$_GET["id"]);	
	$D = $DB->dbRow("SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` WHERE status='1' AND ".$MXPGINFO["PK"]."='$id'");
	$vPass = ""; 
	$vCPass = "";
} else {
	$D = $_POST;	
}
$category = getTableDD($DB->pre."category","categoryID","categoryTitle",$D["categoryID"]);
$arrMsg["roleAID"] = "Role id custom test message";
$arrMsg["displayName"] = "asaa custom test message";
$arrFrom = array(
array("type"=>"select", "name"=>"categoryID", "value"=>$category, "title"=>"Category", "validate"=>"required", "prop"=>' class="text"'),
array("type"=>"text", "name"=>"productTitle", "value"=>$D["productTitle"], "title"=>"Product Title", "validate"=>"required", "prop"=>' class="text"'),
array("type"=>"text", "name"=>"productPrice", "value"=>$D["productPrice"], "title"=>"Product Price", "validate"=>"required", "prop"=>' class="text"'),
array("type"=>"text", "name"=>"discount", "value"=>$D["discount"], "title"=>"Discount", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"editor", "name"=>"synopsis", "value"=>$D["synopsis"], "title"=>"synopsis", "validate"=>"required", "prop"=>' class="text"'),
array("type"=>"editor", "name"=>"description", "value"=>$D["description"], "title"=>"Content", "validate"=>"required", "prop"=>' rows="18" cols="60"'));

$arrFromS = array(
array("type"=>"text", "title"=>"Image Dimensions", "value"=>"Height: ".$D['productImg1_ht']."px Width: ".$D['productImg1_wd']."px", "prop"=>"disabled"),
array("type"=>"file", "name"=>"productImg1", "value"=>$D["productImg1"], "title"=>"Photo 1", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"string", "value"=>getImage($D["productImg1"],$MXPGINFO["TBL"],$D["productTitle"],250,180,"98%","auto")),

array("type"=>"text", "title"=>"Image Dimensions", "value"=>"Height: ".$D['productImg2_ht']."px Width: ".$D['productImg2_wd']."px", "prop"=>"disabled"),
array("type"=>"file", "name"=>"productImg2", "value"=>$D["productImg2"], "title"=>"Photo 2", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"string", "value"=>getImage($D["productImg2"],$MXPGINFO["TBL"],$D["productTitle"],250,180,"98%","auto")),

array("type"=>"text", "title"=>"Image Dimensions", "value"=>"Height: ".$D['productImg3_ht']."px Width: ".$D['productImg3_wd']."px", "prop"=>"disabled"),
array("type"=>"file", "name"=>"productImg3", "value"=>$D["productImg3"], "title"=>"Photo 3", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"string", "value"=>getImage($D["productImg3"],$MXPGINFO["TBL"],$D["productTitle"],250,180,"98%","auto")),

array("type"=>"text", "title"=>"Image Dimensions", "value"=>"Height: ".$D['productImg4_ht']."px Width: ".$D['productImg4_wd']."px", "prop"=>"disabled"),
array("type"=>"file", "name"=>"productImg4", "value"=>$D["productImg4"], "title"=>"Photo 4", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"string", "value"=>getImage($D["productImg4"],$MXPGINFO["TBL"],$D["productTitle"],250,180,"98%","auto")));

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
    <div id="wrap-sub-form">
      <table width="100%" border="0" cellpadding="7" cellspacing="0">
        <?php 
			$MXFRM->formType = "sub";					
			echo $MXFRM->getForm($arrFromS); ?>
      </table>
    </div>
  </div>
</form>
<?php echo getPrettyJs();?> 