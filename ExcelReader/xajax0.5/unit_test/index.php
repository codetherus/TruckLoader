<?php
/*
	File: index.phpinner
	
	xajax Unit Test Framework
*/

error_reporting(E_ERROR | E_WARNING | E_PARSE);

define('XAJAX_HTML_CONTROL_DOCTYPE_FORMAT', 'HTML');
define('XAJAX_HTML_CONTROL_DOCTYPE_VERSION', '4.01');
define('XAJAX_HTML_CONTROL_DOCTYPE_VALIDATION', 'TRANSITIONAL');

require("./xajaxAIO.inc.php");
require("./controlsAIO.inc.php");

$xajax = new xajax();

$xajax->configure('javascript URI', './');

$framework = new Framework($xajax);

$xajax->processRequest();

$objTitle = new clsTitle(array(
	'children' => array(new clsLiteral('xajax Unit Test System'))
	));

ob_start();

?>

		<?php

$objStyle = new clsStyle(array(
	'attributes' => array(
		'type' => 'text/css'
		),
	'child' => new clsLiteral(ob_get_clean())
	));

ob_start();

?>

getElementText = function(element) {
	return element.innerText || element.innerHTML;
}

getFrameDocument = function(frame) {
	return frame.contentDocument || frame.contentWindow.document;
}

clearElementContent = function(element) {
	while (element.firstChild)
		element.removeChild(element.firstChild);
}

replaceElementContent = function(element, content) {
	clearElementContent(element);
	if (content.nodeType)
		element.appendChild(content);
	else
		for (var i in content)
			if (isNaN(i) == false)
				element.appendChild(content[i]);
}

toggleIt = {
	block: function(button, element) {
		replaceElementContent(
			button, 
			document.createTextNode('(show)')
			);
		element.style.display = 'none';
	},
	none: function(button, element) {
		replaceElementContent(
			button, 
			document.createTextNode('(hide)')
			);
		element.style.display = 'block';
	}
}

toggle = function(button) {
	var element = button.parentNode.nextSibling;
	var current = element.style.display;
	toggleIt[current](button, element);
	return false;
}

tests = [];

<?php

$objHeadScript = new clsScript(array(
	'attributes' => array(
		'type' => 'text/javascript'
		),
	'child' => new clsLiteral(ob_get_clean())
	));

$objHead = new clsHead(array(
	'xajax' => $xajax,
	'children' => array(
		$objTitle,
		$objStyle,
		$objHeadScript
		)
	));

ob_start();

?>
pageElement = {}

pageElement.test_container_strip = xajax.$('test_container_strip');
pageElement.test_container = xajax.$('test_container');
pageElement.results_container = xajax.$('results_container');
pageElement.status = xajax.$('status');
pageElement.start_button = xajax.$('startButton');

function TestCase(id, script, parent) {
	var _title = null;
	var _description = null;
	var _expectation = null;
	var _result = null;
	var _frame = document.createElement('IFRAME');
	var _container = document.createElement('TD');
	var _interval = null;

	this.check = function() {
		var update = function(container) {
			if (container)
				if (container.tagName)
					if ('DIV' == container.tagName)
						return getElementText(container);
			return null;
		};

		xajax.config.baseDocument = getFrameDocument(
			_frame
			);

		var titleDiv = xajax.$('title');
		var descriptionDiv = xajax.$('description');
		var expectationDiv = xajax.$('expectation');
		var resultDiv = xajax.$('result');

		xajax.config.baseDocument = document;

		if (!_title) _title = update(titleDiv);
		if (!_description) _description = update(descriptionDiv);
		if (!_expectation) _expectation = update(expectationDiv);
		if (!_result) _result = update(resultDiv);

		if (this.isComplete())
			this.conclude();
	};

	this.conclude = function() {
		clearInterval(_interval);
		_container.parentNode.removeChild(_container);

		displayResults();

		watchDog.reset();
	};

	this.abort = function() {
		_result = 'failed';
		_expectation = 'timed out';
		this.conclude();
	};

	this.isComplete = function() {
		return (null != _result);
	};

	this.getTitle = function() { return _title; };
	this.getDescription = function() { return _description; };
	this.getResult = function() { return _result; };
	this.getExpectation = function() { return _expectation; };

	this.start = function() {
		_frame.src = script;
		_frame.style.display = 'none';

		_container.style.width = '10px';
		_container.style.height = '10px';
		_container.style.backgroundColor = 'black';
		_container.style.border = '1px solid white';
		_container.appendChild(_frame);

		parent.appendChild(_container);

		// weirdness with setInterval... forgets who [this] is...
		var me = this;

		_interval = setInterval(function() { me.check(me); }, 1000);
	};
}

initiateTest = function(id, script) {
	watchDog.state(0);

	replaceElementContent(
		pageElement.status, 
		document.createTextNode('Testing...')
		);

	pageElement.test_container_strip.style.display = 'block';
	pageElement.start_button.disabled = 'disabled';

	tests[id] = new TestCase(id, script, pageElement.test_container);
	tests[id].start();
}

testsInitiated = function() {
	watchDog.state(1);

	replaceElementContent(
		pageElement.status,
		document.createTextNode('Waiting...')
		);

	watchDog.reset();
}

abortTests = function() {
	for (var i in tests)
		if (false == tests[i].isComplete())
			tests[i].abort();
}

complete = function() {
	watchDog.state(2);

	pageElement.start_button.disabled = '';
	pageElement.test_container_strip.style.display = 'none';
	replaceElementContent(
		pageElement.status,
		document.createTextNode('Complete.')
		);

	tests = [];
}

displayResults = function() {
	var titleDiv = document.createElement('DIV');
	titleDiv.appendChild(
		document.createTextNode('Results:')
		);

	var resultsUL = document.createElement('UL');
	for (var i in tests) {
		var test = tests[i];

		if (null == test.getTitle())
			continue;

		var color = 'orange';
		if (test.getResult() == 'success')
			color = 'green';
		else if (test.getResult() == 'failure')
			color = 'red';

		var resultDescriptionToggle = document.createElement('A');
		resultDescriptionToggle.href = '# Show/Hide Description';
		resultDescriptionToggle.onclick = function() { return toggle(this); }
		resultDescriptionToggle.appendChild(document.createTextNode('(show)'));
		if (null == test.description)
			resultDescriptionToggle.disabled = 'disabled';

		var resultTitle = document.createElement('SPAN');
		resultTitle.style.fontWeight = 'bold';
		if (null != test.getTitle())
			resultTitle.appendChild(document.createTextNode(test.getTitle()));
		else
			resultTitle.appendChild(document.createTextNode(i));

		var resultText = document.createElement('SPAN');
		if (null != test.getResult()) {
			resultText.appendChild(document.createTextNode(test.getResult()));
			if (null != test.getExpectation()) {
				resultText.appendChild(document.createElement('BR'));
				resultText.appendChild(document.createTextNode(test.getExpectation()));
			}
		}

		var result = document.createElement('DIV');
		result.style.color = color;
		result.appendChild(resultDescriptionToggle);
		result.appendChild(document.createTextNode(' '));
		result.appendChild(resultTitle);
		result.appendChild(document.createTextNode(': '));
		result.appendChild(resultText);

		var resultDescription = document.createElement('DIV');
		resultDescription.style.display = 'none';
		if (null != test.getDescription())
			resultDescription.appendChild(document.createTextNode(test.getDescription()));

		var resultLI = document.createElement('LI');
		resultLI.appendChild(result);
		resultLI.appendChild(resultDescription);

		resultsUL.appendChild(resultLI);
	}

	var resultsDiv = document.createElement('DIV');
	resultsDiv.appendChild(titleDiv);
	resultsDiv.appendChild(resultsUL);

	while (pageElement.results_container.firstChild)
		pageElement.results_container.removeChild(pageElement.results_container.firstChild);
	pageElement.results_container.appendChild(resultsDiv);
}

countPendingTests = function() {
	return pageElement.test_container
		.childNodes
		.length;
}

WatchDog = function(abortMethod, completeMethod) {
	var _count = 0;
	var _timeout = null;

	var _state = 0;
	// 0 = loading tests...
	// 1 = waiting for tests to complete...
	// 2 = complete

	this.clear = function() {
		if (null != _timeout) {
			clearTimeout(_timeout);
			_timeout = null;
		}
		_count = 0;
	};

	this.set = function() {
		// Weirdness with setTimeout... need to remember [this] context...
		var me = this;

		_timeout = setTimeout(function() { me.fire(); }, 500);
	};

	this.fire = function() {
		_timeout = null;

		if (0 == _state)
			return this.set();

		_count = _count + 1;

		if (_count > 40)
			abortMethod();

		var count = 0;
		for (var i in tests)
			if (null == tests[i].getResult())
				count = count + 1;

		if (0 == count)
			return completeMethod();

		this.set();
	};

	this.state = function(current) {
		_state = current;
	};
}

WatchDog.prototype.reset = function() {
	this.clear();
	this.set();
};

watchDog = new WatchDog(abortTests, complete);

		<?php

$objBodyScript = new clsScript(array(
	'attributes' => array(
		'type' => 'text/javascript'
		),
	'child' => new clsLiteral(ob_get_clean())
	));

$objBody = new clsBody(array(
	'children' => array(
		new clsDiv(array(
			'attributes' => array('style' => 'width: 800px;'),
			'children' => array(
				new clsDiv(array(
					'attributes' => array(
						'style' => 'background-color: darkgray; color: white; font-size: large; text-align: center; width: 80%; margin-left: 10%; margin-right: 10%;'
						),
					'child' => new clsLiteral('xajax Unit Test System')
					)),
				new clsDiv(array(
					'attributes' => array(
						'style' => 'width: 70%; margin-left: 15%; margin-right: 15%; margin-top: 10px; margin-bottom: 10px;'
						),
					'child' => new clsLiteral(
'This script is intended to execute a series of unit test scripts that verify the proper operation of specific features of the xajax project.  Click the start button to begin the process.  Once all test scripts have completed (or the wait period is expired) the result of each test is displayed.'
						)
					)),
				new clsDiv(array(
					'attributes' => array(
						'style' => 'width: 70%; border: 1px solid #aaaaff; margin-left: 15%; margin-right: 15%; padding: 5px;'
						),
					'children' => array(
						new clsTable(array(
							'attributes' => array(
								'style' => 'width: 100%;'
								),
							'child' => new clsTBody(array(
								'child' => new clsTR(array(
									'children' => array(
										new clsTD(array(
											'child' => new clsButton(array(
												'attributes' => array('id' => 'startButton'),
												'child' => new clsLiteral('Start'),
												'event' => array('onclick', $framework->requests['start'])
												))
											)),
										new clsTD(array(
											'child' => new clsLiteral('Status: ')
											)),
										new clsTD(array(
											'child' => new clsDiv(array(
												'attributes' => array('id' => 'status'),
												'child' => new clsLiteral('Ready.')
												))
											))
										)
									))
								))
							)),
						new clsDiv(array(
							'attributes' => array(
								'id' => 'test_container_strip',
								'style' => 'border: 1px solid gray; display: none;'
								),
							'child' => new clsTable(array(
								'child' => new clsTBody(array(
									'child' => new clsTR(array(
										'attributes' => array(
											'id' => 'test_container'
											)
										))
									))
								))
							)),
						new clsDiv(array(
							'attributes' => array('id' => 'results_container')
							))
						)
					))
				)
			)),
		$objBodyScript
		)
	));

$document = new clsDocument(array(
	'children' => array(
		new clsDoctype(),
		new clsHtml(array(
			'children' => array(
				$objHead,
				$objBody
				)
			))
		)
	));

$document->printHTML();

final class Framework {
	/* Contains a list of test scripts */
	private $tests;
	private $response;
	public $requests;

	public function __construct($xajax)
	{
		$this->tests = array();
		$this->response = new xajaxResponse();
		$this->requests = $xajax->register(XAJAX_CALLABLE_OBJECT, $this);

		$sFolder = dirname(__FILE__);
		if (is_dir($sFolder)) {
			if ($handle = opendir($sFolder)) {
				while (!(false === ($sName = readdir($handle))))
					if ($this->IsTestScript($sName))
						$this->tests[] = $sName;
				
				closedir($handle);
			}
		}

		sort($this->tests);
	}

	private function IsTestScript($sName)
	{
		if (is_dir($sName)) return false;
		if ('index.php' == $sName) return false;
		if ('xajax' == substr($sName, 0, 5)) return false;
		if ('.' == substr($sName, 0, 1)) return false;
		if ('~' == substr($sName, strlen($sName) - 1, 1)) return false;
		if ('.php' != substr($sName, strlen($sName) - 4, 4)) return false;
		return true;
	}

	public function Start()
	{
		return $this->InitiateTest(0, 0);
	}

	public function Next($id, $count)
	{
		return $this->InitiateTest($id, $count);
	}

	private function InitiateTest($id, $count)
	{
		if (count($this->tests) > $id)
		{
			$this->response->call('initiateTest', $id, $this->tests[$id]);

			$delay = (200 * $count) + 1;

			$request = $this->requests['next'];

			$request->setParameter(0, XAJAX_JS_VALUE, $id+1);
			$request->setParameter(1, XAJAX_JS_VALUE, 'countPendingTests()');

			$this->response->script(
				'setTimeout(function() { '.
				$request->getScript().
				' }, '.
				$delay.
				');'
				);
		}
		else
			$this->response->call('testsInitiated');

		return $this->response;
	}
}
