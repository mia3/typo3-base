<?php
defined('TYPO3_MODE') || die();

call_user_func(
    function () {
        $ll = 'LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:';

        $temporaryColumns = [
            'text_columns' => [
                'label' => $ll . 'text_columns',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [
                            $ll . 'text_columns.one_column',
                            '0',
                        ],
                        [
                            $ll . 'text_columns.two_columns',
                            '1',
                        ],
                    ],
                    'default' => 0,
                ],
            ],
        ];

        TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $temporaryColumns);
        TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
            'tt_content',
            'text_columns',
            'text',
            'after:bodytext'
        );
    }
);
