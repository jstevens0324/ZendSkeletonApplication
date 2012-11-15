<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mihai
 * Date: 11/15/12
 * Time: 10:44 AM
 * To change this template use File | Settings | File Templates.
 */

namespace RSS\Form;

use Zend\Form\Form;

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
                'type' => 'text',
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
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));

    }
}