<?php

function getGamesList($gameID,$offset){
	global $DB;
	$sql = "SELECT * FROM ".$DB->pre."game WHERE status = 1";
	$data = $DB->dbRows($sql);
	$TOTREC = $DB->numRows;
	
	$play_now_btn_details[0] = getButtons( "play_now_01", "nu_games" );	
	$how_to_play_btn_details[0] = getButtons( "how_to_play_01", "nu_games" );	
	$watch_demo_btn_details[0] = getButtons( "watch_demo_01", "nu_games" );	
	
	$play_now_btn_details[1] = getButtons( "play_now_02", "nu_games" );	
	$how_to_play_btn_details[1] = getButtons( "how_to_play_02", "nu_games" );	
	$watch_demo_btn_details[1] = getButtons( "watch_demo_02", "nu_games" );	
	
	$play_now_btn_details[2] = getButtons( "play_now_03", "nu_games" );	
	$how_to_play_btn_details[2] = getButtons( "how_to_play_03", "nu_games" );	
	$watch_demo_btn_details[2] = getButtons( "watch_demo_03", "nu_games" );	
	
	
	if($TOTREC){
		$sql = "SELECT * FROM ".$DB->pre."game WHERE status = 1 order by gameID asc";//LIMIT ".$offset.",2";
		$data = $DB->dbRows($sql);
		$off = $offset;
		/* convert foreach to for loop */
		
		/* foreach($data as $key => $value){
			$off = $off + 1;
			list( ,$video_url ) = explode( "v=", $value['video_url'] );
			list( $video_url ) = explode( "&", $video_url );
			
			  echo '<li class="gameScroller" gameID="'.$value['gameID'].'" offset="'.$off.'" total="'.$TOTREC.'" > 
				<div class="flash-box" id="flash-box-'.$off.'"  rel="'.$video_url.'" > <img src="'.SITEURL.'/uploads/game/'.$value['imageName'].'" height="390px"  width="574px" /></div>
				<div class="game-description">
				  <div class="title"><img src="'.SITEURL."/uploads/game/".$value['gameTitleImage'].'"></div>
				  <div style="clear: both;" class="editable" id="game-'.$value['gameID'].'" >'.$value['gameDesc'].'</div>
				  <div style="clear: both;" >
					  <a href="'.SITEURL.'/games/'.$value['seoUri'].'/'.$value['gameID'].'/ " class="button">PLAY NOW !</a> 
					  <a href="#" class="btn-gray btn-watch-demo" onClick="$( \'#flash-box-'.$off.'\' ).click(); return( false );">WATCH DEMO</a> 
					  <a href="'.SITEURL.'/how-to-play/?i='.$value['gameID'].'" class="btn-gray">HOW TO PLAY</a> 
				  </div>
			  </li>';
	   } */
	   
	   for( $i = 0; $i < count( $data ); $i++ ){
			$off = $off + 1;
			list( ,$video_url ) = explode( "v=", $data[$i]['video_url'] );
			list( $video_url ) = explode( "&", $video_url );
			echo '<li class="gameScroller" gameID="'.$data[$i]['gameID'].'" offset="'.$off.'" total="'.$TOTREC.'" > 
				<div class="flash-box" id="flash-box-'.$off.'"  rel="'.$video_url.'" > <img src="'.SITEURL.'/uploads/game/'.$data[$i]['imageName'].'" height="390px"  width="574px" /></div>
				<div class="game-description">
				  <div class="title"><img src="'.SITEURL."/uploads/game/".$data[$i]['gameTitleImage'].'"></div>
				  <div style="clear: both;" class="editable" id="game-'.$data[$i]['gameID'].'" >'.$data[$i]['gameDesc'].'</div>
				  <div style="clear: both;" >
					  <a href="'.$play_now_btn_details[$i]["link"].'" class="button '.$play_now_btn_details[$i]["color"].'">'.$play_now_btn_details[$i]["button_txt"].'</a> 
					  <a href="'.$watch_demo_btn_details[$i]["link"].'" class="btn-gray btn-watch-demo '.$watch_demo_btn_details[$i]["color"].'" onClick="$( \'#flash-box-'.$off.'\' ).click(); return( false );">'.$watch_demo_btn_details[$i]["button_txt"].'</a> 
					  <a href="'.$how_to_play_btn_details[$i]["link"].'" class="btn-gray '.$how_to_play_btn_details[$i]["color"].'">'.$how_to_play_btn_details[$i]["button_txt"].'</a> 
				  </div>
			  </li>';
	   }
   }	
}

if($_REQUEST["xAction"]){
	switch($_REQUEST["xAction"]){
		case "getGamesList":
			include("../../connectdb.inc.php");	
			$offset = $_REQUEST['offset'];
			$albumID = $_REQUEST['gameID'];		
			echo getGamesList($gameID,$offset);
		break;
	}
}else{
	$sql = "SELECT gameTitle, seoUri, synopsis, imageName FROM ".$DB->pre."game WHERE gameID =  '".$TPL->modID."' AND status = 1";
	$D = $DB->dbRow($sql);
	if($D){
		$FBMETA = '<meta property="og:title" content="'.$D['gameTitle'].'" />
		<meta property="og:description" content="'.$D['synopsis'].'" />
		<meta property="og:url" content="'.SITEURL.'/product/'.$D['seoUri'].'/'.$TPL->modID.'/" />
		<meta property="og:image" content="'.SITEURL.'/uploads/game/'.$D['imageName'].'" />
		<meta property="og:site_name" content="NU" />';
	}
}
?>