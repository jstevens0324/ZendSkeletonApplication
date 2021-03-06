<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mihai
 * Date: 10/23/12
 * Time: 11:32 AM
 * To change this template use File | Settings | File Templates.
 */
// module/Radio/Module.php
namespace Radio;

use Radio\Model\Radio;
use Radio\Model\RadioTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function getAutoloaderConfig(){
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ .'/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig(){
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Radio\Model\RadioTable' =>  function($sm) {
                    $tableGateway = $sm->get('RadioTableGateway');
                    $table = new RadioTable($tableGateway);
                    return $table;
                },
                'RadioTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Radio());
                    return new TableGateway('radio', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}
