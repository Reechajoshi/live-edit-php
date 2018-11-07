<?php
if($TPL->pageType == "edit"){	
	$id = $_GET["id"];	
	$D = $DB->dbRow("SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` WHERE ".$MXPGINFO["PK"]."='$id'");
} else {
	$D = $_POST;	
}

$arrFrom = false;
$arrFrom = array(
array("type"=>"text", "name"=>"bname", "value"=>$D["bname"], "title"=>"Name", "validate"=>"required", "prop"=>' class="text"'),
//array("type"=>"text", "name"=>"bduration", "value"=>$D["bduration"], "title"=>"Duration (sec)", "validate"=>"required", "prop"=>' class="text"'),
array("type"=>"text", "name"=>"bwidth", "value"=>$D["bwidth"], "title"=>"Width", "validate"=>"required", "prop"=>' class="text"'),
array("type"=>"text", "name"=>"bheight", "value"=>$D["bheight"], "title"=>"Height", "validate"=>"required", "prop"=>' class="text"'),
array("type"=>"file", "name"=>"bim1", "value"=>$D["bim1"], "title"=>"Image 1", "validate"=>"", "prop"=>'  style="height:400px;"'),
array("type"=>"string", "value"=>getImage($D["bim1"],$MXPGINFO["TBL"],"Banner",730,50,"98%","auto")),
array("type"=>"file", "name"=>"bim2", "value"=>$D["bim2"], "title"=>"Image 2", "validate"=>"", "prop"=>'  style="height:400px;"'),
array("type"=>"string", "value"=>getImage($D["bim2"],$MXPGINFO["TBL"],"Banner",730,50,"98%","auto")),
array("type"=>"file", "name"=>"bim3", "value"=>$D["bim3"], "title"=>"Image 3", "validate"=>"", "prop"=>'  style="height:400px;"'),
array("type"=>"string", "value"=>getImage($D["bim3"],$MXPGINFO["TBL"],"Banner",730,50,"98%","auto"))
);

$arrFromS = array();
?>

<form name="frmAddEdit" id="frmAddEdit" action="" method="post" enctype="multipart/form-data">
  <?php echo getPageNav(); ?>
  <div id="wrap-data">
    <div id="wrap-form">
      <table width="100%" border="0" cellpadding="7" cellspacing="0">
        <?php		 
		$MXFRM = new mxForm();			
		echo $MXFRM->getForm($arrFrom,true);
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
<?php echo getPrettyJs(); ?> 