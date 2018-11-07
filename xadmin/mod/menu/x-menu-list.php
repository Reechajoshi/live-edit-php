<?php
$arrSearch = array(
array("type"=>"text", "name"=>"menuID", "value"=>"", "title"=>"#ID", "where"=>"AND menuID='SVAL'",),
array("type"=>"text", "name"=>"menuTitle", "value"=>$D["menuTitle"], "title"=>"Menu Title", "where"=>"AND menuTitle LIKE '%SVAL%'"),
array("type"=>"text", "name"=>"menuType", "value"=>$D["menuType"], "title"=>"Menu Type", "where"=>"AND menuType LIKE '%SVAL%'"));				
$FRM = new mxForm();
$strSearch = $FRM->getSearch($arrSearch);

$sql = "SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` WHERE status='$STATUS' $FRM->where ORDER BY xOrder ASC"; 
$DB->dbRows($sql);
$MXTOTREC = $DB->numRows;
if(!$FRM->where && $DB->numRows < 1)
	$strSearch = "";

echo getPageNav();
	
if($MXTOTREC > 0) {  	
	echo $strSearch;	
	
	$COLS = array(
	array("#ID","menuID",' width="1%" align="center"'),		
	array("Name","menuTitle",' align="left"',true),
	array("Menu URI","seoUri",' align="left"'),
	array("Menu Type","menuType",' align="left"'),
	array("Menu Class","menuClass",' align="left"'),
	array("Order","xOrder",' align="center"'));
	
	$arrD = getDepthArray($DB->rows,"parentID","menuID");
?>

<div id="wrap-data">
  <table border="0" cellspacing="1" cellpadding="7" class="tbl-list">
    <tr> <?php echo getListTitle($COLS); ?></tr>
    <?php foreach($arrD as $d) {			
			if($d["depth"])
				$d["menuTitle"] = str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$d["depth"])."|&rArr; ".$d["menuTitle"];
			else
				$d["menuTitle"] = '<strong>'.$d["menuTitle"].'</strong>';
	 ?>
    <tr>
       <?php echo getMAction("mid",$d["menuID"]);?>
      <?php foreach ($COLS as $v) { ?>
      <td<?php echo $v[2];?>><?php if($v[3]) { echo getEditUrl("id=".$d["menuID"],$d[$v[1]]); } else { echo $d[$v[1]]; } ?></td>
      <?php } ?>
    </tr>
    <?php } ?>
  </table>
</div>
<script language="javascript">
$(document).ready(function(){			
	$("a#reset-menu").click(function(){	
		//alert(ASITEURL+"/mod/menu/x-menu.inc.php?xAction=recreateMenu");
		$.ajax({
		  url: ASITEURL+"/mod/menu/x-menu.inc.php?xAction=recreateMenu",
		  success: function(data) {		
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
