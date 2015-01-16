<?php
/*
	File: 0007_Assign_with_CDATA.php
	
	Test xajaxResponse->assign method is able to send CDATA second as part of data being assigned.
*/

require("./xajaxTestCase.inc.php");

final class TestCase extends xajaxTestCase
{
	public function __construct($xajax, $response, $body)
	{
		parent::__construct($xajax, $response, $body);

		$this->test->title = 'Assign with CDATA';
		$this->test->description = 'Ensure that the assign command can accept a data block that contains a CDATA section.';

		$body->addChild(
			new clsDiv(array(
				'attributes' => array('id' => 'content'),
				'child' => new clsLiteral('Working...')
				))
			);

		$this->test->Expect('content', 'innerHTML', array('<!--[CDATA[Done]]-->', '&lt;![CDATA[Done]]&gt;', ''));

		$this->test->Begin();
	}

	public function Execute()
	{
		$this->test->response->assign('content', 'innerHTML', '<![CDATA[Done]]>');

		$this->test->Conclude();

		return $this->test->response;
	}
}

require('./xajaxUnitTest.inc.php');

