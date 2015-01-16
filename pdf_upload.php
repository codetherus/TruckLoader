<?php
/*
  From Max's ajax uploader.
  This receives an uploaded pdf file to
  be included in a load history record.
*/
   session_start();
   // Edit upload location here
   $destination_path = './inbound_pdf_files/';;
   $result = 0;
   $target_path = $destination_path . basename( $_FILES['myfile']['name']);
   $_SESSION['uploaded_file'] = $target_path; //Save for importer
   if(move_uploaded_file($_FILES['myfile']['tmp_name'], $target_path)) {
      $result = 1;
   }
   sleep(1);
?>
<script language="javascript" type="text/javascript">
window.top.window.stopUpload(<?php echo $result; ?>);
</script>   
