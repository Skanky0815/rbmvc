<?php
/**
 * Created by PhpStorm.
 * User: ricoschulz
 * Date: 27.10.13
 * Time: 10:58
 */

namespace RBMVC\Core\Utilities\Form\Decorators\Element;

use RBMVC\Core\Utilities\Form\Elements\CheckboxElement;

/**
 * Class Checkbox
 * @package RBMVC\Core\Utilities\Form\Decorators\Element
 */
class Checkbox extends AbstractDecorator {

    /**
     * @var string
     */
    private $formGroup = '<div class="form-group"><div class="col-10 col-lg-offset-2">%s</div></div>';

    /**
     * @var string
     */
    private $htmlCheckbox = '<label><input type="hidden" name="%s" value="0"><input type="checkbox" name="%s" value="1" %s /> %s</label>';

    /**
     * @param string $template
     *
     * @return string
     */
    public function render($template = '') {
        /** @var CheckboxElement $element */
        $element = $this->element;

        $checked  = ((bool) $this->element->getValue() ? ' checked="checked"' : '');
        $checkbox = sprintf($this->htmlCheckbox, $element->getName(), $element->getName(), $checked,
            $this->translator->translate($element->getLabel()));

        return sprintf($this->formGroup, $checkbox);
    }

}