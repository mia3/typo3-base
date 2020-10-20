<?php

namespace MIA3\Template\ViewHelpers\Image;


use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Exception;

class MetaViewHelper extends AbstractViewHelper
{
    /**
     * Initialize arguments.
     *
     * @throws Exception
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
    public function render(FileReference $file)
    {
        $property = $this->arguments['property'];
        if (!$property) {
            return null;
        }

        return $file->getProperty($property);
    }
}
