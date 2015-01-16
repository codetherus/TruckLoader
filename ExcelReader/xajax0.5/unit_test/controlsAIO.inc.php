<?php
class clsDocument extends xajaxControlContainer
{
	function clsDocument($aConfiguration=array())
	{
		if (isset($aConfiguration['attributes']))
			trigger_error(
				'clsDocument objects cannot have attributes.'
				. $this->backtrace(),
				E_USER_ERROR);
		
		xajaxControlContainer::xajaxControlContainer('DOCUMENT', $aConfiguration);

		$this->sClass = '%block';
	}

	function printHTML()
	{
		$tStart = microtime();
		$this->_printChildren();
		$tStop = microtime();
		echo '<' . '!--';
		echo ' page generation took ';
		$nTime = $tStop - $tStart;
		$nTime *= 1000;
		echo $nTime;
		echo ' --' . '>';
	}
}


class clsDoctype extends xajaxControlContainer
{
	var $sText;
	
	var $sFormat;
	var $sVersion;
	var $sValidation;
	var $sEncoding;
	
	function clsDocType($sFormat=null, $sVersion=null, $sValidation=null, $sEncoding='UTF-8')
	{
		if (null === $sFormat && false == defined('XAJAX_HTML_CONTROL_DOCTYPE_FORMAT'))
			trigger_error('You must specify a doctype format.', E_USER_ERROR);
		if (null === $sVersion && false == defined('XAJAX_HTML_CONTROL_DOCTYPE_VERSION'))
			trigger_error('You must specify a doctype version.', E_USER_ERROR);
		if (null === $sValidation && false == defined('XAJAX_HTML_CONTROL_DOCTYPE_VALIDATION'))
			trigger_error('You must specify a doctype validation.', E_USER_ERROR);
			
		if (null === $sFormat)
			$sFormat = XAJAX_HTML_CONTROL_DOCTYPE_FORMAT;
		if (null === $sVersion)
			$sVersion = XAJAX_HTML_CONTROL_DOCTYPE_VERSION;
		if (null === $sValidation)
			$sValidation = XAJAX_HTML_CONTROL_DOCTYPE_VALIDATION;
			
		xajaxControlContainer::xajaxControlContainer('DOCTYPE', array());
		
		$this->sText = '<'.'!DOCTYPE html PUBLIC "-//W3C//DTD ';
		$this->sText .= $sFormat;
		$this->sText .= ' ';
		$this->sText .= $sVersion;
		if ('TRANSITIONAL' == $sValidation)
			$this->sText .= ' Transitional';
		else if ('FRAMESET' == $sValidation)
			$this->sText .= ' Frameset';
		$this->sText .= '//EN" ';
		
		if ('HTML' == $sFormat) {
			if ('4.0' == $sVersion) {
				if ('STRICT' == $sValidation)
					$this->sText .= '"http://www.w3.org/TR/html40/strict.dtd"';
				else if ('TRANSITIONAL' == $sValidation)
					$this->sText .= '"http://www.w3.org/TR/html40/loose.dtd"';
			} else if ('4.01' == $sVersion) {
				if ('STRICT' == $sValidation)
					$this->sText .= '"http://www.w3.org/TR/html401/strict.dtd"';
				else if ('TRANSITIONAL' == $sValidation)
					$this->sText .= '"http://www.w3.org/TR/html401/loose.dtd"';
				else if ('FRAMESET' == $sValidation)
					$this->sText .= '"http://www.w3.org/TR/html4/frameset.dtd"';
			}
		} else if ('XHTML' == $sFormat) {
			if ('1.0' == $sVersion) {
				if ('STRICT' == $sValidation)
					$this->sText .= '"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"';
				else if ('TRANSITIONAL' == $sValidation)
					$this->sText .= '"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"';
			} else if ('1.1' == $sVersion) {
				$this->sText .= '"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"';
			}
		} else
			trigger_error('Unsupported DOCTYPE tag.'
				. $this->backtrace(),
				E_USER_ERROR
				);
		
		$this->sText .= '>';
		
		$this->sFormat = $sFormat;
		$this->sVersion = $sVersion;
		$this->sValidation = $sValidation;
		$this->sEncoding = $sEncoding;
	}
	
	function printHTML($sIndent='')
	{
		header('content-type: text/html; charset=' . $this->sEncoding);
		
		if ('XHTML' == $this->sFormat)
			print '<' . '?' . 'xml version="1.0" encoding="' . $this->sEncoding . '" ' . '?' . ">\n";
			
		print $this->sText;
		
		print "\n";
		
		xajaxControlContainer::_printChildren($sIndent);
	}
}

class clsHtml extends xajaxControlContainer
{
	function clsHtml($aConfiguration=array())
	{
		xajaxControlContainer::xajaxControlContainer('html', $aConfiguration);

		$this->sClass = '%block';
		$this->sEndTag = 'optional';
	}
}

class clsHead extends xajaxControlContainer
{
	var $objXajax;
	
	function clsHead($aConfiguration=array())
	{
		$this->objXajax = null;
		if (isset($aConfiguration['xajax']))
			$this->setXajax($aConfiguration['xajax']);
			
		xajaxControlContainer::xajaxControlContainer('head', $aConfiguration);

		$this->sClass = '%block';
		$this->sEndTag = 'optional';
	}
	
	function setXajax(&$objXajax)
	{
		$this->objXajax =& $objXajax;
	}

	function _printChildren($sIndent='')
	{
		if (null != $this->objXajax)
			$this->objXajax->printJavascript();
		
		xajaxControlContainer::_printChildren($sIndent);
	}
}

class clsBody extends xajaxControlContainer
{
	function clsBody($aConfiguration=array())
	{
		xajaxControlContainer::xajaxControlContainer('body', $aConfiguration);
		
		$this->sClass = '%block';
		$this->sEndTag = 'optional';
	}
}

class clsScript extends xajaxControlContainer
{
	function clsScript($aConfiguration=array())
	{
		xajaxControlContainer::xajaxControlContainer('script', $aConfiguration);

		$this->sClass = '%block';
	}
}

class clsStyle extends xajaxControlContainer
{
	function clsStyle($aConfiguration=array())
	{
		xajaxControlContainer::xajaxControlContainer('style', $aConfiguration);

		$this->sClass = '%block';
	}
}

class clsLink extends xajaxControl
{
	function clsLink($aConfiguration=array())
	{
		xajaxControl::xajaxControl('link', $aConfiguration);

		$this->sClass = '%block';
	}
}

class clsMeta extends xajaxControl
{
	function clsMeta($aConfiguration=array())
	{
		xajaxControl::xajaxControl('meta', $aConfiguration);

		$this->sClass = '%block';
	}
}

class clsTitle extends xajaxControlContainer
{
	function clsTitle($aConfiguration=array())
	{
		xajaxControlContainer::xajaxControlContainer('title', $aConfiguration);

		$this->sClass = '%block';
	}

	function setEvent($sEvent, &$objRequest)
	{
		trigger_error(
			'clsTitle objects do not support events.'
			. $this->backtrace(),
			E_USER_ERROR);
	}
}

class clsBase extends xajaxControl
{
	function clsBase($aConfiguration=array())
	{
		xajaxControl::xajaxControl('base', $aConfiguration);

		$this->sClass = '%block';
	}
}

class clsNoscript extends xajaxControlContainer
{
	function clsNoscript($aConfiguration=array())
	{
		xajaxControlContainer::xajaxControlContainer('noscript', $aConfiguration);

		$this->sClass = '%flow';
	}
}

class clsIframe extends xajaxControlContainer
{
	function clsIframe($aConfiguration=array())
	{
		xajaxControlContainer::xajaxControlContainer('iframe', $aConfiguration);

		$this->sClass = '%block';
	}
}

class clsFrameset extends xajaxControlContainer
{
	function clsFrameset($aConfiguration=array())
	{
		xajaxControlContainer::xajaxControlContainer('frameset', $aConfiguration);

		$this->sClass = '%block';
	}
}

class clsFrame extends xajaxControl
{
	function clsFrame($aConfiguration=array())
	{
		xajaxControl::xajaxControl('frame', $aConfiguration);

		$this->sClass = '%block';
	}
}

class clsNoframes extends xajaxControlContainer
{
	function clsNoframes($aConfiguration=array())
	{
		xajaxControlContainer::xajaxControlContainer('noframes', $aConfiguration);

		$this->sClass = '%flow';
	}
}


class clsLiteral extends xajaxControl
{
	function clsLiteral($sText)
	{
		xajaxControl::xajaxControl('CDATA');

		$this->sClass = '%inline';
		$this->sText = $sText;
	}

	function printHTML($sIndent='')
	{
		echo $this->sText;
	}
}

class clsBr extends xajaxControl
{
	function clsBr($aConfiguration=array())
	{
		xajaxControl::xajaxControl('br', $aConfiguration);
		
		$this->sClass = '%inline';
		$this->sEndTag = 'optional';
	}
}

class clsHr extends xajaxControl
{
	function clsHr($aConfiguration=array())
	{
		xajaxControl::xajaxControl('hr', $aConfiguration);
		
		$this->sClass = '%inline';
		$this->sEndTag = 'optional';
	}
}

class clsInlineContainer extends xajaxControlContainer
{
	function clsInlineContainer($sTag, $aConfiguration)
	{
		xajaxControlContainer::xajaxControlContainer($sTag, $aConfiguration);
		
		$this->sClass = '%inline';
		$this->sEndTag = 'required';
	}
}

class clsSub extends clsInlineContainer
{
	function clsSub($aConfiguration=array())
	{
		clsInlineContainer::clsInlineContainer('sub', $aConfiguration);
	}
}

class clsSup extends xajaxControlContainer
{
	function clsSup($aConfiguration=array())
	{
		clsInlineContainer::clsInlineContainer('sup', $aConfiguration);
	}
}

class clsEm extends clsInlineContainer
{
	function clsEm($aConfiguration=array())
	{
		clsInlineContainer::clsInlineContainer('em', $aConfiguration);
	}
}

class clsStrong extends clsInlineContainer
{
	function clsStrong($aConfiguration=array())
	{
		clsInlineContainer::clsInlineContainer('strong', $aConfiguration);
	}
}

class clsCite extends clsInlineContainer
{
	function clsCite($aConfiguration=array())
	{
		clsInlineContainer::clsInlineContainer('cite', $aConfiguration);
	}
}

class clsDfn extends clsInlineContainer
{
	function clsDfn($aConfiguration=array())
	{
		clsInlineContainer::clsInlineContainer('dfn', $aConfiguration);
	}
}

class clsCode extends clsInlineContainer
{
	function clsCode($aConfiguration=array())
	{
		clsInlineContainer::clsInlineContainer('code', $aConfiguration);
	}
}

class clsSamp extends clsInlineContainer
{
	function clsSamp($aConfiguration=array())
	{
		clsInlineContainer::clsInlineContainer('samp', $aConfiguration);
	}
}

class clsKbd extends clsInlineContainer
{
	function clsKbd($aConfiguration=array())
	{
		clsInlineContainer::clsInlineContainer('kbd', $aConfiguration);
	}
}

class clsVar extends clsInlineContainer
{
	function clsVar($aConfiguration=array())
	{
		clsInlineContainer::clsInlineContainer('var', $aConfiguration);
	}
}

class clsAbbr extends clsInlineContainer
{
	function clsAbbr($aConfiguration=array())
	{
		clsInlineContainer::clsInlineContainer('abbr', $aConfiguration);
	}
}

class clsAcronym extends clsInlineContainer
{
	function clsAcronym($aConfiguration=array())
	{
		clsInlineContainer::clsInlineContainer('acronym', $aConfiguration);
	}
}

class clsTt extends clsInlineContainer
{
	function clsTt($aConfiguration=array())
	{
		clsInlineContainer::clsInlineContainer('tt', $aConfiguration);
	}
}

class clsItalic extends clsInlineContainer
{
	function clsItalic($aConfiguration=array())
	{
		clsInlineContainer::clsInlineContainer('i', $aConfiguration);
	}
}

class clsBold extends clsInlineContainer
{
	function clsBold($aConfiguration=array())
	{
		clsInlineContainer::clsInlineContainer('b', $aConfiguration);
	}
}

class clsBig extends clsInlineContainer
{
	function clsBig($aConfiguration=array())
	{
		clsInlineContainer::clsInlineContainer('big', $aConfiguration);
	}
}


class clsSmall extends clsInlineContainer
{
	function clsSmall($aConfiguration=array())
	{
		clsInlineContainer::clsInlineContainer('small', $aConfiguration);
	}
}

class clsIns extends clsInlineContainer
{
	function clsIns($aConfiguration=array())
	{
		clsInlineContainer::clsInlineContainer('ins', $aConfiguration);
	}
}

class clsDel extends clsInlineContainer
{
	function clsDel($aConfiguration=array())
	{
		clsInlineContainer::clsInlineContainer('del', $aConfiguration);
	}
}

class clsHeadline extends xajaxControlContainer
{
	function clsHeadline($sType, $aConfiguration=array())
	{
		if (0 < strpos($sType, '123456'))
			trigger_error('Invalid type for headline control; should be 1,2,3,4,5 or 6.'
				. $this->backtrace(),
				E_USER_ERROR
				);
		
		xajaxControlContainer::xajaxControlContainer('h' . $sType, $aConfiguration);

		$this->sClass = '%inline';
	}
}

class clsAddress extends clsInlineContainer
{
	function clsAddress($aConfiguration=array())
	{
		clsInlineContainer::clsInlineContainer('address', $aConfiguration);
	}
}

class clsParagraph extends clsInlineContainer
{
	function clsParagraph($aConfiguration=array())
	{
		clsInlineContainer::clsInlineContainer('p', $aConfiguration);
	}
}

class clsBlockquote extends clsInlineContainer
{
	function clsBlockquote($aConfiguration=array())
	{
		clsInlineContainer::clsInlineContainer('blockquote', $aConfiguration);
	}
}

class clsPre extends clsInlineContainer
{
	function clsPre($aConfiguration=array())
	{
		clsInlineContainer::clsInlineContainer('pre', $aConfiguration);
	}
}


class clsForm extends xajaxControlContainer
{
	function clsForm($aConfiguration=array())
	{
		if (false == isset($aConfiguration['attributes']))
			$aConfiguration['attributes'] = array();
		if (false == isset($aConfiguration['attributes']['method']))
			$aConfiguration['attributes']['method'] = 'POST';
		if (false == isset($aConfiguration['attributes']['action']))
			$aConfiguration['attributes']['action'] = '#';

		xajaxControlContainer::xajaxControlContainer('form', $aConfiguration);
	}
}

class clsInput extends xajaxControl
{
	function clsInput($aConfiguration=array())
	{
		xajaxControl::xajaxControl('input', $aConfiguration);
	}
}

class clsInputWithLabel extends clsInput
{
	var $objLabel;
	var $sWhere;
	var $objBreak;
	
	function clsInputWithLabel($sLabel, $sWhere, $aConfiguration=array())
	{
		clsInput::clsInput($aConfiguration);
		
		$this->objLabel =& new clsLabel(array(
			'child' => new clsLiteral($sLabel)
			));
		$this->objLabel->setControl($this);
		
		$this->sWhere = $sWhere;
		
		$this->objBreak =& new clsBr();
	}
	
	function printHTML($sIndent='')
	{
		if ('left' == $this->sWhere || 'above' == $this->sWhere)
			$this->objLabel->printHTML($sIndent);
		if ('above' == $this->sWhere)
			$this->objBreak->printHTML($sIndent);
		
		clsInput::printHTML($sIndent);

		if ('below' == $this->sWhere)
			$this->objBreak->printHTML($sIndent);
		if ('right' == $this->sWhere || 'below' == $this->sWhere)
			$this->objLabel->printHTML($sIndent);
	}
}

class clsSelect extends xajaxControlContainer
{
	function clsSelect($aConfiguration=array())
	{
		xajaxControlContainer::xajaxControlContainer('select', $aConfiguration);
	}
	
	function addOption($sValue, $sText)
	{
		$optionNew =& new clsOption();
		$optionNew->setValue($sValue);
		$optionNew->setText($sText);
		$this->addChild($optionNew);
	}
	
	function addOptions($aOptions, $aFields=array())
	{
		if (0 == count($aFields))
			foreach ($aOptions as $sValue => $sText)
				$this->addOption($sValue, $sText);
		else if (1 < count($aFields))
			foreach ($aOptions as $aOption)
				$this->addOption($aOption[$aFields[0]], $aOption[$aFields[1]]);
		else
			trigger_error('Invalid list of fields passed to clsSelect::addOptions; should be array of two strings.'
				. $this->backtrace(),
				E_USER_ERROR
				);
	}
}

class clsOptionGroup extends xajaxControlContainer
{
	function clsOptionGroup($aConfiguration=array())
	{
		xajaxControlContainer::xajaxControlContainer('optgroup', $aConfiguration);
	}
	
	function addOption($sValue, $sText)
	{
		$optionNew =& new clsOption();
		$optionNew->setValue($sValue);
		$optionNew->setText($sText);
		$this->addChild($optionNew);
	}
	
	function addOptions($aOptions, $aFields=array())
	{
		if (0 == count($aFields))
			foreach ($aOptions as $sValue => $sText)
				$this->addOption($sValue, $sText);
		else if (1 < count($aFields))
			foreach ($aOptions as $aOption)
				$this->addOption($aOption[$aFields[0]], $aOption[$aFields[1]]);
		else
			trigger_error('Invalid list of fields passed to clsOptionGroup::addOptions; should be array of two strings.'
				. $this->backtrace(),
				E_USER_ERROR
				);
	}
}

class clsOption extends xajaxControlContainer
{
	function clsOption($aConfiguration=array())
	{
		xajaxControlContainer::xajaxControlContainer('option', $aConfiguration);
	}

	function setValue($sValue)
	{
		$this->setAttribute('value', $sValue);
	}
	
	function setText($sText)
	{
		$this->clearChildren();
		$this->addChild(new clsLiteral($sText));
	}
}

class clsTextArea extends xajaxControlContainer
{
	function clsTextArea($aConfiguration=array())
	{
		xajaxControlContainer::xajaxControlContainer('textarea', $aConfiguration);
		
		$this->sClass = '%block';
	}
}

class clsLabel extends xajaxControlContainer
{
	var $objFor;

	function clsLabel($aConfiguration=array())
	{
		xajaxControlContainer::xajaxControlContainer('label', $aConfiguration);
	}

	function setControl(&$objControl)
	{
		if (false == is_a($objControl, 'xajaxControl'))
			trigger_error(
				'Invalid control passed to clsLabel::setControl(); should be xajaxControl.'
				. $this->backtrace(),
				E_USER_ERROR);

		$this->objFor =& $objControl;
	}

	function printHTML($sIndent='')
	{
		$this->aAttributes['for'] = $this->objFor->aAttributes['id'];
		
		xajaxControlContainer::printHTML($sIndent);
	}
}

class clsFieldset extends xajaxControlContainer
{
	function clsFieldset($aConfiguration=array())
	{
		xajaxControlContainer::xajaxControlContainer('fieldset', $aConfiguration);
		
		$this->sClass = '%block';
	}
}

class clsLegend extends xajaxControlContainer
{
	function clsLegend($aConfiguration=array())
	{
		xajaxControlContainer::xajaxControlContainer('legend', $aConfiguration);
		
		$this->sClass = '%inline';
	}
}


class clsList extends xajaxControlContainer
{
	function clsList($sTag, $aConfiguration=array())
	{
		$this->clearEvent_AddItem();
			
		xajaxControlContainer::xajaxControlContainer($sTag, $aConfiguration);

		$this->sClass = '%block';
	}
	
	function addItem($mItem, $mConfiguration=null)
	{
		if (null != $this->eventAddItem) {
			$objItem =& call_user_func($this->eventAddItem, $mItem, $mConfiguration);
			$this->addChild($objItem);
		} else {
			$objItem =& $this->_onAddItem($mItem, $mConfiguration);
			$this->addChild($objItem);
		}
	}
	
	function addItems($aItems, $mConfiguration=null)
	{
		foreach ($aItems as $mItem)
			$this->addItem($mItem, $mConfiguration);
	}
	
	function clearEvent_AddItem()
	{
		$this->eventAddItem = null;
	}
	
	function setEvent_AddItem($mFunction)
	{
		$this->eventAddItem = $mFunction;
	}
	
	function &_onAddItem($mItem, $mConfiguration)
	{
		$objItem =& new clsLI(array(
			'child' => new clsLiteral($mItem)
			));
		return $objItem;
	}
}

class clsUL extends clsList
{
	function clsUL($aConfiguration=array())
	{
		clsList::clsList('ul', $aConfiguration);
	}
}

class clsOL extends clsList
{
	function clsOL($aConfiguration=array())
	{
		clsList::clsList('ol', $aConfiguration);
	}
}

class clsLI extends xajaxControlContainer
{
	function clsLI($aConfiguration=array())
	{
		xajaxControlContainer::xajaxControlContainer('li', $aConfiguration);

		$this->sClass = '%flow';
		$this->sEndTag = 'optional';
	}
}

class clsDl extends xajaxControlContainer
{
	function clsDl($aConfiguration=array())
	{
		xajaxControlContainer::xajaxControlContainer('dl', $aConfiguration);

		$this->sClass = '%block';
	}
}

class clsDt extends xajaxControlContainer
{
	function clsDt($aConfiguration=array())
	{
		xajaxControlContainer::xajaxControlContainer('dt', $aConfiguration);

		$this->sClass = '%block';
		$this->sEndTag = 'optional';
	}
}

class clsDd extends xajaxControlContainer
{
	function clsDd($aConfiguration=array())
	{
		xajaxControlContainer::xajaxControlContainer('dd', $aConfiguration);

		$this->sClass = '%flow';
		$this->sEndTag = 'optional';
	}
}

class clsTableRowContainer extends xajaxControlContainer
{
	var $eventAddRow;
	var $eventAddRowCell;
	
	function clsTableRowContainer($sTag, $aConfiguration=array())
	{
		$this->clearEvent_AddRow();
		$this->clearEvent_AddRowCell();
			
		xajaxControlContainer::xajaxControlContainer($sTag, $aConfiguration);

		$this->sClass = '%block';
	}

	function addRow($aCells, $mConfiguration=null)
	{
		if (null != $this->eventAddRow) {
			$objRow =& call_user_func($this->eventAddRow, $aCells, $mConfiguration);
			$this->addChild($objRow);
		} else {
			$objRow =& $this->_onAddRow($aCells, $mConfiguration);
			$this->addChild($objRow);
		}
	}
		
	function addRows($aRows, $mConfiguration=null)
	{
		foreach ($aRows as $aCells)
			$this->addRow($aCells, $mConfiguration);
	}
	
	function clearEvent_AddRow()
	{
		$this->eventAddRow = null;
	}
	function clearEvent_AddRowCell()
	{
		$this->eventAddRowCell = null;
	}
	
	function setEvent_AddRow($mFunction)
	{
		$mPrevious = $this->eventAddRow;
		$this->eventAddRow = $mFunction;
		return $mPrevious;
	}
	function setEvent_AddRowCell($mFunction)
	{
		$mPrevious = $this->eventAddRowCell;
		$this->eventAddRowCell = $mFunction;
		return $mPrevious;
	}
	
	function &_onAddRow($aCells, $mConfiguration=null)
	{
		$objTableRow =& new clsTr();
		if (null != $this->eventAddRowCell)
			$objTableRow->setEvent_AddCell($this->eventAddRowCell);
		$objTableRow->addCells($aCells, $mConfiguration);
		return $objTableRow;
	}
}

class clsTable extends xajaxControlContainer
{
	var $eventAddHeader;
	var $eventAddHeaderRow;
	var $eventAddHeaderRowCell;
	var $eventAddBody;
	var $eventAddBodyRow;
	var $eventAddBodyRowCell;
	var $eventAddFooter;
	var $eventAddFooterRow;
	var $eventAddFooterRowCell;
	
	function clsTable($aConfiguration=array())
	{
		$this->clearEvent_AddHeader();
		$this->clearEvent_AddHeaderRow();
		$this->clearEvent_AddHeaderRowCell();
		$this->clearEvent_AddBody();
		$this->clearEvent_AddBodyRow();
		$this->clearEvent_AddBodyRowCell();
		$this->clearEvent_AddFooter();
		$this->clearEvent_AddFooterRow();
		$this->clearEvent_AddFooterRowCell();
		
		xajaxControlContainer::xajaxControlContainer('table', $aConfiguration);

		$this->sClass = '%block';
	}

	function addHeader($aRows, $mConfiguration=null)
	{
		if (null != $this->eventAddHeader) {
			$objHeader =& call_user_func($this->eventAddHeader, $aRows, $mConfiguration);
			$this->addChild($objHeader);
		} else {
			$objHeader =& $this->_onAddHeader($aRows, $mConfiguration);
			$this->addChild($objHeader);
		}
	}
	function addBody($aRows, $mConfiguration=null)
	{
		if (null != $this->eventAddBody) {
			$objBody =& call_user_func($this->eventAddBody, $aRows, $mConfiguration);
			$this->addChild($objBody);
		} else {
			$objBody =& $this->_onAddBody($aRows, $mConfiguration);
			$this->addChild($objBody);
		}
	}
	function addFooter($aRows, $mConfiguration=null)
	{
		if (null != $this->eventAddFooter) {
			$objFooter =& call_user_func($this->eventAddFooter, $aRows, $mConfiguration);
			$this->addChild($objFooter);
		} else {
			$objFooter =& $this->_onAddFooter($aRows, $mConfiguration);
			$this->addChild($objFooter);
		}
	}
		
	function addBodies($aBodies, $mConfiguration=null)
	{
		foreach ($aBodies as $aRows)
			$this->addBody($aRows, $mConfiguration);
	}

	function clearEvent_AddHeader()
	{
		$this->eventAddHeader = null;
	}
	function clearEvent_AddHeaderRow()
	{
		$this->eventAddHeaderRow = null;
	}
	function clearEvent_AddHeaderRowCell()
	{
		$this->eventAddHeaderRowCell = null;
	}
	function clearEvent_AddBody()
	{
		$this->eventAddBody = null;
	}
	function clearEvent_AddBodyRow()
	{
		$this->eventAddBodyRow = null;
	}
	function clearEvent_AddBodyRowCell()
	{
		$this->eventAddBodyRowCell = null;
	}
	function clearEvent_AddFooter()
	{
		$this->eventAddFooter = null;
	}
	function clearEvent_AddFooterRow()
	{
		$this->eventAddFooterRow = null;
	}
	function clearEvent_AddFooterRowCell()
	{
		$this->eventAddFooterRowCell = null;
	}
	
	function setEvent_AddHeader($mFunction)
	{
		$mPrevious = $this->eventAddHeader;
		$this->eventAddHeader = $mFunction;
		return $mPrevious;
	}
	function setEvent_AddHeaderRow($mFunction)
	{
		$mPrevious = $this->eventAddHeaderRow;
		$this->eventAddHeaderRow = $mFunction;
		return $mPrevious;
	}
	function setEvent_AddHeaderRowCell($mFunction)
	{
		$mPrevious = $this->eventAddHeaderRowCell;
		$this->eventAddHeaderRowCell = $mFunction;
		return $mPrevious;
	}
	function setEvent_AddBody($mFunction)
	{
		$mPrevious = $this->eventAddBody;
		$this->eventAddBody = $mFunction;
		return $mPrevious;
	}
	function setEvent_AddBodyRow($mFunction)
	{
		$mPrevious = $this->eventAddBodyRow;
		$this->eventAddBodyRow = $mFunction;
		return $mPrevious;
	}
	function setEvent_AddBodyRowCell($mFunction)
	{
		$mPrevious = $this->eventAddBodyRowCell;
		$this->eventAddBodyRowCell = $mFunction;
		return $mPrevious;
	}
	function setEvent_AddFooter($mFunction)
	{
		$mPrevious = $this->eventAddFooter;
		$this->eventAddFooter = $mFunction;
		return $mPrevious;
	}
	function setEvent_AddFooterRow($mFunction)
	{
		$mPrevious = $this->eventAddFooterRow;
		$this->eventAddFooterRow = $mFunction;
		return $mPrevious;
	}
	function setEvent_AddFooterRowCell($mFunction)
	{
		$mPrevious = $this->eventAddFooterRowCell;
		$this->eventAddFooterRowCell = $mFunction;
		return $mPrevious;
	}
	
	function &_onAddHeader($aRows, $mConfiguration)
	{
		$objTableHeader =& new clsThead();
		if (null != $this->eventAddHeaderRow)
			$objTableHeader->setEvent_AddRow($this->eventAddHeaderRow);
		if (null != $this->eventAddHeaderRowCell)
			$objTableHeader->setEvent_AddRowCell($this->eventAddHeaderRowCell);
		$objTableHeader->addRows($aRows, $mConfiguration);
		return $objTableHeader;
	}
	function &_onAddBody($aRows, $mConfiguration)
	{
		$objTableBody =& new clsTbody();
		if (null != $this->eventAddBodyRow)
			$objTableBody->setEvent_AddRow($this->eventAddBodyRow);
		if (null != $this->eventAddBodyRowCell)
			$objTableBody->setEvent_AddRowCell($this->eventAddBodyRowCell);
		$objTableBody->addRows($aRows, $mConfiguration);
		return $objTableBody;
	}
	function &_onAddFooter($aRows, $mConfiguration)
	{
		$objTableFooter =& new clsTfoot();
		if (null != $this->eventAddFooterRow)
			$objTableFooter->setEvent_AddRow($this->eventAddFooterRow);
		if (null != $this->eventAddFooterRowCell)
			$objTableFooter->setEvent_AddRowCell($this->eventAddFooterRowCell);
		$objTableFooter->addRows($aRows, $mConfiguration);
		return $objTableFooter;
	}
}

class clsCaption extends xajaxControlContainer
{
	function clsCaption($aConfiguration=array())
	{
		xajaxControlContainer::xajaxControlContainer('caption', $aConfiguration);

		$this->sClass = '%block';
	}
}

class clsColgroup extends xajaxControlContainer
{
	function clsColgroup($aConfiguration=array())
	{
		xajaxControlContainer::xajaxControlContainer('colgroup', $aConfiguration);

		$this->sClass = '%block';
		$this->sEndTag = 'optional';
	}
}

class clsCol extends xajaxControl
{
	function clsCol($aConfiguration=array())
	{
		xajaxControl::xajaxControl('col');

		$this->sClass = '%block';
	}
}

class clsThead extends clsTableRowContainer
{
	function clsThead($aConfiguration=array())
	{
		clsTableRowContainer::clsTableRowContainer('thead', $aConfiguration);
	}
}

class clsTbody extends clsTableRowContainer
{
	function clsTbody($aConfiguration=array())
	{
		clsTableRowContainer::clsTableRowContainer('tbody', $aConfiguration);
	}
}

class clsTfoot extends clsTableRowContainer
{
	function clsTfoot($aConfiguration=array())
	{
		clsTableRowContainer::clsTableRowContainer('tfoot', $aConfiguration);
	}
}

class clsTr extends xajaxControlContainer
{
	var $eventAddCell;
	
	function clsTr($aConfiguration=array())
	{
		$this->clearEvent_AddCell();
			
		xajaxControlContainer::xajaxControlContainer('tr', $aConfiguration);

		$this->sClass = '%block';
	}
	
	function addCell($mCell, $mConfiguration=null)
	{
		if (null != $this->eventAddCell) {
			$objCell =& call_user_func($this->eventAddCell, $mCell, $mConfiguration);
			$this->addChild($objCell);
		} else {
			$objCell =& $this->_onAddCell($mCell, $mConfiguration);
			$this->addChild($objCell);
		}
	}
	
	function addCells($aCells, $mConfiguration=null)
	{
		foreach ($aCells as $mCell)
			$this->addCell($mCell, $mConfiguration);
	}
	
	function clearEvent_AddCell()
	{
		$this->eventAddCell = null;
	}
	
	function setEvent_AddCell($mFunction)
	{
		$mPrevious = $this->eventAddCell;
		$this->eventAddCell = $mFunction;
		return $mPrevious;
	}
	
	function &_onAddCell($mCell, $mConfiguration=null)
	{
		return new clsTd(array(
			'child' => new clsLiteral($mCell)
			));
	}
}

class clsTd extends xajaxControlContainer
{
	function clsTd($aConfiguration=array())
	{
		xajaxControlContainer::xajaxControlContainer('td', $aConfiguration);

		$this->sClass = '%flow';
	}
}

class clsTh extends xajaxControlContainer
{
	function clsTh($aConfiguration=array())
	{
		xajaxControlContainer::xajaxControlContainer('th', $aConfiguration);

		$this->sClass = '%flow';
	}
}


class clsObject extends xajaxControlContainer
{
	function clsObject($aConfiguration=array())
	{
		xajaxControlContainer::xajaxControlContainer('object', $aConfiguration);

		$this->sClass = '%block';
		$this->sEndTag = 'required';
	}
}

class clsParam extends xajaxControl
{
	function clsParam($aConfiguration=array())
	{
		xajaxControl::xajaxControl('param', $aConfiguration);

		$this->sClass = '%block';
	}
}

class clsAnchor extends xajaxControlContainer
{
	function clsAnchor($aConfiguration=array())
	{
		if (false == isset($aConfiguration['attributes']))
			$aConfiguration['attributes'] = array();
		if (false == isset($aConfiguration['attributes']['href']))
			$aConfiguration['attributes']['href'] = '#';
		
		xajaxControlContainer::xajaxControlContainer('a', $aConfiguration);

		$this->sClass = '%inline';
		$this->sEndTag = 'required';
	}

	function setEvent($sEvent, &$objRequest, $aParameters=array(), $sBeforeRequest='if (false == ', $sAfterRequest=') return false; ')
	{
		xajaxControl::setEvent($sEvent, $objRequest, $aParameters, $sBeforeRequest, $sAfterRequest);
	}
}

class clsImg extends xajaxControl
{
	function clsImg($aConfiguration=array())
	{
		xajaxControl::xajaxControl('img', $aConfiguration);

		$this->sClass = '%inline';
	}
}

class clsButton extends xajaxControlContainer
{
	function clsButton($aConfiguration=array())
	{
		xajaxControlContainer::xajaxControlContainer('button', $aConfiguration);

		$this->sClass = '%inline';
	}
}

class clsArea extends xajaxControl
{
	function clsArea($aConfiguration=array())
	{
		xajaxControl::xajaxControl('area', $aConfiguration);

		$this->sClass = '%block';
	}
}

class clsMap extends xajaxControlContainer
{
	function clsMap($aConfiguration=array())
	{
		xajaxControlContainer::xajaxControlContainer('map', $aConfiguration);

		$this->sClass = '%block';
	}
}


class clsDiv extends xajaxControlContainer
{
	function clsDiv($aConfiguration=array())
	{
		xajaxControlContainer::xajaxControlContainer('div', $aConfiguration);

		$this->sClass = '%block';
	}
}

class clsSpan extends xajaxControlContainer
{
	function clsSpan($aConfiguration=array())
	{
		xajaxControlContainer::xajaxControlContainer('span', $aConfiguration);

		$this->sClass = '%inline';
	}
}


$aAttributes = array(
	'%bodycolors' => array(
		'bgcolor',
		'text',
		'link',
		'vlink',
		'alink'
		),
	'%coreattrs' => array(
		'id',
		'class',
		'style',
		'title'
		),
	'%i18n' => array(
		'lang',
		'dir'
		),
	'%events' => array(
		'onclick',
		'ondblclick',
		'onmousedown',
		'onmouseup',
		'onmouseover',
		'onmousemove',
		'onmouseout',
		'onkeypress',
		'onkeydown',
		'onkeyup'
		),
	'%attrs' => array(
		'%coreattrs',
		'%i18n',
		'%events'
		),
	'%align' => array(
		'left',
		'center',
		'right',
		'justify'
		),
	'%cellhalign' => array(
		'align'
		),
	'%cellvalign' => array(
		'valign'
		),
	'TT' => array('%attrs'),
	'I' => array('%attrs'),
	'B' => array('%attrs'),
	'U' => array('%attrs'),
	'S' => array('%attrs'),
	'STRIKE' => array('%attrs'),
	'BIG' => array('%attrs'),
	'SMALL' => array('%attrs'),
	'EM' => array('%attrs'),
	'STRONG' => array('%attrs'),
	'DFN' => array('%attrs'),
	'CODE' => array('%attrs'),
	'SAMP' => array('%attrs'),
	'KBD' => array('%attrs'),
	'VAR' => array('%attrs'),
	'CITE' => array('%attrs'),
	'ABBR' => array('%attrs'),
	'ACRONYM' => array('%attrs'),
	'SUB' => array('%attrs'),
	'SUP' => array('%attrs'),
	'SPAN' => array(
		'%attrs'
//		,
//		'%reserved'
		),
	'BDO' => array(
		'%coreattrs',
		'lang',
		'dir'
		),
	'BASEFONT' => array(
		'id',
		'size',
		'color',
		'face'
		),
	'FONT' => array(
		'%coreattrs',
		'%i18n',
		'size',
		'color',
		'face'
		),
	'BR' => array(
		'%coreattrs',
		'clear'
		),
	'BODY' => array(
		'%attrs',
		'onload',
		'onunload',
		'background',
		'%bodycolors'
		),
	'ADDRESS' => array('%attrs'),
	'DIV' => array(
		'%attrs',
		'%align'
//		,
//		'%reserved'
		),
	'CENTER' => array('%attrs'),
	'A' => array(
		'%attrs',
		'charset',
		'type',
		'name',
		'href',
		'hreflang',
		'target',
		'rel',
		'rev',
		'accesskey',
		'shape',
		'coords',
		'tabindex',
		'onfocus',
		'onblur'
		),
	'MAP' => array(
		'%attrs',
		'name'
		),
	'AREA' => array(
		'%attrs',
		'shape',
		'coords',
		'href',
		'target',
		'nohref',
		'alt',
		'tabindex',
		'accesskey',
		'onfocus',
		'onblur'
		),
	'LINK' => array(
		'%attrs',
		'charset',
		'href',
		'hreflang',
		'type',
		'rel',
		'rev',
		'media',
		'target'
		),
	'IMG' => array(
		'%attrs',
		'src',
		'alt',
		'longdesc',
		'name',
		'height',
		'width',
		'usemap',
		'ismap',
		'align',
		'border',
		'hspace',
		'vspace'
		),
	'OBJECT' => array(
		'%attrs',
		'declare',
		'classid',
		'codebase',
		'data',
		'type',
		'codetype',
		'archive',
		'standby',
		'height',
		'width',
		'usemap',
		'name',
		'tabindex',
		'align',
		'border',
		'hspace',
		'vspace'
//		,
//		'%reserved'
		),
	'PARAM' => array(
		'id',
		'name',
		'value',
		'valuetype',
		'type'
		),
	'APPLET' => array(
		'%coreattrs',
		'codebase',
		'archive',
		'code',
		'object',
		'alt',
		'name',
		'width',
		'height',
		'align',
		'hspace',
		'vspace'
		),
	'HR' => array(
		'%attrs',
		'align',
		'noshade',
		'size',
		'width'
		),
	'P' => array(
		'%attrs',
		'%align'
		),
	'H1' => array(
		'%attrs',
		'%align'
		),
	'H2' => array(
		'%attrs',
		'%align'
		),
	'H3' => array(
		'%attrs',
		'%align'
		),
	'H4' => array(
		'%attrs',
		'%align'
		),
	'H5' => array(
		'%attrs',
		'%align'
		),
	'H6' => array(
		'%attrs',
		'%align'
		),
	'PRE' => array(
		'%attrs',
		'width'
		),
	'Q' => array(
		'%attrs',
		'cite'
		),
	'BLOCKQUOTE' => array(
		'%attrs',
		'cite'
		),
	'INS' => array(
		'%attrs',
		'cite',
		'datetime'
		),
	'DEL' => array(
		'%attrs',
		'cite',
		'datetime'
		),
	'DL' => array(
		'%attrs',
		'compact'
		),
	'DT' => array('%attrs'),
	'DD' => array('%attrs'),
	'OL' => array(
		'%attrs',
		'type',
		'compact',
		'start'
		),
	'UL' => array(
		'%attrs',
		'type',
		'compact'
		),
	'DIR' => array(
		'%attrs',
		'compact'
		),
	'MENU' => array(
		'%attrs',
		'compact'
		),
	'LI' => array(
		'%attrs',
		'type',
		'value'
		),
	'FORM' => array(
		'%attrs',
		'action',
		'method',
		'enctype',
		'accept',
		'name',
		'onsubmit',
		'onreset',
		'target',
		'accept-charset'
		),
	'LABEL' => array(
		'%attrs',
		'for',
		'accesskey',
		'onfocus',
		'onblur'
		),
	'INPUT' => array(
		'%attrs',
		'type',
		'name',
		'value',
		'checked',
		'disabled',
		'readonly',
		'size',
		'maxlength',
		'src',
		'alt',
		'usemap',
		'ismap',
		'tabindex',
		'accesskey',
		'onfocus',
		'onblur',
		'onselect',
		'onchange',
		'accept',
		'align'
//		,
//		'%reserved'
		),
	'SELECT' => array(
		'%attrs',
		'name',
		'size',
		'multiple',
		'disabled',
		'tabindex',
		'onfocus',
		'onblur',
		'onchange'
//		,
//		'%reserved'
		),
	'OPTGROUP' => array(
		'%attrs',
		'disabled',
		'label'
		),
	'OPTION' => array(
		'%attrs',
		'selected',
		'disabled',
		'label',
		'value'
		),
	'TEXTAREA' => array(
		'%attrs',
		'name',
		'rows',
		'cols',
		'disabled',
		'readonly',
		'tabindex',
		'accesskey',
		'onfocus',
		'onblur',
		'onselect',
		'onchange'
//		,
//		'%reserved'
		),
	'FIELDSET' => array('%attrs'),
	'LEGEND' => array(
		'%attrs',
		'accesskey',
		'align'
		),
	'BUTTON' => array(
		'%attrs',
		'name',
		'value',
		'type',
		'disabled',
		'tabindex',
		'accesskey',
		'onfocus',
		'onblur'
//		,
//		'%reserved'
		),
	'TABLE' => array(
		'%attrs',
		'summary',
		'width',
		'border',
		'frame',
		'rules',
		'cellspacing',
		'cellpadding',
		'align',
		'bgcolor',
//		'%reserved',
		'datapagesize'
		),
	'CAPTION' => array('%attrs', 'align'),
	'COLGROUP' => array(
		'%attrs',
		'span',
		'width',
		'%cellhalign',
		'%cellvalign'
		),
	'COL' => array(
		'%attrs',
		'span',
		'width',
		'%cellhalign',
		'%cellvalign'
		),
	'THEAD' => array(
		'%attrs',
		'%cellhalign',
		'%cellvalign'
		),
	'TBODY' => array(
		'%attrs',
		'%cellhalign',
		'%cellvalign'
		),
	'TFOOT' => array(
		'%attrs',
		'%cellhalign',
		'%cellvalign'
		),
	'TR' => array(
		'%attrs',
		'%cellhalign',
		'%cellvalign',
		'bgcolor'
		),
	'TH' => array(
		'%attrs',
		'abbr',
		'axis',
		'headers',
		'scope',
		'rowspan',
		'colspan',
		'%cellhalign',
		'%cellvalign',
		'nowrap',
		'bgcolor',
		'width',
		'height'
		),
	'TD' => array(
		'%attrs',
		'abbr',
		'axis',
		'headers',
		'scope',
		'rowspan',
		'colspan',
		'%cellhalign',
		'%cellvalign',
		'nowrap',
		'bgcolor',
		'width',
		'height'
		),
	'IFRAME' => array(
		'%coreattrs',
		'longdesc',
		'name',
		'src',
		'frameborder',
		'marginwidth',
		'marginheight',
		'scrolling',
		'align',
		'height',
		'width'
		),
	'NOFRAMES' => array('%attrs'),
	'HEAD' => array(
		'%i18n',
		'profile'
		),
	'TITLE' => array('%i18n'),
	'BASE' => array(
		'href',
		'target'
		),
	'META' => array(
		'%i18n',
		'http-equiv',
		'name',
		'content',
		'scheme'
		),
	'STYLE' => array(
		'%i18n',
		'type',
		'media',
		'title'
		),
	'SCRIPT' => array(
		'charset',
		'type',
		'language',
		'src',
		'defer',
		'event',
		'for'
		),
	'NOSCRIPT' => array('%attrs'),
	'HTML' => array('%i18n') // , '%version')
	);

$aTags = array(
	'%heading' => array(
		'H1',
		'H2',
		'H3',
		'H4',
		'H5',
		'H6'
		),
	'%list' => array(
		'UL',
		'OL',
		'DIR',
		'MENU'
		),
	'%preformatted' => array('PRE'),
	'%fontstyle' => array(
		'TT',
		'I',
		'B',
		'U',
		'S',
		'STRIKE',
		'BIG',
		'SMALL'
		),
	'%phrase' => array(
		'EM',
		'STRONG',
		'DFN',
		'CODE',
		'SAMP',
		'KBD',
		'VAR',
		'CITE',
		'ABBR',
		'ACRONYM'
		),
	'%special' => array(
		'A',
		'IMG',
		'APPLET',
		'OBJECT',
		'FONT',
		'BASEFONT',
		'BR',
		'SCRIPT',
		'MAP',
		'Q',
		'SUB',
		'SUP',
		'SPAN',
		'BDO',
		'IFRAME'
		),
	'%formctrl' => array(
		'INPUT',
		'SELECT',
		'TEXTAREA',
		'LABEL',
		'BUTTON'
		),
	'%inline' => array(
		'CDATA',
		'%fontstyle',
		'%phrase',
		'%special',
		'%formctrl'
		),
	'%block' => array(
		'P',
		'%heading',
		'%list',
		'%preformatted',
		'DL',
		'DIV',
		'CENTER',
		'NOSCRIPT',
		'NOFRAMES',
		'BLOCKQUOTE',
		'INS',
		'DEL',
		'FORM',
		'ISINDEX',
		'HR',
		'TABLE',
		'FIELDSET',
		'ADDRESS'
		),
	'%flow' => array(
		'%block',
		'%inline'
		),
		
	'TT' => array('%inline'),	// fontstyle
	'I' => array('%inline'),
	'B' => array('%inline'),
	'U' => array('%inline'),
	'S' => array('%inline'),
	'STRIKE' => array('%inline'),
	'BIG' => array('%inline'),
	'SMALL' => array('%inline'),
	
	'EM' => array('%inline'),	// phrase
	'STRONG' => array('%inline'),
	'DFN' => array('%inline'),
	'CODE' => array('%inline'),
	'SAMP' => array('%inline'),
	'KBD' => array('%inline'),
	'VAR' => array('%inline'),
	'CITE' => array('%inline'),
	'ABBR' => array('%inline'),
	'ACRONYM' => array('%inline'),
		
	'SUB' => array('%inline'),
	'SUP' => array('%inline'),
	'SPAN' => array('%inline'),
	'BDO' => array('%inline'),
	'BASEFONT' => array(),
	'FONT' => array('%inline'),
	'BR' => array(),
	'BODY' => array(
		'%flow',
		'INS',
		'DEL'
		),
	'ADDRESS' => array(
		'%inline',
		'P'
		),
	'DIV' => array('%flow'),
	'CENTER' => array('%flow'),
	'A' => array('%inline'),
	'MAP' => array(
		'%block',
		'AREA'
		),
	'AREA' => array(),
	'LINK' => array(),
	'IMG' => array(),
	'OBJECT' => array(
		'PARAM',
		'%flow'
		),
	'PARAM' => array(),
	'HR' => array(),
	'P' => array('%inline'),
	'H1' => array('%inline'),
	'H2' => array('%inline'),
	'H3' => array('%inline'),
	'H4' => array('%inline'),
	'H5' => array('%inline'),
	'H6' => array('%inline'),
	'PRE' => array('%inline'),
	'Q' => array('%inline'),
	'BLOCKQUOTE' => array('%flow'),
	'INS' => array('%flow'),
	'DEL' => array('%flow'),
	'DL' => array(
		'DT',
		'DD'
		),
	'DT' => array('%inline'),
	'DD' => array('%flow'),
	'OL' => array('LI'),
	'UL' => array('LI'),
	'DIR' => array('LI'),
	'MENU' => array('LI'),
	'LI' => array('%flow'),
	'FORM' => array('%flow'),
	'LABEL' => array('%inline'),
	'INPUT' => array(),
	'SELECT' => array(
		'OPTGROUP',
		'OPTION'
		),
	'OPTGROUP' => array('OPTION'),
	'OPTION' => array('CDATA'),
	'TEXTAREA' => array('CDATA'),
	'FIELDSET' => array(
		'CDATA',
		'LEGEND',
		'%flow'
		),
	'LEGEND' => array('%inline'),
	'BUTTON' => array('%flow'),
	'TABLE' => array(
		'CAPTION',
		'COL',
		'COLGROUP',
		'THEAD',
		'TFOOT',
		'TBODY'
		),
	'CAPTION' => array('%inline'),
	'THEAD' => array('TR'),
	'TFOOT' => array('TR'),
	'TBODY' => array('TR'),
	'COLGROUP' => array('COL'),
	'COL' => array(),
	'TR' => array(
		'TH',
		'TD'
		),
	'TH' => array('%flow'),
	'TD' => array('%flow'),
	'IFRAME' => array('%flow'),
	'NOFRAMES' => array('%flow'),
	'HEAD' => array(
		'TITLE',
		'BASE',
		'SCRIPT',
		'STYLE',
		'META',
		'LINK',
		'OBJECT'
		),
	'TITLE' => array('CDATA'),
	'META' => array(),
	'STYLE' => array('CDATA'),
	'SCRIPT' => array('CDATA'),
	'NOSCRIPT' => array('%flow'),
	'BASE' => array(),
	'HTML' => array(
		'HEAD',
		'BODY'
		),
	'DOCUMENT' => array(
		'DOCTYPE',
		'HTML'
		)
	);
		
$aExclusions = array(
	'A' => array('A'),
	'PRE' => array(
		'IMG',
		'OBJECT',
		'APPLET',
		'BIG',
		'SMALL',
		'SUB',
		'SUP',
		'FONT',
		'BASEFONT'
		),
	'DIR' => array('%block'),
	'MENU' => array('%block'),
	'FORM' => array('FORM'),
	'LABEL' => array('LABEL'),
	'BUTTON' => array(
		'A',
		'%formctrl',
		'FORM',
		'ISINDEX',
		'FIELDSET',
		'IFRAME'
		)
	);


$aRequiredAttributes = array(
	'style' => array('type'),
	'script' => array('type'),
	'meta' => array('content'),
	'optgroup' => array('label'),
	'textarea' => array('rows', 'cols'),
	'img' => array('src', 'alt')
	);


class clsValidator
{
	var $aTags;
	var $aAttributes;
	var $aRequiredAttributes;
	
	function clsValidator()
	{
		global $aTags;
		global $aAttributes;
		global $aRequiredAttributes;
		
		$this->aTags = array();
		$this->aAttributes = array();
		$this->aRequiredAttributes = array();
		
		foreach (array_keys($aTags) as $sTag)
		{
			$this->aTags[$sTag] = array();
			$this->_expand($this->aTags[$sTag], $aTags[$sTag], $aTags);
		}
		
		foreach (array_keys($aAttributes) as $sAttribute)
		{
			$this->aAttributes[$sAttribute] = array();
			$this->_expand($this->aAttributes[$sAttribute], $aAttributes[$sAttribute], $aAttributes);
		}
		
		foreach (array_keys($aRequiredAttributes) as $sElement)
		{
			$this->aRequiredAttributes[$sElement] = array();
			$this->_expand($this->aRequiredAttributes[$sElement], $aRequiredAttributes[$sElement], $aRequiredAttributes);
		}
	}
	
	function &getInstance()
	{
		static $obj;
		if (!$obj) {
			$obj = new clsValidator();
		}
		return $obj;
	}
	
	function _expand(&$aDestination, &$aSource, &$aDictionary)
	{
		foreach ($aSource as $sChild)
		{
			if ('%' == substr($sChild, 0, 1)) {
				$this->_expand($aDestination, $aDictionary[$sChild], $aDictionary);
			} else
				$aDestination[] = $sChild;
		}
	}
	
	function elementValid($sElement)
	{
		return isset($this->aTags[strtoupper($sElement)]);
	}
	
	function attributeValid($sElement, $sAttribute)
	{
		if (false == isset($this->aAttributes[strtoupper($sElement)]))
			return false;
		return in_array(strtolower($sAttribute), $this->aAttributes[strtoupper($sElement)]);
	}
	
	function childValid($sParent, $sElement)
	{
		if (false == isset($this->aTags[strtoupper($sParent)]))
			return false;
		return in_array(strtoupper($sElement), $this->aTags[strtoupper($sParent)]);
	}
	
	// verify that required attributes have been specified
	function checkRequiredAttributes($sElement, &$aAttributes, &$sMissing)
	{
		if (isset($this->aRequiredAttributes[strtolower($sElement)]))
			foreach ($this->aRequiredAttributes[strtolower($sElement)] as $sRequiredAttribute)
				if (false == isset($aAttributes[$sRequiredAttribute]))
				{
					$sMissing = $sRequiredAttribute;
					return false;
				}
		
		return true;
	}
}
