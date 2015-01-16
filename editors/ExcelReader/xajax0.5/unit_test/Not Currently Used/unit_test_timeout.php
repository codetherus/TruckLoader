<?php
/*
	File: unit_test_timeout.php
	
	Test that inconclusive tests time out properly.
*/

require("./xajaxTestCase.inc.php");

final class TestCase extends xajaxTestCase
{
	public function __construct($xajax, $response, $body)
	{
		parent::__construct($xajax, $response, $body);

		$this->test->title = 'Always Timeout';
		$this->test->description = 'Ensure that a test case will time out if it does not report success or failure.';

		$body->addChild(
			new clsDiv(array(
				'attributes' => array('id' => 'content'),
				'child' => new clsLiteral('Working...')
				))
			);

		$this->test->Begin();
	}

	function Execute()
	{
		return $this->test->response;
	}
}

require('./xajaxUnitTest.inc.php');

