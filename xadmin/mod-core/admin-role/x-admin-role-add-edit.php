<?php
if($TPL->pageType == "edit"){
	$id = sprintf("%d",$_GET["id"]);	
	$D = $DB->dbRow("SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` WHERE status='1' AND ".$MXPGINFO["PK"]."='$id'");
	$S = getAccess($id);
} else {
	$D = $_POST;
	$S = $_POST["access"];	
}
?>
<style>
table.tbl-grid td {
	background-color: #E5E5E5;
	text-transform: uppercase;
}
table.tbl-grid th {
	background-color: #DBDBDB;
	text-transform: uppercase;
}
input.allv {
	margin-top: 5px;
}
</style>

<form name="frmAddEdit" id="frmAddEdit" action="" method="post" enctype="multipart/form-data">
  <?php echo getPageNav(); ?>
  <div id="wrap-data">
    <div id="wrap-form">
      <table width="100%" border="0" cellpadding="8" cellspacing="1" class="tbl-grid" id="tbl-access">
        <tr>
          <th align="left">Menu Name</th>
          <th>SELECT<br />
            ALL</th>
          <?php 
			foreach($MXACCESS as $v) {
				echo '<th align="center" width="60">'.ucfirst($v).' <br> <input type="checkbox" class="checkbox allv" /></th>';
			} 
		  ?>
        </tr>
        <?php										
		$sql  = "SELECT * FROM mx_admin_menu WHERE menuType = '0' ORDER BY xOrder ASC";			
		$DB->dbRows($sql);
		if($DB->numRows){
			$sub = $DB->rows;					
			//echo '<tr><th colspan="8" align="left">'.$v["menuTitle"].'</th></tr>';
			foreach($sub as $d) {
				echo '<tr><td align="left">'.$d["menuTitle"].'</td><td><input type="checkbox" class="checkbox allh" /></td>';
				foreach($MXACCESS as $m) {
					$ckd = '';
					if($S[$d["adminMenuID"]]) {										
						if(in_array($m,$S[$d["adminMenuID"]]))
							$ckd = ' checked="checked"';
					}
					echo '<td align="center"><input type="checkbox" name="access['.$d["adminMenuID"].'][]" value="'.$m.'"'.$ckd.'class="checkbox" /></td>';
				}	
				echo '</tr>';								
			}								
		}			
		if($_SESSION["MXROLE"] == "SUPER"){ 
			echo '<tr><th align="left">Admin Menu<th colspan="6"><th>&nbsp;</th></tr>';
			foreach($MXADMINROLE as $k=>$v){
				echo '<tr><td align="left">'.$v.'</td><td><input type="checkbox" class="checkbox allh" /></td>';
				foreach($MXACCESS as $m) {
					$ckd = '';
					if($S[$k]) {										
						if(in_array($m,$S[$k]))
							$ckd = ' checked="checked"';
					}
					echo '<td align="center"><input type="checkbox" name="access['.$k.'][]" value="'.$m.'"'.$ckd.'class="checkbox" /></td>';
				}	
				echo '</tr>';
			}
		}
		?>
      </table>
    </div>
    <div id="wrap-sub-form">
      <table width="100%" border="0" cellpadding="7" cellspacing="0">
        <?php		 
            $arrFrom = array(
            array("type"=>"text", "name"=>"roleName", "value"=>$D["roleName"], "title"=>"Role Name", "validate"=>"required,name", "prop"=>' class="text"'));			
            $MXFRM = new mxForm();
			$MXFRM->button   = false;
            echo $MXFRM->getForm($arrFrom);?>
      </table>
    </div>
  </div>
</form>
<script>
 $(document).ready(function () {
	$('.allh').click(function () {
		var status = $(this).attr('checked');
		if(!status)
			status = false;
		$(this).parent().parent().find("input").attr('checked', status);
	});
	$('.allv').click(function () {		
		var index = $(this).parent().index();
		var status = $(this).attr('checked');
		if(!status)
			status = false;	
		$("#tbl-access tr:not(:first)").each(function(){
			$(this).find("input").eq(index-1).attr('checked', status);
		});
	});    
});
</script> 
