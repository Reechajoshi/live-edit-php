<?php
// $arrSearch = array(
// array("type"=>"text", "name"=>"pageID", "value"=>"", "title"=>"#ID", "where"=>"AND pageID='SVAL'",),
// array("type"=>"text", "name"=>"pageTitle", "value"=>$D["pageTitle"], "title"=>"Page Title", "where"=>"AND pageTitle LIKE '%SVAL%'"));				
// $MXFRM = new mxForm();
// $strSearch = $MXFRM->getSearch($arrSearch);

// $sql = "SELECT ".$MXPGINFO['PK']." FROM `".$DB->pre.$MXPGINFO["TBL"]."` ";
//echo $sql;
// $DB->dbQuery($sql);
// $MXTOTREC = $DB->numRows;

// if(!$MXFRM->where && $MXTOTREC < 1)
	// $strSearch = "";

echo getPageNav();
// echo $strSearch;
// if($MXTOTREC > 0) {
	$sql = "SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` "; 
	$DB->dbRows($sql);
	$MXCOLS = array(
	array("Name","pname",' align="left"', true),
	
	// array("#ID","pageID",' width="1%" align="center"'),
	// array("Image","pageImage",' width="1%" align="center"'),	
	// array("Name","pageTitle",' align="left"',true),
	// array("Template File","templateFile",' align="left"'),
	// array("Date Added","dateAdded",' align="center"'),
	// array("Last Modified","dateModified",' align="center"')
	);


	echo( '<div id="wrap-data">
	  <table border="0" cellspacing="1" cellpadding="7" class="tbl-list">
		<tr> '. getListTitle($MXCOLS).' </tr>' );

	foreach($DB->rows as $d) { 	
		echo( '<tr>'. getMAction("mid",$d["pid"]) );
		foreach ($MXCOLS as $v) {
			echo( '<td'.$v[2].'>');
			if($v[3]) {
				echo getEditUrl("id=".$d["pid"],$d[$v[1]]); 
			} 
			else 
			{ 
				echo $d[$v[1]]; 
			}
			echo( '</td>' );
		}
		echo( '</tr>' );
    }
  echo( '</table></div>' );
?>
<!--?php } else { ?-->
<!--div class="no-records">No records found</div-->
<!--?php } ?-->
