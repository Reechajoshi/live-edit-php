<?php
$MXPGINFO  = array();
$MXACCESS  = array("view","add","edit","delete","trash","restore");
$MXACTION  = array("view"=>array("view"),"add"=>array("add"), "edit"=>array("edit"), "trash"=>array("view"), "list"=>array("view")); 
$MXMACTION = array("list"=>array("trash"), "trash"=>array("restore","delete")); 
$MXPGFILE  = array("view"=>"add-edit", "add"=>"add-edit", "edit"=>"add-edit", "list"=>"list", "trash"=>"list");
$MXPGMENU  = array("view"=>array("list","trash"), "add"=>array("list","trash"), "edit"=>array("add","list","trash"), "list"=>array("add","trash"), "trash"=>array("add","list")); 
$MXADMINMENU = array("	setting-list"=>"Settings","admin-user-list"=>"Admin Users","admin-role-list"=>"Admin Roles","admin-menu-list"=>"Admin Menus");
$MXADMINROLE = array("100000"=>"Settings","100001"=>"Admin Users","100002"=>"Admin Roles","100003"=>"Admin Menus");
$MXADMINMENU1 = array('100000'=> array("adminMenuID"=>'100000', "menuTitle"=>"Settings", "seoUri"=>"setting"),
					  '100001'=> array("adminMenuID"=>'100001', "menuTitle"=>"Admin Users", "seoUri"=>"admin-user"),
					  '100002'=> array("adminMenuID"=>'100002', "menuTitle"=>"Admin Roles", "seoUri"=>"admin-role"),
					  '100003'=> array("adminMenuID"=>'100003', "menuTitle"=>"Admin Menus", "seoUri"=>"admin-menu"),
					  '100004'=> array("adminMenuID"=>'100004', "menuTitle"=>"Edit On Page", "seoUri"=>"edit-on-page"));
$MXARRSUPER = array("user"=>"xadmin","pass"=>"xadmin");
$MXSETTINGS = array();
?>