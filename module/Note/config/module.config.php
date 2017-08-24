<?php 

return array(
    'router' => array(
        'routes' => array(
            'note' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/:username[/page/:page]',
                    'constraints' => array(
                        'username' => '\w+'
                    ),
                    'defaults' => array(
                        'controller' => 'NoteNoteIndexController',
                        'action'     => 'index',
                        'page'       => 1
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
);