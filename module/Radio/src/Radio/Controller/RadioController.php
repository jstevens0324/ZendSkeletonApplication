<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mihai
 * Date: 10/24/12
 * Time: 11:13 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Radio\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class RadioController extends AbstractActionController
{
    protected $radioTable;

    public function indexAction(){
        return new ViewModel(array(
            'radios' => $this->getRadioTable()->fetchAll(),
        ));
    }

    public function addAction(){

    }

    public function  editAction(){

    }

    public function deleteAction(){

    }

    public function getRadioTable()
    {
        if (!$this->radioTable) {
            $sm = $this->getServiceLocator();
            $this->radioTable = $sm->get('Radio\Model\RadioTable');
        }
        return $this->radioTable;
    }
}