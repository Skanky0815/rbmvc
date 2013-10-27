<?php
/**
 * Created by PhpStorm.
 * User: ricoschulz
 * Date: 27.10.13
 * Time: 02:34
 */

namespace RBMVC\Core\Utilities\Form\Decorators\Element;

/**
 * Class TextInput
 * @package RBMVC\Core\Utilities\Form\Decorators\Element
 */
class TextInput extends AbstractDecorator {

    /**
     * @var string
     */
    private $labelHtml = '<label class="col-lg-2 control-label" for="%s">%s%s</label>';

    /**
     * @var string
     */
    private $inputHtml = '<div class="%s"><input id="%s" class="form-control%s" %s type="%s" name="%s" value="%s" /></div>';

    /**
     * @var string
     */
    private $errorHtml = '<span class="help-inline">%s</span>';

    /**
     * @var string
     */
    private $formGroup = '<div class="form-group%s">%s%s%s</div>';

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
        $input       =
            sprintf($this->inputHtml, $element->getSize(), $element->getName(), ($element->isRequired() ? ' required' : ''),
                $placeHolder,
                $element->getType(),
                $element->getName(),
                $element->getValue(),
                ($element->isRequired() ? ' required' : '')

            );

        $error = '';
        if ($element->hasError()) {
            $error = sprintf($this->errorHtml, array($this->translator->translate($element->getErrorText())));
        }

        return sprintf($this->formGroup, ($element->hasError() ? ' has-error' : ''), $label, $input, $error);
    }

} 