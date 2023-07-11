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
	'([0-9]+)/sort=([A-z]+)' => [
		'controller' => 'main',
		'action' => 'indexWithSort',
	],
	'sort=([A-z]+)' => [
		'controller' => 'main',
		'action' => 'indexWithSort',
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
