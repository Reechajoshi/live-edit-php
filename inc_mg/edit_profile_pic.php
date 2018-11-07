<?php
	session_start();
	
	require( "../connectdb.inc.php" );
	
	require( "inc.img.php" );
	require( "inc.sess.php" );
	
	function updateDisplayPic($userId, $imageName)
	{
		GLOBAL $DB;
		$_q = "select imageName from ".$DB->pre."site_user where siteUserID=$userId ;";
		
		$_row = $DB->dbRow($_q);
		
		if( strlen( trim( $_row[ 'imageName' ] ) ) > 0 )
		{
			@unlink( "../uploads/site_user/".$_row[ 'imageName' ] );
			@unlink( "../uploads/site_user/1_".$_row[ 'imageName' ] ); //unlink type 1 image whuch is 162x162
			@unlink( "../uploads/site_user/2_".$_row[ 'imageName' ] ); //unlink type 2 image whuch is 25x25
			@unlink( "../uploads/site_user/3_".$_row[ 'imageName' ] ); //unlink type 3 image whuch is 54x53
			@unlink( "../uploads/site_user/4_".$_row[ 'imageName' ] ); //unlink type 4 image whuch is 54x53
			
		}	
		
		$_q = "update ".$DB->pre."site_user set imageName='${imageName}' where siteUserID=$userId ;";
		$DB->dbQuery( $_q );
	}
	
	if( isSessOK() )
	{
		if($_SESSION['SITEUSERID'] && ($_SESSION['SITEUSEREMAIL']))
		{
			if( isset( $_GET[ 'del' ] ) )
			{
				updateDisplayPic( $_SESSION['SITEUSERID'], '' );
			}
			else
			{	
				if( isset( $_FILES[ 'userPhoto' ] ) )
				{
					if( intval( $_FILES[ 'userPhoto' ][ 'error' ] ) === 0 )
					{
						$_name = $_FILES[ 'userPhoto' ][ 'name' ];
						$_name_ex = explode( '.', $_name );
						
						$_ext = strtolower( $_name_ex[ count( $_name_ex ) - 1 ] );
						
						if( $_ext === "png" || $_ext === "jpg" || $_ext === "jpeg" || $_ext === "bmp" )
						{
							$_new_name = basename( $_FILES[ 'userPhoto' ][ 'tmp_name' ] ).".".$_ext;
							$_full_path = "../uploads/site_user/${_new_name}";
							$_full_path_type_1 = "../uploads/site_user/1_${_new_name}";
							$_full_path_type_2 = "../uploads/site_user/2_${_new_name}";
							$_full_path_type_3 = "../uploads/site_user/3_${_new_name}";
							$_full_path_type_4 = "../uploads/site_user/4_${_new_name}";
							
							if( move_uploaded_file( $_FILES[ 'userPhoto' ][ 'tmp_name' ], $_full_path ) && chmod( $_full_path, 0755 ) )
							{
								$obj = new resizeImage( 162, 162, $_full_path, "crop");
								$obj->__resize( $_full_path, $_full_path_type_1 );
								
								$obj = new resizeImage( 25, 25, $_full_path, "crop");
								$obj->__resize( $_full_path, $_full_path_type_2 );
								
								$obj = new resizeImage( 54, 53, $_full_path, "crop");
								$obj->__resize( $_full_path, $_full_path_type_3 );
								
								$obj = new resizeImage( 57, 57, $_full_path, "crop");
								$obj->__resize( $_full_path, $_full_path_type_4 );
								
								updateDisplayPic( $_SESSION['SITEUSERID'], $_new_name );
							}
						}
					}
				}
			}
			header("location: ".SITEURL."/user/".$_SESSION[ 'SITEUSERURI' ]."/".$_SESSION['SITEUSERID'] );
		}
	}
	else
		header("location: ".SITEURL );
?>