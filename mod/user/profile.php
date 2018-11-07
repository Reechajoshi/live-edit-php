<style>
.dd,.dd .ddTitle{font-family: 'ProximaNovaRgRegular';font-size: 14px;}
.dd .ddTitle{ height:34px; padding-left:10px;}
.dd .ddTitle span.arrow{ height:34px; width:35px;}
.dd .ddTitle span.ddTitleText{ line-height:34px;}
.dd .ddChild{ margin-top:-7px;}
</style>
<div class="banner-730-90">
	<?php echo( getBanner( 'banner_ad_8_profile_page' ) ); ?>
</div>
<div class="profile-wrapp">
  <div class="user-details">
	<?php
		$buy_pack_btn_details = getButtons( "buy_pack", "profile" );	
		$buy_pack_btn_details = getButtons( "buy_pack", "profile" );	
		
		$edit_pwd_btn_details = getButtons( "edit_pwd", "profile" );
		$payment_hist_btn_details = getButtons( "payment_history", "profile" );
		$edit_info_btn_details = getButtons( "edit_personal_info", "profile" );
		$remove_acc_btn_details = getButtons( "remove_acc", "profile" );
		$cancel_info_btn_details = getButtons( "cancel_personal_info", "profile" );
		$save_info_btn_details = getButtons( "save_personal_info", "profile" );
		$edit_contact_btn_details = getButtons( "edit_contact_info", "profile" );
		$cancel_contact_btn_details = getButtons( "cancel_contact_info", "profile" );
		$save_contact_btn_details = getButtons( "save_personal_info", "profile" );
		
		$games_btn_details = getButtons( "games", "profile" );
		$tournament_btn_details = getButtons( "tournament", "profile" );
		$chips_btn_details = getButtons( "chips", "profile" );
		
	?>
    <?php if($_SESSION['SITEUSERID'] && ($_SESSION['SITEUSERID'] == $siteUserID)){ ?>
    <div class="right" id="rightDiv">
      <h3>You're almost there !</h3>
      <p>Hi <?php echo $D['userName'];?>, please take a minute to  complete your profile below. Do this now and your experience across the website will be a much easier one.</p>
      <div class="progress-bar"> <span class="title">Profile Completeness :</span>
        <div class="bar">
          <div style="width:65%"; class="percentP">65%</div>
        </div>
      </div>
      <ul class="remaining-data"></ul>
    </div>
    <!--<div id="vipMembership" class="right">
    	<?php 
		/*if($D['isVip'] == 1){ 
			echo "YOU ARE VIP MEMBER";
        }else{
        	echo '
			<b>Would you like to be a VIP MEMBER???</b><br /><br />
        	<a href="#" class="addCartVip">YES</a>';
        } */
		?>
    </div>-->
    <?php } else {  //echo SITEURL.'/images/default-picture.png';?>
    <div class="right">
      <h3>ABOUT ME</h3>
      <p><?php echo $D['aboutMe'];?></p>
    </div>
    <?php } ?>
    <div class="left">
      <div class="img-box">
        <div class="loader" id="UIMG"></div>
		
		<?php if($_SESSION['SITEUSERID'] && ($_SESSION['SITEUSERID'] == $siteUserID)){ 
		if( strlen( $D['imageName'] ) > 0 )
			{
				echo( '<img src="'.SITEURL.'/inc_mg/get_im.php?pim&type=1" id="profilePic" />
		<form id="pp" method="post" action="'.SITEURL.'/inc_mg/edit_profile_pic.php" enctype="multipart/form-data" >
			<div class="profile_del_button">	
				<a href="#" class="delete_button" class="btn-close-II" style="position:absolute;right:0px;" onClick="if( confirm( \'Are you sure, remove Profile Picture?\' ) ){ $(\'#pp\').attr( \'action\', $(\'#pp\').attr( \'action\' )+\'?del\' ); $(\'#pp\').submit(); }" >
					<img src="'.SITEURL.'/images/btn-remove.png" />
				</a>
			</div>
			<div class="file-browse">	
				<input type="file" size="1" id="userPhoto" name="userPhoto" onchange="if(this.value.length > 0){ $(\'#pp\').submit(); };"/>
			</div>
		</form>
	' );
			}
			else
			{
				echo( '<form id="pp" method="post" action="'.SITEURL.'/inc_mg/edit_profile_pic.php" enctype="multipart/form-data" >
			<div class="file-browse">	
				<input type="file" size="1" id="userPhoto" name="userPhoto" onchange="if(this.value.length > 0){ $(\'#pp\').submit(); };"/>
			</div>
		</form>' );
			}
        
		?>
        <?php } ?>
      </div>
      <div class="user-data">
		<?	
			$sql = "SELECT userChips, isVip FROM ".$DB->pre."site_user  WHERE siteUserID='".$_SESSION['SITEUSERID']."'";
			$CHIP = $DB->dbRow($sql);		
		?>
		
        <h1>Hi, <?php echo ( $D['userName'].( ( intval( $CHIP[ 'isVip' ] ) === 1 )?( "*" ):( "" ) ) );?></h1>
        <label class="title">Email ID:</label>
        <span><?php echo $D['userEmail'];?></span>
        
        <label class="title">MEMBER SINCE :</label>
        <span><?php echo date('d/m/Y',strtotime($D['dateAdded']));?></span>
        <?php if($_SESSION['SITEUSERID'] && ($_SESSION['SITEUSERID'] == $siteUserID)){ ?>
        <!-- <a href="<?php // echo SITEURL.'/user/change-password/';?>" class="btn-edit">Edit</a> -->
		<a href="<?php echo( $edit_pwd_btn_details["link"] );?>" class="btn-edit <?php echo( $edit_pwd_btn_details["color"] ); ?>"><?php echo( $edit_pwd_btn_details["button_txt"] ); ?></a>
		<?php } ?>
		
      </div>
      <div class="btn-box"> 
	  <!-- <a class="btn-price"><?php // echo number_format($CHIP['userChips'], 0, '.', ',');?> chips</a>  -->
	  <a class="btn-price <?php echo( $chips_btn_details["color"] ); ?>"><?php echo ( number_format($CHIP['userChips'], 0, '.', ',')." chips" );?></a> 
	  <!-- <a class="btn-turnament">100 TOURNAMENT WINS</a>  -->
	  <a class="btn-turnament <?php echo( $tournament_btn_details["color"] ); ?>"><?php echo( $tournament_btn_details["button_txt"] ); ?></a> 
	  <!-- <a class="btn-won-game">10,000 GAMES WON</a>  -->
	  <a class="btn-won-game <?php echo( $games_btn_details["color"] ); ?>"><?php echo( $games_btn_details["button_txt"] ); ?></a> 
	  <!--a class="btn-edit">Transaction History</a--> </div>
	  <div class="btn-box"> <!-- <a class="btn-unreg" href="<?php //echo SITEURL.'?xAction=remove';?>" onClick="return( confirm( 'Are you sure you want to remove your account?' ) );" >Remove Account</a> --> 
	  <!-- <a href="#" onClick="showPaymentTrans();return( false );" class="btn-turnament">Payment History</a>  -->
	  <a href="#" onClick="showPaymentTrans();return( false );" class="<?php echo( $payment_hist_btn_details["color"] ); ?>"><?php echo( $payment_hist_btn_details["button_txt"] ); ?></a> 
	  </div>
	  
      <!--ul class="other-info">
        <li> <span>OTHER INFO :</span>
          <p>Will come here if needed</p>
        </li>
        <li> <span>OTHER INFO :</span>
          <p>Will come here if needed</p>
        </li>
        <li> <span>OTHER INFO :</span>
          <p>Will come here if needed</p>
        </li>
        <li> <span>OTHER INFO :</span>
          <p>Will come here if needed</p>
        </li>
      </ul-->
    </div>
  </div>
</div>
<?php 
	$genderArr = array("Male"=>Male,"Female"=>Female,"Other"=>Other); 
	$yearArr = array_combine(range(date("Y"), 1913), range(date("Y"), 1913));
	$monthArr = array('01'=>'January', '02'=>'February', '03'=>'March', '04'=>'April', '05'=>'May', '06'=>'June', '07'=>'July', '08'=>'August', '09'=>'September', '10'=>'October', '11'=>'November', '12'=>'December');
	$dayArr = array_combine(range(1,31), range(1,31));
	
	if($D['userDob'] == '0000-00-00'){ 
		$dateDOB = ""; 
	}else{
		$dateDOB = date('d/m/Y',strtotime($D['userDob']));
	}
	$D['userDob'];
	$dateDobArr = explode('-',$D['userDob']);
	
	/*$validate = array(
"userContact"=>array("func"=>"required,email","msg"=>"About me cannot be blank"));*/
?>
<?php if($_SESSION['SITEUSERID'] && ($_SESSION['SITEUSERID'] == $siteUserID)){ ?>
<div class="profile-wrapp">
  <div class="personal-info-wrapp">
    <div class="loader" id="PI"></div>
    <h1>PERSONAL INFO</h1>
    <form id="personalInfo" name="personalInfo" method="post">
      <input type="hidden" name="siteUserID" value="<?php echo $_SESSION['SITEUSERID'];?>" />
      <!-- <a href="#" class="btn-edit">Edit</a>  -->
	  <a href="#" class="btn-edit <?php echo( $edit_info_btn_details["color"] ); ?>"><?php echo( $edit_info_btn_details["button_txt"] ); ?></a> 
	  <!-- <a href="#" class="btn-save">Save</a>  -->
	  <a href="#" class="btn-save <?php echo( $save_info_btn_details["color"] ); ?>"><?php echo( $save_info_btn_details["button_txt"] ); ?></a> 
	  <!-- <a href="#" class="btn-cancel">cancel</a>  -->
	  <a href="#" class="btn-cancel <?php echo( $cancel_info_btn_details["color"] ); ?>"><?php echo( $cancel_info_btn_details["button_txt"] ); ?></a> 
	  <!-- <a href="http://a.stage.nu-casino.com/?xAction=remove" class="btn-remove">Remove</a> -->
	  <a href="<?php echo( $remove_acc_btn_details["color"] ); ?>" class="btn-remove"><?php echo( $remove_acc_btn_details["button_txt"] ); ?></a>
      <ul class="form personalInfo">
        <li> <span class="title">Name</span>
          <div class="element" style="display:none; line-height:36px;"> <?php echo $D['userName'];?> 
            <!--<input type="text" name="userName" id="userName" value="<?php //echo $D['userName'];?>" class="text upf" distit="Name" />--> 
          </div>
          <div class="data"><?php echo $D['userName'];?></div>
        </li>
        <li> <span class="title">GENDER</span>
          <div class="element" style="display:none;">
            <select class="mydds upf" name="userGender" id="userGender" distit="Gender">
              <option value="">Select Gender</option>
              <?php echo getArrayDD($genderArr,$D["userGender"]);?>
            </select>
          </div>
          <div class="data" id="UG"><?php echo $D['userGender']; ?></div>
        </li>
        <li> <span class="title">BIRTHDAY</span>
          <div class="element" style="display:none;">
            <div class="ddArr">
              <select class="mydds upf" name="userDay" id="userDay" distit="Birthday">
                <option value="">Day</option>
                <?php echo getArrayDD($dayArr,$dateDobArr[2]);?>
              </select>
            </div>
            <div class="ddArr">
              <select class="mydds" name="userMonth" id="userMonth">
                <option value="">Month</option>
                <?php echo getArrayDD($monthArr,$dateDobArr[1]);?>
              </select>
            </div>
            <div class="ddArr">
              <select class="mydds" name="userYear" id="userYear" >
                <option value="">Year</option>
                <?php echo getArrayDD($yearArr,$dateDobArr[0]);?>
              </select>
            </div>
          </div>
          <div class="data" id="arrDOB"> <?php echo $dateDOB;?></div>
        </li>
        <li> <span class="title">About me</span>
          <div class="element">
            <textarea  name="aboutMe" id="aboutMe" cols="" rows="" class="text upf" distit="About Me" ><?php echo $D['aboutMe'];?></textarea>
          </div>
          <div class="data lineHeight16"><?php echo $D['aboutMe'];?></div>
        </li>
      </ul>
    </form>
  </div>
</div>
<div class="profile-wrapp">
  <div class="personal-info-wrapp">
    <div class="loader" id="OI"></div>
    <h1>CONTACT & SHIPPING INFO</h1>
    <form id="contactShipping" name="contactShipping" method="post">
      <input type="hidden" name="siteUserID" value="<?php echo $_SESSION['SITEUSERID'];?>" />
      <!-- <a href="#" class="btn-edit">Edit</a>  -->
	  <a href="#" class="btn-edit <?php echo( $edit_contact_btn_details["color"] ); ?>"><?php echo( $edit_contact_btn_details["button_txt"] ); ?></a> 
	  <!-- <a href="#" class="btn-save">Save</a>  -->
	  <a href="#" class="btn-save <?php echo( $save_contact_btn_details["color"] ); ?>"><?php echo( $save_contact_btn_details["button_txt"] ); ?></a> 
	  <!-- <a href="#" class="btn-cancel">cancel</a>  -->
	  <a href="#" class="btn-cancel <?php echo( $cancel_contact_btn_details["color"] ); ?>"><?php echo( $cancel_contact_btn_details["button_txt"] ); ?></a> 
      <ul class="form contactShipping">
        <li> <span class="title">EMAIL</span>
          <div class="element" style=" line-height:36px;">
          	<?php echo $D['userEmail'];?>
            <!--<input value="<?php //echo $D['userEmail'];?>" type="text" class="text upf"  name="userEmail" id="userEmail1" distit="Email" />-->
          </div>
          <div class="data"><?php echo $D['userEmail'];?></div>
        </li>
        <li> <span class="title">First Name</span>
          <div class="element">
            <input value="<?php echo $D['userFirstName']; ?>" type="text" class="text upf" name="userFirstName" id="userFirstName" distit="First Name" />
          </div>
          <div class="data"><?php echo $D['userFirstName']; ?></div>
        </li>
        <li> 
          <span class="title">Last Name</span>
          <div class="element">
            <input value="<?php echo $D['userLastName']; ?>" type="text" class="text upf" name="userLastName" id="userLastName" distit="Last Name" />
          </div>
          <div class="data">
		    <?php echo $D['userLastName']; ?>
          </div>
        </li>
        <li> <span class="title">CONTACT NO</span>
          <div class="element">
            <input value="<?php echo $D['userContact']; ?>" type="text" class="text upf" name="userContact" id="userContact" distit="Contact No" />
          </div>
          <div class="data"><?php echo $D['userContact']; ?></div>
        </li>
        <li> <span class="title">City</span>
          <div class="element">
            <input type="text" value="<?php echo $D['userCity'];?>" class="text upf" name="userCity" id="userCity" distit="City" />
          </div>
          <div class="data"><?php echo $D['userCity'];?></div>
        </li>
        <li> <span class="title">State</span>
          <div class="element">
            <input value="<?php echo $D['userState'];?>" type="text" class="text upf" name="userState" id="userState" distit="State" />
          </div>
          <div class="data"><?php echo $D['userState'];?></div>
        </li>
        <li> <span class="title">COUNTRY</span>
          <div class="element">
            <select class="mydds upf" name="userCountry" id="userCountry" distit="Country">
              <option value="">Select Country</option>
              <?php echo getTableDD($DB->pre."country","countryID","countryName",$D["countryID"]);?>
            </select>
          </div>
          <div class="data" id="UC"><?php echo $D['countryName'];?></div>
        </li>
        <li> <span class="title">Street</span>
          <div class="element">
            <input type="text" value="<?php echo $D['userStreet'];?>" class="text upf" name="userStreet" id="userStreet" distit="Street" />
          </div>
          <div class="data"><?php echo $D['userStreet'];?></div>
        </li>
        <li> <span class="title">ADDRESS</span>
          <div class="element">
            <textarea cols="" rows="" class="text address upf"  name="userAddress" id="userAddress" distit="Address"><?php echo $D['userAddress'];?></textarea>
          </div>
          <div class="data"><?php echo $D['userAddress'];?></div>
        </li>
        <li> <span class="title">Zip Code</span>
          <div class="element">
            <input type="text" value="<?php echo $D['userZip'];?>" class="text upf" name="userZip" id="userZip" distit="Zip Code" />
          </div>
          <div class="data"><?php echo $D['userZip'];?></div>
        </li>
        <!--<li>
        	<input type="hidden" name="mxValidate" id="mxValidate" value="<?php //echo urlencode(json_encode($validate));?>" />
        </li>-->
      </ul>
    </form>
  </div>
</div>
<?php } ?>
