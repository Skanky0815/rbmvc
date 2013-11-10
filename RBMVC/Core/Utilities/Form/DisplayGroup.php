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
use RBMVC\Core\Utilities\Form\Elements\AbstractElement;

/**
 * Class DisplayGroup
 * @package RBMVC\Core\Utilities\Form
 */
class DisplayGroup {

    /**
     * hidden
     */
    const HIDDEN_ELEMENTS = 'hidden';

    /**
     * default
     */
    const DEFAULT_ELEMENTS = 'default';

    /**
     * @var string
     */
    private $name;

    /**
     * @var AbstractElement[]
     */
    private $elements = array();

    /**
     * @var AbstractDecorator
     */
    private $decorator;

    /**
     * @return AbstractDecorator
     */
    public function getDecorator() {
        return $this->decorator;
    }

    /**
     * @param AbstractDecorator $decorator
     *
     * @return AbstractDecorator
     */
    public function setDecorator(AbstractDecorator $decorator) {
        $this->decorator = $decorator;

        return $this;
    }

    /**
     * @return AbstractElement[]
     */
    public function getElements() {
        return $this->elements;
    }

    /**
     * @param array $elements
     *
     * @return DisplayGroup
     */
    public function setElements($elements) {
        $this->elements = $elements;

        return $this;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return DisplayGroup
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function render() {
        return $this->decorator->setElements($this->elements)->render();
    }

}