<?php
$arrSearch = array(
array("type"=>"text", "name"=>"middleGalID", "value"=>"", "title"=>"#ID", "where"=>"AND middleGalID='SVAL'"),
array("type"=>"text", "name"=>"middleGalTitle", "value"=>$D["middleGalTitle"], "title"=>"Title", "where"=>"AND  middleGalTitle LIKE '%SVAL%'"));
$FRM = new mxForm();
$strSearch = $FRM->getSearch($arrSearch);

$sql = "SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` WHERE status='$STATUS' $FRM->where";
//echo $sql;
$DB->dbQuery($sql);
$MXTOTREC = $DB->numRows;

if(!$FRM->where && $MXTOTREC < 1)
	$strSearch = "";
echo getPageNav();
echo $strSearch;
if($MXTOTREC > 0) {	
	$sql = "SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` WHERE status='$STATUS' $FRM->where LIMIT $MXOFFSET,$MXSHOWREC"; 
	$DB->dbRows($sql);
	$COLS = array(
	array("#ID","middleGalID",' width="1%" align="center"'),
	array("Image","imageName",' width="20%" align="center"'),
	array("Icon","iconImage",' width="20%" align="center"'),
	array("Title","middleGalTitle",' width="30%" align="center"',true),
	array("Date Added","dateAdded",' align="center"'));
?>

<div id="wrap-data">
  <table border="0" cellspacing="1" cellpadding="7" class="tbl-list">
    <tr> <?php echo getListTitle($COLS); ?> </tr>
    <?php 
	foreach($DB->rows as $d) { 
		$d["imageName"] = getImage($d["imageName"],$MXPGINFO["TBL"],$d["imageName"]); 
		$d["iconImage"] = getImage($d["iconImage"],$MXPGINFO["TBL"],$d["iconImage"]);
	?>
    <tr> <?php echo getMAction("mid",$d["middleGalID"]);?>
      <?php foreach ($COLS as $v) { ?>
      <td<?php echo $v[2];?>><?php if($v[3]) { echo getEditUrl("id=".$d["middleGalID"],$d[$v[1]]); } else { echo $d[$v[1]]; } ?></td>
      <?php } ?>
    </tr>
    <?php } ?>
  </table>
</div>
<?php echo getPrettyJs();?>
<?php } else { ?>
<div class="no-records">No records found</div>
<?php } ?>

