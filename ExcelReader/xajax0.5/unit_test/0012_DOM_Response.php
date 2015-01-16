<?php
/*
	File: 0012_DOM_Response.php
	
	Test xajaxControl::getResponse method.
*/

require("./xajaxTestCase.inc.php");

final class TestCase extends xajaxTestCase
{
	public function __construct($xajax, $response, $body)
	{
		parent::__construct($xajax, $response, $body);

		$this->test->title = 'Send DOM Response';
		$this->test->description = '...';

		// $xajax->configure('debug', true);

		$body->addChild(
			new clsDiv(array(
				'attributes' => array('id' => 'container')
				))
			);

		$this->test->Expect('content', 'innerHTML', 'Done');

		$this->test->Begin();
	}

	public function Execute()
	{
		$objContent = new clsDiv(array(
			'attributes' => array('id' => 'content'),
			'child' => new clsLiteral('Done')
			));

		$this->test->response->appendResponse(
			$objContent->getResponse(0, 'xajax.$("container")')
			);

		$this->test->Conclude();

		return $this->test->response;
	}
}

require('./xajaxUnitTest.inc.php');

