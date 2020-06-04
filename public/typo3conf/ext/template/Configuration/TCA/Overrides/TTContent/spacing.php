<?php
defined('TYPO3_MODE') || die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'tt_content',
    'spacing',
    'space_before_class,--linebreak--,space_after_class',
    ''
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    '--palette--;LLL:EXT:template/Resources/Private/Language/locallang_ttc.xlf:spacing_options;spacing',
    '',
    'after:--palette--;;grid'
);
