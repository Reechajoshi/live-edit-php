<?php
	
	require( "../inc_mg/inc.trans.php" );
	
echo getPageNav();
	$sql = "select tuserName, tprod_type, tstart_date, tunit_cost, tqty, tamount, tstate from ".$DB->pre."trans_detail td, mx_trans t where t.tid = td.tid;"; 
	$DB->dbRows( $sql );
	$MXCOLS = array(
	array("UserName","tuserName",' align="left"', false),
	array("Product","tprod_type",' align="left"', false),
	array("Start Date","tstart_date",' align="left"', false),
	array("State","tstate",' align="left"', false),
	array("Cost","tunit_cost",' align="left"', false),
	array("Quantity","tqty",' align="left"', false),
	array("Amount","tamount",' align="left"', false)
	);


	echo( '<div id="wrap-data">
	  <table border="0" cellspacing="1" cellpadding="7" class="tbl-list">
		<tr> '. getListTitle($MXCOLS).' </tr>' );

	foreach($DB->rows as $d) { 	
		$d[ 'tstate' ] = getState( intval( $d[ 'tstate' ] ) );
		
		$_d = strtotime( $d[ 'tstart_date' ] );
		$d[ 'tstart_date' ] = date( 'H:i - jS F Y', $_d );   
		
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