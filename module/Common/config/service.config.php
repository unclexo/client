<?php

return array(
	'invokables' => array(
		'NoteAuthAdapter' => 'Common\Authentication\Adapter\AuthAdapter',
	),
	'factories' => array(
		'NoteSessionConfig' => 'Common\Factory\Session\SessionConfigFactory',
		'NoteSessionManager' => 'Common\Factory\Session\SessionManagerFactory',
		'NoteAuthStorage' => 'Common\Factory\Authentication\Storage\SessionFactory',
		'NoteAuthService' => 'Common\Factory\Authentication\AuthenticationServiceFactory',
	),
);