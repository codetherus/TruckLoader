<?php
/*
	File: 0011_AddRemoveHandler.php
	
	Test xajaxResponse->addHandler and xajaxResponse->removeHandler methods.
*/

require("./xajaxTestCase.inc.php");

ob_start();
?>
move = function(sourceID, destinationID) {
	var destination = document.getElementById(destinationID);
	while (destination.firstChild)
		destination.removeChild(destination.firstChild);
	var source = document.getElementById(sourceID);
	while (source.firstChild) {
		var value = source.firstChild;
		source.removeChild(value);
		destination.appendChild(value);
	}
}
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
	update("first", "Done");
}
<?php
$script = ob_get_clean();

final class TestCase extends xajaxTestCase
{
	public function __construct($xajax, $response, $body)
	{
		global $script;

		parent::__construct($xajax, $response, $body);

		$this->test->title = 'AddHandler / RemoveHandler';
		$this->test->description = 'Ensure that the addHandler and removeHandler response commands are sent and executed properly.';

		$body->addChild(
			new clsScript(array(
				'attributes' => array('type' => 'text/javascript'),
				'child' => new clsLiteral($script)
				))
			);

		$body->addChild(
			new clsDiv(array(
				'attributes' => array('id' => 'first'),
				'child' => new clsLiteral('Working...')
				))
			);
		$body->addChild(
			new clsDiv(array(
				'attributes' => array('id' => 'second'),
				'child' => new clsLiteral('Working...')
				))
			);

		$this->test->Expect('first', 'innerHTML', 'Working...');
		$this->test->Expect('second', 'innerHTML', 'Done');

		$this->test->Begin();
	}

	function Execute()
	{
		$this->test->response->addHandler('first', 'click', 'eventHandler');
		$this->test->response->script('doEventDispatch("first", "click")');
		$this->test->response->call('move', 'first', 'second');
		$this->test->response->assign('first', 'innerHTML', 'Working...');
		$this->test->response->removeHandler('first', 'click', 'eventHandler');
		$this->test->response->script('doEventDispatch("first", "click")');

		$this->test->Conclude();

		return $this->test->response;
	}
}

require('./xajaxUnitTest.inc.php');

