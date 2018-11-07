<?php 
$arrSearch = array(
array("type"=>"text", "name"=>"adminMenuID", "value"=>"", "title"=>"#ID", "where"=>"AND adminMenuID='SVAL'",),
array("type"=>"text", "name"=>"menuTitle", "value"=>$D["menuTitle"], "title"=>"Menu Title", "where"=>"AND menuTitle LIKE '%SVAL%'"));				
$MXFRM = new mxForm(false,true);
$strSearch = $MXFRM->getSearch($arrSearch);

$sql = "SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` WHERE (menuType = 1 OR parentID = 0) AND status='$STATUS' $MXFRM->where ORDER BY xOrder ASC";  
$DB->dbRows($sql);
$MXTOTREC = $DB->numRows;
if(!$MXFRM->where && $DB->numRows < 1)
	$strSearch = "";	 	
echo getPageNav('<a href="#" id="reset-menu">Reset Menu</a>');
echo $strSearch;
if($DB->numRows > 0) {
	$M = $DB->rows;   		
	$MXCOLS = array(
	array("#ID","adminMenuID",' width="20" align="center"'),
	array("Menu Title","menuTitle",' align="left"',true),
	array("Menu URI","seoUri",' align="left"'),
	array("Order","xOrder",' align="center"'));
  ?>
<style>div#page-action a#reset-menu { background:none; padding-left:15px;}</style>
<div id="wrap-data">
  <table border="0" cellspacing="1" cellpadding="7" class="tbl-list">
    <tr> <?php echo getListTitle($MXCOLS); ?></tr>
    <?php foreach($DB->rows as $d) { ?>
    <tr>
      <td>&nbsp;</td>
      <?php foreach ($MXCOLS as $v) { ?>
      <td<?php echo $v[2];?>><?php if($v[3]) { echo '<a href="'.ASITEURL.'/'.$TPL->modName.'-edit/?id='.$d["adminMenuID"].'" title="Click to edit"><strong>'.$d[$v[1]].'</strong></a>'; } else { echo $d[$v[1]]; } ?></td>
      <?php } ?>
    </tr>
    <?php
		$sql = "SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` WHERE parentID = '".$d["adminMenuID"]."' AND status='$STATUS' ORDER BY xOrder ASC";  
		$DB->dbRows($sql);
		if($DB->numRows > 0) {
			$S = $DB->rows;
			foreach($S as $s) { $s["menuTitle"] = "&rArr; ".$s["menuTitle"];				
		  ?>
    <tr> <?php echo getMAction("mid",$s["adminMenuID"]);?>
      <?php foreach ($MXCOLS as $v) { ?>
      <td<?php echo $v[2];?>><?php if($v[3]) { echo  getEditUrl($s["adminMenuID"],$s["menuTitle"]); } else { echo $s[$v[1]]; } ?></td>
      <?php } ?>
    </tr>
    <?php }} ?>
    <?php } ?>
  </table>
    <script language="javascript" type="text/javascript">
	$(document).ready(function(e) {		
		$("a#reset-menu").click(function(){	
			showMxLoader();		
			$.ajax({
			  url: ASITEURL+"/mod-core/admin-menu/x-admin-menu.inc.php?xAction=recreateAdminMenu",
			  success: function(data) {
				hideMxLoader();		
				window.location.reload();
			  }
			});				
			return false;	
		});
	});
	</script>
  <?php } else { ?>
  <div class="no-records">No records found</div>
  <?php } ?>
</div>
