<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 04.08.13
 * Time: 12:09
 * To change this template use File | Settings | File Templates.
 */

namespace RBMVC\Core\Utilities\Form\Elements;

use RBMVC\Core\Utilities\Form\Decorators\Element\Select;

/**
 * Class SelectElement
 * @package RBMVC\Core\Utilities\Form\Elements
 */
class SelectElement extends AbstractElement {

    /**
     * @var SelectOption[]
     */
    private $options = array();

    /**
     * @param $name
     */
    public function __construct($name) {
        parent::__construct($name, new Select());
    }

    /**
     * @return SelectOption[]
     */
    public function getOptions() {
        return $this->options;
    }

    /**
     * @param SelectOption[]|array $options
     *
     * @return SelectElement
     */
    public function setOptions(array $options) {
        foreach ($options as $label => $option) {
            if (!$option instanceof SelectOption) {
                $data   = $option;
                $option = new SelectOption();
                $option->setLabel($label);
                $option->setValue($data);
            }

            $this->options[] = $option;
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return SelectElement
     */
    public function setValue($value) {
        parent::setValue($value);

        foreach ($this->options as $option) {
            if ($this->value == $option->getValue()) {
                $option->setIsSelected(true);
            }
        }

        return $this;
    }

}