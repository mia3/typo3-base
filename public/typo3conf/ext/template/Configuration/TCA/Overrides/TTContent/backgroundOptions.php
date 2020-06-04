<?php
defined('TYPO3_MODE') || die();

$backgroundOptionsColumns = [
    "content_background_color" => [
        'exclude' => true,
        'label' => 'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:content_background_color',
        'description' => 'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:content_background_color.desc',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                [
                    'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:content_background_color.none',
                    '0',
                ],
                [
                    'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:content_background_color.1',
                    '1',
                ],
                [
                    'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:content_background_color.2',
                    '2',
                ],
            ],
            'default' => 0,
        ],
    ],
    "content_padding_top" => [
        'exclude' => true,
        'label' => 'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:content_padding_top',
        'description' => 'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:content_padding_top.desc',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                [
                    'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:tt_content.space.none',
                    '0',
                ],
                [
                    'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:tt_content.space.line_1',
                    '1',
                ],
                [
                    'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:tt_content.space.line_2',
                    '2',
                ],
                [
                    'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:tt_content.space.line_3',
                    '3',
                ],
                [
                    'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:tt_content.space.line_4',
                    '4',
                ],
                [
                    'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:tt_content.space.line_5',
                    '5',
                ],
                [
                    'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:tt_content.space.line_6',
                    '6',
                ],
                [
                    'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:tt_content.space.line_7',
                    '7',
                ],
                [
                    'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:tt_content.space.line_8',
                    '8',
                ],
                [
                    'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:tt_content.space.line_9',
                    '9',
                ],
            ],
            'default' => 0,
        ],
    ],
    "content_padding_bottom" => [
        'exclude' => true,
        'label' => 'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:content_padding_bottom',
        'description' => 'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:content_padding_bottom.desc',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                [
                    'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:tt_content.space.none',
                    '0',
                ],
                [
                    'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:tt_content.space.line_1',
                    '1',
                ],
                [
                    'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:tt_content.space.line_2',
                    '2',
                ],
                [
                    'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:tt_content.space.line_3',
                    '3',
                ],
                [
                    'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:tt_content.space.line_4',
                    '4',
                ],
                [
                    'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:tt_content.space.line_5',
                    '5',
                ],
                [
                    'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:tt_content.space.line_6',
                    '6',
                ],
                [
                    'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:tt_content.space.line_7',
                    '7',
                ],
                [
                    'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:tt_content.space.line_8',
                    '8',
                ],
                [
                    'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:tt_content.space.line_9',
                    '9',
                ],
            ],
            'default' => 0,
        ],
    ],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $backgroundOptionsColumns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'tt_content',
    'backgroundOptions',
    'content_background_color,content_padding_top,content_padding_bottom',
    ''
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    '--palette--;LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:background_options;backgroundOptions',
    '',
    'after:--palette--;;grid'
);
