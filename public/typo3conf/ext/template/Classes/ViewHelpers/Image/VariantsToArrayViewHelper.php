<?php
namespace Mia3\Template\ViewHelpers\Image;


use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class VariantsToArrayViewHelper extends AbstractViewHelper
{

    /**
     * Initialize arguments.
     *
     * @throws \TYPO3Fluid\Fluid\Core\ViewHelper\Exception
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('file', 'mixed' , 'propety Of image');
    }


    /**

     * @return mixed|null
     */
    public function render(){
        $file = $this->arguments['file'];
        $fileReferenceClass = get_class($file);
        if($fileReferenceClass == FileReference::class){
            /** @var FileReference $file */
            return json_decode($file->getProperty("crop"), true);
        }elseif($fileReferenceClass == \GeorgRinger\News\Domain\Model\FileReference::class){
            /** @var \GeorgRinger\News\Domain\Model\FileReference $file */
            return json_decode($file->getOriginalResource()->getProperty('crop'), true);
        }


    }
}