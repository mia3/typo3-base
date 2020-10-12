<?php

namespace MIA3\Template\ViewHelpers\Form;

/**
 * ViewHelper which creates a text field :html:`<base-input type="text">`.
 *
 * Examples
 * ========
 *
 * Example::
 *
 *    <t:form.textfield name="myTextBox" value="default value" />
 *
 * Output::
 *
 *    <base-input type="text" name="myTextBox" value="default value"></base-input>
 */
class TextfieldViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\Form\TextfieldViewHelper
{
    /**
     * @var string
     */
    protected $tagName = 'base-input';

    /**
     * Renders the textfield.
     *
     * @return string
     */
    public function render()
    {
        $this->tag->forceClosingTag(true);

        return parent::render();
    }
}
