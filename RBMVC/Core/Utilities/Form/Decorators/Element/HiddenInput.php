<?php
/**
 * Created by PhpStorm.
 * User: ricoschulz
 * Date: 27.10.13
 * Time: 02:23
 */

namespace RBMVC\Core\Utilities\Form\Decorators\Element;

class HiddenInput extends AbstractDecorator {

    private $inputHtml = '<input id="%s" type="hidden" name="%s" value="%s" />';

    /**
     * @param string $template
     *
     * @return string
     */
    public function render($template = '') {
        return sprintf($this->inputHtml, $this->element->getName(), $this->element->getName(), $this->element->getValue());
    }

}