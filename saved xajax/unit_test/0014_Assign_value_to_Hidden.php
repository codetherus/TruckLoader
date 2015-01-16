<?php
/*
	File: 0014_Assign_value_to_Hidden.php
	
	Ensure that xajaxResponse->assign method can be used to assign a value to an input type='hidden' tag.
*/

require("./xajaxTestCase.inc.php");

final class TestCase extends xajaxTestCase
{
	public function __construct($xajax, $response, $body)
	{
		parent::__construct($xajax, $response, $body);

		$this->test->title = 'Assign value to Hidden';
		$this->test->description = 'Ensure that a xajaxResponse->assign call can be used to assign a value to an input type="hidden" tag.';

		$body->addChild(
			new clsInput(array(
				'attributes' => array(
					'id' => 'content',
					'type' => 'hidden',
					'name' => 'content',
					'value' => 'Working...'
					)
				))
			);

		$this->test->Expect('content', 'value', 'Done');

		$this->test->Begin();
	}

	function Execute()
	{
		$this->test->response->assign('content', 'value', 'Done');

		$this->test->Conclude();

		return $this->test->response;
	}
}

require('./xajaxUnitTest.inc.php');

