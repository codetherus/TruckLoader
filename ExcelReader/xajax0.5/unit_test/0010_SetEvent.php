<?php
/*
	File: 0010_SetEvent.php
	
	Test xajaxResponse->setEvent method.
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

		$this->test->title = 'SetEvent';
		$this->test->description = 'Ensure that the setEvent response command is sent and executed properly.';

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
		$this->test->response->setEvent('content', 'click', 'update("content", "Done")');
		$this->test->response->script('xajax.$("content").onclick()');

		$this->test->Conclude();

		return $this->test->response;
	}
}

require('./xajaxUnitTest.inc.php');

