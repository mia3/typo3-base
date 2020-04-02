<?php
return [
    'BE' => [
        'debug' => false,
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
    'EXT' => [
        'extConf' => [
            'backend' => 'a:6:{s:14:"backendFavicon";s:0:"";s:11:"backendLogo";s:0:"";s:20:"loginBackgroundImage";s:0:"";s:13:"loginFootnote";s:0:"";s:19:"loginHighlightColor";s:0:"";s:9:"loginLogo";s:0:"";}',
            'extensionmanager' => 'a:2:{s:21:"automaticInstallation";s:1:"1";s:11:"offlineMode";s:1:"0";}',
            'mask' => 'a:9:{s:4:"json";s:22:"EXT:template/mask.json";s:18:"backendlayout_pids";s:3:"0,1";s:7:"content";s:65:"EXT:template/Resources/Private/Extension/Mask/Frontend/Templates/";s:7:"layouts";s:63:"EXT:template/Resources/Private/Extension/Mask/Frontend/Layouts/";s:8:"partials";s:64:"EXT:template/Resources/Private/Extension/Mask/Frontend/Partials/";s:7:"backend";s:64:"EXT:template/Resources/Private/Extension/Mask/Backend/Templates/";s:15:"layouts_backend";s:62:"EXT:template/Resources/Private/Extension/Mask/Backend/Layouts/";s:16:"partials_backend";s:63:"EXT:template/Resources/Private/Extension/Mask/Backend/Partials/";s:7:"preview";s:62:"EXT:template/Resources/Private/Extension/Mask/Backend/Preview/";}',
            'news' => 'a:17:{s:20:"advancedMediaPreview";s:1:"1";s:11:"archiveDate";s:4:"date";s:34:"categoryBeGroupTceFormsRestriction";s:1:"0";s:19:"categoryRestriction";s:0:"";s:21:"contentElementPreview";s:1:"1";s:22:"contentElementRelation";s:1:"1";s:19:"dateTimeNotRequired";s:1:"0";s:35:"hidePageTreeForAdministrationModule";s:1:"0";s:13:"manualSorting";s:1:"0";s:12:"mediaPreview";s:5:"false";s:13:"prependAtCopy";s:1:"1";s:22:"resourceFolderImporter";s:12:"/news_import";s:12:"rteForTeaser";s:1:"0";s:24:"showAdministrationModule";s:1:"1";s:12:"showImporter";s:1:"0";s:18:"storageUidImporter";s:1:"1";s:6:"tagPid";s:1:"1";}',
            'scheduler' => 'a:2:{s:11:"maxLifetime";s:4:"1440";s:15:"showSampleTasks";s:1:"1";}',
            'vhs' => 'a:1:{s:20:"disableAssetHandling";s:1:"0";}',
        ],
    ],
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
            'backend' => 'EXT:template/Resources/Private/Extensions/mask/Backend/Templates/',
            'backendlayout_pids' => '0,1',
            'content' => 'EXT:template/Resources/Private/Extensions/mask/Frontend/Templates/',
            'json' => 'EXT:template/mask.json',
            'layouts' => 'EXT:template/Resources/Private/Extensions/mask/Frontend/Layouts/',
            'layouts_backend' => 'EXT:template/Resources/Private/Extensions/mask/Backend/Layouts/',
            'partials' => 'EXT:template/Resources/Private/Extensions/mask/Frontend/Partials/',
            'partials_backend' => 'EXT:template/Resources/Private/Extensions/mask/Backend/Partials/',
            'preview' => 'EXT:template/Resources/Private/Extensions/mask/Backend/Preview/',
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
            'storageUidImporter' => '1',
            'tagPid' => '1',
        ],
        'scheduler' => [
            'maxLifetime' => '1440',
            'showSampleTasks' => '1',
        ],
        'vhs' => [
            'disableAssetHandling' => '0',
        ],
    ],
    'FE' => [
        'debug' => false,
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
    'MAIL' => [
        'transport' => 'sendmail',
        'transport_sendmail_command' => '/usr/sbin/sendmail -t -i ',
        'transport_smtp_encrypt' => '',
        'transport_smtp_password' => '',
        'transport_smtp_server' => '',
        'transport_smtp_username' => '',
    ],
    'SYS' => [
        'devIPmask' => '*',
        'displayErrors' => 1,
        'encryptionKey' => '506070055b32e8b0a9521b685eaf45f49db6bf15dcc0da442a1a3f478bc124c84253929181140ecdb5b8d2446d26ac62',
        'exceptionalErrors' => 12290,
        'features' => [
            'unifiedPageTranslationHandling' => true,
        ],
        'sitename' => 'TYPO3 Base',
        'systemLogLevel' => 0,
        'systemMaintainers' => [
            1,
        ],
    ],
];
