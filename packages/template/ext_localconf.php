<?php
defined('TYPO3_MODE') || die();

/**
 * PageTS
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    '@import "EXT:template/Configuration/TsConfig/Page/All.tsconfig"'
);

/**
 * Flux
 */
\FluidTYPO3\Flux\Core::registerProviderExtensionKey('MIA3.Template', 'Content');

$GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['t'] = ['MIA3\\Template\\ViewHelpers'];
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['default_core'] = $GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['default'];
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['default'] = 'EXT:template/Configuration/RTE/Template.yaml';

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'MIA3.Template',
    'ContactForm',
    [
        \MIA3\Template\Controller\FormController::class => 'contactForm',
    ],
    [
        // Disable cache to prevent form data from being executed twice.
        \MIA3\Template\Controller\FormController::class => 'contactForm',
    ]
);
