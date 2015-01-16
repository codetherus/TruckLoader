<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cleaning Class Example</title>
<style type="text/css">
body {
	font-family:Tahoma, Geneva, sans-serif;
}
</style>
</head>
</body>
<fieldset>
  <legend>Output</legend>
<?php
require_once('class.clean.php');
$post = new clean($_POST);	// <--- Create the clean object, with the array you want to clean.

// CUSTOM FIND&REPLACE
$customFind[] 		= "/'/";	//'				
$customReplace[] 	= "[HYPHEN REPLACED]";
$customFind[] 		= "/P[@a]tt[e3]rn/";
$customReplace[] 	= "[PA@TT3RN REPLACED]";
$customFind[] 		= "/f[i!]ndm[3e]/i";
$customReplace[] 	= "[I found you!]";

if($post->set()):														
echo "<h1>View Source to see the result properly</h1>\n";
	extract($post->forHTML,EXTR_PREFIX_ALL,'html'); 					
	extract($post->forMySQL,EXTR_PREFIX_ALL,'mysql'); 					
	extract($post->forMsSQL,EXTR_PREFIX_ALL,'mssql'); 					
	extract($post->orig,EXTR_PREFIX_ALL,'orig'); 						
	extract($post->customReplace($customFind,$customReplace),EXTR_PREFIX_ALL,'custom');
	
	echo '<!-- output -->
';
	echo 'Clean for HTML: '.$html_firstname."<br/>\n";					
	echo 'Clean for MySQL: '.$mysql_firstname."<br/>\n";					
	echo 'Clean for MsSQL: '.$mssql_firstname."<br/>\n";					
	//echo "Unclean: ".$orig_firstname."\n";									
	echo "<hr/>\n";
	echo "Entire HTML Array:\n";
	print_r($post->forHTML); 										
	echo "<hr/>\n";
	echo "Entire MySQL Array:\n";
	print_r($post->forMySQL); 										
	echo "<hr/>\n";
	echo "Entire MsSQL Array:\n";
	print_r($post->forMsSQL); 	
	echo "<hr/>\n";
	echo "CustomRegex Result:\n";
	print_r($post->customReplace); 										
	echo "<hr/>\n";
	echo '
	<!-- /output -->
';
endif;
?>
</fieldset>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  <br />
  <br />
  This input field is DIRTY!!!<br />
  <input type="text" value="<script>alert('XSSAttack!')</script>';DROP * tables; F!ndM3 P@tt3rn" size="80" name="firstname" />
  <br />
  <br />
  Click &#39;Go&#39; and let&#39;s see if we can clean it up!! :D<br />
  <br />
  <input type="submit" value="Go" />
</form>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-11372027-1");
pageTracker._trackPageview();
} catch(err) {}</script>
<body>
</html>