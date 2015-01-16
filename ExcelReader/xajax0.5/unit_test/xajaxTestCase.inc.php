<?php
/*
	File: xajaxTestCase.inc.php
	
	Construct a test page and instantiate the TestCase declared in the calling
	script file.
*/

error_reporting(E_ALL | E_STRICT);

ob_start();
?>
evaluateExpectations = function(expectations) {
	var result = document.getElementById('result');
	if (result)
		if ((result.innerText || result.innerHTML) == 'inconclusive')
			return;
	var output = function(id, text) {
		var div = document.createElement('DIV');
		div.appendChild(
			document.createTextNode(text)
			);
		div.setAttribute('id', id);
		document.body.appendChild(div);
		return false;
	}
	for (var i in expectations) {
		var expectation = expectations[i];
		var elementID = expectation[0];
		var property = expectation[1];
		var value = expectation[2];
		var equality = expectation[3];

		var element = document.getElementById(elementID);
		if (!element) {
			output(
				'expectation',
				[ 
					'Expected element [', 
					elementID, 
					'] ', 
					equality ? 'equal' : 'not equal', 
					' the value [', 
					value,
					'] but instead the element was not found'
				].join('')
				);
			return output('result', 'failure');
		}

		var result = null;

		if ('object' == typeof value) {
			for (var i in value)
				if (result != equality)
					eval( [ 'result = (element.', property, ' == value[i])' ].join('') );
		} else {
			eval( [ 'result = (element.', property, ' == value)' ].join('') );
		}

		if (result != equality) {
			var trueValue = null;
			eval( [ 'trueValue = element.', property, ';' ].join('') );
			output(
				'expectation',
				[ 
					'Expected element [', 
					elementID, 
					'] ', 
					equality ? 'equal' : 'not equal', 
					' the value [', 
					value,
					'] but instead equals [',
					trueValue, 
					']'
				].join('')
				);
			return output('result', 'failure');
		}
	}
	//output('expectation', '');
	return output('result', 'success');
}
<?php
$evaluateExpectations = ob_get_clean();

final class xajaxTestCaseDetail
{
	private $xajax;
	private $body;
	private $expectations = array();

	public $response;
	public $requests;
	public $title;
	public $description;

	public function __construct($testCase, $xajax, $response, $body, $config)
	{
		$this->xajax = $xajax;
		$this->response = $response;
		$this->body = $body;

		$this->requests = $this->xajax->register(XAJAX_CALLABLE_OBJECT, $testCase, $config);
	}

	public function Begin()
	{
		global $evaluateExpectations;

		$this->body->addChild(
			new clsScript(array(
				'attributes' => array(
					'type' => 'text/javascript'
					),
				'child' => new clsLiteral($evaluateExpectations)
				))
			);

		$this->body->addChild(
			new clsDiv(array(
				'attributes' => array(
					'id' => 'title'
					),
				'child' => new clsLiteral($this->title)
				))
			);

		$this->body->addChild(
			new clsDiv(array(
				'attributes' => array(
					'id' => 'description'
					),
				'child' => new clsLiteral($this->description)
				))
			);

		$this->body->setEvent('onload', $this->requests['execute']);
	}

	public function Expect($elementID, $property, $value)
	{
		$this->expectations[] = array($elementID, $property, $value, true);
	}

	public function ExpectFalse($elementID, $property, $value)
	{
		$this->expectations[] = array($elementID, $property, $value, false);
	}

	public function Conclude()
	{
		$this->response->call('evaluateExpectations', $this->expectations);
	}
}

class xajaxTestCase
{
	protected $test;

	protected function __construct($xajax, $response, $body, $config=null)
	{
		$this->test = new xajaxTestCaseDetail($this, $xajax, $response, $body, $config);
	}
}


