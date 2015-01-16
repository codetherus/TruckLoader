<?php

$errmsg = "";
if (! @mysql_connect("localhost","wellho","xxxxxxxx")) {
        $errmsg = "Cannot connect to database";
        }
@mysql_select_db("wellho");

// Create table if it doesn't exist

$q = <<<CREATE
create table pdf (
    pid int primary key not null auto_increment,
    title text,
    imgdata longblob)
CREATE;
@mysql_query($q);

// Store the .pdf

if ($errmsg == "") {
if ($_REQUEST[completed] == 1) {
        move_uploaded_file($_FILES['imagefile']['tmp_name'],"latest.img");
        $instr = fopen("latest.img","rb");
        $image = mysql_real_escape_string(fread($instr,filesize("latest.img")));
        if (strlen($instr) < 1000000) {
                mysql_query ("insert into pdf (title, imgdata) values (\"".
                $_REQUEST[whatsit].
                "\", \"".
                $image.
                "\")");
                $errmsg = "Done";
        } else {
                $errmsg = "Too large!";
        }
} else {
        $errmsg = "Form not completed";
}}
?>
<html>
<head>
<title>.pdf uploaded</title>
<body>
Operation status: <?= $errmsg ?><br>
Click <a href=pdfview.php>here</a> to download latest .pdf<br>
Click <a href=pdfupload.php>here</a> to get an upload form
</body>
</html>
 
