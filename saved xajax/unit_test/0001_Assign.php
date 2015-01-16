<?php
/*
	File: 0001_Assign.php
	
	Test xajaxResponse->assign method.
*/

require("./xajaxTestCase.inc.php");

final class TestCase extends xajaxTestCase
{
	public function __construct($xajax, $response, $body)
	{
		parent::__construct($xajax, $response, $body);

		$this->test->title = 'Assign to innerHTML';
		$this->test->description = 'Fundamental test to ensure that a xajax response can assign a new value to the innerHTML of an existing element on the page.';

		$xajax->configure('debug', true);
		$xajax->configure('debugOutputID', 'debugLog');

		$body->addChild(
			new clsDiv(array(
				'attributes' => array('id' => 'content'),
				'child' => new clsLiteral('Working...')
				))
			);

		$this->test->Expect('content', 'innerHTML', 'Done');

		$this->test->Begin();
	}

	public function Execute()
	{
		$this->test->response->assign('content', 'innerHTML', 'Done');

		$this->test->Conclude();

		return $this->test->response;
	}
}

require('./xajaxUnitTest.inc.php');

