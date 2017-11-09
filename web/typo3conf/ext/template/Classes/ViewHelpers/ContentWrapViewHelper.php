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
     *
     * @param array $data
     * @return string Rendered tag
     */
    public function render($data)
    {
        $classes = array();
        switch ($data['layout']) {
            case 21:
                break;

            default:
                $classes[] = 'container';
                break;
        }

        $parts = explode(':', $data['tx_fed_fcefile']);
        if ($parts > 0 && !empty($data['tx_fed_fcefile']) && $data['CType'] == 'fluidcontent_content') {
            $classes[] = 'ce-' . strtolower(str_replace('.html', '', $parts[1]));
        } else {
            $classes[] = 'ce-core-' . $data['CType'];
        }

        $tag = new TagBuilder('div');
        $tag->addAttribute('class', implode(' ', $classes));
        $tag->setContent($this->renderChildren());

        return $tag->render();
    }

}
