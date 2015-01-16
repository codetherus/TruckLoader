<?php
/*
  From Max's ajax uploader.
  This php receives the uploaded file from the upload page.
  It stores it and returns a success/fail indication to
  the calling page. If success the upload page calls the
  xajax registered function to do the actual updating 
  of the LBJ dastabase.
*/

  //Session timeout controls
  ini_set('session.save_path', 'sessions');
  ini_set('session.gc_maxlifetime',43200);
  ini_set('session.gc_probability',1);
  ini_set('session.gc_divisor',1);

   session_start();
   // Edit upload location here
   $destination_path = './inbound_files/';;
   $result = 0;
   $target_path = $destination_path . basename( $_FILES['myfile']['name']);
   $_SESSION['uploaded_file'] = $target_path; //Save for importer
   if(@move_uploaded_file($_FILES['myfile']['tmp_name'], $target_path)) {
      $result = 1;
   }
   sleep(1);
?>
<script language="javascript" type="text/javascript">
window.top.window.stopUpload(<?php echo $result; ?>);
</script>   
