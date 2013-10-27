<?php
/**
 * Created by PhpStorm.
 * User: ricoschulz
 * Date: 27.10.13
 * Time: 02:06
 */

namespace RBMVC\Core\Utilities\Form\Decorators\Element;

use RBMVC\Core\Translator;
use RBMVC\Core\Utilities\Form\Elements\AbstractElement;

/**
 * Class AbstractDecorator
 * @package RBMVC\Core\Utilities\Form\Decorators\Element
 */
abstract class AbstractDecorator {

    /**
     * @var \RBMVC\Core\Utilities\Form\Elements\AbstractElement
     */
    protected $element = null;

    /**
     * @var \RBMVC\Core\Translator
     */
    protected $translator = null;

    /**
     *
     */
    function __construct() {
        $this->translator = Translator::getInstance();
    }

    /**
     * @return \RBMVC\Core\Utilities\Form\Elements\AbstractElement
     */
    public function getElement() {
        return $this->element;
    }

    /**
     * @param \RBMVC\Core\Utilities\Form\Elements\AbstractElement $elements
     *
     * @return \RBMVC\Core\Utilities\Form\Decorators\Element\AbstractDecorator
     */
    public function setElement(AbstractElement $elements) {
        $this->element = $elements;

        return $this;
    }

    /**
     * @param string $template
     *
     * @return string
     */
    abstract public function render($template = '');

}