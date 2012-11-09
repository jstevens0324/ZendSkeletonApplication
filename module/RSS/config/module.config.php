<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mihai
 * Date: 11/9/12
 * Time: 11:19 AM
 * To change this template use File | Settings | File Templates.
 */

return array(
    'controllers' => array(
        'invokables' => array(
            'RSS\Controller\RSS' => 'RSS\Controller\RSSController',
        ),
    ),

    'router' => array(
        'routes' => array(
            'rss' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/rss[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'RSS\Controller\RSS',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'rss' => __DIR__ . '/../view',
        ),
    ),
);