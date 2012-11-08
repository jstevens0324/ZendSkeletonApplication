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
use Radio\Model\Radio;
use Radio\Form\RadioForm;

class RadioController extends AbstractActionController
{
    protected $radioTable;

    public function indexAction(){
        return new ViewModel(array(
            'radios' => $this->getRadioTable()->fetchAll(),
        ));
    }

    public function addAction(){
        $form = new RadioForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $radio = new Radio();
            $form->setInputFilter($radio->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $radio->exchangeArray($form->getData());
                $this->getRadioTable()->saveRadio($radio);

                // Redirect to list of radios
                return $this->redirect()->toRoute('radio');
            }
        }
        return array('form' => $form);
    }

    public function  editAction(){
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('radio', array(
                'action' => 'add'
            ));
        }
        $radio = $this->getRadioTable()->getRadio($id);

        $form  = new RadioForm();
        $form->bind($radio);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($radio->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getRadioTable()->saveRadio($form->getData());

                // Redirect to list of albums
                return $this->redirect()->toRoute('radio');
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction(){
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('radio');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getRadioTable()->deleteRadio($id);
            }

            // Redirect to list of albums
            return $this->redirect()->toRoute('radio');
        }

        return array(
            'id'    => $id,
            'radio' => $this->getRadioTable()->getRadio($id)
        );
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