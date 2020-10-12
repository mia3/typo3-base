<?php
return [
    'BE' => [
        'debug' => true,
        'explicitADmode' => 'explicitAllow',
        'installToolPassword' => '$argon2i$v=19$m=16384,t=16,p=2$MmxkNy9vSlh4Z3ZkVU9Rcw$sF6CE+EapkwO5eI2/syaXMDY+OtKfx+u5U53NjTJ/8Q',
        'loginSecurityLevel' => 'normal',
        'passwordHashing' => [
            'className' => 'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\Argon2iPasswordHash',
            'options' => [],
        ],
    ],
    'DB' => [
        'Connections' => [
            'Default' => [
                'charset' => 'utf8',
                'driver' => 'mysqli',
            ],
        ],
    ],
    'EXT' => [],
    'EXTENSIONS' => [
        'backend' => [
            'backendFavicon' => 'EXT:template/Resources/Public/Media/Favicon/favicon.ico',
            'backendLogo' => 'EXT:template/Resources/Public/Backend/Logo_3.svg',
            'loginBackgroundImage' => 'EXT:template/Resources/Public/Backend/Backend_Background.png',
            'loginFootnote' => '© MIA3 GmbH & Co. KG',
            'loginHighlightColor' => '#4b113a',
            'loginLogo' => 'EXT:template/Resources/Public/Backend/Logo_MIA3.svg',
        ],
        'extensionmanager' => [
            'automaticInstallation' => '1',
            'offlineMode' => '0',
        ],
        'mask' => [
            'backend' => 'EXT:template/Resources/Private/Mask/Backend/Templates/',
            'backendlayout_pids' => '0,1',
            'content' => 'EXT:template/Resources/Private/Mask/Frontend/Templates/',
            'json' => 'EXT:template/mask.json',
            'layouts' => 'EXT:template/Resources/Private/Mask/Frontend/Layouts/',
            'layouts_backend' => 'EXT:template/Resources/Private/Mask/Backend/Layouts/',
            'partials' => 'EXT:template/Resources/Private/Mask/Frontend/Partials/',
            'partials_backend' => 'EXT:template/Resources/Private/Mask/Backend/Partials/',
            'preview' => 'EXT:template/Resources/Private/Mask/Backend/Preview/',
        ],
        'news' => [
            'advancedMediaPreview' => '1',
            'archiveDate' => 'date',
            'categoryBeGroupTceFormsRestriction' => '0',
            'categoryRestriction' => '',
            'contentElementPreview' => '1',
            'contentElementRelation' => '1',
            'dateTimeNotRequired' => '0',
            'hidePageTreeForAdministrationModule' => '0',
            'manualSorting' => '0',
            'mediaPreview' => 'false',
            'prependAtCopy' => '1',
            'resourceFolderImporter' => '/news_import',
            'rteForTeaser' => '0',
            'showAdministrationModule' => '1',
            'showImporter' => '0',
            'slugBehaviour' => 'unique',
            'storageUidImporter' => '1',
            'tagPid' => '1',
        ],
        'vhs' => [
            'disableAssetHandling' => '0',
        ],
    ],
    'FE' => [
        'debug' => true,
        'loginSecurityLevel' => 'normal',
        'passwordHashing' => [
            'className' => 'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\Argon2iPasswordHash',
            'options' => [],
        ],
    ],
    'GFX' => [
        'processor' => 'ImageMagick',
        'processor_allowTemporaryMasksAsPng' => '',
        'processor_colorspace' => 'RGB',
        'processor_effects' => false,
        'processor_enabled' => '1',
        'processor_path' => '/usr/bin/',
        'processor_path_lzw' => '/usr/bin/',
    ],
    'LOG' => [
        'TYPO3' => [
            'CMS' => [
                'deprecations' => [
                    'writerConfiguration' => [
                        'notice' => [
                            'TYPO3\CMS\Core\Log\Writer\FileWriter' => [
                                'disabled' => false,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'MAIL' => [
        'layoutRootPaths' => [
            700 => 'EXT:template/Resources/Private/Layouts',
        ],
        'templateRootPaths' => [
            700 => 'EXT:template/Resources/Private/Templates/Email',
        ],
        'transport' => 'sendmail',
        'transport_sendmail_command' => '/usr/sbin/sendmail -t -i ',
        'transport_smtp_encrypt' => '',
        'transport_smtp_password' => '',
        'transport_smtp_server' => '',
        'transport_smtp_username' => '',
    ],
    'SYS' => [
        'caching' => [
            'cacheConfigurations' => [
                'hash' => [
                    'backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\Typo3DatabaseBackend',
                ],
                'imagesizes' => [
                    'backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\Typo3DatabaseBackend',
                ],
                'pages' => [
                    'backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\Typo3DatabaseBackend',
                ],
                'pagesection' => [
                    'backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\Typo3DatabaseBackend',
                ],
                'rootline' => [
                    'backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\Typo3DatabaseBackend',
                ],
            ],
        ],
        'devIPmask' => '*',
        'displayErrors' => 1,
        'encryptionKey' => '506070055b32e8b0a9521b685eaf45f49db6bf15dcc0da442a1a3f478bc124c84253929181140ecdb5b8d2446d26ac62',
        'exceptionalErrors' => 12290,
        'features' => [
            'unifiedPageTranslationHandling' => true,
        ],
        'sitename' => 'TYPO3 Base',
        'systemMaintainers' => [
            1,
        ],
    ],
];
