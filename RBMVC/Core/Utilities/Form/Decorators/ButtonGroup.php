<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 11.08.13
 * Time: 18:44
 * To change this template use File | Settings | File Templates.
 */

namespace RBMVC\Core\Utilities\Form\Decorators;

/**
 * Class ButtonGroup
 * @package RBMVC\Core\Utilities\Form\Decorators
 */
class ButtonGroup extends AbstractDecorator {

    /**
     * @param string $template
     *
     * @return string
     */
    public function render($template = '') {
        $out = '<div class="btn-group">';

        /** @var $element \RBMVC\Core\Utilities\Form\Elements\AbstractElement */
        foreach ($this->getElements() as $element) {
            $out .= $element->render();
        }

        $out .= '</div>';

        return $out;
    }

}