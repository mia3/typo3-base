<?php

defined('TYPO3_MODE') || die();

require_once 'tt_content/image.php';
require_once 'tt_content/header.php';

call_user_func(
    function () {
        $temporaryColumns = [
            'tx_template_container' => [
                'label' => 'Container',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [
                            'No container',
                            '',
                        ],
                        [
                            'Container',
                            'container',
                        ],
                    ],
                ],
            ],
        ];

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $temporaryColumns);
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
            'tt_content',
            'frames',
            '--linebreak--,tx_template_container'
        );
    }
);
