<?php

defined('TYPO3_MODE') || die();

// Include CSS for preview of Mask content elements.
$GLOBALS['TBE_STYLES']['skins']['template'] = [];
$GLOBALS['TBE_STYLES']['skins']['template']['name'] = 'template';
$GLOBALS['TBE_STYLES']['skins']['template']['stylesheetDirectories'] = [
    'EXT:template/Resources/Public/Styles/BackendComponents/',
];
