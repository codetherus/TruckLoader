<?php
/**
  05-16-2013
  Php page for running the js and css compression tool
  See compress.php in the compress folder.
**/  
function do_compress()
{
require 'compress.php';  //load the compressor
require 'filelist.php';  //load the files to compress and call the compression method.
}
if (isset($_GET['go']))
  do_compress();
?>
<!DOCTYPE html>
<html>
<head>
  <title> CSS and JS Compression Tool</title>
  <meta charset="utf-8">
</head>
<body>

<form name="form1" method="Get" action="compression_tool.php">
<input type="hidden" name="go" id="go"/>
<input type="submit" value="Submit to run the file compression processor..."/>
</form>
</body>
</html>