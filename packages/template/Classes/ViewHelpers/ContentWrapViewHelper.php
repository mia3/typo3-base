<?php

namespace MIA3\Template\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Exception;
use TYPO3Fluid\Fluid\Core\ViewHelper\TagBuilder;

class ContentWrapViewHelper extends AbstractViewHelper
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
     * @throws Exception
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('data', 'mixed', 'string to format', true, '');
    }

    /**
     * @return string Rendered tag
     */
    public function render()
    {
        $classes = [];
        $data = $this->arguments ['data'];
        switch ($data['layout']) {
            case 0:
                $classes[] = !!preg_match("/^mask.*$/", $data["CType"], $match) ? 'container-fluid' : 'container';
                break;
            case 21:
                $classes[] = 'container-fluid';
                break;
            case 20:
                $classes[] = 'container';
                break;
            default:
                break;
        }

        if ($data['space_before_class']) {
            $classes[] = 'lineSpace-before--'.$data['space_before_class'];
        }

        if ($data['space_after_class']) {
            $classes[] = 'lineSpace-after--'.$data["space_after_class"];
        }
        $tag = new TagBuilder('div');
        $tag->addAttribute('class', implode(' ', $classes));
        $tag->addAttribute('id', "c".$data['uid']);
        $tag->setContent($this->renderChildren());

        return $tag->render();
    }
}
