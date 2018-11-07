<?php
$arrSearch = array(
array("type"=>"text", "name"=>"stockID", "value"=>"", "title"=>"#ID", "where"=>"AND S.stockID='SVAL'"),
array("type"=>"text", "name"=>"productTitle", "value"=>$D["productTitle"], "title"=>"Product Title", "where"=>"AND P.productTitle LIKE '%SVAL%'"),
array("type"=>"text", "name"=>"size", "value"=>$D["size"], "title"=>"Size", "where"=>"AND size LIKE '%SVAL%'"),
array("type"=>"text", "name"=>"qty", "value"=>$D["qty"], "title"=>"Product Quantitty", "where"=>"AND qty LIKE '%SVAL%'"));				
$FRM = new mxForm();
$strSearch = $FRM->getSearch($arrSearch);

$sql = "SELECT S.".$MXPGINFO['PK']." FROM `".$DB->pre.$MXPGINFO["TBL"]."` AS S LEFT JOIN ".$DB->pre."product AS P ON S.productID = P.productID WHERE P.status='$STATUS' $FRM->where"; 

$DB->dbQuery($sql);
$MXTOTREC = $DB->numRows;

if(!$FRM->where && $MXTOTREC < 1)
	$strSearch = "";
echo getPageNav();
echo $strSearch;
if($MXTOTREC > 0) {	
	$sql = "SELECT S.*,P.productTitle FROM `".$DB->pre.$MXPGINFO["TBL"]."` AS S LEFT JOIN ".$DB->pre."product AS P ON S.productID = P.productID WHERE P.status='$STATUS' $FRM->where LIMIT $MXOFFSET,$MXSHOWREC"; 
	$DB->dbRows($sql);
	$COLS = array(
	array("#ID","stockID",' width="1%" align="center"'),
	array("Product Title","productTitle",' align="left"',true),
	array("Size","size",' align="left"'),
	array("Qty","qty",' align="center"'),
	array("Date Added","dateAdded",' align="center"'));
?>

<div id="wrap-data">
  <table border="0" cellspacing="1" cellpadding="7" class="tbl-list">
    <tr> <?php echo getListTitle($COLS); ?> </tr>
    <?php foreach($DB->rows as $d) { ?>
    <tr> <?php echo getMAction("mid",$d["stockID"]);?>
      <?php foreach ($COLS as $v) { ?>
      <td<?php echo $v[2];?>><?php if($v[3]) { echo getEditUrl("id=".$d["stockID"],$d[$v[1]]); } else { echo $d[$v[1]]; } ?></td>
      <?php } ?>
    </tr>
    <?php } ?>
  </table>
</div>
<?php echo getPrettyJs();?>
<?php } else { ?>
<div class="no-records">No records found</div>
<?php } ?>

