<?php
	session_start();
	
	require( "../connectdb.inc.php" );
	
	require( "inc.img.php" );
	require( "inc.sess.php" );
	
	function echoImage($_userName, $type)
	{
		GLOBAL $DB;
		
		$_q = "select imageName from ".$DB->pre."site_user where userName='$_userName';";
		
		$_row = $DB->dbRow($_q);
		
		if( strlen( trim( $_row[ 'imageName' ] ) ) > 0 )
		{
			$_file_path = "../uploads/site_user/".$type."_".$_row[ 'imageName' ];
			if( file_exists( $_file_path ) )
			{
				$arrImage = @getimagesize( $_file_path );
				
				if( isset( $arrImage[ 'mime' ] ) )
				{
					@header("Content-type: ".$arrImage[ 'mime' ]);
					$content = @file_get_contents ( $_file_path );
					if ($content != FALSE)
						echo $content;	
					return( true );	
				}
			}	
		}
		else
		{
			$def_img_path = "../images/default-picture2.png";
			$arrImage = @getimagesize( $def_img_path );
			
			if( isset( $arrImage[ 'mime' ] ) )
			{
				@header("Content-type: ".$arrImage[ 'mime' ]);
				$content = @file_get_contents ( $def_img_path );
				if ($content != FALSE)
					echo $content;	
				return( true );	
			}
		}
		
		return( false );
	}
	
	function echoType3Box()
	{
		@header("Content-type: image/png");
		$content = @file_get_contents ( SITEURL."/images/type_3_box.png" );
		if ($content != FALSE)
			echo $content;
	}
	
	function checkGameroomForUsers($_userName_req, $_userName_req_for)
	{
		GLOBAL $DB;
		
		$_query = "select 1 cnt from mx_game_room where userName = '$_userName_req_for' and gameId in ( select x.gameId from mx_game_room x where x.userName='$_userName_req' ) and roomId in ( select y.roomId from mx_game_room y where y.userName='$_userName_req' );";
		
		$_row = $DB->dbRow($_query);
		
		return( intval( $_row[ 'cnt' ] ) === 1 );
	}
	
	if( isset( $_GET[ 'top_p' ] ) && isset( $_GET[ 'us' ] ) )
	{
		echoImage( $_GET[ 'us' ], 2 );
	}
	else if( isset( $_GET[ 'lb' ] ) && isset( $_GET[ 'us' ] ) )// leader board image request for other user
	{
		if( !echoImage( $_GET[ 'us' ], 3 ) )
			die( '' );
			//echoType3Box();
	}
	else if( isset( $_GET[ 'ing' ] ) && isset( $_GET[ 'us' ] ) )// in game image request for other user
	{
		if( !echoImage( $_GET[ 'us' ], 4 ) )
			die( '' );
	}
	else if( isSessOK() )
	{
		$_userName = $_SESSION[ 'SITEUSERNAME' ];
		if( isset( $_GET[ 'pim' ] ) )//profile image
		{
			if( isset( $_GET[ 'type' ] ) )
			{
				if( intval( $_GET[ 'type' ] ) === 1 || intval( $_GET[ 'type' ] ) === 2 ) //162x162 -- 25x25
				{
					echoImage( $_userName, intval( $_GET[ 'type' ] ) );
				}
			}
		}
		else if( isset( $_GET[ 'gim' ] ) )// game room image request for other user
		{
			if( isset( $_GET[ 'us' ] ) )
			{
				$_userName_for = $_GET[ 'us' ];
				
				if( checkGameroomForUsers($_userName, $_userName_for) )
				{
					if( isset( $_GET[ 'type' ] ) )
					{
						if( intval( $_GET[ 'type' ] ) === 1 || intval( $_GET[ 'type' ] ) === 2 ) //162x162 -- 25x25
						{
							echoImage( $_userName_for, intval( $_GET[ 'type' ] ) );
						}
					}
				}	
			}
		}
	}
?>