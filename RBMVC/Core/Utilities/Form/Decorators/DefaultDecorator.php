<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 11.08.13
 * Time: 19:07
 * To change this template use File | Settings | File Templates.
 */

namespace RBMVC\Core\Utilities\Form\Decorators;

/**
 * Class DefaultDecorator
 * @package RBMVC\Core\Utilities\Form\Decorators
 */
class DefaultDecorator extends AbstractDecorator {

    /**
     * @param string $template
     *
     * @return string
     */
    public function render($template = '') {
        $out = '';

        foreach ($this->getElements() as $element) {
            $out .= $element->render() . "\n";
        }

        return $out;
    }

}