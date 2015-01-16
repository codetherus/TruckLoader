<?php
/*
	File: 0005_Script.php
	
	Test xajaxResponse->script method.
*/

require("./xajaxTestCase.inc.php");

final class TestCase extends xajaxTestCase
{
	public function __construct($xajax, $response, $body)
	{
		parent::__construct($xajax, $response, $body);

		$this->test->title = 'Execute Script';
		$this->test->description = 'Ensure that the script command is sent to and executed on the client browser.';

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
		$this->test->response->script("var content = document.getElementById('content'); while (content.firstChild) content.removeChild(content.firstChild); content.appendChild(document.createTextNode('Done'));");

		$this->test->Conclude();

		return $this->test->response;
	}
}

require('./xajaxUnitTest.inc.php');

