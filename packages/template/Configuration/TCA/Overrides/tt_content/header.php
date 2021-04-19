<?php

defined('TYPO3_MODE') || die();

call_user_func(
    function () {
        $ll = 'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:';

        $temporaryColumns = [
            'header_style' => [
                'exclude' => true,
                'label' => $ll . 'header_style',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [
                            $ll . 'header_style.default',
                            '0',
                        ],
                        [
                            $ll . 'header_style.h1',
                            '1',
                        ],
                        [
                            $ll . 'header_style.h2',
                            '2',
                        ],
                        [
                            $ll . 'header_style.h3',
                            '3',
                        ],
                        [
                            $ll . 'header_style.h4',
                            '4',
                        ],
                    ],
                    'default' => 0,
                ],
            ],
            'header_color' => [
                'exclude' => true,
                'label' => $ll . 'header_color',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [
                            $ll . 'header_color.none',
                            '0',
                        ],
                        [
                            $ll . 'header_color.orange',
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
            'mask_placeholder,mask_slider_df1,mask_teaser_df1,mask_tiles_df1,mask_dividervideo_df1',
            'after:CType'
        );
    }
);

$GLOBALS['TCA']['tt_content']['palettes']['headers']['showitem'] = '
    header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_formlabel,
    header_layout;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_layout_formlabel,
    header_style,
    --linebreak--,
    header_link;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_link_formlabel,
    header_position;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_position_formlabel,
    header_color,
    --linebreak--,
';

$GLOBALS['TCA']['tt_content']['columns']['header']['config'] = [
    'type' => 'text',
    'max' => 255,
    'cols' => 50,
    'rows' => 2,
];
