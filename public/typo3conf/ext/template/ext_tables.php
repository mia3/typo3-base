<?php

defined('TYPO3_MODE') || die();

// Include CSS For Styling Of Backend Preview Of Mask Content Elements
$GLOBALS['TBE_STYLES']['skins'][$_EXTKEY] = [];
$GLOBALS['TBE_STYLES']['skins'][$_EXTKEY]['name'] = $_EXTKEY;
$GLOBALS['TBE_STYLES']['skins'][$_EXTKEY]['stylesheetDirectories'] = [
    'EXT:template/Resources/Public/Build/Backend/',
];
