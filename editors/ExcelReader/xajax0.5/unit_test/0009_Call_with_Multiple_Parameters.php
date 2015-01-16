<?php
/*
	File: 0009_Call_with_Multiple_Parameters.php
	
	Test xajaxResponse->call method.
*/

require("./xajaxTestCase.inc.php");

ob_start();
?>
update = function(elementID, value) {
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

		$this->test->title = 'Call javascript with Multiple Parameters';
		$this->test->description = 'Ensure that the call command and associated list of parameters are sent to the client properly, and that the function is called.';

		$body->addChild(
			new clsScript(array(
				'attributes' => array('type' => 'text/javascript'),
				'child' => new clsLiteral($update)
				))
			);

		$body->addChild(
			new clsDiv(array(
				'attributes' => array('id' => 'content'),
				'child' => new clsLiteral('Working...')
				))
			);

		$this->test->Expect('content', 'innerHTML', 'Done');

		$this->test->Begin();
	}

	function Execute()
	{
		$this->test->response->call('update', 'content', 'Done');

		$this->test->Conclude();

		return $this->test->response;
	}
}

require('./xajaxUnitTest.inc.php');

