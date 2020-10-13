<?php

defined('TYPO3_MODE') || die();

/**
 * Default TypoScript for Template
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'template',
    'Configuration/TypoScript',
    'Template'
);
