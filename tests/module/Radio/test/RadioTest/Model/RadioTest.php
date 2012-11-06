<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mihai
 * Date: 11/6/12
 * Time: 5:37 PM
 * To change this template use File | Settings | File Templates.
 */

namespace RadioTest\Model;

use Radio\Model\Radio;
use PHPUnit_Framework_TestCase;

class AlbumTest extends PHPUnit_Framework_TestCase
{
    public function testRadioInitialState()
    {
        $album = new Radio();

        $this->assertNull($album->radio, '"radio" should initially be null');
        $this->assertNull($album->id, '"id" should initially be null');
        $this->assertNull($album->link, '"link" should initially be null');
    }

    public function testExchangeArraySetsPropertiesCorrectly()
    {
        $album = new Radio();
        $data  = array('radio' => 'some radio',
                       'id'     => 123,
                       'link'  => 'some link');

        $album->exchangeArray($data);

        $this->assertSame($data['radio'], $album->radio, '"radio" was not set correctly');
        $this->assertSame($data['id'], $album->id, '"id" was not set correctly');
        $this->assertSame($data['link'], $album->link, '"link" was not set correctly');
    }

    public function testExchangeArraySetsPropertiesToNullIfKeysAreNotPresent()
    {
        $album = new Radio();

        $album->exchangeArray(array('radio' => 'some radio',
                                    'id'     => 123,
                                    'link'  => 'some link'));
        $album->exchangeArray(array());

        $this->assertNull($album->radio, '"radio" should have defaulted to null');
        $this->assertNull($album->id, '"id" should have defaulted to null');
        $this->assertNull($album->link, '"link" should have defaulted to null');
    }
}