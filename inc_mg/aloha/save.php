<?php
 
// Save Data
echo( $_REQUEST['pageId']."--".$_REQUEST['contentId'].'--'.$_REQUEST['content'] );

 
/* $query = "SELECT id FROM aloha
WHERE
pageId = '".$pageId."'
AND contentId = '".$contentId."';";
 
// $result = $db->query($query, $error);
 
$exists = false;
if($result->valid()) {
$exists = true;
$row = $result->current();
}
 
if ($exists == true) {
$query = "BEGIN;
UPDATE aloha SET
content = '".$content."'
WHERE
id = ".$row['id'].";
COMMIT;";
} else {
$query = "BEGIN;
INSERT INTO aloha
(id, pageId, contentId, content)
VALUES
(NULL, '".$pageId."', '".$contentId."', '".$content."');
COMMIT;";
}
 
$db->query($query, $error);
 
if ( empty($error) ) {
echo 'Content saved.';
} else {
echo 'Error: content not saved.';
//error_log('Error: '.print_r($error, true)."\n", 3, "aloha.log");
} */
 
?>