<?php
defined('TYPO3_MODE') || die();

$condFce = [
    "OR" => [
        'FIELD:CType:=:header',
        'FIELD:CType:=:text'
    ]
];
$GLOBALS['TCA']['tt_content']['columns']['header_link']['displayCond'] = $condFce;
$GLOBALS['TCA']['tt_content']['columns']['header']['displayCond'] = $condFce;
$GLOBALS['TCA']['tt_content']['columns']['header_layout']['displayCond'] = $condFce;
$GLOBALS['TCA']['tt_content']['columns']['header_position']['displayCond'] = $condFce;

$headerColumns = [
    "header_semantic" => [
        'exclude' => true,
        'label' => 'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:header_semantic',
        'description' => 'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:header_semantic.desc',
        'displayCond' => $condFce,
        'config' => [
            'type' => 'check',
            'renderType' => 'checkboxToggle',
            'items' => [
                [
                    0 => '',
                    1 => '',
                ]
            ],
            "default" => 1
        ]
    ],
    "header_styles" => [
        'exclude' => true,
        'label' => 'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:header_styles',
        'displayCond' => $condFce,
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                [
                    'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:header_styles.none',
                    '0'
                ],
                [
                    'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:header_styles.uppercase',
                    'text--uppercase'
                ],
            ],
            'default' => 0
        ]
    ]
];
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns("tt_content", $headerColumns);

$GLOBALS['TCA']['tt_content']['palettes']['headers']["showitem"] = '
    header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_formlabel,
    header_layout;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_layout_formlabel,
    header_semantic,
    --linebreak--,
    header_link;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_link_formlabel,
    header_position;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_position_formlabel,
    header_styles,
';
