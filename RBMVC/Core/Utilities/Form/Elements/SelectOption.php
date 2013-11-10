<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 04.08.13
 * Time: 12:18
 * To change this template use File | Settings | File Templates.
 */

namespace RBMVC\Core\Utilities\Form\Elements;

/**
 * Class SelectOption
 * @package RBMVC\Core\Utilities\Form\Elements
 */
class SelectOption {

    /**
     * @var string
     */
    private $label;

    /**
     * @var string
     */
    private $value;

    /**
     * @var bool
     */
    private $isSelected;

    /**
     * @return bool
     */
    public function getIsSelected() {
        return (bool) $this->isSelected;
    }

    /**
     * @param bool $isSelected
     *
     * @return SelectOption
     */
    public function setIsSelected($isSelected) {
        $this->isSelected = $isSelected;

        return $this;
    }

    /**
     * @return string
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return SelectOption
     */
    public function setLabel($label) {
        $this->label = $label;

        return $this;
    }

    /**
     * @return string
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * @param string $value
     *
     * @return SelectOption
     */
    public function setValue($value) {
        $this->value = $value;

        return $this;
    }

    /**
     * @return bool
     */
    public function isSelected() {
        return (bool) $this->isSelected;
    }

}