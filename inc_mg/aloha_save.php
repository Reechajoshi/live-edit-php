<?php
	if( isset( $_REQUEST[ 'content' ] ) && isset( $_REQUEST[ 'contentId' ] ) )
	{
		require( "../connectdb.inc.php" );
		
		require( "db.map.vars.php" );
		
		$_id = $_REQUEST[ 'contentId' ];
		if( strpos( $_id, '-' ) )
		{
			$_col_index = false;
			list( $_table, $_id, $_col_index ) = explode( '-', $_id );
			if( isset( $_COLS[ $_table ] ) )
			{
				$_id_col = $_COLS[ $_table ][ 0 ];
				
				if( !$_col_index )
					$_upd_col = $_COLS[ $_table ][ 1 ];
				else
					$_upd_col = $_COLS[ $_table ][ $_col_index ];
				
				$_content = mysql_real_escape_string( $_REQUEST[ 'content' ] );
				$_q = "update ".$DB->pre."$_table set ".$_upd_col." = '$_content' where ".$_id_col."='".$_id."';";
				$data = $DB->dbRows( $_q );
			}	
		}
	}
?>