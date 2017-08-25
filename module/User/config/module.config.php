<?php

return array(
	'router' => array(
		'routes' => array(
			'user-registration' => array(
				'type' => 'Zend\Mvc\Router\Http\Literal',
				'options' => array(
					'route' => '/',
					'defaults' => array(
						'controller' => 'NoteUserIndexController',
						'action' => 'index',
					),
				),
			),	
			'user-login' => array(
				'type' => 'Zend\Mvc\Router\Http\Literal',
				'options' => array(
					'route' => '/login',
					'defaults' => array(
						'controller' => 'NoteUserIndexController',
						'action' => 'login',
					),
				),
			),			
			'user-logout' => array(
				'type' => 'Zend\Mvc\Router\Http\Literal',
				'options' => array(
					'route' => '/logout',
					'defaults' => array(
						'controller' => 'NoteUserIndexController',
						'action' => 'logout',
					),
				),
			),
			'user-info' => array(
				'type' => 'Zend\Mvc\Router\Http\Literal',
				'options' => array(
					'route' => '/info',
					'defaults' => array(
						'controller' => 'NoteUserIndexController',
						'action' => 'info',
					),
				),
			),						
		),
	),
	'view_manager' => array(
		'template_path_stack' => array(
			__DIR__ . '/../view',
		),
	),
    'upload_config' => array(
        'upload_path' => 'data/uploads',
    ),	
);