<?php

$contact_us_err_msg = getErrorMessages( "contact_us" );
$email_err_msg = $contact_us_err_msg[ 'email' ];
$message_err_msg = $contact_us_err_msg[ 'message' ];
$name_err_msg = $contact_us_err_msg[ 'name' ];
$reason_err_msg = $contact_us_err_msg[ 'reason' ];

$validate = array(
	"name"=>array("func"=>"required","msg"=>$name_err_msg),
	"email"=>array("func"=>"required,email","msg"=>$email_err_msg),
	"reason"=>array("func"=>"required","msg"=>$reason_err_msg),
	"message"=>array("func"=>"required","msg"=>$message_err_msg)
);
?>
<script language="javascript" type="text/javascript" src="<?php echo SITEURL; ?>/mod/page/x-page.inc.js"></script>
<div class="contact-wrapp">
  <div class="loader"></div>
  <div style="height: 50px;" ><h1>CONTACT US</h1></div>
  
  <div class="editable contact-copy" id="page-3" >
	<?php echo $TPL->data["pageContent"]; ?>
	</div>
  
  <form name="contactUs" id="contactUs" onsubmit="return false;">
    <ul class="contact-form">
      <?php if(!$_SESSION['SITEUSERID']){?>
      <li class="title">NAME</li>
      <li>
        <input value="" type="text" name="name" id="name" class="text" title="Name" />
      </li>
      <li class="title">EMAIL</li>
      <li>
        <input value="" type="text" name="email" id="email" class="text" title="Email" />
      </li>
      <?php } ?>
      <li class="title">REASON FOR CONTACTING</li>
      <li class="dd-contact-reason">
        <select class="mydds" name="reason" id="reason" title="Reason for contacting" >
          <option value="">--- Select Reason ---</option>
          <option value="General">General</option>
          <option value="Sales">Sales</option>
          <option value="Business Related">Business Related</option>
          <option value="Technical">Technical</option>
          <option value="Other">Other</option>
        </select>
      </li>
      <li class="title">MESSAGE</li>
      <li>
        <textarea name="message" id="message" cols="" rows="" class="text" title="Message"></textarea>
      </li>
      <li>
        <input type="hidden" name="mxValidate" id="mxValidate" value="<?php echo urlencode(json_encode($validate));?>" />
      </li>
      <input type="submit" id="contactBtn" value="SUBMIT" class="button-red" />
    </ul>
  </form>
</div>
