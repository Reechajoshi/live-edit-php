<?php
echo getPageNav();
	$sql = "SELECT * FROM `".$DB->pre.$MXPGINFO["TBL"]."` "; 
	$DB->dbRows($sql);
	$MXCOLS = array(
	array("Email","ename",' align="left"', true),
	array("Subject","esubject",' align="left"', true),
	array("From Name","efromname",' align="left"', true),
	array("From Id","efromid",' align="left"', true)
	);


	echo( '<div id="wrap-data">
	  <table border="0" cellspacing="1" cellpadding="7" class="tbl-list">
		<tr> '. getListTitle($MXCOLS).' </tr>' );

	foreach($DB->rows as $d) { 	
		echo( '<tr>'. getMAction("mid",$d["eid"]) );
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