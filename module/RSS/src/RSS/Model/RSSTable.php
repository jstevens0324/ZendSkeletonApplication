<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mihai
 * Date: 11/15/12
 * Time: 4:49 PM
 * To change this template use File | Settings | File Templates.
 */

namespace RSS\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;

class RSSTable extends AbstractTableGateway
{
    protected $table = 'rssComments';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        //$this->resultSetPrototype->setArrayObjectPrototype(new Album());
        $this->initialize();
    }

    public function fetchAll()
    {
        $resultSet = $this->select();
        return $resultSet;
    }
}