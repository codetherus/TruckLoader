<?php
	header("Content-type:text/xml");
	ini_set('max_execution_time', 7000);
	print("<?xml version=\"1.0\" encoding=\"utf-8\"?>");
  if (!isset($_GET["pos"])) $_GET["pos"]=0;
?>

<?php
    include("../dbsettings.php");
    $mysql_host = $dbhost;
    $mysql_user = $dbuser;
    $mysql_pasw = $dbpassword;
    $mysql_db   = $dbdatabase;    
    $link = mysql_pconnect($mysql_host, $mysql_user, $mysql_pasw);
	  $db = mysql_select_db ($mysql_db);
  	getDataFromDB($_GET["mask"]);
	  mysql_close($link);
  //Turn the current row into a table for display
  function MakeRowTable($row)  
  {  
    $s = "<table  border='1'><tr>";
    $s = "<td style='border-color: white;'>".$row['driver']."</td>";    
    $s .= "<td style='border-color: white;'>".$row['location']."<td>";    
    $s .= "<td style='border-color: white;'>".$row['unload_date']."</td>";    
    $s .= "</tr></table>";    
    $s = htmlspecialchars($s);    
    return $s;
  }
	//print one level of the tree, based on parent_id
	function getDataFromDB($mask){
    $pos = $_GET['pos'];
    $dta = mysql_real_escape_string($mask);    
    $sql  = "select * from truck_loader where ";
    $sql .= "driver like '%$dta%' ";
    $sql .= "or location like '%$dta%' ";
    $sql .= "or home_town like '%$dta%' ";
    $sql .= "or telephone like '%$dta%' ";
    $sql .= "or email like '%$dta%' ";
    $sql .= "or home_office like '%$dta%' ";
    $sql .= "or comments like '%$dta%' ";
    $sql .= "or upload_comment like '%$dta%' ";
    $sql .= "or driver_alias like '%$dta%' ";
    $sql .= "or unload_date like '%$dta%' ";
    $sql .= "or truck_no like '%$dta%' ";
    $sql .= "or preferences like '%$dta%' ";
    $sql .= "or driving_limitations like '%$dta%' ";
    $sql .= "or load_options like '%$dta%' ";
    $sql .= "or ttype like '%$dta%' "; 
    $sql .= "or tlength like '%$dta%' ";
		$sql.= " Order By driver LIMIT ". $pos.",20";
		if ( $pos==0)
			print("<complete>");
		else
			print("<complete add='true'>");
		$res = mysql_query ($sql);
		if($res){
			while($row=mysql_fetch_array($res)){
        $rowtable = MakeRowTable($row);        
        $drv = $row['driver'];
        if ($drv=='') continue;
        if (substr($drv,0,1) == '(') continue;        
        $drv=htmlspecialchars($drv);
				print("<option value=\"".$drv."\">");
				print($rowtable);
				print("</option>");
			}
		}
		print("</complete>");
	}
?>