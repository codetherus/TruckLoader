<?php
/*
	File: 0003_Alert.php
	
	Test xajaxResponse->assign method.
*/

require("./xajaxTestCase.inc.php");

final class TestCase extends xajaxTestCase
{
	public function __construct($xajax, $response, $body)
	{
		parent::__construct($xajax, $response, $body);

		$this->test->title = 'Call to Alert';
		$this->test->description = 'Ensure that the response command alert properly transmits the given text and that the alert method is called on the browser.';

		$body->addChild(
			new clsDiv(array(
				'attributes' => array('id' => 'content'),
				'child' => new clsLiteral('Working...')
				))
			);

		$body->addChild(
			new clsScript(array(
				'attributes' => array('type' => 'text/javascript'),
				'child' => new clsLiteral(
					'try { ' .
					'alert = function(text) { ' .
					'document.getElementById("content").innerHTML = text; ' .
					'} ' .
					'} catch (exception) { ' .
					'var expectation = document.createElement("DIV"); ' .
					'expectation.setAttribute("id", "expectation"); ' .
					'expectation.appendChild(document.createTextNode("This test cannot be performed on the current browser.")); ' .
					'document.body.appendChild(expectation); ' .
					'var result = document.createElement("DIV"); ' .
					'result.setAttribute("id", "result"); ' .
					'result.appendChild(document.createTextNode("inconclusive")); ' .
					'document.body.appendChild(result); ' .
					'xajax_TestCase.Execute = function() { }; ' .
					'} '
					)
				))
			);

		$this->test->Expect('content', 'innerHTML', 'Done');

		$this->test->Begin();
	}

	function Execute()
	{
		$this->test->response->alert('Done');

		$this->test->Conclude();

		return $this->test->response;
	}
}

require('./xajaxUnitTest.inc.php');

