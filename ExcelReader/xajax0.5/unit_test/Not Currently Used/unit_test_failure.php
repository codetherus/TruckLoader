<?php
/*
	File: unit_test_failure.php
	
	Script to test that failed unit tests are shown properly.
*/

require("./xajaxTestCase.inc.php");

final class TestCase extends xajaxTestCase
{
	public function __construct($xajax, $response, $body)
	{
		parent::__construct($xajax, $response, $body);

		$this->test->title = 'Always Fail';
		$this->test->description = 'Ensure that Test Cases can report failure properly.';

		$body->addChild(
			new clsDiv(array(
				'attributes' => array('id' => 'content'),
				'child' => new clsLiteral('Working...')
				))
			);

		$this->test->ExpectFalse('content', 'innerHTML', 'wont work');

		$this->test->Begin();
	}

	function Execute()
	{
		$this->test->response->assign('content', 'innerHTML', 'wont work');

		$this->test->Conclude();

		return $this->test->response;
	}
}

require('./xajaxUnitTest.inc.php');

