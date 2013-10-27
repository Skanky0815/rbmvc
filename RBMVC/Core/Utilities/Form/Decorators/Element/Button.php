<?php
/**
 * Created by PhpStorm.
 * User: ricoschulz
 * Date: 27.10.13
 * Time: 02:39
 */

namespace RBMVC\Core\Utilities\Form\Decorators\Element;

/**
 * Class Button
 * @package RBMVC\Core\Utilities\Form\Decorators\Element
 */
class Button extends AbstractDecorator {

    /**
     * @var string
     */
    private $buttonHtml = '<button class="btn %s" name="%s" value="%s">%s</button>';

    /**
     * @param string $template
     *
     * @return string
     */
    public function render($template = '') {
        /** @var \RBMVC\Core\Utilities\Form\Elements\ButtonElement $element */
        $element = $this->element;

        return sprintf($this->buttonHtml, $element->getType(), $element->getName(), $element->getValue(), $this->translator->translate($element->getName()));
    }

} 