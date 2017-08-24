<?php

return array(
    'roles' => array(
        'guest',
        'member'
    ),
    'permissions' => array( 
        'guest' => array(
            'user-login',
            'user-registration',
        ),
        'member' => array(
            'user-logout',
            'user-info',
        )
    )
);