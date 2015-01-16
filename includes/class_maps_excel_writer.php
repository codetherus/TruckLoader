<?PHP
/**
*   This class does simple Excel spreadsheets .
*   The output is a download to the browser.
*/

class Excel_Writer 
{
  var $ssdata = '';           //Data Rows
  var $heads = '';            //Heading row
  
  //Constructor - just clear the sheet body strings
  function Excel_Writer()
  {
    $this->ssdata = '';
    $this->heads = '';
  }
  
  //Save the column header row
  function AddHeaderRow($s)
  {
    $this->heads = '';
    for ($i=0;$i<count($s); $i++)
    {
      $this->heads .= $s[$i] ."\t";
    } 
  }
  
  //Add a data row
  function AddRow($s)
  {
    $rw = '';
    for ($i=0;$i<count($s);$i++)
    {
      $rw .= $s[$i] ."\t";
    }
    $rw .= "\n";
    $this->ssdata .= $rw;
  }
  
  //Output the spreadsheet.
  function Generate($title, $fname,$qry='')
  {
    $ttl = $title.' '.$qry; //Sheet title row
    $cdisp = "Content-Disposition: attachment; filename=\"$fname\"";
    header("Content-type: application/x-msexcel"); 
    header($cdisp);
    header("Pragma: no-cache"); 
    header("Expires: 0"); 
    print "$this->heads\n$this->ssdata"; //Write it...
    //print "$this->ssdata"; //Write it...
  }
}
$excel = new Excel_Writer();
?>