<?php

namespace Blog;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

return [
    'router'          => [
        'routes' => [
            'blog' => [
                'type'          => Literal::class,
                'options'       => [
                    'route'    => '/blog',
                    'defaults' => [
                        'controller' => Controller\ListController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes'  => [
                    'add'    => [
                        'type'    => Literal::class,
                        'options' => [
                            'route'    => '/add',
                            'defaults' => [
                                'controller' => Controller\WriteController::class,
                                'action'     => 'add',
                            ],
                        ],
                    ],
                    'detail' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'       => '/:id',
                            'defaults'    => [
                                'action' => 'detail',
                            ],
                            'constraints' => [
                                'id' => '[1-9]\d*',
                            ],
                        ],
                    ],
                    'edit'   => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'       => '/edit/:id',
                            'constraints' => [
                                'id' => '[1-9]\d*',
                            ],
                            'defaults'    => [
                                'controller' => Controller\WriteController::class,
                                'action'     => 'edit',
                            ],
                        ],
                    ],
                    'delete' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'       => '/delete/:id',
                            'defaults'    => [
                                'controller' => Controller\DeleteController::class,
                                'action'     => 'delete',
                            ],
                            'constraints' => [
                                'id' => '[1-9]\d*',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'view_manager'    => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'controllers'     => [
        'factories' => [
            Controller\ListController::class   => Factory\ListControllerFactory::class,
            Controller\WriteController::class  => Factory\WriteControllerFactory::class,
            Controller\DeleteController::class => Factory\DeleteControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'aliases'   => [
            Model\PostRepositoryInterface::class => Model\ZendDbSqlRepository::class,
            Model\PostCommandInterface::class    => Model\ZendDbSqlCommand::class,
        ],
        'factories' => [
            Model\ZendDbSqlRepository::class => Factory\ZendDbSqlRepositoryFactory::class,
            Model\ZendDbSqlCommand::class    => Factory\ZendDbSqlCommandFactory::class,
        ],
    ],
];