<?php
	$_q = "select userName, isVip, userChips, dateAdded, imageName from ".$DB->pre."site_user order by userChips desc, dateAdded LIMIT 10;";
	$_row = $DB->dbRows($_q);
	
	if(count( $_row ) > 0)
	{
		foreach($_row as $key => $value){
			$user_name = $value['userName'];
			$userChips = $value['userChips'];
			$image_name = $value['imageName'];
			$isVip = $value[ 'isVip' ];
			echo ('<li><a href="#">
					<div class="img-box">');
			if(strlen ($image_name) > 0)
				echo('<img src="'.SITEURL.'/inc_mg/get_im.php?top_p&us='.$user_name.'" id="profilePic" />');
				//echo('<img src="'.SITEURL.'/core/image.inc.php?path=site_user/'.$image_name.'&w=25&h=25&type=crop" id="profilePic" />');
			if( $isVip == 1 )
			{
				echo('  </div>
						<span>'.$user_name.'* - '.number_format( $userChips ).'</span>
					  </a></li>');			
			}
			else
			{
				echo('  </div>
				    <span>'.$user_name.' - '.number_format( $userChips ).'</span>
				  </a></li>');			
			}
		}
	}
?>