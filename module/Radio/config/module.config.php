<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mihai
 * Date: 10/23/12
 * Time: 4:48 PM
 * To change this template use File | Settings | File Templates.
 */

return array(
    'controllers' => array(
        'invokables' => array(
            'Radio\Controller\Radio' => 'Radio\Controller\RadioController',
        ),
    ),

    'router' => array(
        'routes' => array(
            'radio' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/radio[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Radio\Controller\Radio',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'radio' => __DIR__ . '/../view',
        ),
    ),
);