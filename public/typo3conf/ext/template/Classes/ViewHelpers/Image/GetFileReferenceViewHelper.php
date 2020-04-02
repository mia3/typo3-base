<?php


namespace Mia3\Template\ViewHelpers\Image;


use TYPO3\CMS\Core\Resource\FileRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;


/**
 * Gets a FileReference-Object from the uid_local field of a FAL
 *
 * Class GetFileReferenceViewHelper
 * @package Mia3\Template\ViewHelpers\Image
 */
class GetFileReferenceViewHelper extends AbstractViewHelper {


    /**
     * @var bool
     */
    protected $escapeOutput = false;

    /**
     * Initialize arguments.
     *
     * @throws \TYPO3Fluid\Fluid\Core\ViewHelper\Exception
     */
     public function initializeArguments() {
        parent::initializeArguments();
        $this->registerArgument('uid_local', 'integer', 'uid_local for sys_file_reference', true);

    }

    /**
     * @return mixed
     * @throws \TYPO3\CMS\Extbase\Configuration\Exception\InvalidConfigurationTypeException
     */
    public function render(){

        $uid = $this->arguments['uid_local'];

        $fileRepository = GeneralUtility::makeInstance(FileRepository::class);
        $fileObject = $fileRepository->findByUid($uid);
        return $fileObject;

    }
}