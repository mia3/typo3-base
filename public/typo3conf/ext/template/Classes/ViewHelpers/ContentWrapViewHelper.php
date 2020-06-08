<?php
namespace Mia3\Template\ViewHelpers;

/*                                                                        *
 * This script is part of the TYPO3 project - inspiring people to share!  *
 *                                                                        *
 * TYPO3 is free software; you can redistribute it and/or modify it under *
 * the terms of the GNU General Public License version 2 as published by  *
 * the Free Software Foundation.                                          *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General      *
 * Public License for more details.                                       *
 *                                                                        */

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Frontend\Category\Collection\CategoryCollection;
use TYPO3\CMS\Extbase\Service\FlexFormService;
use TYPO3\CMS\Fluid\Core\ViewHelper\TagBuilder;

/**
 */
class ContentWrapViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * Specifies whether the escaping interceptors should be disabled or enabled for the render-result of this ViewHelper
     * @see isOutputEscapingEnabled()
     *
     * @var boolean
     * @api
     */
    protected $escapeOutput = false;

    /**
     * Initialize arguments.
     *
     * @throws \TYPO3Fluid\Fluid\Core\ViewHelper\Exception
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('data', "mixed", 'string to format',true, "");
    }

    /**
     *
     * @param array $data
     * @return string Rendered tag
     */
    public function render()
    {
        $classes = array();
        $classes[] = 'contentWrapper';

        $data = $this->arguments ["data"];
        switch ($data['layout']) {
            case 21:
                $classes[] = "contentWrapper--center";  break;
            case 22:
                $classes[] = "contentWrapper--fullWidth"; break;
            default:
                break;
        }

        if($data["space_before_class"]){
            $classes[] = 'lineSpaceBefore--'.$data["space_before_class"];
        }

        if($data["space_after_class"]){
            $classes[] = 'lineSpaceAfter--'.$data["space_after_class"];
        }

        if($data["content_padding_top"]){
            $classes[] = 'linePaddingTop--'.$data["content_padding_top"];
        }

        if($data["content_padding_bottom"]){
            $classes[] = 'linePaddingBottom--'.$data["content_padding_bottom"];
        }

        if($data["offset_left"] && $data['layout'] != 22){
            $classes[] = 'offsetLeft--'.$data["offset_left"];
        }

        if($data["offset_right"] && $data['layout'] != 22){
            $classes[] = 'offsetRight--'.$data["offset_right"];
        }

        if($data["content_background_color"]){
            $classes[] = 'backgroundcolor--'.$data["content_background_color"];
        }

        $tag = new TagBuilder('div');
        $tag->addAttribute('class', implode(' ', $classes));
        $tag->addAttribute('id', "c" . $data['uid']);
        $tag->setContent($this->renderChildren());

        return $tag->render();
    }

}
