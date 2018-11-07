<?php
$vPass = "isPassword"; 
$vCPass = "isPassword,isEqual:userPass";

if($TPL->pageType == "edit"){	
	$id = sprintf("%d",$_GET["id"]);	
	$D = $DB->dbRow("SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` WHERE ".$MXPGINFO["PK"]."='$id'");
	$vPass = ""; 
	$vCPass = "";
} else {
	$D = $_POST;	
}
$category = getTableDD($DB->pre."category","categoryID","categoryTitle",$D["categoryID"],'categoryID = 3');
$product = getTableDD($DB->pre."product","productID","productTitle",$D["productID"]);

$arrSize = array('small'=>"small",'Medium'=>"Medium",'Large'=>"Large",'XL'=>"XL",'XXL'=>"XXL");
$arrSize1 = getArrayDD($arrSize,$D["size"]);

$arrMsg["roleAID"] = "Role id custom test message";
$arrMsg["displayName"] = "asaa custom test message";
$arrFrom = array(
array("type"=>"select", "name"=>"categoryID", "value"=>$category, "title"=>"Category", "validate"=>"required", "prop"=>' class="text"'),
array("type"=>"select", "name"=>"productID", "value"=>$product, "title"=>"Product", "validate"=>"required", "prop"=>' class="text"'),
array("type"=>"select", "name"=>"size", "value"=>$arrSize1, "title"=>"Size", "validate"=>"required", "prop"=>' class="text"'),
array("type"=>"text", "name"=>"qty", "value"=>$D["qty"], "title"=>"Quantity", "validate"=>"required", "prop"=>' class="text"'));
?>
<script type="text/javascript" src="<?php echo ASITEURL?>/mod/stock/x-stock.inc.js"></script>

<form name="frmAddEdit" id="frmAddEdit" action="" method="post" onsubmit="return validateForm(this);" enctype="multipart/form-data">
  <?php echo getPageNav();?>
  <div id="wrap-data">
    <div id="wrap-form">
      <table width="100%" border="0" cellpadding="7" cellspacing="0">
        <?php $FRM = new mxForm();
				$FRM->errMsg = $arrMsg;			
				echo $FRM->getForm($arrFrom); ?>
      </table>
    </div>
    <div id="wrap-sub-form"></div>
  </div>
</form>
<?php echo getPrettyJs();?> 