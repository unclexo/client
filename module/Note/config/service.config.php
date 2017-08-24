<?php 

return array(
	'invokables' => array(
		'NoteNoteEntity' => 'Note\Entity\NoteEntity',
		'NoteNoteFilter' => 'Note\Filter\NoteFilter',
	),
	'factories' => array(
		'NoteWallEntity' => 'Note\Factory\Entity\WallEntityFactory',
		'NoteNoteForm' => 'Note\Factory\Form\NoteFormFactory'
	),
);