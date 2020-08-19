<?php

namespace MIA3\Template\ViewHelpers;

use Closure;
use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithContentArgumentAndRenderStatic;

class NavigationSliderViewHelper extends AbstractViewHelper
{
    use CompileWithContentArgumentAndRenderStatic;

    public function initializeArguments()
    {
        parent::initializeArguments();

        $this->registerArgument('slides', 'array', 'Mask Slides');
    }

    /**
     * Applies nl2br() on the specified value.
     *
     * @param array $arguments
     * @param Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return string
     */
    public static function renderStatic(
        array $arguments,
        Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ): string {
        $vueFriendlySlides = [];

        foreach ($arguments['slides'] as $slide) {
            $icon = isset($slide['tx_mask_icon'][0]) ? $slide['tx_mask_icon'][0] : '';
            $background = isset($slide['tx_mask_content_background'][0]) ? $slide['tx_mask_content_background'][0] : '';

            if (is_a($icon, FileReference::class)) {
                /** @var FileReference $icon */
                $icon = '/'.$icon->getPublicUrl();
            }

            if (is_a($background, FileReference::class)) {
                /** @var FileReference $icon */
                $background = '/'.$background->getPublicUrl();
            }

            $vueFriendlySlides[] = [
                'uid' => $slide['uid'],
                'label' => $slide['tx_mask_label'],
                'type' => $slide['tx_mask_type'],
                'content' => $slide['tx_mask_content'],
                'icon' => $icon,
                'background' => $background,
            ];
        }

        return json_encode($vueFriendlySlides);
    }
}
