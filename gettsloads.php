<?php
include 'includes/loadsupload.class.php';
$uploader = new loaduploader();
$request = new GetImportedLoadsService();
$response = $uploader->CallGetImportedLoadsService($request);
echo'<pre>';
var_dump($response);
?>