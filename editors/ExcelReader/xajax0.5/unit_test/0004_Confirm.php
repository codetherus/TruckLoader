<?php
/*
	File: 0004_Confirm.php
	
	Test xajaxResponse->confirm method.
*/

require("./xajaxTestCase.inc.php");

final class TestCase extends xajaxTestCase
{
	public function __construct($xajax, $response, $body)
	{
		parent::__construct($xajax, $response, $body);

		$this->test->title = 'Call to Confirm';
		$this->test->description = '...';

		// $xajax->configure('debug', true);

		$bodyParts = array(
			new clsDiv(array(
				'attributes' => array('id' => 'confirmOk'),
				'child' => new clsLiteral('Working...')
				)),
			new clsDiv(array(
				'attributes' => array('id' => 'confirmCancel'),
				'child' => new clsLiteral('Working...')
				)),
			new clsScript(array(
				'attributes' => array('type' => 'text/javascript'),
				'child' => new clsLiteral(
					'try { ' .
					'confirm = function(text) { return text == "Ok"; } ' .
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
		$body->addChildren($bodyParts);

		$this->test->Expect('confirmOk', 'innerHTML', 'Done');
		$this->test->Expect('confirmCancel', 'innerHTML', 'Working...');

		$this->test->Begin();
	}

	function Execute()
	{
		$this->test->response->confirmCommands(1, 'Ok');
		$this->test->response->assign('confirmOk', 'innerHTML', 'Done');

		$this->test->response->confirmCommands(1, 'Cancel');
		$this->test->response->assign('confirmCancel', 'innerHTML', 'Done');

		$this->test->Conclude();

		return $this->test->response;
	}
}

require('./xajaxUnitTest.inc.php');

