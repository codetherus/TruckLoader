<?php
/*
	File: 0017_Challenge_Response.php
	
	Test $xajax->challenge() method.
*/

session_start();

require("./xajaxTestCase.inc.php");

final class TestCase extends xajaxTestCase
{
	private $xajax;

	public function __construct($xajax, $response, $body)
	{
		$this->xajax = $xajax;

		parent::__construct($xajax, $response, $body);

		$this->test->title = 'Challenge and Response';
		$this->test->description = 'Test the Challenge and Response feature.';

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
		if ($this->xajax->challenge() !== true)
			return new xajaxResponse();

		$this->test->response->assign('content', 'innerHTML', 'Done');

		$this->test->Conclude();

		return $this->test->response;
	}
}

require('./xajaxUnitTest.inc.php');

