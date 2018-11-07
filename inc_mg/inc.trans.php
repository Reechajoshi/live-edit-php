<?php
	$_TRANS_START = 0;
	$_TRANS_PAYPAL_INITIATED = 3;
	$_TRANS_FAILED = 5;
	$_TRANS_SUCCESS = 10;
	$_TRANS_SUCCESS_WITH_WARNING = 11;
	
	function getState($s)
	{
		GLOBAL $_TRANS_START, $_TRANS_PAYPAL_INITIATED, $_TRANS_FAILED, $_TRANS_SUCCESS, $_TRANS_SUCCESS_WITH_WARNING;
		
		$str = '';
		if( $s === $_TRANS_START )
			$str = "Started";
		else if( $s === $_TRANS_PAYPAL_INITIATED )
			$str = "Submitted";
		else if( $s === $_TRANS_FAILED )
			$str = "Failed";
		else if( $s === $_TRANS_SUCCESS )
			$str = "Success";
			
		return( $str );
	}
	
	function getunqid_t1($s)
	{
		return(md5(uniqid(time(),true).$s));
	}

	function addDigitalTransaction($_prod, $_total_amount)
	{
		return( addTransaction( true, '', $_prod, $_total_amount ) );
	}
	
	function addNormalTransaction($_shipping_addr, $_prod, $_total_amount)
	{
		return( addTransaction( false, $_shipping_addr, $_prod, $_total_amount ) );
	}
	
	function addTransaction($is_digital, $_shipping_addr, $_prod, $_total_amount)
	{
		global $_TRANS_START, $DB;
		
		$_username = $_SESSION[ 'SITEUSERNAME' ];
		$_tid = getunqid_t1( $_username );
		
		$_ttype = ( $is_digital )?( 1 ):( 0 );
		
		$_q = "insert into ".$DB->pre."trans( tuserName, tid, ttype, tstate, tstart_date, tshipping_addr, total_amount ) values ( '$_username', '$_tid', $_ttype, $_TRANS_START, now(), '$_shipping_addr', '$_total_amount' );";
		
		$DB->dbQuery( $_q );
		
		if( $DB->affectedRows > 0 )
		{
			foreach( $_prod as $_product )
			{
				$_name = $_product[ 'name' ];
				$_unit_c = $_product[ 'amt' ];
				$_qt = $_product[ 'qty' ];
				$_am = ( $_unit_c * $_qt );
				
				$_q = "insert into ".$DB->pre."trans_detail( tid, tprod_type, tunit_cost, tqty, tamount ) values ( '$_tid', '$_name', '$_unit_c', $_qt, '$_am' );";
				
				$DB->dbQuery( $_q );
			}
			
			return( $_tid );
		}
		
		return( false );
	}
	
	function updateTransactionToFailed($token, $resp)
	{
		global $_TRANS_FAILED;
		updateTransaction( $token, $_TRANS_FAILED, $resp );
	}
	
	function updateTransactionToSuccess($token, $resp)
	{
		global $_TRANS_SUCCESS;
		updateTransaction( $token, $_TRANS_SUCCESS, $resp );
	}
	
	function updateTransactionToSuccessWithWarning($token, $resp)
	{
		global $_TRANS_SUCCESS_WITH_WARNING;
		updateTransaction( $token, $_TRANS_SUCCESS_WITH_WARNING, $resp );
	}
	
	function updateTransaction($token, $state, $resp)
	{
		GLOBAL $DB;
		
		$s = mysql_real_escape_string( serialize( $resp ) );
		
		$_q = "update ".$DB->pre."trans set tstate=$state, tresp='$s' where ttoken='$token';";
		
		$DB->dbQuery( $_q );
	}
	
	function updateTransactionToken($unqid, $token)
	{
		GLOBAL $_TRANS_PAYPAL_INITIATED, $DB;
		
		$_q = "update ".$DB->pre."trans set ttoken='$token', tstate=$_TRANS_PAYPAL_INITIATED  where tid='$unqid';";
		
		$DB->dbQuery( $_q );
	}
?>