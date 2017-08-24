<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Home',
                'route' => 'note',
                'use_route_match' => true,
                'resource' => 'note'
            ),
            array(
                'label' => 'Info',
                'route' => 'user-info',
                'resource' => 'user-info'
            ),
            array(
                'label' => 'Logout',
                'route' => 'user-logout',
                'resource' => 'user-logout'
            ),
            array(
                'label' => 'Login',
                'route' => 'user-login',
                'resource' => 'user-login'
            ),                        
        )
    ),  
    'service_manager' => array(
        'factories' => array(
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
        ),
    ),
);
