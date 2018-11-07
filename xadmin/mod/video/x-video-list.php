<?php
$arrSearch = array(
array("type"=>"text", "name"=>"videoID", "value"=>"", "title"=>"#ID", "where"=>"AND videoID='SVAL'"),
array("type"=>"text", "name"=>"videoTitle", "value"=>$D["videoTitle"], "title"=>"Video Title", "where"=>"AND  videoTitle LIKE '%SVAL%'"),
array("type"=>"text", "name"=>"videoLink", "value"=>$d['videoLink'], "title"=>"Video Link", "where"=>"AND videoLink LIKE '%SVAL%'"));				
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
	array("#ID","videoID",' width="1%" align="center"'),
	array("Image","videoImage",' width="1%" align="center"'),
	array("Video Title","videoTitle",' align="left"',true),
	array("Synopsis","synopsis",' align="left"'),
	array("Video Link","videoLink",' align="left"'),
	array("Date Added","dateAdded",' align="center"'));
?>

<div id="wrap-data">
  <table border="0" cellspacing="1" cellpadding="7" class="tbl-list">
    <tr> <?php echo getListTitle($COLS); ?> </tr>
    <?php foreach($DB->rows as $d) { $d["videoImage"] = getImage($d["videoImage"],$MXPGINFO["TBL"],$d["videoImage"]); ?>
    <tr> <?php echo getMAction("mid",$d["videoID"]);?>
      <?php foreach ($COLS as $v) { ?>
      <td<?php echo $v[2];?>><?php if($v[3]) { echo getEditUrl("id=".$d["videoID"],$d[$v[1]]); } else { echo $d[$v[1]]; } ?></td>
      <?php } ?>
    </tr>
    <?php } ?>
  </table>
</div>
<?php echo getPrettyJs();?>
<?php } else { ?>
<div class="no-records">No records found</div>
<?php } ?>

