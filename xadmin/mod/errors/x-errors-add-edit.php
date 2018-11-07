<?php

if($TPL->pageType == "edit"){	
	$id = $_GET["id"];	
	$D = $DB->dbRows("SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` WHERE ".$MXPGINFO["PK"]."='$id'");
} else {
	$D = $_POST;	
}

$arrFrom = array();

foreach( $D as $row )
{
	$arrFrom[] = array( "type" => "text", "name" => "err_message[".$row[ 'title' ]."]", "value" => $row[ 'error_msg' ], "title" => "INVALID ".add_spaces( $row[ 'title' ] )." ERROR MESSAGE", "validate" => "", "prop" => "class='text'" );
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