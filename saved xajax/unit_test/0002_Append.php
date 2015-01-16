<?php
/*
	File: 0002_Append.php
	
	Test xajaxResponse->append method.
*/

require("./xajaxTestCase.inc.php");

final class TestCase extends xajaxTestCase
{
	public function __construct($xajax, $response, $body)
	{
		parent::__construct($xajax, $response, $body);

		$this->test->title = 'Append to innerHTML';
		$this->test->description = 'Foundational test to ensure that an Append to InnerHTML is handled properly.';

		$body->addChild(
			new clsDiv(array(
				'attributes' => array('id' => 'content'),
				'child' => new clsLiteral('Working...')
				))
			);

		$this->test->ExpectFalse('content', 'innerHTML', 'Working...');

		$this->test->Begin();
	}

	function Execute()
	{
		$this->test->response->append('content', 'innerHTML', 'Done');

		$this->test->Conclude();

		return $this->test->response;
	}
}

require('./xajaxUnitTest.inc.php');

