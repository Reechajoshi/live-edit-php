<?php
	function isValidSess($us, $sessid)
	{
		GLOBAL $DB;
		$_q = "select 1 cnt from sess where userName='$us' and sessId='$sessid';";
		
		$_row = $DB->dbRow( $_q );
		
		return( intval( $_row[ 'cnt' ] ) === 1 );
	}
	
	function isSessOK()
	{
		if( isset( $_SESSION[ 'SITEUSERNAME' ] ) && isset( $_SESSION[ 'SESSID' ] ) )
		{
			return( isValidSess( $_SESSION[ 'SITEUSERNAME' ], $_SESSION[ 'SESSID' ] ) );
		}
		return( false );
	}
?>