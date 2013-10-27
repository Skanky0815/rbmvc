<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 11.08.13
 * Time: 18:34
 * To change this template use File | Settings | File Templates.
 */

namespace RBMVC\Core\Utilities\Form;

use RBMVC\Core\Utilities\Form\Decorators\AbstractDecorator;

/**
 * Class DisplayGroup
 * @package RBMVC\Core\Utilities\Form
 */
class DisplayGroup {

    const HIDDEN_ELEMENTS = 'hidden';

    const DEFAULT_ELEMENTS = 'default';

    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $elements = array();

    /**
     * @var \RBMVC\Core\Utilities\Form\Decorators\AbstractDecorator
     */
    private $decorator;

    /**
     * @param \RBMVC\Core\Utilities\Form\Decorators\AbstractDecorator $decorator
     *
     * @return \RBMVC\Core\Utilities\Form\Decorators\AbstractDecorator
     */
    public function setDecorator(AbstractDecorator $decorator) {
        $this->decorator = $decorator;

        return $this;
    }

    /**
     * @return \RBMVC\Core\Utilities\Form\Decorators\AbstractDecorator
     */
    public function getDecorator() {
        return $this->decorator;
    }

    /**
     * @param array $elements
     *
     * @return \RBMVC\Core\Utilities\Form\DisplayGroup
     */
    public function setElements($elements) {
        $this->elements = $elements;

        return $this;
    }

    /**
     * @return array
     */
    public function getElements() {
        return $this->elements;
    }

    /**
     * @param string $name
     *
     * @return \RBMVC\Core\Utilities\Form\DisplayGroup
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return string
     */
    public function render() {
        return $this->decorator->setElements($this->elements)->render();
    }

}