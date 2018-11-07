<?php
	echo getPageNav();
	
	// RETRIVE ERROR PAGE TITLES FROM THE DATABASE
	$sql = "select * from ".$DB->pre.$MXPGINFO["TBL"]." order by category;";
	
	$DB->dbRows( $sql );
	$MXCOLS = array(
	array("#ID","buttonId",' align="left"', true),
	array("Category","category",' align="left"', true),
	array("Text","button_txt",' align="left"', true),
	array("Link","link",' align="left"', true),
	array("Color","color",' align="left"', true),
	array("Button Type","btn_type",' align="left"', true),
	);
	
	echo( '<div id="wrap-data">
		<table border="0" cellspacing="1" cellpadding="7" class="tbl-list">
		<tr> '. getListTitle($MXCOLS).' </tr>' 
	);
	
	foreach($DB->rows as $d) { 	
		echo( '<tr>'. getMAction("mid",$d["buttonId"]) );
		foreach ($MXCOLS as $v) {
			echo( '<td'.$v[2].'>');
			if($v[3]) {
				echo getEditUrl("id=".$d["buttonId"]."&cat=".$d["category"]."",$d[$v[1]]); 
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