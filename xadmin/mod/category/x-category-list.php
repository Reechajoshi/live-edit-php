<?php
$arrSearch = array(
array("type"=>"text", "name"=>"categoryID", "value"=>"", "title"=>"#ID", "where"=>"AND categoryID='SVAL'",),
array("type"=>"text", "name"=>"categoryTitle", "value"=>$D["categoryTitle"], "title"=>"Category Title", "where"=>"AND categoryTitle LIKE '%SVAL%'"));				
$MXFRM = new mxForm(false,true);
$strSearch = $MXFRM->getSearch($arrSearch,false,true);


$sql = "SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` WHERE status='$STATUS' $MXFRM->where ORDER BY categoryTitle ASC";
$data = $DB->dbRows($sql);
$MXTOTREC = $DB->numRows;

if(!$MXFRM->where && $MXTOTREC < 1)
	$strSearch = "";
	
echo getPageNav();
echo $strSearch;

if($MXTOTREC > 0) {  
	$MXCOLS = array(
	array("#ID","categoryID",' width="1%" align="center"'),
	array("Name","categoryTitle",' align="left"',true),
	array("Category URI","seoUri",' align="left"'),
	array("Date Added","dateAdded",' align="center"'));
	if($_SESSION["MXID"] == "SUPER")
		array_push($MXCOLS,array("Template File","templateFile",' align="left"'));
	
	$arrD = getDepthArray($DB->rows,"parentID","categoryID");
?>

<div id="wrap-data">
  <table border="0" cellspacing="1" cellpadding="7" class="tbl-list">
    <tr> <?php echo getListTitle($MXCOLS); ?></tr>
    <?php foreach($arrD as $d) {
			$d["categoryImage"] = getImage($d["categoryImage"],$MXPGINFO["TBL"],$d["categoryTitle"]);
			if($d["depth"])
				$d["categoryTitle"] = str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$d["depth"])."|&rArr; ".$d["categoryTitle"];			
	?>
    <tr>
      <?php echo getMAction("mid",$d["categoryID"]);?>
      <?php foreach ($MXCOLS as $v) { ?>
      <td<?php echo $v[2];?>><?php if($v[3]) { echo getEditUrl("id=".$d["categoryID"],$d[$v[1]]);  } else { echo $d[$v[1]]; } ?></td>
      <?php } ?>
    </tr>
    <?php  } ?>
  </table>
</div>
<?php echo getPrettyJs();?>
<?php } else { ?>
<div class="no-records">No records found</div>
<?php } ?>
