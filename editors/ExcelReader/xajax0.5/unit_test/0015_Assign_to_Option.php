<?php
/*
	File: 0015_Assign_to_Option.php
	
	Ensure that xajaxResponse->assign method can be used to assign a value to an Option tag.
*/

require("./xajaxTestCase.inc.php");

final class TestCase extends xajaxTestCase
{
	public function __construct($xajax, $response, $body)
	{
		parent::__construct($xajax, $response, $body);

		$this->test->title = 'Assign to Option';
		$this->test->description = 'Ensure that a xajaxResponse->assign call can be used to assign to an Option tag.';

		$body->addChild(
			new clsSelect(array(
				'attributes' => array(
					'id' => 'dropDown'
					),
				'children' => array(
					new clsOption(array(
						'attributes' => array(
							'id' => 'content',
							'value' => 'Working...'
							),
						'child' => new clsLiteral('Working...')
						))
					)
				))
			);

		$this->test->Expect('content', 'value', 'Done');
		$this->test->Expect('content', 'innerHTML', 'Done');

		$this->test->Begin();
	}

	function Execute()
	{
		$this->test->response->assign('content', 'value', 'Done');
		$this->test->response->assign('content', 'innerHTML', 'Done');

		$this->test->Conclude();

		return $this->test->response;
	}
}

require('./xajaxUnitTest.inc.php');

