<?php
global $DB;
$D = $DB->dbRow("SELECT * FROM `".$DB->pre."prizes;");
$arrFrom = array(
array("type"=>"editor", "name"=>"prize-desc", "value"=>$D["prize_desc"], "title"=>"Prize Description", "validate"=>"", "prop"=>'  style="height:400px;"')
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
    <div id="wrap-sub-form"> </div>
  </div>
</form>

