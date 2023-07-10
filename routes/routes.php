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
    'admin/([0-9]+)' => [
		'controller' => 'admin',
		'action' => 'edit',
	],	
];
