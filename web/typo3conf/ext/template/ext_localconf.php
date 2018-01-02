<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:template/Configuration/TsConfig/Page.ts">');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:template/Configuration/TsConfig/Rte.ts">');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:template/Configuration/TsConfig/User.ts">');

\FluidTYPO3\Flux\Core::registerProviderExtensionKey('Mia3.Template', 'Page');
\FluidTYPO3\Flux\Core::registerProviderExtensionKey('Mia3.Template', 'Content');

