<!-- load the jQuery and require.js libraries -->
<script type="text/javascript" src="<?php echo SITEURL; ?>/inc_mg/aloha/require.js"></script>
<script type="text/javascript" src="<?php echo SITEURL; ?>/inc_mg/aloha/jquery-1.7.2.js"></script>
 
<!-- here we have our Aloha Editor config -->
<script src="<?php echo SITEURL; ?>/inc_mg/aloha/aloha-config.js"></script>
 
<script src="<?php echo SITEURL; ?>/inc_mg/aloha/latest/lib/aloha.js"
data-aloha-plugins="common/ui,
common/format,
common/list,
common/link,
common/highlighteditables,
common/block,
common/undo,
common/contenthandler,
common/paste,
common/commands"></script>
 
<link rel="stylesheet" href="<?php echo SITEURL; ?>/inc_mg/aloha/latest/css/aloha.css" type="text/css">
 
<!-- save the content of the page -->
<script src="<?php echo SITEURL; ?>/inc_mg/aloha/aloha-save.js"></script>
 
<script type="text/javascript">
Aloha.ready( function() {

var $ = Aloha.jQuery;
// Make all elements with class=".editable" editable once Aloha is loaded and ready.
$('.editable').aloha();
});

// alert( 'x1' );
// Aloha.settings.toolbar = {
    // tabs: [
        // {
            // label: 'Format',
            // components: [
                // [ 'bold', 'italic', 'underline', "link", '\n',
                  // 'subscript', 'superscript', 'strikethrough' ],
				// [ 'formatBlock' ]
            // ]
        // },
		// {
            // label: 'Insert'
        // }
    // ]
// };
// alert( 'x3' );
</script>