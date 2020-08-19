<?php
defined('TYPO3_MODE') || die();

/***************
 * PageTS
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . \MIA3\Template\Utility\ExtensionManagementUtility::getExtensionKey() . '/Configuration/TsConfig/Page/All.tsconfig">');

$GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['t'] = ['MIA3\\Template\\ViewHelpers'];
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['default_core'] = $GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['default'];
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['default'] = 'EXT:template/Configuration/RTE/Template.yaml';

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'MIA3.Template',
    'contact',
    [
        \MIA3\Template\Controller\ContactFormController::class => 'submit'
    ],
    // non-cacheable actions
    [
        \MIA3\Template\Controller\ContactFormController::class => ''
    ]
);
