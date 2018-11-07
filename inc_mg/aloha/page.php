<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en">
<head>
<title>Aloha Editor | Example how to save content</title>
 
<!-- load the jQuery and require.js libraries -->
<script type="text/javascript" src="require.js"></script>
<script type="text/javascript" src="jquery-1.7.2.js"></script>
 
<!-- here we have our Aloha Editor config -->
<script src="./aloha-config.js"></script>
 
<script src="./latest/lib/aloha.js"
data-aloha-plugins="common/ui,
common/format,
common/table,
common/list,
common/link,
common/highlighteditables,
common/block,
common/undo,
common/contenthandler,
common/paste,
common/commands,
common/abbr,
common/image"></script>
 
<link rel="stylesheet" href="./latest/css/aloha.css" type="text/css">
 
<!-- save the content of the page -->
<script src="./aloha-save.js"></script>
 
<script type="text/javascript">
Aloha.ready( function() {
var $ = Aloha.jQuery;
// Make all elements with class=".editable" editable once Aloha is loaded and ready.
$('.editable').aloha();
});
</script>
 
<style>
#headline {
font-size: 1.3em;
}
#article {
margin-top: 20px;
}
#log {
border: 2px dashed green;
margin: 5px auto 5px auto;
padding: 5px;
width: 75%;
display: none;
}
</style>
</head>
<body>
<div id="log"></div>
 
<h1>My Page</h1>
<p>Click below to edit the text. When leaving editing mode (switch between editable areas or click outside an editable area) the content will be saved.</p>
 
<div class="editable" id="headline">HEADLINE CONTENT</div>
<div class="editable" id="article">ARTICLE CONTENT</div>
 
<h2>Textarea</h2>
<textarea name="mytextarea" id="mytextarea" rows="10" class="editable">TEXT AREA CONTENT</textarea>
</body>
</html>