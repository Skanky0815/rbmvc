<?php
namespace RBMVC\Core\Utilities\Form\Elements;

use RBMVC\Core\Utilities\Form\Decorators\Element\TextArea;

/**
 * Class TextareaElement
 * @package RBMVC\Core\Utilities\Form\Elements
 */
class TextareaElement extends AbstractElement {

    /**
     * @var integer
     */
    private $rows;

    /**
     * @var string
     */
    private $placeholder;

    /**
     * @param $name
     */
    public function __construct($name) {
        parent::__construct($name, new TextArea());
    }

    /**
     * @return string
     */
    public function getPlaceholder() {
        return $this->placeholder;
    }

    /**
     * @param string $placeholder
     *
     * @return InputElement
     */
    public function setPlaceholder($placeholder) {
        $this->placeholder = $placeholder;

        return $this;
    }
}
