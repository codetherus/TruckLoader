<?php
/*
	File: 0016_DOM_Response_to_alter_Table.php
	
	Test xajaxControl::getResponse method to update the content of a table.
*/

require("./xajaxTestCase.inc.php");

final class TestCase extends xajaxTestCase
{
	public function __construct($xajax, $response, $body)
	{
		parent::__construct(
			$xajax,
			$response,
			$body,
			array('execute' => array('context' => 'xajax.$("tblBody")'))
			);

		$this->test->title = 'Send DOM Response to manipulate Table';
		$this->test->description = '...';

		// $xajax->configure('debug', true);

		$body->addChild(
			new clsTable(array(
				'attributes' => array(
					'id' => 'tbl', 
					'style' => 'border: 1px solid #999999'
					),
				'child' => new clsTBody(array(
					'attributes' => array('id' => 'tblBody'),
					'children' => array(
						new clsTR(array(
							'attributes' => array(
								'id' => 'rowFirst'
								),
							'child' => new clsTD(array(
								'child' => new clsLiteral('Starting to...')
								))
							)),
						new clsTR(array(
							'attributes' => array(
								'id' => 'rowSecond'
								),
							'child' => new clsTD(array(
								'child' => new clsLiteral('...work')
								))
							))
						)
					))
				))
			);

		$this->test->Expect('content', 'innerHTML', 'Done');

		$this->test->Begin();
	}

	public function Execute()
	{
		$objTableRow = new clsTR(array(
			'attributes' => array(
				'id' => 'rowFirst', 
				'style' => 'background-color: #bbbbbb'
				),
			'child' => new clsTD(array(
				'attributes' => array('id' => 'content'),
				'child' => new clsLiteral('Done')
				))
			));

		$this->test->response->domRemoveChildren('this', 1, 1);
		$this->test->response->appendResponse(
			$objTableRow->getResponse(0, 'this')
			);

		$this->test->Conclude();

		return $this->test->response;
	}
}

require('./xajaxUnitTest.inc.php');

