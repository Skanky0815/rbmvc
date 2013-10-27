<?php
/**
 * Created by PhpStorm.
 * User: ricoschulz
 * Date: 27.10.13
 * Time: 11:17
 */

namespace RBMVC\Core\Utilities\Form\Decorators\Element;

use RBMVC\Core\Utilities\Form\Elements\SelectElement;
use RBMVC\Core\Utilities\Form\Elements\SelectOption;

/**
 * Class Select
 * @package RBMVC\Core\Utilities\Form\Decorators\Element
 */
class Select extends AbstractDecorator {

    /**
     * @var string
     */
    private $formGroup = '<div class="form-group">%s%s</div>';

    /**
     * @var string
     */
    private $htmlLabel = '<label class="col-2 control-label" for="%s">%s%s</label>';

    /**
     * @var string
     */
    private $htmlSelect = '<div class="col-4"><select id="%s" class="form-control" name="%s">%s</select></div>';

    /**
     * @var string
     */
    private $htmlOption = '<option value="%s" %s>%s</option>';

    /**
     * @param string $template
     *
     * @return string
     */
    public function render($template = '') {
        /** @var SelectElement $element */
        $element = $this->element;

        $label = sprintf($this->htmlLabel, $element->getName(), $this->translator->translate($element->getLabel()),
            ($element->isRequired() ? '*' : ''));

        $htmlOptions = '';
        foreach ($element->getOptions() as $option) {
            /** @var SelectOption $option */
            $selected = ($option->isSelected() ? 'selected="selected"' : '');
            $htmlOptions .= sprintf($this->htmlOption, $option->getValue(), $selected,
                $this->translator->translate($option->getLabel()));
        }

        $select = sprintf($this->htmlSelect, $element->getName(), $element->getName(), $htmlOptions);

        return sprintf($this->formGroup, $label, $select);
    }

}