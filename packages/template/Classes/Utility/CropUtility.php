<?php

namespace MIA3\Template\Utility;

use TYPO3\CMS\Core\Imaging\ImageManipulation\CropVariantCollection;
use TYPO3\CMS\Core\Resource\Exception\ResourceDoesNotExistException;
use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Extbase\Service\ImageService;
use TYPO3Fluid\Fluid\Core\ViewHelper\Exception;

class CropUtility
{
    /**
     * @var ImageService
     */
    private $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function getCropImageUrl(
        FileReference $fileReference,
        $cropVariant = 'default',
        $absolute = true,
        $maxWidth = 0,
        $maxHeight = 0
    ) {
        try {
            $crop = $fileReference->getProperty("crop");
            $cropVariantCollection = CropVariantCollection::create((string)$crop);
            $cropArea = $cropVariantCollection->getCropArea($cropVariant);

            $config = [
                'crop' => $cropArea->isEmpty() ? null : $cropArea->makeAbsoluteBasedOnFile($fileReference),
            ];
            if ($maxWidth > 0) {
                $config['width'] = $maxWidth;
            }
            if ($maxHeight > 0) {
                $config['height'] = $maxWidth;
            }
            $processedImage = $this->imageService->applyProcessingInstructions($fileReference, $config);

            return $this->imageService->getImageUri($processedImage, $absolute);

        } catch (ResourceDoesNotExistException $e) {
            // thrown if file does not exist
            throw new Exception($e->getMessage(), 1509741907, $e);
        } catch (\UnexpectedValueException $e) {
            // thrown if a file has been replaced with a folder
            throw new Exception($e->getMessage(), 1509741908, $e);
        } catch (\RuntimeException $e) {
            // RuntimeException thrown if a file is outside of a storage
            throw new Exception($e->getMessage(), 1509741909, $e);
        } catch (\InvalidArgumentException $e) {
            // thrown if file storage does not exist
            throw new Exception($e->getMessage(), 1509741910, $e);
        }
    }

    public function getAbsoluteUrl(FileReference $fileReference)
    {
        $processedImage = $this->imageService->applyProcessingInstructions($fileReference, []);

        return $this->imageService->getImageUri($processedImage, true);
    }
}
