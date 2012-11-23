<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mihai
 * Date: 11/15/12
 * Time: 10:44 AM
 * To change this template use File | Settings | File Templates.
 */

namespace RSS\Form;

use Zend\Captcha;
use Zend\Form\Element;
use Zend\Form\Fieldset;
use Zend\Form\Form;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;

class RSSComment extends Form
{
    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'author',
            'attributes' => array(
                'type'  => 'text'
            ),
            'options' => array(
                'label' => 'Author Name',
            ),
        ));

        $this->add(array(
            'name' => 'comment',
            'attributes' => array(
                'type' => 'textarea',
            ),
            'options' => array(
                'label' => 'Comment Body',
            ),
        ));

        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Author Email',
            ),
        ));

        $this->add(array(
            'name' => 'captcha',
            'type' => 'Zend\Form\Element\Captcha',

            'options' => array(
                'label' => 'Please verify you are human. ',
                'captcha' => array(
                    'class' => 'Dumb',
                ),
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'security'
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));

    }
}