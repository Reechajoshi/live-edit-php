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
//$city = getTableDD($DB->pre."city","cityID","cityName",$D["cityID"]);
//$state = getTableDD($DB->pre."state","stateID","stateName",$D["stateID"]);
$country = getTableDD($DB->pre."country","countryID","countryName",$D["countryID"]);
//$arrGender = array(1=>"Male",2=>"Female");
//$arrGender = getArrayDD($arrGender,$D["gender"]);
$arrFrom = array(
array("type"=>"text", "name"=>"userName", "value"=>$D["userName"], "title"=>"Username", "validate"=>"required", "prop"=>' class="text"'),
array("type"=>"password", "name"=>"userPass", "value"=>"", "title"=>"Password", "validate"=>$vPass."password", "prop"=>' class="text"'),
array("type"=>"password", "name"=>"userPass1", "value"=>"", "title"=>"Varify Password", "validate"=>$vCPass."password,equalto:userPass", "prop"=>' class="text"'),
array("type"=>"text", "name"=>"userEmail", "value"=>$D["userEmail"], "title"=>"Email", "validate"=>"email", "prop"=>' class="text"'),
array("type"=>"text","name"=>"userGender", "value"=>$D["userGender"], "title"=>"Gender", "validate"=>"required", "prop"=>' class="text"'),
array("type"=>"date", "name"=>"userDob", "value"=>$D["userDob"], "title"=>"DOB", "validate"=>"", "prop"=>' class="calender"'),
array("type"=>"textarea", "name"=>"aboutMe", "value"=>$D["aboutMe"], "title"=>"About Me", "validate"=>"", "prop"=>' class="text" rows="5"'),
array("type"=>"text","title"=>"Image Dimensions" , "value"=>"Height: 162px Width: 162px", "prop"=>"disabled"),
array("type"=>"file", "name"=>"imageName", "value"=>$D["imageName"], "title"=>"Image", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"string", "value"=>getImage($D["imageName"],$MXPGINFO["TBL"],$D["userName"],100,100,"98%","auto")));

$arrFromS = array(
array("type"=>"text","name"=>"userFirstName", "value"=>$D["userFirstName"], "title"=>"First Name", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"text","name"=>"userLastName", "value"=>$D["userLastName"], "title"=>"Last Name", "validate"=>"", "prop"=>' class="text"'),array("type"=>"text","name"=>"userContact", "value"=>$D["userContact"], "title"=>"Phone Number", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"text","name"=>"userContact", "value"=>$D["userContact"], "title"=>"Phone Number", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"text", "name"=>"userCity", "value"=>$D["userCity"], "title"=>"City", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"text", "name"=>"userState", "value"=>$D["userState"], "title"=>"State", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"select", "name"=>"countryID", "value"=>$country, "title"=>"Country", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"text", "name"=>"zip", "value"=>$d['zip'], "title"=>"ZIP Code", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"textarea", "name"=>"userAddress", "value"=>$D["userAddress"], "title"=>"Address", "validate"=>"", "prop"=>' class="text"'));
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