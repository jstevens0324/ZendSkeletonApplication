<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mihai
 * Date: 11/8/12
 * Time: 10:27 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Radio\Form;

use Zend\Form\Form;

class RadioForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('radio');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));

        $this->add(array(
            'name' => 'radio',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Radio Name',
            ),
        ));

        $this->add(array(
            'name' => 'link',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Radio Link',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id'    => 'submitbutton',
            ),
        ));
    }
}