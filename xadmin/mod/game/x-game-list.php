<?php
$arrSearch = array(
array("type"=>"text", "name"=>"gameID", "value"=>"", "title"=>"#ID", "where"=>"AND gameID='SVAL'"),
array("type"=>"text", "name"=>"gameTitle", "value"=>$D["gameTitle"], "title"=>"Game Title", "where"=>"AND  gameTitle LIKE '%SVAL%'"),
array("type"=>"text", "name"=>"gamePrice", "value"=>$d['gamePrice'], "title"=>"Game Price", "where"=>"AND gamePrice LIKE '%SVAL%'"),
array("type"=>"text", "name"=>"discount", "value"=>$d['discount'], "title"=>"Discount", "where"=>"AND discount LIKE '%SVAL%'"));				
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
	array("#ID","gameID",' width="1%" align="center"'),
	array("Image","imageName",' width="1%" align="center"'),
	array("Game Title","gameTitle",' align="left"',true),
	array("Synopsis","synopsis",' align="left"'),
	array("Game Price","gamePrice",' align="right"'),
	array("discount","discount",' align="center"'),
	array("Date Added","dateAdded",' align="center"'));
?>

<div id="wrap-data">
  <table border="0" cellspacing="1" cellpadding="7" class="tbl-list">
    <tr> <?php echo getListTitle($COLS); ?> </tr>
    <?php foreach($DB->rows as $d) { $d["imageName"] = getImage($d["imageName"],$MXPGINFO["TBL"],$d["imageName"]); ?>
    <tr> <?php echo getMAction("mid",$d["gameID"]);?>
      <?php foreach ($COLS as $v) { ?>
      <td<?php echo $v[2];?>><?php if($v[3]) { echo getEditUrl("id=".$d["gameID"],$d[$v[1]]); } else { echo $d[$v[1]]; } ?></td>
      <?php } ?>
    </tr>
    <?php } ?>
  </table>
</div>
<?php echo getPrettyJs();?>
<?php } else { ?>
<div class="no-records">No records found</div>
<?php } ?>

