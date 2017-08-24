<?php

return array(
	'session_config' => array(
		'name' => 'Hello71',
        'cache_expire' => 86400,
        'cookie_lifetime' => 86400,
        'remember_me_seconds' => 86400,
        'gc_probability' => 10,
        'gc_divisor' => 1000,
        'use_cookies' => true,
        'cookie_httponly' => true,
        'gc_maxlifetime' => 86400,
	),
	'view_manager' => array(
		'display_not_found_reason' => true,
		'display_exceptions'       => true,
		'doctype'                  => 'HTML5',
		'not_found_template'       => 'error/404',
		'exception_template'       => 'error/index',
		'template_path_stack' => array(
			__DIR__ . '/../view',
		),
	),
);