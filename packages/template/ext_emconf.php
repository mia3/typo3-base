<?php

/**
 * Extension Manager/Repository config file for ext "template".
 */
$EM_CONF[$_EXTKEY] = [
    'title' => 'Template',
    'description' => '',
    'category' => 'templates',
    'constraints' => [
        'depends' => [
            'typo3' => '10',
            'vhs' => '',
            'news' => '',
            'mask' => '',
        ],
        'conflicts' => [
        ],
    ],
    'state' => 'stable',
    'uploadfolder' => 0,
    'clearCacheOnLoad' => 1,
    'author' => 'MIA3 GmbH',
    'author_email' => 'typo3@mia3.com',
    'author_company' => 'MIA3 GmbH',
    'version' => '1.0.0',
];
