<?php
/*
	File: 0006_ScriptContext.php
	
	Test xajaxResponse->script method.
*/

require("./xajaxTestCase.inc.php");

final class TestCase extends xajaxTestCase
{
	private $extention;
	private $requests;

	public function __construct($xajax, $response, $body)
	{
		parent::__construct($xajax, $response, $body);

		$this->test->title = 'Execute Script with Context';
		$this->test->description = 'Ensure that the script command is sent to and executed on the client browser while maintaining a context object throughout the asynchronous call.';

		// $xajax->configure('debug', true);

		$body->addChild(
			new clsDiv(array(
				'attributes' => array('id' => 'content'),
				'child' => new clsLiteral('Working...')
				))
			);

		$this->extension = new TestCaseExtension($response, $this->test->requests['finish']);

		$this->requests = $xajax->register(XAJAX_CALLABLE_OBJECT, $this->extension, array(
			'updatecontent' => array('context' => 'xajax.$("content")')
			));

		$this->test->Expect('content', 'innerHTML', 'Done');

		$this->test->Begin();
	}

	public function Execute()
	{
		$this->test->response->script(
			$this->requests['updatecontent']->getScript()
			);

		return $this->test->response;
	}

	public function Finish()
	{
		$this->test->Conclude();

		return $this->test->response;
	}
}

final class TestCaseExtension
{
	private $response;
	private $finish;

	public function __construct($response, $finish)
	{
		$this->response = $response;
		$this->finish = $finish;
	}

	public function UpdateContent()
	{
		$this->response->script('while (this.firstChild) this.removeChild(this.firstChild); this.appendChild(document.createTextNode("Done"));');
		$this->response->script(
			$this->finish->getScript()
			);
		return $this->response;
	}
}

require('./xajaxUnitTest.inc.php');

