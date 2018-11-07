<?php
$category = getTableDD($DB->pre."category","categoryID","categoryTitle",$_REQUEST["categoryID"], "parentID = 5");

$arrSearch = array(
array("type"=>"text", "name"=>"productID", "value"=>"", "title"=>"#ID", "where"=>"AND U.productID='SVAL'"),
array("type"=>"text", "name"=>"productTitle", "value"=>$D["productTitle"], "title"=>"Product Title", "where"=>"AND U.productTitle LIKE '%SVAL%'"),
array("type"=>"select", "name"=>"categoryID", "value"=>$category, "title"=>"Category", "where"=>"AND U.categoryID='SVAL'"));				
$FRM = new mxForm();
$strSearch = $FRM->getSearch($arrSearch);

$sql = "SELECT U.".$MXPGINFO['PK']." FROM `".$DB->pre.$MXPGINFO["TBL"]."` AS U LEFT JOIN ".$DB->pre."category AS C ON U.categoryID = C.categoryID WHERE U.status='$STATUS' $FRM->where"; 

$DB->dbQuery($sql);
$MXTOTREC = $DB->numRows;

if(!$FRM->where && $MXTOTREC < 1)
	$strSearch = "";
echo getPageNav();
echo $strSearch;
if($MXTOTREC > 0) {	
	$sql = "SELECT U.*,C.categoryTitle FROM `".$DB->pre.$MXPGINFO["TBL"]."` AS U LEFT JOIN ".$DB->pre."category AS C ON U.categoryID = C.categoryID WHERE U.status='$STATUS' $FRM->where LIMIT $MXOFFSET,$MXSHOWREC"; 
	$DB->dbRows($sql);
	$COLS = array(
	array("#ID","productID",' width="1%" align="center"'),
	array("Image","productImg1",' width="1%" align="center"'),
	array("Product Title","productTitle",' align="left"',true),
	array("SEO URL","seoUri",' align="left"'),
	array("Category","categoryTitle",' align="left"'),
	array("Date Added","dateAdded",' align="center"'));
?>

<div id="wrap-data">
  <table border="0" cellspacing="1" cellpadding="7" class="tbl-list">
    <tr> <?php echo getListTitle($COLS); ?> </tr>
    <?php foreach($DB->rows as $d) { $d["productImg1"] = getImage($d["productImg1"],$MXPGINFO["TBL"],$d["productTitle"]);?>
    <tr> <?php echo getMAction("mid",$d["productID"]);?>
      <?php foreach ($COLS as $v) { ?>
      <td<?php echo $v[2];?>><?php if($v[3]) { echo getEditUrl("id=".$d["productID"],$d[$v[1]]); } else { echo $d[$v[1]]; } ?></td>
      <?php } ?>
    </tr>
    <?php } ?>
  </table>
</div>
<?php echo getPrettyJs();?>
<?php } else { ?>
<div class="no-records">No records found</div>
<?php } ?>

