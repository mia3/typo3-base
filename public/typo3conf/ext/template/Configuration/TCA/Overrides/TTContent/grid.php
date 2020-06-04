<?php
defined('TYPO3_MODE') || die();

$gridColumns = [
    "offset_left" => [
        'exclude' => true,
        'label' => 'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:offset_left',
        'description' => 'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:offset_left.desc',
        'displayCond' => 'FIELD:layout:!=:22',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                [
                    'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:offset_left.none',
                    '0',
                ],
                [
                    'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:offset_left.1',
                    '1',
                ],
                [
                    'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:offset_left.2',
                    '2',
                ],
            ],
            'default' => 0,
        ],
    ],
    "offset_right" => [
        'exclude' => true,
        'label' => 'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:offset_right',
        'description' => 'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:offset_right.desc',
        'displayCond' => 'FIELD:layout:!=:22',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                [
                    'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:offset_right.none',
                    '0',
                ],
                [
                    'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:offset_right.1',
                    '1',
                ],
                [
                    'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:offset_right.2',
                    '2',
                ],
            ],
            'default' => 0,
        ],
    ],
];

$GLOBALS['TCA']['tt_content']['columns']['layout']['onChange'] = "reload";

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns("tt_content", $gridColumns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'tt_content',
    'grid',
    'layout;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:layout_formlabel,offset_left,offset_right',
    ''
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    '--palette--;LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:layout_options;grid',
    '',
    'replace:--palette--;;frames'
);
