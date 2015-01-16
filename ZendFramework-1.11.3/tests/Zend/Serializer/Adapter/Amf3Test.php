<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Serializer
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Amf3Test.php 23514 2010-12-15 19:29:04Z mjh_ca $
 */

/**
 * @see Zend_Serializer_Adapter_Amf3
 */
require_once 'Zend/Serializer/Adapter/Amf3.php';

/**
 * @category   Zend
 * @package    Zend_Serializer
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Serializer_Adapter_Amf3Test extends PHPUnit_Framework_TestCase
{

    private $_adapter;

    public function setUp()
    {
        $this->_adapter = new Zend_Serializer_Adapter_Amf3();
    }

    public function tearDown()
    {
        $this->_adapter = null;
    }

    /**
     * Simple test to serialize a value using Zend_Amf_Parser_Amf3_Serializer
     * -> This only tests the usage of Zend_Amf @see Zend_Amf_AllTests
     */
    public function testSerialize()
    {
        $value    = true;
        $expected = "\x03"; // Amf3 -> true

        $data = $this->_adapter->serialize($value);
        $this->assertEquals($expected, $data);
    }

    /**
     * Simple test to unserialize a value using Zend_Amf_Parser_Amf3_Deserializer
     * -> This only tests the usage of Zend_Amf @see Zend_Amf_AllTests
     */
    public function testUnserialize()
    {
        $expected   = true;
        $value      = "\x03"; // Amf3 -> true

        $data = $this->_adapter->unserialize($value);
        $this->assertEquals($expected, $data);
    }

}
