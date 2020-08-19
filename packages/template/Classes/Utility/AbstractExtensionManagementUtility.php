<?php
namespace MIA3\Template\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;

/**
 * This class is an auxiliary class and can be especially helpful for the TCA.
 * Especially if you outsource language files, it happens more often that the string can become very long, which also makes maintenance difficult.
 * The class should help the developer to become more productive and make the maintenance of structures simpler and easier.
 *
 * Class AbstractExtensionManagementUtility
 * @package MIA3\Template
 */
abstract class AbstractExtensionManagementUtility
{
    const PUBLIC_PATH = "Resources/Public";
    const PRIVATE_PATH = "Resources/Private";

    /**
     * returns a string that contains key and language file to load.
     * the extension xlf is automatically added.
     *
     * @param $key
     * @param string $localLang
     * @return string
     */
    public static function getKeyAndXLF($key, $localLang="locallang_db")
    {
        return 'LLL:'.static::getExtension().'/'.static::PRIVATE_PATH."/Language/${localLang}.xlf:${key}";
    }

    /**
     * Model Translation can get messy very fast.
     * This method 'forces' a Structure to keep translations for models separated and in a specific directory.
     * This is obviously not core behaviour, because the TYPO3 Core doesnt locate them automatically, and will always try to lookup in 'locallang.xlf'
     * You can customize this to your needs if you dont like the current folder Structure or need it more granule.
     *
     * @example
     *      Having a Class named \Vendor\Package\Domain\Model\Product in an extension called 'cart'
     *      This will enforce that your translation files will be located in
     *          EXT:cart/Private/Language/Model/locallang_tx_cart_domain_model_product.xlf:followed.by.your_key
     *
     * @param $key
     * @param $modelClassName
     * @return string
     */
    public static function getTranslationForModel($key, $modelClassName)
    {
        return static::getKeyAndXLF($key, 'Model/locallang_'.static::getTableName($modelClassName) );
    }

    public static function getIconPath($fileName)
    {
        return static::getExtension().'/'.self::PUBLIC_PATH.'/Icons/'.$fileName;
    }

    /**
     * Adds the EXT: prefix to your extensionKey
     * @return string
     */
    public static function getExtension()
    {
        return "EXT:". static::getExtensionKey();
    }

    /**
     * returns the model name which is required for the ext_tables.php
     *
     * @param $className
     * @return string
     * @throws \ReflectionException
     */
    public static function getModelName($className)
    {
        $classMeta = static::getReflection($className);
        return strtolower($classMeta->getShortName());
    }

    /**
     * returns the table name of a domain model from an extension.
     *
     * @param $className
     * @return string
     */
    public static function getTableName($className)
    {
        $ext = static::trimExtKey();
        return "tx_${ext}_domain_model_".static::getModelName($className);
    }

    public static function trimExtKey($delimiter = "_", $extensionKey = null)
    {
        if(!$extensionKey){
            $extensionKey = static::getExtensionKey();
        }
        return implode( '', explode($delimiter,$extensionKey));
    }

    /**
     * @param $pathToFile
     * @param bool $absolute
     * @return string
     */
    public static function getResource($pathToFile, $absolute = true)
    {
        $uri = 'EXT:' . GeneralUtility::camelCaseToLowerCaseUnderscored(static::getExtensionKey()) . '/'.static::PUBLIC_PATH.'/' . $pathToFile;
        $uri = GeneralUtility::getFileAbsFileName($uri);
        if ($absolute === false && $uri !== false) {
            $uri = PathUtility::getAbsoluteWebPath($uri);
        }
        if ($absolute === true) {
            $uri = PathUtility::stripPathSitePrefix($uri);
        }
        return $uri;
    }

    /**
     * @param $className
     * @return \ReflectionClass
     * @throws \ReflectionException
     */
    public static function getReflection($className){
        return new \ReflectionClass($className);
    }

    abstract static function getExtensionKey();
}
