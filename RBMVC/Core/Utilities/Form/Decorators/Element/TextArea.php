<?php
/**
 * Created by PhpStorm.
 * User: ricoschulz
 * Date: 27.10.13
 * Time: 02:29
 */

namespace RBMVC\Core\Utilities\Form\Decorators\Element;

/**
 * Class TextArea
 * @package RBMVC\Core\Utilities\Form\Decorators\Element
 */
class TextArea extends AbstractDecorator {

    /**
     * @var string
     */
    private $labelHtml = '<label class="col-lg-2 control-label" for="%s">%s%s</label>';

    /**
     * @var string
     */
    private $inputHtml = '<div class="col-lg-10"><textarea id="%s" style="%s" class="%s" %s name="%s" >%s</textarea></div>';

    /**
     * @var string
     */
    private $errorHtml = '<span class="help-inline">%s</span>';

    /**
     * @var string
     */
    private $borderHtml = '<div class="form-group">%s%s%s</div>';

    /**
     * @param string $template
     *
     * @return string
     */
    public function render($template = '') {
        /** @var \RBMVC\Core\Utilities\Form\Elements\InputElement $element */
        $element = $this->getElement();

        $label = '';
        if ($element->getLabel() != '') {
            $label =
                sprintf($this->labelHtml, $element->getName(), $this->translator->translate($element->getLabel()), ($element->isRequired() ? '*' : ''));
        }

        $placeHolder =
            ($element->getPlaceholder() ? ' placeholder="' . $this->translator->translate($element->getPlaceholder()) . '"' : '');

        $style = 'overflow : scroll; min-height : 300px; width: 100%;';
        $input =
            sprintf($this->inputHtml, $element->getName(), $style, ($element->isRequired() ? ' required' : ''), $placeHolder, $element->getName(), $element->getValue());

        $error = '';
        if ($element->hasError()) {
            $error = sprintf($this->errorHtml, array($this->translator->translate($element->getErrorText())));
        }

        return sprintf($this->borderHtml, ($element->hasError() ? ' has-error' : ''), $label, $input, $error);
    }

}
