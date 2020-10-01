<?php

defined('TYPO3_MODE') || die();

$GLOBALS['TCA']['tt_content']['types']['image']['columnsOverrides']['image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants'] = [
    'desktop' => [
        'title' => 'Desktop',
        'allowedAspectRatios' => [
            '16by9' => [
                'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.16_9',
                'value' => 16 / 9,
            ],
            '3by2' => [
                'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.3_2',
                'value' => 3 / 2,
            ],
            '4by3' => [
                'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.4_3',
                'value' => 4 / 3,
            ],
            '1by1' => [
                'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.1_1',
                'value' => 1.0,
            ],
            'free' => [
                'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.free',
                'value' => 0.0,
            ],
        ],
        'selectedRatio' => 'free',
        'cropArea' => [
            'x' => 0.0,
            'y' => 0.0,
            'width' => 1.0,
            'height' => 1.0,
        ],
    ],
    'tablet' => [
        'title' => 'Tablet',
        'allowedAspectRatios' => [
            '16by9' => [
                'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.16_9',
                'value' => 16 / 9,
            ],
            '3by2' => [
                'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.3_2',
                'value' => 3 / 2,
            ],
            '4by3' => [
                'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.4_3',
                'value' => 4 / 3,
            ],
            '1by1' => [
                'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.1_1',
                'value' => 1.0,
            ],
            'free' => [
                'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.free',
                'value' => 0.0,
            ],
        ],
        'selectedRatio' => 'free',
        'cropArea' => [
            'x' => 0.0,
            'y' => 0.0,
            'width' => 1.0,
            'height' => 1.0,
        ],
    ],
    'mobile' => [
        'title' => 'Mobile',
        'allowedAspectRatios' => [
            '16by9' => [
                'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.16_9',
                'value' => 16 / 9,
            ],
            '3by2' => [
                'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.3_2',
                'value' => 3 / 2,
            ],
            '4by3' => [
                'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.4_3',
                'value' => 4 / 3,
            ],
            '1by1' => [
                'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.1_1',
                'value' => 1.0,
            ],
            'free' => [
                'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.free',
                'value' => 0.0,
            ],
        ],
        'selectedRatio' => 'free',
        'cropArea' => [
            'x' => 0.0,
            'y' => 0.0,
            'width' => 1.0,
            'height' => 1.0,
        ],
    ],
];
