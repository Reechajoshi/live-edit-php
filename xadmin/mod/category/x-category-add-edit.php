<?php
if($TPL->pageType == "edit"){	
	$id = sprintf("%d",$_GET["id"]);	
	$D = $DB->dbRow("SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` WHERE status='1' AND ".$MXPGINFO["PK"]."='$id'");
	$strUri = '<input type="hidden" id="oldUri" name="oldUri" value="'.$D["seoUri"].'" />';
} else {
	$D = $_POST;	
}
$arrCats = $DB->dbRows("SELECT categoryID,categoryTitle,parentID FROM `".$DB->pre."category` WHERE 1");
$strOpt = getTreeDD($arrCats,"categoryID","categoryTitle","parentID",$D['parentID']);

$arrFrom = array(
array("type"=>"select", "name"=>"parentID", "value"=>$strOpt, "title"=>"Category Parent", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"text", "name"=>"categoryTitle", "value"=>$D["categoryTitle"], "title"=>"Category Title", "validate"=>"required,name", "prop"=>' class="text"'),
array("type"=>"editor", "name"=>"synopsis", "value"=>$D["synopsis"], "title"=>"Description", "validate"=>"", "prop"=>' class="text" rows="8"'));

$arrFromS = array(
array("type"=>"text","title"=>"Image Dimensions" , "value"=>"Height: 0px Width: 0px", "prop"=>"disabled"),
array("type"=>"file", "name"=>"categoryImage", "value"=>$D["categoryImage"], "title"=>"Image", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"string", "value"=>getImage($D["categoryImage"],$MXPGINFO["TBL"],$D["pageTitle"],250,180,"98%","auto")));

if($_SESSION["MXID"] == "SUPER")
	array_push($arrFromS,array("type"=>"text", "name"=>"templateFile", "value"=>$D["templateFile"], "title"=>"Template File", "validate"=>"", "prop"=>' class="text"'));
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
  <?php echo $strUri;?>
</form>
<?php echo getPrettyJs(); ?> 
