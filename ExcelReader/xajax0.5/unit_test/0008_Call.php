<?php
/*
	File: 0008_Call_with_Array_Parameter.php
	
	Test xajaxResponse->call method.
*/

require("./xajaxTestCase.inc.php");

ob_start();
?>
update = function(values) {
	var elementID = values[0];
	var value = values[1];
	var element = document.getElementById(elementID);
	while (element.firstChild)
		element.removeChild(element.firstChild);
	element.appendChild(
		document.createTextNode(value)
		);
}
<?php
$update = ob_get_clean();

final class TestCase extends xajaxTestCase
{
	public function __construct($xajax, $response, $body)
	{
		global $update;

		parent::__construct($xajax, $response, $body);

		$this->test->title = 'Call javascript with Array Parameter';
		$this->test->description = 'Ensure that the call command and associated parameter values are sent to the client properly, and that the function is called.';

		$body->addChild(
			new clsScript(array(
				'attributes' => array('type' => 'text/javascript'),
				'child' => new clsLiteral($update)
				))
			);

		$body->addChild(
			new clsDiv(array(
				'attributes' => array('id' => 'content_xml'),
				'child' => new clsLiteral('Working (XML)...')
				))
			);

		$body->addChild(
			new clsDiv(array(
				'attributes' => array('id' => 'content_json'),
				'child' => new clsLiteral('Working (JSON)...')
				))
			);

		$this->test->Expect('content_xml', 'innerHTML', 'Done');
		$this->test->Expect('content_json', 'innerHTML', 'Done');

		$this->test->Begin();
	}

	function Execute()
	{
		$this->test->response->call('update', array( '0' => 'content_xml', '1' => 'Done' ));
		$this->test->response->script(
			'update(' . 
			json_encode(
				array( '0' => 'content_json', '1' => 'Done' )
				) . 
			')'
			);

		$this->test->Conclude();

		return $this->test->response;
	}
}

require('./xajaxUnitTest.inc.php');

