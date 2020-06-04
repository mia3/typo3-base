<?php
defined('TYPO3_MODE') || die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'tt_content',
    'frameOptions',
    'frame_class;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:frame_class_formlabel',
    ''
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    '--palette--;LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:frame_options;frameOptions',
    '',
    'after:--palette--;;grid'
);
