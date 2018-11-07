<?php
	echo getPageNav();
	
	// RETRIVE ERROR PAGE TITLES FROM THE DATABASE
	$sql = "select distinct errid from ".$DB->pre.$MXPGINFO["TBL"].";";
	
	$DB->dbRows( $sql );
	$MXCOLS = array(
	array("Error Page","errid",' align="left"', true),
	);
	
	echo( '<div id="wrap-data">
		<table border="0" cellspacing="1" cellpadding="7" class="tbl-list">
		<tr> '. getListTitle($MXCOLS).' </tr>' 
	);
	
	foreach($DB->rows as $d) { 	
		echo( '<tr>'. getMAction("mid",$d["errid"]) );
		foreach ($MXCOLS as $v) {
			echo( '<td'.$v[2].'>');
			if($v[3]) {
				echo getEditUrl("id=".$d["errid"],$d[$v[1]]); 
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