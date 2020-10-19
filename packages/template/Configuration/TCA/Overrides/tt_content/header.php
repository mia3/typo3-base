<?php

defined('TYPO3_MODE') || die();

call_user_func(
    function () {
        $temporaryColumns = [
            "header_semantic" => [
                'exclude' => true,
                'label' => 'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:header_semantic',
                'description' => 'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:header_semantic.desc',
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
            'header_style' => [
                'exclude' => true,
                'label' => 'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:header_style',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [
                            'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.default_value',
                            '0',
                        ],
                        [
                            'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_layout.I.1',
                            '1',
                        ],
                        [
                            'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_layout.I.2',
                            '2',
                        ],
                        [
                            'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_layout.I.3',
                            '3',
                        ],
                        [
                            'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_layout.I.4',
                            '4',
                        ],
                        [
                            'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_layout.I.5',
                            '5',
                        ],
                        [
                            'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_layout.I.6',
                            '100',
                        ],
                    ],
                    'default' => 0,
                ],
            ],
            'header_color' => [
                'exclude' => true,
                'label' => 'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:header_color',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [
                            'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:header_color.none',
                            '0',
                        ],
                        [
                            'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:header_color.orange',
                            '1',
                        ],
                    ],
                    'default' => 0,
                ],
            ],
        ];

        TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $temporaryColumns);
        TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
            'tt_content',
            'headers',
            'header_style,header_color',
            'after:header_layout'
        );

        // Adds header palette to mask elements.
        TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
            'tt_content',
            '--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;headers',
            'mask_placeholder',
            'after:CType'
        );
    }
);

$GLOBALS['TCA']['tt_content']['palettes']['headers']["showitem"] = '
    header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_formlabel,
    header_layout;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_layout_formlabel,
    header_semantic,
    --linebreak--,
    header_link;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_link_formlabel,
    header_position;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_position_formlabel,
    header_style,
    --linebreak--,
    header_color
';
