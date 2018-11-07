<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MaxDigi Solutions >Add Page</title>
<link href="http://localhost/cms2.0/xadmin/images/settings/favicon.png" rel="SHORTCUT ICON" type="images/icon" />
<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' />
<link rel="stylesheet" type="text/css" href="http://localhost/cms2.0/xadmin/css/style.css" />
<link rel="stylesheet" type="text/css" href="http://localhost/cms2.0/xadmin/css/inside.css" />
<script language="javascript" type="text/javascript" src="http://localhost/cms2.0/config.js.php"></script>
<script language="javascript" type="text/javascript" src="http://localhost/cms2.0/lib/js/jquery-1.7.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://localhost/cms2.0/lib/js/tipsy-0.1.7/tipsy.css" />
<script language="javascript" type="text/javascript" src="http://localhost/cms2.0/lib/js/tipsy-0.1.7/jquery.tipsy.js"></script>
<link rel="Stylesheet" type="text/css" href="http://localhost/cms2.0/lib/js/jscrollpane/jquery.jscrollpane.css" />
<script language="javascript" type="text/javascript" src="http://localhost/cms2.0/lib/js/jscrollpane/jquery.mousewheel.js"></script>
<script language="javascript" type="text/javascript" src="http://localhost/cms2.0/lib/js/jscrollpane/jquery.jscrollpane.min.js"></script>
<script language="javascript" type="text/javascript" src="http://localhost/cms2.0/core/js/mxdialog.inc.js"></script>
<script language="javascript" type="text/javascript" src="http://localhost/cms2.0/core/js/common.inc.js"></script>
<script language="javascript" type="text/javascript" src="http://localhost/cms2.0/xadmin/inc/js/common.inc.js"></script>
<script language="javascript" type="text/javascript" src="http://localhost/cms2.0/xadmin/inc/js/inside.inc.js"></script>
<link rel="stylesheet" type="text/css" href="http://localhost/cms2.0/xadmin/css/form.css" />
<script language="javascript" type="text/javascript" src="http://localhost/cms2.0/core/js/validate.inc.js"></script>
<script language="javascript" type="text/javascript" src="http://localhost/cms2.0/xadmin/inc/js/form.inc.js"></script>
<link rel="stylesheet" type="text/css" href="http://localhost/cms2.0/xadmin/css/maxdigi.css" />
</head>
<body>
<input type="hidden" name="PGINFO" id="PGINFO" value="%7B%22PK%22%3A%22pageID%22%2C%22TBL%22%3A%22page%22%2C%22PGDEFAULT%22%3A%22demo-list%22%2C%22PGTYPE%22%3A%22add%22%2C%22MODNAME%22%3A%22page%22%7D" />
<input type="hidden" name="XJSON" id="XJSON" value="0" />
<div id="top-nav"> <a class="logout right last" href="http://localhost/cms2.0/xadmin/?xAction=xLogout" title="logout">Logout</a> <a class="profile right" href="http://localhost/cms2.0/xadmin/admin-user-edit/?id=SUPER" title="Click to view profile">Welcome : Maxdigi Solutions</a> <a class="setting first left" href="http://localhost/cms2.0/xadmin/setting-list/" title="Settings">Settings</a> <a class="user left" href="http://localhost/cms2.0/xadmin/admin-user-list/" title="Admin Users">Admin Users</a> <a class="role left" href="http://localhost/cms2.0/xadmin/admin-role-list/" title="Admin Roles">Admin Roles</a> <a class="menu left" href="http://localhost/cms2.0/xadmin/admin-menu-list/" title="Admin Menus">Admin Menus</a> </div>
<div id="wrap-left"> <a href="http://localhost/cms2.0/xadmin/demo-list/" id="admin-logo"><img src="http://localhost/cms2.0/xadmin/images/settings/logo.png" /></a>
  <ul id="main-nav">
    <li><a href="http://localhost/cms2.0/xadmin/page-add/" class="add aactive" title="Add New Page">+</a><a href="http://localhost/cms2.0/xadmin/page-list/" class="active">Page</a></li>
    <li><a href="http://localhost/cms2.0/xadmin/post-add/" class="add" title="Add New Post">+</a><a href="http://localhost/cms2.0/xadmin/post-list/">Post</a></li>
    <li><a href="http://localhost/cms2.0/xadmin/menu-add/" class="add" title="Add New Menu">+</a><a href="http://localhost/cms2.0/xadmin/menu-list/">Menu</a></li>
    <li><a href="http://localhost/cms2.0/xadmin/category-add/" class="add" title="Add New Category">+</a><a href="http://localhost/cms2.0/xadmin/category-list/">Category</a></li>
    <li><a href="http://localhost/cms2.0/xadmin/demo-add/" class="add" title="Add New Demo">+</a><a href="http://localhost/cms2.0/xadmin/demo-list/">Demo</a></li>
  </ul>
</div>
<div id="wrap-right">
  <h1>CURRENTLY VIEWING : Add Page</h1>
  <form name="frmAddEdit" id="frmAddEdit" action="" method="post" enctype="multipart/form-data">
    <div id="page-nav">
      <div class="mandatory">Fields with (<em>* </em>) are mandatory</div>
      <div id="navigate">
        <input type="submit" name="btnSubmit" id="btnSubmit" class="btn-medium" value="SAVE" />
        <a href="http://localhost/cms2.0/xadmin/page-list/" class="list" title="List"></a><a href="http://localhost/cms2.0/xadmin/page-trash/" class="trash" title="Trash"></a></div>
    </div>
    <div id="wrap-data">
      <div id="wrap-form">
        <table width="100%" border="0" cellpadding="7" cellspacing="0">
          <tr>
            <th class="title" nowrap="nowrap" width="1%">Page Title <em>*</em></th>
            <td><input type="text" name="pageTitle" id="pageTitle" value="" class="text" title="Page Title" /></td>
          </tr>
          <tr>
            <th class="title" nowrap="nowrap" width="1%">Content</th>
            <td><textarea name="pageContent" id="pageContent"  style="height:400px;" title="Content"></textarea></td>
          </tr>
          <tr style="display:none;">
            <th colspan="2"><script type="text/javascript" src="http://localhost/cms2.0/lib/js/ckeditor/ckeditor.js"></script><script type="text/javascript"> CKEDITOR.replace("pageContent",{width:"98%",height:"350"});</script>
              <input type="hidden" name="xAction" id="xAction" value="ADD" />
              <input type="hidden" name="TBL" value="" />
              <input type="hidden" name="PK" value="" />
              <input type="hidden" name="mxValidate" id="mxValidate" value="%7B%22pageTitle%22%3A%7B%22func%22%3A%22required%22%2C%22msg%22%3Anull%7D%7D" /></th>
          </tr>
        </table>
      </div>
      <div id="wrap-sub-form">
        <table width="100%" border="0" cellpadding="7" cellspacing="0">
          <tr>
            <td><span class="title">Synopsis</span>
              <textarea name="synopsis" id="synopsis" class="text" rows="8" title="Synopsis"></textarea></td>
          </tr>
          <tr>
            <td><span class="title">Image</span>
              <div class="file-box"><span></span>
                <div>BROWSE
                  <input type="file" size="1" id="pageImage" name="pageImage" value="" class="text" title="Image" />
                  <input type="hidden" name="pageImageO" id="pageImageO" value="" />
                </div>
              </div></td>
          </tr>
          <tr>
            <td><span class="title">Template File</span>
              <input type="text" name="templateFile" id="templateFile" value="" class="text" title="Template File" /></td>
          </tr>
          <tr style="display:none;">
            <th colspan="2"><script type="text/javascript" src="http://localhost/cms2.0/lib/js/ckeditor/ckeditor.js"></script><script type="text/javascript"> CKEDITOR.replace("pageContent",{width:"98%",height:"400"});</script>
              <input type="hidden" name="xAction" id="xAction" value="ADD" />
              <input type="hidden" name="TBL" value="" />
              <input type="hidden" name="PK" value="" />
              <input type="hidden" name="mxValidate" id="mxValidate" value="%7B%22pageTitle%22%3A%7B%22func%22%3A%22required%22%2C%22msg%22%3Anull%7D%7D" /></th>
          </tr>
        </table>
      </div>
    </div>
  </form>
</div>
</body>
</html>