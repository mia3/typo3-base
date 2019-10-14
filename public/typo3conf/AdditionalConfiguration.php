<?php

$GLOBALS['TYPO3_CONF_VARS']['DB']['Connections'] = [
	'Default' => [
		'driver' => 'mysqli',
		'host' => 'localhost',
		'dbname' => 'typo3_local',
		'user' => 'root',
		'password' => 'root',
		'unix_socket' => '',
		'charset' => 'utf8',
		'tableoptions' => [
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_unicode_ci',
		],
	],
];

// $GLOBALS['TYPO3_CONF_VARS']['MAIL'] = [
//     'defaultMailFromAddress' => '',
//     'defaultMailFromName' => '',
//     'transport' => 'smtp',
//     'transport_smtp_server' => 'mailcatcher.mia3.com:1025'
// ];

// $GLOBALS['TYPO3_CONF_VARS']['BE']['debug'] = true;
// $GLOBALS['TYPO3_CONF_VARS']['FE']['debug'] = true;
// $GLOBALS['TYPO3_CONF_VARS']['SYS']['displayErrors'] = 1;
