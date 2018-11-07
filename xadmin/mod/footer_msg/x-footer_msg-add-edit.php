<?php
global $DB;
$D = $DB->dbRow("SELECT * FROM `".$DB->pre."footer_msg`;");
$font_size = array( "1" => "small", "2" => "medium", "3" => "large" );
$font_size_DD_01 = getArrayDD( $font_size, $D[ 'message01_font_size' ] );
$font_size_DD_02 = getArrayDD( $font_size, $D[ 'message02_font_size' ] );

$arrFrom = array(
	array("type"=>"editor", "name"=>"footer_message_01", "value"=>html_entity_decode($D["message01"],ENT_COMPAT,"UTF-8"), "title"=>"Footer Message 01", "validate"=>"", "prop"=>''),
	array("type"=>"text", "name"=>"footer_message_02", "value"=>html_entity_decode($D["message02"],ENT_COMPAT,"UTF-8"), "title"=>"Footer Message 02", "validate"=>"", "prop"=>'')
);

$arrFromS = array(
	/* array("type"=>"select", "name"=>"footer_msg_01_size", "value"=>$font_size_DD_01, "title"=>"Footer Message 01 Font Size", "validate"=>"required", "prop"=>' class="text"'), */
	array("type"=>"select", "name"=>"footer_msg_02_size", "value"=>$font_size_DD_02, "title"=>"Footer Message 02 Font Size", "validate"=>"required", "prop"=>' class="text"')
);

?>

<form name="frmAddEdit" id="frmAddEdit" action="" method="post" enctype="multipart/form-data">
  <div id="page-nav">
    <div class="mandatory">Fields with (<em>* </em>) are mandatory</div>
    <div id="navigate">
      <input type="submit" name="btnSubmit" id="btnSubmit" class="btn-medium" value="UPDATE" />
    </div>
  </div>
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
	<table width="100%" border="0" cellpadding="7" cellspacing="0">
        <?php 
			$MXFRM->formType = "sub";					
			echo $MXFRM->getForm($arrFromS); ?>
      </table>
	</div>
  </div>
</form>

