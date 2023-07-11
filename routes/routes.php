<?php
return [
	'([0-9]+)' => [
		'controller' => 'main',
		'action' => 'index',
	],
	'' => [
		'controller' => 'main',
		'action' => 'index',
	],
	'create' => [
		'controller' => 'main',
		'action' => 'create',
	],
    'admin/([0-9]+)' => [
		'controller' => 'admin',
		'action' => 'edit',
	],	
];
