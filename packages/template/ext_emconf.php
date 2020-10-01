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
            'typo3' => '10.4.0-10.4.99',
            'vhs' => '',
            'news' => "",
            'mask' => "",
        ],
        'conflicts' => [
        ],
    ],
    'state' => 'stable',
    'uploadfolder' => 0,
    'clearCacheOnLoad' => 1,
    'author' => 'Marc Neuhaus',
    'author_email' => 'marc@mia3.com',
    'author_company' => 'MIA3',
    'version' => '1.0.0',
];
