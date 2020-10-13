<?php

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['template_contactform'] = 'recursive, select_key, pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['template_contactform'] = 'pi_flexform';

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'MIA3.Template',
    'ContactForm',
    'Contact form'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'template_contactform',
    'FILE:EXT:template/Configuration/FlexForms/ContactForm.xml'
);
