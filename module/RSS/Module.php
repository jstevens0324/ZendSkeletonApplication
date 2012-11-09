<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mihai
 * Date: 10/23/12
 * Time: 11:32 AM
 * To change this template use File | Settings | File Templates.
 */
// module/RSS/Module.php
namespace RSS;

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
}
