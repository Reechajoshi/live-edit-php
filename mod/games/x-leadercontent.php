<?php
	session_start();
	
	include("../../connectdb.inc.php");
	if( isset( $_POST[ 'lt' ] ) )
	{
		$arr = Array();
		if( intval( $_POST[ 'lt' ] ) === 2 ) //overall
		{
			$_q = "select userName, userChips from mx_site_user order by userChips desc limit 100;";
			
			$data = $DB->dbRows( $_q );
			
			foreach($data as $key => $value){
				$arr[] = array( "name"=> $value[ 'userName' ], "count"=> number_format( $value[ 'userChips' ], 0, '.', ',' ) );
			}
		}
		else if( intval( $_POST[ 'lt' ] ) === 1 ) //me
		{
			require( "../../inc_mg/inc.sess.php" );
			
			if( isSessOK() )
			{
				$_q = "select userChips from mx_site_user where userName='".$_SESSION[ 'SITEUSERNAME' ]."';";
				
				$data = $DB->dbRows( $_q );
				$_chips = $data[0][ 'userChips' ];
				// foreach($data as $key => $value){
					// $arr[] = array( "name"=> $_SESSION[ 'SITEUSERNAME' ], "count"=> number_format( $value[ 'userChips' ], 0, '.', ',' ) );
				// }
				
				$_q = "select userName, userChips from mx_site_user where userChips > ".$_chips." order by userChips asc limit 10;";
				$data = $DB->dbRows( $_q );
				foreach($data as $key => $value){
					$arr[] = array( "name"=> $value[ 'userName' ], "count"=> number_format( $value[ 'userChips' ], 0, '.', ',' ) );
				}
				
				$arr[] = array( "name"=> $_SESSION[ 'SITEUSERNAME' ], "count"=> number_format( $_chips, 0, '.', ',' ) );
				
				$_q = "select userName, userChips from mx_site_user where userChips <= ".$_chips." order by userChips desc limit 10;";
				$data = $DB->dbRows( $_q );
				foreach($data as $key => $value){
					if( $_SESSION[ 'SITEUSERNAME' ] != $value[ 'userName' ] )
						$arr[] = array( "name"=> $value[ 'userName' ], "count"=> number_format( $value[ 'userChips' ], 0, '.', ',' ) );
				}
			}
		}
		
		echo( json_encode( $arr ) );
	}
?>