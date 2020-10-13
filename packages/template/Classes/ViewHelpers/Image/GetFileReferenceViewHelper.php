<?php

namespace MIA3\Template\ViewHelpers\Image;

use TYPO3\CMS\Core\Resource\FileRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Exception;


/**
 * Gets a FileReference-Object from the uid_local field of a FAL
 *
 * Class GetFileReferenceViewHelper
 * @package MIA3\Template\ViewHelpers\Image
 */
class GetFileReferenceViewHelper extends AbstractViewHelper
{
    /**
     * @var bool
     */
    protected $escapeOutput = false;

    /**
     * Initialize arguments.
     *
     * @throws Exception
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('uid_local', 'integer', 'uid_local for sys_file_reference', true);

    }

    /**
     * @return mixed
     */
    public function render()
    {

        $uid = $this->arguments['uid_local'];

        $fileRepository = GeneralUtility::makeInstance(FileRepository::class);
        $fileObject = $fileRepository->findByUid($uid);

        return $fileObject;

    }
}
