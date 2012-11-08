<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mihai
 * Date: 10/26/12
 * Time: 10:59 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Radio\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Radio
{
    public $id;
    public $radio;
    public $link;
    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->id       = (isset($data['id'])) ? $data['id'] : null ;
        $this->radio    = (isset($data['radio'])) ? $data['radio'] : null ;
        $this->link       = (isset($data['link'])) ? $data['link'] : null ;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                'name'      => 'id',
                'required'  => 'true',
                'filters'   => array(
                    array('name' => 'Int')
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'radio',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'link',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}