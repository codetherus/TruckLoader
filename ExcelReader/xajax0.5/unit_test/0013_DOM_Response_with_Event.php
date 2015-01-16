<?php
/*
	File: 0013_DOM_Response_with_Event.php
	
	Test .....
*/

require("./xajaxTestCase.inc.php");

ob_start();
?>
update = function(elementID, value) {
	var element = document.getElementById(elementID);
	while (element.firstChild)
		element.removeChild(element.firstChild);
	element.appendChild(
		document.createTextNode(value)
		);
}
doEventDispatch = function(elementID, eventName) {
	var evt = null;
	var elm = null;

	if (document.getElementById)
		elm = document.getElementById(elementID);

	if (elm.fireEvent) {
		elm.fireEvent('on' + eventName);
		return;
	}

	if (document.createEvent)
		evt = document.createEvent('MouseEvents');

	if (elm && elm.dispatchEvent && evt && evt.initMouseEvent) {
		evt.initMouseEvent(
			eventName,
			true, // Click events bubble
			true, // and they can be cancelled
			document.defaultView, // Use the default view
			1, // Just a single click
			0, // Don't bother with co-ordinates
			0,
			0,
			0,
			false, // Don't apply any key modifiers
			false,
			false,
			false,
			0, // 0 - left, 1 - middle, 2 - right
			null
			);
		// Click events don't have any targets other than
		// the recipient of the click
		elm.dispatchEvent(evt);
	}
}
eventHandler = function() {
	update("content", "Done");
}
<?php
$script = ob_get_clean();

final class TestCase extends xajaxTestCase
{
	public function __construct($xajax, $response, $body)
	{
		global $script;

		parent::__construct($xajax, $response, $body);

		$this->test->title = 'Send DOM Response with Event';
		$this->test->description = 'Ensure that HTML Controls can be created via the DOM and their corresponding events are installed and triggered properly.';

		$body->addChild(
			new clsScript(array(
				'attributes' => array('type' => 'text/javascript'),
				'child' => new clsLiteral($script)
				))
			);

		$this->test->Expect('content', 'innerHTML', 'Done');

		$this->test->Begin();
	}

	public function Execute()
	{
		$objContent = new clsDiv(array(
			'attributes' => array('id' => 'content'),
			'child' => new clsLiteral('Working...'),
			'event' => array('onclick', new xajaxRequest('eventHandler'))
			));

		$this->test->response->appendResponse(
			$objContent->getResponse(0, 'document.body')
			);

		$this->test->response->call('doEventDispatch', 'content', 'click');

		$this->test->Conclude();

		return $this->test->response;
	}
}

require('./xajaxUnitTest.inc.php');

