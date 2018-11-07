<?php

if($TPL->pageType == "edit"){	
	$id = $_GET["id"];	
	$D = $DB->dbRow("SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` WHERE ".$MXPGINFO["PK"]."='$id'");
} else {
	$D = $_POST;	
}

$arrFrom = array();
foreach( $D as $row )
{
	$arrFrom = array(
		array("type"=>"text", "name"=>"browser_name", "value"=>$D["browser_name"], "title"=>"Browser Name", "validate"=>"", "prop"=>"disabled"),
		array("type"=>"text", "name"=>"title", "value"=>$D["title"], "title"=>"Message Title", "validate"=>"", "prop"=>""),
		array("type"=>"text", "name"=>"message", "value"=>$D["message"], "title"=>"Browser Message", "validate"=>"", "prop"=>""),
		array("type"=>"text", "name"=>"latest_version", "value"=>$D["latest_version"], "title"=>"Latest Version", "validate"=>"", "prop"=>"")
	);
}

// print_r( $arrFrom );

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