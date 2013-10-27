<?php
namespace RBMVC\Core\Utilities\Form\Elements;

use RBMVC\Core\Utilities\Form\Decorators\Element\TextInput;

class InputElement extends AbstractElement {

    const MINI = 'col-lg-2';

    const SMALL = 'col-lg-4';

    const MEDIUM = 'col-lg-6';

    const LARGE = 'col-lg-8';

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
    public function getSize() {
        return $this->size;
    }

    /**
     * @param string $size
     *
     * @return \RBMVC\Core\Utilities\Form\Elements\InputElement
     */
    public function setSize($size) {
        $this->size = $size;

        return $this;
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
     * @return \RBMVC\Core\Utilities\Form\Elements\InputElement
     */
    public function setPlaceholder($placeholder) {
        $this->placeholder = $placeholder;

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
     * @return \RBMVC\Core\Utilities\Form\Elements\InputElement
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }
}