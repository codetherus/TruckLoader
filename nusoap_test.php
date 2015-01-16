<?php
/*
  nusoap library testing
*/
require_once('NuSoap/lib/nusoap.php');
$client = new nusoap_client('http://ws.cdyne.com/SpellChecker/check.asmx?WSDL',true); 
$err = $client->getError();
if ($err) {
	echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
	echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
	exit();
}
$params = array(
  'BodyText' => 'The quick brown fx jumd over the lzy dog');
/*function call($operation,
                $params=array(),
                $namespace='http://tempuri.org',
                $soapAction='',
                $headers=false,$rpcParams=null,
                $style='rpc',$use='encoded')
*/              
$result = $client->call('CheckTextBodyV2', $params,
                        'http://ws.cdyne.com/CheckTextBodyV2',
                        'http://ws.cdyne.com/CheckTextBodyV2');
                        

if ($err) {
	echo '<h2>Call error</h2><pre>' . $err . '</pre>';
	echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
	exit();
}
echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
echo '<h2>Response</h2>' . htmlspecialchars($client->response);
//echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
$file = 'xml_response.xml';
$dta = $client->response; //htmlspecialchars($client->response);
$i = strpos($dta,'<?xml');
$dta = substr($dta,$i);
file_put_contents($file,$dta);
function startElement($parser, $name, $attrs) 
{
    global $depth;
/*
    for ($i = 0; $i < $depth[$parser]; $i++) {
        echo "  ";
    }
*/
    echo "$name=";
    $depth[$parser]++;
}

function endElement($parser, $name) 
{
    global $depth;
    $depth[$parser]--;
}
function characterData($parser, $data) 
{
    echo "$data<br>";
}


$xml_parser = xml_parser_create();
xml_set_element_handler($xml_parser, "startElement", "endElement");
xml_set_character_data_handler($xml_parser, "characterData");

if (!($fp = fopen($file, "r"))) {
    die("could not open XML input");
}

while ($data = fread($fp, 4096)) {
    if (!xml_parse($xml_parser, $data, feof($fp))) {
        die(sprintf("XML error: %s at line %d",
                    xml_error_string(xml_get_error_code($xml_parser)),
                    xml_get_current_line_number($xml_parser)));
    }
}
xml_parser_free($xml_parser);
?>