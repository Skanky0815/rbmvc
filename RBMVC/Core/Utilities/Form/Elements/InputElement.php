<?php
namespace RBMVC\Core\Utilities\Form\Elements;

use RBMVC\Core\Utilities\Form\Decorators\Element\TextInput;

/**
 * Class InputElement
 * @package RBMVC\Core\Utilities\Form\Elements
 */
class InputElement extends AbstractElement {

    /**
     * mini
     */
    const MINI = 'col-lg-2';

    /**
     * small
     */
    const SMALL = 'col-lg-4';

    /**
     * medium
     */
    const MEDIUM = 'col-lg-6';

    /**
     * large
     */
    const LARGE = 'col-lg-8';

    /**
     * c large
     */
    const X_LARGE = 'col-lg-10';

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $placeholder = '';

    /**
     * @var string
     */
    private $size = self::LARGE;

    /**
     * @param string $name
     * @param string $type
     */
    public function __construct($name, $type) {
        $this->type = $type;
        parent::__construct($name, new TextInput());
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

    /**
     * @return string
     */
    public function getSize() {
        return $this->size;
    }

    /**
     * @param string $size
     *
     * @return InputElement
     */
    public function setSize($size) {
        $this->size = $size;

        return $this;
    }

    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return InputElement
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }
}