<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 11.08.13
 * Time: 18:36
 * To change this template use File | Settings | File Templates.
 */

namespace RBMVC\Core\Utilities\Form\Decorators;

/**
 * Class AbstractDecorators
 * @package RBMVC\Core\Utilities\Form\Decorators
 */
abstract class AbstractDecorator {

    /**
     * @var array
     */
    private $elements = array();

    /**
     * @param string $template
     *
     * @return string
     */
    abstract public function render($template = '');

    /**
     * @param array $elements
     *
     * @return \RBMVC\Core\Utilities\Form\Decorators\AbstractDecorator
     */
    public function setElements(array $elements) {
        $this->elements = $elements;

        return $this;
    }

    /**
     * @return array
     */
    public function getElements() {
        return $this->elements;
    }

}