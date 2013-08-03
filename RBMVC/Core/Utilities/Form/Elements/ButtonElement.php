<?php
namespace RBMVC\Core\Utilities\Form\Elements;

class ButtonElement extends AbstractElement {

    const BTN_PRIMARY = 'btn-primary';
    const BTN_DEFAULT = 'btn-default';
    const BTN_SUCCESS = 'btn-success';

    /**
     * @var string
     */
    private $type = self::BTN_PRIMARY;

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