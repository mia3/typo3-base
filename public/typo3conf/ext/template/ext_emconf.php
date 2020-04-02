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
            'typo3' => '9.5.0-9.5.99',
            'fluid_styled_content' => '9.5.0-9.5.99',
            'rte_ckeditor' => '9.5.0-9.5.99',
            'vhs' => '',
            'news' => "",
            'mask' => ""
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'Mia3\\Template\\' => 'Classes',
        ],
    ],
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'Marc Neuhaus',
    'author_email' => 'marc@mia3.com',
    'author_company' => 'MIA3',
    'version' => '1.0.0',
];
