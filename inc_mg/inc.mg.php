<?php
	include( "google_translate/head.php" );
	include( ABSPATH.'/xadmin/inc/common.inc.php' );
	
	if( isAdminUser() )
	{
		include( 'inc.aloha.php' );
	}
	else
		echo( '	<script type="text/javascript" src="'.SITEURL.'/inc/js/alerts/jquery.blockUI.js"></script>
				<script type="text/javascript" src="'.SITEURL.'/inc/js/alerts/alert_js.js"></script>' );
?>