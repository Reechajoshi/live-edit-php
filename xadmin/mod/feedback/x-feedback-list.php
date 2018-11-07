<?php
	
	echo( $TPL->pageType );
	print_r( $_POST );
	
echo getPageNav();
	$sql = "select * from ".$DB->pre."feedback order by ftime desc;"; 
	$DB->dbRows( $sql );
	$MXCOLS = array(
	array("UserName","fuserName",' align="left"', false),
	array("Date","ftimestamp",' align="left"', false),
	array("Table","ftable",' align="left"', false),
	array("Query","fdesc",' align="left"', false)
	);


	echo( '<div id="wrap-data">
	  <table border="0" cellspacing="1" cellpadding="7" class="tbl-list">
		<tr> '. getListTitle($MXCOLS).' </tr>' );

	foreach($DB->rows as $d) { 	
		
		echo( '<tr>'. getMAction("mid",$d["tid"]) );
		foreach ($MXCOLS as $v) {
			echo( '<td'.$v[2].'>');
			if($v[3]) {
				echo getEditUrl("id=".$d["eid"],$d[$v[1]]); 
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