<?php

defined('TYPO3_MODE') || die();

call_user_func(
    function () {
        $temporaryColumns = [
            'header_style' => [
                'exclude' => true,
                'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.type',
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
            'subheader_above' => [
                'exclude' => true,
                'label' => 'Subheader above',
                'config' => [
                    'type' => 'check',
                ],
            ],
        ];

        TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $temporaryColumns);
        TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
            'tt_content',
            'headers',
            'header_style,header_color,subheader_above',
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
