<?php
global $DB;
$D = $DB->dbRows("SELECT * FROM `".$DB->pre."nucards_steps`;");

$pop_up_steps_title = array();
$page_steps_title = array();
$pop_up_steps_desc = array();
$page_steps_desc = array();

foreach( $DB->rows as $d ) {
	if( $d[ 'steps_type' ] == 'pop-up' )
	{
		$pop_up_steps_title[] = $d[ 'nucards_steps_id' ];
		$pop_up_steps_desc[] = $d[ 'description' ];
	}
	else
	{
		$page_steps_title[] = $d[ 'nucards_steps_id' ];
		$page_steps_desc[] = $d[ 'description' ];
	}
}

$arrFrom = array(

array("type"=>"text", "name"=>"play_nucards_steps", "id"=>"play_nucards_steps", "value"=>"Steps to Play NU Cards: Pop Up", "prop"=>'disabled'), //FOR POP UP

array("type"=>"text", "name"=>"pop_up_steps_txt[]", "title"=>"Step 1 Text", "value"=>$pop_up_steps_title[0]),
array("type"=>"hidden", "name"=>"pop_up_steps_old_title[]", "value"=>$pop_up_steps_title[0]),
array("type"=>"editor", "name"=>"popup_step1_html", "value"=>$pop_up_steps_desc[0], "title"=>"Step 1 Description", "validate"=>"", "prop"=>'  style="height:300px;"'),

array("type"=>"text", "name"=>"pop_up_steps_txt[]", "title"=>"Step 2 Text", "value"=>$pop_up_steps_title[1]),
array("type"=>"hidden", "name"=>"pop_up_steps_old_title[]", "value"=>$pop_up_steps_title[1]),
array("type"=>"editor", "name"=>"popup_step2_html", "value"=>$pop_up_steps_desc[1], "title"=>"Step 2 Description", "validate"=>"", "prop"=>'  style="height:300px;"'),

array("type"=>"text", "name"=>"pop_up_steps_txt[]", "title"=>"Step 3 Text", "value"=>$pop_up_steps_title[2]),
array("type"=>"hidden", "name"=>"pop_up_steps_old_title[]", "value"=>$pop_up_steps_title[2]),
array("type"=>"editor", "name"=>"popup_step3_html", "value"=>$pop_up_steps_desc[2], "title"=>"Step 3 Description", "validate"=>"", "prop"=>'  style="height:300px;"'),

array("type"=>"text", "name"=>"pop_up_steps_txt[]", "title"=>"Step 4 Text", "value"=>$pop_up_steps_title[3]),
array("type"=>"hidden", "name"=>"pop_up_steps_old_title[]", "value"=>$pop_up_steps_title[3]),
array("type"=>"editor", "name"=>"popup_step4_html", "value"=>$pop_up_steps_desc[3], "title"=>"Step 4 Description", "validate"=>"", "prop"=>'  style="height:300px;"'),

array("type"=>"text", "name"=>"pop_up_steps_txt[]", "title"=>"Step 5 Text", "value"=>$pop_up_steps_title[4]),
array("type"=>"hidden", "name"=>"pop_up_steps_old_title[]", "value"=>$pop_up_steps_title[4]),
array("type"=>"editor", "name"=>"popup_step5_html", "value"=>$pop_up_steps_desc[4], "title"=>"Step 5 Description", "validate"=>"", "prop"=>'  style="height:300px;"'),

array("type"=>"text", "name"=>"play_nucards_steps", "id"=>"play_nucards_steps", "value"=>"Steps to Play NU Cards: Pages", "prop"=>'disabled'), //step 1 title
array("type"=>"text", "name"=>"page_steps_txt[]", "title"=>"Step 1 Text", "value"=>$page_steps_title[0]),
array("type"=>"hidden", "name"=>"page_steps_old_title[]", "value"=>$page_steps_title[0]),
array("type"=>"editor", "name"=>"page_step1_html", "value"=>$page_steps_desc[0], "title"=>"Step 1 Description", "validate"=>"", "prop"=>'  style="height:300px;"'),

array("type"=>"text", "name"=>"page_steps_txt[]", "title"=>"Step 2 Text", "value"=>$page_steps_title[1]),
array("type"=>"hidden", "name"=>"page_steps_old_title[]", "value"=>$page_steps_title[1]),
array("type"=>"editor", "name"=>"page_step2_html", "value"=>$page_steps_desc[1], "title"=>"Step 2 Description", "validate"=>"", "prop"=>'  style="height:300px;"'),

array("type"=>"text", "name"=>"page_steps_txt[]", "title"=>"Step 3 Text", "value"=>$page_steps_title[2]),
array("type"=>"hidden", "name"=>"page_steps_old_title[]", "value"=>$page_steps_title[2]),
array("type"=>"editor", "name"=>"page_step3_html", "value"=>$page_steps_desc[2], "title"=>"Step 3 Description", "validate"=>"", "prop"=>'  style="height:300px;"'),

array("type"=>"text", "name"=>"page_steps_txt[]", "title"=>"Step 4 Text", "value"=>$page_steps_title[3]),
array("type"=>"hidden", "name"=>"page_steps_old_title[]", "value"=>$page_steps_title[3]),
array("type"=>"editor", "name"=>"page_step4_html", "value"=>$page_steps_desc[3], "title"=>"Step 4 Description", "validate"=>"", "prop"=>'  style="height:300px;"'),

array("type"=>"text", "name"=>"page_steps_txt[]", "title"=>"Step 5 Text", "value"=>$page_steps_title[4]),
array("type"=>"hidden", "name"=>"page_steps_old_title[]", "value"=>$page_steps_title[4]),
array("type"=>"editor", "name"=>"page_step5_html", "value"=>$page_steps_desc[4], "title"=>"Step 5 Description", "validate"=>"", "prop"=>'  style="height:300px;"'),
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

