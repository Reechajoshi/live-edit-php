<?php
$arrSearch = array(
array("type"=>"text", "name"=>"roleAID", "value"=>"", "title"=>"#ID", "where"=>"AND roleAID='SVAL'"),
array("type"=>"text", "name"=>"roleName", "value"=>"", "title"=>"Role Name", "where"=>"AND roleName='SVAL'"));
$MXFRM = new mxForm(false,true);
$strSearch = $MXFRM->getSearch($arrSearch);

$sql = "SELECT ".$MXPGINFO["PK"]." FROM `".$DB->pre.$MXPGINFO["TBL"]."` WHERE  status='$STATUS' $MXFRM->where";
//echo $sql;
$DB->dbQuery($sql);
$MXTOTREC = $DB->numRows;

echo getPageNav();
echo $strSearch;

if($MXTOTREC > 0) {		
	$sql = "SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` WHERE  status='$STATUS' $MXFRM->where LIMIT $MXOFFSET,$MXSHOWREC"; 
	$DB->dbRows($sql);
	$MXCOLS = array(
	array("#ID","roleAID",' width="1%" align="center" align="left"'),
	array("Role Name","roleName",' align="left"',true));
?>

<div id="wrap-data">
  <table border="0" cellspacing="1" cellpadding="7" class="tbl-list">
    <tr> <?php echo getListTitle($MXCOLS); ?> </tr>
    <?php foreach($DB->rows as $d) {  ?>
    <tr> <?php echo getMAction("mid",$d["roleAID"]);?>
      <?php foreach ($MXCOLS as $v) { ?>
      <td<?php echo $v[2];?>><?php if($v[3]) { echo '<a href="'.ASITEURL.'/'.$TPL->modName.'-edit/?id='.$d["roleAID"].'" title="Click to edit">'.$d[$v[1]].'</a>'; } else { echo $d[$v[1]]; } ?></td>
      <?php } ?>
    </tr>
    <?php } ?>
  </table>
</div>
<?php } else { ?>
<div class="no-records">No roles found</div>
<?php } ?>
