<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mihai
 * Date: 10/26/12
 * Time: 11:05 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Radio\Model;

use PHPUnit_Framework_TestCase;

class RadioTest extends PHPUnit_Framework_TestCase
{
    public function testRadioInitialState()
    {
        $radio = new Radio();

        $this->assertNUll($radio->id, '"id" should initially be null');
        $this->assertNUll($radio->radio, '"radio" should initially be null');
        $this->assertNUll($radio->link, '"link" should initially be null');
    }

    public function testExchangeArraySetsPropertiesCorrectly()
    {
        $radio = new Radio();

        $data = array('radio'   => 'some radio station',
                      'id'      => 123,
                      'link'    => 'http://radiotuna.com'
                     );

        $radio->exchangeArray($data);

        $this->assertSame($data['radio'], $radio->radio, '"radio" was not set correctly');
        $this->assertSame($data['id'], $radio->id, '"id" was not set correctly');
        $this->assertSame($data['link'], $radio->link, '"link" was not set correctly');
    }

    public function testExchangeArraySetsPropertiesToNullIfKeysAreNotPresent()
    {
        $album = new Radio();

        $album->exchangeArray(array('radio' => 'kiss Fm',
                                    'id'     => 123,
                                    'link'  => 'kissfm.md'));
        $album->exchangeArray(array());

        $this->assertNull($album->radio, '"radio" should have defaulted to null');
        $this->assertNull($album->id, '"link" should have defaulted to null');
        $this->assertNull($album->link, '"link" should have defaulted to null');
    }

    protected function setUp()
    {
        \Zend\Mvc\Application::init(include 'config/application.config.php');
    }
}