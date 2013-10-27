<?php
namespace RBMVC\Core\Utilities\Form\Elements;

use RBMVC\Core\Utilities\Form\Decorators\Element\Button;

/**
 * Class ButtonElement
 * @package RBMVC\Core\Utilities\Form\Elements
 */
class ButtonElement extends AbstractElement {

    const BTN_PRIMARY = 'btn-primary';

    const BTN_DEFAULT = 'btn-default';

    const BTN_SUCCESS = 'btn-success';

    /**
     * @var string
     */
    private $type = self::BTN_DEFAULT;

    /**
     * @param $name
     */
    public function __construct($name) {
        parent::__construct($name, new Button());
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
     * @return \RBMVC\Core\Utilities\Form\Elements\ButtonElement
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }
}