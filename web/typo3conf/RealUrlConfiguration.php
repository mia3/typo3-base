<?php
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['default'] = array (
  'init' =>
  array (
    'enableCHashCache' => true,
    'appendMissingSlash' => 'ifNotFile,redirect',
    'adminJumpToBackend' => true,
    'enableUrlDecodeCache' => true,
    'enableUrlEncodeCache' => true,
    'emptyUrlReturnValue' => '/',
  ),
  'pagePath' =>
  array (
    'type' => 'user',
    'userFunc' => 'EXT:realurl/class.tx_realurl_advanced.php:&tx_realurl_advanced->main',
    'spaceCharacter' => '-',
    'languageGetVar' => 'L',
    'rootpage_id' => '1',
  ),
  'fileName' =>
  array (
    'defaultToHTMLsuffixOnPrev' => 0,
    'acceptHTMLsuffix' => 1,
    'index' =>
    array (
      'print' =>
      array (
        'keyValues' =>
        array (
          'type' => 98,
        ),
      ),
    ),
  ),
  'preVars' =>
  array (
    0 =>
    array (
      'GETvar' => 'L',
      'valueMap' =>
      array (
        'en' => '1',
      ),
      'noMatch' => 'bypass',
    ),
  ),
);

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['local.mia3.dev'] = $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['default'];
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['local.mia3.dev']['pagePath']['rootpage_id'] = 1;