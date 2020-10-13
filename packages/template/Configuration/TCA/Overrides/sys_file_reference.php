<?php
defined('TYPO3_MODE') || die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'sys_file_reference',
    'imageoverlayPalette',
    'stretch_across_content',
    'after:crop'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'sys_file_reference',
    [
        'stretch_across_content' => [
            'exclude' => true,
            'label' => 'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:stretch_across_content',
            'description' => 'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:stretch_across_content.desc',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                    ],
                ],
            ],
        ],
    ]
);
