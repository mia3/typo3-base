<?php
namespace Mia3\Template\ViewHelpers;


use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class MetaViewHelper extends AbstractViewHelper
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
    }


    /**
     * @param FileReference $file

     * @return mixed|null
     */
    public function render(FileReference $file){
        $property = $this->arguments['property'];
        if(!$property){
            return NULL;
        }
       return $file->getProperty($property);
    }
}