<?php

namespace MIA3\Template\ViewHelpers\Form;

class TextfieldViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\Form\TextfieldViewHelper
{
    protected $tagName = 'base-input';

    public function render()
    {
        $this->tag->forceClosingTag(true);

        return parent::render();
    }
}
