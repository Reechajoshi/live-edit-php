<?php
$arrSearch = array(
array("type"=>"text", "name"=>"gameTipID", "value"=>"", "title"=>"#ID", "where"=>"AND GT.gameTipID='SVAL'"),
array("type"=>"text", "name"=>"gameTipTitle", "value"=>$D["gameTipTitle"], "title"=>"Game Tip Title", "where"=>"AND GT.gameTipTitle LIKE '%SVAL%'"),
array("type"=>"text", "name"=>"gameTipText", "value"=>$D["gameTipText"], "title"=>"Game Text", "where"=>"AND GT.productTitle LIKE '%SVAL%'"));				
$FRM = new mxForm();
$strSearch = $FRM->getSearch($arrSearch);

$sql = "SELECT GT.".$MXPGINFO['PK']." FROM `".$DB->pre.$MXPGINFO["TBL"]."` AS GT LEFT JOIN ".$DB->pre."game AS G ON GT.gameID = G.gameID WHERE GT.status='$STATUS' $FRM->where"; 

$DB->dbQuery($sql);
$MXTOTREC = $DB->numRows;

if(!$FRM->where && $MXTOTREC < 1)
	$strSearch = "";
echo getPageNav();
echo $strSearch;
if($MXTOTREC > 0) {	
	$sql = "SELECT GT.*,G.gameTitle FROM `".$DB->pre.$MXPGINFO["TBL"]."` AS GT LEFT JOIN ".$DB->pre."game AS G ON GT.gameID = G.gameID WHERE GT.status='$STATUS' $FRM->where LIMIT $MXOFFSET,$MXSHOWREC"; 
	$DB->dbRows($sql);
	$COLS = array(
	array("#ID","gameTipID",' width="1%" align="center"'),
	array("Image","gameTipImage",' width="1%" align="center"'),
	array("Game Title","gameTitle",' align="left"',true),
	array("Game Tip Title","gameTipTitle",' align="left"'),
	array("Game Tip Text","gameTipText",' align="left"'),
	array("Date Added","dateAdded",' align="center"'));
?>

<div id="wrap-data">
  <table border="0" cellspacing="1" cellpadding="7" class="tbl-list">
    <tr> <?php echo getListTitle($COLS); ?> </tr>
    <?php foreach($DB->rows as $d) { $d["gameTipImage"] = getImage($d["gameTipImage"],$MXPGINFO["TBL"],$d["gameTipTitle"]);?>
    <tr> <?php echo getMAction("mid",$d["gameTipID"]);?>
      <?php foreach ($COLS as $v) { ?>
      <td<?php echo $v[2];?>><?php if($v[3]) { echo getEditUrl("id=".$d["gameTipID"],$d[$v[1]]); } else { echo $d[$v[1]]; } ?></td>
      <?php } ?>
    </tr>
    <?php } ?>
  </table>
</div>
<?php echo getPrettyJs();?>
<?php } else { ?>
<div class="no-records">No records found</div>
<?php } ?>

