<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mihai
 * Date: 10/29/12
 * Time: 2:11 PM
 * To change this template use File | Settings | File Templates.
 */

// module/Radio/src/Radio/Model/RadioTable.php;

namespace Radio\Model;

use Zend\Db\TableGateway\TableGateway;

class RadioTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getRadio($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveRadio(Radio $radio)
    {
        $data = array(
            'radio' => $radio->radio,
            'link'  => $radio->link
        );

        $id = (int) $radio->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getRadio($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deletRadio($id) {
        $this->tableGateway->delete(array('id' => $id));
    }
}