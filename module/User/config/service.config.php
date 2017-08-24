<?php

return array(
	'invokables' => array(
		// Entity services
		'NoteFileEntity' => 'User\Entity\FileEntity',
		'NoteUserEntity' => 'User\Entity\UserEntity',

		// Filter services
		'NoteInfoFilter' => 'User\Filter\InfoFilter',
		'NoteLoginFilter' => 'User\Filter\LoginFilter',
		'NoteRegisterFilter' => 'User\Filter\RegisterFilter',				

	),	
	'factories' => array(
		// Form services
		'NoteInfoForm' => 'User\Factory\Form\InfoFormFactory',
		'NoteLoginForm' => 'User\Factory\Form\LoginFormFactory',
		'NoteRegisterForm' => 'User\Factory\Form\RegisterFormFactory',	
	),
);