/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{	config.skin = 'BootstrapCK-Skin';
	config.toolbar = 'Full';
	config.toolbar_Basic =
	[
		[ 'Source', 'Maximize'],		
		[ 'Bold','Italic','Underline'],
		[ 'NumberedList','BulletedList'],
		[ 'Link','Unlink','Anchor' ] ,
		[ 'TextColor','BGColor' ] ,
		
		['Font','FontSize' ] 
	];
	
	config.toolbar_Medium =
	[
	  	[ 'Source', 'Maximize'],
		[ 'Cut','Copy'],
		['Paste','PasteText','PasteFromWord'],
		['Undo','Redo' ] ,
		[ 'Find','Replace'],
		[ 'Bold','Italic','Underline'],
		['Strike','Subscript','Superscript'] ,
		[ 'NumberedList','BulletedList'],
		[ 'Link','Unlink','Anchor' ] ,
		[ 'Image'],
		[ 'TextColor','BGColor' ] ,
		[ 'Styles'],['Format'],
		['Font','FontSize' ] 
	];
	config.toolbar_Full =
	[
		[ 'Source', 'Maximize'],
		['Save','NewPage','DocProps','Preview'] ,
		[ 'Cut','Copy'],
		['Paste','PasteText','PasteFromWord'],
		['Undo','Redo' ] ,
		[ 'Find','Replace'],
		['SelectAll','-','SpellChecker', 'Scayt' ] ,
		[ 'Bold','Italic','Underline'],
		['Strike','Subscript','Superscript'] ,
		[ 'NumberedList','BulletedList'],
		['Outdent','Indent'],
		['Blockquote','CreateDiv'],
		['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
		['BidiLtr','BidiRtl' ] ,
		['RemoveFormat' ],
		[ 'Link','Unlink','Anchor' ] ,
		[ 'Image','Flash','Smiley','SpecialChar'],
		['PageBreak','HorizontalRule'] ,
		['Table','Iframe','Templates'],
		[ 'TextColor','BGColor' ] ,
		[ 'Styles'],['Format'],
		['Font','FontSize' ] 
		
		/*['Checkbox', 'Radio', 'TextField', 'Textarea'],['Print'], 
		['Select', 'Button', 'ImageButton', 'HiddenField' 'Iframe',] ,*/
	];
	
	config.filebrowserBrowseUrl = SITEURL+'/lib/js/kcfinder/browse.php?type=files';
	config.filebrowserImageBrowseUrl = SITEURL+'/lib/js/kcfinder/browse.php?type=images';
	config.filebrowserFlashBrowseUrl = SITEURL+'/lib/js/kcfinder/browse.php?type=flash';
	config.filebrowserUploadUrl = SITEURL+'/lib/js/kcfinder/upload.php?type=files';
	config.filebrowserImageUploadUrl = SITEURL+'/lib/js/kcfinder/upload.php?type=images';
	config.filebrowserFlashUploadUrl = SITEURL+'/lib/js/kcfinder/upload.php?type=flash';
};
