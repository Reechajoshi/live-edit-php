<?php

	function getRegText($id)
	{
		GLOBAL $DB;
		$_q = "select tcontent from ".$DB->pre."texts where tid='$id';";
		
		$_row = $DB->dbRow( $_q );
		
		if( $DB->numRows > 0 )
			return( $_row[ 'tcontent' ] );
		else
			return( '' );
	}
	
	function getFeedbackText()
	{
		GLOBAL $DB;
		$_q = "select tcontent from ".$DB->pre."texts where tid='FEEDBACK_TEXT';";
		
		$_row = $DB->dbRow( $_q );
		
		if( $DB->numRows > 0 )
			return( $_row[ 'tcontent' ] );
		else
			return( 'Feedback is important for us to create a better NU Experience. <br/> Help Us to achieve this by giving us any and all Feedback.' );
	}

	function getMoreVideoText($t)
	{
		GLOBAL $DB;
		$_q = "select tcontent from ".$DB->pre."texts where tid='MORE_VIDEO_TEXT_$t';";
		
		$_row = $DB->dbRow( $_q );
		
		if( $DB->numRows > 0 )
			return( $_row[ 'tcontent' ] );
		else
			return( 'Watch More Party Tricks Videos' );
	}
	
	function getTermsOfUse()
	{
		GLOBAL $DB;
		$_q = "select phtml from ".$DB->pre."pages where pid='_TERMS_USE_';";
		
		$_row = $DB->dbRow( $_q );
		
		if( $DB->numRows > 0 )
			return( $_row[ 'phtml' ] );
		return( '' );
	}
	
	function getPrivacyPolicy()
	{
		GLOBAL $DB;
		$_q = "select phtml from ".$DB->pre."pages where pid='_PRIVACY_POLICY_';";
		
		$_row = $DB->dbRow( $_q );
		
		if( $DB->numRows > 0 )
			return( $_row[ 'phtml' ] );
		return( '' );
	}
	
	function getVipConfirmation()
	{
		GLOBAL $DB;
		$_q = "select phtml from ".$DB->pre."pages where pid='_VIP_MEMBER_CONFIRM_';";
		
		$_row = $DB->dbRow( $_q );
		
		if( $DB->numRows > 0 )
			return( $_row[ 'phtml' ] );
		return( '' );
	}
	
	function getEmailContent($id, &$subject, &$fromname, &$fromid, &$content)
	{
		GLOBAL $DB;
		
		$subject = false;
		$fromname = false;
		$fromid = false;
		$content = false;
		
		$_q = "select esubject, efromname, efromid, ehtml from ".$DB->pre."emails where eid='$id';";
		
		$_row = $DB->dbRow( $_q );
		
		if( $DB->numRows > 0 )
		{
			$subject = $_row[ 'esubject' ];
			$fromname = $_row[ 'efromname' ];
			$fromid = $_row[ 'efromid' ];
			$content = $_row[ 'ehtml' ];
		}
	}
	
	function getBanner($id, $is_square = false)
	{
		GLOBAL $DB;
		$_q = "select * from ".$DB->pre."banner where bid='$id';";
		$_str = false;
		
		$_row = $DB->dbRow( $_q );
		
		if( $DB->numRows > 0 )
		{
			$_h = $_row[ 'bheight' ];
			$_w = $_row[ 'bwidth' ];
			
			$_im1 = SITEURL.'/uploads/banner/'.$_row[ 'bim1' ];
			$_im2 = SITEURL.'/uploads/banner/'.$_row[ 'bim2' ];
			$_im3 = SITEURL.'/uploads/banner/'.$_row[ 'bim3' ];
			
			$_c = "rotator";
			
			if( $is_square )
				$_c = "rotator_square";
			
			$_str = '<div class="'.$_c.'" style="width: '.$_w.'px; height: '.$_h.'px;">
					  <ul>
						<li class="show">
							<a href="javascript:void(0)">
								<img src="'.$_im1.'" width="'.$_w.'" height="'.$_h.'"  alt="pic1" />
							</a>
						</li>
						<li>
							<a href="javascript:void(0)">
								<img src="'.$_im2.'" width="'.$_w.'" height="'.$_h.'"  alt="pic2" />
							</a>
						</li>
						<li>
							<a href="javascript:void(0)">
								<img src="'.$_im3.'" width="'.$_w.'" height="'.$_h.'"  alt="pic3" />
							</a>
						</li>
					  </ul>
					</div>';
		}		
			
		return( $_str );
	}
	
	function getErrorMessages( $errid, $title = null )
	{
		GLOBAL $DB;
		$error_msg_arr = array();
		$_q = "select * from ".$DB->pre."errors where errid='$errid'".( ( $title ) ? ( " and title = '$title';" ) : ( ";" ) );
		$_row = $DB->dbRows( $_q );
		if( $DB->numRows > 0 )
		{
			foreach( $_row as $row )
			{
				$title = $row[ 'title' ];
				$error_msg = $row[ 'error_msg' ];
				$error_msg_arr[ $title ] = $error_msg;
			}
		}
		return $error_msg_arr;
	}
	
	function getFooterMessage( $col_name )
	{
		GLOBAL $DB;
		$font_size = array( "1" => "12px", "2" => "15px", "3" => "20px" );
		$_q = "select $col_name from ".$DB->pre."footer_msg";
		$_row = $DB->dbRow( $_q );
		if( $DB->numRows > 0 )
		{
			return ( ( ( $col_name == "message01_font_size" ) || ( $col_name == "message02_font_size" ) ) ? ( $font_size[ $_row[ $col_name ] ] ) : ( html_entity_decode( $_row[ $col_name ], ENT_QUOTES, "UTF-8" ) ) );
		}
	}
	
	function getNUCardsSteps( $type, &$title_arr, &$desc_arr )
	{
		GLOBAL $DB;
		$_q = "select nucards_steps_id, description from ".$DB->pre."nucards_steps where steps_type = '$type';";

		$title_arr = array();
		$desc_arr = array();
		
		$_row = $DB->dbRows( $_q );
		if( $DB->numRows > 0 )
		{
			foreach( $_row as $row )
			{
				$title_arr[] = $row[ 'nucards_steps_id' ];
				$desc_arr[] = $row[ 'description' ];
			}
		}	
	}
	
	function getButtons( $id, $category )
	{
		GLOBAL $DB;
		
		$color_array = array( 
			"dark_yellow_shading" => "btn-dark-yellow-shading", 
			"light_yellow_shading" =>  "btn-light-yellow-shading", 
			"green_shading" =>  "btn-green-shading", 
			"purple_shading" =>  "btn-purple-shading", 
			"blue_shading" =>  "btn-blue-shading", 
			"red_shading_black_border" =>  "button-red-shading-black-border",
			"red_shading_white_border" => "button-red-shading-white-border",
			"gray_shading" =>  "btn-gray-shading", 
			"red_shading_no_border" => "btn-red-shading-no-border",
			"light_yellow" => "btn-light-yellow", 
			"light_blue" => "btn-light-blue", 
			"light_gray" => "btn-light-gray",
			"light_red" => "btn-light-red"
		);
		
		$_q = "select * from ".$DB->pre."buttons where buttonId = '$id' and category = '$category' ";
		
		$button_detail_arr = array(); 
		
		$_row = $DB->dbRow( $_q );
		if( $DB->numRows > 0 )
		{
			$color_code = $_row["color"];
		
			$button_detail_arr["button_txt"] = $_row["button_txt"];
			$button_detail_arr["link"] = $_row["link"];
			$button_detail_arr["onclick"] = $_row["onclick"];
			$button_detail_arr["color"] = $color_array [ $color_code ];
			$button_detail_arr["btn_type"] = $_row["btn_type"];
		} 
		
		return $button_detail_arr;
	}
	
	function getBrowserUpdateMsg( &$DB_browser, &$msg_title, &$msg_content, &$latest_ver )
	{
		GLOBAL $DB;
		$_q = "select * from mx_browserMsg";
		$_row = $DB->dbRows( $_q );
		if( $DB->numRows > 0 )
		{
			foreach( $_row as $row )
			{
				$DB_browser[] = $row['browser_name'];
				$msg_title[] = $row['title'];
				$msg_content[] = $row['message'];
				$latest_ver[] = $row['latest_version'];
			}
		}
		return $browser_msg_details;
	}
	
	
	// function putMoreVideoText($t, $text)
	// {
		// GLOBAL $DB;
		// $text = mysql_real_escape_string( $text );
		// $_q = "insert into texts ( tid, tcontent ) values ( 'MORE_VIDEO_TEXT_$t', '$text' ) on duplicate key update tcontent='$text';";
		
		// $data = $DB->dbRows( $_q );
	// }
?>