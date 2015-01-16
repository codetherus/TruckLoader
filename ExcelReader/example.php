<?php
/*
  Sample excel conversion for lbj military 
  truck list.
*/
require_once 'reader.php';
//Quick convert excel date (days) to nice date.
function date_convert($days){
  $ts = mktime(0,0,0,1,$days-1,1900);
  return date('m-d-Y',$ts); 
}
$filename="newlbjss.xls"; //Will pass in as a param when implemented
$prod=parseExcel($filename); //Extract the spreadsheet

//Convert the dates.
for($i=1;$i<=count($prod);$i++){
  if ($prod[$i]['OFFER NUMBER'] == '') continue; //Skip trailing blank rows...
  $prod[$i]['PickUpStartCDT'] = date_convert($prod[$i]['PickUpStartCDT']);
  $prod[$i]['PickUpEndCDT'] = date_convert($prod[$i]['PickUpEndCDT']);
  $prod[$i]['DeliveryStartCDT'] = date_convert($prod[$i]['DeliveryStartCDT']);
  $prod[$i]['DeliveryEndCDT'] = date_convert($prod[$i]['DeliveryEndCDT']);
}
echo"<pre>";
print_r($prod);

//This func. instances the reader class, uses it
//to load the spreadsheet, parses out all of the fields
//and returne an array of rows.
function parseExcel($excel_file_name_with_path)
{
	$data = new Spreadsheet_Excel_Reader();
	// Set output Encoding.
	$data->setOutputEncoding('UTF-8');
	$data->read($excel_file_name_with_path);

	$colname=array();
  //Set column names from row 1
  for ($i=1;$i<=$data->sheets[0]['numCols'];$i++){
    $colname[] = $data->sheets[0]['cells'][1][$i];
  }
  //Data starts in row 2 
	for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) { //For each row
		  for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) //For each column{
        @$product[$i-1][$colname[$j-1]]=$data->sheets[0]['cells'][$i][$j];
      }
		
	
	return $product;
}