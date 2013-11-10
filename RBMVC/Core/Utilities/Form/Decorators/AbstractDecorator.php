<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 11.08.13
 * Time: 18:36
 * To change this template use File | Settings | File Templates.
 */

namespace RBMVC\Core\Utilities\Form\Decorators;

use RBMVC\Core\Utilities\Form\Elements\AbstractElement;

/**
 * Class AbstractDecorators
 * @package RBMVC\Core\Utilities\Form\Decorators
 */
abstract class AbstractDecorator {

    /**
     * @var AbstractElement[]
     */
    private $elements = array();

    /**
     * @return AbstractElement[]
     */
    public function getElements() {
        return $this->elements;
    }

    /**
     * @param AbstractElement[] $elements
     *
     * @return AbstractDecorator
     */
    public function setElements(array $elements) {
        $this->elements = $elements;

        return $this;
    }

    /**
     * @param string $template
     *
     * @return string
     */
    abstract public function render($template = '');

}