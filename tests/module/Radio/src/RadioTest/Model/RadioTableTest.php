<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mihai
 * Date: 10/29/12
 * Time: 2:56 PM
 * To change this template use File | Settings | File Templates.
 */

namespace RadioTest\Model;

use Radio\Model\RadioTable;
use Radio\Model\Radio;
use Zend\Db\ResultSet\ResultSet;
use PHPUnit_Framework_TestCase;

class RadioTableTest extends PHPUnit_Framework_TestCase
{

    /*protected function setUp()
    {
        \Zend\Mvc\Application::init(include './config/application.config.php');
    }*/

    public function testFetchAllReturnsAllRadios()
    {
        $resultSet        = new ResultSet();
        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
                                           array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with()
                         ->will($this->returnValue($resultSet));

        $radioTable = new RadioTable($mockTableGateway);

        $this->assertSame($resultSet, $radioTable->fetchAll());
    }

    public function testCanRetrieveAnRadioByItsId()
    {
        $radio = new Radio();
        $radio->exchangeArray(array('id'     => 123,
                                    'radio' => 'The Military Wives',
                                    'link'  => 'In My Dreams'));

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Radio());
        $resultSet->initialize(array($radio));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('id' => 123))
                         ->will($this->returnValue($resultSet));

        $radioTable = new RadioTable($mockTableGateway);

        $this->assertSame($radio, $radioTable->getradio(123));
    }

    public function testCanDeleteAnradioByItsId()
    {
        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('delete'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('delete')
                         ->with(array('id' => 123));

        $radioTable = new radioTable($mockTableGateway);
        $radioTable->deleteRadio(123);
    }

    public function testSaveRadioWillInsertNewRadiosIfTheyDontAlreadyHaveAnId()
    {
        $radioData = array('radio' => 'Radio Zu', 'link' => 'http://www.radiozu.com');
        $radio     = new Radio();
        $radio->exchangeArray($radioData);

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('insert'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('insert')
                         ->with($radioData);

        $radioTable = new RadioTable($mockTableGateway);
        $radioTable->saveRadio($radio);
    }

    public function testSaveRadioWillUpdateExistingRadioIfTheyAlreadyHaveAnId()
    {
        $radioData = array('id' => 123, 'radio' => 'Radio Zu', 'link' => 'http://www.radiozu.com');
        $radio     = new Radio();
        $radio->exchangeArray($radioData);

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Radio());
        $resultSet->initialize(array($radio));

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
                                           array('select', 'update'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('id' => 123))
                         ->will($this->returnValue($resultSet));
        $mockTableGateway->expects($this->once())
                         ->method('update')
                         ->with(array('radio' => 'Radio Zu', 'link' => 'http://www.radiozu.com'),
                                array('id' => 123));

        $radioTable = new RadioTable($mockTableGateway);
        $radioTable->saveRadio($radio);
    }

    public function testExceptionIsThrownWhenGettingNonexistentRadio()
    {
        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Radio());
        $resultSet->initialize(array());

        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with(array('id' => 123))
                         ->will($this->returnValue($resultSet));

        $radioTable = new RadioTable($mockTableGateway);

        try
        {
            $radioTable->getRadio(123);
        }
        catch (\Exception $e)
        {
            $this->assertSame('Could not find row 123', $e->getMessage());
            return;
        }

        $this->fail('Expected exception was not thrown');
    }
}