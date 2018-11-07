<?php
echo getPageNav();
	$sql = "SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` "; 
	$DB->dbRows($sql);
	$MXCOLS = array(
	array("Banner","bname",' align="left"', true),
	//array("Duration(sec)","bduration",' align="left"', true),
	array("Width","bwidth",' align="left"', true),
	array("Height","bheight",' align="left"', true)
	);


	echo( '<div id="wrap-data">
	  <table border="0" cellspacing="1" cellpadding="7" class="tbl-list">
		<tr> '. getListTitle($MXCOLS).' </tr>' );

	foreach($DB->rows as $d) { 	
		echo( '<tr>'. getMAction("mid",$d["bid"]) );
		foreach ($MXCOLS as $v) {
			echo( '<td'.$v[2].'>');
			if($v[3]) {
				echo getEditUrl("id=".$d["bid"],$d[$v[1]]); 
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