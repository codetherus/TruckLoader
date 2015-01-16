<?php
/*
  5/26/11
  This page handles the military truck loads spreadsheet upload to
  LadsByJake.com
  
  1. Get an uploaded file from the user.
  2. Save it.
  3. Redirect to the processing pages.
*/
  //Session timeout controls
  ini_set('session.save_path', './sessions');
  ini_set('session.gc_maxlifetime',43200);
  ini_set('session.gc_probability',1);
  ini_set('session.gc_divisor',1);
  session_start();
//Save the uploaded file and 
  function process(){
   // Edit upload location here
   $destination_path = './inbound_files/';;
   $result = 0;
   $target_path = $destination_path . basename( $_FILES['myfile']['name']);
   $_SESSION['uploaded_file'] = $target_path; //Save for importer
   if(@move_uploaded_file($_FILES['myfile']['tmp_name'], $target_path)) {
      $result = 1;
   }
   if ($result == 1)
      header("Location: ProcessLoadsFile.php");
  }
//If not loading, process the upload.  
if (isset($_POST['isposted']) && $_POST['isposted'] == 'yes'){
  process();
}  

?>
<!DOCTYPE HTML>
<html>
<head>
<title>Military Loads posting</title>
</head>
<body style="color: white; background-color: black;">
<center><h2>Military Loads Posting Processing</h2>
<br/><br/><br/>
<form action="loaduploader.php" method="post" enctype="multipart/form-data" >
<input type="hidden" id="isposted" name="isposted" value="yes"/>
<label style="text-align: left; width: 350px;">File:&nbsp;
<input name="myfile" id="myfile" type="file" size="50" /></label> <br/><br/>
<input type="submit" name="submitBtn" class="sbtn" value="Upload" />
</form>
</body>
</html>