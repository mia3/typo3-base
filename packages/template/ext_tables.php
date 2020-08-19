<?php

defined('TYPO3_MODE') || die();
$_EXTKEY = \MIA3\Template\Utility\ExtensionManagementUtility::getExtensionKey();
// Include CSS For Styling Of Backend Preview Of Mask Content Elements
$GLOBALS['TBE_STYLES']['skins'][$_EXTKEY] = [];
$GLOBALS['TBE_STYLES']['skins'][$_EXTKEY]['name'] = $_EXTKEY;
$GLOBALS['TBE_STYLES']['skins'][$_EXTKEY]['stylesheetDirectories'] = [
    'EXT:template/Resources/Public/Styles/BackendComponents/',
];


TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Template');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'MIA3.Template',
    'contact',
    'Simple Contact Form'
);
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['template_contact'] = 'recursive,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['template_contact'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('template_contact',
    'FILE:EXT:template/Configuration/FlexForms/flexform_contact.xml');

