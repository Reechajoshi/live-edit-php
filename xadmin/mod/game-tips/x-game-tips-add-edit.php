<?php
if($TPL->pageType == "edit"){	
	$id = sprintf("%d",$_GET["id"]);	
	$D = $DB->dbRow("SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` WHERE status='1' AND ".$MXPGINFO["PK"]."='$id'");
	$vPass = ""; 
	$vCPass = "";
} else {
	$D = $_POST;	
}
$gameArr = getTableDD($DB->pre."game","gameID","gameTitle",$D["gameID"]);

$arrFrom = array(
array("type"=>"select", "name"=>"gameID", "value"=>$gameArr, "title"=>"Game", "validate"=>"required", "prop"=>' class="text"'),
array("type"=>"text", "name"=>"gameTipTitle", "value"=>$D["gameTipTitle"], "title"=>"Game Tip Title", "validate"=>"required", "prop"=>' class="text"'),
array("type"=>"editor", "name"=>"gameTipText", "value"=>$D["gameTipText"], "title"=>"Game Tip Text", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"text","title"=>"Image Dimensions" , "value"=>"Height: 337px Width: 192px", "prop"=>"disabled"),
array("type"=>"file", "name"=>"gameTipImage", "value"=>$D["gameTipImage"], "title"=>"Game Tip Image", "validate"=>"", "prop"=>' class="text"'),
array("type"=>"string", "value"=>getImage($D["gameTipImage"],$MXPGINFO["TBL"],$D["gameTipImage"],250,180,"98%","auto")));

?>
<form name="frmAddEdit" id="frmAddEdit" action="" method="post" enctype="multipart/form-data">
  <?php echo getPageNav(); ?>
  <div id="wrap-data">
    <div id="wrap-form">
      <table width="100%" border="0" cellpadding="7" cellspacing="0">
        <?php		 
		$MXFRM = new mxForm();			
		echo $MXFRM->getForm($arrFrom);				
		?>
      </table>
    </div>
    <div id="wrap-sub-form">
    </div>
  </div>
</form>
<?php echo getPrettyJs();?> 