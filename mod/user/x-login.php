<div class="container">
<div class="wrapper page-bg">
  <div class="page-content">
    <div class="editor-data">
      <h1 class="title">Member Login</h1>
      <div class="login-wrap">
        <form name="frmlogin" id="frmlogin" action="" method="post" onsubmit="return validateForm(this);">
          <table border="0" cellspacing="2" cellpadding="5" align="left"  width="100%">
            <tr>
              <td>E-mail</td>
              <td><input type="text" name="userEmail" id="userEmail" value="" class="text" title="Email" /></td>
            </tr>
            <tr>
              <td>Password</td>
              <td><input type="password" name="userPass" id="userPass"  value="" class="text" title="Password" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input type="submit" name="btnLogin" id="btnLogin" class="button button-middle" value="" />
                <input type="hidden" name="xAction" id="xAction" value="loginMember" />
                <input type="hidden" name="redirectTo" id="redirectTo" value="<?php echo $redirectTo; ?>" /></td>
            </tr>
          </table>
        </form>
      </div>
    </div>
  </div>
</div>
