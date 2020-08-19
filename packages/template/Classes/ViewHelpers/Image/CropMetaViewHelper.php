<?php
namespace MIA3\Template\ViewHelpers\Image;


use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class CropMetaViewHelper extends AbstractViewHelper
{

    /**
     * Initialize arguments.
     *
     * @throws \TYPO3Fluid\Fluid\Core\ViewHelper\Exception
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('property', 'string', 'propety Of image');
        $this->registerArgument('image', FileReference::class, 'propety Of image');
    }


    /**
     * @return mixed|null
     */
    public function render(){
        $property = $this->arguments['property'];
        $file = $this->arguments['image'];
        if(!$property){
            return NULL;
        }
        $pathArray = explode( ".", $property);
        $array = json_decode($file->getProperty("crop"), true);
        $string = null;
        foreach ($pathArray as $path){
            if(!$string){
                $string = $array;
            }
            if(!array_key_exists($path, $string)){
                $string = false;
                continue;
            }
            $string = $string[$path];
        }
        return $string;
    }
}
